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
        Schema::table('commande_lignes', function (Blueprint $table) {
            $table->foreignId('devis_ligne_id')
                ->nullable()
                ->after('commande_id')
                ->constrained('devis_lignes')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('commande_lignes', function (Blueprint $table) {
            $table->dropConstrainedForeignId('devis_ligne_id');
        });
    }
};
