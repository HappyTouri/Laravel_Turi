<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;
    protected $fillable = [
        'destination_id',
        'name',
        'accommodation_type',
        'city_id',
        'phone',
        'email',
        'address',
        'note',
        'rate',
        'hotel_website',
        'video_link',
        'share'
    ];
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function photos()
    {
        return $this->hasMany(AccommodationPhoto::class);
    }
    public function accommodation_rooms_categories()
    {
        return $this->hasMany(AccommodationRoomsCategory::class);
    }


    public function privateTourDetails()
    {
        return $this->hasMany(PrivateTourDetail::class);
    }


    public function seasons()
    {
        return $this->hasMany(Season::class);
    }
    // public function roomCategories()
    // {
    //     return $this->hasMany(AccommodationRoomsCategory::class);
    // }
    public function roomCategories()
    {
        return $this->belongsToMany(AccommodationRoomsCategory::class, 'accommodation_rooms_categories');
    }

    public function roomPrices()
    {
        return $this->hasMany(RoomPrice::class);
    }

    public function cooperator()
    {
        return $this->belongsTo(Cooperator::class);
    }





}
