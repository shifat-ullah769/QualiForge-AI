<x-app-layout>
    <div class="qf-assignment-page">
        <style>
            .qf-assignment-page {
                min-height: 100vh;
                padding: 32px;
                background: #07111f;
                color: #e5edf7;
            }

            .qf-as-container { max-width: 1400px; margin: auto; }

            .qf-as-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 15px;
                margin-bottom: 26px;
            }

            .qf-as-header h1 {
                margin: 0 0 7px;
                color: #f8fafc;
                font-size: 27px;
                font-weight: 700;
            }

            .qf-as-header p {
                margin: 0;
                color: #94a3b8;
                font-size: 13px;
            }

            .qf-as-back {
                color: #22d3ee;
                text-decoration: none;
                font-size: 13px;
                font-weight: 600;
            }

            .qf-as-card {
                padding: 24px;
                margin-bottom: 22px;
                background: #101d2e;
                border: 1px solid #1e334a;
                border-radius: 14px;
            }

            .qf-as-card h2 {
                margin: 0 0 7px;
                color: #f1f5f9;
                font-size: 17px;
                font-weight: 650;
            }

            .qf-as-description {
                margin: 0 0 22px;
                color: #94a3b8;
                font-size: 12px;
            }

            .qf-as-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 17px;
            }

            .qf-as-field.full { grid-column: 1 / -1; }

            .qf-as-field label {
                display: block;
                margin-bottom: 8px;
                color: #cbd5e1;
                font-size: 12px;
                font-weight: 600;
            }

            .qf-as-field select,
            .qf-as-field textarea {
                width: 100%;
                padding: 11px 13px;
                border: 1px solid #29415b;
                border-radius: 8px;
                background: #0a1727;
                color: #e5edf7;
                font-size: 13px;
                outline: none;
            }

            .qf-as-field select:focus,
            .qf-as-field textarea:focus {
                border-color: #22d3ee;
            }

            .qf-as-field textarea {
                min-height: 80px;
                resize: vertical;
            }

            .qf-as-submit {
                margin-top: 20px;
                padding: 11px 19px;
                border: none;
                border-radius: 8px;
                background: linear-gradient(135deg, #06b6d4, #0891b2);
                color: white;
                font-size: 13px;
                font-weight: 650;
                cursor: pointer;
            }

            .qf-as-submit:hover { opacity: .9; }

            .qf-as-alert {
                padding: 13px 16px;
                margin-bottom: 18px;
                border-radius: 9px;
                font-size: 13px;
            }

            .qf-as-success {
                background: rgba(22,163,74,.12);
                border: 1px solid rgba(22,163,74,.3);
                color: #86efac;
            }

            .qf-as-error {
                background: rgba(220,38,38,.1);
                border: 1px solid rgba(220,38,38,.3);
                color: #fca5a5;
            }

            .qf-as-error ul { margin: 8px 0 0; padding-left: 20px; }

            .qf-as-table-wrap { overflow-x: auto; }

            .qf-as-table {
                width: 100%;
                min-width: 1000px;
                border-collapse: collapse;
            }

            .qf-as-table th {
                padding: 13px;
                background: #0c1929;
                color: #94a3b8;
                text-align: left;
                font-size: 11px;
                text-transform: uppercase;
                letter-spacing: .5px;
            }

            .qf-as-table td {
                padding: 15px 13px;
                border-top: 1px solid #1e334a;
                color: #cbd5e1;
                font-size: 12px;
                vertical-align: middle;
            }

            .qf-as-badge {
                display: inline-block;
                padding: 5px 9px;
                border-radius: 20px;
                background: rgba(22,163,74,.13);
                color: #86efac;
                font-size: 11px;
                text-transform: capitalize;
            }

            .qf-as-badge.ended {
                background: rgba(100,116,139,.15);
                color: #cbd5e1;
            }

            .qf-as-role {
                display: inline-block;
                margin-top: 5px;
                padding: 4px 8px;
                border-radius: 5px;
                font-size: 10px;
                font-weight: 600;
            }

            .qf-as-role.qe {
                background: rgba(34,211,238,.12);
                color: #67e8f9;
            }

            .qf-as-role.ps {
                background: rgba(168,85,247,.13);
                color: #c4b5fd;
            }

            .qf-as-end-btn {
                padding: 7px 11px;
                border: 1px solid rgba(220,38,38,.4);
                border-radius: 7px;
                background: rgba(220,38,38,.1);
                color: #fca5a5;
                font-size: 11px;
                cursor: pointer;
            }

            .qf-as-empty {
                padding: 30px;
                text-align: center;
                color: #64748b;
                font-size: 13px;
            }

            @media(max-width: 700px) {
                .qf-assignment-page { padding: 20px 12px; }
                .qf-as-card { padding: 18px; }
                .qf-as-grid { grid-template-columns: 1fr; }
                .qf-as-field.full { grid-column: auto; }
            }
        </style>

        <div class="qf-as-container">

            <div class="qf-as-header">
                <div>
                    <h1>User Assignments</h1>
                    <p>Assign Quality Engineers and Production Supervisors to factories, production lines and machines.</p>
                </div>

                <a href="{{ route('dashboard') }}" class="qf-as-back">
                    ← Back to Dashboard
                </a>
            </div>

            @if(session('success'))
                <div class="qf-as-alert qf-as-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="qf-as-alert qf-as-error">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="qf-as-alert qf-as-error">
                    <strong>Please correct the following errors:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="qf-as-card">
                <h2>Create New Assignment</h2>
                <p class="qf-as-description">
                    Select an active Quality Engineer or Production Supervisor and assign a production scope.
                </p>

                <form method="POST" action="{{ route('company-admin.assignments.store') }}">
                    @csrf

                    <div class="qf-as-grid">

                        <div class="qf-as-field">
                            <label>Operational User *</label>
                            <select name="user_id" required>
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}"
                                        @selected(old('user_id') == $user->id)>
                                        {{ $user->name }}
                                        — {{ $user->role?->value === 'production_supervisor' ? 'Production Supervisor' : 'Quality Engineer' }}
                                        ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="qf-as-field">
                            <label>Factory *</label>
                            <select name="factory_id" required>
                                <option value="">Select Factory</option>
                                @foreach($factories as $factory)
                                    <option value="{{ $factory->id }}"
                                        @selected(old('factory_id') == $factory->id)>
                                        {{ $factory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="qf-as-field">
                            <label>Production Line</label>
                            <select name="production_line_id">
                                <option value="">No specific line</option>
                                @foreach($productionLines as $line)
                                    <option value="{{ $line->id }}"
                                        @selected(old('production_line_id') == $line->id)>
                                        {{ $line->name }} — {{ $line->factory?->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="qf-as-field">
                            <label>Machine</label>
                            <select name="machine_id">
                                <option value="">No specific machine</option>
                                @foreach($machines as $machine)
                                    <option value="{{ $machine->id }}"
                                        @selected(old('machine_id') == $machine->id)>
                                        {{ $machine->name }} — {{ $machine->productionLine?->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="qf-as-field full">
                            <label>Assignment Notes</label>
                            <textarea name="notes" placeholder="Optional assignment instructions...">{{ old('notes') }}</textarea>
                        </div>

                    </div>

                    <button type="submit" class="qf-as-submit">
                        + Create Assignment
                    </button>
                </form>
            </div>

            <div class="qf-as-card">
                <h2>Assignment Records</h2>
                <p class="qf-as-description">
                    View and manage your company's production assignments.
                </p>

                @if($assignments->isEmpty())
                    <div class="qf-as-empty">
                        No assignments created yet.
                    </div>
                @else
                    <div class="qf-as-table-wrap">
                        <table class="qf-as-table">
                            <thead>
                                <tr>
                                    <th>Operational User</th>
                                    <th>Role</th>
                                    <th>Factory</th>
                                    <th>Production Line</th>
                                    <th>Machine</th>
                                    <th>Assigned Date</th>
                                    <th>Status</th>
                                    <th>Assigned By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($assignments as $assignment)
                                    <tr>
                                        <td>
                                            <strong>{{ $assignment->user?->name ?? 'Unknown' }}</strong>
                                        </td>

                                        <td>
                                            @if($assignment->user?->role?->value === 'production_supervisor')
                                                <span class="qf-as-role ps">Production Supervisor</span>
                                            @elseif($assignment->user?->role?->value === 'quality_engineer')
                                                <span class="qf-as-role qe">Quality Engineer</span>
                                            @else
                                                <span class="qf-as-role">Other</span>
                                            @endif
                                        </td>

                                        <td>{{ $assignment->factory?->name ?? '—' }}</td>

                                        <td>{{ $assignment->productionLine?->name ?? '—' }}</td>

                                        <td>{{ $assignment->machine?->name ?? '—' }}</td>

                                        <td>
                                            {{ $assignment->assigned_at?->format('d M Y') ?? '—' }}
                                        </td>

                                        <td>
                                            <span class="qf-as-badge {{ $assignment->status === 'ended' ? 'ended' : '' }}">
                                                {{ $assignment->status }}
                                            </span>
                                        </td>

                                        <td>{{ $assignment->assigner?->name ?? '—' }}</td>

                                        <td>
                                            @if($assignment->status === 'active')
                                                <form method="POST"
                                                      action="{{ route('company-admin.assignments.end', $assignment->id) }}"
                                                      onsubmit="return confirm('End this assignment?')">
                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit" class="qf-as-end-btn">
                                                        End Assignment
                                                    </button>
                                                </form>
                                            @else
                                                <span style="color:#64748b;">Completed</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
