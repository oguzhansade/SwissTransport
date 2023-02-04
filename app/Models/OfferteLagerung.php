<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferteLagerung extends Model
{
    protected $fillable = [
        'tariff',
        'chf',
        'volume',
        'extraCostText1',
        'extraCostValue1',
        'extraCostText2',
        'extraCostValue2',
        'discountText',
        'discountValue',
        'discountPercent',
        'totalPrice',
        'fixedPrice',
    ];
    use HasFactory;

    static function InfoLagerung($id,$param)
    {
        $data = OfferteLagerung::where('id',$id)->first();
        return $data[$param];
    }
}
