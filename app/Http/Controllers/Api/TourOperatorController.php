<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\AccommodationPhoto;
use App\Models\Driver;
use App\Models\DriverCarPhoto;
use App\Models\PrivateTour;
use App\Models\PrivateTourDetail;
use App\Models\RoomCategory;
use App\Models\RoomPrice;
use App\Models\Season;
use App\Models\Tour;
use App\Models\Tourguide;
use App\Models\TourPhoto;
use DB;
use Exception;
use Illuminate\Http\Request;

class TourOperatorController extends Controller
{

    // {
    //     try {
    //         $cooperator = auth()->user();

    //         // Check if the user is authenticated
    //         if (!$cooperator) {
    //             return ResponseHelper::Error(
    //                 message: 'Unauthorized',
    //                 statusCode: 401
    //             );
    //         }

    //         // Define the base query
    //         $query = Tour::with('city', 'destination', 'tour_photos');

    //         //1-Admin  2-Tour Operator   3-Tourguide   4-Hotel   5-Travel Agency  6-Driver 7-Customer Service
    //         switch ($cooperator->rule_id) {
    //             case 1: // Admin
    //                 $dayTours = $query->get();
    //                 break;

    //             case 2: // Tour Operator
    //                 $dayTours = $query->where('destination_id', $cooperator->destination_id)->get();
    //                 break;

    //             default:
    //                 return ResponseHelper::Error(
    //                     message: 'Unauthorized',
    //                     statusCode: 403
    //                 );
    //         }

    //         // Return success response with retrieved tours
    //         return ResponseHelper::Success(
    //             message: 'Loaded Successfully',
    //             data: $dayTours,
    //             statusCode: 200
    //         );

    //     } catch (Exception $e) {
    //         return ResponseHelper::Error(
    //             message: $e->getMessage(),
    //             statusCode: 500
    //         );
    //     }
    // }

    // public function create_daytour(Request $request)
    // {
    //     try {
    //         $cooperator = auth()->user();
    //         // Check if the user is authenticated
    //         if (!$cooperator) {
    //             return ResponseHelper::Error(
    //                 message: 'Unauthorized',
    //                 statusCode: 401
    //             );
    //         }
    //         // Validate the request data
    //         $validated = $request->validate([
    //             'title_en' => 'required|string|max:255',
    //             'description_en' => 'required',

    //             'title_ru' => 'required|string|max:255',
    //             'description_ru' => 'required',

    //             'title_ar' => 'required|string|max:255',
    //             'description_ar' => 'required',

    //             'title_local' => 'required|string|max:255',
    //             'description_local' => 'required',

    //             'city_id' => 'required|exists:cities,id', // ensure valid city ID
    //             'images' => 'nullable|array',
    //             'images.*' => 'nullable|image', // validate image files
    //         ]);
    //         $tour = new Tour();

    //         $tour->destination_id = $request->destination_id;
    //         $tour->city_id = $request->city_id;
    //         $tour->title_en = $request->title_en;
    //         $tour->description_en = $request->description_en;
    //         $tour->title_ru = $request->title_ru;
    //         $tour->description_ru = $request->description_ru;
    //         $tour->title_ar = $request->title_ar;
    //         $tour->description_ar = $request->description_ar;
    //         $tour->title_local = $request->title_local;
    //         $tour->description_local = $request->description_local;

    //         $tour->save();

    //         if ($request->hasFile("images")) {
    //             $files = $request->file("images");
    //             foreach ($files as $file) {
    //                 // $imageName = env('APP_URL') . '/TourImages' . '/' . time() . '_' . $file->getClientOriginalName();
    //                 $imageName = 'Day_tour_photo_' . time() . '_' . $file->getClientOriginalName();
    //                 $request['tour_id'] = $tour->id;
    //                 $request['photo'] = $imageName;
    //                 $file->move(\public_path("/uploads"), $imageName);
    //                 TourPhoto::create($request->all());
    //             }
    //         }

    //         // Return success response with created tour data
    //         return ResponseHelper::Success(
    //             message: 'Day Tour Created Successfully',
    //             data: $tour,
    //             statusCode: 201
    //         );
    //     } catch (Exception $e) {
    //         return ResponseHelper::Error(
    //             message: $e->getMessage(),
    //             statusCode: 500
    //         );
    //     }
    // }
    // public function add_daytour_photos(Request $request)
    // {
    //     try {
    //         $cooperator = auth()->user();
    //         // Check if the user is authenticated
    //         if (!$cooperator) {
    //             return ResponseHelper::Error(
    //                 message: 'Unauthorized',
    //                 statusCode: 401
    //             );
    //         }
    //         if ($request->hasFile("images")) {
    //             $files = $request->file("images");
    //             foreach ($files as $file) {
    //                 // $imageName = env('APP_URL') . '/TourImages' . '/' . time() . '_' . $file->getClientOriginalName();
    //                 $imageName = 'Day_tour_photo_' . time() . '_' . $file->getClientOriginalName();
    //                 $request['tour_id'] = $request->tour_id;
    //                 $request['photo'] = $imageName;
    //                 $file->move(\public_path("/uploads"), $imageName);
    //                 TourPhoto::create($request->all());
    //             }
    //         }

    //         // Return success response with created tour data
    //         return ResponseHelper::Success(
    //             message: 'Photos added Successfully',
    //             statusCode: 201
    //         );
    //     } catch (Exception $e) {
    //         return ResponseHelper::Error(
    //             message: $e->getMessage(),
    //             statusCode: 500
    //         );
    //     }
    // }

    // public function delete_daytour_photo($id)
    // {
    //     try {
    //         $cooperator = auth()->user();
    //         // Check if the user is authenticated
    //         if (!$cooperator) {
    //             return ResponseHelper::Error(
    //                 message: 'Unauthorized',
    //                 statusCode: 401
    //             );
    //         }

