<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of subscriptions
     */
    public function index(Request $request)
    {
        $query = Subscription::query();

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where('email', 'like', "%{$search}%");
        }

        // Get counts for stats
        $totalCount = Subscription::count();
        $activeCount = Subscription::where('is_active', true)->count();
        $inactiveCount = Subscription::where('is_active', false)->count();

        // Get subscriptions ordered by most recent first
        $subscriptions = $query->orderBy('created_at', 'desc')->paginate(20);

        // Append query parameters to pagination links
        $subscriptions->appends($request->query());

        return view('admin.subscriptions.index', compact(
            'subscriptions',
            'totalCount',
            'activeCount',
            'inactiveCount'
        ));
    }

    /**
     * Toggle subscription status
     */
    public function toggleStatus(Subscription $subscription)
    {
        $subscription->update([
            'is_active' => !$subscription->is_active
        ]);

        $status = $subscription->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Subscription has been {$status}.");
    }

    /**
     * Remove the specified subscription
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect()->route('admin.subscriptions.index')
            ->with('success', 'Subscription deleted successfully.');
    }

    /**
     * Export subscriptions to CSV
     */
    public function export(Request $request)
    {
        $query = Subscription::query();

        // Apply same filters as index
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $subscriptions = $query->orderBy('created_at', 'desc')->get();

        $filename = 'newsletter_subscriptions_' . date('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($subscriptions) {
            $file = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($file, ['Email', 'Status', 'User ID', 'Subscribed At']);

            // Add data rows
            foreach ($subscriptions as $subscription) {
                fputcsv($file, [
                    $subscription->email,
                    $subscription->is_active ? 'Active' : 'Inactive',
                    $subscription->user_id ?? 'Guest',
                    $subscription->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
