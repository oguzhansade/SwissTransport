<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offerte extends Model
{
    protected $fillable = [
        'customerId',
        'mainOfferteId',
        'appType',
        'auszugaddressId',
        'auszugaddressId2',
        'auszugaddressId3',
        'einzugaddressId',
        'einzugaddressId2',
        'einzugaddressId3',
        'offerteUmzugId',
        'offerteEinpackId',
        'offerteAuspackId',
        'offerteReinigungId',
        'offerteReinigung2Id',
        'offerteEntsorgungId',
        'offerteTransportId',
        'offerteLagerungId',
        'offerteMaterialId',
        'offerteNote',
        'panelNote',
        'kostenInkl',
        'kostenExkl',
        'kostenFrei',
        'contactPerson',
        'offerteStatus',
        'isOfferVerified'
    ];

    protected $casts = [
        'offer_verified_at' => 'datetime',
    ];
    static function getUmzugId($id)
    {
        if($id){
            $data = offerte::where('id',$id)->first();
            return $data['offerteUmzugId'];
        }
        
    }
    use HasFactory;
}
