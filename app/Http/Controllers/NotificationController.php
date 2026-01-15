<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $notifications = $user->notifications()->latest()->paginate(15);
        $unreadCount = $user->unreadNotifications->count();
        $readCount = $user->notifications()->whereNotNull('read_at')->count();
        $totalCount = $user->notifications()->count();

        return view('notifications.index', compact('notifications', 'unreadCount', 'readCount', 'totalCount'));
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return back()->with('success', 'Notification marked as read.');
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back()->with('success', 'All notifications marked as read.');
    }

    public function destroy($id)
    {
        auth()->user()->notifications()->findOrFail($id)->delete();
        return back()->with('success', 'Notification deleted.');
    }

    public function deleteAll()
    {
        auth()->user()->notifications()->delete();
        return back()->with('success', 'All notifications deleted.');
    }

    public function approve($id)
    {
        // This is a placeholder for the "Approve" action mentioned by user
        $notification = auth()->user()->notifications()->findOrFail($id);
        
        // Custom logic for approval would go here
        // For example, if it's a voucher approval or refund approval
        
        $notification->markAsRead();
        return back()->with('success', 'Request approved successfully!');
    }
}
