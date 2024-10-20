<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AidCategory extends Model
{

    protected $fillable = [
        'aid_type_id',
        'name'
    ];

    public function aidType(): BelongsTo {
        return $this->belongsTo(AidType::class);
    }

    public function products(): HasMany {
        return $this->hasMany(Product::class);
    }
}
