<?php

namespace App\Models;

use App\Models\User;
use App\Models\Commune;
use App\Models\District;
use App\Models\Voivodeship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    public $hidden = ['created_at', 'updated_at', 'commune_id', 'district_id', 'voivodeship_id'];
    public function voivodeship(): BelongsTo
    {
        return $this->belongsTo(Voivodeship::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function commune(): BelongsTo
    {
        return $this->belongsTo(Commune::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
