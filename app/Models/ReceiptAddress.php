<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'addressType',
        'line1',
        'line2',
    ];
    
    static function InfoAddress($id,$param)
    {
        $data = ReceiptAddress::where('id',$id)->first();
        return $data[$param];
    }
}

