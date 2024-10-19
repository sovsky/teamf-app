<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{

    protected $fillable = [
        'name',
        'description',
        'aid_category_id'
    ];

    public function aidCategory(): BelongsTo {
        return $this->belongsTo(AidCategory::class);
    }

    public function productCategory(): BelongsTo {
        return $this->belongsTo(ProductCategory::class);
    }
}
