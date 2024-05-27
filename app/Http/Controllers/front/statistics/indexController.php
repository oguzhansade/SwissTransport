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
       // AppointmentMaterial Modelinden tüm verileri çek
       $appMaterials = AppointmentMaterial::all();

       // Şu anki tarih
       $currentDate = now();


       // Her bir AppointmentMaterial öğesini kontrol et
       foreach ($appMaterials as $appMaterial) {
           // AppointmentMaterial'in tarihine 4 hafta ekleyerek son tarihi bul
           $expirationDate = Carbon::createFromFormat('Y-m-d', $appMaterial->meetingDate)->addWeeks(4);

           // Eğer şu anki tarih, expirationDate'den büyükse
           if ($appMaterial->deliveryType == 0 && $currentDate > $expirationDate && $appMaterial->abholungId == NULL ) {
               // expired değerini 1 olarak güncelle
               $appMaterial->update(['expired' => 1]);
           }
           else {
            $appMaterial->update(['expired' => 0]);
           }
       }

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
        $dateBasedFilter = 0;
        $filteredStandCount = 0;
        $filteredCount = 0;
        $filteredServiceCount = 0;
        $filteredZimmerCount = 0;
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

        if($request->umzugmin_date) {
            $minDate = $request->umzugmin_date;
            if($table->whereNotNull('offerteUmzugId'))
            {
                $offerteUmzugIds = OfferteUmzug::whereDate('moveDate', '>=', $minDate)->pluck('id');
                $offerteUmzugs = $table->whereIn('offerteUmzugId',$offerteUmzugIds);
                $dateBasedFilter = $offerteUmzugs->count();

            }
        }

        if($request->umzugmax_date) {
            $maxDate = $request->umzugmax_date;
            if($table->whereNotNull('offerteUmzugId'))
            {
                $offerteUmzugIds = OfferteUmzug::whereDate('moveDate', '<=', $maxDate)->pluck('id');
                $offerteUmzugs = $table->whereIn('offerteUmzugId',$offerteUmzugIds);
                $dateBasedFilter = $offerteUmzugs->count();
            }
        }

        // Minimum date filter
        if($request->min_date) {
            $dateFilteredOfferte = $table->whereDate('created_at', '>=', $request->min_date);
            $dateBasedFilter = $dateFilteredOfferte->count();
        }

        // Maximum date filter
        if($request->max_date) {
            $dateFilteredOfferte = $table->whereDate('created_at', '<=', $request->max_date);
            $dateBasedFilter = $dateFilteredOfferte->count();
        }



        // Umzug zimmer filter
        if ($request->zimmerFilter) {
            $zimmerFilter = $request->zimmerFilter;

            if (is_array($zimmerFilter)) {
                $ZimmerCounter = $table->where(function($query) use ($zimmerFilter) {
                    foreach ($zimmerFilter as $filter) {
                        if ($filter == "1-1.5 Zimmer") {
                            // Önce OfferteUmzug modelinden "tariff" değeri 4 olan verilerin "id" değerlerini çek
                            $offerteUmzugIds = OfferteUmzug::where('tariff', 4)->pluck('id');
                            // Ardından Offerte modelini filtrele ve uygun "offerteUmzugId" ile eşleşenleri seç
                            $query->orWhereIn('offerteUmzugId', $offerteUmzugIds);
                        } elseif ($filter == "2-2.5 Zimmer") {
                            $offerteUmzugIds = OfferteUmzug::where('tariff', 7)->pluck('id');
                            $query->orWhereIn('offerteUmzugId', $offerteUmzugIds);
                        } elseif ($filter == "3-3.5 Zimmer") {
                            $offerteUmzugIds = OfferteUmzug::where('tariff', 7)->pluck('id');
                            $query->orWhereIn('offerteUmzugId', $offerteUmzugIds);
                        } elseif ($filter == "4-4.5 Zimmer") {
                            $offerteUmzugIds = OfferteUmzug::where('tariff', 13)->pluck('id');
                            $query->orWhereIn('offerteUmzugId', $offerteUmzugIds);
                        } elseif ($filter == "5-5.5 Zimmer") {
                            $offerteUmzugIds = OfferteUmzug::where('tariff', 19)->pluck('id');
                            $query->orWhereIn('offerteUmzugId', $offerteUmzugIds);
                        } elseif ($filter == "6-6.5 Zimmer") {
                            $offerteUmzugIds = OfferteUmzug::where('tariff', 22)->pluck('id');
                            $query->orWhereIn('offerteUmzugId', $offerteUmzugIds);
                        }
                    }
                });
            }

            $filteredZimmerCount = $ZimmerCounter->count();
        }

        // Besichtigung Filter
        // Filtrelenmiş veri sayısını tutacak değişkeni tanımlayın
        // Besichtigung Filter
        if ($request->appType) {
            if ($request->appType == 'Nein') {
                $filteredData = $table->whereIn('appType', [0, 2]); // Filtrelenmiş veri setini al
                $filteredCount = $filteredData->count(); // Filtrelenmiş veri sayısını al
            }
            else if ($request->appType == 'Gemacht') {
                $filteredData = $table->where('appType', 1); // Filtrelenmiş veri setini al
                $filteredCount = $filteredData->count(); // Filtrelenmiş veri sayısını al
            }
            else if ($request->appType == 'Alle') {
                // Tüm veri setini almak istiyorsanız burada bir işlem yapabilirsiniz
                $filteredData = $table; // Tüm veri setini al
                $filteredCount = $filteredData->count(); // Filtrelenmiş veri sayısını al
            }
        }

        // StandType Filter

        if($request->standType) {
            if ($request->standType == 'Onaylandı') {
                $filteredStandData = $table->where('offerteStatus', 'Onaylandı');
                $filteredStandCount = $filteredStandData->count();
            }
            else if ($request->standType == 'Onaylanmadı') {
                $filteredStandData = $table->where('offerteStatus', 'Onaylanmadı');
                $filteredStandCount = $filteredStandData->count();
            }
            else if ($request->standType == 'Beklemede') {
                $filteredStandData = $table->where('offerteStatus', 'Beklemede');
                $filteredStandCount = $filteredStandData->count();
            }
            else if ($request->standType == 'Alle') {
                $filteredStandData = $table->get();
                $filteredStandCount = $filteredStandData->count();
            }
        }

        // Service type filter
        if ($request->typeFilter) {
            $typeFilter = $request->typeFilter;

            if (is_array($typeFilter)) {
                $tableType = $table->where(function($query) use ($typeFilter) {
                    foreach ($typeFilter as $filter) {
                        if ($filter == "Umzug") {
                            $query->orWhereNotNull('offerteUmzugId');
                        } elseif ($filter == "Einpack") {
                            $query->orWhereNotNull('offerteEinpackId');
                        } elseif ($filter == "Auspack") {
                            $query->orWhereNotNull('offerteAuspackId');
                        } elseif ($filter == "Entsorgung") {
                            $query->orWhereNotNull('offerteEntsorgungId');
                        } elseif ($filter == "Reinigung") {
                            $query->orWhereNotNull('offerteReinigungId');
                        } elseif ($filter == "Transport") {
                            $query->orWhereNotNull('offerteTransportId');
                        } elseif ($filter == "Lagerung") {
                            $query->orWhereNotNull('offerteLagerungId');
                        } elseif ($filter == "Verpackungsmaterial") {
                            $query->orWhereNotNull('offerteMaterialId');
                        }
                    }
                });
            } else {
                $table->where('zimmer', $typeFilter);
            }

            $filteredServiceCount = $tableType->count();
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
        $renderedData['dateBasedFilter'] = $dateBasedFilter;
        $renderedData['bescBasedFilter'] = $filteredCount;
        $renderedData['filteredStandCount'] = $filteredStandCount;
        $renderedData['filteredServiceCount'] = $filteredServiceCount;
        $renderedData['filteredZimmerCount'] = $filteredZimmerCount;
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

        $totalRecords = $table->count() + $table2->count() + $table3->count();
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
                if($appStatus == 1 && $app['deliveryType'] == 0) {
                    return '<span id="termineBadge" class="badge badge-warning">Lieferung</span>
                    <div class="info-tooltip" id="infoTooltip">Kein Abholung</div>';
                }
                else if($app['deliveryType'] == 1) {
                    return 'Abholung';
                }
                else {
                    return 'Lieferung';
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
                case ('Abholung');
                return '
            <a class="btn btn-sm  btn-primary" href="' . route('appointmentMaterial.detailAbholung', ['id' => $array['id']]) . '"><i class="feather feather-eye" ></i>Termine</a> <span class="text-primary">|</span>
            <a class="btn btn-sm  btn-edit" href="' . route('customer.detail', ['id' => $array['customerId']]) . '"><i class="feather feather-edit" ></i> Kunde</a>';
                break;
            }
        })
        ->rawColumns(['option','appType'])
        ->make(true);

        $renderedData = (array)$data->original;
        $renderedData['totalTermine'] = $totalRecords;
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

        if ($request->docTakenFilter) {
            $docTakenFilter = $request->docTakenFilter;
            if (is_array($docTakenFilter)) {
                if (in_array("Taken", $docTakenFilter)) {
                    // Tabloyu docTaken değerine göre filtreleyelim
                    $table->whereIn('docTaken', [1]);
                    $table2->whereIn('docTaken', [1]);
                }
                if (in_array("Untaken", $docTakenFilter)) {
                    // Tabloyu docTaken değerine göre filtreleyelim
                    $table->whereIn('docTaken', [0]);
                    $table2->whereIn('docTaken', [0]);
                }
            }
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
                $array[$i]["customerSurname"] = Customer::where('id',$v->customerId)->value('surname');
                $array[$i]["customerId"] = $v->customerId;
                $array[$i]["created_at"] = date('d-m-Y', strtotime($v->created_at));
                $array[$i]["tutar"] = $v->totalPrice;
                $array[$i]["expensePrice"] =  $v->expensePrice ? $v->expensePrice : 0;
                $array[$i]["profit"] = $v->totalPrice - $v->expensePrice;
                $array[$i]["payType"] = $v->payType;
                $array[$i]["status"] = $v->status;
                $array[$i]["docTaken"] = $v->docTaken;
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
                $array[$i]["customerSurname"] = Customer::where('id',$v->customerId)->value('surname');
                $array[$i]["customerId"] = $v->customerId;
                $array[$i]["expensePrice"] = $v->expensePrice ? $v->expensePrice : 0;
                $array[$i]["created_at"] = date('d-m-Y', strtotime($v->created_at));
                $array[$i]["tutar"] = $v->totalPrice;
                $array[$i]["profit"] = $v->totalPrice - $v->expensePrice;
                $array[$i]["payType"] = $v->payType;
                $array[$i]["status"] = $v->status;
                $array[$i]["docTaken"] = $v->docTaken;
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

            ->addColumn('docTaken', function ($array) {


                if($array['docTaken'] == 1)
                {
                    return sprintf('<button class="btn btn-sm btn-success " onClick="docTaken(%d, \'%s\')">Ja</button>', $array['id'], $array['receiptType']);
                }
                else {
                    return sprintf('<button class="btn btn-sm btn-danger " onClick="docTaken(%d, \'%s\')">Nein</button>', $array['id'], $array['receiptType']);
                }


            })

            ->rawColumns(['option','docTaken'])
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
