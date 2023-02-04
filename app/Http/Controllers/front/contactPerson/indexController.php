<?php

namespace App\Http\Controllers\front\contactPerson;

use App\Http\Controllers\Controller;
use App\Models\ContactPerson;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class indexController extends Controller
{
    public function index()
    {
        return view ('front.contactPerson.index');
    }

    public function create()
    {
        return view ('front.contactPerson.create');
    }
    
    public function store(Request $request){
        $emailControl = User::where('email',$request->email)->count();

        if($emailControl!=0) 
        {
            return redirect()->back()->with('status2','Email Başkasına Ait');
        }

        $ContactPeople = [
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'phone' => $request->phone,
            'duty' => $request->duty,
        ];

        $create = ContactPerson::create($ContactPeople);

        if($create)
        {
            return redirect()->back()->with('status','Success:Contact Person Added');
        }
        else{
            return redirect()->back()->with('status2','Error: Contact Person cannot be added');
        }
    }

    public function edit(Request $request)
    {
        $id = $request->route('id');
        $c = ContactPerson::where('id',$id)->count();
        

        if($c !=0)
        {
            $data = ContactPerson::where('id',$id)->first();
            return view ('front.contactPerson.edit', ['data' => $data]);
        }
    }

    
    public function data()
    {
        $table=ContactPerson::query();
        $data=DataTables::of($table)
        
        ->addColumn('option',function($table) 
        {
            return '
            <a class="btn btn-sm  btn-edit" href="'.route('contactPerson.edit',['id'=>$table->id]).'"><i class="feather feather-edit" ></i></a> <span class="text-primary">|</span>
            <a class="btn btn-sm  btn-danger"  href="'.route('contactPerson.delete',['id'=>$table->id]).'"><i class="feather feather-trash-2" ></i></a>';
        })
        ->rawColumns(['option'])
        ->make(true);

        return $data;
    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = ContactPerson::where('id',$id)->count();

        $emailControl = User::where('email',$request->email)->count();

        if($emailControl!=0) 
        {
            return redirect()->back()->with('status2','Email Başkasına Ait');
        }


         $ContactPeople = [
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'phone' => $request->phone,
            'duty' => $request->duty,
        ];

        $update = ContactPerson::where('id',$id)->update($ContactPeople);
        if($c !=0)
        {
            if($update) {
               
                return redirect()->back()->with('status','Contact Person Update');
            }
            else {
                return redirect()->back()->with('status2','ERROR:Contact Person Cannot Update');
            }
        }
    }

    public function delete($id)
    {
        $c = ContactPerson::where('id',$id)->count();
        if($c !=0)
        {
            $delete = ContactPerson::where('id',$id)->delete();
            if($delete)
            {
                return redirect()->back()->with('status','Contact Person Deleted');
            }
            else{
                return redirect('/');
            }
        }
    }
}
