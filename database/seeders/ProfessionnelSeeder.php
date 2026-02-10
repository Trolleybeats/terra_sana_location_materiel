<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        DB::table('professionnels')->insert([
            [
                'user_id' => 2,
                'nom_societe' => 'Location Plus SPRL',
                'nom_rue_siege' => 'Avenue Louise',
                'numero_rue_siege' => '45',
                'nom_commune_siege_id' => 2,
                'numero_commune_siege_id' => 2,
                'nom_rue_livraison' => 'Avenue Louise',
                'numero_rue_livraison' => 30,
                'nom_commune_livraison_id' => 2,
                'numero_commune_livraison_id' => 2,
                'pays_id' => 2,
                'heure_ouverture' => 8,
                'minute_ouverture' => 00,
                'heure_fermeture' => 17,
                'minute_fermeture' => 00,
                'langue_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
