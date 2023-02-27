<?php

namespace App\Http\Controllers\front\customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;


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
            return redirect()->back()->with('status','Hata:Müşteri Eklenemedi');
        }
    }

    public function data(Request $request)
    {
        $table=Customer::query();
        $data=DataTables::of($table)
        ->addColumn('publicname',function ($table) {
            if($table->customerType == 0)
            {
                $fullname = $table->name.' '.$table->surname;
                return $fullname;
            }
            else {
                return $table->companyName;
            }
        })
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
                return redirect()->back()->with('status','Müşteri Düzenlendi');
            }
            else {
                return redirect()->back()->with('status','HATA:Müşteri Düzenlenemedi');
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
            return redirect()->back();
        }
        else {
            return redirect('/');
        }
    }
}
