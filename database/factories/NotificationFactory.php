<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['user', 'service', 'job', 'plan', 'subscription', 'quote', 'contact', 'book_service', 'booking'];
        $type = $this->faker->randomElement($types);

        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'type' => $type,
            'action' => $this->generateActionUrl($type),
            'related_id' => $this->faker->optional()->randomNumber(3),
            'is_read' => $this->faker->boolean(30), // 30% chance of being read
        ];
    }

    /**
     * Generate appropriate action URL based on notification type
     */
    private function generateActionUrl(string $type): string
    {
        $baseRoutes = [
            'user' => ['/admin/users/', '/recruiter/profile', '/freelancer/profile'],
            'service' => ['/admin/services/', '/recruiter/services/', '/freelancer/services/'],
            'job' => ['/admin/jobs/', '/recruiter/jobs/', '/freelancer/jobs/'],
            'plan' => ['/admin/plans/', '/user/subscription'],
            'subscription' => ['/admin/subscriptions/', '/user/subscription'],
            'quote' => ['/admin/quotes/', '/recruiter/quotes/'],
            'contact' => ['/admin/contacts/', '/contact'],
            'book_service' => ['/admin/book-services/', '/recruiter/book-services/', '/freelancer/book-services/'],
            'booking' => ['/admin/bookings/', '/user/bookings/'],
        ];

        $routes = $baseRoutes[$type] ?? ['/dashboard'];
        $route = $this->faker->randomElement($routes);

        // Add ID if route expects one
        if (str_ends_with($route, '/')) {
            $route .= $this->faker->randomNumber(3);
        }

        return $route;
    }

    /**
     * Indicate that the notification should be unread.
     */
    public function unread(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_read' => false,
        ]);
    }

    /**
     * Indicate that the notification should be read.
     */
    public function read(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_read' => true,
        ]);
    }

    /**
     * Set the notification type.
     */
    public function type(string $type): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => $type,
            'action' => $this->generateActionUrl($type),
        ]);
    }

    /**
     * Set the user for the notification.
     */
    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }

    /**
     * Create a job-related notification.
     */
    public function jobNotification(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'job',
            'title' => 'Job Application Received',
            'description' => 'Someone has applied for your job posting.',
            'action' => '/recruiter/jobs/' . $this->faker->randomNumber(3),
        ]);
    }

    /**
     * Create a service booking notification.
     */
    public function serviceBookingNotification(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'book_service',
            'title' => 'Service Booked',
            'description' => 'Your service has been booked by a customer.',
            'action' => '/freelancer/book-services/' . $this->faker->randomNumber(3),
        ]);
    }

    /**
     * Create a user registration notification.
     */
    public function userRegistrationNotification(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'user',
            'title' => 'New User Registration',
            'description' => 'A new user has registered on the platform.',
            'action' => '/admin/users/' . $this->faker->randomNumber(3),
        ]);
    }
}
