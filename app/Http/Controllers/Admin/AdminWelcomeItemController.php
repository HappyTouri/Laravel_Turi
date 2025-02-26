<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WelcomeItem;

class AdminWelcomeItemController extends Controller
{
    public function index()
    {
        $welcome_item = WelcomeItem::where('id', 1)->first();
        return view('admin.welcome.index', compact('welcome_item'));
    }

    public function update(Request $request)
    {

        $welcome_item = WelcomeItem::where('id', 1)->first();
        $request->validate([
            'heading' => ['required'],
            'description' => ['required'],
            'button_text' => ['required'],
            'button_link' => ['required'],
            'video' => ['required'],
            'status' => ['required'],
        ]);

        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
            ]);

            unlink(public_path('uploads/' . $welcome_item->photo));

            $final_name = 'welcome_item_' . time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('uploads'), $final_name);
            $welcome_item->photo = $final_name;
        }

        $welcome_item->heading = $request->heading;
        $welcome_item->description = $request->description;
        $welcome_item->button_text = $request->button_text;
        $welcome_item->button_link = $request->button_link;
        $welcome_item->video = $request->video;
        $welcome_item->status = $request->status;
        $welcome_item->save();

        return redirect()->route('admin_welcome_item_index')->with('success', 'Welcome Item Updated successfuly');
    }
}
