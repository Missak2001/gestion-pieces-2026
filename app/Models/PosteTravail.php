<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosteTravail extends Model
{
    protected $table = 'postes_travail';

    protected $fillable = [
        'libelle'
    ];
}
