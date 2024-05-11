<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateInterval;

class UserSubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->take(5)->get();
        $plans = DB::table('subscription_plans')->get();

        foreach($users as $index => $user)
        {
            // Vincula cada um dos primeiros 3 planos aos primeiros 3 usuários, depois recomeça do primeiro plano
            $plan = $plans[$index % 3];

            // Define a data de início para agora
            $start_date = Carbon::now();

            // Define a data de término com base na duração do plano
           // Define a data de término com base na duração do plano
            $end_date = null;
            if (preg_match('/(\d+)\s*(day|week|month|year)s?/', $plan->duration, $matches)) {
                $period = [
                    'day' => 'D',
                    'week' => 'W',
                    'month' => 'M',
                    'year' => 'Y',
                ][$matches[2]];

                $end_date = $start_date->copy()->add(new DateInterval("P{$matches[1]}{$period}"));
            }

            DB::table('user_subscriptions')->insert([
                'user_id' => $user->id,
                'subscription_plan_id' => $plan->id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
