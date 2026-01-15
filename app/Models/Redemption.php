<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Redemption extends Model
{
    protected $fillable = [
        'voucher_id',
        'coupon_id',
        'user_id',
        'user_type',
        'value_redeemed',
        'status',
        'notes',
        'redeemed_at',
    ];

    protected $casts = [
        'redeemed_at' => 'datetime',
    ];

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bonus(): HasOne
    {
        return $this->hasOne(Bonus::class);
    }

    public function referral(): HasOne
    {
        return $this->hasOne(Referral::class);
    }
}
