<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Destination;
use Exception;
use Illuminate\Http\Request;
use Log;
//1-Admin  2-Tour Operator   3-Tourguide   4-Hotel   5-Travel Agency  6-Driver 7-Customer Service
class DestinationController extends Controller
{
    // public function get_destinations()
    // {
    //     try {
    //         // Log::info('Request passed to next middleware.');

    //         $destinations = Destination::with(
    //             'cities',
    //             'tourguidePrice',
    //             'transportationPrices.transportationType',
    //             'packages.packageTitle',
    //             'tourguides'
    //         )->get(); // Use ::all() instead of Destination->get()
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'ok',
    //             'data' => $destinations
    //         ], 200); // Changed to 200 for a successful response
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $e->getMessage()
    //         ], 404);
    //     }
    // }

    public function get_destinations()
    {
        try {
            $cooperator = auth()->user();
            if (!$cooperator) {
                return ResponseHelper::Error(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }

            // Prepare the query with all relationships
            $distinationQuary = Destination::with(
                'cities',
                'tourguidePrice',
                'transportationPrices.transportationType',
                'packages.packageTitle',
                'tourguides'
            );
            // Handle roles using switch
            switch ($cooperator->rule_id) {
                case 1: // Admin
                    break;

                case 2: // Tour Operator
                    $distinationQuary->where('id', $cooperator->destination_id);
                    break;

                case 3: // Tourguide
                    $distinationQuary->where('id', $cooperator->destination_id);
                    break;

                case 4: // Hotel
                    $distinationQuary->where('id', $cooperator->destination_id);
                    break;

                case 5: // Travel Agency
                    break;

                case 6: // Driver
                    $distinationQuary->where('id', $cooperator->destination_id);
                    break;

                case 7: // Customer Service
                    break;


                default: // Unauthorized role
                    return ResponseHelper::Error(
                        message: 'Unauthorized',
                        statusCode: 401
                    );
            }

            // Fetch offers
            $destination = $distinationQuary->get();

            return ResponseHelper::Success(
                message: 'Destination Loaded Successfully',
                data: $destination,
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
