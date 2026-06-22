<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserQualification extends Model
{
    protected $fillable = [
        'user_id',
        'poste_travail_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posteTravail()
    {
        return $this->belongsTo(
            PosteTravail::class,
            'poste_travail_id'
        );
    }
}
