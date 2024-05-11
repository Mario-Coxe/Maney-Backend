<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AtmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buscar todas as categorias
        $categories = DB::table('atm_categories')->get();

        foreach(range(1, 4) as $index)
        {
            // Escolher uma categoria aleatória
            $randomCategory = $categories->random();

            DB::table('atms')->insert([
                'name' => 'ATM ' . $index,
                'latitude' => -8.839988 + mt_rand()/mt_getrandmax() * 0.02 - 0.01, // gerando latitude próxima a -8.839988
                'longitude' => 13.289437 + mt_rand()/mt_getrandmax() * 0.02 - 0.01, // gerando longitude próxima a 13.289437
                'address' => 'Address for ATM ' . $index, // aqui você deve adicionar a forma que deseja gerar o endereço
                'has_cash' => mt_rand(0,1) == 1, // gera booleano aleatório
                'category_id' => $randomCategory->id, // usar o id da categoria aleatória
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
