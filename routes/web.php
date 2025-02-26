<?php
use App\Http\Controllers\Front\PackageController;
use App\Http\Controllers\Front\SingleTourController;
use App\Http\Controllers\Admin\AdminOfferController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\PrintFrontController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\PDF\PdfController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;



require_once __DIR__ . '/web_admin.php';
// Default homepage route without language prefix
Route::get('/', function () {
    $defaultLang = config('app.locale'); // Default language from config
    return redirect("/$defaultLang/turi");
})->name('home');
// User


Route::middleware('user')->prefix('user')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user_dashboard');
    Route::get('/booking', [UserController::class, 'booking'])->name('user_booking');
    Route::get('/review', [UserController::class, 'review'])->name('user_review');
    Route::get('/invoice/{invoice_no}', [UserController::class, 'invoice'])->name('user_invoice');
    Route::get('/profile', [UserController::class, 'profile'])->name('user_profile');
    Route::post('/profile', [UserController::class, 'profile_submit'])->name('user_profile_submit');
    Route::get('/wishlist', [UserController::class, 'wishlist'])->name('user_wishlist');
    Route::get('/wishlist-delete/{id}', [UserController::class, 'wishlist_delete'])->name('user_wishlist_delete');
    Route::get('/message', [UserController::class, 'message'])->name('user_message');
    Route::get('/message-start', [UserController::class, 'message_start'])->name('user_message_start');
    Route::post('/message-submit', [UserController::class, 'message_submit'])->name('user_message_submit');
});

// Registration And Login
Route::get('/registration', [FrontController::class, 'registration'])->name('registration');
Route::post('/registration', [FrontController::class, 'registration_submit'])->name('registration_submit');
Route::get('/logout', [FrontController::class, 'logout'])->name('logout');
Route::get('/registration-verify-email/{email}/{token}', [FrontController::class, 'registration_verify'])->name('registration_verify');

Route::get('/login', [FrontController::class, 'login'])->name('login');
Route::post('/login', [FrontController::class, 'login_submit'])->name('login_submit');
Route::get('/forget-password', [FrontController::class, 'forget_password'])->name('forget_password');
Route::post('/forget_password_submit', [FrontController::class, 'forget_password_submit'])->name('forget_password_submit');
Route::get('/reset-password/{email}/{token}', [FrontController::class, 'reset_password'])->name('reset_password');
Route::post('/reset-password/{email}/{token}', [FrontController::class, 'reset_password_submit'])->name('reset_password_submit');

Route::get('/change/lang', [LangController::class, 'change'])->name('changeLang');
Route::post('/contact/submit', [FrontController::class, 'contact_submit'])->name('contact_submit');

Route::post('/review/submit/', [FrontController::class, 'review_submit'])->name('review_submit');
// Pages
Route::group(['prefix' => '{lang}/{cooperator}', 'middleware' => ['lang', 'cooperator']], function () {
    Route::get('/', [FrontController::class, 'home'])->name('home.lang'); // Homepage
    Route::get('/destinations', [FrontController::class, 'destinations'])->name('destinations');
    Route::get('/destination/{slug}', [FrontController::class, 'destination'])->name('destination');
    Route::get('/packages', [FrontController::class, 'packages'])->name('packages');
    Route::get('/package/{id}', [FrontController::class, 'package'])->name('package');
    Route::get('/tour/{id}', [FrontController::class, 'single_tour'])->name('tour');
    Route::get('/about', [FrontController::class, 'about'])->name('about');
    Route::get('/blog', [FrontController::class, 'blog'])->name('blog');
    Route::get('/post/{slug}', [FrontController::class, 'post'])->name('post');
    Route::get('/contact', [FrontController::class, 'contact'])->name('contact');



    Route::get('/team-members', [FrontController::class, 'team_members'])->name('team_members');
    Route::get('/team-member/{slug}', [FrontController::class, 'team_member'])->name('team_member');
    Route::get('/faq', [FrontController::class, 'faq'])->name('faq');
    Route::get('/category/{slug}', [FrontController::class, 'category'])->name('category');
    Route::post('/enquary/submit/{id}', [FrontController::class, 'enquary_form_submit'])->name('enquary_form_submit');
    Route::post('/payment', [FrontController::class, 'payment'])->name('payment');
    Route::get('paypal/success', [FrontController::class, 'paypal_success'])->name('paypal_success');
    Route::get('paypal/cancel', [FrontController::class, 'paypal_cancel'])->name('paypal_cancel');

    Route::get('/wishlist/{package_id}', [FrontController::class, 'wishlist'])->name('wishlist');
    Route::post('/subscriber-submit/', [FrontController::class, 'subscriber_submit'])->name('subscriber_submit');
    Route::get('/subscriber-verify/{email}/{token}', [FrontController::class, 'subscriber_verify'])->name('subscriber_verify');
    Route::get('/terms-of-use', [FrontController::class, 'terms'])->name('terms');
    Route::get('/privacy-policy', [FrontController::class, 'privacy'])->name('privacy');
    // Single Tour 
    Route::get('/private-tour/{id}', [SingleTourController::class, 'single_tour'])->name('single_tour');
    // Package Page
    Route::get('/package/{cooperator_id}/{package_id}', [PackageController::class, 'package'])->name('my_package');


    //pdf
    Route::get('/name', [PdfController::class, 'invoicePDF'])->name('invoicePDF');

});



//Public Pages Guest name - invoice - ..
Route::get('/guest-name/{id}', [PrintFrontController::class, 'guest_name'])->name('guest_name');
Route::get('/guest-name-pdf/{id}', [PrintFrontController::class, 'guest_name_pdf'])->name('guest_name_pdf');













Route::get('get-cities/{destination_id}', [AdminOfferController::class, 'getCities'])->name('get.cities');

Route::post('/keyx', function (Request $request) {
    $request->session()->flush(); // Use flush() to clear all session data
    echo "Session cleared<br>";
});
