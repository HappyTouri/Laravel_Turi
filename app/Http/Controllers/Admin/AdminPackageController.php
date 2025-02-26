<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Package;
use App\Models\Destination;
use App\Models\PackageAmenity;
use App\Models\PackageFaq;
use App\Models\PackageItinerary;
use App\Models\PackagePhoto;
use App\Models\PackageTitle;
use App\Models\PackageTour;
use App\Models\PackageVideo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('packageTitle', 'destination')
            ->select('packages.*') // Keep original `packages` columns including the primary key
            ->join('package_titles', 'package_titles.id', '=', 'packages.package_title_id')
            ->orderBy('destination_id', 'asc')
            ->orderBy('package_titles.no_days', 'asc') // Order by number of days from the package_titles table
            ->get();
        return view('admin.package.index', compact('packages'));
    }

    public function create()
    {
        $destinations = Destination::orderBy('name_en', 'asc')->get();
        $package_titles = PackageTitle::orderBy('no_days', 'asc')->get();
        return view('admin.package.create', compact('destinations', 'package_titles'));
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'package_title_id' => [
                'required',
                Rule::unique('packages')->where(function ($query) use ($request) {
                    return $query->where('destination_id', $request->destination_id);
                })
            ],
            'destination_id' => ['required'],
            'slug' => ['required', 'alpha_dash', 'unique:packages,slug'],
            'description_en' => ['required'],
            'description_ru' => ['required'],
            'description_ar' => ['required'],
            'featured_photo' => [
                'required',    // Field is required
                'mimes:jpg,jpeg,png,gif', // Only allow certain file types
                'max:4300'     // Maximum file size of 4.3 MB
            ],
            'banner' => [
                'required',
                'mimes:jpg,jpeg,png,gif',
                'max:4300'
            ],

            'price' => ['required'],
        ]);

        $final_name = 'package_feature_' . time() . '.' . $request->featured_photo->getClientOriginalExtension();
        $request->featured_photo->move(public_path('uploads'), $final_name);

        $final_name1 = 'package_banner_' . time() . '.' . $request->banner->getClientOriginalExtension();
        $request->banner->move(public_path('uploads'), $final_name1);


        $package = new Package();
        $package->featured_photo = $final_name;
        $package->banner = $final_name1;
        $package->destination_id = $request->destination_id;
        $package->package_title_id = $request->package_title_id;
        $package->slug = $request->slug;
        $package->description_en = $request->description_en;
        $package->description_ru = $request->description_ru;
        $package->description_ar = $request->description_ar;
        $package->price = $request->price;
        $package->old_price = $request->old_price;
        $package->map = $request->map;
        $package->total_rating = 0;
        $package->total_score = 0;
        $package->save();

        return redirect()->route('admin_package_index')->with('success', 'Package is Created successfuly');

    }

    public function edit($id)
    {
        $package = Package::find($id);
        $destinations = Destination::orderBy('name_en', 'asc')->get();
        $package_titles = PackageTitle::orderBy('id', 'asc')->get();
        return view('admin.package.edit', compact('package', 'destinations', 'package_titles'));
    }

    public function edit_submit(Request $request, $id)
    {
        $package = Package::where('id', $id)->first();

        $request->validate([
            'package_title_id' => [
                'required',
                Rule::unique('packages')
                    ->where(function ($query) use ($request) {
                        return $query->where('destination_id', $request->destination_id);
                    })
                    ->ignore($package->id), // Ignore the current package ID for uniqueness check
            ],
            'slug' => [
                'required',
                'alpha_dash',
                Rule::unique('packages', 'slug')->ignore($id)
            ],
            'description_en' => ['required'],
            'description_ru' => ['required'],
            'description_ar' => ['required'],
            'price' => ['required', 'numeric'],
        ]);

        if ($request->hasFile('featured_photo')) {
            $request->validate([
                'featured_photo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
            ]);

            if ($package->featured_photo && file_exists(public_path('uploads/' . $package->featured_photo))) {
                unlink(public_path('uploads/' . $package->featured_photo));
            }

            $final_name = 'package_featured_' . time() . '.' . $request->featured_photo->getClientOriginalExtension();
            $request->featured_photo->move(public_path('uploads'), $final_name);
            $package->featured_photo = $final_name;
        }

        if ($request->hasFile('banner')) {
            $request->validate([
                'banner' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
            ]);

            if ($package->banner && file_exists(public_path('uploads/' . $package->banner))) {
                unlink(public_path('uploads/' . $package->banner));
            }

            $final_name_1 = 'package_banner_' . time() . '.' . $request->banner->getClientOriginalExtension();
            $request->banner->move(public_path('uploads'), $final_name_1);
            $package->banner = $final_name_1;
        }

        $package->destination_id = $request->destination_id;
        $package->package_title_id = $request->package_title_id;
        $package->slug = $request->slug;
        $package->description_en = $request->description_en;
        $package->description_ru = $request->description_ru;
        $package->description_ar = $request->description_ar;
        $package->price = $request->price;
        $package->old_price = $request->old_price;
        $package->map = $request->map;
        $package->save();

        return redirect()->route('admin_package_index')->with('success', 'Package is updated successfully.');
    }


    public function delete($id)
    {
        $total = packagePhoto::where('package_id', $id)->count();
        if ($total > 0) {
            return redirect()->route('admin_package_index')->with('error', 'First Delete all Photos of This package');
        }

        $total1 = packageVideo::where('package_id', $id)->count();
        if ($total1 > 0) {
            return redirect()->route('admin_package_index')->with('error', 'First Delete all Videos of This package');
        }

        $total3 = PackageAmenity::where('package_id', $id)->count();
        if ($total3 > 0) {
            return redirect()->route('admin_package_index')->with('error', 'First Delete all Amenities of This package');
        }
        $total4 = PackageItinerary::where('package_id', $id)->count();
        if ($total4 > 0) {
            return redirect()->route('admin_package_index')->with('error', 'First Delete all Itinerary of This package');
        }
        $total5 = PackageFaq::where('package_id', $id)->count();
        if ($total5 > 0) {
            return redirect()->route('admin_package_index')->with('error', 'First Delete all FAQs of This package');
        }
        $total6 = PackageTour::where('package_id', $id)->count();
        if ($total6 > 0) {
            return redirect()->route('admin_package_index')->with('error', 'First Delete all Tours of This package');
        }

        $package = package::find($id);
        unlink(public_path('uploads/' . $package->featured_photo));
        unlink(public_path('uploads/' . $package->banner));
        $package->delete();
        return redirect()->route('admin_package_index')->with('success', 'package Deleted successfuly');
    }

    public function package_amenities($id)
    {
        $package = Package::with('packageTitle')->where('id', $id)->first();
        // dd($id);
        $package_amenities_includes = PackageAmenity::with('amenity')
            ->where('package_id', $id)
            ->where('type', 'Include')
            ->get();

        $package_amenities_excludes = PackageAmenity::with('amenity')
            ->where('package_id', $id)
            ->where('type', 'Exclude')
            ->get();
        $amenities = Amenity::orderBy('name', 'asc')->get();
        return view('admin.package.amenities', compact('package', 'package_amenities_includes', 'amenities', 'package_amenities_excludes'));
    }

    public function package_amenity_submit(Request $request, $id)
    {
        $total = PackageAmenity::where('package_id', $id)->where('amenity_id', $request->amenity_id)->count();
        if ($total > 0) {
            return redirect()->back()->with('error', 'This Item is Already Inserted');
        }
        $obj = new PackageAmenity();
        $obj->package_id = $id;
        $obj->amenity_id = $request->amenity_id;
        $obj->type = $request->type;
        $obj->save();

        return redirect()->back()->with('success', 'Package Amenity inserted successfuly');
    }

    public function package_amenity_delete($id)
    {

        $package_amenity = PackageAmenity::find($id);
        $package_amenity->delete();
        return redirect()->back()->with('success', 'Package Amenity id Deleted successfuly');
    }

    public function package_itineraries($id)
    {
        $package = Package::where('id', $id)->first();
        $package_itirenaries = PackageItinerary::where('package_id', $id)->get();
        return view('admin.package.itineraries', compact('package', 'package_itirenaries'));
    }

    public function package_itinerary_submit(Request $request, $id)
    {

        $request->validate([
            'name' => ['required'],
            'description' => ['required'],
        ]);
        $obj = new PackageItinerary();
        $obj->package_id = $id;
        $obj->name = $request->name;
        $obj->description = $request->description;
        $obj->save();

        return redirect()->back()->with('success', 'Package Itirenary inserted successfuly');
    }

    public function package_itinerary_delete($id)
    {

        $package_itirenary = PackageItinerary::find($id);
        $package_itirenary->delete();
        return redirect()->back()->with('success', 'Package Itirenary id Deleted successfuly');
    }


    public function package_photos($id)
    {
        $package = Package::where('id', $id)->first();
        $package_photos = PackagePhoto::where('package_id', $id)->get();
        return view('admin.package.photos', compact('package', 'package_photos'));
    }

    public function package_photo_submit(Request $request, $id)
    {
        $request->validate([
            'photo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
        ]);

        $final_name = 'package_' . time() . '.' . $request->photo->getClientOriginalExtension();
        $request->photo->move(public_path('uploads'), $final_name);

        $obj = new PackagePhoto();
        $obj->package_id = $id;
        $obj->photo = $final_name;
        $obj->save();

        return redirect()->back()->with('success', 'Photo inserted successfuly');
    }

    public function package_photo_delete($id)
    {

        $package_photo = PackagePhoto::find($id);
        unlink(public_path('uploads/' . $package_photo->photo));
        $package_photo->delete();
        return redirect()->back()->with('success', 'Photo id Deleted successfuly');
    }


    public function package_videos($id)
    {
        $package = Package::where('id', $id)->first();
        $package_videos = packageVideo::where('package_id', $id)->get();
        return view('admin.package.videos', compact('package', 'package_videos'));
    }

    public function package_video_submit(Request $request, $id)
    {
        $request->validate([
            'video' => ['required'],
        ]);

        $obj = new packageVideo();
        $obj->package_id = $id;
        $obj->video = $request->video;
        $obj->save();

        return redirect()->back()->with('success', 'video inserted successfuly');
    }

    public function package_video_delete($id)
    {

        $package_video = PackageVideo::find($id);
        $package_video->delete();
        return redirect()->back()->with('success', 'Video is Deleted successfuly');
    }

    public function package_faqs($id)
    {
        $package = Package::with('packageTitle')->where('id', $id)->first();
        $package_faqs = PackageFaq::where('package_id', $id)->get();
        return view('admin.package.faqs', compact('package', 'package_faqs'));
    }

    public function package_faqs_create($id)
    {
        $package = Package::with('packageTitle')->where('id', $id)->first();
        return view('admin.package.fagsCreate', compact('package'));
    }
    public function package_faq_submit(Request $request, $id)
    {
        $request->validate([
            'question_en' => ['required'],
            'answer_en' => ['required'],
            'question_ru' => ['required'],
            'answer_ru' => ['required'],
            'question_ar' => ['required'],
            'answer_ar' => ['required'],
        ]);

        $obj = new PackageFaq();
        $obj->package_id = $id;
        $obj->question_en = $request->question_en;
        $obj->answer_en = $request->answer_en;
        $obj->question_ru = $request->question_ru;
        $obj->answer_ru = $request->answer_ru;
        $obj->question_ar = $request->question_ar;
        $obj->answer_ar = $request->answer_ar;
        $obj->save();

        return redirect()->route('admin_package_faqs', $id)->with('success', 'Faq inserted successfuly');
    }

    public function package_faqs_edit($id)
    {
        $faq = PackageFaq::where('id', $id)->first();
        $package = Package::with('packageTitle')->where('id', $faq->package_id)->first();

        return view('admin.package.fagsEdit', compact('faq', 'package'));
    }


    public function package_faq_edit_submit(Request $request, $id)
    {

        $faq = PackageFaq::where('id', $id)->first();
        $request->validate([
            'question_en' => ['required'],
            'answer_en' => ['required'],
            'question_ru' => ['required'],
            'answer_ru' => ['required'],
            'question_ar' => ['required'],
            'answer_ar' => ['required'],
        ]);

        $faq->question_en = $request->question_en;
        $faq->answer_en = $request->answer_en;
        $faq->question_ru = $request->question_ru;
        $faq->answer_ru = $request->answer_ru;
        $faq->question_ar = $request->question_ar;
        $faq->answer_ar = $request->answer_ar;
        $faq->save();


        return redirect()->route('admin_package_faqs', $faq->package_id)->with('success', 'faq is Updated successfuly');
    }

    public function package_faq_delete($id)
    {

        $package_faq = PackageFaq::find($id);
        $package_faq->delete();
        return redirect()->back()->with('success', 'Faq is Deleted successfuly');
    }


}
