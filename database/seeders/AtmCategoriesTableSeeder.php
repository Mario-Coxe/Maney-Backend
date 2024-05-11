<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AtmCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Banco BAI', 'BFA', 'Millemium', 'Banco BFA'];

        foreach($categories as $category)
        {
            DB::table('atm_categories')->insert([
                'name' => $category,
                'created_at' => now(),
                'updated_at' => now(),
             
            ]);
        }
    }
}
