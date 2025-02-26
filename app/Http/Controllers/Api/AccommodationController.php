<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\AccommodationPhoto;
use App\Models\PrivateTourDetail;
use App\Models\RoomCategory;
use App\Models\RoomPrice;
use App\Models\Season;
use Exception;
use Illuminate\Http\Request;
use DB;
// 1-Admin  2-Tour Operator   3-Tourguide   4-Hotel   5-Travel Agency  6-Driver 7-Customer Service
class AccommodationController extends Controller
{
    public function get_all_accommodations($id)
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
            $query = Accommodation::with('destination', 'city', 'photos', 'accommodation_rooms_categories.room_category', 'seasons.roomPrices', 'roomPrices');

            //1-Admin  2-Tour Operator   3-Tourguide   4-Hotel   5-Travel Agency  6-Driver 7-Customer Service
            switch ($cooperator->rule_id) {
                case 1: // Admin
                    $acoommodations = $query->where('destination_id', $id)->get();
                    break;

                case 2: // Tour Operator
                    $acoommodations = $query->where('destination_id', $cooperator->destination_id)->get();
                    break;
                case 5: //Travel Agency
                    $acoommodations = $query->where('destination_id', $id)->get();
                    break;
                case 7: //Travel Agency
                    $acoommodations = $query->where('destination_id', $id)->get();
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
            if (!$cooperator || $cooperator->rule_id == 7 || $cooperator->rule_id == 5) {
                return ResponseHelper::Success(
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

            $cooperator = auth()->user();
            // Check if the user is authenticated
            if (!$cooperator || $cooperator->rule_id == 7 || $cooperator->rule_id == 5) {
                return ResponseHelper::Success(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }
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
        } catch (Exception $e) {
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
                return ResponseHelper::success(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }
            //1-Admin  2-Tour Operator   3-Tourguide   4-Hotel   5-Travel Agency  6-Driver 7-Customer Service
            if ($cooperator->rule_id = 4) {
                $accommodation = Accommodation::with('destination', 'city', 'photos', 'accommodation_rooms_categories.room_category', 'seasons.roomPrices', 'roomPrices')->where('id', $id)->first();

                return ResponseHelper::Success(
                    message: 'Loaded Successfully',
                    data: $accommodation,
                    statusCode: 200
                );
            }
            return ResponseHelper::success(
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
            if (!$cooperator || $cooperator->rule_id == 7 || $cooperator->rule_id == 5) {
                return ResponseHelper::Success(
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

            $cooperator = auth()->user();
            // Check if the user is authenticated
            if (!$cooperator || $cooperator->rule_id == 7 || $cooperator->rule_id == 5) {
                return ResponseHelper::Success(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }
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
            if (!$cooperator || $cooperator->rule_id == 7 || $cooperator->rule_id == 5) {
                return ResponseHelper::Success(
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
            if (!$cooperator || $cooperator->rule_id == 7 || $cooperator->rule_id == 5) {
                return ResponseHelper::Success(
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
            if (!$cooperator || $cooperator->rule_id == 7 || $cooperator->rule_id == 5) {
                return ResponseHelper::Success(
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
            $cooperator = auth()->user();
            // Check if the user is authenticated
            if (!$cooperator || $cooperator->rule_id == 7 || $cooperator->rule_id == 5) {
                return ResponseHelper::Success(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }
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

            $cooperator = auth()->user();
            // Check if the user is authenticated
            if (!$cooperator || $cooperator->rule_id == 7 || $cooperator->rule_id == 5) {
                return ResponseHelper::Success(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }
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
