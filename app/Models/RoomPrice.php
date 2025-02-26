<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'accommodation_id',
        'accommodation_room_category_id',
        'season_id',
        'price'
    ];
    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }

    // Define the relationship to AccommodationRoomsCategory
    public function roomCategory()
    {
        return $this->belongsTo(AccommodationRoomsCategory::class, 'accommodation_rooms_category_id');
    }


    public function Season()
    {
        return $this->belongsTo(Season::class);
    }
}
