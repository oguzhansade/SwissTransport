<?php

namespace App\Http\Controllers\front\invoice;

use App\Http\Controllers\Controller;
use App\Mail\invoiceMail;
use App\Mail\LagerungMail;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceEinpack;
use App\Models\InvoiceAuspack;
use App\Models\InvoiceBasket;
use App\Models\InvoiceEntsorgung;
use App\Models\InvoiceLagerung;
use App\Models\InvoiceMaterial;
use App\Models\InvoiceReinigung;
use App\Models\InvoiceTransport;
use App\Models\InvoiceUmzug;
use App\Models\LagerungMailer;
use App\Models\offerte;
use App\Models\OfferteAuspack;
use App\Models\OfferteBasket;
use App\Models\OfferteEinpack;
use App\Models\OfferteEntsorgung;
use App\Models\OfferteLagerung;
use App\Models\OfferteMaterial;
use App\Models\OfferteReinigung;
use App\Models\OfferteTransport;
use App\Models\OfferteUmzug;
use App\Notifications\MovieTicketPaid;
use App\Notifications\OrderProcessed;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Vonage;
use Illuminate\Support\Facades\Notification;

class indexController extends Controller
{

    public function create($id)
    {
        $data = Customer::where('id',$id)->first();
        return view('front.invoice.create',['data'=>$data]);
    }

    public function createFromOffer(Request $request)
    {
        $id = $request->route('id');
        if($id !=0)
        {
            
            $data = offerte::where('id',$id)->first();
            $umzug = OfferteUmzug::where('id',$data['offerteUmzugId'])->first();
            $einpack = OfferteEinpack::where('id',$data['offerteEinpackId'])->first();
            $auspack = OfferteAuspack::where('id',$data['offerteAuspackId'])->first();
            $reinigung = OfferteReinigung::where('id',$data['offerteReinigungId'])->first();
            $reinigung2 = OfferteReinigung::where('id',$data['offerteReinigung2Id'])->first();
            $entsorgung = OfferteEntsorgung::where('id',$data['offerteEntsorgungId'])->first();
            $transport = OfferteTransport::where('id',$data['offerteTransportId'])->first();
            $lagerung = OfferteLagerung::where('id',$data['offerteLagerungId'])->first();
            $material = OfferteMaterial::where('id',$data['offerteMaterialId'])->first();
            $basket = OfferteBasket::where('materialId',$data['offerteMaterialId'])->get();
            $customer = Customer::where('id',$data['customerId'])->first();
            $data2 = Customer::where('id',$data['customerId'])->first();
            return view ('front.invoice.createFromOffer', 
            [
                'data' => $data,
                'umzug' => $umzug,
                'einpack' => $einpack,
                'auspack' => $auspack,
                'reinigung' => $reinigung,
                'reinigung2' => $reinigung2,
                'entsorgung' => $entsorgung,
                'transport' => $transport,
                'lagerung' => $lagerung,
                'material' => $material,
                'basket' => $basket,
                'customer' => $customer,
                'data2' => $data2
            ]);
        }
    }

    public function edit(Request $request)
    {   
        $id = $request->route('id');
        if($id !=0)
        {
            
            $data = Invoice::where('id',$id)->first();
            $customer = Customer::where('id',$data['customerId'])->first();
            $umzug = InvoiceUmzug::where('id',$data['umzugId'])->first();
            $einpack = InvoiceEinpack::where('id',$data['einpackId'])->first();
            $auspack = InvoiceAuspack::where('id',$data['auspackId'])->first();
            $reinigung = InvoiceReinigung::where('id',$data['reinigungId'])->first();
            $reinigung2 = InvoiceReinigung::where('id',$data['reinigung2Id'])->first();
            $entsorgung = InvoiceEntsorgung::where('id',$data['entsorgungId'])->first();
            $transport = InvoiceTransport::where('id',$data['transportId'])->first();
            $lagerung = InvoiceLagerung::where('id',$data['lagerungId'])->first();
            $material = InvoiceMaterial::where('id',$data['materialId'])->first();
            $basket = InvoiceBasket::where('materialId',$data['materialId'])->first();
            $data2 = Customer::where('id',$data['customerId'])->first();
            return view ('front.invoice.edit', 
            [
                'data' => $data,
                'customer' => $customer,
                'umzug' => $umzug,
                'einpack' => $einpack,
                'auspack' => $auspack,
                'reinigung' => $reinigung,
                'reinigung2' => $reinigung2,
                'entsorgung' => $entsorgung,
                'transport' => $transport,
                'lagerung' => $lagerung,
                'material' => $material,
                'basket' => $basket,
                'customer' => $customer,
                'data2' => $data2,
            ]);
        }
    }

