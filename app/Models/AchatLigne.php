<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AchatLigne extends Model
{
    protected $fillable = [
        'achat_id',
        'piece_id',
        'quantite',
        'prix_achat',
    ];

    public function achat()
    {
        return $this->belongsTo(Achat::class);
    }

    public function piece()
    {
        return $this->belongsTo(Piece::class);
    }

    public function total()
    {
        return $this->quantite * $this->prix_achat;
    }
}
