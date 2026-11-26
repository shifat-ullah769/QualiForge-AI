<x-app-layout>
    <div class="qm-prediction-page">
        <style>
            .qm-prediction-page {
                min-height: 100vh;
                padding: 32px;
                background: #07111f;
                color: #e5edf7;
            }

            .qm-prediction-container {
                max-width: 1450px;
                margin: auto;
            }

            .qm-prediction-header {
                display: flex;
                justify-content: space-between;
                align-items: flex-end;
                flex-wrap: wrap;
                gap: 18px;
                margin-bottom: 27px;
            }

            .qm-prediction-eyebrow {
                color: #22d3ee;
                font-size: 10px;
                font-weight: 750;
                letter-spacing: 1.5px;
            }

            .qm-prediction-header h1 {
                color: #f8fafc;
                font-size: 29px;
                font-weight: 750;
                margin: 8px 0;
            }

            .qm-prediction-header p {
                color: #94a3b8;
                font-size: 13px;
                margin: 0;
            }

            .qm-monitoring-label {
                padding: 9px 13px;
                border: 1px solid #155e75;
                background: rgba(8, 145, 178, .12);
                color: #67e8f9;
                border-radius: 9px;
                font-size: 11px;
                font-weight: 700;
            }

            .qm-prediction-kpis {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 15px;
                margin-bottom: 22px;
            }

            .qm-prediction-kpi {
                background: #101d2e;
                border: 1px solid #1e334a;
                border-radius: 13px;
                padding: 20px;
            }

            .qm-prediction-kpi label {
                color: #94a3b8;
                font-size: 11px;
                font-weight: 650;
            }

            .qm-prediction-kpi strong {
                display: block;
                margin: 10px 0 5px;
                color: #f8fafc;
                font-size: 29px;
                font-weight: 750;
            }

            .qm-prediction-kpi small {
                color: #64748b;
                font-size: 10px;
            }

            .qm-prediction-insight {
                display: grid;
                grid-template-columns: minmax(0, 1.1fr) minmax(0, 2fr);
                gap: 16px;
                margin-bottom: 23px;
            }

            .qm-insight-card {
                background: #101d2e;
                border: 1px solid #1e334a;
                border-radius: 13px;
                padding: 21px;
            }

            .qm-insight-card h3 {
                color: #f1f5f9;
                font-size: 14px;
                font-weight: 700;
                margin: 0 0 18px;
            }

            .qm-status-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 12px;
                margin-bottom: 15px;
                font-size: 12px;
            }

            .qm-status-row:last-child {
                margin-bottom: 0;
            }

            .qm-status-name {
                color: #cbd5e1;
            }

            .qm-status-number {
                color: #f8fafc;
                font-weight: 750;
            }

            .qm-progress-track {
                height: 7px;
                margin-top: 7px;
                background: #1e334a;
                border-radius: 20px;
                overflow: hidden;
            }

            .qm-progress-fill {
                height: 100%;
                border-radius: 20px;
            }

            .qm-demo-notice {
                border: 1px solid rgba(217, 119, 6, .3);
                background: rgba(217, 119, 6, .09);
                color: #fcd34d;
                padding: 15px 17px;
                border-radius: 10px;
                font-size: 11px;
                line-height: 1.6;
                margin-bottom: 22px;
            }

            .qm-history-panel {
                background: #101d2e;
                border: 1px solid #1e334a;
                border-radius: 14px;
                overflow: hidden;
            }

            .qm-history-heading {
                padding: 21px 23px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 12px;
                border-bottom: 1px solid #1e334a;
            }

            .qm-history-heading h2 {
                color: #f1f5f9;
                font-size: 16px;
                font-weight: 700;
                margin: 0 0 5px;
            }

            .qm-history-heading p {
                color: #94a3b8;
                font-size: 11px;
                margin: 0;
            }

            .qm-history-count {
                color: #67e8f9;
                font-size: 11px;
                font-weight: 750;
            }

            .qm-prediction-table-wrap {
                overflow-x: auto;
            }

            .qm-prediction-table {
                width: 100%;
                min-width: 850px;
                border-collapse: collapse;
            }

            .qm-prediction-table th {
                padding: 14px 17px;
                background: #0c1929;
                color: #94a3b8;
                text-align: left;
                font-size: 10px;
                font-weight: 700;
                letter-spacing: .6px;
                text-transform: uppercase;
                white-space: nowrap;
            }

            .qm-prediction-table td {
                padding: 17px;
                border-top: 1px solid #1e334a;
                color: #cbd5e1;
                font-size: 12px;
                vertical-align: middle;
            }

            .qm-prediction-table tbody tr:hover {
                background: rgba(30, 51, 74, .3);
            }

            .qm-prediction-id {
                color: #67e8f9;
                font-weight: 750;
            }

            .qm-prediction-dataset {
                color: #f1f5f9;
                font-weight: 650;
                margin-bottom: 4px;
            }

            .qm-prediction-meta {
                color: #64748b;
                font-size: 10px;
            }

            .qm-prediction-status {
                display: inline-block;
                padding: 5px 10px;
                border-radius: 20px;
                font-size: 10px;
                font-weight: 750;
                text-transform: capitalize;
            }

            .qm-prediction-status.completed {
                color: #86efac;
                background: rgba(22, 163, 74, .15);
            }

            .qm-prediction-status.failed {
                color: #fca5a5;
                background: rgba(220, 38, 38, .15);
            }

            .qm-prediction-status.running,
            .qm-prediction-status.queued,
            .qm-prediction-status.processing {
                color: #67e8f9;
                background: rgba(8, 145, 178, .15);
            }

            .qm-prediction-view {
                color: #22d3ee;
                text-decoration: none;
                font-weight: 700;
                white-space: nowrap;
            }

            .qm-prediction-view:hover {
                color: #a5f3fc;
            }

            .qm-prediction-empty {
                padding: 55px 20px;
                text-align: center;
                color: #94a3b8;
                font-size: 12px;
            }

            .qm-prediction-empty strong {
                display: block;
                color: #f1f5f9;
                font-size: 16px;
                margin-bottom: 8px;
            }

            .qm-prediction-pagination {
                padding: 18px 22px;
                border-top: 1px solid #1e334a;
            }

            .qm-prediction-pagination nav p {
                color: #94a3b8;
            }

            @media(max-width: 950px) {
                .qm-prediction-kpis {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .qm-prediction-insight {
                    grid-template-columns: 1fr;
                }
            }

            @media(max-width: 600px) {
                .qm-prediction-page {
                    padding: 20px 12px;
                }

                .qm-prediction-kpis {
                    grid-template-columns: 1fr;
                }
            }
        </style>

        <div class="qm-prediction-container">

            <div class="qm-prediction-header">
                <div>
                    <div class="qm-prediction-eyebrow">
                        QUALITY INTELLIGENCE / PREDICTION OVERSIGHT
                    </div>
                    <h1>Prediction Intelligence</h1>
                    <p>
                        Monitor prediction activity, execution status and
                        company-wide prediction records.
                    </p>
                </div>

                <div class="qm-monitoring-label">
                    READ-ONLY MONITORING
                </div>
            </div>

            <div class="qm-prediction-kpis">

                <div class="qm-prediction-kpi">
                    <label>Total Predictions</label>
                    <strong>{{ $totalPredictions }}</strong>
                    <small>Recorded prediction jobs</small>
                </div>

                <div class="qm-prediction-kpi">
                    <label>Completed</label>
                    <strong>{{ $completedPredictions }}</strong>
                    <small>Successfully completed jobs</small>
                </div>

                <div class="qm-prediction-kpi">
                    <label>Failed</label>
                    <strong>{{ $failedPredictions }}</strong>
                    <small>Jobs recorded as failed</small>
                </div>

                <div class="qm-prediction-kpi">
                    <label>Running</label>
                    <strong>{{ $runningPredictions }}</strong>
                    <small>Jobs currently marked running</small>
                </div>

            </div>

            <div class="qm-prediction-insight">

                <div class="qm-insight-card">
                    <h3>Execution Status Distribution</h3>

                    @php
                    $statusGroups = [
                    ['label' => 'Completed', 'count' => $completedPredictions, 'color' => '#4ade80'],
                    ['label' => 'Failed', 'count' => $failedPredictions, 'color' => '#f87171'],
                    ['label' => 'Running', 'count' => $runningPredictions, 'color' => '#22d3ee'],
                    ];
                    @endphp

                    @foreach($statusGroups as $item)
                    @php
                    $percentage = $totalPredictions > 0
                    ? ($item['count'] / $totalPredictions) * 100
                    : 0;
                    @endphp

                    <div style="margin-bottom:17px;">
                        <div class="qm-status-row">
                            <span class="qm-status-name">{{ $item['label'] }}</span>
                            <span class="qm-status-number">
                                {{ $item['count'] }} ({{ number_format($percentage, 1) }}%)
                            </span>
                        </div>

                        <div class="qm-progress-track">
                            <div class="qm-progress-fill"
                                @style([ 'width'=> $percentage . '%',
                                'background-color' => $item['color'],
                                ])
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="qm-insight-card">
                    <h3>Monitoring Overview</h3>

                    <p style="color:#94a3b8;font-size:12px;line-height:1.9;margin:0;">
                        This section provides a consolidated view of prediction
                        execution records associated with your company.
                        Completed, failed and running counts are calculated
                        directly from the recorded prediction statuses.
                    </p>

                    <div style="margin-top:18px;padding:13px;border-radius:9px;background:#0c1929;border:1px solid #1e334a;">
                        <div style="color:#64748b;font-size:10px;margin-bottom:5px;">
                            COMPANY PREDICTION RECORDS
                        </div>
                        <div style="color:#67e8f9;font-size:21px;font-weight:750;">
                            {{ $totalPredictions }}
                        </div>
                    </div>
                </div>

            </div>

            <div class="qm-demo-notice">
                <strong>Demo Environment Disclosure:</strong>
                Prediction records and outputs currently belong to the
                QualiForge-AI demonstration engine. They should not be
                interpreted as results from a production-trained machine
                learning model.
            </div>

            <div class="qm-history-panel">

                <div class="qm-history-heading">
                    <div>
                        <h2>Prediction Activity Registry</h2>
                        <p>Review prediction execution history and associated datasets.</p>
                    </div>

                    <div class="qm-history-count">
                        {{ $predictions->total() }} RECORDS
                    </div>
                </div>

                @if($predictions->count())

                <div class="qm-prediction-table-wrap">
                    <table class="qm-prediction-table">
                        <thead>
                            <tr>
                                <th>Prediction</th>
                                <th>Dataset</th>
                                <th>Requested By</th>
                                <th>Model Version</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Review</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($predictions as $prediction)
                            <tr>
                                <td>
                                    <span class="qm-prediction-id">
                                        #{{ $prediction->id }}
                                    </span>
                                </td>

                                <td>
                                    <div class="qm-prediction-dataset">
                                        {{ $prediction->dataset?->name ?? 'Dataset unavailable' }}
                                    </div>
                                </td>

                                <td>
                                    {{ $prediction->requester?->name ?? 'Unknown' }}
                                </td>

                                <td>
                                    {{ $prediction->model_version ?? '—' }}
                                </td>

                                <td>
                                    <span class="qm-prediction-status {{ strtolower($prediction->status ?? 'unknown') }}">
                                        {{ str_replace('_', ' ', $prediction->status ?? 'unknown') }}
                                    </span>
                                </td>

                                <td>
                                    {{ $prediction->created_at?->format('d M Y, h:i A') ?? '—' }}
                                </td>

                                <td>
                                    <a class="qm-prediction-view"
                                        href="{{ route('qm.predictions.show', $prediction->id) }}">
                                        Review Details →
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="qm-prediction-pagination">
                    {{ $predictions->links() }}
                </div>

                @else

                <div class="qm-prediction-empty">
                    <strong>No Prediction Records</strong>
                    Prediction activity will appear here when prediction records
                    are available for your company.
                </div>

                @endif

            </div>
        </div>
    </div>
</x-app-layout>