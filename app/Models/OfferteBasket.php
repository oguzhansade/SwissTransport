<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferteBasket extends Model
{
    protected $fillable = [
        'productId',
        'buyType',
        'productPrice',
        'quantity',
        'totalPrice',
        'materialId'
    ];
    use HasFactory;

    static function getBasket($id)
    {
        $data = OfferteBasket::where('materialId',$id)->get();
        return $data;
    }

    static function infoBasket($id,$param)
    {
        $data = OfferteBasket::where('materialId',$id)->first();
        return $data[$param];
    }
}
