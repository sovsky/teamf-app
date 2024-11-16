<?php

namespace App\Models;

use App\Models\User;
use App\Models\AidCategory;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{

    protected $fillable = [
        'name',
        'description',
        'aid_category_id',
        'product_category_id'
    ];

    protected $hidden = ['created_at', 'updated_at', 'aid_category_id', 'product_category_id', 'aidCategory', 'productCategory'];
    protected $appends = ['aid_category', 'product_category'];

    //relation with table users
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_products');
    }
    //relation with table aidCategory
    public function aidCategory(): BelongsTo
    {
        return $this->belongsTo(AidCategory::class, 'aid_category_id');
    }

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function getAidCategoryAttribute(): ?string
    {
        return $this->aidCategory() ? $this->aidCategory()->first()->name : null;
    }

    public function getProductCategoryAttribute(): ?string
    {
        return $this->productCategory()->first() ? $this->productCategory()->first()->name : null;
    }
}
