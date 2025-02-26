<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AirticketPhoto extends Model
{

    protected $fillable = [
        'private_tour_id',
        'photo',

    ];
    public function privateTour()
    {
        return $this->belongsTo(PrivateTour::class);
    }
}
