<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\DestinationVideo;
use App\Models\Tour;
use App\Models\TourPhoto;
use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\DestinationPhoto;
use Illuminate\Validation\Rule;

class AdminDestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::get();
        return view('admin.destination.index', compact('destinations'));
    }

    public function create()
    {
        return view('admin.destination.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'name_en' => ['required'],
            'name_ru' => ['required'],
            'name_ar' => ['required'],
            'slug' => ['required', 'alpha_dash', 'unique:destinations,slug'],
            'description_en' => ['required'],
            'description_ru' => ['required'],
            'description_ar' => ['required'],
            'country' => ['required'],
            'visa_requirement_en' => ['required'],
            'visa_requirement_ru' => ['required'],
            'visa_requirement_ar' => ['required'],
            'language_en' => ['required'],
            'language_ru' => ['required'],
            'language_ar' => ['required'],
            'currency_en' => ['required'],
            'currency_ru' => ['required'],
            'currency_ar' => ['required'],
            'activities_en' => ['required'],
            'activities_ru' => ['required'],
            'activities_ar' => ['required'],
            'area_en' => ['required'],
            'area_ru' => ['required'],
            'area_ar' => ['required'],
            'timezone_en' => ['required'],
            'timezone_ru' => ['required'],
            'timezone_ar' => ['required'],
            'best_time_en' => ['required'],
            'best_time_ru' => ['required'],
            'best_time_ar' => ['required'],
            'health_safety_en' => ['required'],
            'health_safety_ru' => ['required'],
            'health_safety_ar' => ['required'],
            'map' => ['required'],

            'featured_photo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
            'banner' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
        ]);

        $final_name = 'destination_' . time() . '.' . $request->featured_photo->getClientOriginalExtension();
        $request->featured_photo->move(public_path('uploads'), $final_name);

        $final_name1 = 'destination_banner_' . time() . '.' . $request->banner->getClientOriginalExtension();
        $request->banner->move(public_path('uploads'), $final_name1);


        $destination = new Destination();
        $destination->name_en = $request->name_en;
        $destination->name_ru = $request->name_ru;
        $destination->name_ar = $request->name_ar;
        $destination->slug = $request->slug;
        $destination->description_en = $request->description_en;
        $destination->description_ru = $request->description_ru;
        $destination->description_ar = $request->description_ar;
        $destination->country = $request->country;
        $destination->visa_requirement_en = $request->visa_requirement_en;
        $destination->visa_requirement_ru = $request->visa_requirement_ru;
        $destination->visa_requirement_ar = $request->visa_requirement_ar;
        $destination->language_en = $request->language_en;
        $destination->language_ru = $request->language_ru;
        $destination->language_ar = $request->language_ar;
        $destination->currency_en = $request->currency_en;
        $destination->currency_ru = $request->currency_ru;
        $destination->currency_ar = $request->currency_ar;
        $destination->activities_en = $request->activities_en;
        $destination->activities_ru = $request->activities_ru;
        $destination->activities_ar = $request->activities_ar;
        $destination->area_en = $request->area_en;
        $destination->area_ru = $request->area_ru;
        $destination->area_ar = $request->area_ar;
        $destination->timezone_en = $request->timezone_en;
        $destination->timezone_ru = $request->timezone_ru;
        $destination->timezone_ar = $request->timezone_ar;
        $destination->best_time_en = $request->best_time_en;
        $destination->best_time_ru = $request->best_time_ru;
        $destination->best_time_ar = $request->best_time_ar;
        $destination->health_safety_en = $request->health_safety_en;
        $destination->health_safety_ru = $request->health_safety_ru;
        $destination->health_safety_ar = $request->health_safety_ar;
        $destination->map = $request->map;
        $destination->featured_photo = $request->featured_photo;
        $destination->banner = $request->banner;
        $destination->save();

        return redirect()->route('admin_destination_index')->with('success', 'Destination is Created successfuly');

    }

    public function edit($id)
    {
        $destination = Destination::find($id);
        return view('admin.destination.edit', compact('destination'));
    }

    public function edit_submit(Request $request, $id)
    {

        $destination = Destination::where('id', $id)->first();
        $request->validate([
            'slug' => [
                'required',
                'alpha_dash',
                Rule::unique('destinations', 'slug')->ignore($id)
            ],
            'name_en' => ['required'],
            'name_ru' => ['required'],
            'name_ar' => ['required'],
            'description_en' => ['required'],
            'description_ru' => ['required'],
            'description_ar' => ['required'],
            'country' => ['required'],
            'visa_requirement_en' => ['required'],
            'visa_requirement_ru' => ['required'],
            'visa_requirement_ar' => ['required'],
            'language_en' => ['required'],
            'language_ru' => ['required'],
            'language_ar' => ['required'],
            'currency_en' => ['required'],
            'currency_ru' => ['required'],
            'currency_ar' => ['required'],
            'activities_en' => ['required'],
            'activities_ru' => ['required'],
            'activities_ar' => ['required'],
            'area_en' => ['required'],
            'area_ru' => ['required'],
            'area_ar' => ['required'],
            'timezone_en' => ['required'],
            'timezone_ru' => ['required'],
            'timezone_ar' => ['required'],
            'best_time_en' => ['required'],
            'best_time_ru' => ['required'],
            'best_time_ar' => ['required'],
            'health_safety_en' => ['required'],
            'health_safety_ru' => ['required'],
            'health_safety_ar' => ['required'],
            'map' => ['required'],
        ]);

        if ($request->hasFile('featured_photo')) {
            $request->validate([
                'featured_photo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
            ]);

            // Check if there is an existing featured photo before attempting to delete
            if (!empty($destination->featured_photo) && file_exists(public_path('uploads/' . $destination->featured_photo))) {
                unlink(public_path('uploads/' . $destination->featured_photo));
            }

            $final_name = 'destination_' . time() . '.' . $request->featured_photo->getClientOriginalExtension();
            $request->featured_photo->move(public_path('uploads'), $final_name);
            $destination->featured_photo = $final_name;
        }

        if ($request->hasFile('banner')) {
            $request->validate([
                'banner' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
            ]);

            // Check if there is an existing featured photo before attempting to delete
            if (!empty($destination->banner) && file_exists(public_path('uploads/' . $destination->banner))) {
                unlink(public_path('uploads/' . $destination->banner));
            }

            $final_name1 = 'destination_banner_' . time() . '.' . $request->banner->getClientOriginalExtension();
            $request->banner->move(public_path('uploads'), $final_name1);
            $destination->banner = $final_name1;
        }



        $destination->name_en = $request->name_en;
        $destination->name_ru = $request->name_ru;
        $destination->name_ar = $request->name_ar;
        $destination->slug = $request->slug;
        $destination->description_en = $request->description_en;
        $destination->description_ru = $request->description_ru;
        $destination->description_ar = $request->description_ar;
        $destination->country = $request->country;
        $destination->visa_requirement_en = $request->visa_requirement_en;
        $destination->visa_requirement_ru = $request->visa_requirement_ru;
        $destination->visa_requirement_ar = $request->visa_requirement_ar;
        $destination->language_en = $request->language_en;
        $destination->language_ru = $request->language_ru;
        $destination->language_ar = $request->language_ar;
        $destination->currency_en = $request->currency_en;
        $destination->currency_ru = $request->currency_ru;
        $destination->currency_ar = $request->currency_ar;
        $destination->activities_en = $request->activities_en;
        $destination->activities_ru = $request->activities_ru;
        $destination->activities_ar = $request->activities_ar;
        $destination->area_en = $request->area_en;
        $destination->area_ru = $request->area_ru;
        $destination->area_ar = $request->area_ar;
        $destination->timezone_en = $request->timezone_en;
        $destination->timezone_ru = $request->timezone_ru;
        $destination->timezone_ar = $request->timezone_ar;
        $destination->best_time_en = $request->best_time_en;
        $destination->best_time_ru = $request->best_time_ru;
        $destination->best_time_ar = $request->best_time_ar;
        $destination->health_safety_en = $request->health_safety_en;
        $destination->health_safety_ru = $request->health_safety_ru;
        $destination->health_safety_ar = $request->health_safety_ar;
        $destination->map = $request->map;
        $destination->save();

        return redirect()->route('admin_destination_index')->with('success', 'Destination is Updated successfuly');
    }

    public function delete($id)
    {
        $total = DestinationPhoto::where('destination_id', $id)->count();
        if ($total > 0) {
            return redirect()->route('admin_destination_index')->with('error', 'First Delete all Photos of This Destination');
        }

        $total1 = DestinationVideo::where('destination_id', $id)->count();
        if ($total1 > 0) {
            return redirect()->route('admin_destination_index')->with('error', 'First Delete all Videos of This Destination');
        }

        $destination = Destination::find($id);
        unlink(public_path('uploads/' . $destination->featured_photo));
        $destination->delete();
        return redirect()->route('admin_destination_index')->with('success', 'Destination Deleted successfuly');
    }



    public function destination_photos($id)
    {
        $destination = Destination::where('id', $id)->first();
        $destination_photos = DestinationPhoto::where('destination_id', $id)->get();
        return view('admin.destination.photos', compact('destination', 'destination_photos'));
    }

    public function destination_photo_submit(Request $request, $id)
    {
        $request->validate([
            'photo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
        ]);

        $final_name = 'destination_' . time() . '.' . $request->photo->getClientOriginalExtension();
        $request->photo->move(public_path('uploads'), $final_name);

        $obj = new DestinationPhoto();
        $obj->destination_id = $id;
        $obj->photo = $final_name;
        $obj->save();

        return redirect()->back()->with('success', 'Photo inserted successfuly');
    }

    public function destination_photo_delete($id)
    {

        $destination_photo = DestinationPhoto::find($id);
        unlink(public_path('uploads/' . $destination_photo->photo));
        $destination_photo->delete();
        return redirect()->back()->with('success', 'Photo id Deleted successfuly');
    }


    public function destination_videos($id)
    {
        $destination = Destination::where('id', $id)->first();
        $destination_videos = DestinationVideo::where('destination_id', $id)->get();
        return view('admin.destination.videos', compact('destination', 'destination_videos'));
    }

    public function destination_video_submit(Request $request, $id)
    {
        $request->validate([
            'video' => ['required'],
        ]);

        $obj = new DestinationVideo();
        $obj->destination_id = $id;
        $obj->video = $request->video;
        $obj->save();

        return redirect()->back()->with('success', 'video inserted successfuly');
    }

    public function destination_video_delete($id)
    {

        $destination_video = DestinationVideo::find($id);
        $destination_video->delete();
        return redirect()->back()->with('success', 'Video is Deleted successfuly');
    }


    public function destination_cities($id)
    {
        $destination = Destination::where('id', $id)->first();
        $destination_cities = City::where('destination_id', $id)->orderBy('city_en', 'asc')->get();
        return view('admin.destination.cities', compact('destination', 'destination_cities'));
    }

    public function destination_city_submit(Request $request, $id)
    {
        $request->validate([
            'city_en' => ['required'],
            'city_ru' => ['required'],
            'city_ar' => ['required'],
        ]);

        $obj = new City();
        $obj->destination_id = $id;
        $obj->city_en = $request->city_en;
        $obj->city_ru = $request->city_ru;
        $obj->city_ar = $request->city_ar;
        $obj->save();

        return redirect()->back()->with('success', 'City inserted successfuly');
    }

    public function city_edit($id)
    {
        $city = City::where('id', $id)->first();
        return view('admin.destination.city_edit', compact('city'));
    }

    public function destination_city_edit_submit(Request $request, $id)
    {
        $obj = City::where('id', $id)->first();
        $request->validate([
            'city_en' => ['required'],
            'city_ru' => ['required'],
            'city_ar' => ['required'],
        ]);

        $obj->city_en = $request->city_en;
        $obj->city_ru = $request->city_ru;
        $obj->city_ar = $request->city_ar;
        $obj->save();

        return redirect()->back()->with('success', 'City Updated successfuly');
    }

    public function destination_city_delete($id)
    {

        $destination_city = City::find($id);
        $destination_city->delete();
        return redirect()->back()->with('success', 'City is Deleted successfuly');
    }

    public function destination_day_tours($id)
    {
        $destination_day_tours = Tour::with('city')->where('destination_id', $id)->get();
        $destination = Destination::where('id', $id)->first();
        return view('admin.day_tour.index', compact('destination_day_tours', 'destination'));
    }

    public function destination_day_tour_create($id)
    {

        $destination = Destination::where('id', $id)->first();
        $cities = City::where('destination_id', $id)->get();
        return view('admin.day_tour.create', compact('cities', 'destination'));
    }

    public function destination_day_tour_create_submit(Request $request, $id)
    {
        $request->validate([
            'city_id' => ['required'],
            'title_en' => ['required'],
            'description_en' => ['required'],
            'title_ru' => ['required'],
            'description_ru' => ['required'],
            'title_ar' => ['required'],
            'description_ar' => ['required'],
            'title_local' => ['required'],
            'description_local' => ['required'],

        ]);

        $obj = new Tour();

        $obj->destination_id = $id;
        $obj->city_id = $request->city_id;
        $obj->title_en = $request->title_en;
        $obj->description_en = $request->description_en;
        $obj->title_ru = $request->title_ru;
        $obj->description_ru = $request->description_ru;
        $obj->title_ar = $request->title_ar;
        $obj->description_ar = $request->description_ar;
        $obj->title_local = $request->title_local;
        $obj->description_local = $request->description_local;

        $obj->save();

        return redirect()->back()->with('success', 'Destination Day Tour is Created successfuly');

    }


    public function destination_day_tour_edit($id)
    {

        $day_tour = Tour::with('destination')->where('id', $id)->first();
        $cities = City::where('destination_id', $day_tour->destination_id)->get();
        return view('admin.day_tour.edit', compact('cities', 'day_tour'));
    }

    public function destination_day_tour_edit_submit(Request $request, $id)
    {
        $obj = Tour::where('id', $id)->first();
        $request->validate([
            'city_id' => ['required'],
            'title_en' => ['required'],
            'description_en' => ['required'],
            'title_ru' => ['required'],
            'description_ru' => ['required'],
            'title_ar' => ['required'],
            'description_ar' => ['required'],
            'title_local' => ['required'],
            'description_local' => ['required'],

        ]);

        $obj->city_id = $request->city_id;
        $obj->title_en = $request->title_en;
        $obj->description_en = $request->description_en;
        $obj->title_ru = $request->title_ru;
        $obj->description_ru = $request->description_ru;
        $obj->title_ar = $request->title_ar;
        $obj->description_ar = $request->description_ar;
        $obj->title_local = $request->title_local;
        $obj->description_local = $request->description_local;

        $obj->save();

        return redirect()->back()->with('success', 'Destination Day Tour is Updated successfuly');

    }


    public function destination_day_tour_delete($id)
    {
        // $total = DestinationPhoto::where('destination_id', $id)->count();
        // if ($total > 0) {
        //     return redirect()->route('admin_destination_index')->with('error', 'First Delete all Photos of This Destination');
        // }

        // $total1 = DestinationVideo::where('destination_id', $id)->count();
        // if ($total1 > 0) {
        //     return redirect()->route('admin_destination_index')->with('error', 'First Delete all Videos of This Destination');
        // }

        $day_tour = Tour::find($id);
        $day_tour->delete();
        return redirect()->back()->with('success', 'Day_tour Deleted successfuly');
    }


    public function destination_tour_photos($id)
    {
        $day_tour = Tour::with('destination')->where('id', $id)->first();
        $day_tour_photos = TourPhoto::where('tour_id', $id)->get();
        return view('admin.day_tour.photos', compact('day_tour', 'day_tour_photos'));
    }

    public function destination_tour_photo_submit(Request $request, $id)
    {
        $request->validate([
            'photo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
        ]);

        $final_name = 'day_tour_' . time() . '.' . $request->photo->getClientOriginalExtension();
        $request->photo->move(public_path('uploads'), $final_name);

        $obj = new TourPhoto();
        $obj->tour_id = $id;
        $obj->photo = $final_name;
        $obj->save();

        return redirect()->back()->with('success', 'Photo inserted successfuly');
    }

    public function destination_tour_photo_delete($id)
    {

        $day_tour_photo = TourPhoto::find($id);
        unlink(public_path('uploads/' . $day_tour_photo->photo));
        $day_tour_photo->delete();
        return redirect()->back()->with('success', 'Photo id Deleted successfuly');
    }




}
