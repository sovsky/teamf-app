<?php

namespace App\Http\Controllers\API;

use App\Models\Commune;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class CommuneController extends BaseController
{
    /**
     * Get all communes
     *
     * @return \Illuminate\Http\Response
     */
    public function getCommunes(): JsonResponse
    {
        $communes = Commune::all();

        return $this->sendResponse($communes, 'All communes.');
    }

    /**
     * Get commune by id
     *
     * @return \Illuminate\Http\Response
     */
    public function getCommuneById(int $communeId): JsonResponse
    {
        $commune = Commune::findOrFail($communeId);

        return $this->sendResponse($commune, 'Commune by id.');
    }

    /**
     * Get communes by district
     *
     * @return \Illuminate\Http\Response
     */
    public function getCommunesByDistrict(int $districtId): JsonResponse
    {
        $communes = Commune::where('district_id', $districtId)->get();

        return $this->sendResponse($communes, 'Communes by district.');
    }
}
