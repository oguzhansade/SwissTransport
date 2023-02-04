<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptDiscount extends Model
{
    use HasFactory;
    protected $fillable = [
        'discount1Text',
        'discount1',
        'discount2Text',
        'discount2',
        'discount3Text',
        'discount3',
        'discount4Text',
        'discount4',
        'discount5Text',
        'discount5',
        'discount6Text',
        'discount6',
        'discount7Text',
        'discount7',
    ];

    static function InfoDiscount($id,$param)
    {
        $data = ReceiptDiscount::where('id',$id)->first();
        return $data[$param];
    }
}

