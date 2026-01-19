<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'type',
        'action',
        'related_id',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope to get unread notifications
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope to get read notifications
     */
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }

    /**
     * Mark notification as unread
     */
    public function markAsUnread()
    {
        $this->update(['is_read' => false]);
    }

    /**
     * Get the icon based on notification type
     */
    public function getIconAttribute()
    {
        return match($this->type) {
            'user' => 'fas fa-user',
            'service' => 'fas fa-broom',
            'job' => 'fas fa-briefcase',
            'plan' => 'fas fa-wallet',
            'subscription' => 'fas fa-envelope',
            'quote' => 'fas fa-comment-alt',
            'contact' => 'fas fa-phone',
            'book_service' => 'fas fa-calendar-check',
            'booking' => 'fas fa-calendar-check',
            default => 'fas fa-bell',
        };
    }

    /**
     * Get the badge color based on notification type
     */
    public function getBadgeColorAttribute()
    {
        return match($this->type) {
            'user' => 'bg-primary',
            'service' => 'bg-info',
            'job' => 'bg-success',
            'plan' => 'bg-warning',
            'subscription' => 'bg-success',
            'quote' => 'bg-primary',
            'contact' => 'bg-info',
            'book_service' => 'bg-warning',
            'booking' => 'bg-warning',
            default => 'bg-secondary',
        };
    }

    /**
     * Get the action URL for the notification
     */
    public function getActionUrlAttribute()
    {
        return $this->action;
    }

    /**
     * Get the user that owns the notification
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
