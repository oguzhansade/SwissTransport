<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferteMaterial extends Model
{
    protected $fillable = [
        'discount',
        'discountPercent',
        'deliverPrice',
        'recievePrice',
        'totalPrice'
    ];
    use HasFactory;
    
    static function InfoMaterial($id,$param)
    {
        $data = OfferteMaterial::where('id',$id)->first();
        return $data[$param];
    }
}
