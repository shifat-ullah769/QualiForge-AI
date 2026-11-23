<x-app-layout>
    <div class="qf-dataset-details-page">
        <style>
            .qf-dataset-details-page {
                min-height: 100vh;
                padding: 32px;
                background: #07111f;
                color: #e5edf7;
            }

            .qf-details-container {
                max-width: 1150px;
                margin: 0 auto;
            }

            .qf-details-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 16px;
                flex-wrap: wrap;
                margin-bottom: 26px;
            }

            .qf-details-header h1 {
                margin: 0 0 7px;
                color: #f8fafc;
                font-size: 27px;
                font-weight: 700;
            }

            .qf-details-header p {
                margin: 0;
                color: #94a3b8;
                font-size: 13px;
            }

            .qf-details-back {
                color: #22d3ee;
                text-decoration: none;
                font-size: 13px;
                font-weight: 600;
            }

            .qf-details-back:hover {
                color: #67e8f9;
            }

            .qf-details-card {
                padding: 24px;
                margin-bottom: 20px;
                background: #101d2e;
                border: 1px solid #1e334a;
                border-radius: 14px;
            }

            .qf-details-card h2 {
                margin: 0 0 20px;
                padding-bottom: 14px;
                border-bottom: 1px solid #1e334a;
                color: #f1f5f9;
                font-size: 16px;
                font-weight: 650;
            }

            .qf-details-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 22px 30px;
            }

            .qf-details-field label {
                display: block;
                margin-bottom: 7px;
                color: #64748b;
                font-size: 11px;
                font-weight: 700;
                letter-spacing: 0.6px;
                text-transform: uppercase;
            }

            .qf-details-field p {
                margin: 0;
                color: #e2e8f0;
                font-size: 14px;
                overflow-wrap: anywhere;
            }

            .qf-details-status {
                display: inline-block;
                padding: 6px 11px;
                border-radius: 20px;
                font-size: 11px;
                font-weight: 650;
                text-transform: capitalize;
            }

            .qf-details-status.uploaded,
            .qf-details-status.pending {
                color: #67e8f9;
                background: rgba(8, 145, 178, 0.15);
            }

            .qf-details-status.validated,
            .qf-details-status.passed {
                color: #86efac;
                background: rgba(22, 163, 74, 0.15);
            }

            .qf-details-status.failed,
            .qf-details-status.error {
                color: #fca5a5;
                background: rgba(220, 38, 38, 0.15);
            }

            .qf-details-errors {
                padding: 16px;
                border-radius: 9px;
                background: rgba(220, 38, 38, 0.08);
                border: 1px solid rgba(220, 38, 38, 0.25);
                color: #fca5a5;
                font-size: 13px;
            }

            .qf-details-errors ul {
                margin: 10px 0 0;
                padding-left: 20px;
            }

            .qf-details-empty {
                color: #94a3b8;
                font-size: 13px;
            }

            @media (max-width: 640px) {
                .qf-dataset-details-page {
                    padding: 20px 12px;
                }

                .qf-details-grid {
                    grid-template-columns: 1fr;
                    gap: 18px;
                }

                .qf-details-card {
                    padding: 18px;
                }
            }
        </style>

        <div class="qf-details-container">

            <div class="qf-details-header">
                <div>
                    <h1>Dataset Details</h1>
                    <p>Review the uploaded dataset information and current status.</p>
                </div>

                <a href="{{ route('qe.datasets.index') }}" class="qf-details-back">
                    ← Back to Datasets
                </a>
            </div>

            <div class="qf-details-card">
                <h2>Dataset Information</h2>

                <div class="qf-details-grid">
                    <div class="qf-details-field">
                        <label>Dataset Name</label>
                        <p>{{ $dataset->name }}</p>
                    </div>

                    <div class="qf-details-field">
                        <label>Original Filename</label>
                        <p>{{ $dataset->original_filename }}</p>
                    </div>

                    <div class="qf-details-field">
                        <label>File Type</label>
                        <p>{{ strtoupper($dataset->file_extension) }}</p>
                    </div>

                    <div class="qf-details-field">
                        <label>File Size</label>
                        <p>
                            @if ($dataset->file_size_bytes < 1048576)
                                {{ number_format($dataset->file_size_bytes / 1024, 2) }} KB
                                @else
                                {{ number_format($dataset->file_size_bytes / 1048576, 2) }} MB
                                @endif
                        </p>
                    </div>

                    <div class="qf-details-field">
                        <label>Uploaded By</label>
                        <p>{{ $dataset->uploader?->name ?? 'Unknown' }}</p>
                    </div>

                    <div class="qf-details-field">
                        <label>Upload Date</label>
                        <p>{{ $dataset->created_at?->format('d M Y, h:i A') ?? '—' }}</p>
                    </div>
                </div>
            </div>

            <div class="qf-details-card">
                <h2>Production Information</h2>

                <div class="qf-details-grid">
                    <div class="qf-details-field">
                        <label>Factory</label>
                        <p>{{ $dataset->factory?->name ?? 'Not assigned' }}</p>
                    </div>

                    <div class="qf-details-field">
                        <label>Production Line</label>
                        <p>{{ $dataset->productionLine?->name ?? 'Not assigned' }}</p>
                    </div>

                    <div class="qf-details-field">
                        <label>Machine</label>
                        <p>{{ $dataset->machine?->name ?? 'Not assigned' }}</p>
                    </div>
                </div>
            </div>

            <div class="qf-details-card">
                <h2>Dataset Processing Status</h2>

                <div class="qf-details-grid">
                    <div class="qf-details-field">
                        <label>Upload Status</label>
                        @php
                        $uploadStatus = strtolower($dataset->status ?? 'unknown');
                        @endphp
                        <p>
                            <span class="qf-details-status {{ $uploadStatus }}">
                                {{ str_replace('_', ' ', $uploadStatus) }}
                            </span>
                        </p>
                    </div>

                    <div class="qf-details-field">
                        <label>Validation Status</label>
                        @php
                        $validationStatus = strtolower($dataset->validation_status ?? 'pending');
                        @endphp
                        <p>
                            <span class="qf-details-status {{ $validationStatus }}">
                                {{ str_replace('_', ' ', $validationStatus) }}
                            </span>
                        </p>
                    </div>

                    <div class="qf-details-field">
                        <label>Row Count</label>
                        <p>{{ $dataset->row_count ?? 'Not processed yet' }}</p>
                    </div>

                    <div class="qf-details-field">
                        <label>Column Count</label>
                        <p>{{ $dataset->column_count ?? 'Not processed yet' }}</p>
                    </div>

                    <div class="qf-details-field">
                        <label>Last Validated</label>
                        <p>{{ $dataset->validated_at?->format('d M Y, h:i A') ?? 'Not validated yet' }}</p>
                    </div>
                </div>
            </div>

            @if (!empty($dataset->validation_errors))
            <div class="qf-details-card">
                <h2>Validation Messages</h2>

                <div class="qf-details-errors">
                    <strong>Recorded validation information</strong>

                    <ul>
                        @foreach ($dataset->validation_errors as $error)
                        <li>
                            {{ is_array($error) ? json_encode($error) : $error }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @else
            <div class="qf-details-card">
                <h2>Validation Messages</h2>
                <p class="qf-details-empty">
                    No validation messages have been recorded.
                </p>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>