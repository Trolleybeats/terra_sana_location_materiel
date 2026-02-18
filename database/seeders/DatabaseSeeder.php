<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        $this->call([
            TypeSeeder::class,
            UserSeeder::class,
            CommuneSeeder::class,
            PaysSeeder::class,
            LangueSeeder::class,
            ParticulierSeeder::class,
            ProfessionnelSeeder::class,
            ModeLivraisonSeeder::class,
            ModeRetourSeeder::class,
            CategorieMaterielSeeder::class,
            MaterielSeeder::class,
            TypeReductionSeeder::class,
            CodeReductionSeeder::class,
            StatutSeeder::class,
            StatutPaiementSeeder::class,
            TypeDocumentSeeder::class,
            FraisLivraisonSeeder::class,
            CommandeSeeder::class,
            FactureSeeder::class,
            FonctionSeeder::class,
            ContactProSeeder::class,
            DetailsCommandeSeeder::class,
            PhotoMaterielSeeder::class,
            ReductionClientSeeder::class,
        ]);
    }
}