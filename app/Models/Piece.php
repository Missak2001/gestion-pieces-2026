<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    protected $fillable = [
        'reference',
        'libelle',
        'stock',
        'prix_vente',
        'prix_catalogue',
        'type_piece_id',
        'fournisseur_id'
    ];

    public function typePiece()
    {
        return $this->belongsTo(TypePiece::class);
    }
    public function composants()
    {
        return $this->hasMany(
            Composition::class,
            'piece_parent_id'
        );
    }

    public function utiliseDans()
    {
        return $this->hasMany(
            Composition::class,
            'piece_enfant_id'
        );
    }

    public function gammes()
    {
        return $this->hasMany(Gamme::class);
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
}
