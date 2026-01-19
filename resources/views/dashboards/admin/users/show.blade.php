@extends('layouts.master')

@section('title', 'User Details')

@section('navbar-title', '👤 User Details')

@section('custom-css')
    .details-container {
        background: white;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 0 auto;
    }

    .profile-header {
        display: flex;
        align-items: center;
        gap: 30px;
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        font-weight: bold;
    }

    .profile-info h2 {
        margin: 0;
        color: #333;
        font-size: 24px;
    }

    .profile-info p {
        margin: 5px 0 0;
        color: #666;
    }

    .details-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }

    .detail-item {
        margin-bottom: 10px;
    }

    .detail-label {
        font-size: 12px;
        text-transform: uppercase;
        color: #999;
        font-weight: 600;
        letter-spacing: 1px;
        margin-bottom: 5px;
    }

    .detail-value {
        font-size: 16px;
        color: #333;
        font-weight: 500;
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
        font-size: 12px;
        text-transform: uppercase;
        font-weight: bold;
        background: #e9ecef;
        color: #495057;
    }

    .actions {
        margin-top: 40px;
        display: flex;
        gap: 15px;
    }

    .btn {
        padding: 12px 25px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
    }

    .btn-edit {
        background: #ffc107;
        color: #000;
    }

    .btn-back {
        background: #6c757d;
        color: white;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }

    .btn-login {
        background: #6f42c1;
        color: white;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
@endsection

@section('content')
    <div class="details-container">
        <div class="profile-header">
            <div class="profile-avatar">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div class="profile-info">
                <h2>{{ $user->name }}</h2>
                <p>User ID: #{{ $user->id }}</p>
            </div>
        </div>

        <div class="details-grid">
            <div class="detail-item">
                <div class="detail-label">Email Address</div>
                <div class="detail-value">{{ $user->email }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Phone Number</div>
                <div class="detail-value">{{ $user->phone }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Account Role</div>
                <div class="detail-value">
                    <span class="role-badge">{{ $user->role }}</span>
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Account Status</div>
                <div class="detail-value">
                    <span class="status-badge status-{{ $user->status }}">
                        {{ ucfirst($user->status) }}
                    </span>
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Current Credit Balance</div>
                <div class="detail-value" style="color: #28a745; font-size: 20px;">
                    ${{ number_format($user->credit, 2) }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Created At</div>
                <div class="detail-value">{{ $user->created_at->format('F d, Y H:i') }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Last Updated</div>
                <div class="detail-value">{{ $user->updated_at->format('F d, Y H:i') }}</div>
            </div>
        </div>

        <div class="details-grid">
            <!-- ... existing fields ... -->
        </div>

        <div style="margin-top: 30px; padding: 20px; background: #f8faff; border-radius: 8px; border: 1px solid #e1e8f0;">
            <h4 style="margin-bottom: 15px; color: #333;">💰 Add Credit to Account</h4>
            <form action="{{ route('admin.users.add-credit', $user->id) }}" method="POST" style="display: flex; gap: 10px; align-items: flex-end;">
                @csrf
                <div style="flex: 1;">
                    <label style="font-size: 12px; font-weight: 600; color: #666; display: block; margin-bottom: 5px;">Amount (USD)</label>
                    <input type="number" name="amount" step="0.01" min="0.01" max="300" placeholder="0.00" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <button type="submit" style="background: #28a745; color: white; border: none; padding: 10px 20px; border-radius: 5px; font-weight: 600; cursor: pointer; height: 42px;">
                    ➕ Add Credit
                </button>
            </form>
            <p style="font-size: 11px; color: #999; margin-top: 8px;">Maximum allowed credit addition at once is $300.</p>
        </div>

        <div class="actions">
            <a href="{{ route('admin.users.index') }}" class="btn btn-back">⬅️ Back to List</a>
            <form action="{{ route('admin.users.login-as', $user->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-login">🔑 Login As User</button>
            </form>
            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-edit">✏️ Edit User</a>
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete">🗑️ Delete User</button>
            </form>
        </div>
    </div>
@endsection
