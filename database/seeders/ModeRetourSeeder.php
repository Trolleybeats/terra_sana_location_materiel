<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModeRetourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mode_retours')->insert([
            [
                'mode_retour' => 'sur place',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mode_retour' => 'livraison',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
