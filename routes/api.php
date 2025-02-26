<?php

use App\Http\Controllers\Api\AccommodationController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DayTourController;
use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\DriverOperatorController;
use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\HotelReservationController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\TourguideController;
use App\Http\Controllers\Api\TourguideOperatorController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/forget-password', [AuthController::class, 'forget_password']);
Route::post('/auth/reset-password', [AuthController::class, 'reset_password']);



// Group routes that require authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/destination', [DestinationController::class, 'get_destinations']);
    Route::get('/tour-titles', [OfferController::class, 'get_tour_titles']);
    Route::get('/day-tours/{id}', [OfferController::class, 'get_days_tour']);
    Route::get('/destination-hotels/{id}', [OfferController::class, 'get_destination_hotels']);

    //User Controller
    Route::get('/get-all-users', [UserController::class, 'get_all_users']);
    Route::post('/add-user', [UserController::class, 'add_user']);

    //Ofers
    Route::post('/create-private-tour', [OfferController::class, 'create_private_tour']);
    Route::get('/get-private-tour/{id}', [OfferController::class, 'get_private_tour']);
    Route::get('/get-all-offers/{id}', [OfferController::class, 'get_all_offers']);
    Route::get('/get-all-my-packages/{id}', [OfferController::class, 'get_all_my_packages']);
    Route::get('/get-all-package-offers/{id}', [OfferController::class, 'get_all_package_offers']);
    Route::delete('/delete-private-tour/{id}', [OfferController::class, 'delete_private_tour']);
    Route::post('/edit-private-tour/{id}', [OfferController::class, 'edit_private_tour']);
    Route::delete('/delete-day-tour/{id}', [OfferController::class, 'delete_day_tour']);
    Route::post('/edit-private-tour-date/{id}', [OfferController::class, 'edit_private_tour_date']);
    Route::post('/edit-private-tour-day', [OfferController::class, 'edit_private_tour_day']);
    Route::get('/get-all-reservations/{id}', [OfferController::class, 'get_all_reservations']);

    //Reservation
    Route::post('/add-reservation', [ReservationController::class, 'add_reservation']);
    Route::post('/add-passports', [ReservationController::class, 'add_passports']);
    Route::post('/add-airtickets', [ReservationController::class, 'add_airtickets']);
    Route::post('/delete-photo', [ReservationController::class, 'delete_photo']);
    Route::get('/get-all-drivers/{id}', [ReservationController::class, 'get_all_drivers']);
    Route::post('/reserve-driver/{id}', [ReservationController::class, 'reserve_driver']);
    Route::post('/reserve-tourguide/{id}', [ReservationController::class, 'reserve_tourguide']);

    //Hotel Reservation
    Route::post('send-email', [HotelReservationController::class, 'send_email']);
    Route::post('cancel-email', [HotelReservationController::class, 'cancel_email']);
    Route::post('/add-confirmations', [HotelReservationController::class, 'add_confirmations']);
    Route::post('/add-invoices', [HotelReservationController::class, 'add_invoices']);
    Route::post('/add-payments', [HotelReservationController::class, 'add_payments']);
    Route::post('/delete-hotel-docoment', [HotelReservationController::class, 'delete_hotel_docoment']);
    Route::post('/set-invoice-price', [HotelReservationController::class, 'set_invoice_price']);
    Route::post('/set-payment-price', [HotelReservationController::class, 'set_payment_price']);

    //Tour Operator
    Route::get('/get-all-daytours/{id}', [DayTourController::class, 'get_all_daytours']);
    Route::post('/create-daytour', [DayTourController::class, 'create_daytour']);
    Route::post('/add-daytour-photos', [DayTourController::class, 'add_daytour_photos']);
    Route::post('/edit-daytour/{id}', [DayTourController::class, 'edit_daytour']);
    Route::delete('/delete-daytour/{id}', [DayTourController::class, 'delete_daytour']);
    Route::delete('/delete-daytour-photo/{id}', [DayTourController::class, 'delete_daytour_photo']);

    Route::get('/get-all-accommodations/{id}', [AccommodationController::class, 'get_all_accommodations']);
    Route::post('/create-accommodation', [AccommodationController::class, 'create_accommodation']);
    Route::delete('/delete-accommodation/{id}', [AccommodationController::class, 'delete_accommodation']);
    Route::get('/get-single-accommodation/{id}', [AccommodationController::class, 'get_single_accommodation']);
    Route::post('/edit-accommodation/{id}', [AccommodationController::class, 'edit_accommodation']);
    Route::post('/add-accommodation-featuredphoto/{id}', [AccommodationController::class, 'add_accommodation_featuredphoto']);
    Route::post('/add-accommodation-photos', [AccommodationController::class, 'add_accommodation_photos']);
    Route::delete('/delete-accommodation-photo/{id}', [AccommodationController::class, 'delete_accommodation_photo']);
    Route::post('/edit-accommodation-share/{id}', [AccommodationController::class, 'edit_accommodation_share']);

    Route::get('/get-rooms-categories', [AccommodationController::class, 'get_rooms_categories']);
    Route::post('/syncRoomCategories', [AccommodationController::class, 'syncRoomCategories']);
    Route::post('/updateOrCreateSeasonsAndPrices', [AccommodationController::class, 'updateOrCreateSeasonsAndPrices']);


    Route::get('/get-all-drivers/{id}', [DriverOperatorController::class, 'get_all_drivers']);
    Route::post('/create-driver', [DriverOperatorController::class, 'create_driver']);
    Route::delete('/delete-driver/{id}', [DriverOperatorController::class, 'delete_driver']);
    Route::get('/get-single-driver/{id}', [DriverOperatorController::class, 'get_single_driver']);
    Route::post('/edit-driver/{id}', [DriverOperatorController::class, 'edit_driver']);
    Route::post('/add-driver-carphotos', [DriverOperatorController::class, 'add_driver_carPhotos']);
    Route::delete('/delete-driver-carphoto/{id}', [DriverOperatorController::class, 'delete_driver_carphoto']);
    Route::post('/add-driver-photo/{id}', [DriverOperatorController::class, 'add_driver_photo']);


    Route::get('/get-all-tourguides/{id}', [TourguideOperatorController::class, 'get_all_tourguides']);
    Route::post('/create-tourguide', [TourguideOperatorController::class, 'create_tourguide']);
    Route::delete('/delete-tourguide/{id}', [TourguideOperatorController::class, 'delete_tourguide']);
    Route::get('/get-single-tourguide/{id}', [TourguideOperatorController::class, 'get_single_tourguide']);
    Route::post('/edit-tourguide/{id}', [TourguideOperatorController::class, 'edit_tourguide']);
    Route::post('/add-tourguide-photo/{id}', [TourguideOperatorController::class, 'add_tourguide_photo']);



    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth/update', [AuthController::class, 'update']);
    Route::get('/auth/user-loaded', action: [AuthController::class, 'loadedUsers']);

    //Hotel Reservation
    Route::get('/hotel-reservations', action: [HotelController::class, 'get_all_hotel_reservations']);

    //Driver Reservation
    Route::get('/driver-reservations', action: [DriverController::class, 'get_all_driver_reservations']);

    //Tourguide Reservation
    Route::get('/tourguide-reservations', action: [TourguideController::class, 'get_all_tourguide_reservations']);
});





