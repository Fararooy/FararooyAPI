<?php

namespace App\Http\Controllers;

use App\Enums\APIResponseStatus;
use App\Services\StatisticsService;
use App\Traits\APIResponseTrait;

class StatisticsController extends Controller
{
    use APIResponseTrait;

    private StatisticsService $statisticsService;

    public function __construct(StatisticsService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    public function index()
    {
        try {
            return $this->generateAPIResponse(
                APIResponseStatus::SUCCESS,
                $this->statisticsService->getMainPageStatistics(),
                [],
                200
            );
        } catch (\Exception $e) {
            return $this->generateAPIResponse(
                APIResponseStatus::FAILURE,
                [],
                [$e->getMessage()],
                500
            );
        }

    }
}
