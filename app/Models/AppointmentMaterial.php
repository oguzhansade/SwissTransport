<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentMaterial extends Model
{
    protected $fillable = [
        'deliverable',
        'deliveryType',
        'meetingDate',
        'meetingHour1',
        'meetingHour2',
        'address',
        'calendarTitle',
        'calendarContent',
        'customerId'
    ];

    use HasFactory;
}
