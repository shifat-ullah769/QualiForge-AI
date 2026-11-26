<x-app-layout>
    <div class="qm-defect-detail-page">
        <style>
            .qm-defect-detail-page {
                min-height: 100vh;
                padding: 30px;
                background: #07111f;
                color: #e5edf7;
            }

            .qm-dd-container {
                max-width: 1250px;
                margin: auto;
            }

            .qm-dd-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 18px;
                flex-wrap: wrap;
                margin-bottom: 24px;
            }

            .qm-dd-eyebrow {
                color: #22d3ee;
                font-size: 10px;
                font-weight: 800;
                letter-spacing: 1.4px;
            }

            .qm-dd-header h1 {
                margin: 8px 0;
                color: #f8fafc;
                font-size: 26px;
                font-weight: 750;
            }

            .qm-dd-header p {
                color: #94a3b8;
                font-size: 13px;
            }

            .qm-dd-actions {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
            }

            .qm-dd-btn {
                display: inline-block;
                padding: 10px 15px;
                border: 1px solid #164e63;
                border-radius: 7px;
                background: #0e7490;
                color: white;
                text-decoration: none;
                font-size: 11px;
                font-weight: 750;
            }

            .qm-dd-btn.secondary {
                border-color: #334155;
                background: #172b40;
                color: #cbd5e1;
            }

            .qm-dd-readonly {
                padding: 13px 16px;
                margin-bottom: 20px;
                border: 1px solid rgba(34, 211, 238, .3);
                border-radius: 9px;
                background: rgba(8, 145, 178, .08);
                color: #67e8f9;
                font-size: 11px;
                font-weight: 700;
            }

            .qm-dd-panel {
                padding: 23px;
                margin-bottom: 19px;
                border: 1px solid #20364e;
                border-radius: 12px;
                background: #101d2e;
            }

            .qm-dd-panel h2 {
                margin: 0 0 20px;
                color: #f1f5f9;
                font-size: 15px;
                font-weight: 750;
            }

            .qm-dd-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 14px;
            }

            .qm-dd-item {
                padding: 15px;
                border: 1px solid #20364e;
                border-radius: 9px;
                background: #0b1727;
                min-width: 0;
            }

            .qm-dd-item span {
                display: block;
                margin-bottom: 8px;
                color: #7f9ab5;
                font-size: 10px;
                font-weight: 700;
                letter-spacing: .5px;
                text-transform: uppercase;
            }

            .qm-dd-item strong {
                color: #e2e8f0;
                font-size: 13px;
                overflow-wrap: anywhere;
            }

            .qm-dd-badge {
                display: inline-block;
                padding: 5px 10px;
                border-radius: 20px;
                font-size: 10px;
                font-weight: 800;
                text-transform: uppercase;
            }

            .qm-dd-critical {
                background: rgba(239, 68, 68, .14);
                color: #fca5a5;
            }

            .qm-dd-high {
                background: rgba(249, 115, 22, .14);
                color: #fdba74;
            }

            .qm-dd-medium {
                background: rgba(234, 179, 8, .14);
                color: #fde047;
            }

            .qm-dd-low {
                background: rgba(34, 197, 94, .14);
                color: #86efac;
            }

            .qm-dd-open {
                background: rgba(239, 68, 68, .12);
                color: #fca5a5;
            }

            .qm-dd-investigating {
                background: rgba(234, 179, 8, .12);
                color: #fde047;
            }

            .qm-dd-resolved {
                background: rgba(34, 197, 94, .12);
                color: #86efac;
            }

            .qm-dd-content {
                padding: 17px;
                border: 1px solid #20364e;
                border-radius: 9px;
                background: #0b1727;
                color: #cbd5e1;
                font-size: 12px;
                line-height: 1.8;
                white-space: pre-wrap;
                overflow-wrap: anywhere;
            }

            .qm-dd-muted {
                color: #71869f;
                font-size: 12px;
            }

            .qm-dd-inspection {
                padding: 18px;
                border: 1px solid #164e63;
                border-radius: 10px;
                background: rgba(8, 145, 178, .06);
            }

            .qm-dd-inspection h3 {
                margin-bottom: 15px;
                color: #67e8f9;
                font-size: 13px;
                font-weight: 750;
            }

            @media (max-width: 850px) {
                .qm-dd-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }

            @media (max-width: 600px) {
                .qm-defect-detail-page {
                    padding: 20px 12px;
                }

                .qm-dd-panel {
                    padding: 16px;
                }

                .qm-dd-grid {
                    grid-template-columns: 1fr;
                }
            }

            @media print {
                nav, header, .qm-dd-actions {
                    display: none !important;
                }

                .qm-defect-detail-page {
                    background: white !important;
                    color: #111827 !important;
                    padding: 10px !important;
                }

                .qm-dd-panel, .qm-dd-item, .qm-dd-content,
                .qm-dd-inspection {
                    background: white !important;
                    color: #111827 !important;
                    border-color: #ccc !important;
                    break-inside: avoid;
                }

                .qm-dd-panel h2,
                .qm-dd-item strong {
                    color: #111827 !important;
                }
            }
        </style>

        <div class="qm-dd-container">

            <div class="qm-dd-header">
                <div>
                    <div class="qm-dd-eyebrow">
                        QUALITY INTELLIGENCE / DEFECT RECORD REVIEW
                    </div>

                    <h1>Defect Record #{{ $defect->id }}</h1>

                    <p>
                        Review defect information, production context
                        and investigation records.
                    </p>
                </div>

                <div class="qm-dd-actions">
                    <button type="button" class="qm-dd-btn"
                        onclick="window.print()">
                        Print Report
                    </button>

                    <a href="{{ route('qm.defects.index') }}"
                        class="qm-dd-btn secondary">
                        ← Defect Registry
                    </a>
                </div>
            </div>

            <div class="qm-dd-readonly">
                READ-ONLY OVERSIGHT — This record is available for monitoring
                and reporting. Operational changes are not permitted.
            </div>

            <section class="qm-dd-panel">
                <h2>Defect Overview</h2>

                <div class="qm-dd-grid">
                    <div class="qm-dd-item">
                        <span>Defect Type</span>
                        <strong>{{ $defect->defect_type }}</strong>
                    </div>

                    <div class="qm-dd-item">
                        <span>Severity</span>
                        <strong>
                            <span class="qm-dd-badge qm-dd-{{ $defect->severity }}">
                                {{ ucfirst($defect->severity) }}
                            </span>
                        </strong>
                    </div>

                    <div class="qm-dd-item">
                        <span>Current Status</span>
                        <strong>
                            <span class="qm-dd-badge qm-dd-{{ $defect->status }}">
                                {{ ucfirst($defect->status) }}
                            </span>
                        </strong>
                    </div>

                    <div class="qm-dd-item">
                        <span>Defect Quantity</span>
                        <strong>{{ number_format($defect->defect_quantity) }}</strong>
                    </div>

                    <div class="qm-dd-item">
                        <span>Batch Number</span>
                        <strong>{{ $defect->batch_number ?: '—' }}</strong>
                    </div>

                    <div class="qm-dd-item">
                        <span>Product Code</span>
                        <strong>{{ $defect->product_code ?: '—' }}</strong>
                    </div>

                    <div class="qm-dd-item">
                        <span>Reported By</span>
                        <strong>{{ $defect->reporter?->name ?? '—' }}</strong>
                    </div>

                    <div class="qm-dd-item">
                        <span>Detected At</span>
                        <strong>
                            {{ $defect->detected_at?->format('d M Y, h:i A') ?? '—' }}
                        </strong>
                    </div>

                    <div class="qm-dd-item">
                        <span>Created At</span>
                        <strong>
                            {{ $defect->created_at?->format('d M Y, h:i A') ?? '—' }}
                        </strong>
                    </div>

                    <div class="qm-dd-item">
                        <span>Resolved At</span>
                        <strong>
                            {{ $defect->resolved_at?->format('d M Y, h:i A') ?? 'Not resolved' }}
                        </strong>
                    </div>
                </div>
            </section>

            <section class="qm-dd-panel">
                <h2>Production Context</h2>

                <div class="qm-dd-grid">
                    <div class="qm-dd-item">
                        <span>Factory</span>
                        <strong>{{ $defect->factory?->name ?? '—' }}</strong>
                    </div>

                    <div class="qm-dd-item">
                        <span>Production Line</span>
                        <strong>{{ $defect->productionLine?->name ?? '—' }}</strong>
                    </div>

                    <div class="qm-dd-item">
                        <span>Machine</span>
                        <strong>{{ $defect->machine?->name ?? '—' }}</strong>
                    </div>
                </div>
            </section>

            @if ($defect->inspection)
                <section class="qm-dd-panel">
                    <h2>Linked Inspection</h2>

                    <div class="qm-dd-inspection">
                        <h3>Associated Inspection Record</h3>

                        <div class="qm-dd-grid">
                            <div class="qm-dd-item">
                                <span>Inspection Number</span>
                                <strong>
                                    {{ $defect->inspection->inspection_number ?? '—' }}
                                </strong>
                            </div>

                            <div class="qm-dd-item">
                                <span>Inspection Type</span>
                                <strong>
                                    {{ $defect->inspection->inspection_type ?? '—' }}
                                </strong>
                            </div>

                            <div class="qm-dd-item">
                                <span>Inspection Status</span>
                                <strong>
                                    {{ ucfirst(str_replace('_', ' ', $defect->inspection->status ?? '—')) }}
                                </strong>
                            </div>

                            <div class="qm-dd-item">
                                <span>Inspection Result</span>
                                <strong>
                                    {{ $defect->inspection->result
                                        ? ucfirst($defect->inspection->result)
                                        : 'Not evaluated' }}
                                </strong>
                            </div>
                        </div>
                    </div>
                </section>
            @endif

            <section class="qm-dd-panel">
                <h2>Defect Description</h2>

                <div class="qm-dd-content">
                    {{ $defect->description ?: 'No description provided.' }}
                </div>
            </section>

            <section class="qm-dd-panel">
                <h2>Resolution Information</h2>

                <div class="qm-dd-content">
                    {{ $defect->resolution_notes ?: 'No resolution notes available.' }}
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
