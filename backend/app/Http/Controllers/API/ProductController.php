<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class ProductController extends BaseController
{
    /**
     * Get all products
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Get(
    path: "/api/products",
    summary: "Get all products",
    description: "Fetches a list of all products, including their associated aid categories and product categories.",
    tags: ["Products"],
    responses: [
        new OA\Response(
            response: 200,
            description: "List of all products",
            content: new OA\JsonContent(
                type: "array",
                items: new OA\Items(ref: "#/components/schemas/Product")
            )
        ),
        new OA\Response(
            response: 500,
            description: "Internal server error"
        )
    ]
)]
    public function getProducts(): JsonResponse
    {
        $products = Product::with('aidCategory', 'productCategory')->get();

        return $this->sendResponse($products, 'All products.');
    }

    /**
     * Get product by id
     *
     * @return \Illuminate\Http\Response
     */
    
    public function getProductById(int $productId): JsonResponse
    {
        $product = Product::with('aidCategory', 'productCategory')->findOrFail($productId);

        return $this->sendResponse($product, 'Product by id.');
    }

    /**
     * Create product
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Post(
        path: "/api/products/create",
        summary: "Create product",
        description: "Creates a new product with provided data.",
        tags: ["Products"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                type: "object",
                required: ["name", "aid_category_id"],
                properties: [
                    new OA\Property(property: "name", type: "string", description: "Product name", example: "Product Name"),
                    new OA\Property(property: "description", type: "string", description: "Product description", example: "This is a description of the product"),
                    new OA\Property(property: "aid_category_id", type: "integer", description: "ID of the aid category", example: 1),
                    new OA\Property(property: "product_category_id", type: "integer", description: "ID of the product category (optional)", example: 2)
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: Response::HTTP_CREATED,
                description: "Product created successfully",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Product created successfully."),
                        new OA\Property(property: "product", type: "object", properties: [
                            new OA\Property(property: "id", type: "integer", example: 1),
                            new OA\Property(property: "name", type: "string", example: "Product Name"),
                            new OA\Property(property: "description", type: "string", example: "Product description"),
                            new OA\Property(property: "aid_category_id", type: "integer", example: 1),
                            new OA\Property(property: "product_category_id", type: "integer", example: 2)
                        ])
                    ]
                )
            ),
            new OA\Response(
                response: Response::HTTP_UNPROCESSABLE_ENTITY,
                description: "Validation failed",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Validation failed."),
                        new OA\Property(property: "errors", type: "object")
                    ]
                )
            ),
            new OA\Response(
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
                description: "Server error"
            )
        ]
    )]
    public function createProduct(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
                'description' => 'nullable',
                'aid_category_id' => 'required|exists:aid_categories,id',
                'product_category_id' => 'nullable|exists:product_categories,id',
            ]);

            $product = Product::create($validated);

            return $this->sendResponse($product, 'Product created successfully.', 201);
        } catch (ValidationException $exception) {
            return $this->sendError('Validation failed.', $exception->validator->errors());
        }
    }

    /**
     * Update product by id
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Patch(
        path: "/api/products/{id}/update",
        summary: "Update product by ID",
        description: "Updates an existing product's details by product ID.",
        tags: ["Products"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "ID of the product to update",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                type: "object",
                properties: [
                    new OA\Property(property: "name", type: "string", description: "Product name", example: "Updated Product Name"),
                    new OA\Property(property: "description", type: "string", description: "Product description", example: "Updated description of the product"),
                    new OA\Property(property: "aid_category_id", type: "integer", description: "ID of the aid category", example: 1),
                    new OA\Property(property: "product_category_id", type: "integer", description: "ID of the product category", example: 2)
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Product updated successfully",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Updated product."),
                        new OA\Property(property: "product", type: "object", properties: [
                            new OA\Property(property: "id", type: "integer", example: 1),
                            new OA\Property(property: "name", type: "string", example: "Updated Product Name"),
                            new OA\Property(property: "description", type: "string", example: "Updated description of the product"),
                            new OA\Property(property: "aid_category_id", type: "integer", example: 1),
                            new OA\Property(property: "product_category_id", type: "integer", example: 2)
                        ])
                    ]
                )
            ),
            new OA\Response(
                response: Response::HTTP_NOT_FOUND,
                description: "Product not found",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Resource not found.")
                    ]
                )
            ),
            new OA\Response(
                response: Response::HTTP_UNPROCESSABLE_ENTITY,
                description: "Validation failed",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Validation failed."),
                        new OA\Property(property: "errors", type: "object")
                    ]
                )
            ),
            new OA\Response(
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
                description: "Server error"
            )
        ]
    )]
    public function updateProductById(Request $request, int $productId): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required',
            'description' => 'sometimes|nullable',
            'aid_category_id' => 'sometimes|required|exists:aid_categories,id',
            'product_category_id' => 'sometimes|nullable|exists:product_categories,id',
        ]);

        $product = Product::with('aidCategory', 'productCategory')->findOrFail($productId);

        $product->update($validated);

        return $this->sendResponse($product, 'Updated product.');
    }

    /**
     * Delete product by id
     *
     * @return \Illuminate\Http\Response
     */
    #[OA\Delete(
        path: "/api/products/{id}/delete",
        summary: "Delete product by ID",
        description: "Deletes a specific product by its ID.",
        tags: ["Products"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "ID of the product to delete",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Product deleted successfully",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Product deleted successfully."),
                        new OA\Property(property: "product", type: "object", properties: [
                            new OA\Property(property: "id", type: "integer", example: 1),
                            new OA\Property(property: "name", type: "string", example: "Product Name"),
                            new OA\Property(property: "description", type: "string", example: "Product description"),
                            new OA\Property(property: "aid_category_id", type: "integer", example: 1),
                            new OA\Property(property: "product_category_id", type: "integer", example: 2)
                        ])
                    ]
                )
            ),
            new OA\Response(
                response: Response::HTTP_NOT_FOUND,
                description: "Product not found",
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
    public function deleteProductById(int $productId): JsonResponse
    {
        $product = Product::with('aidCategory', 'productCategory')->findOrFail($productId);

        $product->delete();

        return $this->sendResponse($product, 'Product deleted successfully.');
    }
}
