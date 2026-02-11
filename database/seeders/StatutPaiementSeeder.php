<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatutPaiementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        DB::table('statut_paiements')->insert([
            [
                'statut' => 'Payée',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'statut' => 'Non payée',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
