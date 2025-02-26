<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\PrivateTour;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;

class PrintFrontController extends Controller
{
    public function guest_name($id)
    {
        $private_tour = PrivateTour::findOrFail($id);
        $logo = $private_tour->cooperator->logo;
        $name = $private_tour->user->name;

        return view('guestName', compact('logo', 'name', 'id'));
    }

    public function guest_name_pdf($id)
    {
        $private_tour = PrivateTour::findOrFail($id);
        $logo = $private_tour->cooperator->logo;
        $name = $private_tour->user->name;

        // Load the Blade view and pass data to it
        // Load the Blade view and pass the data
        $pdf = PDF::loadView('guestName', compact('logo', 'name', 'id'));

        // Return the generated PDF as a download
        return $pdf->download('a4_landscape.pdf');
    }
}
