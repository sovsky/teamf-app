<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AidType extends Model
{

    protected $fillable = [
        'name'
    ];

    public function aidCategories(): HasMany {
        return $this->hasMany(AidCategory::class);
    }
}
