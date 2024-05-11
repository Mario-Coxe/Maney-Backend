<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach(range(1, 10) as $index)
        {
            DB::table('users')->insert([
                'name' => 'User ' . $index,
                'email' => 'user' . $index . '@example.com',
                'phone' => '123456789' . $index,
                'password' => Hash::make('123456789'),
                'provider_name' => null,
                'provider_id' => null,
                'tipo_usuario' => 'cliente',
                'ativo' => true,
                'ultima_atividade' => now(),
                'foto' => null,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
