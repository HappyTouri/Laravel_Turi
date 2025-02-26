<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeItem;
use Illuminate\Http\Request;

class AdminHomeItemController extends Controller
{
    public function index()
    {
        $home_item = HomeItem::where('id', 1)->first();
        return view('admin.home_item.index', compact('home_item'));
    }

    public function update(Request $request)
    {
        $request->validate([
            // Travel icons
            'travel_icon_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'travel_icon_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'travel_icon_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            // Explore section
            'explore_title_en' => 'required|string|max:255',
            'explore_title_ru' => 'required|string|max:255',
            'explore_title_ar' => 'required|string|max:255',
            'explore_description_en' => 'required|string',
            'explore_description_ru' => 'required|string',
            'explore_description_ar' => 'required|string',
            'explore_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'explore_video' => 'nullable|string|max:255',

            // Choose section
            'choose_title_en' => 'required|string|max:255',
            'choose_title_ru' => 'required|string|max:255',
            'choose_title_ar' => 'required|string|max:255',
            'choose_description_en' => 'required|string',
            'choose_description_ru' => 'required|string',
            'choose_description_ar' => 'required|string',
            'choose_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'choose_icon_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'choose_icon_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'choose_icon_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            // Help section
            'help_title_en' => 'required|string|max:255',
            'help_title_ru' => 'required|string|max:255',
            'help_title_ar' => 'required|string|max:255',
            'help_description_en' => 'required|string',
            'help_description_ru' => 'required|string',
            'help_description_ar' => 'required|string',
            'testimonial_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Fetch the specific record
        $homeItem = HomeItem::findOrFail(1);

        // Define an array of image fields to handle
        $imageFields = [
            'travel_icon_1',
            'travel_icon_2',
            'travel_icon_3',
            'explore_photo',
            'choose_photo',
            'choose_icon_1',
            'choose_icon_2',
            'choose_icon_3',
            'testimonial_photo'
        ];

        // Handle file uploads
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                // Unlink the old image if it exists
                if (!empty($homeItem->$field) && file_exists(public_path('uploads/' . $homeItem->$field))) {
                    unlink(public_path('uploads/' . $homeItem->$field));
                }

                // Add a timestamp to the uploaded file name
                $file = $request->file($field);
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);

                // Update the field with the new file name
                $homeItem->$field = $filename;
            }
        }

        // List all valid database columns (whitelist approach)
        $validColumns = [
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
            'explore_video',
            'explore_title_en',
            'explore_title_ru',
            'explore_title_ar',
            'explore_description_en',
            'explore_description_ru',
            'explore_description_ar',
            'choose_title_en',
            'choose_title_ru',
            'choose_title_ar',
            'choose_description_en',
            'choose_description_ru',
            'choose_description_ar',
            'choose_title_1_en',
            'choose_title_1_ru',
            'choose_title_1_ar',
            'choose_description_1_en',
            'choose_description_1_ru',
            'choose_description_1_ar',
            'choose_title_2_en',
            'choose_title_2_ru',
            'choose_title_2_ar',
            'choose_description_2_en',
            'choose_description_2_ru',
            'choose_description_2_ar',
            'choose_title_3_en',
            'choose_title_3_ru',
            'choose_title_3_ar',
            'choose_description_3_en',
            'choose_description_3_ru',
            'choose_description_3_ar',
            'help_title_en',
            'help_title_ru',
            'help_title_ar',
            'help_description_en',
            'help_description_ru',
            'help_description_ar',
        ];

        // Dynamically update text fields
        foreach ($validColumns as $key) {
            if ($request->has($key)) {
                $homeItem->$key = $request->input($key);
            }
        }

        $homeItem->save();

        // Return a response or redirect
        return redirect()->back()->with('success', 'Home Items Updated successfuly');
    }

}
