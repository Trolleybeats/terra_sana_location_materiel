<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhotoMaterielSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('photo_materiels')->insert([
            [
                'materiel_id' => 1,
                'url_photo' => '/photos/chaise-chiavari-1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'materiel_id' => 1,
                'url_photo' => '/photos/chaise-chiavari-2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
