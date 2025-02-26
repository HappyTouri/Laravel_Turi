<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Destination;
use App\Models\Driver;
use App\Models\DriverCarPhoto;
use App\Models\TransportationPrice;
use Illuminate\Http\Request;

class AdminDriverController extends Controller
{
    public function index($id)
    {
        $destination = Destination::where('id', $id)->first();
        $drivers = Driver::with('transportationType', 'city', 'driverCarPhotos')->get();

        return view('admin.driver.index', compact('drivers', 'destination'));
    }

    public function create($id)
    {
        $destination = Destination::where('id', $id)->first();
        $cities = City::where('destination_id', $id)->get();
        $transportation_types = TransportationPrice::with('transportationType')
            ->where('destination_id', $id)->get();
        return view('admin.driver.create', compact('destination', 'cities', 'transportation_types'));
    }

    public function create_submit(Request $request, $id)
    {
        $request->validate([
            'name' => ['required'],
            'phone' => ['required'],
            'city_id' => ['required'],
            'trabsportationType_id' => ['required'],
            'carModel' => ['required'],
            'numberOfSeats' => ['required'],
            'note' => ['required'],
            'pricePerDay' => ['required'],
            'rate' => ['required'],
            'driverPhoto' => [
                'required',    // Field is required
                'mimes:jpg,jpeg,png,gif', // Only allow certain file types
                'max:4300'     // Maximum file size of 4.3 MB
            ],

        ]);

        $final_name = 'Driver_Photo' . time() . '.' . $request->driverPhoto->getClientOriginalExtension();
        $request->driverPhoto->move(public_path('uploads'), $final_name);


        $driver = new Driver();
        $driver->driverPhoto = $final_name;

        $driver->destination_id = $id;
        $driver->city_id = $request->city_id;
        $driver->phone = $request->phone;
        $driver->name = $request->name;
        $driver->trabsportationType_id = $request->trabsportationType_id;
        $driver->carModel = $request->carModel;
        $driver->numberOfSeats = $request->numberOfSeats;
        $driver->note = $request->note;
        $driver->pricePerDay = $request->pricePerDay;
        $driver->rate = $request->rate;
        $driver->save();

        return redirect()->route('admin_driver_index', $id)->with('success', 'Driver is Added successfuly');

    }

    public function edit($id)
    {
        $driver = Driver::with('city', 'transportationType')->find($id);
        $destination = Destination::where('id', $driver->destination_id)->first();

        $cities = City::where('destination_id', $id)->get();
        $transportation_types = TransportationPrice::with('transportationType')
            ->where('destination_id', $id)->get();
        return view('admin.driver.edit', compact(
            'driver',
            'destination',
            'cities',
            'transportation_types'
        ));
    }

    public function edit_submit(Request $request, $id)
    {

        $driver = Driver::with('destination')->where('id', $id)->first();
        $request->validate([
            'name' => ['required'],
            'phone' => ['required'],
            'city_id' => ['required'],
            'trabsportationType_id' => ['required'],
            'carModel' => ['required'],
            'numberOfSeats' => ['required'],
            'note' => ['required'],
            'pricePerDay' => ['required'],
            'rate' => ['required'],
        ]);

        if ($request->hasFile('driverPhoto')) {
            $request->validate([
                'driverPhoto' => [
                    'required',    // Field is required
                    'mimes:jpg,jpeg,png,gif', // Only allow certain file types
                    'max:4300'     // Maximum file size of 4.3 MB
                ],
            ]);
            unlink(public_path('uploads/' . $driver->driverPhoto));
            $final_name = 'driver_Photo_' . time() . '.' . $request->driverPhoto->getClientOriginalExtension();
            $request->driverPhoto->move(public_path('uploads'), $final_name);
            $driver->driverPhoto = $final_name;
        }



        $driver->city_id = $request->city_id;
        $driver->phone = $request->phone;
        $driver->name = $request->name;
        $driver->trabsportationType_id = $request->trabsportationType_id;
        $driver->carModel = $request->carModel;
        $driver->numberOfSeats = $request->numberOfSeats;
        $driver->note = $request->note;
        $driver->pricePerDay = $request->pricePerDay;
        $driver->rate = $request->rate;
        $driver->save();


        return redirect()->route('admin_driver_index', $driver->destination->id)->with('success', 'Driver is Updated successfuly');
    }

    public function delete($id)
    {
        // $total = driverPhoto::where('driver_id', $id)->count();
        // if ($total > 0) {
        //     return redirect()->route('admin_driver_index')->with('error', 'First Delete all Photos of This driver');
        // }

        // $total1 = driverVideo::where('driver_id', $id)->count();
        // if ($total1 > 0) {
        //     return redirect()->route('admin_driver_index')->with('error', 'First Delete all Videos of This driver');
        // }

        // $total3 = driverAmenity::where('driver_id', $id)->count();
        // if ($total3 > 0) {
        //     return redirect()->route('admin_driver_index')->with('error', 'First Delete all Amenities of This driver');
        // }
        // $total4 = driverItinerary::where('driver_id', $id)->count();
        // if ($total4 > 0) {
        //     return redirect()->route('admin_driver_index')->with('error', 'First Delete all Itinerary of This driver');
        // }
        // $total5 = driverFaq::where('driver_id', $id)->count();
        // if ($total5 > 0) {
        //     return redirect()->route('admin_driver_index')->with('error', 'First Delete all FAQs of This driver');
        // }
        // $total6 = driverTour::where('driver_id', $id)->count();
        // if ($total6 > 0) {
        //     return redirect()->route('admin_driver_index')->with('error', 'First Delete all Tours of This driver');
        // }

        $driver = Driver::find($id);
        unlink(public_path('uploads/' . $driver->driverPhoto));
        $driver->delete();
        return redirect()->back()->with('success', 'Driver Deleted successfuly');
    }



    public function car_photos($id)
    {
        $driver = Driver::with('destination')->where('id', $id)->first();
        $driver_car_photos = DriverCarPhoto::where('driver_id', $id)->get();
        return view('admin.driver.photos', compact('driver', 'driver_car_photos'));
    }

    public function car_photo_submit(Request $request, $id)
    {
        $request->validate([
            'car_photo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
        ]);

        $final_name = 'driver_car_photo_' . time() . '.' . $request->car_photo->getClientOriginalExtension();
        $request->car_photo->move(public_path('uploads'), $final_name);

        $obj = new DriverCarPhoto();
        $obj->driver_id = $id;
        $obj->car_photo = $final_name;
        $obj->save();

        return redirect()->back()->with('success', 'Transportation Photo inserted successfuly');
    }

    public function car_photo_delete($id)
    {

        $driver_car_photo = DriverCarPhoto::find($id);
        unlink(public_path('uploads/' . $driver_car_photo->car_photo));
        $driver_car_photo->delete();
        return redirect()->back()->with('success', 'Transportation Photo is Deleted successfuly');
    }

}
