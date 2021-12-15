<?php

namespace App\Enums\Messages\Events;

use Illuminate\Validation\Rules\Enum;

class Exceptions extends Enum
{
    public const EVENT_NOT_FOUND = 'Event not found';
}
