<?php

namespace App\Http\Controllers\ProductionSupervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductionMonitoringController extends Controller
{
    /**
     * Display production resources assigned to the supervisor.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user->hasRole(\App\UserRole::PRODUCTION_SUPERVISOR),
            403
        );

        $assignments = $user->assignments()
            ->with([
                'factory',
                'productionLine',
                'machine',
            ])
            ->where('status', 'active')
            ->get();

        return view(
            'production-supervisor.monitoring.index',
            compact('user', 'assignments')
        );
    }
}
