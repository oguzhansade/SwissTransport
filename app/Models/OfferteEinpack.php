<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferteEinpack extends Model
{
    protected $fillable = [
        'tariff',
        'ma',
        'chf',
        'einpackDate',
        'einpackTime',
        'arrivalReturn',
        'moveHours',
        'extra',
        'extra1',
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
        'fixedPrice',
    ];
    use HasFactory;

    static function InfoEinpack($id,$param)
    {
        $data = OfferteEinpack::where('id',$id)->first();
        return $data[$param];
    }
}
