<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Realisation extends Model
{
    protected $fillable = [
        'gamme_operation_id',
        'user_id',
        'poste_travail_reel_id',
        'machine_reelle_id',
        'date_realisation',
        'temps_reel',
        'terminee',
    ];

    public function gammeOperation()
    {
        return $this->belongsTo(GammeOperation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posteTravailReel()
    {
        return $this->belongsTo(PosteTravail::class, 'poste_travail_reel_id');
    }

    public function machineReelle()
    {
        return $this->belongsTo(Machine::class, 'machine_reelle_id');
    }
}
