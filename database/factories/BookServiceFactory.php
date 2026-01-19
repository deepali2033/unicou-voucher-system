<?php

namespace Database\Factories;

use App\Models\BookService;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookServiceFactory extends Factory
{
    protected $model = BookService::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'service_name' => $this->faker->randomElement([
                'Regular House Cleaning',
                'Deep House Cleaning',
                'Office Cleaning',
                'Post-Construction Cleaning',
                'Window Cleaning',
                'Carpet Cleaning',
                'Move-in/Move-out Cleaning'
            ]),
            'customer_name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'street_address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'zip_code' => $this->faker->postcode(),
            'bedrooms' => $this->faker->numberBetween(1, 5),
            'bathrooms' => $this->faker->numberBetween(1, 4),
            'extras' => $this->faker->optional()->sentence(),
            'frequency' => $this->faker->randomElement([
                'One-time',
                'Weekly',
                'Bi-weekly',
                'Monthly',
                'Quarterly'
            ]),
            'square_feet' => $this->faker->randomElement([
                '500-1000',
                '1000-1500',
                '1500-2000',
                '2000-2500',
                '2500+'
            ]),
            'booking_date' => $this->faker->dateTimeBetween('+1 day', '+30 days')->format('Y-m-d'),
            'booking_time' => $this->faker->randomElement([
                '8:00 AM',
                '9:00 AM',
                '10:00 AM',
                '11:00 AM',
                '12:00 PM',
                '1:00 PM',
                '2:00 PM',
                '3:00 PM',
                '4:00 PM'
            ]),
            'parking_info' => $this->faker->optional()->sentence(),
            'flexible_time' => $this->faker->optional()->sentence(),
            'entrance_info' => $this->faker->optional()->sentence(),
            'pets' => $this->faker->optional()->sentence(),
            'special_instructions' => $this->faker->optional()->paragraph(),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'in_progress', 'completed', 'cancelled']),
            'admin_notes' => $this->faker->optional()->paragraph(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the book service is pending.
     */
    public function pending()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'pending',
            ];
        });
    }

    /**
     * Indicate that the book service is confirmed.
     */
    public function confirmed()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'confirmed',
            ];
        });
    }

    /**
     * Indicate that the book service is completed.
     */
    public function completed()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'completed',
            ];
        });
    }

    /**
     * Indicate that the book service is cancelled.
     */
    public function cancelled()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'cancelled',
            ];
        });
    }
}
