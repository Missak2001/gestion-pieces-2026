<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    protected $fillable = [
        'client_id',
        'date_devis',
        'date_limite',
        'commande_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function lignes()
    {
        return $this->hasMany(DevisLigne::class);
    }

    public function total()
    {
        return $this->lignes->sum(function ($ligne) {
            return $ligne->quantite * $ligne->prix_unitaire;
        });
    }

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}
