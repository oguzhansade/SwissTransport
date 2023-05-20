<?php

namespace App\Http\Controllers\front\worker;

use App\Http\Controllers\Controller;
use App\Mail\WorkerMail;
use App\Models\Company;
use App\Models\User;
use App\Models\UserPermission;
use App\Models\Worker;
use App\Models\WorkerBasket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use Yajra\DataTables\Facades\DataTables;

class indexController extends Controller
{
    public function index()
    {
        
        return view('front.worker.index');
    }

    public function data(Request $request)
    {
        $table=Worker::query();
        $data=DataTables::of($table)
        ->editColumn('workPrice', function($table) {
            return 'CHF'.' '.$table->workPrice;
        })
        ->addColumn('option',function($table) 
        {
            return '
            <a class="btn btn-sm  btn-primary" href="'.route('worker.detail',['id'=>$table->id]).'"><i class="feather feather-eye" ></i></a> 
            <a class="btn btn-sm  btn-edit" href="'.route('worker.edit',['id'=>$table->id]).'"><i class="feather feather-edit" ></i></a> <span class="text-primary">|</span>
            <a class="btn btn-sm  btn-danger"  href="'.route('worker.delete',['id'=>$table->id]).'"><i class="feather feather-trash-2" ></i></a>';
        })
        ->rawColumns(['option'])
        ->make(true);

        return $data;
    }

    public function payStatusChanger ($taskId)
    {
        $task = WorkerBasket::where('id',$taskId)->first();
        if($task['payStatus'] == 0)
        {
            $task = [
                'payStatus' => 1
            ];

            $update = WorkerBasket::where('id',$taskId)->first()->update($task);
        } else if($task['payStatus'] == 1)
        {
            $task = [
                'payStatus' => 0
            ];
            $update = WorkerBasket::where('id',$taskId)->update($task);
        }

        if($update) {
            return response()->json([
                'success' => true,
                'message' => 'Kayıt Güncellendi',
                'task' => WorkerBasket::where('id',$taskId)->first()
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Kayıt Güncellendi',
                'task' => WorkerBasket::where('id',$taskId)->first()
            ]);
        }


    }
    public function taskData(Request $request)
    {
        $workerId = $request->route('id');
        $table = DB::table('worker_baskets')->where('workerId', '=', $workerId);
        // Minimum date filter

        if($request->min_date) {
            $table->whereDate('created_at', '>=', $request->min_date);
        }
        
        // Maximum date filter
        if($request->max_date) {
            $table->whereDate('created_at', '<=', $request->max_date);
        }

        

        // $table = $table->get()->toArray(); // sorun çıkarsa açıklama satırından çıkar
        $data=DataTables::of($table)
        ->editColumn('created_at', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y'); return $formatedDate; })
        ->addColumn('payStatus',function($table) 
        {
            if($table->payStatus == 0)
            {
                return '
                        <button  class="btn btn-sm btn-warning payButton" onClick="payStatusChanger('.$table->id.')">Unpaid</button>';
            }
            else {
                return '
                <button class="btn btn-sm btn-success payButton" onClick="payStatusChanger('.$table->id.')">Paid</button>';
            }
            
        })
        ->rawColumns(['payStatus'])
        ->make(true);

        return $data;
    }

    public function edit(Request $request)
    {
        $id = $request->route('id');
        $c = Worker::where('id',$id)->count();
        

        if($c !=0)
        {
            $data = Worker::where('id',$id)->first();
            return view ('front.worker.edit', ['data' => $data]);
        }
    }

    public function detail(Request $request)
    {
        $id = $request->route('id');
        $c = Worker::where('id',$id)->count();
        

        if($c !=0)
        {
            $data = Worker::where('id',$id)->first();
            return view ('front.worker.detail', ['data' => $data]);
        }
    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Worker::where('id',$id)->count();

        $worker = Worker::where('id',$id)->first();
        $userData = User::where('id',$worker['userId'])->first();

        $emailControl = User::where('email',$request->email)->where('id','!=',$worker['userId'])->count();

            if($emailControl!=0) 
            {
                return redirect()->back()->with('status2','Email Başkasına Ait');
            }
            $password = $request->password;

            $workerArr = [
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'phone' => $request->phone,
                'workPrice' => $request->workPrice,
            ];

            if($password == "") 
            {
                $user = [
                    'name' => $request->name.' '.$request->surname,
                    'email' => $request->email,
                    'permName' => 'worker'
                ];
            }
            else 
            {
                $user = [
                    'name' => $request->name.' '.$request->surname,
                    'email' => $request->email,
                    'password' => Hash::make($password),
                    'permName' => 'worker'
                ];
            }

            User::where('id',$worker['userId'])->update($user);
            $update = Worker::where('id',$id)->update($workerArr);
        
            $emailData = [
                'name' => $request->name,
                'surname' => $request->surname,
                'sub' => 'Ihre Panel-Anmeldeinformationen wurden aktualisiert',
                'from' => Company::InfoCompany('email'),
                'companyName' => Company::InfoCompany('name'),
                'email' => $request->email,
                'password' => $request->password
            ];
            
        
        if($c !=0)
        {

            if($update) {
                if($request->password != "")
                {
                    Mail::to($emailData['email'])->send(new WorkerMail($emailData));
                }
                return redirect()->back()->with('status','İşçi Güncellendi');
            }
            else {
                return redirect()->back()->with('status2','HATA:İşçi Güncellenemedi');
            }
        }
    }

    public function create()
    {
        return view ('front.worker.create');
    }

    public function store(Request $request)
    {
        $userId = NULL;
        $c = User::where ('email', $request->email)->count();
        

        if($c == 0){
            $password = Hash::make($request->password);

            $user = [
                'name' => $request->name.' '.$request->surname,
                'email' => $request->email,
                'password' => $password,
                'permName' => 'worker'
            ];

            User::create($user);
            $userIdBul = DB::table('users')->orderBy('id','DESC')->first();
            $userId = $userIdBul->id;
           

            if($userId)
            {
                $worker = [
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'workPrice' => $request->workPrice,
                    'userId' => $userId
                ];
                $create = Worker::create($worker);
            }

            $emailData = [
                'name' => $request->name,
                'surname' => $request->surname,
                'sub' => 'Ihre Panel-Anmeldeinformationen',
                'from' => Company::InfoCompany('email'),
                'companyName' => Company::InfoCompany('name'),
                'email' => $request->email,
                'password' => $request->password
            ];

            if($create)
            {
                UserPermission::create(['userId' => $userId, 'permissionId' => 4]); // Permission Id 'si 4 olacak çünkü İşçi Paneline ulaşmalı
                Mail::to($emailData['email'])->send(new WorkerMail($emailData));
                return redirect()->back()->with('status','İşçi Başarıyla Eklendi, Kullanıcı Hesabı Oluşturuldu. Panel bilgileri işçiye gönderildi.');
            }
            else {
                return redirect()->back()->with('status2','Hata:İşçi Eklenemedi');
                if($userId)
                {
                    User::where('id',$userId)->delete(); // User oluşturulursa ama işçi oluşturulmamışsa ilgili user silinecek
                }
            }

        }

        else {
            return redirect()->back()->with('status2','Email Sistemde Mevcut');
        }
    }
        
    public function delete($id)
    {

        $c = Worker::where('id',$id)->count();
        if($c !=0)
        {
            $data = Worker::where('id',$id)->first();

            User::where('id',$data['userId'])->delete();
            Worker::where('id',$id)->delete();
            return redirect()->back()->with('status','İşçi Başarıyla Silindi');
        }
        else {
            return redirect('/');
        }
    }
}