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
        // Select total price
        $totalPrices = [];
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
        ->addColumn('totalPrice', function ($data) {
            $totalPrice = 0;
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

            // Calculate the total price for each service.
            foreach ($defaultPrices as $service => $defaultPrice) {
                if ($defaultPrice) {
                $totalPrice += getPriceFromParts($defaultPrice);
                }
            }
            return $totalPrice;
        })

        ->addColumn('gratTotalPrice', function ($data) {
            $gratTotalPrice = $data->sum('id');
            return $gratTotalPrice;
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
        
        return $data;
    }
}
