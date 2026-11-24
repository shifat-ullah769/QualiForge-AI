<x-app-layout>
    <div class="qf-predictions-page">
        <style>
            .qf-predictions-page {
                min-height: 100vh;
                padding: 32px;
                background: #07111f;
                color: #e5edf7;
            }

            .qf-predictions-container {
                max-width: 1250px;
                margin: 0 auto;
            }

            .qf-predictions-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 16px;
                flex-wrap: wrap;
                margin-bottom: 28px;
            }

            .qf-predictions-header h1 {
                margin: 0 0 7px;
                color: #f8fafc;
                font-size: 27px;
                font-weight: 700;
            }

            .qf-predictions-header p {
                margin: 0;
                color: #94a3b8;
                font-size: 13px;
            }

            .qf-predictions-back {
                color: #22d3ee;
                text-decoration: none;
                font-size: 13px;
                font-weight: 600;
            }

            .qf-predictions-card {
                padding: 24px;
                background: #101d2e;
                border: 1px solid #1e334a;
                border-radius: 14px;
            }

            .qf-predictions-card h2 {
                margin: 0 0 20px;
                color: #f1f5f9;
                font-size: 16px;
                font-weight: 650;
            }

            .qf-predictions-summary {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 12px;
                flex-wrap: wrap;
                margin-bottom: 22px;
            }

            .qf-predictions-count {
                color: #94a3b8;
                font-size: 13px;
            }

            .qf-predictions-count strong {
                color: #22d3ee;
                font-size: 20px;
                margin-left: 5px;
            }

            .qf-predictions-table-wrap {
                overflow-x: auto;
            }

            .qf-predictions-table {
                width: 100%;
                border-collapse: collapse;
                min-width: 750px;
            }

            .qf-predictions-table th {
                padding: 13px 14px;
                background: #0b1727;
                color: #64748b;
                font-size: 10px;
                font-weight: 700;
                letter-spacing: 0.6px;
                text-align: left;
                text-transform: uppercase;
                white-space: nowrap;
            }

            .qf-predictions-table td {
                padding: 16px 14px;
                border-bottom: 1px solid #1e334a;
                color: #cbd5e1;
                font-size: 12px;
            }

            .qf-predictions-table tr:last-child td {
                border-bottom: none;
            }

            .qf-predictions-name {
                color: #f1f5f9;
                font-weight: 650;
            }

            .qf-prediction-status {
                display: inline-block;
                padding: 6px 10px;
                border-radius: 20px;
                font-size: 10px;
                font-weight: 700;
                text-transform: capitalize;
            }

            .qf-prediction-status.completed {
                color: #86efac;
                background: rgba(22, 163, 74, 0.15);
            }

            .qf-prediction-status.failed {
                color: #fca5a5;
                background: rgba(220, 38, 38, 0.15);
            }

            .qf-prediction-status.queued,
            .qf-prediction-status.processing {
                color: #67e8f9;
                background: rgba(8, 145, 178, 0.15);
            }

            .qf-prediction-view {
                color: #22d3ee;
                font-weight: 650;
                text-decoration: none;
                white-space: nowrap;
            }

            .qf-prediction-view:hover {
                color: #67e8f9;
            }

            .qf-predictions-empty {
                padding: 45px 15px;
                text-align: center;
                color: #94a3b8;
            }

            .qf-predictions-empty strong {
                display: block;
                margin-bottom: 8px;
                color: #e2e8f0;
                font-size: 15px;
            }

            .qf-predictions-pagination {
                margin-top: 22px;
            }

            .qf-predictions-alert {
                padding: 13px 16px;
                margin-bottom: 18px;
                border-radius: 9px;
                background: rgba(22, 163, 74, 0.10);
                border: 1px solid rgba(22, 163, 74, 0.25);
                color: #86efac;
                font-size: 13px;
            }

            @media (max-width: 640px) {
                .qf-predictions-page {
                    padding: 20px 12px;
                }

                .qf-predictions-card {
                    padding: 16px;
                }
            }
        </style>

        <div class="qf-predictions-container">

            <div class="qf-predictions-header">
                <div>
                    <h1>Prediction Management</h1>
                    <p>Review and monitor your company's prediction history.</p>
                </div>

                <a href="{{ route('qe.datasets.index') }}"
                   class="qf-predictions-back">
                    ← Back to Datasets
                </a>
            </div>

            @if (session('success'))
                <div class="qf-predictions-alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="qf-predictions-alert"
                     style="background:rgba(220,38,38,.10);border-color:rgba(220,38,38,.25);color:#fca5a5;">
                    {{ session('error') }}
                </div>
            @endif

            <div class="qf-predictions-card">
                <div class="qf-predictions-summary">
                    <h2>Prediction History</h2>

                    <div class="qf-predictions-count">
                        Total Predictions:
                        <strong>{{ $predictions->total() }}</strong>
                    </div>
                </div>

                @if ($predictions->count() > 0)

                    <div class="qf-predictions-table-wrap">
                        <table class="qf-predictions-table">
                            <thead>
                                <tr>
                                    <th>Prediction ID</th>
                                    <th>Dataset</th>
                                    <th>Requested By</th>
                                    <th>Model Version</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($predictions as $prediction)
                                    <tr>
                                        <td>#{{ $prediction->id }}</td>

                                        <td class="qf-predictions-name">
                                            {{ $prediction->dataset?->name ?? 'Dataset unavailable' }}
                                        </td>

                                        <td>
                                            {{ $prediction->requester?->name ?? 'Unknown' }}
                                        </td>

                                        <td>
                                            {{ $prediction->model_version ?? '—' }}
                                        </td>

                                        <td>
                                            <span class="qf-prediction-status {{ strtolower($prediction->status) }}">
                                                {{ str_replace('_', ' ', $prediction->status) }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $prediction->created_at?->format('d M Y, h:i A') ?? '—' }}
                                        </td>

                                        <td>
                                            <a href="{{ route('qe.predictions.show', $prediction->id) }}"
                                               class="qf-prediction-view">
                                                View Details →
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="qf-predictions-pagination">
                        {{ $predictions->links() }}
                    </div>

                @else

                    <div class="qf-predictions-empty">
                        <strong>No Predictions Yet</strong>
                        Prediction records will appear here after you run a prediction on a validated dataset.
                    </div>

                @endif
            </div>

        </div>
    </div>
</x-app-layout>
