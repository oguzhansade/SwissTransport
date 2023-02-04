<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceEntsorgung extends Model
{
    use HasFactory;
    protected $fillable = [
        'entsorgungDate',
        'entsorgungVolume',
        'entsorgungFixedChf',
        'entsorgungFixedChfCost',
        'entsorgungHours',
        'entsorgungChf',
        'entsorgungRoadChf',
        'extra1',
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
        'entsorgungCost',
        'entsorgungFixedCost',
        'entsorgungPaid1',
        'entsorgungPaid2',
        'entsorgungTotalPrice',
    ];
}
