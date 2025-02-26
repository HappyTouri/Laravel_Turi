<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransportationType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminTransportationTypeController extends Controller
{
    public function index()
    {
        $transportation_types = TransportationType::get();
        return view('admin.transportation_type.index', compact('transportation_types'));
    }



    public function create_submit(Request $request)
    {
        $request->validate([
            'type' => ['required', 'unique:transportation_types'],

        ]);

        $transportation_type = new TransportationType();
        $transportation_type->type = $request->type;
        $transportation_type->save();

        return redirect()->route('admin_transportation_types_index')->with('success', 'Transportation Type is Created successfuly');

    }

    public function edit($id)
    {
        $transportation_type = TransportationType::find($id);
        return view('admin.transportation_type.edit', compact('transportation_type'));
    }

    public function edit_submit(Request $request, $id)
    {

        $transportation_type = TransportationType::where('id', $id)->first();
        $request->validate([
            'type' => [
                'required',
                Rule::unique('transportation_types')->ignore($id),
            ],
        ]);

        $transportation_type->type = $request->type;
        $transportation_type->save();

        return redirect()->route('admin_transportation_types_index')->with('success', 'transportation_type is Updated successfuly');
    }

    public function delete($id)
    {
        // $total = RoomCategory::where('transportation_type_id', $id)->count();
        // if ($total > 0) {
        //     return redirect()->route('admin_transportation_type_index')->with('error', 'transportation_type is Assigned to Packages, So it can not be deleted');
        // }

        $transportation_type = TransportationType::find($id);
        $transportation_type->delete();
        return redirect()->route('admin_transportation_types_index')->with('success', 'Room Category is Deleted successfuly');
    }
}
