<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModeLivraisonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        DB::table('mode_livraisons')->insert([
            [
                'mode_livraison' => 'sur place',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mode_livraison' => 'livraison',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
