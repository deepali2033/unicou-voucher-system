@extends('recruiter.layouts.app')

@section('title', 'Candidates Management')
@section('page-title', 'Candidates')

@section('page-actions')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ route('recruiter.candidates.create') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-plus"></i> Add New Candidate
            </a>
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="card-title">{{ $stats['total'] }}</h4>
                                <p class="card-text">Total Applications</p>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="card-title">{{ $stats['pending'] }}</h4>
                                <p class="card-text">Pending Review</p>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-clock fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="card-title">{{ $stats['under_review'] }}</h4>
                                <p class="card-text">Under Review</p>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-search fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="card-title">{{ $stats['accepted'] }}</h4>
                                <p class="card-text">Accepted</p>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-check fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('recruiter.candidates.index') }}" class="row g-3">
                    <div class="col-md-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="under_review" {{ request('status') == 'under_review' ? 'selected' : '' }}>Under Review</option>
                            <option value="interviewed" {{ request('status') == 'interviewed' ? 'selected' : '' }}>Interviewed</option>
                            <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" name="position" id="position" class="form-control" 
                               value="{{ request('position') }}" placeholder="Search by position">
                    </div>
                    <div class="col-md-3">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" name="search" id="search" class="form-control" 
                               value="{{ request('search') }}" placeholder="Name or email">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Filter
                            </button>
                            <a href="{{ route('recruiter.candidates.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i> Clear
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Candidates Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Candidates List</h5>
            </div>
            <div class="card-body">
                @if($candidates->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Position</th>
                                    <th>Status</th>
                                    <th>Applied Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($candidates as $candidate)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2">
                                                    {{ strtoupper(substr($candidate->first_name, 0, 1) . substr($candidate->last_name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <strong>{{ $candidate->full_name }}</strong>
                                                    @if($candidate->jobListing)
                                                        <br><small class="text-muted">Applied for: {{ $candidate->jobListing->title }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="mailto:{{ $candidate->email }}">{{ $candidate->email }}</a>
                                        </td>
                                        <td>
                                            @if($candidate->phone)
                                                <a href="tel:{{ $candidate->phone }}">{{ $candidate->phone }}</a>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>{{ $candidate->position_applied ?: 'Not specified' }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm badge {{ $candidate->status_badge }} dropdown-toggle" 
                                                        type="button" data-bs-toggle="dropdown">
                                                    {{ ucfirst($candidate->status) }}
                                                </button>
                                                <ul class="dropdown-menu">
                                                    @foreach(['pending', 'under_review', 'interviewed', 'accepted', 'rejected'] as $status)
                                                        @if($status !== $candidate->status)
                                                            <li>
                                                                <form method="POST" action="{{ route('recruiter.candidates.update-status', $candidate) }}" class="d-inline">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="hidden" name="status" value="{{ $status }}">
                                                                    <button type="submit" class="dropdown-item">
                                                                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $candidate->applied_at->format('M d, Y') }}
                                            <br><small class="text-muted">{{ $candidate->applied_at->diffForHumans() }}</small>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('recruiter.candidates.show', $candidate) }}" 
                                                   class="btn btn-sm btn-outline-primary" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('recruiter.candidates.edit', $candidate) }}" 
                                                   class="btn btn-sm btn-outline-secondary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if($candidate->resume_path)
                                                    <a href="{{ route('recruiter.candidates.download-resume', $candidate) }}" 
                                                       class="btn btn-sm btn-outline-info" title="Download Resume">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                @endif
                                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                                        onclick="confirmDelete({{ $candidate->id }})" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            Showing {{ $candidates->firstItem() }} to {{ $candidates->lastItem() }} of {{ $candidates->total() }} results
                        </div>
                        <div>
                            {{ $candidates->links() }}
                        </div>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <h5>No candidates found</h5>
                        <p class="text-muted">No candidates match your current filters.</p>
                        @if(request()->hasAny(['status', 'position', 'search']))
                            <a href="{{ route('recruiter.candidates.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-times"></i> Clear Filters
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this candidate? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.avatar-sm {
    width: 32px;
    height: 32px;
    font-size: 12px;
    font-weight: bold;
}

.badge-warning {
    background-color: #ffc107 !important;
    color: #000 !important;
}

.badge-info {
    background-color: #17a2b8 !important;
}

.badge-primary {
    background-color: #007bff !important;
}

.badge-success {
    background-color: #28a745 !important;
}

.badge-danger {
    background-color: #dc3545 !important;
}

.badge-secondary {
    background-color: #6c757d !important;
}
</style>
@endpush

@push('scripts')
<script>
function confirmDelete(candidateId) {
    const form = document.getElementById('deleteForm');
    form.action = `/recruiter/candidates/${candidateId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endpush