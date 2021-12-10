<?php

namespace App\Interfaces;

interface EventRepositoryInterface
{
    public function getLatestEvents();
    public function getFeaturedEvents();
    public function getEventsCount();
    public function getFeaturedEventsCount();
    public function getFreeEventsCount();
}
