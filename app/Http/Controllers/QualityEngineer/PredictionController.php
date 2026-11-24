<?php

namespace App\Http\Controllers\QualityEngineer;

use App\Http\Controllers\Controller;
use App\Models\Dataset;
use App\Models\Prediction;
use App\Services\DemoPredictionEngine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class PredictionController extends Controller
{
    /**
     * Display prediction history for the authenticated company.
     */
    public function index(Request $request)
    {
        $companyId = $request->user()->company_id;

        abort_unless($companyId, 403);

        $predictions = Prediction::where('company_id', $companyId)
            ->with(['dataset', 'requester'])
            ->latest()
            ->paginate(15);

        return view('quality-engineer.predictions.index', compact('predictions'));
    }

    /**
     * Run a prediction for a validated dataset.
     */
    public function store(
        Request $request,
        int $datasetId,
        DemoPredictionEngine $engine
    ) {
        $companyId = $request->user()->company_id;

        abort_unless($companyId, 403);

        $dataset = Dataset::where('company_id', $companyId)
            ->findOrFail($datasetId);

        if ($dataset->validation_status !== 'passed') {
            return back()->with(
                'error',
                'Please validate this dataset successfully before running a prediction.'
            );
        }

        $startedAt = now();

        $result = $engine->run($dataset);

        $prediction = DB::transaction(function () use (
            $companyId,
            $request,
            $dataset,
            $result,
            $startedAt
        ) {
            return Prediction::create([
                'company_id' => $companyId,
                'dataset_id' => $dataset->id,
                'requested_by' => $request->user()->id,
                'status' => 'completed',
                'model_version' => $result['model_version'],
                'summary' => $result['summary'],
                'result_payload' => $result['result_payload'],
                'error_details' => null,
                'started_at' => $startedAt,
                'completed_at' => now(),
            ]);
        });

        return redirect()
            ->route('qe.predictions.show', $prediction->id)
            ->with('success', 'Demo prediction completed successfully.');
    }

    /**
     * Display a prediction belonging to the authenticated company.
     */
    public function show(Request $request, int $id)
    {
        $companyId = $request->user()->company_id;

        abort_unless($companyId, 403);

        $prediction = Prediction::where('company_id', $companyId)
            ->with(['dataset', 'requester'])
            ->findOrFail($id);

        return view('quality-engineer.predictions.show', compact('prediction'));
    }

    public function download(Request $request, int $id)
    {
        $companyId = $request->user()->company_id;

        abort_unless($companyId, 403);

        $prediction = Prediction::where('company_id', $companyId)
            ->with(['dataset', 'requester'])
            ->findOrFail($id);

        $summary = $prediction->summary ?? [];
        $payload = $prediction->result_payload ?? [];

        $pdf = Pdf::loadView(
            'quality-engineer.predictions.pdf',
            compact('prediction', 'summary', 'payload')
        )->setPaper('a4', 'portrait');

        return $pdf->download(
            'prediction-report-' . $prediction->id . '.pdf'
        );
    }
}
