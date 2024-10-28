<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferteUmzug extends Model
{
    protected $fillable = [
        'tariff',
        'ma',
        'lkw',
        'anhanger',
        'chf',
        'moveDate',
        'moveTime',
        'moveDate2',
        'arrivalGas',
        'returnGas',
        'montage',
        'moveHours',
        'extra',
        'extra1',
        'extra2',
        'extra3',
        'extra4',
        'extra5',
        'extra5',
        'extra6',
        'extra7',
        'extra8',
        'extra9',
        'extra10',
        'customCostName1',
        'customCostPrice1',
        'customCostName2',
        'customCostPrice2',
        'costPrice',
        'discount',
        'discountPercent',
        'compromiser',
        'extraCostName',
        'extraCostPrice',
        'defaultPrice',
        'topCost',
        'fixedPrice'
    ];
    use HasFactory;

    static function InfoUmzug($id,$param)
    {
        $data = OfferteUmzug::where('id',$id)->first();
        if($data) {
            return $data[$param];
        }

    }

    static function getHour($id)
    {
        $data = OfferteUmzug::where('id',$id)->first();
        if($data) {
            return $data['moveHours'];
        }

    }
}
