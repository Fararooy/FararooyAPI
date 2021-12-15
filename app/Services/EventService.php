<?php

namespace App\Services;

use App\Interfaces\EventRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class EventService
{
    private EventRepositoryInterface $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function getAllEvents(): LengthAwarePaginator
    {
        return $this->eventRepository->getAllEvents();
    }

    public function getEvent(int $eventId): Model
    {
        return $this->eventRepository->getEvent($eventId);
    }

    public function getLatestEvents(): Collection
    {
        return $this->eventRepository->getLatestEvents();
    }

    public function getFeaturedEvents(): Collection
    {
        return $this->eventRepository->getFeaturedEvents();
    }

    public function getEventsCount(): int
    {
        return $this->eventRepository->getEventsCount();
    }

    public function getFeaturedEventsCount(): int
    {
        return $this->eventRepository->getFeaturedEventsCount();
    }

    public function getFreeEventsCount(): int
    {
        return $this->eventRepository->getFreeEventsCount();
    }
}
