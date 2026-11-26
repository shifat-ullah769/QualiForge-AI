<x-app-layout>
    <div class="qf-analytics">

        <style>
            .qf-analytics {
                min-height: 100vh;
                padding: 30px 22px 45px;
                background: #07111f;
                color: #e5edf7;
            }

            .qfa-container {
                max-width: 1350px;
                margin: auto;
            }

            .qfa-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 15px;
                flex-wrap: wrap;
                margin-bottom: 25px;
            }

            .qfa-header h1 {
                font-size: 27px;
                font-weight: 750;
                color: #f8fafc;
                margin: 0 0 7px;
            }

            .qfa-header p {
                font-size: 13px;
                color: #94a3b8;
                margin: 0;
            }

            .qfa-panel {
                background: #101d2e;
                border: 1px solid #1e334a;
                border-radius: 13px;
                padding: 22px;
                margin-bottom: 20px;
            }

            .qfa-panel h2 {
                font-size: 17px;
                font-weight: 700;
                margin: 0 0 20px;
                color: #f1f5f9;
            }

            .qfa-section-title {
                font-size: 19px;
                font-weight: 750;
                color: #f8fafc;
                margin: 30px 0 15px;
            }

            .qfa-section-description {
                color: #94a3b8;
                font-size: 12px;
                margin: -7px 0 17px;
            }

            .qfa-kpi-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(185px, 1fr));
                gap: 14px;
                margin-bottom: 22px;
            }

            .qfa-kpi {
                background: #101d2e;
                border: 1px solid #1e334a;
                border-radius: 12px;
                padding: 19px;
            }

            .qfa-kpi-label {
                color: #94a3b8;
                font-size: 12px;
                margin-bottom: 12px;
            }

            .qfa-kpi-value {
                font-size: 27px;
                font-weight: 750;
                color: #f8fafc;
            }

            .qfa-kpi-note {
                color: #64748b;
                font-size: 10px;
                margin-top: 7px;
            }

            .qfa-grid-two {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 18px;
            }

            .qfa-bar-row {
                margin-bottom: 19px;
            }

            .qfa-bar-info {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 10px;
                font-size: 12px;
                margin-bottom: 8px;
            }

            .qfa-bar-info span:last-child {
                color: #94a3b8;
                white-space: nowrap;
            }

            .qfa-bar-track {
                height: 10px;
                width: 100%;
                background: #091626;
                border-radius: 20px;
                overflow: hidden;
            }

            .qfa-bar-fill {
                height: 100%;
                min-width: 0;
                border-radius: 20px;
                background: #22d3ee;
            }

            .qfa-bar-fill.blue {
                background: #60a5fa;
            }

            .qfa-bar-fill.green {
                background: #34d399;
            }

            .qfa-bar-fill.yellow {
                background: #fbbf24;
            }

            .qfa-bar-fill.red {
                background: #fb7185;
            }

            .qfa-table-wrap {
                overflow-x: auto;
            }

            .qfa-table {
                width: 100%;
                min-width: 450px;
                border-collapse: collapse;
            }

            .qfa-table th {
                text-align: left;
                color: #94a3b8;
                font-size: 11px;
                font-weight: 600;
                padding: 12px;
                white-space: nowrap;
            }

            .qfa-table td {
                border-top: 1px solid #26384d;
                padding: 14px 12px;
                font-size: 12px;
                color: #dce8f8;
            }

            .qfa-badge {
                display: inline-block;
                padding: 5px 9px;
                border-radius: 20px;
                font-size: 10px;
                font-weight: 700;
                text-transform: capitalize;
            }

            .qfa-badge.success {
                background: #123b35;
                color: #5ce0b0;
            }

            .qfa-badge.warning {
                background: #40351a;
                color: #f3cb70;
            }

            .qfa-badge.danger {
                background: #4b202c;
                color: #ff8298;
            }

            .qfa-badge.info {
                background: #17344b;
                color: #69c9ff;
            }

            .qfa-empty {
                color: #94a3b8;
                font-size: 13px;
                padding: 18px 0;
                text-align: center;
            }

            .qfa-demo-notice {
                padding: 14px 17px;
                background: #172438;
                border: 1px solid #854d0e;
                border-radius: 9px;
                color: #fbbf24;
                font-size: 12px;
                line-height: 1.8;
                margin-bottom: 18px;
            }

            .qfa-limitations {
                background: #172438;
                border: 1px solid #854d0e;
                border-radius: 10px;
                padding: 20px;
                margin-top: 25px;
            }

            .qfa-limitations h2 {
                color: #fbbf24;
                font-size: 15px;
                font-weight: 700;
                margin-bottom: 12px;
            }

            .qfa-limitations p,
            .qfa-limitations li {
                color: #cbd5e1;
                font-size: 12px;
                line-height: 1.8;
            }

            .qfa-limitations ul {
                padding-left: 20px;
                margin-top: 10px;
            }

            @media(max-width: 750px) {
                .qfa-grid-two {
                    grid-template-columns: 1fr;
                }

                .qfa-header h1 {
                    font-size: 23px;
                }
            }
        </style>

        <div class="qfa-container">

            {{-- Header --}}
            <div class="qfa-header">
                <div>
                    <h1>Quality Analytics</h1>
                    <p>
                        Company-wide manufacturing quality insights
                        across defects, inspections and predictions.
                    </p>
                </div>
            </div>

            {{-- ================================================= --}}
            {{-- DEFECT ANALYTICS --}}
            {{-- ================================================= --}}

            <h2 class="qfa-section-title">Defect Analytics</h2>

            <p class="qfa-section-description">
                Overview of recorded defects and their distribution.
            </p>

            <div class="qfa-kpi-grid">

                <div class="qfa-kpi">
                    <div class="qfa-kpi-label">Total Defect Records</div>
                    <div class="qfa-kpi-value">{{ $totalDefectRecords }}</div>
                    <div class="qfa-kpi-note">Recorded defect cases</div>
                </div>

                <div class="qfa-kpi">
                    <div class="qfa-kpi-label">Total Defect Quantity</div>
                    <div class="qfa-kpi-value">{{ number_format($totalDefectQuantity) }}</div>
                    <div class="qfa-kpi-note">Reported defective units</div>
                </div>

                <div class="qfa-kpi">
                    <div class="qfa-kpi-label">Open / Investigating</div>
                    <div class="qfa-kpi-value">{{ $openDefects }}</div>
                    <div class="qfa-kpi-note">Unresolved defect records</div>
                </div>

                <div class="qfa-kpi">
                    <div class="qfa-kpi-label">Resolved Defects</div>
                    <div class="qfa-kpi-value">{{ $resolvedDefects }}</div>
                    <div class="qfa-kpi-note">Records marked resolved</div>
                </div>

            </div>

            <div class="qfa-grid-two">

                {{-- Defect Type Analysis --}}
                <section class="qfa-panel">
                    <h2>Defect Type Analysis</h2>

                    @forelse($defectTypeAnalysis as $item)

                        @php
                            $percentage = $totalDefectRecords > 0
                                ? ($item->total_records / $totalDefectRecords) * 100
                                : 0;
                        @endphp

                        <div class="qfa-bar-row">
                            <div class="qfa-bar-info">
                                <strong>{{ $item->defect_type }}</strong>
                                <span>
                                    {{ $item->total_records }} records
                                    / {{ $item->total_quantity }} units
                                </span>
                            </div>

                            <div class="qfa-bar-track">
                                <div class="qfa-bar-fill"
                                    @style(['width' => $percentage . '%'])
                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="qfa-empty">No defect data available.</div>
                    @endforelse
                </section>

                {{-- Severity Distribution --}}
                <section class="qfa-panel">
                    <h2>Severity Distribution</h2>

                    @forelse($severityAnalysis as $item)

                        @php
                            $percentage = $totalDefectRecords > 0
                                ? ($item->total / $totalDefectRecords) * 100
                                : 0;

                            $severityClass = match(strtolower($item->severity ?? '')) {
                                'critical', 'high' => 'red',
                                'medium' => 'yellow',
                                'low' => 'green',
                                default => 'blue',
                            };
                        @endphp

                        <div class="qfa-bar-row">
                            <div class="qfa-bar-info">
                                <strong>{{ ucfirst($item->severity ?? 'Unknown') }}</strong>
                                <span>{{ $item->total }} records</span>
                            </div>

                            <div class="qfa-bar-track">
                                <div class="qfa-bar-fill {{ $severityClass }}"
                                    @style(['width' => $percentage . '%'])
                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="qfa-empty">No severity data available.</div>
                    @endforelse
                </section>

            </div>

            {{-- Machine Analysis --}}
            <section class="qfa-panel">
                <h2>Machine-wise Defect Analysis</h2>

                <div class="qfa-table-wrap">
                    <table class="qfa-table">
                        <thead>
                            <tr>
                                <th>Machine</th>
                                <th>Defect Records</th>
                                <th>Defect Quantity</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($machineAnalysis as $item)
                                <tr>
                                    <td>{{ $item->machine_name ?? 'Unassigned' }}</td>
                                    <td>{{ $item->total_records }}</td>
                                    <td>{{ number_format($item->total_quantity) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="qfa-empty">
                                        No machine data available.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            {{-- Production Line Analysis --}}
            <section class="qfa-panel">
                <h2>Production Line Analysis</h2>

                <div class="qfa-table-wrap">
                    <table class="qfa-table">
                        <thead>
                            <tr>
                                <th>Production Line</th>
                                <th>Defect Records</th>
                                <th>Defect Quantity</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($productionLineAnalysis as $item)
                                <tr>
                                    <td>{{ $item->line_name ?? 'Unassigned' }}</td>
                                    <td>{{ $item->total_records }}</td>
                                    <td>{{ number_format($item->total_quantity) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="qfa-empty">
                                        No production line data available.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            {{-- ================================================= --}}
            {{-- INSPECTION ANALYTICS --}}
            {{-- ================================================= --}}

            <h2 class="qfa-section-title">Inspection Analytics</h2>

            <p class="qfa-section-description">
                Inspection workflow status and recorded outcomes.
            </p>

            <div class="qfa-kpi-grid">

                <div class="qfa-kpi">
                    <div class="qfa-kpi-label">Total Inspections</div>
                    <div class="qfa-kpi-value">{{ $totalInspections }}</div>
                    <div class="qfa-kpi-note">Company inspection records</div>
                </div>

                @foreach($inspectionResultAnalysis as $item)
                    <div class="qfa-kpi">
                        <div class="qfa-kpi-label">
                            {{ $item->result ? ucfirst($item->result) : 'Pending Result' }}
                        </div>
                        <div class="qfa-kpi-value">{{ $item->total }}</div>
                        <div class="qfa-kpi-note">Inspection outcomes</div>
                    </div>
                @endforeach

            </div>

            <div class="qfa-grid-two">

                {{-- Inspection Status --}}
                <section class="qfa-panel">
                    <h2>Inspection Status Distribution</h2>

                    @forelse($inspectionStatusAnalysis as $item)

                        @php
                            $percentage = $totalInspections > 0
                                ? ($item->total / $totalInspections) * 100
                                : 0;

                            $statusClass = match($item->status) {
                                'completed' => 'green',
                                'cancelled' => 'red',
                                'in_progress' => 'yellow',
                                default => 'blue',
                            };
                        @endphp

                        <div class="qfa-bar-row">
                            <div class="qfa-bar-info">
                                <strong>{{ ucfirst(str_replace('_', ' ', $item->status)) }}</strong>
                                <span>{{ $item->total }} records</span>
                            </div>

                            <div class="qfa-bar-track">
                                <div class="qfa-bar-fill {{ $statusClass }}"
                                    @style(['width' => $percentage . '%'])
                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="qfa-empty">No inspection data available.</div>
                    @endforelse
                </section>

                {{-- Inspection Results --}}
                <section class="qfa-panel">
                    <h2>Inspection Result Distribution</h2>

                    @forelse($inspectionResultAnalysis as $item)

                        @php
                            $percentage = $totalInspections > 0
                                ? ($item->total / $totalInspections) * 100
                                : 0;

                            $resultClass = match($item->result) {
                                'pass' => 'green',
                                'fail' => 'red',
                                'conditional' => 'yellow',
                                default => 'blue',
                            };
                        @endphp

                        <div class="qfa-bar-row">
                            <div class="qfa-bar-info">
                                <strong>
                                    {{ $item->result ? ucfirst($item->result) : 'Pending' }}
                                </strong>
                                <span>{{ $item->total }} records</span>
                            </div>

                            <div class="qfa-bar-track">
                                <div class="qfa-bar-fill {{ $resultClass }}"
                                    @style(['width' => $percentage . '%'])
                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="qfa-empty">No inspection results available.</div>
                    @endforelse
                </section>

            </div>

            {{-- ================================================= --}}
            {{-- PREDICTION INSIGHTS --}}
            {{-- ================================================= --}}

            <h2 class="qfa-section-title">Prediction Monitoring Insights</h2>

            <p class="qfa-section-description">
                Overview of prediction execution records and stored outputs.
            </p>

            <div class="qfa-kpi-grid">

                <div class="qfa-kpi">
                    <div class="qfa-kpi-label">Total Predictions</div>
                    <div class="qfa-kpi-value">{{ $totalPredictions }}</div>
                    <div class="qfa-kpi-note">Recorded prediction requests</div>
                </div>

                <div class="qfa-kpi">
                    <div class="qfa-kpi-label">Completed</div>
                    <div class="qfa-kpi-value">{{ $completedPredictions }}</div>
                    <div class="qfa-kpi-note">Completed executions</div>
                </div>

                <div class="qfa-kpi">
                    <div class="qfa-kpi-label">Failed</div>
                    <div class="qfa-kpi-value">{{ $failedPredictions }}</div>
                    <div class="qfa-kpi-note">Failed executions</div>
                </div>

                <div class="qfa-kpi">
                    <div class="qfa-kpi-label">Running / Pending</div>
                    <div class="qfa-kpi-value">{{ $runningPredictions }}</div>
                    <div class="qfa-kpi-note">Unfinished executions</div>
                </div>

            </div>

            <div class="qfa-demo-notice">
                <strong>Demo Environment Disclosure:</strong>
                The prediction outputs below are illustrative demo results.
                They are not actual AI predictions and must not be interpreted
                as validated model performance.
                Demo prediction records identified:
                <strong>{{ $demoPredictionCount }}</strong>.
            </div>

            {{-- Demo Prediction Insights --}}
            <section class="qfa-panel">
                <h2>Demo Prediction Insights</h2>

                @forelse($demoPredictionInsights as $item)

                    <div style="padding:18px;margin-bottom:14px;background:#091626;border:1px solid #26384d;border-radius:10px;">

                        <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:17px;">

                            <strong style="font-size:14px;">
                                Prediction #{{ $item['id'] }}
                            </strong>

                            <span class="qfa-badge warning">
                                Demo Output
                            </span>

                        </div>

                        <div class="qfa-kpi-grid" style="margin-bottom:0;">

                            <div>
                                <div class="qfa-kpi-label">Model Version</div>
                                <strong>{{ $item['model_version'] ?? '—' }}</strong>
                            </div>

                            <div>
                                <div class="qfa-kpi-label">Input Records</div>
                                <strong>{{ $item['total_records'] ?? '—' }}</strong>
                            </div>

                            <div>
                                <div class="qfa-kpi-label">Illustrative Quality Score</div>
                                <strong>
                                    {{ $item['quality_score'] !== null ? $item['quality_score'] . '%' : '—' }}
                                </strong>
                            </div>

                            <div>
                                <div class="qfa-kpi-label">Illustrative Defect Rate</div>
                                <strong>
                                    {{ $item['predicted_defect_rate'] !== null ? $item['predicted_defect_rate'] . '%' : '—' }}
                                </strong>
                            </div>

                            <div>
                                <div class="qfa-kpi-label">Predicted Defect Records</div>
                                <strong>{{ $item['predicted_defect_records'] ?? '—' }}</strong>
                            </div>

                            <div>
                                <div class="qfa-kpi-label">Illustrative Risk Level</div>
                                <strong style="text-transform:capitalize;">
                                    {{ $item['risk_level'] ?? '—' }}
                                </strong>
                            </div>

                        </div>

                        <div style="margin-top:15px;color:#64748b;font-size:11px;">
                            Generated:
                            {{ $item['created_at']?->format('d M Y, h:i A') ?? '—' }}
                        </div>

                    </div>

                @empty

                    <div class="qfa-empty">
                        No demo prediction output is available.
                    </div>

                @endforelse
            </section>

            {{-- ================================================= --}}
            {{-- ANALYSIS LIMITATIONS --}}
            {{-- ================================================= --}}

            <section class="qfa-limitations">

                <h2>Analysis Limitations & Interpretation</h2>

                <p>
                    These analytics summarize records stored within the company's
                    manufacturing quality system. Results should be interpreted
                    within the scope and completeness of the available data.
                </p>

                <ul>
                    <li>
                        Machine-wise and production-line defect associations
                        indicate observed patterns, not confirmed root causes.
                    </li>

                    <li>
                        Inspection outcomes describe recorded inspection results
                        and do not independently establish overall product quality.
                    </li>

                    <li>
                        Prediction outputs marked as demo are illustrative only
                        and do not represent validated AI performance.
                    </li>

                    <li>
                        Accuracy, precision, recall and F1-score are not reported
                        because validated ground-truth evaluation data is not
                        currently available in this prediction structure.
                    </li>

                </ul>

            </section>

        </div>
    </div>
</x-app-layout>
