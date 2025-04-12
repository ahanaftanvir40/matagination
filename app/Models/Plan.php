<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'price',
        'speed',
        'tokens_per_day',
        'estimated_return',
        'icon',
    ];

    
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
