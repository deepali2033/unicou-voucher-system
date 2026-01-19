<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BookedPlan;
use App\Models\User;
use App\Models\Plan;
use Carbon\Carbon;

class BookedPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some users and plans to create sample bookings
        $users = User::take(5)->get();
        $plans = Plan::take(3)->get();

        if ($users->isEmpty() || $plans->isEmpty()) {
            $this->command->warn('No users or plans found. Please create some users and plans first.');
            return;
        }

        $paymentMethods = ['credit_card', 'paypal', 'bank_transfer', 'cash'];
        $statuses = ['success', 'pending', 'failed'];

        // Create sample booked plans
        $bookings = [
            [
                'user_id' => $users->random()->id,
                'plan_id' => $plans->random()->id,
                'amount' => 299.99,
                'payment_method' => 'credit_card',
                'transaction_id' => 'TXN_' . uniqid(),
                'status' => 'success',
                'booking_date' => Carbon::now()->subDays(rand(1, 30)),
            ],
            [
                'user_id' => $users->random()->id,
                'plan_id' => $plans->random()->id,
                'amount' => 199.50,
                'payment_method' => 'paypal',
                'transaction_id' => 'PAY_' . uniqid(),
                'status' => 'success',
                'booking_date' => Carbon::now()->subDays(rand(1, 15)),
            ],
            [
                'user_id' => $users->random()->id,
                'plan_id' => $plans->random()->id,
                'amount' => 499.00,
                'payment_method' => 'bank_transfer',
                'transaction_id' => 'BT_' . uniqid(),
                'status' => 'pending',
                'booking_date' => Carbon::now()->subDays(rand(1, 7)),
            ],
            [
                'user_id' => $users->random()->id,
                'plan_id' => $plans->random()->id,
                'amount' => 149.99,
                'payment_method' => 'cash',
                'transaction_id' => null,
                'status' => 'failed',
                'booking_date' => Carbon::now()->subDays(rand(1, 5)),
            ],
            [
                'user_id' => $users->random()->id,
                'plan_id' => $plans->random()->id,
                'amount' => 399.99,
                'payment_method' => 'credit_card',
                'transaction_id' => 'CC_' . uniqid(),
                'status' => 'success',
                'booking_date' => Carbon::now()->subHours(rand(1, 24)),
            ],
        ];

        foreach ($bookings as $booking) {
            BookedPlan::create($booking);
        }

        $this->command->info('Created ' . count($bookings) . ' sample booked plans.');
    }
}
