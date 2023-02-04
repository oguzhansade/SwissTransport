<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferteReinigung extends Model
{
    protected $fillable = [
        'reinigungType',
        'extraReinigung',
        'fixedTariff',
        'fixedTariffPrice',
        'standartTariff',
        'ma',
        'chf',
        'hours',
        'extraService1',
        'extraService2',
        'startDate',
        'startTime',
        'endDate',
        'endTime',
        'extra1',
        'extra2',
        'extra3',
        'extraCostText1',
        'extraCostValue1',
        'extraCostText2',
        'extraCostValue2',
        'discountText',
        'discount',
        'discountPercent',
        'totalPrice',
    ];
    use HasFactory;

    static function InfoReinigung($id,$param)
    {
        $data = OfferteReinigung::where('id',$id)->first();
        return $data[$param];
    }

}
