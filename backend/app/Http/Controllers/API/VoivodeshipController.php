<?php

namespace App\Http\Controllers\API;

use App\Models\Voivodeship;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class VoivodeshipController extends BaseController
{
    /**
     * Get all voivodeships
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Get(
        path: "/api/voivodeships",
        summary: "Get all voivodeships",
        description: "Fetches a list of all voivodeships.",
        tags: ["Voivodeships"],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "List of all voivodeships",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(
                        type: "object",
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 1),
                            new OA\Property(property: "name", type: "string", example: "Mazowieckie"),
                        ]
                    )
                )
            ),
            new OA\Response(
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
                description: "Server error"
            )
        ]
    )]
    public function getVoivodeships(): JsonResponse
    {
        $voivodeships = Voivodeship::all();

        return $this->sendResponse($voivodeships, 'All voivodesihps.');
    }

    /**
     * Get voivodeship by id
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Get(
        path: "/api/voivodeships/{id}",
        summary: "Get voivodeship by ID",
        description: "Fetches a specific voivodeship by its ID.",
        tags: ["Voivodeships"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "ID of the voivodeship",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Voivodeship details",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "id", type: "integer", example: 1),
                        new OA\Property(property: "name", type: "string", example: "Mazowieckie"),
                    ]
                )
            ),
            new OA\Response(
                response: Response::HTTP_NOT_FOUND,
                description: "Voivodeship not found",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Resource not found.")
                    ]
                )
            ),
            new OA\Response(
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
                description: "Server error"
            )
        ]
    )]
    public function getVoivodeshipById(int $voivodeshipId): JsonResponse
    {
        $voivodeship = Voivodeship::findOrFail($voivodeshipId);

        return $this->sendResponse($voivodeship, 'Voivodeship by id.');
    }
}
