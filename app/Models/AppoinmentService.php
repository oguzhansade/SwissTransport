<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppoinmentService extends Model
{
    
    protected $fillable = [
        'paymentType',
        'address',
        'calendarTitle',
        'calendarContent',
        'customerId',
        'umzugId',
        'umzug2Id',
        'umzug3Id',
        'einpackId',
        'auspackId',
        'reinigungId',
        'reinigung2Id',
        'entsorgungId',
        'transportId',
        'lagerungId'
    ];
    use HasFactory;
}
