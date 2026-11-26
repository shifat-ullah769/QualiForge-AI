<x-app-layout>
    <div class="qm-pd-page">
        <style>
            .qm-pd-page {
                min-height: 100vh;
                padding: 30px;
                background: #07111f;
                color: #e5edf7;
            }

            .qm-pd-container {
                max-width: 1250px;
                margin: auto;
            }

            .qm-pd-heading {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                gap: 20px;
                flex-wrap: wrap;
                margin-bottom: 25px;
            }

            .qm-pd-eyebrow {
                color: #22d3ee;
                font-size: 10px;
                font-weight: 800;
                letter-spacing: 1.5px;
            }

            .qm-pd-heading h1 {
                margin: 7px 0;
                color: #f8fafc;
                font-size: 27px;
                font-weight: 750;
            }

            .qm-pd-heading p {
                color: #94a3b8;
                font-size: 13px;
            }

            .qm-pd-actions {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
            }

            .qm-pd-btn {
                padding: 10px 15px;
                border: 1px solid #164e63;
                border-radius: 7px;
                background: #0e7490;
                color: white;
                text-decoration: none;
                font-size: 12px;
                font-weight: 700;
                cursor: pointer;
            }

            .qm-pd-btn.secondary {
                background: #172b40;
                border-color: #334155;
            }

            .qm-pd-disclosure {
                padding: 15px 18px;
                margin-bottom: 22px;
                border: 1px solid rgba(245, 158, 11, .35);
                border-radius: 10px;
                background: rgba(245, 158, 11, .08);
                color: #fbbf24;
                font-size: 12px;
                line-height: 1.7;
            }

            .qm-pd-section {
                padding: 23px;
                margin-bottom: 20px;
                border: 1px solid #1e334a;
                border-radius: 13px;
                background: #101d2e;
            }

            .qm-pd-section h2 {
                margin: 0 0 20px;
                color: #f1f5f9;
                font-size: 16px;
                font-weight: 750;
            }

            .qm-pd-meta {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 18px;
            }

            .qm-pd-meta-item {
                padding: 15px;
                border: 1px solid #20364e;
                border-radius: 9px;
                background: #0b1727;
            }

            .qm-pd-meta-item span {
                display: block;
                margin-bottom: 8px;
                color: #7f9ab5;
                font-size: 10px;
                text-transform: uppercase;
                letter-spacing: .6px;
            }

            .qm-pd-meta-item strong {
                color: #e2e8f0;
                font-size: 13px;
                overflow-wrap: anywhere;
            }

            .qm-pd-status {
                display: inline-block;
                padding: 5px 10px;
                border-radius: 20px;
                background: rgba(34, 197, 94, .12);
                color: #86efac;
                font-size: 11px;
            }

            .qm-pd-metrics {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 14px;
            }

            .qm-pd-metric {
                padding: 19px;
                border: 1px solid #20364e;
                border-radius: 10px;
                background: #0b1727;
            }

            .qm-pd-metric span {
                display: block;
                margin-bottom: 12px;
                color: #94a3b8;
                font-size: 11px;
            }

            .qm-pd-metric strong {
                color: #22d3ee;
                font-size: 25px;
                font-weight: 750;
            }

            .qm-pd-metric small {
                display: block;
                margin-top: 7px;
                color: #64748b;
                font-size: 10px;
            }

            .qm-pd-analysis {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 18px;
            }

            .qm-pd-chart {
                padding: 20px;
                border: 1px solid #20364e;
                border-radius: 10px;
                background: #0b1727;
            }

            .qm-pd-chart h3 {
                margin-bottom: 15px;
                color: #cbd5e1;
                font-size: 13px;
                font-weight: 700;
            }

            .qm-pd-chart-value {
                margin-bottom: 14px;
                color: #22d3ee;
                font-size: 27px;
                font-weight: 750;
            }

            .qm-pd-progress {
                width: 100%;
                height: 13px;
                overflow: hidden;
                border: 0;
                border-radius: 20px;
                background: #26384d;
                appearance: none;
            }

            .qm-pd-progress::-webkit-progress-bar {
                background: #26384d;
                border-radius: 20px;
            }

            .qm-pd-progress::-webkit-progress-value {
                background: linear-gradient(90deg, #0891b2, #22d3ee);
                border-radius: 20px;
            }

            .qm-pd-progress::-moz-progress-bar {
                background: linear-gradient(90deg, #0891b2, #22d3ee);
                border-radius: 20px;
            }

            .qm-pd-donut-wrap {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 25px;
                flex-wrap: wrap;
            }

            .qm-pd-donut {
                width: 140px;
                height: 140px;
                display: grid;
                place-items: center;
                border-radius: 50%;
                background: conic-gradient(
                    #22d3ee 0 var(--defect-rate),
                    #26384d var(--defect-rate) 100%
                );
                position: relative;
            }

            .qm-pd-donut::before {
                content: "";
                position: absolute;
                width: 100px;
                height: 100px;
                border-radius: 50%;
                background: #0b1727;
            }

            .qm-pd-donut strong {
                z-index: 1;
                color: #f8fafc;
                font-size: 21px;
            }

            .qm-pd-legend {
                display: grid;
                gap: 12px;
                color: #cbd5e1;
                font-size: 11px;
            }

            .qm-pd-legend-item {
                display: flex;
                align-items: center;
                gap: 9px;
            }

            .qm-pd-dot {
                width: 9px;
                height: 9px;
                border-radius: 3px;
                background: #22d3ee;
            }

            .qm-pd-dot.muted {
                background: #26384d;
            }

            .qm-pd-recommendations {
                margin: 0;
                padding-left: 20px;
                color: #cbd5e1;
                font-size: 13px;
                line-height: 2;
            }

            .qm-pd-empty {
                color: #94a3b8;
                font-size: 12px;
            }

            @media (max-width: 900px) {
                .qm-pd-metrics {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .qm-pd-meta {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }

            @media (max-width: 650px) {
                .qm-pd-page {
                    padding: 20px 12px;
                }

                .qm-pd-section {
                    padding: 16px;
                }

                .qm-pd-meta,
                .qm-pd-metrics,
                .qm-pd-analysis {
                    grid-template-columns: 1fr;
                }
            }

            @media print {
                nav, header, .qm-pd-actions {
                    display: none !important;
                }

                .qm-pd-page {
                    background: white !important;
                    color: #111827 !important;
                    padding: 10px !important;
                }

                .qm-pd-section,
                .qm-pd-meta-item,
                .qm-pd-metric,
                .qm-pd-chart {
                    background: white !important;
                    color: #111827 !important;
                    border-color: #ccc !important;
                    break-inside: avoid;
                }

                .qm-pd-section h2,
                .qm-pd-meta-item strong,
                .qm-pd-metric strong {
                    color: #111827 !important;
                }
            }
        </style>

        @php
            $summary = $prediction->summary ?? [];
            $payload = $prediction->result_payload ?? [];
            $recommendations = $payload['recommendations'] ?? [];

            $qualityScore = (float) ($summary['quality_score'] ?? 0);
            $defectRate = (float) ($summary['predicted_defect_rate'] ?? 0);
            $defectRecords = (int) ($summary['predicted_defect_records'] ?? 0);
            $totalRecords = (int) ($summary['total_records'] ?? 0);
            $riskLevel = $summary['risk_level'] ?? '—';
            $isDemo = (bool) ($payload['demo_mode'] ?? false);
        @endphp

        <div class="qm-pd-container">

            <div class="qm-pd-heading">
                <div>
                    <div class="qm-pd-eyebrow">QUALITY INTELLIGENCE / RECORD REVIEW</div>
                    <h1>Prediction Record #{{ $prediction->id }}</h1>
                    <p>Read-only review of prediction results and execution metadata.</p>
                </div>

                <div class="qm-pd-actions">
                    <button type="button" class="qm-pd-btn" onclick="window.print()">
                        Print Report
                    </button>

                    <a href="{{ route('qm.predictions.index') }}" class="qm-pd-btn secondary">
                        ← Prediction Registry
                    </a>
                </div>
            </div>

            @if ($isDemo)
                <div class="qm-pd-disclosure">
                    <strong>DEMO ENVIRONMENT:</strong>
                    {{ $payload['notice'] ?? 'Illustrative results only. These are not outputs from a production-trained AI model.' }}
                </div>
            @endif

            <section class="qm-pd-section">
                <h2>Execution Record</h2>

                <div class="qm-pd-meta">
                    <div class="qm-pd-meta-item">
                        <span>Prediction ID</span>
                        <strong>#{{ $prediction->id }}</strong>
                    </div>

                    <div class="qm-pd-meta-item">
                        <span>Dataset</span>
                        <strong>{{ $prediction->dataset?->name ?? 'Unavailable' }}</strong>
                    </div>

                    <div class="qm-pd-meta-item">
                        <span>Model Version</span>
                        <strong>{{ $prediction->model_version ?? '—' }}</strong>
                    </div>

                    <div class="qm-pd-meta-item">
                        <span>Execution Status</span>
                        <strong>
                            <span class="qm-pd-status">
                                {{ ucfirst($prediction->status) }}
                            </span>
                        </strong>
                    </div>

                    <div class="qm-pd-meta-item">
                        <span>Requested By</span>
                        <strong>{{ $prediction->requester?->name ?? 'Unknown' }}</strong>
                    </div>

                    <div class="qm-pd-meta-item">
                        <span>Completed At</span>
                        <strong>{{ $prediction->completed_at?->format('d M Y, h:i A') ?? '—' }}</strong>
                    </div>
                </div>
            </section>

            <section class="qm-pd-section">
                <h2>Quality Assessment Summary</h2>

                <div class="qm-pd-metrics">
                    <div class="qm-pd-metric">
                        <span>Quality Score</span>
                        <strong>{{ number_format($qualityScore, 1) }}%</strong>
                        <small>Recorded assessment value</small>
                    </div>

                    <div class="qm-pd-metric">
                        <span>Predicted Defect Rate</span>
                        <strong>{{ number_format($defectRate, 1) }}%</strong>
                        <small>Recorded prediction value</small>
                    </div>

                    <div class="qm-pd-metric">
                        <span>Predicted Defect Records</span>
                        <strong>{{ $defectRecords }}</strong>
                        <small>Out of {{ $totalRecords }} records</small>
                    </div>

                    <div class="qm-pd-metric">
                        <span>Risk Classification</span>
                        <strong>{{ ucfirst($riskLevel) }}</strong>
                        <small>Recorded risk category</small>
                    </div>
                </div>
            </section>

            <section class="qm-pd-section">
                <h2>Graphical Result Analysis</h2>

                <div class="qm-pd-analysis">
                    <div class="qm-pd-chart">
                        <h3>Quality Score</h3>

                        <div class="qm-pd-chart-value">
                            {{ number_format($qualityScore, 1) }}%
                        </div>

                        <progress
                            class="qm-pd-progress"
                            max="100"
                            value="{{ min(100, max(0, $qualityScore)) }}">
                        </progress>
                    </div>

                    <div class="qm-pd-chart">
                        <h3>Predicted Defect Distribution</h3>

                        <div class="qm-pd-donut-wrap">
                            <div class="qm-pd-donut"
                                style="--defect-rate: {{ min(100, max(0, $defectRate)) }}%;">
                                <strong>{{ number_format($defectRate, 1) }}%</strong>
                            </div>

                            <div class="qm-pd-legend">
                                <div class="qm-pd-legend-item">
                                    <span class="qm-pd-dot"></span>
                                    Predicted Defects
                                </div>

                                <div class="qm-pd-legend-item">
                                    <span class="qm-pd-dot muted"></span>
                                    Remaining Records
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="qm-pd-section">
                <h2>Recorded Recommendations</h2>

                @if (!empty($recommendations))
                    <ul class="qm-pd-recommendations">
                        @foreach ($recommendations as $recommendation)
                            <li>{{ $recommendation }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="qm-pd-empty">
                        No recommendations are available for this prediction record.
                    </p>
                @endif
            </section>

        </div>
    </div>
</x-app-layout>
