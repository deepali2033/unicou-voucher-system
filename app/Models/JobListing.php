<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class JobListing extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'category',
        'short_description',
        'description',
        'location',
        'employment_type',
        'salary_min',
        'salary_max',
        'salary_type',
        'requirements',
        'benefits',
        'contact_email',
        'contact_phone',
        'is_active',
        'is_featured',
        'is_approved',
        'sort_order',
        'application_deadline',
        'meta_title',
        'image',
        'meta_description',
        'jobtoggle',
    ];

    protected $casts = [
        'requirements' => 'array',
        'benefits' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_approved' => 'boolean',
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
        'application_deadline' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($job) {
            if (empty($job->slug)) {
                $job->slug = Str::slug($job->title);
            }
        });

        static::updating(function ($job) {
            if ($job->isDirty('title') && empty($job->slug)) {
                $job->slug = Str::slug($job->title);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function getSalaryRangeAttribute()
    {
        if ($this->salary_min && $this->salary_max) {
            return '€'.number_format($this->salary_min, 2).' - €'.number_format($this->salary_max, 2).' per '.$this->salary_type;
        } elseif ($this->salary_min) {
            return 'From €'.number_format($this->salary_min, 2).' per '.$this->salary_type;
        }

        return 'Competitive salary';
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function getCategories()
    {
        return [
            'Production & Factory Jobs',
            'Kitchen & Restaurant Assistance',
            'Cleaning Jobs',
            'Other Temporary Roles',
        ];
    }

    public static function getEmploymentTypes()
    {
        return [
            'full-time' => 'Full Time',
            'part-time' => 'Part Time',
            'contract' => 'Contract',
            'temporary' => 'Temporary',
        ];
    }

    public static function getSalaryTypes()
    {
        return [
            'hourly' => 'Hour',
            'monthly' => 'Month',
            'yearly' => 'Year',
        ];
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jobCategory(): BelongsTo
    {
        return $this->belongsTo(JobCategory::class, 'category', 'slug');
    }

    public function candidates(): HasMany
    {
        return $this->hasMany(Candidate::class);
    }

    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }
}
