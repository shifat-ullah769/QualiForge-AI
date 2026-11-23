<x-app-layout>
    <div class="qf-dataset-list-page">
        <style>
            .qf-dataset-list-page {
                min-height: 100vh;
                padding: 32px;
                background: #07111f;
                color: #e5edf7;
            }

            .qf-dataset-container {
                max-width: 1400px;
                margin: 0 auto;
            }

            .qf-dataset-heading {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 20px;
                margin-bottom: 28px;
                flex-wrap: wrap;
            }

            .qf-dataset-heading h1 {
                font-size: 28px;
                font-weight: 700;
                color: #f8fafc;
                margin: 0 0 8px;
            }

            .qf-dataset-heading p {
                color: #94a3b8;
                margin: 0;
                font-size: 14px;
            }

            .qf-dataset-primary-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 11px 18px;
                border-radius: 9px;
                background: linear-gradient(135deg, #06b6d4, #0891b2);
                color: #fff;
                font-weight: 600;
                text-decoration: none;
                font-size: 14px;
                transition: 0.2s;
            }

            .qf-dataset-primary-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 22px rgba(6, 182, 212, 0.2);
            }

            .qf-dataset-panel {
                background: #101d2e;
                border: 1px solid #1e334a;
                border-radius: 14px;
                overflow: hidden;
            }

            .qf-dataset-panel-header {
                padding: 20px 24px;
                border-bottom: 1px solid #1e334a;
            }

            .qf-dataset-panel-header h2 {
                font-size: 17px;
                font-weight: 650;
                color: #f1f5f9;
                margin: 0 0 5px;
            }

            .qf-dataset-panel-header p {
                color: #94a3b8;
                font-size: 13px;
                margin: 0;
            }

            .qf-dataset-table-wrapper {
                width: 100%;
                overflow-x: auto;
            }

            .qf-dataset-table {
                width: 100%;
                border-collapse: collapse;
                min-width: 850px;
            }

            .qf-dataset-table th {
                padding: 14px 20px;
                text-align: left;
                background: #0c1929;
                color: #94a3b8;
                font-size: 11px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.6px;
                white-space: nowrap;
            }

            .qf-dataset-table td {
                padding: 17px 20px;
                border-top: 1px solid #1e334a;
                color: #cbd5e1;
                font-size: 13px;
                vertical-align: middle;
            }

            .qf-dataset-table tbody tr:hover {
                background: rgba(30, 51, 74, 0.35);
            }

            .qf-dataset-name {
                color: #f1f5f9;
                font-weight: 600;
                margin-bottom: 4px;
            }

            .qf-dataset-filename {
                color: #64748b;
                font-size: 11px;
            }

            .qf-dataset-muted {
                color: #64748b;
            }

            .qf-dataset-status {
                display: inline-flex;
                align-items: center;
                padding: 5px 10px;
                border-radius: 20px;
                font-size: 11px;
                font-weight: 650;
                text-transform: capitalize;
                white-space: nowrap;
            }

            .qf-status-uploaded {
                color: #67e8f9;
                background: rgba(8, 145, 178, 0.15);
            }

            .qf-status-pending {
                color: #fcd34d;
                background: rgba(217, 119, 6, 0.15);
            }

            .qf-status-validated {
                color: #86efac;
                background: rgba(22, 163, 74, 0.15);
            }

            .qf-status-failed {
                color: #fca5a5;
                background: rgba(220, 38, 38, 0.15);
            }

            .qf-dataset-view-link {
                color: #22d3ee;
                text-decoration: none;
                font-weight: 600;
                white-space: nowrap;
            }

            .qf-dataset-view-link:hover {
                color: #67e8f9;
            }

            .qf-dataset-empty {
                padding: 65px 20px;
                text-align: center;
            }

            .qf-dataset-empty-icon {
                width: 58px;
                height: 58px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 18px;
                border-radius: 16px;
                background: rgba(6, 182, 212, 0.1);
                color: #22d3ee;
                font-size: 26px;
            }

            .qf-dataset-empty h3 {
                color: #f1f5f9;
                font-size: 18px;
                font-weight: 650;
                margin: 0 0 8px;
            }

            .qf-dataset-empty p {
                color: #94a3b8;
                font-size: 13px;
                margin: 0 0 20px;
            }

            .qf-dataset-pagination {
                padding: 18px 22px;
                border-top: 1px solid #1e334a;
            }

            .qf-dataset-pagination nav p {
                color: #94a3b8;
            }

            .qf-dataset-alert {
                padding: 13px 16px;
                border-radius: 9px;
                margin-bottom: 20px;
                font-size: 13px;
                background: rgba(22, 163, 74, 0.12);
                border: 1px solid rgba(22, 163, 74, 0.3);
                color: #86efac;
            }

            @media (max-width: 640px) {
                .qf-dataset-list-page {
                    padding: 20px 12px;
                }

                .qf-dataset-heading h1 {
                    font-size: 23px;
                }
            }
        </style>

        <div class="qf-dataset-container">

            <div class="qf-dataset-heading">
                <div>
                    <h1>Dataset Management</h1>
                    <p>Upload, organize and manage your manufacturing datasets.</p>
                </div>

                <a href="{{ route('qe.datasets.create') }}"
                   class="qf-dataset-primary-btn">
                    + Upload Dataset
                </a>
            </div>

            @if (session('success'))
                <div class="qf-dataset-alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="qf-dataset-panel">

                <div class="qf-dataset-panel-header">
                    <h2>Uploaded Datasets</h2>
                    <p>
                        Showing {{ $datasets->total() }}
                        dataset(s) belonging to your company.
                    </p>
                </div>

                @if ($datasets->count() > 0)

                    <div class="qf-dataset-table-wrapper">
                        <table class="qf-dataset-table">
                            <thead>
                                <tr>
                                    <th>Dataset</th>
                                    <th>Factory</th>
                                    <th>Production Line</th>
                                    <th>Machine</th>
                                    <th>Rows</th>
                                    <th>Status</th>
                                    <th>Uploaded</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($datasets as $dataset)
                                    <tr>
                                        <td>
                                            <div class="qf-dataset-name">
                                                {{ $dataset->name }}
                                            </div>
                                            <div class="qf-dataset-filename">
                                                {{ $dataset->original_filename }}
                                            </div>
                                        </td>

                                        <td>
                                            {{ $dataset->factory?->name ?? '—' }}
                                        </td>

                                        <td>
                                            {{ $dataset->productionLine?->name ?? '—' }}
                                        </td>

                                        <td>
                                            {{ $dataset->machine?->name ?? '—' }}
                                        </td>

                                        <td>
                                            {{ $dataset->row_count ?? '—' }}
                                        </td>

                                        <td>
                                            @php
                                                $status = strtolower($dataset->status ?? 'unknown');
                                                $validationStatus = strtolower($dataset->validation_status ?? 'pending');

                                                $statusClass = match ($status) {
                                                    'uploaded' => 'qf-status-uploaded',
                                                    'validated', 'processed' => 'qf-status-validated',
                                                    'failed', 'error' => 'qf-status-failed',
                                                    default => 'qf-status-pending',
                                                };
                                            @endphp

                                            <span class="qf-dataset-status {{ $statusClass }}">
                                                {{ str_replace('_', ' ', $status) }}
                                            </span>

                                            <div class="qf-dataset-filename" style="margin-top: 5px;">
                                                Validation: {{ str_replace('_', ' ', $validationStatus) }}
                                            </div>
                                        </td>

                                        <td>
                                            {{ $dataset->created_at?->format('d M Y') ?? '—' }}
                                        </td>

                                        <td>
                                            <a class="qf-dataset-view-link"
                                               href="{{ route('qe.datasets.show', $dataset->id) }}">
                                                View Details →
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="qf-dataset-pagination">
                        {{ $datasets->links() }}
                    </div>

                @else

                    <div class="qf-dataset-empty">
                        <div class="qf-dataset-empty-icon">
                            ⇧
                        </div>

                        <h3>No datasets uploaded yet</h3>

                        <p>
                            Upload your first manufacturing dataset to get started.
                        </p>

                        <a href="{{ route('qe.datasets.create') }}"
                           class="qf-dataset-primary-btn">
                            Upload Your First Dataset
                        </a>
                    </div>

                @endif

            </div>
        </div>
    </div>
</x-app-layout>
