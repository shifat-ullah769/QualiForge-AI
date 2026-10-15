<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Company Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="text-lg font-semibold mb-4">
                        Companies
                    </h3>

                    @if (auth()->user()->hasRole(\App\UserRole::SYSTEM_ADMINISTRATOR))

                    <div class="mb-4">

                        <a
                            href="{{ route('companies.create') }}"
                            style="
                            display: inline-block;
                            background-color: #2563eb;
                            color: white;
                            padding: 8px 14px;
                            border-radius: 6px;
                            text-decoration: none;
                            font-weight: 500;
                        ">
                            Create Company
                        </a>

                    </div>

                    @endif

                    @if (session('success'))
                    <div class="mb-4 rounded-md bg-green-100 px-4 py-3 text-sm text-green-800">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="space-y-3">
                        @forelse ($companies as $company)
                        <div class="border rounded-md p-4">

                            <p>
                                <strong>Name:</strong>
                                {{ $company->name }}
                            </p>

                            <p>
                                <strong>Code:</strong>
                                {{ $company->code }}
                            </p>

                            <p>
                                <strong>Industry:</strong>
                                {{ $company->industry ?? 'Not Set' }}
                            </p>

                            <p>
                                <strong>Country:</strong>
                                {{ $company->country }}
                            </p>

                            <p>
                                <strong>Status:</strong>
                                {{ $company->is_active ? 'Active' : 'Inactive' }}
                            </p>

                            <p>
                                <strong>Users:</strong>
                                {{ $company->users()->count() }}
                            </p>

                            <div class="mt-4 flex gap-2">

                                <a
                                    href="{{ route('companies.show', $company) }}"
                                    style="display: inline-block; background-color: #374151; color: white; padding: 8px 12px; border-radius: 6px; text-decoration: none;">
                                    View Details
                                </a>

                                <a
                                    href="{{ route('companies.edit', $company) }}"
                                    style="display: inline-block; background-color: #2563eb; color: white; padding: 8px 12px; border-radius: 6px; text-decoration: none;">
                                    Edit
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('companies.toggle-status', $company) }}">
                                    @csrf
                                    @method('PATCH')

                                    @if ($company->is_active)

                                    <button
                                        type="submit"
                                        style="background-color: #dc2626; color: white; padding: 8px 12px; border: none; border-radius: 6px; cursor: pointer;">
                                        Deactivate Company
                                    </button>

                                    @else

                                    <button
                                        type="submit"
                                        style="background-color: #16a34a; color: white; padding: 8px 12px; border: none; border-radius: 6px; cursor: pointer;">
                                        Activate Company
                                    </button>

                                    @endif

                                </form>

                            </div>

                        </div>
                        @empty
                        <p class="text-gray-600">
                            No companies found.
                        </p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout><x-app-layout>

    <style>
        /* =========================================================
           QUALIFORGE AI — COMPANY MANAGEMENT
           FRONTEND ONLY
        ========================================================= */

        .qf-company-page {
            --qf-bg: #07111f;
            --qf-surface: #0b192b;
            --qf-border: rgba(148, 163, 184, 0.13);

            --qf-text: #f8fafc;
            --qf-text-soft: #cbd5e1;
            --qf-muted: #94a3b8;
            --qf-muted-dark: #64748b;

            --qf-cyan: #22d3ee;
            --qf-cyan-soft: #67e8f9;

            --qf-green: #22c55e;
            --qf-red: #ef4444;

            min-height: calc(100vh - 64px);

            padding: 34px 24px 60px;

            color: var(--qf-text);

            background:
                radial-gradient(
                    circle at 5% 5%,
                    rgba(34, 211, 238, 0.08),
                    transparent 27%
                ),
                radial-gradient(
                    circle at 95% 90%,
                    rgba(59, 130, 246, 0.07),
                    transparent 30%
                ),
                var(--qf-bg);
        }

        .qf-company-container {
            width: 100%;
            max-width: 1380px;
            margin: 0 auto;
        }

        /* =========================================================
           HEADER
        ========================================================= */

        .qf-company-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;

            margin-bottom: 28px;
        }

        .qf-eyebrow {
            display: flex;
            align-items: center;
            gap: 8px;

            margin-bottom: 9px;

            color: var(--qf-cyan);

            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.13em;
            text-transform: uppercase;
        }

        .qf-dot {
            width: 7px;
            height: 7px;

            border-radius: 50%;

            background: var(--qf-cyan);

            box-shadow:
                0 0 12px rgba(34, 211, 238, 0.85);
        }

        .qf-company-title {
            margin: 0;

            color: var(--qf-text);

            font-size: 31px;
            font-weight: 700;
            line-height: 1.15;
            letter-spacing: -0.035em;
        }

        .qf-company-subtitle {
            max-width: 700px;

            margin: 8px 0 0;

            color: var(--qf-muted);

            font-size: 14px;
            line-height: 1.6;
        }

        /* =========================================================
           CREATE BUTTON
        ========================================================= */

        .qf-create-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            padding: 11px 17px;

            border: 1px solid rgba(34, 211, 238, 0.35);
            border-radius: 10px;

            color: #04111d;

            background: var(--qf-cyan);

            font-size: 12px;
            font-weight: 700;

            text-decoration: none;

            box-shadow:
                0 8px 24px rgba(34, 211, 238, 0.14);

            transition:
                transform 0.2s ease,
                background 0.2s ease,
                box-shadow 0.2s ease;
        }

        .qf-create-button:hover {
            color: #04111d;

            background: var(--qf-cyan-soft);

            transform: translateY(-1px);

            box-shadow:
                0 10px 28px rgba(34, 211, 238, 0.2);
        }

        /* =========================================================
           SUCCESS MESSAGE
        ========================================================= */

        .qf-success {
            display: flex;
            align-items: center;
            gap: 10px;

            margin-bottom: 20px;
            padding: 13px 15px;

            border: 1px solid rgba(34, 197, 94, 0.18);
            border-radius: 11px;

            color: #bbf7d0;

            background: rgba(34, 197, 94, 0.07);

            font-size: 12px;
            font-weight: 600;
        }

        .qf-success-icon {
            width: 28px;
            height: 28px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 8px;

            color: #4ade80;

            background: rgba(34, 197, 94, 0.12);
        }

        /* =========================================================
           COMPANY SUMMARY
        ========================================================= */

        .qf-summary {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;

            margin-bottom: 15px;
        }

        .qf-summary-title {
            margin: 0;

            color: var(--qf-text);

            font-size: 15px;
            font-weight: 700;
        }

        .qf-summary-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-width: 30px;
            height: 24px;

            margin-left: 7px;
            padding: 0 8px;

            border-radius: 7px;

            color: var(--qf-cyan-soft);

            background: rgba(34, 211, 238, 0.08);

            font-size: 11px;
            font-weight: 700;
        }

        /* =========================================================
           COMPANY GRID
        ========================================================= */

        .qf-company-grid {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 20px;

            align-items: stretch;
        }

        /* =========================================================
           COMPANY CARD
        ========================================================= */

        .qf-company-card {
            position: relative;

            display: flex;
            flex-direction: column;

            min-width: 0;
            min-height: 100%;

            overflow: hidden;

            padding: 21px;

            border: 1px solid var(--qf-border);
            border-radius: 16px;

            background:
                linear-gradient(
                    145deg,
                    rgba(11, 26, 44, 0.96),
                    rgba(8, 21, 36, 0.96)
                );

            box-shadow:
                0 14px 35px rgba(0, 0, 0, 0.14);

            transition:
                transform 0.2s ease,
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }

        .qf-company-card::after {
            content: "";

            position: absolute;

            width: 120px;
            height: 120px;

            right: -65px;
            top: -65px;

            border-radius: 50%;

            background: rgba(34, 211, 238, 0.045);

            pointer-events: none;
        }

        .qf-company-card:hover {
            transform: translateY(-2px);

            border-color:
                rgba(34, 211, 238, 0.24);

            box-shadow:
                0 18px 40px rgba(0, 0, 0, 0.2);
        }

        /* =========================================================
           CARD HEADER
        ========================================================= */

        .qf-card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;

            padding-bottom: 17px;

            border-bottom:
                1px solid rgba(148, 163, 184, 0.09);
        }

        .qf-card-company {
            display: flex;
            align-items: center;
            gap: 12px;

            min-width: 0;
        }

        .qf-company-icon {
            width: 43px;
            height: 43px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border: 1px solid rgba(34, 211, 238, 0.18);
            border-radius: 12px;

            color: var(--qf-cyan);

            background: rgba(34, 211, 238, 0.07);

            font-size: 17px;
        }

        .qf-company-name {
            overflow: hidden;

            margin: 0;

            color: var(--qf-text);

            font-size: 15px;
            font-weight: 700;

            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .qf-company-code {
            margin-top: 4px;

            color: var(--qf-muted-dark);

            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.04em;
        }

        /* =========================================================
           STATUS
        ========================================================= */

        .qf-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            flex-shrink: 0;

            padding: 6px 9px;

            border-radius: 8px;

            font-size: 10px;
            font-weight: 700;
        }

        .qf-status.active {
            color: #86efac;

            background: rgba(34, 197, 94, 0.08);
        }

        .qf-status.inactive {
            color: #fca5a5;

            background: rgba(239, 68, 68, 0.08);
        }

        .qf-status-dot {
            width: 6px;
            height: 6px;

            border-radius: 50%;

            background: currentColor;
        }

        /* =========================================================
           COMPANY INFORMATION
        ========================================================= */

        .qf-info-grid {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 12px;

            padding: 18px 0;
        }

        .qf-info {
            min-width: 0;

            padding: 12px;

            border: 1px solid rgba(148, 163, 184, 0.07);
            border-radius: 10px;

            background: rgba(15, 31, 50, 0.42);
        }

        .qf-info-label {
            margin-bottom: 5px;

            color: var(--qf-muted-dark);

            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .qf-info-value {
            overflow: hidden;

            color: var(--qf-text-soft);

            font-size: 12px;
            font-weight: 600;

            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* =========================================================
           USERS
        ========================================================= */

        .qf-users {
            display: flex;
            align-items: center;
            gap: 8px;

            padding-bottom: 18px;

            color: var(--qf-muted);

            font-size: 11px;
        }

        .qf-users-icon {
            width: 27px;
            height: 27px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border-radius: 8px;

            color: var(--qf-cyan);

            background: rgba(34, 211, 238, 0.07);
        }

        .qf-users strong {
            color: var(--qf-text-soft);

            font-size: 12px;
        }

        /* =========================================================
           ACTIONS
        ========================================================= */

        .qf-actions {
            display: flex;
            align-items: center;
            gap: 8px;

            margin-top: auto;
            padding-top: 15px;

            border-top:
                1px solid rgba(148, 163, 184, 0.09);
        }

        .qf-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            min-height: 34px;

            padding: 7px 12px;

            border: 1px solid transparent;
            border-radius: 8px;

            font-size: 10px;
            font-weight: 700;

            text-decoration: none;

            cursor: pointer;

            transition:
                background 0.2s ease,
                border-color 0.2s ease,
                transform 0.2s ease;
        }

        .qf-action:hover {
            transform: translateY(-1px);
        }

        .qf-action.view {
            color: var(--qf-text-soft);

            background: rgba(148, 163, 184, 0.07);

            border-color:
                rgba(148, 163, 184, 0.12);
        }

        .qf-action.view:hover {
            color: var(--qf-text);

            background: rgba(148, 163, 184, 0.12);
        }

        .qf-action.edit {
            color: var(--qf-cyan-soft);

            background: rgba(34, 211, 238, 0.07);

            border-color:
                rgba(34, 211, 238, 0.14);
        }

        .qf-action.edit:hover {
            background: rgba(34, 211, 238, 0.12);
        }

        .qf-action.deactivate {
            color: #fca5a5;

            background: rgba(239, 68, 68, 0.07);

            border-color:
                rgba(239, 68, 68, 0.14);
        }

        .qf-action.deactivate:hover {
            background: rgba(239, 68, 68, 0.12);
        }

        .qf-action.activate {
            color: #86efac;

            background: rgba(34, 197, 94, 0.07);

            border-color:
                rgba(34, 197, 94, 0.14);
        }

        .qf-action.activate:hover {
            background: rgba(34, 197, 94, 0.12);
        }

        .qf-action-form {
            margin: 0;
        }

        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .qf-empty {
            padding: 70px 25px;

            border: 1px dashed rgba(148, 163, 184, 0.16);
            border-radius: 16px;

            background: rgba(11, 25, 43, 0.65);

            text-align: center;
        }

        .qf-empty-icon {
            width: 54px;
            height: 54px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 14px;

            border-radius: 15px;

            color: var(--qf-cyan);

            background: rgba(34, 211, 238, 0.07);

            font-size: 21px;
        }

        .qf-empty-title {
            margin: 0 0 6px;

            color: var(--qf-text);

            font-size: 15px;
            font-weight: 700;
        }

        .qf-empty-text {
            margin: 0;

            color: var(--qf-muted-dark);

            font-size: 11px;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1050px) {

            .qf-company-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {

            .qf-company-page {
                padding: 25px 16px 45px;
            }

            .qf-company-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .qf-create-button {
                width: 100%;
            }
        }

        @media (max-width: 500px) {

            .qf-info-grid {
                grid-template-columns: 1fr;
            }

            .qf-actions {
                flex-wrap: wrap;
            }

            .qf-action {
                flex: 1;
            }

            .qf-card-header {
                align-items: flex-start;
            }
        }
    </style>


    <div class="qf-company-page">

        <div class="qf-company-container">


            {{-- =====================================================
                 PAGE HEADER
            ====================================================== --}}

            <div class="qf-company-header">

                <div>

                    <div class="qf-eyebrow">

                        <span class="qf-dot"></span>

                        Platform Administration

                    </div>

                    <h1 class="qf-company-title">
                        Company Management
                    </h1>

                    <p class="qf-company-subtitle">
                        Manage registered manufacturing companies,
                        review their status and maintain platform access.
                    </p>

                </div>


                {{-- SYSTEM ADMIN ONLY --}}

                @if (auth()->user()->hasRole(\App\UserRole::SYSTEM_ADMINISTRATOR))

                    <a
                        href="{{ route('companies.create') }}"
                        class="qf-create-button"
                    >
                        <i class="bi bi-plus-lg"></i>
                        Create Company
                    </a>

                @endif

            </div>


            {{-- =====================================================
                 SUCCESS MESSAGE
            ====================================================== --}}

            @if (session('success'))

                <div class="qf-success">

                    <span class="qf-success-icon">
                        <i class="bi bi-check-lg"></i>
                    </span>

                    {{ session('success') }}

                </div>

            @endif


            {{-- =====================================================
                 COMPANY COUNT
            ====================================================== --}}

            <div class="qf-summary">

                <h2 class="qf-summary-title">

                    Companies

                    <span class="qf-summary-count">
                        {{ $companies->count() }}
                    </span>

                </h2>

            </div>


            {{-- =====================================================
                 COMPANY GRID
            ====================================================== --}}

            <div class="qf-company-grid">

                @forelse ($companies as $company)


                    <div class="qf-company-card">


                        {{-- =================================================
                             CARD HEADER
                        ================================================== --}}

                        <div class="qf-card-header">

                            <div class="qf-card-company">

                                <span class="qf-company-icon">

                                    <i class="bi bi-building"></i>

                                </span>


                                <div>

                                    <h3 class="qf-company-name">
                                        {{ $company->name }}
                                    </h3>

                                    <div class="qf-company-code">
                                        {{ $company->code }}
                                    </div>

                                </div>

                            </div>


                            {{-- STATUS --}}

                            @if ($company->is_active)

                                <span class="qf-status active">

                                    <span class="qf-status-dot"></span>

                                    Active

                                </span>

                            @else

                                <span class="qf-status inactive">

                                    <span class="qf-status-dot"></span>

                                    Inactive

                                </span>

                            @endif

                        </div>


                        {{-- =================================================
                             COMPANY INFORMATION
                        ================================================== --}}

                        <div class="qf-info-grid">


                            <div class="qf-info">

                                <div class="qf-info-label">
                                    Industry
                                </div>

                                <div class="qf-info-value">
                                    {{ $company->industry ?? 'Not Set' }}
                                </div>

                            </div>


                            <div class="qf-info">

                                <div class="qf-info-label">
                                    Country
                                </div>

                                <div class="qf-info-value">
                                    {{ $company->country }}
                                </div>

                            </div>


                        </div>


                        {{-- =================================================
                             USERS
                        ================================================== --}}

                        <div class="qf-users">

                            <span class="qf-users-icon">

                                <i class="bi bi-people"></i>

                            </span>

                            <span>

                                <strong>
                                    {{ $company->users()->count() }}
                                </strong>

                                {{ $company->users()->count() === 1 ? 'user' : 'users' }}

                                registered

                            </span>

                        </div>


                        {{-- =================================================
                             ACTIONS
                        ================================================== --}}

                        <div class="qf-actions">


                            {{-- VIEW --}}

                            <a
                                href="{{ route('companies.show', $company) }}"
                                class="qf-action view"
                            >
                                <i class="bi bi-eye"></i>
                                View
                            </a>


                            {{-- EDIT --}}

                            <a
                                href="{{ route('companies.edit', $company) }}"
                                class="qf-action edit"
                            >
                                <i class="bi bi-pencil"></i>
                                Edit
                            </a>


                            {{-- STATUS TOGGLE --}}

                            <form
                                method="POST"
                                action="{{ route('companies.toggle-status', $company) }}"
                                class="qf-action-form"
                            >

                                @csrf

                                @method('PATCH')


                                @if ($company->is_active)

                                    <button
                                        type="submit"
                                        class="qf-action deactivate"
                                    >
                                        <i class="bi bi-pause-circle"></i>
                                        Deactivate
                                    </button>

                                @else

                                    <button
                                        type="submit"
                                        class="qf-action activate"
                                    >
                                        <i class="bi bi-play-circle"></i>
                                        Activate
                                    </button>

                                @endif

                            </form>


                        </div>


                    </div>


                @empty


                    {{-- =================================================
                         EMPTY STATE
                    ================================================== --}}

                    <div class="qf-empty">

                        <div class="qf-empty-icon">

                            <i class="bi bi-buildings"></i>

                        </div>

                        <h3 class="qf-empty-title">
                            No companies found
                        </h3>

                        <p class="qf-empty-text">
                            There are currently no companies available
                            for your account.
                        </p>

                    </div>


                @endforelse

            </div>


        </div>

    </div>

</x-app-layout>
