<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceLagerung extends Model
{
    use HasFactory;
    protected $fillable = [
        'lagerungStartDate',
        'lagerungEndDate',
        'lagerungVolume',
        'lagerungChf',
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
        'lagerungCost',
        'lagerungFixedCost',
        'lagerungPaid1',
        'lagerungPaid2',
        'lagerungTotalPrice',
    ];
}
