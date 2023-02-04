<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceBasket extends Model
{
    use HasFactory;
    protected $fillable = [
        'productId',
        'buyType',
        'productPrice',
        'quantity',
        'totalPrice',
        'materialId'
    ];

    static function getBasket($id)
    {
        $data = InvoiceBasket::where('materialId',$id)->get();
        return $data;
    }

    static function infoBasket($id,$param)
    {
        $data = InvoiceBasket::where('materialId',$id)->first();
        return $data[$param];
    }
}
