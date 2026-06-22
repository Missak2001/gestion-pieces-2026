<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $fillable = [
        'nom',
        'description'
    ];

    public function gammes()
    {
        return $this->hasMany(GammeOperation::class);
    }
}
