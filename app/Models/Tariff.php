<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    protected $guarded = [];
    use HasFactory;

    static function getList($type)
    {
        $list = Tariff::where('tariffType',$type)->get();
        return $list;
    }

    static function InfoTariff($id)
    {
        $data = Tariff::where('id',$id)->first();
        return $data['description'];
    }

    static function getTariff($id,$param)
    {
        $data = Tariff::where('id',$id)->first();
        return $data[$param];
    }
}
