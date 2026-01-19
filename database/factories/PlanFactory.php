<?php

namespace Database\Factories;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    protected $model = Plan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true) . ' Plan',
            'description' => $this->faker->sentence(10),
            'points' => $this->faker->numberBetween(10, 1000),
            'image' => $this->faker->imageUrl(400, 300, 'business', true, 'plan'),
            'price' => $this->faker->randomFloat(2, 9.99, 299.99),
            'is_active' => $this->faker->boolean(85), // 85% chance of being active
            'discount_type' => $this->faker->randomElement([null, 'percentage', 'fixed']),
            'discount_value' => $this->faker->optional(0.3)->randomFloat(2, 5, 50), // 30% chance of having discount
        ];
    }

    /**
     * Indicate that the plan is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    /**
     * Indicate that the plan is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Set a specific price for the plan.
     */
    public function withPrice(float $price): static
    {
        return $this->state(fn (array $attributes) => [
            'price' => $price,
        ]);
    }

    /**
     * Add a percentage discount to the plan.
     */
    public function withPercentageDiscount(float $percentage): static
    {
        return $this->state(fn (array $attributes) => [
            'discount_type' => 'percentage',
            'discount_value' => $percentage,
        ]);
    }

    /**
     * Add a fixed discount to the plan.
     */
    public function withFixedDiscount(float $amount): static
    {
        return $this->state(fn (array $attributes) => [
            'discount_type' => 'fixed',
            'discount_value' => $amount,
        ]);
    }

    /**
     * Remove any discount from the plan.
     */
    public function withoutDiscount(): static
    {
        return $this->state(fn (array $attributes) => [
            'discount_type' => null,
            'discount_value' => null,
        ]);
    }
}
