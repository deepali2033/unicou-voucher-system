<?php

namespace Database\Factories;

use App\Models\JobListing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class JobListingFactory extends Factory
{
    protected $model = JobListing::class;

    public function definition()
    {
        $title = $this->faker->jobTitle();
        $categories = JobListing::getCategories();
        $employmentTypes = array_keys(JobListing::getEmploymentTypes());
        $salaryTypes = array_keys(JobListing::getSalaryTypes());

        return [
            'user_id' => User::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'category' => $this->faker->randomElement($categories),
            'short_description' => $this->faker->sentence(10),
            'description' => $this->faker->paragraphs(3, true),
            'location' => $this->faker->city() . ', ' . $this->faker->state(),
            'employment_type' => $this->faker->randomElement($employmentTypes),
            'salary_min' => $this->faker->numberBetween(30000, 60000),
            'salary_max' => $this->faker->numberBetween(70000, 120000),
            'salary_type' => $this->faker->randomElement($salaryTypes),
            'requirements' => [
                $this->faker->sentence(),
                $this->faker->sentence(),
                $this->faker->sentence(),
            ],
            'benefits' => [
                $this->faker->words(3, true),
                $this->faker->words(3, true),
                $this->faker->words(3, true),
            ],
            'contact_email' => $this->faker->companyEmail(),
            'contact_phone' => $this->faker->phoneNumber(),
            'is_active' => $this->faker->boolean(80),
            'is_featured' => $this->faker->boolean(20),
            'is_approved' => $this->faker->boolean(70),
            'sort_order' => $this->faker->numberBetween(1, 100),
            'application_deadline' => $this->faker->dateTimeBetween('now', '+3 months'),
            'meta_title' => $title . ' - Job Opportunity',
            'image' => null, // Will be set explicitly in tests when needed
            'meta_description' => $this->faker->sentence(15),
            'jobtoggle' => $this->faker->randomElement(['user', 'recruiter', 'admin']),
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }

    public function active()
    {
        return $this->state([
            'is_active' => true,
            'is_approved' => true,
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
            'is_approved' => false,
        ]);
    }

    public function approved()
    {
        return $this->state([
            'is_approved' => true,
        ]);
    }

    public function featured()
    {
        return $this->state([
            'is_featured' => true,
            'is_active' => true,
            'is_approved' => true,
        ]);
    }

    public function withImage($imagePath = 'images/test-job.jpg')
    {
        return $this->state([
            'image' => $imagePath,
        ]);
    }

    public function fullTime()
    {
        return $this->state([
            'employment_type' => 'full-time',
        ]);
    }

    public function partTime()
    {
        return $this->state([
            'employment_type' => 'part-time',
        ]);
    }

    public function contract()
    {
        return $this->state([
            'employment_type' => 'contract',
        ]);
    }

    public function temporary()
    {
        return $this->state([
            'employment_type' => 'temporary',
        ]);
    }
}
