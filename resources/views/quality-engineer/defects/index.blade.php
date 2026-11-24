<x-app-layout>

<div class="qf-defects-page">

    <style>
        .qf-defects-page {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px 40px;
            color: #eaf2ff;
        }

        .qf-defects-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .qf-defects-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 8px;
        }

        .qf-defects-header p {
            color: #91a9c7;
            margin: 0;
            font-size: 13px;
        }

        .qf-defects-btn {
            display: inline-block;
            background: #08b9d2;
            color: #061421;
            padding: 11px 17px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
            border: none;
            cursor: pointer;
        }

        .qf-defects-panel {
            background: #111f31;
            border: 1px solid #263c55;
            border-radius: 13px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .qf-defects-panel h2 {
            font-size: 17px;
            margin: 0 0 20px;
            font-weight: 700;
        }

        .qf-defects-filters {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto;
            gap: 12px;
            align-items: end;
        }

        .qf-defects-field label {
            display: block;
            color: #9db4d1;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .qf-defects-field input,
        .qf-defects-field select {
            width: 100%;
            box-sizing: border-box;
            background: #091626;
            border: 1px solid #29415c;
            border-radius: 7px;
            padding: 11px;
            color: #eaf2ff;
            outline: none;
        }

        .qf-defects-field input:focus,
        .qf-defects-field select:focus {
            border-color: #08b9d2;
        }

        .qf-defects-table-wrap {
            overflow-x: auto;
        }

        .qf-defects-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        .qf-defects-table th {
            background: #091626;
            color: #8fa8c7;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .5px;
            text-align: left;
            padding: 14px 12px;
        }

        .qf-defects-table td {
            padding: 16px 12px;
            border-bottom: 1px solid #26394f;
            font-size: 12px;
            color: #dce8f8;
        }

        .qf-defects-table tr:last-child td {
            border-bottom: none;
        }

        .qf-defect-badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 10px;
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

        .qf-defect-link {
            color: #16d2e9;
            text-decoration: none;
            font-weight: 700;
        }

        .qf-defect-link:hover {
            text-decoration: underline;
        }

        .qf-defects-empty {
            text-align: center;
            padding: 45px 15px;
            color: #91a9c7;
        }

        .qf-defects-alert {
            padding: 13px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .qf-defects-success {
            background: #123b35;
            color: #75e2b9;
        }

        .qf-defects-error {
            background: #4b202c;
            color: #ff9aac;
        }

        .qf-defects-pagination {
            margin-top: 20px;
        }

        @media(max-width: 760px) {
            .qf-defects-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .qf-defects-filters {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="qf-defects-header">
        <div>
            <h1>Defect Management</h1>
            <p>Record, review and monitor manufacturing defects.</p>
        </div>

        <a href="{{ route('qe.defects.create') }}" class="qf-defects-btn">
            + Report New Defect
        </a>
    </div>

    @if (session('success'))
        <div class="qf-defects-alert qf-defects-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="qf-defects-alert qf-defects-error">
            {{ session('error') }}
        </div>
    @endif

    <div class="qf-defects-panel">
        <h2>Filter Defects</h2>

        <form method="GET" action="{{ route('qe.defects.index') }}">
            <div class="qf-defects-filters">

                <div class="qf-defects-field">
                    <label for="search">Search</label>
                    <input
                        type="text"
                        id="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Batch, product code or defect type"
                    >
                </div>

                <div class="qf-defects-field">
                    <label for="severity">Severity</label>
                    <select id="severity" name="severity">
                        <option value="">All Severities</option>
                        @foreach (['low', 'medium', 'high', 'critical'] as $severity)
                            <option
                                value="{{ $severity }}"
                                @selected(request('severity') === $severity)
                            >
                                {{ ucfirst($severity) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="qf-defects-field">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="">All Statuses</option>
                        @foreach (['open', 'investigating', 'resolved'] as $status)
                            <option
                                value="{{ $status }}"
                                @selected(request('status') === $status)
                            >
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <button type="submit" class="qf-defects-btn">
                        Apply Filters
                    </button>
                </div>

            </div>
        </form>
    </div>

    <div class="qf-defects-panel">

        <h2>
            Defect History
            <span style="float:right; color:#91a9c7; font-size:12px;">
                Total Records: {{ $defects->total() }}
            </span>
        </h2>

        <div class="qf-defects-table-wrap">

            <table class="qf-defects-table">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Defect Type</th>
                        <th>Batch / Product</th>
                        <th>Machine</th>
                        <th>Quantity</th>
                        <th>Severity</th>
                        <th>Status</th>
                        <th>Detected At</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($defects as $defect)

                        <tr>
                            <td>#{{ $defect->id }}</td>

                            <td>
                                <strong>{{ $defect->defect_type }}</strong>
                            </td>

                            <td>
                                <div>{{ $defect->batch_number ?: '—' }}</div>
                                <small style="color:#91a9c7;">
                                    {{ $defect->product_code ?: '—' }}
                                </small>
                            </td>

                            <td>
                                {{ $defect->machine?->name ?? '—' }}
                            </td>

                            <td>{{ $defect->defect_quantity }}</td>

                            <td>
                                <span class="qf-defect-badge qf-severity-{{ $defect->severity }}">
                                    {{ ucfirst($defect->severity) }}
                                </span>
                            </td>

                            <td>
                                <span class="qf-defect-badge qf-status-{{ $defect->status }}">
                                    {{ ucfirst($defect->status) }}
                                </span>
                            </td>

                            <td>
                                {{ $defect->detected_at?->format('d M Y, h:i A') ?? '—' }}
                            </td>

                            <td>
                                <a
                                    href="{{ route('qe.defects.show', $defect->id) }}"
                                    class="qf-defect-link"
                                >
                                    View Details →
                                </a>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="9">
                                <div class="qf-defects-empty">
                                    <h3>No Defect Records Found</h3>
                                    <p>
                                        No defects have been recorded yet.
                                        Create your first defect report to get started.
                                    </p>
                                    <a
                                        href="{{ route('qe.defects.create') }}"
                                        class="qf-defects-btn"
                                    >
                                        Report New Defect
                                    </a>
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="qf-defects-pagination">
            {{ $defects->links() }}
        </div>

    </div>

</div>

</x-app-layout>
