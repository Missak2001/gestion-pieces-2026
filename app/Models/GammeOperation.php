<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GammeOperation extends Model
{
    protected $fillable = [
        'gamme_id',
        'operation_id',
        'poste_travail_prevu_id',
        'machine_prevue_id',
        'ordre',
        'temps_prevu'
    ];

    public function gamme()
    {
        return $this->belongsTo(Gamme::class);
    }

    public function operation()
    {
        return $this->belongsTo(Operation::class);
    }

    public function posteTravailPrevu()
    {
        return $this->belongsTo(
            PosteTravail::class,
            'poste_travail_prevu_id'
        );
    }

    public function machinePrevue()
    {
        return $this->belongsTo(
            Machine::class,
            'machine_prevue_id'
        );
    }
}
