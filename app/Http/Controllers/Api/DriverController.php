<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\PrivateTour;
use Exception;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function get_all_driver_reservations()
    {
        try {
            $cooperator = auth()->user();
            if (!$cooperator || $cooperator->rule_id != 6) {
                return ResponseHelper::Error(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }

            // Prepare the query based on role
            // Prepare the query based on role
            $offersQuery = PrivateTour::with(
                'privateTourDetails.rRoomCategories.accommodationRoomsCategory.room_category',
                'privateTourDetails.city',
                'privateTourDetails.confirmationPhotos',
                'privateTourDetails.invoicePhotos',
                'privateTourDetails.paymentPhotos',
                'privateTourDetails.dayTour',
                'privateTourDetails.accommodation.city',
                'package.packageTitle',
                'package.destination',
                'user',
                'passportPhotos',
                'airticketPhotos',
                'driver.driverCarPhotos',
                'driver.city',
                'driver.transportationType',
                'cooperator',
                'tourTitle',
                'transportation'
            )
                ->where('reserved', true)
                ->where('driver_id', $cooperator->driver_id)
                ->orderBy('from', 'asc');


            // Fetch offers
            $reservations = $offersQuery->get();

            return ResponseHelper::Success(
                message: 'Loaded Successfully',
                data: $reservations,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }
}
