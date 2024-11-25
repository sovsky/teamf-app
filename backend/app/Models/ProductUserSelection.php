<?php

namespace App\Models;

use App\Models\Product;
use App\Models\UserAidSelection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductUserSelection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_aid_selection_id',
        'product_id'
    ];

    public function userAidSelection()
    {
        return $this->belongsTo(UserAidSelection::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
