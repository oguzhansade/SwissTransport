<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferteAuspack extends Model
{
    protected $fillable = [
        'tariff',
        'ma',
        'chf',
        'auspackDate',
        'auspackTime',
        'arrivalGas',
        'returnGas',
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

    static function InfoAuspack($id,$param)
    {
        $data = OfferteAuspack::where('id',$id)->first();
        return $data[$param];
    }
}
