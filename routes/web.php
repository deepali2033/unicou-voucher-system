<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Addressapi;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookServiceController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DomesticController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ServiceController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/domestic-cleaning', [DomesticController::class, 'domesticCleaning'])->name('domestic-cleaning');
Route::get('/domestic-cleaning/places/{citySlug}', [DomesticController::class, 'domesticCleaningPlace'])->name('domestic-cleaning.places.show');
Route::get('/domestic-cleaning/places/{citySlug}/cleaners/{freelancerSlug}', [DomesticController::class, 'showFreelancer'])->name('domestic-cleaning.places.cleaners.show');
Route::get('/jobservices', [HomeController::class, 'jobServices'])->name('jobservices');

Route::get('/locale/{locale}', function (Request $request, string $locale) {
    $supported = ['en', 'nl'];

    if (! in_array($locale, $supported, true)) {
        abort(404);
    }

    $request->session()->put('app_locale', $locale);

    $referer = $request->headers->get('referer');

    return $referer ? redirect($referer) : redirect()->route('home');
})->name('locale.switch');

// Temporary test route
Route::get('/test-service-data', function () {
    $service = App\Models\Service::where('slug', 'regular-house-cleaning')->first();

    return response()->json([
        'name' => $service->name,
        'features' => $service->features,
        'includes' => $service->includes,
        'features_count' => count($service->features ?? []),
        'includes_count' => count($service->includes ?? []),
    ]);
});

// Test candidate functionality
Route::get('/test-candidates', function () {
    $candidates = App\Models\Candidate::with('jobListing')->get();
    $jobListings = App\Models\JobListing::active()->get();

    return response()->json([
        'candidates_count' => $candidates->count(),
        'job_listings_count' => $jobListings->count(),
        'candidates' => $candidates->map(function ($candidate) {
            return [
                'id' => $candidate->id,
                'name' => $candidate->full_name,
                'email' => $candidate->email,
                'status' => $candidate->status,
                'position' => $candidate->position_applied,
                'job_listing' => $candidate->jobListing ? $candidate->jobListing->title : null,
                'applied_at' => $candidate->applied_at->format('Y-m-d H:i:s'),
            ];
        }),
        'status' => 'Candidate system is working!',
    ]);
});

Route::prefix('jobs')->group(function () {
    Route::get('/household-jobs', [JobController::class, 'joblisted'])->name('jobs.house-jobs');
    Route::get('/agency-jobs', [JobController::class, 'joblistedrecruiter'])->name('jobs.agency-jobs');
    Route::get('/', [JobController::class, 'jobsByCategory'])->name('jobs.by-category');
});
// Services Routes
Route::prefix('services')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/agencysevices', [ServiceController::class, 'agencyservices'])->name('services.agencyservices');
    Route::get('/householdservices', [ServiceController::class, 'householdJobs'])->name('services.householdservices');

    // Keep existing static routes for backward compatibility
    Route::get('/apartment-cleaning', [ServiceController::class, 'apartmentCleaning'])->name('services.apartment-cleaning');
    Route::get('/deep-cleaning', [ServiceController::class, 'deepCleaning'])->name('services.deep-cleaning');
    Route::get('/recurring-cleaning', [ServiceController::class, 'recurringCleaning'])->name('services.recurring-cleaning');
    Route::get('/move-in-out-cleaning', [ServiceController::class, 'moveInOutCleaning'])->name('services.move-in-out-cleaning');
    Route::get('/office-cleaning', [ServiceController::class, 'officeCleaning'])->name('services.office-cleaning');
    Route::get('/domestic-cleaning', [ServiceController::class, 'domesticCleaning'])->name('services.domestic-cleaning');

    Route::view('/domestic-cleaning2', 'services.domestic-cleaning2')->name('jobs.index');
    Route::get('/commercial', [ServiceController::class, 'commercial'])->name('services.commercial');
    Route::get('/residential', [ServiceController::class, 'residential'])->name('services.residential');
    Route::get('/post-construction-cleaning', [ServiceController::class, 'postConstructionCleaning'])->name('services.post-construction-cleaning');
    Route::get('/airbnb-cleaning', [ServiceController::class, 'airbnbCleaning'])->name('services.airbnb-cleaning');
    Route::get('/short-term-rentals', [ServiceController::class, 'shortTermRentals'])->name('services.short-term-rentals');
    Route::get('/get-nearby-cities', [ServiceController::class, 'getNearbyCities']);
    // Dynamic service route (must be last to avoid conflicts)
    Route::get('/{service:slug}', [ServiceController::class, 'show'])->name('services.show');
});

