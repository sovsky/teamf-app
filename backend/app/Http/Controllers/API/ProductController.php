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
     * Update product by id
     *
     * @return \Illuminate\Http\Response
     */
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
    public function deleteProductById(int $productId): JsonResponse
    {
        $product = Product::with('aidCategory', 'productCategory')->findOrFail($productId);

        $product->delete();

        return $this->sendResponse($product, 'Product deleted successfully.');
    }

    /**
     * Create product
     *
     * @return \Illuminate\Http\Response
     */
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
}
