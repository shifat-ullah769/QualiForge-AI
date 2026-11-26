<x-app-layout>
    <div class="qm-report-page">
        <style>
            .qm-report-page {
                min-height: 100vh;
                padding: 30px;
                background: #07111f;
                color: #e5edf7;
            }

            .qm-report-container {
                max-width: 1150px;
                margin: auto;
            }

            .qm-report-toolbar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 15px;
                margin-bottom: 22px;
            }

            .qm-report-toolbar h1 {
                font-size: 25px;
                font-weight: 750;
                color: #f8fafc;
            }

            .qm-report-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                align-items: center;
            }

            .qm-report-btn {
                padding: 10px 16px;
                border: none;
                border-radius: 7px;
                font-size: 12px;
                font-weight: 700;
                cursor: pointer;
                text-decoration: none;
            }

            .qm-print-btn {
                background: #0891b2;
                color: white;
            }

            .qm-download-btn {
                background: #16a34a;
                color: white;
            }

            .qm-filter {
                display: flex;
                align-items: center;
                gap: 8px;
                flex-wrap: wrap;
                margin-bottom: 22px;
                padding: 16px;
                background: #111f31;
                border: 1px solid #26384d;
                border-radius: 9px;
            }

            .qm-filter label {
                color: #cbd5e1;
                font-size: 12px;
                font-weight: 700;
            }

            .qm-filter select {
                min-width: 220px;
                padding: 9px 12px;
                border: 1px solid #475569;
                border-radius: 6px;
                background: #07111f;
                color: white;
                font-size: 12px;
            }

            .qm-filter button {
                padding: 9px 15px;
                background: #0891b2;
                color: white;
                border: none;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 700;
                cursor: pointer;
            }

            .qm-report-document {
                padding: 38px;
                background: white;
                color: #1e293b;
                border-radius: 12px;
                box-shadow: 0 15px 40px rgba(0,0,0,.25);
            }

            .qm-report-cover {
                padding-bottom: 25px;
                border-bottom: 3px solid #0e7490;
                margin-bottom: 25px;
            }

            .qm-brand {
                color: #0e7490;
                font-size: 12px;
                font-weight: 800;
                letter-spacing: 2px;
                text-transform: uppercase;
                margin-bottom: 18px;
            }

            .qm-report-cover h2 {
                font-size: 29px;
                font-weight: 800;
                color: #0f172a;
                margin-bottom: 8px;
            }

            .qm-subtitle {
                color: #64748b;
                font-size: 13px;
            }

            .qm-meta {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
                margin-top: 24px;
            }

            .qm-meta-item {
                padding: 12px;
                background: #f1f5f9;
                border-radius: 7px;
            }

            .qm-meta-item span {
                display: block;
                font-size: 9px;
                color: #64748b;
                text-transform: uppercase;
                margin-bottom: 5px;
                font-weight: 700;
            }

            .qm-meta-item strong {
                font-size: 12px;
                color: #0f172a;
            }

            .qm-section {
                margin-top: 28px;
                page-break-inside: avoid;
            }

            .qm-section h3 {
                font-size: 16px;
                color: #0f172a;
                font-weight: 800;
                padding-bottom: 10px;
                border-bottom: 1px solid #cbd5e1;
                margin-bottom: 15px;
            }

            .qm-section p {
                font-size: 11px;
                line-height: 1.8;
                color: #475569;
                margin-bottom: 10px;
            }

            .qm-kpis {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 12px;
            }

            .qm-kpi {
                padding: 15px;
                border: 1px solid #cbd5e1;
                border-radius: 8px;
                background: #f8fafc;
            }

            .qm-kpi span {
                display: block;
                font-size: 9px;
                color: #64748b;
                margin-bottom: 9px;
            }

            .qm-kpi strong {
                font-size: 23px;
                color: #0f172a;
            }

            .qm-table-wrap {
                overflow-x: auto;
            }

            .qm-table {
                width: 100%;
                border-collapse: collapse;
                font-size: 10px;
            }

            .qm-table th {
                padding: 11px;
                background: #e2e8f0;
                color: #334155;
                text-align: left;
                font-size: 9px;
                text-transform: uppercase;
            }

            .qm-table td {
                padding: 11px;
                border-bottom: 1px solid #e2e8f0;
                color: #334155;
            }

            .qm-empty {
                padding: 13px;
                background: #f8fafc;
                color: #64748b;
                font-size: 11px;
                border-radius: 6px;
            }

            .qm-note {
                padding: 15px;
                background: #f1f5f9;
                border-left: 4px solid #0e7490;
                margin-top: 12px;
                font-size: 11px;
                line-height: 1.8;
                color: #475569;
            }

            .qm-report-footer {
                margin-top: 35px;
                padding-top: 15px;
                border-top: 1px solid #cbd5e1;
                display: flex;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 10px;
                font-size: 9px;
                color: #64748b;
            }

            @media(max-width: 700px) {
                .qm-report-page {
                    padding: 15px 8px;
                }

                .qm-report-document {
                    padding: 20px 13px;
                }

                .qm-kpis {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .qm-meta {
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

                .qm-report-page {
                    padding: 0 !important;
                    background: white !important;
                }

                .qm-report-container {
                    max-width: none !important;
                }

                .qm-report-toolbar,
                .qm-filter,
                nav,
                header {
                    display: none !important;
                }

                .qm-report-document {
                    padding: 0 !important;
                    border-radius: 0 !important;
                    box-shadow: none !important;
                }

                .qm-section {
                    page-break-inside: avoid;
                }

                .qm-table tr {
                    page-break-inside: avoid;
                }

                * {
                    -webkit-print-color-adjust: exact !important;
                    print-color-adjust: exact !important;
                }
            }
        </style>

        <div class="qm-report-container">

            {{-- Toolbar --}}
            <div class="qm-report-toolbar">
                <div>
                    <h1>Quality Reports</h1>
                    <p style="color:#94a3b8;font-size:12px;">
                        Company-level Quality Performance Report
                    </p>
                </div>

                <div class="qm-report-actions">
                    <button type="button"
                        onclick="window.print()"
                        class="qm-report-btn qm-print-btn">
                        Print Report
                    </button>

                    <a href="{{ route('qm.reports.download', request()->query()) }}"
                        class="qm-report-btn qm-download-btn">
                        Download PDF
                    </a>
                </div>
            </div>

            {{-- Factory Filter --}}
            <form method="GET"
                action="{{ route('qm.reports.index') }}"
                class="qm-filter">

                <label for="factory_id">Factory Scope</label>

                <select name="factory_id" id="factory_id">
                    <option value="">All Factories</option>

                    @foreach($factories as $factory)
                        <option value="{{ $factory->id }}"
                            @selected((string) request('factory_id') === (string) $factory->id)>
                            {{ $factory->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit">Apply Filter</button>

                @if($selectedFactory)
                    <a href="{{ route('qm.reports.index') }}"
                        style="font-size:12px;color:#67e8f9;text-decoration:none;">
                        Clear Filter
                    </a>
                @endif
            </form>

            {{-- Report Document --}}
            <div class="qm-report-document">

                {{-- Cover --}}
                <div class="qm-report-cover">
                    <div class="qm-brand">QualiForge AI</div>

                    <h2>Manufacturing Quality Report</h2>

                    <div class="qm-subtitle">
                        Consolidated Quality Performance and Operational Monitoring
                    </div>

                    <div class="qm-meta">
                        <div class="qm-meta-item">
                            <span>Company</span>
                            <strong>{{ $company->name }}</strong>
                        </div>

                        <div class="qm-meta-item">
                            <span>Report Generated</span>
                            <strong>{{ $generatedAt->format('d M Y, h:i A') }}</strong>
                        </div>

                        <div class="qm-meta-item">
                            <span>Factory Scope</span>
                            <strong>{{ $selectedFactory?->name ?? 'All Company Factories' }}</strong>
                        </div>

                        <div class="qm-meta-item">
                            <span>Reporting Period</span>
                            <strong>All Available Records</strong>
                        </div>

                        <div class="qm-meta-item">
                            <span>Report Type</span>
                            <strong>Quality Management Overview</strong>
                        </div>

                        <div class="qm-meta-item">
                            <span>Report Reference</span>
                            <strong>QF-QM-{{ $generatedAt->format('Ymd-His') }}</strong>
                        </div>
                    </div>
                </div>

                {{-- Executive Summary --}}
                <section class="qm-section">
                    <h3>1. Executive Summary</h3>

                    <p>
                        This report presents a consolidated overview of the
                        manufacturing quality records available for
                        {{ $company->name }}.

                        The report covers
                        {{ $selectedFactory?->name ?? 'all company factories' }},
                        including recorded defects, inspection activities,
                        factory-level performance indicators and prediction
                        execution records.
                    </p>

                    <p>
                        It is intended to support management-level monitoring
                        and review of recorded quality activities.
                    </p>
                </section>

                {{-- KPI Overview --}}
                <section class="qm-section">
                    <h3>2. Quality Performance Overview</h3>

                    <div class="qm-kpis">
                        <div class="qm-kpi">
                            <span>Total Defect Records</span>
                            <strong>{{ $totalDefects }}</strong>
                        </div>

                        <div class="qm-kpi">
                            <span>Total Defect Quantity</span>
                            <strong>{{ $totalDefectQuantity }}</strong>
                        </div>

                        <div class="qm-kpi">
                            <span>Total Inspections</span>
                            <strong>{{ $totalInspections }}</strong>
                        </div>

                        <div class="qm-kpi">
                            <span>Total Predictions</span>
                            <strong>{{ $totalPredictions }}</strong>
                        </div>
                    </div>
                </section>

                {{-- Defect Analysis --}}
                <section class="qm-section">
                    <h3>3. Defect Analysis</h3>

                    <h4 style="font-size:12px;font-weight:700;margin-bottom:10px;">
                        Defect Status
                    </h4>

                    <div class="qm-table-wrap">
                        <table class="qm-table">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Records</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($defectStatusCounts as $status => $count)
                                    <tr>
                                        <td>{{ ucfirst(str_replace('_', ' ', $status)) }}</td>
                                        <td>{{ $count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h4 style="font-size:12px;font-weight:700;margin:18px 0 10px;">
                        Defect Severity
                    </h4>

                    <div class="qm-table-wrap">
                        <table class="qm-table">
                            <thead>
                                <tr>
                                    <th>Severity</th>
                                    <th>Records</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($defectSeverityCounts as $severity => $count)
                                    <tr>
                                        <td>{{ ucfirst($severity) }}</td>
                                        <td>{{ $count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h4 style="font-size:12px;font-weight:700;margin:18px 0 10px;">
                        Defect Type Distribution
                    </h4>

                    <div class="qm-table-wrap">
                        <table class="qm-table">
                            <thead>
                                <tr>
                                    <th>Defect Type</th>
                                    <th>Records</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($defectTypeCounts as $item)
                                    <tr>
                                        <td>{{ $item->defect_type }}</td>
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

                {{-- Inspection Analysis --}}
                <section class="qm-section">
                    <h3>4. Inspection Analysis</h3>

                    <h4 style="font-size:12px;font-weight:700;margin-bottom:10px;">
                        Inspection Status
                    </h4>

                    <div class="qm-table-wrap">
                        <table class="qm-table">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Records</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inspectionStatusCounts as $status => $count)
                                    <tr>
                                        <td>{{ ucfirst(str_replace('_', ' ', $status)) }}</td>
                                        <td>{{ $count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h4 style="font-size:12px;font-weight:700;margin:18px 0 10px;">
                        Inspection Results
                    </h4>

                    <div class="qm-table-wrap">
                        <table class="qm-table">
                            <thead>
                                <tr>
                                    <th>Result</th>
                                    <th>Records</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inspectionResultCounts as $result => $count)
                                    <tr>
                                        <td>{{ ucfirst($result) }}</td>
                                        <td>{{ $count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>

                {{-- Factory Analysis --}}
                <section class="qm-section">
                    <h3>5. Factory-wise Quality Analysis</h3>

                    <div class="qm-table-wrap">
                        <table class="qm-table">
                            <thead>
                                <tr>
                                    <th>Factory</th>
                                    <th>Production Lines</th>
                                    <th>Defect Records</th>
                                    <th>Defect Quantity</th>
                                    <th>Inspections</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($factoryAnalysis as $factory)
                                    <tr>
                                        <td>{{ $factory->name }}</td>
                                        <td>{{ $factory->production_lines_count }}</td>
                                        <td>{{ $factory->defect_count }}</td>
                                        <td>{{ $factory->defect_quantity }}</td>
                                        <td>{{ $factory->inspection_count }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No factory records available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                {{-- Prediction Monitoring --}}
                <section class="qm-section">
                    <h3>6. Prediction Execution Summary</h3>

                    <div class="qm-table-wrap">
                        <table class="qm-table">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Records</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($predictionStatusCounts as $status => $count)
                                    <tr>
                                        <td>{{ ucfirst($status) }}</td>
                                        <td>{{ $count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h4 style="font-size:12px;font-weight:700;margin:18px 0 10px;">
                        Recent Completed Prediction Insights
                    </h4>

                    <div class="qm-table-wrap">
                        <table class="qm-table">
                            <thead>
                                <tr>
                                    <th>Prediction ID</th>
                                    <th>Model Version</th>
                                    <th>Quality Score</th>
                                    <th>Predicted Defect Rate</th>
                                    <th>Risk</th>
                                    <th>Mode</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($predictionInsights as $prediction)
                                    <tr>
                                        <td>#{{ $prediction['id'] }}</td>
                                        <td>{{ $prediction['model_version'] ?? 'N/A' }}</td>
                                        <td>
                                            {{ $prediction['quality_score'] !== null
                                                ? $prediction['quality_score'] . '%'
                                                : 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $prediction['predicted_defect_rate'] !== null
                                                ? $prediction['predicted_defect_rate'] . '%'
                                                : 'N/A' }}
                                        </td>
                                        <td>{{ ucfirst($prediction['risk_level'] ?? 'N/A') }}</td>
                                        <td>{{ $prediction['demo_mode'] ? 'Demo' : 'Not identified' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No completed prediction insights available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="qm-note">
                        Prediction records represent execution activity.
                        Demo outputs are illustrative and must not be interpreted
                        as actual predictions from a trained or validated AI model.
                        No accuracy, precision, recall or F1-score is claimed
                        in this report.
                    </div>
                </section>

                {{-- Recent Defects --}}
                <section class="qm-section">
                    <h3>7. Recent Quality Issues</h3>

                    <div class="qm-table-wrap">
                        <table class="qm-table">
                            <thead>
                                <tr>
                                    <th>Defect Type</th>
                                    <th>Factory</th>
                                    <th>Machine</th>
                                    <th>Severity</th>
                                    <th>Status</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentDefects as $defect)
                                    <tr>
                                        <td>{{ $defect->defect_type }}</td>
                                        <td>{{ $defect->factory?->name ?? 'N/A' }}</td>
                                        <td>{{ $defect->machine?->name ?? 'N/A' }}</td>
                                        <td>{{ ucfirst($defect->severity) }}</td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $defect->status)) }}</td>
                                        <td>{{ $defect->defect_quantity }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No recent defects available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <h4 style="font-size:12px;font-weight:700;margin:18px 0 10px;">
                        Recent Inspection Records
                    </h4>

                    <div class="qm-table-wrap">
                        <table class="qm-table">
                            <thead>
                                <tr>
                                    <th>Inspection Number</th>
                                    <th>Factory</th>
                                    <th>Machine</th>
                                    <th>Inspector</th>
                                    <th>Status</th>
                                    <th>Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentInspections as $inspection)
                                    <tr>
                                        <td>{{ $inspection->inspection_number }}</td>
                                        <td>{{ $inspection->factory?->name ?? 'N/A' }}</td>
                                        <td>{{ $inspection->machine?->name ?? 'N/A' }}</td>
                                        <td>{{ $inspection->inspector?->name ?? 'N/A' }}</td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $inspection->status)) }}</td>
                                        <td>{{ $inspection->result ? ucfirst($inspection->result) : 'Pending' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No recent inspections available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                {{-- Findings and Limitations --}}
                <section class="qm-section">
                    <h3>8. Findings and Limitations</h3>

                    <p>
                        This report reflects the records currently stored in
                        the company's QualiForge AI workspace. Defect counts,
                        inspection outcomes and prediction execution statuses
                        are descriptive indicators of recorded activity.
                    </p>

                    <p>
                        Factory-level defect and inspection counts describe
                        recorded associations. They do not independently
                        establish process-level causes or factory performance
                        quality without appropriate production-volume and
                        operational context.
                    </p>

                    <p>
                        Prediction outputs labelled Demo are illustrative.
                        They have not been presented as validated AI results.
                        Model performance metrics cannot be established from
                        these records alone.
                    </p>
                </section>

                {{-- Footer --}}
                <div class="qm-report-footer">
                    <span>QualiForge AI | Manufacturing Quality Intelligence</span>
                    <span>Generated {{ $generatedAt->format('d M Y') }}</span>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
