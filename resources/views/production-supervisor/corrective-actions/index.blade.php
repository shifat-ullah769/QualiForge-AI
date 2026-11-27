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

            @if ($errors->any())
                <div class="ps-register-error">
                    <i class="bi bi-exclamation-circle"></i>
                    Please review the form errors below.
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

                        {{-- EXECUTION PROGRESS --}}

                        <form
                            action="{{ route('production-supervisor.corrective-actions.execution.update', $action) }}"
                            method="POST"
                            class="ps-execution-form"
                        >
                            @csrf
                            @method('PATCH')

                            <div class="ps-execution-heading">
                                <div>
                                    <span class="ps-register-label">EXECUTION MANAGEMENT</span>
                                    <h4>Update Execution Progress</h4>
                                </div>
                            </div>

                            <div class="ps-execution-fields">

                                <div class="ps-execution-field">
                                    <label for="status-{{ $action->id }}">
                                        Execution Status
                                    </label>

                                    <select
                                        id="status-{{ $action->id }}"
                                        name="status"
                                        required
                                    >
                                        <option value="pending" @selected($action->status === 'pending')>
                                            Pending
                                        </option>

                                        <option value="in_progress" @selected($action->status === 'in_progress')>
                                            In Progress
                                        </option>

                                        <option value="completed" @selected($action->status === 'completed')>
                                            Completed
                                        </option>
                                    </select>

                                    @error('status')
                                        <small class="ps-execution-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="ps-execution-field">
                                    <label for="notes-{{ $action->id }}">
                                        Execution Notes
                                    </label>

                                    <textarea
                                        id="notes-{{ $action->id }}"
                                        name="execution_notes"
                                        rows="3"
                                        maxlength="5000"
                                        placeholder="Describe the work performed and its current progress..."
                                    >{{ old('execution_notes', $action->execution_notes) }}</textarea>

                                    @error('execution_notes')
                                        <small class="ps-execution-error">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            <div class="ps-execution-footer">
                                <span>Record the actual execution progress.</span>

                                <button type="submit" class="ps-execution-save">
                                    <i class="bi bi-check2-circle"></i>
                                    Save Progress
                                </button>
                            </div>
                        </form>

                        {{-- EXECUTION EVIDENCE --}}

                        <div class="ps-evidence-section">

                            <div class="ps-evidence-heading">
                                <div>
                                    <span class="ps-register-label">SUPPORTING DOCUMENTATION</span>
                                    <h4>Execution Evidence</h4>
                                </div>

                                <span class="ps-evidence-count">
                                    {{ $action->evidences->count() }} Files
                                </span>
                            </div>

                            <form
                                action="{{ route('production-supervisor.corrective-actions.evidence.store', $action) }}"
                                method="POST"
                                enctype="multipart/form-data"
                                class="ps-evidence-upload"
                            >
                                @csrf

                                <div class="ps-evidence-input">
                                    <label for="evidence-{{ $action->id }}">
                                        Select Evidence File
                                    </label>

                                    <input
                                        type="file"
                                        id="evidence-{{ $action->id }}"
                                        name="evidence"
                                        accept=".jpg,.jpeg,.png,.webp,.pdf"
                                        required
                                    >

                                    <small>
                                        JPG, JPEG, PNG, WEBP or PDF. Maximum size: 10 MB.
                                    </small>
                                </div>

                                <button type="submit" class="ps-evidence-upload-btn">
                                    <i class="bi bi-cloud-arrow-up"></i>
                                    Upload Evidence
                                </button>

                                @error('evidence')
                                    <small class="ps-execution-error">{{ $message }}</small>
                                @enderror
                            </form>

                            @forelse ($action->evidences as $evidence)

                                <div class="ps-evidence-item">

                                    <div class="ps-evidence-file">
                                        <div class="ps-evidence-file-icon">
                                            @if (str_contains($evidence->mime_type, 'pdf'))
                                                <i class="bi bi-file-earmark-pdf"></i>
                                            @else
                                                <i class="bi bi-file-earmark-image"></i>
                                            @endif
                                        </div>

                                        <div class="ps-evidence-file-info">
                                            <strong>{{ $evidence->original_name }}</strong>

                                            <span>
                                                {{ number_format($evidence->file_size / 1024, 1) }} KB
                                                · {{ $evidence->created_at->format('d M Y') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="ps-evidence-actions">

                                        <a href="{{ route('production-supervisor.corrective-actions.evidence.download', $evidence) }}"
                                            class="ps-evidence-download">
                                            <i class="bi bi-download"></i>
                                            Download
                                        </a>

                                        <form
                                            action="{{ route('production-supervisor.corrective-actions.evidence.destroy', $evidence) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to remove this evidence file?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="ps-evidence-remove">
                                                <i class="bi bi-trash"></i>
                                                Remove
                                            </button>
                                        </form>

                                    </div>

                                </div>

                            @empty

                                <div class="ps-evidence-empty">
                                    <i class="bi bi-folder2-open"></i>
                                    <span>No execution evidence uploaded yet.</span>
                                </div>

                            @endforelse

                        </div>

                        <div class="ps-action-card-footer">
                            <span>
                                <i class="bi bi-clock"></i>
                                Recorded {{ $action->created_at->format('d M Y') }}
                            </span>

                            <span>
                                Execution updates are recorded by the assigned Production Supervisor.
                            </span>
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

        .ps-register-count,
        .ps-evidence-count {
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

        .ps-priority.low,
        .ps-action-status.pending {
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

        .ps-execution-form {
            margin-top: 20px;
            padding: 18px;
            border: 1px solid rgba(34,211,238,.2);
            border-radius: 10px;
            background: rgba(14,28,46,.75);
        }

        .ps-execution-heading h4,
        .ps-evidence-heading h4 {
            margin: 6px 0 16px;
            color: var(--text);
            font-size: 15px;
            font-weight: 700;
        }

        .ps-execution-fields {
            display: grid;
            grid-template-columns: 220px minmax(0, 1fr);
            gap: 16px;
        }

        .ps-execution-field {
            min-width: 0;
        }

        .ps-execution-field label,
        .ps-evidence-input label {
            display: block;
            margin-bottom: 8px;
            color: #cbd5e1;
            font-size: 11px;
            font-weight: 600;
        }

        .ps-execution-field select,
        .ps-execution-field textarea {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid var(--border);
            border-radius: 7px;
            background: #07111f;
            color: var(--text);
            font-size: 12px;
        }

        .ps-execution-field textarea {
            resize: vertical;
            line-height: 1.6;
        }

        .ps-execution-field select:focus,
        .ps-execution-field textarea:focus {
            outline: none;
            border-color: var(--cyan);
            box-shadow: 0 0 0 2px rgba(34,211,238,.1);
        }

        .ps-execution-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 15px;
        }

        .ps-execution-footer > span {
            color: var(--muted);
            font-size: 10px;
        }

        .ps-execution-save,
        .ps-evidence-upload-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 10px 15px;
            border: 0;
            border-radius: 7px;
            background: var(--cyan);
            color: #07111f;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        .ps-execution-save:hover,
        .ps-evidence-upload-btn:hover {
            background: #67e8f9;
        }

        .ps-execution-error {
            display: block;
            margin-top: 6px;
            color: #f87171;
            font-size: 10px;
        }

        .ps-register-error {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            padding: 13px 16px;
            border: 1px solid rgba(239,68,68,.25);
            border-radius: 9px;
            background: rgba(239,68,68,.08);
            color: #f87171;
            font-size: 12px;
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

        /* Evidence section */

        .ps-evidence-section {
            margin-top: 18px;
            padding: 18px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: rgba(14,28,46,.65);
        }

        .ps-evidence-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .ps-evidence-heading h4 {
            margin-bottom: 15px;
        }

        .ps-evidence-upload {
            display: flex;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 14px;
            padding: 15px;
            border: 1px dashed var(--border);
            border-radius: 8px;
            background: rgba(7,17,31,.45);
        }

        .ps-evidence-input {
            flex: 1;
            min-width: 220px;
        }

        .ps-evidence-input input {
            display: block;
            width: 100%;
            padding: 9px;
            border: 1px solid var(--border);
            border-radius: 7px;
            background: #07111f;
            color: var(--text);
            font-size: 11px;
        }

        .ps-evidence-input small {
            display: block;
            margin-top: 7px;
            color: var(--muted);
            font-size: 10px;
        }

        .ps-evidence-upload-btn {
            min-height: 38px;
        }

        .ps-evidence-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 12px;
            padding: 13px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: rgba(7,17,31,.5);
        }

        .ps-evidence-file {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .ps-evidence-file-icon {
            display: grid;
            place-items: center;
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            border-radius: 8px;
            background: rgba(34,211,238,.1);
            color: var(--cyan);
            font-size: 19px;
        }

        .ps-evidence-file-info {
            min-width: 0;
        }

        .ps-evidence-file-info strong {
            display: block;
            color: var(--text);
            font-size: 11px;
            overflow-wrap: anywhere;
        }

        .ps-evidence-file-info span {
            display: block;
            margin-top: 5px;
            color: var(--muted);
            font-size: 10px;
        }

        .ps-evidence-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
        }

        .ps-evidence-download,
        .ps-evidence-remove {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 11px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
        }

        .ps-evidence-download {
            border: 1px solid rgba(34,211,238,.25);
            background: rgba(34,211,238,.1);
            color: var(--cyan);
        }

        .ps-evidence-download:hover {
            background: rgba(34,211,238,.2);
        }

        .ps-evidence-remove {
            border: 1px solid rgba(239,68,68,.2);
            background: rgba(239,68,68,.08);
            color: #f87171;
        }

        .ps-evidence-remove:hover {
            background: rgba(239,68,68,.16);
        }

        .ps-evidence-empty {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-top: 13px;
            padding: 14px;
            border: 1px dashed var(--border);
            border-radius: 8px;
            color: var(--muted);
            font-size: 11px;
        }

        .ps-evidence-empty i {
            color: var(--cyan);
            font-size: 17px;
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

        @media(max-width: 850px) {
            .ps-action-metadata {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media(max-width: 600px) {
            .ps-register-page {
                padding: 25px 14px;
            }

            .ps-register-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .ps-register-header h1 {
                font-size: 23px;
            }

            .ps-register-summary {
                grid-template-columns: 1fr 1fr;
            }

            .ps-register-section {
                padding: 16px;
            }

            .ps-action-card-header {
                flex-direction: column;
            }

            .ps-action-badges {
                justify-content: flex-start;
            }

            .ps-action-metadata {
                grid-template-columns: 1fr 1fr;
            }

            .ps-execution-fields {
                grid-template-columns: 1fr;
            }

            .ps-execution-footer {
                align-items: flex-start;
                flex-direction: column;
            }

            .ps-evidence-upload {
                align-items: stretch;
                flex-direction: column;
            }

            .ps-evidence-input {
                min-width: 0;
            }

            .ps-evidence-item {
                align-items: flex-start;
                flex-direction: column;
            }

            .ps-action-card-footer {
                flex-direction: column;
            }
        }
    </style>
</x-app-layout>
