<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;


class UserMatchingService
{
    public function findMatchingUsers(User $currentUser): Collection
    {
        $currentUserSelection = $currentUser->userAidSelections()
            ->latest()
            ->first();

        if (!$currentUserSelection) {
            return collect();
        }

        return User::query()
            ->where('id', '!=', $currentUser->id)
            ->where('role_id', '!=', $currentUser->role_id)
            ->whereHas('city', function (Builder $query) use ($currentUser) {
                $query->where('id', $currentUser->city_id);
            })
            ->whereHas('userAidSelections', function (Builder $query) use ($currentUserSelection) {
                $query->where('aid_type_id', $currentUserSelection->aid_type_id)
                    ->where('aid_category_id', $currentUserSelection->aid_category_id)
                    ->when($currentUserSelection->product_category_id, function (Builder $query) use ($currentUserSelection) {
                        $query->where('product_category_id', $currentUserSelection->product_category_id);
                    });
            })
            ->with([
                'city',
                'userAidSelections' => function ($query) use ($currentUserSelection) {
                    $query->where('aid_type_id', $currentUserSelection->aid_type_id)
                        ->where('aid_category_id', $currentUserSelection->aid_category_id)
                        ->when($currentUserSelection->product_category_id, function ($query) use ($currentUserSelection) {
                            $query->where('product_category_id', $currentUserSelection->product_category_id);
                        })
                        ->with(['productUserSelections.product']);
                }
            ])
            ->get();
    }

    public function getMatchDetails(User $user1, User $user2): array
    {
        $selection1 = $user1->userAidSelections()->latest()->first();
        $selection2 = $user2->userAidSelections()->latest()->first();

        if (!$selection1 || !$selection2) {
            return [
                'matches' => false,
                'reasons' => ['Brak wyborów pomocy dla jednego z użytkowników']
            ];
        }

        $matches = [
            'aid_type' => $selection1->aid_type_id === $selection2->aid_type_id,
            'aid_category' => $selection1->aid_category_id === $selection2->aid_category_id,
            'product_category' => $selection1->product_category_id === $selection2->product_category_id,
            'city' => $user1->city_id === $user2->city_id
        ];

        $productMatch = null;
        if ($selection1->product_category_id && $selection2->product_category_id) {
            $products1 = $selection1->productUserSelections->pluck('product_id')->toArray();
            $products2 = $selection2->productUserSelections->pluck('product_id')->toArray();
            $commonProducts = array_intersect($products1, $products2);
            
            $productMatch = [
                'matches' => count($commonProducts) > 0,
                'common_products' => $commonProducts
            ];
        }

        return [
            'matches' => array_filter($matches),
            'product_matching' => $productMatch
        ];
    }
}