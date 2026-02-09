<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterielSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('materiels')->insert([
            [
                'categorie_id' => '1',
                'nom' => 'chaise chiavari',
                'description' => 'chaise blanche avec dossier arrondis',
                'prix_journalier' => '2.50',
                'dimensions' => '50x50x90 cm',
                'stock_total' => 200,
                'stock_disponible' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
