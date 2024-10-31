<?php

namespace App\Http\Controllers\front\offer;

use App\Http\Controllers\Controller;
use App\Mail\OfferMail;
use App\Models\Appointment;
use App\Models\Company;
use App\Models\Customer;
use App\Models\CustomEmail;
use App\Models\Invoice;
use App\Models\OfferCustomerView;
use App\Models\OfferLogs;
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
use App\Models\OfferteNotes;
use App\Models\OfferVerify;
use App\Models\CustomerForm;
use App\Models\ReceiptReinigung;
use App\Models\ReceiptUmzug;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class indexController extends Controller
{
    public function index()
    {
        return view('front.offer.index');
    }

    public function dateTester(Request $request)
    {
        $data = offerte::where('customerId', 1)
            ->where('offerteStatus', 'Beklemede')
            ->get(['id', 'offerteUmzugId', 'offerteTransportId', 'offerteReinigungId','offerteEntsorgungId'])
            ->toArray();

        $today = Carbon::now()->format('Y-m-d');
        $umzugOfferteler = [];

        foreach ($data as $offerte) {
            $models = OfferteUmzug::find($offerte['offerteUmzugId'])
                ?? OfferteTransport::find($offerte['offerteTransportId'])
                ?? OfferteReinigung::find($offerte['offerteReinigungId'])
                ?? OfferteEntsorgung::find($offerte['offerteEntsorgungId']);

            if ($models) {
                $tarih = null;
                $belirtec = null;
                $servisId = null;

                if ($models instanceof OfferteUmzug) {
                    $belirtec = 'Umzug';
                    $tarih = $models->moveDate;
                    $servisId = $models->id;
                } elseif ($models instanceof OfferteTransport) {
                    $belirtec = 'Transport';
                    $tarih = $models->transportDate;
                    $servisId = $models->id;
                } elseif ($models instanceof OfferteReinigung) {
                    $belirtec = 'Reinigung';
                    $tarih = $models->startDate;
                    $servisId = $models->id;
                }
                elseif ($models instanceof OfferteEntsorgung) {
                    $belirtec = 'Entsorgung';
                    $tarih = $models->entsorgungDate;
                    $servisId = $models->id;
                }

                $durum = ($tarih >= $today) ? 'Online' : 'Expired';

                $umzugOfferteler[] = [
                    'offerteId' => $offerte['id'],
                    'servisAdi' => $belirtec,
                    'servisId' => $servisId,
                    'servisTarihi' => $tarih,
                    'suankiTarih' => $today,
                    'tarihDurumu' => $durum,
                ];


            }

            $expiredOfferteIds = [];

            foreach ($umzugOfferteler as $offerte) {
                if ($offerte['tarihDurumu'] === 'Expired') {
                    $expiredOfferteIds[] = $offerte['offerteId'];
                }
            }
            offerte::whereIn('id', $expiredOfferteIds)->update(['offerteStatus' => 'Onaylanmadı']);
        }

        // dd($umzugOfferteler);
    }

    public function data(Request $request)
    {
        $customerId = $request->route('id');

        $table = DB::table('offertes')->where('customerId', '=', $customerId)->get()->toArray();
        $data = DataTables::of($table)

            ->editColumn('id', function ($data) {
                return '' . $data->id;
            })
            ->editColumn('created_at', function ($data) {
                $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s');
                return $formatedDate;
            })
            ->editColumn('services', function ($data) {

                $services = collect([
                    $data->offerteUmzugId ? 'Umzug' : NULL,
                    $data->offerteEinpackId ? 'Einpack' : NULL,
                    $data->offerteAuspackId ? 'Auspack' : NULL,
                    $data->offerteReinigungId ? 'Reinigung' : NULL,
                    $data->offerteReinigung2Id ? 'Reinigung 2' : NULL,
                    $data->offerteEntsorgungId ? 'Entsorgung' : NULL,
                    $data->offerteTransportId ? 'Transport' : NULL,
                    $data->offerteLagerungId ? 'Lagerung' : NULL,
                    $data->offerteMaterialId ? 'Material' : NULL,
                ])->implode(' ');

                return $services;
            })

            ->addColumn('option', function ($table) {
                return '
            <a title="Detail" class="btn btn-sm    btn-primary" href="' . route('offer.detail', ['id' => $table->id]) . '"><i class="feather feather-eye" ></i></a> <span class="text-primary">|</span>
            <a title="Bearbeiten" class="btn btn-sm   btn-edit" href="' . route('offer.edit', ['id' => $table->id]) . '"><i class="feather feather-edit" ></i></a> <span class="text-primary">|</span>
            <a title="Delete" class="btn btn-sm  btn-danger"  href="' . route('offer.delete', ['id' => $table->id]) . '"><i class="feather feather-trash-2" ></i></a>';
            })
            ->rawColumns(['option'])
            ->make(true);

        return $data;
    }

    public function create($id)
    {
        $data = Customer::where('id', $id)->first();
        $formData = CustomerForm::where('customerId',$id)->first();
        $termineCount = Appointment::where('customerId',$id)->count();
        return view('front.offer.create', ['data' => $data,'formData' => $formData,'termineCount' => $termineCount]);
    }

    public function getOfferte($id)
    {
        $offerte = Offerte::find($id); // Belirli bir id ile offerte verilerini çekiyoruz
        return response()->json(['offerte' => $offerte]);
    }

    public function noticeUpdate(Request $request)
    {
        $id = $request->route('id');
        $offerteUpdateNotice = offerte::where('id',$id)->update([
            'panelNote' => $request->notizTextArea
        ]);
        if($offerteUpdateNotice)
        {
            return redirect()
                ->route('statistics.offer')
                ->with('status', $id . ' - ' . 'Angebot mit Nummer wurde bearbeitet')
                ->withInput()
                ->with('keep_status', true);
        }
        else{
            return response()->json(['success' => false]);
        }

    }

    public function sendSms(Request $request)
    {
            // $customerId = $request->route('id');
            // $customer = Customer::where('id',$customerId)->first();

            // $basic  = new \Vonage\Client\Credentials\Basic("07fc1e6c", "J4i0Q5bZDupy1zIa");
            // $client = new \Vonage\Client($basic);

            // $number = $request->mobile;
            // $staticContent = 'Herr'.' '.$customer['name'].' '.$customer['surname'].','.' ';
            // $content ='Ihr Angebot wurde erstellt From Swiss';
            // $staticContent2 = ' '.Company::InfoCompany('name');

            // if($request->isCustomSMS)
            // {
            //     $content = $request->customSMS;
            //     $response = $client->sms()->send(
            //         new \Vonage\SMS\Message\SMS('905449757797', 'Swiss Transporte GmbH', 'Test')
            //     );
            // }
            // else{
            //     $response = $client->sms()->send(
            //         new \Vonage\SMS\Message\SMS('905449757797', BRAND_NAME, 'A text message sent using the swiss SMS API')
            //     );
            // }


        // $apiKey = "07fc1e6c";
        // $apiSecret = "J4i0Q5bZDupy1zIa";
        // $toNumber = '905449757797'; // TO_NUMBER yerine gerçek bir numara ekleyin
        // $brandName = 'B8PR6LX'; // BRAND_NAME yerine gerçek bir marka adı ekleyin

        // // Vonage API'ye istek yapmak için Laravel HTTP Client'ı kullanalım
        // $response = Http::post('https://rest.nexmo.com/sms/json', [
        //     'api_key' => $apiKey,
        //     'api_secret' => $apiSecret,
        //     'to' => $toNumber,
        //     'from' => $brandName,
        //     'text' => 'A text message sent using the Nexmo SMS API qqq',
        // ]);

        // // Vonage'dan gelen yanıtı kontrol edelim
        // $message = json_decode($response->body())->messages[0];

        // if ($message->status == 0) {
        //     Log::info("The message was sent successfully");
        //     echo "The message was sent successfully\n";
        // } else {
        //     Log::error("The message failed with status: " . $message->status);
        //     echo "The message failed with status: " . $message->status . "\n";
        // }

        // $customerId = $request->route('id');
        // $customer = Customer::where('id', $customerId)->first();

        $basic  = new \Vonage\Client\Credentials\Basic("07fc1e6c", "J4i0Q5bZDupy1zIa");
        $client = new \Vonage\Client($basic);

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("41763995002", "SwissGmbH", 'A text message sent using the Nexmo SMS API ')
        );

        $message = $response->current();

        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }


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
        if ($request->ausStreet1) {
            $mainAusAdress = [
                'street' => $request->ausStreet1,
                'postCode' => $request->ausPostcode1,
                'city' => $request->ausCity1,
                'country' => $request->isAusCustomLand1 ? $request->ausCustomLand1 : $request->ausCountry1,
                'buildType' => $request->ausBuildType1,
                'floor' => $request->ausFloorType1,
                'lift' => $request->isAusLift1,
                'parkPlatz' => $request->isAusParkplatz1,
                'addressType' => 0
            ];

            offerteAddress::create($mainAusAdress);
            $mainAusAdress = DB::table('offerte_addresses')->where('addressType', '=', 0)->orderBy('id', 'DESC')->first();
            $AusId = $mainAusAdress->id;
        }

        if ($request->ausStreet2) {
            $mainAusAdress = [
                'street' => $request->ausStreet2,
                'postCode' => $request->ausPostcode2,
                'city' => $request->ausCity2,
                'country' => $request->isAusCustomLand2 ? $request->ausCustomLand2 : $request->ausCountry2,
                'buildType' => $request->ausBuildType2,
                'floor' => $request->ausFloorType2,
                'lift' => $request->isAusLift2,
                'parkPlatz' => $request->isAusParkplatz2,
                'addressType' => 0
            ];

            offerteAddress::create($mainAusAdress);
            $mainAusAdress = DB::table('offerte_addresses')->where('addressType', '=', 0)->orderBy('id', 'DESC')->first();
            $AusId2 = $mainAusAdress->id;
        }

        if ($request->ausStreet3) {
            $mainAusAdress = [
                'street' => $request->ausStreet3,
                'postCode' => $request->ausPostcode3,
                'city' => $request->ausCity3,
                'country' => $request->isAusCustomLand3 ? $request->ausCustomLand3 : $request->ausCountry3,
                'buildType' => $request->ausBuildType3,
                'floor' => $request->ausFloorType3,
                'lift' => $request->isAusLift3,
                'parkPlatz' => $request->isAusParkplatz3,
                'addressType' => 0
            ];

            offerteAddress::create($mainAusAdress);
            $mainAusAdress = DB::table('offerte_addresses')->where('addressType', '=', 0)->orderBy('id', 'DESC')->first();
            $AusId3 = $mainAusAdress->id;
        }


        if ($request->einStreet1) {
            $mainEinAdress = [
                'street' => $request->einStreet1,
                'postCode' => $request->einPostcode1,
                'city' => $request->einCity1,
                'country' => $request->isEinCustomLand1 ? $request->einCustomLand1 : $request->einCountry1,
                'buildType' => $request->einBuildType1,
                'floor' => $request->einFloorType1,
                'lift' => $request->isEinLift1,
                'parkPlatz' => $request->isEinParkplatz1,
                'addressType' => 1
            ];

            offerteAddress::create($mainEinAdress);
            $mainEinAdress = DB::table('offerte_addresses')->where('addressType', '=', 1)->orderBy('id', 'DESC')->first();
            $EinId = $mainEinAdress->id;
        }


        if ($request->einStreet2) {
            $mainEinAdress = [
                'street' => $request->einStreet2,
                'postCode' => $request->einPostcode2,
                'city' => $request->einCity2,
                'country' => $request->isEinCustomLand2 ? $request->einCustomLand2 : $request->einCountry2,
                'buildType' => $request->einBuildType2,
                'floor' => $request->einFloorType2,
                'lift' => $request->isEinLift2,
                'parkPlatz' => $request->isEinParkplatz2,
                'addressType' => 1
            ];

            offerteAddress::create($mainEinAdress);
            $mainEinAdress = DB::table('offerte_addresses')->where('addressType', '=', 1)->orderBy('id', 'DESC')->first();
            $EinId2 = $mainEinAdress->id;
        }

        if ($request->einStreet3) {
            $mainEinAdress = [
                'street' => $request->einStreet3,
                'postCode' => $request->einPostcode3,
                'city' => $request->einCity3,
                'country' => $request->isEinCustomLand3 ? $request->einCustomLand3 : $request->einCountry3,
                'buildType' => $request->einBuildType3,
                'floor' => $request->einFloorType3,
                'lift' => $request->isEinLift3,
                'parkPlatz' => $request->isEinParkplatz3,
                'addressType' => 1
            ];

            offerteAddress::create($mainEinAdress);
            $mainEinAdress = DB::table('offerte_addresses')->where('addressType', '=', 1)->orderBy('id', 'DESC')->first();
            $EinId3 = $mainEinAdress->id;
        }

        // offerteUmzug
        if ($request->isUmzug) {
            $offerUmzug = [
                'tariff' => $request->umzugTariff,
                'ma' => $request->umzug1ma,
                'lkw' => $request->umzug1lkw,
                'anhanger' => $request->umzug1anhanger,
                'chf' => $request->umzug1chf,
                'moveDate' => $request->umzugausdate,
                'moveTime' => $request->umzug1time,
                'moveDate2' => $request->umzugeindate,
                'arrivalGas' => $request->umzugArrivalGas,
                'returnGas' => $request->umzugReturnGas,
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
                'discountPercent' => $request->umzugDiscountPercent,
                'compromiser' => $request->umzugCompromiser,
                'extraCostName' => $request->umzugExtraDiscountText,
                'extraCostPrice' => $request->umzugExtraDiscount,
                'defaultPrice' => $request->umzugTotalPrice,
                'topCost' => $request->isKostendach ?  $request->umzugTopPrice : Null,
                'fixedPrice' => $request->isPauschal ?  $request->umzugDefaultPrice : Null,
            ];
            OfferteUmzug::create($offerUmzug);
            $offerteUmzugIdBul = DB::table('offerte_umzugs')->orderBy('id', 'DESC')->first();
            $offerUmzugId = $offerteUmzugIdBul->id;
        }

        if ($request->isEinpack) {
            $offerEinpack = [
                'tariff' => $request->einpackTariff,
                'ma' => $request->einpack1ma,
                'chf' => $request->einpack1chf,
                'einpackDate' => $request->einpackdate,
                'einpackTime' => $request->einpacktime,
                'arrivalGas' => $request->einpackArrivalGas,
                'returnGas' => $request->einpackReturnGas,
                'moveHours' => $request->einpackHours,
                'extra' => $request->einpackmasraf ? $request->einpackextra1 : Null,
                'extra1' => $request->einpackmasraf1 ? $request->einpackextra2 : Null,
                'customCostName1' => $request->einpackCostText1,
                'customCostPrice1' => $request->einpackCost1,
                'customCostName2' => $request->einpackCostText2,
                'customCostPrice2' => $request->einpackCost2,
                'costPrice' => $request->einpackCost,
                'discount' => $request->einpackDiscount,
                'discountPercent' => $request->einpackDiscountPercent,
                'compromiser' => $request->einpackCompromiser,
                'extraCostName' => $request->einpackExtraDiscountText,
                'extraCostPrice' => $request->einpackExtraDiscount,
                'defaultPrice' => $request->einpackTotalPrice,
                'topCost' => $request->isEinpackKostendach ?  $request->einpackTopPrice : Null,
                'fixedPrice' => $request->isEinpackPauschal ?  $request->einpackDefaultPrice : Null,
            ];

            OfferteEinpack::create($offerEinpack);
            $offerteEinpackIdBul = DB::table('offerte_einpacks')->orderBy('id', 'DESC')->first();
            $offerEinpackId = $offerteEinpackIdBul->id;
        }

        if ($request->isAuspack) {
            $offerAuspack = [
                'tariff' => $request->auspackTariff,
                'ma' => $request->auspack1ma,
                'chf' => $request->auspack1chf,
                'auspackDate' => $request->auspackdate,
                'auspackTime' => $request->auspacktime,
                'arrivalGas' => $request->auspackArrivalGas,
                'returnGas' => $request->auspackReturnGas,
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
                'topCost' => $request->isAuspackKostendach ?  $request->auspackTopPrice : Null,
                'fixedPrice' => $request->isAuspackPauschal ?  $request->auspackDefaultPrice : Null,
            ];

            OfferteAuspack::create($offerAuspack);
            $offerteAuspackIdBul = DB::table('offerte_auspacks')->orderBy('id', 'DESC')->first();
            $offerAuspackId = $offerteAuspackIdBul->id;
        }

        if ($request->isReinigung) {
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
                'costPrice' => $request->reinigungCostPrice,
                'discountText' => $request->reinigungExtraDiscountText,
                'discount' => $request->reinigungExtraDiscount,
                'discountPercent' => $request->reinigungDiscountPercent,
                'totalPrice' => $request->reinigungTotalPrice,
            ];

            OfferteReinigung::create($offerReinigung);
            $offerteReinigungIdBul = DB::table('offerte_reinigungs')->orderBy('id', 'DESC')->first();
            $offerReinigungId = $offerteReinigungIdBul->id;
        }

        if ($request->isReinigung2) {
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
                'startDate' => $request->reinigungdate2,
                'startTime' => $request->reinigungtime2,
                'endDate' => $request->reinigungEnddate2,
                'endTime' => $request->reinigungEndtime2,
                'extra1' => $request->reinigungmasraf12 ? $request->reinigungextra12 : Null,
                'extra2' => $request->reinigungmasraf22 ? $request->reinigungextra22 : Null,
                'extra3' => $request->reinigungmasraf32 ? $request->reinigungextra32 : Null,
                'extraCostText1' => $request->reinigungCostText12,
                'extraCostValue1' => $request->reinigungCost12,
                'extraCostText2' => $request->reinigungCostText22,
                'extraCostValue2' => $request->reinigungCost22,
                'costPrice' => $request->reinigung2CostPrice,
                'discountText' => $request->reinigungExtraDiscountText2,
                'discount' => $request->reinigungExtraDiscount2,
                'discountPercent' => $request->reinigungDiscountPercent2,
                'totalPrice' => $request->reinigungTotalPrice2,
            ];

            OfferteReinigung::create($offerReinigung2);
            $offerteReinigungIdBul2 = DB::table('offerte_reinigungs')->orderBy('id', 'DESC')->first();
            $offerReinigungId2 = $offerteReinigungIdBul2->id;
        }

        if ($request->isEntsorgung) {
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
                'arrivalGas' => $request->entsorgungArrivalGas,
                'returnGas' => $request->entsorgungReturnGas,
                'entsorgungExtra1' => $request->entsorgungmasraf ? $request->entsorgungextra1 : Null,
                'extraCostText1' => $request->entsorgungCostText1,
                'extraCostValue1' => $request->entsorgungCost1,
                'extraCostText2' => $request->entsorgungCostText2,
                'extraCostValue2' => $request->entsorgungCost2,
                'discount' => $request->entsorgungDiscount,
                'discountPercent' => $request->entsorgungDiscountPercent,
                'extraDiscountText' => $request->entsorgungExtraDiscountText,
                'extraDiscountPrice' => $request->entsorgungExtraDiscount,
                'costPrice' => $request->entsorgungCostPrice,
                'defaultPrice' => $request->entsorgungTotalPrice,
                'topCost' => $request->isEntsorgungKostendach ?  $request->entsorgungTopPrice : Null,
                'fixedPrice' => $request->isEntsorgungPauschal ?  $request->entsorgungDefaultPrice : Null,
            ];
            OfferteEntsorgung::create($offerEntsorgung);
            $offerteEntsorgungIdBul = DB::table('offerte_entsorgungs')->orderBy('id', 'DESC')->first();
            $offerEntsorgungId = $offerteEntsorgungIdBul->id;
        }

        if ($request->isTransport) {
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
                'arrivalGas' => $request->transportArrivalGas,
                'returnGas' => $request->transportReturnGas,
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
                'discountPercent' => $request->transportDiscountPercent,
                'compromiser' => $request->transportCompromiser,
                'extraDiscountText' => $request->transportExtraDiscountText,
                'extraDiscountValue' => $request->transportExtraDiscount,
                'extraDiscountText2' => $request->transportExtraDiscountText2,
                'extraDiscountValue2' => $request->transportExtraDiscount2,
                'defaultPrice' => $request->transportDefaultPrice,
                'topCost' => $request->isTransportKostendach ?  $request->transportTopPrice : Null,
                'fixedPrice' => $request->isTransportKostendach ?  $request->transportFixedPrice : Null,
            ];

            OfferteTransport::create($offerTransport);
            $offerteTransportIdBul = DB::table('offerte_transports')->orderBy('id', 'DESC')->first();
            $offerTransportId = $offerteTransportIdBul->id;
        }

        if ($request->isLagerung) {
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
                'discountPercent' => $request->lagerungDiscountPercent,
                'costPrice' => $request->lagerungCostPrice,
                'totalPrice' => $request->lagerungCost,
                'fixedPrice' => $request->isLagerungFixedPrice ?  $request->lagerungFixedPrice : Null,

            ];

            OfferteLagerung::create($offerLagerung);
            $offerteLagerungIdBul = DB::table('offerte_lagerungs')->orderBy('id', 'DESC')->first();
            $offerLagerungId = $offerteLagerungIdBul->id;
        }

        if ($request->isVerpackungsmaterial) {
            $offerMaterial = [
                'discount' => $request->materialDiscount,
                'discountPercent' => $request->materialDiscountPercent,
                'deliverPrice' => $request->materialShipPrice,
                'recievePrice' => $request->materialRecievePrice,
                'totalPrice' => $request->materialTotalPrice
            ];

            $material = OfferteMaterial::create($offerMaterial);
            $offerteMaterialIdBul = DB::table('offerte_materials')->orderBy('id', 'DESC')->first();
            $offerMaterialId = $offerteMaterialIdBul->id;

            if ($material) {
                $islem = $all['islem'];
                if ($islem) {
                    unset($all['islem']);
                    if (count($islem) != 0) {
                        foreach ($islem as $k => $v) {
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
        }

        if ($request->contactPerson == 'Bitte wählen') {
            $contactPerson = $request->customContactPerson;
        } else {
            $contactPerson = $request->contactPerson;
        }

        $offerte = [
            'customerId' => $customerId,
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
            'offerPrice' => $request->offerteEsimatedIncome,
            'offerteNote' => $request->offertePdfNote,
            'panelNote' => $request->offerteNote,
            'kostenInkl' => $request->kdvType,
            'kostenExkl' => $request->kdvType1,
            'kostenFrei' => $request->kdvType3,
            'contactPerson' => $contactPerson,
            'offerteStatus' => 'Beklemede',
            'isCampaign' => $request->isCampaign ? $request->campaignValue : NULL
        ];

        $create = offerte::create($offerte);
        $offerteIdBul = DB::table('offertes')->orderBy('id', 'DESC')->first();
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
            // if ($request->isSMS) {
            //     function sms(Request $request)
            //     {
            //         $customerId = $request->route('id');
            //         $customer = Customer::where('id', $customerId)->first();

            //         $basic  = new \Vonage\Client\Credentials\Basic("07fc1e6c", "J4i0Q5bZDupy1zIa");
            //         $client = new \Vonage\Client($basic);

            //         $number = $request->mobile;
            //         $staticContent = 'Herr' . ' ' . $customer['name'] . ' ' . $customer['surname'] . ',' . ' ';
            //         $content = 'Ihr Angebot wurde erstellt From Swiss';
            //         $staticContent2 = ' ' . Company::InfoCompany('name');

            //         if ($request->isCustomSMS) {
            //             $content = $request->customSMS;
            //             $response = $client->sms()->send(
            //                 new \Vonage\SMS\Message\SMS('+905449757797', 'BRAND_NAME', $staticContent . $content . $staticContent2)
            //             );
            //         } else {
            //             $response = $client->sms()->send(
            //                 new \Vonage\SMS\Message\SMS('+905449757797', 'BRAND_NAME', $staticContent . $content . $staticContent2)
            //             );
            //         }
            //     }
            // }
        // SMS

        $sub = 'Ihr Angebot';
        $from = Company::InfoCompany('email'); // gösterilen mail.
        $companyName = Company::InfoCompany('name'); // şirket adı buraya yaz veritabanında yok çünkü.
        $customer = DB::table('customers')->where('id', '=', $customerId)->value('name'); // Customer Name
        $customerSurname = DB::table('customers')->where('id', '=', $customerId)->value('surname');
        $customerData = Customer::where('id', $customerId)->first();

        $offer = offerte::where('id', $offerteId)->first();
        $customerData =  Customer::where('id', $customerId)->first();
        $auszug1 = offerteAddress::where('id', $AusId)->first();
        $auszug2 = offerteAddress::where('id', $AusId2)->first();
        $auszug3 = offerteAddress::where('id', $AusId3)->first();
        $einzug1 = offerteAddress::where('id', $EinId)->first();
        $einzug2 = offerteAddress::where('id', $EinId2)->first();
        $einzug3 = offerteAddress::where('id', $EinId3)->first();
        $umzugPdf = OfferteUmzug::where('id', $offerUmzugId)->first();
        $einpackPdf = OfferteEinpack::where('id', $offerEinpackId)->first();
        $auspackPdf = OfferteAuspack::where('id', $offerAuspackId)->first();
        $reinigungPdf = OfferteReinigung::where('id', $offerReinigungId)->first();
        $reinigungPdf2 = OfferteReinigung::where('id', $offerReinigungId2)->first();
        $entsorgungPdf = OfferteEntsorgung::where('id', $offerEntsorgungId)->first();
        $transportPdf = OfferteTransport::where('id', $offerTransportId)->first();
        $lagerungPdf = OfferteLagerung::where('id', $offerLagerungId)->first();
        $materialPdf = OfferteMaterial::where('id', $offerMaterialId)->first();
        $basketPdf = OfferteBasket::where('materialId', $offerMaterialId)->get()->toArray();



        $pdfData = [
            'offer' => $offer,
            'offerteNumber' => $offerteId,
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
            'isAuszug2' => $request->isofferAuszug2,
            'isAuszug3' => $request->isofferAuszug3,
            'isEinzug2' => $request->isofferEinzug2,
            'isEinzug3' => $request->isofferEinzug3,
            'isEinzug1' => $request->einStreet1,
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
        //     // Offerte {{ route('customerOfferView', $data['token2']) }}"
        //    >Ansicht </a>

        $customLinks = "<a href=" . route('customerOfferView', $zToken) . '
            style="background-color: #8359B7;
            border-radius: 30px;
            color: white!important;
            padding: 7px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            margin: 4px 2px;
            cursor: pointer;"
            ' . '>' . 'Offerten Ansicht' . '</a>' . '<br>' . "<a href=" . route('acceptOffer', $oToken) . '
            style="background-color: #28A745;
            border-radius: 30px;
            color: white!important;
            padding: 7px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            margin: 4px 2px;
            cursor: pointer;"
            ' . '>' . 'Offerte Annehmen ' . '</a>' . '<br>' . "<a href=" . route('rejectOffer', $oToken) . '
            style="background-color: #DC3545;
            border-radius: 30px;
            color: white!important;
            padding: 7px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            margin: 4px 2px;
            cursor: pointer;"
            ' . '>' . 'Offerte Ablehnen' . '</a>';
        $offerMailFooter = view('offerMailFooter');
        $reinigungPdf = 'dontsend';
        if($offerReinigungId){
            $reinigungPdf = 'send';
        }
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
            'emailContent' => $request->emailContent,
            'isCustomEmailSend' => $isCustomEmailSend,
            'customEmailContent' => $customEmail,
            'pdf' => $pdf,
            'isReinigungPdf' => $reinigungPdf,
            'token' => $oToken,
            'token2' => $zToken,
            'customLinks' => $customLinks,
            'offerMailFooter' => $offerMailFooter
        ];

        if ($isCustomEmailSend) {
            Arr::set($emailData, 'customEmailContent', $customEmail);
            $customEmailDB = [
                'offerId' => $offerteId,
                'content' => $customEmail,
            ];
            CustomEmail::create($customEmailDB);
        }

        if ($create) {
            $mailSuccess = '';
            if ($isEmailSend) {
                Mail::to($emailData['email'])->send(new OfferMail($emailData));
                $mailSuccess = ', E-Mail und Angebotdatei wurden erfolgreich gesendet';
            }
            //return redirect()->back()->with('status',' '.'Teklif Başarıyla Eklendi'.' '.$mailSuccess );
            return redirect()
                ->route('customer.detail', ['id' => $customerId])
                ->with('status', 'Angebot erfolgreich hinzugefügt ' . $mailSuccess)
                ->with('cat', 'Offerte')
                ->withInput()
                ->with('keep_status', true);
        } else {
            return redirect()->back()->with('status-err', 'Fehler: Angebot konnte nicht hinzugefügt werden, E-Mail konnte nicht gesendet werden');
        }
    }

    public function edit(Request $request)
    {
        $id = $request->route('id');
        if ($id != 0) {

            $data = offerte::where('id', $id)->first();
            $customEmailData = CustomEmail::where('offerId',$id)->first();
            // dd($data);
            $customer = Customer::where('id', $data['customerId'])->first();
            return view(
                'front.offer.edit',
                [
                    'data' => $data,
                    'customer' => $customer,
                    'customEmail' => $customEmailData
                ]
            );
        }
    }


    // Düzenlenecek
    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = offerte::where('id', $id)->count();
        $d = offerte::where('id', $id)->first();
        $all = $request->except('_token');
        $changedData = [];
        $isCustomEmailSend = $request->get('isCustomEmail');
        $customEmail = $request->get('customEmail');

        $customer = Customer::where('id', '=', $d['customerId'])->first();

        // Tanımlamalar
        $AusId = $d['auszugaddressId'] ? $d['auszugaddressId'] : NULL;
        $AusId2 = $d['auszugaddressId2'] ? $d['auszugaddressId2'] : NULL;
        $AusId3 = $d['auszugaddressId3'] ? $d['auszugaddressId3'] : NULL;
        $EinId = $d['einzugaddressId'] ? $d['einzugaddressId'] : NULL;
        $EinId2 = $d['einzugaddressId2'] ? $d['einzugaddressId2'] : NULL;
        $EinId3 = $d['einzugaddressId3'] ? $d['einzugaddressId3'] : NULL;
        $offerUmzugId = $d['offerteUmzugId'] ? $d['offerteUmzugId'] : NULL;
        $offerEinpackId = $d['offerteEinpackId'] ? $d['offerteEinpackId'] : NULL;
        $offerAuspackId = $d['offerteAuspackId'] ? $d['offerteAuspackId'] : NULL;
        $offerReinigungId = $d['offerteReinigungId'] ? $d['offerteReinigungId'] : NULL;
        $offerReinigungId2 = $d['offerteReinigung2Id'] ? $d['offerteReinigung2Id'] : NULL;
        $offerEntsorgungId = $d['offerteEntsorgungId'] ? $d['offerteEntsorgungId'] : NULL;
        $offerTransportId  = $d['offerteTransportId'] ? $d['offerteTransportId'] : NULL;
        $offerLagerungId = $d['offerteLagerungId'] ? $d['offerteLagerungId'] : NULL;
        $offerMaterialId = $d['offerteMaterialId'] ? $d['offerteMaterialId'] : NULL;
        $contactPerson = NULL;
        $isEmailSend = $request->get('isEmail');
        $offerteId = 0;

        // Offerte Adresse
        if ($AusId) {
            $mainAusAdress = [
                'street' => $request->ausStreet1,
                'postCode' => $request->ausPostcode1,
                'city' => $request->ausCity1,
                'country' => $request->isAusCustomLand1 ? $request->ausCustomLand1 : $request->ausCountry1,
                'buildType' => $request->ausBuildType1,
                'floor' => $request->ausFloorType1,
                'lift' => $request->isAusLift1,
                'parkPlatz' => $request->isAusParkplatz1,
                'addressType' => 0
            ];
            // offerteAddress::where('id', $AusId)->update($mainAusAdress);
            $offerteAusAdress = offerteAddress::find($AusId);
            $originalDataAusAdress = $offerteAusAdress->getAttributes();

            $offerteAusAdress->fill($mainAusAdress);
            $offerteAusAdress->save();

            $changes = $offerteAusAdress->getChanges();


            foreach ($changes as $attribute => $newValue) {
                $oldValue = $originalDataAusAdress[$attribute];
                if ($attribute === 'updated_at') {
                    continue; // inputName 'updated_at' ise döngünün bir sonraki iterasyonuna geç
                }

                $attributeMappings = array(
                    'street' => 'STRASSE',
                    'postCode' => 'PLZ',
                    'city' => 'ORT',
                    'country' => 'LAND',
                    'buildType' => 'GEBÄUDE',
                    'floor' => 'ETAGE',
                    'lift' => 'LIFT',
                );
                $newAtt = isset($attributeMappings[$attribute]) ? $attributeMappings[$attribute] : $attribute;

                $changedData[$attribute] = [
                    'oldValue' => $oldValue,
                    'newValue' => $newValue,
                    'serviceType' => 'AusAdress',
                    'offerId' => $request->route('id'),
                    'inputName' => $newAtt,
                ];

            }


                foreach ($changedData as $key => $value) {
                    $oldValue = $value['oldValue'];
                    $newValue = $value['newValue'];
                    $serviceType = $value['serviceType'];
                    $offerId = $value['offerId'];
                    $inputName = $value['inputName'];
                    $userName = Auth::user()->name;

                    $offerLog = [
                        'offerId' => $offerId,
                        'serviceType' => $serviceType,
                        'inputName' => $inputName,
                        'oldValue' => $oldValue,
                        'newValue' => $newValue,
                        'userName' => $userName
                    ];
                    OfferLogs::create($offerLog);
                    $changedData = [];
                }

        }

        if ($AusId2) {
            if ($request->isofferAuszug2 == NULL) {
                offerteAddress::where('id', $AusId2)->delete();
                $AusId2 = NULL;
            } else {
                $mainAusAdress = [
                    'street' => $request->ausStreet2,
                    'postCode' => $request->ausPostcode2,
                    'city' => $request->ausCity2,
                    'country' => $request->isAusCustomLand2 ? $request->ausCustomLand2 : $request->ausCountry2,
                    'buildType' => $request->ausBuildType2,
                    'floor' => $request->ausFloorType2,
                    'lift' => $request->isAusLift2,
                    'parkPlatz' => $request->isAusParkplatz2,
                    'addressType' => 0
                ];

                // offerteAddress::where('id', $AusId2)->update($mainAusAdress);
                $offerteAusAdress2 = offerteAddress::find($AusId2);
                $originalDataAusAdress2 = $offerteAusAdress2->getAttributes();

                $offerteAusAdress2->fill($mainAusAdress);
                $offerteAusAdress2->save();

                $changes = $offerteAusAdress2->getChanges();


                foreach ($changes as $attribute => $newValue) {
                    $oldValue = $originalDataAusAdress2[$attribute];
                    if ($attribute === 'updated_at') {
                        continue; // inputName 'updated_at' ise döngünün bir sonraki iterasyonuna geç
                    }

                    $attributeMappings = array(
                        'street' => 'STRASSE',
                        'postCode' => 'PLZ',
                        'city' => 'ORT',
                        'country' => 'LAND',
                        'buildType' => 'GEBÄUDE',
                        'floor' => 'ETAGE',
                        'lift' => 'LIFT',
                    );
                    $newAtt = isset($attributeMappings[$attribute]) ? $attributeMappings[$attribute] : $attribute;

                    $changedData[$attribute] = [
                        'oldValue' => $oldValue,
                        'newValue' => $newValue,
                        'serviceType' => 'AusAdress2',
                        'offerId' => $request->route('id'),
                        'inputName' => $newAtt,
                    ];

                }


                    foreach ($changedData as $key => $value) {
                        $oldValue = $value['oldValue'];
                        $newValue = $value['newValue'];
                        $serviceType = $value['serviceType'];
                        $offerId = $value['offerId'];
                        $inputName = $value['inputName'];
                        $userName = Auth::user()->name;

                        $offerLog = [
                            'offerId' => $offerId,
                            'serviceType' => $serviceType,
                            'inputName' => $inputName,
                            'oldValue' => $oldValue,
                            'newValue' => $newValue,
                            'userName' => $userName
                        ];
                        OfferLogs::create($offerLog);
                        $changedData = [];
                    }

            }
        } elseif ($AusId2 == NULL && $request->isofferAuszug2) {
            $mainAusAdress = [
                'street' => $request->ausStreet2,
                'postCode' => $request->ausPostcode2,
                'city' => $request->ausCity2,
                'country' => $request->isAusCustomLand2 ? $request->ausCustomLand2 : $request->ausCountry2,
                'buildType' => $request->ausBuildType2,
                'floor' => $request->ausFloorType2,
                'lift' => $request->isAusLift2,
                'parkPlatz' => $request->isAusParkplatz2,
                'addressType' => 0
            ];

            offerteAddress::create($mainAusAdress);
            $mainAusAdress = DB::table('offerte_addresses')->where('addressType', '=', 0)->orderBy('id', 'DESC')->first();
            $AusId2 = $mainAusAdress->id;
        }


        if ($AusId3) {

            if ($request->isofferAuszug3 == NULL) {
                offerteAddress::where('id', $AusId3)->delete();
                $AusId3 = NULL;
            } else {
                $mainAusAdress = [
                    'street' => $request->ausStreet3,
                    'postCode' => $request->ausPostcode3,
                    'city' => $request->ausCity3,
                    'country' => $request->isAusCustomLand3 ? $request->ausCustomLand3 : $request->ausCountry3,
                    'buildType' => $request->ausBuildType3,
                    'floor' => $request->ausFloorType3,
                    'lift' => $request->isAusLift3,
                    'parkPlatz' => $request->isAusParkplatz3,
                    'addressType' => 0
                ];

                // offerteAddress::where('id', $AusId3)->update($mainAusAdress);
                $offerteAusAdress3 = offerteAddress::find($AusId3);
                $originalDataAusAdress3 = $offerteAusAdress3->getAttributes();

                $offerteAusAdress3->fill($mainAusAdress);
                $offerteAusAdress3->save();

                $changes = $offerteAusAdress3->getChanges();


                foreach ($changes as $attribute => $newValue) {
                    $oldValue = $originalDataAusAdress3[$attribute];
                    if ($attribute === 'updated_at') {
                        continue; // inputName 'updated_at' ise döngünün bir sonraki iterasyonuna geç
                    }
                    $attributeMappings = array(
                        'street' => 'STRASSE',
                        'postCode' => 'PLZ',
                        'city' => 'ORT',
                        'country' => 'LAND',
                        'buildType' => 'GEBÄUDE',
                        'floor' => 'ETAGE',
                        'lift' => 'LIFT',
                    );
                    $newAtt = isset($attributeMappings[$attribute]) ? $attributeMappings[$attribute] : $attribute;

                    $changedData[$attribute] = [
                        'oldValue' => $oldValue,
                        'newValue' => $newValue,
                        'serviceType' => 'AusAdress3',
                        'offerId' => $request->route('id'),
                        'inputName' => $newAtt,
                    ];

                }


                    foreach ($changedData as $key => $value) {
                        $oldValue = $value['oldValue'];
                        $newValue = $value['newValue'];
                        $serviceType = $value['serviceType'];
                        $offerId = $value['offerId'];
                        $inputName = $value['inputName'];
                        $userName = Auth::user()->name;

                        $offerLog = [
                            'offerId' => $offerId,
                            'serviceType' => $serviceType,
                            'inputName' => $inputName,
                            'oldValue' => $oldValue,
                            'newValue' => $newValue,
                            'userName' => $userName
                        ];
                        OfferLogs::create($offerLog);
                        $changedData = [];
                    }

            }
        } elseif ($AusId3 == NULL && $request->isofferAuszug3) {
            $mainAusAdress = [
                'street' => $request->ausStreet3,
                'postCode' => $request->ausPostcode3,
                'city' => $request->ausCity3,
                'country' => $request->isAusCustomLand3 ? $request->ausCustomLand3 : $request->ausCountry3,
                'buildType' => $request->ausBuildType3,
                'floor' => $request->ausFloorType3,
                'lift' => $request->isAusLift3,
                'parkPlatz' => $request->isAusParkplatz1,
                'addressType' => 0
            ];

            offerteAddress::create($mainAusAdress);
            $mainAusAdress = DB::table('offerte_addresses')->where('addressType', '=', 0)->orderBy('id', 'DESC')->first();
            $AusId3 = $mainAusAdress->id;
        }


        if ($EinId) {
            $mainEinAdress = [
                'street' => $request->einStreet1,
                'postCode' => $request->einPostcode1,
                'city' => $request->einCity1,
                'country' => $request->isEinCustomLand1 ? $request->einCustomLand1 : $request->einCountry1,
                'buildType' => $request->einBuildType1,
                'floor' => $request->einFloorType1,
                'lift' => $request->isEinLift1,
                'parkPlatz' => $request->isEinParkplatz1,
                'addressType' => 1
            ];
            // offerteAddress::where('id', $EinId)->update($mainEinAdress);
            $offerteEinAdress = offerteAddress::find($EinId);
            $originalDataEinAdress = $offerteEinAdress->getAttributes();

            $offerteEinAdress->fill($mainEinAdress);
            $offerteEinAdress->save();

            $changes = $offerteEinAdress->getChanges();


            foreach ($changes as $attribute => $newValue) {
                $oldValue = $originalDataEinAdress[$attribute];
                if ($attribute === 'updated_at') {
                    continue; // inputName 'updated_at' ise döngünün bir sonraki iterasyonuna geç
                }

                $attributeMappings = array(
                    'street' => 'STRASSE',
                    'postCode' => 'PLZ',
                    'city' => 'ORT',
                    'country' => 'LAND',
                    'buildType' => 'GEBÄUDE',
                    'floor' => 'ETAGE',
                    'lift' => 'LIFT',
                );
                $newAtt = isset($attributeMappings[$attribute]) ? $attributeMappings[$attribute] : $attribute;

                $changedData[$attribute] = [
                    'oldValue' => $oldValue,
                    'newValue' => $newValue,
                    'serviceType' => 'EinAdress',
                    'offerId' => $request->route('id'),
                    'inputName' => $newAtt,
                ];

            }


                foreach ($changedData as $key => $value) {
                    $oldValue = $value['oldValue'];
                    $newValue = $value['newValue'];
                    $serviceType = $value['serviceType'];
                    $offerId = $value['offerId'];
                    $inputName = $value['inputName'];
                    $userName = Auth::user()->name;

                    $offerLog = [
                        'offerId' => $offerId,
                        'serviceType' => $serviceType,
                        'inputName' => $inputName,
                        'oldValue' => $oldValue,
                        'newValue' => $newValue,
                        'userName' => $userName
                    ];
                    OfferLogs::create($offerLog);
                    $changedData = [];
                }

        } elseif ($EinId == NULL && $request->einStreet1) {
            $mainEinAdress = [
                'street' => $request->einStreet1,
                'postCode' => $request->einPostcode1,
                'city' => $request->einCity1,
                'country' => $request->isEinCustomLand1 ? $request->einCustomLand1 : $request->einCountry1,
                'buildType' => $request->einBuildType1,
                'floor' => $request->einFloorType1,
                'lift' => $request->isEinLift1,
                'parkPlatz' => $request->isEinParkplatz1,
                'addressType' => 1
            ];

            offerteAddress::create($mainEinAdress);
            $mainEinAdress = DB::table('offerte_addresses')->where('addressType', '=', 1)->orderBy('id', 'DESC')->first();
            $EinId = $mainEinAdress->id;
        }

        if ($EinId2) {
            if ($request->isofferEinzug2 == NULL) {
                offerteAddress::where('id', $EinId2)->delete();
                $EinId2 = NULL;
            } else {

                $mainEinAdress = [
                    'street' => $request->einStreet2,
                    'postCode' => $request->einPostcode2,
                    'city' => $request->einCity2,
                    'country' => $request->isEinCustomLand2 ? $request->einCustomLand2 : $request->einCountry2,
                    'buildType' => $request->einBuildType2,
                    'floor' => $request->einFloorType2,
                    'lift' => $request->isEinLift2,
                    'parkPlatz' => $request->isEinParkplatz2,
                    'addressType' => 1
                ];
                // offerteAddress::where('id', $EinId2)->update($mainEinAdress);
                $offerteEinAdress2 = offerteAddress::find($EinId2);
                $originalDataEinAdress2 = $offerteEinAdress2->getAttributes();

                $offerteEinAdress2->fill($mainEinAdress);
                $offerteEinAdress2->save();

                $changes = $offerteEinAdress2->getChanges();


                foreach ($changes as $attribute => $newValue) {
                    $oldValue = $originalDataEinAdress2[$attribute];
                    if ($attribute === 'updated_at') {
                        continue; // inputName 'updated_at' ise döngünün bir sonraki iterasyonuna geç
                    }

                    $attributeMappings = array(
                        'street' => 'STRASSE',
                        'postCode' => 'PLZ',
                        'city' => 'ORT',
                        'country' => 'LAND',
                        'buildType' => 'GEBÄUDE',
                        'floor' => 'ETAGE',
                        'lift' => 'LIFT',
                    );
                    $newAtt = isset($attributeMappings[$attribute]) ? $attributeMappings[$attribute] : $attribute;

                    $changedData[$attribute] = [
                        'oldValue' => $oldValue,
                        'newValue' => $newValue,
                        'serviceType' => 'EinAdress2',
                        'offerId' => $request->route('id'),
                        'inputName' => $newAtt,
                    ];

                }


                    foreach ($changedData as $key => $value) {
                        $oldValue = $value['oldValue'];
                        $newValue = $value['newValue'];
                        $serviceType = $value['serviceType'];
                        $offerId = $value['offerId'];
                        $inputName = $value['inputName'];
                        $userName = Auth::user()->name;

                        $offerLog = [
                            'offerId' => $offerId,
                            'serviceType' => $serviceType,
                            'inputName' => $inputName,
                            'oldValue' => $oldValue,
                            'newValue' => $newValue,
                            'userName' => $userName
                        ];
                        OfferLogs::create($offerLog);
                        $changedData = [];
                    }

            }
        } elseif ($EinId2 == NULL && $request->einStreet2) {
            $mainEinAdress = [
                'street' => $request->einStreet2,
                'postCode' => $request->einPostcode2,
                'city' => $request->einCity2,
                'country' => $request->isEinCustomLand2 ? $request->einCustomLand2 : $request->einCountry2,
                'buildType' => $request->einBuildType2,
                'floor' => $request->einFloorType2,
                'lift' => $request->isEinLift2,
                'parkPlatz' => $request->isEinParkplatz2,
                'addressType' => 1
            ];

            offerteAddress::create($mainEinAdress);
            $mainEinAdress = DB::table('offerte_addresses')->where('addressType', '=', 1)->orderBy('id', 'DESC')->first();
            $EinId2 = $mainEinAdress->id;
        }

        if ($EinId3) {
            if ($request->isofferEinzug3 == NULL) {
                offerteAddress::where('id', $EinId3)->delete();
                $EinId3 = NULL;
            }

            $mainEinAdress = [
                'street' => $request->einStreet3,
                'postCode' => $request->einPostcode3,
                'city' => $request->einCity3,
                'country' => $request->isEinCustomLand3 ? $request->einCustomLand3 : $request->einCountry3,
                'buildType' => $request->einBuildType3,
                'floor' => $request->einFloorType3,
                'lift' => $request->isEinLift3,
                'parkPlatz' => $request->isEinParkplatz3,
                'addressType' => 1
            ];

            // offerteAddress::where('id', $EinId3)->update($mainEinAdress);
            $offerteEinAdress3 = offerteAddress::find($EinId3);
            $originalDataEinAdress3 = $offerteEinAdress3->getAttributes();

            $offerteEinAdress3->fill($mainEinAdress);
            $offerteEinAdress3->save();

            $changes = $offerteEinAdress3->getChanges();


            foreach ($changes as $attribute => $newValue) {
                $oldValue = $originalDataEinAdress3[$attribute];
                if ($attribute === 'updated_at') {
                    continue; // inputName 'updated_at' ise döngünün bir sonraki iterasyonuna geç
                }

                $attributeMappings = array(
                    'street' => 'STRASSE',
                    'postCode' => 'PLZ',
                    'city' => 'ORT',
                    'country' => 'LAND',
                    'buildType' => 'GEBÄUDE',
                    'floor' => 'ETAGE',
                    'lift' => 'LIFT',
                );
                $newAtt = isset($attributeMappings[$attribute]) ? $attributeMappings[$attribute] : $attribute;

                $changedData[$attribute] = [
                    'oldValue' => $oldValue,
                    'newValue' => $newValue,
                    'serviceType' => 'EinAdress3',
                    'offerId' => $request->route('id'),
                    'inputName' => $newAtt,
                ];

            }


                foreach ($changedData as $key => $value) {
                    $oldValue = $value['oldValue'];
                    $newValue = $value['newValue'];
                    $serviceType = $value['serviceType'];
                    $offerId = $value['offerId'];
                    $inputName = $value['inputName'];
                    $userName = Auth::user()->name;

                    $offerLog = [
                        'offerId' => $offerId,
                        'serviceType' => $serviceType,
                        'inputName' => $inputName,
                        'oldValue' => $oldValue,
                        'newValue' => $newValue,
                        'userName' => $userName
                    ];
                    OfferLogs::create($offerLog);
                    $changedData = [];
                }


        } elseif ($EinId3 == NULL && $request->einStreet3) {
            $mainEinAdress = [
                'street' => $request->einStreet3,
                'postCode' => $request->einPostcode3,
                'city' => $request->einCity3,
                'country' => $request->isEinCustomLand3 ? $request->einCustomLand3 : $request->einCountry3,
                'buildType' => $request->einBuildType3,
                'floor' => $request->einFloorType3,
                'lift' => $request->isEinLift3,
                'parkPlatz' => $request->isEinParkplatz3,
                'addressType' => 1
            ];

            offerteAddress::create($mainEinAdress);
            $mainEinAdress = DB::table('offerte_addresses')->where('addressType', '=', 1)->orderBy('id', 'DESC')->first();
            $EinId3 = $mainEinAdress->id;
        }

        if ($offerUmzugId) {

            if ($request->isUmzug == NULL) {
                OfferteUmzug::where('id', $offerUmzugId)->delete();
                $offerUmzugId = NULL;
            } else {
                $offerUmzug = [
                    'tariff' => $request->umzugTariff,
                    'ma' => $request->umzug1ma,
                    'lkw' => $request->umzug1lkw,
                    'anhanger' => $request->umzug1anhanger,
                    'chf' => $request->umzug1chf,
                    'moveDate' => $request->umzugausdate,
                    'moveTime' => $request->umzug1time,
                    'moveDate2' => $request->umzugeindate,
                    'arrivalGas' => $request->umzugArrivalGas,
                    'returnGas' => $request->umzugReturnGas,
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
                    'discountPercent' => $request->umzugDiscountPercent,
                    'compromiser' => $request->umzugCompromiser,
                    'extraCostName' => $request->umzugExtraDiscountText,
                    'extraCostPrice' => $request->umzugExtraDiscount,
                    'defaultPrice' => $request->umzugTotalPrice,
                    'topCost' => $request->isKostendach ?  $request->umzugTopPrice : Null,
                    'fixedPrice' => $request->isPauschal ?  $request->umzugDefaultPrice : Null,
                ];

                // OfferteUmzug::where('id', $offerUmzugId)->update($offerUmzug);
                $offerteUmzug = OfferteUmzug::find($offerUmzugId);
                $originalDataUmzug = $offerteUmzug->getAttributes();

                $offerteUmzug->fill($offerUmzug);
                $offerteUmzug->save();

                $changes = $offerteUmzug->getChanges();


                foreach ($changes as $attribute => $newValue) {
                    $oldValue = $originalDataUmzug[$attribute];
                    if ($attribute === 'updated_at') {
                        continue; // inputName 'updated_at' ise döngünün bir sonraki iterasyonuna geç
                    }
                    $attributeMappings = array(
                        'tariff' => 'TARIF',
                        'ma' => 'MA',
                        'lkw' => 'LKW',
                        'anhanger' => 'ANHÄNGER',
                        'chf' => 'CHF-ANSATZ',
                        'moveDate' => 'UMZUGSTERMIN',
                        'moveTime' => 'ARBEITSBEGINN',
                        'moveDate2' => 'EINZUGSTERMIN',
                        'arrivalReturn' => 'ANFAHRT/RÜCKFAHRT [CHF]',
                        'montage' => 'AB- UND AUFBAU',
                        'moveHours' => 'DAUER [H]',
                        'extra' => 'Spesen',
                        'extra1' => 'Klavier 250.-',
                        'extra2' => 'Klavier 350.-',
                        'extra3' => 'Möbellift 0.-',
                        'extra4' => 'Möbellift 250.-',
                        'extra5' => 'Möbellift 350.-',
                        'extra6' => 'Schwergutzuschlag 150.-',
                        'extra7' => 'Schwergutzuschlag 250.-',
                        'extra8' => 'Tresor 350.-',
                        'extra9' => 'Tresor 450.-',
                        'extra10' => 'Wasserbett',
                        'customCostName1' => 'CustomZUSATZ-1 Text',
                        'customCostName2' => 'CustomZUSATZ-2 Text',
                        'customCostPrice1' => 'CustomZUSATZ-1',
                        'customCostPrice2' => 'CustomZUSATZ-2',
                        'costPrice' => 'KOSTEN',
                        'discount' => 'RABATT',
                        'discountPercent' => 'RABATT[%]',
                        'compromiser' => 'ENTGEGENKOMMEN',
                        'extraCostName' => 'WEITERE ABZÜGE',
                        'extraCostPrice' => 'WEITERE ABZÜGE PREIS',
                        'defaultPrice' => 'GESCHÄTZTE KOSTEN',
                        'topCost' => 'KOSTENDACH',
                        'fixedPrice' => 'PAUSCHAL',
                    );
                    $newAtt = isset($attributeMappings[$attribute]) ? $attributeMappings[$attribute] : $attribute;

                    $changedData[$attribute] = [
                        'oldValue' => $oldValue,
                        'newValue' => $newValue,
                        'serviceType' => 'Umzug',
                        'offerId' => $request->route('id'),
                        'inputName' => $newAtt
                    ];
                }


                    foreach ($changedData as $key => $value) {
                        $oldValue = $value['oldValue'];
                        $newValue = $value['newValue'];
                        $serviceType = $value['serviceType'];
                        $offerId = $value['offerId'];
                        $inputName = $value['inputName'];
                        $userName = Auth::user()->name;

                        $offerLog = [
                            'offerId' => $offerId,
                            'serviceType' => $serviceType,
                            'inputName' => $inputName,
                            'oldValue' => $oldValue,
                            'newValue' => $newValue,
                            'userName' => $userName,
                        ];
                        OfferLogs::create($offerLog);
                        $changedData = [];
                    }

            }
        } elseif ($offerUmzugId == NULL && $request->isUmzug) {
            $offerUmzug = [
                'tariff' => $request->umzugTariff,
                'ma' => $request->umzug1ma,
                'lkw' => $request->umzug1lkw,
                'anhanger' => $request->umzug1anhanger,
                'chf' => $request->umzug1chf,
                'moveDate' => $request->umzugausdate,
                'moveTime' => $request->umzug1time,
                'moveDate2' => $request->umzugeindate,
                'arrivalGas' => $request->umzugArrivalGas,
                'returnGas' => $request->umzugReturnGas,
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
                'discountPercent' => $request->umzugDiscountPercent,
                'compromiser' => $request->umzugCompromiser,
                'extraCostName' => $request->umzugExtraDiscountText,
                'extraCostPrice' => $request->umzugExtraDiscount,
                'defaultPrice' => $request->umzugTotalPrice,
                'topCost' => $request->isKostendach ?  $request->umzugTopPrice : Null,
                'fixedPrice' => $request->isPauschal ?  $request->umzugDefaultPrice : Null,
            ];
            OfferteUmzug::create($offerUmzug);
            $offerteUmzugIdBul = DB::table('offerte_umzugs')->orderBy('id', 'DESC')->first();
            $offerUmzugId = $offerteUmzugIdBul->id;
        }



        if ($offerEinpackId) {

            if ($request->isEinpack == NULL) {
                OfferteEinpack::where('id', $offerEinpackId)->delete();
                $offerEinpackId = NULL;
            } else {
                $offerEinpack = [
                    'tariff' => $request->einpackTariff,
                    'ma' => $request->einpack1ma,
                    'chf' => $request->einpack1chf,
                    'einpackDate' => $request->einpackdate,
                    'einpackTime' => $request->einpacktime,
                    'arrivalGas' => $request->einpackArrivalGas,
                    'returnGas' => $request->einpackReturnGas,
                    'moveHours' => $request->einpackHours,
                    'extra' => $request->einpackmasraf ? $request->einpackextra1 : Null,
                    'extra1' => $request->einpackmasraf1 ? $request->einpackextra2 : Null,
                    'customCostName1' => $request->einpackCostText1,
                    'customCostPrice1' => $request->einpackCost1,
                    'customCostName2' => $request->einpackCostText2,
                    'customCostPrice2' => $request->einpackCost2,
                    'costPrice' => $request->einpackCost,
                    'discount' => $request->einpackDiscount,
                    'discountPercent' => $request->einpackDiscountPercent,
                    'compromiser' => $request->einpackCompromiser,
                    'extraCostName' => $request->einpackExtraDiscountText,
                    'extraCostPrice' => $request->einpackExtraDiscount,
                    'defaultPrice' => $request->einpackTotalPrice,
                    'topCost' => $request->isEinpackKostendach ?  $request->einpackTopPrice : Null,
                    'fixedPrice' => $request->isEinpackPauschal ?  $request->einpackDefaultPrice : Null,
                ];

                // OfferteEinpack::where('id', $offerEinpackId)->update($offerEinpack);
                $offerteEinpack = OfferteEinpack::find($offerEinpackId);
                $originalDataEinpack = $offerteEinpack->getAttributes();

                $offerteEinpack->fill($offerEinpack);
                $offerteEinpack->save();

                $changes = $offerteEinpack->getChanges();


                foreach ($changes as $attribute => $newValue) {
                    $oldValue = $originalDataEinpack[$attribute];
                    if ($attribute === 'updated_at') {
                        continue; // inputName 'updated_at' ise döngünün bir sonraki iterasyonuna geç
                    }

                    $attributeMappings = array(
                        'tariff' => 'TARIF',
                        'ma' => 'MA',
                        'chf' => 'CHF-ANSATZ',
                        'einpackDate' => 'PACKTERMIN',
                        'einpackTime' => 'ARBEITSBEGINN',
                        'arrivalReturn' => 'ANFAHRT/RÜCKFAHRT [CHF]',
                        'moveHours' => 'DAUER [H]',
                        'extra' => 'Spesen',
                        'extra1' => 'Verpackungsmaterial',
                        'customCostName1' => 'CustomZUSATZ-1 Text',
                        'customCostName2' => 'CustomZUSATZ-2 Text',
                        'customCostPrice1' => 'CustomZUSATZ-1',
                        'customCostPrice2' => 'CustomZUSATZ-2',
                        'costPrice' => 'KOSTEN',
                        'discount' => 'RABATT',
                        'discountPercent' => 'RABATT[%]',
                        'compromiser' => 'ENTGEGENKOMMEN',
                        'extraCostName' => 'WEITERE ABZÜGE',
                        'extraCostPrice' => 'WEITERE ABZÜGE PREIS',
                        'defaultPrice' => 'GESCHÄTZTE KOSTEN',
                        'topCost' => 'KOSTENDACH',
                        'fixedPrice' => 'PAUSCHAL',
                    );
                    $newAtt = isset($attributeMappings[$attribute]) ? $attributeMappings[$attribute] : $attribute;

                    $changedData[$attribute] = [
                        'oldValue' => $oldValue,
                        'newValue' => $newValue,
                        'serviceType' => 'Einpack',
                        'offerId' => $request->route('id'),
                        'inputName' => $newAtt,
                    ];

                }


                    foreach ($changedData as $key => $value) {
                        $oldValue = $value['oldValue'];
                        $newValue = $value['newValue'];
                        $serviceType = $value['serviceType'];
                        $offerId = $value['offerId'];
                        $inputName = $value['inputName'];
                        $userName = Auth::user()->name;

                        $offerLog = [
                            'offerId' => $offerId,
                            'serviceType' => $serviceType,
                            'inputName' => $inputName,
                            'oldValue' => $oldValue,
                            'newValue' => $newValue,
                            'userName' => $userName
                        ];
                        OfferLogs::create($offerLog);
                        $changedData = [];
                    }

            }
        } elseif ($offerEinpackId == NULL && $request->isEinpack) {
            $offerEinpack = [
                'tariff' => $request->einpackTariff,
                'ma' => $request->einpack1ma,
                'chf' => $request->einpack1chf,
                'einpackDate' => $request->einpackdate,
                'einpackTime' => $request->einpacktime,
                'arrivalGas' => $request->einpackArrivalGas,
                'returnGas' => $request->einpackReturnGas,
                'moveHours' => $request->einpackHours,
                'extra' => $request->einpackmasraf ? $request->einpackextra1 : Null,
                'extra1' => $request->einpackmasraf1 ? $request->einpackextra2 : Null,
                'customCostName1' => $request->einpackCostText1,
                'customCostPrice1' => $request->einpackCost1,
                'customCostName2' => $request->einpackCostText2,
                'customCostPrice2' => $request->einpackCost2,
                'costPrice' => $request->einpackCost,
                'discount' => $request->einpackDiscount,
                'discountPercent' => $request->einpackDiscountPercent,
                'compromiser' => $request->einpackCompromiser,
                'extraCostName' => $request->einpackExtraDiscountText,
                'extraCostPrice' => $request->einpackExtraDiscount,
                'defaultPrice' => $request->einpackTotalPrice,
                'topCost' => $request->isEinpackKostendach ?  $request->einpackTopPrice : Null,
                'fixedPrice' => $request->isEinpackPauschal ?  $request->einpackDefaultPrice : Null,
            ];

            OfferteEinpack::create($offerEinpack);
            $offerteEinpackIdBul = DB::table('offerte_einpacks')->orderBy('id', 'DESC')->first();
            $offerEinpackId = $offerteEinpackIdBul->id;
        }


        if ($offerAuspackId) {

            if ($request->isAuspack == NULL) {
                OfferteAuspack::where('id', $offerAuspackId)->delete();
                $offerAuspackId = NULL;
            } else {
                $offerAuspack = [
                    'tariff' => $request->auspackTariff,
                    'ma' => $request->auspack1ma,
                    'chf' => $request->auspack1chf,
                    'auspackDate' => $request->auspackdate,
                    'auspackTime' => $request->auspacktime,
                    'arrivalGas' => $request->auspackArrivalGas,
                    'returnGas' => $request->auspackReturnGas,
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
                    'topCost' => $request->isAuspackKostendach ?  $request->auspackTopPrice : Null,
                    'fixedPrice' => $request->isAuspackPauschal ?  $request->auspackDefaultPrice : Null,
                ];

                // OfferteAuspack::where('id', $offerAuspackId)->update($offerAuspack);
                $offerteAuspack = OfferteAuspack::find($offerAuspackId);
                $originalDataAuspack = $offerteAuspack->getAttributes();

                $offerteAuspack->fill($offerAuspack);
                $offerteAuspack->save();

                $changes = $offerteAuspack->getChanges();


                foreach ($changes as $attribute => $newValue) {
                    $oldValue = $originalDataAuspack[$attribute];
                    if ($attribute === 'updated_at') {
                        continue; // inputName 'updated_at' ise döngünün bir sonraki iterasyonuna geç
                    }

                    $attributeMappings = array(
                        'tariff' => 'TARIF',
                        'ma' => 'MA',
                        'chf' => 'CHF-ANSATZ',
                        'auspackDate' => 'PACKTERMIN',
                        'auspackTime' => 'ARBEITSBEGINN',
                        'arrivalReturn' => 'ANFAHRT/RÜCKFAHRT [CHF]',
                        'moveHours' => 'DAUER [H]',
                        'extra' => 'Spesen',
                        'extra1' => 'Verpackungsmaterial',
                        'customCostName1' => 'CustomZUSATZ-1 Text',
                        'customCostName2' => 'CustomZUSATZ-2 Text',
                        'customCostPrice1' => 'CustomZUSATZ-1',
                        'customCostPrice2' => 'CustomZUSATZ-2',
                        'costPrice' => 'KOSTEN',
                        'discount' => 'RABATT',
                        'discountPercent' => 'RABATT[%]',
                        'compromiser' => 'ENTGEGENKOMMEN',
                        'extraCostName' => 'WEITERE ABZÜGE',
                        'extraCostPrice' => 'WEITERE ABZÜGE PREIS',
                        'defaultPrice' => 'GESCHÄTZTE KOSTEN',
                        'topCost' => 'KOSTENDACH',
                        'fixedPrice' => 'PAUSCHAL',
                    );
                    $newAtt = isset($attributeMappings[$attribute]) ? $attributeMappings[$attribute] : $attribute;

                    $changedData[$attribute] = [
                        'oldValue' => $oldValue,
                        'newValue' => $newValue,
                        'serviceType' => 'Auspack',
                        'offerId' => $request->route('id'),
                        'inputName' => $newAtt,
                    ];

                }


                    foreach ($changedData as $key => $value) {
                        $oldValue = $value['oldValue'];
                        $newValue = $value['newValue'];
                        $serviceType = $value['serviceType'];
                        $offerId = $value['offerId'];
                        $inputName = $value['inputName'];
                        $userName = Auth::user()->name;

                        $offerLog = [
                            'offerId' => $offerId,
                            'serviceType' => $serviceType,
                            'inputName' => $inputName,
                            'oldValue' => $oldValue,
                            'newValue' => $newValue,
                            'userName' => $userName
                        ];
                        OfferLogs::create($offerLog);
                        $changedData = [];
                    }

            }
        } elseif ($offerAuspackId == NULL && $request->isAuspack) {
            $offerAuspack = [
                'tariff' => $request->auspackTariff,
                'ma' => $request->auspack1ma,
                'chf' => $request->auspack1chf,
                'auspackDate' => $request->auspackdate,
                'auspackTime' => $request->auspacktime,
                'arrivalGas' => $request->auspackArrivalGas,
                'returnGas' => $request->auspackReturnGas,
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
                'topCost' => $request->isAuspackKostendach ?  $request->auspackTopPrice : Null,
                'fixedPrice' => $request->isAuspackPauschal ?  $request->auspackDefaultPrice : Null,
            ];

            OfferteAuspack::create($offerAuspack);
            $offerteAuspackIdBul = DB::table('offerte_auspacks')->orderBy('id', 'DESC')->first();
            $offerAuspackId = $offerteAuspackIdBul->id;
        }

        if ($offerReinigungId) {

            if ($request->isReinigung == NULL) {
                OfferteReinigung::where('id', $offerReinigungId)->delete();
                $offerReinigungId = NULL;
            } else {
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
                    'costPrice' => $request->reinigungCostPrice,
                    'discountText' => $request->reinigungExtraDiscountText,
                    'discount' => $request->reinigungExtraDiscount,
                    'discountPercent' => $request->reinigungDiscountPercent,
                    'totalPrice' => $request->reinigungTotalPrice,
                ];

                // OfferteReinigung::where('id', $offerReinigungId)->update($offerReinigung);
                $offerteReinigung = OfferteReinigung::find($offerReinigungId);
                $originalDataReinigung = $offerteReinigung->getAttributes();

                $offerteReinigung->fill($offerReinigung);
                $offerteReinigung->save();

                $changes = $offerteReinigung->getChanges();


                foreach ($changes as $attribute => $newValue) {
                    $oldValue = $originalDataReinigung[$attribute];
                    if ($attribute === 'updated_at') {
                        continue; // inputName 'updated_at' ise döngünün bir sonraki iterasyonuna geç
                    }

                    $attributeMappings = array(
                        'reinigungType' => 'REINIGUNGSART',
                        'extraReinigung' => 'MANUELLE EINGABE (REINIGUNGSART)',
                        'fixedTariff' => 'TARIF (PAUSCHAL)',
                        'fixedTariffPrice' => 'TARIFPREIS',
                        'standartTariff' => 'TARIF (STUNDENANSATZ)',
                        'ma' => 'MA',
                        'chf' => 'CHF-ANSATZ',
                        'hours' => 'DAUER [H]',
                        'extraService1' => 'DÜBELLÖCHER ZUSPACHTELN',
                        'extraService2' => 'MIT HOCHDRUCKREINIGER',
                        'startDate' => 'REINIGUNGSTERMIN',
                        'startTime' => 'ARBEITSBEGINN',
                        'endDate' => 'ABGABETERMIN',
                        'endTime' => 'ABGABEZEIT',
                        'extra1' => 'Hochdruckreiniger',
                        'extra2' => 'Stein- und Parkettböden',
                        'extra3' => 'Teppichschamponieren',
                        'extraCostText1' => 'CustomZUSATZ-1 Text',
                        'extraCostValue1' => 'CustomZUSATZ-1',
                        'extraCostText2' => 'CustomZUSATZ-2 Text',
                        'extraCostValue2' => 'CustomZUSATZ-2',
                        'costPrice' => 'KOSTEN',
                        'discountText' => 'ABZUG-TEXT',
                        'discount' => 'ABZUG',
                        'discountPercent' => 'RABATT[%]',
                        'totalPrice' => 'GESCHÄTZTE KOSTEN',
                    );
                    $newAtt = isset($attributeMappings[$attribute]) ? $attributeMappings[$attribute] : $attribute;

                    $changedData[$attribute] = [
                        'oldValue' => $oldValue,
                        'newValue' => $newValue,
                        'serviceType' => 'Reinigung',
                        'offerId' => $request->route('id'),
                        'inputName' => $newAtt,
                    ];

                }


                    foreach ($changedData as $key => $value) {
                        $oldValue = $value['oldValue'];
                        $newValue = $value['newValue'];
                        $serviceType = $value['serviceType'];
                        $offerId = $value['offerId'];
                        $inputName = $value['inputName'];
                        $userName = Auth::user()->name;

                        $offerLog = [
                            'offerId' => $offerId,
                            'serviceType' => $serviceType,
                            'inputName' => $inputName,
                            'oldValue' => $oldValue,
                            'newValue' => $newValue,
                            'userName' => $userName
                        ];
                        OfferLogs::create($offerLog);
                        $changedData = [];
                    }

            }
        } elseif ($offerReinigungId == NULL && $request->isReinigung) {
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
                'costPrice' => $request->reinigungCostPrice,
                'discountText' => $request->reinigungExtraDiscountText,
                'discount' => $request->reinigungExtraDiscount,
                'discountPercent' => $request->reinigungDiscountPercent,
                'totalPrice' => $request->reinigungTotalPrice,
            ];

            OfferteReinigung::create($offerReinigung);
            $offerteReinigungIdBul = DB::table('offerte_reinigungs')->orderBy('id', 'DESC')->first();
            $offerReinigungId = $offerteReinigungIdBul->id;
        }

        if ($offerReinigungId2) {

            if ($request->isReinigung2 == NULL) {
                OfferteReinigung::where('id', $offerReinigungId2)->delete();
                $offerReinigungId2 = NULL;
            } else {
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
                    'costPrice' => $request->reinigung2CostPrice,
                    'discountText' => $request->reinigungExtraDiscountText2,
                    'discount' => $request->reinigungExtraDiscount2,
                    'discountPercent' => $request->reinigungDiscountPercent2,
                    'totalPrice' => $request->reinigungTotalPrice2,
                ];

                // OfferteReinigung::where('id', $offerReinigungId2)->update($offerReinigung2);
                $offerteReinigung2 = OfferteReinigung::find($offerReinigungId2);
                $originalDataReinigung2 = $offerteReinigung2->getAttributes();

                $offerteReinigung2->fill($offerReinigung2);
                $offerteReinigung2->save();

                $changes = $offerteReinigung2->getChanges();


                foreach ($changes as $attribute => $newValue) {
                    $oldValue = $originalDataReinigung2[$attribute];
                    if ($attribute === 'updated_at') {
                        continue; // inputName 'updated_at' ise döngünün bir sonraki iterasyonuna geç
                    }

                    $attributeMappings = array(
                        'reinigungType' => 'REINIGUNGSART',
                        'extraReinigung' => 'MANUELLE EINGABE (REINIGUNGSART)',
                        'fixedTariff' => 'TARIF (PAUSCHAL)',
                        'fixedTariffPrice' => 'TARIFPREIS',
                        'standartTariff' => 'TARIF (STUNDENANSATZ)',
                        'ma' => 'MA',
                        'chf' => 'CHF-ANSATZ',
                        'hours' => 'DAUER [H]',
                        'extraService1' => 'DÜBELLÖCHER ZUSPACHTELN',
                        'extraService2' => 'MIT HOCHDRUCKREINIGER',
                        'startDate' => 'REINIGUNGSTERMIN',
                        'startTime' => 'ARBEITSBEGINN',
                        'endDate' => 'ABGABETERMIN',
                        'endTime' => 'ABGABEZEIT',
                        'extra1' => 'Hochdruckreiniger',
                        'extra2' => 'Stein- und Parkettböden',
                        'extra3' => 'Teppichschamponieren',
                        'extraCostText1' => 'CustomZUSATZ-1 Text',
                        'extraCostValue1' => 'CustomZUSATZ-1',
                        'extraCostText2' => 'CustomZUSATZ-2 Text',
                        'extraCostValue2' => 'CustomZUSATZ-2',
                        'costPrice' => 'KOSTEN',
                        'discountText' => 'ABZUG-TEXT',
                        'discount' => 'ABZUG',
                        'discountPercent' => 'RABATT[%]',
                        'totalPrice' => 'GESCHÄTZTE KOSTEN',
                    );
                    $newAtt = isset($attributeMappings[$attribute]) ? $attributeMappings[$attribute] : $attribute;

                    $changedData[$attribute] = [
                        'oldValue' => $oldValue,
                        'newValue' => $newValue,
                        'serviceType' => 'Reinigung2',
                        'offerId' => $request->route('id'),
                        'inputName' => $newAtt,
                    ];

                }


                    foreach ($changedData as $key => $value) {
                        $oldValue = $value['oldValue'];
                        $newValue = $value['newValue'];
                        $serviceType = $value['serviceType'];
                        $offerId = $value['offerId'];
                        $inputName = $value['inputName'];
                        $userName = Auth::user()->name;

                        $offerLog = [
                            'offerId' => $offerId,
                            'serviceType' => $serviceType,
                            'inputName' => $inputName,
                            'oldValue' => $oldValue,
                            'newValue' => $newValue,
                            'userName' => $userName
                        ];
                        OfferLogs::create($offerLog);
                        $changedData = [];
                    }

            }
        } elseif ($offerReinigungId2 == NULL && $request->isReinigung2) {
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
                'costPrice' => $request->reinigung2CostPrice,
                'discountText' => $request->reinigungExtraDiscountText2,
                'discount' => $request->reinigungExtraDiscount2,
                'discountPercent' => $request->reinigungDiscountPercent2,
                'totalPrice' => $request->reinigungTotalPrice2,
            ];

            OfferteReinigung::create($offerReinigung2);
            $offerteReinigungIdBul2 = DB::table('offerte_reinigungs')->orderBy('id', 'DESC')->first();
            $offerReinigungId2 = $offerteReinigungIdBul2->id;
        }


        if ($offerEntsorgungId) {

            if ($request->isEntsorgung == NULL) {
                OfferteEntsorgung::where('id', $offerEntsorgungId)->delete();
                $offerEntsorgungId = NULL;
            } else {
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
                    'arrivalGas' => $request->entsorgungArrivalGas,
                    'returnGas' => $request->entsorgungReturnGas,
                    'entsorgungExtra1' => $request->entsorgungmasraf ? $request->entsorgungextra1 : Null,
                    'extraCostText1' => $request->entsorgungCostText1,
                    'extraCostValue1' => $request->entsorgungCost1,
                    'extraCostText2' => $request->entsorgungCostText2,
                    'extraCostValue2' => $request->entsorgungCost2,
                    'discount' => $request->entsorgungDiscount,
                    'discountPercent' => $request->entsorgungDiscountPercent,
                    'extraDiscountText' => $request->entsorgungExtraDiscountText,
                    'extraDiscountPrice' => $request->entsorgungExtraDiscount,
                    'costPrice' => $request->entsorgungCostPrice,
                    'defaultPrice' => $request->entsorgungTotalPrice,
                    'topCost' => $request->isEntsorgungKostendach ?  $request->entsorgungTopPrice : Null,
                    'fixedPrice' => $request->isEntsorgungPauschal ?  $request->entsorgungDefaultPrice : Null,
                ];

                // OfferteEntsorgung::where('id', $offerEntsorgungId)->update($offerEntsorgung);
                $offerteEntsorgung = OfferteEntsorgung::find($offerEntsorgungId);
                $originalDataEntsorgung = $offerteEntsorgung->getAttributes();

                $offerteEntsorgung->fill($offerEntsorgung);
                $offerteEntsorgung->save();

                $changes = $offerteEntsorgung->getChanges();


                foreach ($changes as $attribute => $newValue) {
                    $oldValue = $originalDataEntsorgung[$attribute];
                    if ($attribute === 'updated_at') {
                        continue; // inputName 'updated_at' ise döngünün bir sonraki iterasyonuna geç
                    }

                    $attributeMappings = array(
                        'volume' => 'VOLUMEN-TARIF',
                        'volumeCHF' => 'CHF-Ansatz',
                        'fixedCost' => 'ENTSORGUNGSAUFWAND PAUSCHAL',
                        'm3' => 'GESCHÄTZTES VOLUMEN [M3]',
                        'tariff' => 'TARIF',
                        'ma' => 'MA',
                        'lkw' => 'LKW',
                        'anhanger' => 'ANHÄNGER',
                        'chf' => 'CHF-ANSATZ',
                        'hour' => 'DAUER [H]',
                        'entsorgungDate' => 'ENTSORGUNGSTERMIN',
                        'entsorgungTime' => 'ARBEITSBEGINN',
                        'arrivalReturn' => 'ANFAHRT/RÜCKFAHRT [CHF]',
                        'entsorgungExtra1' => 'Spesen',
                        'extraCostText1' => 'CustomZUSATZ-1 Text',
                        'extraCostValue1' => 'CustomZUSATZ-1',
                        'extraCostText2' => 'CustomZUSATZ-2 Text',
                        'extraCostValue2' => 'CustomZUSATZ-2',
                        'discount' => 'RABATT',
                        'discountPercent' => 'RABATT[%]',
                        'extraDiscountText' => 'WEITERE ABZÜGE-TEXT',
                        'extraDiscountPrice' => 'WEITERE ABZÜGE-PREIS',
                        'costPrice' => 'KOSTEN',
                        'defaultPrice' => 'GESCHÄTZTE KOSTEN',
                        'topCost' => 'KOSTENDACH',
                        'fixedPrice' => 'PAUSCHAL',
                    );
                    $newAtt = isset($attributeMappings[$attribute]) ? $attributeMappings[$attribute] : $attribute;

                    $changedData[$attribute] = [
                        'oldValue' => $oldValue,
                        'newValue' => $newValue,
                        'serviceType' => 'Entsorgung',
                        'offerId' => $request->route('id'),
                        'inputName' => $newAtt,
                    ];

                }


                    foreach ($changedData as $key => $value) {
                        $oldValue = $value['oldValue'];
                        $newValue = $value['newValue'];
                        $serviceType = $value['serviceType'];
                        $offerId = $value['offerId'];
                        $inputName = $value['inputName'];
                        $userName = Auth::user()->name;

                        $offerLog = [
                            'offerId' => $offerId,
                            'serviceType' => $serviceType,
                            'inputName' => $inputName,
                            'oldValue' => $oldValue,
                            'newValue' => $newValue,
                            'userName' => $userName
                        ];
                        OfferLogs::create($offerLog);
                        $changedData = [];
                    }

            }
        } elseif ($offerEntsorgungId == NULL && $request->isEntsorgung) {
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
                'arrivalGas' => $request->entsorgungArrivalGas,
                'returnGas' => $request->entsorgungReturnGas,
                'entsorgungExtra1' => $request->entsorgungmasraf ? $request->entsorgungextra1 : Null,
                'extraCostText1' => $request->entsorgungCostText1,
                'extraCostValue1' => $request->entsorgungCost1,
                'extraCostText2' => $request->entsorgungCostText2,
                'extraCostValue2' => $request->entsorgungCost2,
                'discount' => $request->entsorgungDiscount,
                'discountPercent' => $request->entsorgungDiscountPercent,
                'extraDiscountText' => $request->entsorgungExtraDiscountText,
                'extraDiscountPrice' => $request->entsorgungExtraDiscount,
                'costPrice' => $request->entsorgungCostPrice,
                'defaultPrice' => $request->entsorgungTotalPrice,
                'topCost' => $request->isEntsorgungKostendach ?  $request->entsorgungTopPrice : Null,
                'fixedPrice' => $request->isEntsorgungPauschal ?  $request->entsorgungDefaultPrice : Null,
            ];

            OfferteEntsorgung::create($offerEntsorgung);
            $offerteEntsorgungIdBul = DB::table('offerte_entsorgungs')->orderBy('id', 'DESC')->first();
            $offerEntsorgungId = $offerteEntsorgungIdBul->id;
        }

        if ($offerTransportId) {
            if ($request->isTransport == NULL) {
                OfferteTransport::where('id', $offerTransportId)->delete();
                $offerTransportId = NULL;
            } else {
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
                    'arrivalGas' => $request->transportArrivalGas,
                    'returnGas' => $request->transportReturnGas,
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
                    'discountPercent' => $request->transportDiscountPercent,
                    'compromiser' => $request->transportCompromiser,
                    'extraDiscountText' => $request->transportExtraDiscountText,
                    'extraDiscountValue' => $request->transportExtraDiscount,
                    'extraDiscountText2' => $request->transportExtraDiscountText2,
                    'extraDiscountValue2' => $request->transportExtraDiscount2,
                    'defaultPrice' => $request->transportDefaultPrice,
                    'topCost' => $request->isTransportKostendach ?  $request->transportTopPrice : Null,
                    'fixedPrice' => $request->isTransportKostendach ?  $request->transportFixedPrice : Null,
                ];
                // OfferteTransport::where('id', $offerTransportId)->update($offerTransport);
                $offerteTransport = OfferteTransport::find($offerTransportId);
                $originalDataTransport = $offerteTransport->getAttributes();

                $offerteTransport->fill($offerTransport);
                $offerteTransport->save();

                $changes = $offerteTransport->getChanges();


                foreach ($changes as $attribute => $newValue) {
                    $oldValue = $originalDataTransport[$attribute];
                    if ($attribute === 'updated_at') {
                        continue; // inputName 'updated_at' ise döngünün bir sonraki iterasyonuna geç
                    }

                    $attributeMappings = array(
                        'pdfText' => 'TRANSPORT-ART TEXT (KOMMT IN PDF)',
                        'fixedChf' => 'PAUSCHALPREIS-TARIF',
                        'tariff' => 'TARIF',
                        'ma' => 'MA',
                        'lkw' => 'LKW',
                        'anhanger' => 'ANHÄNGER',
                        'chf' => 'CHF-ANSATZ',
                        'hour' => 'DAUER [H]',
                        'transportDate' => 'TRANSPORTTERMIN',
                        'transportTime' => 'ARBEITSBEGINN',
                        'arrivalReturn' => 'ANFAHRT/RÜCKFAHRT [CHF]',
                        'extraCostText1' => 'CustomZUSATZ-1 Text',
                        'extraCostValue1' => 'CustomZUSATZ-1',
                        'extraCostText2' => 'CustomZUSATZ-2 Text',
                        'extraCostValue2' => 'CustomZUSATZ-2',
                        'extraCostText3' => 'CustomZUSATZ-3 Text',
                        'extraCostValue3' => 'CustomZUSATZ-3',
                        'extraCostText4' => 'CustomZUSATZ-4 Text',
                        'extraCostValue4' => 'CustomZUSATZ-4',
                        'extraCostText5' => 'CustomZUSATZ-5 Text',
                        'extraCostValue5' => 'CustomZUSATZ-5',
                        'extraCostText6' => 'CustomZUSATZ-6 Text',
                        'extraCostValue6' => 'CustomZUSATZ-6',
                        'extraCostText7' => 'CustomZUSATZ-7 Text',
                        'extraCostValue7' => 'CustomZUSATZ-7',
                        'totalPrice' => 'KOSTEN',
                        'discount' => 'RABATT',
                        'discountPercent' => 'RABATT[%]',
                        'compromiser' => 'ENTGEGENKOMMEN',
                        'extraDiscountText' => 'WEITERE ABZÜGE-1 TEXT',
                        'extraDiscountValue' => 'WEITERE ABZÜGE-1',
                        'extraDiscountText2' => 'WEITERE ABZÜGE-2 TEXT',
                        'extraDiscountValue2' => 'WEITERE ABZÜGE-2',
                        'defaultPrice' => 'GESCHÄTZTE KOSTEN',
                        'topCost' => 'KOSTENDACH',
                        'fixedPrice' => 'PAUSCHAL',
                    );
                    $newAtt = isset($attributeMappings[$attribute]) ? $attributeMappings[$attribute] : $attribute;

                    $changedData[$attribute] = [
                        'oldValue' => $oldValue,
                        'newValue' => $newValue,
                        'serviceType' => 'Transport',
                        'offerId' => $request->route('id'),
                        'inputName' => $newAtt,
                    ];

                }


                foreach ($changedData as $key => $value) {
                    $oldValue = $value['oldValue'];
                    $newValue = $value['newValue'];
                    $serviceType = $value['serviceType'];
                    $offerId = $value['offerId'];
                    $inputName = $value['inputName'];
                    $userName = Auth::user()->name;

                    $offerLog = [
                        'offerId' => $offerId,
                        'serviceType' => $serviceType,
                        'inputName' => $inputName,
                        'oldValue' => $oldValue,
                        'newValue' => $newValue,
                        'userName' => $userName
                    ];
                    OfferLogs::create($offerLog);
                    $changedData = [];
                }

            }
        } elseif ($offerTransportId == NULL && $request->isTransport) {
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
                'arrivalGas' => $request->transportArrivalGas,
                'returnGas' => $request->transportReturnGas,
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
                'discountPercent' => $request->transportDiscountPercent,
                'compromiser' => $request->transportCompromiser,
                'extraDiscountText' => $request->transportExtraDiscountText,
                'extraDiscountValue' => $request->transportExtraDiscount,
                'extraDiscountText2' => $request->transportExtraDiscountText2,
                'extraDiscountValue2' => $request->transportExtraDiscount2,
                'defaultPrice' => $request->transportDefaultPrice,
                'topCost' => $request->isTransportKostendach ?  $request->transportTopPrice : Null,
                'fixedPrice' => $request->isTransportKostendach ?  $request->transportFixedPrice : Null,
            ];

            OfferteTransport::create($offerTransport);
            $offerteTransportIdBul = DB::table('offerte_transports')->orderBy('id', 'DESC')->first();
            $offerTransportId = $offerteTransportIdBul->id;
        }

        if ($offerLagerungId) {
            if ($request->isLagerung == NULL) {
                OfferteLagerung::where('id', $offerLagerungId)->delete();
                $offerLagerungId = NULL;
            } else {
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
                    'discountPercent' => $request->lagerungDiscountPercent,
                    'costPrice' => $request->lagerungCostPrice,
                    'totalPrice' => $request->lagerungCost,
                    'fixedPrice' => $request->isLagerungFixedPrice ?  $request->lagerungFixedPrice : Null,
                ];
                // OfferteLagerung::where('id', $offerLagerungId)->update($offerLagerung);
                $offerteLagerung = OfferteLagerung::find($offerLagerungId);
                $originalDataLagerung = $offerteLagerung->getAttributes();

                $offerteLagerung->fill($offerLagerung);
                $offerteLagerung->save();

                $changes = $offerteLagerung->getChanges();


                foreach ($changes as $attribute => $newValue) {
                    $oldValue = $originalDataLagerung[$attribute];
                    if ($attribute === 'updated_at') {
                        continue; // inputName 'updated_at' ise döngünün bir sonraki iterasyonuna geç
                    }

                    $attributeMappings = array(
                        'tariff' => 'TARIF',
                        'chf' => 'CHF-ANSATZ',
                        'volume' => 'VOLUMEN [M3]',
                        'extraCostText1' => 'WEITERE KOSTEN-1 TEXT',
                        'extraCostValue1' => 'WEITERE KOSTEN-1',
                        'extraCostText2' => 'WEITERE KOSTEN-2 TEXT',
                        'extraCostValue2' => 'WEITERE KOSTEN-2',
                        'discountText' => 'WEITERE ABZÜGE-TEXT',
                        'discountValue' => 'WEITERE ABZÜGE-PREIS',
                        'discountPercent' => 'RABATT[%]',
                        'costPrice' => 'KOSTEN',
                        'totalPrice' => 'GESCHÄTZTE KOSTEN',
                        'fixedPrice' => 'PAUSCHAL',
                    );
                    $newAtt = isset($attributeMappings[$attribute]) ? $attributeMappings[$attribute] : $attribute;

                    $changedData[$attribute] = [
                        'oldValue' => $oldValue,
                        'newValue' => $newValue,
                        'serviceType' => 'Lagerung',
                        'offerId' => $request->route('id'),
                        'inputName' => $newAtt,
                    ];

                }


                    foreach ($changedData as $key => $value) {
                        $oldValue = $value['oldValue'];
                        $newValue = $value['newValue'];
                        $serviceType = $value['serviceType'];
                        $offerId = $value['offerId'];
                        $inputName = $value['inputName'];
                        $userName = Auth::user()->name;

                        $offerLog = [
                            'offerId' => $offerId,
                            'serviceType' => $serviceType,
                            'inputName' => $inputName,
                            'oldValue' => $oldValue,
                            'newValue' => $newValue,
                            'userName' => $userName
                        ];
                        OfferLogs::create($offerLog);
                        $changedData = [];
                    }

            }
        } elseif ($offerLagerungId == NULL && $request->isLagerung) {
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
                'discountPercent' => $request->lagerungDiscountPercent,
                'costPrice' => $request->lagerungCostPrice,
                'totalPrice' => $request->lagerungCost,
                'fixedPrice' => $request->isLagerungFixedPrice ?  $request->lagerungFixedPrice : Null,
            ];

            OfferteLagerung::create($offerLagerung);
            $offerteLagerungIdBul = DB::table('offerte_lagerungs')->orderBy('id', 'DESC')->first();
            $offerLagerungId = $offerteLagerungIdBul->id;
        }


        if ($offerMaterialId) {
            if ($request->isVerpackungsmaterial == NULL) {
                OfferteMaterial::where('id', $offerMaterialId)->delete();
                OfferteBasket::where('materialId', $offerMaterialId)->delete();
                $offerMaterialId = NULL;
            } else {

                $offerMaterial = [
                    'discount' => $request->materialDiscount,
                    'discountPercent' => $request->materialDiscountPercent,
                    'deliverPrice' => $request->materialShipPrice,
                    'recievePrice' => $request->materialRecievePrice,
                    'totalPrice' => $request->materialTotalPrice
                ];

                // $materialUpdate = OfferteMaterial::where('id', $offerMaterialId)->update($offerMaterial);
                $offerteMaterial = OfferteMaterial::find($offerMaterialId);
                $originalDataMaterial = $offerteMaterial->getAttributes();

                $offerteMaterial->fill($offerMaterial);
                $offerteMaterial->save();

                $changes = $offerteMaterial->getChanges();


                foreach ($changes as $attribute => $newValue) {
                    $oldValue = $originalDataMaterial[$attribute];
                    if ($attribute === 'updated_at') {
                        continue; // inputName 'updated_at' ise döngünün bir sonraki iterasyonuna geç
                    }

                    $attributeMappings = array(
                        'discount' => 'REDUKTION',
                        'discountPercent' => 'REDUKTION[%]',
                        'deliverPrice' => 'LIEFERUNG',
                        'recievePrice' => 'ABHOLUNG',
                        'totalPrice' => 'TOTAL',
                    );

                    $newAtt = isset($attributeMappings[$attribute]) ? $attributeMappings[$attribute] : $attribute;

                    $changedData[$attribute] = [
                        'oldValue' => $oldValue,
                        'newValue' => $newValue,
                        'serviceType' => 'Material',
                        'offerId' => $request->route('id'),
                        'inputName' => $newAtt,
                    ];

                }


                    foreach ($changedData as $key => $value) {
                        $oldValue = $value['oldValue'];
                        $newValue = $value['newValue'];
                        $serviceType = $value['serviceType'];
                        $offerId = $value['offerId'];
                        $inputName = $value['inputName'];
                        $userName = Auth::user()->name;

                        $offerLog = [
                            'offerId' => $offerId,
                            'serviceType' => $serviceType,
                            'inputName' => $inputName,
                            'oldValue' => $oldValue,
                            'newValue' => $newValue,
                            'userName' => $userName
                        ];
                        OfferLogs::create($offerLog);
                        $changedData = [];
                    }


                if ($offerteMaterial && $all['islem']) {
                    $islem = $all['islem'];
                    unset($all['islem']);
                    if (count($islem) != 0) {
                        OfferteBasket::where('materialId', $offerMaterialId)->delete();
                        foreach ($islem as $k => $v) {
                            $offerBasket = [
                                'productId' => $v['urunId'],
                                'buyType' => $v['buyType'],
                                'quantity' => $v['adet'],
                                'totalPrice' => $v['toplam'],
                                'materialId' => $offerMaterialId
                            ];
                            OfferteBasket::create($offerBasket);
                        }
                    } else {
                        OfferteMaterial::where('id', $offerMaterialId)->delete();
                        OfferteBasket::where('materialId', $offerMaterialId)->delete();
                    }
                }
            }
        } elseif ($offerMaterialId == NULL && $request->isVerpackungsmaterial) {
            $offerMaterial = [
                'discount' => $request->materialDiscount,
                'discountPercent' => $request->materialDiscountPercent,
                'deliverPrice' => $request->materialShipPrice,
                'recievePrice' => $request->materialRecievePrice,
                'totalPrice' => $request->materialTotalPrice
            ];

            $material = OfferteMaterial::create($offerMaterial);
            $offerteMaterialIdBul = DB::table('offerte_materials')->orderBy('id', 'DESC')->first();
            $offerMaterialId = $offerteMaterialIdBul->id;

            if ($material && $all['islem']) {
                $islem = $all['islem'];
                unset($all['islem']);
                if (count($islem) != 0) {
                    foreach ($islem as $k => $v) {
                        $offerBasket = [
                            'productId' => $v['urunId'],
                            'buyType' => $v['buyType'],
                            'quantity' => $v['adet'],
                            'totalPrice' => $v['tutar'],
                            'materialId' => $offerMaterialId
                        ];
                        OfferteBasket::create($offerBasket);
                    }
                }
            }
        }
        if ($request->contactPerson == 'Bitte wählen') {
            $contactPerson = $request->customContactPerson;
        } else {
            $contactPerson = $request->contactPerson;
        }

        $offerteUpdate = [
            'customerId' => $d['customerId'],
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
            'offerPrice' => $request->offerteEsimatedIncome,
            'offerteNote' => $request->offertePdfNote,
            'panelNote' => $request->offerteNote,
            'kostenInkl' => $request->kdvType,
            'kostenExkl' => $request->kdvType1,
            'kostenFrei' => $request->kdvType3,
            'contactPerson' => $contactPerson,
            'isCampaign' => $request->isCampaign ? $request->campaignValue : NULL
        ];

        $offerte = offerte::find($id);
        $originalData = $offerte->getAttributes();

        $offerte->fill($offerteUpdate);
        $offerte->save();

        $changes = $offerte->getChanges();


        foreach ($changes as $attribute => $newValue) {
            $oldValue = $originalData[$attribute];
            if ($attribute === 'updated_at') {
                continue; // inputName 'updated_at' ise döngünün bir sonraki iterasyonuna geç
            }
            if ($attribute === 'panelNote') {
                continue; // inputName 'panelNote' ise döngünün bir sonraki iterasyonuna geç
            }
            if ($attribute === 'offerPrice') {
                continue; // inputName 'offerPrice' ise döngünün bir sonraki iterasyonuna geç
            }

            $attributeMappings = array(
                'appType' => 'BESICHTIGUNG',
                'auszugaddressId' => 'AuszugAdresse-1',
                'auszugaddressId2' => 'AuszugAdresse-2',
                'auszugaddressId3' => 'AuszugAdresse-3',
                'einzugaddressId' => 'EinzugAdresse-1',
                'einzugaddressId2' => 'EinzugAdresse-2',
                'einzugaddressId3' => 'EinzugAdresse-3',
                'offerteUmzugId' => 'Umzug',
                'offerteEinpackId' => 'Einpack',
                'offerteAuspackId' => 'Auspack',
                'offerteReinigungId' => 'Reinigung',
                'offerteReinigung2Id' => 'Reinigung-2',
                'offerteEntsorgungId' => 'Entsorgung',
                'offerteTransportId' => 'Transport',
                'offerteLagerungId' => 'Lagerung',
                'offerteMaterialId' => 'Material',
                'offerPrice' => 'ESIMATED INCOME',
                'offerteNote' => 'BEMERKUNG (IN OFFERTE)',
                'kostenInkl' => 'Kosten inkl. MwSt.',
                'kostenExkl' => 'Kosten exkl. MwSt.',
                'kostenFrei' => 'Kostenfrei MwSt.',
                'contactPerson' => 'KONTAKTPERSON',
                'offerteStatus' => 'OFFERTE-Stand',
            );

            $newAtt = isset($attributeMappings[$attribute]) ? $attributeMappings[$attribute] : $attribute;

            $changedData[$attribute] = [
                'oldValue' => $oldValue,
                'newValue' => $newValue,
                'serviceType' => 'Offerte',
                'offerId' => $request->route('id'),
                'inputName' => $newAtt,
            ];

        }


            foreach ($changedData as $key => $value) {
                $oldValue = $value['oldValue'];
                $newValue = $value['newValue'];
                $serviceType = $value['serviceType'];
                $offerId = $value['offerId'];
                $inputName = $value['inputName'];
                $userName = Auth::user()->name;

                $offerLog = [
                    'offerId' => $offerId,
                    'serviceType' => $serviceType,
                    'inputName' => $inputName,
                    'oldValue' => $oldValue,
                    'newValue' => $newValue,
                    'userName' => $userName
                ];
                OfferLogs::create($offerLog);
                $changedData = [];
            }


        // Teklif Onayı
        $oToken = Str::random(64);

        OfferVerify::create([
            'offerId' => $id,
            'oToken' => $oToken,
        ]);

        // Teklif Göster
        $zToken = Str::random(64);
        OfferCustomerView::create([
            'offerId' => $id,
            'zToken' => $zToken,
        ]);

        // SMS
        // if($request->isSMS)
        // {
        //     $customerId = $request->route('id');
        //     $customer = Customer::where('id',$customerId)->first();

        //     $basic  = new \Vonage\Client\Credentials\Basic("07fc1e6c", "J4i0Q5bZDupy1zIa");
        //     $client = new \Vonage\Client($basic);

        //     $number = $customer['mobile'];
        //     $staticContent = 'Herr'.' '.$customer['name'].' '.$customer['surname'].','.' ';
        //     $content ='Ihr Angebot wurde erstellt From Swiss';
        //     $staticContent2 = ' '.Company::InfoCompany('name');
        //     if($request->isCustomSMS)
        //     {
        //         $content = $request->customSMS;
        //         $response = $client->sms()->send(
        //             new \Vonage\SMS\Message\SMS('90 544 975 77 97', 'BRAND_NAME', $staticContent.$content.$staticContent2)
        //         );
        //     }
        //     else{
        //         $response = $client->sms()->send(
        //             new \Vonage\SMS\Message\SMS('905449757797', 'BRAND_NAME', $staticContent.$content.$staticContent2)
        //         );
        //     }
        // }
        // SMS

        $sub = 'Ihr Angebot';
        $from = Company::InfoCompany('email'); // gösterilen mail.
        $companyName = Company::InfoCompany('name'); // şirket adı buraya yaz veritabanında yok çünkü.
        $customer = DB::table('customers')->where('id', '=', $d['customerId'])->value('name'); // Customer Name
        $customerSurname = DB::table('customers')->where('id', '=', $d['customerId'])->value('surname');
        $customerData =  Customer::where('id', $d['customerId'])->first();

        $offer = offerte::where('id', $id)->first();
        $auszug1 = offerteAddress::where('id', $AusId)->first();
        $auszug2 = offerteAddress::where('id', $AusId2)->first();
        $auszug3 = offerteAddress::where('id', $AusId3)->first();
        $einzug1 = offerteAddress::where('id', $EinId)->first();
        $einzug2 = offerteAddress::where('id', $EinId2)->first();
        $einzug3 = offerteAddress::where('id', $EinId3)->first();
        $umzugPdf = OfferteUmzug::where('id', $offerUmzugId)->first();
        $einpackPdf = OfferteEinpack::where('id', $offerEinpackId)->first();
        $auspackPdf = OfferteAuspack::where('id', $offerAuspackId)->first();
        $reinigungPdf = OfferteReinigung::where('id', $offerReinigungId)->first();
        $reinigungPdf2 = OfferteReinigung::where('id', $offerReinigungId2)->first();
        $entsorgungPdf = OfferteEntsorgung::where('id', $offerEntsorgungId)->first();
        $transportPdf = OfferteTransport::where('id', $offerTransportId)->first();
        $lagerungPdf = OfferteLagerung::where('id', $offerLagerungId)->first();
        $materialPdf = OfferteMaterial::where('id', $offerMaterialId)->first();
        $basketPdf = OfferteBasket::where('materialId', $offerMaterialId)->get()->toArray();


        $pdfData = [
            'offer' => $offer,
            'offerteNumber' => $offerteId,
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
            'isAuszug2' => $request->isofferAuszug2,
            'isAuszug3' => $request->isofferAuszug3,
            'isEinzug2' => $request->isofferEinzug2,
            'isEinzug3' => $request->isofferEinzug3,
            'isEinzug1' => $request->einStreet1,
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
            'contactPerson' => $offer['contactPerson'],
        ];

        $pdf = Pdf::loadView('offerPdf', $pdfData);
        $pdf->setPaper('A4');

        $customLinks = "<a href=" . route('customerOfferView', $zToken) . '
        style="background-color: #8359B7;
        border-radius: 30px;
        color: white!important;
        padding: 7px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 4px 2px;
        cursor: pointer;"
        ' . '>' . 'Offerten Ansicht' . '</a>' . '<br>' . "<a href=" . route('acceptOffer', $oToken) . '
        style="background-color: #007BFF;
        border-radius: 30px;
        color: white!important;
        padding: 7px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 4px 2px;
        cursor: pointer;"
        ' . '>' . 'Offerte Annehmen ' . '</a>' . '<br>' . "<a href=" . route('rejectOffer', $oToken) . '
        style="background-color: #DC3545;
        border-radius: 30px;
        color: white!important;
        padding: 7px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 4px 2px;
        cursor: pointer;"
        ' . '>' . 'Offerte Ablehnen' . '</a>';
        $offerMailFooter = view('offerMailFooter');

        $reinigungPdf = 'dontsend';
        if($offerReinigungId){
            $reinigungPdf = 'send';
        }

        $emailData = [
            'appType' => $offer['appType'],
            'offerteNumber' => $id,
            'contactPerson' => $contactPerson,
            'name' => $customer,
            'surname' => $customerSurname,
            'gender' => $customerData['gender'],
            'sub' => $sub,
            'from' => $from,
            'companyName' => $companyName,
            'email' => $request->email,
            'emailContent' => $request->emailContent,
            'isCustomEmailSend' => $isCustomEmailSend,
            'customEmailContent' => $customEmail,
            'pdf' => $pdf,
            'isReinigungPdf' => $reinigungPdf,
            'token' => $oToken,
            'token2' => $zToken,
            'customLinks' => $customLinks,
            'offerMailFooter' => $offerMailFooter
        ];


        if ($isCustomEmailSend) {
            Arr::set($emailData, 'customEmailContent', $customEmail);
            $customMail = CustomEmail::where('offerId',$id)->first();
            $customEmailDB = [
                'offerId' => $id,
                'content' => $customEmail,
            ];
            if($customMail)
            {
                CustomEmail::where('offerId',$id)->update($customEmailDB);
            }
            else {
                CustomEmail::create($customEmailDB);
            }
        }

        if ($offerte->save()) {
            $mailSuccess = '';
            if ($isEmailSend) {
                Mail::to($emailData['email'])->send(new OfferMail($emailData));
                $mailSuccess = ', E-Mail und Angebotdatei wurden erfolgreich gesendet';
            }

            return redirect()
                ->route('customer.detail', ['id' => $d['customerId']])
                ->with('status', $id . ' - ' . 'Angebot mit Nummer wurde bearbeitet' . $mailSuccess)
                ->with('cat', 'Offerte')
                ->withInput()
                ->with('keep_status', true);
        } else {
            return redirect()->back()->with('status', 'Fehler: Angebot konnte nicht bearbeitet werden');
        }
    }


    public function detail(Request $request)
    {
        $id = $request->route('id');
        if ($id != 0) {

            $data = offerte::where('id', $id)->first();
            // dd($data);
            $customer = Customer::where('id', $data['customerId'])->first();
            $logs = OfferLogs::where('offerId', $id)->get();
            return view(
                'front.offer.detail',
                [
                    'data' => $data,
                    'customer' => $customer,
                    'logs' => $logs
                ]
            );
        }
    }

    public function manuelAccept (Request $request)
    {
        $id = request()->route('id');
        $offer = [
            'offerteStatus' => 'Onaylandı'
        ];
        $offerAcception = offerte::where('id',$id)->update($offer);
        if($offerAcception){
            return redirect()->back()->with('status', 'Angebotsstatus erfolgreich aktualisiert.');
        }
        else {
            return redirect()->back()->with('status-err', 'Fehler: Angebotsstatus konnte nicht aktualisiert werden.');
        }

    }

    public function manuelReject (Request $request)
    {
        $id = request()->route('id');
        $offer = [
            'offerteStatus' => 'Onaylanmadı'
        ];
        $offerRejection = offerte::where('id',$id)->update($offer);

        if($offerRejection){
            return redirect()->back()->with('status', 'Angebotsstatus erfolgreich aktualisiert.');
        }
        else {
            return redirect()->back()->with('status-err', 'Fehler: Angebotsstatus konnte nicht aktualisiert werden.');
        }
    }

    public function manuelDefault (Request $request)
    {
        $id = request()->route('id');
        $offer = [
            'offerteStatus' => 'Beklemede'
        ];
        $offerDefault = offerte::where('id',$id)->update($offer);

        if($offerDefault){
            return redirect()->back()->with('status', 'Angebotsstatus erfolgreich aktualisiert.');
        }
        else {
            return redirect()->back()->with('status-err', 'Fehler: Angebotsstatus konnte nicht aktualisiert werden.');
        }
    }


    public function delete($id)
    {
        $c = offerte::where('id', $id)->count();
        $offer = offerte::where('id', $id)->first();
        $customerId = $offer['customerId'];
        if ($c != 0) {
            $data = offerte::where('id', $id)->first();

            // MainOfferte
            $auszug = offerteAddress::where('id', $data['auszugaddressId'])->delete();
            $auszug2 = offerteAddress::where('id', $data['auszugaddressId2'])->delete();
            $auszug3 = offerteAddress::where('id', $data['auszugaddressId3'])->delete();
            $einzug = offerteAddress::where('id', $data['einzugaddressId'])->delete();
            $einzug2 = offerteAddress::where('id', $data['einzugaddressId2'])->delete();
            $einzug2 = offerteAddress::where('id', $data['einzugaddressId3'])->delete();
            $umzug = OfferteUmzug::where('id', $data['offerteUmzugId'])->delete();
            $einpack = OfferteEinpack::where('id', $data['offerteEinpackId'])->delete();
            $auspack = OfferteAuspack::where('id', $data['offerteAuspackId'])->delete();
            $reinigung = OfferteReinigung::where('id', $data['offerteReinigungId'])->delete();
            $reinigung2 = OfferteReinigung::where('id', $data['offerteReinigung2Id'])->delete();
            $entsorgung = OfferteEntsorgung::where('id', $data['offerteEntsorgungId'])->delete();
            $transport = OfferteTransport::where('id', $data['offerteTransportId'])->delete();
            $lagerung = OfferteLagerung::where('id', $data['offerteLagerungId'])->delete();
            $basket = OfferteBasket::where('materialId', $data['offerteMaterialId'])->delete();
            $material = OfferteMaterial::where('id', $data['offerteMaterialId'])->delete();

            OfferteNotes::where('offerId',$data['id'])->delete();
            ReceiptUmzug::where('offerId',$data['id'])->delete();
            ReceiptReinigung::where('offerId',$data['id'])->delete();
            OfferCustomerView::where('offerId',$data['id'])->delete();
            OfferLogs::where('offerId',$data['id'])->delete();
            OfferVerify::where('offerId', $data['id'])->delete();
            OfferCustomerView::where('offerId', $data['id'])->delete();
            CustomEmail::where('offerId',$data['id'])->delete();
            offerte::where('id', $id)->delete();

            return redirect()
                ->route('customer.detail', ['id' => $customerId])
                ->with('status', 'Angebot erfolgreich gelöscht')
                ->with('cat', 'Offerte')
                ->withInput()
                ->with('keep_status', true);
        } else {
            return redirect('/');
        }
    }

    public function showPdf($id)
    {
        $offer = offerte::where('id', $id)->first();
        $customerData =  Customer::where('id', $offer['customerId'])->first();
        $auszug1 = offerteAddress::where('id', $offer['auszugaddressId'])->first();
        $auszug2 = offerteAddress::where('id', $offer['auszugaddressId2'])->first();
        $auszug3 = offerteAddress::where('id', $offer['auszugaddressId3'])->first();
        $einzug1 = offerteAddress::where('id', $offer['einzugaddressId'])->first();
        $einzug2 = offerteAddress::where('id', $offer['einzugaddressId2'])->first();
        $einzug3 = offerteAddress::where('id', $offer['einzugaddressId3'])->first();
        $umzugPdf = OfferteUmzug::where('id', $offer['offerteUmzugId'])->first();
        $einpackPdf = OfferteEinpack::where('id', $offer['offerteEinpackId'])->first();
        $auspackPdf = OfferteAuspack::where('id', $offer['offerteAuspackId'])->first();
        $reinigungPdf = OfferteReinigung::where('id', $offer['offerteReinigungId'])->first();
        $reinigungPdf2 = OfferteReinigung::where('id', $offer['offerteReinigung2Id'])->first();
        $entsorgungPdf = OfferteEntsorgung::where('id', $offer['offerteEntsorgungId'])->first();
        $transportPdf = OfferteTransport::where('id', $offer['offerteTransportId'])->first();
        $lagerungPdf = OfferteLagerung::where('id', $offer['offerteLagerungId'])->first();
        $materialPdf = OfferteMaterial::where('id', $offer['offerteMaterialId'])->first();
        $basketPdf = OfferteBasket::where('materialId', $offer['offerteMaterialId'])->get()->toArray();


        $pdfData = [
            'offer' => $offer,
            'offerteNumber' => $offer['id'],
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
        ];

        $pdf = Pdf::loadView('offerPdf', $pdfData);
        return $pdf->stream();
    }

    // Akşam Bakılacak
    public function offerPdfPreview(Request $request)
    {
        $customerId = $request->route('id');
        $customerData = Customer::where('id', $customerId)->first();

        // Auszug Adresses
        $auszug1 = [
            'street' => $request->ausStreet1,
            'postCode' => $request->ausPostcode1,
            'city' => $request->ausCity1,
            'country' => $request->isAusCustomLand1 ? $request->ausCustomLand1 : $request->ausCountry1,
            'buildType' => $request->ausBuildType1,
            'floor' => $request->ausFloorType1,
            'lift' => $request->isAusLift1,
            'parkPlatz' => $request->isAusParkplatz1,
            'addressType' => 0
        ];

        $auszug2 = [
            'street' => $request->ausStreet2,
            'postCode' => $request->ausPostcode2,
            'city' => $request->ausCity2,
            'country' => $request->isAusCustomLand2 ? $request->ausCustomLand2 : $request->ausCountry2,
            'buildType' => $request->ausBuildType2,
            'floor' => $request->ausFloorType2,
            'lift' => $request->isAusLift2,
            'parkPlatz' => $request->isAusParkplatz2,
            'addressType' => 0
        ];

        $auszug3 = [
            'street' => $request->ausStreet3,
            'postCode' => $request->ausPostcode3,
            'city' => $request->ausCity3,
            'country' => $request->isAusCustomLand3 ? $request->ausCustomLand3 : $request->ausCountry3,
            'buildType' => $request->ausBuildType3,
            'floor' => $request->ausFloorType3,
            'lift' => $request->isAusLift3,
            'parkPlatz' => $request->isAusParkplatz3,
            'addressType' => 0
        ];


        // Einzug Adresses
        $einzug1 = [
            'street' => $request->einStreet1,
            'postCode' => $request->einPostcode1,
            'city' => $request->einCity1,
            'country' => $request->isEinCustomLand1 ? $request->einCustomLand1 : $request->einCountry1,
            'buildType' => $request->einBuildType1,
            'floor' => $request->einFloorType1,
            'lift' => $request->isEinLift1,
            'parkPlatz' => $request->isEinParkplatz1,
            'addressType' => 1
        ];

        $einzug2 = [
            'street' => $request->einStreet2,
            'postCode' => $request->einPostcode2,
            'city' => $request->einCity2,
            'country' => $request->isEinCustomLand2 ? $request->einCustomLand2 : $request->einCountry2,
            'buildType' => $request->einBuildType2,
            'floor' => $request->einFloorType2,
            'lift' => $request->isEinLift2,
            'parkPlatz' => $request->isEinParkplatz2,
            'addressType' => 1
        ];

        $einzug3 = [
            'street' => $request->einStreet3,
            'postCode' => $request->einPostcode3,
            'city' => $request->einCity3,
            'country' => $request->isEinCustomLand3 ? $request->einCustomLand3 : $request->einCountry3,
            'buildType' => $request->einBuildType3,
            'floor' => $request->einFloorType3,
            'lift' => $request->isEinLift3,
            'parkPlatz' => $request->isEinParkplatz3,
            'addressType' => 1
        ];


        // Umzug Dizi
        $umzugPdf = [
            'tariff' => $request->umzugTariff,
            'ma' => $request->umzug1ma,
            'lkw' => $request->umzug1lkw,
            'anhanger' => $request->umzug1anhanger,
            'chf' => $request->umzug1chf,
            'moveDate' => $request->umzugausdate,
            'moveTime' => $request->umzug1time,
            'moveDate2' => $request->umzugeindate,
            'arrivalGas' => $request->umzugArrivalGas,
            'returnGas' => $request->umzugReturnGas,
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
            'discountPercent' => $request->umzugDiscountPercent,
            'compromiser' => $request->umzugCompromiser,
            'extraCostName' => $request->umzugExtraDiscountText,
            'extraCostPrice' => $request->umzugExtraDiscount,
            'defaultPrice' => $request->umzugTotalPrice,
            'topCost' => $request->isKostendach ?  $request->umzugTopPrice : Null,
            'fixedPrice' => $request->isPauschal ?  $request->umzugDefaultPrice : Null,
        ];

        // Einpack Dizi
        $einpackPdf = [
            'tariff' => $request->einpackTariff,
            'ma' => $request->einpack1ma,
            'chf' => $request->einpack1chf,
            'einpackDate' => $request->einpackdate,
            'einpackTime' => $request->einpacktime,
            'arrivalGas' => $request->einpackArrivalGas,
            'returnGas' => $request->einpackReturnGas,
            'moveHours' => $request->einpackHours,
            'extra' => $request->einpackmasraf ? $request->einpackextra1 : Null,
            'extra1' => $request->einpackmasraf1 ? $request->einpackextra2 : Null,
            'customCostName1' => $request->einpackCostText1,
            'customCostPrice1' => $request->einpackCost1,
            'customCostName2' => $request->einpackCostText2,
            'customCostPrice2' => $request->einpackCost2,
            'costPrice' => $request->einpackCost,
            'discount' => $request->einpackDiscount,
            'discountPercent' => $request->einpackDiscountPercent,
            'compromiser' => $request->einpackCompromiser,
            'extraCostName' => $request->einpackExtraDiscountText,
            'extraCostPrice' => $request->einpackExtraDiscount,
            'defaultPrice' => $request->einpackTotalPrice,
            'topCost' => $request->isEinpackKostendach ?  $request->einpackTopPrice : Null,
            'fixedPrice' => $request->isEinpackPauschal ?  $request->einpackDefaultPrice : Null,
        ];

        // Auspack Dizi
        $auspackPdf = [
            'tariff' => $request->auspackTariff,
            'ma' => $request->auspack1ma,
            'chf' => $request->auspack1chf,
            'auspackDate' => $request->auspackdate,
            'auspackTime' => $request->auspacktime,
            'arrivalGas' => $request->auspackArrivalGas,
            'returnGas' => $request->auspackReturnGas,
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
            'topCost' => $request->isAuspackKostendach ?  $request->auspackTopPrice : Null,
            'fixedPrice' => $request->isAuspackPauschal ?  $request->auspackDefaultPrice : Null,
        ];

        // Reinigung Dizi
        $reinigungPdf = [
            'reinigungType' => $request->reinigungType,
            'extraReinigung' => $request->extraReinigung,
            'fixedTariff' => $request->reinigungFixedPrice,
            'fixedTariffPrice' => $request->reinigungFixedPriceValue,
            'standartTariff' => $request->reinigungPriceTariff,
            'ma' => $request->reinigungmaValue,
            'chf' => $request->reinigungchfValue,
            'hours' => $request->reinigunghourValue,
            'extraService1' => $request->extraReinigungService1,
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
            'discountPercent' => $request->reinigungDiscountPercent,
            'totalPrice' => $request->reinigungTotalPrice,
        ];

        // Reinigung 2 Dizi
        $reinigungPdf2 = [
            'reinigungType' => $request->reinigungType2,
            'extraReinigung' => $request->extraReinigung2,
            'fixedTariff' => $request->reinigungFixedPrice2,
            'fixedTariffPrice' => $request->reinigungFixedPriceValue2,
            'standartTariff' => $request->reinigungPriceTariff2,
            'ma' => $request->reinigungmaValue2,
            'chf' => $request->reinigungchfValue2,
            'hours' => $request->reinigunghourValue2,
            'extraService1' => $request->extraReinigungService12,
            'startDate' => $request->reinigungdate2,
            'startTime' => $request->reinigungtime2,
            'endDate' => $request->reinigungEnddate2,
            'endTime' => $request->reinigungEndtime2,
            'extra1' => $request->reinigungmasraf12 ? $request->reinigungextra12 : Null,
            'extra2' => $request->reinigungmasraf22 ? $request->reinigungextra22 : Null,
            'extra3' => $request->reinigungmasraf32 ? $request->reinigungextra32 : Null,
            'extraCostText1' => $request->reinigungCostText12,
            'extraCostValue1' => $request->reinigungCost12,
            'extraCostText2' => $request->reinigungCostText22,
            'extraCostValue2' => $request->reinigungCost22,
            'discountText' => $request->reinigungExtraDiscountText2,
            'discount' => $request->reinigungExtraDiscount2,
            'discountPercent' => $request->reinigungDiscountPercent2,
            'totalPrice' => $request->reinigungTotalPrice2,
        ];

        // Entsorgung Dizi
        $entsorgungPdf = [
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
            'arrivalGas' => $request->entsorgungArrivalGas,
            'returnGas' => $request->entsorgungReturnGas,
            'entsorgungExtra1' => $request->entsorgungmasraf ? $request->entsorgungextra1 : Null,
            'extraCostText1' => $request->entsorgungCostText1,
            'extraCostValue1' => $request->entsorgungCost1,
            'extraCostText2' => $request->entsorgungCostText2,
            'extraCostValue2' => $request->entsorgungCost2,
            'discount' => $request->entsorgungDiscount,
            'discountPercent' => $request->entsorgungDiscountPercent,
            'extraDiscountText' => $request->entsorgungExtraDiscountText,
            'extraDiscountPrice' => $request->entsorgungExtraDiscount,
            'defaultPrice' => $request->entsorgungTotalPrice,
            'topCost' => $request->isEntsorgungKostendach ?  $request->entsorgungTopPrice : Null,
            'fixedPrice' => $request->isEntsorgungPauschal ?  $request->entsorgungDefaultPrice : Null,
        ];
        // Transport Dizi
        $transportPdf = [
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
            'arrivalGas' => $request->transportArrivalGas,
            'returnGas' => $request->transportReturnGas,
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
            'discountPercent' => $request->transportDiscountPercent,
            'compromiser' => $request->transportCompromiser,
            'extraDiscountText' => $request->transportExtraDiscountText,
            'extraDiscountValue' => $request->transportExtraDiscount,
            'extraDiscountText2' => $request->transportExtraDiscountText2,
            'extraDiscountValue2' => $request->transportExtraDiscount2,
            'defaultPrice' => $request->transportDefaultPrice,
            'topCost' => $request->isTransportKostendach ?  $request->transportTopPrice : Null,
            'fixedPrice' => $request->isTransportKostendach ?  $request->transportFixedPrice : Null,
        ];

        // Lagerung Dizi
        $lagerungPdf = [
            'tariff' => $request->lagerungTariff,
            'chf' => $request->lagerungChf,
            'volume' => $request->lagerungVolume,
            'extraCostText1' => $request->lagerungCostText1,
            'extraCostValue1' => $request->lagerungCost1,
            'extraCostText2' => $request->lagerungCostText2,
            'extraCostValue2' => $request->lagerungCost2,
            'discountText' => $request->lagerungExtraDiscountText,
            'discountValue' => $request->lagerungExtraDiscount,
            'discountPercent' => $request->lagerungDiscountPercent,
            'totalPrice' => $request->lagerungCost,
            'fixedPrice' => $request->isLagerungFixedPrice ?  $request->lagerungFixedPrice : Null,
        ];
        // Material Dizi
        $materialPdf = [
            'discount' => $request->materialDiscount,
            'deliverPrice' => $request->materialShipPrice,
            'recievePrice' => $request->materialRecievePrice,
            'discountPercent' => $request->materialDiscountPercent,
            'totalPrice' => $request->materialTotalPrice
        ];

        $all = $request->except('_token');
        if (isset($all['islem'])) {
            $islem = $all['islem'];
            unset($all['islem']);

            $baskets = collect();
            foreach ($islem as $v) {
                $basket = [
                    'productId' => $v['urunId'],
                    'buyType' => $v['buyType'],
                    'productPrice' => $v['tutar'],
                    'quantity' => $v['adet'],
                    'totalPrice' => $v['toplam'],
                ];
                $baskets->push($basket);
            }

            $basketPdf = $baskets->toArray();
        } else {
            $basketPdf = [];
        }

        if ($request->customContactPerson) {
            $contactPerson = $request->customContactPerson;
        } else {
            $contactPerson = $request->contactPerson;
        }

        // Offer Dizi
        $offer = [
            'customerId' => $customerId,
            'appType' => $request->appOfferType,
            'offerteNote' => $request->offertePdfNote,
            'panelNote' => $request->offerteNote,
            'kostenInkl' => $request->kdvType,
            'kostenExkl' => $request->kdvType1,
            'kostenFrei' => $request->kdvType3,
            'contactPerson' => $contactPerson,
            'offerteStatus' => 'Beklemede',
            'isCampaign' => $request->isCampaign ? $request->campaignValue : NULL
        ];

        $company = Company::first();
        // PDF Dizi
        $pdfData = [
            'offer' => $offer,
            'company' => $company,
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
            'isAuszug2' => $request->isofferAuszug2,
            'isAuszug3' => $request->isofferAuszug3,
            'isEinzug2' => $request->isofferEinzug2,
            'isEinzug3' => $request->isofferEinzug3,
            'isEinzug1' => $request->einStreet1,
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

        $pdf = Pdf::loadView('offerPdfPreview', $pdfData);
        $pdf->setPaper('A4');
        return $pdf->stream();
    }



    public function offerPdfPreviewEdit(Request $request)
    {
        $id = $request->route('id');
        $offer = offerte::where('id', $id)->first();
        $customerId = $offer['customerId'];
        $customerData = Customer::where('id', $customerId)->first();

        // Auszug Adresses
        $auszug1 = [
            'street' => $request->ausStreet1,
            'postCode' => $request->ausPostcode1,
            'city' => $request->ausCity1,
            'country' => $request->isAusCustomLand1 ? $request->ausCustomLand1 : $request->ausCountry1,
            'buildType' => $request->ausBuildType1,
            'floor' => $request->ausFloorType1,
            'lift' => $request->isAusLift1,
            'parkPlatz' => $request->isAusParkplatz1,
            'addressType' => 0
        ];

        $auszug2 = [
            'street' => $request->ausStreet2,
            'postCode' => $request->ausPostcode2,
            'city' => $request->ausCity2,
            'country' => $request->isAusCustomLand2 ? $request->ausCustomLand2 : $request->ausCountry2,
            'buildType' => $request->ausBuildType2,
            'floor' => $request->ausFloorType2,
            'lift' => $request->isAusLift2,
            'parkPlatz' => $request->isAusParkplatz2,
            'addressType' => 0
        ];

        $auszug3 = [
            'street' => $request->ausStreet3,
            'postCode' => $request->ausPostcode3,
            'city' => $request->ausCity3,
            'country' => $request->isAusCustomLand3 ? $request->ausCustomLand3 : $request->ausCountry3,
            'buildType' => $request->ausBuildType3,
            'floor' => $request->ausFloorType3,
            'lift' => $request->isAusLift3,
            'parkPlatz' => $request->isAusParkplatz3,
            'addressType' => 0
        ];


        // Einzug Adresses
        $einzug1 = [
            'street' => $request->einStreet1,
            'postCode' => $request->einPostcode1,
            'city' => $request->einCity1,
            'country' => $request->isEinCustomLand1 ? $request->einCustomLand1 : $request->einCountry1,
            'buildType' => $request->einBuildType1,
            'floor' => $request->einFloorType1,
            'lift' => $request->isEinLift1,
            'parkPlatz' => $request->isEinParkplatz1,
            'addressType' => 1
        ];

        $einzug2 = [
            'street' => $request->einStreet2,
            'postCode' => $request->einPostcode2,
            'city' => $request->einCity2,
            'country' => $request->isEinCustomLand2 ? $request->einCustomLand2 : $request->einCountry2,
            'buildType' => $request->einBuildType2,
            'floor' => $request->einFloorType2,
            'lift' => $request->isEinLift2,
            'parkPlatz' => $request->isEinParkplatz2,
            'addressType' => 1
        ];

        $einzug3 = [
            'street' => $request->einStreet3,
            'postCode' => $request->einPostcode3,
            'city' => $request->einCity3,
            'country' => $request->isEinCustomLand3 ? $request->einCustomLand3 : $request->einCountry3,
            'buildType' => $request->einBuildType3,
            'floor' => $request->einFloorType3,
            'lift' => $request->isEinLift3,
            'parkPlatz' => $request->isEinParkplatz3,
            'addressType' => 1
        ];


        // Umzug Dizi
        $umzugPdf = [
            'tariff' => $request->umzugTariff,
            'ma' => $request->umzug1ma,
            'lkw' => $request->umzug1lkw,
            'anhanger' => $request->umzug1anhanger,
            'chf' => $request->umzug1chf,
            'moveDate' => $request->umzugausdate,
            'moveTime' => $request->umzug1time,
            'moveDate2' => $request->umzugeindate,
            'arrivalGas' => $request->umzugArrivalGas,
            'returnGas' => $request->umzugReturnGas,
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
            'discountPercent' => $request->umzugDiscountPercent,
            'compromiser' => $request->umzugCompromiser,
            'extraCostName' => $request->umzugExtraDiscountText,
            'extraCostPrice' => $request->umzugExtraDiscount,
            'defaultPrice' => $request->umzugTotalPrice,
            'topCost' => $request->isKostendach ?  $request->umzugTopPrice : Null,
            'fixedPrice' => $request->isPauschal ?  $request->umzugDefaultPrice : Null,
        ];

        // Einpack Dizi
        $einpackPdf = [
            'tariff' => $request->einpackTariff,
            'ma' => $request->einpack1ma,
            'chf' => $request->einpack1chf,
            'einpackDate' => $request->einpackdate,
            'einpackTime' => $request->einpacktime,
            'arrivalGas' => $request->einpackArrivalGas,
            'returnGas' => $request->einpackReturnGas,
            'moveHours' => $request->einpackHours,
            'extra' => $request->einpackmasraf ? $request->einpackextra1 : Null,
            'extra1' => $request->einpackmasraf1 ? $request->einpackextra2 : Null,
            'customCostName1' => $request->einpackCostText1,
            'customCostPrice1' => $request->einpackCost1,
            'customCostName2' => $request->einpackCostText2,
            'customCostPrice2' => $request->einpackCost2,
            'costPrice' => $request->einpackCost,
            'discount' => $request->einpackDiscount,
            'discountPercent' => $request->einpackDiscountPercent,
            'compromiser' => $request->einpackCompromiser,
            'extraCostName' => $request->einpackExtraDiscountText,
            'extraCostPrice' => $request->einpackExtraDiscount,
            'defaultPrice' => $request->einpackTotalPrice,
            'topCost' => $request->isEinpackKostendach ?  $request->einpackTopPrice : Null,
            'fixedPrice' => $request->isEinpackPauschal ?  $request->einpackDefaultPrice : Null,
        ];

        // Auspack Dizi
        $auspackPdf = [
            'tariff' => $request->auspackTariff,
            'ma' => $request->auspack1ma,
            'chf' => $request->auspack1chf,
            'auspackDate' => $request->auspackdate,
            'auspackTime' => $request->auspacktime,
            'arrivalGas' => $request->auspackArrivalGas,
            'returnGas' => $request->auspackReturnGas,
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
            'topCost' => $request->isAuspackKostendach ?  $request->auspackTopPrice : Null,
            'fixedPrice' => $request->isAuspackPauschal ?  $request->auspackDefaultPrice : Null,
        ];

        // Reinigung Dizi
        $reinigungPdf = [
            'reinigungType' => $request->reinigungType,
            'extraReinigung' => $request->extraReinigung,
            'fixedTariff' => $request->reinigungFixedPrice,
            'fixedTariffPrice' => $request->reinigungFixedPriceValue,
            'standartTariff' => $request->reinigungPriceTariff,
            'ma' => $request->reinigungmaValue,
            'chf' => $request->reinigungchfValue,
            'hours' => $request->reinigunghourValue,
            'extraService1' => $request->extraReinigungService1,
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
            'discountPercent' => $request->reinigungDiscountPercent,
            'totalPrice' => $request->reinigungTotalPrice,
        ];

        // Reinigung 2 Dizi
        $reinigungPdf2 = [
            'reinigungType' => $request->reinigungType2,
            'extraReinigung' => $request->extraReinigung2,
            'fixedTariff' => $request->reinigungFixedPrice2,
            'fixedTariffPrice' => $request->reinigungFixedPriceValue2,
            'standartTariff' => $request->reinigungPriceTariff2,
            'ma' => $request->reinigungmaValue2,
            'chf' => $request->reinigungchfValue2,
            'hours' => $request->reinigunghourValue2,
            'extraService1' => $request->extraReinigungService12,
            'startDate' => $request->reinigungdate2,
            'startTime' => $request->reinigungtime2,
            'endDate' => $request->reinigungEnddate2,
            'endTime' => $request->reinigungEndtime2,
            'extra1' => $request->reinigungmasraf12 ? $request->reinigungextra12 : Null,
            'extra2' => $request->reinigungmasraf22 ? $request->reinigungextra22 : Null,
            'extra3' => $request->reinigungmasraf32 ? $request->reinigungextra32 : Null,
            'extraCostText1' => $request->reinigungCostText12,
            'extraCostValue1' => $request->reinigungCost12,
            'extraCostText2' => $request->reinigungCostText22,
            'extraCostValue2' => $request->reinigungCost22,
            'discountText' => $request->reinigungExtraDiscountText2,
            'discount' => $request->reinigungExtraDiscount2,
            'discountPercent' => $request->reinigungDiscountPercent2,
            'totalPrice' => $request->reinigungTotalPrice2,
        ];

        // Entsorgung Dizi
        $entsorgungPdf = [
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
            'arrivalGas' => $request->entsorgungArrivalGas,
            'returnGas' => $request->entsorgungReturnGas,
            'entsorgungExtra1' => $request->entsorgungmasraf ? $request->entsorgungextra1 : Null,
            'extraCostText1' => $request->entsorgungCostText1,
            'extraCostValue1' => $request->entsorgungCost1,
            'extraCostText2' => $request->entsorgungCostText2,
            'extraCostValue2' => $request->entsorgungCost2,
            'discount' => $request->entsorgungDiscount,
            'discountPercent' => $request->entsorgungDiscountPercent,
            'extraDiscountText' => $request->entsorgungExtraDiscountText,
            'extraDiscountPrice' => $request->entsorgungExtraDiscount,
            'defaultPrice' => $request->entsorgungTotalPrice,
            'topCost' => $request->isEntsorgungKostendach ?  $request->entsorgungTopPrice : Null,
            'fixedPrice' => $request->isEntsorgungPauschal ?  $request->entsorgungDefaultPrice : Null,
        ];
        // Transport Dizi
        $transportPdf = [
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
            'arrivalGas' => $request->transportArrivalGas,
            'returnGas' => $request->transportReturnGas,
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
            'discountPercent' => $request->transportDiscountPercent,
            'compromiser' => $request->transportCompromiser,
            'extraDiscountText' => $request->transportExtraDiscountText,
            'extraDiscountValue' => $request->transportExtraDiscount,
            'extraDiscountText2' => $request->transportExtraDiscountText2,
            'extraDiscountValue2' => $request->transportExtraDiscount2,
            'defaultPrice' => $request->transportDefaultPrice,
            'topCost' => $request->isTransportKostendach ?  $request->transportTopPrice : Null,
            'fixedPrice' => $request->isTransportKostendach ?  $request->transportFixedPrice : Null,
        ];

        // Lagerung Dizi
        $lagerungPdf = [
            'tariff' => $request->lagerungTariff,
            'chf' => $request->lagerungChf,
            'volume' => $request->lagerungVolume,
            'extraCostText1' => $request->lagerungCostText1,
            'extraCostValue1' => $request->lagerungCost1,
            'extraCostText2' => $request->lagerungCostText2,
            'extraCostValue2' => $request->lagerungCost2,
            'discountText' => $request->lagerungExtraDiscountText,
            'discountValue' => $request->lagerungExtraDiscount,
            'discountPercent' => $request->lagerungDiscountPercent,
            'totalPrice' => $request->lagerungCost,
            'fixedPrice' => $request->isLagerungFixedPrice ?  $request->lagerungFixedPrice : Null,
        ];
        // Material Dizi
        $materialPdf = [
            'discount' => $request->materialDiscount,
            'deliverPrice' => $request->materialShipPrice,
            'recievePrice' => $request->materialRecievePrice,
            'discountPercent' => $request->materialDiscountPercent,
            'totalPrice' => $request->materialTotalPrice
        ];

        $all = $request->except('_token');
        if (isset($all['islem'])) {
            $islem = $all['islem'];
            unset($all['islem']);

            $baskets = collect();
            foreach ($islem as $v) {
                $basket = [
                    'productId' => $v['urunId'],
                    'buyType' => $v['buyType'],
                    'productPrice' => $v['tutar'],
                    'quantity' => $v['adet'],
                    'totalPrice' => $v['toplam'],
                ];
                $baskets->push($basket);
            }

            $basketPdf = $baskets->toArray();
        } else {
            $basketPdf = [];
        }

        if ($request->customContactPerson) {
            $contactPerson = $request->customContactPerson;
        } else {
            $contactPerson = $request->contactPerson;
        }

        // Offer Dizi
        $offer = [
            'customerId' => $customerId,
            'appType' => $request->appOfferType,
            'offerteNote' => $request->offertePdfNote,
            'panelNote' => $request->offerteNote,
            'kostenInkl' => $request->kdvType,
            'kostenExkl' => $request->kdvType1,
            'kostenFrei' => $request->kdvType3,
            'contactPerson' => $contactPerson,
            'offerteStatus' => 'Beklemede',
            'isCampaign' => $request->isCampaign ? $request->campaignValue : NULL
        ];

        $company = Company::first();

        // PDF Dizi
        $pdfData = [
            'offer' => $offer,
            'company' => $company,
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
            'isAuszug2' => $request->isofferAuszug2,
            'isAuszug3' => $request->isofferAuszug3,
            'isEinzug2' => $request->isofferEinzug2,
            'isEinzug3' => $request->isofferEinzug3,
            'isEinzug1' => $request->einStreet1,
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

        $pdf = Pdf::loadView('offerPdfPreview', $pdfData);
        $pdf->setPaper('A4');
        return $pdf->stream();
    }
}
