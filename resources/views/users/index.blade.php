<x-app-layout>

    {{-- =========================
        Page Header
    ========================== --}}
    <x-slot name="header">
        <div class="qf-page-header">

            <div>
                <div class="qf-eyebrow">
                    <i class="bi bi-people-fill"></i>
                    QUALIFORGE AI
                </div>

                <h2 class="qf-page-title">
                    User Management
                </h2>

                <p class="qf-page-subtitle">
                    Manage users, roles, access status, and company assignments.
                </p>
            </div>

        </div>
    </x-slot>


    {{-- =========================
        Main Content
    ========================== --}}
    <div class="qf-users-page">

        <div class="qf-container">

            {{-- Success Message --}}
            @if (session('success'))
                <div class="qf-alert qf-alert-success">
                    <div class="qf-alert-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>

                    <div>
                        <strong>Success</strong>
                        <div>{{ session('success') }}</div>
                    </div>
                </div>
            @endif


            {{-- =========================
                Toolbar
            ========================== --}}
            <div class="qf-toolbar">

                <div>
                    <div class="qf-section-label">
                        <i class="bi bi-person-lines-fill"></i>
                        User Directory
                    </div>

                    <h3 class="qf-section-title">
                        Platform Users
                    </h3>

                    <p class="qf-section-description">
                        Review and manage authorized users across the platform.
                    </p>
                </div>

                <div class="qf-toolbar-action">
                    <a href="{{ route('users.create') }}" class="qf-primary-btn">
                        <i class="bi bi-person-plus-fill"></i>
                        Create User
                    </a>
                </div>

            </div>


            {{-- =========================
                User Grid
            ========================== --}}
            <div class="qf-user-grid">

                @forelse ($users as $user)

                    <div class="qf-user-card">

                        {{-- User Header --}}
                        <div class="qf-user-card-top">

                            <div class="qf-user-identity">

                                <div class="qf-user-avatar">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>

                                <div class="qf-user-main">

                                    <h4 class="qf-user-name">
                                        {{ $user->name }}
                                    </h4>

                                    <div class="qf-user-email">
                                        <i class="bi bi-envelope"></i>
                                        {{ $user->email }}
                                    </div>

                                </div>

                            </div>


                            {{-- Status --}}
                            <div>
                                @if ($user->is_active)

                                    <span class="qf-status qf-status-active">
                                        <span class="qf-status-dot"></span>
                                        Active
                                    </span>

                                @else

                                    <span class="qf-status qf-status-inactive">
                                        <span class="qf-status-dot"></span>
                                        Inactive
                                    </span>

                                @endif
                            </div>

                        </div>


                        {{-- =========================
                            User Information
                        ========================== --}}
                        <div class="qf-user-info-grid">

                            {{-- Role --}}
                            <div class="qf-info-item">

                                <div class="qf-info-label">
                                    <i class="bi bi-shield-check"></i>
                                    Role
                                </div>

                                <div class="qf-info-value">

                                    @if ($user->role?->value === \App\UserRole::SYSTEM_ADMINISTRATOR->value)

                                        <span class="qf-role qf-role-system">
                                            System Administrator
                                        </span>

                                    @elseif ($user->role?->value === \App\UserRole::COMPANY_ADMINISTRATOR->value)

                                        <span class="qf-role qf-role-admin">
                                            Company Administrator
                                        </span>

                                    @elseif ($user->role?->value === \App\UserRole::QUALITY_MANAGER->value)

                                        <span class="qf-role">
                                            Quality Manager
                                        </span>

                                    @elseif ($user->role?->value === \App\UserRole::QUALITY_ENGINEER->value)

                                        <span class="qf-role">
                                            Quality Engineer
                                        </span>

                                    @elseif ($user->role?->value === \App\UserRole::PRODUCTION_SUPERVISOR->value)

                                        <span class="qf-role">
                                            Production Supervisor
                                        </span>

                                    @else

                                        <span class="qf-role qf-role-unassigned">
                                            Not Assigned
                                        </span>

                                    @endif

                                </div>

                            </div>


                            {{-- Company --}}
                            <div class="qf-info-item">

                                <div class="qf-info-label">
                                    <i class="bi bi-building"></i>
                                    Company
                                </div>

                                <div class="qf-info-value">
                                    {{ $user->company?->name ?? 'No Company' }}
                                </div>

                            </div>


                            {{-- Deactivated --}}
                            @if (!$user->is_active && $user->deactivated_at)

                                <div class="qf-info-item">

                                    <div class="qf-info-label">
                                        <i class="bi bi-clock-history"></i>
                                        Deactivated
                                    </div>

                                    <div class="qf-info-value">
                                        {{ $user->deactivated_at->format('d M Y, h:i A') }}
                                    </div>

                                </div>

                            @endif

                        </div>


                        {{-- =========================
                            Actions
                        ========================== --}}
                        <div class="qf-user-actions">

                            {{-- Edit User --}}
                            @if (
                                auth()->user()->hasRole(\App\UserRole::SYSTEM_ADMINISTRATOR)
                                ||
                                (
                                    auth()->user()->hasRole(\App\UserRole::COMPANY_ADMINISTRATOR)
                                    && (int) auth()->user()->company_id === (int) $user->company_id
                                )
                            )

                                <a
                                    href="{{ route('users.edit', $user) }}"
                                    class="qf-action-btn qf-action-edit"
                                >
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </a>

                            @endif


                            {{-- Activate / Deactivate --}}
                            @if (
                                auth()->user()->hasRole(\App\UserRole::SYSTEM_ADMINISTRATOR)
                                ||
                                (
                                    auth()->user()->hasRole(\App\UserRole::COMPANY_ADMINISTRATOR)
                                    && (int) auth()->user()->company_id === (int) $user->company_id
                                )
                            )

                                {{-- System Admin cannot deactivate another System Admin --}}
                                @if (
                                    !(
                                        $user->role?->value === \App\UserRole::SYSTEM_ADMINISTRATOR->value
                                        && $user->id !== auth()->id()
                                    )
                                )

                                    <form
                                        method="POST"
                                        action="{{ route('users.toggle-status', $user) }}"
                                        class="qf-inline-form"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        @if ($user->is_active)

                                            <button
                                                type="submit"
                                                class="qf-action-btn qf-action-deactivate"
                                            >
                                                <i class="bi bi-person-dash-fill"></i>
                                                Deactivate
                                            </button>

                                        @else

                                            <button
                                                type="submit"
                                                class="qf-action-btn qf-action-activate"
                                            >
                                                <i class="bi bi-person-check-fill"></i>
                                                Activate
                                            </button>

                                        @endif

                                    </form>

                                @endif

                            @endif


                            {{-- Delete User --}}
                            @if (
                                (
                                    auth()->user()->hasRole(\App\UserRole::SYSTEM_ADMINISTRATOR)
                                    && $user->role?->value === \App\UserRole::COMPANY_ADMINISTRATOR->value
                                )
                                ||
                                (
                                    auth()->user()->hasRole(\App\UserRole::COMPANY_ADMINISTRATOR)
                                    && (int) auth()->user()->company_id === (int) $user->company_id
                                )
                            )

                                <form
                                    method="POST"
                                    action="{{ route('users.destroy', $user) }}"
                                    class="qf-inline-form"
                                    onsubmit="return confirm('Are you sure you want to permanently delete this user?');"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="qf-action-btn qf-action-delete"
                                    >
                                        <i class="bi bi-trash3-fill"></i>
                                        Delete
                                    </button>

                                </form>

                            @endif

                        </div>

                    </div>

                @empty

                    {{-- Empty State --}}
                    <div class="qf-empty-state">

                        <div class="qf-empty-icon">
                            <i class="bi bi-people"></i>
                        </div>

                        <h3>No Users Found</h3>

                        <p>
                            There are currently no users available in this directory.
                        </p>

                        <a href="{{ route('users.create') }}" class="qf-primary-btn">
                            <i class="bi bi-person-plus-fill"></i>
                            Create First User
                        </a>

                    </div>

                @endforelse

            </div>

        </div>

    </div>


    {{-- =========================
        Dark Technical Theme
    ========================== --}}
    <style>

        /* =========================
           Main Page
        ========================== */

        .qf-users-page {
            min-height: calc(100vh - 80px);
            padding: 42px 24px 60px;

            background:
                radial-gradient(
                    circle at 10% 0%,
                    rgba(8, 145, 178, 0.10),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 90% 90%,
                    rgba(37, 99, 235, 0.08),
                    transparent 30%
                ),
                #0b1220;
        }

        .qf-container {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
        }


        /* =========================
           Header
        ========================== */

        .qf-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .qf-eyebrow {
            display: flex;
            align-items: center;
            gap: 8px;

            margin-bottom: 6px;

            color: #22d3ee;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .qf-page-title {
            margin: 0;

            color: #f1f5f9;

            font-size: 25px;
            font-weight: 750;
        }

        .qf-page-subtitle {
            margin: 5px 0 0;

            color: #94a3b8;

            font-size: 13px;
        }


        /* =========================
           Alert
        ========================== */

        .qf-alert {
            display: flex;
            align-items: flex-start;
            gap: 13px;

            margin-bottom: 28px;
            padding: 15px 18px;

            border: 1px solid;
            border-radius: 12px;

            font-size: 13px;
        }

        .qf-alert-success {
            color: #86efac;

            background: rgba(22, 101, 52, 0.12);

            border-color: rgba(34, 197, 94, 0.25);
        }

        .qf-alert-icon {
            color: #22c55e;

            font-size: 17px;
        }


        /* =========================
           Toolbar
        ========================== */

        .qf-toolbar {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;

            gap: 25px;
            margin-bottom: 25px;
        }

        .qf-section-label {
            display: flex;
            align-items: center;
            gap: 7px;

            margin-bottom: 5px;

            color: #22d3ee;

            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        .qf-section-title {
            margin: 0;

            color: #f8fafc;

            font-size: 22px;
            font-weight: 750;
        }

        .qf-section-description {
            margin: 5px 0 0;

            color: #64748b;

            font-size: 13px;
        }


        /* =========================
           Primary Button
        ========================== */

        .qf-primary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            padding: 11px 17px;

            border: 1px solid rgba(34, 211, 238, 0.45);
            border-radius: 9px;

            background: linear-gradient(
                135deg,
                #0891b2,
                #0e7490
            );

            color: #ffffff !important;

            font-size: 13px;
            font-weight: 700;

            text-decoration: none !important;

            box-shadow:
                0 5px 20px rgba(8, 145, 178, 0.18);

            transition: all 0.2s ease;
        }

        .qf-primary-btn:hover {
            transform: translateY(-1px);

            border-color: #22d3ee;

            box-shadow:
                0 8px 25px rgba(8, 145, 178, 0.30);
        }


        /* =========================
           User Grid
        ========================== */

        .qf-user-grid {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 18px;
        }


        /* =========================
           User Card
        ========================== */

        .qf-user-card {
            overflow: hidden;

            border: 1px solid #243247;
            border-radius: 15px;

            background:
                linear-gradient(
                    145deg,
                    rgba(22, 32, 49, 0.96),
                    rgba(13, 23, 38, 0.98)
                );

            box-shadow:
                0 8px 25px rgba(0, 0, 0, 0.20);

            transition:
                transform 0.2s ease,
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }

        .qf-user-card:hover {
            transform: translateY(-2px);

            border-color: #31506b;

            box-shadow:
                0 12px 30px rgba(0, 0, 0, 0.28);
        }


        /* =========================
           User Card Top
        ========================== */

        .qf-user-card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;

            gap: 15px;

            padding: 21px;
        }

        .qf-user-identity {
            display: flex;
            align-items: center;

            min-width: 0;

            gap: 13px;
        }

        .qf-user-avatar {
            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            width: 46px;
            height: 46px;

            border: 1px solid rgba(34, 211, 238, 0.28);
            border-radius: 12px;

            background:
                linear-gradient(
                    135deg,
                    rgba(8, 145, 178, 0.20),
                    rgba(14, 116, 144, 0.12)
                );

            color: #67e8f9;

            font-size: 17px;
            font-weight: 800;
        }

        .qf-user-main {
            min-width: 0;
        }

        .qf-user-name {
            margin: 0 0 4px;

            overflow: hidden;

            color: #f1f5f9;

            font-size: 15px;
            font-weight: 750;

            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .qf-user-email {
            display: flex;
            align-items: center;
            gap: 6px;

            overflow: hidden;

            color: #64748b;

            font-size: 12px;

            text-overflow: ellipsis;
            white-space: nowrap;
        }


        /* =========================
           Status
        ========================== */

        .qf-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 6px 9px;

            border-radius: 999px;

            font-size: 11px;
            font-weight: 700;

            white-space: nowrap;
        }

        .qf-status-dot {
            width: 6px;
            height: 6px;

            border-radius: 50%;
        }

        .qf-status-active {
            color: #4ade80;

            background: rgba(34, 197, 94, 0.10);
        }

        .qf-status-active .qf-status-dot {
            background: #22c55e;

            box-shadow:
                0 0 8px rgba(34, 197, 94, 0.55);
        }

        .qf-status-inactive {
            color: #f87171;

            background: rgba(239, 68, 68, 0.10);
        }

        .qf-status-inactive .qf-status-dot {
            background: #ef4444;
        }


        /* =========================
           Information
        ========================== */

        .qf-user-info-grid {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 12px;

            padding: 0 21px 20px;
        }

        .qf-info-item {
            min-width: 0;

            padding: 12px 13px;

            border: 1px solid #26364c;
            border-radius: 9px;

            background: rgba(15, 23, 42, 0.60);
        }

        .qf-info-label {
            display: flex;
            align-items: center;
            gap: 6px;

            margin-bottom: 6px;

            color: #64748b;

            font-size: 10px;
            font-weight: 700;

            letter-spacing: 0.8px;
            text-transform: uppercase;
        }

        .qf-info-value {
            overflow: hidden;

            color: #cbd5e1;

            font-size: 12px;
            font-weight: 600;

            text-overflow: ellipsis;
            white-space: nowrap;
        }


        /* =========================
           Role Badges
        ========================== */

        .qf-role {
            display: inline-flex;

            max-width: 100%;

            overflow: hidden;

            padding: 4px 8px;

            border: 1px solid rgba(34, 211, 238, 0.18);
            border-radius: 6px;

            background: rgba(8, 145, 178, 0.10);

            color: #67e8f9;

            font-size: 10px;
            font-weight: 700;

            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .qf-role-system {
            border-color: rgba(167, 139, 250, 0.25);

            background: rgba(124, 58, 237, 0.12);

            color: #c4b5fd;
        }

        .qf-role-admin {
            border-color: rgba(34, 211, 238, 0.25);

            background: rgba(8, 145, 178, 0.12);

            color: #67e8f9;
        }

        .qf-role-unassigned {
            border-color: #334155;

            background: rgba(100, 116, 139, 0.10);

            color: #94a3b8;
        }


        /* =========================
           Actions
        ========================== */

        .qf-user-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;

            gap: 8px;

            padding: 14px 21px;

            border-top: 1px solid #243247;

            background: rgba(8, 15, 27, 0.55);
        }

        .qf-inline-form {
            margin: 0;
        }

        .qf-action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 6px;

            min-height: 34px;

            padding: 7px 11px;

            border: 1px solid;

            border-radius: 7px;

            background: transparent;

            font-family: inherit;

            font-size: 11px;
            font-weight: 700;

            text-decoration: none !important;

            cursor: pointer;

            transition: all 0.18s ease;
        }


        /* Edit */

        .qf-action-edit {
            border-color: rgba(56, 189, 248, 0.30);

            background: rgba(14, 165, 233, 0.08);

            color: #38bdf8 !important;
        }

        .qf-action-edit:hover {
            border-color: #38bdf8;

            background: rgba(14, 165, 233, 0.15);
        }


        /* Deactivate */

        .qf-action-deactivate {
            border-color: rgba(251, 146, 60, 0.30);

            background: rgba(249, 115, 22, 0.08);

            color: #fb923c;
        }

        .qf-action-deactivate:hover {
            border-color: #fb923c;

            background: rgba(249, 115, 22, 0.15);
        }


        /* Activate */

        .qf-action-activate {
            border-color: rgba(74, 222, 128, 0.30);

            background: rgba(34, 197, 94, 0.08);

            color: #4ade80;
        }

        .qf-action-activate:hover {
            border-color: #4ade80;

            background: rgba(34, 197, 94, 0.15);
        }


        /* Delete */

        .qf-action-delete {
            border-color: rgba(248, 113, 113, 0.30);

            background: rgba(239, 68, 68, 0.08);

            color: #f87171;
        }

        .qf-action-delete:hover {
            border-color: #f87171;

            background: rgba(239, 68, 68, 0.15);
        }


        /* =========================
           Empty State
        ========================== */

        .qf-empty-state {
            grid-column: 1 / -1;

            padding: 65px 25px;

            border: 1px dashed #334155;
            border-radius: 15px;

            background: rgba(15, 23, 42, 0.55);

            text-align: center;
        }

        .qf-empty-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 58px;
            height: 58px;

            margin: 0 auto 15px;

            border: 1px solid rgba(34, 211, 238, 0.20);
            border-radius: 15px;

            background: rgba(8, 145, 178, 0.10);

            color: #22d3ee;

            font-size: 24px;
        }

        .qf-empty-state h3 {
            margin: 0 0 6px;

            color: #f1f5f9;

            font-size: 17px;
            font-weight: 750;
        }

        .qf-empty-state p {
            margin: 0 auto 20px;

            color: #64748b;

            font-size: 13px;
        }


        /* =========================
           Responsive
        ========================== */

        @media (max-width: 900px) {

            .qf-user-grid {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 640px) {

            .qf-users-page {
                padding: 28px 15px 45px;
            }

            .qf-toolbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .qf-toolbar-action,
            .qf-toolbar-action .qf-primary-btn {
                width: 100%;
            }

            .qf-user-card-top {
                flex-direction: column;
            }

            .qf-user-info-grid {
                grid-template-columns: 1fr;
            }

            .qf-user-actions {
                align-items: stretch;
            }

            .qf-action-btn {
                flex: 1;
            }

        }

    </style>

</x-app-layout>
