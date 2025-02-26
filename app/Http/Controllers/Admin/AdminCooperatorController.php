<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\Cooperator;
use App\Models\Destination;
use App\Models\Driver;
use App\Models\Rule;
use Illuminate\Validation\Rule as ValidationRule;
use App\Models\Tourguide;
use Illuminate\Http\Request;



class AdminCooperatorController extends Controller
{
    public function cooperators()
    {

        $cooperators = Cooperator::with('rule', 'destination', 'accommodation', 'driver', 'tourguide')->get();
        return view('admin.cooperator.cooperators', compact('cooperators'));
    }

    public function cooperator_create()
    {
        $rules = Rule::all();
        $accommodations = Accommodation::all();
        $tourguides = Tourguide::all();
        $drivers = Driver::all();
        $destinations = Destination::all();
        return view('admin.cooperator.cooperator_create', compact(
            'rules',
            'accommodations',
            'tourguides',
            'drivers',
            'destinations'
        ));
    }

    public function cooperator_create_submit(Request $request)
    {

        $request->validate([
            'name' => ['required'],
            'slug' => ['required', 'alpha_dash', 'unique:cooperators,slug'],
            'email' => ['required', 'email', 'unique:cooperators,email'],
            'phone' => ['required'],
            'country' => ['required'],
            'address' => ['required'],
            'city' => ['required'],
            'password' => ['required'],
            'photo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:2024'],
            'logo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:2024'],
        ]);

        $final_name = 'cooperator_photo' . time() . '.' . $request->photo->getClientOriginalExtension();
        $request->photo->move(public_path('uploads'), $final_name);

        $final_name1 = 'cooperator_logo' . time() . '.' . $request->photo->getClientOriginalExtension();
        $request->logo->move(public_path('uploads'), $final_name1);

        $user = new Cooperator();
        $user->name = $request->name;
        $user->slug = $request->slug;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->facebook = $request->facebook;
        $user->instagram = $request->instagram;
        $user->youtube = $request->youtube;
        $user->linkedin = $request->linkedin;
        $user->twitter = $request->twitter;
        $user->photo = $final_name;
        $user->logo = $final_name1;
        $user->password = bcrypt($request->password);
        $user->rule_id = $request->rule_id;
        $user->accommodation_id = $request->accommodation_id || null;
        $user->tourguide_id = $request->tourguide_id || null;
        $user->driver_id = $request->driver_id || null;
        $user->destination_id = $request->destination_id || null;

        $user->save();

        return redirect()->route('admin_cooperators')->with('success', 'Cooperator is Created successfuly!');
    }


    public function cooperator_edit($id)
    {
        $cooperator = Cooperator::where('id', $id)->first();
        $rules = Rule::all();
        $accommodations = Accommodation::all();
        $tourguides = Tourguide::all();
        $drivers = Driver::all();
        $destinations = Destination::all();
        return view('admin.cooperator.cooperator_edit', compact(
            'cooperator',
            'rules',
            'accommodations',
            'tourguides',
            'drivers',
            'destinations'
        ));
    }

    public function cooperator_edit_submit(Request $request, $id)
    {
        $cooperator = Cooperator::where('id', $id)->first();
        $request->validate([
            'name' => ['required'],
            'slug' => [
                'required',
                'alpha_dash',
                ValidationRule::unique('cooperators', 'slug')->ignore($id),
            ],
            'email' => ['required', 'email', 'unique:cooperators,email,' . $cooperator->id],
            'phone' => ['required'],
            'country' => ['required'],
            'address' => ['required'],

            'city' => ['required'],

            // 'photo' => ['mimes:jpg,jpeg,png,gif', 'max:2024'],
        ]);

        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => ['mimes:jpg,jpeg,png,gif', 'max:2024'],
            ]);

            if ($cooperator->photo != '') {
                unlink(public_path('uploads/' . $cooperator->photo));
            }
            $final_name = 'cooperator_photo' . time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('uploads'), $final_name);
            $cooperator->photo = $final_name;
        }

        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => ['mimes:jpg,jpeg,png,gif', 'max:2024'],
            ]);

            if ($cooperator->logo != '') {
                unlink(public_path('uploads/' . $cooperator->logo));
            }
            $final_name1 = 'cooperator_logo' . time() . '.' . $request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('uploads'), $final_name1);
            $cooperator->logo = $final_name1;
        }

        if ($request->password) {
            $request->validate([
                'password' => ['required', 'min:6'],
            ]);
            $cooperator->password = bcrypt($request->password);
        }

        $cooperator->name = $request->name;
        $cooperator->slug = $request->slug;
        $cooperator->email = $request->email;
        $cooperator->phone = $request->phone;
        $cooperator->country = $request->country;
        $cooperator->address = $request->address;
        $cooperator->city = $request->city;
        $cooperator->facebook = $request->facebook;
        $cooperator->instagram = $request->instagram;
        $cooperator->youtube = $request->youtube;
        $cooperator->linkedin = $request->linkedin;
        $cooperator->twitter = $request->twitter;
        $cooperator->rule_id = $request->rule_id;
        $cooperator->accommodation_id = $request->accommodation_id || null;
        $cooperator->tourguide_id = $request->tourguide_id || null;
        $cooperator->driver_id = $request->driver_id || null;
        $cooperator->destination_id = $request->destination_id || null;
        $cooperator->save();

        return redirect()->back()->with('success', 'cooperator is Updated successfuly!');


    }



    public function cooperator_delete($id)
    {
        // $total = Review::where('user_id', $id)->count();
        // if ($total > 0) {
        //     return redirect()->back()->with('error', 'User can not be Deleted, because it has some Reviews');
        // }





        $user = Cooperator::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'Cooberator is Deleted successfuly');
    }
}
