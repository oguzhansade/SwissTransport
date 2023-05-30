<?php

namespace App\Http\Controllers\front\expense;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ReceiptReinigung;
use App\Models\ReceiptUmzug;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function createUmzug($id)
    {
        $receipt = ReceiptUmzug::where('id',$id)->first();
        return view('front.expense.createUmzug',['data'=>$receipt]);
    }

    public function storeUmzug(Request $request)
    {
        $id = request()->route('id');
        $receipt = ReceiptUmzug::where('id',$id)->first();
        $all = $request->except('_token');

        if($receipt)
        {
            $islem = $all['islem'];
            unset($all['islem']);
            if(count($islem) !=0) {
                foreach($islem as $k => $v)
                {
                    $quittungId =  $receipt['id'];
                    
                    $expense = [
                        'quittungId' => $quittungId,
                        'expenseName' => $v['expense'],
                        'expenseValue' => $v['expenseValue'],
                    ];
                    
                    $create = Expense::create($expense);
                }
            }
        }
        
    }

    public function createReinigung($id)
    {
        $receipt = ReceiptReinigung::where('id',$id)->first();
        return view('front.expense.createReinigung',['data'=>$receipt]);
    }
}
