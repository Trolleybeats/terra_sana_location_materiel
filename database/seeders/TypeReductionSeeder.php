<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeReductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_reductions')->insert([
            [
                'reduction' => 'fixe',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reduction' => 'pourcentage',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
