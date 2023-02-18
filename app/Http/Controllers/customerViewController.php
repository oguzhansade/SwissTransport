<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\OfferCustomerView;
use App\Models\offerte;
use App\Models\offerteAddress;
use App\Models\OfferteAuspack;
use App\Models\OfferteBasket;
use App\Models\OfferteEinpack;
use App\Models\OfferteEntsorgung;
use App\Models\OfferteLagerung;
use App\Models\OfferteMaterial;
use App\Models\OfferteReinigung;
use App\Models\OfferteTransport;
use App\Models\OfferteUmzug;
use App\Models\OfferVerify;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class customerViewController extends Controller
{
    public function customerOfferView(Request $request)
    { 
        $token = $request->route('token');
        $verifyOffer = OfferCustomerView::where('zToken',$token)->first();

        if($verifyOffer){
            $offer = offerte::where('id',$verifyOffer['offerId'])->first();
           
            if($offer){
                $customerData =  Customer::where('id',$offer['customerId'])->first();
                $auszug1 = offerteAddress::where('id',$offer['auszugaddressId'])->first();
                $auszug2 = offerteAddress::where('id',$offer['auszugaddressId2'])->first();
                $auszug3 = offerteAddress::where('id',$offer['auszugaddressId3'])->first();
                $einzug1 = offerteAddress::where('id',$offer['einzugaddressId'])->first();
                $einzug2 = offerteAddress::where('id',$offer['einzugaddressId2'])->first();
                $einzug3 = offerteAddress::where('id',$offer['einzugaddressId3'])->first();
                $umzugPdf = OfferteUmzug::where('id',$offer['offerteUmzugId'])->first();
                $einpackPdf = OfferteEinpack::where('id',$offer['offerteEinpackId'])->first();
                $auspackPdf = OfferteAuspack::where('id',$offer['offerteAuspackId'])->first();
                $reinigungPdf = OfferteReinigung::where('id',$offer['offerteReinigungId'])->first();
                $reinigungPdf2 = OfferteReinigung::where('id',$offer['offerteReinigung2Id'])->first();
                $entsorgungPdf = OfferteEntsorgung::where('id',$offer['offerteEntsorgungId'])->first();
                $transportPdf = OfferteTransport::where('id',$offer['offerteTransportId'])->first();
                $lagerungPdf = OfferteLagerung::where('id',$offer['offerteLagerungId'])->first();
                $materialPdf = OfferteMaterial::where('id',$offer['offerteMaterialId'])->first();
                $basketPdf = OfferteBasket::where('materialId',$offer['offerteMaterialId'])->get()->toArray();
                $oToken = OfferVerify::where('offerId',$offer['id'])->first();

                return view('front.customerPdfView.index',
                [
                    'offer' => $offer,
                    'token' =>$token,
                    'oToken' => $oToken['oToken'],
                    'customer' => $customerData,
                    'isUmzug' => $offer['offerteUmzugId'],
                    'isEinpack' => $offer['offerteEinpackId'],
                    'isAuspack' => $offer['offerteAuspackId'],
                    'isReinigung' => $offer['offerteReinigungId'],
                    'isReinigung2' => $offer['offerteReinigung2Id'],
                    'isEntsorgung' => $offer['offerteEntsorgungId'],
                    'isTransport' => $offer['offerteTransportId'],
                    'isLagerung' => $offer['offerteLagerungId'],
                    'isMaterial' => $offer['offerteMaterialId'],
                    'auszug1' => $auszug1,
                    'auszug2' => $auszug2,
                    'auszug3' => $auszug3,
                    'einzug1' => $einzug1,
                    'einzug2' => $einzug2,
                    'einzug3' => $einzug3,
                    'umzug' => $umzugPdf,
                    'einpack' => $einpackPdf,
                    'auspack' => $auspackPdf,
                    'reinigung' => $reinigungPdf,
                    'reinigung2' => $reinigungPdf2,
                    'entsorgung' => $entsorgungPdf,
                    'transport' => $transportPdf,
                    'lagerung' => $lagerungPdf,
                    'material' => $materialPdf,
                    'basket' => $basketPdf,
                ]);
            }
            else
            {
                return view('front.errorPage');
            }
        }
    }

    public function showPdf($token)
    {
            $id = OfferCustomerView::where('zToken',$token)->first();
            $offer = offerte::where('id',$id['offerId'])->first();
            $customerData =  Customer::where('id',$offer['customerId'])->first();
            $auszug1 = offerteAddress::where('id',$offer['auszugaddressId'])->first();
            $auszug2 = offerteAddress::where('id',$offer['auszugaddressId2'])->first();
            $auszug3 = offerteAddress::where('id',$offer['auszugaddressId3'])->first();
            $einzug1 = offerteAddress::where('id',$offer['einzugaddressId'])->first();
            $einzug2 = offerteAddress::where('id',$offer['einzugaddressId2'])->first();
            $einzug3 = offerteAddress::where('id',$offer['einzugaddressId3'])->first();
            $umzugPdf = OfferteUmzug::where('id',$offer['offerteUmzugId'])->first();
            $einpackPdf = OfferteEinpack::where('id',$offer['offerteEinpackId'])->first();
            $auspackPdf = OfferteAuspack::where('id',$offer['offerteAuspackId'])->first();
            $reinigungPdf = OfferteReinigung::where('id',$offer['offerteReinigungId'])->first();
            $reinigungPdf2 = OfferteReinigung::where('id',$offer['offerteReinigung2Id'])->first();
            $entsorgungPdf = OfferteEntsorgung::where('id',$offer['offerteEntsorgungId'])->first();
            $transportPdf = OfferteTransport::where('id',$offer['offerteTransportId'])->first();
            $lagerungPdf = OfferteLagerung::where('id',$offer['offerteLagerungId'])->first();
            $materialPdf = OfferteMaterial::where('id',$offer['offerteMaterialId'])->first();
            $basketPdf = OfferteBasket::where('materialId',$offer['offerteMaterialId'])->get()->toArray();

            $pdfData = [
                'offerteNumber' => $offer['id'] ,
                'offer' => $offer,
                'customer' => $customerData,
                'isUmzug' => $offer['offerteUmzugId'],
                'isEinpack' => $offer['offerteEinpackId'],
                'isAuspack' => $offer['offerteAuspackId'],
                'isReinigung' => $offer['offerteReinigungId'],
                'isReinigung2' => $offer['offerteReinigungId2'],
                'isEntsorgung' => $offer['offerteEntsorgungId'],
                'isTransport' => $offer['offerteTransportId'],
                'isLagerung' => $offer['offerteLagerungId'],
                'isMaterial' => $offer['offerteMaterialId'],
                'auszug1' => $auszug1,
                'auszug2' => $auszug2,
                'auszug3' => $auszug3,
                'einzug1' => $einzug1,
                'einzug2' => $einzug2,
                'einzug3' => $einzug3,
                'umzug' => $umzugPdf,
                'einpack' => $einpackPdf,
                'auspack' => $auspackPdf,
                'reinigung' => $reinigungPdf,
                'reinigung2' => $reinigungPdf2,
                'entsorgung' => $entsorgungPdf,
                'transport' => $transportPdf,
                'lagerung' => $lagerungPdf,
                'material' => $materialPdf,
                'basket' => $basketPdf,
            ];
            
            $pdf = Pdf::loadView('offerPdf', $pdfData);
            return $pdf->stream();
    }
}
