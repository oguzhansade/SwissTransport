<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptReinigung extends Model
{
    use HasFactory;
    protected $fillable = [
        'customerId',
        'offerId',
        'receiptType',
        'payType',
        'status',
        'customerGender',
        'customerName',
        'customerStreet',
        'customerAddress',
        'customerPhone',
        'reinigungStreet',
        'reinigungAddress',
        'reinigungDate',
        'reinigungTime',
        'endDate',
        'endTime',
        'reinigungType',
        'reinigungExtraText',
        'extraReinigung',
        'fixedPrice',
        'reinigungHours',
        'reinigungChf',
        'reinigungPrice',
        'receiptExtraId',
        'receiptDiscountId',
        'totalPrice',
        'withTax',
        'withoutTax',
        'freeTax',
        'inBar',
        'inRechnung',
        'cashPrice',
        'invoicePrice',
        'signerName',
        'docTaken'
    ];
}
