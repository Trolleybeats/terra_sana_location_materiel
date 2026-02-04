<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticulierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('particuliers')->insert([
            [
                'user_id' => 1,
                'nom' => 'Dupont',
                'prenom' => 'Jean',
                'nom_rue' => 'Rue de la Paix',
                'numero_rue' => 10,
                'nom_commune_id' => 1,
                'numero_commune_id' => 1,
                'pays_id' => 1,
                'langue_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
