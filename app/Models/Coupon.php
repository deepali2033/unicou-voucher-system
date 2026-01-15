<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    protected $fillable = [
        'voucher_id',
        'code',
        'campaign_name',
        'start_date',
        'end_date',
        'quantity',
        'redeemed_count',
        'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class);
    }

    public function redemptions(): HasMany
    {
        return $this->hasMany(Redemption::class);
    }

    public function isExpired()
    {
        return now()->isAfter($this->end_date);
    }

    public function isActive()
    {
        return $this->status === 'active' && !$this->isExpired() && now()->isAfter($this->start_date);
    }

    public function getRemainingQuantity()
    {
        return $this->quantity - $this->redeemed_count;
    }
}
