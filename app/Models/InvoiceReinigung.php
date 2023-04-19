<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceReinigung extends Model
{
    use HasFactory;
    protected $fillable = [
        'reinigungDate',
        'reinigungType',
        'extraReinigung',
        'reinigungRoom',
        'reinigungFixedPrice',
        'reinigungHours',
        'reinigungChf',
        'extra1',
        'extra2',
        'extra3',
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
        'reinigungCost',
        'reinigungPaid1',
        'reinigungPaid2',
        'reinigungPaid3',
        'reinigungTotalPrice'
    ];
}
