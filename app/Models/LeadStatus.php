<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadStatus extends Model
{
    use HasFactory;

    protected $table = 'lead_status'; // Explicitly define the table name

    protected $fillable = ['name'];

    /**
     * Relationships
     */
    public function leads()
    {
        return $this->hasMany(Lead::class, 'status_id');
    }
}
