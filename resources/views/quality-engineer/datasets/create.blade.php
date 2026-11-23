<x-app-layout>

    <style>
        .qf-dataset-page {
            --bg: #07111f;
            --surface: #0b192b;
            --surface-2: #0e2034;
            --border: rgba(148, 163, 184, .13);
            --text: #f8fafc;
            --muted: #94a3b8;
            --cyan: #22d3ee;

            min-height: calc(100vh - 64px);
            padding: 34px 24px 60px;
            color: var(--text);
            background: var(--bg);
        }

        .qf-dataset-container {
            width: 100%;
            max-width: 1100px;
            margin: auto;
        }

        .qf-dataset-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
            margin-bottom: 28px;
        }

        .qf-dataset-eyebrow {
            color: var(--cyan);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .13em;
            text-transform: uppercase;
            margin-bottom: 9px;
        }

        .qf-dataset-title {
            margin: 0;
            color: var(--text);
            font-size: 29px;
            font-weight: 750;
        }

        .qf-dataset-subtitle {
            margin-top: 8px;
            color: var(--muted);
            font-size: 13px;
        }

        .qf-dataset-back {
            padding: 10px 15px;
            border: 1px solid var(--border);
            border-radius: 9px;
            color: var(--muted);
            text-decoration: none;
            font-size: 12px;
        }

        .qf-dataset-back:hover {
            color: var(--cyan);
            border-color: var(--cyan);
        }

        .qf-dataset-panel {
            padding: 25px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: linear-gradient(145deg, #0d2034, #091727);
            box-shadow: 0 14px 35px rgba(0, 0, 0, .18);
        }

        .qf-dataset-section-title {
            margin: 0 0 6px;
            font-size: 16px;
            font-weight: 700;
            color: var(--text);
        }

        .qf-dataset-section-description {
            margin: 0 0 24px;
            color: var(--muted);
            font-size: 12px;
        }

        .qf-dataset-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .qf-dataset-field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .qf-dataset-field.full {
            grid-column: 1 / -1;
        }

        .qf-dataset-label {
            color: #cbd5e1;
            font-size: 12px;
            font-weight: 600;
        }

        .qf-dataset-input,
        .qf-dataset-select {
            width: 100%;
            min-height: 44px;
            padding: 11px 13px;
            border: 1px solid #263b52;
            border-radius: 9px;
            outline: none;
            color: #f8fafc;
            background: #081727;
            font-size: 12px;
        }

        .qf-dataset-input:focus,
        .qf-dataset-select:focus {
            border-color: var(--cyan);
            box-shadow: 0 0 0 3px rgba(34, 211, 238, .08);
        }

        .qf-dataset-select option {
            background: #0b192b;
            color: white;
        }

        .qf-dataset-help {
            color: #64748b;
            font-size: 11px;
        }

        .qf-dataset-upload-area {
            padding: 25px;
            border: 1px dashed rgba(34, 211, 238, .35);
            border-radius: 12px;
            background: rgba(34, 211, 238, .035);
        }

        .qf-dataset-file {
            width: 100%;
            color: #cbd5e1;
            font-size: 12px;
        }

        .qf-dataset-file::file-selector-button {
            margin-right: 12px;
            padding: 9px 13px;
            border: 1px solid rgba(34, 211, 238, .25);
            border-radius: 7px;
            color: var(--cyan);
            background: rgba(34, 211, 238, .08);
            cursor: pointer;
        }

        .qf-dataset-divider {
            height: 1px;
            margin: 27px 0;
            background: var(--border);
        }

        .qf-dataset-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 25px;
        }

        .qf-dataset-btn {
            padding: 11px 19px;
            border: 1px solid var(--border);
            border-radius: 9px;
            color: #cbd5e1;
            background: transparent;
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .qf-dataset-btn.primary {
            border-color: var(--cyan);
            color: #07111f;
            background: var(--cyan);
        }

        .qf-dataset-btn.primary:hover {
            background: #67e8f9;
        }

        .qf-dataset-errors {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid rgba(239, 68, 68, .25);
            border-radius: 10px;
            color: #fca5a5;
            background: rgba(239, 68, 68, .07);
            font-size: 12px;
        }

        @media(max-width: 650px) {
            .qf-dataset-page {
                padding: 24px 15px;
            }

            .qf-dataset-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .qf-dataset-grid {
                grid-template-columns: 1fr;
            }

            .qf-dataset-field.full {
                grid-column: auto;
            }

            .qf-dataset-panel {
                padding: 18px;
            }
        }
    </style>

    <div class="qf-dataset-page">
        <div class="qf-dataset-container">

            <div class="qf-dataset-header">
                <div>
                    <div class="qf-dataset-eyebrow">
                        Quality Intelligence / Dataset Management
                    </div>

                    <h1 class="qf-dataset-title">
                        Upload Manufacturing Dataset
                    </h1>

                    <p class="qf-dataset-subtitle">
                        Upload historical manufacturing data for quality analysis and AI prediction.
                    </p>
                </div>

                <a href="{{ route('qe.datasets.index') }}"
                   class="qf-dataset-back">
                    ← Back to Datasets
                </a>
            </div>

            @if ($errors->any())
                <div class="qf-dataset-errors">
                    <strong>Please correct the following errors:</strong>

                    <ul style="margin: 9px 0 0 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('qe.datasets.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="qf-dataset-panel">

                    <h2 class="qf-dataset-section-title">
                        Dataset Information
                    </h2>

                    <p class="qf-dataset-section-description">
                        Provide a name and optional manufacturing location.
                    </p>

                    <div class="qf-dataset-grid">

                        <div class="qf-dataset-field full">
                            <label class="qf-dataset-label" for="name">
                                Dataset Name *
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="qf-dataset-input"
                                placeholder="e.g. Production Quality Data - January 2026"
                                value="{{ old('name') }}"
                                required
                            >
                        </div>

                        <div class="qf-dataset-field">
                            <label class="qf-dataset-label" for="factory_id">
                                Factory
                            </label>

                            <select name="factory_id"
                                    id="factory_id"
                                    class="qf-dataset-select">

                                <option value="">Select Factory (Optional)</option>

                                @foreach ($factories as $factory)
                                    <option value="{{ $factory->id }}"
                                        @selected(old('factory_id') == $factory->id)>
                                        {{ $factory->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="qf-dataset-field">
                            <label class="qf-dataset-label" for="production_line_id">
                                Production Line
                            </label>

                            <select name="production_line_id"
                                    id="production_line_id"
                                    class="qf-dataset-select">

                                <option value="">Select Production Line</option>

                                @foreach ($productionLines as $line)
                                    <option value="{{ $line->id }}"
                                        @selected(old('production_line_id') == $line->id)>
                                        {{ $line->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="qf-dataset-field">
                            <label class="qf-dataset-label" for="machine_id">
                                Machine
                            </label>

                            <select name="machine_id"
                                    id="machine_id"
                                    class="qf-dataset-select">

                                <option value="">Select Machine</option>

                                @foreach ($machines as $machine)
                                    <option value="{{ $machine->id }}"
                                        @selected(old('machine_id') == $machine->id)>
                                        {{ $machine->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                    </div>

                    <div class="qf-dataset-divider"></div>

                    <h2 class="qf-dataset-section-title">
                        Dataset File
                    </h2>

                    <p class="qf-dataset-section-description">
                        Upload your historical manufacturing data file.
                    </p>

                    <div class="qf-dataset-upload-area">

                        <div class="qf-dataset-field">

                            <label class="qf-dataset-label" for="file">
                                Select Dataset File *
                            </label>

                            <input
                                type="file"
                                id="file"
                                name="file"
                                class="qf-dataset-file"
                                accept=".csv,.txt,.xls,.xlsx"
                                required
                            >

                            <span class="qf-dataset-help">
                                Supported formats: CSV, TXT, XLS, XLSX. Maximum size: 20 MB.
                            </span>

                        </div>

                    </div>

                    <div class="qf-dataset-actions">

                        <a href="{{ route('qe.datasets.index') }}"
                           class="qf-dataset-btn">
                            Cancel
                        </a>

                        <button type="submit"
                                class="qf-dataset-btn primary">
                            Upload Dataset →
                        </button>

                    </div>

                </div>

            </form>

        </div>
    </div>

</x-app-layout>
