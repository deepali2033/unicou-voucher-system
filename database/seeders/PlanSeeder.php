<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Basic Plan
        Plan::create([
            'name' => 'Basic Plan',
            'description' => "Perfect for individuals and small businesses getting started.\n\n• Up to 3 service listings\n• Basic customer support\n• Standard profile visibility\n• Mobile app access\n• Email notifications",
            'price' => 9.99,
            'is_active' => true,
            'discount_type' => null,
            'discount_value' => null,
        ]);

        // Professional Plan with percentage discount
        Plan::create([
            'name' => 'Professional Plan',
            'description' => "Ideal for growing businesses and experienced freelancers.\n\n• Up to 15 service listings\n• Priority customer support\n• Enhanced profile features\n• Analytics dashboard\n• Advanced messaging tools\n• Featured listing placement",
            'price' => 29.99,
            'is_active' => true,
            'discount_type' => 'percentage',
            'discount_value' => 20.00,
        ]);

        // Premium Plan with fixed discount
        Plan::create([
            'name' => 'Premium Plan',
            'description' => "For established businesses requiring maximum exposure and features.\n\n• Unlimited service listings\n• 24/7 premium support\n• Top-tier profile placement\n• Advanced analytics & insights\n• Custom branding options\n• Dedicated account manager\n• API access",
            'price' => 79.99,
            'is_active' => true,
            'discount_type' => 'fixed',
            'discount_value' => 15.00,
        ]);

        // Enterprise Plan (inactive for demonstration)
        Plan::create([
            'name' => 'Enterprise Plan',
            'description' => "Custom solution for large organizations with specific requirements.\n\n• Everything in Premium Plan\n• Custom integrations\n• White-label solutions\n• Advanced security features\n• Custom reporting\n• Training & onboarding\n• Service level agreements",
            'price' => 199.99,
            'is_active' => false,
            'discount_type' => 'percentage',
            'discount_value' => 10.00,
        ]);
    }
}
