<?php

namespace App\Http\Controllers\ProductionSupervisor;

use App\Http\Controllers\Controller;
use App\Models\OperationalIssue;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OperationalIssueController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user->hasRole(\App\UserRole::PRODUCTION_SUPERVISOR),
            403
        );

        $issues = OperationalIssue::query()
            ->where('company_id', $user->company_id)
            ->where('reported_by', $user->id)
            ->with(['factory', 'productionLine', 'machine'])
            ->latest()
            ->paginate(10);

        return view(
            'production-supervisor.operational-issues.index',
            compact('user', 'issues')
        );
    }

    public function create(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user->hasRole(\App\UserRole::PRODUCTION_SUPERVISOR),
            403
        );

        $assignments = $user->assignments()
            ->with(['factory', 'productionLine', 'machine'])
            ->where('status', 'active')
            ->get();

        abort_if(
            $assignments->isEmpty(),
            403,
            'No active production assignment found.'
        );

        return view(
            'production-supervisor.operational-issues.create',
            compact('user', 'assignments')
        );
    }

    public function store(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user->hasRole(\App\UserRole::PRODUCTION_SUPERVISOR),
            403
        );

        $validated = $request->validate([
            'factory_id' => ['required', 'integer'],
            'production_line_id' => ['nullable', 'integer'],
            'machine_id' => ['nullable', 'integer'],
            'title' => ['required', 'string', 'max:255'],
            'issue_type' => [
                'required',
                Rule::in([
                    'machine_malfunction',
                    'operational_blocker',
                ]),
            ],
            'severity' => [
                'required',
                Rule::in(['low', 'medium', 'high', 'critical']),
            ],
            'description' => ['required', 'string', 'max:5000'],
        ]);

        $assignmentQuery = $user->assignments()
            ->where('status', 'active')
            ->where('company_id', $user->company_id)
            ->where('factory_id', $validated['factory_id']);

        if (!empty($validated['production_line_id'])) {
            $assignmentQuery->where(
                'production_line_id',
                $validated['production_line_id']
            );
        }

        if (!empty($validated['machine_id'])) {
            $assignmentQuery->where(
                'machine_id',
                $validated['machine_id']
            );
        }

        abort_unless(
            $assignmentQuery->exists(),
            403,
            'You are not assigned to the selected production resources.'
        );

        $factoryExists = \App\Models\Factory::query()
            ->where('id', $validated['factory_id'])
            ->where('company_id', $user->company_id)
            ->exists();

        abort_unless($factoryExists, 403);

        if (!empty($validated['production_line_id'])) {
            $lineExists = \App\Models\ProductionLine::query()
                ->where('id', $validated['production_line_id'])
                ->where('factory_id', $validated['factory_id'])
                ->exists();

            abort_unless($lineExists, 403);
        }

        if (!empty($validated['machine_id'])) {
            $machineQuery = \App\Models\Machine::query()
                ->where('id', $validated['machine_id'])
                ->where('company_id', $user->company_id);

            if (!empty($validated['production_line_id'])) {
                $machineQuery->where(
                    'production_line_id',
                    $validated['production_line_id']
                );
            }

            abort_unless($machineQuery->exists(), 403);
        }

        OperationalIssue::create([
            'company_id' => $user->company_id,
            'factory_id' => $validated['factory_id'],
            'production_line_id' => $validated['production_line_id'] ?? null,
            'machine_id' => $validated['machine_id'] ?? null,
            'title' => $validated['title'],
            'issue_type' => $validated['issue_type'],
            'severity' => $validated['severity'],
            'description' => $validated['description'],
            'status' => 'reported',
            'reported_by' => $user->id,
        ]);

        return redirect()
            ->route('production-supervisor.operational-issues.index')
            ->with('success', 'Operational issue reported successfully.');
    }

    public function updateStatus(Request $request, OperationalIssue $operationalIssue)
    {
        $user = $request->user();

        abort_unless(
            $user->hasRole(\App\UserRole::PRODUCTION_SUPERVISOR),
            403
        );

        abort_unless(
            $operationalIssue->company_id === $user->company_id
            && $operationalIssue->reported_by === $user->id,
            404
        );

        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in(['reported', 'under_review', 'resolved']),
            ],
        ]);

        $operationalIssue->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('production-supervisor.operational-issues.index')
            ->with('success', 'Issue status updated successfully.');
    }
}
