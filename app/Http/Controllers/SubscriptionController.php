<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * Store a new subscription
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|max:255',
            ]);

            // Check if email is already subscribed
            $existingSubscription = Subscription::where('email', $request->email)->first();

            if ($existingSubscription) {
                if ($existingSubscription->is_active) {
                    return response()->json([
                        'success' => false,
                        'message' => 'This email is already subscribed to our newsletter.'
                    ], 422);
                } else {
                    // Reactivate subscription
                    $existingSubscription->update(['is_active' => true]);

                    // Create notification for admin
                    $this->createAdminNotification($request->email, 'resubscribed');

                    return response()->json([
                        'success' => true,
                        'message' => 'You have subscribed successfully.'
                    ]);
                }
            }

            // Create new subscription
            $subscription = Subscription::create([
                'email' => $request->email,
                'user_id' => Auth::check() ? Auth::id() : null,
                'is_active' => true,
            ]);

            // Create notification for admin
            $this->createAdminNotification($request->email, 'new');

            return response()->json([
                'success' => true,
                'message' => 'You have subscribed successfully.'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Please enter a valid email address.',
                // 'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your subscription. Please try again later.'
            ], 500);
        }
    }

    /**
     * Create notification for admin users
     */
    private function createAdminNotification($email, $type = 'new')
    {
        // Get all admin users
        $adminUsers = User::where('account_type', 'admin')->get();

        $title = $type === 'new' ? 'New Newsletter Subscription' : 'Newsletter Re-subscription';
        $description = "A user has subscribed to the newsletter with email: {$email}";

        foreach ($adminUsers as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'title' => $title,
                'description' => $description,
                'type' => 'subscription',
                'action' => null,
                'related_id' => null,
                'is_read' => false,
            ]);
        }
    }
}
