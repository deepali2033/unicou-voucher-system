<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReferralCampaign;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ReferralCampaignController extends Controller
{
    public function index(Request $request)
    {
        $query = ReferralCampaign::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('campaign_name', 'like', "%$search%")
                  ->orWhere('unique_code', 'like', "%$search%");
        }

        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        if ($request->has('reward_type') && !empty($request->reward_type)) {
            $query->where('reward_type', $request->reward_type);
        }

        if ($request->has('sort')) {
            $sort = $request->sort;
            switch ($sort) {
                case 'newest':
                    $query->latest();
                    break;
                case 'oldest':
                    $query->oldest();
                    break;
                case 'name_asc':
                    $query->orderBy('campaign_name');
                    break;
                case 'name_desc':
                    $query->orderByDesc('campaign_name');
                    break;
            }
        } else {
            $query->latest();
        }

        $campaigns = $query->paginate(10);
        return view('admin.referral-campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('admin.referral-campaigns.create');
    }

    public function store(Request $request)
    {
        $today = Carbon::today();

        $validated = $request->validate([
            'campaign_name' => 'required|string|max:255',
            'reward_type' => 'required|in:voucher,bonus_points,discount',
            'reward_value' => 'required|numeric|min:0.01',
            'max_reward' => 'nullable|numeric|min:0',
            'applicable_user_types' => 'nullable|array',
            'applicable_user_types.*' => 'string',
            'start_date' => 'required|date|date_format:Y-m-d|after_or_equal:' . $today->format('Y-m-d'),
            'end_date' => 'required|date|date_format:Y-m-d|after:start_date',
        ]);

        $campaign = ReferralCampaign::create([
            'campaign_name' => $validated['campaign_name'],
            'reward_type' => $validated['reward_type'],
            'reward_value' => $validated['reward_value'],
            'max_reward' => $validated['max_reward'],
            'applicable_user_types' => $validated['applicable_user_types'] ?? [],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => 'active',
            'unique_code' => 'REF-' . strtoupper(Str::random(6)),
            'created_by' => auth()->id(),
            'last_modified_by' => auth()->id(),
        ]);

        return redirect()->route('admin.referral-campaigns.index')->with('success', 'Referral campaign created successfully!');
    }

    public function show(ReferralCampaign $referralCampaign)
    {
        $referralCampaign->load(['referrals', 'createdBy', 'modifiedBy']);
        return view('admin.referral-campaigns.show', compact('referralCampaign'));
    }

    public function edit(ReferralCampaign $referralCampaign)
    {
        return view('admin.referral-campaigns.edit', compact('referralCampaign'));
    }

    public function update(Request $request, ReferralCampaign $referralCampaign)
    {
        $today = Carbon::today();

        $validated = $request->validate([
            'campaign_name' => 'required|string|max:255',
            'reward_type' => 'required|in:voucher,bonus_points,discount',
            'reward_value' => 'required|numeric|min:0.01',
            'max_reward' => 'nullable|numeric|min:0',
            'applicable_user_types' => 'nullable|array',
            'applicable_user_types.*' => 'string',
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d|after:start_date',
            'status' => 'required|in:active,inactive,frozen',
        ]);

        $referralCampaign->update([
            'campaign_name' => $validated['campaign_name'],
            'reward_type' => $validated['reward_type'],
            'reward_value' => $validated['reward_value'],
            'max_reward' => $validated['max_reward'],
            'applicable_user_types' => $validated['applicable_user_types'] ?? [],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => $validated['status'],
            'last_modified_by' => auth()->id(),
        ]);

        return redirect()->route('admin.referral-campaigns.index')->with('success', 'Referral campaign updated successfully!');
    }

    public function destroy(ReferralCampaign $referralCampaign)
    {
        $referralCampaign->delete();
        return redirect()->route('admin.referral-campaigns.index')->with('success', 'Referral campaign deleted successfully!');
    }

    public function freeze(ReferralCampaign $referralCampaign)
    {
        $referralCampaign->update([
            'status' => 'frozen',
            'last_modified_by' => auth()->id(),
        ]);

        return redirect()->route('admin.referral-campaigns.index')->with('success', 'Referral campaign frozen successfully!');
    }

    public function unfreeze(ReferralCampaign $referralCampaign)
    {
        $referralCampaign->update([
            'status' => 'active',
            'last_modified_by' => auth()->id(),
        ]);

        return redirect()->route('admin.referral-campaigns.index')->with('success', 'Referral campaign unfrozen successfully!');
    }
}
