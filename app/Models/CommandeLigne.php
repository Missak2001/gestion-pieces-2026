<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommandeLigne extends Model
{
    protected $fillable = [
        'commande_id',
        'piece_id',
        'quantite',
        'prix_unitaire',
        'montant_ligne'
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function piece()
    {
        return $this->belongsTo(Piece::class);
    }
}
