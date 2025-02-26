<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    public function photos()
    {
        return $this->hasMany(DestinationPhoto::class);
    }

    public function videos()
    {
        return $this->hasMany(DestinationVideo::class);
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function accommodations()
    {
        return $this->hasMany(Accommodation::class);
    }

    public function transportationPrices()
    {
        return $this->hasMany(TransportationPrice::class);
    }
    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }
    public function tourguides()
    {
        return $this->hasMany(Tourguide::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function cooperators()
    {
        return $this->hasMany(Cooperator::class);
    }

    public function tourguidePrice()
    {
        return $this->hasOne(TourguidePrice::class);
    }




}
