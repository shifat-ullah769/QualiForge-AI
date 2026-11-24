<x-app-layout>

<div class="qf-inspection-create">

    <style>
        .qf-inspection-create {
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 20px 40px;
            color: #eaf2ff;
        }

        .qf-inspection-create-header {
            margin-bottom: 25px;
        }

        .qf-inspection-create-header h1 {
            font-size: 27px;
            margin: 0 0 8px;
            font-weight: 700;
        }

        .qf-inspection-create-header p {
            color: #91a9c7;
            font-size: 13px;
        }

        .qf-inspection-create-panel {
            background: #111f31;
            border: 1px solid #263c55;
            border-radius: 13px;
            padding: 25px;
            margin-bottom: 20px;
        }

        .qf-inspection-create-panel h2 {
            font-size: 17px;
            margin: 0 0 20px;
        }

        .qf-inspection-create-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .qf-inspection-create-field label {
            display: block;
            color: #a8bdd7;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .qf-inspection-create-field input,
        .qf-inspection-create-field select,
        .qf-inspection-create-field textarea {
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

        .qf-inspection-create-field input:focus,
        .qf-inspection-create-field select:focus,
        .qf-inspection-create-field textarea:focus {
            border-color: #08b9d2;
        }

        .qf-inspection-create-field textarea {
            min-height: 110px;
            resize: vertical;
        }

        .qf-inspection-create-full {
            grid-column: 1 / -1;
        }

        .qf-inspection-create-help {
            color: #8198b5;
            font-size: 11px;
            margin-top: 6px;
        }

        .qf-inspection-create-error {
            color: #ff8da0;
            font-size: 11px;
            margin-top: 6px;
        }

        .qf-inspection-create-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 20px;
        }

        .qf-inspection-create-btn {
            display: inline-block;
            padding: 11px 18px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
        }

        .qf-inspection-create-submit {
            background: #08b9d2;
            color: #061421;
        }

        .qf-inspection-create-cancel {
            background: #26394f;
            color: #dce8f8;
        }

        @media(max-width: 650px) {
            .qf-inspection-create-grid {
                grid-template-columns: 1fr;
            }

            .qf-inspection-create-full {
                grid-column: auto;
            }

            .qf-inspection-create-actions {
                flex-direction: column-reverse;
            }
        }
    </style>

    <div class="qf-inspection-create-header">
        <h1>Create New Inspection</h1>
        <p>Schedule a manufacturing quality inspection and assign its production location.</p>
    </div>

    @if ($errors->any())
        <div class="qf-inspection-create-panel" style="border-color:#9b4054;">
            <strong style="color:#ff8da0;">Please correct the following errors:</strong>
            <ul style="color:#ff9eae; margin-top:10px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('qe.inspections.store') }}">
        @csrf

        <div class="qf-inspection-create-panel">
            <h2>Production Information</h2>

            <div class="qf-inspection-create-grid">

                <div class="qf-inspection-create-field">
                    <label for="factory_id">Factory</label>
                    <select id="factory_id" name="factory_id">
                        <option value="">Select Factory</option>

                        @foreach ($factories as $factory)
                            <option
                                value="{{ $factory->id }}"
                                @selected(old('factory_id') == $factory->id)
                            >
                                {{ $factory->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('factory_id')
                        <div class="qf-inspection-create-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="qf-inspection-create-field">
                    <label for="production_line_id">Production Line</label>
                    <select id="production_line_id" name="production_line_id">
                        <option value="">Select Production Line</option>

                        @foreach ($productionLines as $line)
                            <option
                                value="{{ $line->id }}"
                                data-factory="{{ $line->factory_id }}"
                                @selected(old('production_line_id') == $line->id)
                            >
                                {{ $line->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('production_line_id')
                        <div class="qf-inspection-create-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="qf-inspection-create-field">
                    <label for="machine_id">Machine</label>
                    <select id="machine_id" name="machine_id">
                        <option value="">Select Machine</option>

                        @foreach ($machines as $machine)
                            <option
                                value="{{ $machine->id }}"
                                data-line="{{ $machine->production_line_id }}"
                                @selected(old('machine_id') == $machine->id)
                            >
                                {{ $machine->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('machine_id')
                        <div class="qf-inspection-create-error">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

        <div class="qf-inspection-create-panel">
            <h2>Inspection Information</h2>

            <div class="qf-inspection-create-grid">

                <div class="qf-inspection-create-field">
                    <label for="inspection_type">Inspection Type *</label>

                    <select id="inspection_type" name="inspection_type" required>
                        <option value="">Select Inspection Type</option>

                        @foreach ([
                            'Incoming Material',
                            'In-Process',
                            'Final Product',
                            'Machine',
                            'Safety',
                            'Routine',
                            'Other'
                        ] as $type)
                            <option
                                value="{{ $type }}"
                                @selected(old('inspection_type') === $type)
                            >
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>

                    @error('inspection_type')
                        <div class="qf-inspection-create-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="qf-inspection-create-field">
                    <label for="inspection_date">Inspection Date & Time *</label>

                    <input
                        type="datetime-local"
                        id="inspection_date"
                        name="inspection_date"
                        value="{{ old('inspection_date', now()->format('Y-m-d\TH:i')) }}"
                        required
                    >

                    @error('inspection_date')
                        <div class="qf-inspection-create-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="qf-inspection-create-field qf-inspection-create-full">
                    <label for="notes">Inspection Notes</label>

                    <textarea
                        id="notes"
                        name="notes"
                        placeholder="Add any preliminary instructions or inspection notes..."
                    >{{ old('notes') }}</textarea>

                    @error('notes')
                        <div class="qf-inspection-create-error">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <p class="qf-inspection-create-help">
                Inspector will be automatically assigned from your logged-in account.
                New inspections will start with Scheduled status.
            </p>
        </div>

        <div class="qf-inspection-create-actions">

            <a
                href="{{ route('qe.inspections.index') }}"
                class="qf-inspection-create-btn qf-inspection-create-cancel"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="qf-inspection-create-btn qf-inspection-create-submit"
            >
                Save Inspection
            </button>

        </div>

    </form>

</div>

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

</div>

</x-app-layout>
