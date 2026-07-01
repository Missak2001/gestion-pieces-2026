<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    protected $fillable = [
        'fournisseur_id',
        'date_commande',
        'date_livraison_prevue',
        'date_livraison_reelle',
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function lignes()
    {
        return $this->hasMany(AchatLigne::class);
    }

    public function total()
    {
        return $this->lignes->sum(function ($ligne) {
            return $ligne->quantite * $ligne->prix_achat;
        });
    }
}
