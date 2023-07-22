<?php

namespace App\Http\Controllers\front\statistics;

use App\Http\Controllers\Controller;
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
        if (!empty($request->search)) {
            $searchValue = $request->search;
            $customerIds = Customer::where('name', 'like', "%$searchValue%")
                ->orWhere('surname', 'like', "%$searchValue%")
                ->pluck('id')
                ->toArray();
        
            $table->whereIn('customerId', $customerIds);
        }

        
        // Minimum date filter
        if($request->min_date) {
            $table->whereDate('created_at', '>=', $request->min_date);
        }
        
        // Maximum date filter
        if($request->max_date) {
            $table->whereDate('created_at', '<=', $request->max_date);
        }

       

        // ServiceType Filter
        if($request->serviceType) {
            if ($request->serviceType == 'Umzug') {
                $table->whereNotNull('offerteUmzugId');
            }
            else if ($request->serviceType == 'Einpack') {
                $table->whereNotNull('offerteEinpackId');
            }
            else if ($request->serviceType == 'Auspack') {
                $table->whereNotNull('offerteAuspackId');
            }
            else if ($request->serviceType == 'Entsorgung') {
                $table->whereNotNull('offerteEntsorgungId');
            }
            else if ($request->serviceType == 'Reinigung') {
                $table->whereNotNull('offerteReinigungId');
            }
            else if ($request->serviceType == 'Transport') {
                $table->whereNotNull('offerteTransportId');
            }
            else if ($request->serviceType == 'Lagerung') {
                $table->whereNotNull('offerteLagerungId');
            }
            else if ($request->serviceType == 'Verpackungsmaterial') {
                $table->whereNotNull('offerteMaterialId');
            }
            else if ($request->serviceType == 'Alle') {
                
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
                $table->where('appType', 0);
            }
            else if ($request->appType == 'Gemacht') {
                $table->where('appType', 1);
            }
            else if ($request->appType == 'Winscht Keine') {
                $table->where('appType', 2);
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

                return $customerName.' '.$customerSurname;
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
            <a class="btn btn-sm  btn-edit" href="'.route('customer.detail',['id'=>$data->customerId]).'"><i class="feather feather-edit" ></i> Kunde</a> <span class="text-primary"></span>';
        })
        ->rawColumns(['gratTotalPrice','totalPrice','services','option'])
        ->make(true);

        $renderedData = (array)$data->original;

        $renderedData['filteredTotal'] = $table->sum('offerPrice');
        $renderedData['nonFilteredTotal'] = $totalPrice;
        $renderedData['totalOfferte'] = $totalOfferte;
        return response()->json($renderedData);
        
        // $renderedData = $data;
        // dd($renderedData);
        // return json_decode($renderedData->original, true);
            

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
