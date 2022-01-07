<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface ParticipantRepositoryInterface
{
    public function register(int $eventId, int $userId): Model;
    public function deregister(int $eventId, int $userId): bool;
}
