<?php

namespace App\Http\Controllers\API;

use App\Models\District;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\MediaType;
use OpenApi\Attributes\RequestBody;

class DistrictController extends BaseController
{
    /**
     * Get all districts
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Get(
        path: "/api/districts",
        summary: "Retrieve all districts",
        tags: ["Districts"],
        responses: [
            new OA\Response(
                response: 200,
                description: "List of all districts",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 1),
                            new OA\Property(property: "name", type: "string", example: "District Alpha"),
                            new OA\Property(property: "voivodeship_id", type: "integer", example: 5),
                            new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2024-09-22T10:20:30Z"),
                            new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2024-09-23T15:30:45Z")
                        ]
                    )
                )
            ),
            new OA\Response(response: 500, description: "Server Error")
        ]
    )]
    public function getDistricts(): JsonResponse
    {
        $districts = District::all();

        return $this->sendResponse($districts, 'All districts.');
    }

    /**
     * Get district by id
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Get(
        path: "/api/districts/{id}",
        summary: "Retrieve a district by its ID",
        tags: ["Districts"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, description: "District ID", schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "District details",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "id", type: "integer", example: 2),
                        new OA\Property(property: "name", type: "string", example: "District Beta"),
                        new OA\Property(property: "voivodeship_id", type: "integer", example: 8),
                        new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2024-09-25T11:15:00Z"),
                        new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2024-09-26T17:45:00Z")
                    ]
                )
            ),
            new OA\Response(response: 404, description: "District not found"),
            new OA\Response(response: 500, description: "Server Error")
        ]
    )]
    public function getDistrictById(int $districtId): JsonResponse
    {
        $district = District::findOrFail($districtId);

        return $this->sendResponse($district, 'District by id.');
    }

    /**
     * Get districts by voivodeship
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Get(
        path: "/api/voivodeships/{id}/districts",
        summary: "Retrieve districts by voivodeship ID",
        tags: ["Districts"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, description: "Voivodeship ID", schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "List of districts in the specified voivodeship",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 4),
                            new OA\Property(property: "name", type: "string", example: "District Gamma"),
                            new OA\Property(property: "voivodeship_id", type: "integer", example: 12),
                            new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2024-09-27T12:00:00Z"),
                            new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2024-09-28T14:30:00Z")
                        ]
                    )
                )
            ),
            new OA\Response(response: 404, description: "Voivodeship not found"),
            new OA\Response(response: 500, description: "Server Error")
        ]
    )]
    public function getDistrictsByVoivodeship(int $voivodeshipId): JsonResponse
    {
        $districts = District::where('voivodeship_id', $voivodeshipId)->get();

        return $this->sendResponse($districts, 'Districts by voivodeship.');
    }
}
