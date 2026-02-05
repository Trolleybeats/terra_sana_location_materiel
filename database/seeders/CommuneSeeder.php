<?php

namespace Database\Seeders;

use App\Models\Commune;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CommuneSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('🔄 Récupération des communes belges...');

        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('commandes')->delete();
            Commune::query()->delete();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $this->command->info('🗑️  Tables vidées');

            $response = Http::get(
                'https://services.socialsecurity.be/REST/referenceData/geography/v1/countries/150/cities/',
                ['pageSize' => 3170]
            );

            $data = $response->json();
            $items = $data['items'] ?? [];

            $total = count($items);
            $this->command->info("📦 {$total} items trouvées");

            $seen = [];
            $counter = 0;

            foreach ($items as $item) {
                $nisCode = $item['cityNisCode'] ?? null;
                $zipCode = $item['zipCode'] ?? null; 
                $name = $item['cityName']['fr'] ?? $item['cityName']['nl'] ?? null;

                if (!$nisCode || !$name) {
                    continue;
                }

                if (isset($seen[$nisCode])) {
                    continue;
                }

                $seen[$nisCode] = true;

                Commune::create([
                    'numero_commune' => $zipCode,
                    'nom_commune' => $name
                ]);

                $counter++;
            }

            $this->command->info("✅ {$counter} communes importées !");

        } catch (\Exception $e) {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            $this->command->error('❌ Erreur : ' . $e->getMessage());
        }
    }
}