// About Us Routes
Route::prefix('about-us')->group(function () {
    Route::get('/', [AboutController::class, 'index'])->name('about.index');
    Route::get('/cleaning-process', [AboutController::class, 'cleaningProcess'])->name('about.cleaning-process');
    Route::get('/customer-reviews', [AboutController::class, 'customerReviews'])->name('about.customer-reviews');
    Route::get('/faq', [AboutController::class, 'faq'])->name('about.faq');
    Route::get('/privacy-policy', [AboutController::class, 'privacyPolicy'])->name('about.privacy-policy');
    Route::get('/terms-of-service', [AboutController::class, 'termsOfService'])->name('about.terms-of-service');
});

// Service Areas Routes
Route::prefix('service-areas')->group(function () {
    Route::get('/', [ServiceController::class, 'serviceAreas'])->name('service-areas.index');
    Route::get('/atlanta', [ServiceController::class, 'atlanta'])->name('service-areas.atlanta');
    Route::get('/boston', [ServiceController::class, 'boston'])->name('service-areas.boston');
    Route::get('/chicago', [ServiceController::class, 'chicago'])->name('service-areas.chicago');
    Route::get('/new-york-city', [ServiceController::class, 'newYorkCity'])->name('service-areas.new-york-city');
});

// Blog Routes
Route::prefix(prefix: 'blog')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('blog.show');

    // Category Routes
    Route::get('/category/cleaning', [BlogController::class, 'categoryIndex'])->name('blog.category.cleaning');
    Route::get('/category/cleaning-tips-hacks', [BlogController::class, 'categoryIndex'])->name('blog.category.cleaning-tips-hacks');
    Route::get('/category/organizing', [BlogController::class, 'categoryIndex'])->name('blog.category.organizing');
    Route::get('/category/tips', [BlogController::class, 'categoryIndex'])->name('blog.category.tips');

    // Tag Routes
    Route::get('/tag/cleaning-tips', [BlogController::class, 'tagIndex'])->name('blog.tag.cleaning-tips');
    Route::get('/tag/eco-friendly', [BlogController::class, 'tagIndex'])->name('blog.tag.eco-friendly');

    // Feed Routes
    Route::get('/feed', [BlogController::class, 'feed'])->name('blog.feed');
    Route::get('/comments/feed', [BlogController::class, 'commentsFeed'])->name('blog.comments.feed');
});

// Contact & Quote Routes
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');

// Book Services Routes - Multi-step booking wizard with URL routing
Route::get('/free-quote', [BookServiceController::class, 'index'])->name('book-services.index');
Route::get('/free-quote/{step}', [BookServiceController::class, 'step'])->name('book-services.step')->where('step', 'address|category|services|frequency|duration|extras|pets|date|time');
Route::post('/free-quote', [BookServiceController::class, 'store'])->name('book-services.store');
Route::post('/free-quote/save-session', [BookServiceController::class, 'saveSession'])->name('book-services.save-session');
Route::post('/free-quote/next-step', [BookServiceController::class, 'nextStep'])->name('book-services.next-step');
Route::post('/free-quote/submit', [BookServiceController::class, 'submitBooking'])->name('book-services.submit');
Route::get('/api/services-by-category', [BookServiceController::class, 'getServicesByCategory'])->name('api.services-by-category');
Route::get('/api/service-details', [BookServiceController::class, 'getServiceDetails'])->name('api.service-details');
Route::get('/api/address-suggestions', [Addressapi::class, 'getAddressSuggestions'])->name('api.address-suggestions');

