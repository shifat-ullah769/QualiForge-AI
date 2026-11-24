<x-app-layout>

<div class="qf-inspections-page">

    <style>
        .qf-inspections-page {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px 40px;
            color: #eaf2ff;
        }

        .qf-inspections-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .qf-inspections-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 8px;
        }

        .qf-inspections-header p {
            color: #91a9c7;
            margin: 0;
            font-size: 13px;
        }

        .qf-inspections-btn {
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

        .qf-inspections-panel {
            background: #111f31;
            border: 1px solid #263c55;
            border-radius: 13px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .qf-inspections-panel h2 {
            font-size: 17px;
            margin: 0 0 20px;
            font-weight: 700;
        }

        .qf-inspections-filters {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto;
            gap: 12px;
            align-items: end;
        }

        .qf-inspections-field label {
            display: block;
            color: #9db4d1;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .qf-inspections-field input,
        .qf-inspections-field select {
            width: 100%;
            box-sizing: border-box;
            background: #091626;
            border: 1px solid #29415c;
            border-radius: 7px;
            padding: 11px;
            color: #eaf2ff;
            outline: none;
        }

        .qf-inspections-field input:focus,
        .qf-inspections-field select:focus {
            border-color: #08b9d2;
        }

        .qf-inspections-table-wrap {
            overflow-x: auto;
        }

        .qf-inspections-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 950px;
        }

        .qf-inspections-table th {
            background: #091626;
            color: #8fa8c7;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .5px;
            text-align: left;
            padding: 14px 12px;
        }

        .qf-inspections-table td {
            padding: 16px 12px;
            border-bottom: 1px solid #26394f;
            font-size: 12px;
            color: #dce8f8;
        }

        .qf-inspections-table tr:last-child td {
            border-bottom: none;
        }

        .qf-inspection-badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .qf-inspection-scheduled {
            background: #17344b;
            color: #69c9ff;
        }

        .qf-inspection-in_progress {
            background: #40351a;
            color: #f3cb70;
        }

        .qf-inspection-completed {
            background: #123b35;
            color: #5ce0b0;
        }

        .qf-inspection-cancelled {
            background: #4b202c;
            color: #ff8298;
        }

        .qf-inspection-pass {
            background: #123b35;
            color: #5ce0b0;
        }

        .qf-inspection-fail {
            background: #4b202c;
            color: #ff8298;
        }

        .qf-inspection-conditional {
            background: #40351a;
            color: #f3cb70;
        }

        .qf-inspection-link {
            color: #16d2e9;
            text-decoration: none;
            font-weight: 700;
        }

        .qf-inspection-link:hover {
            text-decoration: underline;
        }

        .qf-inspections-empty {
            text-align: center;
            padding: 45px 15px;
            color: #91a9c7;
        }

        .qf-inspections-alert {
            padding: 13px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .qf-inspections-success {
            background: #123b35;
            color: #75e2b9;
        }

        .qf-inspections-pagination {
            margin-top: 20px;
        }

        @media(max-width: 760px) {
            .qf-inspections-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .qf-inspections-filters {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="qf-inspections-header">
        <div>
            <h1>Inspection Management</h1>
            <p>Schedule, record and monitor manufacturing quality inspections.</p>
        </div>

        <a href="{{ route('qe.inspections.create') }}"
           class="qf-inspections-btn">
            + Create Inspection
        </a>
    </div>

    @if (session('success'))
        <div class="qf-inspections-alert qf-inspections-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="qf-inspections-panel">
        <h2>Filter Inspections</h2>

        <form method="GET" action="{{ route('qe.inspections.index') }}">
            <div class="qf-inspections-filters">

                <div class="qf-inspections-field">
                    <label for="search">Search</label>
                    <input
                        type="text"
                        id="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Inspection number, type or factory"
                    >
                </div>

                <div class="qf-inspections-field">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="">All Statuses</option>

                        @foreach (['scheduled', 'in_progress', 'completed', 'cancelled'] as $status)
                            <option
                                value="{{ $status }}"
                                @selected(request('status') === $status)
                            >
                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="qf-inspections-field">
                    <label for="result">Result</label>
                    <select id="result" name="result">
                        <option value="">All Results</option>

                        @foreach (['pass', 'fail', 'conditional'] as $result)
                            <option
                                value="{{ $result }}"
                                @selected(request('result') === $result)
                            >
                                {{ ucfirst($result) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <button type="submit" class="qf-inspections-btn">
                        Apply Filters
                    </button>
                </div>

            </div>
        </form>
    </div>

    <div class="qf-inspections-panel">

        <h2>
            Inspection History
            <span style="float:right; color:#91a9c7; font-size:12px;">
                Total Records: {{ $inspections->total() }}
            </span>
        </h2>

        <div class="qf-inspections-table-wrap">

            <table class="qf-inspections-table">

                <thead>
                    <tr>
                        <th>Inspection No.</th>
                        <th>Type</th>
                        <th>Factory</th>
                        <th>Production Line</th>
                        <th>Machine</th>
                        <th>Inspector</th>
                        <th>Inspection Date</th>
                        <th>Status</th>
                        <th>Result</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($inspections as $inspection)

                        <tr>
                            <td>
                                <strong>{{ $inspection->inspection_number }}</strong>
                            </td>

                            <td>{{ ucfirst($inspection->inspection_type) }}</td>

                            <td>{{ $inspection->factory?->name ?? '—' }}</td>

                            <td>{{ $inspection->productionLine?->name ?? '—' }}</td>

                            <td>{{ $inspection->machine?->name ?? '—' }}</td>

                            <td>{{ $inspection->inspector?->name ?? '—' }}</td>

                            <td>
                                {{ $inspection->inspection_date?->format('d M Y, h:i A') ?? '—' }}
                            </td>

                            <td>
                                <span class="qf-inspection-badge qf-inspection-{{ $inspection->status }}">
                                    {{ ucfirst(str_replace('_', ' ', $inspection->status)) }}
                                </span>
                            </td>

                            <td>
                                @if ($inspection->result)
                                    <span class="qf-inspection-badge qf-inspection-{{ $inspection->result }}">
                                        {{ ucfirst($inspection->result) }}
                                    </span>
                                @else
                                    —
                                @endif
                            </td>

                            <td>
                                <a
                                    href="{{ route('qe.inspections.show', $inspection->id) }}"
                                    class="qf-inspection-link"
                                >
                                    View Details →
                                </a>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="10">
                                <div class="qf-inspections-empty">
                                    <h3>No Inspection Records Found</h3>
                                    <p>
                                        No inspections have been recorded yet.
                                        Create your first inspection to get started.
                                    </p>

                                    <a
                                        href="{{ route('qe.inspections.create') }}"
                                        class="qf-inspections-btn"
                                    >
                                        Create Inspection
                                    </a>
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="qf-inspections-pagination">
            {{ $inspections->links() }}
        </div>

    </div>

</div>

</x-app-layout>
