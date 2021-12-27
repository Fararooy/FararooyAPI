<?php

namespace App\Services;

use App\Interfaces\CityRepositoryInterface;
use Illuminate\Support\Collection;

class CityService
{
    protected CityRepositoryInterface $cityRepository;

    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function getAllCities(): Collection
    {
        return $this->cityRepository->getAllCities();
    }
}
