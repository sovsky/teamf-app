<?php

namespace App\Http\Controllers\API;

use App\Models\AidCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\MediaType;
use OpenApi\Attributes\RequestBody;

class AidCategoryController extends BaseController
{
    /**
     * Get all aidCategories
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Get(
        path: "/api/aid-categories",
        summary: "Retrieve all aid categories",
        tags: ["Aid Categories"],
        responses: [
            new OA\Response(
                response: 200,
                description: "List of all aid categories",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 1),
                            new OA\Property(property: "name", type: "string", example: "Emergency Aid"),
                            new OA\Property(property: "aid_type_id", type: "integer", example: 2),
                            new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2024-09-22T10:20:30Z"),
                            new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2024-09-23T15:30:45Z")
                        ]
                    )
                )
            ),
            new OA\Response(response: 500, description: "Server Error")
        ]
    )]
    public function getAidCategories(): JsonResponse
    {
        $aidCategories = AidCategory::with('aidType')->get();

        return $this->sendResponse($aidCategories, 'All aid categories.');
    }

    /**
     * Get aid category by id
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Get(
        path: "/api/aid-categories/{id}",
        summary: "Retrieve an aid category by its ID",
        tags: ["Aid Categories"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, description: "Aid category ID", schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Aid category details",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "id", type: "integer", example: 1),
                        new OA\Property(property: "name", type: "string", example: "Emergency Aid"),
                        new OA\Property(property: "aid_type_id", type: "integer", example: 2)
                    ]
                )
            ),
            new OA\Response(response: 404, description: "Aid category not found"),
            new OA\Response(response: 500, description: "Server Error")
        ]
    )]
    public function getAidCategoryById(int $aidCategoryId): JsonResponse
    {
        $aidCategory = AidCategory::with('aidType')->findOrFail($aidCategoryId);


        return $this->sendResponse($aidCategory, 'Aid category by id.');
    }

    /**
     * Update aid category by id
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Put(
        path: "/api/aid-categories/{id}/update",
        summary: "Update an aid category by ID",
        tags: ["Aid Categories"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, description: "Aid category ID", schema: new OA\Schema(type: "integer"))
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "name", type: "string", example: "Updated Aid Category"),
                    new OA\Property(property: "aid_type_id", type: "integer", example: 3)
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Aid category updated successfully"),
            new OA\Response(response: 404, description: "Aid category not found"),
            new OA\Response(response: 400, description: "Validation error")
        ]
    )]

    public function updateAidCategoryById(Request $request, int $aidCategoryId): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required',
            'aid_type_id' => 'sometimes|required|exists:aid_types,id',
        ]);

        $aidCategory = AidCategory::with('aidType')->findOrFail($aidCategoryId);


        $aidCategory->update($validated);

        return $this->sendResponse($aidCategory, 'Updated aid category.');
    }

    /**
     * Delete aid category by id
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Delete(
        path: "/api/aid-categories/{id}/delete",
        summary: "Delete an aid category by ID",
        tags: ["Aid Categories"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, description: "Aid category ID", schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200, description: "Aid category deleted successfully"),
            new OA\Response(response: 404, description: "Aid category not found")
        ]
    )]
    public function deleteAidCategoryById(int $aidCategoryId): JsonResponse
    {
        $aidCategory = AidCategory::with('aidType')->findOrFail($aidCategoryId);

        $aidCategory->delete();

        return $this->sendResponse($aidCategory, 'Aid category deleted successfully.');
    }

    /**
     * Create aid category
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Post(
        path: "/api/aid-categories/create",
        summary: "Create a new aid category",
        tags: ["Aid Categories"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "name", type: "string", example: "New Aid Category"),
                    new OA\Property(property: "aid_type_id", type: "integer", example: 4)
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "Aid category created successfully"),
            new OA\Response(response: 400, description: "Validation error")
        ]
    )]
    public function createAidCategory(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
                'aid_type_id' => 'required|exists:aid_types,id',
            ]);

            $aidCategory = AidCategory::create($validated);

            return $this->sendResponse($aidCategory, 'Aid category created successfully.', 201);
        } catch (ValidationException $exception) {
            return $this->sendError('Validation failed.', $exception->validator->errors());
        }
    }
}
