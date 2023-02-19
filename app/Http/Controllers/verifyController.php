<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Customer;
use App\Models\offerte;
use App\Models\OfferVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class verifyController extends Controller
{
 
  
    public function acceptOffer(Request $request)
    { 
        $token = $request->route('token');
        $verifyOffer = OfferVerify::where('oToken',$token)->first();
        $message = 'Sorry your Offer cannot be identified';

        if($verifyOffer){
            $offer = offerte::where('id',$verifyOffer['offerId'])->first();
            $customer = Customer::where('id',$offer['customerId'])->first();
            if($offer->offerteStatus == 'Beklemede'){
                
                $verify = [
                    'offerteStatus' => 'Onaylandı',
                ];
                offerte::where('id',$verifyOffer['offerId'])->update($verify);

                $data["email"] = Company::InfoCompany('email');
                $data["title"] = "Swiss Transport AG - Offerten Bestätigung";
                $data["offertenumber"] = $offer['id'];
                $data["kundenumber"] = $customer['id'];
                $data["kunde"] = $customer['name']." ".$customer['surname'];
                $data["telefon"] = $customer['phone'];
                $data["phone"] = $customer['mobile'];
                $data["customerEmail"] = $customer['email'];
                $data["cnote"] = "Der folgende Kunde hat die Offerte bestätigt";
                $data["customerNote"] = $request->offerteVerifyNote;

                Mail::send('front.verify.offerMailVerification',$data,function($message)use($data){
                    $message->to($data['email'])
                        ->subject($data['title']);
                });

                return view('front.verify.notifyOffer',['offer' => $offer]);
            }
            else
            {
                return view('front.verify.verifiedOffer',['offer' => $offer]);
            }
        }
        
    }

    public function rejectOffer(Request $request)
    { 
        $token = $request->route('token');
        $verifyOffer = OfferVerify::where('oToken',$token)->first();
        $message = 'Sorry your Offer cannot be identified';

        if($verifyOffer){
            $offer = offerte::where('id',$verifyOffer['offerId'])->first();
            $customer = Customer::where('id',$offer['customerId'])->first();
            if($offer->offerteStatus == 'Beklemede'){
                
                $verify = [
                    'offerteStatus' => 'Onaylanmadı',
                ];
                offerte::where('id',$verifyOffer['offerId'])->update($verify);

                $data["email"] = Company::InfoCompany('email');
                $data["title"] = "Swiss Transport AG - Offerte abgelehnt";
                $data["offertenumber"] = $offer['id'];
                $data["kundenumber"] = $customer['id'];
                $data["kunde"] = $customer['name']." ".$customer['surname'];
                $data["telefon"] = $customer['phone'];
                $data["phone"] = $customer['mobile'];
                $data["customerEmail"] = $customer['email'];
                $data["cnote"] = "Der folgende Kunde hat die Offerte abgelehnt";
                $data["customerNote"] = $request->offerteVerifyNote;

                Mail::send('front.verify.offerMailVerification',$data,function($message)use($data){
                    $message->to($data['email'])
                        ->subject($data['title']);
                });

                return view('front.verify.notifyOfferReject',['offer' => $offer]);
            }
            else
            {
                return view('front.verify.verifiedOffer',['offer' => $offer]);
            }
        }
        
    }
    
    public function acceptOfferView(Request $request)
    { 
        $token = $request->route('token');
        $verifyOffer = OfferVerify::where('oToken',$token)->first();

        if($verifyOffer){
            $offer = offerte::where('id',$verifyOffer['offerId'])->first();
           
            if($offer->offerteStatus == 'Beklemede'){
                
                return view('front.verify.acceptOffer',['offer' => $offer,'token' =>$token]);
            }
            else
            {
                return view('front.verify.verifiedOffer',['offer' => $offer]);
            }
        }
    }
}
