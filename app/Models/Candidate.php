<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Candidate extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip_code',
        'date_of_birth',
        'gender',
        'position_applied',
        'employment_type_preference',
        'expected_salary_min',
        'expected_salary_max',
        'expected_salary_type',
        'available_start_date',
        'work_experience',
        'education',
        'skills',
        'certifications',
        'resume_path',
        'cover_letter_path',
        'profile_photo_path',
        'additional_notes',
        'status',
        'is_active',
        'applied_at',
        'job_listing_id',
        'referral_source',
        'willing_to_relocate',
        'has_transportation',
        'background_check_consent'
    ];

    protected $casts = [
        'skills' => 'array',
        'is_active' => 'boolean',
        'willing_to_relocate' => 'boolean',
        'has_transportation' => 'boolean',
        'background_check_consent' => 'boolean',
        'expected_salary_min' => 'decimal:2',
        'expected_salary_max' => 'decimal:2',
        'date_of_birth' => 'date',
        'available_start_date' => 'date',
        'applied_at' => 'datetime'
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jobListing(): BelongsTo
    {
        return $this->belongsTo(JobListing::class);
    }

    public function jobApplication(): BelongsTo
    {
        return $this->belongsTo(JobApplication::class, 'id', 'candidate_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByPosition($query, $position)
    {
        return $query->where('position_applied', $position);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('applied_at', 'desc');
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getExpectedSalaryRangeAttribute()
    {
        if ($this->expected_salary_min && $this->expected_salary_max) {
            return '€' . number_format($this->expected_salary_min, 2) . ' - €' . number_format($this->expected_salary_max, 2) . ' EUR per ' . $this->expected_salary_type . ' | 🇳🇱 Netherlands (NL)';
        } elseif ($this->expected_salary_min) {
            return 'From €' . number_format($this->expected_salary_min, 2) . ' EUR per ' . $this->expected_salary_type . ' | 🇳🇱 Netherlands (NL)';
        }
        return 'Negotiable';
    }

    public function getStatusBadgeAttribute()
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

    // Static methods
    public static function getStatuses()
    {
        return [
            'pending' => 'Pending',
            'under_review' => 'Under Review',
            'interview_scheduled' => 'Interview Scheduled',
            'selected' => 'Selected',
            'rejected' => 'Rejected'
        ];
    }

    public static function getGenders()
    {
        return [
            'male' => 'Male',
            'female' => 'Female',
            'other' => 'Other',
            'prefer_not_to_say' => 'Prefer not to say'
        ];
    }

    public static function getEmploymentTypePreferences()
    {
        return [
            'full-time' => 'Full Time',
            'part-time' => 'Part Time',
            'contract' => 'Contract',
            'temporary' => 'Temporary'
        ];
    }

    public static function getSalaryTypes()
    {
        return [
            'hourly' => 'Hour',
            'monthly' => 'Month',
            'yearly' => 'Year'
        ];
    }

    public static function getReferralSources()
    {
        return [
            'website' => 'Company Website',
            'job_board' => 'Job Board',
            'social_media' => 'Social Media',
            'referral' => 'Employee Referral',
            'recruitment_agency' => 'Recruitment Agency',
            'walk_in' => 'Walk-in',
            'other' => 'Other'
        ];
    }
}
