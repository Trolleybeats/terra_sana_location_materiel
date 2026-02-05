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
        Schema::create('professionnels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nom_societe');
            $table->string('nom_rue_siege');
            $table->integer('numero_rue_siege');
            $table->foreignId('nom_commune_siege_id')->constrained('communes');
            $table->foreignId('numero_commune_siege_id')->constrained('communes');
            $table->string('nom_rue_livraison');
            $table->integer('numero_rue_livraison');
            $table->foreignId('nom_commune_livraison_id')->constrained('communes');
            $table->foreignId('numero_commune_livraison_id')->constrained('communes');
            $table->foreignId('pays_id')->constrained('pays');
            $table->integer('heure_ouverture');
            $table->integer('minute_ouverture');
            $table->integer('heure_fermeture');
            $table->integer('minute_fermeture');
            $table->foreignId('langue_id')->constrained('langues');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professionnels');
    }
};
