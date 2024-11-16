<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voivodeship extends Model
{
    public $hidden = ['created_at', 'updated_at'];
    
    public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
