<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $table = 'leads'; // Explicitly define the table name

    protected $fillable = [
        'cooperator_id',
        'offer_id',
        'private_tour_id',
        'lead_name',
        'phone_number',
        'name',
        'number_of_person',
        'number_of_days',
        'customer_note',
        'from',
        'till',
        'arrive_to',
        'departure_from',
        'country',
        'nationality',
        'airticket',
        'accommodation',
        'tour',
        'follow_up',
        'status_id',
        'confirm',
        'archived'
    ];

    /**
     * Relationships
     */
    public function status()
    {
        return $this->belongsTo(LeadStatus::class, 'status_id');
    }

    public function cooperator()
    {
        return $this->belongsTo(Cooperator::class, 'cooperator_id');
    }

    public function privateTour()
    {
        return $this->belongsTo(PrivateTour::class, 'private_tour_id');
    }
}
