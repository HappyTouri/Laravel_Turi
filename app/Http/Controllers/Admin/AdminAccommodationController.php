<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\AccommodationPhoto;
use App\Models\AccommodationRoomsCategory;
use App\Models\City;
use App\Models\Destination;
use App\Models\RoomCategory;
use App\Models\RoomPrice;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminAccommodationController extends Controller
{
    public function index($id)
    {
        $destination = Destination::where('id', $id)->first();
        $accommodations = Accommodation::with('city')->get();
        return view('admin.accommodation.index', compact('accommodations', 'destination'));
    }

    public function create($id)
    {
        $destination = Destination::where('id', $id)->first();
        $cities = City::where('destination_id', $id)->get();
        return view('admin.accommodation.create', compact('destination', 'cities'));
    }

    public function create_submit(Request $request, $id)
    {
        $request->validate([
            'name' => ['required'],
            'city_id' => ['required'],
            'accommodation_type' => ['required'],
            'email' => ['required'],
            'address' => ['required'],
            'video_link' => ['required'],
            'hotel_website' => ['required'],
            'rate' => ['required'],
            'phone' => ['required'],
            'note' => ['required'],
            'featured_photo' => [
                'required',    // Field is required
                'mimes:jpg,jpeg,png,gif', // Only allow certain file types
                'max:4300'     // Maximum file size of 4.3 MB
            ],

        ]);

        $final_name = 'accommodation_feature_' . time() . '.' . $request->featured_photo->getClientOriginalExtension();
        $request->featured_photo->move(public_path('uploads'), $final_name);


        $accommodation = new Accommodation();
        $accommodation->featured_photo = $final_name;

        $accommodation->destination_id = $id;
        $accommodation->city_id = $request->city_id;
        $accommodation->phone = $request->phone;
        $accommodation->name = $request->name;
        $accommodation->accommodation_type = $request->accommodation_type;
        $accommodation->email = $request->email;
        $accommodation->address = $request->address;
        $accommodation->video_link = $request->video_link;
        $accommodation->hotel_website = $request->hotel_website;
        $accommodation->rate = $request->rate;
        $accommodation->note = $request->note;

        $accommodation->save();

        return redirect()->route('admin_accommodation_index', $id)->with('success', 'Accommodation is Created successfuly');

    }

    public function edit($id)
    {
        $accommodation = Accommodation::with('destination')->find($id);
        $cities = City::where('destination_id', $id)->get();
        return view('admin.accommodation.edit', compact('accommodation', 'cities'));
    }

    public function edit_submit(Request $request, $id)
    {

        $accommodation = Accommodation::with('destination')->where('id', $id)->first();
        $request->validate([
            'name' => ['required'],
            'city_id' => ['required'],
            'accommodation_type' => ['required'],
            'email' => ['required'],
            'address' => ['required'],
            'video_link' => ['required'],
            'hotel_website' => ['required'],
            'rate' => ['required'],
            'phone' => ['required'],
            'note' => ['required'],
        ]);

        if ($request->hasFile('featured_photo')) {
            $request->validate([
                'featured_photo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
            ]);
            unlink(public_path('uploads/' . $accommodation->featured_photo));
            $final_name = 'accommodation_feature_' . time() . '.' . $request->featured_photo->getClientOriginalExtension();
            $request->featured_photo->move(public_path('uploads'), $final_name);
            $accommodation->featured_photo = $final_name;
        }



        $accommodation->destination_id = $id;
        $accommodation->city_id = $request->city_id;
        $accommodation->phone = $request->phone;
        $accommodation->name = $request->name;
        $accommodation->accommodation_type = $request->accommodation_type;
        $accommodation->email = $request->email;
        $accommodation->address = $request->address;
        $accommodation->video_link = $request->video_link;
        $accommodation->hotel_website = $request->hotel_website;
        $accommodation->rate = $request->rate;
        $accommodation->note = $request->note;

        $accommodation->save();

        return redirect()->route('admin_accommodation_index', $accommodation->destination->id)->with('success', 'accommodation is Updated successfuly');
    }

    public function delete($id)
    {
        // $total = accommodationPhoto::where('accommodation_id', $id)->count();
        // if ($total > 0) {
        //     return redirect()->route('admin_accommodation_index')->with('error', 'First Delete all Photos of This accommodation');
        // }

        // $total1 = accommodationVideo::where('accommodation_id', $id)->count();
        // if ($total1 > 0) {
        //     return redirect()->route('admin_accommodation_index')->with('error', 'First Delete all Videos of This accommodation');
        // }

        // $total3 = accommodationAmenity::where('accommodation_id', $id)->count();
        // if ($total3 > 0) {
        //     return redirect()->route('admin_accommodation_index')->with('error', 'First Delete all Amenities of This accommodation');
        // }
        // $total4 = accommodationItinerary::where('accommodation_id', $id)->count();
        // if ($total4 > 0) {
        //     return redirect()->route('admin_accommodation_index')->with('error', 'First Delete all Itinerary of This accommodation');
        // }
        // $total5 = accommodationFaq::where('accommodation_id', $id)->count();
        // if ($total5 > 0) {
        //     return redirect()->route('admin_accommodation_index')->with('error', 'First Delete all FAQs of This accommodation');
        // }
        // $total6 = accommodationTour::where('accommodation_id', $id)->count();
        // if ($total6 > 0) {
        //     return redirect()->route('admin_accommodation_index')->with('error', 'First Delete all Tours of This accommodation');
        // }

        $accommodation = Accommodation::find($id);
        unlink(public_path('uploads/' . $accommodation->featured_photo));
        $accommodation->delete();
        return redirect()->back()->with('success', 'accommodation Deleted successfuly');
    }



    public function accommodation_photos($id)
    {
        $accommodation = Accommodation::where('id', $id)->first();
        $accommodation_photos = AccommodationPhoto::where('accommodation_id', $id)->get();
        return view('admin.accommodation.photos', compact('accommodation', 'accommodation_photos'));
    }

    public function accommodation_photo_submit(Request $request, $id)
    {
        $request->validate([
            'photo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
        ]);

        $final_name = 'accommodation_' . time() . '.' . $request->photo->getClientOriginalExtension();
        $request->photo->move(public_path('uploads'), $final_name);

        $obj = new AccommodationPhoto();
        $obj->accommodation_id = $id;
        $obj->photo = $final_name;
        $obj->save();

        return redirect()->back()->with('success', 'Photo inserted successfuly');
    }

    public function accommodation_photo_delete($id)
    {

        $accommodation_photo = AccommodationPhoto::find($id);
        unlink(public_path('uploads/' . $accommodation_photo->photo));
        $accommodation_photo->delete();
        return redirect()->back()->with('success', 'Photo is Deleted successfuly');
    }


    public function accommodation_rooms_categories($id)
    {
        $accommodation = Accommodation::where('id', $id)->first();

        // Get accommodation room categories with the relationship
        $accommodation_rooms_categories = AccommodationRoomsCategory::with('room_category')
            ->where('accommodation_id', $id)
            ->get();

        // Get the room category IDs that are already associated with the accommodation
        $existing_category_ids = $accommodation_rooms_categories->pluck('room_category_id')->toArray();

        // Fetch the room categories that are not in the accommodation
        $rooms_categories = RoomCategory::whereNotIn('id', $existing_category_ids)
            ->orderBy('category', 'asc')
            ->get();

        return view('admin.accommodation.rooms_category', compact(
            'accommodation',
            'accommodation_rooms_categories',
            'rooms_categories'
        ));
    }


    public function accommodation_room_category_submit(Request $request, $id)
    {
        $total = AccommodationRoomsCategory::where('accommodation_id', $id)->where('room_category_id', $request->room_category_id)->count();
        if ($total > 0) {
            return redirect()->back()->with('error', 'This Category is Already Inserted');
        }
        $obj = new AccommodationRoomsCategory();
        $obj->accommodation_id = $id;
        $obj->room_category_id = $request->room_category_id;
        $obj->save();

        return redirect()->back()->with('success', 'Room Category inserted successfuly');
    }

    public function accommodation_room_category_delete($id)
    {

        $room_category = AccommodationRoomsCategory::find($id);
        $room_category->delete();
        return redirect()->back()->with('success', 'Room Category is Deleted successfuly');
    }


    public function accommodation_price_list($id)
    {

        $accommodation = Accommodation::findOrFail($id);
        $accommodation_rooms_categories = AccommodationRoomsCategory::with('room_category')->where('accommodation_id', $id)->get();
        $seasons = Season::with([
            'roomPrices' => function ($query) use ($id) {
                $query->where('accommodation_id', $id);
            }
        ])->where('accommodation_id', $id)->orderBy('start_date', 'asc')->get();

        // dd($seasons);

        return view('admin.accommodation.price', compact(
            'accommodation',
            'accommodation_rooms_categories',
            'seasons'
        ));
    }

    public function saveRoomPrices(Request $request, $accommodationId)
    {

        // Get the list of season IDs that are marked for deletion
        $deleteSeasonIds = $request->delete_season_ids ?? [];

        // Filter out deleted seasons from the request data
        $filteredStartDates = [];
        $filteredEndDates = [];
        $filteredExtraBedPrices = [];
        $filteredRoomPrices = [];
        $filteredSeasonIds = [];

        for ($i = 0; $i < count($request->season_start_date); $i++) {
            $seasonId = $request->season_ids[$i] ?? null;

            // If the season is not marked for deletion, keep it in the filtered arrays
            if (!in_array($seasonId, $deleteSeasonIds)) {
                $filteredSeasonIds[] = $seasonId;
                $filteredStartDates[] = $request->season_start_date[$i];
                $filteredEndDates[] = $request->season_end_date[$i];
                $filteredExtraBedPrices[] = $request->extra_bed_price[$i];

                // For room prices, we also need to filter by room category
                foreach ($request->room_prices as $roomCategoryId => $prices) {
                    $filteredRoomPrices[$roomCategoryId][] = $prices[$i];
                }
            }
        }

        // Replace the request data with the filtered arrays
        $request->merge([
            'season_ids' => $filteredSeasonIds,
            'season_start_date' => $filteredStartDates,
            'season_end_date' => $filteredEndDates,
            'extra_bed_price' => $filteredExtraBedPrices,
            'room_prices' => $filteredRoomPrices,
        ]);



        // Handle deletions
        if (!empty($deleteSeasonIds)) {
            RoomPrice::whereIn('season_id', $deleteSeasonIds)->delete();
            Season::destroy($deleteSeasonIds);
        }
        // Validate the filtered data
        $request->validate([
            'season_ids' => 'array',
            'season_start_date' => 'required|array',
            'season_start_date.*' => 'required|date_format:d.m.Y',
            'season_end_date' => 'required|array',
            'season_end_date.*' => 'required|date_format:d.m.Y|after_or_equal:season_start_date.*',
            'extra_bed_price' => 'required|array',
            'extra_bed_price.*' => 'required|numeric|min:0',
            'room_prices' => 'required|array',
            'room_prices.*' => 'required|array',
            'room_prices.*.*' => 'required|numeric|min:0',
        ]);




        // Loop through the filtered season data and save prices
        for ($i = 0; $i < count($request->season_start_date); $i++) {
            $seasonId = $request->season_ids[$i] ?? null;

            // Convert the date format
            $startDate = \DateTime::createFromFormat('d.m.Y', $request->season_start_date[$i])->format('Y-m-d');
            $endDate = \DateTime::createFromFormat('d.m.Y', $request->season_end_date[$i])->format('Y-m-d');

            if ($seasonId) {
                // Update existing season
                $season = Season::findOrFail($seasonId);
                $season->update([
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'extra_bed' => $request->extra_bed_price[$i],
                ]);
            } else {
                // Create a new season
                $season = Season::create([
                    'accommodation_id' => $accommodationId,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'extra_bed' => $request->extra_bed_price[$i],
                ]);
            }

            // Save room prices for the created or updated season
            foreach ($request->room_prices as $roomCategoryId => $prices) {
                RoomPrice::updateOrCreate(
                    [
                        'accommodation_id' => $accommodationId,
                        'accommodation_room_category_id' => $roomCategoryId,
                        'season_id' => $season->id,
                    ],
                    [
                        'price' => $prices[$i],
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Room prices updated successfully!');
    }





}
