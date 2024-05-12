<?php

namespace App\Http\Controllers\front\customer;

use App\Http\Controllers\Controller;
use App\Models\AppoinmentService;
use App\Models\Appointment;
use App\Models\AppointmentMaterial;
use App\Models\Customer;
use App\Models\CustomerForm;
use App\Models\Invoice;
use App\Models\LagerungMailer;
use App\Models\offerte;
use App\Models\ReceiptReinigung;
use App\Models\ReceiptUmzug;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\OfferteUmzug;
use App\Models\Company;
use App\Mail\CustomerReminder;
use App\Models\OfferteEntsorgung;
use App\Models\OfferteReinigung;
use App\Models\OfferteTransport;
use Illuminate\Support\Facades\Auth;


class indexController extends Controller
{
    public function index()
    {
        return view('front.customer.index');
    }

    public function reminderTest(){
        $offertes = Offerte::where('customerId', 1)
            ->where('offerteStatus', 'Onaylandı')
            ->get();
        $umzugDate = null;
        foreach ($offertes as $offerte) {
            if ($offerte) {
                $customer = Customer::find($offerte->customerId);
                $from = Company::InfoCompany('email');
                $companyName = Company::InfoCompany('name');

                if ($offerte->offerteUmzugId) {
                    $umzugService = OfferteUmzug::find($offerte->offerteUmzugId);

                    // Check if both offerteUmzugId and moveDate are present
                    if ($umzugService && $umzugService->moveDate) {
                        $umzugDate = Carbon::parse($umzugService->moveDate);
                        $mailParseTime = $umzugService->moveTime;
                    } else {
                        // If moveDate is null, proceed to check for offerteTransportId
                        $umzugDate = null;
                        $mailParseTime = null;
                    }
                }

                if (!$umzugDate && $offerte->offerteTransportId) {
                    $transportService = OfferteTransport::find($offerte->offerteTransportId);

                    // Check if both offerteUmzugId and moveDate are present
                    if ($transportService && $transportService->moveDate) {
                        $umzugDate = Carbon::parse($transportService->transportDate);
                        $mailParseTime = $transportService->transportTime;
                    } else {
                        // If moveDate is null, proceed to check for offerteTransportId
                        $umzugDate = null;
                        $mailParseTime = null;
                    }
                }

                if (!$umzugDate && $offerte->offerteReinigungId) {
                    $reinigungService = OfferteReinigung::find($offerte->offerteReinigungId);

                    // Check if both offerteUmzugId and moveDate are present
                    if ($reinigungService && $reinigungService->startDate) {
                        $umzugDate = Carbon::parse($reinigungService->startDate);
                        $mailParseTime = $reinigungService->startTime;
                    } else {
                        // If moveDate is null, proceed to check for offerteTransportId
                        $umzugDate = null;
                        $mailParseTime = null;
                    }
                }

                if (!$umzugDate && $offerte->offerteEntsorgungId) {
                    $entsorgungService = OfferteEntsorgung::find($offerte->offerteEntsorgungId);

                    // Check if both offerteUmzugId and moveDate are present
                    if ($entsorgungService && $entsorgungService->entsorgungDate) {
                        $umzugDate = Carbon::parse($entsorgungService->entsorgungDate);
                        $mailParseTime = $entsorgungService->entsorgungTime;
                    } else {
                        // If moveDate is null, proceed to check for offerteTransportId
                        $umzugDate = null;
                        $mailParseTime = null;
                    }
                }

                // If both offerteUmzugId and moveDate are null, skip this iteration
                if (!$umzugDate) {
                    continue;
                }

                // 1 hafta öncesi kontrol et
                $oneWeekBefore = $umzugDate->subDays(7);

                // Carbon::now() == $twoWeeksAfter eğer böyle yazsaydık saatinde uyuşması gerekirdi o yüzden isSameDay kullandık
                if (Carbon::now()->isSameDay($oneWeekBefore)) {
                    $emailData = [
                        'mailType' => 'beforeOneWeek',
                        'customer' => $customer,
                        'from' => $from,
                        'sub' => 'Taşınma Hatırlatıcısı',
                        'companyName' => $companyName,
                        'offerte' => $offerte,
                        'umzugDate' => $umzugDate->addDays(7)->format('d-m-Y'),
                        'umzugTime' => $mailParseTime
                    ];

                    Mail::to($customer->email)->send(new CustomerReminder($emailData));
                }
            }
        }
    }

