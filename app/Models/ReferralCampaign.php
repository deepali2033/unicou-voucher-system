<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class ReferralCampaign extends Model
{
    protected $fillable = [
        'campaign_name',
        'reward_type',
        'reward_value',
        'max_reward',
        'applicable_user_types',
        'start_date',
        'end_date',
        'status',
        'unique_code',
        'created_by',
        'last_modified_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'applicable_user_types' => 'array',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function modifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'last_modified_by');
    }

    public function referrals(): HasMany
    {
        return $this->hasMany(Referral::class, 'campaign_id');
    }

    public function isActive()
    {
        return $this->status === 'active' && !$this->isExpired() && $this->hasStarted();
    }

    public function isExpired()
    {
        return Carbon::now()->isAfter($this->end_date);
    }

    public function hasStarted()
    {
        return Carbon::now()->isAfter($this->start_date);
    }

    public function isFrozen()
    {
        return $this->status === 'frozen';
    }

    public function isApplicableToUserType($userType)
    {
        if (empty($this->applicable_user_types)) {
            return true;
        }
        return in_array($userType, $this->applicable_user_types);
    }
}
