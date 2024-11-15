<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;

class MatchController extends BaseController
{
    public function findMatches(Request $request)
    {
  // Get the currently authenticated user
    $user = auth()->user();

    // Find matching users based on location, products, and type of aid
    $matches = User::where('city', $user->city) // Match users in the same city
        ->whereHas('products', function ($query) use ($user) {
            // Check if users have the same products as the current user
            $query->whereIn('products.id', $user->products->pluck('id'));
        })
        ->whereHas('products', function ($query) use ($user) {
            // Ensure users' products are linked to matching aid categories and aid types
            $query->whereHas('aidCategory', function ($subQuery) use ($user) {
                $subQuery->whereHas('aidType', function ($aidTypeQuery) use ($user) {
                    // Explicitly use the table alias for `aid_types.id`
                    $aidTypeQuery->whereIn('aid_types.id', $user->products->pluck('aidCategory.aid_type_id'));
                });
            });
        })
        ->where('users.id', '!=', $user->id) // Exclude the current user from the results
        ->get();

    // Return the matching users as a JSON response
    return response()->json($matches);

    }
}
