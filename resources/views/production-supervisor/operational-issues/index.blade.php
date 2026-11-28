<x-app-layout>
<div class="container-fluid py-4 operational-issues-page">

    <div class="page-header">
        <div>
            <span class="eyebrow">PRODUCTION SUPERVISOR</span>
            <h1>Operational Alerts & Issues</h1>
            <p>Report and track machine malfunctions and operational blockers.</p>
        </div>

        <a href="{{ route('production-supervisor.operational-issues.create') }}"
           class="btn btn-primary">
            + Report New Issue
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            Please check the submitted information and try again.
        </div>
    @endif

    <div class="summary-card">
        <div>
            <span class="summary-label">TOTAL REPORTED ISSUES</span>
            <h2>{{ $issues->total() }}</h2>
            <p>Your reported operational issues</p>
        </div>
        <div class="summary-icon">!</div>
    </div>

    <div class="section-heading">
        <div>
            <h2>Reported Issues</h2>
            <p>Issues reported by your account</p>
        </div>
    </div>

    @forelse($issues as $issue)
        <div class="issue-card">

            <div class="issue-top">
                <div>
                    <span class="issue-id">ISSUE #{{ $issue->id }}</span>
                    <h3>{{ $issue->title }}</h3>
                    <p class="issue-date">
                        Reported {{ $issue->created_at->format('d M Y, h:i A') }}
                    </p>
                </div>

                <div class="issue-badges">
                    <span class="severity-badge severity-{{ $issue->severity }}">
                        {{ ucfirst($issue->severity) }} Severity
                    </span>

                    <span class="status-badge status-{{ $issue->status }}">
                        {{ ucwords(str_replace('_', ' ', $issue->status)) }}
                    </span>
                </div>
            </div>

            <div class="issue-details">
                <div>
                    <span>Issue Type</span>
                    <strong>
                        {{ $issue->issue_type === 'machine_malfunction'
                            ? 'Machine Malfunction'
                            : 'Operational Blocker' }}
                    </strong>
                </div>

                <div>
                    <span>Factory</span>
                    <strong>{{ $issue->factory?->name ?? 'Unavailable' }}</strong>
                </div>

                <div>
                    <span>Production Line</span>
                    <strong>{{ $issue->productionLine?->name ?? 'Not specified' }}</strong>
                </div>

                <div>
                    <span>Machine</span>
                    <strong>{{ $issue->machine?->name ?? 'Not specified' }}</strong>
                </div>
            </div>

            <div class="issue-description">
                <span>Description</span>
                <p>{{ $issue->description }}</p>
            </div>

            <form method="POST"
                  action="{{ route('production-supervisor.operational-issues.status.update', $issue) }}"
                  class="status-form">
                @csrf
                @method('PATCH')

                <label for="status-{{ $issue->id }}">Update Issue Status</label>

                <div class="status-controls">
                    <select name="status" id="status-{{ $issue->id }}" required>
                        <option value="reported" @selected($issue->status === 'reported')>
                            Reported
                        </option>
                        <option value="under_review" @selected($issue->status === 'under_review')>
                            Under Review
                        </option>
                        <option value="resolved" @selected($issue->status === 'resolved')>
                            Resolved
                        </option>
                    </select>

                    <button type="submit" class="btn btn-outline-primary">
                        Update Status
                    </button>
                </div>
            </form>

        </div>
    @empty
        <div class="empty-state">
            <div class="empty-icon">!</div>
            <h3>No Operational Issues Reported</h3>
            <p>
                You have not reported any machine malfunction or operational blocker yet.
            </p>
            <a href="{{ route('production-supervisor.operational-issues.create') }}"
               class="btn btn-primary">
                Report an Issue
            </a>
        </div>
    @endforelse

    <div class="pagination-wrapper">
        {{ $issues->links() }}
    </div>

</div>

<style>
.operational-issues-page {
    color: #e8eef8;
    max-width: 1500px;
    margin: auto;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 28px;
}

.eyebrow {
    color: #20c5d9;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 1.5px;
}

.page-header h1 {
    font-size: 28px;
    font-weight: 750;
    margin: 7px 0;
    color: #f4f7fc;
}

.page-header p,
.section-heading p {
    color: #91a0b5;
    margin: 0;
}

.operational-issues-page .btn-primary {
    background: #0e9fb5;
    border-color: #0e9fb5;
    color: white;
    font-weight: 650;
    padding: 10px 17px;
    border-radius: 8px;
    text-decoration: none;
}

.operational-issues-page .btn-primary:hover {
    background: #0b879a;
    border-color: #0b879a;
}

