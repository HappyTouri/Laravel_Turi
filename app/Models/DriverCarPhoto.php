<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverCarPhoto extends Model
{
    use HasFactory;

    protected $fillable = [

        'driver_id',      // Foreign key to the Driver model
        'car_photo',     // Path of the photo
        // Add any other columns that need to be mass assignable
    ];
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
