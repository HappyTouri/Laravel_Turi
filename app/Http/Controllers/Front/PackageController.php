<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cooperator;
use App\Models\Package;
use App\Models\PrivateTour;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function my_package($cooperator_id, $package_id)
    {
        $package = Package::with(
            'destination',
            'package_photos',
            'packageTitle'
        )->findOrFail($package_id);

        $cooperator = Cooperator::where('id', $cooperator_id)->first();


        $private_tours = PrivateTour::with('tourTitle')
            ->where('package_id', $package_id)
            ->where('cooperator_id', $cooperator_id)
            ->where('reserved', false)
            ->where('my_offer', true)

            ->get();


        return view('website.package', compact(
            'package',
            'cooperator',
            'private_tours'
        ));
    }
}
