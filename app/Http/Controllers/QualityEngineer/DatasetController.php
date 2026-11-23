<?php

namespace App\Http\Controllers\QualityEngineer;

use App\Http\Controllers\Controller;
use App\Models\Dataset;
use App\Models\Factory;
use App\Models\Machine;
use App\Models\ProductionLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Throwable;

class DatasetController extends Controller
{
    /**
     * Display datasets belonging to the authenticated user's company.
     */
    public function index(Request $request)
    {
        $companyId = $request->user()->company_id;

        $datasets = Dataset::where('company_id', $companyId)
            ->with(['uploader', 'factory', 'productionLine', 'machine'])
            ->latest()
            ->paginate(15);

        return view('quality-engineer.datasets.index', compact('datasets'));
    }

    /**
     * Show the dataset upload form.
     */
    public function create(Request $request)
    {
        $companyId = $request->user()->company_id;

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

        return view('quality-engineer.datasets.create', compact(
            'factories',
            'productionLines',
            'machines'
        ));
    }

    /**
     * Validate and store an uploaded CSV or Excel dataset.
     */
    public function store(Request $request)
    {
        $companyId = $request->user()->company_id;

        if (!$companyId) {
            abort(403, 'Your account is not associated with a company.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

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

            'file' => [
                'required',
                'file',
                'mimes:csv,txt,xls,xlsx',
                'max:20480',
            ],
        ]);

        // Verify factory and production line relationship.
        if (!empty($validated['production_line_id'])) {
            $line = ProductionLine::where('id', $validated['production_line_id'])
                ->where('company_id', $companyId)
                ->firstOrFail();

            if (
                !empty($validated['factory_id']) &&
                $line->factory_id != $validated['factory_id']
            ) {
                throw ValidationException::withMessages([
                    'production_line_id' =>
                    'The selected production line does not belong to the selected factory.',
                ]);
            }
        }

        // A machine must belong to the selected production line.
        if (!empty($validated['machine_id'])) {
            if (empty($validated['production_line_id'])) {
                throw ValidationException::withMessages([
                    'production_line_id' =>
                    'Select a production line when assigning a machine.',
                ]);
            }

            $machine = Machine::where('id', $validated['machine_id'])
                ->where('company_id', $companyId)
                ->firstOrFail();

            if ($machine->production_line_id != $validated['production_line_id']) {
                throw ValidationException::withMessages([
                    'machine_id' =>
                    'The selected machine does not belong to the selected production line.',
                ]);
            }
        }

        $file = $request->file('file');

        $path = $file->store(
            "datasets/company-{$companyId}",
            'local'
        );

        try {
            Dataset::create([
                'company_id' => $companyId,
                'uploaded_by' => $request->user()->id,

                'factory_id' => $validated['factory_id'] ?? null,
                'production_line_id' => $validated['production_line_id'] ?? null,
                'machine_id' => $validated['machine_id'] ?? null,

                'name' => $validated['name'],
                'original_filename' => $file->getClientOriginalName(),
                'stored_path' => $path,
                'disk' => 'local',

                'file_extension' => strtolower($file->getClientOriginalExtension()),
                'mime_type' => $file->getMimeType(),
                'file_size_bytes' => $file->getSize(),

                'status' => 'uploaded',
                'validation_status' => 'pending',
            ]);
        } catch (Throwable $exception) {
            Storage::disk('local')->delete($path);

            throw $exception;
        }

        return redirect()
            ->route('qe.datasets.index')
            ->with('success', 'Dataset uploaded successfully.');
    }

    /**
     * Display one dataset belonging to the authenticated user's company.
     */
    public function show(Request $request, int $id)
    {
        $dataset = Dataset::where('company_id', $request->user()->company_id)
            ->with(['uploader', 'factory', 'productionLine', 'machine'])
            ->findOrFail($id);

        return view('quality-engineer.datasets.show', compact('dataset'));
    }
}
