<?php

namespace App\Services;

use App\Interfaces\EventRepositoryInterface;

class EventService
{
    private EventRepositoryInterface $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function getLatestEvents()
    {
        return $this->eventRepository->getLatestEvents();
    }

    public function getFeaturedEvents()
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
