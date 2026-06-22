<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompatibiliteMachinePosteTravail extends Model
{
    protected $fillable = [
        'poste_travail_id',
        'machine_id',
    ];

    public function posteTravail()
    {
        return $this->belongsTo(PosteTravail::class, 'poste_travail_id');
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }
}
