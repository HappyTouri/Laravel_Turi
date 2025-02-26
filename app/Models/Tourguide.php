<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tourguide extends Model
{
    use HasFactory;
    protected $fillable = [
        'destination_id',
        'city_id',
        'name',
        'mobile',
        'email',
        'note',
        'price_per_day',
        'status',
        'rate',
        'date_of_birth',
        'photo',
    ];
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function cooperator()
    {
        return $this->belongsTo(Cooperator::class);
    }

    public function privateTourDetails()
    {
        return $this->hasMany(PrivateTourDetail::class);
    }
}
