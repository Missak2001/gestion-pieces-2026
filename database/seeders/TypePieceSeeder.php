<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypePiece;

class TypePieceSeeder extends Seeder
{
    public function run(): void
    {
        TypePiece::firstOrCreate(['libelle' => 'Matière Première']);
        TypePiece::firstOrCreate(['libelle' => 'Sous-ensemble']);
        TypePiece::firstOrCreate(['libelle' => 'Produit Fini']);
    }
}
