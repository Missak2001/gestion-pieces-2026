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
        Schema::create('gamme_operations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('gamme_id')
                ->constrained('gammes')
                ->cascadeOnDelete();

            $table->foreignId('operation_id')
                ->constrained('operations')
                ->cascadeOnDelete();

            $table->integer('ordre');
            $table->integer('temps_prevu');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gamme_operations');
    }
};
