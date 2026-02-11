<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('numero_commande')->unique();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->timestamp('date_commande')->useCurrent();
            $table->foreignId('statut_id')->constrained('statuts');
            $table->foreignId('mode_livraison_id')->constrained('mode_livraisons');
            $table->foreignId('mode_retour_id')->constrained('mode_retours');
            $table->string('nom_rue');
            $table->integer('numero_rue');
            $table->foreignId('nom_commune_id')->constrained('communes');
            $table->foreignId('numero_commune_id')->constrained('communes');
            $table->foreignId('pays_id')->constrained('pays');
            $table->decimal('montant_total', 10, 2);
            $table->decimal('frais_livraison', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
