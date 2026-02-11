<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('types')->insert([
            [
                'type' => 'Particulier',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Professionnel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
