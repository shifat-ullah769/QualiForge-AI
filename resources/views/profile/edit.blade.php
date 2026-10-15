<x-app-layout>

    {{-- =========================
        Page Header
    ========================== --}}
    <x-slot name="header">
        <div class="qf-page-header">

            <div>

                <div class="qf-eyebrow">

                    <i class="bi bi-person-circle"></i>

                    @if (auth()->user()->hasRole(\App\UserRole::SYSTEM_ADMINISTRATOR))
                        QUALIFORGE AI
                    @elseif (auth()->user()->hasRole(\App\UserRole::COMPANY_ADMINISTRATOR))
                        COMPANY WORKSPACE
                    @else
                        QUALIFORGE AI
                    @endif

                </div>

                <h2 class="qf-page-title">
                    Profile
                </h2>

                <p class="qf-page-subtitle">

                    @if (auth()->user()->hasRole(\App\UserRole::COMPANY_ADMINISTRATOR))

                        Manage your personal information, password, and company account settings.

                    @else

                        Manage your personal information, password, and account settings.

                    @endif

                </p>

            </div>

        </div>
    </x-slot>


    {{-- =========================
        Main Content
    ========================== --}}
    <div class="qf-profile-page">

        <div class="qf-profile-container">

            {{-- =========================
                Profile Information
            ========================== --}}
            <section class="qf-profile-card qf-profile-info-card">

                <div class="qf-card-header">

                    <div class="qf-card-icon qf-icon-cyan">
                        <i class="bi bi-person-vcard-fill"></i>
                    </div>

                    <div>

                        <h3 class="qf-card-title">
                            Profile Information
                        </h3>

                        <p class="qf-card-description">

                            @if (auth()->user()->hasRole(\App\UserRole::COMPANY_ADMINISTRATOR))
                                Update your personal information and company profile details.
                            @else
                                Update your account information and profile details.
                            @endif

                        </p>

                    </div>

                </div>

                <div class="qf-card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>

            </section>


            {{-- =========================
                Password
            ========================== --}}
            <section class="qf-profile-card">

                <div class="qf-card-header">

                    <div class="qf-card-icon qf-icon-purple">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>

                    <div>

                        <h3 class="qf-card-title">
                            Update Password
                        </h3>

                        <p class="qf-card-description">
                            Make sure your account uses a strong and secure password.
                        </p>

                    </div>

                </div>

                <div class="qf-card-body">
                    @include('profile.partials.update-password-form')
                </div>

            </section>


            {{-- =========================
                Delete Account
            ========================== --}}
            <section class="qf-profile-card qf-danger-card">

                <div class="qf-card-header">

                    <div class="qf-card-icon qf-icon-red">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>

                    <div>

                        <h3 class="qf-card-title">
                            Delete Account
                        </h3>

                        <p class="qf-card-description">

                            @if (auth()->user()->hasRole(\App\UserRole::COMPANY_ADMINISTRATOR))
                                Permanently remove your account and associated company access.
                            @else
                                Permanently remove your account and associated access.
                            @endif

                        </p>

                    </div>

                </div>

                <div class="qf-card-body">
                    @include('profile.partials.delete-user-form')
                </div>

            </section>

        </div>

    </div>


    {{-- =========================
        Dark Technical Theme
    ========================== --}}
    <style>

        /* =========================
           Main Page
        ========================== */

        .qf-profile-page {
            min-height: calc(100vh - 80px);
            padding: 42px 24px 65px;

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


        .qf-profile-container {
            width: 100%;
            max-width: 1050px;
            margin: 0 auto;

            display: flex;
            flex-direction: column;
            gap: 20px;
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
           Profile Cards
        ========================== */

        .qf-profile-card {
            overflow: hidden;

            border: 1px solid #243247;
            border-radius: 15px;

            background:
                linear-gradient(
                    145deg,
                    rgba(22, 32, 49, 0.97),
                    rgba(13, 23, 38, 0.98)
                );

            box-shadow:
                0 8px 28px rgba(0, 0, 0, 0.20);

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }


        .qf-profile-card:hover {
            border-color: #31506b;

            box-shadow:
                0 12px 32px rgba(0, 0, 0, 0.25);
        }


        /* =========================
           Card Header
        ========================== */

        .qf-card-header {
            display: flex;
            align-items: center;
            gap: 15px;

            padding: 21px 23px;

            border-bottom: 1px solid #243247;

            background:
                rgba(8, 15, 27, 0.40);
        }


        .qf-card-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            width: 43px;
            height: 43px;

            border-radius: 11px;

            font-size: 17px;
        }


        .qf-icon-cyan {
            border: 1px solid rgba(34, 211, 238, 0.25);

            background: rgba(8, 145, 178, 0.12);

            color: #22d3ee;
        }


        .qf-icon-purple {
            border: 1px solid rgba(167, 139, 250, 0.25);

            background: rgba(124, 58, 237, 0.12);

            color: #a78bfa;
        }


        .qf-icon-red {
            border: 1px solid rgba(248, 113, 113, 0.25);

            background: rgba(239, 68, 68, 0.10);

            color: #f87171;
        }


        .qf-card-title {
            margin: 0 0 4px;

            color: #f1f5f9;

            font-size: 16px;
            font-weight: 750;
        }


        .qf-card-description {
            margin: 0;

            color: #64748b;

            font-size: 12px;
            line-height: 1.5;
        }


        /* =========================
           Card Body
        ========================== */

        .qf-card-body {
            padding: 23px;
        }


        /* =====================================================
           PROFILE PHOTO
           Facebook-style circular avatar
        ====================================================== */

        .qf-profile-info-card .qf-card-body img {
            display: block !important;

            width: 96px !important;
            height: 96px !important;

            min-width: 96px !important;
            min-height: 96px !important;

            max-width: 96px !important;
            max-height: 96px !important;

            margin: 0 0 14px !important;

            border: 3px solid #1e293b !important;

            border-radius: 50% !important;

            background: #0f172a !important;

            object-fit: cover !important;
            object-position: center !important;

            box-shadow:
                0 0 0 1px rgba(34, 211, 238, 0.35),
                0 8px 22px rgba(0, 0, 0, 0.30) !important;
        }


        /* Photo wrapper if present */

        .qf-profile-info-card .rounded-full {
            border-radius: 50% !important;
        }


        .qf-profile-info-card .rounded-lg {
            border-radius: 50% !important;
        }


        /* Profile photo label */

        .qf-profile-info-card label {
            color: #cbd5e1 !important;

            font-size: 13px !important;
            font-weight: 600 !important;
        }


        /* File upload */

        .qf-profile-info-card input[type="file"] {
            width: 100%;

            max-width: 500px;

            padding: 8px;

            border: 1px solid #334155 !important;
            border-radius: 8px !important;

            background: #0f172a !important;

            color: #94a3b8 !important;

            font-size: 12px !important;
        }


        .qf-profile-info-card input[type="file"]::file-selector-button {
            margin-right: 10px;

            padding: 7px 12px;

            border: 1px solid #334155;

            border-radius: 6px;

            background: #1e293b;

            color: #cbd5e1;

            font-size: 11px;
            font-weight: 600;

            cursor: pointer;
        }


        .qf-profile-info-card input[type="file"]::file-selector-button:hover {
            border-color: #0891b2;

            background: #164e63;

            color: #67e8f9;
        }


        /* =========================
           Inputs
        ========================== */

        .qf-profile-card input,
        .qf-profile-card textarea,
        .qf-profile-card select {
            border-color: #334155 !important;

            background-color: #0f172a !important;

            color: #e2e8f0 !important;

            border-radius: 8px !important;
        }


        .qf-profile-card input::placeholder,
        .qf-profile-card textarea::placeholder {
            color: #475569 !important;
        }


        .qf-profile-card input:focus,
        .qf-profile-card textarea:focus,
        .qf-profile-card select:focus {
            border-color: #0891b2 !important;

            box-shadow:
                0 0 0 1px rgba(8, 145, 178, 0.25) !important;

            outline: none !important;
        }


        /* =========================
           Text
        ========================== */

        .qf-profile-card p {
            color: #64748b;
        }


        .qf-profile-card .text-gray-600,
        .qf-profile-card .text-gray-700,
        .qf-profile-card .text-gray-800,
        .qf-profile-card .text-gray-900 {
            color: #94a3b8 !important;
        }


        .qf-profile-card .text-gray-400,
        .qf-profile-card .text-gray-500 {
            color: #64748b !important;
        }


        .qf-profile-card .dark\:text-gray-100,
        .qf-profile-card .dark\:text-gray-200 {
            color: #e2e8f0 !important;
        }


        /* =========================
           Buttons
        ========================== */

        .qf-profile-card button[type="submit"] {
            border: 1px solid rgba(34, 211, 238, 0.35) !important;

            border-radius: 8px !important;

            background:
                linear-gradient(
                    135deg,
                    #0891b2,
                    #0e7490
                ) !important;

            color: #ffffff !important;

            font-size: 12px !important;
            font-weight: 700 !important;

            transition: all 0.2s ease !important;
        }


        .qf-profile-card button[type="submit"]:hover {
            border-color: #22d3ee !important;

            box-shadow:
                0 5px 18px rgba(8, 145, 178, 0.20) !important;

            transform: translateY(-1px);
        }


        /* =========================
           Success Messages
        ========================== */

        .qf-profile-card .text-green-600,
        .qf-profile-card .text-green-500 {
            color: #4ade80 !important;
        }


        .qf-profile-card .bg-green-100 {
            background: rgba(34, 197, 94, 0.10) !important;
        }


        /* =========================
           Validation Errors
        ========================== */

        .qf-profile-card .text-red-600,
        .qf-profile-card .text-red-500,
        .qf-profile-card .text-red-700 {
            color: #f87171 !important;
        }


        /* =========================
           Delete Account
        ========================== */

        .qf-danger-card {
            border-color: rgba(239, 68, 68, 0.22);
        }


        .qf-danger-card:hover {
            border-color: rgba(239, 68, 68, 0.38);
        }


        .qf-danger-card button[type="submit"] {
            border-color: rgba(248, 113, 113, 0.35) !important;

            background:
                rgba(127, 29, 29, 0.25) !important;

            color: #f87171 !important;
        }


        .qf-danger-card button[type="submit"]:hover {
            border-color: #f87171 !important;

            background:
                rgba(127, 29, 29, 0.40) !important;

            box-shadow:
                0 5px 18px rgba(239, 68, 68, 0.12) !important;
        }


        /* =========================
           Links
        ========================== */

        .qf-profile-card a {
            color: #38bdf8;
        }


        .qf-profile-card a:hover {
            color: #67e8f9;
        }


        /* =========================
           Responsive
        ========================== */

        @media (max-width: 640px) {

            .qf-profile-page {
                padding: 28px 15px 45px;
            }


            .qf-card-header {
                align-items: flex-start;
                padding: 18px;
            }


            .qf-card-body {
                padding: 18px;
            }


            .qf-page-title {
                font-size: 22px;
            }


            .qf-profile-info-card .qf-card-body img {
                width: 82px !important;
                height: 82px !important;

                min-width: 82px !important;
                min-height: 82px !important;

                max-width: 82px !important;
                max-height: 82px !important;
            }

        }

    </style>

</x-app-layout>
