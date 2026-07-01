<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        'client_id',
        'date_commande',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function lignes()
    {
        return $this->hasMany(CommandeLigne::class);
    }

    public function total()
    {
        return $this->lignes->sum(function ($ligne) {
            return $ligne->quantite * $ligne->prix_unitaire;
        });
    }

    public function devis()
    {
        return $this->hasManyThrough(
            Devis::class,
            CommandeLigne::class,
            'commande_id',
            'id',
            'id',
            'devis_ligne_id'
        );
    }
}
