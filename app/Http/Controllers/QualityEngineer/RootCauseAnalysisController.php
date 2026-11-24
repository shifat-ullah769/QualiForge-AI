<?php

namespace App\Http\Controllers\QualityEngineer;

use App\Http\Controllers\Controller;
use App\Models\Defect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RootCauseAnalysisController extends Controller
{
    public function index(Request $request)
    {
        $companyId = $request->user()->company_id;

        abort_unless($companyId, 403);

        $baseQuery = Defect::where('defects.company_id', $companyId);

        $totalRecords = (clone $baseQuery)->count();

        $totalQuantity = (clone $baseQuery)
            ->sum('defect_quantity');

        $openDefects = (clone $baseQuery)
            ->whereIn('status', ['open', 'investigating'])
            ->count();

        $resolvedDefects = (clone $baseQuery)
            ->where('status', 'resolved')
            ->count();

        $severityAnalysis = (clone $baseQuery)
            ->select('severity', DB::raw('COUNT(*) as total'))
            ->groupBy('severity')
            ->get();

        $defectTypeAnalysis = (clone $baseQuery)
            ->select(
                'defect_type',
                DB::raw('COUNT(*) as total_records'),
                DB::raw('SUM(defect_quantity) as total_quantity')
            )
            ->groupBy('defect_type')
            ->orderByDesc('total_records')
            ->get();

        $machineAnalysis = (clone $baseQuery)
            ->leftJoin('machines', 'defects.machine_id', '=', 'machines.id')
            ->select(
                'machines.name as machine_name',
                DB::raw('COUNT(defects.id) as total_records'),
                DB::raw('SUM(defects.defect_quantity) as total_quantity')
            )
            ->groupBy('machines.id', 'machines.name')
            ->orderByDesc('total_records')
            ->get();

        $productionLineAnalysis = (clone $baseQuery)
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

        return view(
            'quality-engineer.root-cause-analysis.index',
            compact(
                'totalRecords',
                'totalQuantity',
                'openDefects',
                'resolvedDefects',
                'severityAnalysis',
                'defectTypeAnalysis',
                'machineAnalysis',
                'productionLineAnalysis'
            )
        );
    }
}
