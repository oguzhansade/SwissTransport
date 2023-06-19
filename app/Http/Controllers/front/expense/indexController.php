<?php

namespace App\Http\Controllers\front\expense;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ReceiptReinigung;
use App\Models\ReceiptUmzug;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function editUmzug($id)
    {
        $receipt = ReceiptUmzug::where('id',$id)->first();
        $expenses = Expense::where('quittungId',$id)->count();
        $expense = Expense::where('quittungId',$id)->get();
        $expenseArray =  [
            'Möbellift Miete',
            'Lieferwagen Miete',
            'Schutzmaterial',
            'Schaden',
            'Busse',
            'Entgegenkommen',
            'Arbeiter',
            'Diesel',
            'Other'
        ];
        if($expenses > 0){
            return view('front.expense.editUmzug',['data'=>$receipt,'expense' => $expense,'expenseList' => $expenseArray]);
        }
        return view('front.expense.editUmzug',['data'=>$receipt,'expense' => $expense]);
    }

    public function editReinigung($id)
    {
        $receipt = ReceiptReinigung::where('id',$id)->first();
        $expenses = Expense::where('quittungId',$id)->count();
        $expense = Expense::where('quittungId',$id)->get();
        $expenseArray =  [
            'Möbellift Miete',
            'Lieferwagen Miete',
            'Schutzmaterial',
            'Schaden',
            'Busse',
            'Entgegenkommen',
            'Arbeiter',
            'Diesel',
            'Other'
        ];
        if($expenses > 0){
            return view('front.expense.editReinigung',['data'=>$receipt,'expense' => $expense,'expenseList' => $expenseArray]);
        }
        return view('front.expense.editReinigung',['data'=>$receipt,'expense' => $expense]);
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
                        'offerId' => $receipt['offerId'],
                        'exType' => 'Umzug',
                        'expenseName' => $v['expense'],
                        'expenseValue' => $v['expenseValue'],
                    ];
                    
                    $create = Expense::create($expense);
                    
                }
            }
            $receiptUpdate = [
                'expensePrice' => $request->totalExpense
            ];
            $receiptUpdater = ReceiptUmzug::where('id',$id)->update($receiptUpdate);
        }
        
        if($receiptUpdater)
        {
            return redirect()
            ->route('customer.detail', ['id' => $receipt['customerId']])
            ->with('status','Makbuz Giderleri Başarıyla Eklendi.'.' '.'Makbuz NO:'.' '.$receipt['offerId'].'.'.$id)
            ->with('cat', 'Quittung')
            ->withInput()
            ->with('keep_status', true);
        }
        else {
            return redirect()->back()->with('status2','Hata:Makbuz Giderleri Girilemedi');
        }
    }

    public function updateUmzug(Request $request)
    {
        $id = request()->route('id');
        $receipt = ReceiptUmzug::where('id',$id)->first();
        $all = $request->except('_token');
        if($receipt && $all['islem'])
        {
            
            $islem = $all['islem'];
            unset($all['islem']);
            if(count($islem) !=0) {
                Expense::where('quittungId','=',$id)->where('exType','=', 'Umzug')->where('offerId', '=', $receipt['offerId'])->delete();
                foreach($islem as $k => $v)
                {
                    $quittungId =  $id;
                    
                    $expense = [
                        'quittungId' => $quittungId,
                        'offerId' => $receipt['offerId'],
                        'exType' => 'Umzug',
                        'expenseName' => $v['expense'],
                        'expenseValue' => $v['expenseValue'],
                    ];
                    
                    $update = Expense::create($expense);
                    
                }
            }
                
            $receiptUpdate = [
                'expensePrice' => $request->totalExpense
            ];
            $receiptUpdater = ReceiptUmzug::where('id',$id)->update($receiptUpdate);
        }
        
        if($receiptUpdater)
        {
            return redirect()
            ->route('customer.detail', ['id' => $receipt['customerId']])
            ->with('status','Makbuz Giderleri Başarıyla Güncellendi.'.' '.'Makbuz NO:'.' '.$receipt['offerId'].'.'.$id)
            ->with('cat', 'Quittung')
            ->withInput()
            ->with('keep_status', true);
        }
        else {
            return redirect()->back()->with('status2','Hata:Makbuz Giderleri Güncellenemedi');
        }
    }

    public function updateReinigung(Request $request)
    {
        $id = request()->route('id');
        $receipt = ReceiptReinigung::where('id',$id)->first();
        $all = $request->except('_token');
        if($receipt && $all['islem'])
        {
            
            $islem = $all['islem'];
            unset($all['islem']);
            if(count($islem) !=0) {
                Expense::where('quittungId','=',$id)->where('exType','=', 'Reinigung')->where('offerId', '=', $receipt['offerId'])->delete();
                foreach($islem as $k => $v)
                {
                    $quittungId =  $id;
                    
                    $expense = [
                        'quittungId' => $quittungId,
                        'offerId' => $receipt['offerId'],
                        'exType' => 'Reinigung',
                        'expenseName' => $v['expense'],
                        'expenseValue' => $v['expenseValue'],
                    ];
                    
                    $update = Expense::create($expense);
                    
                }
            }
                
            $receiptUpdate = [
                'expensePrice' => $request->totalExpense
            ];
            $receiptUpdater = ReceiptReinigung::where('id',$id)->update($receiptUpdate);
        }
        
        if($receiptUpdater)
        {
            return redirect()
            ->route('customer.detail', ['id' => $receipt['customerId']])
            ->with('status','Makbuz Giderleri Başarıyla Güncellendi.'.' '.'Makbuz NO:'.' '.$receipt['offerId'].'.'.$id)
            ->with('cat', 'Quittung')
            ->withInput()
            ->with('keep_status', true);
        }
        else {
            return redirect()->back()->with('status2','Hata:Makbuz Giderleri Güncellenemedi');
        }
    }

    public function deleteUmzug(Request $request)
    {
        $id = request()->route('id');
        $receipt = ReceiptUmzug::where('id',$id)->first();
        $delete = Expense::where('quittungId','=',$id)->where('exType','=','Umzug')->delete();
        $receiptUpdate = [
            'expensePrice' => $request->totalExpense
        ];
        $receiptUpdater = ReceiptUmzug::where('id',$id)->update($receiptUpdate);
        
        if($delete)
        {
            return redirect()
            ->route('customer.detail', ['id' => $receipt['customerId']])
            ->with('status','Makbuz Giderleri Başarıyla Silindi.'.' '.'Makbuz NO:'.' '.$receipt['offerId'].'.'.$id)
            ->with('cat', 'Quittung')
            ->withInput()
            ->with('keep_status', true);
        }
        else {
            return redirect()->back()->with('status2','Hata:Makbuz Giderleri Silinemedi');
        }
    }
    public function deleteReinigung(Request $request)
    {
        $id = request()->route('id');
        $receipt = ReceiptReinigung::where('id',$id)->first();
        $delete = Expense::where('quittungId','=',$id)->where('exType','=','Reinigung')->delete();
        $receiptUpdate = [
            'expensePrice' => $request->totalExpense
        ];
        $receiptUpdater = ReceiptReinigung::where('id',$id)->update($receiptUpdate);
        
        if($delete)
        {
            return redirect()
            ->route('customer.detail', ['id' => $receipt['customerId']])
            ->with('status','Makbuz Giderleri Başarıyla Silindi.'.' '.'Makbuz NO:'.' '.$receipt['offerId'].'.'.$id)
            ->with('cat', 'Quittung')
            ->withInput()
            ->with('keep_status', true);
        }
        else {
            return redirect()->back()->with('status2','Hata:Makbuz Giderleri Silinemedi');
        }
    }

    public function createReinigung($id)
    {
        $receipt = ReceiptReinigung::where('id',$id)->first();
        return view('front.expense.createReinigung',['data'=>$receipt]);
    }
}
