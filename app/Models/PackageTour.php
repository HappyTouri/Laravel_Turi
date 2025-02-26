<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageTour extends Model
{
    use HasFactory;
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function bookings()
    {
        return $this->belongsTo(Booking::class);
    }



}
