<?php

namespace App\Http\Controllers\front\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Yajra\DataTables\Facades\DataTables;

class indexController extends Controller
{
    public function index()
    {
        return view('front.user.index');
    }

    public function workerIndex()
    {
        return view('front.user.workerIndex');
    }

    public function create()
    {
        return view ('front.user.create');
    }

    public function store(Request $request)
    {
        $all = $request->except('_token');
        
        $c = User::where ('email', $all['email'])->count();
        if($c == 0){

            // $permission = (isset($all['permission'])) ? $all['permission'] : [];
            // unset($all['permission']);
            $all['password'] = Hash::make($all['password']);
            $create = User::create($all);

            if($create)
            {
                // if(count($permission)!=0)
                // {
                //     foreach ($permission as $k => $v)
                //     {
                //         UserPermission::create(['userId' => $create -> id, 'permissionId' => $v]);
                //     }
                // }
                
                return redirect()->back()->with('status','Kullanıcı Başarıyla Eklendi');
            }
            else {
                return redirect()->back()->with('status','Hata:Kullanıcı Eklenemedi');
            }

        }else {
                return redirect()->back()->with('status','Email Sistemde Mevcut');
            }
    }

    public function edit($id)
    {
        $c = User::where('id',$id)->count();
        if($c !=0)
        {
            $data = User::where('id',$id)->get();
            return view ('front.user.edit', ['data' => $data]);
        }
    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = User::where('id',$id)->count();
        if($c !=0)
        {
            $all = $request->except('_token');

            $emailControl = User::where('email',$all['email'])->where('id','!=',$id)->count();

            if($emailControl!=0) 
            {
                return redirect()->back()->with('status','Email Mevcut');
            }
            if($all['password'] == "") 
            {
                unset($all['password']);
            }
            else 
            {
                $all['password'] = Hash::make($all['password']);
            }

            // $permission = (isset($all['permission'])) ? $all['permission'] : [];

            // UserPermission::where('userId',$id)->delete();
            // if(count($permission)!=0)
            // {
            //     foreach($permission as $k => $v)
            //     {
            //         UserPermission::create(['userId' => $id, 'permissionId' => $v]);
            //     }
            // }
            // unset($all['permission']);


            $data = User::where('id',$id)->get();
            $update = User::where('id',$id)->update($all);
            
            if($update) 
            {
                
                return redirect()->back()->with('status','Kullanıcı Düzenlendi');
            }
            else {
                return redirect()->back()->with('status','HATA:Kullanıcı Düzenlenemedi');
            }

            
        }
    }

    public function delete($id)
    {

        $c = User::where('id',$id)->count();
        if($c !=0)
        {
            $data = User::where('id',$id)->get();
            
            User::where('id',$id)->delete();
            return redirect()->back();
        }
        else {
            return redirect('/');
        }
    }

    public function dataWorker(Request $request)
    {
        $table= DB::table('users')->where('permName','=', 'worker')->get()->toArray();

        $data=DataTables::of($table)
        ->addColumn('edit',function($table) 
        {
            return '<a href="'.route('user.edit',['id'=>$table->id]).'">Düzenle</a>';
        })

        ->addColumn('delete',function($table) {
            return '<a href="'.route('user.delete',['id'=>$table->id]).'">Sil</a>';
        })   
        ->rawColumns(['edit','delete'])
        ->make(true);

        return $data;
    }

    public function data(Request $request)
    {
        $table = User::whereNull('permName')->orWhere('permName', '!=', 'worker')->get();
        $data=DataTables::of($table)

        ->addColumn('option',function($table) 
        {
            
            if($table->name == 'Developer')
            {
                return '<span class="dev-badge">Developer</span>';
            }
            else {
                return '
            <a class="btn btn-sm  btn-edit" href="'.route('user.edit',['id'=>$table->id]).'"><i class="feather feather-edit" ></i></a>
            <a class="btn btn-sm  btn-danger"  href="'.route('user.delete',['id'=>$table->id]).'"><i class="feather feather-trash-2" ></i></a>
            ';
            }
        })
        ->rawColumns(['option'])
        ->make(true);

        return $data;
    }
}
