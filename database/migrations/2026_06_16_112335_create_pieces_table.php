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
    Schema::create('pieces', function (Blueprint $table) {
        $table->id();
        $table->text('reference')->unique();
        $table->text('libelle');
        $table->integer('stock')->default(0);
        $table->decimal('prix', 10, 2)->nullable();

        $table->foreignId('type_piece_id')
            ->constrained('type_pieces')
            ->cascadeOnDelete();

        $table->foreignId('fournisseur_id')
            ->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pieces');
    }
};
