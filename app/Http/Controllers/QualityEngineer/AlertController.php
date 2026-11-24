<?php

namespace App\Http\Controllers\QualityEngineer;

use App\Http\Controllers\Controller;
use App\Models\Defect;
use App\Models\Inspection;
use App\Models\Prediction;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function index(Request $request)
    {
        $companyId = $request->user()->company_id;

        abort_unless($companyId, 403);

        $defects = Defect::where('company_id', $companyId)
            ->whereIn('severity', ['high', 'critical'])
            ->where('status', '!=', 'resolved')
            ->with(['factory', 'machine'])
            ->latest()
            ->get();

        $inspections = Inspection::where('company_id', $companyId)
            ->whereIn('result', ['fail', 'conditional'])
            ->with(['factory', 'machine'])
            ->latest('inspection_date')
            ->get();

        $predictions = Prediction::where('company_id', $companyId)
            ->where('status', 'failed')
            ->with('dataset')
            ->latest()
            ->get();

        return view('quality-engineer.alerts.index', compact(
            'defects',
            'inspections',
            'predictions'
        ));
    }
}
