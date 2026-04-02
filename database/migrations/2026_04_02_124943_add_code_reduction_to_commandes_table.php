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
        Schema::table('commandes', function (Blueprint $table) {
            $table->foreignId('code_reduction_id')->nullable()->after('frais_livraison')->constrained('code_reductions')->onDelete('set null');
            $table->decimal('montant_reduction', 10, 2)->default(0)->after('code_reduction_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropForeign(['code_reduction_id']);
            $table->dropColumn(['code_reduction_id', 'montant_reduction']);
        });
    }
};
