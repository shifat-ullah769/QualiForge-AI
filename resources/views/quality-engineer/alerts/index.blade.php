<x-app-layout>
    <div style="min-height:100vh;padding:30px;background:#07111f;color:#e5edf7;">
        <div style="max-width:1250px;margin:auto;">

            <div style="margin-bottom:28px;">
                <h1 style="font-size:27px;font-weight:700;color:#f8fafc;">
                    Quality Alerts
                </h1>
                <p style="color:#94a3b8;font-size:13px;">
                    Monitor important quality issues across your production operations.
                </p>
            </div>

            @php
                $totalAlerts = $defects->count()
                    + $inspections->count()
                    + $predictions->count();
            @endphp

            <div style="padding:20px;margin-bottom:24px;background:#101d2e;border:1px solid #1e334a;border-radius:12px;">
                <span style="color:#94a3b8;font-size:12px;">Total Active Alerts</span>
                <div style="font-size:30px;font-weight:750;color:#f8fafc;">
                    {{ $totalAlerts }}
                </div>
            </div>

            {{-- High and Critical Defects --}}
            <section style="margin-bottom:25px;">
                <h2 style="font-size:17px;font-weight:700;margin-bottom:14px;">
                    High / Critical Defects ({{ $defects->count() }})
                </h2>

                @forelse($defects as $defect)
                    <div style="padding:17px;margin-bottom:10px;background:#101d2e;border:1px solid #713f46;border-radius:10px;">
                        <div style="display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap;">
                            <strong>{{ $defect->defect_type }}</strong>
                            <span style="color:#fca5a5;font-size:12px;font-weight:700;">
                                {{ ucfirst($defect->severity) }} Priority
                            </span>
                        </div>

                        <p style="margin-top:8px;color:#94a3b8;font-size:12px;">
                            Status: {{ ucfirst(str_replace('_', ' ', $defect->status)) }}
                            | Quantity: {{ $defect->defect_quantity }}
                        </p>

                        <a href="{{ route('qe.defects.show', $defect->id) }}"
                           style="display:inline-block;margin-top:10px;color:#22d3ee;font-size:12px;">
                            View Defect Details →
                        </a>
                    </div>
                @empty
                    <p style="color:#94a3b8;font-size:13px;">No high or critical unresolved defects.</p>
                @endforelse
            </section>

            {{-- Failed and Conditional Inspections --}}
            <section style="margin-bottom:25px;">
                <h2 style="font-size:17px;font-weight:700;margin-bottom:14px;">
                    Inspection Alerts ({{ $inspections->count() }})
                </h2>

                @forelse($inspections as $inspection)
                    <div style="padding:17px;margin-bottom:10px;background:#101d2e;border:1px solid #854d0e;border-radius:10px;">
                        <strong>{{ $inspection->inspection_number }}</strong>

                        <p style="margin-top:8px;color:#94a3b8;font-size:12px;">
                            Type: {{ ucfirst($inspection->inspection_type) }}
                            | Result: {{ ucfirst($inspection->result) }}
                        </p>

                        <a href="{{ route('qe.inspections.show', $inspection->id) }}"
                           style="display:inline-block;margin-top:10px;color:#22d3ee;font-size:12px;">
                            View Inspection Details →
                        </a>
                    </div>
                @empty
                    <p style="color:#94a3b8;font-size:13px;">No failed or conditional inspections.</p>
                @endforelse
            </section>

            {{-- Failed Predictions --}}
            <section>
                <h2 style="font-size:17px;font-weight:700;margin-bottom:14px;">
                    Failed Predictions ({{ $predictions->count() }})
                </h2>

                @forelse($predictions as $prediction)
                    <div style="padding:17px;margin-bottom:10px;background:#101d2e;border:1px solid #713f46;border-radius:10px;">
                        <strong>
                            {{ $prediction->dataset?->name ?? 'Unknown Dataset' }}
                        </strong>

                        <p style="margin-top:8px;color:#94a3b8;font-size:12px;">
                            Prediction ID: #{{ $prediction->id }}
                            | Status: {{ ucfirst($prediction->status) }}
                        </p>

                        <a href="{{ route('qe.predictions.show', $prediction->id) }}"
                           style="display:inline-block;margin-top:10px;color:#22d3ee;font-size:12px;">
                            View Prediction Details →
                        </a>
                    </div>
                @empty
                    <p style="color:#94a3b8;font-size:13px;">No failed predictions.</p>
                @endforelse
            </section>

        </div>
    </div>
</x-app-layout>
