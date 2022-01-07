<?php

namespace App\Enums\Participants;

use Illuminate\Validation\Rules\Enum;

class ParticipantRegistrationStatus extends Enum
{
    public const PENDING = 'pending';
    public const REJECTED = 'rejected';
    public const REGISTERED = 'registered';
}
