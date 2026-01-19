@extends('admin.layouts.app')

@section('title', 'Contact-Us')
@section('page-title', 'Contact-Us')

@section('content')
    <div class="card shadow-sm border-0 koa-tb-card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between align-items-center p-3">
                <h3 class="card-title mb-0 text-dark fs-4">All Contacts</h3>
                <div class="card-tools d-flex align-items-center gap-3">
                    <span class="badge koa-badge-green fw-bold px-3 py-2">
                        {{ $contacts->total() }} Total Submissions
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body p-4 koa-tb-cnt">
            @if($contacts->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-borderless align-middle">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Subject</th>
                                <th>User Name</th>
                                <th>Submitted At</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                            <tr>
                                <td>
                                    <strong class="text-dark">{{ $contact->name }}</strong>
                                </td>
                                <td>
                                    <a href="mailto:{{ $contact->email }}" class="text-dark fw-medium text-decoration-none">
                                        {{ $contact->email }}
                                    </a>
                                </td>
                                <td>
                                    <span class="badge koa-badge-light-green  fw-normal px-3 py-2">
                                        <a href="tel:{{ $contact->phone }}" class="text-decoration-none" style="color: inherit;">
                                            {{ $contact->phone }}
                                        </a>
                                    </span>
                                </td>
                                <td>
                                    <span class="text-dark">{{ Str::limit($contact->subject, 40) }}</span>
                                </td>
                                <td>
                                    @if($contact->user)
                                        <span class="badge koa-badge-light-green  fw-normal px-3 py-2">
                                            {{ $contact->user->name }}
                                        </span>
                                    @else
                                        <span class="badge koa-badge-light-grey fw-normal px-3 py-2">Guest</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">{{ $contact->created_at->format('M d, Y H:i') }}</small>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group" role="group" aria-label="Contact actions">
                                        <a href="{{ route('admin.contact-us.show', $contact->id) }}"
                                             class="btn btn-sm rounded-circle action-btns koa-badge-light-green"
                                               title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.contact-us.destroy', $contact->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this contact submission?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
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

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $contacts->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-envelope fa-3x text-muted mb-3"></i>
                    <h4 class="text-dark">No Contact Submissions Found</h4>
                    <p class="text-muted">There are no contact submissions yet.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
