<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePrivateTour;
use App\Http\Requests\EditChangeDateTour;
use App\Http\Requests\EditDayTour;
use App\Http\Requests\EditPrivateTour;
use App\Models\Package;
use App\Models\PackageTitle;
use App\Models\PrivateTour;
use App\Models\PrivateTourDetail;
use App\Models\RRoomCategory;
use App\Models\TourTitle;
use App\Models\TransportationPrice;
use Carbon\Carbon;
use App\Helper\ResponseHelper;
use Exception;
use Illuminate\Support\Facades\DB;
// 1-Admin  2-Tour Operator   3-Tourguide   4-Hotel   5-Travel Agency  6-Driver 7-Customer Service
class OfferController extends Controller
{

    //1- Get All Tour Titles
    public function get_tour_titles()
    {
        try {
            $TourTitles = TourTitle::all();
            return ResponseHelper::Success(
                message: 'loaded Successfully',
                data: $TourTitles,
                statusCode: 200
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    //2- Get All Offers
    public function get_all_offers($id)
    {
        try {
            $cooperator = auth()->user();
            if (!$cooperator) {
                return ResponseHelper::Error(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }
            // Prepare the query with all relationships
            $offersQuery = PrivateTour::with(
                'privateTourDetails.rRoomCategories.accommodationRoomsCategory.room_category',
                'privateTourDetails.city',
                'privateTourDetails.confirmationPhotos',
                'privateTourDetails.invoicePhotos',
                'privateTourDetails.paymentPhotos',
                'privateTourDetails.dayTour',
                'privateTourDetails.accommodation.city',
                'package.packageTitle',
                'package.destination',
                'user',
                'passportPhotos',
                'airticketPhotos',
                'driver.driverCarPhotos',
                'driver.city',
                'driver.transportationType',
                'cooperator',
                'tourTitle',
                'transportation'
            )
                ->where('reserved', false)
                ->where('website', false)
                ->where('from', '>', now());

            // Handle roles using switch
            switch ($cooperator->rule_id) {
                case 1: // Admin
                    $offersQuery->whereHas('package', function ($query) use ($id) {
                        $query->where('destination_id', $id);
                    });
                    break;

                case 2: // Tour Operator
                    $offersQuery->whereHas('package', function ($query) use ($cooperator) {
                        $query->where('destination_id', $cooperator->destination_id);
                    });
                    break;

                case 5: // Travel Agency
                    $offersQuery->where('cooperator_id', $cooperator->id);
                    break;

                case 7: // Customer Service
                    $offersQuery->where('cooperator_id', $cooperator->id);
                    break;

                default: // Unauthorized role
                    return ResponseHelper::error(
                        message: 'Unauthorized',
                        statusCode: 401
                    );
            }

            // Fetch offers
            $offers = $offersQuery->orderBy('from', 'asc')->get();

            return ResponseHelper::Success(
                message: 'Loaded Successfully',
                data: $offers,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    //3- Get All My Packages
    public function get_all_my_packages($id)
    {
        try {
            $cooperator = auth()->user();
            if (!$cooperator) {
                return ResponseHelper::Error(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }

            // Initialize the query
            $query = Package::query();

            // Switch case for different role IDs
            switch ($cooperator->rule_id) {
                case 1: // Admin
                case 5: // Travel Agency
                case 7: // Customer Service
                    // Fetch packages with private tours filtered by cooperator_id
                    $query->with([
                        'packageTitle',
                        'destination',
                        'privateTours' => function ($query) use ($cooperator) {
                            $query->where('cooperator_id', $cooperator->id)
                                ->where('website', true)
                                ->where('reserved', false)
                                ->with([
                                    'privateTourDetails.rRoomCategories.accommodationRoomsCategory.room_category',
                                    'privateTourDetails.city',
                                    'privateTourDetails.confirmationPhotos',
                                    'privateTourDetails.invoicePhotos',
                                    'privateTourDetails.paymentPhotos',
                                    'privateTourDetails.dayTour',
                                    'privateTourDetails.accommodation.city',
                                    'package.packageTitle',
                                    'package.destination',
                                    'user',
                                    'passportPhotos',
                                    'airticketPhotos',
                                    'driver.driverCarPhotos',
                                    'driver.city',
                                    'driver.transportationType',
                                    'cooperator',
                                    'tourTitle',
                                    'transportation',
                                ]);
                        }
                    ])
                        ->where('destination_id', $id)
                        ->whereHas('privateTours', function ($query) use ($cooperator) {
                            $query->where('cooperator_id', $cooperator->id)
                                ->where('website', true)
                                ->where('reserved', false);
                        });

                    // Order by the number of days in package titles
                    $query->orderBy(
                        PackageTitle::select('no_days')
                            ->whereColumn('package_titles.id', 'packages.package_title_id')
                            ->orderBy('no_days', 'asc')
                            ->limit(1),
                        'asc'
                    );
                    break;

                default:
                    // Return unauthorized for all other roles
                    return ResponseHelper::Success(
                        message: 'Unauthorized',
                        data: [],
                        statusCode: 200
                    );
            }

            // Fetch the results
            $packages = $query->get();

            return ResponseHelper::Success(
                message: 'Loaded Successfully',
                data: $packages,
                statusCode: 200
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }



    //4- Get All My Package Offers
    public function get_all_package_offers($id)
    {
        try {
            $cooperator = auth()->user();
            if (!$cooperator) {
                return ResponseHelper::Error(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }

            // Start building the query with common filters
            $offers = PrivateTour::with(
                'privateTourDetails.rRoomCategories.accommodationRoomsCategory.room_category',
                'privateTourDetails.city',
                'privateTourDetails.confirmationPhotos',
                'privateTourDetails.invoicePhotos',
                'privateTourDetails.paymentPhotos',
                'privateTourDetails.dayTour',
                'privateTourDetails.accommodation.city',
                'package.packageTitle',
                'package.destination',
                'user',
                'passportPhotos',
                'airticketPhotos',
                'driver.driverCarPhotos',
                'driver.city',
                'driver.transportationType',
                'cooperator',
                'tourTitle',
                'transportation'
            )
                ->where('reserved', false)
                ->where('website', true)
                ->where('package_id', $id)
                ->where('cooperator_id', $cooperator->id) // Common condition
                ->get();

            return ResponseHelper::Success(
                message: 'Loaded Successfully',
                data: $offers,
                statusCode: 200
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    //5- Get All Reservations
    public function get_all_reservations($id)
    {
        try {
            $cooperator = auth()->user();
            if (!$cooperator) {
                return ResponseHelper::Error(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }

            // Initialize the query with common conditions
            $offersQuery = PrivateTour::with(
                'privateTourDetails.rRoomCategories.accommodationRoomsCategory.room_category',
                'privateTourDetails.city',
                'privateTourDetails.confirmationPhotos',
                'privateTourDetails.invoicePhotos',
                'privateTourDetails.paymentPhotos',
                'privateTourDetails.dayTour',
                'privateTourDetails.tourguidee',
                'privateTourDetails.accommodation.city',
                'package.packageTitle',
                'package.destination',
                'user',
                'passportPhotos',
                'airticketPhotos',
                'driver.driverCarPhotos',
                'driver.city',
                'driver.transportationType',
                'cooperator',
                'tourTitle',
                'transportation'
            )
                ->where('reserved', true)
                ->whereHas('package', function ($query) use ($id) {
                    $query->where('destination_id', $id);
                });

            // Apply role-specific conditions
            switch ($cooperator->rule_id) {
                case 1: // Admin
                    break;

                case 2: // Tour Operator
                    $offersQuery->whereHas('package', function ($query) use ($cooperator) {
                        $query->where('destination_id', $cooperator->destination_id);
                    });
                    break;

                case 5: // Travel Agency
                    $offersQuery->whereHas('cooperator', function ($query) use ($cooperator) {
                        $query->where('id', $cooperator->id);
                    });
                    break;

                case 7: // Customer Service
                    $offersQuery->whereHas('cooperator', function ($query) use ($cooperator) {
                        $query->where('id', $cooperator->id);
                    });
                    break;

                default:
                    return ResponseHelper::Success(
                        message: 'Unauthorized',
                        data: [],
                        statusCode: 200
                    );
            }

            // Fetch the offers
            $offers = $offersQuery->get();

            // Update status based on PrivateTourDetails conditions
            foreach ($offers as $offer) {
                $allPaid = true;
                $allConfirmed = true;

                foreach ($offer->privateTourDetails as $detail) {
                    // Check if with_accommodation is true
                    if ($detail->with_accommodation) {
                        if (is_null($detail->invoice_price) || $detail->invoice_price == 0) {
                            $allConfirmed = false;
                        }
                        if (is_null($detail->payment_price) || $detail->payment_price == 0) {
                            $allPaid = false;
                        }
                    }
                }

                // Update the status of the PrivateTour based on conditions
                $offer->status = $allPaid ? 'paid' : ($allConfirmed ? 'confirmed' : 'pending');
                $offer->save();
            }

            return ResponseHelper::Success(
                message: 'Loaded Successfully',
                data: $offers,
                statusCode: 200
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }


    //6- Create Private Tour
    public function create_private_tour(CreatePrivateTour $request)
    {
        try {

            $private_tour = new PrivateTour([
                "cooperator_id" => $request->cooperator_id,
                "tour_name" => $request->tour_name,
                "website" => $request->website,
                "reserved" => false,
                "my_offer" => $request->my_offer,
                "tour_title_id" => $request->tour_title_id,
                "package_id" => $request->package_id,
                "transportation_id" => $request->transportation_id,
                "from" => Carbon::parse($request->from),
                "till" => Carbon::parse($request->till),
                "number_of_days" => $request->number_of_days,
                "transportation_price" => $request->transportation_price,
                "tourguide_price" => $request->tourguide_price,
                "hotels_price" => $request->hotels_price,
                "profit_price" => $request->profit_price,
                "total_price" => $request->total_price,
                "logo" => $request->logo,
                "driver_price" => 0,
            ]);
            $private_tour->save();

            $tourDetails = $request->tourDetails;

            foreach ($tourDetails as $tourDetailData) {
                $tourDetail = new PrivateTourDetail([
                    'private_tour_id' => $private_tour->id,
                    'date' => Carbon::parse($tourDetailData['date']),
                    'day_tour_id' => $tourDetailData['tour_id'],
                    'city_id' => $tourDetailData['city_id'],
                    'tourguide' => $tourDetailData['tourguide'] ?? false,
                    'with_accommodation' => $tourDetailData['accommodation'] ?? false,
                    'accommodation_id' => $tourDetailData['accommodation_id'] ?? null,
                    'number_of_rooms' => $tourDetailData['number_of_rooms'] ?? 0,
                    'accommodation_price' => $tourDetailData['accommodation_price'] ?? 0,
                    'tourguide_price' => $tourDetailData['tourguide_price'] ?? 0,
                ]);
                $tourDetail->save();



                if ($tourDetail->accommodation == true && isset($tourDetailData['roomsCategories'])) {
                    $roomsCategories = $tourDetailData['roomsCategories'];
                    foreach ($roomsCategories as $roomCategoryData) {
                        $roomCategory = new RRoomCategory([
                            'private_tour_detail_id' => $tourDetail->id,
                            'room_category_id' => $roomCategoryData['room_category_id'],
                            'extra_bed' => $roomCategoryData['extrabed'],
                            'room_price' => $roomCategoryData['room_price'],
                            'extrabed_price' => $roomCategoryData['extrabed_price'],
                        ]);
                        $roomCategory->save();
                    }
                }

            }


            return ResponseHelper::Success(
                message: 'Offer Created Successfully',
                data: $request->tour_name,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    //7- Delete Private Tour
    public function delete_private_tour($id)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Find the private tour by ID
            $privateTour = PrivateTour::find($id);

            if (!$privateTour) {
                return ResponseHelper::Error(
                    message: 'Private Tour not found',
                    statusCode: 404
                );
            }

            // Get all PrivateTourDetails for the private tour
            $tourDetails = PrivateTourDetail::where('private_tour_id', $id)->get();

            foreach ($tourDetails as $detail) {
                // Delete associated room categories for each tour detail
                RRoomCategory::where('private_tour_detail_id', $detail->id)->delete();
            }

            // Delete all PrivateTourDetails for the private tour
            PrivateTourDetail::where('private_tour_id', $id)->delete();

            // Delete the private tour itself
            $privateTour->delete();

            // Commit the transaction
            DB::commit();

            return ResponseHelper::Success(
                message: 'Private Tour and related data deleted successfully',
                statusCode: 200
            );

        } catch (Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();

            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    //8- Edit Private Tour
    public function edit_private_tour(EditPrivateTour $request, $id)
    {
        try {
            // Find the PrivateTour
            $private_tour = PrivateTour::findOrFail($id);

            // Update PrivateTour fields
            $private_tour->update([
                "tour_name" => $request->tour_name,
                "tour_title_id" => $request->tour_title_id,
                "transportation_id" => $request->transportation_id,

                "transportation_price" => $request->transportation_price,
                "tourguide_price" => $request->tourguide_price,
                "hotels_price" => $request->hotels_price,
                "profit_price" => $request->profit_price,
                "total_price" => $request->total_price,
            ]);
            return ResponseHelper::Success(
                message: 'Tour updated successfully',
                data: $private_tour->tour_name,
                statusCode: 200
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    //9- Delete Day Tour
    public function delete_day_tour($id)
    {
        try {

            $privateTourDetail = PrivateTourDetail::where('id', $id)->first();

            if (!$privateTourDetail) {
                return ResponseHelper::Error(
                    message: 'Private Tour not found',
                    statusCode: 404
                );
            }

            if ($privateTourDetail->email_send == true) {
                return ResponseHelper::Success(
                    message: 'Cancel Email then Deleted',
                    statusCode: 200
                );
            }

            $privateTour = PrivateTour::where('id', $privateTourDetail->private_tour_id)->first();

            $transportation_price = TransportationPrice::where('id', $privateTour->transportation_id)->first();

            $Trasportation_P = $privateTour->transportation_price - $transportation_price->price;
            $Tourguide_p = $privateTour->tourguide_price - $privateTourDetail->tourguide_price;
            $Hotels_p = $privateTour->hotels_price - $privateTourDetail->accommodation_price;
            $Total_p = $Trasportation_P + $Tourguide_p + $Hotels_p + $privateTour->profit_price;

            $no_of_days = $privateTour->number_of_days - 1;

            $package = Package::where('destination_id', $transportation_price->destination_id)
                ->whereHas('packageTitle', function ($query) use ($no_of_days) {
                    $query->where('no_days', $no_of_days);
                })
                ->first();

            $privateTour->update([
                "number_of_days" => $no_of_days,
                "transportation_price" => $Trasportation_P,
                "tourguide_price" => $Tourguide_p,
                "hotels_price" => $Hotels_p,
                "total_price" => $Total_p,
                "till" => $privateTour->till ? Carbon::parse($privateTour->till)->subDay() : null,

                "package_id" => $package->id,

            ]);


            RRoomCategory::where('private_tour_detail_id', $id)->delete();

            $privateTourDetail->delete();



            return ResponseHelper::Success(
                message: 'Last Day deleted successfully',
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    //10- Edit Private Tour Date
    public function edit_private_tour_date(EditChangeDateTour $request, $id)
    {
        try {
            // Fetch the private tour by ID
            $privateTour = PrivateTour::findOrFail($id);

            // Parse the 'from' date from the request
            $fromDate = Carbon::parse($request->from);

            // Calculate the 'till' date based on 'number_of_days'
            $numberOfDays = $privateTour->number_of_days - 1;
            $tillDate = $fromDate->clone()->addDays($numberOfDays);

            // Update the private tour
            $privateTour->update([
                "from" => $fromDate,
                "till" => $tillDate,
            ]);

            // Update related PrivateTourDetail dates
            $currentDate = $fromDate->clone();

            foreach ($privateTour->privateTourDetails as $tourDetail) {
                // Update each detail date and save
                $tourDetail->update([
                    'date' => $currentDate,
                ]);

                // Increment the date for the next day
                $currentDate->addDay();
            }

            return ResponseHelper::Success(
                message: 'Private Tour Dates Updated Successfully',
                data: $privateTour,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    //11- Edit Private Tour Day 
    public function edit_private_tour_day(EditDayTour $request)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Fetch the related private tour
            $privateTour = PrivateTour::findOrFail($request->private_tour_id);

            $accommodationPrice = 0;

            // Calculate the accommodation price based on the incoming data
            if ($request->with_accommodation && $request->has('r_room_categories') && is_array($request->r_room_categories)) {
                foreach ($request->r_room_categories as $category) {
                    $roomPrice = $category['room_price'] ?? 0;
                    $extraBedPrice = $category['extrabed_price'] ?? 0;
                    $accommodationPrice += $roomPrice + $extraBedPrice;
                }
            }

            if ($request->id) {
                // Update an existing PrivateTourDetail
                $privateTourDetail = PrivateTourDetail::findOrFail($request->id);

                $tourguidePrice = $privateTour->tourguide_price - $privateTourDetail->tourguide_price;
                $hotelsPrice = $privateTour->hotels_price - $privateTourDetail->accommodation_price;

                $privateTourDetail->update([
                    "city_id" => $request->city_id,
                    "day_tour_id" => $request->day_tour_id,
                    "with_accommodation" => $request->with_accommodation,
                    "accommodation_id" => $request->accommodation_id,
                    "tourguide" => $request->tourguide,
                    "tourguide_price" => $request->tourguide_price,
                    "accommodation_price" => $accommodationPrice,
                    "number_of_rooms" => $request->number_of_rooms,
                ]);

                // Delete all related rRoomCategories
                $privateTourDetail->rRoomCategories()->delete();
            } else {
                // Create a new PrivateTourDetail
                $privateTourDetail = PrivateTourDetail::create([
                    "private_tour_id" => $request->private_tour_id,
                    "city_id" => $request->city_id,
                    "day_tour_id" => $request->day_tour_id,
                    "with_accommodation" => $request->with_accommodation,
                    "accommodation_id" => $request->accommodation_id,
                    "tourguide" => $request->tourguide,
                    "tourguide_price" => $request->tourguide_price,
                    "accommodation_price" => $accommodationPrice,
                    "number_of_rooms" => $request->number_of_rooms,
                    "date" => Carbon::parse($request->date),  // Ensure the date is passed in the request
                ]);

                $tourguidePrice = $privateTour->tourguide_price;
                $hotelsPrice = $privateTour->hotels_price;
            }

            // Recreate the rRoomCategories with updated data
            if ($request->with_accommodation && $request->has('r_room_categories') && is_array($request->r_room_categories)) {
                foreach ($request->r_room_categories as $category) {
                    $roomCategory = new RRoomCategory([
                        'private_tour_detail_id' => $privateTourDetail->id,
                        'room_category_id' => $category['room_category_id'],
                        'extra_bed' => $category['extra_bed'],
                        'room_price' => $category['room_price'],
                        'extrabed_price' => $category['extrabed_price'],
                    ]);
                    $roomCategory->save();
                }
            }

            // Calculate transportation price adjustment
            $existingDaysCount = $privateTour->privateTourDetails()->count() - 1; // Number of existing days
            $transportationPricePerDay = $request->id ? 0 : $privateTour->transportation_price / $existingDaysCount;
            $adjustedTransportationPrice = $privateTour->transportation_price + $transportationPricePerDay;

            $package = null;

            $package = $request->number_of_days
                ? Package::whereHas('packageTitle', function ($query) use ($request) {
                    $query->where('no_days', $request->number_of_days);
                })->first()
                : Package::find($privateTour->package_id);

            $numberOfDays = $request->id ? $privateTour->number_of_days : $request->number_of_days;
            $till = $request->id ? $privateTour->till : Carbon::parse($request->date);

            // Update the private tour prices
            $privateTour->update([
                "package_id" => $package->id,
                "till" => $till,
                "number_of_days" => $numberOfDays,
                "tourguide_price" => $tourguidePrice + $request->tourguide_price,
                "hotels_price" => $hotelsPrice + $accommodationPrice,
                "transportation_price" => $adjustedTransportationPrice,
                "total_price" => $tourguidePrice + $request->tourguide_price
                    + $hotelsPrice + $accommodationPrice
                    + $adjustedTransportationPrice
                    + $privateTour->profit_price,
            ]);

            // Commit the transaction
            DB::commit();

            return ResponseHelper::Success(
                message: $request->id ? 'Private Tour Details Updated Successfully' : 'Day Tour Added Successfully',
                data: $privateTourDetail->load('rRoomCategories'), // Include related data in the response if needed
                statusCode: 200
            );
        } catch (Exception $e) {
            // Rollback transaction on error
            DB::rollBack();

            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }





}
