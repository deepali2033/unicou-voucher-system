<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\RedemptionController;
use App\Http\Controllers\Admin\BonusController;
use App\Http\Controllers\Admin\ReferralController;
use App\Http\Controllers\Admin\ReferralCampaignController;
use App\Http\Controllers\Admin\RevenueController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\RefundController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\PersonalInfoController;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

// Email Verification Routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Auto-verify route for local environment
if (app()->environment('local')) {
    Route::get('/email/auto-verify', function (Request $request) {
        $user = $request->user();
        if ($user && !$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            $user->update(['status' => 'active']);
            return redirect('/home')->with('success', 'Email verified automatically!');
        }
        return redirect('/home');
    })->middleware('auth')->name('verification.auto');
}

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function() {
        return redirect('/' . auth()->user()->role);
    });

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Common Personal Info Form
    Route::get('/personal-info', [PersonalInfoController::class, 'create'])->name('profile.personal.form');
    Route::post('/personal-info', [PersonalInfoController::class, 'store'])->name('profile.personal.store');

<<<<<<< HEAD
    // Student Profile Form
    Route::get('/student-profile', [StudentProfileController::class, 'showForm'])->name('profile.student.form');
    Route::post('/student-profile', [StudentProfileController::class, 'store'])->name('profile.student.store');
});

=======
   
});

 // Student Profile Form
    Route::get('/student-profile', [StudentProfileController::class, 'showForm'])->name('forms.student.form');
    Route::post('/student-profile', [StudentProfileController::class, 'store'])->name('student.store');
>>>>>>> deepali
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'admin'])->middleware('role:admin');
    Route::get('/manager', [DashboardController::class, 'manager'])->middleware('role:manager');
    Route::get('/agent', [DashboardController::class, 'agent'])->middleware('role:agent');
    Route::get('/support', [DashboardController::class, 'support'])->middleware('role:support');
    Route::get('/student', [DashboardController::class, 'student'])->middleware('role:student');
    Route::get('/reseller_agent', [DashboardController::class, 'reseller_agent'])->middleware('role:reseller_agent');

    // Notification Routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::delete('/notifications/delete-all', [NotificationController::class, 'deleteAll'])->name('notifications.deleteAll');
    Route::post('/notifications/{id}/approve', [NotificationController::class, 'approve'])->name('notifications.approve');

    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

        Route::resource('vouchers', VoucherController::class, ['as' => 'admin']);
        Route::post('vouchers/{voucher}/freeze', [VoucherController::class, 'freeze'])->name('admin.vouchers.freeze');
        Route::post('vouchers/{voucher}/unfreeze', [VoucherController::class, 'unfreeze'])->name('admin.vouchers.unfreeze');
        
        Route::resource('coupons', CouponController::class, ['as' => 'admin']);
        Route::resource('redemptions', RedemptionController::class, ['as' => 'admin', 'only' => ['index', 'show']]);
        Route::resource('bonuses', BonusController::class, ['as' => 'admin']);
        
        Route::resource('referral-campaigns', ReferralCampaignController::class, ['as' => 'admin']);
        Route::post('referral-campaigns/{referral_campaign}/freeze', [ReferralCampaignController::class, 'freeze'])->name('admin.referral-campaigns.freeze');
        Route::post('referral-campaigns/{referral_campaign}/unfreeze', [ReferralCampaignController::class, 'unfreeze'])->name('admin.referral-campaigns.unfreeze');
        
        Route::resource('referrals', ReferralController::class, ['as' => 'admin']);
        
        Route::resource('users', UserController::class, ['as' => 'admin']);
        Route::post('users/{user}/login-as', [UserController::class, 'loginAs'])->name('admin.users.login-as');
        Route::post('users/{user}/add-credit', [UserController::class, 'addCredit'])->name('admin.users.add-credit');

        Route::get('settings', [SettingsController::class, 'index'])->name('admin.settings.index');
        Route::post('settings/toggle-voucher', [SettingsController::class, 'toggleVoucherSystem'])->name('admin.settings.toggle-voucher');
        Route::post('settings/pause-voucher-system', [SettingsController::class, 'pauseVoucherSystem'])->name('admin.settings.pause-voucher-system');
        Route::post('settings/resume-voucher-system', [SettingsController::class, 'resumeVoucherSystem'])->name('admin.settings.resume-voucher-system');
        Route::post('settings/update', [SettingsController::class, 'update'])->name('admin.settings.update');
        
        Route::get('refunds', [RefundController::class, 'index'])->name('admin.refunds.index');
        Route::post('refunds/{refund}/approve', [RefundController::class, 'approve'])->name('admin.refunds.approve');
        Route::post('refunds/{refund}/reject', [RefundController::class, 'reject'])->name('admin.refunds.reject');

        // Revenue Routes
        Route::prefix('revenue')->group(function () {
            Route::get('/overview', [RevenueController::class, 'overview'])->name('admin.revenue.overview');
            Route::get('/balance', [RevenueController::class, 'balance'])->name('admin.revenue.balance');
            Route::get('/sales', [RevenueController::class, 'sales'])->name('admin.revenue.sales');
            Route::get('/credit', [RevenueController::class, 'credit'])->name('admin.revenue.credit');
            Route::get('/refunds', [RevenueController::class, 'refunds'])->name('admin.revenue.refunds');
            Route::get('/financial', [RevenueController::class, 'financial'])->name('admin.revenue.financial');
        });
    });

    Route::prefix('support')->middleware('role:support')->group(function () {
           Route::get('/dashboard', [DashboardController::class, 'support'])->name('admin.dashboard');
                Route::get('/document-form', [DashboardControlccler::class, 'DocumentForm'])->name('support.document');
        });

    Route::post('/stop-impersonation', [UserController::class, 'stopImpersonation'])->name('admin.users.stop-impersonation');
});
