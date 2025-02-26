<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddReservationRequest;
use App\Http\Requests\ReserveDriverRequest;
use App\Http\Requests\StoreAirticketsRequest;
use App\Http\Requests\StorePassportsRequest;
use App\Models\AirticketPhoto;
use App\Models\Driver;
use App\Models\PassportPhoto;
use App\Models\PrivateTour;
use App\Models\PrivateTourDetail;
use Exception;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function add_reservation(AddReservationRequest $request)
    {
        try {
            // Find the PrivateTour
            $private_tour = PrivateTour::findOrFail($request->private_tour_id);
            // Update PrivateTour fields
            $private_tour->update([
                "user_id" => $request->user_id,
                "number_of_people" => $request->number_of_people,
                "note" => $request->note,
                "reserved" => true,
            ]);

            return ResponseHelper::Success(
                message: 'User Added Successfully',
                data: $private_tour,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }
    public function add_passports(StorePassportsRequest $request)
    {
        try {
            if ($request->hasFile("passports")) {
                $files = $request->file("passports");
                foreach ($files as $file) {
                    $final_name = 'Passport_Photo' . time() . '.' . $file->getClientOriginalName();
                    $request['private_tour_id'] = $request->private_tour_id;
                    $request['photo'] = $final_name;
                    $file->move(\public_path("/uploads"), $final_name);
                    PassportPhoto::create($request->all());
                }
            }
            $data = PassportPhoto::all()->where("private_tour_id", $request->private_tour_id);

            return ResponseHelper::Success(
                message: 'loaded Successfully',
                data: $data,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }
    public function add_airtickets(StoreAirticketsRequest $request)
    {
        try {
            if ($request->hasFile("airtickets")) {
                $files = $request->file("airtickets");
                foreach ($files as $file) {
                    $final_name = 'airticket_Photo' . time() . '.' . $file->getClientOriginalName();
                    $request['private_tour_id'] = $request->private_tour_id;
                    $request['photo'] = $final_name;
                    $file->move(\public_path("/uploads"), $final_name);
                    AirticketPhoto::create($request->all());
                }
            }
            $data = AirticketPhoto::all()->where("private_tour_id", $request->private_tour_id);

            return ResponseHelper::Success(
                message: 'loaded Successfully',
                data: $data,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function delete_photo(Request $request)
    {
        try {
            $type = $request->get('type'); // Accept the type of photo (passport or airticket)

            if ($type === 'passport') {
                $photo = PassportPhoto::findOrFail($request->id);
            } elseif ($type === 'airticket') {
                $photo = AirticketPhoto::findOrFail($request->id);
            } else {
                return ResponseHelper::Error(
                    message: 'Invalid photo type specified',
                    statusCode: 400
                );
            }

            // Delete the file from the uploads directory
            $filePath = public_path("/uploads/" . $photo->photo);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Delete the database record
            $photo->delete();

            return ResponseHelper::Success(
                message: 'Photo deleted successfully',
                data: null,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }


    //Get All Drivers by Destination id
    public function get_all_drivers($id)
    {
        try {
            $all_drivers = Driver::with('city', 'destination', 'driverCarPhotos', 'transportationType')->where('destination_id', $id)->get();


            return ResponseHelper::Success(
                message: 'Loaded Successfully',
                data: $all_drivers,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function reserve_driver(ReserveDriverRequest $request, $id)
    {
        try {
            $private_tour = PrivateTour::findOrFail($id);

            // Update PrivateTour fields
            $private_tour->update([
                "driver_id" => $request->driver_id,
                "driver_price" => $request->driver_price,
            ]);


            return ResponseHelper::Success(
                message: 'Driver Reserved Successfully',
                data: $private_tour,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }
    public function reserve_tourguide(Request $request, $id)
    {
        try {
            $private_tour_detail = PrivateTourDetail::findOrFail($id);

            // Update PrivateTour fields
            $private_tour_detail->update([
                "tourguide_id" => $request->tourguide_id,
                "tourguide_deal_price" => $request->tourguide_deal_price,
            ]);


            return ResponseHelper::Success(
                message: 'Tourguide Reserved Successfully',
                data: $private_tour_detail,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function get_private_tour($id)
    {
        try {

            $private_tour = PrivateTour::with(
                'privateTourDetails.rRoomCategories.accommodationRoomsCategory.room_category',
                'privateTourDetails.city',
                'privateTourDetails.confirmationPhotos',
                'privateTourDetails.invoicePhotos',
                'privateTourDetails.paymentPhotos',
                'privateTourDetails.dayTour',
                'privateTourDetails.accommodation.city',
                'privateTourDetails.tourguidee',
                'package.packageTitle',
                'package.destination',
                'user',
                'passportPhotos',
                'airticketPhotos',
                'driver.driverCarPhotos',
                'driver.city',
                'driver.transportationType',
                'cooperator'

            )
                ->where('id', $id)->first();
            return ResponseHelper::Success(
                message: 'Offer Created Successfully',
                data: $private_tour,
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
