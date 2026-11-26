<x-app-layout>
    <div class="qm-dataset-page">
        <style>
            .qm-dataset-page {
                min-height: 100vh;
                padding: 32px;
                background: #07111f;
                color: #e5edf7;
            }

            .qm-dataset-container {
                max-width: 1450px;
                margin: auto;
            }

            .qm-dataset-header {
                display: flex;
                justify-content: space-between;
                align-items: flex-end;
                flex-wrap: wrap;
                gap: 18px;
                margin-bottom: 30px;
            }

            .qm-dataset-eyebrow {
                color: #22d3ee;
                font-size: 11px;
                font-weight: 750;
                letter-spacing: 1.5px;
            }

            .qm-dataset-header h1 {
                margin: 8px 0;
                color: #f8fafc;
                font-size: 29px;
                font-weight: 750;
            }

            .qm-dataset-header p {
                color: #94a3b8;
                font-size: 13px;
                margin: 0;
            }

            .qm-readonly-label {
                border: 1px solid #155e75;
                background: rgba(8,145,178,.12);
                color: #67e8f9;
                padding: 9px 14px;
                border-radius: 9px;
                font-size: 12px;
                font-weight: 650;
            }

            .qm-dataset-summary {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 16px;
                margin-bottom: 25px;
            }

            .qm-summary-card {
                background: #101d2e;
                border: 1px solid #1e334a;
                border-radius: 13px;
                padding: 20px;
                position: relative;
                overflow: hidden;
            }

            .qm-summary-card::after {
                content: "";
                position: absolute;
                left: 0;
                top: 0;
                width: 3px;
                height: 100%;
                background: var(--accent);
            }

            .qm-summary-label {
                color: #94a3b8;
                font-size: 12px;
                font-weight: 600;
            }

            .qm-summary-value {
                color: #f8fafc;
                font-size: 29px;
                font-weight: 750;
                margin: 10px 0 4px;
            }

            .qm-summary-note {
                color: #64748b;
                font-size: 11px;
            }

            .qm-dataset-panel {
                background: #101d2e;
                border: 1px solid #1e334a;
                border-radius: 14px;
                overflow: hidden;
            }

            .qm-panel-heading {
                padding: 21px 24px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 12px;
                border-bottom: 1px solid #1e334a;
            }

            .qm-panel-heading h2 {
                color: #f1f5f9;
                font-size: 17px;
                font-weight: 700;
                margin: 0 0 5px;
            }

            .qm-panel-heading p {
                color: #94a3b8;
                font-size: 12px;
                margin: 0;
            }

            .qm-dataset-count {
                color: #67e8f9;
                font-size: 12px;
                font-weight: 650;
            }

            .qm-table-wrap {
                overflow-x: auto;
            }

            .qm-dataset-table {
                width: 100%;
                min-width: 900px;
                border-collapse: collapse;
            }

            .qm-dataset-table th {
                background: #0c1929;
                color: #94a3b8;
                text-align: left;
                padding: 14px 18px;
                font-size: 10px;
                text-transform: uppercase;
                letter-spacing: .7px;
                white-space: nowrap;
            }

            .qm-dataset-table td {
                padding: 17px 18px;
                border-top: 1px solid #1e334a;
                color: #cbd5e1;
                font-size: 12px;
                vertical-align: middle;
            }

            .qm-dataset-table tbody tr:hover {
                background: rgba(30,51,74,.3);
            }

            .qm-dataset-title {
                color: #f1f5f9;
                font-weight: 650;
                margin-bottom: 4px;
            }

            .qm-dataset-file {
                color: #64748b;
                font-size: 10px;
            }

            .qm-status {
                display: inline-block;
                padding: 5px 9px;
                border-radius: 20px;
                font-size: 10px;
                font-weight: 700;
                text-transform: capitalize;
            }

            .qm-status-uploaded {
                color: #67e8f9;
                background: rgba(8,145,178,.15);
            }

            .qm-status-passed {
                color: #86efac;
                background: rgba(22,163,74,.15);
            }

            .qm-status-pending {
                color: #fcd34d;
                background: rgba(217,119,6,.15);
            }

            .qm-status-failed {
                color: #fca5a5;
                background: rgba(220,38,38,.15);
            }

            .qm-view-link {
                color: #22d3ee;
                text-decoration: none;
                font-weight: 700;
                white-space: nowrap;
            }

            .qm-view-link:hover {
                color: #a5f3fc;
            }

            .qm-empty {
                text-align: center;
                padding: 55px 20px;
                color: #94a3b8;
            }

            .qm-empty h3 {
                color: #f1f5f9;
                font-size: 17px;
                margin-bottom: 7px;
            }

            .qm-pagination {
                padding: 18px 22px;
                border-top: 1px solid #1e334a;
            }

            .qm-pagination nav p {
                color: #94a3b8;
            }

            @media(max-width: 900px) {
                .qm-dataset-summary {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }

            @media(max-width: 600px) {
                .qm-dataset-page {
                    padding: 20px 12px;
                }

                .qm-dataset-summary {
                    grid-template-columns: 1fr;
                }

                .qm-dataset-header h1 {
                    font-size: 24px;
                }
            }
        </style>

        <div class="qm-dataset-container">

            <div class="qm-dataset-header">
                <div>
                    <div class="qm-dataset-eyebrow">
                        QUALITY INTELLIGENCE / DATA ASSETS
                    </div>
                    <h1>Dataset Intelligence</h1>
                    <p>
                        Monitor dataset availability, validation health and
                        manufacturing data coverage across your company.
                    </p>
                </div>

                <div class="qm-readonly-label">
                    Read-only Monitoring
                </div>
            </div>

            <div class="qm-dataset-summary">

                <div class="qm-summary-card" style="--accent:#22d3ee;">
                    <div class="qm-summary-label">Total Datasets</div>
                    <div class="qm-summary-value">{{ $totalDatasets }}</div>
                    <div class="qm-summary-note">Company data assets</div>
                </div>

                <div class="qm-summary-card" style="--accent:#4ade80;">
                    <div class="qm-summary-label">Validated</div>
                    <div class="qm-summary-value">{{ $validatedDatasets }}</div>
                    <div class="qm-summary-note">Passed validation</div>
                </div>

                <div class="qm-summary-card" style="--accent:#fbbf24;">
                    <div class="qm-summary-label">Pending</div>
                    <div class="qm-summary-value">{{ $pendingDatasets }}</div>
                    <div class="qm-summary-note">Awaiting validation</div>
                </div>

                <div class="qm-summary-card" style="--accent:#f87171;">
                    <div class="qm-summary-label">Failed</div>
                    <div class="qm-summary-value">{{ $failedDatasets }}</div>
                    <div class="qm-summary-note">Validation failures</div>
                </div>

            </div>

            <div class="qm-dataset-panel">

                <div class="qm-panel-heading">
                    <div>
                        <h2>Company Dataset Registry</h2>
                        <p>
                            Review manufacturing datasets and their current
                            validation status.
                        </p>
                    </div>

                    <div class="qm-dataset-count">
                        {{ $datasets->total() }} DATA ASSETS
                    </div>
                </div>

                @if($datasets->count())

                    <div class="qm-table-wrap">
                        <table class="qm-dataset-table">
                            <thead>
                                <tr>
                                    <th>Dataset</th>
                                    <th>Factory</th>
                                    <th>Production Line</th>
                                    <th>Machine</th>
                                    <th>Rows</th>
                                    <th>Validation</th>
                                    <th>Uploaded</th>
                                    <th>Review</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($datasets as $dataset)
                                    @php
                                        $validation = strtolower(
                                            $dataset->validation_status ?? 'pending'
                                        );

                                        $statusClass = match($validation) {
                                            'passed' => 'qm-status-passed',
                                            'failed' => 'qm-status-failed',
                                            default => 'qm-status-pending',
                                        };
                                    @endphp

                                    <tr>
                                        <td>
                                            <div class="qm-dataset-title">
                                                {{ $dataset->name }}
                                            </div>
                                            <div class="qm-dataset-file">
                                                {{ $dataset->original_filename }}
                                            </div>
                                        </td>

                                        <td>{{ $dataset->factory?->name ?? '—' }}</td>

                                        <td>{{ $dataset->productionLine?->name ?? '—' }}</td>

                                        <td>{{ $dataset->machine?->name ?? '—' }}</td>

                                        <td>{{ $dataset->row_count ?? '—' }}</td>

                                        <td>
                                            <span class="qm-status {{ $statusClass }}">
                                                {{ str_replace('_', ' ', $validation) }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $dataset->created_at?->format('d M Y') ?? '—' }}
                                        </td>

                                        <td>
                                            <a class="qm-view-link"
                                               href="{{ route('qm.datasets.show', $dataset->id) }}">
                                                Review Details →
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="qm-pagination">
                        {{ $datasets->links() }}
                    </div>

                @else

                    <div class="qm-empty">
                        <h3>No Dataset Records</h3>
                        <p>No manufacturing datasets are currently available for monitoring.</p>
                    </div>

                @endif

            </div>
        </div>
    </div>
</x-app-layout>
