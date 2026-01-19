<?php

namespace Database\Factories;

use App\Models\JobApplication;
use App\Models\User;
use App\Models\JobListing;
use App\Models\Candidate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobApplication>
 */
class JobApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobApplication::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'candidate_id' => Candidate::factory(),
            'job_listing_id' => JobListing::factory(),
            'freelancer_id' => User::factory(),
            'recruiter_id' => User::factory(),
            'status' => $this->faker->randomElement(['pending', 'under_review', 'interview_scheduled', 'selected', 'rejected']),
            'recruiter_notified' => $this->faker->boolean(),
            'admin_notified' => $this->faker->boolean(),
            'recruiter_notified_at' => $this->faker->optional()->dateTime(),
            'admin_notified_at' => $this->faker->optional()->dateTime(),
            'application_notes' => $this->faker->optional()->paragraph(),
        ];
    }

    /**
     * Indicate that the application is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    /**
     * Indicate that the application is under review.
     */
    public function underReview(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'under_review',
        ]);
    }

    /**
     * Indicate that the application is selected.
     */
    public function selected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'selected',
        ]);
    }

    /**
     * Indicate that the application is rejected.
     */
    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
        ]);
    }
}
