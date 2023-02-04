<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offerteAddress extends Model
{
    protected $fillable = [
        'addressType',
        'street',
        'postCode',
        'city',
        'country',
        'buildType',
        'floor',
        'lift'
    ];
    use HasFactory;

    static function InfoAdress($id,$param)
    {
        $data = offerteAddress::where('id',$id)->first();
        return $data[$param];
    }
}
