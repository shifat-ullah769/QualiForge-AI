<x-app-layout>
    <div class="ps-action-page">
        <div class="ps-action-container">

            <div class="ps-action-header">
                <div>
                    <span class="ps-action-eyebrow">PRODUCTION OPERATIONS</span>
                    <h1>Record Corrective Action</h1>
                    <p>Record an instruction received from the Quality Manager.</p>
                </div>

                <a href="{{ route('production-supervisor.corrective-actions.index') }}"
                   class="ps-action-back">
                    <i class="bi bi-arrow-left"></i> Back to Register
                </a>
            </div>

            @if ($errors->any())
                <div class="ps-action-errors">
                    <strong>Please correct the following errors.</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST"
                  action="{{ route('production-supervisor.corrective-actions.store') }}"
                  class="ps-action-form">
                @csrf

                <div class="ps-form-section">
                    <div class="ps-form-section-heading">
                        <span class="ps-section-icon"><i class="bi bi-buildings"></i></span>
                        <div>
                            <h2>Production Resource</h2>
                            <p>Select the assigned resource related to this instruction.</p>
                        </div>
                    </div>

                    <div class="ps-form-grid">

                        <div class="ps-field">
                            <label for="factory_id">Assigned Factory <span>*</span></label>
                            <select name="factory_id" id="factory_id" required>
                                <option value="">Select Factory</option>
                                @foreach ($assignments->unique('factory_id') as $assignment)
                                    <option value="{{ $assignment->factory_id }}"
                                        @selected(old('factory_id') == $assignment->factory_id)>
                                        {{ $assignment->factory?->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('factory_id') <small>{{ $message }}</small> @enderror
                        </div>

                        <div class="ps-field">
                            <label for="production_line_id">Production Line</label>
                            <select name="production_line_id" id="production_line_id">
                                <option value="">Not specified</option>
                                @foreach ($assignments->whereNotNull('production_line_id')->unique('production_line_id') as $assignment)
                                    <option value="{{ $assignment->production_line_id }}"
                                        @selected(old('production_line_id') == $assignment->production_line_id)>
                                        {{ $assignment->productionLine?->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="ps-field">
                            <label for="machine_id">Assigned Machine</label>
                            <select name="machine_id" id="machine_id">
                                <option value="">Not specified</option>
                                @foreach ($assignments->whereNotNull('machine_id')->unique('machine_id') as $assignment)
                                    <option value="{{ $assignment->machine_id }}"
                                        @selected(old('machine_id') == $assignment->machine_id)>
                                        {{ $assignment->machine?->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>

                <div class="ps-form-divider"></div>

                <div class="ps-form-section">
                    <div class="ps-form-section-heading">
                        <span class="ps-section-icon"><i class="bi bi-clipboard-check"></i></span>
                        <div>
                            <h2>Corrective Action Details</h2>
                            <p>Enter the instruction provided for production execution.</p>
                        </div>
                    </div>

                    <div class="ps-field">
                        <label for="title">Action Title <span>*</span></label>
                        <input type="text"
                               id="title"
                               name="title"
                               maxlength="255"
                               value="{{ old('title') }}"
                               placeholder="Enter a short corrective action title"
                               required>
                        @error('title') <small>{{ $message }}</small> @enderror
                    </div>

                    <div class="ps-field">
                        <label for="instruction">Instruction Details <span>*</span></label>
                        <textarea id="instruction"
                                  name="instruction"
                                  rows="5"
                                  maxlength="5000"
                                  placeholder="Enter the corrective action instruction received from the Quality Manager..."
                                  required>{{ old('instruction') }}</textarea>
                        @error('instruction') <small>{{ $message }}</small> @enderror
                    </div>

                    <div class="ps-form-grid">
                        <div class="ps-field">
                            <label for="priority">Priority <span>*</span></label>
                            <select name="priority" id="priority" required>
                                <option value="low" @selected(old('priority') == 'low')>Low</option>
                                <option value="medium" @selected(old('priority', 'medium') == 'medium')>Medium</option>
                                <option value="high" @selected(old('priority') == 'high')>High</option>
                            </select>
                        </div>

                        <div class="ps-field">
                            <label for="due_date">Due Date</label>
                            <input type="date"
                                   id="due_date"
                                   name="due_date"
                                   min="{{ now()->toDateString() }}"
                                   value="{{ old('due_date') }}">
                        </div>
                    </div>
                </div>

                <div class="ps-form-footer">
                    <a href="{{ route('production-supervisor.corrective-actions.index') }}"
                       class="ps-cancel-btn">Cancel</a>

                    <button type="submit" class="ps-submit-btn">
                        <i class="bi bi-check2-circle"></i>
                        Record Corrective Action
                    </button>
                </div>

            </form>
        </div>
    </div>

    <style>
        .ps-action-page {
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

        .ps-action-container { max-width: 1050px; margin: auto; }

        .ps-action-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 27px;
        }

        .ps-action-eyebrow {
            color: var(--cyan);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .13em;
        }

        .ps-action-header h1 {
            color: var(--text);
            margin: 8px 0;
            font-size: 27px;
            font-weight: 750;
        }

        .ps-action-header p {
            color: var(--muted);
            margin: 0;
            font-size: 13px;
        }

        .ps-action-back, .ps-cancel-btn, .ps-submit-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            border-radius: 8px;
            padding: 11px 15px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .ps-action-back {
            border: 1px solid var(--border);
            color: var(--cyan);
            background: var(--surface);
        }

        .ps-action-form {
            padding: 27px;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: linear-gradient(145deg, #101f32, #0b1829);
        }

        .ps-form-section-heading {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 23px;
        }

        .ps-section-icon {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            border-radius: 10px;
            color: var(--cyan);
            background: rgba(34,211,238,.12);
            font-size: 18px;
        }

        .ps-form-section-heading h2 {
            color: var(--text);
            font-size: 16px;
            font-weight: 700;
            margin: 0 0 4px;
        }

        .ps-form-section-heading p {
            color: var(--muted);
            font-size: 11px;
            margin: 0;
        }

        .ps-form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .ps-field { margin-bottom: 21px; min-width: 0; }

        .ps-field label {
            display: block;
            margin-bottom: 9px;
            color: #cbd5e1;
            font-size: 12px;
            font-weight: 600;
        }

        .ps-field label span { color: var(--cyan); }

        .ps-field input, .ps-field select, .ps-field textarea {
            display: block;
            width: 100%;
            box-sizing: border-box;
            padding: 12px 13px;
            border: 1px solid var(--border);
            border-radius: 8px;
            outline: none;
            background: #081525;
            color: var(--text);
            font-family: inherit;
            font-size: 12px;
            transition: border-color .2s, box-shadow .2s;
        }

        .ps-field input, .ps-field select { min-height: 43px; }

        .ps-field textarea { resize: vertical; min-height: 120px; }

        .ps-field input:focus, .ps-field select:focus, .ps-field textarea:focus {
            border-color: var(--cyan);
            box-shadow: 0 0 0 3px rgba(34,211,238,.09);
        }

        .ps-field input::placeholder, .ps-field textarea::placeholder {
            color: #64748b;
        }

        .ps-field small {
            display: block;
            color: #f87171;
            margin-top: 6px;
            font-size: 11px;
        }

        .ps-form-divider {
            height: 1px;
            background: rgba(148,163,184,.15);
            margin: 10px 0 27px;
        }

        .ps-form-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding-top: 20px;
            border-top: 1px solid rgba(148,163,184,.15);
        }

        .ps-cancel-btn {
            color: #cbd5e1;
            border: 1px solid var(--border);
            background: transparent;
        }

        .ps-submit-btn {
            color: #07111f;
            background: var(--cyan);
            border: 1px solid var(--cyan);
        }

        .ps-submit-btn:hover { background: #67e8f9; }

        .ps-action-errors {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid rgba(248,113,113,.3);
            border-radius: 9px;
            background: rgba(239,68,68,.08);
            color: #fca5a5;
            font-size: 12px;
        }

        .ps-action-errors ul { margin: 8px 0 0; padding-left: 20px; }

        @media(max-width: 650px) {
            .ps-action-page { padding: 25px 14px; }
            .ps-action-header { align-items: flex-start; flex-direction: column; }
            .ps-action-header h1 { font-size: 23px; }
            .ps-form-grid { grid-template-columns: 1fr; gap: 0; }
            .ps-action-form { padding: 19px; }
            .ps-form-footer { flex-direction: column-reverse; }
            .ps-form-footer a, .ps-form-footer button { width: 100%; }
        }
    </style>
</x-app-layout>
