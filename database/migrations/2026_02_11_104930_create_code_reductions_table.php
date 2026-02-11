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
        Schema::create('code_reductions', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('type_reduction_id')->constrained('type_reduction');
            $table->decimal('montant', 10, 2);
            $table->boolean('hors_tva');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('utilisation_max');
            $table->integer('utilisation_actuelles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('code_reductions');
    }
};
