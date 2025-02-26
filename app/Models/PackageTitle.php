<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageTitle extends Model
{
    use HasFactory;
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }


    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}
