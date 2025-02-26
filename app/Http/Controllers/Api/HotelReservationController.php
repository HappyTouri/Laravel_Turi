<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\HotelDocomentsRequest;
use App\Mail\CancelEmailMailable;
use App\Mail\SendEmailMailable;
use App\Models\ConfirmationPhoto;
use App\Models\InvoicePhoto;
use App\Models\PaymentPhoto;
use App\Models\PrivateTour;
use App\Models\PrivateTourDetail;
use Exception;
use Illuminate\Http\Request;
use Mail;

class HotelReservationController extends Controller
{
    public function send_email(Request $request)
    {
        try {
            $email = $request->accommodation['email'];
            Mail::to($email)->send(new SendEmailMailable($request));



            // Fetch the tours using the correct query
            $private_tour_Details = PrivateTourDetail::whereBetween('date', [$request->date, $request->till])
                ->where('accommodation_id', $request->accommodation_id)
                ->where('private_tour_id', $request->private_tour_id)
                ->get(); // Execute the query

            // Update each tour detail
            foreach ($private_tour_Details as $item) {
                $item->email_send = true; // Update status to "Email Sent"
                $item->email_note = $request->email_note;
                $item->save();
            }



            return ResponseHelper::Success(
                message: 'Email Send Successfully',
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function cancel_email(Request $request)
    {
        try {
            $email = $request->accommodation['email'];
            Mail::to($email)->send(new CancelEmailMailable($request));



            // Fetch the tours using the correct query
            $private_tour_Details = PrivateTourDetail::whereBetween('date', [$request->date, $request->till])
                ->where('accommodation_id', $request->accommodation_id)
                ->where('private_tour_id', $request->private_tour_id)
                ->get(); // Execute the query

            // Update each tour detail
            foreach ($private_tour_Details as $item) {
                $item->email_send = false; // Update status to "Email Sent"
                $item->email_note = $request->email_note;
                $item->invoice_price = 0;
                $item->payment_price = 0;
                $item->save();
            }



            return ResponseHelper::Success(
                message: 'Email Cancel Successfully',
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }


    public function add_confirmations(HotelDocomentsRequest $request)
    {
        try {
            if ($request->hasFile("confirmations")) {
                $files = $request->file("confirmations");
                foreach ($files as $file) {
                    $final_name = 'confirmation_Photo' . time() . '.' . $file->getClientOriginalName();
                    $request['private_tour_detail_id'] = $request->private_tour_detail_id;
                    $request['photo'] = $final_name;
                    $file->move(\public_path("/uploads"), $final_name);
                    ConfirmationPhoto::create($request->all());
                }
            }
            $data = ConfirmationPhoto::all()->where("private_tour_detail_id", $request->private_tour_detail_id);

            return ResponseHelper::Success(
                message: 'loaded Successfully',
                data: $data,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function add_invoices(HotelDocomentsRequest $request)
    {
        try {
            if ($request->hasFile("invoices")) {
                $files = $request->file("invoices");
                foreach ($files as $file) {
                    $final_name = 'invoice_Photo' . time() . '.' . $file->getClientOriginalName();
                    $request['private_tour_detail_id'] = $request->private_tour_detail_id;
                    $request['photo'] = $final_name;
                    $file->move(\public_path("/uploads"), $final_name);
                    InvoicePhoto::create($request->all());
                }
            }
            $data = InvoicePhoto::all()->where("private_tour_detail_id", $request->private_tour_detail_id);

            return ResponseHelper::Success(
                message: 'loaded Successfully',
                data: $data,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function add_payments(HotelDocomentsRequest $request)
    {
        try {
            if ($request->hasFile("payments")) {
                $files = $request->file("payments");
                foreach ($files as $file) {
                    $final_name = 'payment_Photo' . time() . '.' . $file->getClientOriginalName();
                    $request['private_tour_detail_id'] = $request->private_tour_detail_id;
                    $request['photo'] = $final_name;
                    $file->move(\public_path("/uploads"), $final_name);
                    PaymentPhoto::create($request->all());
                }
            }
            $data = PaymentPhoto::all()->where("private_tour_detail_id", $request->private_tour_detail_id);

            return ResponseHelper::Success(
                message: 'loaded Successfully',
                data: $data,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function delete_hotel_docoment(Request $request)
    {
        try {
            $type = $request->get('type'); // Accept the type of photo (passport or airticket)

            if ($type === 'confirmations') {
                $photo = ConfirmationPhoto::findOrFail($request->id);
            } elseif ($type === 'invoices') {
                $photo = InvoicePhoto::findOrFail($request->id);
            } elseif ($type === 'payments') {
                $photo = PaymentPhoto::findOrFail($request->id);
            } else {
                return ResponseHelper::Error(
                    message: 'Invalid photo type specified',
                    statusCode: 400
                );
            }

            // Delete the file from the uploads directory
            $filePath = public_path("/uploads/" . $photo->photo);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Delete the database record
            $photo->delete();

            return ResponseHelper::Success(
                message: 'Photo deleted successfully',
                data: null,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function set_invoice_price(Request $request)
    {
        try {
            // Fetch the tours using the correct query
            $private_tour_Details = PrivateTourDetail::whereBetween('date', [$request->date, $request->till])
                ->where('accommodation_id', $request->accommodation_id)
                ->where('private_tour_id', $request->private_tour_id)
                ->get(); // Execute the query

            // Update each tour detail
            foreach ($private_tour_Details as $item) {
                $item->invoice_price = $request->invoice_price;
                $item->save();
            }



            return ResponseHelper::Success(
                message: 'Invoice Price added Successfully',
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }


    public function set_payment_price(Request $request)
    {
        try {
            // Fetch the tours using the correct query
            $private_tour_Details = PrivateTourDetail::whereBetween('date', [$request->date, $request->till])
                ->where('accommodation_id', $request->accommodation_id)
                ->where('private_tour_id', $request->private_tour_id)
                ->get(); // Execute the query

            // Update each tour detail
            foreach ($private_tour_Details as $item) {
                $item->payment_price = $request->payment_price;
                $item->save();
            }



            return ResponseHelper::Success(
                message: 'Payment Price added Successfully',
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }


}
