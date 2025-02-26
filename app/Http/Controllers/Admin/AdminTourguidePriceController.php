<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\TourguidePrice;
use App\Models\TourTitle;
use Illuminate\Http\Request;

class AdminTourguidePriceController extends Controller
{
    public function index()
    {
        $tourguide_prices = TourguidePrice::with('destination')->get();
        $destinations = Destination::all();
        return view('admin.tourguide_price.index', compact('tourguide_prices', 'destinations'));
    }


    public function create_submit(Request $request)
    {
        $request->validate([
            'destination_id' => ['required', 'unique:tourguide_prices'],
            'price' => ['required'],
        ]);

        $tourguide_price = new TourguidePrice();
        $tourguide_price->destination_id = $request->destination_id;
        $tourguide_price->price = $request->price;
        $tourguide_price->save();

        return redirect()->route('admin_tourguide_prices_index')->with('success', 'Tourguide Price is Created successfuly');

    }

    public function edit($id)
    {
        $tourguide_price = TourguidePrice::with('destination')->find($id);
        return view('admin.tourguide_price.edit', compact('tourguide_price'));
    }

    public function edit_submit(Request $request, $id)
    {

        $tourguide_price = TourguidePrice::where('id', $id)->first();
        $request->validate([
            'price' => ['required'],

        ]);
        $tourguide_price->price = $request->price;
        $tourguide_price->save();
        return redirect()->route('admin_tourguide_prices_index')->with('success', 'tourguide_price is Updated successfuly');
    }

    public function delete($id)
    {
        // $total = PackageTitl::where('tourguide_price_id', $id)->count();
        // if ($total > 0) {
        //     return redirect()->route('admin_tourguide_price_index')->with('error', 'tourguide_price is Assigned to Packages, So it can not be deleted');
        // }

        $tourguide_price = TourguidePrice::find($id);
        $tourguide_price->delete();
        return redirect()->route('admin_tourguide_prices_index')->with('success', 'Tour Title is Deleted successfuly');
    }
}
