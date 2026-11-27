<?php

namespace App\Http\Controllers\ProductionSupervisor;

use App\Http\Controllers\Controller;
use App\Models\CorrectiveAction;
use App\Models\Factory;
use App\Models\ProductionLine;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CorrectiveActionController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $actions = CorrectiveAction::where('company_id', $user->company_id)
            ->where('recorded_by', $user->id)
            ->with(['factory', 'productionLine', 'machine'])
            ->latest()
            ->paginate(10);

        return view(
            'production-supervisor.corrective-actions.index',
            compact('actions')
        );
    }

    public function create(Request $request)
    {
        $assignments = $request->user()
            ->assignments()
            ->with(['factory', 'productionLine', 'machine'])
            ->where('company_id', $request->user()->company_id)
            ->where('status', 'active')
            ->get();

        abort_if($assignments->isEmpty(), 403);

        return view(
            'production-supervisor.corrective-actions.create',
            compact('assignments')
        );
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'factory_id' => ['required', 'integer'],
            'production_line_id' => ['nullable', 'integer'],
            'machine_id' => ['nullable', 'integer'],
            'title' => ['required', 'string', 'max:255'],
            'instruction' => ['required', 'string', 'max:5000'],
            'priority' => ['required', Rule::in(['low', 'medium', 'high'])],
            'due_date' => ['nullable', 'date', 'after_or_equal:today'],
        ]);

        $factoryExists = Factory::where('id', $validated['factory_id'])
            ->where('company_id', $user->company_id)
            ->exists();

        abort_unless($factoryExists, 403);

        if (!empty($validated['production_line_id'])) {
            $lineExists = ProductionLine::where(
                'id',
                $validated['production_line_id']
            )
                ->where('company_id', $user->company_id)
                ->where('factory_id', $validated['factory_id'])
                ->exists();

            abort_unless($lineExists, 403);
        }

        if (!empty($validated['machine_id'])) {
            abort_unless(!empty($validated['production_line_id']), 422);

            $machineExists = Machine::where('id', $validated['machine_id'])
                ->where('company_id', $user->company_id)
                ->where('production_line_id', $validated['production_line_id'])
                ->exists();

            abort_unless($machineExists, 403);
        }

        $assignments = $user->assignments()
            ->where('company_id', $user->company_id)
            ->where('factory_id', $validated['factory_id'])
            ->where('status', 'active')
            ->get();

        $authorized = $assignments->contains(function ($assignment) use ($validated) {
            if (
                $assignment->production_line_id !== null &&
                (int) $assignment->production_line_id !== (int) ($validated['production_line_id'] ?? 0)
            ) {
                return false;
            }

            if (
                $assignment->machine_id !== null &&
                (int) $assignment->machine_id !== (int) ($validated['machine_id'] ?? 0)
            ) {
                return false;
            }

            return true;
        });

        abort_unless($authorized, 403);

        CorrectiveAction::create([
            'company_id' => $user->company_id,
            'factory_id' => $validated['factory_id'],
            'production_line_id' => $validated['production_line_id'] ?? null,
            'machine_id' => $validated['machine_id'] ?? null,
            'title' => $validated['title'],
            'instruction' => $validated['instruction'],
            'priority' => $validated['priority'],
            'due_date' => $validated['due_date'] ?? null,
            'status' => 'pending',
            'recorded_by' => $user->id,
        ]);

        return redirect()
            ->route('production-supervisor.corrective-actions.index')
            ->with('success', 'Corrective action recorded successfully.');
    }

    public function updateExecution(Request $request, CorrectiveAction $correctiveAction)
    {
        $user = $request->user();

        abort_unless(
            $correctiveAction->company_id === $user->company_id &&
            $correctiveAction->recorded_by === $user->id,
            404
        );

        $assignment = $user->assignments()
            ->where('company_id', $user->company_id)
            ->where('factory_id', $correctiveAction->factory_id)
            ->where('status', 'active')
            ->get()
            ->contains(function ($assignment) use ($correctiveAction) {
                if (
                    $assignment->production_line_id !== null &&
                    (int) $assignment->production_line_id !==
                        (int) $correctiveAction->production_line_id
                ) {
                    return false;
                }

                if (
                    $assignment->machine_id !== null &&
                    (int) $assignment->machine_id !==
                        (int) $correctiveAction->machine_id
                ) {
                    return false;
                }

                return true;
            });

        abort_unless($assignment, 403);

        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in(['pending', 'in_progress', 'completed']),
            ],
            'execution_notes' => ['nullable', 'string', 'max:5000'],
        ]);

        $correctiveAction->update([
            'status' => $validated['status'],
            'execution_notes' => $validated['execution_notes'] ?? null,
        ]);

        return redirect()
            ->route('production-supervisor.corrective-actions.index')
            ->with('success', 'Execution progress updated successfully.');
    }
}
