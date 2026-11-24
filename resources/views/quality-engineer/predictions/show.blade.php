<x-app-layout>
    <div class="qf-prediction-details">
        <style>
            .qf-prediction-details {
                min-height: 100vh;
                padding: 32px;
                background: #07111f;
                color: #e5edf7;
            }

            .qf-pd-container {
                max-width: 1250px;
                margin: auto;
            }

            .qf-pd-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 15px;
                flex-wrap: wrap;
                margin-bottom: 25px;
            }

            .qf-pd-header h1 {
                margin: 0 0 7px;
                color: #f8fafc;
                font-size: 27px;
                font-weight: 700;
            }

            .qf-pd-header p {
                margin: 0;
                color: #94a3b8;
                font-size: 13px;
            }

            .qf-pd-back {
                color: #22d3ee;
                text-decoration: none;
                font-size: 13px;
                font-weight: 650;
            }

            .qf-pd-demo {
                padding: 13px 16px;
                margin-bottom: 22px;
                border: 1px solid rgba(8, 145, 178, .35);
                border-radius: 9px;
                background: rgba(8, 145, 178, .10);
                color: #67e8f9;
                font-size: 12px;
            }

            .qf-pd-card {
                padding: 23px;
                margin-bottom: 20px;
                background: #101d2e;
                border: 1px solid #1e334a;
                border-radius: 14px;
            }

            .qf-pd-card h2 {
                margin: 0 0 20px;
                color: #f1f5f9;
                font-size: 16px;
                font-weight: 700;
            }

            .qf-pd-grid {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 15px;
            }

            .qf-pd-metric {
                padding: 18px;
                background: #0b1727;
                border: 1px solid #1e334a;
                border-radius: 11px;
            }

            .qf-pd-metric span {
                display: block;
                margin-bottom: 12px;
                color: #94a3b8;
                font-size: 11px;
            }

            .qf-pd-metric strong {
                color: #f8fafc;
                font-size: 25px;
                font-weight: 750;
            }

            .qf-pd-metric small {
                display: block;
                margin-top: 6px;
                color: #64748b;
                font-size: 10px;
            }

            .qf-pd-status {
                display: inline-block;
                padding: 6px 11px;
                border-radius: 20px;
                background: rgba(22, 163, 74, .15);
                color: #86efac;
                font-size: 11px;
                font-weight: 700;
                text-transform: capitalize;
            }

            .qf-pd-charts {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 20px;
            }

            .qf-pd-chart-box {
                min-width: 0;
                padding: 20px;
                background: #0b1727;
                border: 1px solid #1e334a;
                border-radius: 11px;
            }

            .qf-pd-chart-box h3 {
                margin: 0 0 18px;
                color: #e2e8f0;
                font-size: 13px;
                font-weight: 700;
            }

            .qf-pd-chart-value {
                margin-bottom: 15px;
                color: #22d3ee;
                font-size: 28px;
                font-weight: 750;
            }

            .qf-pd-progress {
                display: block;
                width: 100%;
                height: 13px;
                appearance: none;
                border: none;
                border-radius: 20px;
                overflow: hidden;
                background: #26384d;
            }

            .qf-pd-progress::-webkit-progress-bar {
                background: #26384d;
                border-radius: 20px;
            }

            .qf-pd-progress::-webkit-progress-value {
                background: linear-gradient(90deg, #0891b2, #22d3ee);
                border-radius: 20px;
            }

            .qf-pd-progress::-moz-progress-bar {
                background: linear-gradient(90deg, #0891b2, #22d3ee);
                border-radius: 20px;
            }

            .qf-pd-donut-wrap {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 25px;
                flex-wrap: wrap;
                padding: 10px 0;
            }

            .qf-pd-donut {
                width: 145px;
                height: 145px;
                display: grid;
                place-items: center;
                border-radius: 50%;
                background: conic-gradient(#22d3ee 0 var(--defect-rate),
                        #26384d var(--defect-rate) 100%);
                position: relative;
            }

            .qf-pd-donut::before {
                content: "";
                position: absolute;
                width: 105px;
                height: 105px;
                border-radius: 50%;
                background: #0b1727;
            }

            .qf-pd-donut-label {
                z-index: 1;
                color: #f8fafc;
                font-size: 22px;
                font-weight: 750;
            }

            .qf-pd-legend {
                display: grid;
                gap: 12px;
            }

            .qf-pd-legend-item {
                display: flex;
                align-items: center;
                gap: 9px;
                color: #cbd5e1;
                font-size: 11px;
            }

            .qf-pd-dot {
                width: 9px;
                height: 9px;
                border-radius: 3px;
                background: #22d3ee;
            }

            .qf-pd-dot.muted {
                background: #26384d;
            }

            .qf-pd-list {
                margin: 0;
                padding-left: 20px;
                color: #cbd5e1;
                font-size: 13px;
                line-height: 2;
            }

            .qf-pd-meta {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 18px;
            }

            .qf-pd-meta span {
                display: block;
                margin-bottom: 6px;
                color: #64748b;
                font-size: 10px;
                font-weight: 700;
                text-transform: uppercase;
            }

            .qf-pd-meta strong {
                color: #e2e8f0;
                font-size: 13px;
                overflow-wrap: anywhere;
            }

            .qf-pd-empty {
                color: #94a3b8;
                font-size: 12px;
            }

            @media (max-width: 850px) {
                .qf-pd-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .qf-pd-charts {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width: 640px) {
                .qf-prediction-details {
                    padding: 20px 12px;
                }

                .qf-pd-card {
                    padding: 17px;
                }

                .qf-pd-meta {
                    grid-template-columns: 1fr;
                }
            }
        </style>

        @php
        $summary = $prediction->summary ?? [];
        $payload = $prediction->result_payload ?? [];
        $quality = $payload['quality_assessment'] ?? [];
        $defect = $payload['defect_analysis'] ?? [];
        $recommendations = $payload['recommendations'] ?? [];

        $qualityScore = (float) ($summary['quality_score'] ?? 0);
        $defectRate = (float) ($summary['predicted_defect_rate'] ?? 0);
        $defectRecords = (int) ($summary['predicted_defect_records'] ?? 0);
        $totalRecords = (int) ($summary['total_records'] ?? 0);

        $isDemo = (bool) ($payload['demo_mode'] ?? false);
        @endphp

        <div class="qf-pd-container">

            <div class="qf-pd-header">
                <div>
                    <h1>Prediction Details</h1>
                    <p>Manufacturing quality prediction and analysis</p>
                </div>

                <a href="{{ route('qe.predictions.index') }}"
                    class="qf-pd-back">
                    ← Prediction History
                </a>
            </div>

            @if ($isDemo)
            <div class="qf-pd-demo">
                <strong>DEMO MODE:</strong>
                {{ $payload['notice'] ?? 'Illustrative results only. Not actual AI predictions.' }}
            </div>
            @endif

            <div class="qf-pd-card">
                <h2>Prediction Overview</h2>

                <div class="qf-pd-meta">
                    <div>
                        <span>Prediction ID</span>
                        <strong>#{{ $prediction->id }}</strong>
                    </div>

                    <div>
                        <span>Dataset</span>
                        <strong>{{ $prediction->dataset?->name ?? 'Unavailable' }}</strong>
                    </div>

                    <div>
                        <span>Model Version</span>
                        <strong>{{ $prediction->model_version ?? '—' }}</strong>
                    </div>

                    <div>
                        <span>Status</span>
                        <strong>
                            <span class="qf-pd-status">
                                {{ ucfirst($prediction->status) }}
                            </span>
                        </strong>
                    </div>

                    <div>
                        <span>Requested By</span>
                        <strong>{{ $prediction->requester?->name ?? 'Unknown' }}</strong>
                    </div>

                    <div>
                        <span>Completed At</span>
                        <strong>{{ $prediction->completed_at?->format('d M Y, h:i A') ?? '—' }}</strong>
                    </div>
                </div>
            </div>

            <div class="qf-pd-card">
                <h2>Quality Prediction Summary</h2>

                <div class="qf-pd-grid">
                    <div class="qf-pd-metric">
                        <span>Quality Score</span>
                        <strong>{{ number_format($qualityScore, 1) }}%</strong>
                        <small>Demo quality assessment</small>
                    </div>

                    <div class="qf-pd-metric">
                        <span>Predicted Defect Rate</span>
                        <strong>{{ number_format($defectRate, 1) }}%</strong>
                        <small>Illustrative defect rate</small>
                    </div>

                    <div class="qf-pd-metric">
                        <span>Predicted Defect Records</span>
                        <strong>{{ $defectRecords }}</strong>
                        <small>Out of {{ $totalRecords }} records</small>
                    </div>

                    <div class="qf-pd-metric">
                        <span>Risk Level</span>
                        <strong>{{ ucfirst($summary['risk_level'] ?? '—') }}</strong>
                        <small>Demo classification</small>
                    </div>
                </div>
            </div>

            <div class="qf-pd-card">
                <h2>Graphical Quality Analysis</h2>

                <div class="qf-pd-charts">

                    <div class="qf-pd-chart-box">
                        <h3>Quality Score</h3>

                        <div class="qf-pd-chart-value">
                            {{ number_format($qualityScore, 1) }}%
                        </div>

                        <progress
                            class="qf-pd-progress"
                            max="100"
                            value="{{ min(100, max(0, $qualityScore)) }}">
                        </progress>
                    </div>

                    <div class="qf-pd-chart-box">
                        <h3>Predicted Defect Distribution</h3>

                        <div class="qf-pd-donut-wrap">
                            <div class="qf-pd-donut"
                                style="--defect-rate: {{ min(100, max(0, $defectRate)) }}%;">
                                <div class="qf-pd-donut-label">
                                    {{ number_format($defectRate, 1) }}%
                                </div>
                            </div>

                            <div class="qf-pd-legend">
                                <div class="qf-pd-legend-item">
                                    <span class="qf-pd-dot"></span>
                                    Predicted Defects
                                </div>

                                <div class="qf-pd-legend-item">
                                    <span class="qf-pd-dot muted"></span>
                                    Remaining Records
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="qf-pd-card">
                <h2>Quality Recommendations</h2>

                @if (!empty($recommendations))
                <ul class="qf-pd-list">
                    @foreach ($recommendations as $recommendation)
                    <li>{{ $recommendation }}</li>
                    @endforeach
                </ul>
                @else
                <p class="qf-pd-empty">
                    No recommendations are available.
                </p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>