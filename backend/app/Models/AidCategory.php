<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class AidCategory extends Model
{
    use HasUuids;

    protected $fillable = [
        'aid_type_id',
        'name'
    ];
}
