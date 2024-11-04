<?php

namespace App\Http\Controllers\API;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\API\JsonResponse;
use App\Http\Controllers\API\BaseController;

class AdminStatsController extends BaseController
{
    public function getUsersByAge()
    {
        // Log::info('getUsersByAge method called');
        // Log::info('Current user: ' . Auth::id());
        $userModel = new User();
        $usersByAge = $userModel->getUsersByAge();
        return response()->json($usersByAge);
    }
    public function getVolunteerCount(): JsonResponse
    {
        $volunteerCount = User::where('role_id', 1)->count();
        
        return response()->json(['volunteer_count' => $volunteerCount]);
    }
    
    public function getDeprivedPersonCount(): JsonResponse
    {
        $deprivedPersonCount = User::where('role_id', 2)->count();
        
        return response()->json(['deprived_person_count' => $deprivedPersonCount]);
    }
    public function deleteUser($id) {
        $user = User::find($id);

        if(!$user) {
            return response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted successfuly'],  Response::HTTP_OK);
    }   
}
