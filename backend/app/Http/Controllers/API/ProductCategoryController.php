<?php

namespace App\Http\Controllers\API;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class ProductCategoryController extends BaseController
{
    /**
     * Get all product categories
     *
     * @return \Illuminate\Http\Response
     */
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
    public function getProductCategoryById(int $productCategoryId): JsonResponse
    {
        $productCategory = ProductCategory::find($productCategoryId);

        if (is_null($productCategory)) return $this->sendError('Product category not found.');

        return $this->sendResponse($productCategory, 'Product category by id.');
    }

    /**
     * Update product category by id
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProductCategoryById(Request $request, int $productCategoryId): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required',
        ]);

        $productCategory = ProductCategory::find($productCategoryId);

        if (is_null($productCategory)) return $this->sendError('Product category not found.');

        $productCategory->update($validated);

        return $this->sendResponse($productCategory, 'Updated product category.');
    }

    /**
     * Delete product category by id
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteProductCategoryById(int $productCategoryId): JsonResponse
    {
        $productCategory = ProductCategory::find($productCategoryId);

        if (is_null($productCategory)) return $this->sendError('Product category not found.');

        $productCategory->delete();

        return $this->sendResponse($productCategory, 'Product category deleted successfully.');
    }

    /**
     * Create product category
     *
     * @return \Illuminate\Http\Response
     */
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
}
