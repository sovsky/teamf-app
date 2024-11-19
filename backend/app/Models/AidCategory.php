<?php

namespace App\Models;

use App\Models\AidType;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AidCategory extends Model
{

    protected $fillable = [
        'aid_type_id',
        'name'
    ];

    protected $hidden = ['created_at', 'updated_at', 'aid_type_id', 'aidType'];
    protected $appends = ['aid_type'];

    public function aidType(): BelongsTo
    {
        return $this->belongsTo(AidType::class, 'aid_type_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'aid_category_id');
    }

    public function getAidTypeAttribute(): ?string
    {
        return $this->aidType() ? $this->aidType()->first()->name : null;
    }
}
