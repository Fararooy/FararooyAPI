<?php

namespace App\Repositories;

use App\Interfaces\FavouriteEventInterface;
use App\Models\FavouriteEvent;

class FavouriteEventRepository implements FavouriteEventInterface
{

    public function addToFavourites(int $userId, int $eventId): bool
    {
        return FavouriteEvent::firstOrCreate([
            'user_id'  => $userId,
            'event_id' => $eventId,
        ]);
    }
}
