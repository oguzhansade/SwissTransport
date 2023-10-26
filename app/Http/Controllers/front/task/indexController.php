<?php

namespace App\Http\Controllers\front\task;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\offerte;
use App\Models\ReceiptUmzug;
use App\Models\Task;
use App\Models\Worker;
use App\Models\WorkerBasket;
use Carbon\Carbon;
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

        ->editColumn('created_at', function ($data) {
            $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s');
            return $formatedDate;
        })

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
            '"><i class="feather feather-eye" ></i></a> <span class="text-primary"></span>
            <a class="btn btn-sm  btn-edit" href="'.route('task.edit',['id'=>$table->id]).'"><i class="feather feather-edit" ></i></a> <span class="text-primary"></span>
            <a class="btn btn-sm  btn-danger"  href="'.route('task.delete',['id'=>$table->id]).'"><i class="feather feather-trash-2" ></i></a>';
        })
        ->addColumn('selector',function($table) 
        {
            return '<input id="deleteInput" class="form-control deleteInput text-center" onchange="onCheckBoxChange(this)" type="checkbox" value="'.$table->id.'">';
        })
           
        ->rawColumns(['option','delete','detail','selector'])
        ->make(true);

        return $data;
    }

    public function createFromReceipt(Request $request)
    {
        $receiptUmzugId = $request->route('id');
        $c = ReceiptUmzug::where('id',$receiptUmzugId)->count();
        $receiptUmzug = ReceiptUmzug::where('id',$receiptUmzugId)->first();
        if($c != 0)
        {
            return view ('front.task.createFromReceipt',['receipt' => $receiptUmzug]);
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
            'receiptUmzugId' => $request->receiptUmzugId,
            'taskDate' => $request->taskDate,
            'taskTime' => $request->taskTime,
            'taskTotalPrice' => $request->taskTotalPrice,
        ];

        $taskCreate = Task::create($task);
        $taskIdBul = DB::table('tasks')->orderBy('id','DESC')->first();
        $taskId = $taskIdBul->id;
        $expense = [
            'quittungId' => $request->receiptUmzugId,
            'exType' => 'Umzug',
            'expenseName' => 'Arbeiter',
            'expenseValue' => $request->taskTotalPrice,
        ];
        $expenseCreate = Expense::create($expense);
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
                        'receiptUmzugId' => $request->receiptUmzugId,
                        'taskId' => $taskId,
                        'workerId' => $v['workerId'],
                        'userId' => $userId,
                        'workerName' => $name.' '.$surname,
                        'workerPrice' => $v['tutar'],
                        'workHour' => $v['saat'],
                        'workerHour' => 0,
                        'totalPrice' => $v['toplam'],
                        'payStatus' => isset($v['prePaid']) ? 1 : 0
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
            'receiptUmzugId' => $request->receiptUmzugId,
            'taskDate' => $request->taskDate,
            'taskTime' => $request->taskTime,
            'taskTotalPrice' => $request->taskTotalPrice,
        ];
        $expense = [
            'quittungId' => $request->receiptUmzugId,
            'exType' => 'Umzug',
            'expenseName' => 'Arbeiter',
            'expenseValue' => $request->taskTotalPrice,
        ];
        $findExpense = Expense::where('id',$request->receiptUmzugId)->count();
        if($findExpense != 0)
        {
            $expenseData = Expense::where('id',$request->receiptUmzugId)->first();
            $expenseUpdate = Expense::where('id',$expenseData['id'])->update($expense);
        }
        else {
            $expenseCreate = Expense::create($expense);
        }
        
        
        $taskUpdate = Task::where('id',$id)->update($task);
        if($taskUpdate && $all['islem'])
        {
            
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
                        'receiptUmzugId' => $request->receiptUmzugId,
                        'taskId' => $id,
                        'workerId' => $v['workerId'],
                        'userId' => $userId,
                        'workerName' => $name.' '.$surname,
                        'workerPrice' => $v['tutar'],
                        'workHour' => $v['saat'],
                        'totalPrice' => $v['toplam'],
                        'payStatus' => isset($v['prePaid']) ? 1 : 0
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
            WorkerBasket::where('taskId','=',$id)->delete();
            return redirect()->back()->with('status','Görev Silindi');
        }
        else {
            return redirect()->back()->with('status2','HATA:Görev Silinemedi');
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->taskIds;

        if(!empty($ids)) {
            $bulkTask = Task::whereIn('id',$ids)->delete();
            $bulkWorkerBasket = WorkerBasket::whereIn('taskId',$ids)->delete();
            return response()->json(['message' => 'Seçilen tasklar başarıyla silindi.']);
        } else {
            return response()->json(['message' => 'Silinecek tasklar belirtilmedi.'],400);
        }
    }
}
