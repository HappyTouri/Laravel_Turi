<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }


    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function privateTourDetails()
    {
        return $this->hasMany(PrivateTourDetail::class);
    }
    public function accommodations()
    {
        return $this->hasMany(Accommodation::class);
    }

    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }

    public function tourguides()
    {
        return $this->hasMany(Tourguide::class);
    }

}
