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
        Schema::create('achat_lignes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('achat_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('piece_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->integer('quantite');
            $table->decimal('prix_achat', 12, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achat_lignes');
    }
};
