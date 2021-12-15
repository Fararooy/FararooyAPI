<?php

namespace App\Exceptions\Events;

use App\Enums\Messages\Events\Exceptions;

class EventNotFound extends \Exception
{
    public function __construct($message = Exceptions::EVENT_NOT_FOUND, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
