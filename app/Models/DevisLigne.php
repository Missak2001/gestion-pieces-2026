<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevisLigne extends Model
{
    protected $table = 'devis_lignes';

    protected $fillable = [
        'devis_id',
        'piece_id',
        'quantite',
        'prix_unitaire',
    ];

    public function devis()
    {
        return $this->belongsTo(Devis::class);
    }

    public function piece()
    {
        return $this->belongsTo(Piece::class);
    }

    public function total()
    {
        return $this->quantite * $this->prix_unitaire;
    }
}
