<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Voucher extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'price',
        'stock',
        'low_stock_threshold',
        'start_date',
        'end_date',
        'status',
        'usage_count',
        'type',
        'discount_percent',
        'fixed_amount',
        'free_item_name',
        'per_user_limit',
        'total_limit',
        'applicable_user_types',
        'extended_status',
        'is_system_paused',
        'last_modified_by',
        'last_freeze_unfreeze_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'applicable_user_types' => 'array',
        'is_system_paused' => 'boolean',
    ];

    public function coupons(): HasMany
    {
        return $this->hasMany(Coupon::class);
    }

    public function redemptions(): HasMany
    {
        return $this->hasMany(Redemption::class);
    }

    public function bonuses(): HasMany
    {
        return $this->hasMany(Bonus::class);
    }

    public function referrals(): HasMany
    {
        return $this->hasMany(Referral::class);
    }

    public function auditLogs(): HasMany
    {
        return $this->hasMany(VoucherAuditLog::class);
    }

    public function isExpired()
    {
        return Carbon::now()->isAfter($this->end_date);
    }

    public function isActive()
    {
        return $this->extended_status === 'active' && !$this->isExpired() && !$this->is_system_paused;
    }

    public function hasStarted()
    {
        return Carbon::now()->isAfter($this->start_date);
    }

    public function isFrozen()
    {
        return $this->extended_status === 'frozen';
    }

    public function canBeRedeemed()
    {
        return $this->isActive() && !$this->isFrozen() && $this->hasStarted();
    }

    public function getRemainingStock()
    {
        if ($this->stock === null) {
            return null;
        }
        return $this->stock - $this->usage_count;
    }

    public function getRemainingSlotsForUser($userId)
    {
        if ($this->per_user_limit === null) {
            return null;
        }
        $used = $this->redemptions()->where('user_id', $userId)->count();
        return $this->per_user_limit - $used;
    }

    public function getTotalRemainingUses()
    {
        if ($this->total_limit === null) {
            return null;
        }
        return $this->total_limit - $this->usage_count;
    }

    public function isApplicableToUserType($userType)
    {
        if (empty($this->applicable_user_types)) {
            return true;
        }
        return in_array($userType, $this->applicable_user_types);
    }
}
