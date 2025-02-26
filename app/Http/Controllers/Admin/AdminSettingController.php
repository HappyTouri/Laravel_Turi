<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index()
    {
        $setting = Setting::where('id', 1)->first();
        return view('admin.setting.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::where('id', 1)->first();

        // Update logo
        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
            ]);
            if ($setting->logo != '') {
                unlink(public_path('uploads/' . $setting->logo));
            }

            $final_name = 'Logo_' . time() . '.' . $request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('uploads'), $final_name);
            $setting->logo = $final_name;
        }

        // Update favicon
        if ($request->hasFile('favicon')) {
            $request->validate([
                'favicon' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
            ]);
            if ($setting->favicon != '') {
                unlink(public_path('uploads/' . $setting->favicon));
            }

            $final_name1 = 'favicon_' . time() . '.' . $request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('uploads'), $final_name1);
            $setting->favicon = $final_name1;
        }

        // Update destinations banner
        if ($request->hasFile('destinations_banner')) {
            $request->validate([
                'destinations_banner' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
            ]);

            if (!empty($setting->destinations_banner) && file_exists(public_path('uploads/' . $setting->destinations_banner))) {
                unlink(public_path('uploads/' . $setting->destinations_banner));
            }

            $final_name_1 = 'destinations_banner_' . time() . '.' . $request->destinations_banner->getClientOriginalExtension();
            $request->destinations_banner->move(public_path('uploads'), $final_name_1);
            $setting->destinations_banner = $final_name_1;
        }

        // Update packages banner
        if ($request->hasFile('packages_banner')) {
            $request->validate([
                'packages_banner' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
            ]);

            if (!empty($setting->packages_banner) && file_exists(public_path('uploads/' . $setting->packages_banner))) {
                unlink(public_path('uploads/' . $setting->packages_banner));
            }

            $final_name_2 = 'packages_banner_' . time() . '.' . $request->packages_banner->getClientOriginalExtension();
            $request->packages_banner->move(public_path('uploads'), $final_name_2);
            $setting->packages_banner = $final_name_2;
        }

        // Update about banner
        if ($request->hasFile('about_banner')) {
            $request->validate([
                'about_banner' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
            ]);

            if (!empty($setting->about_banner) && file_exists(public_path('uploads/' . $setting->about_banner))) {
                unlink(public_path('uploads/' . $setting->about_banner));
            }

            $final_name_3 = 'about_banner_' . time() . '.' . $request->about_banner->getClientOriginalExtension();
            $request->about_banner->move(public_path('uploads'), $final_name_3);
            $setting->about_banner = $final_name_3;
        }

        // Update blog banner
        if ($request->hasFile('blog_banner')) {
            $request->validate([
                'blog_banner' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
            ]);

            if (!empty($setting->blog_banner) && file_exists(public_path('uploads/' . $setting->blog_banner))) {
                unlink(public_path('uploads/' . $setting->blog_banner));
            }

            $final_name_4 = 'blog_banner_' . time() . '.' . $request->blog_banner->getClientOriginalExtension();
            $request->blog_banner->move(public_path('uploads'), $final_name_4);
            $setting->blog_banner = $final_name_4;
        }

        // Update general settings
        $setting->phone = $request->phone;
        $setting->email = $request->email;
        $setting->address = $request->address;

        $setting->facebook = $request->facebook;
        $setting->instagram = $request->instagram;
        $setting->linkedin = $request->linkedin;
        $setting->twitter = $request->twitter;
        $setting->youtube = $request->youtube;

        $setting->copyright = $request->copyright;

        $setting->save();

        return redirect()->back()->with('success', 'Settings updated successfully');
    }

}
