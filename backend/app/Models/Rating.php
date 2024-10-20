<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rating extends Model
{

    protected $fillable = [
        'user_id',
        'role_id',
        'rating',
        'comment'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'role_id');
    }
}
