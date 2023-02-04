<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferVerify extends Model
{
    
    use HasFactory;

    public $table = "offer_verifies";

    protected $fillable = [
        'offerId',
        'oToken',
    ];

    static function getToken($id)
    {
        $data = OfferVerify::where('offerId',$id)->first();
        return $data['oToken'];
    }

    public function offerte()
    {
        return $this->belongsTo(offerte::class);
    }

    
}
