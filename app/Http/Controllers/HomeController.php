<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\JobCategory;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\Rating;
use App\Models\JobListing;
use App\Models\Service;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
 public function index()
    {
        // Fetch all active services created by users and recruiters
        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
        $jobs = JobListing::active()
            ->ordered()
            ->get();
        // Fetch all active categories
        $categories = Category::active()
            ->ordered()
            ->get();
        $JobCategory = JobCategory::active()
            ->ordered()
            ->get();
 // Fetch latest 3 active blogs for homepage
        $blogs = Blog::with('category')
            ->where('is_active', true)
            ->latest('published_at')
            ->limit(3)
            ->get();
        // Get paginated reviews (10 per page)
        $reviews = Rating::where('ratee_id', 1) // KOA Service company
            ->with(['rater'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Get recent reviews for carousel (10 most recent)
        $recentReviews = Rating::where('ratee_id', 1)
            ->with(['rater'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Get statistics for display
        $totalRatings = Rating::where('ratee_id', 1)->count();
        $averageRating = Rating::where('ratee_id', 1)->average('stars') ?? 0;

        // Get star count distribution
        $starCounts = [
            5 => Rating::where('ratee_id', 1)->where('stars', 5)->count(),
            4 => Rating::where('ratee_id', 1)->where('stars', 4)->count(),
            3 => Rating::where('ratee_id', 1)->where('stars', 3)->count(),
            2 => Rating::where('ratee_id', 1)->where('stars', 2)->count(),
            1 => Rating::where('ratee_id', 1)->where('stars', 1)->count(),
        ];

        // Calculate percentages
        $starPercentages = [];
        foreach ($starCounts as $star => $count) {
            $starPercentages[$star] = $totalRatings > 0 ? round(($count / $totalRatings) * 100) : 0;
        }
   // Get active testimonials for home page
        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->limit(8) // Show up to 8 testimonials
            ->get();
        return view('home.index', compact('starPercentages','blogs', 'testimonials','starCounts', 'averageRating', 'totalRatings', 'recentReviews', 'reviews', 'services', 'categories', 'JobCategory', 'jobs'));
    }
    /**
     * Display the gift cards page.
     */
    public function giftCards()
    {
        return view('home.gift-cards');
    }

    /**
     * Display the big cleaning company page.
     */
    public function bigCleaningCompany()
    {
        return view('home.big-cleaning-company');
    }

    /**
     * Display the avatar page.
     */
    public function avatar()
    {
        return view('home.avatar');
    }

    /**
     * Display the job services page.
     */
    public function jobServices()
    {
        $jobs = JobListing::active()->ordered()->get();

        return view('home.Jobservices', compact('jobs'));
    }
}
