<?php

namespace App\Http\Controllers\QualityEngineer;

use App\Http\Controllers\Controller;
use App\Models\Defect;
use App\Models\Factory;
use App\Models\Inspection;
use App\Models\Machine;
use App\Models\ProductionLine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class InspectionController extends Controller
{
    /**
     * Get authenticated application user.
     */
    private function authenticatedUser(): User
    {
        $user = Auth::user();

        abort_unless($user instanceof User, 403);

        return $user;
    }

    /**
     * Display company inspections.
     */
    public function index(Request $request)
    {
        $user = $this->authenticatedUser();
        $companyId = $user->company_id;

        abort_unless($companyId, 403);

        $query = Inspection::where('company_id', $companyId)
            ->with([
                'factory',
                'productionLine',
                'machine',
                'inspector',
            ]);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('result')) {
            $query->where('result', $request->result);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('inspection_number', 'like', "%{$search}%")
                    ->orWhere('inspection_type', 'like', "%{$search}%")
                    ->orWhereHas('factory', function ($factoryQuery) use ($search) {
                        $factoryQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $inspections = $query->latest('inspection_date')
            ->paginate(15)
            ->withQueryString();

        return view(
            'quality-engineer.inspections.index',
            compact('inspections')
        );
    }

    /**
     * Show inspection creation form.
     */
    public function create()
    {
        $user = $this->authenticatedUser();
        $companyId = $user->company_id;

        abort_unless($companyId, 403);

        $factories = Factory::where('company_id', $companyId)
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $productionLines = ProductionLine::where('company_id', $companyId)
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $machines = Machine::where('company_id', $companyId)
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        return view(
            'quality-engineer.inspections.create',
            compact('factories', 'productionLines', 'machines')
        );
    }

    /**
     * Store a new inspection.
     */
    public function store(Request $request)
    {
        $user = $this->authenticatedUser();
        $companyId = $user->company_id;

        abort_unless($companyId, 403);

        $validated = $request->validate([
            'factory_id' => [
                'nullable',
                'integer',
                Rule::exists('factories', 'id')
                    ->where('company_id', $companyId),
            ],

            'production_line_id' => [
                'nullable',
                'integer',
                Rule::exists('production_lines', 'id')
                    ->where('company_id', $companyId),
            ],

            'machine_id' => [
                'nullable',
                'integer',
                Rule::exists('machines', 'id')
                    ->where('company_id', $companyId),
            ],

            'inspection_type' => [
                'required',
                'string',
                'max:255',
            ],

            'inspection_date' => [
                'required',
                'date',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        $this->validateManufacturingHierarchy(
            $validated,
            $companyId
        );

        do {
            $inspectionNumber = 'INS-'
                . now()->format('Ymd-His')
                . '-'
                . Str::upper(Str::random(4));
        } while (
            Inspection::where('company_id', $companyId)
                ->where('inspection_number', $inspectionNumber)
                ->exists()
        );

        $inspection = Inspection::create([
            ...$validated,

            'company_id' => $companyId,
            'inspection_number' => $inspectionNumber,
            'inspector_id' => $user->id,
            'status' => 'scheduled',
            'result' => null,
        ]);

        return redirect()
            ->route('qe.inspections.show', $inspection->id)
            ->with('success', 'Inspection created successfully.');
    }

    /**
     * Display a single inspection.
     */
    public function show(int $id)
    {
        $user = $this->authenticatedUser();
        $companyId = $user->company_id;

        abort_unless($companyId, 403);

        $inspection = Inspection::where('company_id', $companyId)
            ->with([
                'factory',
                'productionLine',
                'machine',
                'inspector',
                'defects.reporter',
            ])
            ->findOrFail($id);

        return view(
            'quality-engineer.inspections.show',
            compact('inspection')
        );
    }

    /**
     * Update inspection status and findings.
     */
    public function update(Request $request, int $id)
    {
        $user = $this->authenticatedUser();
        $companyId = $user->company_id;

        abort_unless($companyId, 403);

        $inspection = Inspection::where('company_id', $companyId)
            ->findOrFail($id);

        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'scheduled',
                    'in_progress',
                    'completed',
                    'cancelled',
                ]),
            ],

            'result' => [
                'nullable',
                Rule::requiredIf(
                    $request->input('status') === 'completed'
                ),
                Rule::in(['pass', 'fail', 'conditional']),
            ],

            'findings' => [
                'nullable',
                'string',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        $inspection->update($validated);

        return redirect()
            ->route('qe.inspections.show', $inspection->id)
            ->with('success', 'Inspection updated successfully.');
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
                ->where('company_id', $companyId)
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
                ->where('company_id', $companyId)
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
