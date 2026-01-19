<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function approve(Service $service)
    {
        $service->update(['approval_status' => 'Approved']);
        return redirect()->route('admin.services.index')->with('success', 'Service approved successfully.');
    }

    public function reject(Service $service)
    {
        $service->update(['approval_status' => 'Rejected']);
        return redirect()->route('admin.services.index')->with('success', 'Service rejected successfully.');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Service::where('approval_status', 'Pending');

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

        $services = $query->orderBy('sort_order')->orderBy('name')->paginate(15);

        // Preserve query parameters in pagination
        $services->appends($request->query());

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price_from' => 'nullable|numeric|min:0',
            'price_to' => 'nullable|numeric|min:0|gte:price_from',
            'duration' => 'nullable|string|max:255',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
            'includes' => 'nullable|array',
            'includes.*' => 'string|max:255',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Filter out empty features and includes
        if (isset($validated['features'])) {
            $validated['features'] = array_filter($validated['features']);
        }
        if (isset($validated['includes'])) {
            $validated['includes'] = array_filter($validated['includes']);
        }

        $service = Service::create($validated);

        // Create notification
        NotificationService::serviceCreated($service);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug,' . $service->id,
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price_from' => 'nullable|numeric|min:0',
            'price_to' => 'nullable|numeric|min:0|gte:price_from',
            'duration' => 'nullable|string|max:255',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
            'includes' => 'nullable|array',
            'includes.*' => 'string|max:255',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Filter out empty features and includes
        if (isset($validated['features'])) {
            $validated['features'] = array_filter($validated['features']);
        }
        if (isset($validated['includes'])) {
            $validated['includes'] = array_filter($validated['includes']);
        }

        $service->update($validated);

        // Create notification
        NotificationService::serviceUpdated($service);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        // Delete image if exists
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    /**
     * Toggle service status
     */
    public function toggleStatus(Service $service)
    {
        $service->update(['is_active' => !$service->is_active]);

        $status = $service->is_active ? 'activated' : 'deactivated';

        // Create notification
        if ($service->is_active) {
            NotificationService::serviceActivated($service);
        } else {
            NotificationService::serviceDeactivated($service);
        }

        return redirect()->back()->with('success', "Service {$status} successfully.");
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Service $service)
    {
        $service->update(['is_featured' => !$service->is_featured]);

        $status = $service->is_featured ? 'marked as featured' : 'removed from featured';

        // Create notification
        if ($service->is_featured) {
            NotificationService::serviceFeatured($service);
        } else {
            NotificationService::serviceUnfeatured($service);
        }

        return redirect()->back()->with('success', "Service {$status} successfully.");
    }
}
