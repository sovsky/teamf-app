<?php

namespace App\Repositories;

use App\Models\City;
use Illuminate\Support\Collection;

class CityRepository
{
    public function searchCities(string $cityName, int $limit = 20): Collection
    {
        return City::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($cityName) . '%'])
                    ->limit(20)
                    ->get();
    }
}