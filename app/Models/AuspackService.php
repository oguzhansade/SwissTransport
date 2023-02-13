<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuspackService extends Model
{
    protected $fillable = [
        'auspackDate',
        'auspackTime',
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
