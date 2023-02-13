<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EinpackService extends Model
{
    protected $fillable = [
        'einpackDate',
        'einpackTime',
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
