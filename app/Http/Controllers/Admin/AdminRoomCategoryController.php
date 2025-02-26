<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminRoomCategoryController extends Controller
{
    public function index()
    {
        $room_categories = RoomCategory::get();
        return view('admin.room_category.index', compact('room_categories'));
    }



    public function create_submit(Request $request)
    {
        $request->validate([
            'category' => ['required', 'unique:room_categories'],

        ]);

        $room_category = new RoomCategory();
        $room_category->category = $request->category;
        $room_category->save();

        return redirect()->route('admin_room_categories_index')->with('success', 'room_category is Created successfuly');

    }

    public function edit($id)
    {
        $room_category = RoomCategory::find($id);
        return view('admin.room_category.edit', compact('room_category'));
    }

    public function edit_submit(Request $request, $id)
    {

        $room_category = RoomCategory::where('id', $id)->first();
        $request->validate([
            'category' => [
                'required',
                Rule::unique('room_categories')->ignore($id),
            ],
        ]);

        $room_category->category = $request->category;
        $room_category->save();

        return redirect()->route('admin_room_categories_index')->with('success', 'room_category is Updated successfuly');
    }

    public function delete($id)
    {
        // $total = RoomCategory::where('room_category_id', $id)->count();
        // if ($total > 0) {
        //     return redirect()->route('admin_room_category_index')->with('error', 'room_category is Assigned to Packages, So it can not be deleted');
        // }

        $room_category = RoomCategory::find($id);
        $room_category->delete();
        return redirect()->route('admin_room_categories_index')->with('success', 'Room Category is Deleted successfuly');
    }

}
