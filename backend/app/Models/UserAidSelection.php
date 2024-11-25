<?php

namespace App\Models;

use App\Models\AidType;
use App\Models\AidCategory;
use App\Models\ProductCategory;
use App\Models\ProductUserSelection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAidSelection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'aid_type_id',
        'aid_category_id',
        'product_category_id'
    ];

    public function productUserSelections()
    {
        return $this->hasMany(ProductUserSelection::class);
    }

    public function aidType()
    {
        return $this->belongsTo(AidType::class);
    }

    public function aidCategory()
    {
        return $this->belongsTo(AidCategory::class);
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
