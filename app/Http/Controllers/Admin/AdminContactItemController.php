<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactItem;
use Illuminate\Http\Request;

class AdminContactItemController extends Controller
{
    public function index()
    {
        $contact_item = ContactItem::where('id', 1)->first();
        return view('admin.contact_item.index', compact('contact_item'));
    }

    public function update(Request $request)
    {

        $contact_item = ContactItem::where('id', 1)->first();

        if ($request->hasFile('banner')) {
            $request->validate([
                'banner' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
            ]);

            // Check if there is an existing featured photo before attempting to delete
            if (!empty($contact_item->banner) && file_exists(public_path('uploads/' . $contact_item->banner))) {
                unlink(public_path('uploads/' . $contact_item->banner));
            }

            $final_name = 'contact_item_' . time() . '.' . $request->banner->getClientOriginalExtension();
            $request->banner->move(public_path('uploads'), $final_name);
            $contact_item->banner = $final_name;
        }

        $contact_item->map = $request->map;
        $contact_item->save();

        return redirect()->back()->with('success', 'Contact Items Updated successfuly');
    }
}
