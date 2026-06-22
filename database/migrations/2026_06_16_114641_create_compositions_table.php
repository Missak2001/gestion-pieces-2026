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
    Schema::create('compositions', function (Blueprint $table) {
        $table->id();

        $table->foreignId('piece_parent_id')
            ->constrained('pieces')
            ->cascadeOnDelete();

        $table->foreignId('piece_enfant_id')
            ->constrained('pieces')
            ->cascadeOnDelete();

        $table->integer('quantite');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compositions');
    }
};
