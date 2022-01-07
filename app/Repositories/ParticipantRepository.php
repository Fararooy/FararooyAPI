<?php

namespace App\Repositories;

use App\Interfaces\ParticipantRepositoryInterface;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Model;

class ParticipantRepository implements ParticipantRepositoryInterface
{
    public function register(int $eventId, int $userId): Model
    {
        return Participant::firstOrCreate([
            'event_id' => $eventId,
            'user_id' => $userId,
        ]);
    }

    public function deregister(int $eventId, int $userId): bool
    {
        return Participant::where('event_id', '=', $eventId)
            ->where('user_id', '=', $userId)
            ->delete();
    }
}
