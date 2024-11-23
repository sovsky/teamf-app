<?php

namespace App\Http\Controllers\API;

use App\Models\City;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\MediaType;
use OpenApi\Attributes\RequestBody;

class CityController extends BaseController
{
    /**
     * Get all cities
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Get(
        path: "/api/cities",
        summary: "Retrieve all cities",
        tags: ["Cities"],
        responses: [
            new OA\Response(
                response: 200,
                description: "List of all cities",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 1),
                            new OA\Property(property: "name", type: "string", example: "Warsaw"),
                            new OA\Property(property: "commune_id", type: "integer", example: 101),
                            new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2024-09-22T10:20:30Z"),
                            new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2024-09-23T15:30:45Z")
                        ]
                    )
                )
            ),
            new OA\Response(response: 500, description: "Server Error")
        ]
    )]
    public function getCities(): JsonResponse
    {
        $cities = City::all();

        return $this->sendResponse($cities, 'All cities.');
    }

    /**
     * Get city by id
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Get(
        path: "/api/cities/{id}",
        summary: "Retrieve a city by its ID",
        tags: ["Cities"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, description: "City ID", schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "City details",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "id", type: "integer", example: 1),
                        new OA\Property(property: "name", type: "string", example: "Warsaw"),
                        new OA\Property(property: "commune_id", type: "integer", example: 101),
                        new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2024-09-22T10:20:30Z"),
                        new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2024-09-23T15:30:45Z")
                    ]
                )
            ),
            new OA\Response(response: 404, description: "City not found"),
            new OA\Response(response: 500, description: "Server Error")
        ]
    )]
    public function getCityById(int $cityId): JsonResponse
    {
        $city = City::findOrFail($cityId);

        return $this->sendResponse($city, 'City by id.');
    }

    /**
     * Get cities by commune
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Get(
        path: "/api/communes/{id}/cities",
        summary: "Retrieve cities by commune ID",
        tags: ["Cities"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, description: "Commune ID", schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "List of cities in the commune",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 2),
                            new OA\Property(property: "name", type: "string", example: "Krakow"),
                            new OA\Property(property: "commune_id", type: "integer", example: 102),
                            new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2024-09-25T11:15:00Z"),
                            new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2024-09-26T17:45:00Z")
                        ]
                    )
                )
            ),
            new OA\Response(response: 404, description: "Commune not found"),
            new OA\Response(response: 500, description: "Server Error")
        ]
    )]
    public function getCitiesByCommune(int $communeId): JsonResponse
    {
        $cities = City::where('commune_id', $communeId)->get();

        return $this->sendResponse($cities, 'Cities by commune.');
    }
}
