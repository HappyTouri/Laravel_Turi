<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Destination;
use App\Models\Tourguide;
use Illuminate\Http\Request;

class AdminTourguideController extends Controller
{
    public function index($id)
    {
        $destination = Destination::where('id', $id)->first();
        $tourguides = Tourguide::with('city')->get();

        return view('admin.tourguide.index', compact('tourguides', 'destination'));
    }

    public function create($id)
    {
        $destination = Destination::where('id', $id)->first();
        $cities = City::where('destination_id', $id)->get();

        return view('admin.tourguide.create', compact('destination', 'cities'));
    }

    public function create_submit(Request $request, $id)
    {
        $request->validate([
            'name' => ['required'],
            'mobile' => ['required'],
            'city_id' => ['required'],
            'email' => ['required'],
            'price_per_day' => ['required'],
            'note' => ['required'],
            'status' => ['required'],
            'date_of_birth' => ['required'],
            'photo' => [
                'required',    // Field is required
                'mimes:jpg,jpeg,png,gif', // Only allow certain file types
                'max:4300'     // Maximum file size of 4.3 MB
            ],

        ]);

        $final_name = 'tourguide_Photo' . time() . '.' . $request->photo->getClientOriginalExtension();
        $request->photo->move(public_path('uploads'), $final_name);


        $tourguide = new tourguide();
        $tourguide->photo = $final_name;

        $tourguide->destination_id = $id;
        $tourguide->city_id = $request->city_id;
        $tourguide->mobile = $request->mobile;
        $tourguide->name = $request->name;
        $tourguide->email = $request->email;
        $tourguide->price_per_day = $request->price_per_day;
        $tourguide->date_of_birth = $request->date_of_birth;
        $tourguide->note = $request->note;
        $tourguide->status = $request->status;
        $tourguide->save();

        return redirect()->route('admin_tourguide_index', $id)->with('success', 'Tourguide is Added successfuly');

    }

    public function edit($id)
    {
        $tourguide = tourguide::with('city')->find($id);
        $destination = Destination::where('id', $id)->first();
        $cities = City::where('destination_id', $id)->get();

        return view('admin.tourguide.edit', compact(
            'tourguide',
            'destination',
            'cities',
        ));
    }

    public function edit_submit(Request $request, $id)
    {

        $tourguide = tourguide::with('destination')->where('id', $id)->first();
        $request->validate([
            'name' => ['required'],
            'mobile' => ['required'],
            'city_id' => ['required'],
            'email' => ['required'],
            'price_per_day' => ['required'],
            'note' => ['required'],
            'status' => ['required'],
            'date_of_birth' => ['required'],
        ]);

        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => [
                    'required',    // Field is required
                    'mimes:jpg,jpeg,png,gif', // Only allow certain file types
                    'max:4300'     // Maximum file size of 4.3 MB
                ],
            ]);
            unlink(public_path('uploads/' . $tourguide->photo));
            $final_name = 'tourguide_Photo_' . time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('uploads'), $final_name);
            $tourguide->photo = $final_name;
        }



        $tourguide->destination_id = $id;
        $tourguide->city_id = $request->city_id;
        $tourguide->mobile = $request->mobile;
        $tourguide->name = $request->name;
        $tourguide->email = $request->email;
        $tourguide->price_per_day = $request->price_per_day;
        $tourguide->date_of_birth = $request->date_of_birth;
        $tourguide->note = $request->note;
        $tourguide->status = $request->status;
        $tourguide->save();


        return redirect()->route('admin_tourguide_index', $tourguide->destination->id)->with('success', 'Tourguide is Updated successfuly');
    }

    public function delete($id)
    {
        // $total = photo::where('tourguide_id', $id)->count();
        // if ($total > 0) {
        //     return redirect()->route('admin_tourguide_index')->with('error', 'First Delete all Photos of This tourguide');
        // }

        // $total1 = tourguideVideo::where('tourguide_id', $id)->count();
        // if ($total1 > 0) {
        //     return redirect()->route('admin_tourguide_index')->with('error', 'First Delete all Videos of This tourguide');
        // }

        // $total3 = tourguideAmenity::where('tourguide_id', $id)->count();
        // if ($total3 > 0) {
        //     return redirect()->route('admin_tourguide_index')->with('error', 'First Delete all Amenities of This tourguide');
        // }
        // $total4 = tourguideItinerary::where('tourguide_id', $id)->count();
        // if ($total4 > 0) {
        //     return redirect()->route('admin_tourguide_index')->with('error', 'First Delete all Itinerary of This tourguide');
        // }
        // $total5 = tourguideFaq::where('tourguide_id', $id)->count();
        // if ($total5 > 0) {
        //     return redirect()->route('admin_tourguide_index')->with('error', 'First Delete all FAQs of This tourguide');
        // }
        // $total6 = tourguideTour::where('tourguide_id', $id)->count();
        // if ($total6 > 0) {
        //     return redirect()->route('admin_tourguide_index')->with('error', 'First Delete all Tours of This tourguide');
        // }

        $tourguide = tourguide::find($id);
        unlink(public_path('uploads/' . $tourguide->photo));
        $tourguide->delete();
        return redirect()->back()->with('success', 'tourguide Deleted successfuly');
    }

}
