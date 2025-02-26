<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en',
        'title_ru',
        'title_ar',
        'title_local',
        'description_en',
        'description_ru',
        'description_ar',
        'description_local',
        'destination_id',
        'city_id',
    ];
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }


    public function tour_photos()
    {
        return $this->hasMany(TourPhoto::class);
    }

}
