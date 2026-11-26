<x-app-layout>

    <div class="qf-inspection-details">

        <style>
            .qf-inspection-details {
                max-width: 1100px;
                margin: 30px auto;
                padding: 0 20px 40px;
                color: #eaf2ff;
            }

            .qf-id-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 15px;
                margin-bottom: 25px;
            }

            .qf-id-header h1 {
                font-size: 27px;
                font-weight: 700;
                margin: 0 0 7px;
            }

            .qf-id-header p {
                color: #91a9c7;
                font-size: 13px;
                margin: 0;
            }

            .qf-id-panel {
                background: #111f31;
                border: 1px solid #263c55;
                border-radius: 13px;
                padding: 23px;
                margin-bottom: 20px;
            }

            .qf-id-panel h2 {
                font-size: 17px;
                margin: 0 0 20px;
            }

            .qf-id-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 20px;
            }

            .qf-id-item small {
                display: block;
                color: #91a9c7;
                font-size: 11px;
                margin-bottom: 7px;
            }

            .qf-id-item strong {
                display: block;
                font-size: 13px;
                color: #eaf2ff;
                overflow-wrap: anywhere;
            }

            .qf-id-badge {
                display: inline-block;
                padding: 5px 10px;
                border-radius: 20px;
                font-size: 10px;
                font-weight: 700;
                text-transform: capitalize;
            }

            .qf-id-scheduled {
                background: #17344b;
                color: #69c9ff;
            }

            .qf-id-in_progress,
            .qf-id-conditional {
                background: #40351a;
                color: #f3cb70;
            }

            .qf-id-completed,
            .qf-id-pass,
            .qf-id-resolved {
                background: #123b35;
                color: #5ce0b0;
            }

            .qf-id-cancelled,
            .qf-id-fail {
                background: #4b202c;
                color: #ff8298;
            }

            .qf-id-open {
                background: #4b202c;
                color: #ff8298;
            }

            .qf-id-investigating {
                background: #40351a;
                color: #f3cb70;
            }

            .qf-id-defect {
                padding: 17px;
                background: #091626;
                border: 1px solid #263c55;
                border-radius: 9px;
                margin-bottom: 12px;
            }

            .qf-id-defect p {
                color: #91a9c7;
                font-size: 12px;
                margin: 9px 0;
            }

            .qf-id-link {
                color: #16d2e9;
                text-decoration: none;
                font-weight: 700;
                font-size: 12px;
            }

            .qf-id-link:hover {
                text-decoration: underline;
            }

            .qf-id-empty {
                text-align: center;
                color: #91a9c7;
                padding: 25px 10px;
                font-size: 13px;
            }

            .qf-id-btn {
                display: inline-block;
                padding: 11px 17px;
                border-radius: 8px;
                text-decoration: none;
                font-weight: 700;
                font-size: 12px;
            }

            .qf-id-secondary {
                background: #26394f;
                color: #dce8f8;
            }

            .qf-id-disclosure {
                padding: 13px 16px;
                border: 1px solid #16465a;
                border-radius: 8px;
                background: #0b2536;
                color: #8eddf0;
                font-size: 12px;
                margin-bottom: 20px;
            }

            @media(max-width: 650px) {
                .qf-id-header {
                    align-items: flex-start;
                    flex-direction: column;
                }

                .qf-id-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>

        {{-- Header --}}
        <div class="qf-id-header">
            <div>
                <h1>Inspection Details</h1>
                <p>{{ $inspection->inspection_number }}</p>
            </div>

            <a href="{{ route('qm.inspections.index') }}"
                class="qf-id-btn qf-id-secondary">
                ← Back to Inspections
            </a>
        </div>

        <div class="qf-id-disclosure">
            <strong>Read-only monitoring:</strong>
            This inspection record is available for review.
            Updates and operational actions are managed by authorized users.
        </div>

        {{-- Inspection Overview --}}
        <div class="qf-id-panel">
            <h2>Inspection Overview</h2>

            <div class="qf-id-grid">

                <div class="qf-id-item">
                    <small>Inspection Number</small>
                    <strong>{{ $inspection->inspection_number }}</strong>
                </div>

                <div class="qf-id-item">
                    <small>Inspection Type</small>
                    <strong>{{ $inspection->inspection_type ?? '—' }}</strong>
                </div>

                <div class="qf-id-item">
                    <small>Inspection Date</small>
                    <strong>
                        {{ $inspection->inspection_date?->format('d M Y, h:i A') ?? '—' }}
                    </strong>
                </div>

                <div class="qf-id-item">
                    <small>Inspector</small>
                    <strong>{{ $inspection->inspector?->name ?? '—' }}</strong>
                </div>

                <div class="qf-id-item">
                    <small>Status</small>
                    <strong>
                        <span class="qf-id-badge qf-id-{{ $inspection->status }}">
                            {{ ucfirst(str_replace('_', ' ', $inspection->status)) }}
                        </span>
                    </strong>
                </div>

                <div class="qf-id-item">
                    <small>Result</small>
                    <strong>
                        @if ($inspection->result)
                            <span class="qf-id-badge qf-id-{{ $inspection->result }}">
                                {{ ucfirst($inspection->result) }}
                            </span>
                        @else
                            Not evaluated yet
                        @endif
                    </strong>
                </div>

            </div>
        </div>

        {{-- Production Information --}}
        <div class="qf-id-panel">
            <h2>Production Information</h2>

            <div class="qf-id-grid">

                <div class="qf-id-item">
                    <small>Factory</small>
                    <strong>{{ $inspection->factory?->name ?? '—' }}</strong>
                </div>

                <div class="qf-id-item">
                    <small>Production Line</small>
                    <strong>{{ $inspection->productionLine?->name ?? '—' }}</strong>
                </div>

                <div class="qf-id-item">
                    <small>Machine</small>
                    <strong>{{ $inspection->machine?->name ?? '—' }}</strong>
                </div>

                <div class="qf-id-item">
                    <small>Record Created At</small>
                    <strong>
                        {{ $inspection->created_at?->format('d M Y, h:i A') ?? '—' }}
                    </strong>
                </div>

            </div>
        </div>

        {{-- Inspection Findings --}}
        <div class="qf-id-panel">
            <h2>Inspection Findings</h2>

            <div class="qf-id-item">
                <small>Findings</small>
                <strong style="font-weight: 400; line-height: 1.8;">
                    {{ $inspection->findings ?: 'No inspection findings recorded.' }}
                </strong>
            </div>

            <hr style="border-color: #263c55; margin: 20px 0;">

            <div class="qf-id-item">
                <small>Additional Notes</small>
                <strong style="font-weight: 400; line-height: 1.8;">
                    {{ $inspection->notes ?: 'No additional notes recorded.' }}
                </strong>
            </div>
        </div>

        {{-- Related Defects --}}
        <div class="qf-id-panel">

            <h2>
                Related Defects
                <span style="color: #91a9c7; font-size: 12px; margin-left: 8px;">
                    Total: {{ $inspection->defects->count() }}
                </span>
            </h2>

            @forelse ($inspection->defects as $defect)

                <div class="qf-id-defect">

                    <div style="display:flex; justify-content:space-between; gap:12px; flex-wrap:wrap;">

                        <strong>{{ $defect->defect_type }}</strong>

                        <span class="qf-id-badge qf-id-{{ $defect->status }}">
                            {{ ucfirst($defect->status) }}
                        </span>

                    </div>

                    <p>
                        Severity: {{ ucfirst($defect->severity) }}
                        | Quantity: {{ $defect->defect_quantity }}
                    </p>

                    <p>
                        Reported By: {{ $defect->reporter?->name ?? '—' }}
                    </p>

                    <a href="{{ route('qm.defects.show', $defect->id) }}"
                        class="qf-id-link">
                        View Defect Details →
                    </a>

                </div>

            @empty

                <div class="qf-id-empty">
                    No defects have been linked to this inspection yet.
                </div>

            @endforelse

        </div>

    </div>

</x-app-layout>
