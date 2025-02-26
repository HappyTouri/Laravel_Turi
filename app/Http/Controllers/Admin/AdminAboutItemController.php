<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutItem;
use Illuminate\Http\Request;

class AdminAboutItemController extends Controller
{
    public function index()
    {
        $about_item = AboutItem::where('id', 1)->first();
        return view('admin.about_item.index', compact('about_item'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'top_title_en' => 'required|string|max:255',
            'top_title_ru' => 'required|string|max:255',
            'top_title_ar' => 'required|string|max:255',
            'top_description_en' => 'required|string',
            'top_description_ru' => 'required|string',
            'top_description_ar' => 'required|string',
            'top_logo_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'top_logo_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo1_title_en' => 'required|string|max:255',
            'logo1_title_ru' => 'required|string|max:255',
            'logo1_title_ar' => 'required|string|max:255',
            'logo2_title_en' => 'required|string|max:255',
            'logo2_title_ru' => 'required|string|max:255',
            'logo2_title_ar' => 'required|string|max:255',
            'point_1_en' => 'required|string|max:255',
            'point_1_ru' => 'required|string|max:255',
            'point_1_ar' => 'required|string|max:255',
            'point_2_en' => 'required|string|max:255',
            'point_2_ru' => 'required|string|max:255',
            'point_2_ar' => 'required|string|max:255',
            'point_3_en' => 'required|string|max:255',
            'point_3_ru' => 'required|string|max:255',
            'point_3_ar' => 'required|string|max:255',
            'mission_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'mission_description_en' => 'required|string',
            'mission_description_ru' => 'required|string',
            'mission_description_ar' => 'required|string',
            'destination_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'destination_description_en' => 'required|string',
            'destination_description_ru' => 'required|string',
            'destination_description_ar' => 'required|string',
            'planning_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'planning_description_en' => 'required|string',
            'planning_description_ru' => 'required|string',
            'planning_description_ar' => 'required|string',
            'main_title_en' => 'required|string|max:255',
            'main_title_ru' => 'required|string|max:255',
            'main_title_ar' => 'required|string|max:255',
            'main_description_en' => 'required|string',
            'main_description_ru' => 'required|string',
            'main_description_ar' => 'required|string',
            'title_1_en' => 'required|string|max:255',
            'title_1_ru' => 'required|string|max:255',
            'title_1_ar' => 'required|string|max:255',
            'description_1_en' => 'required|string',
            'description_1_ru' => 'required|string',
            'description_1_ar' => 'required|string',
            'title_2_en' => 'required|string|max:255',
            'title_2_ru' => 'required|string|max:255',
            'title_2_ar' => 'required|string|max:255',
            'description_2_en' => 'required|string',
            'description_2_ru' => 'required|string',
            'description_2_ar' => 'required|string',
            'title_3_en' => 'required|string|max:255',
            'title_3_ru' => 'required|string|max:255',
            'title_3_ar' => 'required|string|max:255',
            'description_3_en' => 'required|string',
            'description_3_ru' => 'required|string',
            'description_3_ar' => 'required|string',
            'title_4_en' => 'required|string|max:255',
            'title_4_ru' => 'required|string|max:255',
            'title_4_ar' => 'required|string|max:255',
            'description_4_en' => 'required|string',
            'description_4_ru' => 'required|string',
            'description_4_ar' => 'required|string',
        ]);

        // Fetch the specific record
        $aboutItem = AboutItem::findOrFail(1);

        // Define an array of image fields to handle
        $imageFields = ['image_1', 'image_2', 'top_logo_1', 'top_logo_2', 'mission_logo', 'destination_logo', 'planning_logo'];

        // Handle file uploads
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                // Unlink the old image if it exists
                if (!empty($aboutItem->$field) && file_exists(public_path('uploads/' . $aboutItem->$field))) {
                    unlink(public_path('uploads/' . $aboutItem->$field));
                }

                // Add a timestamp to the uploaded file name
                $file = $request->file($field);
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);

                // Update the field with the new file name
                $aboutItem->$field = $filename;
            }
        }

        // List all valid database columns (whitelist approach)
        $validColumns = [
            'top_title_en',
            'top_title_ru',
            'top_title_ar',
            'top_description_en',
            'top_description_ru',
            'top_description_ar',
            'logo1_title_en',
            'logo1_title_ru',
            'logo1_title_ar',
            'logo2_title_en',
            'logo2_title_ru',
            'logo2_title_ar',
            'point_1_en',
            'point_1_ru',
            'point_1_ar',
            'point_2_en',
            'point_2_ru',
            'point_2_ar',
            'point_3_en',
            'point_3_ru',
            'point_3_ar',
            'mission_description_en',
            'mission_description_ru',
            'mission_description_ar',
            'destination_description_en',
            'destination_description_ru',
            'destination_description_ar',
            'planning_description_en',
            'planning_description_ru',
            'planning_description_ar',
            'main_title_en',
            'main_title_ru',
            'main_title_ar',
            'main_description_en',
            'main_description_ru',
            'main_description_ar',
            'title_1_en',
            'title_1_ru',
            'title_1_ar',
            'description_1_en',
            'description_1_ru',
            'description_1_ar',
            'title_2_en',
            'title_2_ru',
            'title_2_ar',
            'description_2_en',
            'description_2_ru',
            'description_2_ar',
            'title_3_en',
            'title_3_ru',
            'title_3_ar',
            'description_3_en',
            'description_3_ru',
            'description_3_ar',
            'title_4_en',
            'title_4_ru',
            'title_4_ar',
            'description_4_en',
            'description_4_ru',
            'description_4_ar',
        ];

        // Dynamically update text fields
        foreach ($validColumns as $key) {
            if ($request->has($key)) {
                $aboutItem->$key = $request->input($key);
            }
        }

        $aboutItem->save();

        // Return a response or redirect
        return redirect()->route('admin_about_item_index')->with('success', 'Record updated successfully.');
    }
}
