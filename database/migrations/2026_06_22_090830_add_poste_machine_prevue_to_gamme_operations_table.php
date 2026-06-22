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
        Schema::table('gamme_operations', function (Blueprint $table) {
            $table->foreignId('poste_travail_prevu_id')
                ->nullable()
                ->after('operation_id')
                ->constrained('postes_travail')
                ->nullOnDelete();

            $table->foreignId('machine_prevue_id')
                ->nullable()
                ->after('poste_travail_prevu_id')
                ->constrained('machines')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gamme_operations', function (Blueprint $table) {
            $table->dropConstrainedForeignId('machine_prevue_id');
            $table->dropConstrainedForeignId('poste_travail_prevu_id');
        });
    }
};
