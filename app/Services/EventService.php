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
}
