<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailsCommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('details_commandes')->insert([
            [
                'commande_id' => 1,
                'materiel_id' => 1,
                'quantite' => 50,
                'prix_unitaire' => 2.50,
                'sous_total' => 125.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
