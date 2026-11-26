<?php

namespace App\Http\Controllers\QualityManager;

use App\Http\Controllers\Controller;
use App\Models\Defect;
use Illuminate\Http\Request;

class DefectOversightController extends Controller
{
    public function index(Request $request)
    {
        $companyId = $request->user()->company_id;
        abort_unless($companyId, 403);

        $baseQuery = Defect::where('company_id', $companyId);

        $totalDefects = (clone $baseQuery)->count();

        $openDefects = (clone $baseQuery)
            ->where('status', 'open')->count();

        $investigatingDefects = (clone $baseQuery)
            ->where('status', 'investigating')->count();

        $resolvedDefects = (clone $baseQuery)
            ->where('status', 'resolved')->count();

        $criticalDefects = (clone $baseQuery)
            ->where('severity', 'critical')->count();

        $highDefects = (clone $baseQuery)
            ->where('severity', 'high')->count();

        $severityCounts = [
            'critical' => (clone $baseQuery)->where('severity', 'critical')->count(),
            'high' => (clone $baseQuery)->where('severity', 'high')->count(),
            'medium' => (clone $baseQuery)->where('severity', 'medium')->count(),
            'low' => (clone $baseQuery)->where('severity', 'low')->count(),
        ];

        $defectTypes = (clone $baseQuery)
            ->selectRaw('defect_type, COUNT(*) as total')
            ->groupBy('defect_type')
            ->orderByDesc('total')
            ->limit(6)
            ->get();

        $defects = Defect::where('company_id', $companyId)
            ->with([
                'factory',
                'productionLine',
                'machine',
                'reporter',
            ])
            ->latest()
            ->paginate(15);

        return view('quality-manager.defects.index', compact(
            'defects',
            'totalDefects',
            'openDefects',
            'investigatingDefects',
            'resolvedDefects',
            'criticalDefects',
            'highDefects',
            'severityCounts',
            'defectTypes'
        ));
    }

    public function show(Request $request, int $id)
    {
        $companyId = $request->user()->company_id;
        abort_unless($companyId, 403);

        $defect = Defect::where('company_id', $companyId)
            ->with([
                'factory',
                'productionLine',
                'machine',
                'reporter',
                'inspection',
            ])
            ->findOrFail($id);

        return view('quality-manager.defects.show', compact('defect'));
    }
}
