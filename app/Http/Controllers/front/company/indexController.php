<?php

namespace App\Http\Controllers\front\company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\EmailConfiguration;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class indexController extends Controller
{
    public function index()
    {
        return view('front.company.index');
    }

    public function create()
    {
        return view('front.company.create');
    }

    public function store(Request $request)
    {
        
        $company = Company::create([
            'name' => $request->name,
            'street' => $request->street,
            'post_code' => $request->post_code,
            'city' => $request->city,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'contact_person' => $request->contact_person,
            'email' => $request->email,
            'website' => $request->website,

        ]);
        
        $emailconf = EmailConfiguration::create([
            'companyId' => $company->id,
            'host' => $request->host,
            'port' => $request->port,
            'ssl' => $request->ssl ? '1' : '0',
            'username' => $request->username,
            'password' => $request->password,
            'display_name' => $request->display_name,
            'reply_address' => $request->reply_address,
        ]);


        if($company && $emailconf)
        { 
                      
            return redirect()->back()->with('status','Firma Başarıyla Eklendi');
        }
        else {
            return redirect()->back()->with('status','Hata:Firma Eklenemedi');
        }
    }

    public function data(Request $request)
    {
        $table=Company::query();
        $data=DataTables::of($table)
        ->addColumn('option',function($table) 
        {
            return '
            <a class="btn btn-sm  btn-edit" href="'.route('company.edit',['id'=>$table->id]).'"><i class="feather feather-edit" ></i></a> <span class="text-primary">|</span>
            <a class="btn btn-sm  btn-danger"  href="'.route('company.delete',['id'=>$table->id]).'"><i class="feather feather-trash-2" ></i></a>
            ';
        })
        ->rawColumns(['option'])
        ->make(true);

        return $data;
    }

    public function edit($id)
    {
        $c = Company::where('id',$id)->count();
        if($c !=0)
        {
            $data = Company::where('id',$id)->get();
            $data2 = EmailConfiguration::where('companyId',$id)->get();
            return view ('front.company.edit', ['data' => $data ,'data2' => $data2]);
        }
    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Company::where('id',$id)->count();
        if($c !=0)
        {
            $all = $request->except('_token');
            $data = Company::where('id',$id)->get();
            $data2 = EmailConfiguration::where('companyId',$id)->get();

            $update = Company::where('id',$id)->update([
                'name' => $request->name,
                'street' => $request->street,
                'post_code' => $request->post_code,
                'city' => $request->city,
                'phone' => $request->phone,
                'mobile' => $request->mobile,
                'contact_person' => $request->contact_person,
                'email' => $request->email,
                'website' => $request->website,
            ]);

            $update2 = EmailConfiguration::where('companyId',$id)->update([
                'host' => $request->host,
                'port' => $request->port,
                'ssl' => $request->ssl ? '1' : '0',
                'username' => $request->username,
                'password' => $request->password,
                'display_name' => $request->display_name,
                'reply_address' => $request->reply_address,
            ]);

            if($update) {
                return redirect()->back()->with('status','Firma Düzenlendi');
            }
            else {
                return redirect()->back()->with('status','HATA:Firma Düzenlenemedi');
            }
        }
    }

    public function delete($id)
    {

        $c = Company::where('id',$id)->count();
        if($c !=0)
        {
            EmailConfiguration::where('companyId',$id)->delete();
            Company::where('id',$id)->delete();
            return redirect()->back();
        }
        else {
            return redirect('/');
        }
    }
}
