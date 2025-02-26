<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;


class AdminTestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::get();
        return view('admin.testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonial.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'designation' => ['required'],
            'comment' => ['required'],
            'photo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
        ]);

        $final_name = 'testimonial_' . time() . '.' . $request->photo->getClientOriginalExtension();
        $request->photo->move(public_path('uploads'), $final_name);


        $testimonial = new Testimonial();
        $testimonial->photo = $final_name;
        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->comment = $request->comment;
        $testimonial->save();

        return redirect()->route('admin_testimonial_index')->with('success', 'testimonial Created successfuly');

    }

    public function edit($id)
    {
        $testimonial = testimonial::find($id);
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    public function edit_submit(Request $request, $id)
    {

        $testimonial = Testimonial::where('id', $id)->first();
        $request->validate([
            'name' => ['required'],
            'designation' => ['required'],
            'comment' => ['required'],
        ]);

        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
            ]);

            unlink(public_path('uploads/' . $testimonial->photo));

            $final_name = 'testimonial_' . time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('uploads'), $final_name);
            $testimonial->photo = $final_name;
        }


        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->comment = $request->comment;
        $testimonial->save();

        return redirect()->route('admin_testimonial_index')->with('success', 'testimonial Updated successfuly');
    }

    public function delete($id)
    {
        $testimonial = Testimonial::find($id);
        unlink(public_path('uploads/' . $testimonial->photo));
        $testimonial->delete();
        return redirect()->route('admin_testimonial_index')->with('success', 'testimonial Deleted successfuly');
    }

}
