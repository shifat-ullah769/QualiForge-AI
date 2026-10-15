<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sign In — QualiForge AI</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <style>
        :root {
            --qf-bg: #07111f;
            --qf-bg-soft: #0b1a2c;
            --qf-panel: rgba(10, 24, 41, 0.88);
            --qf-border: rgba(148, 163, 184, 0.15);
            --qf-border-hover: rgba(34, 211, 238, 0.35);

            --qf-text: #f8fafc;
            --qf-text-soft: #cbd5e1;
            --qf-muted: #94a3b8;
            --qf-muted-dark: #64748b;

            --qf-primary: #22d3ee;
            --qf-primary-light: #67e8f9;
            --qf-success: #22c55e;
            --qf-danger: #f87171;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100%;
        }

        body {
            margin: 0;
            min-height: 100vh;

            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            color: var(--qf-text);

            background:
                radial-gradient(
                    circle at 12% 18%,
                    rgba(34, 211, 238, 0.11),
                    transparent 31%
                ),
                radial-gradient(
                    circle at 88% 82%,
                    rgba(59, 130, 246, 0.10),
                    transparent 30%
                ),
                var(--qf-bg);

            overflow-x: hidden;
        }

        /* Technical grid */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: 0.17;

            background-image:
                linear-gradient(
                    rgba(148, 163, 184, 0.07) 1px,
                    transparent 1px
                ),
                linear-gradient(
                    90deg,
                    rgba(148, 163, 184, 0.07) 1px,
                    transparent 1px
                );

            background-size: 42px 42px;

            mask-image:
                linear-gradient(
                    to bottom,
                    black,
                    transparent 92%
                );
        }

        .login-wrapper {
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 34px 20px;

            position: relative;
            z-index: 1;
        }

        .login-container {
            width: 100%;
            max-width: 1080px;
        }

        .login-shell {
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;

            min-height: 630px;

            overflow: hidden;

            border: 1px solid var(--qf-border);
            border-radius: 24px;

            background: rgba(8, 20, 35, 0.78);

            box-shadow:
                0 30px 90px rgba(0, 0, 0, 0.42),
                inset 0 1px 0 rgba(255, 255, 255, 0.04);

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        /* =========================================================
           LEFT PANEL
        ========================================================= */

        .login-info {
            position: relative;

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            padding: 54px;

            border-right: 1px solid var(--qf-border);

            background:
                radial-gradient(
                    circle at 18% 15%,
                    rgba(34, 211, 238, 0.12),
                    transparent 34%
                ),
                linear-gradient(
                    145deg,
                    rgba(15, 37, 61, 0.75),
                    rgba(7, 17, 31, 0.35)
                );
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;

            color: white;
            text-decoration: none;

            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .brand:hover {
            color: white;
        }

        .brand-mark {
            width: 40px;
            height: 40px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border-radius: 12px;

            color: #06202a;

            background:
                linear-gradient(
                    135deg,
                    var(--qf-primary-light),
                    var(--qf-primary)
                );

            box-shadow:
                0 8px 25px rgba(34, 211, 238, 0.22);
        }

        .info-content {
            max-width: 465px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            margin-bottom: 18px;

            color: var(--qf-primary);

            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .status-dot {
            width: 7px;
            height: 7px;

            border-radius: 50%;

            background: var(--qf-primary);

            box-shadow:
                0 0 14px rgba(34, 211, 238, 0.8);
        }

        .info-title {
            margin: 0 0 18px;

            font-size: clamp(34px, 4vw, 52px);
            line-height: 1.04;

            font-weight: 750;

            letter-spacing: -0.045em;
        }

        .info-title span {
            color: var(--qf-primary);
        }

        .info-text {
            margin: 0;

            max-width: 440px;

            color: var(--qf-muted);

            font-size: 15px;
            line-height: 1.8;
        }

        .platform-points {
            display: grid;
            gap: 12px;

            margin-top: 30px;
        }

        .platform-point {
            display: flex;
            align-items: center;
            gap: 12px;

            color: var(--qf-text-soft);

            font-size: 14px;
        }

        .point-icon {
            width: 30px;
            height: 30px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border: 1px solid rgba(34, 211, 238, 0.18);
            border-radius: 9px;

            color: var(--qf-primary);

            background: rgba(34, 211, 238, 0.07);
        }

        .info-footer {
            color: var(--qf-muted-dark);
            font-size: 12px;
        }

        /* =========================================================
           RIGHT PANEL
        ========================================================= */

        .login-panel {
            display: flex;
            align-items: center;

            padding: 54px;

            background:
                linear-gradient(
                    145deg,
                    rgba(7, 17, 31, 0.58),
                    rgba(7, 17, 31, 0.84)
                );
        }

        .login-form {
            width: 100%;
            max-width: 410px;

            margin: 0 auto;
        }

        .login-heading {
            margin: 0 0 8px;

            font-size: 31px;
            font-weight: 700;

            letter-spacing: -0.035em;
        }

        .login-subheading {
            margin: 0 0 32px;

            color: var(--qf-muted);

            font-size: 14px;
            line-height: 1.6;
        }

        /* =========================================================
           STATUS / ERRORS
        ========================================================= */

        .session-status {
            margin-bottom: 20px;

            padding: 12px 14px;

            border: 1px solid rgba(34, 197, 94, 0.20);
            border-radius: 10px;

            color: #86efac;

            background: rgba(34, 197, 94, 0.08);

            font-size: 13px;
            line-height: 1.5;
        }

        .error-message {
            margin-top: 7px;

            color: var(--qf-danger);

            font-size: 12px;
            line-height: 1.5;
        }

        /* =========================================================
           FORM
        ========================================================= */

        .form-group {
            margin-bottom: 21px;
        }

        .form-label {
            display: block;

            margin-bottom: 8px;

            color: var(--qf-text-soft);

            font-size: 13px;
            font-weight: 600;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;

            left: 15px;
            top: 50%;

            transform: translateY(-50%);

            color: var(--qf-muted-dark);

            pointer-events: none;

            transition: color 0.2s ease;
        }

        .form-control-qf {
            width: 100%;
            height: 50px;

            padding: 0 15px 0 44px;

            border: 1px solid rgba(148, 163, 184, 0.17);
            border-radius: 11px;

            outline: none;

            color: #f8fafc;

            background: rgba(15, 23, 42, 0.72);

            font-size: 14px;

            transition:
                border-color 0.2s ease,
                background 0.2s ease,
                box-shadow 0.2s ease;
        }

        .form-control-qf::placeholder {
            color: #64748b;
        }

        .form-control-qf:hover {
            border-color: rgba(148, 163, 184, 0.28);
        }

        .form-control-qf:focus {
            border-color: rgba(34, 211, 238, 0.68);

            background: rgba(15, 23, 42, 0.94);

            box-shadow:
                0 0 0 3px rgba(34, 211, 238, 0.09);
        }

        .input-wrapper:focus-within .input-icon {
            color: var(--qf-primary);
        }

        /* Browser autofill fix */
        .form-control-qf:-webkit-autofill,
        .form-control-qf:-webkit-autofill:hover,
        .form-control-qf:-webkit-autofill:focus,
        .form-control-qf:-webkit-autofill:active {
            -webkit-text-fill-color: #f8fafc !important;

            -webkit-box-shadow:
                0 0 0 1000px #0f1b2d inset !important;

            box-shadow:
                0 0 0 1000px #0f1b2d inset !important;

            caret-color: #f8fafc;

            transition:
                background-color 9999s ease-in-out 0s;
        }

        /* =========================================================
           PASSWORD TOGGLE
        ========================================================= */

        .password-input {
            padding-right: 48px;
        }

        .password-toggle {
            position: absolute;

            top: 50%;
            right: 12px;

            width: 32px;
            height: 32px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            transform: translateY(-50%);

            border: 0;
            border-radius: 8px;

            color: var(--qf-muted-dark);

            background: transparent;

            cursor: pointer;

            transition:
                color 0.2s ease,
                background 0.2s ease;
        }

        .password-toggle:hover {
            color: var(--qf-primary);

            background: rgba(34, 211, 238, 0.08);
        }

        .password-toggle:focus-visible {
            outline: 2px solid rgba(34, 211, 238, 0.55);
            outline-offset: 2px;
        }

        /* =========================================================
           OPTIONS
        ========================================================= */

        .login-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;

            margin: 4px 0 25px;
        }

        .remember-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            color: var(--qf-muted);

            font-size: 13px;

            cursor: pointer;
        }

        .remember-checkbox {
            width: 16px;
            height: 16px;

            margin: 0;

            accent-color: var(--qf-primary);

            cursor: pointer;
        }

        .forgot-link {
            color: var(--qf-primary-light);

            font-size: 13px;

            text-decoration: none;

            transition: color 0.2s ease;
        }

        .forgot-link:hover {
            color: #a5f3fc;
            text-decoration: underline;
        }

        /* =========================================================
           LOGIN BUTTON
        ========================================================= */

        .login-button {
            width: 100%;
            height: 50px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;

            border: 0;
            border-radius: 11px;

            color: #06202a;

            background:
                linear-gradient(
                    135deg,
                    var(--qf-primary-light),
                    var(--qf-primary)
                );

            font-size: 14px;
            font-weight: 700;

            box-shadow:
                0 10px 28px rgba(34, 211, 238, 0.16);

            cursor: pointer;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                filter 0.2s ease;
        }

        .login-button:hover {
            transform: translateY(-1px);

            filter: brightness(1.04);

            box-shadow:
                0 14px 34px rgba(34, 211, 238, 0.24);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .login-button:focus-visible {
            outline: 2px solid rgba(103, 232, 249, 0.8);
            outline-offset: 3px;
        }

        /* =========================================================
           SECURITY + HOME
        ========================================================= */

        .security-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            margin-top: 21px;

            color: var(--qf-muted-dark);

            font-size: 11px;
        }

        .security-note i {
            color: var(--qf-success);
        }

        .home-link-wrapper {
            display: flex;
            justify-content: center;

            margin-top: 20px;
        }

        .home-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            color: var(--qf-muted);

            font-size: 12px;

            text-decoration: none;

            transition: color 0.2s ease;
        }

        .home-link:hover {
            color: var(--qf-primary-light);
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 900px) {

            .login-shell {
                grid-template-columns: 1fr;

                max-width: 560px;

                margin: 0 auto;
            }

            .login-info {
                display: none;
            }

            .login-panel {
                min-height: 630px;

                padding: 44px 32px;
            }
        }

        @media (max-width: 480px) {

            .login-wrapper {
                padding: 18px 12px;
            }

            .login-shell {
                border-radius: 18px;
            }

            .login-panel {
                min-height: 600px;

                padding: 34px 22px;
            }

            .login-heading {
                font-size: 27px;
            }

            .login-options {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                transition: none !important;
                animation: none !important;
            }
        }
    </style>
