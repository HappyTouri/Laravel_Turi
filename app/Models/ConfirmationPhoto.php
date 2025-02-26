<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfirmationPhoto extends Model
{

    protected $fillable = [
        'private_tour_detail_id',
        'photo',
    ];


    public function privateTourDetail()
    {
        return $this->belongsToMany(PrivateTourDetail::class);
    }
}
