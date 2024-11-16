<?php

namespace App\Http\Controllers\API;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class DistrictController extends BaseController
{
    /**
     * Get all districts
     *
     * @return \Illuminate\Http\Response
     */
    public function getDistricts(): JsonResponse
    {
        $districts = District::all();

        return $this->sendResponse($districts, 'All districts.');
    }

    /**
     * Get district by id
     *
     * @return \Illuminate\Http\Response
     */
    public function getDistrictById(int $districtId): JsonResponse
    {
        $district = District::findOrFail($districtId);

        return $this->sendResponse($district, 'District by id.');
    }

    /**
     * Get districts by voivodeship
     *
     * @return \Illuminate\Http\Response
     */
    public function getDistrictsByVoivodeship(int $voivodeshipId): JsonResponse
    {
        $districts = District::where('voivodeship_id', $voivodeshipId)->get();

        return $this->sendResponse($districts, 'Districts by voivodeship.');
    }
}
