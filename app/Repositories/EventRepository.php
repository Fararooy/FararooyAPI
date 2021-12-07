<?php

namespace App\Repositories;

use App\Interfaces\EventRepositoryInterface;
use App\Models\Event;

class EventRepository implements EventRepositoryInterface
{
    public function getLatestEvents()
    {
        return Event::with([
            'categories',
            'eventTimeSlots',
            'images',
            'featuredImage',
        ])->orderByDesc('created_at')
            ->limit(10)
            ->get();
    }
}
