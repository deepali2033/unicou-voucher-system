<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    /**
     * Create a notification
     */
    public static function create(string $title, string $description, string $type, string $action, $relatedId = null, $userId = null)
    {
        return Notification::create([
            'user_id' => $userId,
            'title' => $title,
            'description' => $description,
            'type' => $type,
            'action' => $action,
            'related_id' => $relatedId,
            'is_read' => false,
        ]);
    }

    /**
     * Create user notification
     */
    public static function userCreated($user)
    {
        return self::create(
            'New User Created',
            "A new user '{$user->name}' ({$user->email}) has been created with account type: {$user->account_type}.",
            'user',
            'created',
            $user->id
        );
    }

    public static function userUpdated($user)
    {
        return self::create(
            'User Updated',
            "User '{$user->name}' ({$user->email}) has been updated.",
            'user',
            'updated',
            $user->id
        );
    }

    public static function userActivated($user)
    {
        return self::create(
            'User Activated',
            "User '{$user->name}' ({$user->email}) has been activated.",
            'user',
            'activated',
            $user->id
        );
    }

    public static function userDeactivated($user)
    {
        return self::create(
            'User Deactivated',
            "User '{$user->name}' ({$user->email}) has been deactivated.",
            'user',
            'deactivated',
            $user->id
        );
    }

    /**
     * Create service notification
     */
    public static function serviceCreated($service)
    {
        return self::create(
            'New Service Added',
            "A new service '{$service->name}' has been added to the system.",
            'service',
            'created',
            $service->id,
            $service->user_id ?? null
        );
    }

    public static function serviceUpdated($service)
    {
        return self::create(
            'Service Updated',
            "Service '{$service->name}' has been updated.",
            'service',
            'updated',
            $service->id,
            $service->user_id ?? null
        );
    }

    public static function serviceActivated($service)
    {
        return self::create(
            'Service Activated',
            "Service '{$service->name}' has been activated.",
            'service',
            'activated',
            $service->id,
            $service->user_id ?? null
        );
    }

    public static function serviceDeactivated($service)
    {
        return self::create(
            'Service Deactivated',
            "Service '{$service->name}' has been deactivated.",
            'service',
            'deactivated',
            $service->id,
            $service->user_id ?? null
        );
    }

    public static function serviceFeatured($service)
    {
        return self::create(
            'Service Featured',
            "Service '{$service->name}' has been marked as featured.",
            'service',
            'featured',
            $service->id,
            $service->user_id ?? null
        );
    }

    public static function serviceUnfeatured($service)
    {
        return self::create(
            'Service Unfeatured',
            "Service '{$service->name}' has been removed from featured.",
            'service',
            'unfeatured',
            $service->id,
            $service->user_id ?? null
        );
    }

    /**
     * Create job notification
     */
    public static function jobCreated($job)
    {
        return self::create(
            'New Job Created',
            "A new job '{$job->title}' has been created in {$job->location}.",
            'job',
            'created',
            $job->id,
            $job->user_id ?? null
        );
    }

    public static function jobUpdated($job)
    {
        return self::create(
            'Job Updated',
            "Job '{$job->title}' has been updated.",
            'job',
            'updated',
            $job->id,
            $job->user_id ?? null
        );
    }

    public static function jobActivated($job)
    {
        return self::create(
            'Job Activated',
            "Job '{$job->title}' has been activated.",
            'job',
            'activated',
            $job->id,
            $job->user_id ?? null
        );
    }

    public static function jobDeactivated($job)
    {
        return self::create(
            'Job Deactivated',
            "Job '{$job->title}' has been deactivated.",
            'job',
            'deactivated',
            $job->id,
            $job->user_id ?? null
        );
    }

    public static function jobFeatured($job)
    {
        return self::create(
            'Job Featured',
            "Job '{$job->title}' has been marked as featured.",
            'job',
            'featured',
            $job->id,
            $job->user_id ?? null
        );
    }

    public static function jobUnfeatured($job)
    {
        return self::create(
            'Job Unfeatured',
            "Job '{$job->title}' has been removed from featured.",
            'job',
            'unfeatured',
            $job->id,
            $job->user_id ?? null
        );
    }

    /**
     * Create plan notification
     */
    public static function planCreated($plan)
    {
        return self::create(
            'New Plan Created',
            "A new plan '{$plan->name}' has been created with price \${$plan->price}.",
            'plan',
            'created',
            $plan->id
        );
    }

    public static function planUpdated($plan)
    {
        return self::create(
            'Plan Updated',
            "Plan '{$plan->name}' has been updated.",
            'plan',
            'updated',
            $plan->id
        );
    }

    public static function planActivated($plan)
    {
        return self::create(
            'Plan Activated',
            "Plan '{$plan->name}' has been activated.",
            'plan',
            'activated',
            $plan->id
        );
    }

    public static function planDeactivated($plan)
    {
        return self::create(
            'Plan Deactivated',
            "Plan '{$plan->name}' has been deactivated.",
            'plan',
            'deactivated',
            $plan->id
        );
    }

    /**
     * Create service booking notification
     * Determines where to send the notification based on who created the service
     */
    public static function serviceBooked($booking)
    {
        $notifications = [];

        // Always notify all admins
        $admins = \App\Models\User::where('account_type', 'admin')->get();
        foreach ($admins as $admin) {
            $notifications[] = self::create(
                'New Service Booking',
                "New booking from {$booking->customer_name} for {$booking->service_name}",
                'book_service',
                route('admin.book-services.show', $booking->id),
                $booking->id,
                $admin->id
            );
        }

        // If the service has an associated service record and creator, notify them
        if ($booking->service_id) {
            $service = \App\Models\Service::find($booking->service_id);

            if ($service && $service->user_id) {
                $serviceCreator = \App\Models\User::find($service->user_id);

                if ($serviceCreator) {
                    // Determine the appropriate route based on service creator's account type
                    $actionRoute = '';

                    if ($serviceCreator->isUser()) {
                        $actionRoute = route('user.book-services.show', $booking->id);
                    } elseif ($serviceCreator->isRecruiter()) {
                        $actionRoute = route('recruiter.book-services.show', $booking->id);
                    } elseif ($serviceCreator->isFreelancer()) {
                        $actionRoute = route('freelancer.book-services.show', $booking->id);
                    }

                    // Only create notification if we have a valid route
                    if ($actionRoute) {
                        $notifications[] = self::create(
                            'Your Service Has Been Booked',
                            "Your service '{$booking->service_name}' has been booked by {$booking->customer_name}",
                            'book_service',
                            $actionRoute,
                            $booking->id,
                            $serviceCreator->id
                        );
                    }
                }
            }
        }

        return $notifications;
    }

    /**
     * Create notification for booking status change
     */
    public static function bookingStatusChanged($booking, $oldStatus, $newStatus)
    {
        $notifications = [];

        // Notify the customer (booking creator)
        if ($booking->user_id) {
            $statusText = self::getStatusDisplayText($newStatus);
            $actionRoute = route('user.book-services.show', $booking->id);

            $notifications[] = self::create(
                'Booking Status Updated',
                "Your booking for '{$booking->service_name}' has been updated to: {$statusText}",
                'book_service',
                $actionRoute,
                $booking->id,
                $booking->user_id
            );
        }

        return $notifications;
    }

    /**
     * Create notification for new booking
     */
    public static function bookingCreated($booking)
    {
        $notifications = [];

        // Notify the customer (booking creator)
        if ($booking->user_id) {
            $actionRoute = route('user.book-services.show', $booking->id);

            $notifications[] = self::create(
                'Booking Confirmation',
                "Your booking for '{$booking->service_name}' has been submitted successfully. We will contact you soon to confirm your appointment.",
                'book_service',
                $actionRoute,
                $booking->id,
                $booking->user_id
            );
        }

        return $notifications;
    }

    /**
     * Helper method to get display text for status
     */
    private static function getStatusDisplayText($status)
    {
        return match($status) {
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'in_progress' => 'In Progress',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            default => ucfirst(str_replace('_', ' ', $status)),
        };
    }
}
