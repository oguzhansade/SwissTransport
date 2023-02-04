<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceAuspack extends Model
{
    use HasFactory;
    protected $fillable = [
        'auspackDate',
        'auspackHour',
        'auspackChf',
        'auspackHour2',
        'auspackChf2',
        'auspackRoadChf',
        'extra1',
        'extra2',
        'extraText1',
        'extraValue1',
        'extraText2',
        'extraValue2',
        'discount',
        'discount2',
        'extraDiscountText1',
        'extraDiscountValue1',
        'extraDiscountText2',
        'extraDiscountValue2',
        'auspackCost',
        'auspackFixedCost',
        'auspackPaid1',
        'auspackPaid2',
        'auspackPaid3',
        'auspackTotalPrice',
    ];
}
