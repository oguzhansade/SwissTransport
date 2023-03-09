<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $fillable = [
        'appType',
        'serviceType',
        'serviceId',
        'eventId'
    ];
    use HasFactory;
}
