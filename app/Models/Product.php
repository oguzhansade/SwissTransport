<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    use HasFactory;

    

    static function InfoProduct($param,$param2)
    {
        $data = Product::where('id',$param)->first();
        return $data[$param2];
    }

    static function getProduct()
    {
        $data = Product::get();
        return $data;
    }

    static function productName($param)
    {
        $data = Product::where('id',$param)->first();
        return $data['productName'];
    }

    static function buyPrice($param)
    {
        $data = Product::where('id',$param)->first();
        return $data['buyPrice'];
    }

    

    static function rentPrice($param)
    {
        $data = Product::where('id',$param)->first();
        return $data['rentPrice'];
    }
}
