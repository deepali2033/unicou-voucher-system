<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'slug',
        'short_description',
        'description',
        'icon',
        'image',
        'price_from',
        'price_to',
        'duration',
        'features',
        'includes',
        'is_active',
        'is_featured',
        'sort_order',
        'meta_title',
        'meta_description',
        'approval_status',
        'servicetoggle'
    ];

    protected $casts = [
        'features' => 'array',
        'includes' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'price_from' => 'decimal:2',
        'price_to' => 'decimal:2',
        'approval_status' => 'string'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->name);
            }
        });

        static::updating(function ($service) {
            if ($service->isDirty('name') && empty($service->slug)) {
                $service->slug = Str::slug($service->name);
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

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function getPriceRangeAttribute()
    {
        if ($this->price_from && $this->price_to) {
            return '€' . number_format($this->price_from, 0) . ' - €' . number_format($this->price_to, 0) . ' EUR';
        } elseif ($this->price_from) {
            return 'From €' . number_format($this->price_from, 0) . ' EUR';
        }
        return 'Contact for pricing';
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the user who created the service.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the service.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
