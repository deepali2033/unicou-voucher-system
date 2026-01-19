<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition()
    {
        $name = $this->faker->words(2, true) . ' Service';

        return [
            'user_id' => User::factory(),
            'name' => $name,
            'slug' => Str::slug($name),
            'short_description' => $this->faker->sentence(10),
            'description' => $this->faker->paragraphs(3, true),
            'icon' => $this->faker->randomElement(['fas fa-home', 'fas fa-building', 'fas fa-broom', 'fas fa-spray-can']),
            'image' => $this->faker->imageUrl(800, 600, 'business', true),
            'price_from' => $this->faker->numberBetween(50, 200),
            'price_to' => $this->faker->numberBetween(300, 800),
            'duration' => $this->faker->numberBetween(1, 8) . ' hours',
            'features' => [
                $this->faker->sentence(4),
                $this->faker->sentence(4),
                $this->faker->sentence(4),
            ],
            'includes' => [
                $this->faker->words(3, true),
                $this->faker->words(3, true),
                $this->faker->words(3, true),
            ],
            'is_active' => $this->faker->boolean(80), // 80% chance of being active
            'is_featured' => $this->faker->boolean(30), // 30% chance of being featured
            'sort_order' => $this->faker->numberBetween(1, 100),
            'meta_title' => $name . ' - KOA Services',
            'meta_description' => $this->faker->sentence(15),
            'approval_status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }

    public function active()
    {
        return $this->state([
            'is_active' => true,
            'approval_status' => 'approved',
        ]);
    }

    public function inactive()
    {
        return $this->state([
            'is_active' => false,
        ]);
    }

    public function pending()
    {
        return $this->state([
            'approval_status' => 'pending',
        ]);
    }

    public function approved()
    {
        return $this->state([
            'approval_status' => 'approved',
        ]);
    }

    public function rejected()
    {
        return $this->state([
            'approval_status' => 'rejected',
        ]);
    }

    public function featured()
    {
        return $this->state([
            'is_featured' => true,
            'is_active' => true,
            'approval_status' => 'approved',
        ]);
    }
}
