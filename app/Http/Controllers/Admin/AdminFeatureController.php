<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;

class AdminFeatureController extends Controller
{
    public function index()
    {
        $features = Feature::get();
        return view('admin.feature.index', compact('features'));
    }

    public function create()
    {
        return view('admin.feature.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'icon' => ['required'],
            'heading' => ['required'],
            'description' => ['required'],
        ]);

        $feature = new Feature();
        $feature->heading = $request->heading;
        $feature->description = $request->description;
        $feature->icon = $request->icon;
        $feature->save();

        return redirect()->route('admin_feature_index')->with('success', 'feature is Created successfuly');

    }

    public function edit($id)
    {
        $feature = Feature::find($id);
        return view('admin.feature.edit', compact('feature'));
    }

    public function edit_submit(Request $request, $id)
    {

        $feature = Feature::where('id', $id)->first();
        $request->validate([
            'heading' => ['required'],
            'description' => ['required'],
            'icon' => ['required'],
        ]);

        $feature->heading = $request->heading;
        $feature->description = $request->description;
        $feature->icon = $request->icon;
        $feature->save();

        return redirect()->route('admin_feature_index')->with('success', 'feature is Updated successfuly');
    }

    public function delete($id)
    {
        $feature = feature::find($id);
        $feature->delete();
        return redirect()->route('admin_feature_index')->with('success', 'feature is Deleted successfuly');
    }


}
