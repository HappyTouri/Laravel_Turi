<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportationType extends Model
{
    use HasFactory;
    public function transportationPrices()
    {
        return $this->hasMany(TransportationPrice::class);
    }
    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }
    public function privateTour()
    {
        return $this->hasMany(PrivateTour::class);
    }
}
