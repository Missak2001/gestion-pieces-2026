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
            $table->dropColumn('montant_total');
        });

        Schema::table('commande_lignes', function (Blueprint $table) {
            $table->dropColumn('montant_ligne');
        });
    }

    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->decimal('montant_total', 12, 2)->default(0);
        });

        Schema::table('commande_lignes', function (Blueprint $table) {
            $table->decimal('montant_ligne', 12, 2);
        });
    }
};
