<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FraisLivraisonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('frais_livraisons')->insert([
            [
                'jour_semaine' => 'Lundi - Vendredi',
                'distance_max' => 50,
                'montant' => 10.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jour_semaine' => 'Samedi',
                'distance_max' => 50,
                'montant' => 15.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jour_semaine' => 'Dimanche',
                'distance_max' => 20,
                'montant' => 12.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