    //         // Find the photo by ID
    //         $photo = TourPhoto::find($id);
    //         if (!$photo) {
    //             return ResponseHelper::Error(
    //                 message: 'Photo not found',
    //                 statusCode: 404
    //             );
    //         }

    //         // Delete the file from the server
    //         $filePath = public_path("/uploads/" . $photo->photo);
    //         if (file_exists($filePath)) {
    //             unlink($filePath);
    //         }

    //         // Delete the photo record from the database
    //         $photo->delete();

    //         // Return success response
    //         return ResponseHelper::Success(
    //             message: 'Photo deleted successfully',
    //             statusCode: 200
    //         );
    //     } catch (Exception $e) {
    //         return ResponseHelper::Error(
    //             message: $e->getMessage(),
    //             statusCode: 500
    //         );
    //     }
    // }

    // public function get_single_daytour($id)
    // {
    //     try {
    //         $cooperator = auth()->user();
    //         // Check if the user is authenticated
    //         if (!$cooperator) {
    //             return ResponseHelper::Error(
    //                 message: 'Unauthorized',
    //                 statusCode: 401
    //             );
    //         }
    //         //1-Admin  2-Tour Operator   3-Tourguide   4-Hotel   5-Travel Agency  6-Driver 7-Customer Service
    //         if ($cooperator->rule_id = 1 || $cooperator->rule_id = 2) {
    //             $dayTour = Tour::with('city', 'tour_photos')->where('id', $id)->first();

    //             return ResponseHelper::Success(
    //                 message: 'Loaded Successfully',
    //                 data: $dayTour,
    //                 statusCode: 200
    //             );
    //         }
    //         return ResponseHelper::Error(
    //             message: 'Unauthorized',
    //             statusCode: 401
    //         );
    //     } catch (Exception $e) {
    //         return ResponseHelper::Error(
    //             message: $e->getMessage(),
    //             statusCode: 500
    //         );
    //     }
    // }

    // public function edit_daytour(Request $request, $id)
    // {
    //     try {
    //         $cooperator = auth()->user();
    //         // Check if the user is authenticated
    //         if (!$cooperator) {
    //             return ResponseHelper::Error(
    //                 message: 'Unauthorized',
    //                 statusCode: 401
    //             );
    //         }

    //         // Find the tour by ID
    //         $tour = Tour::find($id);
    //         if (!$tour) {
    //             return ResponseHelper::Error(
    //                 message: 'Day Tour not found',
    //                 statusCode: 404
    //             );
    //         }

    //         // Validate the request data
    //         $validated = $request->validate([
    //             'title_en' => 'sometimes|required|string|max:255',
    //             'description_en' => 'sometimes|required',

    //             'title_ru' => 'sometimes|required|string|max:255',
    //             'description_ru' => 'sometimes|required',

    //             'title_ar' => 'sometimes|required|string|max:255',
    //             'description_ar' => 'sometimes|required',

    //             'title_local' => 'sometimes|required|string|max:255',
    //             'description_local' => 'sometimes|required',

    //             'city_id' => 'sometimes|required|exists:cities,id', // ensure valid city ID
    //         ]);

    //         // Update the tour details
    //         $tour->update([
    //             'title_en' => $request->title_en ?? $tour->title_en,
    //             'description_en' => $request->description_en ?? $tour->description_en,
    //             'title_ru' => $request->title_ru ?? $tour->title_ru,
    //             'description_ru' => $request->description_ru ?? $tour->description_ru,
    //             'title_ar' => $request->title_ar ?? $tour->title_ar,
    //             'description_ar' => $request->description_ar ?? $tour->description_ar,
    //             'title_local' => $request->title_local ?? $tour->title_local,
    //             'description_local' => $request->description_local ?? $tour->description_local,
    //             'city_id' => $request->city_id ?? $tour->city_id,
    //             'destination_id' => $request->destination_id ?? $tour->destination_id,
    //         ]);

    //         // Return success response with updated tour data
    //         return ResponseHelper::Success(
    //             message: 'Day Tour Updated Successfully',
    //             data: $tour,
    //             statusCode: 200
    //         );
    //     } catch (Exception $e) {
    //         return ResponseHelper::Error(
    //             message: $e->getMessage(),
    //             statusCode: 500
    //         );
    //     }
    // }

    // public function delete_daytour($id)
    // {
    //     try {

    //         // Find the tour by ID
    //         $tour = Tour::find($id);

    //         // Check if the tour exists
    //         if (!$tour) {
    //             return ResponseHelper::Error(
    //                 message: 'Day Tour Not Found',
    //                 statusCode: 404
    //             );
    //         }


    //         $total = PrivateTourDetail::where('day_tour_id', $id)->count();
    //         if ($total > 0) {
    //             return ResponseHelper::Success(
    //                 message: 'This Day Tour cannot be deleted because it is associated with other tour details.',
    //                 statusCode: 404
    //             );
    //         }

    //         // Delete associated images
    //         $tourPhotos = TourPhoto::where('tour_id', $id)->get();
    //         foreach ($tourPhotos as $photo) {
    //             // Delete the file from storage if it exists
    //             $photoPath = public_path("/uploads/" . $photo->photo);
    //             if (file_exists($photoPath)) {
    //                 unlink($photoPath);
    //             }
    //             $photo->delete();
    //         }

    //         // Delete the tour
    //         $tour->delete();

    //         // Return success response
    //         return ResponseHelper::Success(
    //             message: 'Day Tour Deleted Successfully',
    //             statusCode: 200
    //         );
    //     } catch (Exception $e) {
    //         return ResponseHelper::Error(
    //             message: $e->getMessage(),
    //             statusCode: 500
    //         );
    //     }
    // }

    public function get_all_accommodations()
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
            $query = Accommodation::with('destination', 'city', 'photos');

