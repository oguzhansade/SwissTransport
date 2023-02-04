<?php

namespace App\Http\Controllers\front\task;

use App\Http\Controllers\Controller;
use App\Models\offerte;
use App\Models\Task;
use App\Models\Worker;
use App\Models\WorkerBasket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class indexController extends Controller
{
    public function index()
    {
        return view ('front.task.index');
    }

    public function data(Request $request)
    {

        $table=Task::query();  
        $data=DataTables::of($table)
        
        ->editColumn('taskDate', function($data) {
            $taskDate = $data->taskDate.' '.$data->taskTime;
            return $taskDate;
        })
        ->editColumn('taskTotalPrice', function($data){ 
            if($data->taskTotalPrice)
            {
                return 'CHF'.' '.$data->taskTotalPrice;
            }
            else
            {
                return 'CHF'.' '.'0';
            }
            
        })
        ->addColumn('option',function($table) 
        {
            return '
            <a class="btn btn-sm  btn-primary" href="'.
            route('task.detail',['id'=>$table->id]).
            '"><i class="feather feather-eye" ></i></a> <span class="text-primary">|</span>
            <a class="btn btn-sm  btn-edit" href="'.route('task.edit',['id'=>$table->id]).'"><i class="feather feather-edit" ></i></a> <span class="text-primary">|</span>
            <a class="btn btn-sm  btn-danger"  href="'.route('task.delete',['id'=>$table->id]).'"><i class="feather feather-trash-2" ></i></a>';
        })
           
        ->rawColumns(['option','delete','detail'])
        ->make(true);

        return $data;
    }

    public function createFromOffer(Request $request)
    {
        $offerId = $request->route('id');
        $c = offerte::where('id',$offerId)->count();
        $offer = offerte::where('id',$offerId)->first();
        if($c != 0)
        {
            return view ('front.task.createFromOffer',['offer' => $offer]);
        }
        else{
            return view('front.errorPage');
        }
    }

    public function create(Request $request)
    {
        return view ('front.task.create');
    }

    public function store(Request $request)
    {
        $taskId = 0;
        $all = $request->except('_token');

        $task = [
            'offerteId' => $request->offerteId,
            'taskDate' => $request->taskDate,
            'taskTime' => $request->taskTime,
            'taskTotalPrice' => $request->taskTotalPrice,
        ];

        $taskCreate = Task::create($task);
        $taskIdBul = DB::table('tasks')->orderBy('id','DESC')->first();
        $taskId = $taskIdBul->id;

        if($taskCreate)
        {
            $islem = $all['islem'];
            unset($all['islem']);
            if(count($islem) !=0) {
                foreach($islem as $k => $v)
                {
                    $worker = Worker::where('id',$v['workerId'])->first();
                    $userId = $worker['userId'];
                    $surname = $worker['surname'];
                    $name = $worker['name'];
                    
                    $workerBasket = [
                        'offerteId' => $request->offerteId,
                        'taskId' => $taskId,
                        'workerId' => $v['workerId'],
                        'userId' => $userId,
                        'workerName' => $name.' '.$surname,
                        'workerPrice' => $v['tutar'],
                        'workHour' => $v['saat'],
                        'workerHour' => 0,
                        'totalPrice' => $v['toplam'],
                    ];
                    
                    $create = WorkerBasket::create($workerBasket);
                }
            }
        }
                    
        if($create)
        {
            return redirect()->back()->with('status','Görev Başarıyla Eklendi');
        }
        else {
            return redirect()->back()->with('status2','Hata:Görev Eklenemedi');
        }
                    
    }

    public function edit(Request $request)
    {
        $id = $request->route('id');
        $c = Task::where('id',$id)->count();
        
        if($c !=0)
        {
            $data = Task::where('id',$id)->first();
            $basket = WorkerBasket::where('taskId',$data['id'])->get();
            return view ('front.task.edit', ['data' => $data,'basket' => $basket]);
        }
    }

    public function detail(Request $request)
    {
        $id = $request->route('id');
        $c = Task::where('id',$id)->count();
        
        if($c !=0)
        {
            $data = Task::where('id',$id)->first();
            $basket = WorkerBasket::where('taskId',$data['id'])->get();
            return view ('front.task.detail', ['data' => $data,'basket' => $basket]);
        }
    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $d = Task::where('id',$id)->first();
        $all = $request->except('_token');

        $task = [
            'offerteId' => $request->offerteId,
            'taskDate' => $request->taskDate,
            'taskTime' => $request->taskTime,
            'taskTotalPrice' => $request->taskTotalPrice,
        ];

        $taskUpdate = Task::where('id',$id)->update($task);
        if($taskUpdate && $all['islem'])
        {
           $all = $request->except('_token');
            $islem = $all['islem'];
            unset($all['islem']);
            if(count($islem) !=0) {
                WorkerBasket::where('taskId','=',$id)->delete();
                foreach($islem as $k => $v)
                {
                    $worker = Worker::where('id',$v['workerId'])->first();
                    $userId = $worker['userId'];
                    $surname = $worker['surname'];
                    $name = $worker['name'];
                    
                    $workerBasket = [
                        'offerteId' => $request->offerteId,
                        'taskId' => $id,
                        'workerId' => $v['workerId'],
                        'userId' => $userId,
                        'workerName' => $name.' '.$surname,
                        'workerPrice' => $v['tutar'],
                        'workHour' => $v['saat'],
                        'totalPrice' => $v['toplam'],
                    ];
                    
                    $update = WorkerBasket::create($workerBasket);
                }
            }
        }
        

        if($update) {
            return redirect()->back()->with('status','Görev Güncellendi');
        }
        else {
            return redirect()->back()->with('status2','HATA:Görev Güncellenemedi');
        }
          
    }
 
        
    

    public function delete($id)
    {

        $c = Task::where('id',$id)->count();
        if($c !=0)
        {
            $data = Task::where('id',$id)->get();
            Task::where('id',$id)->delete();
            return redirect()->back()->with('status','Görev Silindi');
        }
        else {
            return redirect()->back()->with('status2','HATA:Görev Silinemedi');
        }
    }
}
