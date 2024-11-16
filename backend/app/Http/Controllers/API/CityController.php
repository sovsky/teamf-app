<?php

namespace App\Http\Controllers\API;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class CityController extends BaseController
{
    /**
     * Get all cities
     *
     * @return \Illuminate\Http\Response
     */
    public function getCities(): JsonResponse
    {
        $cities = City::all();

        return $this->sendResponse($cities, 'All cities.');
    }

    /**
     * Get city by id
     *
     * @return \Illuminate\Http\Response
     */
    public function getCityById(int $cityId): JsonResponse
    {
        $city = City::findOrFail($cityId);

        return $this->sendResponse($city, 'City by id.');
    }

    /**
     * Get cities by commune
     *
     * @return \Illuminate\Http\Response
     */
    public function getCitiesByCommune(int $communeId): JsonResponse
    {
        $cities = City::where('commune_id', $communeId)->get();

        return $this->sendResponse($cities, 'Cities by commune.');
    }
}
