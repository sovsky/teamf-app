<?php

namespace App\Models;

use App\Models\User;
use App\Models\Rating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{

    protected $fillable = [
        'name'
    ];

    public function ratings(): HasMany {
        return $this->hasMany(Rating::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
