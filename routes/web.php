<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('locale/{lang}', function ($lang) {
    $available = ['en', 'hi'];
    if (in_array($lang, $available)) {
        Session::put('locale', $lang);
    }
    return redirect()->back();
})->name('change.language');

Route::middleware(['guest'])->group(function () {
    include "Admin/auth.php";
    Route::get('/', '\App\Http\Controllers\User\DashboardController@home')->name('home.index');
    Route::get('/news-events', '\App\Http\Controllers\User\DashboardController@newsEvents')->name('newsEvents');
    Route::get('/news-event-details/{id?}', '\App\Http\Controllers\User\DashboardController@newsEventDetails')->name('newsEventDetails');
    Route::get('/notices', '\App\Http\Controllers\User\DashboardController@notices')->name('notices');
    Route::get('/testing-service', '\App\Http\Controllers\User\DashboardController@testingService')->name('testingService');

    Route::get('/testing-service-detail/{slug}', '\App\Http\Controllers\User\DashboardController@testServiceDetails')->name('testServiceDetails');

    Route::match(['get','post'],'/test-service-category-detail/{slug}', '\App\Http\Controllers\User\DashboardController@testServiceCategoryDetails')->name('testServiceCategoryDetails');

    Route::get('/notice-details/{id?}', '\App\Http\Controllers\User\DashboardController@noticeDetails')->name('noticeDetails');
    Route::get('/search', '\App\Http\Controllers\User\DashboardController@search')->name('search');

    Route::get('/page/details/{slug?}', '\App\Http\Controllers\User\DashboardController@screenReaderDetail')->name('screenReaderDetail');
    Route::get('/order-forms', '\App\Http\Controllers\User\DashboardController@orderForms')->name('orderForms');
    
    Route::get('/gallery', function () {
        $query = request()->query();
        
        $query = request()->query();
        if (isset($query['id'])){
            $images = \App\Models\Admin\Gallery::whereId($query['id'])->orderBy('id', 'asc')->first();
        }
        else{
           $images =  \App\Models\Admin\Gallery::where('status','=',1)->orderBy('id', 'asc')->first();
        }
        return view('front.gallery',['images'=>$images->image??""]);
    })->name('gallery');

    Route::get('/video-gallery', function () {
        $query = request()->query();
        
        $query = request()->query();
        if (isset($query['id'])){
            $videos = \App\Models\Admin\VideoGallery::whereId($query['id'])->orderBy('id', 'asc')->first();
        }
        else{
           $videos =  \App\Models\Admin\VideoGallery::where('status','=',1)->orderBy('id', 'asc')->first();
        }
        return view('front.videoGallery',['videos'=>$videos->video??""]);
    })->name('videoGallery');

    Route::get('/about-us', function () {
        return view('front.aboutUs');
    })->name('aboutUs');

    Route::get('/contact-us', function () {
        return view('front.contactUs');
    })->name('contactUs');

    Route::post('/contact-us/add', '\App\Http\Controllers\Admin\ContactUsController@add')
    ->name('contactUs.add');

    Route::get('/mobile-form', '\App\Http\Controllers\User\UsersController@mobileForm')
    ->name('mobile.form');

    Route::post('/mobile-send-otp', '\App\Http\Controllers\User\UsersController@sendMobileOtp')
    ->name('mobile.sendOtp');

    Route::post('/mobile-verify', '\App\Http\Controllers\User\UsersController@verifyMobileOtp')
    ->name('mobile.verify');

    Route::get('/email-form/{id}', '\App\Http\Controllers\User\UsersController@emailForm')
    ->name('email.form');

    Route::post('/email-send-otp', '\App\Http\Controllers\User\UsersController@sendEmailOtp')
    ->name('email.sendOtp');

    Route::post('/email-verify', '\App\Http\Controllers\User\UsersController@verifyEmailOtp')
    ->name('email.verify');

    Route::get('/registration', '\App\Http\Controllers\User\UsersController@registrationForm')
    ->name('registration.form');

    Route::post('/registration/store', '\App\Http\Controllers\User\UsersController@store')
    ->name('registration.store');

    Route::get('/confirmation', '\App\Http\Controllers\User\UsersController@confirmation')
    ->name('registration.confirmation');

    Route::get('/partner-login', '\App\Http\Controllers\User\UsersController@partnerLoginForm')
    ->name('partner.login.form');

    Route::get('/get-districts/{state_id}', '\App\Http\Controllers\User\UsersController@getDistricts')
    ->name('districts.get');

    Route::post('/login/send-otp', '\App\Http\Controllers\User\LoginController@sendOtp')
    ->name('login.sendOtp');
    Route::post('/login/verify-otp', '\App\Http\Controllers\User\LoginController@verifyOtp')
    ->name('login.verifyOtp');

    Route::get('/logout', '\App\Http\Controllers\User\LoginController@logout')
    ->name('logout');
});

Route::prefix('user')->middleware(['auth'])->group(function () {
    // include "user/dashboard.php";
});

Route::prefix('user')->middleware(['partnerAdminAuth'])->group(function () {
    include "PartnerAdmin/dashboard.php";
    include "PartnerAdmin/manageCenter.php";
    include "PartnerAdmin/batches.php";
    include "PartnerAdmin/participants.php";
    include "PartnerAdmin/profile.php";
    include "PartnerAdmin/actions.php";
    include "PartnerAdmin/testManagements.php";
});

Route::prefix('admin')->middleware(['adminAuth'])->group(function () {
    include "Admin/dashboard.php";
    include "Admin/admins.php";
    include "Admin/users.php";
    include "Admin/pages.php";
    include "Admin/profile.php";
    include "Admin/blogs.php";
    include "Admin/emailTemplates.php";
    include "Admin/actions.php";
    include "Admin/activities.php";
    include "Admin/settings.php";
    include "Admin/testimonial.php";
    include "Admin/aboutUs.php";
    include "Admin/headerMenu.php";
    include "Admin/footerMenu.php";
    include "Admin/menu.php";
    include "Admin/sliderMenu.php";
    include "Admin/homePage.php";
    include "Admin/contactUs.php";
    include "Admin/gallery.php";
    include "Admin/newsEvents.php";
    include "Admin/notices.php";
    include "Admin/videoGallery.php";
    include "Admin/headerAds.php";
    include "Admin/manageCenter.php";
    include "Admin/batches.php";
    include "Admin/participants.php";
    include "Admin/userManagement.php";
    include "Admin/states.php";
    include "Admin/district.php";
    include "Admin/testingServices.php";
    include "Admin/testingServiceContent.php";
    include "Admin/testServiceCategories.php";
    include "Admin/serviceCategoryWiseTests.php";
    include "Admin/testManagements.php";    
    include "Admin/labManagements.php";    

});