    public function create()
    {
        return view ('front.customer.create');
    }

    public function createForm($id)
    {
        $c = CustomerForm::where('id',$id)->count();
        if($c !=0)
        {
            $data = CustomerForm::where('id',$id)->first();
            return view ('front.customer.createForm', ['data' => $data]);
        }

    }

    public function storeForm(Request $request)
    {
        $all = $request->except('_token');
        $customer = [
            'name' => $request->name,
            'surname' => $request->surname,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'street' => $request->street,
            'postCode' => $request->postCode,
            'Ort' => $request->Ort,
            'country' => $request->isCustomCountry ? $request->customCountry : $request->country,
            'source1' => $request->source1,
            'source2' => $request->source2,
            'note' => $request->note,
            'companyName' => $request->companyName,
            'contactPerson' => $request->contactPerson,

        ];

        $create = Customer::create($customer);
        $customerIdBul = DB::table('customers')->orderBy('id', 'DESC')->first();
        $customerId = $customerIdBul->id;

        $formUpdate = CustomerForm::where('id',$request->route('id'))->update([
            'status' => 1,
            'customerId' => $customerId
        ]);
        if($create && $formUpdate)
        {

            $data = Customer::where('id',$create->id)->get();
            //return redirect()->back()->with('status','Müşteri Başarıyla Eklendi');
            return view ('front.customer.detail', ['id' => $create->id , 'data' => $data]);
        }
        else {
            return redirect()->back()->with('status','Fehler: Kunde konnte nicht hinzugefügt werden.');
        }

    }

    public function store(Request $request)
    {

        $all = $request->except('_token');
        $customer = [
            'name' => $request->name,
            'surname' => $request->surname,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'street' => $request->street,
            'postCode' => $request->postCode,
            'Ort' => $request->Ort,
            'country' => $request->isCustomCountry ? $request->customCountry : $request->country,
            'source1' => $request->source1,
            'source2' => $request->source2,
            'note' => $request->note,
            'companyName' => $request->companyName,
            'contactPerson' => $request->contactPerson,

        ];

        $create = Customer::create($customer);
        if($create)
        {
            $data = Customer::where('id',$create->id)->get();
            //return redirect()->back()->with('status','Müşteri Başarıyla Eklendi');
            return view ('front.customer.detail', ['id' => $create->id , 'data' => $data]);
        }
        else {
            return redirect()->back()->with('status','Fehler: Kunde konnte nicht hinzugefügt werden.');
        }
    }

