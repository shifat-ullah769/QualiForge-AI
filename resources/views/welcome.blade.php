<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>QualiForge AI — Manufacturing Quality Intelligence</title>

    <meta name="description"
        content="QualiForge AI transforms manufacturing production data into actionable quality intelligence using machine learning and risk analysis.">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --qf-dark: #07111f;
            --qf-dark-2: #0b1728;
            --qf-cyan: #22d3ee;
            --qf-blue: #3b82f6;
            --qf-text: #e5eef8;
            --qf-muted: #91a4b8;
            --qf-border: rgba(148, 163, 184, 0.16);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: #ffffff;
            color: #172033;
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont,
                "Segoe UI", sans-serif;
        }

        /* ================= NAVBAR ================= */

        .qf-navbar {
            background: rgba(7, 17, 31, 0.92);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
        }

        .qf-brand {
            letter-spacing: -0.5px;
        }

        .qf-brand-mark {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--qf-cyan), var(--qf-blue));
            color: #06111e;
            font-weight: 800;
            box-shadow: 0 0 25px rgba(34, 211, 238, 0.18);
        }

        .qf-navbar .nav-link {
            color: #9fb0c2;
            font-size: 0.93rem;
            margin: 0 5px;
            transition: 0.2s ease;
        }

        .qf-navbar .nav-link:hover,
        .qf-navbar .nav-link.active {
            color: #ffffff;
        }

        .qf-login-btn {
            border: 1px solid rgba(34, 211, 238, 0.5);
            color: var(--qf-cyan);
            border-radius: 8px;
            padding: 8px 18px;
            font-weight: 600;
            transition: 0.2s ease;
        }

        .qf-login-btn:hover {
            background: var(--qf-cyan);
            color: #07111f;
            border-color: var(--qf-cyan);
        }

        /* ================= HERO ================= */

        .qf-hero {
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at 80% 20%, rgba(34, 211, 238, 0.10), transparent 28%),
                radial-gradient(circle at 15% 80%, rgba(59, 130, 246, 0.10), transparent 28%),
                linear-gradient(135deg, #07111f 0%, #0b1728 55%, #0a1423 100%);
            color: white;
        }

        .qf-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.025) 1px, transparent 1px);
            background-size: 42px 42px;
            pointer-events: none;
        }

        .qf-hero-content {
            position: relative;
            z-index: 2;
        }

        .qf-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border: 1px solid rgba(34, 211, 238, 0.25);
            background: rgba(34, 211, 238, 0.07);
            border-radius: 999px;
            color: var(--qf-cyan);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .qf-eyebrow-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #34d399;
            box-shadow: 0 0 12px rgba(52, 211, 153, 0.8);
        }

        .qf-hero h1 {
            font-size: clamp(2.7rem, 5vw, 4.7rem);
            line-height: 1.02;
            letter-spacing: -0.055em;
        }

        .qf-gradient-text {
            background: linear-gradient(90deg,
                    #ffffff,
                    #8be9f8,
                    #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .qf-hero-description {
            max-width: 650px;
            color: #9fb0c2;
            font-size: 1.08rem;
            line-height: 1.8;
        }

        .qf-primary-btn {
            background: linear-gradient(135deg, var(--qf-cyan), #38bdf8);
            color: #06111e;
            border: none;
            font-weight: 700;
            padding: 12px 22px;
            border-radius: 9px;
            transition: 0.2s ease;
        }

        .qf-primary-btn:hover {
            transform: translateY(-2px);
            color: #06111e;
            box-shadow: 0 12px 30px rgba(34, 211, 238, 0.18);
        }

        .qf-secondary-btn {
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #dce7f2;
            padding: 12px 22px;
            border-radius: 9px;
            font-weight: 600;
        }

        .qf-secondary-btn:hover {
            background: rgba(255, 255, 255, 0.06);
            color: white;
            border-color: rgba(255, 255, 255, 0.25);
        }

        /* ================= DASHBOARD PREVIEW ================= */

        .qf-dashboard {
            background: rgba(10, 23, 40, 0.88);
            border: 1px solid rgba(148, 163, 184, 0.16);
            border-radius: 16px;
            box-shadow:
                0 35px 80px rgba(0, 0, 0, 0.35),
                0 0 50px rgba(34, 211, 238, 0.05);
            overflow: hidden;
        }

        .qf-dashboard-header {
            padding: 14px 18px;
            border-bottom: 1px solid var(--qf-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .qf-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #6ee7b7;
            font-size: 0.78rem;
            font-weight: 600;
        }

        .qf-status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #34d399;
        }

        .qf-dashboard-body {
            padding: 20px;
        }

        .qf-metric {
            background: rgba(255, 255, 255, 0.035);
            border: 1px solid rgba(148, 163, 184, 0.10);
            border-radius: 12px;
            padding: 16px;
        }

        .qf-metric-label {
            color: #7f93a8;
            font-size: 0.75rem;
        }

        .qf-metric-value {
            color: white;
            font-size: 1.65rem;
            font-weight: 750;
            margin-top: 5px;
        }

        .qf-chart {
            height: 120px;
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            background:
                linear-gradient(to bottom,
                    rgba(34, 211, 238, 0.04),
                    transparent);
        }

        .qf-chart-line {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 22px;
            height: 70px;
            background: linear-gradient(135deg,
                    transparent 5%,
                    transparent 15%,
                    rgba(34, 211, 238, 0.8) 16%,
                    rgba(34, 211, 238, 0.8) 17%,
                    transparent 18%,
                    transparent 30%,
                    rgba(34, 211, 238, 0.8) 31%,
                    rgba(34, 211, 238, 0.8) 32%,
                    transparent 33%,
                    transparent 48%,
                    rgba(34, 211, 238, 0.8) 49%,
                    rgba(34, 211, 238, 0.8) 50%,
                    transparent 51%,
                    transparent 63%,
                    rgba(34, 211, 238, 0.8) 64%,
                    rgba(34, 211, 238, 0.8) 65%,
                    transparent 66%,
                    transparent 77%,
                    rgba(34, 211, 238, 0.8) 78%,
                    rgba(34, 211, 238, 0.8) 79%,
                    transparent 80%);
            opacity: 0.7;
        }

        /* ================= SECTION ================= */

        .qf-section-label {
            color: #0891b2;
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .qf-section-title {
            font-size: clamp(2rem, 4vw, 3rem);
            letter-spacing: -0.04em;
        }

        .qf-section-description {
            max-width: 700px;
            color: #6b7c8f;
            line-height: 1.8;
        }

        /* ================= FEATURE CARDS ================= */

        .qf-feature-card {
            height: 100%;
            border: 1px solid #e7edf3;
            border-radius: 14px;
            padding: 28px;
            background: white;
            transition: 0.25s ease;
        }

        .qf-feature-card:hover {
            transform: translateY(-5px);
            border-color: rgba(34, 211, 238, 0.4);
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
        }

        .qf-feature-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ecfeff;
            color: #0891b2;
            font-size: 1.25rem;
            margin-bottom: 20px;
        }

        .qf-feature-card p {
            color: #718096;
            line-height: 1.7;
        }

        /* ================= WORKFLOW ================= */

        .qf-workflow {
            background: #f7fafc;
        }

        .qf-step {
            position: relative;
            height: 100%;
            padding: 28px;
            border: 1px solid #e4ebf2;
            border-radius: 14px;
            background: white;
        }

        .qf-step-number {
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            color: #0891b2;
            margin-bottom: 16px;
        }

        /* ================= CTA ================= */

        .qf-cta {
            background:
                radial-gradient(circle at 15% 50%, rgba(34, 211, 238, 0.10), transparent 25%),
                linear-gradient(135deg, #07111f, #0b1728);
            color: white;
        }

        /* ================= FOOTER ================= */

        .qf-footer {
            background: #050d18;
            color: #91a4b8;
        }

        .qf-footer-brand {
            color: white;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 991px) {
            .qf-navbar .nav-link {
                margin: 4px 0;
            }

            .qf-hero {
                text-align: center;
            }

            .qf-hero-description {
                margin-left: auto;
                margin-right: auto;
            }

            .qf-hero-actions {
                justify-content: center;
            }
        }
    </style>
</head>

<body>

    <!-- ================= NAVBAR ================= -->

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top qf-navbar">
        <div class="container py-2">

            <a class="navbar-brand d-flex align-items-center gap-2 qf-brand" href="#">
                <span class="qf-brand-mark">Q</span>

                <span class="fw-bold fs-5">
                    QualiForge <span style="color: #22d3ee;">AI</span>
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">

                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">
                        <a class="nav-link active" href="#home">
                            Platform
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#features">
                            Capabilities
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#workflow">
                            Workflow
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#about">
                            About
                        </a>
                    </li>

                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a href="{{ route('login') }}" class="btn qf-login-btn">
                            Sign in
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>


    <!-- ================= HERO ================= -->

    <section id="home" class="qf-hero">

        <div class="container py-5">
            <div class="row align-items-center g-5 py-lg-5 qf-hero-content">

                <div class="col-lg-6">

                    <div class="qf-eyebrow mb-4">
                        <span class="qf-eyebrow-dot"></span>
                        Manufacturing Quality Intelligence
                    </div>

                    <h1 class="fw-bold mb-4">
                        Turn production data into
                        <span class="qf-gradient-text">
                            quality intelligence.
                        </span>
                    </h1>

                    <p class="qf-hero-description mb-4">
                        QualiForge AI connects manufacturing data, machine
                        learning and quality analysis to help teams identify
                        emerging production risks and make better decisions.
                    </p>

                    <div class="d-flex flex-wrap gap-3 qf-hero-actions">

                        <a href="#features" class="btn qf-primary-btn">
                            Explore Platform
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>

                        <a href="#workflow" class="btn qf-secondary-btn">
                            See How It Works
                        </a>

                    </div>

                    <div class="d-flex flex-wrap gap-4 mt-5 small" style="color: #71869b;">

                        <span>
                            <i class="bi bi-shield-check me-1"></i>
                            Data-driven
                        </span>

                        <span>
                            <i class="bi bi-cpu me-1"></i>
                            ML-powered
                        </span>

                        <span>
                            <i class="bi bi-graph-up-arrow me-1"></i>
                            Action-oriented
                        </span>

                    </div>

                </div>


                <!-- Dashboard Preview -->

                <div class="col-lg-6">

                    <div class="qf-dashboard">

                        <div class="qf-dashboard-header">

                            <div>
                                <div class="text-white fw-semibold">
                                    Quality Intelligence
                                </div>

                                <div class="small" style="color: #71869b;">
                                    Production overview
                                </div>
                            </div>

                            <div class="qf-status">
                                <span class="qf-status-dot"></span>
                                System Active
                            </div>

                        </div>


                        <div class="qf-dashboard-body">

                            <div class="row g-3">

                                <div class="col-6">
                                    <div class="qf-metric">

                                        <div class="qf-metric-label">
                                            Production Records
                                        </div>

                                        <div class="qf-metric-value">
                                            12.4K
                                        </div>

                                        <div class="small mt-1" style="color:#6ee7b7;">
                                            <i class="bi bi-arrow-up"></i>
                                            Processed
                                        </div>

                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="qf-metric">

                                        <div class="qf-metric-label">
                                            Quality Risk
                                        </div>

                                        <div class="qf-metric-value">
                                            8.4%
                                        </div>

                                        <div class="small mt-1" style="color:#fbbf24;">
                                            Potential Risk
                                        </div>

                                    </div>
                                </div>


                                <div class="col-12">

                                    <div class="qf-metric">

                                        <div class="d-flex justify-content-between mb-3">

                                            <div>
                                                <div class="qf-metric-label">
                                                    Quality Trend
                                                </div>

                                                <div class="text-white fw-semibold mt-1">
                                                    Stable
                                                </div>
                                            </div>

                                            <span class="small" style="color:#6ee7b7;">
                                                +12.8%
                                            </span>

                                        </div>

                                        <div class="qf-chart">
                                            <div class="qf-chart-line"></div>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </section>


    <!-- ================= FEATURES ================= -->

    <section id="features" class="py-5">

        <div class="container py-5">

            <div class="text-center mb-5">

                <div class="qf-section-label mb-2">
                    Platform Capabilities
                </div>

                <h2 class="qf-section-title fw-bold mb-3">
                    Built around manufacturing quality.
                </h2>

                <p class="qf-section-description mx-auto mb-0">
                    A focused intelligence layer that connects production
                    information with machine learning and actionable quality
                    analysis.
                </p>

            </div>


            <div class="row g-4">

                <div class="col-md-6 col-lg-4">
                    <div class="qf-feature-card">

                        <div class="qf-feature-icon">
                            <i class="bi bi-database"></i>
                        </div>

                        <h5 class="fw-bold">
                            Production Data
                        </h5>

                        <p class="mb-0">
                            Organize and prepare manufacturing datasets
                            for downstream quality analysis.
                        </p>

                    </div>
                </div>


                <div class="col-md-6 col-lg-4">
                    <div class="qf-feature-card">

                        <div class="qf-feature-icon">
                            <i class="bi bi-cpu"></i>
                        </div>

                        <h5 class="fw-bold">
                            Machine Learning
                        </h5>

                        <p class="mb-0">
                            Apply machine learning models to uncover
                            meaningful patterns within production data.
                        </p>

                    </div>
                </div>


                <div class="col-md-6 col-lg-4">
                    <div class="qf-feature-card">

                        <div class="qf-feature-icon">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>

                        <h5 class="fw-bold">
                            Risk Detection
                        </h5>

                        <p class="mb-0">
                            Identify production conditions associated with
                            potential quality risks.
                        </p>

                    </div>
                </div>


                <div class="col-md-6 col-lg-4">
                    <div class="qf-feature-card">

                        <div class="qf-feature-icon">
                            <i class="bi bi-speedometer2"></i>
                        </div>

                        <h5 class="fw-bold">
                            Quality Dashboard
                        </h5>

                        <p class="mb-0">
                            Bring important quality indicators into one
                            focused operational view.
                        </p>

                    </div>
                </div>


                <div class="col-md-6 col-lg-4">
                    <div class="qf-feature-card">

                        <div class="qf-feature-icon">
                            <i class="bi bi-search"></i>
                        </div>

                        <h5 class="fw-bold">
                            Explainable Insights
                        </h5>

                        <p class="mb-0">
                            Understand the factors contributing to quality
                            risk and model decisions.
                        </p>

                    </div>
                </div>


                <div class="col-md-6 col-lg-4">
                    <div class="qf-feature-card">

                        <div class="qf-feature-icon">
                            <i class="bi bi-clock-history"></i>
                        </div>

                        <h5 class="fw-bold">
                            Prediction History
                        </h5>

                        <p class="mb-0">
                            Maintain a structured history of quality analysis
                            and prediction results.
                        </p>

                    </div>
                </div>

            </div>

        </div>

    </section>


    <!-- ================= WORKFLOW ================= -->

    <section id="workflow" class="qf-workflow py-5">

        <div class="container py-5">

            <div class="text-center mb-5">

                <div class="qf-section-label mb-2">
                    Intelligence Workflow
                </div>

                <h2 class="qf-section-title fw-bold mb-3">
                    From production data to action.
                </h2>

                <p class="qf-section-description mx-auto mb-0">
                    QualiForge AI creates a clear path from raw production
                    information to useful quality intelligence.
                </p>

            </div>


            <div class="row g-4">

                <div class="col-md-6 col-lg-3">
                    <div class="qf-step">

                        <div class="qf-step-number">
                            STEP 01
                        </div>

                        <h5 class="fw-bold">
                            Upload Data
                        </h5>

                        <p class="text-muted mb-0">
                            Bring relevant production records into the
                            quality intelligence workflow.
                        </p>

                    </div>
                </div>


                <div class="col-md-6 col-lg-3">
                    <div class="qf-step">

                        <div class="qf-step-number">
                            STEP 02
                        </div>

                        <h5 class="fw-bold">
                            Prepare & Validate
                        </h5>

                        <p class="text-muted mb-0">
                            Validate and prepare production data for
                            reliable downstream analysis.
                        </p>

                    </div>
                </div>


                <div class="col-md-6 col-lg-3">
                    <div class="qf-step">

                        <div class="qf-step-number">
                            STEP 03
                        </div>

                        <h5 class="fw-bold">
                            Analyze
                        </h5>

                        <p class="text-muted mb-0">
                            Apply machine learning and quality analysis
                            to identify important patterns.
                        </p>

                    </div>
                </div>


                <div class="col-md-6 col-lg-3">
                    <div class="qf-step">

                        <div class="qf-step-number">
                            STEP 04
                        </div>

                        <h5 class="fw-bold">
                            Take Action
                        </h5>

                        <p class="text-muted mb-0">
                            Turn the resulting intelligence into informed
                            quality decisions.
                        </p>

                    </div>
                </div>

            </div>

        </div>

    </section>


    <!-- ================= ABOUT ================= -->

    <section id="about" class="py-5">

        <div class="container py-5">

            <div class="row align-items-center g-5">

                <div class="col-lg-6">

                    <div class="qf-section-label mb-2">
                        About QualiForge AI
                    </div>

                    <h2 class="qf-section-title fw-bold mb-4">
                        A quality intelligence layer for modern manufacturing.
                    </h2>

                    <p class="text-muted" style="line-height:1.85;">
                        QualiForge AI is designed to connect manufacturing
                        production data with machine learning and quality
                        risk analysis.
                    </p>

                    <p class="text-muted" style="line-height:1.85;">
                        The goal is simple: help manufacturing teams move
                        beyond raw production records and turn data into
                        useful, understandable quality intelligence.
                    </p>

                </div>


                <div class="col-lg-6">

                    <div class="qf-dashboard">

                        <div class="qf-dashboard-header">
                            <span class="text-white fw-semibold">
                                Platform Architecture
                            </span>

                            <span class="small" style="color:#71869b;">
                                v1.0
                            </span>
                        </div>

                        <div class="qf-dashboard-body">

                            <div class="d-flex align-items-center gap-3 py-3 border-bottom"
                                style="border-color:rgba(148,163,184,0.12)!important;">

                                <span class="qf-brand-mark" style="width:34px;height:34px;">
                                    01
                                </span>

                                <div>
                                    <div class="text-white fw-semibold">
                                        Production Data
                                    </div>

                                    <div class="small" style="color:#71869b;">
                                        Structured manufacturing information
                                    </div>
                                </div>

                            </div>


                            <div class="d-flex align-items-center gap-3 py-3 border-bottom"
                                style="border-color:rgba(148,163,184,0.12)!important;">

                                <span class="qf-brand-mark" style="width:34px;height:34px;">
                                    02
                                </span>

                                <div>
                                    <div class="text-white fw-semibold">
                                        Machine Learning
                                    </div>

                                    <div class="small" style="color:#71869b;">
                                        Pattern discovery and prediction
                                    </div>
                                </div>

                            </div>


                            <div class="d-flex align-items-center gap-3 py-3">

                                <span class="qf-brand-mark" style="width:34px;height:34px;">
                                    03
                                </span>

                                <div>
                                    <div class="text-white fw-semibold">
                                        Quality Intelligence
                                    </div>

                                    <div class="small" style="color:#71869b;">
                                        Actionable quality information
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- ================= CTA ================= -->

    <section class="qf-cta py-5">

        <div class="container text-center py-4">

            <div class="qf-eyebrow mb-3">
                <span class="qf-eyebrow-dot"></span>
                Quality Intelligence Platform
            </div>

            <h2 class="fw-bold mb-3">
                Build a smarter quality workflow.
            </h2>

            <p class="mb-4" style="color:#91a4b8;">
                Transform manufacturing data into meaningful quality intelligence.
            </p>

            <a href="{{ route('login') }}" class="btn qf-primary-btn">
                Access Platform
                <i class="bi bi-arrow-right ms-2"></i>
            </a>

        </div>

    </section>


    <!-- ================= FOOTER ================= -->

    <footer class="qf-footer">

        <div class="container py-5">

            <div class="row g-4">

                <div class="col-lg-6">

                    <div class="d-flex align-items-center gap-2 mb-3">

                        <span class="qf-brand-mark">
                            Q
                        </span>

                        <span class="qf-footer-brand fw-bold fs-5">
                            QualiForge <span style="color:#22d3ee;">AI</span>
                        </span>

                    </div>

                    <p class="mb-0" style="max-width:500px;">
                        Manufacturing Quality Intelligence Platform
                        connecting production data, machine learning
                        and actionable quality analysis.
                    </p>

                </div>


                <div class="col-lg-6 text-lg-end">

                    <div class="small mb-2">
                        © {{ date('Y') }} QualiForge AI.
                        All rights reserved.
                    </div>

                    <div class="small">
                        Built for intelligent manufacturing.
                    </div>

                </div>

            </div>

        </div>

    </footer>


    <!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
