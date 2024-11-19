<?php

namespace App\Http\Controllers\API;

use App\Models\Voivodeship;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class VoivodeshipController extends BaseController
{
    /**
     * Get all voivodeships
     *
     * @return \Illuminate\Http\Response
     */
    public function getVoivodeships(): JsonResponse
    {
        $voivodeships = Voivodeship::all();

        return $this->sendResponse($voivodeships, 'All voivodesihps.');
    }

    /**
     * Get voivodeship by id
     *
     * @return \Illuminate\Http\Response
     */
    public function getVoivodeshipById(int $voivodeshipId): JsonResponse
    {
        $voivodeship = Voivodeship::findOrFail($voivodeshipId);

        return $this->sendResponse($voivodeship, 'Voivodeship by id.');
    }
}
