<?php

namespace App\Http\Controllers\API;

use App\Models\ProductCategory;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\MediaType;
use OpenApi\Attributes\RequestBody;

class ProductCategoryController extends BaseController
{
    /**
     * Get all product categories
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Get(
        path: "/api/product-categories",
        summary: "Retrieve all product categories",
        tags: ["Product Categories"],
        responses: [
            new OA\Response(
                response: 200,
                description: "List of all product categories",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 1),
                            new OA\Property(property: "name", type: "string", example: "Electronics"),
                            new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2024-09-22T10:20:30Z"),
                            new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2024-09-23T15:30:45Z")
                        ]
                    )
                )
            ),
            new OA\Response(response: 500, description: "Server Error")
        ]
    )]
    public function getProductCategories(): JsonResponse
    {
        $productCategories = ProductCategory::all();

        return $this->sendResponse($productCategories, 'All product categories.');
    }

    /**
     * Get product category by id
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Get(
        path: "/api/product-categories/{id}",
        summary: "Retrieve a product category by its ID",
        tags: ["Product Categories"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, description: "Product Category ID", schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Product category details",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "id", type: "integer", example: 2),
                        new OA\Property(property: "name", type: "string", example: "Clothing"),
                        new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2024-09-25T11:15:00Z"),
                        new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2024-09-26T17:45:00Z")
                    ]
                )
            ),
            new OA\Response(response: 404, description: "Product category not found"),
            new OA\Response(response: 500, description: "Server Error")
        ]
    )]
    public function getProductCategoryById(int $productCategoryId): JsonResponse
    {
        $productCategory = ProductCategory::findOrFail($productCategoryId);

        return $this->sendResponse($productCategory, 'Product category by id.');
    }

    /**
     * Create product category
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Post(
        path: "/api/product-categories/create",
        summary: "Create a new product category",
        tags: ["Product Categories"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "name", type: "string", example: "Books")
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "Product category created successfully"),
            new OA\Response(response: 422, description: "Validation failed"),
            new OA\Response(response: 500, description: "Server Error")
        ]
    )]
    public function createProductCategory(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required'
            ]);

            $productCategory = ProductCategory::create($validated);

            return $this->sendResponse($productCategory, 'Product category created successfully.', 201);
        } catch (ValidationException $exception) {
            return $this->sendError('Validation failed.', $exception->validator->errors());
        }
    }

    /**
     * Update product category by id
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Patch(
        path: "/api/product-categories/{id}/update",
        summary: "Update a product category by its ID",
        tags: ["Product Categories"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, description: "Product Category ID", schema: new OA\Schema(type: "integer"))
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "name", type: "string", example: "Updated Category")
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Product category updated successfully"),
            new OA\Response(response: 404, description: "Product category not found"),
            new OA\Response(response: 422, description: "Validation failed"),
            new OA\Response(response: 500, description: "Server Error")
        ]
    )]
    public function updateProductCategoryById(Request $request, int $productCategoryId): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required',
        ]);

        $productCategory = ProductCategory::findOrFail($productCategoryId);

        $productCategory->update($validated);

        return $this->sendResponse($productCategory, 'Updated product category.');
    }

    /**
     * Delete product category by id
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Delete(
        path: "/api/product-categories/{id}/delete",
        summary: "Delete a product category by its ID",
        tags: ["Product Categories"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, description: "Product Category ID", schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200, description: "Product category deleted successfully"),
            new OA\Response(response: 404, description: "Product category not found"),
            new OA\Response(response: 500, description: "Server Error")
        ]
    )]
    public function deleteProductCategoryById(int $productCategoryId): JsonResponse
    {
        $productCategory = ProductCategory::findOrFail($productCategoryId);

        $productCategory->delete();

        return $this->sendResponse($productCategory, 'Product category deleted successfully.');
    }
}
