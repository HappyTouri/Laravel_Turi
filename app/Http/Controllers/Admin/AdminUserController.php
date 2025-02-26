<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\Driver;
use App\Models\Message;
use App\Models\Review;
use App\Models\Rule;
use App\Models\Tourguide;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MessageComment;
use Auth;
use App\Mail\Websitemail;

class AdminUserController extends Controller
{
    public function users()
    {
        $users = User::with('rule')->get();
        return view('admin.user.users', compact('users'));
    }

    public function user_create()
    {
        $rules = Rule::all();
        $accommodations = Accommodation::all();
        $tourguides = Tourguide::all();
        $drivers = Driver::all();
        $destinations = Destination::all();
        return view('admin.user.user_create', compact(
            'rules',
            'accommodations',
            'tourguides',
            'drivers',
            'destinations'
        ));
    }

    public function user_create_submit(Request $request)
    {

        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required'],
            'country' => ['required'],
            'address' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'password' => ['required'],
            'zip' => ['required'],
            'photo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:2024'],
        ]);

        $final_name = 'user_' . time() . '.' . $request->photo->getClientOriginalExtension();
        $request->photo->move(public_path('uploads'), $final_name);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->address = $request->address;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->zip = $request->zip;
        $user->photo = $final_name;
        $user->password = bcrypt($request->password);
        $user->status = $request->status;
        $user->rule_id = $request->rule_id;
        $user->accommodation_id = $request->accommodation_id || null;
        $user->tourguide_id = $request->tourguide_id || null;
        $user->driver_id = $request->driver_id || null;
        $user->destination_id = $request->destination_id || null;

        $user->save();

        return redirect()->back()->with('success', 'User is Created successfuly!');
    }


    public function user_edit($id)
    {
        $user = User::where('id', $id)->first();
        $rules = Rule::all();
        $accommodations = Accommodation::all();
        $tourguides = Tourguide::all();
        $drivers = Driver::all();
        $destinations = Destination::all();
        return view('admin.user.user_edit', compact(
            'user',
            'rules',
            'accommodations',
            'tourguides',
            'drivers',
            'destinations'
        ));
    }

    public function user_edit_submit(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'phone' => ['required'],
            'country' => ['required'],
            'address' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'zip' => ['required'],
            // 'photo' => ['mimes:jpg,jpeg,png,gif', 'max:2024'],
        ]);

        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => ['mimes:jpg,jpeg,png,gif', 'max:2024'],
            ]);

            if ($user->photo != '') {
                unlink(public_path('uploads/' . $user->photo));
            }
            $final_name = 'user_' . time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('uploads'), $final_name);
            $user->photo = $final_name;
        }

        if ($request->password) {
            $request->validate([
                'password' => ['required', 'min:6'],
            ]);
            $user->password = bcrypt($request->password);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->address = $request->address;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->zip = $request->zip;
        $user->status = $request->status;
        $user->rule_id = $request->rule_id;
        $user->accommodation_id = $request->accommodation_id;
        $user->tourguide_id = $request->tourguide_id;
        $user->driver_id = $request->driver_id;
        $user->destination_id = $request->destination_id;
        $user->save();

        return redirect()->back()->with('success', 'User is Updated successfuly!');





    }



    public function user_delete($id)
    {
        $total = Review::where('user_id', $id)->count();
        if ($total > 0) {
            return redirect()->back()->with('error', 'User can not be Deleted, because it has some Reviews');
        }

        $total1 = Message::where('user_id', $id)->count();
        if ($total1 > 0) {
            return redirect()->back()->with('error', 'User can not be Deleted, because it has some Messages');
        }

        $total2 = Wishlist::where('user_id', $id)->count();
        if ($total1 > 0) {
            return redirect()->back()->with('error', 'User can not be Deleted, because it has some Wishlists');
        }
        $total3 = Booking::where('user_id', $id)->count();
        if ($total1 > 0) {
            return redirect()->back()->with('error', 'User can not be Deleted, because it has some Bookings');
        }

        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'User is Deleted successfuly');
    }



    public function message()
    {
        $messages = Message::with('user')->get();
        return view('admin.user.message', compact('messages'));
    }

    public function message_detail($id)
    {
        $message_comments = MessageComment::where('message_id', $id)
            ->orderBy('id', 'desc')
            ->get();
        return view('admin.user.message_detail', compact('message_comments', 'id'));
    }

    public function message_submit(Request $request, $id)
    {
        $request->validate([
            'comment' => ['required'],
        ]);

        $obj = new MessageComment();
        $obj->sender_id = 1;
        $obj->message_id = $id;
        $obj->type = "Admin";
        $obj->comment = $request->comment;
        $obj->save();

        $message_link = route('user_message');

        $subject = "Admin Reply";
        $message = "Please Click on the Following Link to see the Message From the Admin:<br>";
        $message .= "<a href='" . $message_link . "'>Click Here</a>";

        $message_data = Message::where('id', $id)->first();
        $user_email = $message_data->user->email;
        // Send the email
        \Mail::to($user_email)->send(new Websitemail($subject, $message));


        return redirect()->back()->with('success', 'Message is Send Successfully');

    }
}
