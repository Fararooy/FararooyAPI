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
            'featuredCategory',
            'images',
            'featuredImage',
            'city',
            'eventTimeSlots',
        ])->where('featured', '=', 0)
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();
    }

    public function getFeaturedEvents()
    {
        return Event::with([
            'categories',
            'featuredCategory',
            'images',
            'featuredImage',
            'city',
            'eventTimeSlots',
        ])->where('featured', '=', 1)
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();
    }

    public function getEventsCount(): int
    {
        return Event::all()->count();
    }

    public function getFeaturedEventsCount(): int
    {
        return Event::where('featured', '=', 1)->count();
    }

    public function getFreeEventsCount(): int
    {
        return Event::where('price', '=', 0)
            ->orWhere('price', '=', null)
        ->count();
    }
}
