<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferteEntsorgung extends Model
{
    protected $fillable = [
        'volume',
        'volumeCHF',
        'fixedCost',
        'm3',
        'tariff',
        'ma',
        'lkw',
        'anhanger',
        'chf',
        'hour',
        'entsorgungDate',
        'entsorgungTime',
        'arrivalReturn',
        'entsorgungExtra1',
        'extraCostText1',
        'extraCostValue1',
        'extraCostText2',
        'extraCostValue2',
        'discount',
        'discountPercent',
        'extraDiscountText',
        'extraDiscountPrice',
        'costPrice',
        'defaultPrice',
        'topCost',
        'fixedPrice',
    ];
    use HasFactory;

    static function InfoEntsorgung($id,$param)
    {
        $data = OfferteEntsorgung::where('id',$id)->first();
        return $data[$param];
    }
}
