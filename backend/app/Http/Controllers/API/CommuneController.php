<?php

namespace App\Http\Controllers\API;

use App\Models\Commune;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\MediaType;
use OpenApi\Attributes\RequestBody;

class CommuneController extends BaseController
{
    /**
     * Get all communes
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Get(
        path: "/api/communes",
        summary: "Retrieve all communes",
        tags: ["Communes"],
        responses: [
            new OA\Response(
                response: 200,
                description: "List of all communes",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 1),
                            new OA\Property(property: "name", type: "string", example: "Commune Alpha"),
                            new OA\Property(property: "district_id", type: "integer", example: 10),
                            new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2024-09-22T10:20:30Z"),
                            new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2024-09-23T15:30:45Z")
                        ]
                    )
                )
            ),
            new OA\Response(response: 500, description: "Server Error")
        ]
    )]
    public function getCommunes(): JsonResponse
    {
        $communes = Commune::all();

        return $this->sendResponse($communes, 'All communes.');
    }

    /**
     * Get commune by id
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Get(
        path: "/api/communes/{id}",
        summary: "Retrieve a commune by its ID",
        tags: ["Communes"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, description: "Commune ID", schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Commune details",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "id", type: "integer", example: 1),
                        new OA\Property(property: "name", type: "string", example: "Commune Beta"),
                        new OA\Property(property: "district_id", type: "integer", example: 20),
                        new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2024-09-22T10:20:30Z"),
                        new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2024-09-23T15:30:45Z")
                    ]
                )
            ),
            new OA\Response(response: 404, description: "Commune not found"),
            new OA\Response(response: 500, description: "Server Error")
        ]
    )]
    public function getCommuneById(int $communeId): JsonResponse
    {
        $commune = Commune::findOrFail($communeId);

        return $this->sendResponse($commune, 'Commune by id.');
    }

    /**
     * Get communes by district
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Get(
        path: "/api/districts/{id}/communes",
        summary: "Retrieve communes by district ID",
        tags: ["Communes"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, description: "District ID", schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "List of communes in the district",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 3),
                            new OA\Property(property: "name", type: "string", example: "Commune Gamma"),
                            new OA\Property(property: "district_id", type: "integer", example: 30),
                            new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2024-09-25T11:15:00Z"),
                            new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2024-09-26T17:45:00Z")
                        ]
                    )
                )
            ),
            new OA\Response(response: 404, description: "District not found"),
            new OA\Response(response: 500, description: "Server Error")
        ]
    )]
    public function getCommunesByDistrict(int $districtId): JsonResponse
    {
        $communes = Commune::where('district_id', $districtId)->get();

        return $this->sendResponse($communes, 'Communes by district.');
    }
}
