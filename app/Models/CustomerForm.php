<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerForm extends Model
{
    
    protected $fillable =[
        'customerName',
        'mail',
        'phone',
        'firma',
        'vonStreet',
        'vonPlz',
        'zimmer',
        'nachStreet',
        'nachPlz',
        'umzugDate',
        'vonEtage',
        'nachEtage',
        'vonLift',
        'nachLift',
        'extraService',
        'bemerkung',
        'type',
        'status',
        'customerId'
    ];
    use HasFactory;
}
