<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\PrivateTourDetail;
use App\Models\Tour;
use App\Models\TourPhoto;
use Exception;
use Illuminate\Http\Request;

class DayTourController extends Controller
{
    public function get_all_daytours($id)
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
            $query = Tour::with('city', 'destination', 'tour_photos');

            //1-Admin  2-Tour Operator   3-Tourguide   4-Hotel   5-Travel Agency  6-Driver 7-Customer Service
            switch ($cooperator->rule_id) {
                case 1: // Admin
                    $dayTours = $query->where('destination_id', $id)->get();
                    break;

                case 2: // Tour Operator
                    $dayTours = $query->where('destination_id', $cooperator->destination_id)->get();
                    break;

                case 5: // Travel Agency
                    $dayTours = $query->where('destination_id', $id)->get();
                    break;

                case 7: // Customer Service
                    $dayTours = $query->where('destination_id', $id)->get();
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
                data: $dayTours,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function create_daytour(Request $request)
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

            // Check user role based on rule_id
            switch ($cooperator->rule_id) {
                case 1: // Admin: Admin can create day tours
                    break;

                case 2: // Tour Operator: Tour Operators can also create day tours
                    break;

                default:
                    return ResponseHelper::Success(
                        message: 'Unauthorized',
                        statusCode: 403
                    );
            }

            // Validate the request data
            $validated = $request->validate([
                'title_en' => 'required|string|max:255',
                'description_en' => 'required',

                'title_ru' => 'required|string|max:255',
                'description_ru' => 'required',

                'title_ar' => 'required|string|max:255',
                'description_ar' => 'required',

                'title_local' => 'required|string|max:255',
                'description_local' => 'required',

                'city_id' => 'required|exists:cities,id', // ensure valid city ID
                'images' => 'nullable|array',
                'images.*' => 'nullable|image', // validate image files
            ]);

            $tour = new Tour();

            $tour->destination_id = $request->destination_id;
            $tour->city_id = $request->city_id;
            $tour->title_en = $request->title_en;
            $tour->description_en = $request->description_en;
            $tour->title_ru = $request->title_ru;
            $tour->description_ru = $request->description_ru;
            $tour->title_ar = $request->title_ar;
            $tour->description_ar = $request->description_ar;
            $tour->title_local = $request->title_local;
            $tour->description_local = $request->description_local;

            $tour->save();

            if ($request->hasFile("images")) {
                $files = $request->file("images");
                foreach ($files as $file) {
                    // Generate a unique name for the image
                    $imageName = 'Day_tour_photo_' . time() . '_' . $file->getClientOriginalName();

                    // Check if the image already exists in the database
                    $existingImage = TourPhoto::where('photo', $imageName)->first();
                    if ($existingImage) {
                        // If the image already exists, skip creating a new one
                        continue;
                    }

                    // Save the image if it doesn't exist already
                    $request['tour_id'] = $tour->id;
                    $request['photo'] = $imageName;
                    $file->move(\public_path("/uploads"), $imageName);
                    TourPhoto::create($request->all());
                }
            }

            // Return success response with created tour data
            return ResponseHelper::Success(
                message: 'Day Tour Created Successfully',
                data: $tour,
                statusCode: 201
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function edit_daytour(Request $request, $id)
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

            // Check the user's role and restrict access based on role
            switch ($cooperator->rule_id) {
                case 1: // Admin
                    // Admin can update any day tour
                    $tour = Tour::find($id);
                    break;

                case 2: // Tour Operator
                    // Tour Operator can only update tours associated with their destination
                    $tour = Tour::where('id', $id)
                        ->where('destination_id', $cooperator->destination_id)
                        ->first();
                    break;

                default:
                    return ResponseHelper::Success(
                        message: 'Unauthorized',
                        statusCode: 403
                    );
            }

            // If the tour is not found
            if (!$tour) {
                return ResponseHelper::Success(
                    message: 'Tour not found or you do not have permission to update this tour',
                    statusCode: 404
                );
            }

            // Validate the request data
            $validated = $request->validate([
                'title_en' => 'required|string|max:255',
                'description_en' => 'required',
                'title_ru' => 'required|string|max:255',
                'description_ru' => 'required',
                'title_ar' => 'required|string|max:255',
                'description_ar' => 'required',
                'title_local' => 'required|string|max:255',
                'description_local' => 'required',
                'city_id' => 'required|exists:cities,id', // ensure valid city ID
                'images' => 'nullable|array',
                'images.*' => 'nullable|image', // validate image files
            ]);

            // Update the tour's attributes
            $tour->destination_id = $request->destination_id ?? $tour->destination_id;
            $tour->city_id = $request->city_id ?? $tour->city_id;
            $tour->title_en = $request->title_en ?? $tour->title_en;
            $tour->description_en = $request->description_en ?? $tour->description_en;
            $tour->title_ru = $request->title_ru ?? $tour->title_ru;
            $tour->description_ru = $request->description_ru ?? $tour->description_ru;
            $tour->title_ar = $request->title_ar ?? $tour->title_ar;
            $tour->description_ar = $request->description_ar ?? $tour->description_ar;
            $tour->title_local = $request->title_local ?? $tour->title_local;
            $tour->description_local = $request->description_local ?? $tour->description_local;

            $tour->save();

            // Fetch existing images associated with the tour
            $existingImages = $tour->photos; // Assuming the relation is `photos` for TourPhotos
            $newImageNames = [];

            // Process new images
            if ($request->hasFile("images")) {
                $files = $request->file("images");

                foreach ($files as $file) {
                    $originalFileName = $file->getClientOriginalName();

                    // Skip image if it already exists in the database
                    $existingImage = $tour->photos->where('photo', $originalFileName)->first();
                    if ($existingImage) {
                        continue;
                    }

                    // Generate unique name and move the file
                    $imageName = 'Day_tour_photo_' . time() . '_' . $originalFileName;
                    $newImageNames[] = $imageName;
                    $file->move(\public_path("/uploads"), $imageName);

                    // Save the new image to the database
                    $request['tour_id'] = $tour->id;
                    $request['photo'] = $imageName;
                    TourPhoto::create($request->all());
                }

                // Delete old images that were not included in the new request
                foreach ($existingImages as $existingImage) {
                    if (!in_array($existingImage->photo, $newImageNames)) {
                        // Delete the image file from the server
                        $imagePath = public_path("/uploads/{$existingImage->photo}");
                        if (file_exists($imagePath)) {
                            unlink($imagePath); // Delete the file from the server
                        }

                        // Delete the record from the database
                        $existingImage->delete();
                    }
                }
            }

            return ResponseHelper::Success(
                message: 'Day Tour Updated Successfully',
                data: $tour,
                statusCode: 200
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function delete_daytour($id)
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

            // Check the user's role and restrict access based on role
            switch ($cooperator->rule_id) {
                case 1: // Admin
                    // Admin can delete any day tour
                    $tour = Tour::find($id);
                    break;

                case 2: // Tour Operator
                    // Tour Operator can only delete tours associated with their destination
                    $tour = Tour::where('id', $id)
                        ->where('destination_id', $cooperator->destination_id)
                        ->first();
                    break;

                default:
                    return ResponseHelper::Success(
                        message: 'Unauthorized',
                        statusCode: 403
                    );
            }

            // If the tour is not found or user doesn't have permission to delete it
            if (!$tour) {
                return ResponseHelper::Success(
                    message: 'Tour not found or you do not have permission to delete this tour',
                    statusCode: 404
                );
            }

            // Check if the tour is associated with other tour details (PrivateTourDetail)
            $total = PrivateTourDetail::where('day_tour_id', $id)->count();
            if ($total > 0) {
                return ResponseHelper::Success(
                    message: 'This Day Tour cannot be deleted because it is associated with other tour details.',
                    statusCode: 404
                );
            }

            // Delete associated images
            $tourPhotos = TourPhoto::where('tour_id', $id)->get();
            foreach ($tourPhotos as $photo) {
                // Delete the file from storage if it exists
                $photoPath = public_path("/uploads/" . $photo->photo);
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
                $photo->delete();
            }

            // Delete the tour
            $tour->delete();

            // Return success response
            return ResponseHelper::Success(
                message: 'Day Tour Deleted Successfully',
                statusCode: 200
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function add_daytour_photos(Request $request)
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
            if ($request->hasFile("images")) {
                $files = $request->file("images");
                foreach ($files as $file) {
                    // $imageName = env('APP_URL') . '/TourImages' . '/' . time() . '_' . $file->getClientOriginalName();
                    $imageName = 'Day_tour_photo_' . time() . '_' . $file->getClientOriginalName();
                    $request['tour_id'] = $request->tour_id;
                    $request['photo'] = $imageName;
                    $file->move(\public_path("/uploads"), $imageName);
                    TourPhoto::create($request->all());
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

    public function delete_daytour_photo($id)
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
            $photo = TourPhoto::find($id);
            if (!$photo) {
                return ResponseHelper::Error(
                    message: 'Photo not found',
                    statusCode: 404
                );
            }

            // Delete the file from the server
            $filePath = public_path("/uploads/" . $photo->photo);
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

}
