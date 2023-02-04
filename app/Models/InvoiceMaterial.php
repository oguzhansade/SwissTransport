<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceMaterial extends Model
{
    use HasFactory;
    protected $fillable = [
        'discount',
        'customDiscountText',
        'customDiscountValue',
        'deliverPrice',
        'recievePrice',
        'totalPrice'
    ];
}
