<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->take(10)->get();

        foreach($users as $user)
        {
            DB::table('wallets')->insert([
                'user_id' => $user->id,
                'balance' => mt_rand(100, 10000)/100, // Gera um valor aleatório entre 1.00 e 100.00
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
