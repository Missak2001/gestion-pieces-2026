<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Composition extends Model
{
    protected $fillable = [
        'piece_parent_id',
        'piece_enfant_id',
        'quantite'
    ];

    public function pieceParent()
    {
        return $this->belongsTo(Piece::class, 'piece_parent_id');
    }

    public function pieceEnfant()
    {
        return $this->belongsTo(Piece::class, 'piece_enfant_id');
    }
}
