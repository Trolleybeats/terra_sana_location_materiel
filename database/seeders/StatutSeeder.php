<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuts')->insert([
            [
                'statut' => 'en attente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'statut' => 'confirmée',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'statut' => 'livrée',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'statut' => 'annulée',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
