<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\DriverCarPhoto;
use App\Models\PrivateTour;
use Exception;
use Illuminate\Http\Request;

class DriverOperatorController extends Controller
{
    public function get_all_drivers($id)
    {
        try {
            $cooperator = auth()->user();

            // Check if the user is authenticated
            if (!$cooperator) {
                return ResponseHelper::Error(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }

            // Define the base query
            $query = Driver::with('transportationType', 'city', 'destination', 'driverCarPhotos');

            //1-Admin  2-Tour Operator   3-Tourguide   4-Hotel   5-Travel Agency  6-Driver 7-Customer Service
            switch ($cooperator->rule_id) {
                case 1: // Admin
                    $drivers = $query->where('destination_id', $id)->get();
                    break;

                case 2: // Tour Operator
                    $drivers = $query->where('destination_id', $cooperator->destination_id)->get();
                    break;

                case 5: // Admin
                    $drivers = $query->where('destination_id', $id)->get();
                    break;

                case 7: // Admin
                    $drivers = $query->where('destination_id', $id)->get();
                    break;

                default:
                    return ResponseHelper::Error(
                        message: 'Unauthorized',
                        statusCode: 403
                    );
            }

            // Return success response with retrieved tours
            return ResponseHelper::Success(
                message: 'Loaded Successfully',
                data: $drivers,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }
    public function create_driver(Request $request)
    {
        try {
            $cooperator = auth()->user();
            // Check if the user is authenticated
            if (!$cooperator || $cooperator->rule_id == 7 || $cooperator->rule_id == 5) {
                return ResponseHelper::Success(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }
            // Validate the request data
            $validated = $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'city_id' => 'required',
                'transportationType_id' => 'required',
                'destination_id' => 'required',
                'carModel' => 'required',
                'numberOfSeats' => 'required',
                'note' => 'required',
                'pricePerDay' => 'required',
                'rate' => 'required',
                'DriverPhoto' => 'required',

                'images' => 'nullable|array',
                'images.*' => 'nullable|image', // validate image files
            ]);
            $obj = new Driver();

            if ($request->hasFile("DriverPhoto")) {
                $file = $request->file("DriverPhoto");
                $imageName = 'Driver_photo_' . time() . '_' . $file->getClientOriginalName();
                $file->move(\public_path("/uploads"), $imageName);
                $obj->driverPhoto = $imageName;
            }


            $obj->name = $request->name;
            $obj->phone = $request->phone;
            $obj->city_id = $request->city_id;
            $obj->trabsportationType_id = $request->transportationType_id;
            $obj->destination_id = $request->destination_id;
            $obj->carModel = $request->carModel;
            $obj->numberOfSeats = $request->numberOfSeats;
            $obj->note = $request->note;
            $obj->pricePerDay = $request->pricePerDay;
            $obj->rate = $request->rate;
            $obj->save();

            if ($request->hasFile("CarPhoto")) {
                $files = $request->file("CarPhoto");
                foreach ($files as $file) {
                    // $imageName = env('APP_URL') . '/TourImages' . '/' . time() . '_' . $file->getClientOriginalName();
                    $imageName = 'Car_photo_' . time() . '_' . $file->getClientOriginalName();
                    $request['driver_id'] = $obj->id;
                    $request['car_photo'] = $imageName;
                    $file->move(\public_path("/uploads"), $imageName);
                    DriverCarPhoto::create($request->all());
                }
            }

            // Return success response with created tour data
            return ResponseHelper::Success(
                message: 'Driver Created Successfully',
                data: $obj,
                statusCode: 201
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function delete_driver($id)
    {
        try {

            $cooperator = auth()->user();
            // Check if the user is authenticated
            if (!$cooperator || $cooperator->rule_id == 7 || $cooperator->rule_id == 5) {
                return ResponseHelper::Success(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }

            // Find the tour by ID
            $driver = Driver::find($id);

            // Check if the tour exists
            if (!$driver) {
                return ResponseHelper::Success(
                    message: 'Driver Not Found',
                    statusCode: 404
                );
            }


            $total = PrivateTour::where('driver_id', $id)->count();
            if ($total > 0) {
                return ResponseHelper::Success(
                    message: 'This Driver cannot be deleted because it is associated with other tour details.',
                    statusCode: 404
                );
            }

            // Delete the driver's photo (driverPhoto) from storage
            if ($driver->driverPhoto) {
                $driverPhotoPath = public_path("/uploads/" . $driver->driverPhoto);
                if (file_exists($driverPhotoPath)) {
                    unlink($driverPhotoPath);
                }
            }

            // Delete associated images
            $driverPhotos = DriverCarPhoto::where('driver_id', $id)->get();
            foreach ($driverPhotos as $photo) {
                // Delete the file from storage if it exists
                $photoPath = public_path("/uploads/" . $photo->car_photo);
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
                $photo->delete();
            }

            // Delete the tour
            $driver->delete();

            // Return success response
            return ResponseHelper::Success(
                message: 'Driver Deleted Successfully',
                statusCode: 200
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }



    public function edit_driver(Request $request, $id)
    {
        try {
            $cooperator = auth()->user();
            // Check if the user is authenticated
            if (!$cooperator || $cooperator->rule_id == 7 || $cooperator->rule_id == 5) {
                return ResponseHelper::Success(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }

            // Find the tour by ID
            $driver = Driver::find($id);
            if (!$driver) {
                return ResponseHelper::Error(
                    message: 'Driver not found',
                    statusCode: 404
                );
            }

            // Validate the request data
            $validated = $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'city_id' => 'required',
                'transportationType_id' => 'required',
                'destination_id' => 'required',
                'carModel' => 'required',
                'numberOfSeats' => 'required',
                'note' => 'required',
                'pricePerDay' => 'required',
                'rate' => 'required',
            ]);

            // Update the tour details
            $driver->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'city_id' => $request->city_id,
                'transportationType_id' => $request->transportationType_id,
                'destination_id' => $request->destination_id,
                'carModel' => $request->carModel,
                'numberOfSeats' => $request->numberOfSeats,
                'note' => $request->note,
                'pricePerDay' => $request->pricePerDay,
                'rate' => $request->rate,
            ]);

            // Return success response with updated tour data
            return ResponseHelper::Success(
                message: 'Driver Updated Successfully',
                data: $driver,
                statusCode: 200
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }
    public function add_driver_carPhotos(Request $request)
    {
        try {
            $cooperator = auth()->user();
            // Check if the user is authenticated
            if (!$cooperator || $cooperator->rule_id == 7 || $cooperator->rule_id == 5) {
                return ResponseHelper::Success(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }
            if ($request->hasFile("CarPhoto")) {
                $files = $request->file("CarPhoto");
                foreach ($files as $file) {
                    // $imageName = env('APP_URL') . '/TourImages' . '/' . time() . '_' . $file->getClientOriginalName();
                    $imageName = 'Car_photo_' . time() . '_' . $file->getClientOriginalName();
                    $request['driver_id'] = $request->driver_id;
                    $request['car_photo'] = $imageName;
                    $file->move(\public_path("/uploads"), $imageName);
                    DriverCarPhoto::create($request->all());
                }
            }

            // Return success response with created tour data
            return ResponseHelper::Success(
                message: 'Photos added Successfully',
                statusCode: 201
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }
    public function delete_driver_carphoto($id)
    {
        try {
            $cooperator = auth()->user();
            // Check if the user is authenticated
            if (!$cooperator || $cooperator->rule_id == 7 || $cooperator->rule_id == 5) {
                return ResponseHelper::Success(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }

            // Find the photo by ID
            $photo = DriverCarPhoto::find($id);
            if (!$photo) {
                return ResponseHelper::Error(
                    message: 'Photo not found',
                    statusCode: 404
                );
            }

            // Delete the file from the server
            $filePath = public_path("/uploads/" . $photo->car_photo);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Delete the photo record from the database
            $photo->delete();

            // Return success response
            return ResponseHelper::Success(
                message: 'Photo deleted successfully',
                statusCode: 200
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }
    public function add_driver_photo(Request $request, $id)
    {
        try {
            $cooperator = auth()->user();
            // Check if the user is authenticated
            if (!$cooperator || $cooperator->rule_id == 7 || $cooperator->rule_id == 5) {
                return ResponseHelper::Success(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }
            $driver = Driver::find($id);

            if (!$driver) {
                return ResponseHelper::Error(
                    message: 'Driver not found',
                    statusCode: 404
                );
            }

            // Validate the photo
            $request->validate([
                'DriverPhoto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Handle the new file upload
            if ($request->hasFile("DriverPhoto")) {
                // If there's an existing photo, unlink (delete) it
                if ($driver->driverPhoto) {
                    $oldPhotoPath = public_path("/uploads/") . $driver->driverPhoto;
                    if (file_exists($oldPhotoPath)) {
                        unlink($oldPhotoPath);
                    }
                }

                // Upload the new photo
                $file = $request->file("DriverPhoto");
                $imageName = 'Driver_photo_' . time() . '_' . $file->getClientOriginalName();
                $file->move(\public_path("/uploads"), $imageName);

                // Update the driver's photo in the database
                $driver->driverPhoto = $imageName;
                $driver->save();
            }

            return ResponseHelper::Success(
                message: 'Driver photo updated successfully',
                data: $driver,
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
