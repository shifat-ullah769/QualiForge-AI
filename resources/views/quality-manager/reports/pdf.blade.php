<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manufacturing Quality Report</title>

    <style>
        @page {
            margin: 35px 38px 55px 38px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #1e293b;
            font-size: 9px;
            line-height: 1.6;
        }

        .brand {
            color: #0e7490;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 14px;
        }

        .cover {
            border-bottom: 3px solid #0e7490;
            padding-bottom: 18px;
            margin-bottom: 22px;
        }

        h1 {
            font-size: 22px;
            color: #0f172a;
            margin: 0 0 6px;
        }

        .subtitle {
            color: #64748b;
            font-size: 9px;
        }

        .meta-table {
            width: 100%;
            margin-top: 18px;
            border-collapse: separate;
            border-spacing: 5px;
        }

        .meta-table td {
            width: 50%;
            padding: 9px;
            background: #f1f5f9;
            vertical-align: top;
        }

        .meta-label {
            display: block;
            font-size: 7px;
            color: #64748b;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 3px;
        }

        .meta-value {
            font-size: 9px;
            color: #0f172a;
            font-weight: bold;
        }

        .section {
            margin-top: 22px;
            page-break-inside: avoid;
        }

        h2 {
            font-size: 12px;
            color: #0f172a;
            border-bottom: 1px solid #cbd5e1;
            padding-bottom: 7px;
            margin-bottom: 10px;
        }

        h3 {
            font-size: 9px;
            color: #334155;
            margin: 12px 0 6px;
        }

        p {
            color: #475569;
            margin: 5px 0 9px;
            text-align: justify;
        }

        .kpi-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 5px;
        }

        .kpi-table td {
            width: 25%;
            padding: 12px 9px;
            background: #f8fafc;
            border: 1px solid #cbd5e1;
        }

        .kpi-label {
            display: block;
            color: #64748b;
            font-size: 7px;
            margin-bottom: 5px;
        }

        .kpi-value {
            color: #0f172a;
            font-size: 18px;
            font-weight: bold;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 7px;
            font-size: 8px;
        }

        .data-table th {
            background: #e2e8f0;
            color: #334155;
            text-align: left;
            padding: 8px 7px;
            font-size: 7px;
            text-transform: uppercase;
        }

        .data-table td {
            padding: 7px;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
        }

        .empty {
            color: #64748b;
            font-style: italic;
        }

        .note {
            margin-top: 9px;
            padding: 10px;
            background: #f1f5f9;
            border-left: 3px solid #0e7490;
            color: #475569;
            font-size: 8px;
        }

        .footer {
            position: fixed;
            bottom: -35px;
            left: 0;
            right: 0;
            border-top: 1px solid #cbd5e1;
            padding-top: 7px;
            color: #64748b;
            font-size: 7px;
        }

        .footer .right {
            float: right;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>

    {{-- Cover and Report Metadata --}}
    <div class="cover">
        <div class="brand">QUALIFORGE AI</div>

        <h1>Manufacturing Quality Report</h1>

        <div class="subtitle">
            Consolidated Quality Performance and Operational Monitoring
        </div>

        <table class="meta-table">
            <tr>
                <td>
                    <span class="meta-label">Company</span>
                    <span class="meta-value">{{ $company->name }}</span>
                </td>
                <td>
                    <span class="meta-label">Report Generated</span>
                    <span class="meta-value">
                        {{ $generatedAt->format('d M Y, h:i A') }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="meta-label">Factory Scope</span>
                    <span class="meta-value">
                        {{ $selectedFactory?->name ?? 'All Company Factories' }}
                    </span>
                </td>
                <td>
                    <span class="meta-label">Reporting Period</span>
                    <span class="meta-value">All Available Records</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="meta-label">Report Type</span>
                    <span class="meta-value">Quality Management Overview</span>
                </td>
                <td>
                    <span class="meta-label">Report Reference</span>
                    <span class="meta-value">
                        QF-QM-{{ $generatedAt->format('Ymd-His') }}
                    </span>
                </td>
            </tr>
        </table>
    </div>

    {{-- 1. Executive Summary --}}
    <div class="section">
        <h2>1. Executive Summary</h2>

        <p>
            This report presents a consolidated overview of the manufacturing
            quality records available for {{ $company->name }}.
            The report covers
            {{ $selectedFactory?->name ?? 'all company factories' }},
            including recorded defects, inspection activities, factory-level
            quality indicators and prediction execution records.
        </p>

        <p>
            It is intended to support management-level monitoring and review
            of recorded quality activities.
        </p>
    </div>

    {{-- 2. KPI Overview --}}
    <div class="section">
        <h2>2. Quality Performance Overview</h2>

        <table class="kpi-table">
            <tr>
                <td>
                    <span class="kpi-label">Total Defect Records</span>
                    <span class="kpi-value">{{ $totalDefects }}</span>
                </td>
                <td>
                    <span class="kpi-label">Defect Quantity</span>
                    <span class="kpi-value">{{ $totalDefectQuantity }}</span>
                </td>
                <td>
                    <span class="kpi-label">Total Inspections</span>
                    <span class="kpi-value">{{ $totalInspections }}</span>
                </td>
                <td>
                    <span class="kpi-label">Total Predictions</span>
                    <span class="kpi-value">{{ $totalPredictions }}</span>
                </td>
            </tr>
        </table>
    </div>

    {{-- 3. Defect Analysis --}}
    <div class="section">
        <h2>3. Defect Analysis</h2>

        <h3>Defect Status</h3>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Records</th>
                </tr>
            </thead>
            <tbody>
                @foreach($defectStatusCounts as $status => $count)
                    <tr>
                        <td>{{ ucfirst(str_replace('_', ' ', $status)) }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Defect Severity</h3>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Severity</th>
                    <th>Records</th>
                </tr>
            </thead>
            <tbody>
                @foreach($defectSeverityCounts as $severity => $count)
                    <tr>
                        <td>{{ ucfirst($severity) }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Defect Type Distribution</h3>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Defect Type</th>
                    <th>Records</th>
                </tr>
            </thead>
            <tbody>
                @forelse($defectTypeCounts as $item)
                    <tr>
                        <td>{{ $item->defect_type }}</td>
                        <td>{{ $item->total }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="empty">No defect records available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- 4. Inspection Analysis --}}
    <div class="section">
        <h2>4. Inspection Analysis</h2>

        <h3>Inspection Status</h3>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Records</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inspectionStatusCounts as $status => $count)
                    <tr>
                        <td>{{ ucfirst(str_replace('_', ' ', $status)) }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Inspection Results</h3>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Result</th>
                    <th>Records</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inspectionResultCounts as $result => $count)
                    <tr>
                        <td>{{ ucfirst($result) }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- 5. Factory Analysis --}}
    <div class="section">
        <h2>5. Factory-wise Quality Analysis</h2>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Factory</th>
                    <th>Production Lines</th>
                    <th>Defect Records</th>
                    <th>Defect Quantity</th>
                    <th>Inspections</th>
                </tr>
            </thead>
            <tbody>
                @forelse($factoryAnalysis as $factory)
                    <tr>
                        <td>{{ $factory->name }}</td>
                        <td>{{ $factory->production_lines_count }}</td>
                        <td>{{ $factory->defect_count }}</td>
                        <td>{{ $factory->defect_quantity }}</td>
                        <td>{{ $factory->inspection_count }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty">
                            No factory records available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- 6. Prediction Summary --}}
    <div class="section">
        <h2>6. Prediction Execution Summary</h2>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Records</th>
                </tr>
            </thead>
            <tbody>
                @foreach($predictionStatusCounts as $status => $count)
                    <tr>
                        <td>{{ ucfirst($status) }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Recent Completed Prediction Insights</h3>

        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Model</th>
                    <th>Quality Score</th>
                    <th>Defect Rate</th>
                    <th>Risk</th>
                    <th>Mode</th>
                </tr>
            </thead>
            <tbody>
                @forelse($predictionInsights as $prediction)
                    <tr>
                        <td>#{{ $prediction['id'] }}</td>
                        <td>{{ $prediction['model_version'] ?? 'N/A' }}</td>
                        <td>
                            {{ $prediction['quality_score'] !== null
                                ? $prediction['quality_score'] . '%'
                                : 'N/A' }}
                        </td>
                        <td>
                            {{ $prediction['predicted_defect_rate'] !== null
                                ? $prediction['predicted_defect_rate'] . '%'
                                : 'N/A' }}
                        </td>
                        <td>{{ ucfirst($prediction['risk_level'] ?? 'N/A') }}</td>
                        <td>
                            {{ $prediction['demo_mode'] ? 'Demo' : 'Not identified' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">
                            No completed prediction insights available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="note">
            Prediction records represent execution activity.
            Demo outputs are illustrative and must not be interpreted as
            actual predictions from a trained or validated AI model.
            No accuracy, precision, recall or F1-score is claimed.
        </div>
    </div>

    {{-- 7. Recent Quality Issues --}}
    <div class="section">
        <h2>7. Recent Quality Issues</h2>

        <h3>Recent Defect Records</h3>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Defect Type</th>
                    <th>Factory</th>
                    <th>Machine</th>
                    <th>Severity</th>
                    <th>Status</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentDefects as $defect)
                    <tr>
                        <td>{{ $defect->defect_type }}</td>
                        <td>{{ $defect->factory?->name ?? 'N/A' }}</td>
                        <td>{{ $defect->machine?->name ?? 'N/A' }}</td>
                        <td>{{ ucfirst($defect->severity) }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $defect->status)) }}</td>
                        <td>{{ $defect->defect_quantity }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">No recent defects available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <h3>Recent Inspection Records</h3>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Inspection Number</th>
                    <th>Factory</th>
                    <th>Machine</th>
                    <th>Inspector</th>
                    <th>Status</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentInspections as $inspection)
                    <tr>
                        <td>{{ $inspection->inspection_number }}</td>
                        <td>{{ $inspection->factory?->name ?? 'N/A' }}</td>
                        <td>{{ $inspection->machine?->name ?? 'N/A' }}</td>
                        <td>{{ $inspection->inspector?->name ?? 'N/A' }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $inspection->status)) }}</td>
                        <td>{{ $inspection->result ? ucfirst($inspection->result) : 'Pending' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">No recent inspections available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- 8. Findings and Limitations --}}
    <div class="section">
        <h2>8. Findings and Limitations</h2>

        <p>
            This report reflects the records currently stored in the company's
            QualiForge AI workspace. Defect counts, inspection outcomes and
            prediction execution statuses are descriptive indicators of
            recorded activity.
        </p>

        <p>
            Factory-level defect and inspection counts describe recorded
            associations. They do not independently establish process-level
            causes or factory performance quality without appropriate
            production-volume and operational context.
        </p>

        <p>
            Prediction outputs labelled Demo are illustrative.
            They have not been presented as validated AI results.
            Model performance metrics cannot be established from these
            records alone.
        </p>
    </div>

    {{-- Footer --}}
    <div class="footer">
        QualiForge AI | Manufacturing Quality Intelligence
        <span class="right">
            Generated {{ $generatedAt->format('d M Y') }}
        </span>
    </div>

</body>
</html>
