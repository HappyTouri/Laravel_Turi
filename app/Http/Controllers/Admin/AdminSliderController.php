<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;


class AdminSliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'heading_en' => ['required'],
            'heading_ru' => ['required'],
            'heading_ar' => ['required'],
            'text_en' => ['required'],
            'text_ru' => ['required'],
            'text_ar' => ['required'],
            'photo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
        ]);

        $final_name = 'Slider_' . time() . '.' . $request->photo->getClientOriginalExtension();
        $request->photo->move(public_path('uploads'), $final_name);


        $slider = new Slider();
        $slider->photo = $final_name;
        $slider->heading_en = $request->heading_en;
        $slider->heading_ru = $request->heading_ru;
        $slider->heading_ar = $request->heading_ar;
        $slider->text_en = $request->text_en;
        $slider->text_ru = $request->text_ru;
        $slider->text_ar = $request->text_ar;
        $slider->save();

        return redirect()->route('admin_slider_index')->with('success', 'Slider Created successfuly');

    }

    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function edit_submit(Request $request, $id)
    {

        $slider = Slider::where('id', $id)->first();
        $request->validate([
            'heading_en' => ['required'],
            'heading_ru' => ['required'],
            'heading_ar' => ['required'],
            'text_en' => ['required'],
            'text_ru' => ['required'],
            'text_ar' => ['required'],
        ]);

        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
            ]);

            unlink(public_path('uploads/' . $slider->photo));

            $final_name = 'Slider_' . time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('uploads'), $final_name);
            $slider->photo = $final_name;
        }

        $slider->heading_en = $request->heading_en;
        $slider->heading_ru = $request->heading_ru;
        $slider->heading_ar = $request->heading_ar;
        $slider->text_en = $request->text_en;
        $slider->text_ru = $request->text_ru;
        $slider->text_ar = $request->text_ar;
        $slider->save();

        return redirect()->route('admin_slider_index')->with('success', 'Slider Updated successfuly');
    }

    public function delete($id)
    {
        $slider = Slider::find($id);
        unlink(public_path('uploads/' . $slider->photo));
        $slider->delete();
        return redirect()->route('admin_slider_index')->with('success', 'Slider Deleted successfuly');
    }





}
