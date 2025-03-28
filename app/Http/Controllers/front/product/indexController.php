<?php

namespace App\Http\Controllers\front\product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class indexController extends Controller
{

    public function index()
    {
        return view('front.product.index');
    }

    public function data(Request $request)
    {
        $table=Product::query();
        $data=DataTables::of($table)
        
        ->editColumn('productName', function($table){
            return '<a class="clickableCell" href="'.route('product.edit',['id'=>$table->id]).'">'.$table->productName.'</a>';
        }, 'td')

        ->addColumn('option',function($table) 
        {
            return '
            <a class="btn btn-sm  btn-edit" href="'.route('product.edit',['id'=>$table->id]).'"><i class="feather feather-edit" ></i></a> <span class="text-primary">|</span>
            <a class="btn btn-sm  btn-danger"  href="'.route('product.delete',['id'=>$table->id]).'"><i class="feather feather-trash-2" ></i></a>';
        })
        ->rawColumns(['option','productName'])
        ->make(true);

        return $data;
    }

    public function create()
    {
        return view ('front.product.create');
    }

    public function store(Request $request)
    {
        $all = $request->except('_token');
        $create = Product::create($all);

        if($create)
        {
            return redirect()->back()->with('status','Produkt erfolgreich hinzugefügt');
        }
        else {
            return redirect()->back()->with('status','Fehler: Produkt konnte nicht hinzugefügt werden');
        }
    }

    public function delete($id)
    {

        $c = Product::where('id',$id)->count();
        if($c !=0)
        {
            $data = Product::where('id',$id)->get();
            
            Product::where('id',$id)->delete();
            return redirect()->back()->with('status','Produkt wurde gelöscht');
        }
        else {
            return redirect()->back()->with('status2','Fehler: Produkt konnte nicht gelöscht werden');
        }
    }

    public function edit(Request $request)
    {
        $id = $request->route('id');
        $c = Product::where('id',$id)->count();
        

        if($c !=0)
        {
            $data = Product::where('id',$id)->first();
            return view ('front.product.edit', ['data' => $data]);
        }
    }


    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Product::where('id',$id)->count();
        if($c !=0)
        {
            $all = $request->except('_token');
            $data = Product::where('id',$id)->get();
           

            $update = Product::where('id',$id)->update([
                'productName' => $request->productName,
                'buyPrice' => $request->buyPrice,
                'rentPrice' => $request->rentPrice,
            ]);

            if($update) {
                return redirect()->back()->with('status','Produkt wurde aktualisiert');
            }
            else {
                return redirect()->back()->with('status2','Fehler: Produkt konnte nicht aktualisiert werden');
            }
        }
    }

    
}
