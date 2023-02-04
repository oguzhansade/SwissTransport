<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'contactType',
        'address',
        'date',
        'time',
        'calendarTitle',
        'calendarContent',
        'customerId'
    ];
    use HasFactory;
}
