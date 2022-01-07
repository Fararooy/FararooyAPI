<?php

namespace App\Models;

use App\Casts\DateTime\JalaliDateCast;
use App\Casts\DateTime\JalaliDateTimeCast;
use App\Casts\Digits\PersianDigitCast;
use App\Enums\Events\EventStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use JWTAuth;

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

    protected $appends = [
        'status',
        'user_registered_for_event',
    ];

    public function getStatusAttribute()
    {
        $startDate = Carbon::createFromDate($this->attributes['start_date']);
        $endDate = Carbon::createFromDate($this->attributes['end_date']);
        $now = Carbon::now();

        if ($endDate < $now) {
            return EventStatus::CLOSED;
        }

        if ($startDate > $now) {
            return EventStatus::NOT_STARTED;
        }

        if ($startDate < $now && $endDate > $now) {
            return EventStatus::OPEN;
        }
    }

    public function getUserRegisteredForEventAttribute(): bool
    {
        try {
            $authUser = JWTAuth::parseToken()->authenticate();
            $participant = $this->participants()
                ->where('participants.user_id', '=', $authUser->id)
                ->count();
            return $participant === 1;
        } catch (\Exception $e) {
            return false;
        }
     }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'participants');
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
