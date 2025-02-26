<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourTitle;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminTourTitleController extends Controller
{
    public function index()
    {
        $tour_titles = TourTitle::get();
        return view('admin.tour_title.index', compact('tour_titles'));
    }


    public function create_submit(Request $request)
    {
        $request->validate([
            'title_en' => ['required', 'unique:package_titles'],
            'title_ru' => ['required', 'unique:package_titles'],
            'title_ar' => ['required', 'unique:package_titles'],
            'photo' => [
                'required',    // Field is required
                'max:4300'     // Maximum file size of 4.3 MB
            ],

        ]);



        $final_name = 'tour_title_photo_' . time() . '.' . $request->photo->getClientOriginalExtension();
        $request->photo->move(public_path('uploads'), $final_name);

        $tour_title = new TourTitle();
        $tour_title->title_en = $request->title_en;
        $tour_title->title_ru = $request->title_ru;
        $tour_title->title_ar = $request->title_ar;
        $tour_title->photo = $final_name;
        $tour_title->save();

        return redirect()->route('admin_tour_titles_index')->with('success', 'Tour_Title is Created successfuly');

    }

    public function edit($id)
    {
        $tour_title = TourTitle::find($id);
        return view('admin.tour_title.edit', compact('tour_title'));
    }

    public function edit_submit(Request $request, $id)
    {

        $tour_title = TourTitle::where('id', $id)->first();
        $request->validate([
            'title_en' => ['required', Rule::unique('tour_titles')->ignore($tour_title->id)],
            'title_ru' => ['required', Rule::unique('tour_titles')->ignore($tour_title->id)],
            'title_ar' => ['required', Rule::unique('tour_titles')->ignore($tour_title->id)],
        ]);

        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => ['required', 'max:4300'],
            ]);

            // Check if the current photo exists before unlinking
            if (!empty($tour_title->photo) && file_exists(public_path('uploads/' . $tour_title->photo))) {
                unlink(public_path('uploads/' . $tour_title->photo));
            }

            // Upload the new photo
            $final_name = 'tour_title_photo_' . time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('uploads'), $final_name);
            $tour_title->photo = $final_name;
        }


        $tour_title->title_en = $request->title_en;
        $tour_title->title_ru = $request->title_ru;
        $tour_title->title_ar = $request->title_ar;

        $tour_title->save();

        return redirect()->route('admin_tour_titles_index')->with('success', 'Tour_Title is Updated successfuly');
    }

    public function delete($id)
    {
        // $total = PackageTitl::where('tour_title_id', $id)->count();
        // if ($total > 0) {
        //     return redirect()->route('admin_tour_title_index')->with('error', 'tour_title is Assigned to Packages, So it can not be deleted');
        // }

        $tour_title = TourTitle::find($id);
        $tour_title->delete();
        return redirect()->route('admin_tour_titles_index')->with('success', 'Tour Title is Deleted successfuly');
    }
}
