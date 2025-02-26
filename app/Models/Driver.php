<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'city_id',
        'trabsportationType_id',
        'destination_id',
        'carModel',
        'numberOfSeats',
        'note',
        'pricePerDay',
        'rate',
    ];
    public function transportationType()
    {
        return $this->belongsTo(TransportationType::class, 'trabsportationType_id'); // Correct if necessary
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }


    public function driverCarPhotos()
    {
        return $this->hasMany(DriverCarPhoto::class);
    }


    public function cooperator()
    {
        return $this->belongsTo(Cooperator::class);
    }





}
