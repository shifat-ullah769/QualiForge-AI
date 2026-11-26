<x-app-layout>
    <div class="qm-inspection-page">
        <style>
            .qm-inspection-page {
                min-height: 100vh;
                padding: 30px;
                background: #07111f;
                color: #e5edf7;
            }

            .qm-ins-container {
                max-width: 1450px;
                margin: auto;
            }

            .qm-ins-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 18px;
                flex-wrap: wrap;
                margin-bottom: 25px;
            }

            .qm-ins-eyebrow {
                color: #22d3ee;
                font-size: 10px;
                font-weight: 800;
                letter-spacing: 1.4px;
            }

            .qm-ins-header h1 {
                margin: 8px 0;
                color: #f8fafc;
                font-size: 27px;
                font-weight: 750;
            }

            .qm-ins-header p {
                color: #94a3b8;
                font-size: 13px;
            }

            .qm-ins-readonly {
                padding: 10px 14px;
                border: 1px solid #164e63;
                border-radius: 8px;
                background: rgba(8, 145, 178, .10);
                color: #67e8f9;
                font-size: 10px;
                font-weight: 800;
                letter-spacing: .5px;
            }

            .qm-ins-kpis {
                display: grid;
                grid-template-columns: repeat(5, minmax(0, 1fr));
                gap: 13px;
                margin-bottom: 22px;
            }

            .qm-ins-kpi {
                padding: 19px;
                border: 1px solid #20364e;
                border-radius: 11px;
                background: #101d2e;
            }

            .qm-ins-kpi span {
                display: block;
                margin-bottom: 12px;
                color: #94a3b8;
                font-size: 10px;
            }

            .qm-ins-kpi strong {
                color: #f8fafc;
                font-size: 27px;
                font-weight: 750;
            }

            .qm-ins-kpi small {
                display: block;
                margin-top: 7px;
                color: #64748b;
                font-size: 9px;
            }

            .qm-ins-analysis {
                display: grid;
                grid-template-columns: 1.1fr .9fr;
                gap: 18px;
                margin-bottom: 22px;
            }

            .qm-ins-panel {
                padding: 22px;
                border: 1px solid #20364e;
                border-radius: 12px;
                background: #101d2e;
            }

            .qm-ins-panel h2 {
                margin: 0 0 20px;
                color: #f1f5f9;
                font-size: 15px;
                font-weight: 750;
            }

            .qm-ins-result-row {
                margin-bottom: 18px;
            }

            .qm-ins-result-heading {
                display: flex;
                justify-content: space-between;
                gap: 10px;
                margin-bottom: 8px;
                color: #cbd5e1;
                font-size: 11px;
            }

            .qm-ins-track {
                height: 11px;
                overflow: hidden;
                border-radius: 20px;
                background: #26384d;
            }

            .qm-ins-fill {
                height: 100%;
                border-radius: 20px;
            }

            .qm-ins-pass { background: #22c55e; }
            .qm-ins-fail { background: #ef4444; }
            .qm-ins-conditional { background: #eab308; }
            .qm-ins-pending { background: #64748b; }

            .qm-ins-summary {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }

            .qm-ins-summary-item {
                padding: 17px;
                border: 1px solid #20364e;
                border-radius: 9px;
                background: #0b1727;
            }

            .qm-ins-summary-item span {
                display: block;
                margin-bottom: 9px;
                color: #94a3b8;
                font-size: 10px;
            }

            .qm-ins-summary-item strong {
                color: #22d3ee;
                font-size: 24px;
                font-weight: 750;
            }

            .qm-ins-registry {
                overflow: hidden;
                border: 1px solid #20364e;
                border-radius: 12px;
                background: #101d2e;
            }

            .qm-ins-registry-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 15px;
                flex-wrap: wrap;
                padding: 21px;
                border-bottom: 1px solid #20364e;
            }

            .qm-ins-registry-header h2 {
                color: #f1f5f9;
                font-size: 15px;
                font-weight: 750;
            }

            .qm-ins-registry-header span {
                color: #22d3ee;
                font-size: 10px;
                font-weight: 800;
            }

            .qm-ins-table-wrap {
                width: 100%;
                overflow-x: auto;
            }

            .qm-ins-table {
                width: 100%;
                min-width: 1150px;
                border-collapse: collapse;
            }

            .qm-ins-table th {
                padding: 14px 15px;
                background: #0b1727;
                color: #7f9ab5;
                text-align: left;
                font-size: 9px;
                font-weight: 800;
                letter-spacing: .6px;
                text-transform: uppercase;
                white-space: nowrap;
            }

            .qm-ins-table td {
                padding: 16px 15px;
                border-top: 1px solid #20364e;
                color: #cbd5e1;
                font-size: 11px;
                vertical-align: middle;
            }

            .qm-ins-table tr:hover td {
                background: rgba(34, 211, 238, .025);
            }

            .qm-ins-primary {
                display: block;
                color: #f1f5f9;
                font-weight: 700;
            }

            .qm-ins-secondary {
                display: block;
                margin-top: 5px;
                color: #71869f;
                font-size: 10px;
            }

            .qm-ins-badge {
                display: inline-block;
                padding: 5px 9px;
                border-radius: 20px;
                font-size: 9px;
                font-weight: 800;
                text-transform: capitalize;
                white-space: nowrap;
            }

            .qm-ins-scheduled {
                background: rgba(59, 130, 246, .13);
                color: #93c5fd;
            }

            .qm-ins-in_progress {
                background: rgba(234, 179, 8, .13);
                color: #fde047;
            }

            .qm-ins-completed {
                background: rgba(34, 197, 94, .13);
                color: #86efac;
            }

            .qm-ins-cancelled {
                background: rgba(239, 68, 68, .13);
                color: #fca5a5;
            }

            .qm-ins-pass {
                background: rgba(34, 197, 94, .13);
                color: #86efac;
            }

            .qm-ins-fail {
                background: rgba(239, 68, 68, .13);
                color: #fca5a5;
            }

            .qm-ins-conditional {
                background: rgba(234, 179, 8, .13);
                color: #fde047;
            }

            .qm-ins-link {
                color: #22d3ee;
                font-size: 11px;
                font-weight: 750;
                text-decoration: none;
                white-space: nowrap;
            }

            .qm-ins-link:hover {
                color: #a5f3fc;
            }

            .qm-ins-empty {
                padding: 35px;
                color: #94a3b8;
                text-align: center;
                font-size: 12px;
            }

            .qm-ins-pagination {
                padding: 18px;
                border-top: 1px solid #20364e;
            }

            @media (max-width: 1100px) {
                .qm-ins-kpis {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                }
            }

            @media (max-width: 850px) {
                .qm-ins-analysis {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width: 600px) {
                .qm-inspection-page {
                    padding: 20px 12px;
                }

                .qm-ins-kpis {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .qm-ins-kpi {
                    padding: 15px;
                }
            }
        </style>

        <div class="qm-ins-container">

            <div class="qm-ins-header">
                <div>
                    <div class="qm-ins-eyebrow">
                        QUALITY INTELLIGENCE / INSPECTION MONITORING
                    </div>

                    <h1>Inspection Intelligence</h1>

                    <p>
                        Monitor inspection activity, evaluation outcomes
                        and company-wide inspection records.
                    </p>
                </div>

                <div class="qm-ins-readonly">
                    READ-ONLY MONITORING
                </div>
            </div>

            <div class="qm-ins-kpis">
                <div class="qm-ins-kpi">
                    <span>Total Inspections</span>
                    <strong>{{ number_format($totalInspections) }}</strong>
                    <small>Company inspection records</small>
                </div>

                <div class="qm-ins-kpi">
                    <span>Scheduled</span>
                    <strong>{{ number_format($scheduledInspections) }}</strong>
                    <small>Awaiting execution</small>
                </div>

                <div class="qm-ins-kpi">
                    <span>In Progress</span>
                    <strong>{{ number_format($inProgressInspections) }}</strong>
                    <small>Currently underway</small>
                </div>

                <div class="qm-ins-kpi">
                    <span>Completed</span>
                    <strong>{{ number_format($completedInspections) }}</strong>
                    <small>Execution completed</small>
                </div>

                <div class="qm-ins-kpi">
                    <span>Cancelled</span>
                    <strong>{{ number_format($cancelledInspections) }}</strong>
                    <small>Cancelled records</small>
                </div>
            </div>

            <div class="qm-ins-analysis">

                <section class="qm-ins-panel">
                    <h2>Inspection Result Distribution</h2>

                    @php
                        $resultColors = [
                            'pass' => 'qm-ins-pass',
                            'fail' => 'qm-ins-fail',
                            'conditional' => 'qm-ins-conditional',
                            'pending' => 'qm-ins-pending',
                        ];
                    @endphp

                    @foreach ($resultCounts as $result => $count)
                        @php
                            $percentage = $totalInspections > 0
                                ? ($count / $totalInspections) * 100
                                : 0;
                        @endphp

                        <div class="qm-ins-result-row">
                            <div class="qm-ins-result-heading">
                                <span>{{ ucfirst($result) }} Results</span>
                                <strong>
                                    {{ $count }} ({{ number_format($percentage, 1) }}%)
                                </strong>
                            </div>

                            <div class="qm-ins-track">
                                <div
                                    class="qm-ins-fill {{ $resultColors[$result] }}"
                                    @style(['width' => $percentage . '%'])>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </section>

                <section class="qm-ins-panel">
                    <h2>Outcome Summary</h2>

                    <div class="qm-ins-summary">
                        <div class="qm-ins-summary-item">
                            <span>Passed</span>
                            <strong>{{ $resultCounts['pass'] }}</strong>
                        </div>

                        <div class="qm-ins-summary-item">
                            <span>Failed</span>
                            <strong>{{ $resultCounts['fail'] }}</strong>
                        </div>

                        <div class="qm-ins-summary-item">
                            <span>Conditional</span>
                            <strong>{{ $resultCounts['conditional'] }}</strong>
                        </div>

                        <div class="qm-ins-summary-item">
                            <span>Pending Result</span>
                            <strong>{{ $resultCounts['pending'] }}</strong>
                        </div>
                    </div>
                </section>

            </div>

            <section class="qm-ins-registry">
                <div class="qm-ins-registry-header">
                    <div>
                        <h2>Company Inspection Registry</h2>
                        <p style="margin-top: 6px; color: #7f9ab5; font-size: 11px;">
                            Review inspection execution and evaluation records.
                        </p>
                    </div>

                    <span>{{ $inspections->total() }} RECORDS</span>
                </div>

                <div class="qm-ins-table-wrap">
                    <table class="qm-ins-table">
                        <thead>
                            <tr>
                                <th>Inspection Number</th>
                                <th>Type</th>
                                <th>Factory</th>
                                <th>Production Line</th>
                                <th>Machine</th>
                                <th>Inspector</th>
                                <th>Inspection Date</th>
                                <th>Status</th>
                                <th>Result</th>
                                <th>Review</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($inspections as $inspection)
                                <tr>
                                    <td>
                                        <span class="qm-ins-primary">
                                            {{ $inspection->inspection_number }}
                                        </span>
                                    </td>

                                    <td>{{ ucfirst($inspection->inspection_type) }}</td>

                                    <td>
                                        {{ $inspection->factory?->name ?? '—' }}
                                    </td>

                                    <td>
                                        {{ $inspection->productionLine?->name ?? '—' }}
                                    </td>

                                    <td>
                                        {{ $inspection->machine?->name ?? '—' }}
                                    </td>

                                    <td>
                                        {{ $inspection->inspector?->name ?? '—' }}
                                    </td>

                                    <td>
                                        {{ $inspection->inspection_date?->format('d M Y, h:i A') ?? '—' }}
                                    </td>

                                    <td>
                                        <span class="qm-ins-badge qm-ins-{{ $inspection->status }}">
                                            {{ ucfirst(str_replace('_', ' ', $inspection->status)) }}
                                        </span>
                                    </td>

                                    <td>
                                        @if ($inspection->result)
                                            <span class="qm-ins-badge qm-ins-{{ $inspection->result }}">
                                                {{ ucfirst($inspection->result) }}
                                            </span>
                                        @else
                                            <span class="qm-ins-secondary">Pending</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a
                                            href="{{ route('qm.inspections.show', $inspection->id) }}"
                                            class="qm-ins-link">
                                            Review →
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="qm-ins-empty">
                                        No inspection records have been recorded for this company.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($inspections->hasPages())
                    <div class="qm-ins-pagination">
                        {{ $inspections->links() }}
                    </div>
                @endif
            </section>

        </div>
    </div>
</x-app-layout>
