<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'state' ,
        'ticket_date',
        'ticket_type',
        'ticket_points',
        'existing_points',
        'existing_points_count',
        'ticket_received_city',
        'ticket_received_country',
        'ticket_received_state',
        'accident',
        'accident_description',
        'cdl_license',
        'full_name',
        'email',
        'phone_number',
        'ticket_ids',
        'response_deadline',
        'additional_details',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
