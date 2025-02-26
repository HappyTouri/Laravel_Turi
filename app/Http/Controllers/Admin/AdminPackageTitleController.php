<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackageTitle;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPackageTitleController extends Controller
{
    public function index()
    {
        $package_titles = PackageTitle::orderBy('no_days', 'asc')->get();
        return view('admin.package_title.index', compact('package_titles'));
    }


    public function create_submit(Request $request)
    {
        $request->validate([
            'title_en' => ['required', 'unique:package_titles'],
            'title_ru' => ['required', 'unique:package_titles'],
            'title_ar' => ['required', 'unique:package_titles'],
            'no_days' => ['required', 'unique:package_titles'],
        ]);

        $package_title = new PackageTitle();
        $package_title->title_en = $request->title_en;
        $package_title->title_ru = $request->title_ru;
        $package_title->title_ar = $request->title_ar;
        $package_title->no_days = $request->no_days;
        $package_title->save();

        return redirect()->route('admin_package_titles_index')->with('success', 'package_title is Created successfuly');

    }

    public function edit($id)
    {
        $package_title = PackageTitle::find($id);
        return view('admin.package_title.edit', compact('package_title'));
    }

    public function edit_submit(Request $request, $id)
    {

        $package_title = PackageTitle::where('id', $id)->first();
        $request->validate([
            'title_en' => ['required', Rule::unique('package_titles')->ignore($package_title->id)],
            'title_ru' => ['required', Rule::unique('package_titles')->ignore($package_title->id)],
            'title_ar' => ['required', Rule::unique('package_titles')->ignore($package_title->id)],
            'no_days' => ['required', Rule::unique('package_titles')->ignore($package_title->id)],
        ]);


        $package_title->title_en = $request->title_en;
        $package_title->title_ru = $request->title_ru;
        $package_title->title_ar = $request->title_ar;
        $package_title->no_days = $request->no_days;
        $package_title->save();

        return redirect()->route('admin_package_titles_index')->with('success', 'Package_Title is Updated successfuly');
    }

    public function delete($id)
    {
        // $total = PackageTitl::where('package_title_id', $id)->count();
        // if ($total > 0) {
        //     return redirect()->route('admin_package_title_index')->with('error', 'package_title is Assigned to Packages, So it can not be deleted');
        // }

        $package_title = PackageTitle::find($id);
        $package_title->delete();
        return redirect()->route('admin_package_titles_index')->with('success', 'Room Category is Deleted successfuly');
    }
}
