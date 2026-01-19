<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display the blog index page.
     */
    public function index()
    {
        // Get all active blog posts with pagination
        $blogs = Blog::with('category')
            ->where('is_active', true)
            ->latest('published_at')
            ->paginate(12);
            
        return view('blog.index', compact('blogs'));
    }
    
    /**
     * Get latest blogs for homepage (3 blogs).
     */
    public function getLatestBlogs($limit = 3)
    {
        return Blog::with('category')
            ->where('is_active', true)
            ->latest('published_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Display a specific blog post.
     */
    public function show($slug)
    {
        // Find the blog post by slug
        $blog = Blog::with('category')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('blog.show', compact('blog'));
    }

    /**
     * Display blog posts by category.
     */
    public function categoryIndex(Request $request)
    {
        $category = $request->route('category');
        return view('blog.category', compact('category'));
    }

    /**
     * Display blog posts by tag.
     */
    public function tagIndex(Request $request)
    {
        $tag = $request->route('tag');
        return view('blog.tag', compact('tag'));
    }

    /**
     * Generate RSS feed for blog posts.
     */
    public function feed()
    {
        return response()->view('blog.feed')->header('Content-Type', 'application/rss+xml');
    }

    /**
     * Generate RSS feed for blog comments.
     */
    public function commentsFeed()
    {
        return response()->view('blog.comments-feed')->header('Content-Type', 'application/rss+xml');
    }
}