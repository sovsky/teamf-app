<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
