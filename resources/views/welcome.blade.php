<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>QualiForge AI</title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body>

    <!-- ================= NAVBAR ================= -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">

            <a class="navbar-brand fw-bold fs-4" href="#">
                QualiForge <span class="text-info">AI</span>
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" href="#">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#workflow">Workflow</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>

                </ul>

                <div class="ms-lg-3">
                    <a href="#" class="btn btn-outline-info">
                        Login
                    </a>
                </div>

            </div>
        </div>
    </nav>


    <!-- ================= HERO ================= -->
    <section class="bg-dark text-white py-5">

        <div class="container py-5">

            <div class="row align-items-center g-5">

                <!-- Hero Text -->
                <div class="col-lg-6">

                    <span class="badge bg-info text-dark mb-3 px-3 py-2">
                        AI-Powered Manufacturing Quality
                    </span>

                    <h1 class="display-4 fw-bold mb-4">
                        Smarter Manufacturing.
                        <span class="text-info">
                            Better Quality.
                        </span>
                    </h1>

                    <p class="lead text-light mb-4">
                        QualiForge AI transforms production data into
                        actionable quality insights using machine learning
                        and intelligent risk analysis.
                    </p>

                    <div class="d-flex flex-wrap gap-3">

                        <a href="#features" class="btn btn-info btn-lg px-4">
                            Explore Platform
                        </a>

                        <a href="#workflow" class="btn btn-outline-light btn-lg px-4">
                            How It Works
                        </a>

                    </div>

                </div>


                <!-- Dashboard Preview -->
                <div class="col-lg-6">

                    <div class="card shadow-lg border-0">

                        <div class="card-header bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-dark">
                                    Quality Intelligence
                                </span>

                                <span class="badge bg-success">
                                    System Active
                                </span>
                            </div>
                        </div>

                        <div class="card-body text-dark">

                            <div class="row g-3">

                                <div class="col-6">
                                    <div class="card bg-light border-0 h-100">
                                        <div class="card-body">
                                            <small class="text-muted">
                                                Production Records
                                            </small>

                                            <h3 class="fw-bold mt-2">
                                                12,480
                                            </h3>

                                            <span class="text-success small">
                                                Processed Data
                                            </span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="card bg-light border-0 h-100">
                                        <div class="card-body">
                                            <small class="text-muted">
                                                Quality Risk
                                            </small>

                                            <h3 class="fw-bold mt-2">
                                                8.4%
                                            </h3>

                                            <span class="text-warning small">
                                                Potential Risk
                                            </span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">

                                    <div class="card border-0 bg-light">
                                        <div class="card-body">

                                            <div class="d-flex justify-content-between mb-2">
                                                <span class="fw-semibold">
                                                    Quality Status
                                                </span>

                                                <span class="text-success fw-semibold">
                                                    Stable
                                                </span>
                                            </div>

                                            <div class="progress" style="height: 10px;">
                                                <div
                                                    class="progress-bar bg-success"
                                                    role="progressbar"
                                                    style="width: 84%"></div>
                                            </div>

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

        <div class="container py-4">

            <div class="text-center mb-5">

                <span class="badge bg-info text-dark mb-2">
                    Platform Features
                </span>

                <h2 class="fw-bold">
                    Manufacturing Quality Intelligence
                </h2>

                <p class="text-muted mx-auto" style="max-width: 700px;">
                    A focused platform for transforming production data
                    into meaningful quality and risk information.
                </p>

            </div>


            <div class="row g-4">

                <!-- Feature 1 -->
                <div class="col-md-6 col-lg-4">

                    <div class="card h-100 border-0 shadow-sm">

                        <div class="card-body p-4">

                            <div class="fs-1 mb-3">
                                📊
                            </div>

                            <h5 class="fw-bold">
                                Production Data
                            </h5>

                            <p class="text-muted">
                                Upload and manage manufacturing datasets
                                for quality analysis and machine learning.
                            </p>

                        </div>

                    </div>

                </div>


                <!-- Feature 2 -->
                <div class="col-md-6 col-lg-4">

                    <div class="card h-100 border-0 shadow-sm">

                        <div class="card-body p-4">

                            <div class="fs-1 mb-3">
                                🤖
                            </div>

                            <h5 class="fw-bold">
                                Machine Learning
                            </h5>

                            <p class="text-muted">
                                Use trained machine learning models to
                                analyze production quality patterns.
                            </p>

                        </div>

                    </div>

                </div>


                <!-- Feature 3 -->
                <div class="col-md-6 col-lg-4">

                    <div class="card h-100 border-0 shadow-sm">

                        <div class="card-body p-4">

                            <div class="fs-1 mb-3">
                                ⚠️
                            </div>

                            <h5 class="fw-bold">
                                Risk Detection
                            </h5>

                            <p class="text-muted">
                                Identify potential quality risks and
                                abnormal production conditions.
                            </p>

                        </div>

                    </div>

                </div>


                <!-- Feature 4 -->
                <div class="col-md-6 col-lg-4">

                    <div class="card h-100 border-0 shadow-sm">

                        <div class="card-body p-4">

                            <div class="fs-1 mb-3">
                                📈
                            </div>

                            <h5 class="fw-bold">
                                Quality Dashboard
                            </h5>

                            <p class="text-muted">
                                Monitor important quality indicators
                                through an intuitive dashboard.
                            </p>

                        </div>

                    </div>

                </div>


                <!-- Feature 5 -->
                <div class="col-md-6 col-lg-4">

                    <div class="card h-100 border-0 shadow-sm">

                        <div class="card-body p-4">

                            <div class="fs-1 mb-3">
                                🔍
                            </div>

                            <h5 class="fw-bold">
                                Explainable Insights
                            </h5>

                            <p class="text-muted">
                                Understand which production factors
                                contribute to predicted quality risks.
                            </p>

                        </div>

                    </div>

                </div>


                <!-- Feature 6 -->
                <div class="col-md-6 col-lg-4">

                    <div class="card h-100 border-0 shadow-sm">

                        <div class="card-body p-4">

                            <div class="fs-1 mb-3">
                                📋
                            </div>

                            <h5 class="fw-bold">
                                Prediction History
                            </h5>

                            <p class="text-muted">
                                Keep track of previous predictions and
                                quality analysis results.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- ================= WORKFLOW ================= -->
    <section id="workflow" class="bg-light py-5">

        <div class="container py-4">

            <div class="text-center mb-5">

                <span class="badge bg-dark mb-2">
                    Workflow
                </span>

                <h2 class="fw-bold">
                    From Production Data to Quality Intelligence
                </h2>

                <p class="text-muted">
                    A simple workflow connecting manufacturing data
                    with machine learning based quality analysis.
                </p>

            </div>


            <div class="row g-4 text-center">

                <!-- Step 1 -->
                <div class="col-md-6 col-lg-3">

                    <div class="card border-0 shadow-sm h-100">

                        <div class="card-body p-4">

                            <div class="display-5 fw-bold text-info mb-3">
                                01
                            </div>

                            <h5 class="fw-bold">
                                Upload Data
                            </h5>

                            <p class="text-muted mb-0">
                                Provide production data for analysis.
                            </p>

                        </div>

                    </div>

                </div>


                <!-- Step 2 -->
                <div class="col-md-6 col-lg-3">

                    <div class="card border-0 shadow-sm h-100">

                        <div class="card-body p-4">

                            <div class="display-5 fw-bold text-info mb-3">
                                02
                            </div>

                            <h5 class="fw-bold">
                                Prepare Data
                            </h5>

                            <p class="text-muted mb-0">
                                Validate and prepare the dataset
                                for machine learning.
                            </p>

                        </div>

                    </div>

                </div>


                <!-- Step 3 -->
                <div class="col-md-6 col-lg-3">

                    <div class="card border-0 shadow-sm h-100">

                        <div class="card-body p-4">

                            <div class="display-5 fw-bold text-info mb-3">
                                03
                            </div>

                            <h5 class="fw-bold">
                                Predict
                            </h5>

                            <p class="text-muted mb-0">
                                Apply machine learning models to
                                estimate quality risk.
                            </p>

                        </div>

                    </div>

                </div>


                <!-- Step 4 -->
                <div class="col-md-6 col-lg-3">

                    <div class="card border-0 shadow-sm h-100">

                        <div class="card-body p-4">

                            <div class="display-5 fw-bold text-info mb-3">
                                04
                            </div>

                            <h5 class="fw-bold">
                                Take Action
                            </h5>

                            <p class="text-muted mb-0">
                                Use the resulting insights to support
                                quality decisions.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- ================= ABOUT ================= -->
    <section id="about" class="py-5">

        <div class="container py-4">

            <div class="row align-items-center g-5">

                <div class="col-lg-6">

                    <span class="badge bg-info text-dark mb-3">
                        About QualiForge AI
                    </span>

                    <h2 class="fw-bold mb-4">
                        Turning Manufacturing Data Into Actionable Insight
                    </h2>

                    <p class="text-muted">
                        QualiForge AI is designed as a manufacturing quality
                        intelligence platform that connects production data,
                        machine learning and quality risk analysis.
                    </p>

                    <p class="text-muted">
                        The platform focuses on helping manufacturing teams
                        understand production quality patterns and identify
                        potential risks through data-driven analysis.
                    </p>

                </div>


                <div class="col-lg-6">

                    <div class="card bg-dark text-white border-0 shadow">

                        <div class="card-body p-4 p-lg-5">

                            <h4 class="fw-bold mb-4">
                                Core Platform
                            </h4>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Production Data</span>
                                    <span>01</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Machine Learning</span>
                                    <span>02</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Risk Analysis</span>
                                    <span>03</span>
                                </div>
                            </div>

                            <div>
                                <div class="d-flex justify-content-between">
                                    <span>Quality Intelligence</span>
                                    <span>04</span>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- ================= CTA ================= -->
    <section class="bg-info py-5">

        <div class="container text-center py-4">

            <h2 class="fw-bold mb-3">
                Build a Smarter Quality Workflow
            </h2>

            <p class="lead mb-4">
                Transform production data into meaningful quality intelligence.
            </p>

            <a href="#" class="btn btn-dark btn-lg px-4">
                Get Started
            </a>

        </div>

    </section>


    <!-- ================= FOOTER ================= -->
    <footer class="bg-dark text-white">

        <div class="container py-4">

            <div class="text-center">

                <h5 class="fw-bold mb-2">
                    QualiForge <span class="text-info">AI</span>
                </h5>

                <p class="text-secondary mb-3">
                    Manufacturing Quality Intelligence Platform
                </p>

                <p class="text-secondary small mb-2">
                    © {{ date('Y') }} QualiForge AI. All rights reserved.
                </p>

                <p class="text-secondary small mb-0">
                    Developed by
                    <span class="text-info fw-semibold">
                        Shifat
                    </span>
                </p>

            </div>

        </div>

    </footer>


    <!-- Bootstrap JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>