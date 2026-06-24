<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        'client_id',
        'date_commande',
        'montant_total'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function lignes()
    {
        return $this->hasMany(CommandeLigne::class);
    }
}
