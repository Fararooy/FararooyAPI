<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Event extends Model
{
    use HasFactory;

    protected $hidden = ['user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function eventParticipants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    public function eventTimeSlots(): HasMany
    {
        return $this->hasMany(EventTimeSlot::class);
    }

    public function eventCategories(): HasMany
    {
        return $this->hasMany(EventCategory::class);
    }

    public function city(): HasOne
    {
        return $this->hasOne(City::class);
    }

    public function categories(): HasManyThrough
    {
        return $this->hasManyThrough(
            Category::class,
            EventCategory::class,
            'event_id',
            'id'
        );
    }

    public function images(): HasMany
    {
        return $this->hasMany(EventImage::class)
            ->where('deleted_at', null);
    }

    public function featuredImage(): HasOne
    {
        return $this->hasOne(EventImage::class)
            ->where('featured', true)
            ->where('deleted_at', null);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(EventReview::class)
            ->where('deleted_at', null);
    }
}
