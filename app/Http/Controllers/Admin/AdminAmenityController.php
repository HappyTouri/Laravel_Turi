<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Amenity;
use App\Models\PackageAmenity;
use Illuminate\Validation\Rule;

class AdminAmenityController extends Controller
{
    public function index()
    {
        $amenities = Amenity::get();
        return view('admin.amenity.index', compact('amenities'));
    }

    public function create()
    {
        return view('admin.amenity.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'name_en' => ['required', 'unique:amenities'],
            'name_ru' => ['required', 'unique:amenities'],
            'name_ar' => ['required', 'unique:amenities'],

        ]);

        $amenity = new Amenity();
        $amenity->name_en = $request->name_en;
        $amenity->name_ru = $request->name_ru;
        $amenity->name_ar = $request->name_ar;
        $amenity->save();

        return redirect()->route('admin_amenity_index')->with('success', 'Amenity is Created successfuly');

    }

    public function edit($id)
    {
        $amenity = Amenity::find($id);
        return view('admin.amenity.edit', compact('amenity'));
    }

    public function edit_submit(Request $request, $id)
    {

        $amenity = Amenity::where('id', $id)->first();
        $request->validate([
            'name_en' => [
                'required',
                Rule::unique('amenities')->ignore($id),
            ],
            'name_ru' => [
                'required',
                Rule::unique('amenities')->ignore($id),
            ],
            'name_ar' => [
                'required',
                Rule::unique('amenities')->ignore($id),
            ],
        ]);

        $amenity->name_en = $request->name_en;
        $amenity->name_ru = $request->name_ru;
        $amenity->name_ar = $request->name_ar;
        $amenity->save();

        return redirect()->route('admin_amenity_index')->with('success', 'Amenity is Updated successfuly');
    }

    public function delete($id)
    {
        $total = PackageAmenity::where('amenity_id', $id)->count();
        if ($total > 0) {
            return redirect()->route('admin_amenity_index')->with('error', 'Amenity is Assigned to Packages, So it can not be deleted');
        }

        $amenity = Amenity::find($id);
        $amenity->delete();
        return redirect()->route('admin_amenity_index')->with('success', 'Amenity is Deleted successfuly');
    }



}
