<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Notification;

class JobApplication extends Model
{
    protected $fillable = [
        'candidate_id',
        'job_listing_id',
        'freelancer_id',
        'recruiter_id',
        'status',
        'recruiter_notified',
        'admin_notified',
        'recruiter_notified_at',
        'admin_notified_at',
        'application_notes',
    ];

    protected $casts = [
        'recruiter_notified' => 'boolean',
        'admin_notified' => 'boolean',
        'recruiter_notified_at' => 'datetime',
        'admin_notified_at' => 'datetime',
    ];

    // Relationships
    public function candidate(): BelongsTo
    {
        return $this->belongsTo(Candidate::class);
    }

    public function jobListing(): BelongsTo
    {
        return $this->belongsTo(JobListing::class);
    }

    public function freelancer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    public function recruiter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recruiter_id');
    }

    // Scopes
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeForRecruiter($query, $recruiterId)
    {
        return $query->where('recruiter_id', $recruiterId);
    }

    public function scopeForFreelancer($query, $freelancerId)
    {
        return $query->where('freelancer_id', $freelancerId);
    }

    // Methods
    public function notifyRecruiter(): bool
    {
        if (!$this->recruiter_notified) {
            // Here you would implement actual notification logic
            // For testing purposes, we'll just mark as notified
            $this->recruiter_notified = true;
            $this->recruiter_notified_at = now();
            return $this->save();
        }
        return true;
    }

    public function notifyAdmin(): bool
    {
        if (!$this->admin_notified) {
            // Here you would implement actual notification logic
            // For testing purposes, we'll just mark as notified
            $this->admin_notified = true;
            $this->admin_notified_at = now();
            return $this->save();
        }
        return true;
    }

    public function notifyAll(): bool
    {
        return $this->notifyRecruiter() && $this->notifyAdmin();
    }

    public static function getStatuses(): array
    {
        return [
            'pending' => 'Pending',
            'under_review' => 'Under Review',
            'interview_scheduled' => 'Interview Scheduled',
            'selected' => 'Selected',
            'rejected' => 'Rejected'
        ];
    }

    public function getStatusBadgeAttribute(): string
    {
        $badges = [
            'pending' => 'badge-warning',
            'under_review' => 'badge-info',
            'interview_scheduled' => 'badge-primary',
            'selected' => 'badge-success',
            'rejected' => 'badge-danger'
        ];

        return $badges[$this->status] ?? 'badge-secondary';
    }
}
