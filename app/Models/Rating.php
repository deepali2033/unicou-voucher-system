<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';

    protected $fillable = [
        'rater_id',
        'ratee_id',
        'stars',
        'review_text',
        'review_title',
        'experience_date',
        'job_id',
        'booking_id',
        'ip_address',
    ];

    protected $casts = [
        'stars' => 'integer',
        'experience_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user who made the rating (rater)
     */
    public function rater()
    {
        return $this->belongsTo(User::class, 'rater_id');
    }

    /**
     * Get the user being rated (ratee)
     */
    public function ratee()
    {
        return $this->belongsTo(User::class, 'ratee_id');
    }

    /**
     * Get the job associated with this rating (if any)
     */
    public function job()
    {
        return $this->belongsTo(JobListing::class, 'job_id');
    }

    /**
     * Get the booking associated with this rating (if any)
     */
    public function booking()
    {
        return $this->belongsTo(BookService::class, 'booking_id');
    }

    /**
     * Get average rating for a user
     */
    public static function getAverageRating($userId)
    {
        return self::where('ratee_id', $userId)->average('stars') ?? 0;
    }

    /**
     * Get total ratings count for a user
     */
    public static function getRatingsCount($userId)
    {
        return self::where('ratee_id', $userId)->count();
    }

    /**
     * Get rating breakdown (stars distribution)
     */
    public static function getRatingBreakdown($userId)
    {
        $breakdown = [];
        for ($i = 5; $i >= 1; $i--) {
            $breakdown[$i] = self::where('ratee_id', $userId)
                ->where('stars', $i)
                ->count();
        }

        return $breakdown;
    }
}
