<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceEinpack extends Model
{
    use HasFactory;
    protected $fillable = [
        'einpackDate',
        'einpackHour',
        'einpackChf',
        'einpackHour2',
        'einpackChf2',
        'einpackRoadChf',
        'extra1',
        'extra2',
        'extraText1',
        'extraValue1',
        'extraText2',
        'extraValue2',
        'discount',
        'discount2',
        'discountPercent',
        'extraDiscountText1',
        'extraDiscountValue1',
        'extraDiscountText2',
        'extraDiscountValue2',
        'einpackCost',
        'einpackFixedCost',
        'einpackPaid1',
        'einpackPaid2',
        'einpackPaid3',
        'einpackTotalPrice',
    ];
}
