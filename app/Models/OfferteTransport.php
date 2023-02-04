<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferteTransport extends Model
{
    protected $fillable = [
        'pdfText',
        'fixedChf',
        'tariff',
        'ma',
        'lkw',
        'anhanger',
        'chf',
        'hour',
        'transportDate',
        'transportTime',
        'arrivalReturn',
        'extraCostText1',
        'extraCostValue1',
        'extraCostText2',
        'extraCostValue2',
        'extraCostText3',
        'extraCostValue3',
        'extraCostText4',
        'extraCostValue4',
        'extraCostText5',
        'extraCostValue5',
        'extraCostText6',
        'extraCostValue6',
        'extraCostText7',
        'extraCostValue7',
        'totalPrice',
        'discount',
        'discountPercent',
        'compromiser',
        'extraDiscountText',
        'extraDiscountValue',
        'extraDiscountText2',
        'extraDiscountValue2',
        'defaultPrice',
        'topCost',
        'fixedPrice',
    ];
    use HasFactory;
    static function InfoTransport($id,$param)
    {
        $data = OfferteTransport::where('id',$id)->first();
        return $data[$param];
    }
}
