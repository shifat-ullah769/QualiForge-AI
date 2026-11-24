<x-app-layout>
    <div style="min-height:100vh;padding:30px;background:#07111f;color:#e5edf7;">
        <div style="max-width:1250px;margin:auto;">

            {{-- Header --}}
            <div style="margin-bottom:28px;">
                <h1 style="font-size:27px;font-weight:700;color:#f8fafc;">
                    Root Cause Analysis
                </h1>
                <p style="color:#94a3b8;font-size:13px;">
                    Analyze defect patterns across machines and production lines.
                </p>
            </div>

            {{-- Summary Cards --}}
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:15px;margin-bottom:25px;">

                @foreach([
                ['Total Defect Records', $totalRecords],
                ['Total Defect Quantity', $totalQuantity],
                ['Open / Investigating', $openDefects],
                ['Resolved Defects', $resolvedDefects],
                ] as $item)

                <div style="padding:20px;background:#101d2e;border:1px solid #1e334a;border-radius:12px;">
                    <div style="font-size:12px;color:#94a3b8;margin-bottom:12px;">
                        {{ $item[0] }}
                    </div>

                    <div style="font-size:28px;font-weight:750;color:#f8fafc;">
                        {{ $item[1] }}
                    </div>
                </div>

                @endforeach

            </div>

            {{-- Defect Type Analysis --}}
            <section style="padding:22px;margin-bottom:20px;background:#101d2e;border:1px solid #1e334a;border-radius:12px;">

                <h2 style="font-size:17px;font-weight:700;margin-bottom:20px;">
                    Defect Type Analysis
                </h2>

                @forelse($defectTypeAnalysis as $item)

                @php
                $barWidth = $totalRecords > 0
                ? ($item->total_records / $totalRecords) * 100
                : 0;
                @endphp

                <div style="margin-bottom:18px;">

                    <div style="display:flex;justify-content:space-between;gap:10px;font-size:12px;margin-bottom:7px;">
                        <strong>{{ $item->defect_type }}</strong>

                        <span style="color:#94a3b8;">
                            {{ $item->total_records }} records
                            / {{ $item->total_quantity }} units
                        </span>
                    </div>

                    <progress
                        value="{{ $barWidth }}"
                        max="100"
                        style="width:100%;height:12px;accent-color:#22d3ee;"></progress>

                </div>

                @empty

                <p style="color:#94a3b8;font-size:13px;">
                    No defect data available.
                </p>

                @endforelse

            </section>

            {{-- Severity Analysis --}}
            <section style="padding:22px;margin-bottom:20px;background:#101d2e;border:1px solid #1e334a;border-radius:12px;">

                <h2 style="font-size:17px;font-weight:700;margin-bottom:18px;">
                    Severity Distribution
                </h2>

                <div style="display:flex;flex-wrap:wrap;gap:12px;">

                    @forelse($severityAnalysis as $item)

                    <div style="flex:1;min-width:120px;padding:16px;background:#0b1727;border:1px solid #26384d;border-radius:9px;">

                        <div style="font-size:11px;color:#94a3b8;text-transform:capitalize;">
                            {{ $item->severity }}
                        </div>

                        <div style="font-size:25px;font-weight:750;margin-top:8px;">
                            {{ $item->total }}
                        </div>

                        <div style="font-size:10px;color:#64748b;">
                            Records
                        </div>

                    </div>

                    @empty

                    <p style="color:#94a3b8;font-size:13px;">
                        No severity data available.
                    </p>

                    @endforelse

                </div>

            </section>

            {{-- Machine Analysis --}}
            <section style="padding:22px;margin-bottom:20px;background:#101d2e;border:1px solid #1e334a;border-radius:12px;">

                <h2 style="font-size:17px;font-weight:700;margin-bottom:18px;">
                    Machine-wise Analysis
                </h2>

                <div style="overflow-x:auto;">

                    <table style="width:100%;border-collapse:collapse;min-width:450px;">

                        <thead>
                            <tr style="color:#94a3b8;text-align:left;font-size:11px;">
                                <th style="padding:12px;">Machine</th>
                                <th style="padding:12px;">Defect Records</th>
                                <th style="padding:12px;">Defect Quantity</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($machineAnalysis as $item)

                            <tr style="border-top:1px solid #26384d;font-size:13px;">

                                <td style="padding:14px;">
                                    {{ $item->machine_name ?? 'Unassigned' }}
                                </td>

                                <td style="padding:14px;">
                                    {{ $item->total_records }}
                                </td>

                                <td style="padding:14px;">
                                    {{ $item->total_quantity }}
                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="3" style="padding:15px;color:#94a3b8;">
                                    No machine data available.
                                </td>
                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </section>

            {{-- Production Line Analysis --}}
            <section style="padding:22px;margin-bottom:20px;background:#101d2e;border:1px solid #1e334a;border-radius:12px;">

                <h2 style="font-size:17px;font-weight:700;margin-bottom:18px;">
                    Production Line Analysis
                </h2>

                <div style="overflow-x:auto;">

                    <table style="width:100%;border-collapse:collapse;min-width:450px;">

                        <thead>
                            <tr style="color:#94a3b8;text-align:left;font-size:11px;">
                                <th style="padding:12px;">Production Line</th>
                                <th style="padding:12px;">Defect Records</th>
                                <th style="padding:12px;">Defect Quantity</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($productionLineAnalysis as $item)

                            <tr style="border-top:1px solid #26384d;font-size:13px;">

                                <td style="padding:14px;">
                                    {{ $item->line_name ?? 'Unassigned' }}
                                </td>

                                <td style="padding:14px;">
                                    {{ $item->total_records }}
                                </td>

                                <td style="padding:14px;">
                                    {{ $item->total_quantity }}
                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="3" style="padding:15px;color:#94a3b8;">
                                    No production line data available.
                                </td>
                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </section>

            {{-- Analysis Limitation --}}
            <section style="padding:18px;background:#172438;border:1px solid #854d0e;border-radius:10px;">

                <h2 style="font-size:14px;font-weight:700;color:#fbbf24;margin-bottom:9px;">
                    Analysis Limitation
                </h2>

                <p style="font-size:12px;line-height:1.8;color:#cbd5e1;">
                    This analysis identifies patterns in recorded defect data.
                    Machine-wise or production-line associations do not establish
                    actual root causes. Further investigation and supporting
                    operational evidence are required to confirm causal factors.
                </p>

            </section>

        </div>
    </div>
</x-app-layout>