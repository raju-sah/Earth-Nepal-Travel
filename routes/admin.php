<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\BaseMenuController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\BookingFormController;
use App\Http\Controllers\Admin\CommonFaqController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\DestinationCategoryController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\EquipmentController;
use App\Http\Controllers\Admin\EssentialInfoController;
use App\Http\Controllers\Admin\IconController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\IncludeExcludeController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\ItineraryController;
use App\Http\Controllers\Admin\ItineraryDetailController;
use App\Http\Controllers\Admin\JourneyController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\NewsLetterController;
use App\Http\Controllers\Admin\OurServiceController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PackageFaqController;
use App\Http\Controllers\Admin\PackageGalleryController;
use App\Http\Controllers\Admin\PackageReviewController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\SeasonController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\Setting\SeoSettingController;
use App\Http\Controllers\Admin\Setting\SiteSettingController;
use App\Http\Controllers\Admin\Setting\SmtpSettingController;
use App\Http\Controllers\Admin\Setting\SocialMediaSettingController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TravelDiaryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    //---------------------------------------- HOME REPORT --------------------------------------
    Route::get('/get-package-based-inquiries', [HomeController::class, 'packageBasedInquiries'])->name('package-based-inquiries');
    Route::get('/get-top-rated-packages', [HomeController::class, 'topRatedPackages'])->name('top-rated-packages');

    //---------------------------------------- PROFILE ------------------------------------------
    Route::get('profile', [ProfileController::class, 'index'])->name('profiles.index');
    Route::patch('profile-update', [ProfileController::class, 'update'])->name('profiles.update');

    //---------------------------------------- GALLERIES/IMAGES -----------------------------------
    Route::delete('delete-gallery-image', [ImageController::class, 'destroy'])->name('delete-gallery-image');
    Route::delete('delete-single-image', [ImageController::class, 'destroySingleImage'])->name('delete-single-image');
    Route::delete('delete-repeating-item', [ImageController::class, 'deleteRepeaterItem'])->name('delete-repeating-item');

    //---------------------------------------- DESTINATIONS ----------------------------------------
    Route::get('status-change-destination', [DestinationController::class, 'changeStatus'])->name('status-change-destination');
    Route::resource('destinations', DestinationController::class);
    Route::post('destinations/import-excel', [DestinationController::class, 'importExcel'])->name('destinations.import-excel');

    //---------------------------------------- DESTINATION CATEGORIES -------------------------------
    Route::get('status-change-destination_category', [DestinationCategoryController::class, 'changeStatus'])->name('status-change-destination_category');
    Route::resource('destination-categories', DestinationCategoryController::class);

    //---------------------------------------- ACTIVITIES --------------------------------------------
    Route::get('status-change-activity', [ActivityController::class, 'changeStatus'])->name('status-change-activity');
    Route::resource('activities', ActivityController::class);

    //---------------------------------------- ADMIN USERS --------------------------------------------
    Route::get('status-change-admin-user', [AdminUserController::class, 'changeStatus'])->name('status-change-admin-user');
    Route::prefix('setting')->name('setting.')->group(function () {
        //-------------------------- SITE SETTING -----------------------------------------------------
        Route::get('/company-setting', [SiteSettingController::class, 'getCompanyDetails'])->name('company');
        Route::put('/company/update/{id?}', [SiteSettingController::class, 'updateCompanyDetails'])->name('company.update');

        //-------------------------- SEO SETTING ------------------------------------------------------
        Route::get('/seo-setting', [SeoSettingController::class, 'getSeoDetails'])->name('seo');
        Route::put('/seo/update/{id?}', [SeoSettingController::class, 'updateSeoDetails'])->name('seo.update');

        //-------------------------- SOCIAL MEDIA SETTING ----------------------------------------------
        Route::resource('social-media-settings', SocialMediaSettingController::class);

        //-------------------------- SMTP SETTING -----------------------------------------------------
        Route::get('/smtp-setting', [SmtpSettingController::class, 'getSmtpDetails'])->name('smtp');
        Route::put('/smtp/update/{id?}', [SmtpSettingController::class, 'updateSmtpDetails'])->name('smtp.update');
    });

    //---------------------------------------- BLOGS --------------------------------------------------
    Route::get('status-change-blog', [BlogController::class, 'changeStatus'])->name('status-change-blog');
    Route::resource('blogs', BlogController::class);

    //---------------------------------------- INQUIRY -------------------------------------------------
    Route::get('inquiry-notification/{inquiry}', [InquiryController::class, 'inquiryNotification'])->name('inquiry-notification');
    Route::resource('inquiries', InquiryController::class)->except('create', 'store', 'edit', 'update');
    Route::post('/inquiry-update-status/{id}', [InquiryController::class, 'updateInquiryStatus'])->name('inquiry-update-status');

    //-------------------------- TESTIMONIALS ----------------------------------------------------------
    Route::get('status-change-testimonial', [TestimonialController::class, 'changeStatus'])->name('status-change-testimonial');
    Route::resource('testimonials', TestimonialController::class)->except('create', 'store', 'edit', 'update');
    Route::get('testimonials-notification/{testimonial}', [TestimonialController::class, 'testimonialNotification'])->name('testimonials-notification');


    //---------------------------------------- ADMIN USERS ---------------------------------------------
    Route::get('status-change-admin-user', [AdminUserController::class, 'changeStatus'])->name('status-change-admin-user');
    Route::resource('users', AdminUserController::class);

    //---------------------------------------- ROLE PERMISSIONS ----------------------------------------
    Route::get('get-role-based-permissions', RolePermissionController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);

    //---------------------------------------- SEASONS -------------------------------------------------
    Route::get('status-change-seasons', [SeasonController::class, 'changeStatus'])->name('status-change-seasons');
    Route::resource('seasons', SeasonController::class);

    //---------------------------------------- SERVICES ------------------------------------------------
    Route::get('status-change-service', [ServiceController::class, 'changeStatus'])->name('status-change-service');
    Route::resource('services', ServiceController::class);

    //---------------------------------------- ICONS ---------------------------------------------------
    Route::resource('icons', IconController::class);

    //---------------------------------------- JOURNEY GROUPS ------------------------------------------------
    Route::get('status-change-journey', [JourneyController::class, 'changeStatus'])->name('status-change-journey');
    Route::resource('journeys', JourneyController::class);

    //---------------------------------------- PACKAGES ------------------------------------------------
    Route::get('status-change-package', [PackageController::class, 'changeStatus'])->name('status-change-package');
    Route::resource('packages', PackageController::class);
    Route::post('packages/import-excel', [PackageController::class, 'importExcel'])->name('packages.import-excel');
    Route::get('packages/get-journey/{type}', [PackageController::class, 'dependentJourniesCreate'])->name('packages.get-journey');
    // Route::get('packages/{package}/get-edit-journey/{type}', [PackageController::class, 'dependentJourniesEdit'])->name('get-edit-journey');
    Route::get('packages/{package}/get-edit-journey/{type}', [PackageController::class, 'dependentJourniesEdit'])->name('get-edit-journey');

    //---------------------------------------- Reviews ------------------------------------------------
    Route::get('status-change-package_review', [PackageReviewController::class, 'changeStatus'])->name('status-change-package_review');
    Route::get('show-package-review/{package_review}', [PackageReviewController::class, 'showPackageReview'])->name('package-reviews.show-page');
    Route::resource('package-reviews', PackageReviewController::class)->only('index', 'show', 'destroy');

    //---------------------------------------- PACKAGE GALLERY ------------------------------------------
    Route::get('packages/{package}/packages-gallery/edit', [PackageGalleryController::class, 'edit'])->name('packages.packages-gallery.edit');
    Route::patch('packages/{package}/packages-gallery/update', [PackageGalleryController::class, 'update'])->name('packages.packages-gallery.update');
    Route::resource('packages.packages-gallery', PackageGalleryController::class)->only('create', 'store');

    //---------------------------------------- PACKAGE INCLUDE EXCLUDE -----------------------------------
    Route::resource('packages.include-excludes', IncludeExcludeController::class)->except('index', 'show');

    //---------------------------------------- COMMON FAQ ------------------------------------------------
    Route::get('status-change-common-faq', [CommonFaqController::class, 'changeStatus'])->name('status-change-common-faq');
    Route::resource('common-faqs', CommonFaqController::class);

    //---------------------------------------- PACKAGE FAQ -----------------------------------------------
    Route::get('status-change-package_faq', [PackageFaqController::class, 'changeStatus'])->name('status-change-package_faq');
    Route::resource('packages.package_faqs', PackageFaqController::class)->except('show');
    Route::post('packages/{package}/package_faq/row-reorder', [PackageFaqController::class, 'rowReorder'])->name('packages.package_faq.row-reorder');
    Route::post('packages/{package}/package_faq/store-common-faqs', [PackageFaqController::class, 'storeCommonFaqs'])->name('packages.package-faq.store-common-faqs');
    Route::delete('packages/{package}/package_faq/{package_faq}/bulk-delete', [PackageFaqController::class, 'bulkDelete'])->name('packages.package_faqs.bulk-delete');

    //---------------------------------------- PACKAGE ESSENTIAL INFO -------------------------------------
    Route::resource('packages.essential-infos', EssentialInfoController::class)->except('index', 'show');

    //---------------------------------------- PACKAGE EQUIPMENT ------------------------------------------
    Route::resource('packages.equipment', EquipmentController::class)->except('show');
    Route::post('packages.equipment/import-excel', [EquipmentController::class, 'importExcel'])->name('packages.equipment.import-excel');
    Route::post('packages/{package}/equipment/row-reorder', [EquipmentController::class, 'rowReorder'])->name('packages.equipment.row-reorder');
    Route::delete('packages/{package}/equipment/{equipment}/bulk-delete', [EquipmentController::class, 'bulkDelete'])->name('packages.equipment.bulk-delete');

    //---------------------------------------- PACKAGE ITINERARY -------------------------------------------
    Route::post('packages/{package}/itineraries/row-reorder', [ItineraryController::class, 'rowReorder'])->name('packages.itineraries.row-reorder');
    Route::resource('packages.itineraries', ItineraryController::class)->except('show');
    Route::post('packages.itineraries/import-excel', [ItineraryController::class, 'importExcel'])->name('packages.itineraries.import-excel');
    Route::delete('packages/{package}/itineraries/{itinerary}/bulk-delete', [ItineraryController::class, 'bulkDelete'])->name('packages.itineraries.bulk-delete');

    //---------------------------------------- PACKAGE ITINERARY DETAILS -------------------------------------
    Route::post('packages/{package}/itinerary-details/row-reorder', [ItineraryDetailController::class, 'rowReorder'])->name('packages.itinerary-details.row-reorder');
    Route::resource('packages.itinerary-details', ItineraryDetailController::class)->except('show');
    Route::delete('packages/{package}/itinerary-details/{itinerary_detail}/bulk-delete', [ItineraryDetailController::class, 'bulkDelete'])->name('packages.itinerary-details.bulk-delete');

    //---------------------------------------- PAGES ---------------------------------------------------------
    Route::get('status-change-page', [PageController::class, 'changeStatus'])->name('status-change-page');
    Route::resource('pages', PageController::class);
    //---------------------------------------- TEAM ----------------------------------------------------------
    Route::get('status-change-team', [TeamController::class, 'changeStatus'])->name('status-change-team');
    Route::resource('teams', TeamController::class);

    //---------------------------------------- ABOUT ----------------------------------------------------------
    Route::resource('abouts', AboutController::class)->only('create', 'store', 'edit', 'update');

    //---------------------------------------- OUR SERVICES ---------------------------------------------------
    Route::resource('our-services', OurServiceController::class)->only('create', 'store', 'edit', 'update');

    //---------------------------------------- BASE MENU ------------------------------------------------------
    Route::get('base-menus', [BaseMenuController::class, 'index'])->name('base-menus.index');

    //---------------------------------------- MENU ------------------------------------------------------------
    Route::get('get-data-by-model', [MenuController::class, 'getDataByModel'])->name('get-data-by-model');
    Route::resource('base-menus.menus', MenuController::class);

    //---------------------------------------- BOOKING FORM ----------------------------------------------------
    Route::resource('booking-forms', BookingFormController::class)->only('create', 'store', 'edit', 'update');

    //---------------------------------------- CONTACT US Page--------------------------------------------------
    Route::resource('contact-uses', ContactUsController::class)->only('create', 'store', 'edit', 'update');

    //---------------------------------------- TRAVEL DIARY ----------------------------------------------------
    Route::resource('travel-diaries', TravelDiaryController::class)->only('create', 'store', 'edit', 'update');

    //---------------------------------------- REPORTS --------------------------------------------------------
    Route::get('package/reports', [ReportController::class, 'packageReport'])->name('package-reports.index');
    Route::get('package/filters', [ReportController::class, 'reportFilter'])->name('package-reports.filters');
    Route::get('/generate-pdf', [ReportController::class, 'generatePDF'])->name('package.generate-pdf');

    //---------------------------------------- Email Templates --------------------------------------------------
    Route::post('email-reply', [EmailTemplateController::class, 'emailReply'])->name('email-reply');
    Route::get('fetch-email-template', [EmailTemplateController::class, 'fetchEmailTemplate'])->name('fetch-email-template');
    Route::resource('email-templates', EmailTemplateController::class);

    //---------------------------------------- Partners --------------------------------------------------
    Route::resource('partners', PartnerController::class);
    Route::get('status-change-partner', [PartnerController::class, 'changeStatus'])->name('status-change-partner');


    //---------------------------------------- Bookings --------------------------------------------------
    Route::get('booking-notification/{booking}', [BookingController::class, 'bookingNotification'])->name('booking-notification');
    Route::post('bookings-status-update', [BookingController::class, 'updateStatus'])->name('bookings-status-update');
    Route::resource('bookings', BookingController::class);

    //---------------------------------------- News Letter --------------------------------------------------
    Route::resource('newsletters', NewsLetterController::class)->only('index', 'destroy');
    Route::get('newsletters-notification/{newsletter}', [NewsLetterController::class, 'newsletterNotification'])->name('newsletters-notification');

    //---------------------------------------- Notification List -------------------------------------------------
    Route::get('all-notifications', function () {
        return view('admin.notifications.index', [
            'notifications' => auth()->user()->notifications
        ]);
    })->name('all-notifications');
});
