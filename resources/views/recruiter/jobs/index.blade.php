@extends('recruiter.layouts.app')

@section('title', 'Job Listings')
@section('page-title', 'Job Listings')

@section('page-actions')
    <a href="{{ route('recruiter.jobs.create') }}" class="btn btn-t-y">
        <i class="fas fa-plus me-1"></i> Add New Job
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 koa-tb-card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between align-items-center p-3">
                        <h5 class="card-title mb-0 text-dark fs-4">All Job Listings</h5>
                        <div class="card-tools">
                            <span class="badge koa-badge-green fw-bold px-3 py-2">
                                {{ $jobs->total() }} Total Jobs
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4 koa-tb-cnt">
                    @if($jobs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless align-middle">
                                <thead class="koa-thead">
                                    <tr>
                                        <th class="ps-4">Title</th>
                                        <th>Category</th>
                                        <th>Location</th>
                                        <th>Employment Type</th>
                                        <th>Salary Range</th>
                                        <th>Status</th>
                                        <th>Approval Status</th>
                                        <th>Featured</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jobs as $job)
                                        <tr style="transition: background-color 0.2s;">
                                            <td class="ps-4">
                                                <div>
                                                    <strong class="text-dark">{{ $job->title }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ Str::limit($job->short_description, 50) }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge koa-badge-blue fw-normal px-3 py-2">
                                                    {{ $job->category }}
                                                </span>
                                            </td>
                                            <td class="text-muted">
                                                {{ $job->location ?: 'Not specified' }}
                                            </td>
                                            <td>
                                                <span class="badge koa-badge-light-green fw-normal px-3 py-2">
                                                    {{ ucfirst(str_replace('-', ' ', $job->employment_type)) }}
                                                </span>
                                            </td>
                                            <td class="text-muted">
                                                {{ $job->salary_range }}
                                            </td>
                                            <td>
                                                <form action="{{ route('recruiter.jobs.toggle-status', $job) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="btn btn-sm fw-medium rounded-pill text-nowrap px-3 {{ $job->is_active ? 'koa-badge-green' : 'koa-badge-green-outline' }}">
                                                        <i class="fas {{ $job->is_active ? 'fa-check' : 'fa-times' }} me-1"></i>
                                                        {{ $job->is_active ? 'Active' : 'Inactive' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <span class="badge {{ $job->is_approved ? 'koa-badge-green' : 'koa-badge-red' }} fw-normal px-3 py-2">
                                                    {{ $job->is_approved ? 'Approved' : 'Pending' }}
                                                </span>
                                            </td>
                                            <td>
                                                <form action="{{ route('recruiter.jobs.toggle-featured', $job) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="btn btn-sm fw-medium rounded-pill text-nowrap px-3 {{ $job->is_featured ? 'koa-badge-yellow' : 'koa-badge-yellow-outline' }}">
                                                        <i class="fas fa-star me-1"></i>
                                                        {{ $job->is_featured ? 'Featured' : 'Not Featured' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="btn-group" role="group" style="gap: 8px;">
                                                    <a href="{{ route('recruiter.jobs.show', $job) }}"
                                                        class="btn btn-sm rounded-circle action-btns koa-badge-light-green"
                                                        title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('recruiter.jobs.edit', $job) }}"
                                                        class="btn btn-sm rounded-circle action-btns koa-badge-green" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('recruiter.jobs.destroy', $job) }}" method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Are you sure you want to delete this job listing?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm rounded-circle action-btns koa-badge-red-outline"
                                                            title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $jobs->links('pagination::bootstrap-5') }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-briefcase fa-3x text-muted mb-3"></i>
                            <h5 class="text-dark">No Job Listings Found</h5>
                            <p class="text-muted">Get started by creating your first job listing.</p>
                            <a href="{{ route('recruiter.jobs.create') }}" class="btn fw-medium px-4 py-2"
                                style="background-color: #3ca200; color: #fff;">
                                <i class="fas fa-plus me-2"></i>Add New Job
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
