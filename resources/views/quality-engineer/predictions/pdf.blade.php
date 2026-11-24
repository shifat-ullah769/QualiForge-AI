
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prediction Report - {{ $prediction->id }}</title>

    <style>
        @page {
            margin: 35px 40px 45px 40px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #263238;
            line-height: 1.5;
        }

        .header {
            border-bottom: 3px solid #2563eb;
            padding-bottom: 14px;
            margin-bottom: 20px;
        }

        .brand {
            font-size: 23px;
            font-weight: bold;
            color: #1e3a8a;
        }

        .subtitle {
            color: #64748b;
            font-size: 11px;
        }

        .report-title {
            font-size: 19px;
            font-weight: bold;
            margin-top: 15px;
        }

        .demo-notice {
            background: #fff7ed;
            border: 1px solid #fdba74;
            color: #9a3412;
            padding: 10px;
            margin-bottom: 18px;
            border-radius: 4px;
        }

        .section {
            margin-top: 20px;
            page-break-inside: avoid;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #1e3a8a;
            border-bottom: 1px solid #cbd5e1;
            padding-bottom: 6px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        td,
        th {
            border: 1px solid #e2e8f0;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #f1f5f9;
            font-weight: bold;
        }

        .label {
            color: #64748b;
            width: 25%;
        }

        .metric-table td {
            width: 25%;
            text-align: center;
            background: #f8fafc;
        }

        .metric-value {
            display: block;
            font-size: 20px;
            font-weight: bold;
            color: #1e40af;
        }

        .metric-label {
            display: block;
            font-size: 9px;
            color: #64748b;
            margin-top: 4px;
        }

        /* Visualization bars */

        table.bar-bg {
            width: 100%;
            height: 12px;
            border-collapse: collapse;
            border: none;
            background: #e2e8f0;
            margin-top: 5px;
            margin-bottom: 12px;
        }

        .bar-bg td {
            border: none;
            padding: 0;
            height: 12px;
        }

        .bar-fill {
            background: #2563eb;
        }

        .defect-fill {
            background: #f97316;
        }

        .recommendation {
            padding: 7px 9px;
            border-left: 3px solid #2563eb;
            background: #f8fafc;
            margin-bottom: 7px;
        }

        .muted {
            color: #64748b;
        }

        .footer {
            margin-top: 25px;
            padding-top: 8px;
            border-top: 1px solid #cbd5e1;
            color: #64748b;
            font-size: 9px;
            text-align: center;
        }
    </style>
</head>

<body>

@php
    $quality = $payload['quality_assessment'] ?? [];
    $defect = $payload['defect_analysis'] ?? [];
    $recommendations = $payload['recommendations'] ?? [];

    $qualityScore = (float) ($summary['quality_score'] ?? 0);
    $defectRate = (float) ($summary['predicted_defect_rate'] ?? 0);

    $defectRecords = (int) ($summary['predicted_defect_records'] ?? 0);
    $totalRecords = (int) ($summary['total_records'] ?? 0);

    $qualityScore = max(0, min(100, $qualityScore));
    $defectRate = max(0, min(100, $defectRate));

    $isDemo = (bool) ($payload['demo_mode'] ?? false);
@endphp

<div class="header">
    <div class="brand">QualiForge AI</div>
    <div class="subtitle">
        Manufacturing Quality Intelligence Platform
    </div>
    <div class="report-title">
        Individual Prediction Report
    </div>
    <div class="subtitle">
        Prediction ID: #{{ $prediction->id }}
    </div>
</div>

@if($isDemo)
    <div class="demo-notice">
        <strong>DEMO MODE:</strong>
        {{ $payload['notice'] ?? 'These are illustrative demo results, not actual AI predictions.' }}
    </div>
@endif

<!-- 1. Prediction Information -->

<div class="section">
    <div class="section-title">
        1. Prediction Information
    </div>

    <table>
        <tr>
            <td class="label">Prediction ID</td>
            <td>#{{ $prediction->id }}</td>
            <td class="label">Status</td>
            <td>{{ ucfirst($prediction->status ?? 'N/A') }}</td>
        </tr>

        <tr>
            <td class="label">Dataset</td>
            <td>{{ $prediction->dataset->name ?? 'N/A' }}</td>
            <td class="label">Model Version</td>
            <td>{{ $prediction->model_version ?? 'N/A' }}</td>
        </tr>

        <tr>
            <td class="label">Requested By</td>
            <td>{{ $prediction->requester->name ?? 'N/A' }}</td>
            <td class="label">Generated At</td>
            <td>{{ now()->format('d M Y, h:i A') }}</td>
        </tr>

        <tr>
            <td class="label">Started At</td>
            <td>{{ $prediction->started_at ?? 'N/A' }}</td>
            <td class="label">Completed At</td>
            <td>{{ $prediction->completed_at ?? 'N/A' }}</td>
        </tr>
    </table>
</div>

<!-- 2. Prediction Summary -->

<div class="section">
    <div class="section-title">
        2. Prediction Summary
    </div>

    <table class="metric-table">
        <tr>
            <td>
                <span class="metric-value">
                    {{ number_format($qualityScore, 1) }}%
                </span>
                <span class="metric-label">Quality Score</span>
            </td>

            <td>
                <span class="metric-value">
                    {{ number_format($defectRate, 1) }}%
                </span>
                <span class="metric-label">Predicted Defect Rate</span>
            </td>

            <td>
                <span class="metric-value">
                    {{ $defectRecords }}
                </span>
                <span class="metric-label">Predicted Defect Records</span>
            </td>

            <td>
                <span class="metric-value">
                    {{ $totalRecords }}
                </span>
                <span class="metric-label">Total Dataset Records</span>
            </td>
        </tr>
    </table>
</div>

<!-- 3. Quality Assessment -->

<div class="section">
    <div class="section-title">
        3. Quality Assessment
    </div>

    <table>
        <tr>
            <td class="label">Classification</td>
            <td>{{ $quality['classification'] ?? 'N/A' }}</td>
        </tr>

        <tr>
            <td class="label">Risk Level</td>
            <td>{{ $quality['risk_level'] ?? 'N/A' }}</td>
        </tr>

        <tr>
            <td class="label">Quality Score</td>
            <td>{{ number_format($qualityScore, 1) }}%</td>
        </tr>
    </table>

    <p>
        <strong>Quality Score Visualization</strong>
    </p>

    <table class="bar-bg">
        <tr>
            <td class="bar-fill" width="{{ $qualityScore }}%"></td>
            <td width="{{ 100 - $qualityScore }}%"></td>
        </tr>
    </table>

    <p>
        <strong>Predicted Defect Rate Visualization</strong>
    </p>

    <table class="bar-bg">
        <tr>
            <td class="defect-fill" width="{{ $defectRate }}%"></td>
            <td width="{{ 100 - $defectRate }}%"></td>
        </tr>
    </table>
</div>

<!-- 4. Defect Analysis -->

<div class="section">
    <div class="section-title">
        4. Defect Analysis
    </div>

    <table>
        <tr>
            <td class="label">Predicted Defect Rate</td>
            <td>
                {{ number_format((float) ($defect['defect_rate'] ?? $defectRate), 2) }}%
            </td>
        </tr>

        <tr>
            <td class="label">Predicted Defect Records</td>
            <td>
                {{ $defect['defect_records'] ?? $defectRecords }}
            </td>
        </tr>

        <tr>
            <td class="label">Total Records</td>
            <td>{{ $totalRecords }}</td>
        </tr>
    </table>
</div>

<!-- 5. Recommendations -->

<div class="section">
    <div class="section-title">
        5. Recommendations
    </div>

    @forelse($recommendations as $recommendation)
        <div class="recommendation">
            {{ $recommendation }}
        </div>
    @empty
        <p class="muted">
            No recommendations available.
        </p>
    @endforelse
</div>

<!-- 6. Report Notes -->

<div class="section">
    <div class="section-title">
        6. Report Notes
    </div>

    <p>
        This report presents the recorded output of Prediction
        #{{ $prediction->id }} based on the selected dataset.
    </p>

    @if($isDemo)
        <p>
            <strong>Important:</strong>
            This report contains illustrative demo output.
            It must not be interpreted as a real machine learning
            prediction or used as the basis for actual manufacturing
            quality decisions.
        </p>
    @endif
</div>

<div class="footer">
    QualiForge AI | Individual Prediction Report |
    Prediction #{{ $prediction->id }}
</div>

</body>
</html>
