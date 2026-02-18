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
        Schema::create('particuliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nom');
            $table->string('prenom');
            $table->string('nom_rue');
            $table->integer('numero_rue');
            $table->foreignId('nom_commune_id')->constrained('communes');
            $table->foreignId('numero_commune_id')->constrained('communes');
            $table->foreignId('pays_id')->constrained('pays');
            $table->foreignId('langue_id')->constrained('langues');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('particuliers');
    }
};
