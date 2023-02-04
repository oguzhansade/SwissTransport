<?php

namespace App\Http\Controllers\front\workerPanel;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Customer;
use App\Models\offerte;
use App\Models\offerteAddress;
use App\Models\Task;
use App\Models\User;
use App\Models\Worker;
use App\Models\WorkerBasket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\WorkerMail;
use Illuminate\Support\Facades\Hash;


use Yajra\DataTables\Facades\DataTables;

class indexController extends Controller
{
    public function index()
    {
        $gorevSayisi = WorkerBasket::where('userId',Auth::id())->count();
        return view('front.workerPanel.index',['gorevSayisi' => $gorevSayisi]);
    }

    public function data(Request $request)
    {
        $workerId = $request->route('id');

        $table= DB::table('worker_baskets')->where('userId','=', Auth::id())->get()->toArray();   
        $data=DataTables::of($table)

        ->editColumn('workerHour', function($data){ 
            if ($data->workerHour == 0)  {
                return 'Saat Girilecek';
            }
            else {
                return $data->workerHour.' '.'[h]';
            }
        })
        ->editColumn('offerteId', function($data){ 
                return ''.$data->offerteId;
        })
        ->editColumn('workerPrice', function($data){ 
            return 'CHF'.' '.$data->workerPrice;
        })
        ->editColumn('taskDate', function($data) {

            $task = Task::where('id',$data->taskId)->first();
            $taskDate = Carbon::createFromFormat('Y-m-d', $task['taskDate'])->format('d-m-Y');
            $taskfullDate = $taskDate;
           
            return $taskfullDate;
        
        })
        ->addColumn('detail',function($table) 
        {
            return '<a href="'.route('workerPanel.taskDetail',['userId'=>$table->userId,'id'=>$table->id]).'">Detay</a>';
        })
        ->addColumn('edit',function($table) 
        {
            if($table->workerHour > 0)
            {
                return '<a href="'.route('workerPanel.taskEdit',['userId'=>$table->userId,'id'=>$table->id]).'">Saati Düzenle</a>';
            }
            else
            {
                return '<a href="'.route('workerPanel.taskEdit',['userId'=>$table->userId,'id'=>$table->id]).'">Saat Gir</a>';
            }
            
            
        })
        ->addColumn('option',function($table) 
        {
            if($table->workerHour >0) 
            {
                return '<a class="btn btn-sm  btn-primary" href="'.route('workerPanel.taskDetail',['userId'=>$table->userId,'id'=>$table->id]).'"><i class="feather feather-eye" ></i></a>
                <a class="btn btn-sm  btn-success" href="'.route('workerPanel.taskEdit',['userId'=>$table->userId,'id'=>$table->id]).'"><i class="feather feather-clock" ></i></a>';
            }
            else
            {
                return '<a class="btn btn-sm  btn-primary" href="'.route('workerPanel.taskDetail',['userId'=>$table->userId,'id'=>$table->id]).'"><i class="feather feather-eye" ></i></a>
                <a  class="btn btn-sm  btn-warning" href="'.route('workerPanel.taskEdit',['userId'=>$table->userId,'id'=>$table->id]).'">
                <i class="feather feather-clock" ></i>
                </a>';
            }
            
        })
        ->rawColumns(['option'])
        ->make(true);

        return $data;
    }

    public function task($id, Request $request)
    {
        $Rid = $request->route('id');
        if($Rid == Auth::id())
        {
            $data = Worker::where('userId',$id)->first();
            return view ('front.workerPanel.task', ['data' => $data]);
        }
        else{
            return view('front.errorPage');
        }
    }

    public function taskDetail(Request $request)
    {
        $taskid = $request->route('id');
        $data = WorkerBasket::where('userId',Auth::id())->where('id',$taskid)->first();
        $task = Task::where('id',$data['taskId'])->first();
        $offerte = offerte::where('id',$data['offerteId'])->first();
        $customer = Customer::where('id',$offerte['customerId'])->first();
        $ausAdres1 = offerteAddress::where('id',$offerte['auszugaddressId'])->first();
        $ausAdres2 = offerteAddress::where('id',$offerte['auszugaddressId2'])->first();
        $ausAdres3 = offerteAddress::where('id',$offerte['auszugaddressId3'])->first();
        $einAdres1 = offerteAddress::where('id',$offerte['einzugaddressId'])->first();
        $einAdres2 = offerteAddress::where('id',$offerte['einzugaddressId2'])->first();
        $einAdres3 = offerteAddress::where('id',$offerte['einzugaddressId3'])->first();
        return view ('front.workerPanel.task.detail',[
            'data' => $data, 
            'task' => $task,
            'offerte' => $offerte,
            'customer' => $customer,
            'ausAdres1' => $ausAdres1,
            'ausAdres2' => $ausAdres2,
            'ausAdres3' => $ausAdres3,
            'einAdres1' => $einAdres1,
            'einAdres2' => $einAdres2,
            'einAdres3' => $einAdres3,
        ]);
    }


    public function taskEdit($userId,$id, Request $request)
    {
        $taskid = $request->route('id');
        $c = WorkerBasket::where('userId',Auth::id())->where('id',$taskid)->count();
        if($c != 0 )
        {
            $data = WorkerBasket::where('userId',Auth::id())->where('id',$id)->first();
            $task = Task::where('id',$data['taskId'])->first();
            return view ('front.workerPanel.task.edit', ['data' => $data,'task' => $task]);
        }
        else {
            return view('front.errorPage');
        }
    }

    public function taskUpdate(Request $request)
    {
        $id = $request->route('id');
        $userId = $request->route('userId');
        $c = WorkerBasket::where('id',$id)->where('userId',$userId)->count();
        if($c !=0)
        {
            $update = WorkerBasket::where('id',$id)->update([
                'workerHour' => $request->workerHour,
            ]);

            if($update) {
                $data = Worker::where('userId',Auth::id())->first();
                return redirect()->route('workerPanel.task',['id' => Auth::id(),'data' => $data, ])->with('status','Saat Güncellendi');
            }
            else {
                return redirect()->back()->with('status2','HATA:Saat Güncellenemedi');
            }
        }
    }

    public function profileEdit($id)
    {
        $c = Worker::where('userId',$id)->count();
        if($c != 0)
        {
            $data = Worker::where('userId',$id)->first();
            return view('front.workerPanel.profile.edit',['data' => $data]);
        }
        else{
            return view('front.errorPage');
        }
        
    }
    public function profileUpdate(Request $request)
    {
        $id = Auth::id();
        $c = Worker::where('userId',$id)->count();
        $worker = Worker::where('userId',$id)->first();
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
        $update = Worker::where('id',$worker['id'])->update($workerArr);
    
        $emailData = [
            'name' => $request->name,
            'surname' => $request->surname,
            'sub' => 'Ihre Panel-Anmeldeinformationen wurden aktualisiert',
            'from' => Company::InfoCompany('email'),
            'companyName' => Company::InfoCompany('name'),
            'email' => $request->email,
            'password' => $request->password
        ];

        if($update) {
            if($request->password != "")
            {
                Mail::to($emailData['email'])->send(new WorkerMail($emailData));
            }
            return redirect()->back()->with('status','Profil Bilgileriniz Güncellendi');
        }
        else {
            return redirect()->back()->with('status2','HATA:Profil Bilgileriniz Güncellenemedi');
        }
        
    }
    
}
