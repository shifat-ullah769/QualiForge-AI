<x-app-layout>
    <div class="qf-manufacturing-page">
        <style>
            .qf-manufacturing-page {
                min-height: 100vh;
                padding: 32px;
                background: #07111f;
                color: #e5edf7;
            }

            .qf-mfg-container {
                max-width: 1400px;
                margin: auto;
            }

            .qf-mfg-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 18px;
                margin-bottom: 28px;
            }

            .qf-mfg-header h1 {
                margin: 0 0 7px;
                font-size: 27px;
                font-weight: 700;
                color: #f8fafc;
            }

            .qf-mfg-header p {
                margin: 0;
                color: #94a3b8;
                font-size: 13px;
            }

            .qf-mfg-stats {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 18px;
                margin-bottom: 25px;
            }

            .qf-mfg-stat {
                padding: 20px;
                background: #101d2e;
                border: 1px solid #1e334a;
                border-radius: 13px;
            }

            .qf-mfg-stat span {
                color: #94a3b8;
                font-size: 12px;
            }

            .qf-mfg-stat h2 {
                margin: 8px 0 0;
                color: #22d3ee;
                font-size: 26px;
                font-weight: 700;
            }

            .qf-mfg-card {
                padding: 24px;
                margin-bottom: 22px;
                background: #101d2e;
                border: 1px solid #1e334a;
                border-radius: 14px;
            }

            .qf-mfg-card h2 {
                margin: 0 0 7px;
                color: #f1f5f9;
                font-size: 17px;
                font-weight: 650;
            }

            .qf-mfg-description {
                margin: 0 0 22px;
                color: #94a3b8;
                font-size: 12px;
            }

            .qf-mfg-form-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 17px;
            }

            .qf-mfg-field.full {
                grid-column: 1 / -1;
            }

            .qf-mfg-field label {
                display: block;
                margin-bottom: 8px;
                color: #cbd5e1;
                font-size: 12px;
                font-weight: 600;
            }

            .qf-mfg-field input,
            .qf-mfg-field select,
            .qf-mfg-field textarea {
                width: 100%;
                padding: 11px 13px;
                border: 1px solid #29415b;
                border-radius: 8px;
                background: #0a1727;
                color: #e5edf7;
                outline: none;
                font-size: 13px;
            }

            .qf-mfg-field input:focus,
            .qf-mfg-field select:focus,
            .qf-mfg-field textarea:focus {
                border-color: #22d3ee;
            }

            .qf-mfg-field textarea {
                min-height: 75px;
                resize: vertical;
            }

            .qf-mfg-submit {
                margin-top: 20px;
                padding: 11px 19px;
                border: none;
                border-radius: 8px;
                background: linear-gradient(135deg, #06b6d4, #0891b2);
                color: white;
                font-weight: 650;
                font-size: 13px;
                cursor: pointer;
            }

            .qf-mfg-submit:hover {
                opacity: .9;
            }

            .qf-mfg-table-wrap {
                overflow-x: auto;
            }

            .qf-mfg-table {
                width: 100%;
                min-width: 650px;
                border-collapse: collapse;
            }

            .qf-mfg-table th {
                padding: 13px;
                background: #0c1929;
                color: #94a3b8;
                text-align: left;
                font-size: 11px;
                text-transform: uppercase;
                letter-spacing: .5px;
            }

            .qf-mfg-table td {
                padding: 15px 13px;
                border-top: 1px solid #1e334a;
                color: #cbd5e1;
                font-size: 13px;
            }

            .qf-mfg-empty {
                padding: 25px;
                color: #64748b;
                text-align: center;
                font-size: 13px;
            }

            .qf-mfg-alert {
                padding: 13px 16px;
                margin-bottom: 20px;
                border-radius: 9px;
                background: rgba(22, 163, 74, .12);
                border: 1px solid rgba(22, 163, 74, .3);
                color: #86efac;
                font-size: 13px;
            }

            .qf-mfg-errors {
                padding: 13px 16px;
                margin-bottom: 20px;
                border-radius: 9px;
                background: rgba(220, 38, 38, .1);
                border: 1px solid rgba(220, 38, 38, .3);
                color: #fca5a5;
                font-size: 13px;
            }

            .qf-mfg-errors ul {
                margin: 8px 0 0;
                padding-left: 20px;
            }

            .qf-mfg-badge {
                display: inline-block;
                padding: 5px 9px;
                border-radius: 20px;
                background: rgba(22, 163, 74, .13);
                color: #86efac;
                font-size: 11px;
            }

            .qf-mfg-badge.inactive {
                background: rgba(220, 38, 38, .13);
                color: #fca5a5;
            }

            .qf-mfg-action {
                padding: 7px 12px;
                border: 1px solid;
                border-radius: 7px;
                font-size: 11px;
                font-weight: 600;
                cursor: pointer;
            }

            .qf-mfg-action.deactivate {
                background: rgba(220, 38, 38, .1);
                border-color: rgba(220, 38, 38, .4);
                color: #fca5a5;
            }

            .qf-mfg-action.activate {
                background: rgba(22, 163, 74, .1);
                border-color: rgba(22, 163, 74, .4);
                color: #86efac;
            }

            @media(max-width: 700px) {
                .qf-manufacturing-page {
                    padding: 20px 12px;
                }

                .qf-mfg-stats {
                    grid-template-columns: 1fr;
                }

                .qf-mfg-form-grid {
                    grid-template-columns: 1fr;
                }

                .qf-mfg-field.full {
                    grid-column: auto;
                }

                .qf-mfg-card {
                    padding: 18px;
                }
            }
        </style>

        <div class="qf-mfg-container">

            <div class="qf-mfg-header">
                <div>
                    <h1>Manufacturing Setup</h1>
                    <p>Manage factories, production lines and manufacturing machines.</p>
                </div>
            </div>

            @if(session('success'))
            <div class="qf-mfg-alert">{{ session('success') }}</div>
            @endif

            @if($errors->any())
            <div class="qf-mfg-errors">
                <strong>Please correct the following errors:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="qf-mfg-stats">
                <div class="qf-mfg-stat">
                    <span>Total Factories</span>
                    <h2>{{ $factories->count() }}</h2>
                </div>

                <div class="qf-mfg-stat">
                    <span>Production Lines</span>
                    <h2>{{ $productionLines->count() }}</h2>
                </div>

                <div class="qf-mfg-stat">
                    <span>Total Machines</span>
                    <h2>{{ $machines->count() }}</h2>
                </div>
            </div>

            <!-- Factory -->
            <div class="qf-mfg-card">
                <h2>1. Add Factory</h2>
                <p class="qf-mfg-description">
                    Register a manufacturing factory under your company.
                </p>

                <form method="POST" action="{{ route('company-admin.factories.store') }}">
                    @csrf

                    <div class="qf-mfg-form-grid">
                        <div class="qf-mfg-field">
                            <label>Factory Name *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required>
                        </div>

                        <div class="qf-mfg-field">
                            <label>Factory Code *</label>
                            <input type="text" name="factory_code" value="{{ old('factory_code') }}" required>
                        </div>

                        <div class="qf-mfg-field">
                            <label>Contact Person</label>
                            <input type="text" name="contact_person" value="{{ old('contact_person') }}">
                        </div>

                        <div class="qf-mfg-field">
                            <label>Contact Email</label>
                            <input type="email" name="contact_email" value="{{ old('contact_email') }}">
                        </div>

                        <div class="qf-mfg-field">
                            <label>Contact Phone</label>
                            <input type="text" name="contact_phone" value="{{ old('contact_phone') }}">
                        </div>

                        <div class="qf-mfg-field">
                            <label>City</label>
                            <input type="text" name="city" value="{{ old('city') }}">
                        </div>

                        <div class="qf-mfg-field">
                            <label>Country</label>
                            <input type="text" name="country" value="{{ old('country', 'Bangladesh') }}">
                        </div>

                        <div class="qf-mfg-field">
                            <label>Address</label>
                            <input type="text" name="address" value="{{ old('address') }}">
                        </div>
                    </div>

                    <button type="submit" class="qf-mfg-submit">+ Create Factory</button>
                </form>
            </div>

            <!-- Factory List -->
            <div class="qf-mfg-card">
                <h2>Existing Factories</h2>

                @if($factories->isEmpty())
                <div class="qf-mfg-empty">No factories registered yet.</div>
                @else
                <div class="qf-mfg-table-wrap">
                    <table class="qf-mfg-table">
                        <thead>
                            <tr>
                                <th>Factory</th>
                                <th>Code</th>
                                <th>City</th>
                                <th>Production Lines</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($factories as $factory)
                            <tr>
                                <td>{{ $factory->name }}</td>
                                <td>{{ $factory->factory_code }}</td>
                                <td>{{ $factory->city ?? '—' }}</td>
                                <td>{{ $factory->productionLines->count() }}</td>
                                <td><span class="qf-mfg-badge">{{ $factory->status }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            <!-- Production Line -->
            <div class="qf-mfg-card">
                <h2>2. Add Production Line</h2>
                <p class="qf-mfg-description">
                    Create a production line inside an existing factory.
                </p>

                <form method="POST" action="{{ route('company-admin.production-lines.store') }}">
                    @csrf

                    <div class="qf-mfg-form-grid">
                        <div class="qf-mfg-field">
                            <label>Factory *</label>
                            <select name="factory_id" required>
                                <option value="">Select Factory</option>
                                @foreach($factories as $factory)
                                <option value="{{ $factory->id }}">{{ $factory->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="qf-mfg-field">
                            <label>Production Line Name *</label>
                            <input type="text" name="name" required>
                        </div>

                        <div class="qf-mfg-field">
                            <label>Line Code *</label>
                            <input type="text" name="code" required>
                        </div>

                        <div class="qf-mfg-field">
                            <label>Location</label>
                            <input type="text" name="location">
                        </div>

                        <div class="qf-mfg-field full">
                            <label>Description</label>
                            <textarea name="description"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="qf-mfg-submit">+ Create Production Line</button>
                </form>
            </div>

            <!-- Production Line List -->
            <div class="qf-mfg-card">
                <h2>Existing Production Lines</h2>

                @if($productionLines->isEmpty())
                <div class="qf-mfg-empty">No production lines registered yet.</div>
                @else
                <div class="qf-mfg-table-wrap">
                    <table class="qf-mfg-table">
                        <thead>
                            <tr>
                                <th>Line</th>
                                <th>Code</th>
                                <th>Factory</th>
                                <th>Machines</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productionLines as $line)
                            <tr>
                                <td>{{ $line->name }}</td>
                                <td>{{ $line->code }}</td>
                                <td>{{ $line->factory?->name ?? '—' }}</td>
                                <td>{{ $line->machines->count() }}</td>
                                <td><span class="qf-mfg-badge">{{ $line->status }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            <!-- Machine -->
            <div class="qf-mfg-card">
                <h2>3. Add Machine</h2>
                <p class="qf-mfg-description">
                    Register a machine under an existing production line.
                </p>

                <form method="POST" action="{{ route('company-admin.machines.store') }}">
                    @csrf

                    <div class="qf-mfg-form-grid">
                        <div class="qf-mfg-field">
                            <label>Production Line *</label>
                            <select name="production_line_id" required>
                                <option value="">Select Production Line</option>
                                @foreach($productionLines as $line)
                                <option value="{{ $line->id }}">
                                    {{ $line->name }} ({{ $line->factory?->name ?? 'Factory' }})
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="qf-mfg-field">
                            <label>Machine Name *</label>
                            <input type="text" name="name" required>
                        </div>

                        <div class="qf-mfg-field">
                            <label>Machine Code *</label>
                            <input type="text" name="machine_code" required>
                        </div>

                        <div class="qf-mfg-field">
                            <label>Machine Type</label>
                            <input type="text" name="machine_type">
                        </div>

                        <div class="qf-mfg-field">
                            <label>Manufacturer</label>
                            <input type="text" name="manufacturer">
                        </div>

                        <div class="qf-mfg-field">
                            <label>Model Number</label>
                            <input type="text" name="model_number">
                        </div>

                        <div class="qf-mfg-field">
                            <label>Serial Number</label>
                            <input type="text" name="serial_number">
                        </div>

                        <div class="qf-mfg-field">
                            <label>Installation Date</label>
                            <input type="date" name="installation_date">
                        </div>

                        <div class="qf-mfg-field full">
                            <label>Description</label>
                            <textarea name="description"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="qf-mfg-submit">+ Register Machine</button>
                </form>
            </div>


            <!-- Machine List -->
            <div class="qf-mfg-card">
                <h2>Registered Machines</h2>
                <p class="qf-mfg-description">
                    Monitor machine status and manage machine availability.
                </p>

                @if($machines->isEmpty())
                <div class="qf-mfg-empty">No machines registered yet.</div>
                @else
                <div class="qf-mfg-table-wrap">
                    <table class="qf-mfg-table">
                        <thead>
                            <tr>
                                <th>Machine</th>
                                <th>Code</th>
                                <th>Production Line</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($machines as $machine)
                            <tr>
                                <td>{{ $machine->name }}</td>
                                <td>{{ $machine->machine_code }}</td>
                                <td>{{ $machine->productionLine?->name ?? '—' }}</td>
                                <td>{{ $machine->machine_type ?? '—' }}</td>
                                <td>
                                    <span class="qf-mfg-badge {{ $machine->status === 'active' ? '' : 'inactive' }}">
                                        {{ ucfirst($machine->status) }}
                                    </span>
                                </td>
                                <td>
                                    <form method="POST"
                                        action="{{ route('company-admin.machines.toggle-status', $machine->id) }}"
                                       onsubmit="return confirm('Are you sure you want to change this machine status?')">

                                        @csrf
                                        @method('PATCH')

                                        <button type="submit"
                                            class="qf-mfg-action {{ $machine->status === 'active' ? 'deactivate' : 'activate' }}">
                                            {{ $machine->status === 'active' ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
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