<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceUmzug extends Model
{
    use HasFactory;
    protected $fillable = [
        'umzugDate',
        'umzugHour',
        'umzugChf',
        'umzugHour2',
        'umzugChf2',
        'umzugRoadChf',
        'extra1',
        'extra2',
        'extra3',
        'extra4',
        'extra5',
        'extra6',
        'extra7',
        'extra8',
        'extra9',
        'extra10',
        'extra11',
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
        'umzugCost',
        'umzugFixedCost',
        'umzugPaid1',
        'umzugPaid2',
        'umzugPaid3',
        'umzugTotalPrice',
    ];
}
