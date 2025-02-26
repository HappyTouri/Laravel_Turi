<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cooperator;
use App\Models\Package;
use App\Models\PackageAmenity;
use App\Models\PackageFaq;
use App\Models\PackagePhoto;
use App\Models\PackageVideo;
use App\Models\PrivateTour;
use App\Models\PrivateTourDetail;
use App\Models\Review;
use Illuminate\Http\Request;

class SingleTourController extends Controller
{
    public function single_tour($lang, $id)
    {

        $private_tour = PrivateTour::with(
            'package.destination',
            'package.packageTitle',
            'tourTitle',
            'cooperator'
        )->findOrFail($id);

        $cooperator = Cooperator::where('id', $private_tour->cooperator_id)->first();
        $package = Package::where('id', $private_tour->package_id)->first();



        $package_photos = PackagePhoto::where('package_id', $package->id)->get();
        $package_videos = PackageVideo::where('package_id', $package->id)->get();
        $package_faqs = PackageFaq::where('package_id', $package->id)->get();
        $package_reviews = Review::with('user')
            ->where('package_id', $package->id)
            ->paginate(2);
        $total_reviews = Review::where('package_id', $package->id)->count();
        $package_rating = ($package->total_rating && $package->total_rating > 0)
            ? number_format($package->total_score / $package->total_rating, 1)
            : null; // Return 'N/A' if total_rating is null or 0



        $package_amenities_includes = PackageAmenity::with('amenity')
            ->where('package_id', $package->id)
            ->where('type', 'Include')
            ->get();

        $package_amenities_excludes = PackageAmenity::with('amenity')
            ->where('package_id', $package->id)
            ->where('type', 'Exclude')
            ->get();


        $private_tour_details = PrivateTourDetail::with(
            'accommodation.city',
            'dayTour.tour_photos'
        )
            ->where('private_tour_id', $id)->get();

        return view('website.singleTour', compact(
            'private_tour',
            'package_amenities_includes',
            'package_amenities_excludes',
            'private_tour_details',
            'package_photos',
            'package_videos',
            'package_faqs',
            'cooperator',
            'package_reviews',
            'total_reviews',
            'package_rating',
            'package'
        ));
    }
}