    public function update (Request $request)
    {
        $id = $request->route('id');
        $c = Invoice::where('id',$id)->count();
        $d = Invoice::where('id',$id)->first();
        $all = $request->except('_token');

        $isCustomEmailSend = $request->get('isCustomEmail');
        $customEmail = $request->get('customEmail');

        $customer = Customer::where('id','=',$d['customerId'])->first();
        
         // Tanımlamalar
         $invoiceUmzugId = $d['invoiceUmzugId'] ? $d['invoiceUmzugId'] : NULL;
         $invoiceEinpackId = $d['invoiceEinpackId'] ? $d['invoiceEinpackId'] : NULL;
         $invoiceAuspackId = $d['invoiceAuspackId'] ? $d['invoiceAuspackId'] : NULL;
         $invoiceReinigungId = $d['invoiceReinigungId'] ? $d['invoiceReinigungId'] : NULL;
         $invoiceReinigungId2 = $d['invoiceReinigung2Id'] ? $d['invoiceReinigung2Id'] : NULL;
         $invoiceEntsorgungId = $d['invoiceEntsorgungId'] ? $d['invoiceEntsorgungId'] : NULL;
         $invoiceTransportId  = $d['invoiceTransportId'] ? $d['invoiceTransportId'] : NULL;
         $invoiceLagerungId = $d['invoiceLagerungId'] ? $d['invoiceLagerungId'] : NULL;
         $invoiceMaterialId = $d['invoiceMaterialId'] ? $d['invoiceMaterialId'] : NULL;
         $contactPerson = NULL;
         $isEmailSend = $request->get('isEmail');
         
        
     

        if($invoiceUmzugId)
        {

            if($request->isUmzug == NULL)
            {
                InvoiceUmzug::where('id',$invoiceUmzugId)->delete();
                $invoiceUmzugId = NULL;
            }

            else {
                $invoiceUmzug = [
                    'umzugDate' => $request->umzugDate,
                    'umzugHour' => $request->umzugHours,
                    'umzugChf' => $request->umzugChf,
                    'umzugHour2' => $request->umzugHours2,
                    'umzugChf2' => $request->umzugChf2,
                    'umzugRoadChf' => $request->umzugRoadChf,
                    'extra1' => $request->masraf ? $request->extra1 : Null,
                    'extra2'=> $request->masraf1 ? $request->extra2 : Null,
                    'extra3'=> $request->masraf2 ? $request->extra3 : Null,
                    'extra4'=> $request->masraf3 ? $request->extra4 : Null,
                    'extra5'=> $request->masraf4 ? $request->extra5 : Null,
                    'extra6'=> $request->masraf5 ? $request->extra6 : Null,
                    'extra7'=> $request->masraf6 ? $request->extra7 : Null,
                    'extra8'=> $request->masraf7 ? $request->extra8 : Null,
                    'extra9'=> $request->masraf8 ? $request->extra9 : Null,
                    'extra10'=> $request->masraf9 ? $request->extra10 : Null,
                    'extra11'=> $request->masraf10 ? $request->extra11 : Null,
                    'extraText1' => $request->extra12CostText,
                    'extraValue1' => $request->extra12Cost,
                    'extraText2' => $request->extra13CostText,
                    'extraValue2'=> $request->extra13Cost,
                    'discount' => $request->umzugDiscount,
                    'discount2' => $request->umzugDiscount2,
                    'discountPercent' => $request->umzugDiscountPercent,
                    'extraDiscountText1' => $request->umzugExtraDiscountText,
                    'extraDiscountValue1' => $request->umzugExtraDiscount,
                    'extraDiscountText2' => $request->umzugExtraDiscountText2,
                    'extraDiscountValue2' => $request->umzugExtraDiscount2,
                    'umzugCost' => $request->umzugCost,
                    'umzugFixedCost' => $request->umzugFixedPrice,
                    'umzugPaid1' => $request->umzugPaid1,
                    'umzugPaid2' => $request->umzugPaid2,
                    'umzugPaid3' => $request->umzugPaid3,
                    'umzugTotalPrice' => $request->umzugTotalPrice
                ];
    
                InvoiceUmzug::where('id',$invoiceUmzugId)->update($invoiceUmzug);
            }
            
        }

        elseif($invoiceUmzugId == NULL && $request->isUmzug)
        {
            $invoiceUmzug = [
                'umzugDate' => $request->umzugDate,
                'umzugHour' => $request->umzugHours,
                'umzugChf' => $request->umzugChf,
                'umzugHour2' => $request->umzugHours2,
                'umzugChf2' => $request->umzugChf2,
                'umzugRoadChf' => $request->umzugRoadChf,
                'extra1' => $request->masraf ? $request->extra1 : Null,
                'extra2'=> $request->masraf1 ? $request->extra2 : Null,
                'extra3'=> $request->masraf2 ? $request->extra3 : Null,
                'extra4'=> $request->masraf3 ? $request->extra4 : Null,
                'extra5'=> $request->masraf4 ? $request->extra5 : Null,
                'extra6'=> $request->masraf5 ? $request->extra6 : Null,
                'extra7'=> $request->masraf6 ? $request->extra7 : Null,
                'extra8'=> $request->masraf7 ? $request->extra8 : Null,
                'extra9'=> $request->masraf8 ? $request->extra9 : Null,
                'extra10'=> $request->masraf9 ? $request->extra10 : Null,
                'extra11'=> $request->masraf10 ? $request->extra11 : Null,
                'extraText1' => $request->extra12CostText,
                'extraValue1' => $request->extra12Cost,
                'extraText2' => $request->extra13CostText,
                'extraValue2'=> $request->extra13Cost,
                'discount' => $request->umzugDiscount,
                'discount2' => $request->umzugDiscount2,
                'discountPercent' => $request->umzugDiscountPercent,
                'extraDiscountText1' => $request->umzugExtraDiscountText,
                'extraDiscountValue1' => $request->umzugExtraDiscount,
                'extraDiscountText2' => $request->umzugExtraDiscountText2,
                'extraDiscountValue2' => $request->umzugExtraDiscount2,
                'umzugCost' => $request->umzugCost,
                'umzugFixedCost' => $request->umzugFixedPrice,
                'umzugPaid1' => $request->umzugPaid1,
                'umzugPaid2' => $request->umzugPaid2,
                'umzugPaid3' => $request->umzugPaid3,
                'umzugTotalPrice' => $request->umzugTotalPrice
            ];
            InvoiceUmzug::create($invoiceUmzug);
            $invoiceUmzugIdBul = DB::table('invoice_umzugs')->orderBy('id','DESC')->first();
            $invoiceUmzugId = $invoiceUmzugIdBul->id;
        }



        if($invoiceEinpackId)
        {

            if($request->isEinpack == NULL)
            {
                InvoiceEinpack::where('id',$invoiceEinpackId)->delete();
                $invoiceEinpackId = NULL;
            }

            else {
                $invoiceEinpack = [
                    'einpackDate' => $request->einpackDate,
                    'einpackHour' => $request->einpackHours,
                    'einpackChf' => $request->einpackChf,
                    'einpackHour2' => $request->einpackHours2,
                    'einpackChf2' => $request->einpackChf2,
                    'einpackRoadChf' => $request->einpackRoadChf,
                    'extra1' => $request->einpackMasraf ? $request->einpackExtra1 : Null,
                    'extra2'=> $request->einpackMasraf1 ? $request->einpackExtra2 : Null,
                    'extraText1' => $request->einpackExtra1CostText,
                    'extraValue1' => $request->einpackExtra1Cost,
                    'extraText2' => $request->einpackExtra2CostText,
                    'extraValue2'=> $request->einpackExtra2Cost,
                    'discount' => $request->einpackDiscount,
                    'discount2' => $request->einpackDiscount2,
                    'discountPercent' => $request->einpackDiscountPercent,
                    'extraDiscountText1' => $request->einpackExtraDiscountText,
                    'extraDiscountValue1' => $request->einpackExtraDiscount,
                    'extraDiscountText2' => $request->einpackExtraDiscountText2,
                    'extraDiscountValue2' => $request->einpackExtraDiscount2,
                    'einpackCost' => $request->einpackCost,
                    'einpackFixedCost' => $request->einpackFixedPrice,
                    'einpackPaid1' => $request->einpackPaid1,
                    'einpackPaid2' => $request->einpackPaid2,
                    'einpackPaid3' => $request->einpackPaid3,
                    'einpackTotalPrice' => $request->einpackTotalPrice
                ];
                
                InvoiceEinpack::where('id',$invoiceEinpackId)->update($invoiceEinpack);
            }
            
        }

        elseif($invoiceEinpackId == NULL && $request->isEinpack)
        {
            $invoiceEinpack = [
                'einpackDate' => $request->einpackDate,
                'einpackHour' => $request->einpackHours,
                'einpackChf' => $request->einpackChf,
                'einpackHour2' => $request->einpackHours2,
                'einpackChf2' => $request->einpackChf2,
                'einpackRoadChf' => $request->einpackRoadChf,
                'extra1' => $request->einpackMasraf ? $request->einpackExtra1 : Null,
                'extra2'=> $request->einpackMasraf1 ? $request->einpackExtra2 : Null,
                'extraText1' => $request->einpackExtra1CostText,
                'extraValue1' => $request->einpackExtra1Cost,
                'extraText2' => $request->einpackExtra2CostText,
                'extraValue2'=> $request->einpackExtra2Cost,
                'discount' => $request->einpackDiscount,
                'discount2' => $request->einpackDiscount2,
                'discountPercent' => $request->einpackDiscountPercent,
                'extraDiscountText1' => $request->einpackExtraDiscountText,
                'extraDiscountValue1' => $request->einpackExtraDiscount,
                'extraDiscountText2' => $request->einpackExtraDiscountText2,
                'extraDiscountValue2' => $request->einpackExtraDiscount2,
                'einpackCost' => $request->einpackCost,
                'einpackFixedCost' => $request->einpackFixedPrice,
                'einpackPaid1' => $request->einpackPaid1,
                'einpackPaid2' => $request->einpackPaid2,
                'einpackPaid3' => $request->einpackPaid3,
                'einpackTotalPrice' => $request->einpackTotalPrice
            ];

            InvoiceEinpack::create($invoiceEinpack);
            $invoiceEinpackIdBul = DB::table('invoice_einpacks')->orderBy('id','DESC')->first();
            $invoiceEinpackId = $invoiceEinpackIdBul->id;
        }


        if($invoiceAuspackId)
        {

            if($request->isAuspack == NULL)
            {
                InvoiceAuspack::where('id',$invoiceAuspackId)->delete();
                $invoiceAuspackId = NULL;
            }

            else {
                $invoiceAuspack = [
                    'auspackDate' => $request->auspackDate,
                    'auspackHour' => $request->auspackHours,
                    'auspackChf' => $request->auspackChf,
                    'auspackHour2' => $request->auspackHours2,
                    'auspackChf2' => $request->auspackChf2,
                    'auspackRoadChf' => $request->auspackRoadChf,
                    'extra1' => $request->auspackMasraf ? $request->auspackExtra1 : Null,
                    'extra2'=> $request->auspackMasraf1 ? $request->auspackExtra2 : Null,
                    'extraText1' => $request->auspackExtra1CostText,
                    'extraValue1' => $request->auspackExtra1Cost,
                    'extraText2' => $request->auspackExtra2CostText,
                    'extraValue2'=> $request->auspackExtra2Cost,
                    'discount' => $request->auspackDiscount,
                    'discount2' => $request->auspackDiscount2,
                    'discountPercent' => $request->auspackDiscountPercent,
                    'extraDiscountText1' => $request->auspackExtraDiscountText,
                    'extraDiscountValue1' => $request->auspackExtraDiscount,
                    'extraDiscountText2' => $request->auspackExtraDiscountText2,
                    'extraDiscountValue2' => $request->auspackExtraDiscount2,
                    'auspackCost' => $request->auspackCost,
                    'auspackFixedCost' => $request->auspackFixedPrice,
                    'auspackPaid1' => $request->auspackPaid1,
                    'auspackPaid2' => $request->auspackPaid2,
                    'auspackPaid3' => $request->auspackPaid3,
                    'auspackTotalPrice' => $request->auspackTotalPrice
                ];
                
                InvoiceAuspack::where('id',$invoiceAuspackId)->update($invoiceAuspack);
            }
            
        }

        elseif($invoiceAuspackId == NULL && $request->isAuspack)
        {
            $invoiceAuspack = [
                'auspackDate' => $request->auspackDate,
                'auspackHour' => $request->auspackHours,
                'auspackChf' => $request->auspackChf,
                'auspackHour2' => $request->auspackHours2,
                'auspackChf2' => $request->auspackChf2,
                'auspackRoadChf' => $request->auspackRoadChf,
                'extra1' => $request->auspackMasraf ? $request->auspackExtra1 : Null,
                'extra2'=> $request->auspackMasraf1 ? $request->auspackExtra2 : Null,
                'extraText1' => $request->auspackExtra1CostText,
                'extraValue1' => $request->auspackExtra1Cost,
                'extraText2' => $request->auspackExtra2CostText,
                'extraValue2'=> $request->auspackExtra2Cost,
                'discount' => $request->auspackDiscount,
                'discount2' => $request->auspackDiscount2,
                'discountPercent' => $request->auspackDiscountPercent,
                'extraDiscountText1' => $request->auspackExtraDiscountText,
                'extraDiscountValue1' => $request->auspackExtraDiscount,
                'extraDiscountText2' => $request->auspackExtraDiscountText2,
                'extraDiscountValue2' => $request->auspackExtraDiscount2,
                'auspackCost' => $request->auspackCost,
                'auspackFixedCost' => $request->auspackFixedPrice,
                'auspackPaid1' => $request->auspackPaid1,
                'auspackPaid2' => $request->auspackPaid2,
                'auspackPaid3' => $request->auspackPaid3,
                'auspackTotalPrice' => $request->auspackTotalPrice
            ];

            InvoiceAuspack::create($invoiceAuspack);
            $invoiceAuspackIdBul = DB::table('invoice_auspacks')->orderBy('id','DESC')->first();
            $invoiceAuspackId = $invoiceAuspackIdBul->id;
        }

        if($invoiceReinigungId)
        {

            if($request->isReinigung == NULL)
            {
                InvoiceReinigung::where('id',$invoiceReinigungId)->delete();
                $invoiceReinigungId = NULL;
            }

            else {
                $invoiceReinigung = [
                    'reinigungDate' => $request->reinigungDate,
                    'reinigungType' => $request->reinigungTypeManuel ? $request->reinigungTypeManuel : $request->reinigungType,
                    'extraReinigung' => $request->extraReinigung,
                    'reinigungRoom' => $request->reinigungFixedRoom,
                    'reinigungFixedPrice' => $request->reinigungFixedPrice,
                    'reinigungHours' => $request->reinigungHours,
                    'reinigungChf' => $request->reinigungChf,
                    'extra1'=> $request->reinigungMasraf1 ? $request->reinigungExtra1 : Null,
                    'extra2' => $request->reinigungMasraf2 ? $request->reinigungExtra2 : Null,
                    'extra3' =>  $request->reinigungMasraf3 ? $request->reinigungExtra3 : Null,
                    'extraText1' => $request->reinigungExtra1CostText,
                    'extraValue1'=> $request->reinigungExtra1Cost,
                    'extraText2' => $request->reinigungExtra2CostText,
                    'extraValue2' => $request->reinigungExtra2Cost,
                    'discount' => $request->reinigungDiscount,
                    'discount2' => $request->reinigungDiscount2,
                    'discountPercent' => $request->reinigungDiscountPercent,
                    'extraDiscountText1' => $request->reinigungExtraDiscountText,
                    'extraDiscountValue1' => $request->reinigungExtraDiscount,
                    'extraDiscountText2' => $request->reinigungExtraDiscountText2,
                    'extraDiscountValue2' => $request->reinigungExtraDiscount2,
                    'reinigungCost' => $request->reinigungCost,
                    'reinigungPaid1' => $request->reinigungPaid1,
                    'reinigungPaid2' => $request->reinigungPaid2,
                    'reinigungPaid3' => $request->reinigungPaid3,
                    'reinigungTotalPrice' => $request->reinigungTotalPrice
                ];
                
                InvoiceReinigung::where('id',$invoiceReinigungId)->update($invoiceReinigung);
            }
            
        }

        elseif($invoiceReinigungId == NULL && $request->isReinigung)
        {
            $invoiceReinigung = [
                'reinigungDate' => $request->reinigungDate,
                'reinigungType' => $request->reinigungTypeManuel ? $request->reinigungTypeManuel : $request->reinigungType,
                'extraReinigung' => $request->extraReinigung,
                'reinigungRoom' => $request->reinigungFixedRoom,
                'reinigungFixedPrice' => $request->reinigungFixedPrice,
                'reinigungHours' => $request->reinigungHours,
                'reinigungChf' => $request->reinigungChf,
                'extra1'=> $request->reinigungMasraf1 ? $request->reinigungExtra1 : Null,
                'extra2' => $request->reinigungMasraf2 ? $request->reinigungExtra2 : Null,
                'extra3' =>  $request->reinigungMasraf3 ? $request->reinigungExtra3 : Null,
                'extraText1' => $request->reinigungExtra1CostText,
                'extraValue1'=> $request->reinigungExtra1Cost,
                'extraText2' => $request->reinigungExtra2CostText,
                'extraValue2' => $request->reinigungExtra2Cost,
                'discount' => $request->reinigungDiscount,
                'discount2' => $request->reinigungDiscount2,
                'discountPercent' => $request->reinigungDiscountPercent,
                'extraDiscountText1' => $request->reinigungExtraDiscountText,
                'extraDiscountValue1' => $request->reinigungExtraDiscount,
                'extraDiscountText2' => $request->reinigungExtraDiscountText2,
                'extraDiscountValue2' => $request->reinigungExtraDiscount2,
                'reinigungCost' => $request->reinigungCost,
                'reinigungPaid1' => $request->reinigungPaid1,
                'reinigungPaid2' => $request->reinigungPaid2,
                'reinigungPaid3' => $request->reinigungPaid3,
                'reinigungTotalPrice' => $request->reinigungTotalPrice
            ];

            InvoiceReinigung::create($invoiceReinigung);
            $invoiceReinigungIdBul = DB::table('invoice_reinigungs')->orderBy('id','DESC')->first();
            $invoiceReinigungId = $invoiceReinigungIdBul->id;
        }

        if($invoiceReinigungId2)
        {

            if($request->isReinigung2 == NULL)
            {
                InvoiceReinigung::where('id',$invoiceReinigungId2)->delete();
                $invoiceReinigungId2 = NULL;
            }

            else {
                $invoiceReinigung2 = [
                    'reinigungDate' => $request->reinigung2Date,
                    'reinigungType' => $request->reinigung2TypeManuel ? $request->reinigung2TypeManuel : $request->reinigung2Type,
                    'extraReinigung' => $request->extraReinigung2,
                    'reinigungRoom' => $request->reinigung2FixedRoom,
                    'reinigungFixedPrice' => $request->reinigung2FixedPrice,
                    'reinigungHours' => $request->reinigung2Hours,
                    'reinigungChf' => $request->reinigung2Chf,
                    'extra1'=> $request->reinigung2Masraf1 ? $request->reinigung2Extra1 : Null,
                    'extra2' => $request->reinigung2Masraf2 ? $request->reinigung2Extra2 : Null,
                    'extra3' =>  $request->reinigung2Masraf3 ? $request->reinigung2Extra3 : Null,
                    'extraText1' => $request->reinigung2Extra1CostText,
                    'extraValue1'=> $request->reinigung2Extra1Cost,
                    'extraText2' => $request->reinigung2Extra2CostText,
                    'extraValue2' => $request->reinigung2Extra2Cost,
                    'discount' => $request->reinigung2Discount,
                    'discount2' => $request->reinigung2Discount2,
                    'discountPercent' => $request->reinigung2DiscountPercent,
                    'extraDiscountText1' => $request->reinigung2ExtraDiscountText,
                    'extraDiscountValue1' => $request->reinigung2ExtraDiscount,
                    'extraDiscountText2' => $request->reinigung2ExtraDiscountText2,
                    'extraDiscountValue2' => $request->reinigung2ExtraDiscount2,
                    'reinigungCost' => $request->reinigung2Cost,
                    'reinigungPaid1' => $request->reinigung2Paid1,
                    'reinigungPaid2' => $request->reinigung2Paid2,
                    'reinigungPaid3' => $request->reinigung2Paid3,
                    'reinigungTotalPrice' => $request->reinigung2TotalPrice
                ];
                
                InvoiceReinigung::where('id',$invoiceReinigungId2)->update($invoiceReinigung2);
            }
            
        }

        elseif($invoiceReinigungId2 == NULL && $request->isReinigung2)
        {
            $invoiceReinigung2 = [
                'reinigungDate' => $request->reinigung2Date,
                'reinigungType' => $request->reinigung2TypeManuel ? $request->reinigung2TypeManuel : $request->reinigung2Type,
                'extraReinigung' => $request->extraReinigung2,
                'reinigungRoom' => $request->reinigung2FixedRoom,
                'reinigungFixedPrice' => $request->reinigung2FixedPrice,
                'reinigungHours' => $request->reinigung2Hours,
                'reinigungChf' => $request->reinigung2Chf,
                'extra1'=> $request->reinigung2Masraf1 ? $request->reinigung2Extra1 : Null,
                'extra2' => $request->reinigung2Masraf2 ? $request->reinigung2Extra2 : Null,
                'extra3' =>  $request->reinigung2Masraf3 ? $request->reinigung2Extra3 : Null,
                'extraText1' => $request->reinigung2Extra1CostText,
                'extraValue1'=> $request->reinigung2Extra1Cost,
                'extraText2' => $request->reinigung2Extra2CostText,
                'extraValue2' => $request->reinigung2Extra2Cost,
                'discount' => $request->reinigung2Discount,
                'discount2' => $request->reinigung2Discount2,
                'discountPercent' => $request->reinigung2DiscountPercent,
                'extraDiscountText1' => $request->reinigung2ExtraDiscountText,
                'extraDiscountValue1' => $request->reinigung2ExtraDiscount,
                'extraDiscountText2' => $request->reinigung2ExtraDiscountText2,
                'extraDiscountValue2' => $request->reinigung2ExtraDiscount2,
                'reinigungCost' => $request->reinigung2Cost,
                'reinigungPaid1' => $request->reinigung2Paid1,
                'reinigungPaid2' => $request->reinigung2Paid2,
                'reinigungPaid3' => $request->reinigung2Paid3,
                'reinigungTotalPrice' => $request->reinigung2TotalPrice
            ];

            InvoiceReinigung::create($invoiceReinigung2);
            $invoiceReinigungIdBul2 = DB::table('invoice_reinigungs')->orderBy('id','DESC')->first();
            $invoiceReinigungId2 = $invoiceReinigungIdBul2->id;
        }


        if($invoiceEntsorgungId)
        {

            if($request->isEntsorgung == NULL)
            {
                InvoiceEntsorgung::where('id',$invoiceEntsorgungId)->delete();
                $invoiceEntsorgungId = NULL;
            }

            else {
                $invoiceEntsorgung = [
                    'entsorgungDate' => $request->entsorgungDate,
                    'entsorgungVolume' => $request->entsorgungVolume,
                    'entsorgungFixedChf' => $request->entsorgungFixedChf,
                    'entsorgungFixedChfCost' => $request->entsorgungFixedChfCost,
                    'entsorgungHours' => $request->entsorgungHours,
                    'entsorgungChf' => $request->entsorgungChf,
                    'entsorgungRoadChf' => $request->entsorgungRoadChf,
                    'extra1'=> $request->entsorgungMasraf ? $request->entsorgungExtra1 : Null,
                    'extraText1' => $request->entsorgungExtra1CostText,
                    'extraValue1' =>  $request->entsorgungExtra1Cost,
                    'extraText2' => $request->entsorgungExtra2CostText,
                    'extraValue2'=> $request->entsorgungExtra2Cost,
                    'discount' => $request->entsorgungDiscount,
                    'discount2' => $request->entsorgungDiscount2,
                    'discountPercent' => $request->entsorgungDiscountPercent,
                    'extraDiscountText1' => $request->entsorgungExtraDiscountText,
                    'extraDiscountValue1' => $request->entsorgungExtraDiscount,
                    'extraDiscountText2' => $request->entsorgungExtraDiscountText2,
                    'extraDiscountValue2' => $request->entsorgungExtraDiscount2,
                    'entsorgungCost' => $request->entsorgungCost,
                    'entsorgungFixedCost' => $request->entsorgungFixedPrice,
                    'entsorgungPaid1' => $request->entsorgungPaid1,
                    'entsorgungPaid2' => $request->entsorgungPaid2,
                    'entsorgungTotalPrice' => $request->entsorgungTotalPrice,
                ];
                
                InvoiceEntsorgung::where('id',$invoiceEntsorgungId)->update($invoiceEntsorgung);
            }
            
        }

        elseif($invoiceEntsorgungId == NULL && $request->isEntsorgung)
        {
            $invoiceEntsorgung = [
                'entsorgungDate' => $request->entsorgungDate,
                'entsorgungVolume' => $request->entsorgungVolume,
                'entsorgungFixedChf' => $request->entsorgungFixedChf,
                'entsorgungFixedChfCost' => $request->entsorgungFixedChfCost,
                'entsorgungHours' => $request->entsorgungHours,
                'entsorgungChf' => $request->entsorgungChf,
                'entsorgungRoadChf' => $request->entsorgungRoadChf,
                'extra1'=> $request->entsorgungMasraf ? $request->entsorgungExtra1 : Null,
                'extraText1' => $request->entsorgungExtra1CostText,
                'extraValue1' =>  $request->entsorgungExtra1Cost,
                'extraText2' => $request->entsorgungExtra2CostText,
                'extraValue2'=> $request->entsorgungExtra2Cost,
                'discount' => $request->entsorgungDiscount,
                'discount2' => $request->entsorgungDiscount2,
                'discountPercent' => $request->entsorgungDiscountPercent,
                'extraDiscountText1' => $request->entsorgungExtraDiscountText,
                'extraDiscountValue1' => $request->entsorgungExtraDiscount,
                'extraDiscountText2' => $request->entsorgungExtraDiscountText2,
                'extraDiscountValue2' => $request->entsorgungExtraDiscount2,
                'entsorgungCost' => $request->entsorgungCost,
                'entsorgungFixedCost' => $request->entsorgungFixedPrice,
                'entsorgungPaid1' => $request->entsorgungPaid1,
                'entsorgungPaid2' => $request->entsorgungPaid2,
                'entsorgungTotalPrice' => $request->entsorgungTotalPrice,
            ];

            InvoiceEntsorgung::create($invoiceEntsorgung);
            $invoiceEntsorgungIdBul = DB::table('invoice_entsorgungs')->orderBy('id','DESC')->first();
            $invoiceEntsorgungId = $invoiceEntsorgungIdBul->id;
        }

        if($invoiceTransportId)
        {
            if($request->isTransport == NULL)
            {
                InvoiceTransport::where('id',$invoiceTransportId)->delete();
                $invoiceTransportId = NULL;
            }

            else {
                $invoiceTransport = [
                    'pdfText' => $request->pdfText,
                    'transportDate' => $request->transportDate,
                    'transportFixedTariff' => $request->transportFixedTariff,
                    'transportHours' => $request->transportHours,
                    'transportChf' => $request->transportChf,
                    'transportHours2' => $request->transportHours2,
                    'transportChf2' => $request->transportChf2,
                    'transportRoadChf'=> $request->transportRoadChf,
                    'extraText1' => $request->transportExtra1CostText,
                    'extraValue1' =>  $request->transportExtra1Cost,
                    'extraText2' => $request->transportExtra2CostText,
                    'extraValue2'=> $request->transportExtra2Cost,
                    'extraText3' => $request->transportExtra3CostText,
                    'extraValue3' =>  $request->transportExtra3Cost,
                    'extraText4' => $request->transportExtra4CostText,
                    'extraValue4'=> $request->transportExtra4Cost,
                    'extraText5' => $request->transportExtra5CostText,
                    'extraValue5' =>  $request->transportExtra5Cost,
                    'extraText6' => $request->transportExtra6CostText,
                    'extraValue6'=> $request->transportExtra6Cost,
                    'extraText7' => $request->transportExtra7CostText,
                    'extraValue7'=> $request->transportExtra7Cost,
                    'discount' => $request->transportDiscount,
                    'discount2' => $request->transportDiscount2,
                    'discountPercent' => $request->transportDiscountPercent,
                    'extraDiscountText1' => $request->transportExtraDiscountText,
                    'extraDiscountValue1' => $request->transportExtraDiscount,
                    'extraDiscountText2' => $request->transportExtraDiscountText2,
                    'extraDiscountValue2' => $request->transportExtraDiscount2,
                    'transportCost' => $request->transportCost,
                    'transportFixedCost' => $request->transportFixedPrice,
                    'transportPaid1' => $request->transportPaid1,
                    'transportPaid2' => $request->transportPaid2,
                    'transportPaid3' => $request->transportPaid3,
                    'transportTotalPrice' => $request->transportTotalPrice,
                ];
                InvoiceTransport::where('id',$invoiceTransportId)->update($invoiceTransport);
            }
            
        }

        elseif($invoiceTransportId == NULL && $request->isTransport)
        {
            $invoiceTransport = [
                'pdfText' => $request->pdfText,
                'transportDate' => $request->transportDate,
                'transportFixedTariff' => $request->transportFixedTariff,
                'transportHours' => $request->transportHours,
                'transportChf' => $request->transportChf,
                'transportHours2' => $request->transportHours2,
                'transportChf2' => $request->transportChf2,
                'transportRoadChf'=> $request->transportRoadChf,
                'extraText1' => $request->transportExtra1CostText,
                'extraValue1' =>  $request->transportExtra1Cost,
                'extraText2' => $request->transportExtra2CostText,
                'extraValue2'=> $request->transportExtra2Cost,
                'extraText3' => $request->transportExtra3CostText,
                'extraValue3' =>  $request->transportExtra3Cost,
                'extraText4' => $request->transportExtra4CostText,
                'extraValue4'=> $request->transportExtra4Cost,
                'extraText5' => $request->transportExtra5CostText,
                'extraValue5' =>  $request->transportExtra5Cost,
                'extraText6' => $request->transportExtra6CostText,
                'extraValue6'=> $request->transportExtra6Cost,
                'extraText7' => $request->transportExtra7CostText,
                'extraValue7'=> $request->transportExtra7Cost,
                'discount' => $request->transportDiscount,
                'discount2' => $request->transportDiscount2,
                'discountPercent' => $request->transportDiscountPercent,
                'extraDiscountText1' => $request->transportExtraDiscountText,
                'extraDiscountValue1' => $request->transportExtraDiscount,
                'extraDiscountText2' => $request->transportExtraDiscountText2,
                'extraDiscountValue2' => $request->transportExtraDiscount2,
                'transportCost' => $request->transportCost,
                'transportFixedCost' => $request->transportFixedPrice,
                'transportPaid1' => $request->transportPaid1,
                'transportPaid2' => $request->transportPaid2,
                'transportPaid3' => $request->transportPaid3,
                'transportTotalPrice' => $request->transportTotalPrice,
            ];

            InvoiceTransport::create($invoiceTransport);
            $invoiceTransportIdBul = DB::table('invoice_transports')->orderBy('id','DESC')->first();
            $invoiceTransportId = $invoiceTransportIdBul->id;
        }

        if($invoiceLagerungId)
        {
            if($request->isLagerung == NULL)
            {
                InvoiceLagerung::where('id',$invoiceLagerungId)->delete();
                $invoiceLagerungId = NULL;
            }

            else {
                $invoiceLagerung = [
                    'lagerungStartDate' => $request->lagerungStartDate,
                    'lagerungEndDate' => $request->lagerungEndDate,
                    'lagerungVolume' => $request->lagerungVolume,
                    'lagerungChf' => $request->lagerungChf,
                    'extraText1' => $request->lagerungExtra1CostText,
                    'extraValue1' => $request->lagerungExtra1Cost,
                    'extraText2' => $request->lagerungExtra2CostText,
                    'extraValue2'=> $request->lagerungExtra2Cost,
                    'discount' => $request->lagerungDiscount,
                    'discount2' =>  $request->lagerungDiscount2,
                    'discountPercent' => $request->lagerungDiscountPercent,
                    'extraDiscountText1' => $request->lagerungExtraDiscountText,
                    'extraDiscountValue1'=> $request->lagerungExtraDiscount,
                    'extraDiscountText2' => $request->lagerungExtraDiscountText2,
                    'extraDiscountValue2' =>  $request->lagerungExtraDiscount2,
                    'lagerungCost' => $request->lagerungCost,
                    'lagerungFixedCost'=> $request->lagerungFixedPrice,
                    'lagerungPaid1' => $request->lagerungPaid1,
                    'lagerungPaid2' =>  $request->lagerungPaid2,
                    'lagerungTotalPrice' => $request->lagerungTotalPrice,
                ];
                InvoiceLagerung::where('id',$invoiceLagerungId)->update($invoiceLagerung);
            }
            
        }

        elseif($invoiceLagerungId == NULL && $request->isLagerung)
        {
            $invoiceLagerung = [
                'lagerungStartDate' => $request->lagerungStartDate,
                'lagerungEndDate' => $request->lagerungEndDate,
                'lagerungVolume' => $request->lagerungVolume,
                'lagerungChf' => $request->lagerungChf,
                'extraText1' => $request->lagerungExtra1CostText,
                'extraValue1' => $request->lagerungExtra1Cost,
                'extraText2' => $request->lagerungExtra2CostText,
                'extraValue2'=> $request->lagerungExtra2Cost,
                'discount' => $request->lagerungDiscount,
                'discount2' =>  $request->lagerungDiscount2,
                'discountPercent' => $request->lagerungDiscountPercent,
                'extraDiscountText1' => $request->lagerungExtraDiscountText,
                'extraDiscountValue1'=> $request->lagerungExtraDiscount,
                'extraDiscountText2' => $request->lagerungExtraDiscountText2,
                'extraDiscountValue2' =>  $request->lagerungExtraDiscount2,
                'lagerungCost' => $request->lagerungCost,
                'lagerungFixedCost'=> $request->lagerungFixedPrice,
                'lagerungPaid1' => $request->lagerungPaid1,
                'lagerungPaid2' =>  $request->lagerungPaid2,
                'lagerungTotalPrice' => $request->lagerungTotalPrice,
            ];

            InvoiceLagerung::create($invoiceLagerung);
            $invoiceLagerungIdBul = DB::table('invoice_lagerungs')->orderBy('id','DESC')->first();
            $invoiceLagerungId = $invoiceLagerungIdBul->id;
        }


        if($invoiceMaterialId)
        {
            if($request->isVerpackungsmaterial == NULL)
            {
                InvoiceMaterial::where('id',$invoiceMaterialId)->delete();
                InvoiceBasket::where('materialId',$invoiceMaterialId)->delete();
                $invoiceMaterialId = NULL;
            }

            else {

                $all = $request->except('_token');
                $invoiceMaterial = [
                    'discount' => $request->materialDiscount,
                    'discountPercent' => $request->materialDiscountPercent,
                    'customDiscountText' => $request->materialExtraDiscount,
                    'customDiscountValue' => $request->materialExtraDiscountValue,
                    'deliverPrice' => $request->materialShipPrice,
                    'recievePrice' => $request->materialRecievePrice,
                    'totalPrice' => $request->materialTotalPrice
                ];

                $materialUpdate = InvoiceMaterial::where('id',$invoiceMaterialId)->update($invoiceMaterial);
                
                if($materialUpdate && $all['islem'])
                {
                    $islem = $all['islem'];
                    unset($all['islem']);
                    if(count($islem) !=0) {
                        InvoiceBasket::where('materialId',$invoiceMaterialId)->delete();
                        foreach($islem as $k => $v)
                        {
                            $invoiceBasket = [
                                'productId' => $v['urunId'],
                                'buyType' => $v['buyType'],
                                'quantity' => $v['adet'],
                                'totalPrice' => $v['toplam'],
                                'materialId' => $invoiceMaterialId
                            ];
                            InvoiceBasket::create($invoiceBasket);
                        }
                    }
                    else {
                        InvoiceMaterial::where('id',$invoiceMaterialId)->delete();
                        InvoiceBasket::where('materialId',$invoiceMaterialId)->delete();
                    }
                }

            }
            
        }

        elseif($invoiceMaterialId == NULL && $request->isVerpackungsmaterial)
        {
            $all = $request->except('_token');
            $invoiceMaterial = [
                'discount' => $request->materialDiscount,
                'discountPercent' => $request->materialDiscountPercent,
                'customDiscountText' => $request->materialExtraDiscount,
                'customDiscountValue' => $request->materialExtraDiscountValue,
                'deliverPrice' => $request->materialShipPrice,
                'recievePrice' => $request->materialRecievePrice,
                'totalPrice' => $request->materialTotalPrice
            ];

            $material = InvoiceMaterial::create($invoiceMaterial);
            $invoiceMaterialIdBul = DB::table('invoice_materials')->orderBy('id','DESC')->first();
            $invoiceMaterialId = $invoiceMaterialIdBul->id;

            if($material && $all['islem'])
            {
                $islem = $all['islem'];
                unset($all['islem']);
                if(count($islem) !=0) {
                    foreach($islem as $k => $v)
                    {
                        $invoiceBasket = [
                            'productId' => $v['urunId'],
                            'buyType' => $v['buyType'],
                            'quantity' => $v['adet'],
                            'totalPrice' => $v['toplam'],
                            'materialId' => $invoiceMaterialId
                        ];
                        InvoiceBasket::create($invoiceBasket);
                    }
                }
            }
        }

        $payDay = $request->payCondition;
            $gun = 0;

            switch($payDay){
                case(1):
                    $gun = 7;
                break;
                case(2):
                    $gun = 14;
                break;
                case(3):
                    $gun = 31;
                break;
            };
            
            $invoice = [
                'customerId' => $d['customerId'],
                'payCondition' => $request->payCondition,
                'street' => $request->invoiceStreet,
                'plz' => $request->invoicePostCode,
                'ort' => $request->invoiceOrt,
                'land' => $request->invoiceLand,
                'status' => 'Ödenmedi',
                'expiryDate' => $d['created_at']->addDays($gun),
                'umzugId' => $invoiceUmzugId,
                'einpackId' => $invoiceEinpackId,
                'auspackId' => $invoiceAuspackId,
                'reinigungId' => $invoiceReinigungId,
                'reinigung2Id' => $invoiceReinigungId2,
                'entsorgungId' => $invoiceEntsorgungId,
                'transportId' => $invoiceTransportId,
                'lagerungId' => $invoiceLagerungId,
                'materialId' => $invoiceMaterialId,
                'warningPrice' => $request->invoiceWarningPrice,
                'totalPrice' => $request->invoiceTotalPrice,
                'withTax' =>$request->kdvType,
                'withoutTax' =>$request->kdvType1,
                'freeTax' => $request->kdvType2,
            ];

        $update = invoice::where('id',$id)->update($invoice);

        $sub = 'Ihre Rechnung wurde aktualisiert';
        $from = Company::InfoCompany('email'); // gösterilen mail.
        $companyName = Company::InfoCompany('name'); // şirket adı buraya yaz veritabanında yok çünkü.
        $customer=DB::table('customers')->where('id','=', $d['customerId'])->value('name'); // Customer Name
        $customerSurname=DB::table('customers')->where('id','=', $d['customerId'])->value('surname');
        $customerData =  Customer::where('id',$d['customerId'])->first();

        $invoicePdf = Invoice::where('id',$id)->first();
        $umzugPdf = InvoiceUmzug::where('id',$invoiceUmzugId)->first();
        $einpackPdf = InvoiceEinpack::where('id',$invoiceEinpackId)->first();
        $auspackPdf = InvoiceAuspack::where('id',$invoiceAuspackId)->first();
        $reinigungPdf = InvoiceReinigung::where('id',$invoiceReinigungId)->first();
        $reinigungPdf2 = InvoiceReinigung::where('id',$invoiceReinigungId2)->first();
        $entsorgungPdf = InvoiceEntsorgung::where('id',$invoiceEntsorgungId)->first();
        $transportPdf = InvoiceTransport::where('id',$invoiceTransportId)->first();
        $lagerungPdf = InvoiceLagerung::where('id',$invoiceLagerungId)->first();
        $materialPdf = InvoiceMaterial::where('id',$invoiceMaterialId)->first();
        $basketPdf = InvoiceBasket::where('materialId',$invoiceMaterialId)->get()->toArray();
        

        $pdfData = [
            'invoiceNumber' => $id,
            'invoice' => $invoicePdf,
            'customer' => $customerData,
            'isUmzug' => $request->isUmzug,
            'isEinpack' => $request->isEinpack,
            'isAuspack' => $request->isAuspack,
            'isReinigung' => $request->isReinigung,
            'isReinigung2' => $request->isReinigung2,
            'isEntsorgung' => $request->isEntsorgung,
            'isTransport' => $request->isTransport,
            'isLagerung' => $request->isLagerung,
            'isMaterial' => $request->isVerpackungsmaterial,
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
        
        $pdf = Pdf::loadView('invoicePdf', $pdfData);
        $pdf->setPaper('A4');

  
        $emailData = [
            'invoiceNumber' => $id,
            'contactPerson' => $contactPerson,
            'name' => $customer,
            'surname' => $customerSurname,
            'gender' => $customerData['gender'],
            'sub' => $sub,
            'from' => $from,
            'companyName' => $companyName,
            'email' => $request->email,
            'emailContent'=> $request->emailContent,
            'isCustomEmailSend' => $isCustomEmailSend,
            'customEmailContent' => $customEmail,
            'pdf' => $pdf,
        ];

        if ($isCustomEmailSend)
        {
            Arr::set($emailData, 'customEmailContent', $customEmail);
        }

        if($update) 
            {
                $mailSuccess = '';
                if($isEmailSend)
                {
                    Mail::to($emailData['email'])->send(new InvoiceMail($emailData));
                    $mailSuccess = ', E-Mail und Rechnungsdatei wurden erfolgreich gesendet.';
                }
                return redirect()
                    ->route('customer.detail', ['id' => $d['customerId']])
                    ->with('status',$id.' - '.'Numaralı Fatura Düzenlendi'.' '.$mailSuccess)
                    ->with('cat', 'Rechnung')
                    ->withInput()
                    ->with('keep_status', true);
            }

            else {
                return redirect()->back()->with('status','Fehler: Rechnung konnte nicht bearbeitet werden.');
            }

    }

    public function detail(Request $request)
    {
        $id = $request->route('id');
        if($id !=0)
        {
            
            $data = Invoice::where('id',$id)->first();
            $umzug = InvoiceUmzug::where('id',$data['umzugId'])->first();
            $einpack = InvoiceEinpack::where('id',$data['einpackId'])->first();
            $auspack = InvoiceAuspack::where('id',$data['auspackId'])->first();
            $reinigung = InvoiceReinigung::where('id',$data['reinigungId'])->first();
            $reinigung2 = InvoiceReinigung::where('id',$data['reinigung2Id'])->first();
            $entsorgung = InvoiceEntsorgung::where('id',$data['entsorgungId'])->first();
            $transport = InvoiceTransport::where('id',$data['transportId'])->first();
            $lagerung = InvoiceLagerung::where('id',$data['lagerungId'])->first();
            $material = InvoiceMaterial::where('id',$data['materialId'])->first();
            $basket = InvoiceBasket::where('materialId',$data['materialId'])->first();
            $data2 = Customer::where('id',$data['customerId'])->first();
            $customer = Customer::where('id',$data['customerId'])->first();
            return view ('front.invoice.detail', 
            [
                'data' => $data,
                'umzug' => $umzug,
                'einpack' => $einpack,
                'auspack' => $auspack,
                'reinigung' => $reinigung,
                'reinigung2' => $reinigung2,
                'entsorgung' => $entsorgung,
                'transport' => $transport,
                'lagerung' => $lagerung,
                'material' => $material,
                'basket' => $basket,
                'data2' => $data2,
                'customer' => $customer,
            ]);
        }
    }

    public function data(Request $request)
    {
        $customerId = $request->route('id');

        $table= DB::table('invoices')->where('customerId','=', $customerId)->get()->toArray();   
        $data=DataTables::of($table)
        

        ->editColumn('id', function($data){ 
            return ''.$data->id;
        })
        ->editColumn('created_at', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s'); return $formatedDate; })
        ->editColumn('expiryDate', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->expiryDate)->format('d-m-Y H:i:s'); return $formatedDate; })

        ->editColumn('services', function($data) {
            $services = collect([
                $data->umzugId ? 'Umzug': NULL,
                $data->einpackId ? 'Einpack': NULL,
                $data->auspackId ? 'Auspack': NULL,
                $data->reinigungId ? 'Reinigung': NULL,
                $data->reinigung2Id ? 'Reinigung 2': NULL,
                $data->entsorgungId ? 'Entsorgung': NULL,
                $data->transportId ? 'Transport': NULL,
                $data->lagerungId ? 'Lagerung': NULL,
                $data->materialId ? 'Material': NULL,
            ])->implode(' ');
           
            return $services;
        
        })
        ->addColumn('option',function($table) 
        {
            return '
            <a class="btn btn-sm  btn-primary" href="'.route('invoice.detail',['id'=>$table->id]).'"><i class="feather feather-eye" ></i></a> <span class="text-primary">|</span>
            <a class="btn btn-sm  btn-edit" href="'.route('invoice.edit',['id'=>$table->id]).'"><i class="feather feather-edit" ></i></a> <span class="text-primary">|</span>
            <a class="btn btn-sm  btn-danger"  href="'.route('invoice.delete',['id'=>$table->id]).'"><i class="feather feather-trash-2" ></i></a>';
        })
        ->rawColumns(['option'])
        ->make(true);

        return $data;
    }
    
