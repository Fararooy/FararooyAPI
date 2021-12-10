<?php

namespace App\Services;

class StatisticsService
{
    private EventService $eventService;

    private UserService $userService;

    public function __construct(
        EventService $eventService,
        UserService $userService
    )
    {
        $this->eventService = $eventService;
        $this->userService = $userService;
    }

    public function getMainPageStatistics(): array
    {
        return [
            'events_count' => $this->eventService->getEventsCount(),
            'featured_events_count' => $this->eventService->getFeaturedEventsCount(),
            'free_events_count' => $this->eventService->getFreeEventsCount(),
            'users_count' => $this->userService->getUsersCount(),
        ];
    }
}
