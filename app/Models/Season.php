<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'extra_bed',
        'accommodation_id'
    ];
    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }

    public function roomPrices()
    {
        return $this->hasMany(RoomPrice::class);
    }
}
