<?php

namespace App\Interfaces;

interface FavouriteEventInterface
{
    public function addToFavourites(int $userId, int $eventId): bool;
}
