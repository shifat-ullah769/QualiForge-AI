<x-app-layout>

    <div class="qf-defect-create">

        <style>
            .qf-defect-create {
                max-width: 1000px;
                margin: 30px auto;
                padding: 0 20px 40px;
                color: #eaf2ff;
            }

            .qf-create-header {
                margin-bottom: 25px;
            }

            .qf-create-header h1 {
                font-size: 27px;
                margin: 0 0 8px;
                font-weight: 700;
            }

            .qf-create-header p {
                color: #91a9c7;
                font-size: 13px;
            }

            .qf-create-panel {
                background: #111f31;
                border: 1px solid #263c55;
                border-radius: 13px;
                padding: 25px;
                margin-bottom: 20px;
            }

            .qf-create-panel h2 {
                font-size: 17px;
                margin: 0 0 20px;
            }

            .qf-create-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 18px;
            }

            .qf-create-field label {
                display: block;
                color: #a8bdd7;
                font-size: 12px;
                margin-bottom: 8px;
            }

            .qf-create-field input,
            .qf-create-field select,
            .qf-create-field textarea {
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

            .qf-create-field input:focus,
            .qf-create-field select:focus,
            .qf-create-field textarea:focus {
                border-color: #08b9d2;
            }

            .qf-create-field textarea {
                min-height: 110px;
                resize: vertical;
            }

            .qf-create-full {
                grid-column: 1 / -1;
            }

            .qf-create-help {
                display: block;
                color: #8198b5;
                font-size: 11px;
                margin-top: 6px;
            }

            .qf-create-error {
                color: #ff8da0;
                font-size: 11px;
                margin-top: 6px;
            }

            .qf-create-actions {
                display: flex;
                justify-content: flex-end;
                gap: 12px;
                margin-top: 20px;
            }

            .qf-create-btn {
                display: inline-block;
                padding: 11px 18px;
                border-radius: 8px;
                border: none;
                cursor: pointer;
                text-decoration: none;
                font-weight: 700;
                font-size: 13px;
            }

            .qf-create-submit {
                background: #08b9d2;
                color: #061421;
            }

            .qf-create-cancel {
                background: #26394f;
                color: #dce8f8;
            }

            @media(max-width: 650px) {
                .qf-create-grid {
                    grid-template-columns: 1fr;
                }

                .qf-create-full {
                    grid-column: auto;
                }

                .qf-create-actions {
                    flex-direction: column-reverse;
                }
            }
        </style>

        {{-- Page Header --}}
        <div class="qf-create-header">
            <h1>Report New Defect</h1>
            <p>Record a manufacturing quality defect for investigation and tracking.</p>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="qf-create-panel" style="border-color:#9b4054;">
                <strong style="color:#ff8da0;">
                    Please correct the following errors:
                </strong>

                <ul style="color:#ff9eae; margin-top:10px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('qe.defects.store') }}">
            @csrf

            {{-- Linked Inspection --}}
            @if ($inspection)
                <input
                    type="hidden"
                    name="inspection_id"
                    value="{{ $inspection->id }}"
                >

                <div class="qf-create-panel" style="border-color:#087f91;">

                    <h2>Linked Inspection</h2>

                    <p>
                        <strong>Inspection No:</strong>
                        {{ $inspection->inspection_number }}
                    </p>

                    <p>
                        <strong>Inspection Type:</strong>
                        {{ $inspection->inspection_type }}
                    </p>

                    <p>
                        <strong>Inspection Status:</strong>
                        {{ ucfirst(str_replace('_', ' ', $inspection->status)) }}
                    </p>

                    <small class="qf-create-help">
                        This defect will be linked to the selected inspection.
                    </small>

                </div>
            @endif

            {{-- Production Information --}}
            <div class="qf-create-panel">

                <h2>Production Information</h2>

                <div class="qf-create-grid">

                    {{-- Factory --}}
                    <div class="qf-create-field">
                        <label for="factory_id">Factory</label>

                        <select id="factory_id" name="factory_id">
                            <option value="">Select Factory</option>

                            @foreach ($factories as $factory)
                                <option
                                    value="{{ $factory->id }}"
                                    @selected(
                                        old('factory_id', $inspection?->factory_id)
                                        == $factory->id
                                    )
                                >
                                    {{ $factory->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('factory_id')
                            <div class="qf-create-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Production Line --}}
                    <div class="qf-create-field">
                        <label for="production_line_id">Production Line</label>

                        <select id="production_line_id" name="production_line_id">
                            <option value="">Select Production Line</option>

                            @foreach ($productionLines as $line)
                                <option
                                    value="{{ $line->id }}"
                                    data-factory="{{ $line->factory_id }}"
                                    @selected(
                                        old('production_line_id', $inspection?->production_line_id)
                                        == $line->id
                                    )
                                >
                                    {{ $line->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('production_line_id')
                            <div class="qf-create-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Machine --}}
                    <div class="qf-create-field">
                        <label for="machine_id">Machine</label>

                        <select id="machine_id" name="machine_id">
                            <option value="">Select Machine</option>

                            @foreach ($machines as $machine)
                                <option
                                    value="{{ $machine->id }}"
                                    data-line="{{ $machine->production_line_id }}"
                                    @selected(
                                        old('machine_id', $inspection?->machine_id)
                                        == $machine->id
                                    )
                                >
                                    {{ $machine->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('machine_id')
                            <div class="qf-create-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Batch Number --}}
                    <div class="qf-create-field">
                        <label for="batch_number">Batch Number</label>

                        <input
                            type="text"
                            id="batch_number"
                            name="batch_number"
                            value="{{ old('batch_number') }}"
                            placeholder="e.g. BATCH-001"
                        >

                        @error('batch_number')
                            <div class="qf-create-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Product Code --}}
                    <div class="qf-create-field">
                        <label for="product_code">Product Code</label>

                        <input
                            type="text"
                            id="product_code"
                            name="product_code"
                            value="{{ old('product_code') }}"
                            placeholder="e.g. PROD-1001"
                        >

                        @error('product_code')
                            <div class="qf-create-error">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- Defect Information --}}
            <div class="qf-create-panel">

                <h2>Defect Information</h2>

                <div class="qf-create-grid">

                    {{-- Defect Type --}}
                    <div class="qf-create-field">
                        <label for="defect_type">Defect Type *</label>

                        <input
                            type="text"
                            id="defect_type"
                            name="defect_type"
                            value="{{ old('defect_type') }}"
                            placeholder="e.g. Surface Crack"
                            required
                        >

                        @error('defect_type')
                            <div class="qf-create-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Severity --}}
                    <div class="qf-create-field">
                        <label for="severity">Severity *</label>

                        <select id="severity" name="severity" required>
                            <option value="">Select Severity</option>

                            @foreach (['low', 'medium', 'high', 'critical'] as $severity)
                                <option
                                    value="{{ $severity }}"
                                    @selected(old('severity', 'medium') == $severity)
                                >
                                    {{ ucfirst($severity) }}
                                </option>
                            @endforeach
                        </select>

                        @error('severity')
                            <div class="qf-create-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Defect Quantity --}}
                    <div class="qf-create-field">
                        <label for="defect_quantity">Defect Quantity *</label>

                        <input
                            type="number"
                            id="defect_quantity"
                            name="defect_quantity"
                            min="1"
                            value="{{ old('defect_quantity', 1) }}"
                            required
                        >

                        @error('defect_quantity')
                            <div class="qf-create-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Detected At --}}
                    <div class="qf-create-field">
                        <label for="detected_at">Detected At</label>

                        <input
                            type="datetime-local"
                            id="detected_at"
                            name="detected_at"
                            value="{{ old('detected_at', now()->format('Y-m-d\TH:i')) }}"
                        >

                        @error('detected_at')
                            <div class="qf-create-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="qf-create-field qf-create-full">
                        <label for="description">Defect Description</label>

                        <textarea
                            id="description"
                            name="description"
                            placeholder="Describe the observed defect, affected product and inspection findings..."
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <div class="qf-create-error">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- Form Actions --}}
            <div class="qf-create-actions">

                <a
                    href="{{ route('qe.defects.index') }}"
                    class="qf-create-btn qf-create-cancel"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="qf-create-btn qf-create-submit"
                >
                    Save Defect Record
                </button>

            </div>

        </form>

    </div>

    {{-- Cascading Dropdown Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const factorySelect = document.getElementById('factory_id');
            const lineSelect = document.getElementById('production_line_id');
            const machineSelect = document.getElementById('machine_id');

            function filterLines() {

                const factoryId = factorySelect.value;

                Array.from(lineSelect.options).forEach(option => {

                    if (!option.value) return;

                    option.hidden = factoryId !== '' &&
                        option.dataset.factory !== factoryId;

                });

                const selectedLine = lineSelect.selectedOptions[0];

                if (selectedLine && selectedLine.hidden) {
                    lineSelect.value = '';
                }

                filterMachines();
            }

            function filterMachines() {

                const lineId = lineSelect.value;

                Array.from(machineSelect.options).forEach(option => {

                    if (!option.value) return;

                    option.hidden = lineId !== '' &&
                        option.dataset.line !== lineId;

                });

                const selectedMachine = machineSelect.selectedOptions[0];

                if (selectedMachine && selectedMachine.hidden) {
                    machineSelect.value = '';
                }
            }

            factorySelect.addEventListener('change', filterLines);
            lineSelect.addEventListener('change', filterMachines);

            filterLines();

        });
    </script>

</x-app-layout>
