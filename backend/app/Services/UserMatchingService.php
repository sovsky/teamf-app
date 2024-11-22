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
        $currentUserSelection = $this->getCurrentUserSelection($currentUser);
        
        if (!$currentUserSelection) {
            return collect();
        }
        
        return $this->buildMatchingUsersQuery($currentUser, $currentUserSelection);
    }

    private function getCurrentUserSelection(User $currentUser)
    {
        return $currentUser->userAidSelections()->latest()->first();
    }

    private function buildMatchingUsersQuery(User $currentUser, $currentUserSelection)
    {
        return User::query()
            ->where('id', '!=', $currentUser->id)
            ->where('role_id', '!=', $currentUser->role_id)
            ->whereHas('city', fn($query) => $query->where('id', $currentUser->city_id))
            ->whereHas('userAidSelections', fn($query) => $this->applyUserAidSelectionFilters($query, $currentUserSelection))
            ->with([
                'city',
                'userAidSelections' => fn($query) => $this->applyDetailedUserAidSelectionFilters($query, $currentUserSelection)
            ])
            ->get();
    }

    private function applyUserAidSelectionFilters($query, $currentUserSelection)
    {
        return $query->where('aid_type_id', $currentUserSelection->aid_type_id)
            ->where('aid_category_id', $currentUserSelection->aid_category_id)
            ->when($currentUserSelection->product_category_id, 
                fn($q) => $q->where('product_category_id', $currentUserSelection->product_category_id)
            );
    }

    private function applyDetailedUserAidSelectionFilters($query, $currentUserSelection)
    {
        return $query->where('aid_type_id', $currentUserSelection->aid_type_id)
            ->where('aid_category_id', $currentUserSelection->aid_category_id)
            ->when($currentUserSelection->product_category_id, 
                fn($q) => $q->where('product_category_id', $currentUserSelection->product_category_id)
            )
            ->with(['productUserSelections.product']);
    }

    public function getMatchDetails(User $user1, User $user2): array
    {
        $selection1 = $user1->userAidSelections()->latest()->first();
        $selection2 = $user2->userAidSelections()->latest()->first();
        
        if (!$selection1 || !$selection2) {
            return $this->noMatchResult();
        }
        
        return $this->calculateMatchDetails($user1, $user2, $selection1, $selection2);
    }

    private function noMatchResult(): array
    {
        return [
            'matches' => false,
            'reasons' => ['Brak wyborów pomocy dla jednego z użytkowników']
        ];
    }

    private function calculateMatchDetails(User $user1, User $user2, $selection1, $selection2): array
    {
        $matches = $this->compareSelectionMatches($selection1, $selection2, $user1, $user2);
        $productMatch = $this->compareProductMatches($selection1, $selection2);
        
        return [
            'matches' => array_filter($matches),
            'product_matching' => $productMatch
        ];
    }

    private function compareSelectionMatches($selection1, $selection2, $user1, $user2): array
    {
        return [
            'aid_type' => $selection1->aid_type_id === $selection2->aid_type_id,
            'aid_category' => $selection1->aid_category_id === $selection2->aid_category_id,
            'product_category' => $selection1->product_category_id === $selection2->product_category_id,
            'city' => $user1->city_id === $user2->city_id
        ];
    }

    private function compareProductMatches($selection1, $selection2)
    {
        if (!$selection1->product_category_id || !$selection2->product_category_id) {
            return null;
        }

        $products1 = $selection1->productUserSelections->pluck('product_id')->toArray();
        $products2 = $selection2->productUserSelections->pluck('product_id')->toArray();
        $commonProducts = array_intersect($products1, $products2);
        
        return [
            'matches' => count($commonProducts) > 0,
            'common_products' => $commonProducts
        ];
    }
}