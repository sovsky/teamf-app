<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use App\Intefaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

final readonly class UserMatchingService
{
    public function findMatchingUsers(User $currentUser): Collection
    {
        return User::query()
            ->where('id', '!=', $currentUser->id)
            ->whereHas('city', function (Builder $query) use ($currentUser) {
                $query->where('voivodeship_id', $currentUser->city->voivodeship_id)
                    ->where('district_id', $currentUser->city->district_id)
                    ->where('commune_id', $currentUser->city->commune_id);
            })
            ->whereHas('products', function (Builder $query) use ($currentUser) {
                $query->whereIn('products.id', $currentUser->products->pluck('id'));
            })
            ->whereHas('products.aidCategory', function (Builder $query) use ($currentUser) {
                $currentUserCategories = $currentUser->products()
                    ->with('aidCategory.aidType')
                    ->get()
                    ->pluck('aidCategory')
                    ->unique('id');

                $query->whereIn('aid_categories.id', $currentUserCategories->pluck('id'))
                    ->whereHas('aidType', function (Builder $typeQuery) use ($currentUserCategories) {
                        $typeQuery->whereIn('type_of_aid.id', 
                            $currentUserCategories->pluck('aidType.id')->unique()
                        );
                    });
            })
            ->with(['city', 'products.aidCategory.aidType'])
            ->get();
    }
}