<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\PrivateTourDetail;
use App\Models\Tourguide;
use Exception;
use Illuminate\Http\Request;

class TourguideOperatorController extends Controller
{
    public function get_all_tourguides($id)
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
            $query = Tourguide::with('city', 'destination');

            //1-Admin  2-Tour Operator   3-Tourguide   4-Hotel   5-Travel Agency  6-Driver 7-Customer Service
            switch ($cooperator->rule_id) {
                case 1: // Admin
                    $tourguides = $query->where('destination_id', $id)->get();
                    break;

                case 2: // Tour Operator
                    $tourguides = $query->where('destination_id', $cooperator->destination_id)->get();
                    break;

                case 5: // Travel Agency
                    $tourguides = $query->where('destination_id', $id)->get();
                    break;
                case 7: // Customer Service
                    $tourguides = $query->where('destination_id', $id)->get();
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
                data: $tourguides,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function create_tourguide(Request $request)
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
                'destination_id' => 'required',
                'city_id' => 'required',
                'name' => 'required',
                'mobile' => 'required',
                'email' => 'required',
                'TourguidePhoto' => 'required',
                'note' => 'required',
                'price_per_day' => 'required',
                'status' => 'required',
                'rate' => 'required',
                'date_of_birth' => 'required',
            ]);
            $obj = new Tourguide();

            if ($request->hasFile("TourguidePhoto")) {
                $file = $request->file("TourguidePhoto");
                $imageName = 'Tourguide_photo_' . time() . '_' . $file->getClientOriginalName();
                $file->move(\public_path("/uploads"), $imageName);
                $obj->photo = $imageName;
            }


            $obj->destination_id = $request->destination_id;
            $obj->city_id = $request->city_id;
            $obj->name = $request->name;
            $obj->mobile = $request->mobile;
            $obj->email = $request->email;
            $obj->note = $request->note;
            $obj->price_per_day = $request->price_per_day;
            $obj->status = $request->status;
            $obj->rate = $request->rate;
            $obj->date_of_birth = $request->date_of_birth;
            $obj->save();



            // Return success response with created tour data
            return ResponseHelper::Success(
                message: 'Tourguide Created Successfully',
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

    public function delete_tourguide($id)
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

            $tourguide = Tourguide::find($id);

            // Check if the tour exists
            if (!$tourguide) {
                return ResponseHelper::Success(
                    message: 'Tourguide Not Found',
                    statusCode: 404
                );
            }

            $total = PrivateTourDetail::where('tourguide_id', $id)->count();
            if ($total > 0) {
                return ResponseHelper::Success(
                    message: 'This Tourguide cannot be deleted because it is associated with other tour details.',
                    statusCode: 404
                );
            }


            // Delete the driver's photo (driverPhoto) from storage
            if ($tourguide->photo) {
                $tourguidePhotoPath = public_path("/uploads/" . $tourguide->photo);
                if (file_exists($tourguidePhotoPath)) {
                    unlink($tourguidePhotoPath);
                }
            }


            // Delete the tour
            $tourguide->delete();

            // Return success response
            return ResponseHelper::Success(
                message: 'Tourguide Deleted Successfully',
                statusCode: 200
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }
    public function get_single_tourguide($id)
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
            //1-Admin  2-Tour Operator   3-Tourguide   4-Hotel   5-Travel Agency  6-Driver 7-Customer Service
            if ($cooperator->rule_id = 1 || $cooperator->rule_id = 2) {
                $tourguide = Tourguide::with('city', 'destination')->where('id', $id)->first();

                return ResponseHelper::Success(
                    message: 'Loaded Successfully',
                    data: $tourguide,
                    statusCode: 200
                );
            }
            return ResponseHelper::Error(
                message: 'Unauthorized',
                statusCode: 401
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function edit_tourguide(Request $request, $id)
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
            $tourguide = Tourguide::find($id);
            if (!$tourguide) {
                return ResponseHelper::Error(
                    message: 'Tourguide not found',
                    statusCode: 404
                );
            }

            // Validate the request data
            $validated = $request->validate([
                'destination_id' => 'required',
                'city_id' => 'required',
                'name' => 'required',
                'mobile' => 'required',
                'email' => 'required',

                'note' => 'required',
                'price_per_day' => 'required',
                'status' => 'required',
                'rate' => 'required',
                'date_of_birth' => 'required',
            ]);

            // Update the tour details
            $tourguide->update([
                'destination_id' => $request->destination_id,
                'city_id' => $request->city_id,
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'note' => $request->note,
                'price_per_day' => $request->price_per_day,
                'status' => $request->status,
                'date_of_birth' => $request->date_of_birth,
                'rate' => $request->rate,
            ]);

            // Return success response with updated tour data
            return ResponseHelper::Success(
                message: 'Tourguide Updated Successfully',
                data: $tourguide,
                statusCode: 200
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function add_tourguide_photo(Request $request, $id)
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
            // Find the driver
            $tourguide = Tourguide::find($id);

            if (!$tourguide) {
                return ResponseHelper::Error(
                    message: 'Tourguide not found',
                    statusCode: 404
                );
            }

            // Validate the photo
            $request->validate([
                'TourguidePhoto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Handle the new file upload
            if ($request->hasFile("TourguidePhoto")) {
                // If there's an existing photo, unlink (delete) it
                if ($tourguide->photo) {
                    $oldPhotoPath = public_path("/uploads/") . $tourguide->photo;
                    if (file_exists($oldPhotoPath)) {
                        unlink($oldPhotoPath);
                    }
                }

                // Upload the new photo
                $file = $request->file("TourguidePhoto");
                $imageName = 'Tourguide_photo_' . time() . '_' . $file->getClientOriginalName();
                $file->move(\public_path("/uploads"), $imageName);

                // Update the driver's photo in the database
                $tourguide->photo = $imageName;
                $tourguide->save();
            }

            return ResponseHelper::Success(
                message: 'Tourguide photo updated successfully',
                data: $tourguide,
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
