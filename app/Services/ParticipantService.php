<?php

namespace App\Services;

use App\Interfaces\ParticipantRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ParticipantService
{
    protected ParticipantRepositoryInterface $participantRepository;

    public function __construct(ParticipantRepositoryInterface $participantRepository)
    {
        $this->participantRepository = $participantRepository;
    }

    public function register(int $eventId, int $userId): Model
    {
        return $this->participantRepository->register($eventId, $userId);
    }

    public function deregister(int $eventId, int $userId): bool
    {
        return $this->participantRepository->deregister($eventId, $userId);
    }
}
