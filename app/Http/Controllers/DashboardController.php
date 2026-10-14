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
            'inactiveUsersList'
        ));
    }
}
