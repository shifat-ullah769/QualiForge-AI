<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = request()->user();

        /*
        |--------------------------------------------------------------------------
        | SYSTEM ADMINISTRATOR DASHBOARD
        |--------------------------------------------------------------------------
        */

        if ($user->hasRole(\App\UserRole::SYSTEM_ADMINISTRATOR)) {

            $totalCompanies = \App\Models\Company::count();

            $activeCompanies = \App\Models\Company::where(
                'is_active',
                true
            )->count();

            $inactiveCompanies = \App\Models\Company::where(
                'is_active',
                false
            )->count();

            $totalUsers = \App\Models\User::count();

            $activeUsers = \App\Models\User::where(
                'is_active',
                true
            )->count();

            $inactiveUsers = \App\Models\User::where(
                'is_active',
                false
            )->count();

            $totalSystemAdmins = \App\Models\User::where(
                'role',
                \App\UserRole::SYSTEM_ADMINISTRATOR->value
            )->count();

            $totalCompanyAdmins = \App\Models\User::where(
                'role',
                \App\UserRole::COMPANY_ADMINISTRATOR->value
            )->count();

            $totalQualityManagers = \App\Models\User::where(
                'role',
                \App\UserRole::QUALITY_MANAGER->value
            )->count();

            $totalQualityEngineers = \App\Models\User::where(
                'role',
                \App\UserRole::QUALITY_ENGINEER->value
            )->count();

            $totalProductionSupervisors = \App\Models\User::where(
                'role',
                \App\UserRole::PRODUCTION_SUPERVISOR->value
            )->count();

            $recentlyCreatedCompanies = \App\Models\Company::latest('created_at')
                ->take(5)
                ->get();

            $recentlyUpdatedCompanies = \App\Models\Company::latest('updated_at')
                ->take(5)
                ->get();

            $inactiveCompanyList = \App\Models\Company::where(
                'is_active',
                false
            )->get();

            $inactiveCompanyAdmins = \App\Models\User::where(
                'role',
                \App\UserRole::COMPANY_ADMINISTRATOR->value
            )->where(
                'is_active',
                false
            )->get();

            $inactiveSystemAdmins = \App\Models\User::where(
                'role',
                \App\UserRole::SYSTEM_ADMINISTRATOR->value
            )->where(
                'is_active',
                false
            )->get();

            return view('dashboard', compact(
                'totalCompanies',
                'activeCompanies',
                'inactiveCompanies',
                'totalUsers',
                'activeUsers',
                'inactiveUsers',
                'totalSystemAdmins',
                'totalCompanyAdmins',
                'totalQualityManagers',
                'totalQualityEngineers',
                'totalProductionSupervisors',
                'recentlyCreatedCompanies',
                'recentlyUpdatedCompanies',
                'inactiveCompanyList',
                'inactiveCompanyAdmins',
                'inactiveSystemAdmins'
            ));
        }

        /*
|--------------------------------------------------------------------------
| QUALITY ENGINEER DASHBOARD
|--------------------------------------------------------------------------
|
|
*/


        if ($user->hasRole(\App\UserRole::QUALITY_ENGINEER)) {

            $company = $user->company;
            $dashboardRole = 'quality_engineer';

            if (!$company) {
                return view('dashboard', [
                    'dashboardRole' => 'quality_engineer',
                    'qualityEngineer' => $user,
                    'company' => null,
                ]);
            }

            $companyId = $company->id;
            $dashboardRole = 'quality_engineer';

            // Dataset overview
            $totalDatasets = \App\Models\Dataset::where('company_id', $companyId)->count();
            $validatedDatasets = \App\Models\Dataset::where('company_id', $companyId)
                ->where('validation_status', 'passed')->count();
            $pendingDatasets = \App\Models\Dataset::where('company_id', $companyId)
                ->where('validation_status', 'pending')->count();
            $failedDatasets = \App\Models\Dataset::where('company_id', $companyId)
                ->where('validation_status', 'failed')->count();

            // Prediction overview
            $totalPredictions = \App\Models\Prediction::where('company_id', $companyId)->count();
            $completedPredictions = \App\Models\Prediction::where('company_id', $companyId)
                ->where('status', 'completed')->count();

            // Defect overview
            $totalDefects = \App\Models\Defect::where('company_id', $companyId)->count();
            $openDefects = \App\Models\Defect::where('company_id', $companyId)
                ->whereIn('status', ['open', 'investigating'])->count();
            $highPriorityDefects = \App\Models\Defect::where('company_id', $companyId)
                ->whereIn('severity', ['high', 'critical'])
                ->whereIn('status', ['open', 'investigating'])->count();

            // Inspection overview
            $totalInspections = \App\Models\Inspection::where('company_id', $companyId)->count();
            $scheduledInspections = \App\Models\Inspection::where('company_id', $companyId)
                ->where('status', 'scheduled')->count();
            $completedInspections = \App\Models\Inspection::where('company_id', $companyId)
                ->where('status', 'completed')->count();
            $failedInspections = \App\Models\Inspection::where('company_id', $companyId)
                ->where('result', 'fail')->count();

            // Recent activity
            $recentDatasets = \App\Models\Dataset::where('company_id', $companyId)
                ->latest()->take(5)->get();

            $recentDefects = \App\Models\Defect::where('company_id', $companyId)
                ->latest()->take(5)->get();

            $recentInspections = \App\Models\Inspection::where('company_id', $companyId)
                ->latest()->take(5)->get();

            return view('dashboard', compact(
                'dashboardRole',
                'user',
                'company',
                'totalDatasets',
                'validatedDatasets',
                'pendingDatasets',
                'failedDatasets',
                'totalPredictions',
                'completedPredictions',
                'totalDefects',
                'openDefects',
                'highPriorityDefects',
                'totalInspections',
                'scheduledInspections',
                'completedInspections',
                'failedInspections',
                'recentDatasets',
                'recentDefects',
                'recentInspections'
            ));
        }




        /*
        |--------------------------------------------------------------------------
        | QUALITY MANAGER DASHBOARD
        |--------------------------------------------------------------------------
        */

        if ($user->hasRole(\App\UserRole::QUALITY_MANAGER)) {

            $company = $user->company;

            if (!$company) {
                return view('dashboard', [
                    'dashboardRole' => 'quality_manager',
                    'user' => $user,
                    'company' => null,
                ]);
            }

            $companyId = $company->id;

            // Dataset Monitoring
            $totalDatasets = \App\Models\Dataset::where('company_id', $companyId)->count();

            $validatedDatasets = \App\Models\Dataset::where('company_id', $companyId)
                ->where('validation_status', 'passed')->count();

            $pendingDatasets = \App\Models\Dataset::where('company_id', $companyId)
                ->where('validation_status', 'pending')->count();

            // Prediction Monitoring
            $totalPredictions = \App\Models\Prediction::where('company_id', $companyId)->count();

            $completedPredictions = \App\Models\Prediction::where('company_id', $companyId)
                ->where('status', 'completed')->count();

            $failedPredictions = \App\Models\Prediction::where('company_id', $companyId)
                ->where('status', 'failed')->count();

            // Defect Oversight
            $totalDefects = \App\Models\Defect::where('company_id', $companyId)->count();

            $openDefects = \App\Models\Defect::where('company_id', $companyId)
                ->whereIn('status', ['open', 'investigating'])->count();

            $criticalDefects = \App\Models\Defect::where('company_id', $companyId)
                ->whereIn('severity', ['high', 'critical'])
                ->whereIn('status', ['open', 'investigating'])->count();

            // Inspection Monitoring
            $totalInspections = \App\Models\Inspection::where('company_id', $companyId)->count();

            $completedInspections = \App\Models\Inspection::where('company_id', $companyId)
                ->where('status', 'completed')->count();

            $failedInspections = \App\Models\Inspection::where('company_id', $companyId)
                ->where('result', 'fail')->count();

            // Recent Company Activity
            $recentDatasets = \App\Models\Dataset::where('company_id', $companyId)
                ->latest()->take(5)->get();

            $recentPredictions = \App\Models\Prediction::where('company_id', $companyId)
                ->latest()->take(5)->get();

            $recentDefects = \App\Models\Defect::where('company_id', $companyId)
                ->latest()->take(5)->get();

            $recentInspections = \App\Models\Inspection::where('company_id', $companyId)
                ->latest()->take(5)->get();

            $dashboardRole = 'quality_manager';

            return view('dashboard', compact(
                'user',
                'company',
                'dashboardRole',
                'totalDatasets',
                'validatedDatasets',
                'pendingDatasets',
                'totalPredictions',
                'completedPredictions',
                'failedPredictions',
                'totalDefects',
                'openDefects',
                'criticalDefects',
                'totalInspections',
                'completedInspections',
                'failedInspections',
                'recentDatasets',
                'recentPredictions',
                'recentDefects',
                'recentInspections'
            ));
        }




        /*
|--------------------------------------------------------------------------
| PRODUCTION SUPERVISOR DASHBOARD
|--------------------------------------------------------------------------
*/

        if ($user->hasRole(\App\UserRole::PRODUCTION_SUPERVISOR)) {

            $company = $user->company;

            $assignments = $user->assignments()
                ->with([
                    'factory',
                    'productionLine',
                    'machine',
                ])
                ->where('status', 'active')
                ->get();

            return view('dashboard', compact(
                'user',
                'company',
                'assignments'
            ));
        }



        /*
        |--------------------------------------------------------------------------
        | COMPANY ADMINISTRATOR DASHBOARD
        |--------------------------------------------------------------------------
        */

        $company = $user->company;

        if (!$company) {
            return view('dashboard', [
                'company' => null,
                'totalUsers' => 0,
                'activeUsers' => 0,
                'inactiveUsers' => 0,
                'companyAdmins' => 0,
                'qualityManagers' => 0,
                'qualityEngineers' => 0,
                'productionSupervisors' => 0,
                'totalFactories' => 0,
                'totalProductionLines' => 0,
                'totalMachines' => 0,
                'totalAssignments' => 0,
                'activeAssignments' => 0,
                'assignedEngineers' => 0,
            ]);
        }

        $totalUsers = $company->users()->count();

        $activeUsers = $company->users()
            ->where('is_active', true)
            ->count();

        $inactiveUsers = $company->users()
            ->where('is_active', false)
            ->count();

        $companyAdmins = $company->users()
            ->where(
                'role',
                \App\UserRole::COMPANY_ADMINISTRATOR->value
            )
            ->count();

        $qualityManagers = $company->users()
            ->where(
                'role',
                \App\UserRole::QUALITY_MANAGER->value
            )
            ->count();

        $qualityEngineers = $company->users()
            ->where(
                'role',
                \App\UserRole::QUALITY_ENGINEER->value
            )
            ->count();

        $productionSupervisors = $company->users()
            ->where(
                'role',
                \App\UserRole::PRODUCTION_SUPERVISOR->value
            )
            ->count();

        $totalAssignments = $company->assignments()->count();

        $activeAssignments = $company->assignments()
            ->where('status', 'active')
            ->count();

        $assignedEngineers = $company->assignments()
            ->where('status', 'active')
            ->distinct('user_id')
            ->count('user_id');

        // Manufacturing Overview
        $totalFactories = $company->factories()->count();

        $totalProductionLines = $company->productionLines()->count();

        $totalMachines = $company->machines()->count();

        $recentlyCreatedUsers = $company->users()
            ->latest('created_at')
            ->take(5)
            ->get();

        $recentlyUpdatedUsers = $company->users()
            ->latest('updated_at')
            ->take(5)
            ->get();

        $inactiveUsersList = $company->users()
            ->where('is_active', false)
            ->get();

        return view('dashboard', compact(
            'company',
            'totalUsers',
            'activeUsers',
            'inactiveUsers',
            'companyAdmins',
            'qualityManagers',
            'qualityEngineers',
            'productionSupervisors',
            'recentlyCreatedUsers',
            'recentlyUpdatedUsers',
            'inactiveUsersList',
            'totalFactories',
            'totalProductionLines',
            'totalMachines',
            'totalAssignments',
            'activeAssignments',
            'assignedEngineers'
        ));
    }
}
