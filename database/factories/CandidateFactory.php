<?php

namespace Database\Factories;

use App\Models\Candidate;
use App\Models\User;
use App\Models\JobListing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Candidate::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'zip_code' => $this->faker->postcode(),
            'date_of_birth' => $this->faker->date('Y-m-d', '1990-01-01'),
            'gender' => $this->faker->randomElement(['male', 'female', 'other', 'prefer_not_to_say']),
            'position_applied' => $this->faker->jobTitle(),
            'employment_type_preference' => $this->faker->randomElement(['full-time', 'part-time', 'contract', 'temporary']),
            'expected_salary_min' => $this->faker->numberBetween(30000, 60000),
            'expected_salary_max' => $this->faker->numberBetween(60000, 100000),
            'expected_salary_type' => $this->faker->randomElement(['hourly', 'monthly', 'yearly']),
            'available_start_date' => $this->faker->dateTimeBetween('now', '+3 months'),
            'work_experience' => $this->faker->optional()->paragraph(),
            'education' => $this->faker->optional()->sentence(),
            'skills' => [$this->faker->word(), $this->faker->word(), $this->faker->word()],
            'certifications' => $this->faker->optional()->sentence(),
            'resume_path' => $this->faker->optional()->filePath(),
            'cover_letter_path' => $this->faker->optional()->filePath(),
            'additional_notes' => $this->faker->optional()->paragraph(),
            'status' => $this->faker->randomElement(['pending', 'under_review', 'interview_scheduled', 'selected', 'rejected']),
            'is_active' => $this->faker->boolean(80),
            'applied_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'job_listing_id' => JobListing::factory(),
            'referral_source' => $this->faker->randomElement(['website', 'job_board', 'social_media', 'referral', 'recruitment_agency', 'walk_in', 'other']),
            'willing_to_relocate' => $this->faker->boolean(30),
            'has_transportation' => $this->faker->boolean(90),
            'background_check_consent' => $this->faker->boolean(95),
        ];
    }

    /**
     * Indicate that the candidate is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    /**
     * Indicate that the candidate is under review.
     */
    public function underReview(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'under_review',
        ]);
    }

    /**
     * Indicate that the candidate is selected.
     */
    public function selected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'selected',
        ]);
    }

    /**
     * Indicate that the candidate is rejected.
     */
    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
        ]);
    }

    /**
     * Indicate that the candidate is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }
}
