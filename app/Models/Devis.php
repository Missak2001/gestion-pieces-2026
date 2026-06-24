<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    protected $fillable = [
        'client_id',
        'date_devis',
        'date_limite',
        'montant_total'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function lignes()
    {
        return $this->hasMany(DevisLigne::class);
    }
}
