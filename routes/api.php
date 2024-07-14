<?php

use App\Http\Controllers\Api\v1\PackageReviewApiController;
use App\Http\Controllers\Api\v1\PartnerApiController;
use App\Http\Controllers\Api\v1\TeamApiController;
use App\Http\Controllers\Api\v1\ActivityApiController;
use App\Http\Controllers\Api\v1\BlogApiController;
use App\Http\Controllers\Api\v1\BookingApiController;
use App\Http\Controllers\Api\v1\BookingFormPageApiController;
use App\Http\Controllers\Api\v1\ContactUsPageApiController;
use App\Http\Controllers\Api\v1\DestinationApiController;
use App\Http\Controllers\Api\v1\DestinationCategoryApiController;
use App\Http\Controllers\Api\v1\InquiryFormApiController;
use App\Http\Controllers\Api\v1\MenuApiController;
use App\Http\Controllers\Api\v1\NewsLetterApiController;
use App\Http\Controllers\Api\v1\OurServicePageApiController;
use App\Http\Controllers\Api\v1\PackageApiController;
use App\Http\Controllers\Api\v1\SeasonApiController;
use App\Http\Controllers\Api\v1\ServiceApiController;
use App\Http\Controllers\Api\v1\TestimonialApiController;
use App\Http\Controllers\Api\v1\TravelDiaryPageApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//------------------------------------------ ACTIVITIES --------------------------------------
Route::get('activities', [ActivityApiController::class, 'index'])->summary('get list of activities.')->description('Get list of activities with per_page(optional, default all) pagination and is_exclusive(optional, default all) it can be Yes or No.');
Route::get('activities/{slug}', [ActivityApiController::class, 'show'])->summary('get activity using slug.')->description('Get activity using slug.');
Route::get('activity-package/{slug}', [ActivityApiController::class, 'getPackage'])->summary('get activity package using slug.')->description('Get activity package using slug with per_page(optional, default all) pagination.');
Route::get('activity-destination/{slug}', [ActivityApiController::class, 'getDestination'])->summary('get activity destination using slug.')->description('Get activity destination using slug with per_page(optional, default all) pagination.');

//------------------------------------------ BLOGS --------------------------------------
Route::get('blogs', [BlogApiController::class, 'index'])->summary('get list of blogs.')->description('Get list of blogs with per_page(optional, default all) pagination.');
Route::get('blogs/{slug}', [BlogApiController::class, 'show'])->summary('get blog details using slug.')->description('Get blog details using slug.');

//------------------------------------------ DESTINATIONS --------------------------------------
Route::get('destinations', [DestinationApiController::class, 'index'])->summary('get list of destinations.')->description('Get list of destinations with per_page(optional, default all) pagination.');
Route::get('destinations/{slug}', [DestinationApiController::class, 'show'])->summary('get destination details using slug.')->description('Get destination details using slug.');
Route::get('destination-package/{slug}', [DestinationApiController::class, 'getPackage'])->summary('get destination packages using slug.')->description('Get destination packages using slug with per_page(optional, default all) pagination.');
Route::get('destination-activity/{slug}', [DestinationApiController::class, 'getActivity'])->summary('get destination activities using slug.')->description('Get destination activities using slug with per_page(optional, default all) pagination.');

//------------------------------------------DESTINATION CATEGORIES --------------------------------------
Route::get('destination-categories', [DestinationCategoryApiController::class, 'index'])->summary('get list of destination categories.')->description('Get list of destination categories with per_page(optional, default all) pagination.');
Route::get('destination-categories-destinations/{slug}', [DestinationCategoryApiController::class, 'getDestinations'])->summary('get list of destination category destinations.')->description('Get list of destination category destinations with per_page(optional, default all) pagination.');

//------------------------------------------ MENU --------------------------------------
Route::get('top-menu', [MenuApiController::class, 'getTopMenu'])->summary('get list of top menu.')->description('Get list of top menu');
Route::get('footer-menu', [MenuApiController::class, 'getFooterMenu'])->summary('get list of footer menu.')->description('Get list of footer menu');

