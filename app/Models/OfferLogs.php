<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferLogs extends Model
{
    protected $fillable = [
        'offerId',
        'serviceType',
        'inputName',
        'oldValue',
        'newValue',
        'userName'
    ];
    use HasFactory;
}
