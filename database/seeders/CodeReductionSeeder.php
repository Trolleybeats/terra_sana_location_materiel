<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CodeReductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('code_reductions')->insert([
            [
                'code' => 'NOEL25',
                'type_reduction_id' => 1,
                'montant' => 10.00,
                'hors_tva' => true,
                'date_debut' => '2025-12-01',
                'date_fin' => '2025-12-31',
                'utilisation_max' => 2000,
                'utilisation_actuelles' => 320,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
