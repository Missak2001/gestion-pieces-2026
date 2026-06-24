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
        Schema::table('pieces', function (Blueprint $table) {
            $table->renameColumn('prix', 'prix_vente');
            $table->decimal('prix_catalogue', 10, 2)->nullable()->after('prix_vente');
        });
    }

    public function down(): void
    {
        Schema::table('pieces', function (Blueprint $table) {
            $table->dropColumn('prix_catalogue');
            $table->renameColumn('prix_vente', 'prix');
        });
    }
};
