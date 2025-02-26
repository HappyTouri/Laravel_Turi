<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Offer;
use App\Models\PackageTitle;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminOfferController extends Controller
{
    public function index()
    {
        $offers = Offer::get();
        return view('admin.offer.index', compact('offers'));
    }

    public function create()
    {
        $destinations = Destination::with('cities')->orderBy('name', 'asc')->get();
        $package_titles = PackageTitle::orderBy('id', 'asc')->get();
        return view('admin.offer.create', compact('destinations', 'package_titles'));
    }

    // In OfferController
    public function getCities($destination_id)
    {
        dd($destination_id);
        $destination = Destination::with('cities')->findOrFail($destination_id);
        return response()->json($destination->cities);
    }

    // public function create_submit(Request $request)
    // {
    //     $request->validate([
    //         'name' => ['required'],
    //         'slug' => ['required', 'alpha_dash', 'unique:offers,slug'],
    //         'description' => ['required'],
    //         'featured_photo' => [
    //             'required',    // Field is required
    //             'mimes:jpg,jpeg,png,gif', // Only allow certain file types
    //             'max:4300'     // Maximum file size of 4.3 MB
    //         ],
    //         'banner' => [
    //             'required',
    //             'mimes:jpg,jpeg,png,gif',
    //             'max:4300'
    //         ],

    //         'price' => ['required'],
    //     ]);

    //     $final_name = 'offer_feature_' . time() . '.' . $request->featured_photo->getClientOriginalExtension();
    //     $request->featured_photo->move(public_path('uploads'), $final_name);

    //     $final_name1 = 'offer_banner_' . time() . '.' . $request->banner->getClientOriginalExtension();
    //     $request->banner->move(public_path('uploads'), $final_name1);


    //     $offer = new Offer();
    //     $offer->featured_photo = $final_name;
    //     $offer->banner = $final_name1;
    //     $offer->destination_id = $request->destination_id;
    //     $offer->name = $request->name;
    //     $offer->slug = $request->slug;
    //     $offer->description = $request->description;
    //     $offer->price = $request->price;
    //     $offer->old_price = $request->old_price;
    //     $offer->map = $request->map;
    //     $offer->total_rating = 0;
    //     $offer->total_score = 0;
    //     $offer->save();

    //     return redirect()->route('admin_offer_index')->with('success', 'offer is Created successfuly');

    // }

    // public function edit($id)
    // {
    //     $offer = Offer::find($id);
    //     $destinations = Destination::orderBy('name', 'asc')->get();
    //     return view('admin.offer.edit', compact('offer', 'destinations'));
    // }

    // public function edit_submit(Request $request, $id)
    // {

    //     $offer = Offer::where('id', $id)->first();
    //     $request->validate([
    //         'name' => ['required'],
    //         'slug' => [
    //             'required',
    //             'alpha_dash',
    //             Rule::unique('offers', 'slug')->ignore($id)
    //         ],
    //         'description' => ['required'],
    //         'price' => ['required', 'numeric'],

    //     ]);

    //     if ($request->hasFile('featured_photo')) {
    //         $request->validate([
    //             'featured_photo' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
    //         ]);
    //         unlink(public_path('uploads/' . $offer->featured_photo));
    //         $final_name = 'offer_' . time() . '.' . $request->featured_photo->getClientOriginalExtension();
    //         $request->featured_photo->move(public_path('uploads'), $final_name);
    //         $offer->featured_photo = $final_name;
    //     }

    //     if ($request->hasFile('banner')) {
    //         $request->validate([
    //             'banner' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:4300'],
    //         ]);
    //         unlink(public_path('uploads/' . $offer->banner));
    //         $final_name1 = 'offer_' . time() . '.' . $request->banner->getClientOriginalExtension();
    //         $request->banner->move(public_path('uploads'), $final_name1);
    //         $offer->banner = $final_name1;
    //     }

    //     $offer->destination_id = $request->destination_id;
    //     $offer->name = $request->name;
    //     $offer->slug = $request->slug;
    //     $offer->description = $request->description;
    //     $offer->price = $request->price;
    //     $offer->old_price = $request->old_price;
    //     $offer->map = $request->map;
    //     $offer->save();

    //     return redirect()->route('admin_offer_index')->with('success', 'offer is Updated successfuly');
    // }

    // public function delete($id)
    // {
    //     // $total = offerPhoto::where('offer_id', $id)->count();
    //     // if ($total > 0) {
    //     //     return redirect()->route('admin_offer_index')->with('error', 'First Delete all Photos of This offer');
    //     // }

    //     // $total1 = offerVideo::where('offer_id', $id)->count();
    //     // if ($total1 > 0) {
    //     //     return redirect()->route('admin_offer_index')->with('error', 'First Delete all Videos of This offer');
    //     // }

    //     // $total3 = offerAmenity::where('offer_id', $id)->count();
    //     // if ($total3 > 0) {
    //     //     return redirect()->route('admin_offer_index')->with('error', 'First Delete all Amenities of This offer');
    //     // }
    //     // $total4 = offerItinerary::where('offer_id', $id)->count();
    //     // if ($total4 > 0) {
    //     //     return redirect()->route('admin_offer_index')->with('error', 'First Delete all Itinerary of This offer');
    //     // }
    //     // $total5 = offerFaq::where('offer_id', $id)->count();
    //     // if ($total5 > 0) {
    //     //     return redirect()->route('admin_offer_index')->with('error', 'First Delete all FAQs of This offer');
    //     // }
    //     // $total6 = offerTour::where('offer_id', $id)->count();
    //     // if ($total6 > 0) {
    //     //     return redirect()->route('admin_offer_index')->with('error', 'First Delete all Tours of This offer');
    //     // }

    //     $offer = Offer::find($id);
    //     unlink(public_path('uploads/' . $offer->featured_photo));
    //     unlink(public_path('uploads/' . $offer->banner));
    //     $offer->delete();
    //     return redirect()->route('admin_offer_index')->with('success', 'offer Deleted successfuly');
    // }
}
