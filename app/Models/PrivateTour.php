<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivateTour extends Model
{

    protected $fillable = [
        'cooperator_id',
        'tour_name',
        'website',
        'reserved',
        'tour_title_id',
        'package_id',
        'transportation_id',
        'from',
        'till',
        'number_of_days',
        'transportation_price',
        'tourguide_price',
        'hotels_price',
        'profit_price',
        'total_price',
        'logo',
        'driver_price',
        'reserved',
        'number_of_people',
        'note',
        'user_id',
        'driver_id',
        'driver_price',
        'my_offer',
        'status',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function tourTitle()
    {
        return $this->belongsTo(TourTitle::class, 'tour_title_id', 'id');
    }

    public function transportation()
    {
        return $this->belongsTo(TransportationType::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function cooperator()
    {
        return $this->belongsTo(Cooperator::class, 'cooperator_id', 'id');
    }
    public function privateTourDetails()
    {
        return $this->hasMany(PrivateTourDetail::class);
    }

    public function passportPhotos()
    {
        return $this->hasMany(PassportPhoto::class);
    }

    public function airticketPhotos()
    {
        return $this->hasMany(AirticketPhoto::class);
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }

}
