<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\PrivateTourDetail;
use Exception;
use Illuminate\Http\Request;

class TourguideController extends Controller
{
    public function get_all_tourguide_reservations()
    {
        try {
            $cooperator = auth()->user();
            if (!$cooperator || $cooperator->rule_id != 3) {
                return ResponseHelper::Error(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }

            // Prepare the query based on role
            $reservationsQuery = PrivateTourDetail::with('privateTour.user', 'city', 'dayTour.tour_photos', 'rRoomCategories.accommodationRoomsCategory.room_category')
                ->where('tourguide_id', $cooperator->tourguide_id)
                ->whereHas('privateTour', function ($query) {
                    $query->where('reserved', true);
                });

            // Fetch offers
            $reservations = $reservationsQuery->get();

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
