<?php

namespace App\Http\Controllers\QualityEngineer;

use App\Http\Controllers\Controller;
use App\Models\Defect;
use App\Models\Factory;
use App\Models\Machine;
use App\Models\ProductionLine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use App\Models\Inspection;



class DefectController extends Controller
{
    /**
     * Get the authenticated application user.
     */
    private function authenticatedUser(): User
    {
        $user = Auth::user();

        abort_unless($user instanceof User, 403);

        return $user;
    }

    /**
     * Display all company defects.
     */
    public function index(Request $request)
    {
        $user = $this->authenticatedUser();
        $companyId = $user->company_id;

        abort_unless($companyId, 403);

        $query = Defect::where('company_id', $companyId)
            ->with([
                'factory',
                'productionLine',
                'machine',
                'reporter',
            ]);

        if ($request->filled('severity')) {
            $query->where('severity', $request->severity);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('batch_number', 'like', "%{$search}%")
                    ->orWhere('product_code', 'like', "%{$search}%")
                    ->orWhere('defect_type', 'like', "%{$search}%");
            });
        }

        $defects = $query->latest()
            ->paginate(15)
            ->withQueryString();

        return view(
            'quality-engineer.defects.index',
            compact('defects')
        );
    }

    /**
     * Show the defect creation form.
     */
    public function create(Request $request)
    {
        $user = $this->authenticatedUser();
        $companyId = $user->company_id;

        abort_unless($companyId, 403);

        $inspection = null;

        if ($request->filled('inspection_id')) {
            $inspection = Inspection::where('company_id', $companyId)
                ->findOrFail($request->input('inspection_id'));
        }

        $factories = Factory::where('company_id', $companyId)
            ->where('status', 'active')
            ->orderBy('name', 'asc')
            ->get();

        $productionLines = ProductionLine::whereHas(
            'factory',
            fn($query) => $query->where('company_id', $companyId)
        )
            ->orderBy('name')
            ->get();

        $machines = Machine::whereHas(
            'productionLine.factory',
            fn($query) => $query->where('company_id', $companyId)
        )
            ->orderBy('name')
            ->get();

        return view(
            'quality-engineer.defects.create',
            compact('factories', 'productionLines', 'machines', 'inspection')
        );
    }

    /**
     * Store a new defect record.
     */

    public function store(Request $request)
    {
        $user = $this->authenticatedUser();
        $companyId = $user->company_id;

        abort_unless($companyId, 403);

        $validated = $request->validate([
            'inspection_id' => [
                'nullable',
                'integer',
                Rule::exists('inspections', 'id')
                    ->where('company_id', $companyId),
            ],

            'factory_id' => [
                'nullable',
                'integer',
                Rule::exists('factories', 'id')
                    ->where('company_id', $companyId),
            ],

            'production_line_id' => [
                'nullable',
                'integer',
                Rule::exists('production_lines', 'id'),
            ],

            'machine_id' => [
                'nullable',
                'integer',
                Rule::exists('machines', 'id'),
            ],

            'batch_number' => ['nullable', 'string', 'max:255'],
            'product_code' => ['nullable', 'string', 'max:255'],

            'defect_type' => ['required', 'string', 'max:255'],

            'severity' => [
                'required',
                Rule::in(['low', 'medium', 'high', 'critical']),
            ],

            'defect_quantity' => ['required', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
            'detected_at' => ['nullable', 'date'],
        ]);

        $this->validateManufacturingHierarchy(
            $validated,
            $companyId
        );

        // Verify that linked inspection belongs to the same
        // factory, production line and machine.
        if (!empty($validated['inspection_id'])) {

            $inspection = Inspection::where('company_id', $companyId)
                ->findOrFail($validated['inspection_id']);

            foreach (
                [
                    'factory_id',
                    'production_line_id',
                    'machine_id',
                ] as $field
            ) {

                if (($validated[$field] ?? null) != $inspection->$field) {
                    throw ValidationException::withMessages([
                        $field => 'The selected production information does not match the linked inspection.',
                    ]);
                }
            }
        }

        $defect = Defect::create([
            ...$validated,

            'company_id' => $companyId,
            'reported_by' => $user->id,
            'status' => 'open',
            'detected_at' => $validated['detected_at'] ?? now(),
        ]);

        return redirect()
            ->route('qe.defects.show', $defect->id)
            ->with('success', 'Defect record created successfully.');
    }


    /**
     * Display a single company defect.
     */
    public function show(int $id)
    {
        $user = $this->authenticatedUser();
        $companyId = $user->company_id;

        abort_unless($companyId, 403);

        $defect = Defect::where('company_id', $companyId)
            ->with([
                'factory',
                'productionLine',
                'machine',
                'reporter',
                'inspection',
            ])
            ->findOrFail($id);

        return view(
            'quality-engineer.defects.show',
            compact('defect')
        );
    }

    /**
     * Update defect severity and status.
     */
    public function update(Request $request, int $id)
    {
        $user = $this->authenticatedUser();
        $companyId = $user->company_id;

        abort_unless($companyId, 403);

        $defect = Defect::where('company_id', $companyId)
            ->findOrFail($id);

        $validated = $request->validate([
            'severity' => [
                'required',
                Rule::in(['low', 'medium', 'high', 'critical']),
            ],

            'status' => [
                'required',
                Rule::in(['open', 'investigating', 'resolved']),
            ],

            'resolution_notes' => ['nullable', 'string'],
        ]);

        $validated['resolved_at'] =
            $validated['status'] === 'resolved'
            ? ($defect->resolved_at ?? now())
            : null;

        $defect->update($validated);

        return redirect()
            ->route('qe.defects.show', $defect->id)
            ->with('success', 'Defect record updated successfully.');
    }

    /**
     * Validate Factory -> Production Line -> Machine hierarchy.
     */
    private function validateManufacturingHierarchy(
        array $data,
        int $companyId
    ): void {
        if (!empty($data['production_line_id'])) {
            $line = ProductionLine::where(
                'id',
                $data['production_line_id']
            )
                ->whereHas(
                    'factory',
                    fn($query) => $query->where(
                        'company_id',
                        $companyId
                    )
                )
                ->first();

            if (!$line) {
                throw ValidationException::withMessages([
                    'production_line_id' =>
                    'The selected production line does not belong to your company.',
                ]);
            }

            if (
                !empty($data['factory_id']) &&
                $line->factory_id != $data['factory_id']
            ) {
                throw ValidationException::withMessages([
                    'production_line_id' =>
                    'The selected production line does not belong to the selected factory.',
                ]);
            }
        }

        if (!empty($data['machine_id'])) {
            $machine = Machine::where(
                'id',
                $data['machine_id']
            )
                ->whereHas(
                    'productionLine.factory',
                    fn($query) => $query->where(
                        'company_id',
                        $companyId
                    )
                )
                ->first();

            if (!$machine) {
                throw ValidationException::withMessages([
                    'machine_id' =>
                    'The selected machine does not belong to your company.',
                ]);
            }

            if (
                !empty($data['production_line_id']) &&
                $machine->production_line_id != $data['production_line_id']
            ) {
                throw ValidationException::withMessages([
                    'machine_id' =>
                    'The selected machine does not belong to the selected production line.',
                ]);
            }
        }
    }
}
