<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\Http\Controllers\Controller;
use App\Models\Factory;
use App\Models\Machine;
use App\Models\ProductionLine;
use App\Models\User;
use App\Models\UserAssignment;
use App\Services\UserAssignmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserAssignmentController extends Controller
{
    public function index(Request $request)
    {
        $companyId = $request->user()->company_id;

        abort_unless($companyId, 403);

        $users = User::where('company_id', $companyId)
            ->where('role', 'quality_engineer')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $factories = Factory::where('company_id', $companyId)
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $productionLines = ProductionLine::where('company_id', $companyId)
            ->where('status', 'active')
            ->with('factory')
            ->orderBy('name')
            ->get();

        $machines = Machine::where('company_id', $companyId)
            ->where('status', 'active')
            ->with('productionLine')
            ->orderBy('name')
            ->get();

        $assignments = UserAssignment::where('company_id', $companyId)
            ->with(['user', 'factory', 'productionLine', 'machine', 'assigner'])
            ->latest()
            ->get();

        return view('company-admin.assignments.index', compact(
            'users',
            'factories',
            'productionLines',
            'machines',
            'assignments'
        ));
    }

    public function store(Request $request, UserAssignmentService $assignmentService)
    {
        $companyId = $request->user()->company_id;

        abort_unless($companyId, 403);

        $validated = $request->validate([
            'user_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id')
                    ->where('company_id', $companyId)
                    ->where('role', 'quality_engineer')
                    ->where('is_active', true),
            ],
            'factory_id' => [
                'required',
                'integer',
                Rule::exists('factories', 'id')
                    ->where('company_id', $companyId)
                    ->where('status', 'active'),
            ],
            'production_line_id' => [
                'nullable',
                'integer',
                Rule::exists('production_lines', 'id')
                    ->where('company_id', $companyId)
                    ->where('status', 'active'),
            ],
            'machine_id' => [
                'nullable',
                'integer',
                Rule::exists('machines', 'id')
                    ->where('company_id', $companyId)
                    ->where('status', 'active'),
            ],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $assignmentData = [
            ...$validated,
            'company_id' => $companyId,
            'assigned_by' => $request->user()->id,
        ];

        $assignmentService->validate($assignmentData);

        DB::transaction(function () use ($assignmentData) {
            UserAssignment::create([
                ...$assignmentData,
                'assigned_at' => now()->toDateString(),
                'status' => 'active',
            ]);
        });

        return redirect()
            ->route('company-admin.assignments.index')
            ->with('success', 'User assignment created successfully.');
    }

    public function end(Request $request, int $id)
    {
        $companyId = $request->user()->company_id;

        abort_unless($companyId, 403);

        $assignment = UserAssignment::where('company_id', $companyId)
            ->whereKey($id)
            ->firstOrFail();

        if ($assignment->status !== 'active') {
            return back()->with('error', 'This assignment is already inactive.');
        }

        $assignment->update([
            'status' => 'ended',
            'ended_at' => now()->toDateString(),
        ]);

        return back()->with('success', 'Assignment ended successfully.');
    }
}
