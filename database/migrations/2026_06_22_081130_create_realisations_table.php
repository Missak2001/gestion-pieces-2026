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
        Schema::create('realisations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('gamme_operation_id')
                ->constrained('gamme_operations')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('poste_travail_reel_id')
                ->constrained('postes_travail')
                ->cascadeOnDelete();

            $table->foreignId('machine_reelle_id')
                ->constrained('machines')
                ->cascadeOnDelete();

            $table->date('date_realisation');
            $table->integer('temps_reel');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisations');
    }
};
