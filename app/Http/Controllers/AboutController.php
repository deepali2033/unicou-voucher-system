<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the about us index page.
     */
    public function index()
    {
        return view('about.index');
    }

    /**
     * Display the cleaning process page.
     */
    public function cleaningProcess()
    {
        return view('about.cleaning-process');
    }

    /**
     * Display the customer reviews page.
     */
    public function customerReviews()
    {
        return view('about.customer-reviews');
    }

    /**
     * Display the FAQ page.
     */
    public function faq()
    {
        return view('about.faq');
    }

    /**
     * Display the privacy policy page.
     */
    public function privacyPolicy()
    {
        return view('about.privacy-policy');
    }

    /**
     * Display the terms of service page.
     */
    public function termsOfService()
    {
        return view('about.terms-of-service');
    }
}