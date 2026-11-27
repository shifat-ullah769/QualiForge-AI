<x-app-layout>

    <div class="ps-monitoring">

        <div class="ps-container">

            {{-- PAGE HEADER --}}

            <div class="ps-header">
                <div>
                    <span class="ps-eyebrow">PRODUCTION OPERATIONS</span>
                    <h1>Production & Machine Monitoring</h1>
                    <p>
                        View the factory, production lines and machines
                        assigned to your responsibility.
                    </p>
                </div>

                <div class="ps-readonly-badge">
                    <i class="bi bi-eye"></i>
                    Read-only Monitoring
                </div>
            </div>

            {{-- SUMMARY --}}

            <div class="ps-summary">

                <div class="ps-summary-card">
                    <span>Active Assignments</span>
                    <strong>{{ $assignments->count() }}</strong>
                    <i class="bi bi-clipboard-check"></i>
                </div>

                <div class="ps-summary-card">
                    <span>Assigned Factories</span>
                    <strong>{{ $assignments->pluck('factory_id')->unique()->count() }}</strong>
                    <i class="bi bi-buildings"></i>
                </div>

                <div class="ps-summary-card">
                    <span>Production Lines</span>
                    <strong>{{ $assignments->pluck('production_line_id')->filter()->unique()->count() }}</strong>
                    <i class="bi bi-diagram-3"></i>
                </div>

                <div class="ps-summary-card">
                    <span>Assigned Machines</span>
                    <strong>{{ $assignments->pluck('machine_id')->filter()->unique()->count() }}</strong>
                    <i class="bi bi-gear"></i>
                </div>

            </div>

            {{-- ASSIGNED RESOURCES --}}

            <div class="ps-section-heading">
                <div>
                    <span class="ps-section-label">YOUR RESPONSIBILITY</span>
                    <h2>Assigned Production Resources</h2>
                </div>
            </div>

            @forelse($assignments as $assignment)

                <div class="ps-resource-card">

                    {{-- FACTORY --}}

                    <div class="ps-resource-header">
                        <div class="ps-resource-title">
                            <div class="ps-resource-icon factory-icon">
                                <i class="bi bi-buildings"></i>
                            </div>

                            <div>
                                <span class="ps-resource-label">FACTORY</span>
                                <h3>{{ $assignment->factory?->name ?? 'Not specified' }}</h3>
                            </div>
                        </div>

                        <span class="ps-status {{ strtolower($assignment->factory?->status ?? 'unknown') }}">
                            {{ ucfirst($assignment->factory?->status ?? 'Unknown') }}
                        </span>
                    </div>

                    <div class="ps-resource-details">

                        <div class="ps-detail-item">
                            <span>Factory Code</span>
                            <strong>{{ $assignment->factory?->factory_code ?? '—' }}</strong>
                        </div>

                        <div class="ps-detail-item">
                            <span>Location</span>
                            <strong>
                                {{ collect([
                                    $assignment->factory?->city,
                                    $assignment->factory?->country
                                ])->filter()->implode(', ') ?: '—' }}
                            </strong>
                        </div>

                        <div class="ps-detail-item">
                            <span>Address</span>
                            <strong>{{ $assignment->factory?->address ?? '—' }}</strong>
                        </div>

                    </div>

                    {{-- PRODUCTION LINE --}}

                    <div class="ps-subresource">

                        <div class="ps-subresource-header">
                            <div class="ps-resource-title">
                                <div class="ps-resource-icon line-icon">
                                    <i class="bi bi-diagram-3"></i>
                                </div>

                                <div>
                                    <span class="ps-resource-label">PRODUCTION LINE</span>
                                    <h3>{{ $assignment->productionLine?->name ?? 'All assigned lines' }}</h3>
                                </div>
                            </div>

                            @if($assignment->productionLine)
                                <span class="ps-status {{ strtolower($assignment->productionLine->status) }}">
                                    {{ ucfirst($assignment->productionLine->status) }}
                                </span>
                            @endif
                        </div>

                        @if($assignment->productionLine)

                            <div class="ps-resource-details">

                                <div class="ps-detail-item">
                                    <span>Line Code</span>
                                    <strong>{{ $assignment->productionLine->code ?? '—' }}</strong>
                                </div>

                                <div class="ps-detail-item">
                                    <span>Location</span>
                                    <strong>{{ $assignment->productionLine->location ?? '—' }}</strong>
                                </div>

                                <div class="ps-detail-item">
                                    <span>Description</span>
                                    <strong>{{ $assignment->productionLine->description ?? '—' }}</strong>
                                </div>

                            </div>

                        @else

                            <p class="ps-scope-note">
                                This assignment covers the factory-level production scope.
                            </p>

                        @endif

                        {{-- MACHINE --}}

                        <div class="ps-machine-panel">

                            <div class="ps-subresource-header">
                                <div class="ps-resource-title">
                                    <div class="ps-resource-icon machine-icon">
                                        <i class="bi bi-gear-wide-connected"></i>
                                    </div>

                                    <div>
                                        <span class="ps-resource-label">ASSIGNED MACHINE</span>
                                        <h3>{{ $assignment->machine?->name ?? 'All machines in assigned scope' }}</h3>
                                    </div>
                                </div>

                                @if($assignment->machine)
                                    <span class="ps-status {{ strtolower($assignment->machine->status) }}">
                                        {{ ucfirst($assignment->machine->status) }}
                                    </span>
                                @endif
                            </div>

                            @if($assignment->machine)

                                <div class="ps-machine-details">

                                    <div class="ps-detail-item">
                                        <span>Machine Code</span>
                                        <strong>{{ $assignment->machine->machine_code ?? '—' }}</strong>
                                    </div>

                                    <div class="ps-detail-item">
                                        <span>Machine Type</span>
                                        <strong>{{ $assignment->machine->machine_type ?? '—' }}</strong>
                                    </div>

                                    <div class="ps-detail-item">
                                        <span>Manufacturer</span>
                                        <strong>{{ $assignment->machine->manufacturer ?? '—' }}</strong>
                                    </div>

                                    <div class="ps-detail-item">
                                        <span>Model Number</span>
                                        <strong>{{ $assignment->machine->model_number ?? '—' }}</strong>
                                    </div>

                                    <div class="ps-detail-item">
                                        <span>Serial Number</span>
                                        <strong>{{ $assignment->machine->serial_number ?? '—' }}</strong>
                                    </div>

                                    <div class="ps-detail-item">
                                        <span>Installation Date</span>
                                        <strong>
                                            {{ $assignment->machine->installation_date?->format('d M Y') ?? '—' }}
                                        </strong>
                                    </div>

                                </div>

                            @else

                                <p class="ps-scope-note">
                                    This assignment covers machines within the selected production scope.
                                </p>

                            @endif

                            <div class="ps-monitoring-note">
                                <i class="bi bi-info-circle"></i>
                                Displayed status represents the saved administrative record.
                                Live sensor monitoring is not currently connected.
                            </div>

                        </div>

                    </div>

                    {{-- ASSIGNMENT INFORMATION --}}

                    <div class="ps-assignment-info">
                        <span>
                            <i class="bi bi-calendar-check"></i>
                            Assigned: {{ $assignment->assigned_at?->format('d M Y') ?? '—' }}
                        </span>

                        <span>
                            <i class="bi bi-person-check"></i>
                            Assignment: {{ ucfirst($assignment->status) }}
                        </span>
                    </div>

                </div>

            @empty

                <div class="ps-empty">
                    <i class="bi bi-inbox"></i>
                    <h3>No Active Production Assignment</h3>
                    <p>
                        No production resources are currently assigned to your account.
                        Please contact your Company Administrator.
                    </p>
                </div>

            @endforelse

        </div>

    </div>

    <style>
        .ps-monitoring {
            --ps-bg: #07111f;
            --ps-surface: #0e1c2e;
            --ps-border: #26394e;
            --ps-text: #f8fafc;
            --ps-muted: #94a3b8;
            --ps-cyan: #22d3ee;

            min-height: calc(100vh - 64px);
            padding: 32px 24px 55px;
            background:
                radial-gradient(circle at 5% 5%, rgba(34,211,238,.07), transparent 28%),
                var(--ps-bg);
            color: var(--ps-text);
        }

        .ps-container {
            max-width: 1380px;
            margin: auto;
        }

        .ps-header,
        .ps-section-heading,
        .ps-resource-header,
        .ps-subresource-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .ps-header {
            margin-bottom: 28px;
        }

        .ps-eyebrow,
        .ps-section-label,
        .ps-resource-label {
            color: var(--ps-cyan);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .13em;
        }

        .ps-header h1 {
            margin: 8px 0;
            font-size: 29px;
            font-weight: 750;
        }

        .ps-header p {
            margin: 0;
            color: var(--ps-muted);
            font-size: 13px;
        }

        .ps-readonly-badge {
            padding: 10px 14px;
            border: 1px solid var(--ps-border);
            border-radius: 9px;
            color: var(--ps-cyan);
            background: var(--ps-surface);
            font-size: 11px;
            white-space: nowrap;
        }

        .ps-summary {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 35px;
        }

        .ps-summary-card {
            position: relative;
            padding: 20px;
            border: 1px solid var(--ps-border);
            border-radius: 12px;
            background: var(--ps-surface);
        }

        .ps-summary-card span {
            display: block;
            color: var(--ps-muted);
            font-size: 11px;
        }

        .ps-summary-card strong {
            display: block;
            margin-top: 12px;
            font-size: 29px;
        }

        .ps-summary-card > i {
            position: absolute;
            top: 19px;
            right: 19px;
            color: var(--ps-cyan);
            font-size: 20px;
        }

        .ps-section-heading {
            margin-bottom: 17px;
        }

        .ps-section-heading h2 {
            margin: 6px 0;
            font-size: 20px;
            font-weight: 700;
        }

        .ps-resource-card {
            margin-bottom: 20px;
            padding: 23px;
            border: 1px solid var(--ps-border);
            border-radius: 13px;
            background: linear-gradient(145deg, #101f32, #0b1829);
        }

        .ps-resource-title {
            display: flex;
            align-items: center;
            gap: 13px;
            min-width: 0;
        }

        .ps-resource-icon {
            display: grid;
            place-items: center;
            flex-shrink: 0;
            width: 43px;
            height: 43px;
            border-radius: 10px;
            font-size: 19px;
        }

        .factory-icon {
            color: #22d3ee;
            background: rgba(34,211,238,.12);
        }

        .line-icon {
            color: #a78bfa;
            background: rgba(139,92,246,.13);
        }

        .machine-icon {
            color: #4ade80;
            background: rgba(34,197,94,.12);
        }

        .ps-resource-title h3 {
            margin: 5px 0 0;
            font-size: 15px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .ps-status {
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
            white-space: nowrap;
            background: rgba(148,163,184,.1);
            color: #cbd5e1;
        }

        .ps-status.active {
            color: #4ade80;
            background: rgba(34,197,94,.1);
        }

        .ps-status.inactive {
            color: #f87171;
            background: rgba(239,68,68,.1);
        }

        .ps-resource-details,
        .ps-machine-details {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-top: 22px;
        }

        .ps-detail-item {
            min-width: 0;
        }

        .ps-detail-item span {
            display: block;
            margin-bottom: 6px;
            color: var(--ps-muted);
            font-size: 10px;
        }

        .ps-detail-item strong {
            display: block;
            font-size: 12px;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .ps-subresource {
            margin-top: 25px;
            padding-top: 22px;
            border-top: 1px solid rgba(148,163,184,.13);
        }

        .ps-machine-panel {
            margin-top: 22px;
            padding: 19px;
            border: 1px solid rgba(34,211,238,.15);
            border-radius: 11px;
            background: rgba(34,211,238,.025);
        }

        .ps-monitoring-note {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            margin-top: 22px;
            padding: 12px;
            border-radius: 8px;
            background: rgba(245,158,11,.07);
            color: #fbbf24;
            font-size: 10px;
            line-height: 1.6;
        }

        .ps-scope-note {
            margin: 15px 0 0;
            color: var(--ps-muted);
            font-size: 11px;
        }

        .ps-assignment-info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 23px;
            padding-top: 15px;
            border-top: 1px solid rgba(148,163,184,.12);
            color: var(--ps-muted);
            font-size: 10px;
        }

        .ps-empty {
            padding: 50px 20px;
            border: 1px dashed var(--ps-border);
            border-radius: 12px;
            text-align: center;
            color: var(--ps-muted);
        }

        .ps-empty > i {
            font-size: 35px;
            color: var(--ps-cyan);
        }

        .ps-empty h3 {
            color: var(--ps-text);
            font-size: 17px;
        }

        .ps-empty p {
            font-size: 12px;
        }

        @media(max-width: 900px) {
            .ps-summary { grid-template-columns: repeat(2, 1fr); }
            .ps-resource-details,
            .ps-machine-details { grid-template-columns: repeat(2, 1fr); }
        }

        @media(max-width: 600px) {
            .ps-monitoring { padding: 25px 14px; }
            .ps-header { align-items: flex-start; flex-direction: column; }
            .ps-header h1 { font-size: 23px; }
            .ps-summary { grid-template-columns: 1fr 1fr; }
            .ps-resource-header,
            .ps-subresource-header { align-items: flex-start; flex-direction: column; }
            .ps-resource-details,
            .ps-machine-details { grid-template-columns: 1fr; }
        }
    </style>

</x-app-layout>
