<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Regular House Cleaning',
                'slug' => 'regular-house-cleaning',
                'short_description' => 'Professional regular house cleaning service to keep your home spotless and fresh.',
                'description' => 'Our regular house cleaning service includes comprehensive cleaning of all rooms, dusting, vacuuming, mopping, and sanitizing. We use eco-friendly products and professional equipment to ensure your home is clean, healthy, and comfortable for your family.',
                'icon' => 'fas fa-home',
                'price_from' => 80,
                'price_to' => 150,
                'duration' => '2-3 hours',
                'features' => [
                    'All rooms cleaned thoroughly',
                    'Eco-friendly cleaning products',
                    'Professional equipment used',
                    'Flexible scheduling',
                    'Insured and bonded staff'
                ],
                'includes' => [
                    'Dusting all surfaces',
                    'Vacuuming carpets and rugs',
                    'Mopping floors',
                    'Cleaning bathrooms',
                    'Kitchen cleaning',
                    'Trash removal'
                ],
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 1,
                'meta_title' => 'Regular House Cleaning Services - Professional & Reliable',
                'meta_description' => 'Professional regular house cleaning services. Eco-friendly products, flexible scheduling, insured staff. Book your cleaning service today!'
            ],
            [
                'name' => 'Deep Cleaning Service',
                'slug' => 'deep-cleaning-service',
                'short_description' => 'Comprehensive deep cleaning service for a thorough and detailed clean of your entire home.',
                'description' => 'Our deep cleaning service goes beyond regular cleaning to tackle every corner of your home. Perfect for spring cleaning, move-in/move-out, or when you need that extra level of cleanliness. We clean areas often overlooked in regular cleaning.',
                'icon' => 'fas fa-broom',
                'price_from' => 200,
                'price_to' => 400,
                'duration' => '4-6 hours',
                'features' => [
                    'Detailed cleaning of all areas',
                    'Inside appliances cleaning',
                    'Baseboards and window sills',
                    'Light fixtures and ceiling fans',
                    'Cabinet fronts and interiors'
                ],
                'includes' => [
                    'Everything in regular cleaning',
                    'Inside oven and refrigerator',
                    'Baseboards and trim',
                    'Light fixtures',
                    'Window cleaning (interior)',
                    'Cabinet cleaning'
                ],
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 2,
                'meta_title' => 'Deep Cleaning Services - Thorough Home Cleaning',
                'meta_description' => 'Professional deep cleaning services for your home. Comprehensive cleaning including appliances, baseboards, and detailed areas.'
            ],
            [
                'name' => 'Office Cleaning',
                'slug' => 'office-cleaning',
                'short_description' => 'Professional office cleaning services to maintain a clean and productive work environment.',
                'description' => 'Keep your workplace clean and professional with our comprehensive office cleaning services. We understand the importance of a clean work environment for productivity and employee health.',
                'icon' => 'fas fa-building',
                'price_from' => 100,
                'price_to' => 300,
                'duration' => '2-4 hours',
                'features' => [
                    'Flexible scheduling options',
                    'Commercial-grade equipment',
                    'Disinfection services',
                    'Customizable cleaning plans',
                    'Reliable and trustworthy staff'
                ],
                'includes' => [
                    'Desk and surface cleaning',
                    'Vacuuming and mopping',
                    'Restroom sanitization',
                    'Trash removal',
                    'Kitchen/break room cleaning',
                    'Window cleaning'
                ],
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 3,
                'meta_title' => 'Professional Office Cleaning Services',
                'meta_description' => 'Professional office cleaning services to maintain a clean, healthy, and productive work environment.'
            ],
            [
                'name' => 'Move-In/Move-Out Cleaning',
                'slug' => 'move-in-move-out-cleaning',
                'short_description' => 'Specialized cleaning service for moving in or out of your home or apartment.',
                'description' => 'Moving can be stressful enough without worrying about cleaning. Our move-in/move-out cleaning service ensures your new home is spotless when you arrive, or your old home is ready for the next occupants.',
                'icon' => 'fas fa-truck-moving',
                'price_from' => 150,
                'price_to' => 350,
                'duration' => '3-5 hours',
                'features' => [
                    'Empty home cleaning',
                    'All areas thoroughly cleaned',
                    'Cabinet and drawer cleaning',
                    'Appliance cleaning',
                    'Same-day availability'
                ],
                'includes' => [
                    'All rooms deep cleaned',
                    'Inside cabinets and drawers',
                    'Appliance cleaning',
                    'Bathroom deep clean',
                    'Floor cleaning and polishing',
                    'Window cleaning'
                ],
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 4,
                'meta_title' => 'Move-In/Move-Out Cleaning Services',
                'meta_description' => 'Professional move-in and move-out cleaning services. Make your transition smooth with our thorough cleaning.'
            ],
            [
                'name' => 'Airbnb Cleaning',
                'slug' => 'airbnb-cleaning',
                'short_description' => 'Specialized cleaning service for Airbnb and short-term rental properties.',
                'description' => 'Keep your Airbnb property guest-ready with our specialized cleaning service. We understand the quick turnaround times and high standards required for short-term rentals.',
                'icon' => 'fas fa-key',
                'price_from' => 75,
                'price_to' => 200,
                'duration' => '1-3 hours',
                'features' => [
                    'Quick turnaround times',
                    'Guest-ready standards',
                    'Linen and towel service',
                    'Inventory restocking',
                    'Same-day service available'
                ],
                'includes' => [
                    'Complete property cleaning',
                    'Fresh linens and towels',
                    'Bathroom restocking',
                    'Kitchen supplies check',
                    'Trash removal',
                    'Final inspection'
                ],
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 5,
                'meta_title' => 'Airbnb Cleaning Services - Guest-Ready Standards',
                'meta_description' => 'Professional Airbnb cleaning services with quick turnaround times and guest-ready standards for your rental property.'
            ],
            [
                'name' => 'Post-Construction Cleaning',
                'slug' => 'post-construction-cleaning',
                'short_description' => 'Specialized cleaning service for newly constructed or renovated properties.',
                'description' => 'After construction or renovation work, your property needs specialized cleaning to remove dust, debris, and construction residue. Our post-construction cleaning service prepares your space for occupancy.',
                'icon' => 'fas fa-hard-hat',
                'price_from' => 250,
                'price_to' => 500,
                'duration' => '4-8 hours',
                'features' => [
                    'Construction dust removal',
                    'Debris cleanup',
                    'Window and surface cleaning',
                    'Floor cleaning and polishing',
                    'Safety equipment used'
                ],
                'includes' => [
                    'Dust removal from all surfaces',
                    'Window cleaning inside and out',
                    'Floor cleaning and sealing',
                    'Fixture cleaning',
                    'Debris removal',
                    'Final walkthrough'
                ],
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 6,
                'meta_title' => 'Post-Construction Cleaning Services',
                'meta_description' => 'Professional post-construction cleaning services to prepare your newly built or renovated space for occupancy.'
            ]
        ];

        foreach ($services as $serviceData) {
            Service::create($serviceData);
        }
    }
}
