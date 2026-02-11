<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReductionClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reduction_clients')->insert([
            [
                'user_id' => 1,
                'code_reduction_id' => 1,
                'date_attribution' => '2025-12-31',
                'date_expiration' => '2026-12-31',
                'montant_fixe' => 50.00,
                'pourcentage' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
