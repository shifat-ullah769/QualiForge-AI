<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quality Report</title>

    <style>
        @page {
            margin: 35px 38px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #263445;
            font-size: 10px;
            line-height: 1.5;
        }

        .header {
            border-bottom: 3px solid #2457a7;
            padding-bottom: 14px;
            margin-bottom: 20px;
        }

        .brand {
            font-size: 21px;
            font-weight: bold;
            color: #2457a7;
        }

        .subtitle {
            color: #64748b;
            font-size: 10px;
        }

        h2 {
            font-size: 14px;
            color: #2457a7;
            border-bottom: 1px solid #dbe3ee;
            padding-bottom: 6px;
            margin-top: 22px;
        }

        h3 {
            font-size: 11px;
            color: #334155;
            margin-top: 14px;
        }

        .meta {
            width: 100%;
            margin: 15px 0;
        }

        .meta td {
            padding: 5px;
            border: 1px solid #e2e8f0;
        }

        .kpis {
            width: 100%;
            border-collapse: separate;
            border-spacing: 5px;
        }

        .kpis td {
            width: 25%;
            padding: 12px 7px;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            text-align: center;
        }

        .kpi-value {
            font-size: 19px;
            font-weight: bold;
            color: #2457a7;
        }

        .kpi-label {
            color: #64748b;
            font-size: 9px;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        table.data th {
            background: #eaf0f8;
            color: #263445;
            text-align: left;
            font-weight: bold;
        }

        table.data th,
        table.data td {
            border: 1px solid #dbe3ee;
            padding: 7px;
        }

        .note {
            padding: 10px;
            background: #f8fafc;
            border-left: 3px solid #64748b;
            margin-top: 8px;
        }

        .footer {
            margin-top: 25px;
            padding-top: 8px;
            border-top: 1px solid #dbe3ee;
            color: #64748b;
            font-size: 8px;
            text-align: center;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="brand">QualiForge AI</div>
        <div class="subtitle">Manufacturing Quality Intelligence Platform</div>
        <h2>QUALITY PERFORMANCE REPORT</h2>
        <div class="subtitle">
            Company-wide manufacturing quality overview
        </div>
    </div>

    <table class="meta">
        <tr>
            <td><strong>Company</strong></td>
            <td>{{ $company->name }}</td>
        </tr>
        <tr>
            <td><strong>Reporting Period</strong></td>
            <td>All Available Company Records</td>
        </tr>
        <tr>
            <td><strong>Generated At</strong></td>
            <td>{{ $generatedAt->format('d M Y, h:i A') }}</td>
        </tr>
        <tr>
            <td><strong>Report Reference</strong></td>
            <td>QF-{{ $company->id }}-{{ $generatedAt->format('YmdHis') }}</td>
        </tr>
    </table>

    <h2>1. Executive Summary</h2>

    <p>
        This report presents a company-level overview of recorded
        manufacturing defects, inspections, and prediction activities.
        The report is generated from the quality records currently
        available in the system.
    </p>

    <h2>2. Key Performance Indicators</h2>

    <table class="kpis">
        <tr>
            <td>
                <div class="kpi-value">{{ $totalDefects }}</div>
                <div class="kpi-label">Total Defect Records</div>
            </td>
            <td>
                <div class="kpi-value">{{ $totalDefectQuantity }}</div>
                <div class="kpi-label">Affected Quantity</div>
            </td>
            <td>
                <div class="kpi-value">{{ $totalInspections }}</div>
                <div class="kpi-label">Total Inspections</div>
            </td>
            <td>
                <div class="kpi-value">{{ $totalPredictions }}</div>
                <div class="kpi-label">Prediction Records</div>
            </td>
        </tr>
    </table>

    <h2>3. Defect Analysis</h2>

    <h3>Defect Status</h3>

    <table class="data">
        <thead>
            <tr><th>Status</th><th>Total Records</th></tr>
        </thead>
        <tbody>
            @forelse($defectStatusSummary as $item)
                <tr>
                    <td>{{ ucfirst(str_replace('_', ' ', $item->status)) }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
            @empty
                <tr><td colspan="2">No defect records available.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h3>Defect Severity</h3>

    <table class="data">
        <thead>
            <tr><th>Severity</th><th>Total Records</th></tr>
        </thead>
        <tbody>
            @forelse($defectSeveritySummary as $item)
                <tr>
                    <td>{{ ucfirst($item->severity) }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
            @empty
                <tr><td colspan="2">No severity data available.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h3>Defect Types</h3>

    <table class="data">
        <thead>
            <tr><th>Defect Type</th><th>Total Records</th></tr>
        </thead>
        <tbody>
            @forelse($defectTypeSummary as $item)
                <tr>
                    <td>{{ $item->defect_type }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
            @empty
                <tr><td colspan="2">No defect types available.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="page-break"></div>

    <h2>4. Inspection Analysis</h2>

    <h3>Inspection Status</h3>

    <table class="data">
        <thead>
            <tr><th>Status</th><th>Total</th></tr>
        </thead>
        <tbody>
            @forelse($inspectionStatusSummary as $item)
                <tr>
                    <td>{{ ucfirst(str_replace('_', ' ', $item->status)) }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
            @empty
                <tr><td colspan="2">No inspection records available.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h3>Inspection Results</h3>

    <table class="data">
        <thead>
            <tr><th>Result</th><th>Total</th></tr>
        </thead>
        <tbody>
            @forelse($inspectionResultSummary as $item)
                <tr>
                    <td>{{ ucfirst($item->result) }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
            @empty
                <tr><td colspan="2">No inspection results available.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h2>5. Prediction Activity</h2>

    <div class="note">
        Prediction records are summarized by their stored execution status.
        Demo prediction outputs, where applicable, are simulated and must
        not be interpreted as validated real-world AI predictions.
    </div>

    <table class="data">
        <thead>
            <tr><th>Prediction Status</th><th>Total Records</th></tr>
        </thead>
        <tbody>
            @forelse($predictionStatusSummary as $item)
                <tr>
                    <td>{{ ucfirst(str_replace('_', ' ', $item->status)) }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
            @empty
                <tr><td colspan="2">No prediction records available.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h2>6. Recent Quality Issues</h2>

    <table class="data">
        <thead>
            <tr>
                <th>Defect</th>
                <th>Severity</th>
                <th>Status</th>
                <th>Factory</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentDefects as $defect)
                <tr>
                    <td>{{ $defect->defect_type }}</td>
                    <td>{{ ucfirst($defect->severity) }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $defect->status)) }}</td>
                    <td>{{ $defect->factory?->name ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr><td colspan="4">No recent defects available.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h3>Recent Inspections</h3>

    <table class="data">
        <thead>
            <tr>
                <th>Inspection Number</th>
                <th>Type</th>
                <th>Status</th>
                <th>Result</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentInspections as $inspection)
                <tr>
                    <td>{{ $inspection->inspection_number }}</td>
                    <td>{{ $inspection->inspection_type }}</td>
                    <td>{{ ucfirst($inspection->status) }}</td>
                    <td>{{ $inspection->result ? ucfirst($inspection->result) : 'Pending' }}</td>
                </tr>
            @empty
                <tr><td colspan="4">No recent inspections available.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h2>7. Findings and Limitations</h2>

    <div class="note">
        This report summarizes recorded system data. Defect associations
        with machines or production lines do not independently establish
        root causes. Prediction status counts do not establish model
        accuracy or predictive effectiveness. Further investigation and
        validation are required before operational conclusions are made.
    </div>


</body>
</html>
