<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'name' => 'Basic',
                'price' => 9.99,
                'duration' => '1 month',
            ],
            [
                'name' => 'Premium',
                'price' => 19.99,
                'duration' => '1 month',
            ],
            [
                'name' => 'Annual',
                'price' => 199.99,
                'duration' => '1 year',
            ],
        ];

        foreach($plans as $plan)
        {
            DB::table('subscription_plans')->insert(array_merge($plan, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
