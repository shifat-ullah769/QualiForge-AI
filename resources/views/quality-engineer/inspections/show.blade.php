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

            .qf-id-in_progress {
                background: #40351a;
                color: #f3cb70;
            }

            .qf-id-completed,
            .qf-id-pass {
                background: #123b35;
                color: #5ce0b0;
            }

            .qf-id-cancelled,
            .qf-id-fail {
                background: #4b202c;
                color: #ff8298;
            }

            .qf-id-conditional {
                background: #40351a;
                color: #f3cb70;
            }

            .qf-id-field label {
                display: block;
                color: #a8bdd7;
                font-size: 12px;
                margin-bottom: 8px;
            }

            .qf-id-field input,
            .qf-id-field select,
            .qf-id-field textarea {
                width: 100%;
                box-sizing: border-box;
                background: #091626;
                border: 1px solid #29415c;
                border-radius: 7px;
                padding: 11px;
                color: #eaf2ff;
                outline: none;
                font-size: 13px;
            }

            .qf-id-field input:focus,
            .qf-id-field select:focus,
            .qf-id-field textarea:focus {
                border-color: #08b9d2;
            }

            .qf-id-field textarea {
                min-height: 110px;
                resize: vertical;
            }

            .qf-id-form-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 18px;
            }

            .qf-id-full {
                grid-column: 1 / -1;
            }

            .qf-id-btn {
                display: inline-block;
                padding: 11px 17px;
                border-radius: 8px;
                border: none;
                cursor: pointer;
                text-decoration: none;
                font-weight: 700;
                font-size: 12px;
            }

            .qf-id-primary {
                background: #08b9d2;
                color: #061421;
            }

            .qf-id-secondary {
                background: #26394f;
                color: #dce8f8;
            }

            .qf-id-link {
                color: #16d2e9;
                text-decoration: none;
                font-weight: 700;
            }

            .qf-id-link:hover {
                text-decoration: underline;
            }

            .qf-id-alert {
                padding: 13px 16px;
                border-radius: 8px;
                margin-bottom: 18px;
                font-size: 13px;
            }

            .qf-id-success {
                background: #123b35;
                color: #75e2b9;
            }

            .qf-id-error {
                background: #4b202c;
                color: #ff9aac;
            }

            .qf-id-defect {
                padding: 15px;
                background: #091626;
                border: 1px solid #263c55;
                border-radius: 8px;
                margin-bottom: 12px;
            }

            .qf-id-actions {
                display: flex;
                justify-content: flex-end;
                gap: 10px;
                margin-top: 20px;
            }

            .qf-id-empty {
                text-align: center;
                color: #91a9c7;
                padding: 25px 10px;
                font-size: 13px;
            }

            @media(max-width: 650px) {
                .qf-id-header {
                    align-items: flex-start;
                    flex-direction: column;
                }

                .qf-id-grid,
                .qf-id-form-grid {
                    grid-template-columns: 1fr;
                }

                .qf-id-full {
                    grid-column: auto;
                }
            }
        </style>

        <div class="qf-id-header">
            <div>
                <h1>Inspection Details</h1>
                <p>{{ $inspection->inspection_number }}</p>
            </div>

            <a href="{{ route('qe.inspections.index') }}"
                class="qf-id-btn qf-id-secondary">
                ← Back to Inspections
            </a>
        </div>

        @if (session('success'))
        <div class="qf-id-alert qf-id-success">
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="qf-id-alert qf-id-error">
            <strong>Please correct the following errors:</strong>
            <ul style="margin-top:8px;">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

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
                    <strong>{{ $inspection->inspection_type }}</strong>
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
                    <small>Created At</small>
                    <strong>{{ $inspection->created_at?->format('d M Y, h:i A') ?? '—' }}</strong>
                </div>

            </div>
        </div>

        {{-- Inspection Update --}}
        <div class="qf-id-panel">
            <h2>Update Inspection</h2>

            <form
                method="POST"
                action="{{ route('qe.inspections.update', $inspection->id) }}"
                id="inspectionUpdateForm">
                @csrf
                @method('PUT')

                <div class="qf-id-form-grid">

                    <div class="qf-id-field">
                        <label for="status">Inspection Status *</label>

                        <select id="status" name="status" required>
                            @foreach ([
                            'scheduled',
                            'in_progress',
                            'completed',
                            'cancelled'
                            ] as $status)
                            <option
                                value="{{ $status }}"
                                @selected(old('status', $inspection->status) === $status)
                                >
                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="qf-id-field">
                        <label for="result">Inspection Result</label>

                        <select id="result" name="result">
                            <option value="">Select Result</option>

                            @foreach (['pass', 'fail', 'conditional'] as $result)
                            <option
                                value="{{ $result }}"
                                @selected(old('result', $inspection->result) === $result)
                                >
                                {{ ucfirst($result) }}
                            </option>
                            @endforeach
                        </select>

                        <small style="color:#8198b5; font-size:11px;">
                            Required when status is Completed.
                        </small>
                    </div>

                    <div class="qf-id-field qf-id-full">
                        <label for="findings">Inspection Findings</label>

                        <textarea
                            id="findings"
                            name="findings"
                            placeholder="Describe what was observed during the inspection...">{{ old('findings', $inspection->findings) }}</textarea>
                    </div>

                    <div class="qf-id-field qf-id-full">
                        <label for="notes">Inspection Notes</label>

                        <textarea
                            id="notes"
                            name="notes"
                            placeholder="Additional inspection notes...">{{ old('notes', $inspection->notes) }}</textarea>
                    </div>

                </div>

                <div class="qf-id-actions">
                    <button type="submit" class="qf-id-btn qf-id-primary">
                        Save Inspection Update
                    </button>
                </div>

            </form>
        </div>

        {{-- Linked Defects --}}
        {{-- Linked Defects --}}
        <div class="qf-id-panel">
            <div style="display:flex; justify-content:space-between; align-items:center; gap:15px; flex-wrap:wrap; margin-bottom:20px;">

                <h2 style="margin:0;">
                    Related Defects
                    <span style="color:#91a9c7; font-size:12px; margin-left:8px;">
                        Total: {{ $inspection->defects->count() }}
                    </span>
                </h2>

                <a
                    href="{{ route('qe.defects.create', ['inspection_id' => $inspection->id]) }}"
                    class="qf-id-btn qf-id-primary">
                    + Report Defect
                </a>

            </div>

            @forelse ($inspection->defects as $defect)

            <div class="qf-id-defect">
                <div style="display:flex; justify-content:space-between; gap:12px; flex-wrap:wrap;">
                    <strong>{{ $defect->defect_type }}</strong>

                    <span class="qf-id-badge qf-id-{{ $defect->status === 'resolved' ? 'completed' : 'in_progress' }}">
                        {{ ucfirst($defect->status) }}
                    </span>
                </div>

                <p style="color:#91a9c7; font-size:12px; margin:9px 0;">
                    Severity: {{ ucfirst($defect->severity) }}
                    | Quantity: {{ $defect->defect_quantity }}
                </p>

                <a
                    href="{{ route('qe.defects.show', $defect->id) }}"
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const statusSelect = document.getElementById('status');
            const resultSelect = document.getElementById('result');

            function updateResultRequirement() {
                resultSelect.required = statusSelect.value === 'completed';
            }

            statusSelect.addEventListener('change', updateResultRequirement);

            updateResultRequirement();
        });
    </script>

</x-app-layout>