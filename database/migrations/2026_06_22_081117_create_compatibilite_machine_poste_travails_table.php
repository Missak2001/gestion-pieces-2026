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
        Schema::create('compatibilite_machine_poste_travails', function (Blueprint $table) {
            $table->id();

            $table->foreignId('poste_travail_id')
                ->constrained('postes_travail')
                ->cascadeOnDelete();

            $table->foreignId('machine_id')
                ->constrained('machines')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['poste_travail_id', 'machine_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compatibilite_machine_poste_travails');
    }
};