    public function store(Request $request)
    {
            // $lagerunMailer = LagerungMailer::where('startDate',Carbon::now()->format('Y-m-d'))
            //     ->get();
            
            // foreach ($lagerunMailer as $lagerunMailer) {
            //     $invoicePdf = Invoice::where('id',$lagerunMailer['invoiceId'])->first();
            //     if($invoicePdf)
            //     {
            //         $CustomerMail = Customer::where('id',$lagerunMailer['customerId'])->first();
            //         $customerData =  Customer::where('id',$lagerunMailer['customerId'])->first();
            //         $lagerungPdf = InvoiceLagerung::where('id',$lagerunMailer['lagerungId'])->first();
    
            //         $pdfData = [
            //             'invoiceNumber' => $lagerunMailer['invoiceId'],
            //             'invoice' => $invoicePdf,
            //             'customer' => $customerData,
            //             'lagerung' => $lagerungPdf,
            //         ];
    
            //         $pdf = Pdf::loadView('lagerungPdf', $pdfData);
            //         $pdf->setPaper('A4');
    
            //         $emailData = [
            //             'invoiceNumber' => $lagerunMailer['invoiceId'],
            //             'name' => $CustomerMail['name'],
            //             'gender' => $customerData['gender'],
            //             'surname' => $CustomerMail['surname'],
            //             'companyName'=>Company::InfoCompany('name'),
            //             'sub' => 'Lagerung Bill Reminder',
            //             'from' => Company::InfoCompany('email'),
            //             'pdf' => $pdf,
            //         ];
            //     Mail::to($CustomerMail['email'])->send(new LagerungMail($emailData));
            //     }
            // }
        //Invoice Variables

            $customerId = $request->route('id');
            $invoiceUmzugId = NULL;
            $invoiceEinpackId = NULL;
            $invoiceAuspackId = NULL;
            $invoiceReinigungId = NULL;
            $invoiceReinigung2Id = NULL;
            $invoiceEntsorgungId = NULL;
            $invoiceTransportId = NULL;
            $invoiceLagerungId = NULL;
            $invoiceMaterialId = NULL;
        //Invoice Variables

        // Mail Variables
            $mailSuccess = NULL;
            $isEmailSend = $request->get('isEmail');
            $isCustomEmailSend = $request->get('isCustomEmail');
            $customEmail = $request->get('customEmail');
        // Mail Variables

        // Umzug
            if($request->isUmzug)
            {
                $invoiceUmzug = [
                    'umzugDate' => $request->umzugDate,
                    'umzugHour' => $request->umzugHours,
                    'umzugChf' => $request->umzugChf,
                    'umzugHour2' => $request->umzugHours2,
                    'umzugChf2' => $request->umzugChf2,
                    'umzugRoadChf' => $request->umzugRoadChf,
                    'extra1' => $request->masraf ? $request->extra1 : Null,
                    'extra2'=> $request->masraf1 ? $request->extra2 : Null,
                    'extra3'=> $request->masraf2 ? $request->extra3 : Null,
                    'extra4'=> $request->masraf3 ? $request->extra4 : Null,
                    'extra5'=> $request->masraf4 ? $request->extra5 : Null,
                    'extra6'=> $request->masraf5 ? $request->extra6 : Null,
                    'extra7'=> $request->masraf6 ? $request->extra7 : Null,
                    'extra8'=> $request->masraf7 ? $request->extra8 : Null,
                    'extra9'=> $request->masraf8 ? $request->extra9 : Null,
                    'extra10'=> $request->masraf9 ? $request->extra10 : Null,
                    'extra11'=> $request->masraf10 ? $request->extra11 : Null,
                    'extraText1' => $request->extra12CostText,
                    'extraValue1' => $request->extra12Cost,
                    'extraText2' => $request->extra13CostText,
                    'extraValue2'=> $request->extra13Cost,
                    'discount' => $request->umzugDiscount,
                    'discount2' => $request->umzugDiscount2,
                    'discountPercent' => $request->umzugDiscountPercent,
                    'extraDiscountText1' => $request->umzugExtraDiscountText,
                    'extraDiscountValue1' => $request->umzugExtraDiscount,
                    'extraDiscountText2' => $request->umzugExtraDiscountText2,
                    'extraDiscountValue2' => $request->umzugExtraDiscount2,
                    'umzugCost' => $request->umzugCost,
                    'umzugFixedCost' => $request->umzugFixedPrice,
                    'umzugPaid1' => $request->umzugPaid1,
                    'umzugPaid2' => $request->umzugPaid2,
                    'umzugPaid3' => $request->umzugPaid3,
                    'umzugTotalPrice' => $request->umzugTotalPrice
                ];
                InvoiceUmzug::create($invoiceUmzug);
                $invoiceUmzugIdBul = DB::table('invoice_umzugs')->orderBy('id','DESC')->first();
                $invoiceUmzugId = $invoiceUmzugIdBul->id;
            }
        // Umzug

        // Einpack
            if($request->isEinpack)
            {
                $invoiceEinpack = [
                    'einpackDate' => $request->einpackDate,
                    'einpackHour' => $request->einpackHours,
                    'einpackChf' => $request->einpackChf,
                    'einpackHour2' => $request->einpackHours2,
                    'einpackChf2' => $request->einpackChf2,
                    'einpackRoadChf' => $request->einpackRoadChf,
                    'extra1' => $request->einpackMasraf ? $request->einpackExtra1 : Null,
                    'extra2'=> $request->einpackMasraf1 ? $request->einpackExtra2 : Null,
                    'extraText1' => $request->einpackExtra1CostText,
                    'extraValue1' => $request->einpackExtra1Cost,
                    'extraText2' => $request->einpackExtra2CostText,
                    'extraValue2'=> $request->einpackExtra2Cost,
                    'discount' => $request->einpackDiscount,
                    'discount2' => $request->einpackDiscount2,
                    'discountPercent' => $request->einpackDiscountPercent,
                    'extraDiscountText1' => $request->einpackExtraDiscountText,
                    'extraDiscountValue1' => $request->einpackExtraDiscount,
                    'extraDiscountText2' => $request->einpackExtraDiscountText2,
                    'extraDiscountValue2' => $request->einpackExtraDiscount2,
                    'einpackCost' => $request->einpackCost,
                    'einpackFixedCost' => $request->einpackFixedPrice,
                    'einpackPaid1' => $request->einpackPaid1,
                    'einpackPaid2' => $request->einpackPaid2,
                    'einpackPaid3' => $request->einpackPaid3,
                    'einpackTotalPrice' => $request->einpackTotalPrice
                ];

                InvoiceEinpack::create($invoiceEinpack);
                $invoiceEinpackIdBul = DB::table('invoice_einpacks')->orderBy('id','DESC')->first();
                $invoiceEinpackId = $invoiceEinpackIdBul->id;
            }
        // Einpack

        // Auspack
            if($request->isAuspack)
            {
                $invoiceAuspack = [
                    'auspackDate' => $request->auspackDate,
                    'auspackHour' => $request->auspackHours,
                    'auspackChf' => $request->auspackChf,
                    'auspackHour2' => $request->auspackHours2,
                    'auspackChf2' => $request->auspackChf2,
                    'auspackRoadChf' => $request->auspackRoadChf,
                    'extra1' => $request->auspackMasraf ? $request->auspackExtra1 : Null,
                    'extra2'=> $request->auspackMasraf1 ? $request->auspackExtra2 : Null,
                    'extraText1' => $request->auspackExtra1CostText,
                    'extraValue1' => $request->auspackExtra1Cost,
                    'extraText2' => $request->auspackExtra2CostText,
                    'extraValue2'=> $request->auspackExtra2Cost,
                    'discount' => $request->auspackDiscount,
                    'discount2' => $request->auspackDiscount2,
                    'discountPercent' => $request->auspackDiscountPercent,
                    'extraDiscountText1' => $request->auspackExtraDiscountText,
                    'extraDiscountValue1' => $request->auspackExtraDiscount,
                    'extraDiscountText2' => $request->auspackExtraDiscountText2,
                    'extraDiscountValue2' => $request->auspackExtraDiscount2,
                    'auspackCost' => $request->auspackCost,
                    'auspackFixedCost' => $request->auspackFixedPrice,
                    'auspackPaid1' => $request->auspackPaid1,
                    'auspackPaid2' => $request->auspackPaid2,
                    'auspackPaid3' => $request->auspackPaid3,
                    'auspackTotalPrice' => $request->auspackTotalPrice
                ];

                InvoiceAuspack::create($invoiceAuspack);
                $invoiceAuspackIdBul = DB::table('invoice_auspacks')->orderBy('id','DESC')->first();
                $invoiceAuspackId = $invoiceAuspackIdBul->id;
            }
        // Auspack
    
        //Reinigung
            if($request->isReinigung)
            {
                $invoiceReinigung = [
                    'reinigungDate' => $request->reinigungDate,
                    'reinigungType' => $request->reinigungTypeManuel ? $request->reinigungTypeManuel : $request->reinigungType,
                    'extraReinigung' => $request->extraReinigung,
                    'reinigungRoom' => $request->reinigungFixedRoom,
                    'reinigungFixedPrice' => $request->reinigungFixedPrice,
                    'reinigungHours' => $request->reinigungHours,
                    'reinigungChf' => $request->reinigungChf,
                    'extra1'=> $request->reinigungMasraf1 ? $request->reinigungExtra1 : Null,
                    'extra2' => $request->reinigungMasraf2 ? $request->reinigungExtra2 : Null,
                    'extra3' =>  $request->reinigungMasraf3 ? $request->reinigungExtra3 : Null,
                    'extraText1' => $request->reinigungExtra1CostText,
                    'extraValue1'=> $request->reinigungExtra1Cost,
                    'extraText2' => $request->reinigungExtra2CostText,
                    'extraValue2' => $request->reinigungExtra2Cost,
                    'discount' => $request->reinigungDiscount,
                    'discount2' => $request->reinigungDiscount2,
                    'discountPercent' => $request->reinigungDiscountPercent,
                    'extraDiscountText1' => $request->reinigungExtraDiscountText,
                    'extraDiscountValue1' => $request->reinigungExtraDiscount,
                    'extraDiscountText2' => $request->reinigungExtraDiscountText2,
                    'extraDiscountValue2' => $request->reinigungExtraDiscount2,
                    'reinigungCost' => $request->reinigungCost,
                    'reinigungPaid1' => $request->reinigungPaid1,
                    'reinigungPaid2' => $request->reinigungPaid2,
                    'reinigungPaid3' => $request->reinigungPaid3,
                    'reinigungTotalPrice' => $request->reinigungTotalPrice
                ];

                InvoiceReinigung::create($invoiceReinigung);
                $invoiceReinigungIdBul = DB::table('invoice_reinigungs')->orderBy('id','DESC')->first();
                $invoiceReinigungId = $invoiceReinigungIdBul->id;
            }
        //Reinigung

        //Reinigung 2
            if($request->isReinigung2)
            {
                $invoiceReinigung2 = [
                    'reinigungDate' => $request->reinigung2Date,
                    'reinigungType' => $request->reinigung2TypeManuel ? $request->reinigung2TypeManuel : $request->reinigung2Type,
                    'extraReinigung' => $request->extraReinigung2,
                    'reinigungRoom' => $request->reinigung2FixedRoom,
                    'reinigungFixedPrice' => $request->reinigung2FixedPrice,
                    'reinigungHours' => $request->reinigung2Hours,
                    'reinigungChf' => $request->reinigung2Chf,
                    'extra1'=> $request->reinigung2Masraf1 ? $request->reinigung2Extra1 : Null,
                    'extra2' => $request->reinigung2Masraf2 ? $request->reinigung2Extra2 : Null,
                    'extra3' =>  $request->reinigung2Masraf3 ? $request->reinigung2Extra3 : Null,
                    'extraText1' => $request->reinigung2Extra1CostText,
                    'extraValue1'=> $request->reinigung2Extra1Cost,
                    'extraText2' => $request->reinigung2Extra2CostText,
                    'extraValue2' => $request->reinigung2Extra2Cost,
                    'discount' => $request->reinigung2Discount,
                    'discount2' => $request->reinigung2Discount2,
                    'discountPercent' => $request->reinigung2DiscountPercent,
                    'extraDiscountText1' => $request->reinigung2ExtraDiscountText,
                    'extraDiscountValue1' => $request->reinigung2ExtraDiscount,
                    'extraDiscountText2' => $request->reinigung2ExtraDiscountText2,
                    'extraDiscountValue2' => $request->reinigung2ExtraDiscount2,
                    'reinigungCost' => $request->reinigung2Cost,
                    'reinigungPaid1' => $request->reinigung2Paid1,
                    'reinigungPaid2' => $request->reinigung2Paid2,
                    'reinigungPaid3' => $request->reinigung2Paid3,
                    'reinigungTotalPrice' => $request->reinigung2TotalPrice
                ];

                InvoiceReinigung::create($invoiceReinigung2);
                $invoiceReinigung2IdBul = DB::table('invoice_reinigungs')->orderBy('id','DESC')->first();
                $invoiceReinigung2Id = $invoiceReinigung2IdBul->id;
            }
        //Reinigung 2

        //Entsorgung
            if($request->isEntsorgung)
            {
                $invoiceEntsorgung = [
                    'entsorgungDate' => $request->entsorgungDate,
                    'entsorgungVolume' => $request->entsorgungVolume,
                    'entsorgungFixedChf' => $request->entsorgungFixedChf,
                    'entsorgungFixedChfCost' => $request->entsorgungFixedChfCost,
                    'entsorgungHours' => $request->entsorgungHours,
                    'entsorgungChf' => $request->entsorgungChf,
                    'entsorgungRoadChf' => $request->entsorgungRoadChf,
                    'extra1'=> $request->entsorgungMasraf ? $request->entsorgungExtra1 : Null,
                    'extraText1' => $request->entsorgungExtra1CostText,
                    'extraValue1' =>  $request->entsorgungExtra1Cost,
                    'extraText2' => $request->entsorgungExtra2CostText,
                    'extraValue2'=> $request->entsorgungExtra2Cost,
                    'discount' => $request->entsorgungDiscount,
                    'discount2' => $request->entsorgungDiscount2,
                    'discountPercent' => $request->entsorgungDiscountPercent,
                    'extraDiscountText1' => $request->entsorgungExtraDiscountText,
                    'extraDiscountValue1' => $request->entsorgungExtraDiscount,
                    'extraDiscountText2' => $request->entsorgungExtraDiscountText2,
                    'extraDiscountValue2' => $request->entsorgungExtraDiscount2,
                    'entsorgungCost' => $request->entsorgungCost,
                    'entsorgungFixedCost' => $request->entsorgungFixedPrice,
                    'entsorgungPaid1' => $request->entsorgungPaid1,
                    'entsorgungPaid2' => $request->entsorgungPaid2,
                    'entsorgungTotalPrice' => $request->entsorgungTotalPrice,
                ];

                InvoiceEntsorgung::create($invoiceEntsorgung);
                $invoiceEntsorgungIdBul = DB::table('invoice_entsorgungs')->orderBy('id','DESC')->first();
                $invoiceEntsorgungId = $invoiceEntsorgungIdBul->id;
            }
        //Entsorgung

        //Transport
            if($request->isTransport)
            {
                $invoiceTransport = [
                    'pdfText' => $request->pdfText,
                    'transportDate' => $request->transportDate,
                    'transportFixedTariff' => $request->transportFixedTariff,
                    'transportHours' => $request->transportHours,
                    'transportChf' => $request->transportChf,
                    'transportHours2' => $request->transportHours2,
                    'transportChf2' => $request->transportChf2,
                    'transportRoadChf'=> $request->transportRoadChf,
                    'extraText1' => $request->transportExtra1CostText,
                    'extraValue1' =>  $request->transportExtra1Cost,
                    'extraText2' => $request->transportExtra2CostText,
                    'extraValue2'=> $request->transportExtra2Cost,
                    'extraText3' => $request->transportExtra3CostText,
                    'extraValue3' =>  $request->transportExtra3Cost,
                    'extraText4' => $request->transportExtra4CostText,
                    'extraValue4'=> $request->transportExtra4Cost,
                    'extraText5' => $request->transportExtra5CostText,
                    'extraValue5' =>  $request->transportExtra5Cost,
                    'extraText6' => $request->transportExtra6CostText,
                    'extraValue6'=> $request->transportExtra6Cost,
                    'extraText7' => $request->transportExtra7CostText,
                    'extraValue7'=> $request->transportExtra7Cost,
                    'discount' => $request->transportDiscount,
                    'discount2' => $request->transportDiscount2,
                    'discountPercent' => $request->transportDiscountPercent,
                    'extraDiscountText1' => $request->transportExtraDiscountText,
                    'extraDiscountValue1' => $request->transportExtraDiscount,
                    'extraDiscountText2' => $request->transportExtraDiscountText2,
                    'extraDiscountValue2' => $request->transportExtraDiscount2,
                    'transportCost' => $request->transportCost,
                    'transportFixedCost' => $request->transportFixedPrice,
                    'transportPaid1' => $request->transportPaid1,
                    'transportPaid2' => $request->transportPaid2,
                    'transportPaid3' => $request->transportPaid3,
                    'transportTotalPrice' => $request->transportTotalPrice,
                ];

                InvoiceTransport::create($invoiceTransport);
                $invoiceTransportIdBul = DB::table('invoice_transports')->orderBy('id','DESC')->first();
                $invoiceTransportId = $invoiceTransportIdBul->id;
            }
        //Transport

        //Lagerung
            if($request->isLagerung)
            {
                $invoiceLagerung = [
                    'lagerungStartDate' => $request->lagerungStartDate,
                    'lagerungEndDate' => $request->lagerungEndDate,
                    'lagerungVolume' => $request->lagerungVolume,
                    'lagerungChf' => $request->lagerungChf,
                    'extraText1' => $request->lagerungExtra1CostText,
                    'extraValue1' => $request->lagerungExtra1Cost,
                    'extraText2' => $request->lagerungExtra2CostText,
                    'extraValue2'=> $request->lagerungExtra2Cost,
                    'discount' => $request->lagerungDiscount,
                    'discount2' =>  $request->lagerungDiscount2,
                    'discountPercent' => $request->lagerungDiscountPercent,
                    'extraDiscountText1' => $request->lagerungExtraDiscountText,
                    'extraDiscountValue1'=> $request->lagerungExtraDiscount,
                    'extraDiscountText2' => $request->lagerungExtraDiscountText2,
                    'extraDiscountValue2' =>  $request->lagerungExtraDiscount2,
                    'lagerungCost' => $request->lagerungCost,
                    'lagerungFixedCost'=> $request->lagerungFixedPrice,
                    'lagerungPaid1' => $request->lagerungPaid1,
                    'lagerungPaid2' =>  $request->lagerungPaid2,
                    'lagerungTotalPrice' => $request->lagerungTotalPrice,
                ];

                

                
                InvoiceLagerung::create($invoiceLagerung);
                $invoiceLagerungIdBul = DB::table('invoice_lagerungs')->orderBy('id','DESC')->first();
                $invoiceLagerungId = $invoiceLagerungIdBul->id;

                
            }
        //Lagerung

        //Material
            if($request->isVerpackungsmaterial)
            {
                $all = $request->except('_token');
                $invoiceMaterial = [
                    'discount' => $request->materialDiscount,
                    'discountPercent' => $request->materialDiscountPercent,
                    'customDiscountText' => $request->materialExtraDiscount,
                    'customDiscountValue' => $request->materialExtraDiscountValue,
                    'deliverPrice' => $request->materialShipPrice,
                    'recievePrice' => $request->materialRecievePrice,
                    'totalPrice' => $request->materialTotalPrice
                ];

                $material = InvoiceMaterial::create($invoiceMaterial);
                $invoiceMaterialIdBul = DB::table('invoice_materials')->orderBy('id','DESC')->first();
                $invoiceMaterialId = $invoiceMaterialIdBul->id;

                if($material)
                {
                    $islem = $all['islem'];
                    unset($all['islem']);
                    if(count($islem) !=0) {
                        foreach($islem as $k => $v)
                        {
                            $invoiceBasket = [
                                'productId' => $v['urunId'],
                                'buyType' => $v['buyType'],
                                'quantity' => $v['adet'],
                                'totalPrice' => $v['toplam'],
                                'materialId' => $invoiceMaterialId
                            ];
                            InvoiceBasket::create($invoiceBasket);
                        }
                    }
                }
            }
        //Material

        // Invoice
            $payDay = $request->payCondition;
            $gun = 0;

            switch($payDay){
                case(1):
                    $gun = 7;
                break;
                case(2):
                    $gun = 14;
                break;
                case(3):
                    $gun = 31;
                break;
            };
            
            $invoice = [
                'customerId' => $customerId,
                'payCondition' => $request->payCondition,
                'status' => 'Ödenmedi',
                'expiryDate' => Carbon::now()->addDays($gun),
                'umzugId' => $invoiceUmzugId,
                'street' => $request->invoiceStreet,
                'plz' => $request->invoicePostCode,
                'ort' => $request->invoiceOrt,
                'land' => $request->invoiceLand,
                'einpackId' => $invoiceEinpackId,
                'auspackId' => $invoiceAuspackId,
                'reinigungId' => $invoiceReinigungId,
                'reinigung2Id' => $invoiceReinigung2Id,
                'entsorgungId' => $invoiceEntsorgungId,
                'transportId' => $invoiceTransportId,
                'lagerungId' => $invoiceLagerungId,
                'materialId' => $invoiceMaterialId,
                'warningPrice' => $request->invoiceWarningPrice,
                'totalPrice' => $request->invoiceTotalPrice,
                'withTax' =>$request->kdvType,
                'withoutTax' =>$request->kdvType1,
                'freeTax' => $request->kdvType2,
            ];

            $create = Invoice::create($invoice);
            $invoiceIdBul = DB::table('invoices')->orderBy('id','DESC')->first();
            $invoiceId = $invoiceIdBul->id;
           

            
        // Invoice
        
        // SMS
        if($request->isSMS)
        {
            $customerId = $request->route('id');
            $customer = Customer::where('id',$customerId)->first();
        
            $basic  = new \Vonage\Client\Credentials\Basic("07fc1e6c", "J4i0Q5bZDupy1zIa");
            $client = new \Vonage\Client($basic);

            $number = $request->mobile;
            $staticContent = 'Herr'.' '.$customer['name'].' '.$customer['surname'].','.' ';
            $content ='Ihr Angebot wurde erstellt From Swiss';
            $staticContent2 = ' '.Company::InfoCompany('name');
           
            if($request->isCustomSMS)
            {
                $content = $request->customSMS;
                $response = $client->sms()->send(
                    new \Vonage\SMS\Message\SMS($number, 'BRAND_NAME', $staticContent.$content.$staticContent2)
                );
                
                
            }
            else{
                $response = $client->sms()->send(
                    new \Vonage\SMS\Message\SMS($number, 'BRAND_NAME', $staticContent.$content.$staticContent2)
                );
                
                
            }
        }
        // SMS

        $sub = 'Ihre Rechnung wurde erstellt';
        $from = Company::InfoCompany('email'); // gösterilen mail.
        $companyName = Company::InfoCompany('name'); // şirket adı buraya yaz veritabanında yok çünkü.
        $customer=DB::table('customers')->where('id','=', $customerId)->value('name'); // Customer Name
        $customerSurname=DB::table('customers')->where('id','=', $customerId)->value('surname');
        $customerData = Customer::where('id',$customerId)->first();
        
        
        $customerData =  Customer::where('id',$customerId)->first();
        $invoicePdf = Invoice::where('id',$invoiceId)->first();
        $umzugPdf = InvoiceUmzug::where('id',$invoiceUmzugId)->first();
        $einpackPdf = InvoiceEinpack::where('id',$invoiceEinpackId)->first();
        $auspackPdf = InvoiceAuspack::where('id',$invoiceAuspackId)->first();
        $reinigungPdf = InvoiceReinigung::where('id',$invoiceReinigungId)->first();
        $reinigungPdf2 = InvoiceReinigung::where('id',$invoiceReinigung2Id)->first();
        $entsorgungPdf = InvoiceEntsorgung::where('id',$invoiceEntsorgungId)->first();
        $transportPdf = InvoiceTransport::where('id',$invoiceTransportId)->first();
        $lagerungPdf = InvoiceLagerung::where('id',$invoiceLagerungId)->first();
        $materialPdf = InvoiceMaterial::where('id',$invoiceMaterialId)->first();
        $basketPdf = InvoiceBasket::where('materialId',$invoiceMaterialId)->get()->toArray();


        $pdfData = [
            'invoiceNumber' => $invoiceId,
            'invoice' => $invoicePdf,
            'customer' => $customerData,
            'isUmzug' => $request->isUmzug,
            'isEinpack' => $request->isEinpack,
            'isAuspack' => $request->isAuspack,
            'isReinigung' => $request->isReinigung,
            'isReinigung2' => $request->isReinigung2,
            'isEntsorgung' => $request->isEntsorgung,
            'isTransport' => $request->isTransport,
            'isLagerung' => $request->isLagerung,
            'isMaterial' => $request->isVerpackungsmaterial,
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

        $pdf = Pdf::loadView('invoicePdf', $pdfData);
        $pdf->setPaper('A4');

        $emailData = [
            'invoiceNumber' => $invoiceId,
            'name' => $customer,
            'surname' => $customerSurname,
            'gender' => $customerData['gender'],
            'sub' => $sub,
            'from' => $from,
            'companyName' => $companyName,
            'email' => $request->email,
            'emailContent'=> $request->emailContent,
            'isCustomEmailSend' => $isCustomEmailSend,
            'customEmailContent' => $customEmail,
            'pdf' => $pdf,
        ];

        // Otomatik Lagerung Mail
        if($invoicePdf['lagerungId'])
        {
            $startDate = \Carbon\Carbon::parse($request->lagerungStartDate)->format('Y-m-d');
            $endDate = \Carbon\Carbon::parse($request->lagerungEndDate)->format('Y-m-d');
            // $period = \Carbon\CarbonPeriod::create($startDate,'1 month',$endDate);
            $period = \Carbon\CarbonPeriod::since($startDate)->days(30)->until($endDate);

            $lagerungMailer = [];

            foreach ($period as $date) {

                $lagerungMailer = [
                    'customerId' => $customerId,
                    'invoiceId' => $invoiceId,
                    'lagerungId' => $invoicePdf['lagerungId'],
                    'startDate' => $date->format('Y-m-d'),
                    'startTime' => '19:03:00',
                    'endTime' => '19:03:00',
                ];

                LagerungMailer::create($lagerungMailer);
            }
            
        }

        if ($isCustomEmailSend)
        {
            Arr::set($emailData, 'customEmailContent', $customEmail);
        }

        if($create)
        {
            $mailSuccess = '';
            if($isEmailSend)
            {
                Mail::to($emailData['email'])->send(new invoiceMail($emailData));
                $mailSuccess = ', E-Mail und Rechnung erfolgreich versendet.';
            } 
            return redirect()
                    ->route('customer.detail', ['id' => $customerId])
                    ->with('status','Rechnung erfolgreich erstellt..'.' '.'Belegnummer:'.' '.$invoiceId.' '.$mailSuccess)
                    ->with('cat', 'Rechnung')
                    ->withInput()
                    ->with('keep_status', true);
        }
        else {
            return redirect()->back()->with('status','Fehler: Rechnung konnte nicht erstellt werden.');
        }
    }

    public function delete($id)
    {
        $c = Invoice::where('id',$id)->count();
        
        if($c !=0)
        {
            $data = Invoice::where('id',$id)->first();
            $umzug = InvoiceUmzug::where('id',$data['invoiceUmzugId'])->delete();
            $einpack = InvoiceEinpack::where('id',$data['invoiceEinpackId'])->delete();
            $auspack = InvoiceAuspack::where('id',$data['invoiceAuspackId'])->delete();
            $reinigung = InvoiceReinigung::where('id',$data['invoiceReinigungId'])->delete();
            $reinigung2 = InvoiceReinigung::where('id',$data['invoiceReinigung2Id'])->delete();
            $entsorgung = InvoiceEntsorgung::where('id',$data['invoiceEntsorgungId'])->delete();
            $transport = InvoiceTransport::where('id',$data['invoiceTransportId'])->delete();
            $lagerung = InvoiceLagerung::where('id',$data['invoiceLagerungId'])->delete();
            $basket = InvoiceBasket::where('materialId',$data['invoiceMaterialId'])->delete();
            $material = InvoiceMaterial::where('id',$data['invoiceMaterialId'])->delete();
            $lagerungMailer = LagerungMailer::where('lagerungId',$data['invoiceLagerungId'])->delete();
            Invoice::where('id',$id)->delete();

            return redirect()
                    ->route('customer.detail', ['id' => $d['customerId']])
                    ->with('status','Rechnung erfolgreich gelöscht.')
                    ->with('cat', 'Rechnung')
                    ->withInput()
                    ->with('keep_status', true);
        }
        else {
            return redirect('/');
        }
    }
    public function showPdf($id)
    {
        $invoicePdf = Invoice::where('id',$id)->first();
        $customerData =  Customer::where('id',$invoicePdf['customerId'])->first();
        $umzugPdf = InvoiceUmzug::where('id',$invoicePdf['umzugId'])->first();
        $einpackPdf = InvoiceEinpack::where('id',$invoicePdf['einpackId'])->first();
        $auspackPdf = InvoiceAuspack::where('id',$invoicePdf['auspackId'])->first();
        $reinigungPdf = InvoiceReinigung::where('id',$invoicePdf['reinigungId'])->first();
        $reinigungPdf2 = InvoiceReinigung::where('id',$invoicePdf['reinigung2Id'])->first();
        $entsorgungPdf = InvoiceEntsorgung::where('id',$invoicePdf['entsorgungId'])->first();
        $transportPdf = InvoiceTransport::where('id',$invoicePdf['transportId'])->first();
        $lagerungPdf = InvoiceLagerung::where('id',$invoicePdf['lagerungId'])->first();
        $materialPdf = InvoiceMaterial::where('id',$invoicePdf['materialId'])->first();
        $basketPdf = InvoiceBasket::where('materialId',$invoicePdf['materialId'])->get()->toArray();

        $pdfData = [
            'invoiceNumber' => $id,
            'invoice' => $invoicePdf,
            'customer' => $customerData,
            'isUmzug' => $umzugPdf,
            'isEinpack' => $einpackPdf,
            'isAuspack' => $auspackPdf,
            'isReinigung' => $reinigungPdf,
            'isReinigung2' => $reinigungPdf2,
            'isEntsorgung' => $entsorgungPdf,
            'isTransport' => $transportPdf,
            'isLagerung' => $lagerungPdf,
            'isMaterial' => $materialPdf,
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

        $pdf = Pdf::loadView('invoicePdf', $pdfData);
        return $pdf->stream();
    }
}
