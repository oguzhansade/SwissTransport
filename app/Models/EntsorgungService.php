<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntsorgungService extends Model
{
    protected $fillable = [
        'entsorgungDate',
        'entsorgungTime',
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
