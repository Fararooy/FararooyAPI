<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface CityRepositoryInterface
{
    public function getAllCities(): Collection;
}
