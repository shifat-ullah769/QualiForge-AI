<?php

namespace App\Http\Controllers\QualityManager;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Factory;
use App\Models\Defect;
use App\Models\Inspection;
use App\Models\Prediction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class QualityReportController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->getReportData($request);

        return view('quality-manager.reports.index', $data);
    }

    public function download(Request $request)
    {
        $data = $this->getReportData($request);

        $pdf = Pdf::loadView(
            'quality-manager.reports.pdf',
            $data
        )->setPaper('a4', 'portrait');

        return $pdf->download(
            'quality-report-' . now()->format('Y-m-d') . '.pdf'
        );
    }

    private function getReportData(Request $request): array
    {
        $companyId = $request->user()->company_id;

        abort_unless($companyId, 403);

        $company = Company::findOrFail($companyId);

        $factories = Factory::where('company_id', $companyId)
            ->orderBy('name')
            ->get();

        $factoryId = $request->query('factory_id');

        $selectedFactory = null;

        if ($factoryId !== null && $factoryId !== '') {
            $selectedFactory = Factory::where('company_id', $companyId)
                ->findOrFail($factoryId);
        }

        $defectQuery = Defect::where('company_id', $companyId);
        $inspectionQuery = Inspection::where('company_id', $companyId);
        $predictionQuery = Prediction::where('company_id', $companyId);

        if ($selectedFactory) {
            $defectQuery->where('factory_id', $selectedFactory->id);

            $inspectionQuery->where(
                'factory_id',
                $selectedFactory->id
            );

            $predictionQuery->whereHas('dataset', function ($query) use ($selectedFactory) {
                $query->where('factory_id', $selectedFactory->id);
            });
        }

        $totalDefects = (clone $defectQuery)->count();

        $totalDefectQuantity = (clone $defectQuery)
            ->sum('defect_quantity');

        $defectStatusCounts = [
            'open' => (clone $defectQuery)->where('status', 'open')->count(),
            'investigating' => (clone $defectQuery)->where('status', 'investigating')->count(),
            'resolved' => (clone $defectQuery)->where('status', 'resolved')->count(),
        ];

        $defectSeverityCounts = [
            'critical' => (clone $defectQuery)->where('severity', 'critical')->count(),
            'high' => (clone $defectQuery)->where('severity', 'high')->count(),
            'medium' => (clone $defectQuery)->where('severity', 'medium')->count(),
            'low' => (clone $defectQuery)->where('severity', 'low')->count(),
        ];

        $defectTypeCounts = (clone $defectQuery)
            ->selectRaw('defect_type, COUNT(*) as total')
            ->groupBy('defect_type')
            ->orderByDesc('total')
            ->get();

        $totalInspections = (clone $inspectionQuery)->count();

        $inspectionStatusCounts = [
            'scheduled' => (clone $inspectionQuery)->where('status', 'scheduled')->count(),
            'in_progress' => (clone $inspectionQuery)->where('status', 'in_progress')->count(),
            'completed' => (clone $inspectionQuery)->where('status', 'completed')->count(),
            'cancelled' => (clone $inspectionQuery)->where('status', 'cancelled')->count(),
        ];

        $inspectionResultCounts = [
            'pass' => (clone $inspectionQuery)->where('result', 'pass')->count(),
            'fail' => (clone $inspectionQuery)->where('result', 'fail')->count(),
            'conditional' => (clone $inspectionQuery)->where('result', 'conditional')->count(),
            'pending' => (clone $inspectionQuery)->whereNull('result')->count(),
        ];

        $totalPredictions = (clone $predictionQuery)->count();

        $predictionStatusCounts = [
            'completed' => (clone $predictionQuery)->where('status', 'completed')->count(),
            'running' => (clone $predictionQuery)->where('status', 'running')->count(),
            'failed' => (clone $predictionQuery)->where('status', 'failed')->count(),
        ];

        $recentDefects = (clone $defectQuery)
            ->with(['factory', 'machine', 'reporter'])
            ->latest('created_at')
            ->take(5)
            ->get();

        $recentInspections = (clone $inspectionQuery)
            ->with(['factory', 'machine', 'inspector'])
            ->latest('inspection_date')
            ->take(5)
            ->get();

        $factoryAnalysis = Factory::where('company_id', $companyId)
            ->when($selectedFactory, function ($query) use ($selectedFactory) {
                $query->where('id', $selectedFactory->id);
            })
            ->withCount([
                'productionLines',
            ])
            ->get()
            ->map(function ($factory) use ($companyId) {
                $factory->defect_count = Defect::where('company_id', $companyId)
                    ->where('factory_id', $factory->id)
                    ->count();

                $factory->defect_quantity = Defect::where('company_id', $companyId)
                    ->where('factory_id', $factory->id)
                    ->sum('defect_quantity');

                $factory->inspection_count = Inspection::where('company_id', $companyId)
                    ->where('factory_id', $factory->id)
                    ->count();

                return $factory;
            });

        $predictionInsights = (clone $predictionQuery)
            ->where('status', 'completed')
            ->latest('completed_at')
            ->take(5)
            ->get()
            ->map(function ($prediction) {
                $summary = $prediction->summary ?? [];
                $payload = $prediction->result_payload ?? [];

                return [
                    'id' => $prediction->id,
                    'model_version' => $prediction->model_version,
                    'quality_score' => data_get($summary, 'quality_score'),
                    'predicted_defect_rate' => data_get($summary, 'predicted_defect_rate'),
                    'predicted_defect_records' => data_get($summary, 'predicted_defect_records'),
                    'risk_level' => data_get($summary, 'risk_level'),
                    'demo_mode' => data_get($payload, 'demo_mode', false),
                    'completed_at' => $prediction->completed_at,
                ];
            });

        return [
            'company' => $company,
            'factories' => $factories,
            'selectedFactory' => $selectedFactory,

            'totalDefects' => $totalDefects,
            'totalDefectQuantity' => $totalDefectQuantity,
            'defectStatusCounts' => $defectStatusCounts,
            'defectSeverityCounts' => $defectSeverityCounts,
            'defectTypeCounts' => $defectTypeCounts,

            'totalInspections' => $totalInspections,
            'inspectionStatusCounts' => $inspectionStatusCounts,
            'inspectionResultCounts' => $inspectionResultCounts,

            'totalPredictions' => $totalPredictions,
            'predictionStatusCounts' => $predictionStatusCounts,
            'predictionInsights' => $predictionInsights,

            'recentDefects' => $recentDefects,
            'recentInspections' => $recentInspections,
            'factoryAnalysis' => $factoryAnalysis,

            'generatedAt' => now(),
        ];
    }
}