            //1-Admin  2-Tour Operator   3-Tourguide   4-Hotel   5-Travel Agency  6-Driver 7-Customer Service
            switch ($cooperator->rule_id) {
                case 1: // Admin
                    $acoommodations = $query->get();
                    break;

                case 2: // Tour Operator
                    $acoommodations = $query->where('destination_id', $cooperator->destination_id)->get();
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
                data: $acoommodations,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function create_accommodation(Request $request)
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
            // Validate the request data
            $validated = $request->validate([
                'destination_id' => 'required',
                'name' => 'required',
                'accommodation_type' => 'required',
                'city_id' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'address' => 'required',
                'note' => 'required',
                'rate' => 'required',
                'hotel_website' => 'required',
                'video_link' => 'required',
                'featured_photo' => 'required',

                'HotelPhotos' => 'nullable|array',
                'HotelPhotos.*' => 'nullable|image', // validate image files
            ]);
            $obj = new Accommodation();

            if ($request->hasFile("featured_photo")) {
                $file = $request->file("featured_photo");
                $imageName = 'Accommodation_photo_' . time() . '_' . $file->getClientOriginalName();
                $file->move(\public_path("/uploads"), $imageName);
                $obj->featured_photo = $imageName;
            }

            $obj->destination_id = $request->destination_id;
            $obj->name = $request->name;
            $obj->accommodation_type = $request->accommodation_type;
            $obj->city_id = $request->city_id;

            $obj->phone = $request->phone;
            $obj->email = $request->email;
            $obj->address = $request->address;

            $obj->hotel_website = $request->hotel_website;
            $obj->video_link = $request->video_link;
            $obj->note = $request->note;

            $obj->rate = $request->rate;
            $obj->save();

            if ($request->hasFile("HotelPhotos")) {
                $files = $request->file("HotelPhotos");
                foreach ($files as $file) {
                    // $imageName = env('APP_URL') . '/TourImages' . '/' . time() . '_' . $file->getClientOriginalName();
                    $imageName = 'Hotel_photo_' . time() . '_' . $file->getClientOriginalName();
                    $request['accommodation_id'] = $obj->id;
                    $request['photo'] = $imageName;
                    $file->move(\public_path("/uploads"), $imageName);
                    AccommodationPhoto::create($request->all());
                }
            }

            // Return success response with created tour data
            return ResponseHelper::Success(
                message: 'Accommodation Created Successfully',
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

    public function delete_accommodation($id)
    {
        try {
            // Start transaction
            DB::beginTransaction();

            // Find the accommodation by ID
            $accommodation = Accommodation::find($id);

            // Check if the accommodation exists
            if (!$accommodation) {
                return ResponseHelper::Success(
                    message: 'Accommodation Not Found',
                    statusCode: 404
                );
            }

            // Check if the accommodation is associated with other details
            $total = PrivateTourDetail::where('accommodation_id', $id)->count();
            if ($total > 0) {
                return ResponseHelper::Success(
                    message: 'This Accommodation cannot be deleted because it is associated with other tour details.',
                    statusCode: 422
                );
            }

            // Delete the accommodation's featured photo
            if (!empty($accommodation->featured_photo)) {
                $accommodationPhotoPath = public_path("/uploads/" . $accommodation->featured_photo);
                if (file_exists($accommodationPhotoPath)) {
                    unlink($accommodationPhotoPath);
                }
            }

            // Delete associated photos
            $hotel_photos = AccommodationPhoto::where('accommodation_id', $id)->get();
            foreach ($hotel_photos as $photo) {
                if (!empty($photo->photo)) {
                    $photoPath = public_path("/uploads/" . $photo->photo);
                    if (file_exists($photoPath)) {
                        unlink($photoPath);
                    }
                }
                $photo->delete();
            }

            // Delete the accommodation
            $accommodation->delete();

            // Commit transaction
            DB::commit();

            // Return success response
            return ResponseHelper::Success(
                message: 'Accommodation Deleted Successfully',
                statusCode: 200
            );
        } catch (\Exception $e) {
            // Rollback transaction in case of error
            DB::rollBack();

            // Return error response
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }
    public function get_single_accommodation($id)
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
            if ($cooperator->rule_id = 1 || $cooperator->rule_id = 2 || $cooperator->rule_id = 4) {
                $accommodation = Accommodation::with('destination', 'city', 'photos', 'accommodation_rooms_categories.room_category', 'seasons.roomPrices')->where('id', $id)->first();

                return ResponseHelper::Success(
                    message: 'Loaded Successfully',
                    data: $accommodation,
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

    public function edit_accommodation(Request $request, $id)
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

            // Find the tour by ID
            $accommodation = Accommodation::find($id);
            if (!$accommodation) {
                return ResponseHelper::Error(
                    message: 'Accommodation not found',
                    statusCode: 404
                );
            }

            // Validate the request data
            $validated = $request->validate([
                'destination_id' => 'required',
                'name' => 'required',
                'accommodation_type' => 'required',
                'city_id' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'address' => 'required',
                'note' => 'required',
                'rate' => 'required',
                'hotel_website' => 'required',
                'video_link' => 'required',
            ]);

            // Update the tour details
            $accommodation->update([
                'destination_id' => $request->destination_id ?? $accommodation->destination_id,
                'name' => $request->name ?? $accommodation->name,
                'accommodation_type' => $request->accommodation_type ?? $accommodation->accommodation_type,
                'city_id' => $request->city_id ?? $accommodation->city_id,
                'phone' => $request->phone ?? $accommodation->phone,
                'email' => $request->email ?? $accommodation->email,
                'address' => $request->address ?? $accommodation->address,
                'note' => $request->note ?? $accommodation->note,
                'rate' => $request->rate ?? $accommodation->rate,
                'hotel_website' => $request->hotel_website ?? $accommodation->hotel_website,
                'video_link' => $request->video_link ?? $accommodation->video_link,
            ]);

            // Return success response with updated tour data
            return ResponseHelper::Success(
                message: 'Accommodation Updated Successfully',
                data: $accommodation,
                statusCode: 200
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function add_accommodation_featuredphoto(Request $request, $id)
    {
        try {
            // Find the driver
            $accommodation = Accommodation::find($id);

            if (!$accommodation) {
                return ResponseHelper::Error(
                    message: 'Accommodation not found',
                    statusCode: 404
                );
            }

            // Validate the photo
            $request->validate([
                'featured_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Handle the new file upload
            if ($request->hasFile("featured_photo")) {
                // If there's an existing photo, unlink (delete) it
                if ($accommodation->featured_photo) {
                    $oldPhotoPath = public_path("/uploads/") . $accommodation->featured_photo;
                    if (file_exists($oldPhotoPath)) {
                        unlink($oldPhotoPath);
                    }
                }

                // Upload the new photo
                $file = $request->file("featured_photo");
                $imageName = 'Accommodation_featured_photo_' . time() . '_' . $file->getClientOriginalName();
                $file->move(\public_path("/uploads"), $imageName);

                // Update the driver's photo in the database
                $accommodation->featured_photo = $imageName;
                $accommodation->save();
            }

            return ResponseHelper::Success(
                message: 'Accommodation photo updated successfully',
                data: $accommodation,
                statusCode: 200
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function add_accommodation_photos(Request $request)
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
            if ($request->hasFile("HotelPhotos")) {
                $files = $request->file("HotelPhotos");
                foreach ($files as $file) {
                    // $imageName = env('APP_URL') . '/TourImages' . '/' . time() . '_' . $file->getClientOriginalName();
                    $imageName = 'Hotel_photo_' . time() . '_' . $file->getClientOriginalName();
                    $request['accommodation_id'] = $request->accommodation_id;
                    $request['photo'] = $imageName;
                    $file->move(\public_path("/uploads"), $imageName);
                    AccommodationPhoto::create($request->all());
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

    public function delete_accommodation_photo($id)
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

            // Find the photo by ID
            $photo = AccommodationPhoto::find($id);
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

    public function edit_accommodation_share(Request $request, $id)
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

            // Find the tour by ID
            $accommodation = Accommodation::find($id);
            if (!$accommodation) {
                return ResponseHelper::Error(
                    message: 'Accommodation not found',
                    statusCode: 404
                );
            }

            // Validate the request data
            $request->validate([
                'share' => 'required',

            ]);

            // Update the tour details
            $accommodation->update([
                'share' => $request->share ?? $accommodation->share,
            ]);

            // Return success response with updated tour data
            return ResponseHelper::Success(
                message: 'Accommodation Updated Successfully',
                data: $accommodation,
                statusCode: 200
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }


    // public function get_all_drivers()
    // {
    //     try {
    //         $cooperator = auth()->user();

    //         // Check if the user is authenticated
    //         if (!$cooperator) {
    //             return ResponseHelper::Error(
    //                 message: 'Unauthorized',
    //                 statusCode: 401
    //             );
    //         }

    //         // Define the base query
    //         $query = Driver::with('transportationType', 'city', 'destination', 'driverCarPhotos');

    //         //1-Admin  2-Tour Operator   3-Tourguide   4-Hotel   5-Travel Agency  6-Driver 7-Customer Service
    //         switch ($cooperator->rule_id) {
    //             case 1: // Admin
    //                 $drivers = $query->get();
    //                 break;

    //             case 2: // Tour Operator
    //                 $drivers = $query->where('destination_id', $cooperator->destination_id)->get();
    //                 break;

    //             default:
    //                 return ResponseHelper::Error(
    //                     message: 'Unauthorized',
    //                     statusCode: 403
    //                 );
    //         }

    //         // Return success response with retrieved tours
    //         return ResponseHelper::Success(
    //             message: 'Loaded Successfully',
    //             data: $drivers,
    //             statusCode: 200
    //         );

    //     } catch (Exception $e) {
    //         return ResponseHelper::Error(
    //             message: $e->getMessage(),
    //             statusCode: 500
    //         );
    //     }
    // }
    // public function create_driver(Request $request)
    // {
    //     try {
    //         $cooperator = auth()->user();
    //         // Check if the user is authenticated
    //         if (!$cooperator) {
    //             return ResponseHelper::Error(
    //                 message: 'Unauthorized',
    //                 statusCode: 401
    //             );
    //         }
    //         // Validate the request data
    //         $validated = $request->validate([
    //             'name' => 'required',
    //             'phone' => 'required',
    //             'city_id' => 'required',
    //             'transportationType_id' => 'required',
    //             'destination_id' => 'required',
    //             'carModel' => 'required',
    //             'numberOfSeats' => 'required',
    //             'note' => 'required',
    //             'pricePerDay' => 'required',
    //             'rate' => 'required',
    //             'DriverPhoto' => 'required',

    //             'images' => 'nullable|array',
    //             'images.*' => 'nullable|image', // validate image files
    //         ]);
    //         $obj = new Driver();

    //         if ($request->hasFile("DriverPhoto")) {
    //             $file = $request->file("DriverPhoto");
    //             $imageName = 'Driver_photo_' . time() . '_' . $file->getClientOriginalName();
    //             $file->move(\public_path("/uploads"), $imageName);
    //             $obj->driverPhoto = $imageName;
    //         }


    //         $obj->name = $request->name;
    //         $obj->phone = $request->phone;
    //         $obj->city_id = $request->city_id;
    //         $obj->email = $request->transportationType_id;
    //         $obj->destination_id = $request->destination_id;
    //         $obj->carModel = $request->carModel;
    //         $obj->numberOfSeats = $request->numberOfSeats;
    //         $obj->note = $request->note;
    //         $obj->pricePerDay = $request->pricePerDay;
    //         $obj->rate = $request->rate;
    //         $obj->save();

    //         if ($request->hasFile("CarPhoto")) {
    //             $files = $request->file("CarPhoto");
    //             foreach ($files as $file) {
    //                 // $imageName = env('APP_URL') . '/TourImages' . '/' . time() . '_' . $file->getClientOriginalName();
    //                 $imageName = 'Car_photo_' . time() . '_' . $file->getClientOriginalName();
    //                 $request['driver_id'] = $obj->id;
    //                 $request['car_photo'] = $imageName;
    //                 $file->move(\public_path("/uploads"), $imageName);
    //                 DriverCarPhoto::create($request->all());
    //             }
    //         }

    //         // Return success response with created tour data
    //         return ResponseHelper::Success(
    //             message: 'Driver Created Successfully',
    //             data: $obj,
    //             statusCode: 201
    //         );
    //     } catch (Exception $e) {
    //         return ResponseHelper::Error(
    //             message: $e->getMessage(),
    //             statusCode: 500
    //         );
    //     }
    // }

    // public function delete_driver($id)
    // {
    //     try {

    //         // Find the tour by ID
    //         $driver = Driver::find($id);

    //         // Check if the tour exists
    //         if (!$driver) {
    //             return ResponseHelper::Success(
    //                 message: 'Driver Not Found',
    //                 statusCode: 404
    //             );
    //         }


    //         $total = PrivateTour::where('driver_id', $id)->count();
    //         if ($total > 0) {
    //             return ResponseHelper::Success(
    //                 message: 'This Driver cannot be deleted because it is associated with other tour details.',
    //                 statusCode: 404
    //             );
    //         }

    //         // Delete the driver's photo (driverPhoto) from storage
    //         if ($driver->driverPhoto) {
    //             $driverPhotoPath = public_path("/uploads/" . $driver->driverPhoto);
    //             if (file_exists($driverPhotoPath)) {
    //                 unlink($driverPhotoPath);
    //             }
    //         }

    //         // Delete associated images
    //         $driverPhotos = DriverCarPhoto::where('driver_id', $id)->get();
    //         foreach ($driverPhotos as $photo) {
    //             // Delete the file from storage if it exists
    //             $photoPath = public_path("/uploads/" . $photo->car_photo);
    //             if (file_exists($photoPath)) {
    //                 unlink($photoPath);
    //             }
    //             $photo->delete();
    //         }

    //         // Delete the tour
    //         $driver->delete();

    //         // Return success response
    //         return ResponseHelper::Success(
    //             message: 'Driver Deleted Successfully',
    //             statusCode: 200
    //         );
    //     } catch (Exception $e) {
    //         return ResponseHelper::Error(
    //             message: $e->getMessage(),
    //             statusCode: 500
    //         );
    //     }
    // }

    // public function get_single_driver($id)
    // {
    //     try {
    //         $cooperator = auth()->user();
    //         // Check if the user is authenticated
    //         if (!$cooperator) {
    //             return ResponseHelper::Error(
    //                 message: 'Unauthorized',
    //                 statusCode: 401
    //             );
    //         }
    //         //1-Admin  2-Tour Operator   3-Tourguide   4-Hotel   5-Travel Agency  6-Driver 7-Customer Service
    //         if ($cooperator->rule_id = 1 || $cooperator->rule_id = 2) {
    //             $driver = Driver::with('transportationType', 'city', 'destination', 'driverCarPhotos')->where('id', $id)->first();

    //             return ResponseHelper::Success(
    //                 message: 'Loaded Successfully',
    //                 data: $driver,
    //                 statusCode: 200
    //             );
    //         }
    //         return ResponseHelper::Error(
    //             message: 'Unauthorized',
    //             statusCode: 401
    //         );
    //     } catch (Exception $e) {
    //         return ResponseHelper::Error(
    //             message: $e->getMessage(),
    //             statusCode: 500
    //         );
    //     }
    // }

    // public function edit_driver(Request $request, $id)
    // {
    //     try {
    //         $cooperator = auth()->user();
    //         // Check if the user is authenticated
    //         if (!$cooperator) {
    //             return ResponseHelper::Error(
    //                 message: 'Unauthorized',
    //                 statusCode: 401
    //             );
    //         }

    //         // Find the tour by ID
    //         $driver = Driver::find($id);
    //         if (!$driver) {
    //             return ResponseHelper::Error(
    //                 message: 'Driver not found',
    //                 statusCode: 404
    //             );
    //         }

    //         // Validate the request data
    //         $validated = $request->validate([
    //             'name' => 'required',
    //             'phone' => 'required',
    //             'city_id' => 'required',
    //             'transportationType_id' => 'required',
    //             'destination_id' => 'required',
    //             'carModel' => 'required',
    //             'numberOfSeats' => 'required',
    //             'note' => 'required',
    //             'pricePerDay' => 'required',
    //             'rate' => 'required',
    //         ]);

    //         // Update the tour details
    //         $driver->update([
    //             'name' => $request->name,
    //             'phone' => $request->phone,
    //             'city_id' => $request->city_id,
    //             'transportationType_id' => $request->transportationType_id,
    //             'destination_id' => $request->destination_id,
    //             'carModel' => $request->carModel,
    //             'numberOfSeats' => $request->numberOfSeats,
    //             'note' => $request->note,
    //             'pricePerDay' => $request->pricePerDay,
    //             'rate' => $request->rate,
    //         ]);

    //         // Return success response with updated tour data
    //         return ResponseHelper::Success(
    //             message: 'Driver Updated Successfully',
    //             data: $driver,
    //             statusCode: 200
    //         );
    //     } catch (Exception $e) {
    //         return ResponseHelper::Error(
    //             message: $e->getMessage(),
    //             statusCode: 500
    //         );
    //     }
    // }
    // public function add_driver_carPhotos(Request $request)
    // {
    //     try {
    //         $cooperator = auth()->user();
    //         // Check if the user is authenticated
    //         if (!$cooperator) {
    //             return ResponseHelper::Error(
    //                 message: 'Unauthorized',
    //                 statusCode: 401
    //             );
    //         }
    //         if ($request->hasFile("CarPhoto")) {
    //             $files = $request->file("CarPhoto");
    //             foreach ($files as $file) {
    //                 // $imageName = env('APP_URL') . '/TourImages' . '/' . time() . '_' . $file->getClientOriginalName();
    //                 $imageName = 'Car_photo_' . time() . '_' . $file->getClientOriginalName();
    //                 $request['driver_id'] = $request->driver_id;
    //                 $request['car_photo'] = $imageName;
    //                 $file->move(\public_path("/uploads"), $imageName);
    //                 DriverCarPhoto::create($request->all());
    //             }
    //         }

    //         // Return success response with created tour data
    //         return ResponseHelper::Success(
    //             message: 'Photos added Successfully',
    //             statusCode: 201
    //         );
    //     } catch (Exception $e) {
    //         return ResponseHelper::Error(
    //             message: $e->getMessage(),
    //             statusCode: 500
    //         );
    //     }
    // }
    // public function delete_driver_carphoto($id)
    // {
    //     try {
    //         $cooperator = auth()->user();
    //         // Check if the user is authenticated
    //         if (!$cooperator) {
    //             return ResponseHelper::Error(
    //                 message: 'Unauthorized',
    //                 statusCode: 401
    //             );
    //         }

    //         // Find the photo by ID
    //         $photo = DriverCarPhoto::find($id);
    //         if (!$photo) {
    //             return ResponseHelper::Error(
    //                 message: 'Photo not found',
    //                 statusCode: 404
    //             );
    //         }

    //         // Delete the file from the server
    //         $filePath = public_path("/uploads/" . $photo->car_photo);
    //         if (file_exists($filePath)) {
    //             unlink($filePath);
    //         }

    //         // Delete the photo record from the database
    //         $photo->delete();

    //         // Return success response
    //         return ResponseHelper::Success(
    //             message: 'Photo deleted successfully',
    //             statusCode: 200
    //         );
    //     } catch (Exception $e) {
    //         return ResponseHelper::Error(
    //             message: $e->getMessage(),
    //             statusCode: 500
    //         );
    //     }
    // }
    // public function add_driver_photo(Request $request, $id)
    // {
    //     try {
    //         // Find the driver
    //         $driver = Driver::find($id);

    //         if (!$driver) {
    //             return ResponseHelper::Error(
    //                 message: 'Driver not found',
    //                 statusCode: 404
    //             );
    //         }

    //         // Validate the photo
    //         $request->validate([
    //             'DriverPhoto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         ]);

    //         // Handle the new file upload
    //         if ($request->hasFile("DriverPhoto")) {
    //             // If there's an existing photo, unlink (delete) it
    //             if ($driver->driverPhoto) {
    //                 $oldPhotoPath = public_path("/uploads/") . $driver->driverPhoto;
    //                 if (file_exists($oldPhotoPath)) {
    //                     unlink($oldPhotoPath);
    //                 }
    //             }

    //             // Upload the new photo
    //             $file = $request->file("DriverPhoto");
    //             $imageName = 'Driver_photo_' . time() . '_' . $file->getClientOriginalName();
    //             $file->move(\public_path("/uploads"), $imageName);

    //             // Update the driver's photo in the database
    //             $driver->driverPhoto = $imageName;
    //             $driver->save();
    //         }

    //         return ResponseHelper::Success(
    //             message: 'Driver photo updated successfully',
    //             data: $driver,
    //             statusCode: 200
    //         );
    //     } catch (Exception $e) {
    //         return ResponseHelper::Error(
    //             message: $e->getMessage(),
    //             statusCode: 500
    //         );
    //     }
    // }

    // public function get_all_tourguides()
    // {
    //     try {
    //         $cooperator = auth()->user();

    //         // Check if the user is authenticated
    //         if (!$cooperator) {
    //             return ResponseHelper::Error(
    //                 message: 'Unauthorized',
    //                 statusCode: 401
    //             );
    //         }

    //         // Define the base query
    //         $query = Tourguide::with('city', 'destination');

    //         //1-Admin  2-Tour Operator   3-Tourguide   4-Hotel   5-Travel Agency  6-Driver 7-Customer Service
    //         switch ($cooperator->rule_id) {
    //             case 1: // Admin
    //                 $tourguides = $query->get();
    //                 break;

    //             case 2: // Tour Operator
    //                 $tourguides = $query->where('destination_id', $cooperator->destination_id)->get();
    //                 break;

    //             default:
    //                 return ResponseHelper::Error(
    //                     message: 'Unauthorized',
    //                     statusCode: 403
    //                 );
    //         }

    //         // Return success response with retrieved tours
    //         return ResponseHelper::Success(
    //             message: 'Loaded Successfully',
    //             data: $tourguides,
    //             statusCode: 200
    //         );

    //     } catch (Exception $e) {
    //         return ResponseHelper::Error(
    //             message: $e->getMessage(),
    //             statusCode: 500
    //         );
    //     }
    // }

    // public function create_tourguide(Request $request)
    // {
    //     try {
    //         $cooperator = auth()->user();
    //         // Check if the user is authenticated
    //         if (!$cooperator) {
    //             return ResponseHelper::Error(
    //                 message: 'Unauthorized',
    //                 statusCode: 401
    //             );
    //         }
    //         // Validate the request data
    //         $validated = $request->validate([
    //             'destination_id' => 'required',
    //             'city_id' => 'required',
    //             'name' => 'required',
    //             'mobile' => 'required',
    //             'email' => 'required',
    //             'TourguidePhoto' => 'required',
    //             'note' => 'required',
    //             'price_per_day' => 'required',
    //             'status' => 'required',
    //             'rate' => 'required',
    //             'date_of_birth' => 'required',
    //         ]);
    //         $obj = new Tourguide();

    //         if ($request->hasFile("TourguidePhoto")) {
    //             $file = $request->file("TourguidePhoto");
    //             $imageName = 'Tourguide_photo_' . time() . '_' . $file->getClientOriginalName();
    //             $file->move(\public_path("/uploads"), $imageName);
    //             $obj->photo = $imageName;
    //         }


    //         $obj->destination_id = $request->destination_id;
    //         $obj->city_id = $request->city_id;
    //         $obj->name = $request->name;
    //         $obj->mobile = $request->mobile;
    //         $obj->email = $request->email;
    //         $obj->note = $request->note;
    //         $obj->price_per_day = $request->price_per_day;
    //         $obj->status = $request->status;
    //         $obj->rate = $request->rate;
    //         $obj->date_of_birth = $request->date_of_birth;
    //         $obj->save();



    //         // Return success response with created tour data
    //         return ResponseHelper::Success(
    //             message: 'Tourguide Created Successfully',
    //             data: $obj,
    //             statusCode: 201
    //         );
    //     } catch (Exception $e) {
    //         return ResponseHelper::Error(
    //             message: $e->getMessage(),
    //             statusCode: 500
    //         );
    //     }
    // }

    // public function delete_tourguide($id)
    // {
    //     try {


    //         $tourguide = Tourguide::find($id);

    //         // Check if the tour exists
    //         if (!$tourguide) {
    //             return ResponseHelper::Success(
    //                 message: 'Tourguide Not Found',
    //                 statusCode: 404
    //             );
    //         }

    //         $total = PrivateTourDetail::where('tourguide_id', $id)->count();
    //         if ($total > 0) {
    //             return ResponseHelper::Success(
    //                 message: 'This Tourguide cannot be deleted because it is associated with other tour details.',
    //                 statusCode: 404
    //             );
    //         }


    //         // Delete the driver's photo (driverPhoto) from storage
    //         if ($tourguide->photo) {
    //             $tourguidePhotoPath = public_path("/uploads/" . $tourguide->photo);
    //             if (file_exists($tourguidePhotoPath)) {
    //                 unlink($tourguidePhotoPath);
    //             }
    //         }


    //         // Delete the tour
    //         $tourguide->delete();

    //         // Return success response
    //         return ResponseHelper::Success(
    //             message: 'Tourguide Deleted Successfully',
    //             statusCode: 200
    //         );
    //     } catch (Exception $e) {
    //         return ResponseHelper::Error(
    //             message: $e->getMessage(),
    //             statusCode: 500
    //         );
    //     }
    // }
    // public function get_single_tourguide($id)
    // {
    //     try {
    //         $cooperator = auth()->user();
    //         // Check if the user is authenticated
    //         if (!$cooperator) {
    //             return ResponseHelper::Error(
    //                 message: 'Unauthorized',
    //                 statusCode: 401
    //             );
    //         }
    //         //1-Admin  2-Tour Operator   3-Tourguide   4-Hotel   5-Travel Agency  6-Driver 7-Customer Service
    //         if ($cooperator->rule_id = 1 || $cooperator->rule_id = 2) {
    //             $tourguide = Tourguide::with('city', 'destination')->where('id', $id)->first();

    //             return ResponseHelper::Success(
    //                 message: 'Loaded Successfully',
    //                 data: $tourguide,
    //                 statusCode: 200
    //             );
    //         }
    //         return ResponseHelper::Error(
    //             message: 'Unauthorized',
    //             statusCode: 401
    //         );
    //     } catch (Exception $e) {
    //         return ResponseHelper::Error(
    //             message: $e->getMessage(),
    //             statusCode: 500
    //         );
    //     }
    // }

    // public function edit_tourguide(Request $request, $id)
    // {
    //     try {
    //         $cooperator = auth()->user();
    //         // Check if the user is authenticated
    //         if (!$cooperator) {
    //             return ResponseHelper::Error(
    //                 message: 'Unauthorized',
    //                 statusCode: 401
    //             );
    //         }

    //         // Find the tour by ID
    //         $tourguide = Tourguide::find($id);
    //         if (!$tourguide) {
    //             return ResponseHelper::Error(
    //                 message: 'Tourguide not found',
    //                 statusCode: 404
    //             );
    //         }

    //         // Validate the request data
    //         $validated = $request->validate([
    //             'destination_id' => 'required',
    //             'city_id' => 'required',
    //             'name' => 'required',
    //             'mobile' => 'required',
    //             'email' => 'required',

    //             'note' => 'required',
    //             'price_per_day' => 'required',
    //             'status' => 'required',
    //             'rate' => 'required',
    //             'date_of_birth' => 'required',
    //         ]);

    //         // Update the tour details
    //         $tourguide->update([
    //             'destination_id' => $request->destination_id,
    //             'city_id' => $request->city_id,
    //             'name' => $request->name,
    //             'mobile' => $request->mobile,
    //             'email' => $request->email,
    //             'note' => $request->note,
    //             'price_per_day' => $request->price_per_day,
    //             'status' => $request->status,
    //             'date_of_birth' => $request->date_of_birth,
    //             'rate' => $request->rate,
    //         ]);

    //         // Return success response with updated tour data
    //         return ResponseHelper::Success(
    //             message: 'Tourguide Updated Successfully',
    //             data: $tourguide,
    //             statusCode: 200
    //         );
    //     } catch (Exception $e) {
    //         return ResponseHelper::Error(
    //             message: $e->getMessage(),
    //             statusCode: 500
    //         );
    //     }
    // }

    // public function add_tourguide_photo(Request $request, $id)
    // {
    //     try {
    //         // Find the driver
    //         $tourguide = Tourguide::find($id);

    //         if (!$tourguide) {
    //             return ResponseHelper::Error(
    //                 message: 'Tourguide not found',
    //                 statusCode: 404
    //             );
    //         }

    //         // Validate the photo
    //         $request->validate([
    //             'TourguidePhoto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         ]);

    //         // Handle the new file upload
    //         if ($request->hasFile("TourguidePhoto")) {
    //             // If there's an existing photo, unlink (delete) it
    //             if ($tourguide->photo) {
    //                 $oldPhotoPath = public_path("/uploads/") . $tourguide->photo;
    //                 if (file_exists($oldPhotoPath)) {
    //                     unlink($oldPhotoPath);
    //                 }
    //             }

    //             // Upload the new photo
    //             $file = $request->file("TourguidePhoto");
    //             $imageName = 'Tourguide_photo_' . time() . '_' . $file->getClientOriginalName();
    //             $file->move(\public_path("/uploads"), $imageName);

    //             // Update the driver's photo in the database
    //             $tourguide->photo = $imageName;
    //             $tourguide->save();
    //         }

    //         return ResponseHelper::Success(
    //             message: 'Tourguide photo updated successfully',
    //             data: $tourguide,
    //             statusCode: 200
    //         );
    //     } catch (Exception $e) {
    //         return ResponseHelper::Error(
    //             message: $e->getMessage(),
    //             statusCode: 500
    //         );
    //     }
    // }

    public function get_rooms_categories()
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


            $rooms_categories = RoomCategory::orderBy('category', 'asc')->get();


            return ResponseHelper::Success(
                message: 'Loaded Successfully',
                data: $rooms_categories,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }


    // Hotel Rooms Categories and Prices 
    public function syncRoomCategories(Request $request)
    {
        try {
            $validated = $request->validate([
                'room_category_ids' => 'required|array',
                'room_category_ids.*' => 'exists:room_categories,id',
            ]);

            $accommodation = Accommodation::findOrFail($request->accommodation_id);

            // Get the current room category IDs for this accommodation
            $currentCategoryIds = $accommodation->accommodation_rooms_categories->pluck('room_category_id')->toArray();

            // Determine which IDs to add and which to remove
            $toAdd = array_diff($validated['room_category_ids'], $currentCategoryIds);
            $toRemove = array_diff($currentCategoryIds, $validated['room_category_ids']);

            // Add new relationships
            foreach ($toAdd as $categoryId) {
                $accommodation->accommodation_rooms_categories()->create([
                    'room_category_id' => $categoryId,
                ]);
            }

            // Remove old relationships
            $accommodation->accommodation_rooms_categories()->whereIn('room_category_id', $toRemove)->delete();

            return ResponseHelper::Success(
                message: 'Room categories updated successfully',
                statusCode: 200
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }


    public function updateOrCreateSeasonsAndPrices(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'accommodation_id' => 'required|exists:accommodations,id',
                'season_prices' => 'required|array',
                'season_prices.*.id' => 'nullable|exists:seasons,id',
                'season_prices.*.from' => 'required|date',
                'season_prices.*.till' => 'required|date|after_or_equal:season_prices.*.from',
                'season_prices.*.extraBed' => 'required|numeric',
                'season_prices.*.RoomsCategory' => 'required|array',
                'season_prices.*.RoomsCategory.*.id' => 'required|exists:accommodation_rooms_categories,id',
                'season_prices.*.RoomsCategory.*.Price' => 'required|numeric',
                // 'season_prices.*.RoomsCategory.*.room_price_id' => 'nullable|exists:room_prices,id',
            ]);

            $accommodationId = $validated['accommodation_id'];

            // Track the processed season and room price IDs
            $processedSeasonIds = [];
            $processedRoomPriceIds = [];

            foreach ($validated['season_prices'] as $seasonData) {
                // Step 1: Update or create the season
                $season = Season::updateOrCreate(
                    [
                        'id' => $seasonData['id'] ?? null, // Update if ID exists, create otherwise
                    ],
                    [
                        'accommodation_id' => $accommodationId,
                        'start_date' => $seasonData['from'],
                        'end_date' => $seasonData['till'],
                        'extra_bed' => $seasonData['extraBed'],
                    ]
                );

                // Add the processed season ID
                $processedSeasonIds[] = $season->id;

                // Step 2: Update or create room prices for this season
                foreach ($seasonData['RoomsCategory'] as $roomData) {
                    // If room_price_id is missing, create a new room price with null room_price_id
                    $roomPrice = RoomPrice::updateOrCreate(
                        [
                            'id' => $roomData['room_price_id'] ?? null, // Update if room_price_id exists, create otherwise
                            'accommodation_id' => $accommodationId,
                            'accommodation_room_category_id' => $roomData['id'],
                            'season_id' => $season->id,
                        ],
                        [
                            'price' => $roomData['Price'],
                        ]
                    );

                    // Add the processed room price ID
                    $processedRoomPriceIds[] = $roomPrice->id;
                }
            }

            // Step 3: Delete any seasons not in the processedSeasonIds
            Season::where('accommodation_id', $accommodationId)
                ->whereNotIn('id', $processedSeasonIds)
                ->delete();

            // Step 4: Delete any room prices not in the processedRoomPriceIds
            RoomPrice::where('accommodation_id', $accommodationId)
                ->whereNotIn('id', $processedRoomPriceIds)
                ->delete();

            return ResponseHelper::Success(
                message: 'Seasons and room prices updated successfully',
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
