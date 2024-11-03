<?php

namespace App\Http\Controllers\API;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\API\BaseController;

class AdminStatsController extends BaseController
{
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
    
    
}
