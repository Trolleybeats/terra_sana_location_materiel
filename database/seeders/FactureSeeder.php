<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FactureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('factures')->insert([
            [
                'commande_id' => 1,
                'numero_facture' => 'FAC-2025-001',
                'type_document_id' => 2,
                'date_emission' => '2025-12-31',
                'date_echeance' => '2026-12-31',
                'montant_ht' => 20,
                'montant_tva' => 10,
                'montant_ttc' => 30,
                'statut_paiement_id' => 2,
                'url_pdf' => '/FAC-2025-001.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
