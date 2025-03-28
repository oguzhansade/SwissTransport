<?php

namespace App\Http\Controllers\front\company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\EmailConfiguration;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Config;
use App\Helper\fileUpload;

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

    public function options(Request $request)
    {
        $company = Company::first();
        return view('front.company.options',['company' => $company]);
    }
    public function updateOptions(Request $request)
    {
        
        // Dosyanın var olup olmadığını kontrol edin
        if ($request->logoExpand) {
            $file = $request->logoExpand;
            // Dosyayı yükleyin ve sonucu kontrol edin
            $fileUpload = fileUpload::logoExpand($file);
        }
        
        if($request->logoCollapse) {
            $fileCollapse = $request->logoCollapse;
            $fileCollapseUpload = fileUpload::logoCollapse($fileCollapse);
        }

        $colors = [
            'crmPrimaryColor' => $request->crmPrimaryColor,
            'crmSecondaryColor' => $request->crmSecondaryColor,
            'pdfPrimaryColor' => $request->pdfPrimaryColor
        ];

       
        $update = Company::first()->update($colors);
        
        if($update)
        { 
                      
            return redirect()->back()->with('status','Firma Stil Renkleri Düzenlendi');
        }
        else {
            return redirect()->back()->with('status','Hata: Firma Stil Renkleri Düzenlenemedi');
        }
        
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
                      
            return redirect()->back()->with('status','Firma erfolgreich hinzugefügt.');
        }
        else {
            return redirect()->back()->with('status','Fehler: Firma konnte nicht hinzugefügt werden.');
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
            $data = Company::where('id',$id)->first();
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

             // Dosyanın var olup olmadığını kontrol edin
             if ($request->logoExpand) {
                $file = $request->logoExpand;
                // Dosyayı yükleyin ve sonucu kontrol edin
                $fileUpload = fileUpload::logoExpand($file);
            }

            if($request->logoCollapse) {
                $fileCollapse = $request->logoCollapse;
                $fileCollapseUpload = fileUpload::logoCollapse($fileCollapse);
            }
           

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
                'crmPrimaryColor' => $request->crmPrimaryColor,
                'crmSecondaryColor' => $request->crmSecondaryColor,
                'pdfPrimaryColor' => $request->pdfPrimaryColor
            ]);

            
            if($update) {
                return redirect()->back()->with('status','Firma wurde bearbeitet.');
            }
            else {
                return redirect()->back()->with('status','Fehler: Die Firma konnte nicht bearbeitet werden');
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
