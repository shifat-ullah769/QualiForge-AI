<?php

namespace App\Http\Controllers\QualityManager;

use App\Http\Controllers\Controller;
use App\Models\Inspection;
use Illuminate\Http\Request;

class InspectionMonitoringController extends Controller
{
    public function index(Request $request)
    {
        $companyId = $request->user()->company_id;
        abort_unless($companyId, 403);

        $baseQuery = Inspection::where('company_id', $companyId);

        $totalInspections = (clone $baseQuery)->count();

        $scheduledInspections = (clone $baseQuery)
            ->where('status', 'scheduled')->count();

        $inProgressInspections = (clone $baseQuery)
            ->where('status', 'in_progress')->count();

        $completedInspections = (clone $baseQuery)
            ->where('status', 'completed')->count();

        $cancelledInspections = (clone $baseQuery)
            ->where('status', 'cancelled')->count();

        $resultCounts = [
            'pass' => (clone $baseQuery)->where('result', 'pass')->count(),
            'fail' => (clone $baseQuery)->where('result', 'fail')->count(),
            'conditional' => (clone $baseQuery)->where('result', 'conditional')->count(),
            'pending' => (clone $baseQuery)
                ->whereNull('result')
                ->count(),
        ];

        $inspections = Inspection::where('company_id', $companyId)
            ->with([
                'factory',
                'productionLine',
                'machine',
                'inspector',
            ])
            ->latest('inspection_date')
            ->paginate(15);

        return view('quality-manager.inspections.index', compact(
            'inspections',
            'totalInspections',
            'scheduledInspections',
            'inProgressInspections',
            'completedInspections',
            'cancelledInspections',
            'resultCounts'
        ));
    }

    public function show(Request $request, int $id)
    {
        $companyId = $request->user()->company_id;
        abort_unless($companyId, 403);

        $inspection = Inspection::where('company_id', $companyId)
            ->with([
                'factory',
                'productionLine',
                'machine',
                'inspector',
                'defects.reporter',
            ])
            ->findOrFail($id);

        return view('quality-manager.inspections.show', compact('inspection'));
    }
}
