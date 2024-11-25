<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\City;
use App\Models\Role;
use App\Models\Rating;
use App\Models\Product;
use App\Models\AidCategory;
use App\Models\UserAidSelection;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'age', 
        'phone_number',
        'picture',
        'is_picture_public',
        'role_id',
        'city_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function ratings(): HasMany {
        return $this->hasMany(Rating::class);
    }

    public function role(): BelongsTo {
        return $this->belongsTo(Role::class, 'role_id');
    }

    //relation with table products
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'users_products');
    }
    //realtion with aidCategories table
    public function aidCategories()
    {
        return $this->belongsToMany(AidCategory::class, Product::class, 'id', 'id', 'id', 'aid_category_id');
    }

    public function userAidSelections()
    {
        return $this->hasMany(UserAidSelection::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class); // Assuming you have a City model
    }

    //admin panel 
    //download users from database
    public static function getUsersByAge()
    {
        return self::select(DB::raw('EXTRACT(YEAR FROM AGE(age)) AS age'), DB::raw('COUNT(*) as count'))
            ->groupBy('age')
            ->orderByDesc('count')
            ->limit(10)
            ->get();
    }
}    