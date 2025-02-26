<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportationPrice extends Model
{
    use HasFactory;
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function transportationType()
    {
        return $this->belongsTo(TransportationType::class, 'type_id');
    }
}
