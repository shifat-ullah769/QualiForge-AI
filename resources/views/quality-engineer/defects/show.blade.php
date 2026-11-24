<x-app-layout>

<div class="qf-defect-details">

    <style>
        .qf-defect-details {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px 40px;
            color: #eaf2ff;
        }

        .qf-detail-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .qf-detail-header h1 {
            font-size: 27px;
            margin: 0 0 7px;
        }

        .qf-detail-header p {
            color: #91a9c7;
            font-size: 13px;
        }

        .qf-detail-panel {
            background: #111f31;
            border: 1px solid #263c55;
            border-radius: 13px;
            padding: 24px;
            margin-bottom: 22px;
        }

        .qf-detail-panel h2 {
            font-size: 17px;
            margin: 0 0 20px;
        }

        .qf-detail-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .qf-detail-item label {
            display: block;
            color: #8fa8c7;
            font-size: 11px;
            margin-bottom: 7px;
        }

        .qf-detail-item strong {
            font-size: 14px;
            color: #eaf2ff;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .qf-detail-badge {
            display: inline-block;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .qf-severity-low {
            background: #123b35;
            color: #5ce0b0;
        }

        .qf-severity-medium {
            background: #40351a;
            color: #f3cb70;
        }

        .qf-severity-high {
            background: #49291b;
            color: #ffad72;
        }

        .qf-severity-critical {
            background: #4b202c;
            color: #ff8298;
        }

        .qf-status-open {
            background: #17344b;
            color: #69c9ff;
        }

        .qf-status-investigating {
            background: #40351a;
            color: #f3cb70;
        }

        .qf-status-resolved {
            background: #123b35;
            color: #5ce0b0;
        }

        .qf-detail-description {
            background: #091626;
            border: 1px solid #263c55;
            border-radius: 8px;
            padding: 16px;
            color: #c8d8ec;
            line-height: 1.7;
            font-size: 13px;
            white-space: pre-wrap;
            overflow-wrap: anywhere;
        }

        .qf-update-field {
            margin-bottom: 18px;
        }

        .qf-update-field label {
            display: block;
            color: #a8bdd7;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .qf-update-field select,
        .qf-update-field textarea {
            width: 100%;
            box-sizing: border-box;
            background: #091626;
            border: 1px solid #29415c;
            border-radius: 7px;
            padding: 12px;
            color: #eaf2ff;
            outline: none;
        }

        .qf-update-field textarea {
            min-height: 100px;
            resize: vertical;
        }

        .qf-detail-btn {
            display: inline-block;
            padding: 11px 18px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
        }

        .qf-detail-submit {
            background: #08b9d2;
            color: #061421;
        }

        .qf-detail-back {
            background: #26394f;
            color: #dce8f8;
        }

        .qf-detail-alert {
            padding: 13px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .qf-detail-success {
            background: #123b35;
            color: #75e2b9;
        }

        .qf-detail-error {
            background: #4b202c;
            color: #ff9aac;
        }

        @media(max-width: 650px) {
            .qf-detail-grid {
                grid-template-columns: 1fr;
            }

            .qf-detail-header {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>

    <div class="qf-detail-header">
        <div>
            <h1>Defect Details #{{ $defect->id }}</h1>
            <p>Review defect information and manage its investigation status.</p>
        </div>

        <a
            href="{{ route('qe.defects.index') }}"
            class="qf-detail-btn qf-detail-back"
        >
            ← Back to Defects
        </a>
    </div>

    @if (session('success'))
        <div class="qf-detail-alert qf-detail-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="qf-detail-alert qf-detail-error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="qf-detail-panel">
        <h2>Defect Overview</h2>

        <div class="qf-detail-grid">

            <div class="qf-detail-item">
                <label>Defect Type</label>
                <strong>{{ $defect->defect_type }}</strong>
            </div>

            <div class="qf-detail-item">
                <label>Severity</label>
                <strong>
                    <span class="qf-detail-badge qf-severity-{{ $defect->severity }}">
                        {{ ucfirst($defect->severity) }}
                    </span>
                </strong>
            </div>

            <div class="qf-detail-item">
                <label>Status</label>
                <strong>
                    <span class="qf-detail-badge qf-status-{{ $defect->status }}">
                        {{ ucfirst($defect->status) }}
                    </span>
                </strong>
            </div>

            <div class="qf-detail-item">
                <label>Defect Quantity</label>
                <strong>{{ number_format($defect->defect_quantity) }}</strong>
            </div>

            <div class="qf-detail-item">
                <label>Batch Number</label>
                <strong>{{ $defect->batch_number ?: '—' }}</strong>
            </div>

            <div class="qf-detail-item">
                <label>Product Code</label>
                <strong>{{ $defect->product_code ?: '—' }}</strong>
            </div>

            <div class="qf-detail-item">
                <label>Reported By</label>
                <strong>{{ $defect->reporter?->name ?? '—' }}</strong>
            </div>

            <div class="qf-detail-item">
                <label>Detected At</label>
                <strong>
                    {{ $defect->detected_at?->format('d M Y, h:i A') ?? '—' }}
                </strong>
            </div>

            <div class="qf-detail-item">
                <label>Created At</label>
                <strong>{{ $defect->created_at->format('d M Y, h:i A') }}</strong>
            </div>

            <div class="qf-detail-item">
                <label>Resolved At</label>
                <strong>
                    {{ $defect->resolved_at?->format('d M Y, h:i A') ?? 'Not resolved' }}
                </strong>
            </div>

        </div>
    </div>

    <div class="qf-detail-panel">
        <h2>Production Information</h2>

        <div class="qf-detail-grid">

            <div class="qf-detail-item">
                <label>Factory</label>
                <strong>{{ $defect->factory?->name ?? '—' }}</strong>
            </div>

            <div class="qf-detail-item">
                <label>Production Line</label>
                <strong>{{ $defect->productionLine?->name ?? '—' }}</strong>
            </div>

            <div class="qf-detail-item">
                <label>Machine</label>
                <strong>{{ $defect->machine?->name ?? '—' }}</strong>
            </div>

        </div>
    </div>

    <div class="qf-detail-panel">
        <h2>Defect Description</h2>

        <div class="qf-detail-description">
            {{ $defect->description ?: 'No description provided.' }}
        </div>
    </div>

    <div class="qf-detail-panel">
        <h2>Resolution Information</h2>

        <div class="qf-detail-description">
            {{ $defect->resolution_notes ?: 'No resolution notes available.' }}
        </div>
    </div>

    <div class="qf-detail-panel">
        <h2>Update Defect Status</h2>

        <form
            method="POST"
            action="{{ route('qe.defects.update', $defect->id) }}"
        >
            @csrf
            @method('PUT')

            <div class="qf-update-field">
                <label for="severity">Severity</label>

                <select id="severity" name="severity" required>
                    @foreach (['low', 'medium', 'high', 'critical'] as $severity)
                        <option
                            value="{{ $severity }}"
                            @selected(old('severity', $defect->severity) === $severity)
                        >
                            {{ ucfirst($severity) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="qf-update-field">
                <label for="status">Defect Status</label>

                <select id="status" name="status" required>
                    @foreach (['open', 'investigating', 'resolved'] as $status)
                        <option
                            value="{{ $status }}"
                            @selected(old('status', $defect->status) === $status)
                        >
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="qf-update-field">
                <label for="resolution_notes">Resolution Notes</label>

                <textarea
                    id="resolution_notes"
                    name="resolution_notes"
                    placeholder="Describe the investigation findings or corrective action..."
                >{{ old('resolution_notes', $defect->resolution_notes) }}</textarea>
            </div>

            <button type="submit" class="qf-detail-btn qf-detail-submit">
                Update Defect
            </button>

        </form>
    </div>

</div>

</x-app-layout>
