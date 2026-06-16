<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    protected $fillable = [
        'reference',
        'libelle',
        'stock',
        'prix',
        'type_piece_id',
        'fournisseur_id'
    ];

    public function typePiece()
    {
        return $this->belongsTo(TypePiece::class);
    }
}
