<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\UserMatchingService;
use App\Http\Controllers\API\BaseController;

class MatchController extends BaseController
{
    public function findMatchingUsers(
        Request $request,
        UserMatchingService $matchingService,
    ) {
        $matchingUsers = $matchingService->findMatchingUsers(
            $request->user()
        );

        return response()->json([
            'data' => UserResource::collection($matchingUsers)
        ]);
    }
}
