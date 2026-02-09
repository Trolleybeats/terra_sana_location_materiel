<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieMaterielSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorie_materiels')->insert([
            [
                'nom' => 'siege',
                'description' => 'chaises, tabourets, fauteuils',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'tables',
                'description' => 'tables rondes, rectangulaires',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
