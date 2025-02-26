<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomCategory extends Model
{
    use HasFactory;
    public function accommodation_rooms_categories()
    {
        return $this->hasMany(AccommodationRoomsCategory::class);
    }
}
