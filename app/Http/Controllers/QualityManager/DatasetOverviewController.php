<?php

namespace App\Http\Controllers\QualityManager;

use App\Http\Controllers\Controller;
use App\Models\Dataset;
use Illuminate\Http\Request;

class DatasetOverviewController extends Controller
{
    /**
     * Display company-wide dataset overview.
     * Read-only access for Quality Manager.
     */
    public function index(Request $request)
    {
        $companyId = $request->user()->company_id;

        abort_unless($companyId, 403);

        $datasets = Dataset::where('company_id', $companyId)
            ->with(['uploader', 'factory', 'productionLine', 'machine'])
            ->latest()
            ->paginate(15);

        $totalDatasets = Dataset::where('company_id', $companyId)->count();

        $validatedDatasets = Dataset::where('company_id', $companyId)
            ->where('validation_status', 'passed')
            ->count();

        $pendingDatasets = Dataset::where('company_id', $companyId)
            ->where('validation_status', 'pending')
            ->count();

        $failedDatasets = Dataset::where('company_id', $companyId)
            ->where('validation_status', 'failed')
            ->count();

        return view('quality-manager.datasets.index', compact(
            'datasets',
            'totalDatasets',
            'validatedDatasets',
            'pendingDatasets',
            'failedDatasets'
        ));
    }

    /**
     * Display dataset details within the user's company.
     */
    public function show(Request $request, int $id)
    {
        $companyId = $request->user()->company_id;

        abort_unless($companyId, 403);

        $dataset = Dataset::where('company_id', $companyId)
            ->with(['uploader', 'factory', 'productionLine', 'machine'])
            ->findOrFail($id);

        return view('quality-manager.datasets.show', compact('dataset'));
    }
}
