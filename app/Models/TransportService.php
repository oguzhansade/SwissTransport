<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportService extends Model
{
    
    protected $fillable = [
        'transportDate',
        'transportTime',
        'destination',
        'arrival',
        'workHours',
        'ma',
        'lkw',
        'anhanger',
        'calendarTitle',
        'calendarComment',
        'calendarLocation',
    ];
    use HasFactory;
}
