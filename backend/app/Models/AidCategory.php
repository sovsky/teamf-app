<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AidCategory extends Model
{

    protected $fillable = [
        'aid_type_id',
        'name'
    ];
}
