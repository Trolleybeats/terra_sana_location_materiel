<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactProSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contact_pros')->insert([
            [
                'professionnel_id' => 1,
                'nom' => 'Leblanc',
                'prenom' => 'Marc',
                'email' => 'leblanc.marc@gmail.com',
                'telephone' => '+32 123 456 789',
                'fonction_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
