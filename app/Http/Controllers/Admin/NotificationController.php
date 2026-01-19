<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of notifications.
     */
    public function index(Request $request)
    {
        // Filter notifications for the current admin user
        $query = Notification::where('user_id', auth()->id());

        // Filter by status (read/unread)
        if ($request->filled('status')) {
            if ($request->status === 'unread') {
                $query->unread();
            } elseif ($request->status === 'read') {
                $query->read();
            }
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Get counts for stats (for current admin user)
        $totalCount = Notification::where('user_id', auth()->id())->count();
        $unreadCount = Notification::where('user_id', auth()->id())->unread()->count();
        $readCount = Notification::where('user_id', auth()->id())->read()->count();

        // Get notifications ordered by most recent first
        $notifications = $query->orderBy('created_at', 'desc')->paginate(15);

        // Append query parameters to pagination links
        $notifications->appends($request->query());

        return view('admin.notifications.index', compact('notifications', 'totalCount', 'unreadCount', 'readCount'));
    }

    /**
     * Display the specified notification.
     */
    public function show(Notification $notification)
    {
        // Mark as read when viewing
        if (!$notification->is_read) {
            $notification->markAsRead();
        }

        return view('admin.notifications.show', compact('notification'));
    }

    /**
     * Mark notification as read
     */
    public function markAsRead(Notification $notification)
    {
        $notification->markAsRead();

        return redirect()->back()->with('success', 'Notification marked as read.');
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        Notification::where('user_id', auth()->id())->unread()->update(['is_read' => true]);

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    /**
     * Show the form for editing the specified notification.
     */
    public function edit(Notification $notification)
    {
        return view('admin.notifications.edit', compact('notification'));
    }

    /**
     * Update the specified notification in storage.
     */
    public function update(Request $request, Notification $notification)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'nullable|string',
            'is_read' => 'boolean',
        ]);

        $notification->update([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'is_read' => $request->has('is_read'),
        ]);

        return redirect()->route('admin.notifications.index')->with('success', 'Notification updated successfully.');
    }

    /**
     * Remove the specified notification from storage.
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();

        return redirect()->route('admin.notifications.index')->with('success', 'Notification deleted successfully.');
    }

    /**
     * Delete all read notifications
     */
    public function deleteAllRead()
    {
        Notification::where('user_id', auth()->id())->read()->delete();

        return redirect()->back()->with('success', 'All read notifications have been deleted.');
    }
}
