<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\Http\Controllers\Controller;
use App\Models\Factory;
use App\Models\Machine;
use App\Models\ProductionLine;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ManufacturingSetupController extends Controller
{
    /**
     * Display company manufacturing setup.
     */
    public function index(Request $request)
    {
        $companyId = $request->user()->company_id;

        abort_unless($companyId, 403);

        $factories = Factory::where('company_id', $companyId)
            ->with('productionLines.machines')
            ->orderBy('name')
            ->get();

        $productionLines = ProductionLine::where('company_id', $companyId)
            ->with(['factory', 'machines'])
            ->orderBy('name')
            ->get();

        $machines = Machine::where('company_id', $companyId)
            ->with('productionLine')
            ->orderBy('name')
            ->get();

        return view('company-admin.manufacturing.index', compact(
            'factories',
            'productionLines',
            'machines'
        ));
    }

    /**
     * Store a factory.
     */
    public function storeFactory(Request $request)
    {
        $companyId = $request->user()->company_id;

        abort_unless($companyId, 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'factory_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('factories', 'factory_code')
                    ->where('company_id', $companyId),
            ],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
        ]);

        Factory::create([
            ...$validated,
            'company_id' => $companyId,
            'created_by' => $request->user()->id,
            'status' => 'active',
        ]);

        return back()->with('success', 'Factory created successfully.');
    }

    /**
     * Store a production line.
     */
    public function storeProductionLine(Request $request)
    {
        $companyId = $request->user()->company_id;

        abort_unless($companyId, 403);

        $validated = $request->validate([
            'factory_id' => [
                'required',
                'integer',
                Rule::exists('factories', 'id')
                    ->where('company_id', $companyId),
            ],
            'name' => ['required', 'string', 'max:255'],
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('production_lines', 'code')
                    ->where('company_id', $companyId),
            ],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);

        ProductionLine::create([
            ...$validated,
            'company_id' => $companyId,
            'created_by' => $request->user()->id,
            'status' => 'active',
        ]);

        return back()->with('success', 'Production line created successfully.');
    }

    /**
     * Store a machine.
     */
    public function storeMachine(Request $request)
    {
        $companyId = $request->user()->company_id;

        abort_unless($companyId, 403);

        $validated = $request->validate([
            'production_line_id' => [
                'required',
                'integer',
                Rule::exists('production_lines', 'id')
                    ->where('company_id', $companyId),
            ],
            'name' => ['required', 'string', 'max:255'],
            'machine_code' => [
                'required',
                'string',
                'max:100',
                Rule::unique('machines', 'machine_code')
                    ->where('company_id', $companyId),
            ],
            'machine_type' => ['nullable', 'string', 'max:255'],
            'manufacturer' => ['nullable', 'string', 'max:255'],
            'model_number' => ['nullable', 'string', 'max:255'],
            'serial_number' => ['nullable', 'string', 'max:255'],
            'installation_date' => ['nullable', 'date'],
            'description' => ['nullable', 'string'],
        ]);

        Machine::create([
            ...$validated,
            'company_id' => $companyId,
            'status' => 'active',
        ]);

        return back()->with('success', 'Machine created successfully.');
    }
}
