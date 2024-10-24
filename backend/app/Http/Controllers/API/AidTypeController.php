<?php

namespace App\Http\Controllers\API;

use App\Models\AidType;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class AidTypeController extends BaseController
{
    /**
     * Get all aid types
     *
     * @return \Illuminate\Http\Response
     */
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
    public function getAidTypeById(int $aidTypeId): JsonResponse
    {
        $aidType = AidType::find($aidTypeId);

        if (is_null($aidType)) return $this->sendError('Aid type not found.');

        return $this->sendResponse($aidType, 'Aid type by id.');
    }

    /**
     * Update aid type by id
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAidTypeById(Request $request, int $aidTypeId): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required',
        ]);

        $aidType = AidType::find($aidTypeId);

        if (is_null($aidType)) return $this->sendError('Aid type not found.');

        $aidType->update($validated);

        return $this->sendResponse($aidType, 'Updated aid type.');
    }

    /**
     * Delete aid type by id
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAidTypeById(int $aidTypeId): JsonResponse
    {
        $aidType = AidType::find($aidTypeId);

        if (is_null($aidType)) return $this->sendError('Aid type not found.');

        $aidType->delete();

        return $this->sendResponse($aidType, 'Aid type deleted successfully.');
    }

    /**
     * Create aid type
     *
     * @return \Illuminate\Http\Response
     */
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
