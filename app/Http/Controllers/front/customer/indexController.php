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


class indexController extends Controller
{
    public function index()
    {
        return view('front.customer.index');
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

        if ($request->serviceFilter) {
            $serviceFilter = $request->serviceFilter;
        
            if (is_array($serviceFilter)) {
                if (in_array("Offerte", $serviceFilter)) {
                    // Offerte'ye sahip olan müşterilerin customerId'lerini alalım
                    $offerteCustomerIds = Offerte::pluck('customerId');

                    // Tabloyu customerId'ye göre filtreleyelim
                    $table->whereIn('id', $offerteCustomerIds);
                } 
                if (in_array("Nicht Offerte", $serviceFilter)) {
                    // Offerte'ye sahip olan müşterilerin customerId'lerini alalım
                    $offerteCustomerIds = Offerte::pluck('customerId');

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
        ->editColumn('created_at', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y'); return $formatedDate; })
        ->addColumn('option',function($table) 
        {
            return '
            <a class="btn btn-sm  btn-primary" href="'.route('customer.detail',['id'=>$table->id]).'"><i class="feather feather-eye" ></i></a> <span class="text-primary">|</span>
            <a class="btn btn-sm  btn-edit" href="'.route('customer.edit',['id'=>$table->id]).'"><i class="feather feather-edit" ></i></a> <span class="text-primary">|</span>
            <a class="btn btn-sm  btn-danger"  href="'.route('customer.delete',['id'=>$table->id]).'"><i class="feather feather-trash-2" ></i></a>';
        })
        ->rawColumns(['publicname','option'])
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
