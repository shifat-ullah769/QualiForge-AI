<x-app-layout>
    <div class="ps-register-page">
        <div class="ps-register-container">

            <div class="ps-register-header">
                <div>
                    <span class="ps-register-eyebrow">PRODUCTION OPERATIONS</span>
                    <h1>Corrective Action Register</h1>
                    <p>Record and track corrective action instructions for production execution.</p>
                </div>

                <a href="{{ route('production-supervisor.corrective-actions.create') }}"
                   class="ps-register-create">
                    <i class="bi bi-plus-lg"></i>
                    Record Corrective Action
                </a>
            </div>

            @if (session('success'))
                <div class="ps-register-success">
                    <i class="bi bi-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="ps-register-summary">
                <div>
                    <span>Total Recorded Actions</span>
                    <strong>{{ $actions->total() }}</strong>
                </div>
                <div>
                    <span>Current Page</span>
                    <strong>{{ $actions->count() }}</strong>
                </div>
            </div>

            <div class="ps-register-section">
                <div class="ps-register-section-heading">
                    <div>
                        <span class="ps-register-label">ACTION RECORDS</span>
                        <h2>Recorded Corrective Actions</h2>
                    </div>
                    <span class="ps-register-count">
                        {{ $actions->total() }} Records
                    </span>
                </div>

                @forelse ($actions as $action)

                    <div class="ps-action-card">

                        <div class="ps-action-card-header">
                            <div>
                                <span class="ps-action-reference">
                                    ACTION #{{ $action->id }}
                                </span>
                                <h3>{{ $action->title }}</h3>
                            </div>

                            <div class="ps-action-badges">
                                <span class="ps-priority {{ $action->priority }}">
                                    {{ ucfirst($action->priority) }} Priority
                                </span>

                                <span class="ps-action-status {{ $action->status }}">
                                    {{ ucwords(str_replace('_', ' ', $action->status)) }}
                                </span>
                            </div>
                        </div>

                        <p class="ps-action-instruction">
                            {{ $action->instruction }}
                        </p>

                        <div class="ps-action-metadata">

                            <div>
                                <span><i class="bi bi-buildings"></i> Factory</span>
                                <strong>{{ $action->factory?->name ?? 'N/A' }}</strong>
                            </div>

                            <div>
                                <span><i class="bi bi-diagram-3"></i> Production Line</span>
                                <strong>{{ $action->productionLine?->name ?? 'Not specified' }}</strong>
                            </div>

                            <div>
                                <span><i class="bi bi-gear"></i> Machine</span>
                                <strong>{{ $action->machine?->name ?? 'Not specified' }}</strong>
                            </div>

                            <div>
                                <span><i class="bi bi-calendar-event"></i> Due Date</span>
                                <strong>{{ $action->due_date?->format('d M Y') ?? 'Not set' }}</strong>
                            </div>

                        </div>

                        <div class="ps-action-card-footer">
                            <span>
                                <i class="bi bi-clock"></i>
                                Recorded {{ $action->created_at->format('d M Y') }}
                            </span>
                            <span>Execution status will be updated during the next phase.</span>
                        </div>

                    </div>

                @empty

                    <div class="ps-register-empty">
                        <div class="ps-register-empty-icon">
                            <i class="bi bi-clipboard2-check"></i>
                        </div>

                        <h3>No Corrective Actions Yet</h3>
                        <p>
                            Record an instruction received from the Quality Manager
                            to begin tracking its execution.
                        </p>

                        <a href="{{ route('production-supervisor.corrective-actions.create') }}"
                           class="ps-register-create">
                            <i class="bi bi-plus-lg"></i>
                            Record First Action
                        </a>
                    </div>

                @endforelse

                @if ($actions->hasPages())
                    <div class="ps-register-pagination">
                        {{ $actions->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>

    <style>
        .ps-register-page {
            --bg: #07111f;
            --surface: #0e1c2e;
            --border: #26394e;
            --text: #f8fafc;
            --muted: #94a3b8;
            --cyan: #22d3ee;

            min-height: calc(100vh - 64px);
            padding: 32px 24px 55px;
            background: radial-gradient(circle at 5% 5%, rgba(34,211,238,.07), transparent 28%), var(--bg);
            color: var(--text);
        }

        .ps-register-container {
            max-width: 1380px;
            margin: auto;
        }

        .ps-register-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 27px;
        }

        .ps-register-eyebrow,
        .ps-register-label {
            color: var(--cyan);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .13em;
        }

        .ps-register-header h1 {
            color: var(--text);
            margin: 8px 0;
            font-size: 28px;
            font-weight: 750;
        }

        .ps-register-header p {
            color: var(--muted);
            margin: 0;
            font-size: 13px;
        }

        .ps-register-create {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 12px 16px;
            border: 1px solid var(--cyan);
            border-radius: 8px;
            background: var(--cyan);
            color: #07111f;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
            transition: .2s;
        }

        .ps-register-create:hover {
            background: #67e8f9;
            color: #07111f;
        }

        .ps-register-summary {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .ps-register-summary > div {
            padding: 19px;
            border: 1px solid var(--border);
            border-radius: 11px;
            background: var(--surface);
        }

        .ps-register-summary span {
            display: block;
            color: var(--muted);
            font-size: 11px;
        }

        .ps-register-summary strong {
            display: block;
            margin-top: 9px;
            color: var(--text);
            font-size: 25px;
        }

        .ps-register-section {
            padding: 23px;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: linear-gradient(145deg, #101f32, #0b1829);
        }

        .ps-register-section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 21px;
        }

        .ps-register-section-heading h2 {
            color: var(--text);
            margin: 6px 0 0;
            font-size: 19px;
            font-weight: 700;
        }

        .ps-register-count {
            color: var(--cyan);
            font-size: 11px;
            white-space: nowrap;
        }

        .ps-action-card {
            padding: 21px;
            margin-bottom: 15px;
            border: 1px solid var(--border);
            border-radius: 11px;
            background: rgba(7,17,31,.55);
        }

        .ps-action-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
        }

        .ps-action-reference {
            color: var(--cyan);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .08em;
        }

        .ps-action-card h3 {
            color: var(--text);
            margin: 6px 0 0;
            font-size: 16px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .ps-action-badges {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            gap: 7px;
        }

        .ps-priority,
        .ps-action-status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .ps-priority.low {
            color: #cbd5e1;
            background: rgba(148,163,184,.12);
        }

        .ps-priority.medium {
            color: #fbbf24;
            background: rgba(245,158,11,.12);
        }

        .ps-priority.high {
            color: #f87171;
            background: rgba(239,68,68,.12);
        }

        .ps-action-status.pending {
            color: #cbd5e1;
            background: rgba(148,163,184,.12);
        }

        .ps-action-status.in_progress {
            color: #67e8f9;
            background: rgba(34,211,238,.12);
        }

        .ps-action-status.completed {
            color: #4ade80;
            background: rgba(34,197,94,.12);
        }

        .ps-action-instruction {
            margin: 18px 0;
            padding: 13px;
            border-left: 2px solid var(--cyan);
            border-radius: 0 7px 7px 0;
            background: rgba(34,211,238,.045);
            color: #cbd5e1;
            font-size: 12px;
            line-height: 1.7;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .ps-action-metadata {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 17px;
        }

        .ps-action-metadata > div {
            min-width: 0;
        }

        .ps-action-metadata span {
            display: block;
            margin-bottom: 7px;
            color: var(--muted);
            font-size: 10px;
        }

        .ps-action-metadata strong {
            display: block;
            color: var(--text);
            font-size: 11px;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .ps-action-card-footer {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
            padding-top: 13px;
            border-top: 1px solid rgba(148,163,184,.13);
            color: var(--muted);
            font-size: 10px;
        }

        .ps-register-empty {
            padding: 48px 20px;
            text-align: center;
            border: 1px dashed var(--border);
            border-radius: 11px;
        }

        .ps-register-empty-icon {
            color: var(--cyan);
            font-size: 34px;
            margin-bottom: 12px;
        }

        .ps-register-empty h3 {
            color: var(--text);
            font-size: 17px;
            font-weight: 700;
        }

        .ps-register-empty p {
            max-width: 470px;
            margin: 8px auto 20px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .ps-register-pagination {
            margin-top: 20px;
            color: var(--text);
        }

        .ps-register-success {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            padding: 13px 16px;
            border: 1px solid rgba(34,197,94,.25);
            border-radius: 9px;
            background: rgba(34,197,94,.08);
            color: #4ade80;
            font-size: 12px;
        }

        @media(max-width: 850px) {
            .ps-action-metadata {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media(max-width: 600px) {
            .ps-register-page { padding: 25px 14px; }
            .ps-register-header {
                align-items: flex-start;
                flex-direction: column;
            }
            .ps-register-header h1 { font-size: 23px; }
            .ps-register-summary { grid-template-columns: 1fr 1fr; }
            .ps-register-section { padding: 16px; }
            .ps-action-card-header { flex-direction: column; }
            .ps-action-badges { justify-content: flex-start; }
            .ps-action-metadata { grid-template-columns: 1fr 1fr; }
            .ps-action-card-footer { flex-direction: column; }
        }
    </style>
</x-app-layout>
