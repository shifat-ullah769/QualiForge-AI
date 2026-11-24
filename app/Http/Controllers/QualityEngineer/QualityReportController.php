<?php

namespace App\Http\Controllers\QualityEngineer;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Defect;
use App\Models\Inspection;
use App\Models\Prediction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class QualityReportController extends Controller
{
    public function index(Request $request)
    {
        $companyId = $request->user()->company_id;

        abort_unless($companyId, 403);

        $data = $this->getReportData($companyId);

        return view('quality-engineer.reports.index', $data);
    }


    public function download(Request $request)
    {
        $companyId = $request->user()->company_id;

        abort_unless($companyId, 403);

        $data = $this->getReportData($companyId);

        $pdf = Pdf::loadView(
            'quality-engineer.reports.pdf',
            $data
        )->setPaper('a4', 'portrait');

        $pdf->render();

        $canvas = $pdf->getCanvas();

        $canvas->page_text(
            38,
            810,
            'QualiForge AI | Confidential Company Quality Report | Page {PAGE_NUM} of {PAGE_COUNT}',
            null,
            8,
            [100, 116, 139]
        );

        return $pdf->download(
            'quality-report-' . now()->format('Y-m-d') . '.pdf'
        );
    }


    private function getReportData(int $companyId): array
    {
        $company = Company::findOrFail($companyId);

        // Defect Summary
        $defects = Defect::where('company_id', $companyId);

        $totalDefects = (clone $defects)->count();

        $totalDefectQuantity = (clone $defects)
            ->sum('defect_quantity');

        $defectStatusSummary = (clone $defects)
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get();

        $defectSeveritySummary = (clone $defects)
            ->selectRaw('severity, COUNT(*) as total')
            ->groupBy('severity')
            ->get();

        $defectTypeSummary = (clone $defects)
            ->selectRaw('defect_type, COUNT(*) as total')
            ->groupBy('defect_type')
            ->orderByDesc('total')
            ->get();

        // Inspection Summary
        $inspections = Inspection::where('company_id', $companyId);

        $totalInspections = (clone $inspections)->count();

        $inspectionStatusSummary = (clone $inspections)
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get();

        $inspectionResultSummary = (clone $inspections)
            ->whereNotNull('result')
            ->selectRaw('result, COUNT(*) as total')
            ->groupBy('result')
            ->get();

        // Prediction Summary
        $predictions = Prediction::where('company_id', $companyId);

        $totalPredictions = (clone $predictions)->count();

        $predictionStatusSummary = (clone $predictions)
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get();

        // Recent Records
        $recentDefects = Defect::where('company_id', $companyId)
            ->with(['factory', 'machine'])
            ->latest()
            ->limit(5)
            ->get();

        $recentInspections = Inspection::where('company_id', $companyId)
            ->with(['factory', 'machine'])
            ->latest('inspection_date')
            ->limit(5)
            ->get();

        return compact(
            'company',
            'totalDefects',
            'totalDefectQuantity',
            'defectStatusSummary',
            'defectSeveritySummary',
            'defectTypeSummary',
            'totalInspections',
            'inspectionStatusSummary',
            'inspectionResultSummary',
            'totalPredictions',
            'predictionStatusSummary',
            'recentDefects',
            'recentInspections'
        ) + [
            'generatedAt' => now(),
        ];
    }
}
