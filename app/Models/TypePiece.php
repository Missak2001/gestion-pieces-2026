<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypePiece extends Model
{
    protected $fillable = [
        'libelle'
    ];

    public function pieces()
    {
        return $this->hasMany(Piece::class);
    }
}