// Legacy quote routes (if needed)
Route::get('/quote', [QuoteController::class, 'index'])->name('quote.index');
Route::post('/submit-quote', [QuoteController::class, 'submitQuote'])->name('quote.submit');

// Newsletter Subscription
Route::post('/subscribe', [App\Http\Controllers\SubscriptionController::class, 'store'])->name('subscription.store');

// AJAX Handler (replaces WordPress admin-ajax.php for Elementor/theme scripts)
Route::any('/ajax', [App\Http\Controllers\AjaxController::class, 'handle'])->name('ajax.handle');

// Pricing
Route::get('/pricing', [PricingController::class, 'index'])->name('pricing.index');

// Payment Routes
Route::prefix('payment')->group(function () {
    Route::post('/create-checkout-session', [PaymentController::class, 'createCheckoutSession'])->name('payment.create-checkout-session');
    Route::get('/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::post('/webhook', [PaymentController::class, 'handleWebhook'])->name('payment.webhook');

    Route::middleware('auth')->group(function () {
        Route::get('/book-service-checkout/{booking}', [PaymentController::class, 'createBookingCheckout'])->name('payment.book-service-checkout');
        Route::get('/book-service-success/{booking}', [PaymentController::class, 'bookingPaymentSuccess'])->name('payment.book-service-success');
    });
});

// Gift Cards
Route::get('/gift-cards', [HomeController::class, 'giftCards'])->name('gift-cards');

// Careers Routes
Route::prefix('careers')->group(function () {
    Route::get('/', [CareerController::class, 'index'])->name('careers.index');
    Route::get('/executive-housekeeper', [CareerController::class, 'executiveHousekeeper'])->name('careers.executive-housekeeper');
    Route::get('/full-time-housekeeper', [CareerController::class, 'fullTimeHousekeeper'])->name('careers.full-time-housekeeper');
    Route::get('/inbound-sales-representative-and-customer-support', [CareerController::class, 'salesRepresentative'])->name('careers.sales-representative');
    Route::get('/team-leader', [CareerController::class, 'teamLeader'])->name('careers.team-leader');
});

// Big Cleaning Company (if needed)
Route::get('/big-cleaning-company', [HomeController::class, 'bigCleaningCompany'])->name('big-cleaning-company');

// Avatar (profile/user related)
Route::get('/avatar', [HomeController::class, 'avatar'])->name('avatar');

// Auth Routes (modal submits)
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('auth.login');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('auth.register');
Route::get('/storage-link', function () {
    // Only allow authenticated users or add more restrictions as needed
    if (! Auth::check()) {
        return redirect()->route('login');
    }

    $publicStoragePath = public_path('storage');
    $storageAppPublic = storage_path('app/public');

    // Check if storage link already exists
    if (is_link($publicStoragePath) && readlink($publicStoragePath) === $storageAppPublic) {
        $message = 'Storage link is already successful! All images are accessible.';
        $status = 'success';
    } else {
        try {
            Artisan::call('storage:link');
            $message = 'Storage link created successfully! All images are now accessible.';
            $status = 'success';
        } catch (\Exception $e) {
            $message = 'Failed to create storage link: '.$e->getMessage();
            $status = 'error';
        }
    }

    // Return HTML response to show message on the URL
    return response()->make('
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Storage Link Status</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .success { color: green; }
                .error { color: red; }
            </style>
        </head>
        <body>
            <h1>Storage Link Status</h1>
            <p class="'.$status.'">'.$message.'</p>
            <a href="'.route('home').'">Go back to home</a>
        </body>
        </html>
    ', 200, ['Content-Type' => 'text/html']);
})->name('storage.link');

// Login page
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Registration page
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Recruiter Registration page
Route::get('/register-recruiter', function () {
    return view('auth.recruiter-register');
})->name('register-recruiter');

// Freelancer Registration page
Route::get('/register-freelancer', function () {
    return view('auth.freelancer-register');
})->name('register-freelancer');

// Email Verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    // If user is logged in, log them out to force fresh login after verification
    if (Auth::check()) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    return redirect()->route('login')->with('status', 'Email verified successfully. Please log in.');
})->middleware(['auth', 'signed', 'throttle:6,1'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Forgot Password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink($request->only('email'));

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->name('password.email');

// Reset Password page without token (keeps existing UI link working)
Route::get('/reset-password', function () {
    return view('auth.reset-password');
})->name('password.reset.form');

// Reset Password page with token (from email link) - must be named 'password.reset' for Laravel
Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token, 'email' => request('email')]);
})->name('password.reset');

