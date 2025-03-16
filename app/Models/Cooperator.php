<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Cooperator extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'phone',
        'agent_name',
        'country',
        'address',
        'city',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'linkedin',
        'logo', // For logo image
        'photo', // For photo image
        'rule_id', // If cooperator has a specific role/rule
        'website', // For website field if it exists

    ];


    protected $hidden = [
        'password',

    ];


    public function rule()
    {
        return $this->belongsTo(Rule::class);
    }
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    public function tourguide()
    {
        return $this->belongsTo(Tourguide::class);
    }

    public function privateTour()
    {
        return $this->hasMany(PrivateTour::class);
    }

    public function leads()
    {
        return $this->hasMany(Lead::class, 'cooperator_id');
    }






}
