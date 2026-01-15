@extends('layouts.master')

@section('title', 'Notifications')

@section('navbar-title', '🔔 Notifications')

@section('custom-css')
    .notifications-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .icon-total { background: #e7f0ff; color: #007bff; }
    .icon-unread { background: #fff4e5; color: #ff9800; }
    .icon-read { background: #f0fdf4; color: #28a745; }

    .stat-info h4 {
        margin: 0;
        color: #666;
        font-size: 14px;
        font-weight: 500;
    }

    .stat-info p {
        margin: 5px 0 0;
        font-size: 24px;
        font-weight: 700;
        color: #333;
    }

    .notifications-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .card-header {
        padding: 20px 25px;
        background: #f8f9fa;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h3 {
        margin: 0;
        font-size: 18px;
        color: #333;
    }

    .badge-count {
        background: #28a745;
        color: white;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 12px;
    }

    .notification-item {
        padding: 20px 25px;
        border-bottom: 1px solid #f1f1f1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: background 0.3s;
    }

    .notification-item:hover {
        background: #fafafa;
    }

    .notification-item.unread {
        background: #f8faff;
        border-left: 4px solid #667eea;
    }

    .noti-content {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .noti-icon {
        font-size: 24px;
        color: #ccc;
    }

    .noti-text h5 {
        margin: 0;
        color: #333;
        font-size: 15px;
    }

    .noti-text p {
        margin: 5px 0 0;
        color: #777;
        font-size: 13px;
    }

    .noti-actions {
        display: flex;
        gap: 10px;
    }

    .btn-action {
        padding: 6px 12px;
        border-radius: 5px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-approve { background: #28a745; color: white; }
    .btn-read { background: #6c757d; color: white; }
    .btn-delete { background: #dc3545; color: white; }

    .btn-action:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
    }

    .empty-icon {
        font-size: 60px;
        color: #eee;
        margin-bottom: 20px;
    }

    .btn-delete-all {
        background: #fff;
        border: 1px solid #dc3545;
        color: #dc3545;
        padding: 8px 15px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-delete-all:hover {
        background: #dc3545;
        color: white;
    }
@endsection

@section('content')
    <div class="notifications-header">
        <h2>Notifications</h2>
        @if($totalCount > 0)
            <form action="{{ route('notifications.deleteAll') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete all notifications?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete-all">🗑️ Delete All Read</button>
            </form>
        @endif
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon icon-total">🔔</div>
            <div class="stat-info">
                <h4>Total Notifications</h4>
                <p>{{ $totalCount }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-unread">📧</div>
            <div class="stat-info">
                <h4>Unread</h4>
                <p>{{ $unreadCount }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-read">📥</div>
            <div class="stat-info">
                <h4>Read</h4>
                <p>{{ $readCount }}</p>
            </div>
        </div>
    </div>

    <div class="notifications-card">
        <div class="card-header">
            <h3>All Notifications</h3>
            <span class="badge-count">{{ $unreadCount }} Notifications</span>
        </div>

        <div class="notifications-list">
            @forelse($notifications as $notification)
                <div class="notification-item {{ $notification->read_at ? '' : 'unread' }}">
                    <div class="noti-content">
                        <div class="noti-icon">
                            {!! $notification->read_at ? '🔕' : '🔔' !!}
                        </div>
                        <div class="noti-text">
                            <h5>{{ $notification->data['title'] ?? 'New Notification' }}</h5>
                            <p>{{ $notification->data['message'] ?? 'You have a new update.' }}</p>
                            <small style="color:#aaa">{{ $notification->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    <div class="noti-actions">
                        @if(isset($notification->data['action_type']) && $notification->data['action_type'] === 'approve')
                            <form action="{{ route('notifications.approve', $notification->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-action btn-approve">✅ Approve</button>
                            </form>
                        @endif

                        @if(!$notification->read_at)
                            <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-action btn-read">👁️ Mark Read</button>
                            </form>
                        @endif

                        <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete">🗑️</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">🔔</div>
                    <h3>No notifications found</h3>
                    <p>You'll see notifications here when you create or update services and jobs.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div style="margin-top: 20px;">
        {{ $notifications->links() }}
    </div>
@endsection
