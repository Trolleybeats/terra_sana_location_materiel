<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LangueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('langues')->insert([
            [
                'langue' => 'Français',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'langue' => 'English',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'langue' => 'Nederlands',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}