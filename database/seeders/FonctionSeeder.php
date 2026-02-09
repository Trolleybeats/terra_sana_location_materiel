<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FonctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fonctions')->insert([
            [
                'fonction' => 'responsable logistique',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fonction' => 'directeur commerciale',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
