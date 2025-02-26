<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RRoomCategory extends Model
{
    protected $fillable = [
        'private_tour_detail_id',
        'room_category_id',
        'extra_bed',
        'room_price',
        'extrabed_price'
    ];
    public function privateTourDetail()
    {
        return $this->belongsTo(PrivateTourDetail::class);
    }

    public function accommodationRoomsCategory()
    {
        return $this->belongsTo(AccommodationRoomsCategory::class, 'room_category_id', 'id');
    }



}