// //------------------------------------------ PACKAGES --------------------------------------
Route::get('packages', [PackageApiController::class, 'index'])->summary('get list of packages.')->description('Get list of packages with pagination and type filter.Both per_page and type are optional.per_page is number of package per page by default is all packages. type is package type. type can be: "trekking", "tour", "travel", "adventure".');
Route::get('packages/{slug}', [PackageApiController::class, 'show'])->summary('get package details using slug.')->description('Get package details using slug.');
Route::get('package-activity/{slug}', [PackageApiController::class, 'getActivity'])->summary('get package activities using slug.')->description('Get package activities using slug.');
Route::get('package-destination/{slug}', [PackageApiController::class, 'getDestination'])->summary('get package destination using slug.')->description('Get package destination using slug.');
Route::get('package-service/{slug}', [PackageApiController::class, 'getService'])->summary('get package service using slug.')->description('Get package service using slug.');
Route::get('package-season/{slug}', [PackageApiController::class, 'getSeason'])->summary('get package season using slug.')->description('Get package season using slug.');

//------------------------------------------ PARTNER --------------------------------------
Route::get('partners', [PartnerApiController::class, 'index'])->summary('get list of partners.')->description('Get list of partners with per_page(optional, default all) pagination.');

//------------------------------------------ SEASONS --------------------------------------
Route::get('seasons', [SeasonApiController::class, 'index'])->summary('get list of seasons.')->description('Get list of seasons with per_page(optional, default all) pagination.');
Route::get('seasons-packages/{type}', [SeasonApiController::class, 'getPackages'])->summary('get list of packages by season type.')->description('Get list of packages by season type with pagination.');

// //------------------------------------------ SERVICES --------------------------------------
Route::get('services', [ServiceApiController::class, 'index'])->summary('get list of services.')->description('Get list of services with per_page(optional, default all) pagination.');
Route::get('services-packages/{slug}', [ServiceApiController::class, 'getPackages'])->summary('get list of packages by service slug.')->description('Get list of packages by service slug with per_page(optional, default all) pagination.');

//------------------------------------------ TEAM --------------------------------------
Route::get('teams', [TeamApiController::class, 'index'])->summary('get list of teams.')->description('Get list of teams with per_page(optional, default all) pagination.');

//------------------------------------------ BOOKING FORM PAGE --------------------------------------
Route::get('booking-form-page', [BookingFormPageApiController::class, 'index'])->summary('get booking form page.')->description('Get booking form page.');

//------------------------------------------ CONTACT US PAGE --------------------------------------
Route::get('contact-us-page', [ContactUsPageApiController::class, 'index'])->summary('get contact us page.')->description('Get contact us page.');

//------------------------------------------ OUR SERVICE PAGE --------------------------------------
Route::get('our-services', [OurServicePageApiController::class, 'index'])->summary('get our service page.')->description('Get our service page.');

//------------------------------------------ TRAVEL DIARY PAGE --------------------------------------
Route::get('travel-diary-page', [TravelDiaryPageApiController::class, 'index'])->summary('get travel diary page.')->description('Get travel diary page.');

//------------------------------------------ BOOKING POST --------------------------------------
Route::post('booking', [BookingApiController::class, 'store'])->summary('Create booking.')->description('Create booking.');

//------------------------------------------ INQUIRY FORM POST --------------------------------------
Route::post('inquiry', [InquiryFormApiController::class, 'store'])->summary('Create inquiry.')->description('Create inquiry.');

//------------------------------------------ NEWS LETTER POST --------------------------------------
Route::post('news-letter', [NewsLetterApiController::class, 'store'])->summary('Create news letter.')->description('Create news letter.');

//------------------------------------------ PACKAGE REVIEW POST --------------------------------------
Route::post('package-reviews', [PackageReviewApiController::class, 'store'])->summary('Create package review.')->description('Create package review.');

//------------------------------------------ TESTIMONIAL  --------------------------------------
Route::post('testimonials', [TestimonialApiController::class, 'store'])->summary('Create testimonial.')->description('Create testimonial.');