.summary-card {
    background: linear-gradient(120deg, #10263e, #153d55);
    border: 1px solid #24516a;
    border-radius: 13px;
    padding: 22px 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 350px;
    margin-bottom: 35px;
}

.summary-label {
    font-size: 11px;
    color: #9fb5c9;
    font-weight: 750;
    letter-spacing: .8px;
}

.summary-card h2 {
    font-size: 32px;
    margin: 8px 0 3px;
    color: #ffffff;
}

.summary-card p {
    color: #a8bbce;
    font-size: 12px;
    margin: 0;
}

.summary-icon,
.empty-icon {
    width: 43px;
    height: 43px;
    border-radius: 12px;
    background: #0e7185;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 23px;
    font-weight: 800;
}

.section-heading {
    margin-bottom: 16px;
}

.section-heading h2 {
    font-size: 19px;
    color: #f1f5fb;
    margin-bottom: 5px;
}

.section-heading p {
    font-size: 13px;
}

.issue-card {
    background: #101e30;
    border: 1px solid #263950;
    border-radius: 12px;
    padding: 23px;
    margin-bottom: 17px;
}

.issue-top {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    flex-wrap: wrap;
}

.issue-id {
    color: #28c1d4;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .8px;
}

.issue-top h3 {
    font-size: 18px;
    color: #f3f6fb;
    margin: 7px 0;
}

.issue-date {
    color: #8294aa;
    font-size: 12px;
    margin: 0;
}

.issue-badges {
    display: flex;
    gap: 8px;
    align-items: flex-start;
    flex-wrap: wrap;
}

.severity-badge,
.status-badge {
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 750;
}

.severity-low {
    background: #153b35;
    color: #6ce0b0;
}

.severity-medium {
    background: #3d3822;
    color: #e9ce70;
}

.severity-high {
    background: #49321e;
    color: #ffbd78;
}

.severity-critical {
    background: #4b252d;
    color: #ff8998;
}

.status-reported {
    background: #26364c;
    color: #a8c9ed;
}

.status-under_review {
    background: #3d3822;
    color: #e9ce70;
}

.status-resolved {
    background: #153b35;
    color: #6ce0b0;
}

.issue-details {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 15px;
    padding: 20px 0;
    margin-top: 17px;
    border-top: 1px solid #263950;
    border-bottom: 1px solid #263950;
}

.issue-details div,
.issue-description {
    min-width: 0;
}

.issue-details span,
.issue-description span {
    display: block;
    color: #8294aa;
    font-size: 11px;
    margin-bottom: 6px;
}

.issue-details strong {
    color: #e1eaf5;
    font-size: 13px;
    overflow-wrap: anywhere;
}

.issue-description {
    padding: 17px 0;
}

.issue-description p {
    color: #c4d0df;
    font-size: 13px;
    line-height: 1.6;
    margin: 0;
    white-space: pre-line;
}

.status-form {
    border-top: 1px solid #263950;
    padding-top: 16px;
}

.status-form label {
    display: block;
    color: #aebed0;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 9px;
}

.status-controls {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.status-controls select {
    background: #0b1727;
    border: 1px solid #34485e;
    color: #e8eef8;
    border-radius: 7px;
    padding: 9px 12px;
    min-width: 180px;
}

.btn-outline-primary {
    border: 1px solid #159eb3;
    color: #48c9d9;
    background: transparent;
    border-radius: 7px;
    padding: 8px 15px;
    font-weight: 650;
}

.btn-outline-primary:hover {
    background: #0e7185;
    color: white;
}

.empty-state {
    background: #101e30;
    border: 1px dashed #34485e;
    border-radius: 12px;
    text-align: center;
    padding: 50px 20px;
}

.empty-icon {
    margin: 0 auto 15px;
}

.empty-state h3 {
    color: #e8eef8;
    font-size: 18px;
}

.empty-state p {
    color: #91a0b5;
    font-size: 13px;
    margin-bottom: 20px;
}

.pagination-wrapper {
    margin-top: 20px;
}

.pagination-wrapper .pagination {
    gap: 4px;
}

.pagination-wrapper .page-link {
    background: #101e30;
    border-color: #263950;
    color: #b8c9dc;
}

.pagination-wrapper .active .page-link {
    background: #0e9fb5;
    border-color: #0e9fb5;
    color: white;
}

@media (max-width: 768px) {
    .page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .issue-details {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .issue-card {
        padding: 17px;
    }
}

@media (max-width: 420px) {
    .issue-details {
        grid-template-columns: 1fr;
    }
}
</style>
</x-app-layout>
