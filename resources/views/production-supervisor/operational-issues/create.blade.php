<x-app-layout>
    <div class="container py-4 operational-create-page">

        <div class="page-header">
            <div>
                <span class="eyebrow">PRODUCTION SUPERVISOR</span>
                <h1>Report Operational Issue</h1>
                <p>Record a machine malfunction or operational blocker.</p>
            </div>

            <a href="{{ route('production-supervisor.operational-issues.index') }}"
                class="btn btn-back">
                ← Back to Issues
            </a>
        </div>

        @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please correct the following:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="form-card">
            <div class="form-heading">
                <h2>Issue Information</h2>
                <p>Provide the details of the operational issue you encountered.</p>
            </div>

            <form method="POST"
                action="{{ route('production-supervisor.operational-issues.store') }}">
                @csrf

                <div class="form-group">
                    <label for="assignment_id">Assigned Production Resource <span>*</span></label>

                    <select id="assignment_id" class="form-control" required>
                        <option value="">Select assigned resource</option>

                        @foreach($assignments as $assignment)
                        <option
                            value="{{ $assignment->id }}"
                            data-factory="{{ $assignment->factory_id }}"
                            data-line="{{ $assignment->production_line_id }}"
                            data-machine="{{ $assignment->machine_id }}"
                            @selected(
                            old('factory_id')==$assignment->factory_id
                            && old('production_line_id') == $assignment->production_line_id
                            && old('machine_id') == $assignment->machine_id
                            )
                            >
                            {{ $assignment->factory?->name ?? 'Factory unavailable' }}
                            — {{ $assignment->productionLine?->name ?? 'No line specified' }}
                            — {{ $assignment->machine?->name ?? 'No machine specified' }}
                        </option>
                        @endforeach
                    </select>

                    <input type="hidden" name="factory_id" id="factory_id" value="{{ old('factory_id') }}">
                    <input type="hidden" name="production_line_id" id="production_line_id" value="{{ old('production_line_id') }}">
                    <input type="hidden" name="machine_id" id="machine_id" value="{{ old('machine_id') }}">

                    <small>Select the assigned factory, line and machine related to this issue.</small>
                </div>

                <div class="form-group">
                    <label for="title">Issue Title <span>*</span></label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        class="form-control"
                        maxlength="255"
                        value="{{ old('title') }}"
                        placeholder="e.g. CNC machine unexpected shutdown"
                        required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="issue_type">Issue Type <span>*</span></label>
                        <select name="issue_type" id="issue_type" class="form-control" required>
                            <option value="">Select issue type</option>
                            <option value="machine_malfunction" @selected(old('issue_type')==='machine_malfunction' )>
                                Machine Malfunction
                            </option>
                            <option value="operational_blocker" @selected(old('issue_type')==='operational_blocker' )>
                                Operational Blocker
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="severity">Severity <span>*</span></label>
                        <select name="severity" id="severity" class="form-control" required>
                            <option value="">Select severity</option>
                            <option value="low" @selected(old('severity')==='low' )>Low</option>
                            <option value="medium" @selected(old('severity')==='medium' )>Medium</option>
                            <option value="high" @selected(old('severity')==='high' )>High</option>
                            <option value="critical" @selected(old('severity')==='critical' )>Critical</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Issue Description <span>*</span></label>
                    <textarea
                        name="description"
                        id="description"
                        class="form-control"
                        rows="6"
                        maxlength="5000"
                        placeholder="Describe what happened, when it occurred, and how it is affecting the operation..."
                        required>{{ old('description') }}</textarea>
                    <small>Maximum 5,000 characters.</small>
                </div>

                <div class="notice">
                    <strong>Important:</strong>
                    This report records an operational issue. It does not represent
                    live sensor monitoring or an automated machine diagnosis.
                </div>

                <div class="form-actions">
                    <a href="{{ route('production-supervisor.operational-issues.index') }}"
                        class="btn btn-cancel">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-submit">
                        Submit Issue Report
                    </button>
                </div>

            </form>
        </div>
    </div>

    <style>
        .operational-create-page {
            width: 100%;
            max-width: 1050px;
            margin-left: auto;
            margin-right: auto;
            color: #e8eef8;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .eyebrow {
            color: #20c5d9;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .page-header {
            width: 100%;
            max-width: 850px;
            margin: 0 auto 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .page-header p {
            color: #91a0b5;
            margin: 0;
            font-size: 13px;
        }

        .btn-back {
            color: #48c9d9;
            border: 1px solid #24516a;
            border-radius: 8px;
            padding: 9px 14px;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-back:hover {
            background: #153d55;
            color: white;
        }

        .form-card {
            width: 100%;
            max-width: 850px;
            margin: 0 auto;
            background: #101e30;
            border: 1px solid #263950;
            border-radius: 13px;
            padding: 28px;
        }

        .form-heading {
            border-bottom: 1px solid #263950;
            padding-bottom: 19px;
            margin-bottom: 23px;
        }

        .form-heading h2 {
            color: #f1f5fb;
            font-size: 19px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .form-heading p {
            color: #91a0b5;
            font-size: 13px;
            margin: 0;
        }

        .form-group {
            margin-bottom: 21px;
            flex: 1;
            min-width: 0;
        }

        .form-row {
            display: flex;
            gap: 18px;
        }

        .form-group label {
            display: block;
            color: #d8e3f0;
            font-size: 13px;
            font-weight: 650;
            margin-bottom: 9px;
        }

        .form-group label span {
            color: #ff8d9c;
        }

        .form-control {
            width: 100%;
            background-color: #0b1727;
            border: 1px solid #34485e;
            border-radius: 8px;
            color: #e8eef8;
            padding: 11px 13px;
            font-size: 13px;
        }

        .form-control:focus {
            background-color: #0b1727;
            border-color: #20b9cc;
            color: white;
            box-shadow: 0 0 0 3px rgba(32, 185, 204, .12);
        }

        .form-control option {
            background: #101e30;
            color: white;
        }

        .form-group small {
            display: block;
            color: #8294aa;
            font-size: 11px;
            margin-top: 7px;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 130px;
            line-height: 1.6;
        }

        .notice {
            background: #142d43;
            border-left: 3px solid #20b9cc;
            color: #b9cddd;
            border-radius: 6px;
            padding: 13px 15px;
            font-size: 12px;
            line-height: 1.6;
            margin: 25px 0;
        }

        .notice strong {
            color: #4bcbd9;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            border-top: 1px solid #263950;
            padding-top: 20px;
        }

        .btn-cancel,
        .btn-submit {
            border-radius: 8px;
            padding: 10px 17px;
            font-size: 13px;
            font-weight: 700;
        }

        .btn-cancel {
            color: #b8c9dc;
            border: 1px solid #34485e;
            text-decoration: none;
        }

        .btn-submit {
            background: #0e9fb5;
            border: 1px solid #0e9fb5;
            color: white;
        }

        .btn-submit:hover {
            background: #0b879a;
        }

        @media (max-width: 650px) {
            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .form-card {
                padding: 19px;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .form-actions .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const assignmentSelect = document.getElementById('assignment_id');

            const factoryInput = document.getElementById('factory_id');
            const lineInput = document.getElementById('production_line_id');
            const machineInput = document.getElementById('machine_id');

            function syncAssignment() {
                const selected = assignmentSelect.options[assignmentSelect.selectedIndex];

                if (!selected || !selected.value) {
                    factoryInput.value = '';
                    lineInput.value = '';
                    machineInput.value = '';
                    return;
                }

                factoryInput.value = selected.dataset.factory || '';
                lineInput.value = selected.dataset.line || '';
                machineInput.value = selected.dataset.machine || '';
            }

            assignmentSelect.addEventListener('change', syncAssignment);
            syncAssignment();
        });
    </script>
</x-app-layout>