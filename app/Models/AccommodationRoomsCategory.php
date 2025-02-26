<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommodationRoomsCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'accommodation_id',
        'room_category_id',
    ];
    public function room_category()
    {
        return $this->belongsTo(RoomCategory::class);
    }



    public function accommodations()
    {
        return $this->belongsToMany(Accommodation::class, 'room_prices')
            ->withPivot('price', 'season_id');
    }


    public function roomPrices()
    {
        return $this->hasMany(RoomPrice::class, 'accommodation_rooms_category_id');
    }


}
