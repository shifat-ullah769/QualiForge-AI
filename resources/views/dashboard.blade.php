<x-app-layout>

    <style>
        /* =========================================================
           QUALIFORGE AI — ADMIN DASHBOARD
           FRONTEND ONLY
           No controller / model / route / database changes.
        ========================================================= */

        .qf-dashboard {
            --qf-bg: #07111f;
            --qf-surface: #0b192b;
            --qf-surface-2: #0e2034;
            --qf-border: rgba(148, 163, 184, 0.13);

            --qf-text: #f8fafc;
            --qf-text-soft: #cbd5e1;
            --qf-muted: #94a3b8;
            --qf-muted-dark: #64748b;

            --qf-cyan: #22d3ee;
            --qf-cyan-soft: #67e8f9;

            --qf-green: #22c55e;
            --qf-yellow: #f59e0b;
            --qf-red: #ef4444;

            min-height: calc(100vh - 64px);

            padding: 34px 24px 60px;

            color: var(--qf-text);

            background:
                radial-gradient(circle at 5% 5%,
                    rgba(34, 211, 238, 0.08),
                    transparent 27%),
                radial-gradient(circle at 95% 90%,
                    rgba(59, 130, 246, 0.07),
                    transparent 30%),
                var(--qf-bg);
        }

        .qf-container {
            width: 100%;
            max-width: 1380px;
            margin: 0 auto;
        }

        /* =========================================================
           HEADER
        ========================================================= */

        .qf-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;

            margin-bottom: 30px;
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

        .qf-title {
            margin: 0;

            color: var(--qf-text);

            font-size: 31px;
            font-weight: 700;
            line-height: 1.15;
            letter-spacing: -0.035em;
        }

        .qf-subtitle {
            max-width: 680px;

            margin: 8px 0 0;

            color: var(--qf-muted);

            font-size: 14px;
            line-height: 1.6;
        }

        .qf-role-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 10px 14px;

            border: 1px solid rgba(34, 211, 238, 0.18);
            border-radius: 10px;

            color: var(--qf-cyan-soft);

            background: rgba(34, 211, 238, 0.06);

            font-size: 12px;
            font-weight: 600;

            white-space: nowrap;
        }

        /* =========================================================
           STAT CARDS
        ========================================================= */

        .qf-stat-grid {
            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 16px;

            margin-bottom: 22px;
        }

        .qf-stat {
            position: relative;

            padding: 21px;

            overflow: hidden;

            border: 1px solid var(--qf-border);
            border-radius: 16px;

            background:
                linear-gradient(145deg,
                    rgba(13, 32, 52, 0.95),
                    rgba(8, 22, 38, 0.95));

            box-shadow:
                0 14px 35px rgba(0, 0, 0, 0.16);

            transition:
                transform 0.2s ease,
                border-color 0.2s ease;
        }

        .qf-stat:hover {
            transform: translateY(-2px);

            border-color:
                rgba(34, 211, 238, 0.25);
        }

        .qf-stat::after {
            content: "";

            position: absolute;

            width: 90px;
            height: 90px;

            right: -35px;
            bottom: -45px;

            border-radius: 50%;

            background: rgba(34, 211, 238, 0.055);

            pointer-events: none;
        }

        .qf-stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 18px;
        }

        .qf-stat-label {
            color: var(--qf-muted);

            font-size: 12px;
            font-weight: 600;
        }

        .qf-stat-icon {
            width: 38px;
            height: 38px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border-radius: 11px;

            color: var(--qf-cyan);

            background: rgba(34, 211, 238, 0.08);

            font-size: 17px;
        }

        .qf-stat-value {
            margin: 0;

            color: var(--qf-text);

            font-size: 30px;
            font-weight: 700;
            line-height: 1;

            letter-spacing: -0.035em;
        }

        .qf-stat-description {
            margin-top: 9px;

            color: var(--qf-muted-dark);

            font-size: 11px;
        }

        /* =========================================================
           PANELS
        ========================================================= */

        .qf-grid {
            display: grid;

            grid-template-columns:
                minmax(0, 1.25fr) minmax(320px, 0.75fr);

            gap: 20px;

            margin-bottom: 20px;
        }

        .qf-panel {
            overflow: hidden;

            border: 1px solid var(--qf-border);
            border-radius: 16px;

            background:
                linear-gradient(145deg,
                    rgba(11, 26, 44, 0.95),
                    rgba(8, 21, 36, 0.95));

            box-shadow:
                0 14px 35px rgba(0, 0, 0, 0.13);
        }

        .qf-panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;

            padding: 19px 21px;

            border-bottom:
                1px solid var(--qf-border);
        }

        .qf-panel-title {
            display: flex;
            align-items: center;
            gap: 9px;

            margin: 0;

            color: var(--qf-text);

            font-size: 15px;
            font-weight: 700;
        }

        .qf-panel-title i {
            color: var(--qf-cyan);
        }

        .qf-panel-subtitle {
            margin: 4px 0 0;

            color: var(--qf-muted-dark);

            font-size: 11px;
        }

        .qf-panel-body {
            padding: 21px;
        }

        /* =========================================================
           COMPANY OVERVIEW
        ========================================================= */

        .qf-company-grid {
            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 12px;
        }

        .qf-mini {
            padding: 17px;

            border: 1px solid rgba(148, 163, 184, 0.10);
            border-radius: 12px;

            background: rgba(15, 31, 50, 0.55);
        }

        .qf-mini-label {
            margin-bottom: 8px;

            color: var(--qf-muted-dark);

            font-size: 11px;
        }

        .qf-mini-value {
            color: var(--qf-text);

            font-size: 22px;
            font-weight: 700;
        }

        .qf-mini-value.green {
            color: #86efac;
        }

        .qf-mini-value.red {
            color: #fca5a5;
        }

        /* =========================================================
           USER DISTRIBUTION
        ========================================================= */

        .qf-role-list {
            display: grid;
            gap: 10px;
        }

        .qf-role-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;

            padding: 12px 13px;

            border: 1px solid rgba(148, 163, 184, 0.08);
            border-radius: 11px;

            background: rgba(15, 31, 50, 0.42);
        }

        .qf-role-left {
            display: flex;
            align-items: center;
            gap: 10px;

            min-width: 0;
        }

        .qf-role-icon {
            width: 31px;
            height: 31px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 8px;

            color: var(--qf-cyan);

            background: rgba(34, 211, 238, 0.07);

            font-size: 13px;
        }

        .qf-role-name {
            overflow: hidden;

            color: var(--qf-text-soft);

            font-size: 11px;
            font-weight: 600;

            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .qf-role-count {
            min-width: 32px;

            padding: 4px 8px;

            border-radius: 7px;

            color: var(--qf-cyan-soft);

            background: rgba(34, 211, 238, 0.07);

            font-size: 11px;
            font-weight: 700;

            text-align: center;
        }

        /* =========================================================
           RECENT LIST
        ========================================================= */

        .qf-list {
            display: grid;
        }

        .qf-list-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;

            padding: 14px 0;

            border-bottom:
                1px solid rgba(148, 163, 184, 0.08);
        }

        .qf-list-item:first-child {
            padding-top: 0;
        }

        .qf-list-item:last-child {
            padding-bottom: 0;

            border-bottom: 0;
        }

        .qf-list-left {
            display: flex;
            align-items: center;
            gap: 11px;

            min-width: 0;
        }

        .qf-company-icon {
            width: 34px;
            height: 34px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border: 1px solid rgba(34, 211, 238, 0.13);
            border-radius: 9px;

            color: var(--qf-cyan);

            background: rgba(34, 211, 238, 0.06);

            font-size: 14px;
        }

        .qf-company-name {
            overflow: hidden;

            color: var(--qf-text-soft);

            font-size: 12px;
            font-weight: 600;

            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .qf-date {
            flex-shrink: 0;

            color: var(--qf-muted-dark);

            font-size: 10px;
        }

        .qf-empty {
            color: var(--qf-muted-dark);

            font-size: 11px;
            line-height: 1.6;
        }

        /* =========================================================
           ATTENTION
        ========================================================= */

        .qf-attention-grid {
            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 14px;
        }

        .qf-attention-card {
            min-height: 135px;

            padding: 17px;

            border: 1px solid var(--qf-border);
            border-radius: 13px;

            background: rgba(15, 31, 50, 0.48);
        }

        .qf-attention-card.warning {
            border-color:
                rgba(245, 158, 11, 0.18);
        }

        .qf-attention-card.danger {
            border-color:
                rgba(239, 68, 68, 0.18);
        }

        .qf-attention-title {
            display: flex;
            align-items: center;
            gap: 8px;

            margin-bottom: 12px;

            color: var(--qf-text-soft);

            font-size: 12px;
            font-weight: 700;
        }

        .qf-attention-title i {
            color: var(--qf-yellow);
        }

        .qf-attention-card.danger .qf-attention-title i {
            color: var(--qf-red);
        }

        .qf-attention-item {
            display: flex;
            align-items: center;
            gap: 7px;

            padding: 6px 0;

            color: var(--qf-muted);

            font-size: 11px;
        }

        .qf-attention-item i {
            color: var(--qf-red);

            font-size: 8px;
        }

        /* =========================================================
           COMPANY ADMIN FALLBACK UI
           Existing backend data preserved.
           This section will be redesigned later.
        ========================================================= */

        .qf-company-old {
            color: var(--qf-text);
        }

        .qf-company-old h3 {
            margin: 0 0 16px;

            font-size: 18px;
            font-weight: 700;
        }

        .qf-company-old h4 {
            margin: 22px 0 9px;

            font-size: 14px;
            font-weight: 700;
        }

        .qf-company-old p {
            margin: 7px 0;

            color: var(--qf-muted);

            font-size: 13px;
        }

        .qf-company-old hr {
            margin: 22px 0;

            border: 0;
            border-top:
                1px solid var(--qf-border);
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1100px) {

            .qf-stat-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

            .qf-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 800px) {

            .qf-dashboard {
                padding: 25px 16px 45px;
            }

            .qf-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .qf-company-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

            .qf-attention-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 550px) {

            .qf-stat-grid {
                grid-template-columns: 1fr;
            }

            .qf-company-grid {
                grid-template-columns: 1fr;
            }

            .qf-panel-header,
            .qf-panel-body {
                padding: 16px;
            }

            .qf-title {
                font-size: 26px;
            }
        }
    </style>


    <div class="qf-dashboard">

        <div class="qf-container">


            {{-- =====================================================
                 SYSTEM ADMINISTRATOR
            ====================================================== --}}

            @if (auth()->user()->hasRole(\App\UserRole::SYSTEM_ADMINISTRATOR))


            {{-- HEADER --}}

            <div class="qf-header">

                <div>

                    <div class="qf-eyebrow">

                        <span class="qf-dot"></span>

                        Platform Administration

                    </div>

                    <h1 class="qf-title">
                        System Overview
                    </h1>

                    <p class="qf-subtitle">
                        Monitor companies, users and platform
                        administration from one centralized workspace.
                    </p>

                </div>


                <div class="qf-role-badge">

                    <i class="bi bi-shield-lock-fill"></i>

                    System Administrator

                </div>

            </div>


            {{-- =================================================
                     PRIMARY STATISTICS
                ================================================== --}}

            <div class="qf-stat-grid">


                {{-- TOTAL COMPANIES --}}

                <div class="qf-stat">

                    <div class="qf-stat-top">

                        <span class="qf-stat-label">
                            Total Companies
                        </span>

                        <span class="qf-stat-icon">
                            <i class="bi bi-buildings"></i>
                        </span>

                    </div>

                    <p class="qf-stat-value">
                        {{ $totalCompanies }}
                    </p>

                    <div class="qf-stat-description">
                        Registered on the platform
                    </div>

                </div>


                {{-- ACTIVE COMPANIES --}}

                <div class="qf-stat">

                    <div class="qf-stat-top">

                        <span class="qf-stat-label">
                            Active Companies
                        </span>

                        <span class="qf-stat-icon">
                            <i class="bi bi-check-circle"></i>
                        </span>

                    </div>

                    <p class="qf-stat-value">
                        {{ $activeCompanies }}
                    </p>

                    <div class="qf-stat-description">
                        Currently operational
                    </div>

                </div>


                {{-- TOTAL USERS --}}

                <div class="qf-stat">

                    <div class="qf-stat-top">

                        <span class="qf-stat-label">
                            Total Users
                        </span>

                        <span class="qf-stat-icon">
                            <i class="bi bi-people"></i>
                        </span>

                    </div>

                    <p class="qf-stat-value">
                        {{ $totalUsers }}
                    </p>

                    <div class="qf-stat-description">
                        Across all companies
                    </div>

                </div>


                {{-- ACTIVE USERS --}}

                <div class="qf-stat">

                    <div class="qf-stat-top">

                        <span class="qf-stat-label">
                            Active Users
                        </span>

                        <span class="qf-stat-icon">
                            <i class="bi bi-person-check"></i>
                        </span>

                    </div>

                    <p class="qf-stat-value">
                        {{ $activeUsers }}
                    </p>

                    <div class="qf-stat-description">
                        Active platform accounts
                    </div>

                </div>


            </div>


            {{-- =================================================
                     COMPANY + USER OVERVIEW
                ================================================== --}}

            <div class="qf-grid">


                {{-- COMPANY OVERVIEW --}}

                <section class="qf-panel">

                    <div class="qf-panel-header">

                        <div>

                            <h2 class="qf-panel-title">

                                <i class="bi bi-buildings"></i>

                                Company Overview

                            </h2>

                            <p class="qf-panel-subtitle">
                                Current platform company status
                            </p>

                        </div>

                    </div>


                    <div class="qf-panel-body">

                        <div class="qf-company-grid">


                            <div class="qf-mini">

                                <div class="qf-mini-label">
                                    Total Companies
                                </div>

                                <div class="qf-mini-value">
                                    {{ $totalCompanies }}
                                </div>

                            </div>


                            <div class="qf-mini">

                                <div class="qf-mini-label">
                                    Active
                                </div>

                                <div class="qf-mini-value green">
                                    {{ $activeCompanies }}
                                </div>

                            </div>


                            <div class="qf-mini">

                                <div class="qf-mini-label">
                                    Inactive
                                </div>

                                <div
                                    class="qf-mini-value
                                        {{ $inactiveCompanies > 0 ? 'red' : 'green' }}">
                                    {{ $inactiveCompanies }}
                                </div>

                            </div>


                        </div>

                    </div>

                </section>


                {{-- USER DISTRIBUTION --}}

                <section class="qf-panel">

                    <div class="qf-panel-header">

                        <div>

                            <h2 class="qf-panel-title">

                                <i class="bi bi-diagram-3"></i>

                                User Distribution

                            </h2>

                            <p class="qf-panel-subtitle">
                                Platform users by role
                            </p>

                        </div>

                    </div>


                    <div class="qf-panel-body">

                        <div class="qf-role-list">


                            {{-- SYSTEM ADMINS --}}

                            <div class="qf-role-item">

                                <div class="qf-role-left">

                                    <span class="qf-role-icon">
                                        <i class="bi bi-shield-lock"></i>
                                    </span>

                                    <span class="qf-role-name">
                                        System Administrators
                                    </span>

                                </div>

                                <span class="qf-role-count">
                                    {{ $totalSystemAdmins }}
                                </span>

                            </div>


                            {{-- COMPANY ADMINS --}}

                            <div class="qf-role-item">

                                <div class="qf-role-left">

                                    <span class="qf-role-icon">
                                        <i class="bi bi-person-gear"></i>
                                    </span>

                                    <span class="qf-role-name">
                                        Company Administrators
                                    </span>

                                </div>

                                <span class="qf-role-count">
                                    {{ $totalCompanyAdmins }}
                                </span>

                            </div>


                            {{-- QUALITY MANAGERS --}}

                            <div class="qf-role-item">

                                <div class="qf-role-left">

                                    <span class="qf-role-icon">
                                        <i class="bi bi-person-check"></i>
                                    </span>

                                    <span class="qf-role-name">
                                        Quality Managers
                                    </span>

                                </div>

                                <span class="qf-role-count">
                                    {{ $totalQualityManagers }}
                                </span>

                            </div>


                            {{-- QUALITY ENGINEERS --}}

                            <div class="qf-role-item">

                                <div class="qf-role-left">

                                    <span class="qf-role-icon">
                                        <i class="bi bi-cpu"></i>
                                    </span>

                                    <span class="qf-role-name">
                                        Quality Engineers
                                    </span>

                                </div>

                                <span class="qf-role-count">
                                    {{ $totalQualityEngineers }}
                                </span>

                            </div>


                            {{-- PRODUCTION SUPERVISORS --}}

                            <div class="qf-role-item">

                                <div class="qf-role-left">

                                    <span class="qf-role-icon">
                                        <i class="bi bi-clipboard-check"></i>
                                    </span>

                                    <span class="qf-role-name">
                                        Production Supervisors
                                    </span>

                                </div>

                                <span class="qf-role-count">
                                    {{ $totalProductionSupervisors }}
                                </span>

                            </div>


                        </div>

                    </div>

                </section>


            </div>


            {{-- =================================================
                     RECENT COMPANIES
                ================================================== --}}

            <div class="qf-grid">


                {{-- RECENTLY CREATED --}}

                <section class="qf-panel">

                    <div class="qf-panel-header">

                        <div>

                            <h2 class="qf-panel-title">

                                <i class="bi bi-plus-circle"></i>

                                Recently Created Companies

                            </h2>

                            <p class="qf-panel-subtitle">
                                Latest companies added to the platform
                            </p>

                        </div>

                    </div>


                    <div class="qf-panel-body">

                        @if ($recentlyCreatedCompanies->count())

                        <div class="qf-list">

                            @foreach ($recentlyCreatedCompanies as $company)

                            <div class="qf-list-item">

                                <div class="qf-list-left">

                                    <span class="qf-company-icon">

                                        <i class="bi bi-building"></i>

                                    </span>

                                    <span class="qf-company-name">

                                        {{ $company->name }}

                                    </span>

                                </div>


                                <span class="qf-date">

                                    {{ $company->created_at->format('d M Y') }}

                                </span>

                            </div>

                            @endforeach

                        </div>

                        @else

                        <div class="qf-empty">
                            No companies found.
                        </div>

                        @endif

                    </div>

                </section>


                {{-- RECENTLY UPDATED --}}

                <section class="qf-panel">

                    <div class="qf-panel-header">

                        <div>

                            <h2 class="qf-panel-title">

                                <i class="bi bi-arrow-repeat"></i>

                                Recently Updated

                            </h2>

                            <p class="qf-panel-subtitle">
                                Latest company changes
                            </p>

                        </div>

                    </div>


                    <div class="qf-panel-body">

                        @if ($recentlyUpdatedCompanies->count())

                        <div class="qf-list">

                            @foreach ($recentlyUpdatedCompanies as $company)

                            <div class="qf-list-item">

                                <div class="qf-list-left">

                                    <span class="qf-company-icon">

                                        <i class="bi bi-building-gear"></i>

                                    </span>

                                    <span class="qf-company-name">

                                        {{ $company->name }}

                                    </span>

                                </div>


                                <span class="qf-date">

                                    {{ $company->updated_at->format('d M Y') }}

                                </span>

                            </div>

                            @endforeach

                        </div>

                        @else

                        <div class="qf-empty">
                            No companies found.
                        </div>

                        @endif

                    </div>

                </section>


            </div>


            {{-- =================================================
                     ATTENTION / STATUS
                ================================================== --}}

            <section class="qf-panel">

                <div class="qf-panel-header">

                    <div>

                        <h2 class="qf-panel-title">

                            <i class="bi bi-activity"></i>

                            Attention & Status

                        </h2>

                        <p class="qf-panel-subtitle">
                            Items that may require administrative attention
                        </p>

                    </div>

                </div>


                <div class="qf-panel-body">

                    <div class="qf-attention-grid">


                        {{-- INACTIVE COMPANIES --}}

                        <div
                            class="qf-attention-card
                                {{ $inactiveCompanyList->count() ? 'warning' : '' }}">

                            <div class="qf-attention-title">

                                <i class="bi bi-buildings"></i>

                                Inactive Companies

                            </div>


                            @if ($inactiveCompanyList->count())

                            @foreach ($inactiveCompanyList as $company)

                            <div class="qf-attention-item">

                                <i class="bi bi-circle-fill"></i>

                                {{ $company->name }}

                            </div>

                            @endforeach

                            @else

                            <div class="qf-empty">
                                No inactive companies.
                            </div>

                            @endif

                        </div>


                        {{-- INACTIVE COMPANY ADMINS --}}

                        <div
                            class="qf-attention-card
                                {{ $inactiveCompanyAdmins->count() ? 'warning' : '' }}">

                            <div class="qf-attention-title">

                                <i class="bi bi-person-x"></i>

                                Inactive Company Administrators

                            </div>


                            @if ($inactiveCompanyAdmins->count())

                            @foreach ($inactiveCompanyAdmins as $admin)

                            <div class="qf-attention-item">

                                <i class="bi bi-circle-fill"></i>

                                {{ $admin->name }}

                            </div>

                            @endforeach

                            @else

                            <div class="qf-empty">
                                No inactive company administrators.
                            </div>

                            @endif

                        </div>


                        {{-- INACTIVE SYSTEM ADMINS --}}

                        <div
                            class="qf-attention-card
                                {{ $inactiveSystemAdmins->count() ? 'danger' : '' }}">

                            <div class="qf-attention-title">

                                <i class="bi bi-shield-x"></i>

                                Inactive System Administrators

                            </div>


                            @if ($inactiveSystemAdmins->count())

                            @foreach ($inactiveSystemAdmins as $admin)

                            <div class="qf-attention-item">

                                <i class="bi bi-circle-fill"></i>

                                {{ $admin->name }}

                            </div>

                            @endforeach

                            @else

                            <div class="qf-empty">
                                No inactive system administrators.
                            </div>

                            @endif

                        </div>


                    </div>

                </div>

            </section>


            @elseif (auth()->user()->hasRole(\App\UserRole::QUALITY_ENGINEER))

            {{-- =====================================================
                 QUALITY ENGINEER DASHBOARD
            ====================================================== --}}


            <div class="qf-qe-dashboard">

                <div class="qf-qe-header">
                    <div>
                        <span class="qf-qe-eyebrow">MANUFACTURING QUALITY INTELLIGENCE</span>
                        <h1>Welcome back, {{ $user->name }}!</h1>
                        <p>Monitor your company's datasets, predictions, inspections and defects from one place.</p>
                    </div>
                    <div class="qf-qe-company">
                        <i class="bi bi-building"></i>
                        <span>{{ $company?->name ?? 'No company assigned' }}</span>
                    </div>
                </div>

                @if($company)

                <div class="qf-qe-section-title">
                    <h2>Quality Overview</h2>
                    <span>Company-wide records</span>
                </div>

                <div class="qf-qe-stats">

                    <a href="{{ route('qe.datasets.index') }}" class="qf-qe-stat">
                        <i class="bi bi-database"></i>
                        <span>Total Datasets</span>
                        <strong>{{ $totalDatasets }}</strong>
                        <small>{{ $validatedDatasets }} validated</small>
                    </a>

                    <a href="{{ route('qe.predictions.index') }}" class="qf-qe-stat">
                        <i class="bi bi-graph-up-arrow"></i>
                        <span>Total Predictions</span>
                        <strong>{{ $totalPredictions }}</strong>
                        <small>{{ $completedPredictions }} completed</small>
                    </a>

                    <a href="{{ route('qe.defects.index') }}" class="qf-qe-stat">
                        <i class="bi bi-exclamation-triangle"></i>
                        <span>Total Defects</span>
                        <strong>{{ $totalDefects }}</strong>
                        <small>{{ $openDefects }} open / investigating</small>
                    </a>

                    <a href="{{ route('qe.inspections.index') }}" class="qf-qe-stat">
                        <i class="bi bi-clipboard-check"></i>
                        <span>Total Inspections</span>
                        <strong>{{ $totalInspections }}</strong>
                        <small>{{ $completedInspections }} completed</small>
                    </a>

                </div>

                <div class="qf-qe-section-title">
                    <h2>Quality Attention</h2>
                    <span>Items that may require review</span>
                </div>

                <div class="qf-qe-attention">

                    <div>
                        <span>Pending Dataset Validation</span>
                        <strong>{{ $pendingDatasets }}</strong>
                    </div>

                    <div>
                        <span>Failed Dataset Validation</span>
                        <strong>{{ $failedDatasets }}</strong>
                    </div>

                    <div>
                        <span>High / Critical Open Defects</span>
                        <strong>{{ $highPriorityDefects }}</strong>
                    </div>

                    <div>
                        <span>Failed Inspections</span>
                        <strong>{{ $failedInspections }}</strong>
                    </div>

                    <div>
                        <span>Scheduled Inspections</span>
                        <strong>{{ $scheduledInspections }}</strong>
                    </div>

                </div>

                <div class="qf-qe-section-title">
                    <h2>Quality Management Modules</h2>
                    <span>Access your workspace</span>
                </div>

                <div class="qf-qe-modules">

                    <a href="{{ route('qe.datasets.index') }}">
                        <i class="bi bi-database"></i>
                        <strong>Dataset Management</strong>
                        <span>Upload, validate and manage manufacturing datasets.</span>
                        <small>Open module →</small>
                    </a>

                    <a href="{{ route('qe.predictions.index') }}">
                        <i class="bi bi-graph-up-arrow"></i>
                        <strong>Prediction Management</strong>
                        <span>Run and review quality prediction results.</span>
                        <small>Open module →</small>
                    </a>

                    <a href="{{ route('qe.defects.index') }}">
                        <i class="bi bi-exclamation-diamond"></i>
                        <strong>Defect Management</strong>
                        <span>Record, investigate and monitor defects.</span>
                        <small>Open module →</small>
                    </a>

                    <a href="{{ route('qe.inspections.index') }}">
                        <i class="bi bi-clipboard-check"></i>
                        <strong>Inspection Management</strong>
                        <span>Create inspections and review their results.</span>
                        <small>Open module →</small>
                    </a>

                    <a href="{{ route('qe.alerts.index') }}">
                        <i class="bi bi-bell"></i>
                        <strong>Quality Alerts</strong>
                        <span>Review active quality alerts and issues.</span>
                        <small>Open module →</small>
                    </a>

                    <a href="{{ route('qe.root-cause-analysis.index') }}">
                        <i class="bi bi-search"></i>
                        <strong>Root Cause Analysis</strong>
                        <span>Explore defect patterns across machines and lines.</span>
                        <small>Open module →</small>
                    </a>

                    <a href="{{ route('qe.reports.index') }}">
                        <i class="bi bi-file-earmark-bar-graph"></i>
                        <strong>Quality Reports</strong>
                        <span>Review company quality reports and summaries.</span>
                        <small>Open module →</small>
                    </a>

                </div>

                <div class="qf-qe-section-title">
                    <h2>Recent Activity</h2>
                    <span>Latest company records</span>
                </div>

                <div class="qf-qe-recent-grid">

                    <div class="qf-qe-recent">
                        <h3>Recent Datasets</h3>
                        @forelse($recentDatasets as $dataset)
                        <a href="{{ route('qe.datasets.show', $dataset->id) }}">
                            <span>{{ $dataset->name }}</span>
                            <small>{{ $dataset->created_at->format('d M Y') }}</small>
                        </a>
                        @empty
                        <p>No datasets uploaded yet.</p>
                        @endforelse
                    </div>

                    <div class="qf-qe-recent">
                        <h3>Recent Defects</h3>
                        @forelse($recentDefects as $defect)
                        <a href="{{ route('qe.defects.show', $defect->id) }}">
                            <span>{{ $defect->defect_type }}</span>
                            <small>{{ ucfirst($defect->status) }}</small>
                        </a>
                        @empty
                        <p>No defects recorded yet.</p>
                        @endforelse
                    </div>

                    <div class="qf-qe-recent">
                        <h3>Recent Inspections</h3>
                        @forelse($recentInspections as $inspection)
                        <a href="{{ route('qe.inspections.show', $inspection->id) }}">
                            <span>{{ $inspection->inspection_number }}</span>
                            <small>{{ ucfirst($inspection->status) }}</small>
                        </a>
                        @empty
                        <p>No inspections recorded yet.</p>
                        @endforelse
                    </div>

                </div>

                @else
                <div class="qf-qe-empty">
                    No company is currently assigned to your account.
                    Please contact your Company Administrator.
                </div>
                @endif

            </div>



            <style>
                .qf-qe-dashboard {
                    color: #f8fafc;
                    width: 100%;
                }

                .qf-qe-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    flex-wrap: wrap;
                    gap: 20px;
                    margin-bottom: 32px;
                }

                .qf-qe-eyebrow {
                    color: #22d3ee;
                    font-size: 11px;
                    font-weight: 700;
                    letter-spacing: 2px;
                }

                .qf-qe-header h1 {
                    margin: 10px 0;
                    font-size: 30px;
                    font-weight: 750;
                }

                .qf-qe-header p,
                .qf-qe-section-title span {
                    color: #94a3b8;
                    font-size: 13px;
                }

                .qf-qe-company {
                    padding: 13px 17px;
                    border: 1px solid #263b52;
                    border-radius: 10px;
                    background: #10243a;
                    color: #67e8f9;
                    display: flex;
                    gap: 10px;
                    align-items: center;
                    font-size: 13px;
                }

                .qf-qe-section-title {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    flex-wrap: wrap;
                    gap: 10px;
                    margin: 30px 0 15px;
                }

                .qf-qe-section-title h2 {
                    font-size: 18px;
                    font-weight: 750;
                    margin: 0;
                }

                .qf-qe-stats {
                    display: grid;
                    grid-template-columns: repeat(4, minmax(0, 1fr));
                    gap: 15px;
                }

                .qf-qe-stat {
                    display: flex;
                    flex-direction: column;
                    gap: 9px;
                    padding: 20px;
                    text-decoration: none !important;
                    border: 1px solid #263b52;
                    border-radius: 13px;
                    background: #111f32;
                    transition: .2s;
                }

                .qf-qe-stat:hover,
                .qf-qe-modules a:hover {
                    border-color: #22d3ee;
                    transform: translateY(-2px);
                }

                .qf-qe-stat i {
                    color: #22d3ee;
                    font-size: 22px;
                }

                .qf-qe-stat span {
                    color: #94a3b8;
                    font-size: 12px;
                }

                .qf-qe-stat strong {
                    color: #f8fafc;
                    font-size: 28px;
                }

                .qf-qe-stat small {
                    color: #67e8f9;
                    font-size: 11px;
                }

                .qf-qe-attention {
                    display: grid;
                    grid-template-columns: repeat(5, minmax(0, 1fr));
                    gap: 12px;
                }

                .qf-qe-attention>div {
                    padding: 16px;
                    background: #111f32;
                    border: 1px solid #263b52;
                    border-radius: 11px;
                }

                .qf-qe-attention span {
                    display: block;
                    color: #94a3b8;
                    font-size: 11px;
                    min-height: 32px;
                }

                .qf-qe-attention strong {
                    display: block;
                    color: #fbbf24;
                    font-size: 23px;
                    margin-top: 8px;
                }

                .qf-qe-modules {
                    display: grid;
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                    gap: 15px;
                }

                .qf-qe-modules a {
                    display: flex;
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 11px;
                    padding: 21px;
                    text-decoration: none !important;
                    border: 1px solid #263b52;
                    border-radius: 13px;
                    background: linear-gradient(145deg, #16263b, #101c2d);
                    transition: .2s;
                }

                .qf-qe-modules i {
                    color: #22d3ee;
                    font-size: 25px;
                }

                .qf-qe-modules strong {
                    color: #f1f5f9;
                    font-size: 14px;
                }

                .qf-qe-modules span {
                    color: #94a3b8;
                    font-size: 12px;
                    line-height: 1.6;
                }

                .qf-qe-modules small {
                    color: #22d3ee;
                    font-size: 11px;
                    font-weight: 700;
                    margin-top: auto;
                }

                .qf-qe-recent-grid {
                    display: grid;
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                    gap: 15px;
                }

                .qf-qe-recent {
                    padding: 18px;
                    background: #111f32;
                    border: 1px solid #263b52;
                    border-radius: 12px;
                }

                .qf-qe-recent h3 {
                    font-size: 14px;
                    margin: 0 0 14px;
                }

                .qf-qe-recent a {
                    display: flex;
                    justify-content: space-between;
                    gap: 10px;
                    padding: 11px 0;
                    border-bottom: 1px solid #263b52;
                    color: #e2e8f0;
                    text-decoration: none;
                    font-size: 11px;
                }

                .qf-qe-recent a:hover {
                    color: #22d3ee;
                }

                .qf-qe-recent small {
                    color: #94a3b8;
                    white-space: nowrap;
                }

                .qf-qe-recent p,
                .qf-qe-empty {
                    color: #94a3b8;
                    font-size: 12px;
                }

                .qf-qe-empty {
                    padding: 25px;
                    border: 1px solid #263b52;
                    border-radius: 12px;
                    background: #111f32;
                }

                @media(max-width: 1000px) {
                    .qf-qe-stats {
                        grid-template-columns: repeat(2, 1fr);
                    }

                    .qf-qe-attention {
                        grid-template-columns: repeat(3, 1fr);
                    }

                    .qf-qe-modules {
                        grid-template-columns: repeat(2, 1fr);
                    }

                    .qf-qe-recent-grid {
                        grid-template-columns: 1fr;
                    }
                }

                @media(max-width: 550px) {

                    .qf-qe-stats,
                    .qf-qe-attention,
                    .qf-qe-modules {
                        grid-template-columns: 1fr;
                    }

                    .qf-qe-header h1 {
                        font-size: 24px;
                    }
                }
            </style>



            @elseif (auth()->user()->hasRole(\App\UserRole::QUALITY_MANAGER))

            {{-- QUALITY MANAGER DASHBOARD --}}

            <div class="qf-qm-dashboard">

                <div class="qf-qm-header">
                    <span class="qf-qm-eyebrow">
                        <i class="bi bi-shield-check"></i>
                        QUALITY MANAGEMENT INTELLIGENCE
                    </span>

                    <h1 class="qf-qm-title">
                        Welcome back, {{ $user->name }}!
                    </h1>

                    <p class="qf-qm-subtitle">
                        Monitor company-wide quality performance, predictions,
                        defects and inspection activities.
                    </p>
                </div>

                @if($company)

                <div class="qf-qm-company">
                    <strong>Company:</strong> {{ $company->name }}
                    <span style="float:right;">Read-only Monitoring</span>
                </div>

                <div class="qf-qm-grid">

                    <div class="qf-qm-card">
                        <h3><i class="bi bi-database"></i> Dataset Overview</h3>
                        <p>Total Datasets: <strong>{{ $totalDatasets }}</strong></p>
                        <p>Validated: <strong>{{ $validatedDatasets }}</strong></p>
                        <p>Pending Validation: <strong>{{ $pendingDatasets }}</strong></p>
                    </div>

                    <div class="qf-qm-card">
                        <h3><i class="bi bi-graph-up-arrow"></i> Prediction Monitoring</h3>
                        <p>Total Predictions: <strong>{{ $totalPredictions }}</strong></p>
                        <p>Completed: <strong>{{ $completedPredictions }}</strong></p>
                        <p>Failed: <strong>{{ $failedPredictions }}</strong></p>
                    </div>

                    <div class="qf-qm-card">
                        <h3><i class="bi bi-exclamation-triangle"></i> Defect Oversight</h3>
                        <p>Total Defects: <strong>{{ $totalDefects }}</strong></p>
                        <p>Open / Investigating: <strong>{{ $openDefects }}</strong></p>
                        <p>High / Critical Open: <strong>{{ $criticalDefects }}</strong></p>
                    </div>

                    <div class="qf-qm-card">
                        <h3><i class="bi bi-clipboard-check"></i> Inspection Monitoring</h3>
                        <p>Total Inspections: <strong>{{ $totalInspections }}</strong></p>
                        <p>Completed: <strong>{{ $completedInspections }}</strong></p>
                        <p>Failed: <strong>{{ $failedInspections }}</strong></p>
                    </div>

                </div>

                <div style="margin-top:28px;">
                    <h2 style="font-size:18px;font-weight:750;margin-bottom:15px;">
                        Recent Quality Activity
                    </h2>

                    <div class="qf-qm-grid">

                        <div class="qf-qm-card">
                            <h3><i class="bi bi-database"></i> Recent Datasets</h3>
                            @forelse($recentDatasets as $dataset)
                            <p>{{ $dataset->name }}</p>
                            @empty
                            <p>No datasets available.</p>
                            @endforelse
                        </div>

                        <div class="qf-qm-card">
                            <h3><i class="bi bi-graph-up"></i> Recent Predictions</h3>
                            @forelse($recentPredictions as $prediction)
                            <p>Prediction #{{ $prediction->id }} — {{ ucfirst($prediction->status) }}</p>
                            @empty
                            <p>No predictions available.</p>
                            @endforelse
                        </div>

                        <div class="qf-qm-card">
                            <h3><i class="bi bi-exclamation-triangle"></i> Recent Defects</h3>
                            @forelse($recentDefects as $defect)
                            <p>{{ $defect->defect_type }} — {{ ucfirst($defect->severity) }}</p>
                            @empty
                            <p>No defects available.</p>
                            @endforelse
                        </div>

                        <div class="qf-qm-card">
                            <h3><i class="bi bi-clipboard-check"></i> Recent Inspections</h3>
                            @forelse($recentInspections as $inspection)
                            <p>{{ $inspection->inspection_number }} — {{ ucfirst($inspection->status) }}</p>
                            @empty
                            <p>No inspections available.</p>
                            @endforelse
                        </div>

                    </div>
                </div>

                @else

                <div class="qf-qm-card">
                    <p>No company is assigned to your account. Please contact your Company Administrator.</p>
                </div>

                @endif

            </div>


            @else

            {{-- =====================================================
                 COMPANY ADMINISTRATOR
                 KEEPING EXISTING FUNCTIONALITY
            ====================================================== --}}

            {{-- Company Administrator Dashboard --}}
            <div class="qf-company-dashboard">

                {{-- Company Overview --}}
                <section class="qf-dashboard-card">

                    <div class="qf-dashboard-card-header">
                        <div class="qf-dashboard-icon cyan">
                            <i class="bi bi-building"></i>
                        </div>

                        <div>
                            <h3>Company Overview</h3>
                            <p>Your company's current information</p>
                        </div>
                    </div>

                    <div class="qf-dashboard-card-body">

                        @if ($company)
                        <div class="qf-company-name">
                            {{ $company->name }}
                        </div>

                        <div class="qf-company-meta">
                            <span>
                                <i class="bi bi-briefcase"></i>
                                {{ $company->industry ?? 'Industry not specified' }}
                            </span>

                            <span>
                                <i class="bi bi-geo-alt"></i>
                                {{ $company->city ?? 'City not specified' }},
                                {{ $company->country ?? 'Country not specified' }}
                            </span>
                        </div>

                        <div class="qf-company-status">
                            @if ($company->is_active)
                            <span class="qf-status-active">
                                <span></span> Active
                            </span>
                            @else
                            <span class="qf-status-inactive">
                                <span></span> Inactive
                            </span>
                            @endif
                        </div>

                        <a href="{{ route('companies.show', $company) }}"
                            class="qf-dashboard-link">
                            View Company Details
                            <i class="bi bi-arrow-up-right"></i>
                        </a>
                        @else
                        <p class="qf-muted">
                            No company is currently assigned to your account.
                        </p>
                        @endif

                    </div>
                </section>


                {{-- Team Overview --}}
                <section class="qf-dashboard-card">

                    <div class="qf-dashboard-card-header">
                        <div class="qf-dashboard-icon purple">
                            <i class="bi bi-people-fill"></i>
                        </div>

                        <div>
                            <h3>Team Overview</h3>
                            <p>Summary of your company users</p>
                        </div>
                    </div>

                    <div class="qf-dashboard-card-body">

                        <div class="qf-team-stats">

                            <div class="qf-team-stat">
                                <span>Total Users</span>
                                <strong>{{ $totalUsers }}</strong>
                            </div>

                            <div class="qf-team-stat">
                                <span>Active Users</span>
                                <strong class="qf-number-green">
                                    {{ $activeUsers }}
                                </strong>
                            </div>

                            <div class="qf-team-stat">
                                <span>Inactive Users</span>
                                <strong class="qf-number-red">
                                    {{ $inactiveUsers }}
                                </strong>
                            </div>

                        </div>

                        <div class="qf-role-breakdown">

                            <div>
                                <span>Company Administrators</span>
                                <strong>{{ $companyAdmins }}</strong>
                            </div>

                            <div>
                                <span>Quality Managers</span>
                                <strong>{{ $qualityManagers }}</strong>
                            </div>

                            <div>
                                <span>Quality Engineers</span>
                                <strong>{{ $qualityEngineers }}</strong>
                            </div>

                            <div>
                                <span>Production Supervisors</span>
                                <strong>{{ $productionSupervisors }}</strong>
                            </div>

                        </div>

                        <a href="{{ route('users.index') }}"
                            class="qf-dashboard-link">
                            Manage Team
                            <i class="bi bi-arrow-up-right"></i>
                        </a>

                    </div>
                </section>



                {{-- Manufacturing Overview --}}
                <section class="qf-dashboard-card">

                    <div class="qf-dashboard-card-header">
                        <div class="qf-dashboard-icon cyan">
                            <i class="bi bi-buildings"></i>
                        </div>

                        <div>
                            <h3>Manufacturing Overview</h3>
                            <p>Your company's manufacturing infrastructure</p>
                        </div>
                    </div>

                    <div class="qf-dashboard-card-body">

                        <div class="qf-team-stats">

                            <div class="qf-team-stat">
                                <span>Total Factories</span>
                                <strong>{{ $totalFactories }}</strong>
                            </div>

                            <div class="qf-team-stat">
                                <span>Production Lines</span>
                                <strong>{{ $totalProductionLines }}</strong>
                            </div>

                            <div class="qf-team-stat">
                                <span>Total Machines</span>
                                <strong>{{ $totalMachines }}</strong>
                            </div>

                        </div>

                        <a href="{{ route('company-admin.manufacturing.index') }}"
                            class="qf-dashboard-link">
                            Manage Manufacturing Setup
                            <i class="bi bi-arrow-up-right"></i>
                        </a>

                    </div>
                </section>

                {{-- User Assignment Overview --}}
                <section class="qf-dashboard-card">

                    <div class="qf-dashboard-card-header">
                        <div class="qf-dashboard-icon purple">
                            <i class="bi bi-person-workspace"></i>
                        </div>

                        <div>
                            <h3>User Assignment Overview</h3>
                            <p>Monitor your company's workforce assignments</p>
                        </div>
                    </div>

                    <div class="qf-dashboard-card-body">

                        <div class="qf-team-stats">

                            <div class="qf-team-stat">
                                <span>Total Assignments</span>
                                <strong>{{ $totalAssignments }}</strong>
                            </div>

                            <div class="qf-team-stat">
                                <span>Active Assignments</span>
                                <strong class="qf-number-green">
                                    {{ $activeAssignments }}
                                </strong>
                            </div>

                            <div class="qf-team-stat">
                                <span>Assigned Engineers</span>
                                <strong>{{ $assignedEngineers }}</strong>
                            </div>

                        </div>

                        <a href="{{ route('company-admin.assignments.index') }}"
                            class="qf-dashboard-link">
                            Manage User Assignments
                            <i class="bi bi-arrow-up-right"></i>
                        </a>

                    </div>
                </section>

                {{-- Recent Team Activity --}}
                <section class="qf-dashboard-card">

                    <div class="qf-dashboard-card-header">
                        <div class="qf-dashboard-icon blue">
                            <i class="bi bi-clock-history"></i>
                        </div>

                        <div>
                            <h3>Recent Team Activity</h3>
                            <p>Recently created and updated accounts</p>
                        </div>
                    </div>

                    <div class="qf-dashboard-card-body">

                        <h4 class="qf-list-heading">Recently Created Users</h4>

                        @forelse ($recentlyCreatedUsers as $recentUser)
                        <div class="qf-activity-row">
                            <div class="qf-activity-avatar">
                                {{ strtoupper(substr($recentUser->name, 0, 1)) }}
                            </div>

                            <div class="qf-activity-info">
                                <strong>{{ $recentUser->name }}</strong>
                                <span>{{ $recentUser->email }}</span>
                            </div>

                            <span class="qf-activity-date">
                                {{ $recentUser->created_at->format('d M Y') }}
                            </span>
                        </div>
                        @empty
                        <p class="qf-muted">No recently created users.</p>
                        @endforelse


                        <div class="qf-list-divider"></div>

                        <h4 class="qf-list-heading">Recently Updated Users</h4>

                        @forelse ($recentlyUpdatedUsers as $updatedUser)
                        <div class="qf-activity-row">
                            <div class="qf-activity-avatar">
                                {{ strtoupper(substr($updatedUser->name, 0, 1)) }}
                            </div>

                            <div class="qf-activity-info">
                                <strong>{{ $updatedUser->name }}</strong>
                                <span>{{ $updatedUser->email }}</span>
                            </div>

                            <span class="qf-activity-date">
                                {{ $updatedUser->updated_at->format('d M Y') }}
                            </span>
                        </div>
                        @empty
                        <p class="qf-muted">No recently updated users.</p>
                        @endforelse

                    </div>
                </section>


                {{-- Attention / Status --}}
                <section class="qf-dashboard-card">

                    <div class="qf-dashboard-card-header">
                        <div class="qf-dashboard-icon orange">
                            <i class="bi bi-exclamation-circle"></i>
                        </div>

                        <div>
                            <h3>Attention &amp; Status</h3>
                            <p>Accounts that may require your attention</p>
                        </div>
                    </div>

                    <div class="qf-dashboard-card-body">

                        @if ($inactiveUsersList->isNotEmpty())

                        <div class="qf-attention-summary">
                            <i class="bi bi-exclamation-triangle"></i>

                            <div>
                                <strong>{{ $inactiveUsersList->count() }} inactive user(s)</strong>
                                <span>Review their account status below.</span>
                            </div>
                        </div>

                        @foreach ($inactiveUsersList as $inactiveUser)
                        <div class="qf-inactive-row">

                            <div class="qf-activity-avatar inactive">
                                {{ strtoupper(substr($inactiveUser->name, 0, 1)) }}
                            </div>

                            <div class="qf-activity-info">
                                <strong>{{ $inactiveUser->name }}</strong>
                                <span>{{ $inactiveUser->email }}</span>

                                @if ($inactiveUser->deactivated_at)
                                <small>
                                    Deactivated
                                    {{ $inactiveUser->deactivated_at->format('d M Y, h:i A') }}
                                </small>
                                @endif
                            </div>

                            <span class="qf-status-inactive">
                                <span></span> Inactive
                            </span>

                        </div>
                        @endforeach

                        <a href="{{ route('users.index') }}"
                            class="qf-dashboard-link">
                            Review Users
                            <i class="bi bi-arrow-up-right"></i>
                        </a>

                        @else

                        <div class="qf-all-clear">
                            <div class="qf-clear-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>

                            <strong>All Clear</strong>

                            <p>
                                There are no inactive users requiring attention.
                            </p>
                        </div>

                        @endif

                    </div>
                </section>

            </div>

            <style>
                .qf-company-dashboard {
                    display: grid;
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                    gap: 20px;
                    width: 100%;
                }

                .qf-dashboard-card {
                    min-width: 0;
                    overflow: hidden;
                    border: 1px solid #243247;
                    border-radius: 15px;
                    background: linear-gradient(145deg, #162031, #0d1726);
                    box-shadow: 0 8px 25px rgba(0, 0, 0, .2);
                }

                .qf-dashboard-card-header {
                    display: flex;
                    align-items: center;
                    gap: 13px;
                    padding: 20px;
                    border-bottom: 1px solid #243247;
                    background: rgba(8, 15, 27, .4);
                }

                .qf-dashboard-card-header h3 {
                    margin: 0 0 4px;
                    color: #f1f5f9;
                    font-size: 16px;
                    font-weight: 750;
                }

                .qf-dashboard-card-header p {
                    margin: 0;
                    color: #64748b;
                    font-size: 12px;
                }

                .qf-dashboard-icon {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-shrink: 0;
                    width: 42px;
                    height: 42px;
                    border-radius: 11px;
                    font-size: 17px;
                }

                .qf-dashboard-icon.cyan {
                    color: #22d3ee;
                    background: rgba(8, 145, 178, .12);
                    border: 1px solid rgba(34, 211, 238, .2);
                }

                .qf-dashboard-icon.purple {
                    color: #c4b5fd;
                    background: rgba(124, 58, 237, .12);
                }

                .qf-dashboard-icon.blue {
                    color: #60a5fa;
                    background: rgba(37, 99, 235, .12);
                }

                .qf-dashboard-icon.orange {
                    color: #fb923c;
                    background: rgba(249, 115, 22, .12);
                }

                .qf-dashboard-card-body {
                    padding: 20px;
                }

                .qf-company-name {
                    color: #f1f5f9;
                    font-size: 20px;
                    font-weight: 750;
                    overflow-wrap: anywhere;
                }

                .qf-company-meta {
                    display: grid;
                    gap: 10px;
                    margin-top: 16px;
                }

                .qf-company-meta span {
                    display: flex;
                    align-items: flex-start;
                    gap: 9px;
                    color: #94a3b8;
                    font-size: 12px;
                    overflow-wrap: anywhere;
                }

                .qf-company-meta i {
                    color: #22d3ee;
                }

                .qf-company-status {
                    margin-top: 18px;
                }

                .qf-status-active,
                .qf-status-inactive {
                    display: inline-flex;
                    align-items: center;
                    gap: 7px;
                    padding: 6px 9px;
                    border-radius: 999px;
                    font-size: 11px;
                    font-weight: 700;
                }

                .qf-status-active {
                    color: #4ade80;
                    background: rgba(34, 197, 94, .1);
                }

                .qf-status-active span,
                .qf-status-inactive span {
                    width: 6px;
                    height: 6px;
                    border-radius: 50%;
                    background: currentColor;
                }

                .qf-status-inactive {
                    color: #f87171;
                    background: rgba(239, 68, 68, .1);
                }

                .qf-dashboard-link {
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                    margin-top: 20px;
                    color: #22d3ee !important;
                    font-size: 12px;
                    font-weight: 700;
                    text-decoration: none;
                }

                .qf-dashboard-link:hover {
                    color: #a5f3fc !important;
                }

                .qf-team-stats {
                    display: grid;
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                    gap: 10px;
                }

                .qf-team-stat {
                    padding: 13px 10px;
                    border: 1px solid #26364c;
                    border-radius: 10px;
                    background: rgba(15, 23, 42, .6);
                }

                .qf-team-stat span {
                    display: block;
                    color: #94a3b8;
                    font-size: 11px;
                }

                .qf-team-stat strong {
                    display: block;
                    margin-top: 7px;
                    color: #f1f5f9;
                    font-size: 23px;
                }

                .qf-team-stat .qf-number-green,
                .qf-team-stat strong.qf-number-green {
                    color: #4ade80;
                }

                .qf-team-stat .qf-number-red,
                .qf-team-stat strong.qf-number-red {
                    color: #f87171;
                }

                .qf-role-breakdown {
                    display: grid;
                    gap: 0;
                    margin-top: 18px;
                }

                .qf-role-breakdown>div {
                    display: flex;
                    justify-content: space-between;
                    gap: 12px;
                    padding: 11px 0;
                    border-bottom: 1px solid #243247;
                    color: #94a3b8;
                    font-size: 12px;
                }

                .qf-role-breakdown strong {
                    color: #e2e8f0;
                }

                .qf-list-heading {
                    margin: 0 0 12px;
                    color: #cbd5e1;
                    font-size: 12px;
                    font-weight: 750;
                }

                .qf-activity-row,
                .qf-inactive-row {
                    display: flex;
                    align-items: center;
                    gap: 11px;
                    padding: 11px 0;
                    border-bottom: 1px solid rgba(36, 50, 71, .75);
                }

                .qf-activity-avatar {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-shrink: 0;
                    width: 36px;
                    height: 36px;
                    border: 1px solid rgba(34, 211, 238, .2);
                    border-radius: 50%;
                    background: rgba(8, 145, 178, .12);
                    color: #67e8f9;
                    font-size: 13px;
                    font-weight: 750;
                }

                .qf-activity-avatar.inactive {
                    color: #f87171;
                    border-color: rgba(248, 113, 113, .2);
                    background: rgba(239, 68, 68, .1);
                }

                .qf-activity-info {
                    display: flex;
                    flex: 1;
                    flex-direction: column;
                    min-width: 0;
                    gap: 3px;
                }

                .qf-activity-info strong {
                    color: #e2e8f0;
                    font-size: 12px;
                    overflow-wrap: anywhere;
                }

                .qf-activity-info span,
                .qf-activity-info small {
                    color: #64748b;
                    font-size: 11px;
                    overflow-wrap: anywhere;
                }

                .qf-activity-date {
                    flex-shrink: 0;
                    color: #64748b;
                    font-size: 10px;
                }

                .qf-list-divider {
                    height: 1px;
                    margin: 20px 0;
                    background: #243247;
                }

                .qf-attention-summary {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    padding: 14px;
                    border: 1px solid rgba(249, 115, 22, .2);
                    border-radius: 10px;
                    background: rgba(249, 115, 22, .07);
                    color: #fb923c;
                }

                .qf-attention-summary>i {
                    font-size: 19px;
                }

                .qf-attention-summary div {
                    display: flex;
                    flex-direction: column;
                    gap: 4px;
                }

                .qf-attention-summary strong {
                    font-size: 12px;
                }

                .qf-attention-summary span {
                    color: #94a3b8;
                    font-size: 11px;
                }

                .qf-all-clear {
                    padding: 25px 10px;
                    text-align: center;
                }

                .qf-clear-icon {
                    margin-bottom: 12px;
                    color: #4ade80;
                    font-size: 29px;
                }

                .qf-all-clear strong {
                    display: block;
                    color: #e2e8f0;
                    font-size: 15px;
                }

                .qf-all-clear p,
                .qf-muted {
                    color: #64748b;
                    font-size: 12px;
                }

                .qf-all-clear p {
                    margin: 6px 0 0;
                }

                @media (max-width: 850px) {
                    .qf-company-dashboard {
                        grid-template-columns: 1fr;
                    }
                }

                @media (max-width: 480px) {
                    .qf-team-stats {
                        grid-template-columns: 1fr;
                    }

                    .qf-activity-date {
                        display: none;
                    }

                    .qf-dashboard-card-header,
                    .qf-dashboard-card-body {
                        padding: 16px;
                    }
                }

                /* =========================================================
   QUALITY MANAGER DASHBOARD
========================================================= */

                .qf-qm-dashboard {
                    width: 100%;
                    color: #f8fafc;
                }

                .qf-qm-header {
                    margin-bottom: 28px;
                }

                .qf-qm-eyebrow {
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    margin-bottom: 9px;
                    color: #22d3ee;
                    font-size: 11px;
                    font-weight: 700;
                    letter-spacing: .13em;
                    text-transform: uppercase;
                }

                .qf-qm-title {
                    margin: 0 0 10px;
                    color: #f8fafc;
                    font-size: 31px;
                    font-weight: 750;
                    line-height: 1.2;
                }

                .qf-qm-subtitle {
                    margin: 0;
                    color: #94a3b8;
                    font-size: 13px;
                    line-height: 1.7;
                }

                .qf-qm-company {
                    margin-bottom: 22px;
                    padding: 17px 20px;
                    border: 1px solid #243247;
                    border-radius: 12px;
                    background: #0e2034;
                    color: #cbd5e1;
                    font-size: 13px;
                }

                .qf-qm-company strong {
                    margin-right: 5px;
                    color: #22d3ee;
                }

                .qf-qm-grid {
                    display: grid;
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                    gap: 20px;
                }

                .qf-qm-card {
                    min-width: 0;
                    padding: 23px;
                    border: 1px solid #243247;
                    border-radius: 15px;
                    background: linear-gradient(145deg, #162031, #0d1726);
                    box-shadow: 0 8px 25px rgba(0, 0, 0, .16);
                    transition: border-color .2s ease, transform .2s ease;
                }

                .qf-qm-card:hover {
                    border-color: rgba(34, 211, 238, .4);
                    transform: translateY(-2px);
                }

                .qf-qm-card h3 {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    margin: 0 0 13px;
                    color: #e2e8f0;
                    font-size: 15px;
                    font-weight: 750;
                }

                .qf-qm-card h3 i {
                    color: #22d3ee;
                    font-size: 18px;
                }

                .qf-qm-card p {
                    margin: 0;
                    color: #94a3b8;
                    font-size: 12px;
                    line-height: 1.8;
                }

                .qf-qm-status {
                    display: inline-flex;
                    align-items: center;
                    margin-top: 17px;
                    padding: 6px 10px;
                    border: 1px solid rgba(245, 158, 11, .2);
                    border-radius: 20px;
                    background: rgba(245, 158, 11, .1);
                    color: #fbbf24;
                    font-size: 10px;
                    font-weight: 700;
                }

                @media (max-width: 850px) {
                    .qf-qm-grid {
                        grid-template-columns: 1fr;
                    }
                }

                @media (max-width: 480px) {
                    .qf-qm-title {
                        font-size: 25px;
                    }

                    .qf-qm-card {
                        padding: 18px;
                    }
                }
            </style>

            @endif

        </div>

    </div>

</x-app-layout>