<?php

namespace App\Interfaces;

interface EventRepositoryInterface
{
    public function getLatestEvents();
    public function getFeaturedEvents();
}
