<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'points',
        'image',
        'price',
        'is_active',
        'discount_type',
        'discount_value',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'discount_value' => 'decimal:2',
    ];

    /**
     * Get the discounted price
     */
    public function getDiscountedPriceAttribute()
    {
        if (!$this->discount_value) {
            return $this->price;
        }

        if ($this->discount_type === 'percentage') {
            return $this->price - ($this->price * ($this->discount_value / 100));
        }

        if ($this->discount_type === 'fixed') {
            return max(0, $this->price - $this->discount_value);
        }

        return $this->price;
    }

    /**
     * Check if plan has discount
     */
    public function hasDiscount()
    {
        return $this->discount_value > 0 && in_array($this->discount_type, ['percentage', 'fixed']);
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute()
    {
        return '€' . number_format($this->price, 2) . ' EUR';
    }

    /**
     * Get formatted discounted price
     */
    public function getFormattedDiscountedPriceAttribute()
    {
        return '€' . number_format($this->discounted_price, 2) . ' EUR';
    }

    /**
     * Scope for active plans
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get all bookings for this plan.
     */
    public function bookedPlans()
    {
        return $this->hasMany(BookedPlan::class);
    }

    /**
     * Get successful bookings for this plan.
     */
    public function successfulBookings()
    {
        return $this->hasMany(BookedPlan::class)->successful();
    }
}
