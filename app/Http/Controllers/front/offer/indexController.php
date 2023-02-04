<?php

namespace App\Http\Controllers\front\offer;

use App\Http\Controllers\Controller;
use App\Mail\OfferMail;
use App\Models\Company;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Arr;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Offers;
use App\Models\OfferVerify;
use App\Models\Task;
use App\Models\WorkerBasket;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class indexController extends Controller
{
    public function index()
    { 
        return view('front.offer.index');
    }

    public function updatedOffer(Request $request)
    {
        $customerId = $request->route('customerId');
        $id = $request->route('id');

        $data = offerte::where('id',$id)->first();
        $data2 = DB::table('offertes')->where('customerId','=', $customerId)->where('mainOfferteId', '=', $id)->get()->toArray();   
        return view('front.offer.updatedOffer',['data' => $data,'data2'=>$data2]);
    }

    public function updatedData(Request $request)
    {
        $customerId = $request->route('customerId');
        $id = $request->route('id');

        $table= DB::table('offertes')->where('customerId','=', $customerId)->where('mainOfferteId', '=', $id)->get()->toArray();   
        $data=DataTables::of($table)
        
        ->editColumn('id', function($data){ 
            return ''.$data->id;
        })
        ->editColumn('created_at', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s'); return $formatedDate; })
        ->editColumn('services', function($data) {

            $services = collect([
                $data->offerteUmzugId ? 'Umzug': NULL,
                $data->offerteEinpackId ? 'Einpack': NULL,
                $data->offerteAuspackId ? 'Auspack': NULL,
                $data->offerteReinigungId ? 'Reinigung': NULL,
                $data->offerteReinigung2Id ? 'Reinigung 2': NULL,
                $data->offerteEntsorgungId ? 'Entsorgung': NULL,
                $data->offerteTransportId ? 'Transport': NULL,
                $data->offerteLagerungId ? 'Lagerung': NULL,
                $data->offerteMaterialId ? 'Material': NULL,
            ])->implode(' ');
           
            return $services;
        })

        ->addColumn('option',function($table) 
        {
            return '
            <a title="Detail" class="btn btn-sm  btn-primary" href="'.route('offer.detail',['id'=>$table->id]).'"><i class="feather feather-eye" ></i></a> <span class="text-primary">|</span>
            <a title="Edit" class="btn btn-sm  btn-edit" href="'.route('offer.edit',['id'=>$table->id]).'"><i class="feather feather-edit" ></i></a> <span class="text-primary">|</span>
            <a title="Delete" class="btn btn-sm  btn-danger"  href="'.route('offer.delete',['id'=>$table->id]).'"><i class="feather feather-trash-2" ></i></a>';
        })
        ->rawColumns(['option'])
        ->make(true);

        return $data;
    }

    public function data(Request $request)
    {
        $customerId = $request->route('id');

        $table= DB::table('offertes')->where('customerId','=', $customerId)->where('mainOfferteId', '=', NULL)->get()->toArray();   
        $data=DataTables::of($table)
        
        ->editColumn('id', function($data){ 
            return ''.$data->id;
        })
        ->editColumn('created_at', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s'); return $formatedDate; })
        ->editColumn('services', function($data) {

            $services = collect([
                $data->offerteUmzugId ? 'Umzug': NULL,
                $data->offerteEinpackId ? 'Einpack': NULL,
                $data->offerteAuspackId ? 'Auspack': NULL,
                $data->offerteReinigungId ? 'Reinigung': NULL,
                $data->offerteReinigung2Id ? 'Reinigung 2': NULL,
                $data->offerteEntsorgungId ? 'Entsorgung': NULL,
                $data->offerteTransportId ? 'Transport': NULL,
                $data->offerteLagerungId ? 'Lagerung': NULL,
                $data->offerteMaterialId ? 'Material': NULL,
            ])->implode(' ');
           
            return $services;
        })

        ->addColumn('option',function($table) 
        {
            return '
            <a title="Detail" class="btn btn-sm  btn-primary" href="'.route('offer.detail',['id'=>$table->id]).'"><i class="feather feather-eye" ></i></a> <span class="text-primary">|</span>
            <a title="Edit" class="btn btn-sm  btn-edit" href="'.route('offer.edit',['id'=>$table->id]).'"><i class="feather feather-edit" ></i></a> <span class="text-primary">|</span>
            <a title="Update List" class="btn btn-sm  btn-info" href="'.route('offer.updatedOffer',['customerId'=>$table->customerId,'id'=>$table->id]).'"><i class="feather feather-file" ></i></a> <span class="text-primary">|</span>
            <a title="Delete" class="btn btn-sm  btn-danger"  href="'.route('offer.delete',['id'=>$table->id]).'"><i class="feather feather-trash-2" ></i></a>';
        })
        ->rawColumns(['option'])
        ->make(true);

        return $data;
    }

    public function create($id)
    { 
        $data = Customer::where('id',$id)->first();
        return view('front.offer.create',['data'=>$data]);
    }

    public function store(Request $request)
    { 
        $customerId = $request->route('id');
        $all = $request->except('_token');
        $mailSuccess = NULL;
        $isEmailSend = $request->get('isEmail');
        $isCustomEmailSend = $request->get('isCustomEmail');
        $customEmail = $request->get('customEmail');

        // Tanımlamalar
        $AusId = NULL;
        $AusId2 = NULL;
        $AusId3 = NULL;
        $EinId = NULL;
        $EinId2 = NULL;
        $EinId3 = NULL;
        $offerUmzugId = NULL;
        $offerEinpackId = NULL;
        $offerAuspackId = NULL;
        $offerReinigungId = NULL;
        $offerReinigungId2 = NULL;
        $offerEntsorgungId = NULL;
        $offerTransportId  = NULL;
        $offerLagerungId = NULL;
        $offerMaterialId = NULL;
        $contactPerson = NULL;
        $offerteId = 0;
       
        // Offerte Adresse    
        if($request->ausStreet1)
        {
            $mainAusAdress = [
                'street' => $request->ausStreet1,
                'postCode' => $request->ausPostcode1,
                'city' => $request->ausCity1,
                'country' => $request->ausCountry1,
                'buildType' => $request->ausBuildType1,
                'floor' => $request->ausFloorType1,
                'lift' => $request->isAusLift1,
                'addressType' => 0   
            ];

            offerteAddress::create($mainAusAdress);
            $mainAusAdress = DB::table('offerte_addresses')->where('addressType' ,'=', 0)->orderBy('id','DESC')->first();
            $AusId = $mainAusAdress->id;
        }
        
        if($request->ausStreet2)
        {
            $mainAusAdress = [
                'street' => $request->ausStreet2,
                'postCode' => $request->ausPostcode2,
                'city' => $request->ausCity2,
                'country' => $request->ausCountry2,
                'buildType' => $request->ausBuildType2,
                'floor' => $request->ausFloorType2,
                'lift' => $request->isAusLift2,
                'addressType' => 0   
            ];

            offerteAddress::create($mainAusAdress);
            $mainAusAdress = DB::table('offerte_addresses')->where('addressType' ,'=', 0)->orderBy('id','DESC')->first();
            $AusId2 = $mainAusAdress->id;
        }

        if($request->ausStreet3)
        {
            $mainAusAdress = [
                'street' => $request->ausStreet3,
                'postCode' => $request->ausPostcode3,
                'city' => $request->ausCity3,
                'country' => $request->ausCountry3,
                'buildType' => $request->ausBuildType3,
                'floor' => $request->ausFloorType3,
                'lift' => $request->isAusLift3,
                'addressType' => 0   
            ];

            offerteAddress::create($mainAusAdress);
            $mainAusAdress = DB::table('offerte_addresses')->where('addressType' ,'=', 0)->orderBy('id','DESC')->first();
            $AusId3 = $mainAusAdress->id;
        }
        

        if($request->einStreet1)
        {
            $mainEinAdress = [
                'street' => $request->einStreet1,
                'postCode' => $request->einPostcode1,
                'city' => $request->einCity1,
                'country' => $request->einCountry1,
                'buildType' => $request->einBuildType1,
                'floor' => $request->einFloorType1,
                'lift' => $request->isEinLift1, 
                'addressType' => 1  
            ];

            offerteAddress::create($mainEinAdress);
            $mainEinAdress = DB::table('offerte_addresses')->where('addressType' ,'=', 1)->orderBy('id','DESC')->first();
            $EinId = $mainEinAdress->id;
        }

        
        if($request->einStreet2)
        {
            $mainEinAdress = [
                'street' => $request->einStreet2,
                'postCode' => $request->einPostcode2,
                'city' => $request->einCity2,
                'country' => $request->einCountry2,
                'buildType' => $request->einBuildType2,
                'floor' => $request->einFloorType2,
                'lift' => $request->isEinLift2, 
                'addressType' => 1  
            ];

            offerteAddress::create($mainEinAdress);
            $mainEinAdress = DB::table('offerte_addresses')->where('addressType' ,'=', 1)->orderBy('id','DESC')->first();
            $EinId2 = $mainEinAdress->id;
        }

        if($request->einStreet3)
        {
            $mainEinAdress = [
                'street' => $request->einStreet3,
                'postCode' => $request->einPostcode3,
                'city' => $request->einCity3,
                'country' => $request->einCountry3,
                'buildType' => $request->einBuildType3,
                'floor' => $request->einFloorType3,
                'lift' => $request->isEinLift3, 
                'addressType' => 1  
            ];

            offerteAddress::create($mainEinAdress);
            $mainEinAdress = DB::table('offerte_addresses')->where('addressType' ,'=', 1)->orderBy('id','DESC')->first();
            $EinId3 = $mainEinAdress->id;
        }

        // offerteUmzug
        if($request->isUmzug)
        {
            $offerUmzug = [
                'tariff' => $request->umzugTariff,
                'ma' => $request->umzug1ma,
                'lkw' => $request->umzug1lkw,
                'anhanger' => $request->umzug1anhanger,
                'chf' => $request->umzug1chf,
                'moveDate' => $request->umzugausdate,
                'moveTime' => $request->umzug1time,
                'moveDate2' => $request->umzugeindate,
                'arrivalReturn' => $request->umzugroadChf,
                'montage' => $request->umzugMontaj,
                'moveHours' => $request->umzugHours,
                'extra' => $request->masraf ? $request->extra1 : Null,
                'extra1' => $request->masraf1 ? $request->extra2 : Null,
                'extra2' => $request->masraf2 ? $request->extra3 : Null,
                'extra3' => $request->masraf3 ? $request->extra4 : Null,
                'extra4' => $request->masraf4 ? $request->extra5 : Null,
                'extra5' => $request->masraf5 ? $request->extra6 : Null,
                'extra6' => $request->masraf6 ? $request->extra7 : Null,
                'extra7' => $request->masraf7 ? $request->extra8 : Null,
                'extra8' => $request->masraf8 ? $request->extra9 : Null,
                'extra9' => $request->masraf9 ? $request->extra10 : Null,
                'extra10' => $request->masraf10 ? $request->extra11 : Null,
                'customCostName1' => $request->extra12CostText,
                'customCostPrice1' => $request->extra12Cost,
                'customCostName2' => $request->extra13CostText,
                'customCostPrice2' => $request->extra13Cost,
                'costPrice' => $request->umzugCost,
                'discount' => $request->umzugDiscount,
                'compromiser' => $request->umzugCompromiser,
                'extraCostName' => $request->umzugExtraDiscountText,
                'extraCostPrice' => $request->umzugExtraDiscount,
                'defaultPrice' => $request->umzugTotalPrice,
                'topCost' => $request->umzugTopPrice ?  $request->umzugTopPrice : 0,
                'fixedPrice' => $request->umzugDefaultPrice ? $request->umzugDefaultPrice : 0,
            ];
            OfferteUmzug::create($offerUmzug);
            $offerteUmzugIdBul = DB::table('offerte_umzugs')->orderBy('id','DESC')->first();
            $offerUmzugId = $offerteUmzugIdBul->id;
        }

        if($request->isEinpack)
        {
            $offerEinpack = [
                'tariff' => $request->einpackTariff,
                'ma' => $request->einpack1ma,
                'chf' => $request->einpack1chf,
                'einpackDate' => $request->einpackdate,
                'einpackTime' => $request->einpacktime,
                'arrivalReturn' => $request->einpackroadChf,
                'moveHours' => $request->einpackHours,
                'extra' => $request->einpackmasraf ? $request->einpackextra1 : Null,
                'extra1' => $request->einpackmasraf1 ? $request->einpackextra2 : Null,
                'customCostName1' => $request->einpackCostText1,
                'customCostPrice1' => $request->einpackCost1,
                'customCostName2' => $request->einpackCostText2,
                'customCostPrice2' => $request->einpackCost2,
                'costPrice' => $request->einpackCost,
                'discount' => $request->einpackDiscount,
                'compromiser' => $request->einpackCompromiser,
                'extraCostName' => $request->einpackExtraDiscountText,
                'extraCostPrice' => $request->einpackExtraDiscount,
                'defaultPrice' => $request->einpackTotalPrice,
                'topCost' => $request->einpackTopPrice ?  $request->einpackTopPrice : 0,
                'fixedPrice' => $request->einpackDefaultPrice ? $request->einpackDefaultPrice : 0,
            ];

            OfferteEinpack::create($offerEinpack);
            $offerteEinpackIdBul = DB::table('offerte_einpacks')->orderBy('id','DESC')->first();
            $offerEinpackId = $offerteEinpackIdBul->id;
        }

        if($request->isAuspack)
        {
            $offerAuspack = [
                'tariff' => $request->auspackTariff,
                'ma' => $request->auspack1ma,
                'chf' => $request->auspack1chf,
                'auspackDate' => $request->auspackdate,
                'auspackTime' => $request->auspacktime,
                'arrivalReturn' => $request->auspackroadChf,
                'moveHours' => $request->auspackHours,
                'extra' => $request->auspackmasraf ? $request->auspackextra1 : Null,
                'extra1' => $request->auspackmasraf1 ? $request->auspackextra2 : Null,
                'customCostName1' => $request->auspackCostText1,
                'customCostPrice1' => $request->auspackCost1,
                'customCostName2' => $request->auspackCostText2,
                'customCostPrice2' => $request->auspackCost2,
                'costPrice' => $request->auspackCost,
                'discount' => $request->auspackDiscount,
                'discountPercent' => $request->auspackDiscountPercent,
                'compromiser' => $request->auspackCompromiser,
                'extraCostName' => $request->auspackExtraDiscountText,
                'extraCostPrice' => $request->auspackExtraDiscount,
                'defaultPrice' => $request->auspackTotalPrice,
                'topCost' => $request->auspackTopPrice ?  $request->auspackTopPrice : 0,
                'fixedPrice' => $request->auspackDefaultPrice ? $request->auspackDefaultPrice : 0,
            ];

            OfferteAuspack::create($offerAuspack);
            $offerteAuspackIdBul = DB::table('offerte_auspacks')->orderBy('id','DESC')->first();
            $offerAuspackId = $offerteAuspackIdBul->id;
        }

        if($request->isReinigung)
        {
            $offerReinigung = [
                'reinigungType' => $request->reinigungType,
                'extraReinigung' => $request->extraReinigung,
                'fixedTariff' => $request->reinigungFixedPrice,
                'fixedTariffPrice' => $request->reinigungFixedPriceValue,
                'standartTariff' => $request->reinigungPriceTariff,
                'ma' => $request->reinigungmaValue,
                'chf' => $request->reinigungchfValue,
                'hours' => $request->reinigunghourValue,
                'extraService1' => $request->extraReinigungService1,
                'extraService2' => $request->extraReinigungService2,
                'startDate' => $request->reinigungdate,
                'startTime' => $request->reinigungtime,
                'endDate' => $request->reinigungEnddate,
                'endTime' => $request->reinigungEndtime,
                'extra1' => $request->reinigungmasraf ? $request->reinigungextra1 : Null,
                'extra2' => $request->reinigungmasraf2 ? $request->reinigungextra2 : Null,
                'extra3' => $request->reinigungmasraf3 ? $request->reinigungextra3 : Null,
                'extraCostText1' => $request->reinigungCostText1,
                'extraCostValue1' => $request->reinigungCost1,
                'extraCostText2' => $request->reinigungCostText2,
                'extraCostValue2' => $request->reinigungCost2,
                'discountText' => $request->reinigungExtraDiscountText,
                'discount' => $request->reinigungExtraDiscount,
                'totalPrice' => $request->reinigungTotalPrice,
            ];

            OfferteReinigung::create($offerReinigung);
            $offerteReinigungIdBul = DB::table('offerte_reinigungs')->orderBy('id','DESC')->first();
            $offerReinigungId = $offerteReinigungIdBul->id;
        }

        if($request->isReinigung2)
        {
            $offerReinigung2 = [
                'reinigungType' => $request->reinigungType2,
                'extraReinigung' => $request->extraReinigung2,
                'fixedTariff' => $request->reinigungFixedPrice2,
                'fixedTariffPrice' => $request->reinigungFixedPriceValue2,
                'standartTariff' => $request->reinigungPriceTariff2,
                'ma' => $request->reinigungmaValue2,
                'chf' => $request->reinigungchfValue2,
                'hours' => $request->reinigunghourValue2,
                'extraService1' => $request->extraReinigungService12,
                'extraService2' => $request->extraReinigungService22,
                'startDate' => $request->reinigungdate2,
                'startTime' => $request->reinigungtime2,
                'endDate' => $request->reinigungEnddate2,
                'endTime' => $request->reinigungEndtime2,
                'extra1' => $request->reinigungmasraf2 ? $request->reinigungextra12 : Null,
                'extra2' => $request->reinigungmasraf22 ? $request->reinigungextra22 : Null,
                'extra3' => $request->reinigungmasraf32 ? $request->reinigungextra32 : Null,
                'extraCostText1' => $request->reinigungCostText12,
                'extraCostValue1' => $request->reinigungCost12,
                'extraCostText2' => $request->reinigungCostText22,
                'extraCostValue2' => $request->reinigungCost22,
                'discountText' => $request->reinigungExtraDiscountText2,
                'discount' => $request->reinigungExtraDiscount2,
                'totalPrice' => $request->reinigungTotalPrice2,
            ];

            OfferteReinigung::create($offerReinigung2);
            $offerteReinigungIdBul2 = DB::table('offerte_reinigungs')->orderBy('id','DESC')->first();
            $offerReinigungId2 = $offerteReinigungIdBul2->id;
        }

        if($request->isEntsorgung)
        {
            $offerEntsorgung = [
                'volume' => $request->entsorgungVolume,
                'volumeCHF' => $request->entsorgungVolumeChf,
                'fixedCost' => $request->entsorgungFixedChf,
                'm3' => $request->estimatedVolume,
                'tariff' => $request->entsorgungTariff,
                'ma' => $request->entsorgungma,
                'lkw' => $request->entsorgunglkw,
                'anhanger' => $request->entsorgunganhanger,
                'chf' => $request->entsorgungchf,
                'hour' => $request->entsorgungHours,
                'entsorgungDate' => $request->entsorgungDate,
                'entsorgungTime' => $request->entsorgungTime,
                'arrivalReturn' => $request->entsorgungroadChf,
                'entsorgungExtra1' => $request->entsorgungmasraf ? $request->entsorgungextra1 : Null,
                'extraCostText1' => $request->entsorgungCostText1,
                'extraCostValue1' => $request->entsorgungCost1,
                'extraCostText2' => $request->entsorgungCostText2,
                'extraCostValue2' => $request->entsorgungCost2,
                'discount' => $request->entsorgungDiscount,
                'extraDiscountText' => $request->entsorgungExtraDiscountText,
                'extraDiscountPrice' => $request->entsorgungExtraDiscount,
                'defaultPrice' => $request->entsorgungTotalPrice,
                'topCost' => $request->entsorgungTopPrice,
                'fixedPrice' => $request->entsorgungDefaultPrice,
            ];

            OfferteEntsorgung::create($offerEntsorgung);
            $offerteEntsorgungIdBul = DB::table('offerte_entsorgungs')->orderBy('id','DESC')->first();
            $offerEntsorgungId = $offerteEntsorgungIdBul->id;
        }
        
        if($request->isTransport)
        {
            $offerTransport = [
                'pdfText' => $request->pdfText,
                'fixedChf' => $request->transportFixedTariff,
                'tariff' => $request->transportTariff,
                'ma' => $request->transportma,
                'lkw' => $request->transportlkw,
                'anhanger' => $request->transportanhanger,
                'chf' => $request->transportchf,
                'hour' => $request->transporthour,
                'transportDate' => $request->transportDate,
                'transportTime' => $request->transportTime,
                'arrivalReturn' => $request->transportRoadChf,
                'extraCostText1' => $request->transportCostText1,
                'extraCostValue1' => $request->transportCost1,
                'extraCostText2' => $request->transportCostText2,
                'extraCostValue2' => $request->transportCost2,
                'extraCostText3' => $request->transportCostText3,
                'extraCostValue3' => $request->transportCost3,
                'extraCostText4' => $request->transportCostText4,
                'extraCostValue4' => $request->transportCost4,
                'extraCostText5' => $request->transportCostText5,
                'extraCostValue5' => $request->transportCost5,
                'extraCostText6' => $request->transportCostText6,
                'extraCostValue6' => $request->transportCost6,
                'extraCostText7' => $request->transportCostText7,
                'extraCostValue7' => $request->transportCost7,
                'totalPrice' => $request->transportCost,
                'discount' => $request->transportDiscount,
                'compromiser' => $request->transportCompromiser,
                'extraDiscountText' => $request->transportExtraDiscountText,
                'extraDiscountValue' => $request->transportExtraDiscount,
                'extraDiscountText2' => $request->transportExtraDiscountText2,
                'extraDiscountValue2' => $request->transportExtraDiscount2,
                'defaultPrice' => $request->transportDefaultPrice,
                'topCost' => $request->transportTopPrice,
                'fixedPrice' => $request->transportFixedPrice,
            ];

            OfferteTransport::create($offerTransport);
            $offerteTransportIdBul = DB::table('offerte_transports')->orderBy('id','DESC')->first();
            $offerTransportId = $offerteTransportIdBul->id;
        }

        if($request->isLagerung)
        {
            $offerLagerung = [
                'tariff' => $request->lagerungTariff,
                'chf' => $request->lagerungChf,
                'volume' => $request->lagerungVolume,
                'extraCostText1' => $request->lagerungCostText1,
                'extraCostValue1' => $request->lagerungCost1,
                'extraCostText2' => $request->lagerungCostText2,
                'extraCostValue2' => $request->lagerungCost2, 
                'discountText' => $request->lagerungExtraDiscountText, 
                'discountValue' => $request->lagerungExtraDiscount, 
                'totalPrice' => $request->lagerungCost, 
                'fixedPrice' => $request->lagerungFixedPrice, 
            ];

            OfferteLagerung::create($offerLagerung);
            $offerteLagerungIdBul = DB::table('offerte_lagerungs')->orderBy('id','DESC')->first();
            $offerLagerungId = $offerteLagerungIdBul->id;
        }

        if($request->isVerpackungsmaterial)
        {
            $offerMaterial = [
                'discount' => $request->materialDiscount,
                'deliverPrice' => $request->materialShipPrice,
                'recievePrice' => $request->materialRecievePrice,
                'totalPrice' => $request->materialTotalPrice
            ];

            $material = OfferteMaterial::create($offerMaterial);
            $offerteMaterialIdBul = DB::table('offerte_materials')->orderBy('id','DESC')->first();
            $offerMaterialId = $offerteMaterialIdBul->id;

            if($material)
            {
                $islem = $all['islem'];
                unset($all['islem']);
                if(count($islem) !=0) {
                    foreach($islem as $k => $v)
                    {
                        $offerBasket = [
                            'productId' => $v['urunId'],
                            'buyType' => $v['buyType'],
                            'productPrice' => $v['tutar'],
                            'quantity' => $v['adet'],
                            'totalPrice' => $v['toplam'],
                            'materialId' => $offerMaterialId
                        ];
                        OfferteBasket::create($offerBasket);
                    }
                }
            }
        }

        if ($request->customContactPerson)
        {   
            $contactPerson = $request->customContactPerson;
        }
        else
        {
            $contactPerson = $request->contactPerson;
        }

        $offerte = [
            'customerId' =>$customerId,
            'appType' => $request->appOfferType,
            'auszugaddressId' => $AusId,
            'auszugaddressId2' => $AusId2,
            'auszugaddressId3' => $AusId3,
            'einzugaddressId' => $EinId,
            'einzugaddressId2' => $EinId2,
            'einzugaddressId3' => $EinId3,
            'offerteUmzugId' => $offerUmzugId,
            'offerteEinpackId' => $offerEinpackId,
            'offerteAuspackId' => $offerAuspackId,
            'offerteReinigungId' => $offerReinigungId,
            'offerteReinigung2Id' => $offerReinigungId2,
            'offerteEntsorgungId' => $offerEntsorgungId,
            'offerteTransportId' => $offerTransportId,
            'offerteLagerungId' => $offerLagerungId,
            'offerteMaterialId' => $offerMaterialId,
            'offerteNote' => $request->offertePdfNote,
            'panelNote' => $request->offerteNote,
            'kostenInkl' => $request->kdvType,
            'kostenExkl' => $request->kdvType1,
            'kostenFrei' => $request->kdvType3,
            'contactPerson' => $contactPerson,
            'offerteStatus' => 'Onaylanmadı'
        ];

        $create = offerte::create($offerte);
        $offerteIdBul = DB::table('offertes')->orderBy('id','DESC')->first();
        $offerteId = $offerteIdBul->id;

        // Teklif Onayı
            $oToken = Str::random(64);

            OfferVerify::create([
                'offerId' => $offerteId,
                'oToken' => $oToken,
            ]);

        // Teklif Göster
            $zToken = Str::random(64);
            OfferCustomerView::create([
                'offerId' => $offerteId,
                'zToken' => $zToken,
            ]);

            // SMS
                if($request->isSMS)
                {
                    $customerId = $request->route('id');
                    $customer = Customer::where('id',$customerId)->first();
                
                    $basic  = new \Vonage\Client\Credentials\Basic("07fc1e6c", "J4i0Q5bZDupy1zIa");
                    $client = new \Vonage\Client($basic);

                    $number = $customer['mobile'];
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

        $sub = 'Ihre Angebotsdatei';
        $from = Company::InfoCompany('email'); // gösterilen mail.
        $companyName = Company::InfoCompany('name'); // şirket adı buraya yaz veritabanında yok çünkü.
        $customer=DB::table('customers')->where('id','=', $customerId)->value('name'); // Customer Name
        $customerSurname=DB::table('customers')->where('id','=', $customerId)->value('surname');
        $customerData = Customer::where('id',$customerId)->first();

        $offer = offerte::where('id',$offerteId)->first();
        $customerData =  Customer::where('id',$customerId)->first();
        $auszug1 = offerteAddress::where('id',$AusId)->first();
        $auszug2 = offerteAddress::where('id',$AusId2)->first();
        $auszug3 = offerteAddress::where('id',$AusId3)->first();
        $einzug1 = offerteAddress::where('id',$EinId)->first();
        $einzug2 = offerteAddress::where('id',$EinId2)->first();
        $einzug3 = offerteAddress::where('id',$EinId3)->first();
        $umzugPdf = OfferteUmzug::where('id',$offerUmzugId)->first();
        $einpackPdf = OfferteEinpack::where('id',$offerEinpackId)->first();
        $auspackPdf = OfferteAuspack::where('id',$offerAuspackId)->first();
        $reinigungPdf = OfferteReinigung::where('id',$offerReinigungId)->first();
        $reinigungPdf2 = OfferteReinigung::where('id',$offerReinigungId2)->first();
        $entsorgungPdf = OfferteEntsorgung::where('id',$offerEntsorgungId)->first();
        $transportPdf = OfferteTransport::where('id',$offerTransportId)->first();
        $lagerungPdf = OfferteLagerung::where('id',$offerLagerungId)->first();
        $materialPdf = OfferteMaterial::where('id',$offerMaterialId)->first();
        $basketPdf = OfferteBasket::where('materialId',$offerMaterialId)->get()->toArray();
        

        $pdfData = [
            'offer' => $offer,
            'offerteNumber' => $offerteId ,
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
        $pdf->setPaper('A4');

  
        $emailData = [
            'appType' => $offer['appType'],
            'offerteNumber' => $offerteId,
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
            'token' => $oToken,
            'token2' => $zToken
        ];

        if ($isCustomEmailSend)
        {
            Arr::set($emailData, 'customEmailContent', $customEmail);
        }

        if($create)
        {   
            $mailSuccess = '';
            if($isEmailSend)
            {
                Mail::to($emailData['email'])->send(new OfferMail($emailData));
                $mailSuccess = ', Mail ve Teklif Dosyası Başarıyla Gönderildi';
            }          
            return redirect()->back()->with('status',' '.'Teklif Başarıyla Eklendi'.' '.$mailSuccess );
        }
        else {
            return redirect()->back()->with('status-err','Hata:Teklif Eklenemedi, Mail Gönderilemedi');
        }

    }

    public function edit(Request $request)
    {   
        $id = $request->route('id');
        if($id !=0)
        {
            
            $data = offerte::where('id',$id)->first();
            // dd($data);
            $customer = Customer::where('id',$data['customerId'])->first();
            return view ('front.offer.edit', 
            [
                'data' => $data,
                'customer' => $customer
            ]);
        }
    }

    public function update (Request $request)
    {
        $id = $request->route('id');
        $customer = offerte::where('id',$id)->first();
        $customerId = $customer['customerId'];
        $all = $request->except('_token');
        $mailSuccess = NULL;
        $isEmailSend = $request->get('isEmail');
        $isCustomEmailSend = $request->get('isCustomEmail');
        $customEmail = $request->get('customEmail');

        // Tanımlamalar
        $AusId = NULL;
        $AusId2 = NULL;
        $AusId3 = NULL;
        $EinId = NULL;
        $EinId2 = NULL;
        $EinId3 = NULL;
        $offerUmzugId = NULL;
        $offerEinpackId = NULL;
        $offerAuspackId = NULL;
        $offerReinigungId = NULL;
        $offerReinigungId2 = NULL;
        $offerEntsorgungId = NULL;
        $offerTransportId  = NULL;
        $offerLagerungId = NULL;
        $offerMaterialId = NULL;
        $contactPerson = NULL;
        $offerteId = 0;
       
        // Offerte Adresse    
        if($request->ausStreet1)
        {
            $mainAusAdress = [
                'street' => $request->ausStreet1,
                'postCode' => $request->ausPostcode1,
                'city' => $request->ausCity1,
                'country' => $request->ausCountry1,
                'buildType' => $request->ausBuildType1,
                'floor' => $request->ausFloorType1,
                'lift' => $request->isAusLift1,
                'addressType' => 0   
            ];

            offerteAddress::create($mainAusAdress);
            $mainAusAdress = DB::table('offerte_addresses')->where('addressType' ,'=', 0)->orderBy('id','DESC')->first();
            $AusId = $mainAusAdress->id;
        }
        
        if($request->ausStreet2)
        {
            $mainAusAdress = [
                'street' => $request->ausStreet2,
                'postCode' => $request->ausPostcode2,
                'city' => $request->ausCity2,
                'country' => $request->ausCountry2,
                'buildType' => $request->ausBuildType2,
                'floor' => $request->ausFloorType2,
                'lift' => $request->isAusLift2,
                'addressType' => 0   
            ];

            offerteAddress::create($mainAusAdress);
            $mainAusAdress = DB::table('offerte_addresses')->where('addressType' ,'=', 0)->orderBy('id','DESC')->first();
            $AusId2 = $mainAusAdress->id;
        }

        if($request->ausStreet3)
        {
            $mainAusAdress = [
                'street' => $request->ausStreet3,
                'postCode' => $request->ausPostcode3,
                'city' => $request->ausCity3,
                'country' => $request->ausCountry3,
                'buildType' => $request->ausBuildType3,
                'floor' => $request->ausFloorType3,
                'lift' => $request->isAusLift3,
                'addressType' => 0   
            ];

            offerteAddress::create($mainAusAdress);
            $mainAusAdress = DB::table('offerte_addresses')->where('addressType' ,'=', 0)->orderBy('id','DESC')->first();
            $AusId3 = $mainAusAdress->id;
        }
        

        if($request->einStreet1)
        {
            $mainEinAdress = [
                'street' => $request->einStreet1,
                'postCode' => $request->einPostcode1,
                'city' => $request->einCity1,
                'country' => $request->einCountry1,
                'buildType' => $request->einBuildType1,
                'floor' => $request->einFloorType1,
                'lift' => $request->isEinLift1, 
                'addressType' => 1  
            ];

            offerteAddress::create($mainEinAdress);
            $mainEinAdress = DB::table('offerte_addresses')->where('addressType' ,'=', 1)->orderBy('id','DESC')->first();
            $EinId = $mainEinAdress->id;
        }

        
        if($request->einStreet2)
        {
            $mainEinAdress = [
                'street' => $request->einStreet2,
                'postCode' => $request->einPostcode2,
                'city' => $request->einCity2,
                'country' => $request->einCountry2,
                'buildType' => $request->einBuildType2,
                'floor' => $request->einFloorType2,
                'lift' => $request->isEinLift2, 
                'addressType' => 1  
            ];

            offerteAddress::create($mainEinAdress);
            $mainEinAdress = DB::table('offerte_addresses')->where('addressType' ,'=', 1)->orderBy('id','DESC')->first();
            $EinId2 = $mainEinAdress->id;
        }

        if($request->einStreet3)
        {
            $mainEinAdress = [
                'street' => $request->einStreet3,
                'postCode' => $request->einPostcode3,
                'city' => $request->einCity3,
                'country' => $request->einCountry3,
                'buildType' => $request->einBuildType3,
                'floor' => $request->einFloorType3,
                'lift' => $request->isEinLift3, 
                'addressType' => 1  
            ];

            offerteAddress::create($mainEinAdress);
            $mainEinAdress = DB::table('offerte_addresses')->where('addressType' ,'=', 1)->orderBy('id','DESC')->first();
            $EinId3 = $mainEinAdress->id;
        }

        // offerteUmzug
        if($request->isUmzug)
        {
            $offerUmzug = [
                'tariff' => $request->umzugTariff,
                'ma' => $request->umzug1ma,
                'lkw' => $request->umzug1lkw,
                'anhanger' => $request->umzug1anhanger,
                'chf' => $request->umzug1chf,
                'moveDate' => $request->umzugausdate,
                'moveTime' => $request->umzug1time,
                'moveDate2' => $request->umzugeindate,
                'arrivalReturn' => $request->umzugroadChf,
                'montage' => $request->umzugMontaj,
                'moveHours' => $request->umzugHours,
                'extra' => $request->masraf ? $request->extra1 : Null,
                'extra1' => $request->masraf1 ? $request->extra2 : Null,
                'extra2' => $request->masraf2 ? $request->extra3 : Null,
                'extra3' => $request->masraf3 ? $request->extra4 : Null,
                'extra4' => $request->masraf4 ? $request->extra5 : Null,
                'extra5' => $request->masraf5 ? $request->extra6 : Null,
                'extra6' => $request->masraf6 ? $request->extra7 : Null,
                'extra7' => $request->masraf7 ? $request->extra8 : Null,
                'extra8' => $request->masraf8 ? $request->extra9 : Null,
                'extra9' => $request->masraf9 ? $request->extra10 : Null,
                'extra10' => $request->masraf10 ? $request->extra11 : Null,
                'customCostName1' => $request->extra12CostText,
                'customCostPrice1' => $request->extra12Cost,
                'customCostName2' => $request->extra13CostText,
                'customCostPrice2' => $request->extra13Cost,
                'costPrice' => $request->umzugCost,
                'discount' => $request->umzugDiscount,
                'compromiser' => $request->umzugCompromiser,
                'extraCostName' => $request->umzugExtraDiscountText,
                'extraCostPrice' => $request->umzugExtraDiscount,
                'defaultPrice' => $request->umzugTotalPrice,
                'topCost' => $request->umzugTopPrice ?  $request->umzugTopPrice : 0,
                'fixedPrice' => $request->umzugDefaultPrice ? $request->umzugDefaultPrice : 0,
            ];
            OfferteUmzug::create($offerUmzug);
            $offerteUmzugIdBul = DB::table('offerte_umzugs')->orderBy('id','DESC')->first();
            $offerUmzugId = $offerteUmzugIdBul->id;
        }

        if($request->isEinpack)
        {
            $offerEinpack = [
                'tariff' => $request->einpackTariff,
                'ma' => $request->einpack1ma,
                'chf' => $request->einpack1chf,
                'einpackDate' => $request->einpackdate,
                'einpackTime' => $request->einpacktime,
                'arrivalReturn' => $request->einpackroadChf,
                'moveHours' => $request->einpackHours,
                'extra' => $request->einpackmasraf ? $request->einpackextra1 : Null,
                'extra1' => $request->einpackmasraf1 ? $request->einpackextra2 : Null,
                'customCostName1' => $request->einpackCostText1,
                'customCostPrice1' => $request->einpackCost1,
                'customCostName2' => $request->einpackCostText2,
                'customCostPrice2' => $request->einpackCost2,
                'costPrice' => $request->einpackCost,
                'discount' => $request->einpackDiscount,
                'compromiser' => $request->einpackCompromiser,
                'extraCostName' => $request->einpackExtraDiscountText,
                'extraCostPrice' => $request->einpackExtraDiscount,
                'defaultPrice' => $request->einpackTotalPrice,
                'topCost' => $request->einpackTopPrice ?  $request->einpackTopPrice : 0,
                'fixedPrice' => $request->einpackDefaultPrice ? $request->einpackDefaultPrice : 0,
            ];

            OfferteEinpack::create($offerEinpack);
            $offerteEinpackIdBul = DB::table('offerte_einpacks')->orderBy('id','DESC')->first();
            $offerEinpackId = $offerteEinpackIdBul->id;
        }

        if($request->isAuspack)
        {
            $offerAuspack = [
                'tariff' => $request->auspackTariff,
                'ma' => $request->auspack1ma,
                'chf' => $request->auspack1chf,
                'auspackDate' => $request->auspackdate,
                'auspackTime' => $request->auspacktime,
                'arrivalReturn' => $request->auspackroadChf,
                'moveHours' => $request->auspackHours,
                'extra' => $request->auspackmasraf ? $request->auspackextra1 : Null,
                'extra1' => $request->auspackmasraf1 ? $request->auspackextra2 : Null,
                'customCostName1' => $request->auspackCostText1,
                'customCostPrice1' => $request->auspackCost1,
                'customCostName2' => $request->auspackCostText2,
                'customCostPrice2' => $request->auspackCost2,
                'costPrice' => $request->auspackCost,
                'discount' => $request->auspackDiscount,
                'compromiser' => $request->auspackCompromiser,
                'extraCostName' => $request->auspackExtraDiscountText,
                'extraCostPrice' => $request->auspackExtraDiscount,
                'defaultPrice' => $request->auspackTotalPrice,
                'topCost' => $request->auspackTopPrice ?  $request->auspackTopPrice : 0,
                'fixedPrice' => $request->auspackDefaultPrice ? $request->auspackDefaultPrice : 0,
            ];

            OfferteAuspack::create($offerAuspack);
            $offerteAuspackIdBul = DB::table('offerte_auspacks')->orderBy('id','DESC')->first();
            $offerAuspackId = $offerteAuspackIdBul->id;
        }

        if($request->isReinigung)
        {
            $offerReinigung = [
                'reinigungType' => $request->reinigungType,
                'extraReinigung' => $request->extraReinigung,
                'fixedTariff' => $request->reinigungFixedPrice,
                'fixedTariffPrice' => $request->reinigungFixedPriceValue,
                'standartTariff' => $request->reinigungPriceTariff,
                'ma' => $request->reinigungmaValue,
                'chf' => $request->reinigungchfValue,
                'hours' => $request->reinigunghourValue,
                'extraService1' => $request->extraReinigungService1,
                'extraService2' => $request->extraReinigungService2,
                'startDate' => $request->reinigungdate,
                'startTime' => $request->reinigungtime,
                'endDate' => $request->reinigungEnddate,
                'endTime' => $request->reinigungEndtime,
                'extra1' => $request->reinigungmasraf ? $request->reinigungextra1 : Null,
                'extra2' => $request->reinigungmasraf2 ? $request->reinigungextra2 : Null,
                'extra3' => $request->reinigungmasraf3 ? $request->reinigungextra3 : Null,
                'extraCostText1' => $request->reinigungCostText1,
                'extraCostValue1' => $request->reinigungCost1,
                'extraCostText2' => $request->reinigungCostText2,
                'extraCostValue2' => $request->reinigungCost2,
                'discountText' => $request->reinigungExtraDiscountText,
                'discount' => $request->reinigungExtraDiscount,
                'totalPrice' => $request->reinigungTotalPrice,
            ];

            OfferteReinigung::create($offerReinigung);
            $offerteReinigungIdBul = DB::table('offerte_reinigungs')->orderBy('id','DESC')->first();
            $offerReinigungId = $offerteReinigungIdBul->id;
        }

        if($request->isReinigung2)
        {
            $offerReinigung2 = [
                'reinigungType' => $request->reinigungType2,
                'extraReinigung' => $request->extraReinigung2,
                'fixedTariff' => $request->reinigungFixedPrice2,
                'fixedTariffPrice' => $request->reinigungFixedPriceValue2,
                'standartTariff' => $request->reinigungPriceTariff2,
                'ma' => $request->reinigungmaValue2,
                'chf' => $request->reinigungchfValue2,
                'hours' => $request->reinigunghourValue2,
                'extraService1' => $request->extraReinigungService12,
                'extraService2' => $request->extraReinigungService22,
                'startDate' => $request->reinigungdate2,
                'startTime' => $request->reinigungtime2,
                'endDate' => $request->reinigungEnddate2,
                'endTime' => $request->reinigungEndtime2,
                'extra1' => $request->reinigungmasraf2 ? $request->reinigungextra12 : Null,
                'extra2' => $request->reinigungmasraf22 ? $request->reinigungextra22 : Null,
                'extra3' => $request->reinigungmasraf32 ? $request->reinigungextra32 : Null,
                'extraCostText1' => $request->reinigungCostText12,
                'extraCostValue1' => $request->reinigungCost12,
                'extraCostText2' => $request->reinigungCostText22,
                'extraCostValue2' => $request->reinigungCost22,
                'discountText' => $request->reinigungExtraDiscountText2,
                'discount' => $request->reinigungExtraDiscount2,
                'totalPrice' => $request->reinigungTotalPrice2,
            ];

            OfferteReinigung::create($offerReinigung2);
            $offerteReinigungIdBul2 = DB::table('offerte_reinigungs')->orderBy('id','DESC')->first();
            $offerReinigungId2 = $offerteReinigungIdBul2->id;
        }

        if($request->isEntsorgung)
        {
            $offerEntsorgung = [
                'volume' => $request->entsorgungVolume,
                'volumeCHF' => $request->entsorgungVolumeChf,
                'fixedCost' => $request->entsorgungFixedChf,
                'm3' => $request->estimatedVolume,
                'tariff' => $request->entsorgungTariff,
                'ma' => $request->entsorgungma,
                'lkw' => $request->entsorgunglkw,
                'anhanger' => $request->entsorgunganhanger,
                'chf' => $request->entsorgungchf,
                'hour' => $request->entsorgungHours,
                'entsorgungDate' => $request->entsorgungDate,
                'entsorgungTime' => $request->entsorgungTime,
                'arrivalReturn' => $request->entsorgungroadChf,
                'entsorgungExtra1' => $request->entsorgungmasraf ? $request->entsorgungextra1 : Null,
                'extraCostText1' => $request->entsorgungCostText1,
                'extraCostValue1' => $request->entsorgungCost1,
                'extraCostText2' => $request->entsorgungCostText2,
                'extraCostValue2' => $request->entsorgungCost2,
                'discount' => $request->entsorgungDiscount,
                'extraDiscountText' => $request->entsorgungExtraDiscountText,
                'extraDiscountPrice' => $request->entsorgungExtraDiscount,
                'defaultPrice' => $request->entsorgungTotalPrice,
                'topCost' => $request->entsorgungTopPrice,
                'fixedPrice' => $request->entsorgungDefaultPrice,
            ];

            OfferteEntsorgung::create($offerEntsorgung);
            $offerteEntsorgungIdBul = DB::table('offerte_entsorgungs')->orderBy('id','DESC')->first();
            $offerEntsorgungId = $offerteEntsorgungIdBul->id;
        }
        
        if($request->isTransport)
        {
            $offerTransport = [
                'pdfText' => $request->pdfText,
                'fixedChf' => $request->transportFixedTariff,
                'tariff' => $request->transportTariff,
                'ma' => $request->transportma,
                'lkw' => $request->transportlkw,
                'anhanger' => $request->transportanhanger,
                'chf' => $request->transportchf,
                'hour' => $request->transporthour,
                'transportDate' => $request->transportDate,
                'transportTime' => $request->transportTime,
                'arrivalReturn' => $request->transportRoadChf,
                'extraCostText1' => $request->transportCostText1,
                'extraCostValue1' => $request->transportCost1,
                'extraCostText2' => $request->transportCostText2,
                'extraCostValue2' => $request->transportCost2,
                'extraCostText3' => $request->transportCostText3,
                'extraCostValue3' => $request->transportCost3,
                'extraCostText4' => $request->transportCostText4,
                'extraCostValue4' => $request->transportCost4,
                'extraCostText5' => $request->transportCostText5,
                'extraCostValue5' => $request->transportCost5,
                'extraCostText6' => $request->transportCostText6,
                'extraCostValue6' => $request->transportCost6,
                'extraCostText7' => $request->transportCostText7,
                'extraCostValue7' => $request->transportCost7,
                'totalPrice' => $request->transportCost,
                'discount' => $request->transportDiscount,
                'compromiser' => $request->transportCompromiser,
                'extraDiscountText' => $request->transportExtraDiscountText,
                'extraDiscountValue' => $request->transportExtraDiscount,
                'extraDiscountText2' => $request->transportExtraDiscountText2,
                'extraDiscountValue2' => $request->transportExtraDiscount2,
                'defaultPrice' => $request->transportDefaultPrice,
                'topCost' => $request->transportTopPrice,
                'fixedPrice' => $request->transportFixedPrice,
            ];

            OfferteTransport::create($offerTransport);
            $offerteTransportIdBul = DB::table('offerte_transports')->orderBy('id','DESC')->first();
            $offerTransportId = $offerteTransportIdBul->id;
        }

        if($request->isLagerung)
        {
            $offerLagerung = [
                'tariff' => $request->lagerungTariff,
                'chf' => $request->lagerungChf,
                'volume' => $request->lagerungVolume,
                'extraCostText1' => $request->lagerungCostText1,
                'extraCostValue1' => $request->lagerungCost1,
                'extraCostText2' => $request->lagerungCostText2,
                'extraCostValue2' => $request->lagerungCost2, 
                'discountText' => $request->lagerungExtraDiscountText, 
                'discountValue' => $request->lagerungExtraDiscount, 
                'totalPrice' => $request->lagerungCost, 
                'fixedPrice' => $request->lagerungFixedPrice, 
            ];

            OfferteLagerung::create($offerLagerung);
            $offerteLagerungIdBul = DB::table('offerte_lagerungs')->orderBy('id','DESC')->first();
            $offerLagerungId = $offerteLagerungIdBul->id;
        }

        if($request->isVerpackungsmaterial)
        {
            $offerMaterial = [
                'discount' => $request->materialDiscount,
                'deliverPrice' => $request->materialShipPrice,
                'recievePrice' => $request->materialRecievePrice,
                'totalPrice' => $request->materialTotalPrice
            ];

            $material = OfferteMaterial::create($offerMaterial);
            $offerteMaterialIdBul = DB::table('offerte_materials')->orderBy('id','DESC')->first();
            $offerMaterialId = $offerteMaterialIdBul->id;

            if($material)
            {
                $islem = $all['islem'];
                unset($all['islem']);
                if(count($islem) !=0) {
                    foreach($islem as $k => $v)
                    {
                        $offerBasket = [
                            'productId' => $v['urunId'],
                            'buyType' => $v['buyType'],
                            'productPrice' => $v['tutar'],
                            'quantity' => $v['adet'],
                            'totalPrice' => $v['toplam'],
                            'materialId' => $offerMaterialId
                        ];
                        OfferteBasket::create($offerBasket);
                    }
                }
            }
        }

        if ($request->customContactPerson)
        {   
            $contactPerson = $request->customContactPerson;
        }
        else
        {
            $contactPerson = $request->contactPerson;
        }

        
        $mainOfferte = offerte::where('id',$id)->first();
        $mainOfferteId = $mainOfferte['mainOfferteId'];

        if($mainOfferteId)
        {
            $mainOfferteId = $mainOfferteId;
        }
        else
        {
            $mainOfferteId = $id;
        }

        $offerte = [
            'mainOfferteId' => $mainOfferteId,
            'customerId' =>$customerId,
            'appType' => $request->appOfferType,
            'auszugaddressId' => $AusId,
            'auszugaddressId2' => $AusId2,
            'auszugaddressId3' => $AusId3,
            'einzugaddressId' => $EinId,
            'einzugaddressId2' => $EinId2,
            'einzugaddressId3' => $EinId3,
            'offerteUmzugId' => $offerUmzugId,
            'offerteEinpackId' => $offerEinpackId,
            'offerteAuspackId' => $offerAuspackId,
            'offerteReinigungId' => $offerReinigungId,
            'offerteReinigung2Id' => $offerReinigungId2,
            'offerteEntsorgungId' => $offerEntsorgungId,
            'offerteTransportId' => $offerTransportId,
            'offerteLagerungId' => $offerLagerungId,
            'offerteMaterialId' => $offerMaterialId,
            'offerteNote' => $request->offertePdfNote,
            'panelNote' => $request->offerteNote,
            'kostenInkl' => $request->kdvType,
            'kostenExkl' => $request->kdvType1,
            'kostenFrei' => $request->kdvType3,
            'contactPerson' => $contactPerson,
            'offerteStatus' => 'Onaylanmadı'
        ];

        $create = offerte::create($offerte);
        $offerteIdBul = DB::table('offertes')->orderBy('id','DESC')->first();
        $offerteId = $offerteIdBul->id;

        // Teklif Onayı
            $oToken = Str::random(64);

            OfferVerify::create([
                'offerId' => $offerteId,
                'oToken' => $oToken,
            ]);

        // Teklif Göster
            $zToken = Str::random(64);
            OfferCustomerView::create([
                'offerId' => $offerteId,
                'zToken' => $zToken,
            ]);

        $sub = 'Ihre Angebotsdatei wurde aktualisiert';
        $from = Company::InfoCompany('email'); // gösterilen mail.
        $companyName = Company::InfoCompany('name'); // şirket adı buraya yaz veritabanında yok çünkü.
        $customer=DB::table('customers')->where('id','=', $customerId)->value('name'); // Customer Name
        $customerSurname=DB::table('customers')->where('id','=', $customerId)->value('surname');
        $customerData = Customer::where('id',$customerId)->first();

        $offer = offerte::where('id',$id)->first();
        $customerData =  Customer::where('id',$customerId)->first();
        $auszug1 = offerteAddress::where('id',$AusId)->first();
        $auszug2 = offerteAddress::where('id',$AusId2)->first();
        $auszug3 = offerteAddress::where('id',$AusId3)->first();
        $einzug1 = offerteAddress::where('id',$EinId)->first();
        $einzug2 = offerteAddress::where('id',$EinId2)->first();
        $einzug3 = offerteAddress::where('id',$EinId3)->first();
        $umzugPdf = OfferteUmzug::where('id',$offerUmzugId)->first();
        $einpackPdf = OfferteEinpack::where('id',$offerEinpackId)->first();
        $auspackPdf = OfferteAuspack::where('id',$offerAuspackId)->first();
        $reinigungPdf = OfferteReinigung::where('id',$offerReinigungId)->first();
        $reinigungPdf2 = OfferteReinigung::where('id',$offerReinigungId2)->first();
        $entsorgungPdf = OfferteEntsorgung::where('id',$offerEntsorgungId)->first();
        $transportPdf = OfferteTransport::where('id',$offerTransportId)->first();
        $lagerungPdf = OfferteLagerung::where('id',$offerLagerungId)->first();
        $materialPdf = OfferteMaterial::where('id',$offerMaterialId)->first();
        $basketPdf = OfferteBasket::where('materialId',$offerMaterialId)->get()->toArray();
        

        $pdfData = [
            'offer' => $offer,
            'offerteNumber' => $offerteId ,
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
        $pdf->setPaper('A4');

  
        $emailData = [
            'offerteNumber' => $offerteId,
            'contactPerson' => $contactPerson,
            'appType' => $request->appOfferType,
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
            'token' => $oToken,
            'token2' => $zToken
        ];

        if ($isCustomEmailSend)
        {
            Arr::set($emailData, 'customEmailContent', $customEmail);
        }

        if($create)
        {   
            $mailSuccess = '';
            if($isEmailSend)
            {
                Mail::to($emailData['email'])->send(new OfferMail($emailData));
                $mailSuccess = ', Mail ve Teklif Dosyası Başarıyla Gönderildi';
            }          
            return redirect()->back()->with('status',' '.'Teklif Başarıyla Güncellendi'.' '.$mailSuccess );
        }
        else {
            return redirect()->back()->with('status-err','Hata:Teklif Güncellenemedi, Mail Gönderilemedi');
        }

        
    }


    public function detail(Request $request)
    {
        $id = $request->route('id');
        if($id !=0)
        {
            
            $data = offerte::where('id',$id)->first();
            // dd($data);
            $customer = Customer::where('id',$data['customerId'])->first();
            return view ('front.offer.detail', 
            [
                'data' => $data,
                'customer' => $customer
            ]);
        }
    }

    public function delete ($id)
    {
        $c = offerte::where('id',$id)->count();
        
        if($c !=0)
        {
            $data = offerte::where('id',$id)->first();
            $data2 = offerte::where('mainOfferteId',$data['mainOfferteId'])->first();

            // MainOfferte
            $auszug = offerteAddress::where('id',$data['auszugaddressId'])->delete();
            $auszug2 = offerteAddress::where('id',$data['auszugaddressId2'])->delete();
            $auszug3 = offerteAddress::where('id',$data['auszugaddressId3'])->delete();
            $einzug = offerteAddress::where('id',$data['einzugaddressId'])->delete();
            $einzug2 = offerteAddress::where('id',$data['einzugaddressId2'])->delete();
            $einzug2 = offerteAddress::where('id',$data['einzugaddressId3'])->delete();
            $umzug = OfferteUmzug::where('id',$data['offerteUmzugId'])->delete();
            $einpack = OfferteEinpack::where('id',$data['offerteEinpackId'])->delete();
            $auspack = OfferteAuspack::where('id',$data['offerteAuspackId'])->delete();
            $reinigung = OfferteReinigung::where('id',$data['offerteReinigungId'])->delete();
            $reinigung2 = OfferteReinigung::where('id',$data['offerteReinigung2Id'])->delete();
            $entsorgung = OfferteEntsorgung::where('id',$data['offerteEntsorgungId'])->delete();
            $transport = OfferteTransport::where('id',$data['offerteTransportId'])->delete();
            $lagerung = OfferteLagerung::where('id',$data['offerteLagerungId'])->delete();
            $basket = OfferteBasket::where('materialId',$data['offerteMaterialId'])->delete();
            $material = OfferteMaterial::where('id',$data['offerteMaterialId'])->delete();
            Task::where('offerteId',$data['id'])->delete();
            WorkerBasket::where('offerteID',$data['id'])->delete();
            OfferVerify::where('offerId',$data['id'])->delete();
            OfferCustomerView::where('offerId',$data['id'])->delete();

            // UpdatedOfferte
            $Uauszug = offerteAddress::where('id',$data2['auszugaddressId'])->delete();
            $Uauszug2 = offerteAddress::where('id',$data2['auszugaddressId2'])->delete();
            $Uauszug3 = offerteAddress::where('id',$data2['auszugaddressId3'])->delete();
            $Ueinzug = offerteAddress::where('id',$data2['einzugaddressId'])->delete();
            $Ueinzug2 = offerteAddress::where('id',$data2['einzugaddressId2'])->delete();
            $Ueinzug2 = offerteAddress::where('id',$data2['einzugaddressId3'])->delete();
            $Uumzug = OfferteUmzug::where('id',$data2['offerteUmzugId'])->delete();
            $Ueinpack = OfferteEinpack::where('id',$data2['offerteEinpackId'])->delete();
            $Uauspack = OfferteAuspack::where('id',$data2['offerteAuspackId'])->delete();
            $Ureinigung = OfferteReinigung::where('id',$data2['offerteReinigungId'])->delete();
            $Ureinigung2 = OfferteReinigung::where('id',$data2['offerteReinigung2Id'])->delete();
            $Uentsorgung = OfferteEntsorgung::where('id',$data2['offerteEntsorgungId'])->delete();
            $Utransport = OfferteTransport::where('id',$data2['offerteTransportId'])->delete();
            $Ulagerung = OfferteLagerung::where('id',$data2['offerteLagerungId'])->delete();
            $Ubasket = OfferteBasket::where('materialId',$data2['offerteMaterialId'])->delete();
            $Umaterial = OfferteMaterial::where('id',$data2['offerteMaterialId'])->delete();
            Task::where('offerteId',$data2['id'])->delete();
            WorkerBasket::where('offerteID',$data2['id'])->delete();
            OfferVerify::where('offerId',$data2['id'])->delete();
            OfferCustomerView::where('offerId',$data2['id'])->delete();

            offerte::where('mainOfferteId',$data2['id'])->delete();
            offerte::where('id',$id)->delete();

            return redirect()->back()->with('status','Teklif Başarıyla Silindi');
        }
        else {
            return redirect('/');
        }
    }

    public function showPdf($id)
    {
            $offer = offerte::where('id',$id)->first();
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
                'offer' => $offer,
                'offerteNumber' => $offer['id'] ,
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