// Reset Password submission
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => \Hash::make($password),
            ])->save();

            $user->setRememberToken(\Str::random(60));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->name('password.update');

Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');

// Jobs Routes

// Temporary fix for unapproved jobs - can be removed after running once
Route::get('/fix-unapproved-jobs-temp', function () {
    $count = \App\Models\JobListing::where('is_approved', false)->update(['is_approved' => true]);

    return "Fixed: Approved $count unapproved job listings. You can now remove this route.";
});
Route::get('/jobs-agency', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs-agency/{slug}', [JobController::class, 'category'])->name('jobs.category');
Route::get('/jobs/{job:slug}', [JobController::class, 'show'])->name('jobs.show');
// Candidates Routes
Route::prefix('candidates')->group(function () {
    Route::get('/', [CandidateController::class, 'index'])->name('candidates.index');

    // Job application routes - restricted to freelancers only
    Route::middleware(['auth', 'account_type:freelancer'])->group(function () {
        Route::get('/create', [CandidateController::class, 'create'])->name('candidates.create');
        Route::post('/', [CandidateController::class, 'store'])->name('candidates.store');
    });

    Route::get('/{candidate}', [CandidateController::class, 'show'])->name('candidates.show');
    Route::get('/{candidate}/edit', [CandidateController::class, 'edit'])->name('candidates.edit');
    Route::put('/{candidate}', [CandidateController::class, 'update'])->name('candidates.update');
    Route::delete('/{candidate}', [CandidateController::class, 'destroy'])->name('candidates.destroy');
    Route::get('/{candidate}/download-resume', [CandidateController::class, 'downloadResume'])->name('candidates.download-resume');
    Route::get('/{candidate}/download-cover-letter', [CandidateController::class, 'downloadCoverLetter'])->name('candidates.download-cover-letter');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'account_type:admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');

    // Services Management
    Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
    Route::patch('services/{service}/toggle-status', [App\Http\Controllers\Admin\ServiceController::class, 'toggleStatus'])->name('services.toggle-status');
    Route::patch('services/{service}/toggle-featured', [App\Http\Controllers\Admin\ServiceController::class, 'toggleFeatured'])->name('services.toggle-featured');
    Route::get('agencyservices', [App\Http\Controllers\Admin\ServiceController::class, 'agencyservices'])->name('services.services');

    // Jobs Management
    Route::resource('jobs', App\Http\Controllers\Admin\JobListingController::class);
    Route::patch('jobs/{job}/toggle-status', [App\Http\Controllers\Admin\JobListingController::class, 'toggleStatus'])->name('jobs.toggle-status');
    Route::patch('jobs/{job}/toggle-featured', [App\Http\Controllers\Admin\JobListingController::class, 'toggleFeatured'])->name('jobs.toggle-featured');

    // Users Management
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::patch('users/{user}/verify-profile', [App\Http\Controllers\Admin\UserController::class, 'verifyProfile'])->name('users.verify-profile');
    Route::patch('users/{user}/reject-profile', [App\Http\Controllers\Admin\UserController::class, 'rejectProfile'])->name('users.reject-profile');
    Route::patch('users/{user}/toggle-status', [App\Http\Controllers\Admin\UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::patch('users/{user}/approve-email', [App\Http\Controllers\Admin\UserController::class, 'approveEmail'])->name('users.approve-email');
    Route::patch('users/{user}/disapprove-email', [App\Http\Controllers\Admin\UserController::class, 'disapproveEmail'])->name('users.disapprove-email');

    // Plans Management
    Route::resource('plans', App\Http\Controllers\Admin\PlanController::class);
    Route::patch('plans/{plan}/toggle-status', [App\Http\Controllers\Admin\PlanController::class, 'toggleStatus'])->name('plans.toggle-status');

    // Booked Plans Management
    Route::resource('booked-plans', App\Http\Controllers\Admin\BookedPlanController::class)->only(['index', 'show', 'destroy']);
    Route::patch('booked-plans/{bookedPlan}/update-status', [App\Http\Controllers\Admin\BookedPlanController::class, 'updateStatus'])->name('booked-plans.update-status');

    // Analytics
    Route::get('analytics', [App\Http\Controllers\Admin\AnalyticsController::class, 'index'])->name('analytics');

    // Quotes Management
    Route::resource('quotes', App\Http\Controllers\Admin\QuoteController::class)->only(['index', 'show', 'destroy']);
    Route::post('quotes/{quote}/send-email', [App\Http\Controllers\Admin\QuoteController::class, 'sendEmail'])->name('quotes.send-email');

    // Book Services Management
    Route::resource('book-services', App\Http\Controllers\Admin\BookServiceController::class)->only(['index', 'show', 'destroy']);
    Route::patch('book-services/{bookService}/update-status', [App\Http\Controllers\Admin\BookServiceController::class, 'updateStatus'])->name('book-services.update-status');

    // Notifications Management
    Route::delete('notifications/delete-all-read', [App\Http\Controllers\Admin\NotificationController::class, 'deleteAllRead'])->name('notifications.delete-all-read');
    Route::resource('notifications', App\Http\Controllers\Admin\NotificationController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
    Route::post('notifications/mark-all-read', [App\Http\Controllers\Admin\NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::post('notifications/{notification}/mark-read', [App\Http\Controllers\Admin\NotificationController::class, 'markAsRead'])->name('notifications.mark-read');

    // Newsletter Subscriptions Management
    Route::get('subscriptions', [App\Http\Controllers\Admin\SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::patch('subscriptions/{subscription}/toggle-status', [App\Http\Controllers\Admin\SubscriptionController::class, 'toggleStatus'])->name('subscriptions.toggle-status');
    Route::delete('subscriptions/{subscription}', [App\Http\Controllers\Admin\SubscriptionController::class, 'destroy'])->name('subscriptions.destroy');
    Route::get('subscriptions/export', [App\Http\Controllers\Admin\SubscriptionController::class, 'export'])->name('subscriptions.export');

    // Contact Us Management
    Route::get('contact-us', [App\Http\Controllers\Admin\ContactUsController::class, 'index'])->name('contact-us.index');
    Route::get('contact-us/{contactUs}', [App\Http\Controllers\Admin\ContactUsController::class, 'show'])->name('contact-us.show');
    Route::delete('contact-us/{contactUs}', [App\Http\Controllers\Admin\ContactUsController::class, 'destroy'])->name('contact-us.destroy');

    // Categories Management
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('job-categories', App\Http\Controllers\Admin\JobCategoryController::class);

    // Blogs Management
    Route::resource('blogs', App\Http\Controllers\Admin\BlogController::class);

    // Testimonials Management
    Route::resource('testimonials', App\Http\Controllers\Admin\TestimonialController::class);
    // // Candidates Management
    // Route::resource('candidates', App\Http\Controllers\Admin\CandidateController::class);
    // Route::patch('candidates/{candidate}/toggle-status', [App\Http\Controllers\Admin\CandidateController::class, 'toggleStatus'])->name('candidates.toggle-status');
    // Route::patch('candidates/{candidate}/update-status', [App\Http\Controllers\Admin\CandidateController::class, 'updateStatus'])->name('candidates.update-status');
    // Route::get('candidates/{candidate}/download-resume', [App\Http\Controllers\Admin\CandidateController::class, 'downloadResume'])->name('candidates.download-resume');
    // Route::get('candidates/{candidate}/download-cover-letter', [App\Http\Controllers\Admin\CandidateController::class, 'downloadCoverLetter'])->name('candidates.download-cover-letter');
});

// Recruiter Routes
Route::prefix('recruiter')->name('recruiter.')->middleware(['auth', 'account_type:recruiter'])->group(callback: function () {
    Route::get('/', [App\Http\Controllers\Recruiter\RecruiterController::class, 'dashboard'])->name('dashboard');

    // Profile Management
    Route::get('/profile', [App\Http\Controllers\Recruiter\ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [App\Http\Controllers\Recruiter\ProfileController::class, 'update'])->name('profile.update');

    // Services Management
    Route::resource('services', App\Http\Controllers\Recruiter\ServiceController::class);
    Route::patch('services/{service}/toggle-status', [App\Http\Controllers\Recruiter\ServiceController::class, 'toggleStatus'])->name('services.toggle-status');
    Route::patch('services/{service}/toggle-featured', [App\Http\Controllers\Recruiter\ServiceController::class, 'toggleFeatured'])->name('services.toggle-featured');

    // Jobs Management
    Route::resource('jobs', App\Http\Controllers\Recruiter\JobListingController::class);
    Route::patch('jobs/{job}/toggle-status', [App\Http\Controllers\Recruiter\JobListingController::class, 'toggleStatus'])->name('jobs.toggle-status');
    Route::patch('jobs/{job}/toggle-featured', [App\Http\Controllers\Recruiter\JobListingController::class, 'toggleFeatured'])->name('jobs.toggle-featured');

    // Notifications Management
    Route::get('notifications', [App\Http\Controllers\Recruiter\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('notifications/{id}/mark-as-read', [App\Http\Controllers\Recruiter\NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
    Route::post('notifications/mark-all-read', [App\Http\Controllers\Recruiter\NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::delete('notifications/delete-all-read', [App\Http\Controllers\Recruiter\NotificationController::class, 'deleteAllRead'])->name('notifications.delete-all-read');
    Route::delete('notifications/{id}', [App\Http\Controllers\Recruiter\NotificationController::class, 'destroy'])->name('notifications.destroy');

    // Book Services Management
    Route::resource('book-services', App\Http\Controllers\Recruiter\BookServiceController::class);
    Route::patch('book-services/{bookService}/update-status', [App\Http\Controllers\Recruiter\BookServiceController::class, 'updateStatus'])->name('book-services.update-status');

    // Received Applications Management
    Route::get('applications', [App\Http\Controllers\Recruiter\ReceivedApplicationController::class, 'index'])->name('applications.index');
    Route::get('applications/{application}', [App\Http\Controllers\Recruiter\ReceivedApplicationController::class, 'show'])->name('applications.show');
    Route::patch('applications/{application}/update-status', [App\Http\Controllers\Recruiter\ReceivedApplicationController::class, 'updateStatus'])->name('applications.update-status');
    Route::delete('applications/{application}', [App\Http\Controllers\Recruiter\ReceivedApplicationController::class, 'destroy'])->name('applications.destroy');

});
// freelancer Routes
Route::prefix('freelancer')->name('freelancer.')->middleware(['auth', 'account_type:freelancer'])->group(callback: function () {
    Route::get('/', [App\Http\Controllers\Freelancer\FreelancerController::class, 'dashboard'])->name('dashboard');
    Route::get('/applied-jobs', [App\Http\Controllers\Freelancer\AppliedJobController::class, 'index'])->name('applied-jobs.index');
    Route::get('/applied-jobs/create', [App\Http\Controllers\Freelancer\AppliedJobController::class, 'create'])->name('applied-jobs.create');
    Route::post('/applied-jobs', [App\Http\Controllers\Freelancer\AppliedJobController::class, 'store'])->name('applied-jobs.store');
    Route::get('/applied-jobs/{candidate}', [App\Http\Controllers\Freelancer\AppliedJobController::class, 'show'])->name('applied-jobs.show');
    Route::put('/applied-jobs/{candidate}/update-photo', [App\Http\Controllers\Freelancer\AppliedJobController::class, 'updatePhoto'])->name('applied-jobs.update-photo');
    Route::get('/profile', [App\Http\Controllers\Freelancer\ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [App\Http\Controllers\Freelancer\ProfileController::class, 'update'])->name('profile.update');

    // Services Management
    Route::resource('services', App\Http\Controllers\Freelancer\ServiceController::class);
    Route::patch('services/{service}/toggle-status', [App\Http\Controllers\Freelancer\ServiceController::class, 'toggleStatus'])->name('services.toggle-status');
    Route::patch('services/{service}/toggle-featured', [App\Http\Controllers\Freelancer\ServiceController::class, 'toggleFeatured'])->name('services.toggle-featured');

    // Jobs Management
    Route::resource('jobs', App\Http\Controllers\Freelancer\JobListingController::class);
    Route::get('jobs-browse', [App\Http\Controllers\Freelancer\JobListingController::class, 'browse'])->name('jobs.browse');
    Route::patch('jobs/{job}/toggle-status', [App\Http\Controllers\Freelancer\JobListingController::class, 'toggleStatus'])->name('jobs.toggle-status');
    Route::patch('jobs/{job}/toggle-featured', [App\Http\Controllers\Freelancer\JobListingController::class, 'toggleFeatured'])->name('jobs.toggle-featured');

    // Book Services Management
    Route::resource('book-services', App\Http\Controllers\Freelancer\BookServiceController::class);

    // Notifications Management
    Route::get('notifications', [App\Http\Controllers\Freelancer\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('notifications/{id}/mark-as-read', [App\Http\Controllers\Freelancer\NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
    Route::post('notifications/mark-all-read', [App\Http\Controllers\Freelancer\NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::delete('notifications/delete-all-read', [App\Http\Controllers\Freelancer\NotificationController::class, 'deleteAllRead'])->name('notifications.delete-all-read');
    Route::delete('notifications/{id}', [App\Http\Controllers\Freelancer\NotificationController::class, 'destroy'])->name('notifications.destroy');

});
// User Routes
Route::prefix('user')->name('user.')->middleware(['auth', 'account_type:user'])->group(callback: function () {
    Route::get('services/create', [App\Http\Controllers\User\ServiceController::class, 'create'])->name('services.create');
    Route::get('/', [App\Http\Controllers\User\UserController::class, 'dashboard'])->name('dashboard');

    // Profile Management
    Route::get('/profile', [App\Http\Controllers\User\ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [App\Http\Controllers\User\ProfileController::class, 'update'])->name('profile.update');

    // Services Management
    Route::resource('services', App\Http\Controllers\User\ServiceController::class);
    Route::patch('services/{service}/toggle-status', [App\Http\Controllers\User\ServiceController::class, 'toggleStatus'])->name('services.toggle-status');
    Route::patch('services/{service}/toggle-featured', [App\Http\Controllers\User\ServiceController::class, 'toggleFeatured'])->name('services.toggle-featured');

    // Jobs Management
    Route::resource('jobs', App\Http\Controllers\User\JobListingController::class);
    Route::post('jobs/select-category', [App\Http\Controllers\User\JobListingController::class, 'selectCategory'])->name('jobs.select-category');
    Route::patch('jobs/{job}/toggle-status', [App\Http\Controllers\User\JobListingController::class, 'toggleStatus'])->name('jobs.toggle-status');
    Route::patch('jobs/{job}/toggle-featured', [App\Http\Controllers\User\JobListingController::class, 'toggleFeatured'])->name('jobs.toggle-featured');

    // Book Services Management
    Route::resource('book-services', App\Http\Controllers\User\BookServiceController::class);
    Route::patch('book-services/{bookService}/update-status', [App\Http\Controllers\User\BookServiceController::class, 'updateStatus'])->name('book-services.update-status');

    // Notifications Management
    Route::get('notifications', [App\Http\Controllers\User\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('notifications/{id}/mark-as-read', [App\Http\Controllers\User\NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
    Route::post('notifications/mark-all-read', [App\Http\Controllers\User\NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::delete('notifications/delete-all-read', [App\Http\Controllers\User\NotificationController::class, 'deleteAllRead'])->name('notifications.delete-all-read');
    Route::delete('notifications/{id}', [App\Http\Controllers\User\NotificationController::class, 'destroy'])->name('notifications.destroy');

    // Received Applications Management
    Route::get('applications', [App\Http\Controllers\User\ReceivedApplicationController::class, 'index'])->name('applications.index');
    Route::get('applications/{application}', [App\Http\Controllers\User\ReceivedApplicationController::class, 'show'])->name('applications.show');
    Route::patch('applications/{application}/update-status', [App\Http\Controllers\User\ReceivedApplicationController::class, 'updateStatus'])->name('applications.update-status');
    Route::delete('applications/{application}', [App\Http\Controllers\User\ReceivedApplicationController::class, 'destroy'])->name('applications.destroy');

});

Route::get('/terms', function () {
    return view('legal.terms');
});
Route::get('/_gdpr', function () {
    return view('legal._gdpr');
});
Route::get('/privacy-policy', function () {
    return view('legal.privacy');
});
// Route for freelancer job browsing
Route::middleware(['auth', 'account_type:freelancer'])->group(function () {
    Route::get('/browse-jobs', [App\Http\Controllers\Freelancer\JobController::class, 'index'])->name('freelancer.browse-jobs');
});

// Rating Routes
Route::get('/reviews', [RatingController::class, 'index'])->name('rating.index');
Route::post('/reviews/submit', [RatingController::class, 'store'])->name('rating.store');
Route::get('/reviews/statistics/{userId}', [RatingController::class, 'getStatistics'])->name('rating.statistics');
// Storage Link Route (for live server without command line access)
Route::get('/storage-link', function () {
    try {
        // Remove existing link if it exists
        if (file_exists(public_path('storage')) && is_link(public_path('storage'))) {
            unlink(public_path('storage'));
        }
        $exitCode = Artisan::call('storage:link');
        $commandOutput = Artisan::output();
        if ($exitCode === 0) {
            return response()->json([
                'success' => true,
                'message' => 'Storage link created/refreshed successfully!',
                'output' => $commandOutput,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create storage link.',
                'output' => $commandOutput,
            ]);
        }
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to create storage link: '.$e->getMessage(),
        ], 500);
    }
})->name('storage.link');
Route::middleware('auth')->group(function () {
    // Get user's existing review
    Route::get('/reviews/user-review', [RatingController::class, 'getUserReview'])->name('rating.user-review');
    // Update rating - only by the rater
    Route::put('/reviews/{ratingId}', [RatingController::class, 'update'])->name('rating.update');
    // Delete rating - only by the rater
    Route::delete('/reviews/{ratingId}', [RatingController::class, 'delete'])->name('rating.delete');
});

// Rating Display Page (Demo with dummy data)
Route::get('/rating-display', function () {
    return view('rating.display');
})->name('rating.display');

Route::get('/make-blog-storage', function (Request $request) {
    // Security: allow only in local or when you provide the correct secret token
    if (app()->environment('production') && $request->query('key') !== env('MAINTENANCE_KEY')) {
        abort(403, 'Forbidden');
    }

    // Optionally require auth and specific user id / role (uncomment if needed)
    // if (! Auth::check() || Auth::user()->account_type !== 'admin') {
    //     abort(403, 'Admin only');
    // }

    $path = storage_path('app/public/testimonials');
    $path = storage_path('app/public/blogs');

    try {
        \Illuminate\Support\Facades\File::ensureDirectoryExists($path, 0775);
        // set permissions (may require proper server config)
        @chmod($path, 0775);

        return response()->json([
            'status' => 'ok',
            'message' => 'Directory ensured: '.$path,
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
        ], 500);
    }
});
