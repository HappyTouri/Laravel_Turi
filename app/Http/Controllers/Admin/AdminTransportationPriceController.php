<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\TransportationPrice;
use App\Models\TransportationType;
use Illuminate\Http\Request;

class AdminTransportationPriceController extends Controller
{
    public function index($id)
    {
        $destination = Destination::where('id', $id)->first();
        $transportation_types = TransportationType::orderBy('type', 'asc')->get();
        $transportation_Prices = TransportationPrice::with('destination', 'transportationType')
            ->where('destination_id', $id)
            ->orderBy('price', 'asc')
            ->get();
        return view('admin.transportation_price.index', compact(
            'transportation_types',
            'transportation_Prices',
            'destination'

        ));
    }

    public function create_submit(Request $request, $id)
    {
        $total = TransportationPrice::where('destination_id', $id)->where('type_id', $request->type_id)->count();
        if ($total > 0) {
            return redirect()->back()->with('error', 'This Transportation Type is Already Inserted');
        }

        $request->validate([
            'type_id' => ['required'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);
        $obj = new TransportationPrice();
        $obj->destination_id = $id;
        $obj->type_id = $request->type_id;
        $obj->price = $request->price;
        $obj->save();

        return redirect()->back()->with('success', 'Transportation Price inserted successfuly');
    }

    public function edit($id)
    {
        $transportation_price = TransportationPrice::with('destination', 'transportationType')->find($id);
        return view('admin.transportation_price.edit', compact('transportation_price'));
    }

    public function edit_submit(Request $request, $id)
    {
        $transportation_Prices = TransportationPrice::where('id', $id)->first();
        $request->validate([
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        $transportation_Prices->price = $request->price;
        $transportation_Prices->save();

        return redirect()->back()->with('success', 'Transportation Price Updated successfuly');

    }

    public function delete($id)
    {
        $transportation_Prices = TransportationPrice::find($id);
        $transportation_Prices->delete();
        return redirect()->back()->with('success', 'Transportation Price is Deleted successfuly');
    }






}
