<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptExtra extends Model
{
    use HasFactory;
    protected $fillable = [
        'extra1Text',
        'extra1',
        'extra2Text',
        'extra2',
        'extra3Text',
        'extra3',
        'extra4Text',
        'extra4',
        'extra5Text',
        'extra5',
        'extra6Text',
        'extra6',
        'extra7Text',
        'extra7',
        'extra8Text',
        'extra8',
        'extra9Text',
        'extra9',
        'extra10Text',
        'extra10',
        'extra11Text',
        'extra11',
        'extra12Text',
        'extra12',
        'extra13Text',
        'extra13',
        'extra14Text',
        'extra14',
        'extra15Text',
        'extra15',
        'extra16Text',
        'extra16',
    ];

    static function InfoExtra($id,$param)
    {
        $data = ReceiptExtra::where('id',$id)->first();
        return $data[$param];
    }
}
