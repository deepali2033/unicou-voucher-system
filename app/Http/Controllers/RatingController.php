<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Show ratings page
     */
    public function index()
    {
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

        return view('rating.trustpilot_style', [
            'reviews' => $reviews,
            'recentReviews' => $recentReviews,
            'totalRatings' => $totalRatings,
            'averageRating' => round($averageRating, 1),
            'starCounts' => $starCounts,
            'starPercentages' => $starPercentages,
        ]);
    }

    /**
     * Store a new rating
     */
    public function store(Request $request)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'You need to be logged in to submit a review',
                'requires_login' => true,
                'redirect_url' => route('login')
            ], 401);
        }

        // Validate the request
        try {
            $validated = $request->validate([
                'stars' => 'required|integer|between:1,5',
                'review_text' => 'required|string|min:10|max:1000',
                'review_title' => 'required|string|min:5|max:100',
                'experience_date' => 'required|date|before_or_equal:today',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        }

        try {
            // Create the rating
            $rating = Rating::create([
                'rater_id' => Auth::id(),
                'ratee_id' => 1, // KOA Service company ID (adjust if needed)
                'stars' => $validated['stars'],
                'review_text' => $validated['review_text'],
                'review_title' => $validated['review_title'],
                'experience_date' => $validated['experience_date'],
                'ip_address' => $request->ip(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Review submitted successfully!',
                'rating' => $rating
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error submitting review: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all ratings for a user
     */
    public function getUserRatings($userId)
    {
        $ratings = Rating::where('ratee_id', $userId)
            ->with(['rater'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json($ratings);
    }

    /**
     * Get rating statistics
     */
    public function getStatistics($userId)
    {
        $totalRatings = Rating::where('ratee_id', $userId)->count();
        $averageRating = Rating::where('ratee_id', $userId)->average('stars') ?? 0;
        $breakdown = Rating::getRatingBreakdown($userId);

        return response()->json([
            'total_ratings' => $totalRatings,
            'average_rating' => round($averageRating, 1),
            'breakdown' => $breakdown
        ]);
    }

    /**
     * Delete a rating (only by the rater)
     */
    public function delete($ratingId)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $rating = Rating::find($ratingId);

        if (!$rating) {
            return response()->json([
                'success' => false,
                'message' => 'Rating not found'
            ], 404);
        }

        if ($rating->rater_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'You can only delete your own reviews'
            ], 403);
        }

        $rating->delete();

        return response()->json([
            'success' => true,
            'message' => 'Review deleted successfully'
        ]);
    }
}
