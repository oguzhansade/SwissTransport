<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LagerungMailer extends Model
{
    use HasFactory;
    protected $fillable = [
        'customerId',
        'invoiceId',
        'lagerungId',
        'startDate',
        'startTime',
        'endDate',
        'endTime',
    ];
}
