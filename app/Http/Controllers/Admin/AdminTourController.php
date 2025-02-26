<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PackageTour;
use App\Models\Package;
use App\Models\Booking;

class AdminTourController extends Controller
{
    public function index()
    {
        $tours = PackageTour::with('package')->get();
        return view('admin.tour.index', compact('tours'));
    }

    public function create()
    {
        $packages = Package::orderBy('name', 'asc')->get();
        return view('admin.tour.create', compact('packages'));
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'tour_name' => ['required'],
            'tour_start_date' => ['required'],
            'tour_end_date' => ['required'],
            'booking_end_date' => ['required'],
            'total_seat' => ['required', 'integer', 'min:0'],
        ]);

        $tour = new PackageTour();
        $tour->package_id = $request->package_id;
        $tour->tour_name = $request->tour_name;
        $tour->tour_start_date = $request->tour_start_date;
        $tour->tour_end_date = $request->tour_end_date;
        $tour->booking_end_date = $request->booking_end_date;
        $tour->total_seat = $request->total_seat;
        $tour->save();

        return redirect()->route('admin_tour_index')->with('success', 'Tour is Created successfuly');

    }

    public function edit($id)
    {
        $tour = PackageTour::find($id);
        $packages = Package::orderBy('name', 'asc')->get();
        return view('admin.tour.edit', compact('tour', 'packages'));
    }

    public function edit_submit(Request $request, $id)
    {

        $tour = PackageTour::where('id', $id)->first();
        $request->validate([
            'tour_name' => ['required'],
            'tour_start_date' => ['required'],
            'tour_end_date' => ['required'],
            'booking_end_date' => ['required'],
            'total_seat' => ['required', 'integer', 'min:0'],
        ]);

        $tour->package_id = $request->package_id;
        $tour->tour_name = $request->tour_name;
        $tour->tour_start_date = $request->tour_start_date;
        $tour->tour_end_date = $request->tour_end_date;
        $tour->booking_end_date = $request->booking_end_date;
        $tour->total_seat = $request->total_seat;
        $tour->save();

        return redirect()->route('admin_tour_index')->with('success', 'Tour is Updated successfuly');
    }

    public function delete($id)
    {
        $total = Booking::where('tour_id', $id)->count();
        if ($total > 0) {
            return redirect()->route('admin_tour_index')->with('error', 'This Tour has Booking, So It Can not be Deleted');
        }
        $tour = PackageTour::find($id);
        $tour->delete();
        return redirect()->route('admin_tour_index')->with('success', 'tour is Deleted successfuly');
    }

    public function tour_booking($tour_id, $package_id)
    {
        // dd($tour_id, $package_id);
        $all_data = Booking::with('user')
            ->where('tour_id', $tour_id)
            ->where('package_id', $package_id)
            ->get();

        return view('admin.tour.booking', compact('all_data'));

    }


    public function tour_booking_delete($id)
    {
        $booking = Booking::find($id);
        $booking->delete();
        return redirect()->back()->with('success', 'Booking is Deleted successfuly');
    }

    public function tour_invoice($id)
    {
        $booking = Booking::with('user', 'tour', 'package')->where('id', $id)->first();
        return view('admin.tour.invoice', compact('booking'));


    }
    public function tour_booking_approve($id)
    {
        Booking::where('id', $id)->update(['payment_status' => 'Completed']);
        return redirect()->back()->with('success', 'Booking is Approved successfuly');


    }




}
