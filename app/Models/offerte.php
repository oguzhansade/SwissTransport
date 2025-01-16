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
        'offerPrice',
        'offerteNote',
        'panelNote',
        'kostenInkl',
        'kostenExkl',
        'kostenFrei',
        'contactPerson',
        'offerteStatus',
        'isOfferVerified',
        'isCampaign',
        'emailSent'
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

    public function receiptUmzug()
    {
        return $this->hasMany(ReceiptUmzug::class, 'offerId', 'id')->onDelete('cascade');;
    }
    public function receiptReinigung()
    {
        return $this->hasMany(ReceiptReinigung::class, 'offerId', 'id')->onDelete('cascade');;
    }

    use HasFactory;
}
