<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Plan::query();

        // Search by name
        if ($request->filled('search')) {
            $searchTerm = $request->get('search');
            $query->where('name', 'LIKE', '%' . $searchTerm . '%');
        }

        // Filter by status
        if ($request->filled('status') && $request->get('status') !== '') {
            $status = $request->get('status') === 'active';
            $query->where('is_active', $status);
        }

        $plans = $query->orderBy('name')->paginate(15);

        // Preserve query parameters in pagination
        $plans->appends($request->query());

        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'points' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'discount_type' => 'nullable|in:percentage,fixed',
            'discount_value' => 'nullable|numeric|min:0',
        ]);

        // Validate discount value based on type
        if ($validated['discount_type'] === 'percentage' && $validated['discount_value'] > 100) {
            return back()->withErrors(['discount_value' => 'Percentage discount cannot exceed 100%'])->withInput();
        }

        if ($validated['discount_type'] === 'fixed' && $validated['discount_value'] > $validated['price']) {
            return back()->withErrors(['discount_value' => 'Fixed discount cannot exceed the plan price'])->withInput();
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('plans', 'public');
            // Ensure file is accessible via public/storage
            $this->ensureFileAccessible($validated['image']);
        }

        $plan = Plan::create($validated);

        // Create notification
        NotificationService::planCreated($plan);

        return redirect()->route('admin.plans.index')
            ->with('success', 'Plan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        return view('admin.plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'points' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'discount_type' => 'nullable|in:percentage,fixed',
            'discount_value' => 'nullable|numeric|min:0',
        ]);

        // Validate discount value based on type
        if ($validated['discount_type'] === 'percentage' && $validated['discount_value'] > 100) {
            return back()->withErrors(['discount_value' => 'Percentage discount cannot exceed 100%'])->withInput();
        }

        if ($validated['discount_type'] === 'fixed' && $validated['discount_value'] > $validated['price']) {
            return back()->withErrors(['discount_value' => 'Fixed discount cannot exceed the plan price'])->withInput();
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($plan->image) {
                Storage::disk('public')->delete($plan->image);
            }
            $validated['image'] = $request->file('image')->store('plans', 'public');
            // Ensure file is accessible via public/storage
            $this->ensureFileAccessible($validated['image']);
        }

        $plan->update($validated);

        // Create notification
        NotificationService::planUpdated($plan);

        return redirect()->route('admin.plans.index')
            ->with('success', 'Plan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        // Delete image if exists
        if ($plan->image) {
            Storage::disk('public')->delete($plan->image);
        }

        $plan->delete();

        return redirect()->route('admin.plans.index')
            ->with('success', 'Plan deleted successfully.');
    }

    /**
     * Toggle plan status
     */
    public function toggleStatus(Plan $plan)
    {
        $plan->update(['is_active' => !$plan->is_active]);

        $status = $plan->is_active ? 'activated' : 'deactivated';

        // Create notification
        if ($plan->is_active) {
            NotificationService::planActivated($plan);
        } else {
            NotificationService::planDeactivated($plan);
        }

        return redirect()->back()->with('success', "Plan {$status} successfully.");
    }

    /**
     * Ensure uploaded file is accessible via public/storage
     */
    private function ensureFileAccessible($relativePath)
    {
        $sourcePath = Storage::disk('public')->path($relativePath);
        $targetPath = public_path('storage/' . $relativePath);

        // Create directory if it doesn't exist
        $targetDir = dirname($targetPath);
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        // Copy file to public storage if it doesn't exist or source is newer
        if (!file_exists($targetPath) || filemtime($sourcePath) > filemtime($targetPath)) {
            copy($sourcePath, $targetPath);
        }
    }
}
