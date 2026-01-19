<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display the services index page.
     * Shows both user-created and recruiter-created services.
     * Can be filtered by category via ?category=id parameter.
     */
    public function index(Request $request)
    {
        // Get all categories for filtering display
        $categories = Category::orderBy('name')->get();

        // Start with base query for active services
        $query = Service::active()
            ->where(function ($q) {
                $q->whereNull('servicetoggle')
                    ->orWhere('servicetoggle', '')
                    ->orWhere('servicetoggle', 'recruiter');
            });

        // Apply category filter if provided
        $selectedCategory = null;
        if ($request->has('category') && $request->category) {
            $categoryId = $request->category;
            $selectedCategory = Category::find($categoryId);

            if ($selectedCategory) {
                $query->where('category_id', $categoryId);
            }
        }

        $services = $query->ordered()->get();

        return view('services.index', compact('services', 'categories', 'selectedCategory'));
    }

    /**
     * Display the household jobs page.
     */
    public function householdJobs()
    {
        $services = Service::active()->ordered()->get();

        return view('services.index', compact('services'));
    }

    public function agencyservices()
    {
        $services = Service::active()->ordered()->get();

        return view('services.index', compact('services'));
    }

    /**
     * Display a specific service page.
     */
    public function show(Service $service)
    {
        if (! $service->is_active) {
            abort(404);
        }

        return view('services.singleservice', compact('service'));
    }

    // Static service methods for backward compatibility
    public function houseCleaning()
    {
        $service = Service::where('slug', 'house-cleaning')->first();
        if (! $service) {
            abort(404);
        }

        return view('services.singleservice', compact('service'));
    }

    public function apartmentCleaning()
    {
        $service = Service::where('slug', 'apartment-cleaning')->first();
        if (! $service) {
            abort(404);
        }

        return view('services.singleservice', compact('service'));
    }

    public function deepCleaning()
    {
        $service = Service::where('slug', 'deep-cleaning')->first();
        if (! $service) {
            abort(404);
        }

        return view('services.singleservice', compact('service'));
    }

    public function recurringCleaning()
    {
        $service = Service::where('slug', 'recurring-cleaning')->first();
        if (! $service) {
            abort(404);
        }

        return view('services.singleservice', compact('service'));
    }

    public function moveInOutCleaning()
    {
        $service = Service::where('slug', 'move-in-out-cleaning')->first();
        if (! $service) {
            abort(404);
        }

        return view('services.singleservice', compact('service'));
    }

    public function officeCleaning()
    {
        $service = Service::where('slug', 'office-cleaning')->first();
        if (! $service) {
            abort(404);
        }

        return view('services.singleservice', compact('service'));
    }

    public function commercial()
    {
        $service = Service::where('slug', 'commercial')->first();
        if (! $service) {
            abort(404);
        }

        return view('services.singleservice', compact('service'));
    }

    public function residential()
    {
        $service = Service::where('slug', 'residential')->first();
        if (! $service) {
            abort(404);
        }

        return view('services.singleservice', compact('service'));
    }

    public function postConstructionCleaning()
    {
        $service = Service::where('slug', 'post-construction-cleaning')->first();
        if (! $service) {
            abort(404);
        }

        return view('services.singleservice', compact('service'));
    }

    public function airbnbCleaning()
    {
        $service = Service::where('slug', 'airbnb-cleaning')->first();
        if (! $service) {
            abort(404);
        }

        return view('services.singleservice', compact('service'));
    }

    public function domesticCleaning(Request $request)
    {
        $service = Service::where('slug', 'domestic-cleaning')->first();
        $services = Service::active()->ordered()->get();

        $freelancers = User::where('account_type', 'freelancer')
            ->whereNotNull('city')
            ->get();

        $freelancerCities = $freelancers->pluck('city')
            ->unique()
            ->values();
        $freelancersuser = User::where('account_type', 'freelancer')
            ->whereNotNull('city')
            ->get();
        $selectedCity = null;
        $cityFreelancers = collect();

        return view('services.domestic-cleaning', compact('service', 'freelancersuser', 'services', 'freelancerCities', 'selectedCity', 'cityFreelancers'));
    }

    public function domesticCleaningPlace(string $citySlug)
    {
        $service = Service::where('slug', 'domestic-cleaning')->first();
        if (! $service) {
            abort(404);
        }

        $services = Service::active()->ordered()->get();

        $freelancers = User::where('account_type', 'freelancer')
            ->whereNotNull('city')
            ->get();

        $freelancerCities = $freelancers->pluck('city')
            ->unique()
            ->values();

        $selectedCity = $freelancerCities->first(function ($city) use ($citySlug) {
            return Str::slug($city) === $citySlug;
        });

        if (! $selectedCity) {
            abort(404);
        }

        $cityFreelancers = $freelancers->filter(function ($freelancer) use ($citySlug) {
            return Str::slug($freelancer->city) === $citySlug;
        })->values();

        return view('services.domestic-cleaning', compact('service', 'services', 'freelancerCities', 'selectedCity', 'cityFreelancers'));
    }

    public function shortTermRentals()
    {
        $service = Service::where('slug', 'short-term-rentals')->first();
        if (! $service) {
            abort(404);
        }

        return view('services.singleservice', compact('service'));
    }
}
