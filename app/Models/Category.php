<?php

namespace App\Models;

use App\Casts\Digits\PersianDigitCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'parent',
        'laravel_through_key',
        'pivot',
    ];

    protected $casts = [
        'events_count' => PersianDigitCast::class,
    ];

    public function eventCategories(): HasMany
    {
        return $this->hasMany(EventCategory::class);
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_categories');
    }
}
