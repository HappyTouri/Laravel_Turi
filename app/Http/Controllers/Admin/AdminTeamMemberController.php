<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class AdminTeamMemberController extends Controller
{
    public function index()
    {
        $team_members = TeamMember::get();
        return view('admin.team_member.index', compact('team_members'));
    }

    public function create()
    {
        return view('admin.team_member.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'slug' => ['required', 'alpha_dash', 'unique:team_members,slug'],
            'designation' => ['required'],
            'address' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'biography' => ['required'],
            // 'facebook' => ['required'],
            // 'twitter' => ['required'],
            // 'linkedin' => ['required'],
            // 'instagram' => ['required'],
            'photo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
        ]);

        $final_name = 'team_member_' . time() . '.' . $request->photo->getClientOriginalExtension();
        $request->photo->move(public_path('uploads'), $final_name);


        $team_member = new TeamMember();
        $team_member->photo = $final_name;
        $team_member->name = $request->name;
        $team_member->slug = $request->slug;
        $team_member->designation = $request->designation;
        $team_member->email = $request->email;
        $team_member->address = $request->address;
        $team_member->phone = $request->phone;
        $team_member->biography = $request->biography;
        $team_member->facebook = $request->facebook;
        $team_member->twitter = $request->twitter;
        $team_member->linkedin = $request->linkedin;
        $team_member->instagram = $request->instagram;
        $team_member->save();

        return redirect()->route('admin_team_member_index')->with('success', 'Team Member Created successfuly');

    }

    public function edit($id)
    {
        $team_member = TeamMember::find($id);
        return view('admin.team_member.edit', compact('team_member'));
    }

    public function edit_submit(Request $request, $id)
    {

        $team_member = TeamMember::where('id', $id)->first();
        $request->validate([
            'name' => ['required'],
            'slug' => [
                'required',
                'alpha_dash',
                Rule::unique('team_members', 'slug')->ignore($id)
            ],
            'designation' => ['required'],
            'address' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'biography' => ['required'],
            // 'facebook' => ['required'],
            // 'twitter' => ['required'],
            // 'linkedin' => ['required'],
            // 'instagram' => ['required'],
        ]);

        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
            ]);

            unlink(public_path('uploads/' . $team_member->photo));

            $final_name = 'team_member_' . time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('uploads'), $final_name);
            $team_member->photo = $final_name;
        }



        $team_member->name = $request->name;
        $team_member->designation = $request->designation;
        $team_member->email = $request->email;
        $team_member->address = $request->address;
        $team_member->slug = $request->slug;
        $team_member->phone = $request->phone;
        $team_member->biography = $request->biography;
        $team_member->facebook = $request->facebook;
        $team_member->twitter = $request->twitter;
        $team_member->linkedin = $request->linkedin;
        $team_member->instagram = $request->instagram;
        $team_member->save();

        return redirect()->route('admin_team_member_index')->with('success', 'Team Member Updated successfuly');
    }

    public function delete($id)
    {
        $team_member = TeamMember::find($id);
        unlink(public_path('uploads/' . $team_member->photo));
        $team_member->delete();
        return redirect()->route('admin_team_member_index')->with('success', 'Team Member Deleted successfuly');
    }
}
