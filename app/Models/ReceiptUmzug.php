<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptUmzug extends Model
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
        'customerMail',
        'auszugId1',
        'auszugId2',
        'auszugId3',
        'einzugId1',
        'einzugId2',
        'einzugId3',
        'receiptExtraId',
        'receiptDiscountId',
        'orderDate',
        'orderTime',
        'umzugHour',
        'umzugChf',
        'umzugTotalChf',
        'umzugCharge',
        'umzugRoadChf',
        'materialPrice',
        'entsorgungVolume',
        'entsorgungChf',
        'entsorgungTotalChf',
        'entsorgungFixedChf',
        'fixedPrice',
        'topPrice',
        'totalPrice',
        'withTax',
        'withoutTax',
        'freeTax',
        'inBar',
        'inRechnung',
        'cashPrice',
        'invoicePrice',
        'signerName',
        'expensePrice',
        'docTaken'
    ];

    public function offerte() {
        return $this->belongsTo(offerte::class, 'offerId', 'id');
    }
}
