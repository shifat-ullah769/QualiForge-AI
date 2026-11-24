<x-app-layout>
    <div class="qf-report-page">

        <style>
            .qf-report-page {
                min-height: 100vh;
                padding: 30px;
                background: #07111f;
                color: #e5edf7;
            }

            .qf-report-container {
                max-width: 1150px;
                margin: auto;
            }

            .qf-report-toolbar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 15px;
                flex-wrap: wrap;
                margin-bottom: 22px;
            }

            .qf-report-toolbar h1 {
                font-size: 25px;
                font-weight: 750;
                color: #f8fafc;
            }

            .qf-report-actions {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
            }

            .qf-report-btn {
                padding: 11px 17px;
                border-radius: 7px;
                border: none;
                cursor: pointer;
                font-size: 12px;
                font-weight: 700;
            }

            .qf-report-print {
                background: #0891b2;
                color: white;
            }

            .qf-report-download {
                background: #16a34a;
                color: white;
            }

            .qf-report-document {
                padding: 38px;
                background: #ffffff;
                color: #1e293b;
                border-radius: 12px;
                box-shadow: 0 15px 40px rgba(0, 0, 0, .25);
            }

            .qf-report-cover {
                padding-bottom: 25px;
                border-bottom: 3px solid #0e7490;
                margin-bottom: 25px;
            }

            .qf-report-brand {
                color: #0e7490;
                font-size: 12px;
                font-weight: 800;
                letter-spacing: 2px;
                text-transform: uppercase;
                margin-bottom: 18px;
            }

            .qf-report-cover h2 {
                font-size: 29px;
                font-weight: 800;
                color: #0f172a;
                margin-bottom: 8px;
            }

            .qf-report-subtitle {
                color: #64748b;
                font-size: 13px;
            }

            .qf-report-meta {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 15px;
                margin-top: 24px;
            }

            .qf-report-meta-item {
                padding: 12px;
                background: #f1f5f9;
                border-radius: 7px;
            }

            .qf-report-meta-item span {
                display: block;
                font-size: 9px;
                color: #64748b;
                text-transform: uppercase;
                margin-bottom: 5px;
                font-weight: 700;
            }

            .qf-report-meta-item strong {
                font-size: 12px;
                color: #0f172a;
            }

            .qf-report-section {
                margin-top: 28px;
                page-break-inside: avoid;
            }

            .qf-report-section h3 {
                font-size: 16px;
                color: #0f172a;
                font-weight: 800;
                padding-bottom: 10px;
                border-bottom: 1px solid #cbd5e1;
                margin-bottom: 15px;
            }

            .qf-report-section p {
                font-size: 11px;
                line-height: 1.8;
                color: #475569;
            }

            .qf-report-kpis {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 12px;
            }

            .qf-report-kpi {
                padding: 15px;
                border: 1px solid #cbd5e1;
                border-radius: 8px;
                background: #f8fafc;
            }

            .qf-report-kpi span {
                display: block;
                font-size: 9px;
                color: #64748b;
                margin-bottom: 9px;
            }

            .qf-report-kpi strong {
                font-size: 23px;
                color: #0f172a;
            }

            .qf-report-table-wrap {
                overflow-x: auto;
            }

            .qf-report-table {
                width: 100%;
                border-collapse: collapse;
                font-size: 10px;
            }

            .qf-report-table th {
                padding: 11px;
                background: #e2e8f0;
                color: #334155;
                text-align: left;
                font-size: 9px;
                text-transform: uppercase;
            }

            .qf-report-table td {
                padding: 11px;
                border-bottom: 1px solid #e2e8f0;
                color: #334155;
            }

            .qf-report-empty {
                padding: 13px;
                background: #f8fafc;
                color: #64748b;
                font-size: 11px;
                border-radius: 6px;
            }

            .qf-report-note {
                padding: 15px;
                background: #f1f5f9;
                border-left: 4px solid #0e7490;
                margin-top: 12px;
                font-size: 11px;
                line-height: 1.8;
                color: #475569;
            }

            .qf-report-footer {
                margin-top: 35px;
                padding-top: 15px;
                border-top: 1px solid #cbd5e1;
                display: flex;
                justify-content: space-between;
                gap: 10px;
                flex-wrap: wrap;
                font-size: 9px;
                color: #64748b;
            }

            @media(max-width: 700px) {
                .qf-report-page {
                    padding: 15px 8px;
                }

                .qf-report-document {
                    padding: 20px 13px;
                }

                .qf-report-kpis {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .qf-report-meta {
                    grid-template-columns: 1fr;
                }
            }

            @media print {
                @page {
                    size: A4;
                    margin: 15mm;
                }

                body {
                    background: white !important;
                }

                .qf-report-page {
                    padding: 0 !important;
                    background: white !important;
                    min-height: auto !important;
                }

                .qf-report-container {
                    max-width: none !important;
                }

                .qf-report-toolbar,
                nav,
                header {
                    display: none !important;
                }

                .qf-report-document {
                    padding: 0 !important;
                    border-radius: 0 !important;
                    box-shadow: none !important;
                }

                .qf-report-section {
                    page-break-inside: avoid;
                }

                .qf-report-table {
                    page-break-inside: auto;
                }

                .qf-report-table tr {
                    page-break-inside: avoid;
                }

                * {
                    -webkit-print-color-adjust: exact !important;
                    print-color-adjust: exact !important;
                }
            }
        </style>

        <div class="qf-report-container">

            {{-- Toolbar --}}
            <div class="qf-report-toolbar">
                <div>
                    <h1>Quality Report Preview</h1>
                    <p style="color:#94a3b8;font-size:12px;">
                        Manufacturing Quality Performance Report
                    </p>
                </div>

                <div class="qf-report-actions">
                    <button
                        type="button"
                        onclick="window.print()"
                        class="qf-report-btn qf-report-print">
                        Print Report
                    </button>

                    <a href="{{ route('qe.reports.pdf') }}"
                        class="qf-report-btn qf-report-download">
                        Download PDF
                    </a>
                </div>
            </div>

            {{-- Report Document --}}
            <div class="qf-report-document">

                {{-- Cover / Header --}}
                <div class="qf-report-cover">

                    <div class="qf-report-brand">
                        QualiForge AI
                    </div>

                    <h2>Manufacturing Quality Report</h2>

                    <div class="qf-report-subtitle">
                        Consolidated Quality Performance and Operational Analysis
                    </div>

                    <div class="qf-report-meta">

                        <div class="qf-report-meta-item">
                            <span>Company</span>
                            <strong>{{ $company->name }}</strong>
                        </div>

                        <div class="qf-report-meta-item">
                            <span>Report Generated</span>
                            <strong>{{ now()->format('d M Y, h:i A') }}</strong>
                        </div>

                        <div class="qf-report-meta-item">
                            <span>Reporting Scope</span>
                            <strong>All Available Company Records</strong>
                        </div>

                        <div class="qf-report-meta-item">
                            <span>Report Type</span>
                            <strong>Manufacturing Quality Overview</strong>
                        </div>

                    </div>
                </div>

                {{-- Executive Summary --}}
                <section class="qf-report-section">
                    <h3>1. Executive Summary</h3>

                    <p>
                        This report provides a consolidated overview of the
                        manufacturing quality records available for
                        {{ $company->name }}. It summarizes recorded defects,
                        inspection activities and prediction execution statuses.
                        The report is intended to support quality monitoring
                        and operational review.
                    </p>
                </section>

                {{-- KPI Overview --}}
                <section class="qf-report-section">
                    <h3>2. Quality Performance Overview</h3>

                    <div class="qf-report-kpis">

                        <div class="qf-report-kpi">
                            <span>Total Defect Records</span>
                            <strong>{{ $totalDefects }}</strong>
                        </div>

                        <div class="qf-report-kpi">
                            <span>Defect Quantity</span>
                            <strong>{{ $totalDefectQuantity }}</strong>
                        </div>

                        <div class="qf-report-kpi">
                            <span>Total Inspections</span>
                            <strong>{{ $totalInspections }}</strong>
                        </div>

                        <div class="qf-report-kpi">
                            <span>Total Predictions</span>
                            <strong>{{ $totalPredictions }}</strong>
                        </div>

                    </div>
                </section>

                {{-- Defect Status --}}
                <section class="qf-report-section">
                    <h3>3. Defect Status Analysis</h3>

                    <div class="qf-report-table-wrap">
                        <table class="qf-report-table">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Number of Records</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($defectStatusSummary as $item)
                                <tr>
                                    <td>{{ ucfirst(str_replace('_', ' ', $item->status)) }}</td>
                                    <td>{{ $item->total }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2">No defect records available.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                {{-- Defect Severity --}}
                <section class="qf-report-section">
                    <h3>4. Defect Severity Distribution</h3>

                    <div class="qf-report-table-wrap">
                        <table class="qf-report-table">
                            <thead>
                                <tr>
                                    <th>Severity</th>
                                    <th>Number of Records</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($defectSeveritySummary as $item)
                                <tr>
                                    <td>{{ ucfirst($item->severity) }}</td>
                                    <td>{{ $item->total }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2">No severity data available.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                {{-- Defect Types --}}
                <section class="qf-report-section">
                    <h3>5. Defect Type Analysis</h3>

                    <div class="qf-report-table-wrap">
                        <table class="qf-report-table">
                            <thead>
                                <tr>
                                    <th>Defect Type</th>
                                    <th>Record Count</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($defectTypeSummary as $item)
                                <tr>
                                    <td>{{ $item->defect_type }}</td>
                                    <td>{{ $item->total }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2">No defect type data available.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                {{-- Inspection Summary --}}
                <section class="qf-report-section">
                    <h3>6. Inspection Summary</h3>

                    <h4 style="font-size:12px;font-weight:700;margin-bottom:10px;">
                        Inspection Status
                    </h4>

                    <div class="qf-report-table-wrap">
                        <table class="qf-report-table">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Records</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($inspectionStatusSummary as $item)
                                <tr>
                                    <td>{{ ucfirst($item->status) }}</td>
                                    <td>{{ $item->total }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2">No inspection status data available.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <h4 style="font-size:12px;font-weight:700;margin:18px 0 10px;">
                        Inspection Results
                    </h4>

                    <div class="qf-report-table-wrap">
                        <table class="qf-report-table">
                            <thead>
                                <tr>
                                    <th>Result</th>
                                    <th>Records</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($inspectionResultSummary as $item)
                                <tr>
                                    <td>{{ ucfirst($item->result) }}</td>
                                    <td>{{ $item->total }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2">No inspection result data available.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                {{-- Prediction Summary --}}
                <section class="qf-report-section">
                    <h3>7. Prediction Execution Summary</h3>

                    <div class="qf-report-table-wrap">
                        <table class="qf-report-table">
                            <thead>
                                <tr>
                                    <th>Prediction Status</th>
                                    <th>Records</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($predictionStatusSummary as $item)
                                <tr>
                                    <td>{{ ucfirst($item->status) }}</td>
                                    <td>{{ $item->total }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2">No prediction records available.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="qf-report-note">
                        Prediction status represents execution records only.
                        Where illustrative demo predictions are present,
                        their outputs must not be interpreted as results
                        from a trained AI model.
                    </div>
                </section>

                {{-- Recent Defects --}}
                <section class="qf-report-section">
                    <h3>8. Recent Defect Records</h3>

                    <div class="qf-report-table-wrap">
                        <table class="qf-report-table">
                            <thead>
                                <tr>
                                    <th>Defect</th>
                                    <th>Severity</th>
                                    <th>Status</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($recentDefects as $defect)
                                <tr>
                                    <td>{{ $defect->defect_type }}</td>
                                    <td>{{ ucfirst($defect->severity) }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $defect->status)) }}</td>
                                    <td>{{ $defect->defect_quantity }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">No recent defects available.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                {{-- Recent Inspections --}}
                <section class="qf-report-section">
                    <h3>9. Recent Inspection Records</h3>

                    <div class="qf-report-table-wrap">
                        <table class="qf-report-table">
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
                                    <td>{{ ucfirst($inspection->inspection_type) }}</td>
                                    <td>{{ ucfirst($inspection->status) }}</td>
                                    <td>{{ $inspection->result ? ucfirst($inspection->result) : 'Pending' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">No recent inspections available.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                {{-- Findings --}}
                <section class="qf-report-section">
                    <h3>10. Quality Findings and Limitations</h3>

                    <p>
                        The information in this report reflects the records
                        currently stored in the company's QualiForge AI
                        workspace. Defect counts, inspection results and
                        prediction execution records are descriptive indicators
                        of recorded activity.
                    </p>

                    <p>
                        Statistical associations do not independently establish
                        root causes. Further investigation and operational
                        evidence are required before confirming causal factors
                        or making process-level conclusions.
                    </p>
                </section>

                {{-- Footer --}}
                <div class="qf-report-footer">
                    <span>QualiForge AI | Manufacturing Quality Intelligence</span>
                    <span>Generated {{ now()->format('d M Y') }}</span>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>