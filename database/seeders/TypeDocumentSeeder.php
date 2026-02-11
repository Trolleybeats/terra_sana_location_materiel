<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        DB::table('type_documents')->insert([
            [
                'document' => 'Devis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'document' => 'Livraison',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
