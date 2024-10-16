<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'role_id',
        'rating',
        'comment'
    ];
}
