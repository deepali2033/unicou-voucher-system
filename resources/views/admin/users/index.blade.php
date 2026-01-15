@extends('layouts.master')

@section('title', 'User Management')

@section('navbar-title', '👥 User Management')

@section('custom-css')
    .users-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .create-btn {
        background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
        color: white;
        padding: 12px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 600;
        transition: transform 0.3s;
    }

    .create-btn:hover {
        transform: translateY(-2px);
        color: white;
    }

    .users-table {
        width: 100%;
        background: white;
        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .users-table thead {
        background: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }

    .users-table th {
        padding: 15px;
        text-align: left;
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }

    .users-table td {
        padding: 15px;
        border-bottom: 1px solid #dee2e6;
        color: #666;
    }

    .users-table tbody tr:hover {
        background: #f8f9fa;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-active {
        background: #d4edda;
        color: #155724;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-frozen {
        background: #f8d7da;
        color: #721c24;
    }

    .role-badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 11px;
        text-transform: uppercase;
        font-weight: bold;
        background: #e9ecef;
        color: #495057;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-small {
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
        display: inline-block;
    }

    .btn-view {
        background: #17a2b8;
        color: white;
    }

    .btn-edit {
        background: #ffc107;
        color: #000;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }

    .btn-login {
        background: #6f42c1;
        color: white;
    }

    .btn-small:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }
@endsection

@section('content')
    <div class="users-header">
        <h2>System Users</h2>
        <a href="{{ route('admin.users.create') }}" class="create-btn">➕ Create New User</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="users-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>#{{ $user->id }}</td>
                    <td><strong>{{ $user->name }}</strong></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td><span class="role-badge">{{ $user->role }}</span></td>
                    <td>
                        <span class="status-badge status-{{ $user->status }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <form action="{{ route('admin.users.login-as', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-small btn-login">🔑 Login As</button>
                            </form>
                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn-small btn-view">👁️ View</a>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-small btn-edit">✏️ Edit</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-small btn-delete">🗑️ Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 30px;">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $users->links() }}
    </div>
@endsection
