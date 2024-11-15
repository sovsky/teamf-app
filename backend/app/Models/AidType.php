<?php

namespace App\Models;

use App\Models\AidCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AidType extends Model
{

    protected $fillable = [
        'name'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function aidCategories(): HasMany {
        return $this->hasMany(AidCategory::class, 'type_of_aid_id');
    }
}
