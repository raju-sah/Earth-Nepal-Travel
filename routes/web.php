<?php

use App\Http\Controllers\Front\BookingController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\DestinationController;
use App\Http\Controllers\Front\FaqController;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\IntroductionController;
use App\Http\Controllers\Front\MenuController;
use App\Http\Controllers\Front\NewsLetterController;
use App\Http\Controllers\Front\PackageController;
use App\Http\Controllers\Front\ServiceController;
use App\Http\Controllers\Front\TeamController;
use App\Http\Controllers\Front\TestimonialController;
use App\Http\Controllers\HomeController;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('cmd', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    echo "Success !!";
});


Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/notifications/{notification}', function (DatabaseNotification $notification) {
    $notification->markAsRead();
})->name('mark_as_read');

Route::get('mark-all-as-read', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return back();
})->name('mark_all_as_read');

// Unwanted route
Route::post('/contact-post', [HomeController::class, 'contactPost'])->name('home.contact-post');

Route::get('/', [IndexController::class, 'index'])->name('front.home');

Route::prefix('front')->name('front.')->group(function () {
    Route::post('/newsletter', [NewsLetterController::class, 'store'])->name('newsletter');
    Route::resource('/testimonial', TestimonialController::class)->only(['index', 'store']);
    Route::get('/team', [TeamController::class, 'team'])->name('team.index');
    Route::resource('/contact', ContactController::class)->only(['index', 'store']);
    Route::get('/introduction', [IntroductionController::class, 'show'])->name('introduction.show');
    Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
    Route::resource('/packages', PackageController::class)->only(['index', 'show']);
    Route::get('/packages-search', [PackageController::class, 'search'])->name('packages.search');
    Route::get('services/hotel', [ServiceController::class, 'hotelBooking'])->name('services.hotel');
    Route::get('services/flight', [ServiceController::class, 'flightBooking'])->name('services.flight');
    Route::get('services/rafting', [ServiceController::class, 'raftingBooking'])->name('services.rafting');

    Route::get('/destinations/{country}', [DestinationController::class, 'show'])->name('destinations.show');

    Route::resource('/booking', BookingController::class)->only(['index', 'store']);
});
