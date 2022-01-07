<?php

namespace App\Repositories;

use App\Interfaces\EventRepositoryInterface;
use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class EventRepository implements EventRepositoryInterface
{
    public function getEvent(int $eventId): Model
    {
        return $this->getEventQueryBuilder()
            ->where('id', '=', $eventId)
            ->first();
    }

    public function getLatestEvents(): Collection
    {
        return $this->getEventQueryBuilder()
            ->where('featured', '=', 0)
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();
    }

    public function getFeaturedEvents(): Collection
    {
        return $this->getEventQueryBuilder()
            ->where('featured', '=', 1)
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

    public function getAllEvents(): LengthAwarePaginator
    {
        return $this->getEventQueryBuilder()
            ->paginate(10);
    }

    private function getEventQueryBuilder(): Builder
    {
        return Event::with([
            'categories',
            'featuredCategory',
            'images',
            'featuredImage',
            'city',
            'eventTimeSlots',
        ])
            ->withCount([
                'participants',
                'reviews',
                'categories',
            ]);
    }
}
