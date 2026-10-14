<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (auth()->user()->hasRole(\App\UserRole::SYSTEM_ADMINISTRATOR))

                        {{-- SYSTEM ADMINISTRATOR DASHBOARD --}}

                        <h3 class="text-lg font-semibold mb-4">
                            System Overview
                        </h3>

                        <p>
                            Total Companies:
                            {{ $totalCompanies }}
                        </p>

                        <p>
                            Active Companies:
                            {{ $activeCompanies }}
                        </p>

                        <p>
                            Inactive Companies:
                            {{ $inactiveCompanies }}
                        </p>


                        <hr class="my-4">


                        <h3 class="text-lg font-semibold mb-4">
                            User Overview
                        </h3>

                        <p>
                            Total Users:
                            {{ $totalUsers }}
                        </p>

                        <p>
                            Active Users:
                            {{ $activeUsers }}
                        </p>

                        <p>
                            Inactive Users:
                            {{ $inactiveUsers }}
                        </p>

                        <p>
                            System Administrators:
                            {{ $totalSystemAdmins }}
                        </p>

                        <p>
                            Company Administrators:
                            {{ $totalCompanyAdmins }}
                        </p>

                        <p>
                            Quality Managers:
                            {{ $totalQualityManagers }}
                        </p>

                        <p>
                            Quality Engineers:
                            {{ $totalQualityEngineers }}
                        </p>

                        <p>
                            Production Supervisors:
                            {{ $totalProductionSupervisors }}
                        </p>


                        <hr class="my-4">


                        <h3 class="text-lg font-semibold mb-4">
                            Company Overview
                        </h3>

                        <h4 class="font-semibold mb-2">
                            Recently Created Companies
                        </h4>

                        @if ($recentlyCreatedCompanies->count())

                            @foreach ($recentlyCreatedCompanies as $company)
                                <p>
                                    {{ $company->name }}
                                    — {{ $company->created_at->format('d M Y') }}
                                </p>
                            @endforeach

                        @else

                            <p>No companies found.</p>

                        @endif


                        <h4 class="font-semibold mt-6 mb-2">
                            Recently Updated Companies
                        </h4>

                        @if ($recentlyUpdatedCompanies->count())

                            @foreach ($recentlyUpdatedCompanies as $company)
                                <p>
                                    {{ $company->name }}
                                    — {{ $company->updated_at->format('d M Y') }}
                                </p>
                            @endforeach

                        @else

                            <p>No companies found.</p>

                        @endif


                        <hr class="my-4">


                        <h3 class="text-lg font-semibold mb-4">
                            Attention / Status
                        </h3>

                        <h4 class="font-semibold mb-2">
                            Inactive Companies
                        </h4>

                        @if ($inactiveCompanyList->count())

                            @foreach ($inactiveCompanyList as $company)
                                <p>
                                    {{ $company->name }}
                                </p>
                            @endforeach

                        @else

                            <p>No inactive companies.</p>

                        @endif


                        <h4 class="font-semibold mt-6 mb-2">
                            Inactive Company Administrators
                        </h4>

                        @if ($inactiveCompanyAdmins->count())

                            @foreach ($inactiveCompanyAdmins as $admin)
                                <p>
                                    {{ $admin->name }}
                                </p>
                            @endforeach

                        @else

                            <p>No inactive company administrators.</p>

                        @endif


                        <h4 class="font-semibold mt-6 mb-2">
                            Inactive System Administrators
                        </h4>

                        @if ($inactiveSystemAdmins->count())

                            @foreach ($inactiveSystemAdmins as $admin)
                                <p>
                                    {{ $admin->name }}
                                </p>
                            @endforeach

                        @else

                            <p>No inactive system administrators.</p>

                        @endif


                    @else

                        {{-- COMPANY ADMINISTRATOR DASHBOARD --}}

                        <h3 class="text-lg font-semibold mb-4">
                            Company Overview
                        </h3>

                        <p>
                            Company Name:
                            {{ $company?->name ?? 'N/A' }}
                        </p>

                        <p>
                            Company Status:
                            {{ $company?->is_active ? 'Active' : 'Inactive' }}
                        </p>

                        <p>
                            Industry:
                            {{ $company?->industry ?? 'N/A' }}
                        </p>

                        <p>
                            Location:
                            {{ $company?->city ?? 'N/A' }},
                            {{ $company?->country ?? 'N/A' }}
                        </p>


                        <hr class="my-4">


                        <h3 class="text-lg font-semibold mb-4">
                            Team Overview
                        </h3>

                        <p>
                            Total Users:
                            {{ $totalUsers }}
                        </p>

                        <p>
                            Active Users:
                            {{ $activeUsers }}
                        </p>

                        <p>
                            Inactive Users:
                            {{ $inactiveUsers }}
                        </p>

                        <p>
                            Company Administrators:
                            {{ $companyAdmins }}
                        </p>

                        <p>
                            Quality Managers:
                            {{ $qualityManagers }}
                        </p>

                        <p>
                            Quality Engineers:
                            {{ $qualityEngineers }}
                        </p>

                        <p>
                            Production Supervisors:
                            {{ $productionSupervisors }}
                        </p>


                        <hr class="my-4">


                        <h3 class="text-lg font-semibold mb-4">
                            Recent Team Activity
                        </h3>

                        <h4 class="font-semibold mb-2">
                            Recently Created Users
                        </h4>

                        @if ($recentlyCreatedUsers->count())

                            @foreach ($recentlyCreatedUsers as $user)
                                <p>
                                    {{ $user->name }}
                                    — {{ $user->created_at->format('d M Y') }}
                                </p>
                            @endforeach

                        @else

                            <p>No recently created users.</p>

                        @endif


                        <h4 class="font-semibold mt-6 mb-2">
                            Recently Updated Users
                        </h4>

                        @if ($recentlyUpdatedUsers->count())

                            @foreach ($recentlyUpdatedUsers as $user)
                                <p>
                                    {{ $user->name }}
                                    — {{ $user->updated_at->format('d M Y') }}
                                </p>
                            @endforeach

                        @else

                            <p>No recently updated users.</p>

                        @endif


                        <hr class="my-4">


                        <h3 class="text-lg font-semibold mb-4">
                            Attention / Status
                        </h3>

                        <h4 class="font-semibold mb-2">
                            Inactive Users
                        </h4>

                        @if ($inactiveUsersList->count())

                            @foreach ($inactiveUsersList as $user)
                                <p>
                                    {{ $user->name }}
                                </p>
                            @endforeach

                        @else

                            <p>No inactive users.</p>

                        @endif

                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>