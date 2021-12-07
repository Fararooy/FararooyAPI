<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventImage extends Model
{
    use HasFactory;

    protected $hidden = [
        'event_id',
        'featured',
        'deleted_at',
        'updated_at',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