    public function data(Request $request)
    {
        $table=Customer::query();
        $totalPrice = 0; // Initialize the total price variable,

        // Minimum date filter

        if($request->min_date) {
            $table->whereDate('created_at', '>=', $request->min_date);
        }

        // Maximum date filter
        if($request->max_date) {
            $table->whereDate('created_at', '<=', $request->max_date);
        }

        // Tekrar eden e-posta adreslerini filtreleme
        if ($request->duplicateFilter == 1) {
            $duplicateEmails = Customer::select('email')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('email')
            ->having('count', '>', 1)
            ->pluck('email')
            ->sort(); // E-posta adreslerini alfabetik olarak sıralar

             $table->whereIn('email', $duplicateEmails);
        }

        if ($request->serviceFilter) {
            $serviceFilter = $request->serviceFilter;

            if (is_array($serviceFilter)) {
                if (in_array("Offerte", $serviceFilter)) {
                    // Offerte'ye sahip olan müşterilerin customerId'lerini alalım
                    $offerteCustomerIds = offerte::pluck('customerId');

                    // Tabloyu customerId'ye göre filtreleyelim
                    $table->whereIn('id', $offerteCustomerIds);
                }
                if (in_array("Nicht Offerte", $serviceFilter)) {
                    // Offerte'ye sahip olan müşterilerin customerId'lerini alalım
                    $offerteCustomerIds = offerte::pluck('customerId');

                    // Tabloyu customerId'ye göre filtreleyelim
                    $table->whereNotIn('id', $offerteCustomerIds);
                }
                if (in_array("Quittung", $serviceFilter)) {
                    // Quittung'a sahip olan müşterilerin customerId'lerini alalım
                    $receiptUmzugCustomer = ReceiptUmzug::pluck('customerId');
                    $receiptReinigungCustomer = ReceiptReinigung::pluck('customerId');

                    // Müşteri ID'lerini birleştirerek tek bir dizi elde edelim
                    $allCustomerIds = array_merge($receiptUmzugCustomer->toArray(), $receiptReinigungCustomer->toArray());

                    // Tabloyu customerId'ye göre filtreleyelim
                    $table->whereIn('id', $allCustomerIds);
                }

                if (in_array("Nicht Quittung", $serviceFilter)) {
                    // Quittung'a sahip olan müşterilerin customerId'lerini alalım
                    $receiptUmzugCustomer = ReceiptUmzug::pluck('customerId');
                    $receiptReinigungCustomer = ReceiptReinigung::pluck('customerId');

                    // Müşteri ID'lerini birleştirerek tek bir dizi elde edelim
                    $allCustomerIds = array_merge($receiptUmzugCustomer->toArray(), $receiptReinigungCustomer->toArray());

                    // Tabloyu customerId'ye göre filtreleyelim
                    $table->whereNotIn('id', $allCustomerIds);
                }

                if (in_array("Termine", $serviceFilter)) {
                    // Termine'e sahip olan müşterilerin customerId'lerini alalım
                    $appCustomer = Appointment::pluck('customerId');
                    $appServiceCustomer = AppoinmentService::pluck('customerId');
                    $appMaterialCustomer = AppointmentMaterial::pluck('customerId');

                    // Müşteri ID'lerini birleştirerek tek bir dizi elde edelim
                    $allCustomerIds = array_merge($appCustomer->toArray(), $appServiceCustomer->toArray(), $appMaterialCustomer->toArray());

                    // Tabloyu customerId'ye göre filtreleyelim
                    $table->whereIn('id', $allCustomerIds);
                }
                if (in_array("Nicht Termine", $serviceFilter)) {
                    // Termine'e sahip olan müşterilerin customerId'lerini alalım
                    $appCustomer = Appointment::pluck('customerId');
                    $appServiceCustomer = AppoinmentService::pluck('customerId');
                    $appMaterialCustomer = AppointmentMaterial::pluck('customerId');

                    // Müşteri ID'lerini birleştirerek tek bir dizi elde edelim
                    $allCustomerIds = array_merge($appCustomer->toArray(), $appServiceCustomer->toArray(), $appMaterialCustomer->toArray());

                    // Tabloyu customerId'ye göre filtreleyelim
                    $table->whereNotIn('id', $allCustomerIds);
                }
            }
        }

        // Select total price

        $data=DataTables::of($table)

        ->editColumn('customerType',function ($table) {
            if($table->customerType == 0) {
                return "Kunde";
            }
            else {
                return "Company";
            }
        })
        ->addColumn('offerteFilter', function($table){
            // Offerte'ye sahip olan müşterilerin customerId'lerini alalım
            $offerte = offerte::where('customerId',$table->id)->count();

            if($offerte > 0){
                if($offerte > 1)
                {
                    return '<span id="offerteBadge" class="badge badge-success">Offerte ✓✓</span>
                    <div class="info-tooltip" id="infoTooltip">Mehrere Angebote vorhanden</div>
                    ';
                }
                else {
                    return '<span id="offerteBadge" class="badge badge-success">Offerte ✓</span>
                    <div class="info-tooltip" id="infoTooltip">Angebot vorhanden</div>';
                }
            }
            else {
                return '<span id="offerteBadge" class="badge badge-warning">Offerte !</span>
                <div class="info-tooltip" id="infoTooltip">Kein Angebot</div>';
            }
        })
        ->editColumn('created_at', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y'); return $formatedDate; })
        ->addColumn('option',function($table)
        {
            if(Auth::user()->permName == 'superAdmin')
            {
                return '
                <a class="btn btn-sm  btn-primary" href="'.route('customer.detail',['id'=>$table->id]).'"><i class="feather feather-eye" ></i></a> <span class="text-primary">|</span>
                <a class="btn btn-sm  btn-edit" href="'.route('customer.edit',['id'=>$table->id]).'"><i class="feather feather-edit" ></i></a> <span class="text-primary">|</span>
                <a class="btn btn-sm  btn-danger"  href="'.route('customer.delete',['id'=>$table->id]).'"><i class="feather feather-trash-2" ></i></a>';
            }
            else {
                return '
                <a class="btn btn-sm  btn-primary" href="'.route('customer.detail',['id'=>$table->id]).'"><i class="feather feather-eye" ></i></a> <span class="text-primary">|</span>
                <a class="btn btn-sm  btn-edit" href="'.route('customer.edit',['id'=>$table->id]).'"><i class="feather feather-edit" ></i></a> <span class="text-primary">|</span>';
            }

        })
        ->rawColumns(['publicname','option','offerteFilter'])
        ->make(true);


        return $data;
    }

    public function edit($id)
    {
        $c = Customer::where('id',$id)->count();
        if($c !=0)
        {
            $data = Customer::where('id',$id)->get();
            return view ('front.customer.edit', ['data' => $data]);
        }
    }

    public function detail($id)
    {
        $c = Customer::where('id',$id)->count();
        if($c !=0)
        {
            $data = Customer::where('id',$id)->get();
            return view ('front.customer.detail', ['data' => $data]);
        }
    }

    public function updateNote(Request $request){
        $id = $request->route('id');
        $c = Customer::where('id',$id)->count();
        if($c !=0)
        {
            $update = Customer::where('id',$id)->update([
                'note' => $request->note
            ]);
            if($update){
                return response()->json(['message' => 'Müşteri Notu Güncellendi'], 200);
            }
            else {
                return response()->json(['message' => 'Müşteri Notu Güncellenemedi'], 500);
            }
        }
        else {

        }
    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Customer::where('id',$id)->count();
        if($c !=0)
        {
            $customer = [
                'name' => $request->name,
                'surname' => $request->surname,
                'gender' => $request->gender,
                'email' => $request->email,
                'phone' => $request->phone,
                'mobile' => $request->mobile,
                'street' => $request->street,
                'postCode' => $request->postCode,
                'Ort' => $request->Ort,
                'country' => $request->isCustomCountry ? $request->customCountry : $request->country,
                'source1' => $request->source1,
                'source2' => $request->source2,
                'note' => $request->note,
                'companyName' => $request->companyName,
                'contactPerson' => $request->contactPerson,

            ];

            $update = Customer::where('id',$id)->update($customer);
            if($update)
            {
                return redirect()
                ->route('customer.detail', ['id' => $id])
                ->with('status', 'Kunde wurde bearbeitet')
                ->with('keep_status', true);
                return redirect()->back()->with('status','Kunde wurde bearbeitet.');
            }
            else {
                return redirect()->back()->with('status','Fehler: Kunde konnte nicht bearbeitet werden.');
            }
        }
    }



    public function delete($id)
    {

        $c = Customer::where('id',$id)->count();
        if($c !=0)
        {
            $data = Customer::where('id',$id)->get();
            Customer::where('id',$id)->delete();
            offerte::where('customerId',$id)->delete();
            Appointment::where('customerId',$id)->delete();
            AppoinmentService::where('customerId',$id)->delete();
            AppointmentMaterial::where('customerId',$id)->delete();
            Invoice::where('customerId',$id)->delete();
            LagerungMailer::where('customerId',$id)->delete();
            ReceiptUmzug::where('customerId',$id)->delete();
            ReceiptReinigung::where('customerId',$id)->delete();
            $customerForm = CustomerForm::where('customerId',$id)->count();
            if($customerForm != 0)
            {
                CustomerForm::where('customerId',$id)->update([
                    'status' => 0,
                    'customerId' => NULL
                ]);
            }

            return redirect()->back();
        }
        else {
            return redirect('/');
        }
    }
}
