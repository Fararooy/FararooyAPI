<?php

namespace App\Models;

use App\Casts\DateTime\JalaliDateCast;
use App\Casts\DateTime\JalaliDateTimeCast;
use App\Casts\Digits\PersianDigitCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Event extends Model
{
    use HasFactory;

    protected $hidden = [
        'user_id',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'created_at_jalali' => JalaliDateTimeCast::class,
        'start_date_jalali' => JalaliDateCast::class,
        'end_date_jalali' => JalaliDateCast::class,
        'price' => PersianDigitCast::class,
        'capacity' => PersianDigitCast::class,
        'participant_count' => PersianDigitCast::class,
        'review_count' => PersianDigitCast::class,
    ];

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

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'event_categories');
    }

    public function featuredCategory(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'event_categories')
            ->where('event_categories.featured', true);
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
