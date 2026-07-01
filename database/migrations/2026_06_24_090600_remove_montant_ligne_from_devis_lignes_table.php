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
        Schema::table('devis_lignes', function (Blueprint $table) {
            $table->dropColumn('montant_ligne');
        });
    }

    public function down(): void
    {
        Schema::table('devis_lignes', function (Blueprint $table) {
            $table->decimal('montant_ligne', 12, 2);
        });
    }
};
