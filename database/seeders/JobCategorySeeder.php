<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'IT & Technology', 'slug' => 'it-technology', 'description' => 'Information Technology and Software Development jobs'],
            ['name' => 'Healthcare', 'slug' => 'healthcare', 'description' => 'Medical and healthcare related positions'],
            ['name' => 'Education', 'slug' => 'education', 'description' => 'Teaching and educational roles'],
            ['name' => 'Finance', 'slug' => 'finance', 'description' => 'Financial services and banking jobs'],
            ['name' => 'Construction', 'slug' => 'construction', 'description' => 'Building and construction industry'],
            ['name' => 'Retail', 'slug' => 'retail', 'description' => 'Retail and sales positions'],
            ['name' => 'Hospitality', 'slug' => 'hospitality', 'description' => 'Hotel and restaurant services'],
            ['name' => 'Manufacturing', 'slug' => 'manufacturing', 'description' => 'Production and manufacturing jobs'],
        ];

        foreach ($categories as $category) {
            \App\Models\JobCategory::create($category);
        }
    }
}
