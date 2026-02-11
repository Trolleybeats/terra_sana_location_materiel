<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('commandes')->insert([
            [
                'user_id' => 1,
                'numero_commande' => 'cmd-2025-001',
                'date_debut' => '2025-12-20',
                'date_fin' => '2025-12-21',
                'date_commande' => '2025-12-01',
                'statut_id' => 1,
                'mode_livraison_id' => 1,
                'mode_retour_id' => 1,
                'nom_rue' => 'Rue de Paris',
                'numero_rue' => 123,
                'nom_commune_id' => 1,
                'numero_commune_id' => 1,
                'pays_id' => 1,
                'montant_total' => 125.50,
                'frais_livraison' => 4.50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
