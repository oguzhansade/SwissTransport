<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'customerId',
        'payCondition',
        'status',
        'street',
        'ort',
        'plz',
        'land',
        'expiryDate',
        'umzugId',
        'einpackId',
        'auspackId',
        'reinigungId',
        'reinigung2Id',
        'entsorgungId',
        'transportId',
        'lagerungId',
        'materialId',
        'warningPrice',
        'totalPrice',
        'withTax',
        'withoutTax',
        'freeTax'
    ];
}
