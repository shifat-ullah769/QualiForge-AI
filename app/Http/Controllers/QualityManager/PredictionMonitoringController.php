<?php

namespace App\Http\Controllers\QualityManager;

use App\Http\Controllers\Controller;
use App\Models\Prediction;
use Illuminate\Http\Request;

class PredictionMonitoringController extends Controller
{
    /**
     * Display company-wide prediction monitoring.
     */
    public function index(Request $request)
    {
        $companyId = $request->user()->company_id;

        abort_unless($companyId, 403);

        $query = Prediction::where('company_id', $companyId);

        $totalPredictions = (clone $query)->count();

        $completedPredictions = (clone $query)
            ->where('status', 'completed')
            ->count();

        $failedPredictions = (clone $query)
            ->where('status', 'failed')
            ->count();

        $runningPredictions = (clone $query)
            ->where('status', 'running')
            ->count();

        $predictions = Prediction::where('company_id', $companyId)
            ->with(['dataset', 'requester'])
            ->latest()
            ->paginate(15);

        return view('quality-manager.predictions.index', compact(
            'predictions',
            'totalPredictions',
            'completedPredictions',
            'failedPredictions',
            'runningPredictions'
        ));
    }

    /**
     * Display prediction details within the user's company.
     */
    public function show(Request $request, int $id)
    {
        $companyId = $request->user()->company_id;

        abort_unless($companyId, 403);

        $prediction = Prediction::where('company_id', $companyId)
            ->with(['dataset', 'requester'])
            ->findOrFail($id);

        return view('quality-manager.predictions.show', compact(
            'prediction'
        ));
    }
}
