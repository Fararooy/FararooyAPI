<?php

namespace App\Enums\Events;

use Illuminate\Validation\Rules\Enum;

class EventStatus extends Enum
{
    public const NOT_STARTED = 'not started';
    public const OPEN = 'open';
    public const CLOSED = 'closed';
}
