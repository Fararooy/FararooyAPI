<?php

namespace App\Services;

use App\Interfaces\FavouriteEventInterface;

class FavouriteEventService
{
    private FavouriteEventInterface $favouriteEventRepository;

    public function __construct(FavouriteEventInterface $favouriteEvent)
    {
        $this->favouriteEventRepository = $favouriteEvent;
    }

    public function addToFavourites(int $userId, int $eventId): bool
    {
        return $this->favouriteEventRepository->addToFavourites($userId, $eventId);
    }

    public function removeFromFavourites(int $userId, int $eventId): bool
    {
        return $this->favouriteEventRepository->removeFromFavourites($userId, $eventId);
    }
}
