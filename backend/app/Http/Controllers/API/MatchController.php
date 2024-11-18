<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Property;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes\MediaType;
use OpenApi\Attributes\RequestBody;
use App\Http\Resources\UserResource;
use App\Services\UserMatchingService;
use App\Http\Controllers\API\BaseController;

class MatchController extends BaseController
{
    #[OA\Get(
        path: "/api/matching-users",
        summary: "Retrieve matching users with their latest selection details",
        tags: ["Users"],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Successfully retrieved matching users",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "data", type: "array", items: new OA\Items(
                            type: "object", properties: [
                                new OA\Property(property: "id", type: "integer"), 
                                new OA\Property(property: "name", type: "string"), 
                                new OA\Property(property: "city", type: "string"),
                                new OA\Property(property: "latest_selection", type: "object", properties: [
                                    new OA\Property(property: "aid_type", type: "string"), 
                                    new OA\Property(property: "aid_category", type: "string"), 
                                    new OA\Property(property: "product_category", type: "string"), 
                                    new OA\Property(property: "products", type: "array", items: new OA\Items(
                                        type: "object", properties: [
                                            new OA\Property(property: "id", type: "integer"), 
                                            new OA\Property(property: "name", type: "string")
                                        ]
                                    ))
                                ])
                            ]
                        ))
                    ]
                )
            ),
            new OA\Response(response: Response::HTTP_BAD_REQUEST, description: "Bad Request"),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Server Error"),
        ]
    )]    
    
     /**
     * Search function for people with specific criteria
     *
     */
    public function findMatchingUsers(Request $request, UserMatchingService $matchingService)
    {
        $currentUser = $request->user();
        $matchingUsers = $matchingService->findMatchingUsers($currentUser);

        $result = $matchingUsers->map(function ($matchingUser) use ($matchingService, $currentUser) {
            $matchingDetails = $matchingService->getMatchDetails($currentUser, $matchingUser);
            
            return [
                'user' => new UserResource($matchingUser),
            ];
        });

        return response()->json([
            'data' => $result
        ]);
    }
}
