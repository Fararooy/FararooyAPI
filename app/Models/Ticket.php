<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }

    public function eventPayments(): HasMany
    {
        return $this->hasMany(EventPayment::class);
    }
}
