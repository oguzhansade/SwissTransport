<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReinigungService extends Model
{
    protected $fillable = [
        'reinigungStartDate',
        'reinigungStartTime',
        'reinigungEndDate',
        'reinigungEndTime',
        'calendarTitle',
        'calendarComment',
        'calendarLocation',
    ];
    use HasFactory;
}
