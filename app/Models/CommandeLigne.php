<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommandeLigne extends Model
{
    protected $fillable = [
        'commande_id',
        'devis_ligne_id',
        'piece_id',
        'quantite',
        'prix_unitaire',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function piece()
    {
        return $this->belongsTo(Piece::class);
    }

    public function total()
    {
        return $this->quantite * $this->prix_unitaire;
    }

    public function devisLigne()
    {
        return $this->belongsTo(DevisLigne::class);
    }
}
