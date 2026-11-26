<?php

namespace App\Http\Controllers\QualityManager;

use App\Http\Controllers\Controller;
use App\Models\Defect;
use App\Models\Inspection;
use App\Models\Prediction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QualityAnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $companyId = $request->user()->company_id;

        abort_unless($companyId, 403);

        /*
        |--------------------------------------------------------------------------
        | Defect Analytics
        |--------------------------------------------------------------------------
        */

        $defectQuery = Defect::where('defects.company_id', $companyId);

        $totalDefectRecords = (clone $defectQuery)->count();

        $totalDefectQuantity = (clone $defectQuery)
            ->sum('defect_quantity');

        $openDefects = (clone $defectQuery)
            ->whereIn('status', ['open', 'investigating'])
            ->count();

        $resolvedDefects = (clone $defectQuery)
            ->where('status', 'resolved')
            ->count();

        $severityAnalysis = (clone $defectQuery)
            ->select('severity', DB::raw('COUNT(*) as total'))
            ->groupBy('severity')
            ->get();

        $defectTypeAnalysis = (clone $defectQuery)
            ->select(
                'defect_type',
                DB::raw('COUNT(*) as total_records'),
                DB::raw('SUM(defect_quantity) as total_quantity')
            )
            ->groupBy('defect_type')
            ->orderByDesc('total_records')
            ->get();

        $machineAnalysis = (clone $defectQuery)
            ->leftJoin('machines', 'defects.machine_id', '=', 'machines.id')
            ->select(
                'machines.name as machine_name',
                DB::raw('COUNT(defects.id) as total_records'),
                DB::raw('SUM(defects.defect_quantity) as total_quantity')
            )
            ->groupBy('machines.id', 'machines.name')
            ->orderByDesc('total_records')
            ->get();

        $productionLineAnalysis = (clone $defectQuery)
            ->leftJoin(
                'production_lines',
                'defects.production_line_id',
                '=',
                'production_lines.id'
            )
            ->select(
                'production_lines.name as line_name',
                DB::raw('COUNT(defects.id) as total_records'),
                DB::raw('SUM(defects.defect_quantity) as total_quantity')
            )
            ->groupBy('production_lines.id', 'production_lines.name')
            ->orderByDesc('total_records')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Inspection Analytics
        |--------------------------------------------------------------------------
        */

        $inspectionQuery = Inspection::where('company_id', $companyId);

        $totalInspections = (clone $inspectionQuery)->count();

        $inspectionStatusAnalysis = (clone $inspectionQuery)
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get();

        $inspectionResultAnalysis = (clone $inspectionQuery)
            ->select('result', DB::raw('COUNT(*) as total'))
            ->groupBy('result')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Prediction Monitoring
        |--------------------------------------------------------------------------
        */

        $predictions = Prediction::where('company_id', $companyId)
            ->with('dataset')
            ->latest()
            ->get();

        $totalPredictions = $predictions->count();

        $completedPredictions = $predictions
            ->where('status', 'completed')
            ->count();

        $failedPredictions = $predictions
            ->where('status', 'failed')
            ->count();

        $runningPredictions = $predictions
            ->whereIn('status', ['pending', 'processing', 'running'])
            ->count();

        $demoPredictions = $predictions->filter(function ($prediction) {
            return data_get($prediction->result_payload, 'demo_mode') === true;
        });

        $demoPredictionCount = $demoPredictions->count();

        $demoPredictionInsights = $demoPredictions
            ->map(function ($prediction) {
                return [
                    'id' => $prediction->id,
                    'model_version' => $prediction->model_version,
                    'total_records' => data_get(
                        $prediction->summary,
                        'total_records'
                    ),
                    'quality_score' => data_get(
                        $prediction->summary,
                        'quality_score'
                    ),
                    'predicted_defect_rate' => data_get(
                        $prediction->summary,
                        'predicted_defect_rate'
                    ),
                    'predicted_defect_records' => data_get(
                        $prediction->summary,
                        'predicted_defect_records'
                    ),
                    'risk_level' => data_get(
                        $prediction->summary,
                        'risk_level'
                    ),
                    'created_at' => $prediction->created_at,
                ];
            })
            ->values();

        return view('quality-manager.analytics.index', compact(
            'totalDefectRecords',
            'totalDefectQuantity',
            'openDefects',
            'resolvedDefects',
            'severityAnalysis',
            'defectTypeAnalysis',
            'machineAnalysis',
            'productionLineAnalysis',
            'totalInspections',
            'inspectionStatusAnalysis',
            'inspectionResultAnalysis',
            'totalPredictions',
            'completedPredictions',
            'failedPredictions',
            'runningPredictions',
            'demoPredictionCount',
            'demoPredictionInsights'
        ));
    }
}
