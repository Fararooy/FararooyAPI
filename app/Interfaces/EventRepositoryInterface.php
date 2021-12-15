<?php

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EventRepositoryInterface
{
    public function getEvent(int $eventId): Model;
    public function getAllEvents(): LengthAwarePaginator;
    public function getLatestEvents(): Collection;
    public function getFeaturedEvents(): Collection;
    public function getEventsCount(): int;
    public function getFeaturedEventsCount(): int;
    public function getFreeEventsCount(): int;
}
