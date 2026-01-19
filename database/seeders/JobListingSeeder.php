<?php

namespace Database\Seeders;

use App\Models\JobListing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = [
            [
                'title' => 'Production Line Worker',
                'category' => 'Production & Factory Jobs',
                'short_description' => 'Join our production team in a fast-paced manufacturing environment with competitive pay and benefits.',
                'description' => 'We are seeking dedicated Production Line Workers to join our manufacturing team. You will be responsible for operating machinery, quality control, and maintaining production standards. This is an excellent opportunity for individuals looking to start or advance their career in manufacturing.',
                'location' => 'Industrial District',
                'employment_type' => 'full-time',
                'salary_min' => 18.00,
                'salary_max' => 22.00,
                'salary_type' => 'hourly',
                'requirements' => [
                    'High school diploma or equivalent',
                    'Ability to lift up to 50 lbs',
                    'Attention to detail',
                    'Reliable transportation',
                    'Willingness to work shifts'
                ],
                'benefits' => [
                    'Health insurance',
                    'Paid time off',
                    'Overtime opportunities',
                    'Safety training provided',
                    '401k retirement plan'
                ],
                'contact_email' => 'hr@koaservice.com',
                'contact_phone' => '+1 (555) 123-4567',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 1
            ],
            [
                'title' => 'Kitchen Assistant',
                'category' => 'Kitchen & Restaurant Assistance',
                'short_description' => 'Support our kitchen team in food preparation and maintaining cleanliness standards.',
                'description' => 'We are looking for a reliable Kitchen Assistant to help with food preparation, dishwashing, and maintaining kitchen cleanliness. Perfect for someone who enjoys working in a team environment and wants to learn about the food service industry.',
                'location' => 'Downtown Restaurant District',
                'employment_type' => 'part-time',
                'salary_min' => 15.00,
                'salary_max' => 18.00,
                'salary_type' => 'hourly',
                'requirements' => [
                    'Food safety knowledge preferred',
                    'Ability to work in fast-paced environment',
                    'Team player attitude',
                    'Flexible schedule availability',
                    'Physical stamina for standing long periods'
                ],
                'benefits' => [
                    'Flexible scheduling',
                    'Meal discounts',
                    'Training provided',
                    'Career advancement opportunities'
                ],
                'contact_email' => 'kitchen@koaservice.com',
                'contact_phone' => '+1 (555) 123-4568',
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 2
            ],
            [
                'title' => 'Commercial Cleaner',
                'category' => 'Cleaning Jobs',
                'short_description' => 'Maintain cleanliness and hygiene standards in commercial buildings and offices.',
                'description' => 'Join our professional cleaning team to maintain high standards of cleanliness in commercial properties. You will be responsible for cleaning offices, restrooms, common areas, and ensuring all spaces meet our quality standards.',
                'location' => 'Various Commercial Buildings',
                'employment_type' => 'full-time',
                'salary_min' => 16.00,
                'salary_max' => 20.00,
                'salary_type' => 'hourly',
                'requirements' => [
                    'Previous cleaning experience preferred',
                    'Reliable and trustworthy',
                    'Attention to detail',
                    'Ability to work independently',
                    'Valid driver\'s license'
                ],
                'benefits' => [
                    'Competitive hourly rate',
                    'Flexible hours',
                    'Supplies provided',
                    'Regular work schedule',
                    'Performance bonuses'
                ],
                'contact_email' => 'cleaning@koaservice.com',
                'contact_phone' => '+1 (555) 123-4569',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 3
            ],
            [
                'title' => 'Warehouse Associate',
                'category' => 'Other Temporary Roles',
                'short_description' => 'Handle inventory management and order fulfillment in our busy warehouse facility.',
                'description' => 'We need a Warehouse Associate to help with receiving, storing, and shipping products. This role involves inventory management, order picking, and maintaining warehouse organization. Great opportunity for someone looking for stable employment with growth potential.',
                'location' => 'Warehouse District',
                'employment_type' => 'temporary',
                'salary_min' => 17.00,
                'salary_max' => 21.00,
                'salary_type' => 'hourly',
                'requirements' => [
                    'Forklift certification preferred',
                    'Basic computer skills',
                    'Ability to lift 40+ lbs',
                    'Warehouse experience a plus',
                    'Good organizational skills'
                ],
                'benefits' => [
                    'Weekly pay',
                    'Overtime available',
                    'Safety equipment provided',
                    'Potential for permanent placement',
                    'Skills training'
                ],
                'contact_email' => 'warehouse@koaservice.com',
                'contact_phone' => '+1 (555) 123-4570',
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 4
            ],
            [
                'title' => 'Food Service Worker',
                'category' => 'Kitchen & Restaurant Assistance',
                'short_description' => 'Serve customers and maintain food service standards in our busy cafeteria.',
                'description' => 'Looking for a friendly Food Service Worker to serve customers, maintain food displays, and ensure excellent customer service. This position offers flexible hours and is perfect for someone who enjoys interacting with people.',
                'location' => 'Corporate Cafeteria',
                'employment_type' => 'part-time',
                'salary_min' => 14.50,
                'salary_max' => 17.00,
                'salary_type' => 'hourly',
                'requirements' => [
                    'Customer service experience',
                    'Food handler\'s permit preferred',
                    'Friendly and professional demeanor',
                    'Ability to handle cash transactions',
                    'Flexible availability'
                ],
                'benefits' => [
                    'Free meals during shifts',
                    'Flexible scheduling',
                    'Tips allowed',
                    'Friendly work environment'
                ],
                'contact_email' => 'foodservice@koaservice.com',
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 5
            ],
            [
                'title' => 'Quality Control Inspector',
                'category' => 'Production & Factory Jobs',
                'short_description' => 'Ensure product quality and compliance with manufacturing standards.',
                'description' => 'We are seeking a detail-oriented Quality Control Inspector to monitor production processes and ensure products meet our high-quality standards. You will conduct inspections, document findings, and work with production teams to maintain excellence.',
                'location' => 'Manufacturing Plant',
                'employment_type' => 'full-time',
                'salary_min' => 20.00,
                'salary_max' => 25.00,
                'salary_type' => 'hourly',
                'requirements' => [
                    'High school diploma required',
                    'Previous QC experience preferred',
                    'Strong attention to detail',
                    'Basic math and measurement skills',
                    'Computer literacy'
                ],
                'benefits' => [
                    'Comprehensive health benefits',
                    'Paid vacation and holidays',
                    'Training and certification programs',
                    'Career advancement opportunities',
                    'Retirement savings plan'
                ],
                'contact_email' => 'qc@koaservice.com',
                'contact_phone' => '+1 (555) 123-4571',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 6,
                'application_deadline' => now()->addDays(30)
            ]
        ];

        foreach ($jobs as $jobData) {
            JobListing::create($jobData);
        }
    }
}
