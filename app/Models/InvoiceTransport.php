<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceTransport extends Model
{
    use HasFactory;
    protected $fillable = [
        'pdfText',
        'transportDate',
        'transportFixedTariff',
        'transportHours',
        'transportChf',
        'transportHours2',
        'transportChf2',
        'transportRoadChf',
        'extraText1',
        'extraValue1',
        'extraText2',
        'extraValue2',
        'extraText3',
        'extraValue3',
        'extraText4',
        'extraValue4',
        'extraText5',
        'extraValue5',
        'extraText6',
        'extraValue6',
        'extraText7',
        'extraValue7',
        'discount',
        'discount2',
        'discountPercent',
        'extraDiscountText1',
        'extraDiscountValue1',
        'extraDiscountText2',
        'extraDiscountValue2',
        'transportCost',
        'transportFixedCost',
        'transportPaid1',
        'transportPaid2',
        'transportPaid3',
        'transportTotalPrice',
    ];
}