</head>

<body>

<div class="login-wrapper">

    <div class="login-container">

        <div class="login-shell">

            <!-- =====================================================
                 LEFT INFORMATION PANEL
            ====================================================== -->

            <section class="login-info">

                <div>
                    <a href="{{ url('/') }}" class="brand">

                        <span class="brand-mark">
                            <i class="bi bi-cpu-fill"></i>
                        </span>

                        <span>QualiForge AI</span>

                    </a>
                </div>


                <div class="info-content">

                    <div class="eyebrow">

                        <span class="status-dot"></span>

                        Manufacturing Intelligence Platform

                    </div>


                    <h1 class="info-title">

                        Quality decisions,
                        <span>powered by intelligence.</span>

                    </h1>


                    <p class="info-text">

                        Access your manufacturing quality intelligence
                        workspace and turn production data into actionable
                        insight.

                    </p>


                    <div class="platform-points">

                        <div class="platform-point">

                            <span class="point-icon">
                                <i class="bi bi-bar-chart-line"></i>
                            </span>

                            Production and quality intelligence

                        </div>


                        <div class="platform-point">

                            <span class="point-icon">
                                <i class="bi bi-cpu"></i>
                            </span>

                            Machine learning powered analysis

                        </div>


                        <div class="platform-point">

                            <span class="point-icon">
                                <i class="bi bi-shield-check"></i>
                            </span>

                            Secure role-based access

                        </div>

                    </div>

                </div>


                <div class="info-footer">

                    © {{ date('Y') }} QualiForge AI ·
                    Manufacturing Quality Intelligence

                </div>

            </section>


            <!-- =====================================================
                 LOGIN PANEL
            ====================================================== -->

            <section class="login-panel">

                <div class="login-form">

                    <h2 class="login-heading">
                        Welcome back
                    </h2>


                    <p class="login-subheading">
                        Sign in to access your QualiForge workspace.
                    </p>


                    <!-- Laravel session status — unchanged -->
                    @if (session('status'))

                        <div class="session-status">
                            {{ session('status') }}
                        </div>

                    @endif


                    <!-- Laravel login form — backend unchanged -->
                    <form method="POST" action="{{ route('login') }}">

                        @csrf


                        <!-- Email Address -->

                        <div class="form-group">

                            <label
                                for="email"
                                class="form-label"
                            >
                                Email address
                            </label>


                            <div class="input-wrapper">

                                <i class="bi bi-envelope input-icon"></i>


                                <input
                                    id="email"
                                    class="form-control-qf"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="you@company.com"
                                    required
                                    autofocus
                                    autocomplete="username"
                                >

                            </div>


                            @if ($errors->get('email'))

                                <div class="error-message">

                                    @foreach ($errors->get('email') as $message)

                                        <div>{{ $message }}</div>

                                    @endforeach

                                </div>

                            @endif

                        </div>


                        <!-- Password -->

                        <div class="form-group">

                            <label
                                for="password"
                                class="form-label"
                            >
                                Password
                            </label>


                            <div class="input-wrapper">

                                <i class="bi bi-lock input-icon"></i>


                                <input
                                    id="password"
                                    class="form-control-qf password-input"
                                    type="password"
                                    name="password"
                                    placeholder="Enter your password"
                                    required
                                    autocomplete="current-password"
                                >


                                <!-- Client-side only.
                                     Does NOT affect Laravel authentication. -->

                                <button
                                    type="button"
                                    class="password-toggle"
                                    id="passwordToggle"
                                    aria-label="Show password"
                                    title="Show password"
                                >
                                    <i
                                        class="bi bi-eye"
                                        id="passwordToggleIcon"
                                    ></i>
                                </button>

                            </div>


                            @if ($errors->get('password'))

                                <div class="error-message">

                                    @foreach ($errors->get('password') as $message)

                                        <div>{{ $message }}</div>

                                    @endforeach

                                </div>

                            @endif

                        </div>


                        <!-- Remember Me + Forgot Password -->

                        <div class="login-options">

                            <label
                                for="remember_me"
                                class="remember-label"
                            >

                                <input
                                    id="remember_me"
                                    type="checkbox"
                                    class="remember-checkbox"
                                    name="remember"
                                >

                                <span>
                                    Remember me
                                </span>

                            </label>


                            @if (Route::has('password.request'))

                                <a
                                    class="forgot-link"
                                    href="{{ route('password.request') }}"
                                >
                                    Forgot password?
                                </a>

                            @endif

                        </div>


                        <!-- Login button -->

                        <button
                            type="submit"
                            class="login-button"
                        >

                            <span>
                                Sign in to QualiForge
                            </span>

                            <i class="bi bi-arrow-right"></i>

                        </button>


                        <!-- Security indicator -->

                        <div class="security-note">

                            <i class="bi bi-shield-lock-fill"></i>

                            Secure authenticated access

                        </div>


                        <!-- Back to landing page -->

                        <div class="home-link-wrapper">

                            <a
                                href="{{ url('/') }}"
                                class="home-link"
                            >

                                <i class="bi bi-arrow-left"></i>

                                Back to homepage

                            </a>

                        </div>

                    </form>

                </div>

            </section>

        </div>

    </div>

</div>


<!-- =============================================================
     CLIENT-SIDE PASSWORD VISIBILITY TOGGLE
     This does NOT communicate with or modify the backend.
============================================================== -->

<script>
    const passwordInput = document.getElementById('password');
    const passwordToggle = document.getElementById('passwordToggle');
    const passwordToggleIcon = document.getElementById('passwordToggleIcon');

    if (passwordInput && passwordToggle && passwordToggleIcon) {

        passwordToggle.addEventListener('click', function () {

            const isPassword = passwordInput.type === 'password';

            passwordInput.type = isPassword ? 'text' : 'password';

            passwordToggleIcon.classList.toggle(
                'bi-eye',
                !isPassword
            );

            passwordToggleIcon.classList.toggle(
                'bi-eye-slash',
                isPassword
            );

            passwordToggle.setAttribute(
                'aria-label',
                isPassword ? 'Hide password' : 'Show password'
            );

            passwordToggle.setAttribute(
                'title',
                isPassword ? 'Hide password' : 'Show password'
            );

            passwordInput.focus();
        });
    }
</script>

</body>
</html>
