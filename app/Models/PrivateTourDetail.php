<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivateTourDetail extends Model
{
    protected $fillable = [
        'private_tour_id',
        'date',
        'tour_id',
        'city_id',
        'day_tour_id',
        'tourguide',
        'with_accommodation',
        'accommodation_id',
        'accommodation_price',
        'number_of_rooms',
        'tourguide_price',
        'tourguide_id',
        'tourguide_deal_price',
        'number_of_room',
        'email_send',
        'invoice_prive',
        'payment_prive'
    ];
    public function privateTour()
    {
        return $this->belongsTo(PrivateTour::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }

    public function dayTour()
    {
        return $this->belongsTo(Tour::class, 'day_tour_id', 'id');
    }

    public function tourguidee()
    {
        return $this->belongsTo(Tourguide::class, 'tourguide_id', 'id');
    }

    public function rRoomCategories()
    {
        return $this->hasMany(RRoomCategory::class);
    }



    public function confirmationPhotos()
    {
        return $this->hasMany(ConfirmationPhoto::class, 'private_tour_detail_id', 'id');
    }

    public function invoicePhotos()
    {
        return $this->hasMany(InvoicePhoto::class);
    }

    public function paymentPhotos()
    {
        return $this->hasMany(PaymentPhoto::class);
    }

}
