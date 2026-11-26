<x-app-layout>
    <div class="qm-defect-page">
        <style>
            .qm-defect-page {
                min-height: 100vh;
                padding: 30px;
                background: #07111f;
                color: #e5edf7;
            }

            .qm-defect-container {
                max-width: 1450px;
                margin: auto;
            }

            .qm-defect-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 20px;
                flex-wrap: wrap;
                margin-bottom: 25px;
            }

            .qm-defect-eyebrow {
                color: #22d3ee;
                font-size: 10px;
                font-weight: 800;
                letter-spacing: 1.5px;
            }

            .qm-defect-header h1 {
                margin: 8px 0;
                color: #f8fafc;
                font-size: 27px;
                font-weight: 750;
            }

            .qm-defect-header p {
                color: #94a3b8;
                font-size: 13px;
            }

            .qm-defect-readonly {
                padding: 10px 14px;
                border: 1px solid #164e63;
                border-radius: 8px;
                background: rgba(8, 145, 178, .10);
                color: #67e8f9;
                font-size: 10px;
                font-weight: 800;
                letter-spacing: .5px;
            }

            .qm-defect-kpis {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 14px;
                margin-bottom: 22px;
            }

            .qm-defect-kpi {
                padding: 20px;
                border: 1px solid #20364e;
                border-radius: 12px;
                background: #101d2e;
            }

            .qm-defect-kpi span {
                display: block;
                margin-bottom: 12px;
                color: #94a3b8;
                font-size: 11px;
            }

            .qm-defect-kpi strong {
                color: #f8fafc;
                font-size: 28px;
                font-weight: 750;
            }

            .qm-defect-kpi small {
                display: block;
                margin-top: 7px;
                color: #64748b;
                font-size: 10px;
            }

            .qm-defect-analysis {
                display: grid;
                grid-template-columns: 1.1fr .9fr;
                gap: 18px;
                margin-bottom: 22px;
            }

            .qm-defect-panel {
                padding: 22px;
                border: 1px solid #20364e;
                border-radius: 12px;
                background: #101d2e;
            }

            .qm-defect-panel h2 {
                margin: 0 0 20px;
                color: #f1f5f9;
                font-size: 15px;
                font-weight: 750;
            }

            .qm-defect-severity-row {
                margin-bottom: 17px;
            }

            .qm-defect-severity-heading {
                display: flex;
                justify-content: space-between;
                gap: 10px;
                margin-bottom: 8px;
                color: #cbd5e1;
                font-size: 11px;
            }

            .qm-defect-track {
                height: 10px;
                overflow: hidden;
                border-radius: 20px;
                background: #26384d;
            }

            .qm-defect-fill {
                height: 100%;
                min-width: 0;
                border-radius: 20px;
            }

            .qm-defect-critical {
                background: #ef4444;
            }

            .qm-defect-high {
                background: #f97316;
            }

            .qm-defect-medium {
                background: #eab308;
            }

            .qm-defect-low {
                background: #22c55e;
            }

            .qm-defect-type-list {
                display: grid;
                gap: 12px;
            }

            .qm-defect-type-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 12px;
                padding-bottom: 11px;
                border-bottom: 1px solid #20364e;
                color: #cbd5e1;
                font-size: 12px;
            }

            .qm-defect-type-item:last-child {
                padding-bottom: 0;
                border-bottom: 0;
            }

            .qm-defect-type-item strong {
                color: #22d3ee;
            }

            .qm-defect-registry {
                overflow: hidden;
                border: 1px solid #20364e;
                border-radius: 12px;
                background: #101d2e;
            }

            .qm-defect-registry-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 15px;
                flex-wrap: wrap;
                padding: 21px;
                border-bottom: 1px solid #20364e;
            }

            .qm-defect-registry-header h2 {
                color: #f1f5f9;
                font-size: 15px;
                font-weight: 750;
            }

            .qm-defect-registry-header span {
                color: #22d3ee;
                font-size: 10px;
                font-weight: 800;
            }

            .qm-defect-table-wrap {
                width: 100%;
                overflow-x: auto;
            }

            .qm-defect-table {
                width: 100%;
                min-width: 1050px;
                border-collapse: collapse;
            }

            .qm-defect-table th {
                padding: 14px 16px;
                background: #0b1727;
                color: #7f9ab5;
                text-align: left;
                font-size: 9px;
                font-weight: 800;
                letter-spacing: .7px;
                text-transform: uppercase;
                white-space: nowrap;
            }

            .qm-defect-table td {
                padding: 16px;
                border-top: 1px solid #20364e;
                color: #cbd5e1;
                font-size: 11px;
                vertical-align: middle;
            }

            .qm-defect-table tr:hover td {
                background: rgba(34, 211, 238, .025);
            }

            .qm-defect-primary {
                display: block;
                color: #f1f5f9;
                font-weight: 700;
            }

            .qm-defect-secondary {
                display: block;
                margin-top: 5px;
                color: #71869f;
                font-size: 10px;
            }

            .qm-defect-badge {
                display: inline-block;
                padding: 5px 9px;
                border-radius: 20px;
                font-size: 9px;
                font-weight: 800;
                text-transform: uppercase;
                white-space: nowrap;
            }

            .qm-severity-critical {
                background: rgba(239, 68, 68, .14);
                color: #fca5a5;
            }

            .qm-severity-high {
                background: rgba(249, 115, 22, .14);
                color: #fdba74;
            }

            .qm-severity-medium {
                background: rgba(234, 179, 8, .14);
                color: #fde047;
            }

            .qm-severity-low {
                background: rgba(34, 197, 94, .14);
                color: #86efac;
            }

            .qm-status-open {
                background: rgba(239, 68, 68, .12);
                color: #fca5a5;
            }

            .qm-status-investigating {
                background: rgba(234, 179, 8, .12);
                color: #fde047;
            }

            .qm-status-resolved {
                background: rgba(34, 197, 94, .12);
                color: #86efac;
            }

            .qm-defect-link {
                color: #22d3ee;
                font-size: 11px;
                font-weight: 750;
                text-decoration: none;
                white-space: nowrap;
            }

            .qm-defect-link:hover {
                color: #a5f3fc;
            }

            .qm-defect-empty {
                padding: 35px;
                color: #94a3b8;
                text-align: center;
                font-size: 12px;
            }

            .qm-defect-pagination {
                padding: 18px;
                border-top: 1px solid #20364e;
            }

            .qm-defect-pagination nav p {
                color: #94a3b8;
                font-size: 11px;
            }

            .qm-defect-pagination nav a,
            .qm-defect-pagination nav span {
                font-size: 11px;
            }

            @media (max-width: 1000px) {
                .qm-defect-kpis {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .qm-defect-analysis {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width: 600px) {
                .qm-defect-page {
                    padding: 20px 12px;
                }

                .qm-defect-kpis {
                    grid-template-columns: 1fr 1fr;
                }

                .qm-defect-kpi {
                    padding: 15px;
                }
            }
        </style>

        <div class="qm-defect-container">

            <div class="qm-defect-header">
                <div>
                    <div class="qm-defect-eyebrow">
                        QUALITY INTELLIGENCE / DEFECT OVERSIGHT
                    </div>
                    <h1>Defect Intelligence</h1>
                    <p>
                        Monitor company-wide defect records, severity distribution
                        and unresolved quality issues.
                    </p>
                </div>

                <div class="qm-defect-readonly">
                    READ-ONLY MONITORING
                </div>
            </div>

            <div class="qm-defect-kpis">
                <div class="qm-defect-kpi">
                    <span>Total Defects</span>
                    <strong>{{ number_format($totalDefects) }}</strong>
                    <small>Recorded company defects</small>
                </div>

                <div class="qm-defect-kpi">
                    <span>Open Defects</span>
                    <strong>{{ number_format($openDefects) }}</strong>
                    <small>Awaiting investigation</small>
                </div>

                <div class="qm-defect-kpi">
                    <span>Investigating</span>
                    <strong>{{ number_format($investigatingDefects) }}</strong>
                    <small>Under active review</small>
                </div>

                <div class="qm-defect-kpi">
                    <span>Resolved</span>
                    <strong>{{ number_format($resolvedDefects) }}</strong>
                    <small>Marked as resolved</small>
                </div>
            </div>

            <div class="qm-defect-analysis">

                <section class="qm-defect-panel">
                    <h2>Severity Distribution</h2>

                    @php
                    $severityColors = [
                    'critical' => 'qm-defect-critical',
                    'high' => 'qm-defect-high',
                    'medium' => 'qm-defect-medium',
                    'low' => 'qm-defect-low',
                    ];
                    @endphp

                    @foreach ($severityCounts as $severity => $count)
                    @php
                    $percentage = $totalDefects > 0
                    ? ($count / $totalDefects) * 100
                    : 0;
                    @endphp

                    <div class="qm-defect-severity-row">
                        <div class="qm-defect-severity-heading">
                            <span>{{ ucfirst($severity) }} Severity</span>
                            <strong>
                                {{ $count }} ({{ number_format($percentage, 1) }}%)
                            </strong>
                        </div>

                        <div class="qm-defect-track">
                            <div
                                class="qm-defect-fill {{ $severityColors[$severity] }}"
                                @style(['width'=> $percentage . '%'])>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </section>

                <section class="qm-defect-panel">
                    <h2>Most Recorded Defect Types</h2>

                    @forelse ($defectTypes as $type)
                    <div class="qm-defect-type-list">
                        <div class="qm-defect-type-item">
                            <span>{{ $type->defect_type ?: 'Unspecified' }}</span>
                            <strong>{{ $type->total }}</strong>
                        </div>
                    </div>
                    @empty
                    <p class="qm-defect-empty">
                        No defect type data is available.
                    </p>
                    @endforelse

                    <div style="margin-top: 22px; padding-top: 15px; border-top: 1px solid #20364e;">
                        <div class="qm-defect-type-item">
                            <span>Critical Severity</span>
                            <strong>{{ $criticalDefects }}</strong>
                        </div>

                        <div class="qm-defect-type-item" style="margin-top: 12px;">
                            <span>High Severity</span>
                            <strong>{{ $highDefects }}</strong>
                        </div>
                    </div>
                </section>

            </div>

            <section class="qm-defect-registry">
                <div class="qm-defect-registry-header">
                    <div>
                        <h2>Company Defect Registry</h2>
                        <p style="margin-top: 6px; color: #7f9ab5; font-size: 11px;">
                            Review reported defects and their production context.
                        </p>
                    </div>

                    <span>{{ $defects->total() }} RECORDS</span>
                </div>

                <div class="qm-defect-table-wrap">
                    <table class="qm-defect-table">
                        <thead>
                            <tr>
                                <th>Defect</th>
                                <th>Production Context</th>
                                <th>Batch / Product</th>
                                <th>Quantity</th>
                                <th>Severity</th>
                                <th>Status</th>
                                <th>Reported By</th>
                                <th>Detected</th>
                                <th>Review</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($defects as $defect)
                            <tr>
                                <td>
                                    <span class="qm-defect-primary">
                                        {{ $defect->defect_type }}
                                    </span>
                                    <span class="qm-defect-secondary">
                                        Defect #{{ $defect->id }}
                                    </span>
                                </td>

                                <td>
                                    <span class="qm-defect-primary">
                                        {{ $defect->factory?->name ?? '—' }}
                                    </span>
                                    <span class="qm-defect-secondary">
                                        {{ $defect->productionLine?->name ?? '—' }}
                                    </span>
                                    <span class="qm-defect-secondary">
                                        {{ $defect->machine?->name ?? '—' }}
                                    </span>
                                </td>

                                <td>
                                    <span>{{ $defect->batch_number ?? '—' }}</span>
                                    <span class="qm-defect-secondary">
                                        {{ $defect->product_code ?? '—' }}
                                    </span>
                                </td>

                                <td>
                                    {{ number_format($defect->defect_quantity) }}
                                </td>

                                <td>
                                    <span class="qm-defect-badge qm-severity-{{ $defect->severity }}">
                                        {{ $defect->severity }}
                                    </span>
                                </td>

                                <td>
                                    <span class="qm-defect-badge qm-status-{{ $defect->status }}">
                                        {{ $defect->status }}
                                    </span>
                                </td>

                                <td>
                                    {{ $defect->reporter?->name ?? 'Unknown' }}
                                </td>

                                <td>
                                    {{ $defect->detected_at?->format('d M Y') ?? '—' }}
                                </td>

                                <td>
                                    <a
                                        href="{{ route('qm.defects.show', $defect->id) }}"
                                        class="qm-defect-link">
                                        Review →
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="qm-defect-empty">
                                    No defect records have been reported for this company.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($defects->hasPages())
                <div class="qm-defect-pagination">
                    {{ $defects->links() }}
                </div>
                @endif
            </section>

        </div>
    </div>
</x-app-layout>