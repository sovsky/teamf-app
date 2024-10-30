<?php

namespace App\Http\Controllers\API;

use App\Models\AidCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class AidCategoryController extends BaseController
{
    /**
     * Get all aidCategories
     *
     * @return \Illuminate\Http\Response
     */
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
