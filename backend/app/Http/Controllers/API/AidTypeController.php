<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\AidType;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\MediaType;
use OpenApi\Attributes\RequestBody;

class AidTypeController extends BaseController
{
    /**
     * Get all aid types
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Get(
        path: "/api/aid-types",
        summary: "Retrieve all aid types",
        tags: ["Aid Types"],
        responses: [
            new OA\Response(
                response: 200,
                description: "List of all aid types",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 1),
                            new OA\Property(property: "name", type: "string", example: "Financial Aid"),
                            new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2024-09-22T10:20:30Z"),
                            new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2024-09-23T15:30:45Z")
                        ]
                    )
                )
            ),
            new OA\Response(response: 500, description: "Server Error")
        ]
    )]
    public function getAidTypes(): JsonResponse
    {
        $aidTypes = AidType::all();

        return $this->sendResponse($aidTypes, 'All aid types.');
    }

    /**
     * Get aid type by id
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Get(
        path: "/api/aid-types/{id}",
        summary: "Retrieve an aid type by its ID",
        tags: ["Aid Types"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, description: "Aid type ID", schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Aid type details",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "id", type: "integer", example: 1),
                        new OA\Property(property: "name", type: "string", example: "Financial Aid"),
                        new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2024-09-22T10:20:30Z"),
                        new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2024-09-23T15:30:45Z")
                    ]
                )
            ),
            new OA\Response(response: 404, description: "Aid type not found"),
            new OA\Response(response: 500, description: "Server Error")
        ]
    )]
    public function getAidTypeById(int $aidTypeId): JsonResponse
    {
        $aidType = AidType::findOrFail($aidTypeId);

        return $this->sendResponse($aidType, 'Aid type by id.');
    }

    /**
     * Update aid type by id
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Patch(
        path: "/api/aid-types/{id}/update",
        summary: "Update an aid type by ID",
        tags: ["Aid Types"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, description: "Aid type ID", schema: new OA\Schema(type: "integer"))
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "name", type: "string", example: "Updated Aid Type")
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Aid type updated successfully"),
            new OA\Response(response: 404, description: "Aid type not found"),
            new OA\Response(response: 400, description: "Validation error")
        ]
    )]
    public function updateAidTypeById(Request $request, int $aidTypeId): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required',
        ]);

        $aidType = AidType::findOrFail($aidTypeId);

        $aidType->update($validated);

        return $this->sendResponse($aidType, 'Updated aid type.');
    }

    /**
     * Delete aid type by id
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Delete(
        path: "/api/aid-types/{id}/delete",
        summary: "Delete an aid type by ID",
        tags: ["Aid Types"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, description: "Aid type ID", schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200, description: "Aid type deleted successfully"),
            new OA\Response(response: 404, description: "Aid type not found")
        ]
    )]
    public function deleteAidTypeById(int $aidTypeId): JsonResponse
    {
        $aidType = AidType::findOrFail($aidTypeId);

        $aidType->delete();

        return $this->sendResponse($aidType, 'Aid type deleted successfully.');
    }

    /**
     * Create aid type
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Post(
        path: "/api/aid-types/create",
        summary: "Create a new aid type",
        tags: ["Aid Types"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "name", type: "string", example: "New Aid Type")
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "Aid type created successfully"),
            new OA\Response(response: 400, description: "Validation error")
        ]
    )]
    public function createAidType(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required'
            ]);

            $aidType = AidType::create($validated);

            return $this->sendResponse($aidType, 'Aid type created successfully.', 201);
        } catch (ValidationException $exception) {
            return $this->sendError('Validation failed.', $exception->validator->errors());
        }
    }
}
