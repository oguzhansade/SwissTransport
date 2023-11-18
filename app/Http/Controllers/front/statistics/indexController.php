<?php

namespace App\Http\Controllers\front\statistics;

use App\Http\Controllers\Controller;
use App\Models\AppointmentMaterial;
use App\Models\Customer;
use App\Models\offerte;
use App\Models\OfferteAuspack;
use App\Models\OfferteEinpack;
use App\Models\OfferteEntsorgung;
use App\Models\OfferteLagerung;
use App\Models\OfferteMaterial;
use App\Models\OfferteReinigung;
use App\Models\OfferteTransport;
use App\Models\OfferteUmzug;
use App\Models\ReceiptUmzug;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class indexController extends Controller
{
    public function index()
    {
        return view ('front.statistics.index');

    }
    public function offer()
    {
        return view ('front.statistics.offer');
    }
    public function receipt()
    {
        return view ('front.statistics.receipt');
    }
    public function termine()
    {
        return view ('front.statistics.termine');
    }
    public function offerData(Request $request)
    {
      
        // Datatabledaki Esimated Income Fonksiyonu
        function getPriceFromParts($price) {
            $priceParts = explode('-', $price);
            $defaultPrice = (count($priceParts) === 2) ? (float) trim($priceParts[1]) : (float) trim($price);
            return $defaultPrice;
        };

        $table=offerte::query();
        $totalPrice = 0; // Initialize the total price variable,
        $col1Sum = 0; // İlk sütunun toplamını temsil eden değişken

        // Customer Search Filter
        if (!empty($request->searchInput)) {
            $searchValue = $request->searchInput;
            $customerIds = Customer::where('name', 'like', "%$searchValue%")
                ->orWhere('surname', 'like', "%$searchValue%")
                ->pluck('id')
                ->toArray();
        
            $table->whereIn('customerId', $customerIds);
        }

        // Contact Person Filter
        if($request->contactPersonInput)
        {
            $table->where('contactPerson', 'like', "%$request->contactPersonInput%");
        }

        // Umzugdate Filter (Transport ve Entsorgung da eklenebilir koraya sor)
        if($request->umzugmin_date) {
            $minDate = $request->umzugmin_date;
            if($table->whereNotNull('offerteUmzugId'))
            {
                $offerteUmzugIds = OfferteUmzug::whereDate('moveDate', '>=', $minDate)->pluck('id');

                $table->whereIn('offerteUmzugId',$offerteUmzugIds);
            }
        }

        if($request->umzugmax_date) {
            $maxDate = $request->umzugmax_date;
            if($table->whereNotNull('offerteUmzugId'))
            {
                $offerteUmzugIds = OfferteUmzug::whereDate('moveDate', '<=', $maxDate)->pluck('id');

                $table->whereIn('offerteUmzugId',$offerteUmzugIds);
            }
        }

        // Minimum date filter
        if($request->min_date) {
            $table->whereDate('created_at', '>=', $request->min_date);
        }
        
        // Maximum date filter
        if($request->max_date) {
            $table->whereDate('created_at', '<=', $request->max_date);
        }

        // Service type filter
        if ($request->typeFilter) {
            $typeFilter = $request->typeFilter;
        
            if (is_array($typeFilter)) {
                if (in_array("Umzug", $typeFilter)) {
                    $table->whereNotNull('offerteUmzugId');
                } elseif (in_array("Einpack", $typeFilter)) {
                    $table->whereNotNull('offerteEinpackId');
                } elseif (in_array("Auspack", $typeFilter)) {
                    $table->whereNotNull('offerteAuspackId');
                } elseif (in_array("Entsorgung", $typeFilter)) {
                    $table->whereNotNull('offerteEntsorgungId');
                } elseif (in_array("Reinigung", $typeFilter)) {
                    $table->whereNotNull('offerteReinigungId');
                } elseif (in_array("Transport", $typeFilter)) {
                    $table->whereNotNull('offerteTransportId');
                } elseif (in_array("Lagerung", $typeFilter)) {
                    $table->whereNotNull('offerteLagerungId');
                } elseif (in_array("Verpackungsmaterial", $typeFilter)) {
                    $table->whereNotNull('offerteMaterialId');
                }
            } else {
                $table->where('zimmer', $typeFilter);
            }
        }

        // Umzug zimmer filter
        if ($request->zimmerFilter) {
            $zimmerFilter = $request->zimmerFilter;
        
            if (is_array($zimmerFilter)) {
                if (in_array("1-1.5 Zimmer", $zimmerFilter) &&  $table->whereNotNull('offerteUmzugId')) {
                    // Önce OfferteUmzug modelinden "tariff" değeri 4 olan verilerin "id" değerlerini çek
                    $offerteUmzugIds = OfferteUmzug::where('tariff', 4)->pluck('id');
                        
                    // Ardından Offerte modelini filtrele ve uygun "offerteUmzugId" ile eşleşenleri seç
                    $table->whereIn('offerteUmzugId', $offerteUmzugIds);
                } elseif (in_array("2-2.5 Zimmer", $zimmerFilter) &&  $table->whereNotNull('offerteUmzugId')) {
                    // Önce OfferteUmzug modelinden "tariff" değeri 4 olan verilerin "id" değerlerini çek
                    $offerteUmzugIds = OfferteUmzug::where('tariff', 7)->pluck('id');
                                        
                    // Ardından Offerte modelini filtrele ve uygun "offerteUmzugId" ile eşleşenleri seç
                    $table->whereIn('offerteUmzugId', $offerteUmzugIds);
                } 
                elseif (in_array("3-3.5 Zimmer", $zimmerFilter) &&  $table->whereNotNull('offerteUmzugId')) {
                    // Önce OfferteUmzug modelinden "tariff" değeri 4 olan verilerin "id" değerlerini çek
                    $offerteUmzugIds = OfferteUmzug::where('tariff', 7)->pluck('id');
                                        
                    // Ardından Offerte modelini filtrele ve uygun "offerteUmzugId" ile eşleşenleri seç
                    $table->whereIn('offerteUmzugId', $offerteUmzugIds);
                } 
                elseif (in_array("4-4.5 Zimmer", $zimmerFilter) &&  $table->whereNotNull('offerteUmzugId')) {
                    // Önce OfferteUmzug modelinden "tariff" değeri 4 olan verilerin "id" değerlerini çek
                    $offerteUmzugIds = OfferteUmzug::where('tariff', 13)->pluck('id');
                                        
                    // Ardından Offerte modelini filtrele ve uygun "offerteUmzugId" ile eşleşenleri seç
                    $table->whereIn('offerteUmzugId', $offerteUmzugIds);
                }
                elseif (in_array("5-5.5 Zimmer", $zimmerFilter) &&  $table->whereNotNull('offerteUmzugId')) {
                    // Önce OfferteUmzug modelinden "tariff" değeri 4 olan verilerin "id" değerlerini çek
                    $offerteUmzugIds = OfferteUmzug::where('tariff', 19)->pluck('id');
                                        
                    // Ardından Offerte modelini filtrele ve uygun "offerteUmzugId" ile eşleşenleri seç
                    $table->whereIn('offerteUmzugId', $offerteUmzugIds);
                }
                elseif (in_array("6-6.5 Zimmer", $zimmerFilter) &&  $table->whereNotNull('offerteUmzugId')) {
                    // Önce OfferteUmzug modelinden "tariff" değeri 4 olan verilerin "id" değerlerini çek
                    $offerteUmzugIds = OfferteUmzug::where('tariff', 22)->pluck('id');
                                        
                    // Ardından Offerte modelini filtrele ve uygun "offerteUmzugId" ile eşleşenleri seç
                    $table->whereIn('offerteUmzugId', $offerteUmzugIds);
                }
            }
        }

        // StandType Filter
        if($request->standType) {
            if ($request->standType == 'Onaylandı') {
                $table->where('offerteStatus', 'Onaylandı');
            }
            else if ($request->standType == 'Onaylanmadı') {
                $table->where('offerteStatus', 'Onaylanmadı');
            }
            else if ($request->standType == 'Beklemede') {
                $table->where('offerteStatus', 'Beklemede');
            }
            else if ($request->standType == 'Alle') {
                
            }
        }

        // Besichtigung Filter
        if($request->appType){
            if ($request->appType == 'Nein') {
                $table->whereIn('appType', [0, 2]);
            }
            else if ($request->appType == 'Gemacht') {
                $table->where('appType', 1);
            }
            else if ($request->appType == 'Alle')
            {

            }
        }
       
        $data=DataTables::of($table)
        
        // Servisler
        ->addColumn('services', function ($data) {
                
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
        ->editColumn('customerId', function ($data) {
            if($data->customerId)
            {
                $customerName = Customer::where('id',$data->customerId)->value('name');
                $customerSurname = Customer::where('id',$data->customerId)->value('surname');
                $customerFullName = $customerName.' '.$customerSurname;
                return $customerFullName;
            }
        })
        ->addColumn('offerPrices', function ($data) use (&$totalPrice, &$col1Sum) {
            // Burası Önemli Sakın Silme
            $offerPrice = 0;
            
            // Get the default prices for all of the services.
            $defaultPrices = [
                'offerteUmzug' => OfferteUmzug::where('id', $data['offerteUmzugId'])->value('defaultPrice'),
                'offerteEinpack' => OfferteEinpack::where('id', $data['offerteEinpackId'])->value('defaultPrice'),
                'offerteAuspack' =>  OfferteAuspack::where('id', $data['offerteAuspackId'])->value('defaultPrice'),
                'offerteReinigung' =>  OfferteReinigung::where('id', $data['offerteReinigungId'])->value('totalPrice'),
                'offerteReinigung2' =>  OfferteReinigung::where('id', $data['offerteReinigung2Id'])->value('totalPrice'),
                'offerteEntsorgung' => OfferteEntsorgung::where('id', $data['offerteEntsorgungId'])->value('defaultPrice'),
                'offerteTransport' => OfferteTransport::where('id', $data['offerteTransportId'])->value('defaultPrice'),
                'offerteLagerung' =>  OfferteLagerung::where('id', $data['offerteLagerungId'])->value('totalPrice'),
                'offerteMaterial' =>  OfferteMaterial::where('id', $data['offerteMaterialId'])->value('totalPrice'),
            ];

            $col1Value = $data[0];
            $col1Sum += $col1Value;

            // Calculate the total price for each service.
            foreach ($defaultPrices as $service => $defaultPrice) {
                if ($defaultPrice) {
                $offerPrice += getPriceFromParts($defaultPrice);
                }
            }
            offerte::where('id',$data->id)->update(['offerPrice' => $offerPrice]);

            // Güncel offerPrice'ı totalPrice'a ekleyin
            $totalPrice += $offerPrice;
            return $offerPrice;
        })
        ->addColumn ('totalPrice', function ($data) use (&$totalPrice, &$totalOfferte) {
            $totalPrice = $data->sum('offerPrice');
            $totalOfferte = $data->count();
            return $totalPrice;
        })
        
        ->editColumn('created_at', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y'); return $formatedDate; })
        ->addColumn('option',function($data) 

        
        {
            return '
            <a class="btn btn-sm  btn-primary" href="'.route('offer.detail',['id'=>$data->id]).'"><i class="feather feather-eye" ></i> Offerte</a> <span class="text-primary"></span>
            <a class="btn btn-sm  btn-edit" href="'.route('customer.detail',['id'=>$data->customerId]).'"><i class="feather feather-edit" ></i> Kunde</a> <span class="text-primary"></span>
            <a class="btn btn-sm btn-info notizButton" href="#" data-toggle="modal" data-target="#notizModal" data-customer="'.$data->customerId.'" data-id="'.$data->id.'" ><i class="feather feather-edit-2"></i> Notiz</a>';
        })
        ->rawColumns(['gratTotalPrice','totalPrice','services','option'])
        ->make(true);

        $renderedData = (array)$data->original;
        $renderedData['filteredTotal'] = $table->sum('offerPrice');
        $renderedData['nonFilteredTotal'] = $totalPrice;
        $renderedData['totalOfferte'] = $totalOfferte;
        $renderedData['filteredBestatig'] = $table->where('offerteStatus', 'Onaylandı')->count();
        return response()->json($renderedData);
        
        // $renderedData = $data;
        // dd($renderedData);
        // return json_decode($renderedData->original, true);
            

    }

    public function termineData(Request $request)
    {
        $table = DB::table('appointments');
        $table2 = DB::table('appointment_materials');
        $table3 = DB::table('appoinment_services');

        $array = [];
        $i = 0;

        
        // Minimum date filter
        if ($request->min_date) {
            $table->whereDate('created_at', '>=', $request->min_date);
            $table2->whereDate('created_at', '>=', $request->min_date);
            $table3->whereDate('created_at', '>=', $request->min_date);
        }

        // Maximum date filter
        if ($request->max_date) {
            $table->whereDate('created_at', '<=', $request->max_date);
            $table2->whereDate('created_at', '<=', $request->max_date);
            $table3->whereDate('created_at', '<=', $request->max_date);
        }

        $tableData = $table->get()->toArray();
        $table2Data = $table2->get()->toArray();
        $table3Data = $table3->get()->toArray();

        if($request->appType)
        {
            if($request->appType == '1')
            {
                foreach ($tableData as $k => $v) {
                    $customer = Customer::where('id',$v->customerId)->first();
                    $array[$i]["aid"] = $i + 1;
                    $array[$i]["id"] = $v->id;
                    $array[$i]["appType"] ='Besichtigung';
                    $array[$i]["adres"] = $v->address;
                    $array[$i]["customerId"] = $v->customerId;
                    $array[$i]["tarih"] = date('d-m-Y H:i:s', strtotime($v->created_at));
                    $i++;
                }
            }
            elseif($request->appType == '2')
            {
                foreach ($table2Data as $k => $v) {
                    $customer = Customer::where('id',$v->customerId)->first();
                    $app = AppointmentMaterial::where('id',$v->id)->first();
                    $appStatus = $app['expired'];
                    $array[$i]["aid"] = $i + 1;
                    $array[$i]["id"] = $v->id;
                    $array[$i]["appType"] = 'Lieferung';
                    $array[$i]["adres"] = $v->address;
                    $array[$i]["customerId"] = $v->customerId;
                    $array[$i]["tarih"] = date('d-m-Y H:i:s', strtotime($v->created_at));
                    $i++;
                }
            }
            elseif($request->appType == '3'){
                foreach ($table3Data as $k => $v) {
                    $customer = Customer::where('id',$v->customerId)->first('name');
                    $array[$i]["aid"] = $i + 1;
                    $array[$i]["id"] = $v->id;
                    $array[$i]["appType"] ='Auftragsbestätigung';
                    $array[$i]["adres"] = $v->address;
                    $array[$i]["customerId"] = $v->customerId;
                    $array[$i]["tarih"] = date('d-m-Y H:i:s', strtotime($v->created_at));
                    $i++;
                }
            }
            else{
            
            foreach ($tableData as $k => $v) {
                $customer = Customer::where('id',$v->customerId)->first();
                $array[$i]["aid"] = $i + 1;
                $array[$i]["id"] = $v->id;
                $array[$i]["appType"] ='Besichtigung';
                $array[$i]["adres"] = $v->address;
                $array[$i]["customerId"] = $v->customerId;
                $array[$i]["tarih"] = date('d-m-Y H:i:s', strtotime($v->created_at));
                $i++;
            }
       

        
            foreach ($table2Data as $k => $v) {
                $customer = Customer::where('id',$v->customerId)->first();
                $app = AppointmentMaterial::where('id',$v->id)->first();
                $appStatus = $app['expired'];
                $array[$i]["aid"] = $i + 1;
                $array[$i]["id"] = $v->id;
                $array[$i]["appType"] = 'Lieferung';
                $array[$i]["adres"] = $v->address;
                $array[$i]["customerId"] = $v->customerId;
                $array[$i]["tarih"] = date('d-m-Y H:i:s', strtotime($v->created_at));
                $i++;
            }
        

        
            foreach ($table3Data as $k => $v) {
                $customer = Customer::where('id',$v->customerId)->first('name');
                $array[$i]["aid"] = $i + 1;
                $array[$i]["id"] = $v->id;
                $array[$i]["appType"] ='Auftragsbestätigung';
                $array[$i]["adres"] = $v->address;
                $array[$i]["customerId"] = $v->customerId;
                $array[$i]["tarih"] = date('d-m-Y H:i:s', strtotime($v->created_at));
                $i++;
            }
        
            }
        }
        
        
        $data=DataTables::of($array)

        ->editColumn('customerId', function ($array) {
            if($array['customerId'])
            {
                $customerName = Customer::where('id',$array['customerId'])->value('name');
                $customerSurname = Customer::where('id',$array['customerId'])->value('surname');
                $customerFullName = $customerName.' '.$customerSurname;
                return $customerFullName;
            }
        })
        ->editColumn('appType', function ($array) {
            if($array['appType'] == 'Lieferung')
            {
                $app = AppointmentMaterial::where('id',$array['id'])->first();
                $appStatus = $app['expired'];
                if($appStatus == 1) {
                    return '<span id="termineBadge" class="badge badge-warning">Lieferung</span>
                    <div class="info-tooltip" id="infoTooltip">Kein Abholung</div>';
                }
                else {
                    return '<span class="btn btn-sm btn-success">Lieferung</span>';
                }
               
            }
            if($array['appType'] == 'Besichtigung') {
                return 'Besichtigung';
            }
            if($array['appType'] == 'Auftragsbestätigung') {
                return 'Auftragsbestätigung';
            }
        })
        ->addColumn('option', function ($array) {
            switch ($array['appType']) {
                case ('Besichtigung');
                    return '
                <a class="btn btn-sm  btn-primary" href="' . route('appointment.detail', ['id' => $array['id']]) . '"><i class="feather feather-eye" ></i>Termine</a> <span class="text-primary">|</span>
                <a class="btn btn-sm  btn-edit" href="' . route('customer.detail', ['id' => $array['customerId']]) . '"><i class="feather feather-edit" ></i>Kunde</a>';
                    break;
                case ('Auftragsbestätigung');
                    return '
                <a class="btn btn-sm  btn-primary" href="' . route('appointmentService.detail', ['id' => $array['id']]) . '"><i class="feather feather-eye" ></i>Termine</a> <span class="text-primary">|</span>
                <a class="btn btn-sm  btn-edit" href="' . route('customer.detail', ['id' => $array['customerId']]) . '"><i class="feather feather-edit" ></i>Kunde</a>';
                    break;
                case ('Lieferung');
                    return '
                <a class="btn btn-sm  btn-primary" href="' . route('appointmentMaterial.detail', ['id' => $array['id']]) . '"><i class="feather feather-eye" ></i>Termine</a> <span class="text-primary">|</span>
                <a class="btn btn-sm  btn-edit" href="' . route('customer.detail', ['id' => $array['customerId']]) . '"><i class="feather feather-edit" ></i> Kunde</a>';
                    break;
            }
        })
        ->rawColumns(['option','appType'])
        ->make(true);

        $renderedData = (array)$data->original;
        return response()->json($renderedData);
    }

    public function receiptData(Request $request)
    {
        $receiptType = $request->get('receiptType');

        $array = [];
        $i = 0;
        $totalPrice = 0; // Initialize the total price variable,
        $customerId = $request->route('id');

        $table = DB::table('receipt_umzugs');
        $table2 = DB::table('receipt_reinigungs');

        $totalRecords = $table->count() + $table2->count();
        // Minimum date filter
        if ($request->min_date) {
            $table->whereDate('created_at', '>=', $request->min_date);
            $table2->whereDate('created_at', '>=', $request->min_date);
        }

        // Maximum date filter
        if ($request->max_date) {
            $table->whereDate('created_at', '<=', $request->max_date);
            $table2->whereDate('created_at', '<=', $request->max_date);
        }

        $tableData = $table->get()->toArray();
        $table2Data = $table2->get()->toArray();
       
        
        $MobeTotal = 0;
        $LiefTotal = 0;
        $SchuTotal = 0;
        $SchaTotal = 0;
        $BussTotal = 0;
        $EntgTotal = 0;
        $ArbeTotal = 0;
        $DiesTotal = 0;
        $OtheTotal = 0;

        $expenseTypes = [
            'Umzug' => $tableData,
            'Reinigung' => $table2Data,
        ];
        
        

        foreach ($expenseTypes as $exType => $data) {
            foreach ($data as $record) {
                $expenses = DB::table('expenses')
                    ->where('quittungId', $record->id)
                    ->where('exType', $exType)
                    ->get();
        
                foreach ($expenses as $expense) {
                    if ($expense->expenseName === 'Möbellift Miete') {
                        $MobeTotal += $expense->expenseValue;
                    } elseif ($expense->expenseName === 'Lieferwagen Miete') {
                        $LiefTotal += $expense->expenseValue;
                    } elseif ($expense->expenseName === 'Schutzmaterial') {
                        $SchuTotal += $expense->expenseValue;
                    }elseif ($expense->expenseName === 'Schaden') {
                        $SchaTotal += $expense->expenseValue;
                    }elseif ($expense->expenseName === 'Busse') {
                        $BussTotal += $expense->expenseValue;
                    }elseif ($expense->expenseName === 'Entgegenkommen') {
                        $EntgTotal += $expense->expenseValue;
                    }elseif ($expense->expenseName === 'Arbeiter') {
                        $ArbeTotal += $expense->expenseValue;
                    }elseif ($expense->expenseName === 'Diesel') {
                        $DiesTotal += $expense->expenseValue;
                    }elseif ($expense->expenseName === 'Other') {
                        $OtheTotal += $expense->expenseValue;
                    }
                    
                }
            }
        }
        
       
        if ($tableData) {
            foreach ($tableData as $k => $v) {
                $array[$i]["aid"] = $i + 1;
                $array[$i]["id"] = $v->id;
                $array[$i]["makbuzNo"] = $v->offerId . '.' . $v->id;
                $array[$i]["receiptType"] = 'Umzug';
                $array[$i]["offerId"] = $v->offerId;
                $array[$i]["customer"] = Customer::where('id',$v->customerId)->value('name');
                $array[$i]["customerId"] = $v->customerId;
                $array[$i]["created_at"] = date('d-m-Y', strtotime($v->created_at));
                $array[$i]["tutar"] = $v->totalPrice;
                $array[$i]["expensePrice"] =  $v->expensePrice ? $v->expensePrice : 0;
                $array[$i]["profit"] = $v->totalPrice - $v->expensePrice;
                $array[$i]["payType"] = $v->payType;
                $array[$i]["status"] = $v->status;
                $i++;
            }
        }

        if ($table2Data) {
            foreach ($table2Data as $k => $v) {
                $array[$i]["aid"] = $i + 1;
                $array[$i]["id"] = $v->id;
                $array[$i]["makbuzNo"] = $v->offerId . '.' . $v->id;
                $array[$i]["receiptType"] = 'Reinigung';
                $array[$i]["offerId"] = $v->offerId;
                $array[$i]["customer"] = Customer::where('id',$v->customerId)->value('name');
                $array[$i]["customerId"] = $v->customerId;
                $array[$i]["expensePrice"] = $v->expensePrice ? $v->expensePrice : 0;
                $array[$i]["created_at"] = date('d-m-Y', strtotime($v->created_at));
                $array[$i]["tutar"] = $v->totalPrice;
                $array[$i]["profit"] = $v->totalPrice - $v->expensePrice;
                $array[$i]["payType"] = $v->payType;
                $array[$i]["status"] = $v->status;
                $i++;
            }
        }
       
        
       
        $data = DataTables::of($array)
       
            ->addColumn('option', function ($array) {
                switch ($array['receiptType']) {
                    case ('Umzug');
                        return '
                            <a class="btn btn-sm  btn-primary" href="' . route('receipt.detail', ['id' => $array['id']]) . '"><i class="feather feather-eye" ></i> Quittung</a> 
                            <a class="btn btn-sm  btn-edit" href="'.route('customer.detail',['id'=>$array['customerId']]).'"><i class="feather feather-edit" ></i> Kunde</a> ';
                        break;
                    case ('Reinigung');
                        return '
                            <a class="btn btn-sm  btn-primary" href="' . route('receiptReinigung.detail', ['id' => $array['id']]) . '"><i class="feather feather-eye" ></i> Quittung</a> 
                            <a class="btn btn-sm  btn-edit" href="'.route('customer.detail',['id'=>$array['customerId']]).'"><i class="feather feather-edit" ></i> Kunde</a> ';
                        break;
                }
            })
            
            ->rawColumns(['option'])
            ->make(true);


            $renderedData = (array)$data->original;
            $renderedData['total'] = $table->sum('totalPrice') + $table2->sum('totalPrice');
            $renderedData['expense'] = $table->sum('expensePrice') + $table2->sum('expensePrice');
            $renderedData['totalQuittung'] = $totalRecords;
            $renderedData['MobeTotal'] = $MobeTotal;
            $renderedData['LiefTotal'] = $LiefTotal;
            $renderedData['SchuTotal'] = $SchuTotal;
            $renderedData['SchaTotal'] = $SchaTotal;
            $renderedData['BussTotal'] = $BussTotal;
            $renderedData['EntgTotal'] = $EntgTotal;
            $renderedData['ArbeTotal'] = $ArbeTotal;
            $renderedData['DiesTotal'] = $DiesTotal;
            $renderedData['OtheTotal'] = $OtheTotal;
            return response()->json($renderedData);
    }
}
