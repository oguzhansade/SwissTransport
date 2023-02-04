<?php

namespace App\Http\Controllers\front\tariff;

use App\Http\Controllers\Controller;
use App\Models\Tariff;
use App\Models\TariffCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class indexController extends Controller
{

    public function index()
    {
        return view ('front.tariff.index');
    }

    public function data(Request $request)
    {
        $table=Tariff::query();
        $data=DataTables::of($table)
        ->editColumn('chf', function($table){
            return 'CHF'.' '.$table->chf;
        })
        ->addColumn('option',function($table) 
        {
            return '
            <a class="btn btn-sm  btn-edit" href="'.route('tariff.edit',['id'=>$table->id]).'"><i class="feather feather-edit" ></i></a> <span class="text-primary">|</span>
            <a class="btn btn-sm  btn-danger"  href="'.route('tariff.delete',['id'=>$table->id]).'"><i class="feather feather-trash-2" ></i></a>';
        })
        ->rawColumns(['option'])
        ->make(true);

        return $data;
    }

    public function create()
    {
        return view ('front.tariff.create');
    }

    public function store(Request $request)
    {
    
        $all = $request->except('_token');
        

        $tariffName = TariffCategory::where('id',$request->tariffCategory)->first();
        
        $tariff = [
            'tariffType' => $request->tariffCategory,
            'tariffName' => $tariffName['categoryName'],
            'description' => $request->tariffDescription,
            'ma' => $request->ma,
            'lkw' => $request->lkw,
            'anhanger' => $request->anhanger,
            'chf' => $request->chf,
        ];

        $create = Tariff::create($tariff);

        if($create)
        {
            return redirect()->back()->with('status','Tarife Başarıyla Eklendi');
        }
        else {
            return redirect()->back()->with('status2','Hata:Tarife Eklenemedi');
        }
    }

    public function edit(Request $request)
    {
        $id = $request->route('id');
        $c = Tariff::where('id',$id)->count();
        

        if($c !=0)
        {
            $data = Tariff::where('id',$id)->first();
            return view ('front.tariff.edit', ['data' => $data]);
        }
    }


    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Tariff::where('id',$id)->count();
        $tariffName = TariffCategory::where('id',$request->tariffCategory)->first();

        if($c !=0)
        {
            $all = $request->except('_token');
            $data = Tariff::where('id',$id)->get();
           

            $update = Tariff::where('id',$id)->update([
                'tariffType' => $request->tariffCategory,
                'tariffName' => $tariffName['categoryName'],
                'description' => $request->tariffDescription,
                'ma' => $request->ma,
                'lkw' => $request->lkw,
                'anhanger' => $request->anhanger,
                'chf' => $request->chf,
            ]);

            if($update) {
                return redirect()->back()->with('status','Tarife Güncellendi');
            }
            else {
                return redirect()->back()->with('status2','HATA:Tarife Güncellenemedi');
            }
        }
    }

    public function delete($id)
    {
        $c = Tariff::where('id',$id)->count();
        if($c !=0)
        {
            $data = Tariff::where('id',$id)->get();
            
            Tariff::where('id',$id)->delete();
            return redirect()->back()->with('status','Tarife Silindi');
        }
        else {
            return redirect()->back()->with('status2','HATA:Tarife Silinemedi');
        }
    }
}
