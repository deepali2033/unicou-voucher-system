<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Cleaning Services',
                'description' => 'Professional cleaning services for homes and offices',
            ],
            [
                'name' => 'Kitchen & Food',
                'description' => 'Food preparation, catering, and kitchen assistance services',
            ],
            [
                'name' => 'Home Maintenance',
                'description' => 'General maintenance, repairs, and home improvement services',
            ],
            [
                'name' => 'Garden & Landscaping',
                'description' => 'Garden maintenance, landscaping, and outdoor services',
            ],
            [
                'name' => 'Pet Services',
                'description' => 'Pet care, walking, grooming, and related services',
            ],
            [
                'name' => 'Personal Assistant',
                'description' => 'Administrative support, errands, and personal assistance',
            ],
            [
                'name' => 'Childcare',
                'description' => 'Babysitting, nanny services, and childcare support',
            ],
            [
                'name' => 'Event Services',
                'description' => 'Event planning, setup, and coordination services',
            ],
            [
                'name' => 'Transportation',
                'description' => 'Delivery, moving, and transportation services',
            ],
            [
                'name' => 'Other Services',
                'description' => 'Miscellaneous services not covered in other categories',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
