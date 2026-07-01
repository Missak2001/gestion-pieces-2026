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
        Schema::table('devis', function (Blueprint $table) {
            $table->foreignId('commande_id')
                ->nullable()
                ->after('date_limite')
                ->constrained('commandes')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('devis', function (Blueprint $table) {
            $table->dropConstrainedForeignId('commande_id');
        });
    }
};
