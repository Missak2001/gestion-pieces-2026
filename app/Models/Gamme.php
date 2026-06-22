<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gamme extends Model
{
    protected $fillable = [
        'piece_id',
        'nom',
        'responsable'
    ];

    public function piece()
    {
        return $this->belongsTo(Piece::class);
    }

    public function operations()
    {
        return $this->hasMany(GammeOperation::class);
    }
}
