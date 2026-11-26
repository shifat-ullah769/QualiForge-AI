<x-app-layout>
    <div class="qm-dataset-detail">
        <style>
            .qm-dataset-detail {
                min-height: 100vh;
                padding: 32px;
                background: #07111f;
                color: #e5edf7;
            }

            .qm-detail-container {
                max-width: 1200px;
                margin: auto;
            }

            .qm-detail-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 15px;
                margin-bottom: 25px;
            }

            .qm-detail-eyebrow {
                color: #22d3ee;
                font-size: 10px;
                font-weight: 750;
                letter-spacing: 1.5px;
            }

            .qm-detail-header h1 {
                color: #f8fafc;
                font-size: 27px;
                font-weight: 750;
                margin: 8px 0 5px;
            }

            .qm-detail-header p {
                color: #94a3b8;
                font-size: 13px;
                margin: 0;
            }

            .qm-detail-back {
                color: #67e8f9;
                text-decoration: none;
                font-size: 13px;
                font-weight: 650;
            }

            .qm-detail-back:hover {
                color: #cffafe;
            }

            .qm-detail-readonly {
                display: inline-block;
                padding: 8px 12px;
                background: rgba(8,145,178,.12);
                border: 1px solid #155e75;
                color: #67e8f9;
                border-radius: 8px;
                font-size: 11px;
                font-weight: 700;
            }

            .qm-detail-hero {
                background: linear-gradient(120deg, #102b40, #101d2e);
                border: 1px solid #1e4560;
                border-radius: 15px;
                padding: 25px;
                margin-bottom: 20px;
            }

            .qm-detail-hero-label {
                color: #67e8f9;
                font-size: 10px;
                font-weight: 750;
                letter-spacing: 1px;
                margin-bottom: 9px;
            }

            .qm-detail-hero h2 {
                color: #f8fafc;
                font-size: 23px;
                font-weight: 750;
                overflow-wrap: anywhere;
                margin: 0 0 8px;
            }

            .qm-detail-hero p {
                color: #94a3b8;
                font-size: 12px;
                margin: 0;
                overflow-wrap: anywhere;
            }

            .qm-detail-metrics {
                display: grid;
                grid-template-columns: repeat(3, minmax(0,1fr));
                gap: 15px;
                margin-bottom: 22px;
            }

            .qm-detail-metric {
                background: #101d2e;
                border: 1px solid #1e334a;
                border-radius: 12px;
                padding: 19px;
            }

            .qm-detail-metric label {
                display: block;
                color: #94a3b8;
                font-size: 11px;
                font-weight: 650;
                margin-bottom: 9px;
            }

            .qm-detail-metric strong {
                display: block;
                color: #f8fafc;
                font-size: 23px;
                font-weight: 750;
            }

            .qm-detail-panel {
                background: #101d2e;
                border: 1px solid #1e334a;
                border-radius: 13px;
                padding: 23px;
                margin-bottom: 18px;
            }

            .qm-detail-panel h3 {
                color: #f1f5f9;
                font-size: 15px;
                font-weight: 700;
                padding-bottom: 14px;
                border-bottom: 1px solid #1e334a;
                margin: 0 0 20px;
            }

            .qm-detail-grid {
                display: grid;
                grid-template-columns: repeat(2,minmax(0,1fr));
                gap: 23px 30px;
            }

            .qm-detail-field label {
                display: block;
                color: #64748b;
                font-size: 10px;
                font-weight: 750;
                letter-spacing: .7px;
                text-transform: uppercase;
                margin-bottom: 7px;
            }

            .qm-detail-field p {
                color: #e2e8f0;
                font-size: 13px;
                margin: 0;
                overflow-wrap: anywhere;
            }

            .qm-detail-status {
                display: inline-block;
                padding: 6px 11px;
                border-radius: 20px;
                font-size: 10px;
                font-weight: 750;
                text-transform: capitalize;
            }

            .qm-detail-status.passed,
            .qm-detail-status.validated {
                background: rgba(22,163,74,.15);
                color: #86efac;
            }

            .qm-detail-status.failed,
            .qm-detail-status.error {
                background: rgba(220,38,38,.15);
                color: #fca5a5;
            }

            .qm-detail-status.pending,
            .qm-detail-status.uploaded {
                background: rgba(8,145,178,.15);
                color: #67e8f9;
            }

            .qm-validation-errors {
                background: rgba(220,38,38,.08);
                border: 1px solid rgba(220,38,38,.25);
                border-radius: 9px;
                padding: 17px;
                color: #fca5a5;
                font-size: 12px;
            }

            .qm-validation-errors ul {
                padding-left: 20px;
                margin: 10px 0 0;
            }

            .qm-no-errors {
                color: #94a3b8;
                font-size: 12px;
                margin: 0;
            }

            @media(max-width: 700px) {
                .qm-dataset-detail {
                    padding: 20px 12px;
                }

                .qm-detail-metrics {
                    grid-template-columns: 1fr;
                }

                .qm-detail-grid {
                    grid-template-columns: 1fr;
                    gap: 18px;
                }
            }
        </style>

        @php
            $uploadStatus = strtolower($dataset->status ?? 'unknown');
            $validationStatus = strtolower($dataset->validation_status ?? 'pending');
        @endphp

        <div class="qm-detail-container">

            <div class="qm-detail-header">
                <div>
                    <div class="qm-detail-eyebrow">
                        QUALITY INTELLIGENCE / DATA REVIEW
                    </div>
                    <h1>Dataset Assessment</h1>
                    <p>Detailed review of a company manufacturing data asset.</p>
                </div>

                <a href="{{ route('qm.datasets.index') }}"
                   class="qm-detail-back">
                    ← Dataset Overview
                </a>
            </div>

            <div class="qm-detail-hero">
                <div class="qm-detail-hero-label">
                    DATASET IDENTIFICATION
                </div>

                <h2>{{ $dataset->name }}</h2>

                <p>{{ $dataset->original_filename }}</p>

                <div style="margin-top:16px;">
                    <span class="qm-detail-readonly">
                        READ-ONLY REVIEW
                    </span>
                </div>
            </div>

            <div class="qm-detail-metrics">

                <div class="qm-detail-metric">
                    <label>Dataset Rows</label>
                    <strong>{{ $dataset->row_count ?? '—' }}</strong>
                </div>

                <div class="qm-detail-metric">
                    <label>Dataset Columns</label>
                    <strong>{{ $dataset->column_count ?? '—' }}</strong>
                </div>

                <div class="qm-detail-metric">
                    <label>File Size</label>
                    <strong>
                        @if($dataset->file_size_bytes !== null)
                            @if($dataset->file_size_bytes < 1048576)
                                {{ number_format($dataset->file_size_bytes / 1024, 2) }} KB
                            @else
                                {{ number_format($dataset->file_size_bytes / 1048576, 2) }} MB
                            @endif
                        @else
                            —
                        @endif
                    </strong>
                </div>

            </div>

            <div class="qm-detail-panel">
                <h3>Dataset Information</h3>

                <div class="qm-detail-grid">

                    <div class="qm-detail-field">
                        <label>Dataset Name</label>
                        <p>{{ $dataset->name }}</p>
                    </div>

                    <div class="qm-detail-field">
                        <label>Original Filename</label>
                        <p>{{ $dataset->original_filename }}</p>
                    </div>

                    <div class="qm-detail-field">
                        <label>File Type</label>
                        <p>{{ strtoupper($dataset->file_extension ?? 'Unknown') }}</p>
                    </div>

                    <div class="qm-detail-field">
                        <label>Uploaded By</label>
                        <p>{{ $dataset->uploader?->name ?? 'Unknown' }}</p>
                    </div>

                    <div class="qm-detail-field">
                        <label>Upload Date</label>
                        <p>{{ $dataset->created_at?->format('d M Y, h:i A') ?? '—' }}</p>
                    </div>

                    <div class="qm-detail-field">
                        <label>Last Updated</label>
                        <p>{{ $dataset->updated_at?->format('d M Y, h:i A') ?? '—' }}</p>
                    </div>

                </div>
            </div>

            <div class="qm-detail-panel">
                <h3>Manufacturing Coverage</h3>

                <div class="qm-detail-grid">

                    <div class="qm-detail-field">
                        <label>Factory</label>
                        <p>{{ $dataset->factory?->name ?? 'Not assigned' }}</p>
                    </div>

                    <div class="qm-detail-field">
                        <label>Production Line</label>
                        <p>{{ $dataset->productionLine?->name ?? 'Not assigned' }}</p>
                    </div>

                    <div class="qm-detail-field">
                        <label>Machine</label>
                        <p>{{ $dataset->machine?->name ?? 'Not assigned' }}</p>
                    </div>

                </div>
            </div>

            <div class="qm-detail-panel">
                <h3>Processing & Validation Assessment</h3>

                <div class="qm-detail-grid">

                    <div class="qm-detail-field">
                        <label>Upload Status</label>
                        <p>
                            <span class="qm-detail-status {{ $uploadStatus }}">
                                {{ str_replace('_', ' ', $uploadStatus) }}
                            </span>
                        </p>
                    </div>

                    <div class="qm-detail-field">
                        <label>Validation Status</label>
                        <p>
                            <span class="qm-detail-status {{ $validationStatus }}">
                                {{ str_replace('_', ' ', $validationStatus) }}
                            </span>
                        </p>
                    </div>

                    <div class="qm-detail-field">
                        <label>Last Validated</label>
                        <p>{{ $dataset->validated_at?->format('d M Y, h:i A') ?? 'Not validated yet' }}</p>
                    </div>

                </div>
            </div>

            <div class="qm-detail-panel">
                <h3>Validation Messages</h3>

                @if(!empty($dataset->validation_errors))

                    <div class="qm-validation-errors">
                        <strong>Recorded validation information</strong>

                        <ul>
                            @foreach($dataset->validation_errors as $field => $errors)
                                @if(is_array($errors))
                                    @foreach($errors as $error)
                                        <li>
                                            <strong>{{ ucfirst($field) }}:</strong>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                @else
                                    <li>{{ $errors }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                @else

                    <p class="qm-no-errors">
                        No validation messages have been recorded.
                    </p>

                @endif
            </div>

        </div>
    </div>
</x-app-layout>
