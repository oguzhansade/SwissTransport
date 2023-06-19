<?php

namespace App\Http\Controllers\front\receipt;

use App\Http\Controllers\Controller;
use App\Mail\ReceiptReinigungMail;
use App\Mail\ReceiptStandartMail;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\offerte;
use App\Models\ReceiptDiscount;
use App\Models\ReceiptExtra;
use App\Models\ReceiptAddress;
use App\Models\ReceiptUmzug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;



class indexController extends Controller
{
    public function createStandart($id,$customer)
    {
        $offer = offerte::where('id',$id)->first();
        $data = Customer::where('id',$customer)->first();
        return view('front.receipt.create',['offer'=>$offer,'data'=>$data]);
    }
    
    public function edit(Request $request)
    {
        $id = $request->route('id');
        $c = ReceiptUmzug::where('id',$id)->count();

        if($c !=0)
        {
            $data = ReceiptUmzug::where('id',$id)->first();
            $data2 = Customer::where('id',$data['customerId'])->first();
            return view ('front.receipt.edit', ['data' => $data,'data2' => $data2]);
        }
    }

    public function detail(Request $request)
    {
        $id = $request->route('id');
        $c = ReceiptUmzug::where('id',$id)->count();

        if($c !=0)
        {
            $data = ReceiptUmzug::where('id',$id)->first();
            $data2 = Customer::where('id',$data['customerId'])->first();
            return view ('front.receipt.detail', ['data' => $data,'data2' => $data2]);
        }
    }

    public function update (Request $request)
    {
        $id = $request->route('id');
        $c = ReceiptUmzug::where('id',$id)->count();
        $d = ReceiptUmzug::where('id',$id)->first();
        $all = $request->except('_token');
        $isCustomEmailSend = $request->get('isCustomEmail');
        $customEmail = $request->get('customEmail');

        // Mail Variables
            $mailSuccess = NULL;
            $isEmailSend = $request->get('isEmail');
            $isCustomEmailSend = $request->get('isCustomEmail');
            $customEmail = $request->get('customEmail');
        // Mail Variables

        $customer = Customer::where('id','=',$d['customerId'])->first();
        $offer = offerte::where('id','=',$d['offerId'])->first();

        $auszugId1 = $d['auszugId1'] ? $d['auszugId1'] : NULL;
        $auszugId2 = $d['auszugId2'] ? $d['auszugId2'] : NULL;
        $auszugId3 = $d['auszugId3'] ? $d['auszugId3'] : NULL;
        $einzugId1 = $d['einzugId1'] ? $d['einzugId1'] : NULL;
        $einzugId2 = $d['einzugId2'] ? $d['einzugId2'] : NULL;
        $einzugId3 = $d['einzugId3'] ? $d['einzugId3'] : NULL;
        $receiptExtraId = $d['receiptExtraId'] ? $d['receiptExtraId'] : NULL;
        $receiptDiscountId = $d['receiptDiscountId'] ? $d['receiptDiscountId'] : NULL;

        // Auszug Adresleri
            if($auszugId1)
            {
                $auszug1 = [
                    'addressType' => 0,
                    'line1' => $request->aus1Street,
                    'line2' => $request->aus1PostCode
                ];
                ReceiptAddress::where('id',$auszugId1)->update($auszug1);
            }
            else
            {
                $auszug1 = [
                    'addressType' => 0,
                    'line1' => $request->aus1Street,
                    'line2' => $request->aus1PostCode
                ];

                ReceiptAddress::create($auszug1);
                $auszug1 = DB::table('receipt_addresses')->where('addressType' ,'=', 0)->orderBy('id','DESC')->first();
                $auszugId1 = $auszug1->id;
            }
            

            if($auszugId2)
            {
                $auszug2 = [
                    'addressType' => 0,
                    'line1' => $request->aus2Street,
                    'line2' => $request->aus2PostCode
                ];
                ReceiptAddress::where('id',$auszugId2)->update($auszug2);
            }
            else
            {
                $auszug2 = [
                    'addressType' => 0,
                    'line1' => $request->aus2Street,
                    'line2' => $request->aus2PostCode
                ];

                ReceiptAddress::create($auszug2);
                $auszug2 = DB::table('receipt_addresses')->where('addressType' ,'=', 0)->orderBy('id','DESC')->first();
                $auszugId2 = $auszug2->id;
            }

            if($auszugId3)
            {
                $auszug3 = [
                    'addressType' => 0,
                    'line1' => $request->aus3Street,
                    'line2' => $request->aus3PostCode
                ];
                ReceiptAddress::where('id',$auszugId3)->update($auszug3);
            }
            else
            {
                $auszug3 = [
                    'addressType' => 0,
                    'line1' => $request->aus3Street,
                    'line2' => $request->aus3Street
                ];

                ReceiptAddress::create($auszug3);
                $auszug3 = DB::table('receipt_addresses')->where('addressType' ,'=', 0)->orderBy('id','DESC')->first();
                $auszugId3 = $auszug3->id;
            }
        // Auszug Adresleri

        // Einzug Adresleri
            if($einzugId1)
            {
                $einzug1 = [
                    'addressType' => 1,
                    'line1' => $request->ein1Street,
                    'line2' => $request->ein1PostCode
                ];
                ReceiptAddress::where('id',$einzugId1)->update($einzug1);
            }
            else
            {
                $einzug1 = [
                    'addressType' => 1,
                    'line1' => $request->ein1Street,
                    'line2' => $request->ein1PostCode
                ];

                ReceiptAddress::create($einzug1);
                $einzug1 = DB::table('receipt_addresses')->where('addressType' ,'=', 1)->orderBy('id','DESC')->first();
                $einzugId1 = $einzug1->id;
            }

            if($einzugId2)
            {
                $einzug2 = [
                    'addressType' => 1,
                    'line1' => $request->ein2Street,
                    'line2' => $request->ein2PostCode
                ];
                ReceiptAddress::where('id',$einzugId2)->update($einzug2);
            }
            else
            {
                $einzug2 = [
                    'addressType' => 1,
                    'line1' => $request->ein2Street,
                    'line2' => $request->ein2PostCode
                ];

                ReceiptAddress::create($einzug2);
                $einzug2 = DB::table('receipt_addresses')->where('addressType' ,'=', 1)->orderBy('id','DESC')->first();
                $einzugId2 = $einzug2->id;
            }

            if($einzugId3)
            {
                $einzug3 = [
                    'addressType' => 1,
                    'line1' => $request->ein3Street,
                    'line2' => $request->ein3PostCode
                ];
                ReceiptAddress::where('id',$einzugId3)->update($einzug3);
            }
            else
            {
                $einzug3 = [
                    'addressType' => 1,
                    'line1' => $request->ein3Street,
                    'line2' => $request->ein3PostCode
                ];

                ReceiptAddress::create($einzug3);
                $einzug3 = DB::table('receipt_addresses')->where('addressType' ,'=', 1)->orderBy('id','DESC')->first();
                $einzugId3 = $einzug3->id;
            }

        // Einzug Adresleri

        // Extralar
         if($receiptExtraId)
         {
            $extra = [
                'extra1Text' => $request->addCost1Text,
                'extra1' => $request->addCost1,
                'extra2Text' => $request->addCost2Text,
                'extra2' => $request->addCost2,
                'extra3Text' => $request->addCost3Text,
                'extra3' => $request->addCost3,
                'extra4Text' => $request->addCost4Text,
                'extra4' => $request->addCost4,
                'extra5Text' => $request->addCost5Text,
                'extra5' => $request->addCost5,
                'extra6Text' => $request->addCost6Text,
                'extra6' => $request->addCost6,
                'extra7Text' => $request->addCost7Text,
                'extra7' => $request->addCost7,
                'extra8Text' => $request->addCost8Text,
                'extra8' => $request->addCost8,
                'extra9Text' => $request->addCost9Text,
                'extra9' => $request->addCost9,
                'extra10Text' => $request->addCost10Text,
                'extra10' => $request->addCost10,
                'extra11Text' => $request->addCost11Text,
                'extra11' => $request->addCost11,
                'extra12Text' => $request->addCost12Text,
                'extra12' => $request->addCost12,
                'extra13Text' => $request->addCost13Text,
                'extra13' => $request->addCost13,
                'extra14Text' => $request->addCost14Text,
                'extra14' => $request->addCost14,
                'extra15Text' => $request->addCost15Text,
                'extra15' => $request->addCost15,
                'extra16Text' => $request->addCost16Text,
                'extra16' => $request->addCost16, 
            ];
            ReceiptExtra::where('id',$receiptExtraId)->update($extra);
         }
         else
         {
            $extra = [
                'extra1Text' => $request->addCost1Text,
                'extra1' => $request->addCost1,
                'extra2Text' => $request->addCost2Text,
                'extra2' => $request->addCost2,
                'extra3Text' => $request->addCost3Text,
                'extra3' => $request->addCost3,
                'extra4Text' => $request->addCost4Text,
                'extra4' => $request->addCost4,
                'extra5Text' => $request->addCost5Text,
                'extra5' => $request->addCost5,
                'extra6Text' => $request->addCost6Text,
                'extra6' => $request->addCost6,
                'extra7Text' => $request->addCost7Text,
                'extra7' => $request->addCost7,
                'extra8Text' => $request->addCost8Text,
                'extra8' => $request->addCost8,
                'extra9Text' => $request->addCost9Text,
                'extra9' => $request->addCost9,
                'extra10Text' => $request->addCost10Text,
                'extra10' => $request->addCost10,
                'extra11Text' => $request->addCost11Text,
                'extra11' => $request->addCost11,
                'extra12Text' => $request->addCost12Text,
                'extra12' => $request->addCost12,
                'extra13Text' => $request->addCost13Text,
                'extra13' => $request->addCost13,
                'extra14Text' => $request->addCost14Text,
                'extra14' => $request->addCost14,
                'extra15Text' => $request->addCost15Text,
                'extra15' => $request->addCost15,
                'extra16Text' => $request->addCost16Text,
                'extra16' => $request->addCost16, 
            ];

            ReceiptExtra::create($extra);
            $extraIdBul = DB::table('receipt_extras')->orderBy('id','DESC')->first();
            $receiptExtraId = $extraIdBul->id;
         }
        // Extralar

        // Discountlar
         if($receiptDiscountId)
         {
            $discount = [
                'discount1Text' => $request->addDiscount1Text,
                'discount1' => $request->addDiscount1,
                'discount2Text' => $request->addDiscount2Text,
                'discount2' => $request->addDiscount2,
                'discount3Text' => $request->addDiscount3Text,
                'discount3' => $request->addDiscount3,
                'discount4Text' => $request->addDiscount4Text,
                'discount4' => $request->addDiscount4,
                'discount5Text' => $request->addDiscount5Text,
                'discount5' => $request->addDiscount5,
                'discount6Text' => $request->addDiscount6Text,
                'discount6' => $request->addDiscount6,
                'discount7Text' => $request->addDiscount7Text,
                'discount7' => $request->addDiscount7,
            ];
            ReceiptDiscount::where('id',$receiptDiscountId)->update($discount);
         }
         else
         {
            $discount = [
                'discount1Text' => $request->addDiscount1Text,
                'discount1' => $request->addDiscount1,
                'discount2Text' => $request->addDiscount2Text,
                'discount2' => $request->addDiscount2,
                'discount3Text' => $request->addDiscount3Text,
                'discount3' => $request->addDiscount3,
                'discount4Text' => $request->addDiscount4Text,
                'discount4' => $request->addDiscount4,
                'discount5Text' => $request->addDiscount5Text,
                'discount5' => $request->addDiscount5,
                'discount6Text' => $request->addDiscount6Text,
                'discount6' => $request->addDiscount6,
                'discount7Text' => $request->addDiscount7Text,
                'discount7' => $request->addDiscount7,
            ];

            ReceiptDiscount::create($discount);
            $discountIdBul = DB::table('receipt_discounts')->orderBy('id','DESC')->first();
            $receiptDiscountId = $discountIdBul->id;
         }
        // Discountlar

        $receiptStandart = [
            'customerId' => $d['customerId'],
            'offerId' => $d['offerId'],
            'receiptType' => 0,
            'payType' => 'Rechnung',
            'status' => $request->status,
            'customerGender' => $request->customerGender,
            'customerName' => $request->customerName,
            'customerStreet' => $request->customerStreet,
            'customerAddress' => $request->customerPostCode,
            'customerPhone' => $request->customerPhone,
            'auszugId1' => $auszugId1,
            'auszugId2' => $auszugId2,
            'auszugId3' => $auszugId3,
            'einzugId1' => $einzugId1,
            'einzugId2' => $einzugId2,
            'einzugId3' => $einzugId3,
            'receiptExtraId' => $receiptExtraId,
            'receiptDiscountId' => $receiptDiscountId,
            'orderDate' => $request->umzugDate,
            'orderTime' => $request->umzugTime,
            'umzugHour' => $request->umzugHour,
            'umzugChf' => $request->umzugChf,
            'umzugTotalChf' => $request->umzugCost,
            'umzugCharge' => $request->umzugSpesenCost,
            'umzugRoadChf' => $request->umzugRoadChf,
            'materialPrice' => $request->umzugPackCost,
            'entsorgungVolume' => $request->entsorgungVolume,
            'entsorgungChf' => $request->entsorgungRate,
            'entsorgungTotalChf' => $request->entsorgungCost,
            'entsorgungFixedChf' => $request->entsorgungFixed,
            'fixedPrice' => $request->costFix,
            'topPrice' => $request->costHigh,
            'totalPrice' => $request->totalCost,
            'withTax' => $request->withTax,
            'withoutTax'=> $request->withoutTax,
            'freeTax'=> $request->freeTax,
            'inBar' => $request->payedCash,
            'inRechnung' => $request->payedBill,
            'cashPrice' => $request->payedCashCost,
            'invoicePrice' => $request->payedBillCost,
            'signerName' => $request->signatureName,
        ];

        $update = ReceiptUmzug::where('id',$id)->update($receiptStandart);

        $sub = 'Ihre Quittung ausgestellt';
        $from = Company::InfoCompany('email'); // gösterilen mail.
        $companyName = Company::InfoCompany('name'); // şirket adı buraya yaz veritabanında yok çünkü.
        $customer=DB::table('customers')->where('id','=', $d['customerId'])->value('name'); // Customer Name
        $customerSurname=DB::table('customers')->where('id','=', $d['customerId'])->value('surname');
        $gender=DB::table('customers')->where('id','=', $d['customerId'])->value('gender');// Customer Name
        $customerData =  Customer::where('id',$d['customerId'])->first();
        $receiptPdf = ReceiptUmzug::where('id',$id)->first();
        $auszug1Pdf = ReceiptAddress::where('id',$auszugId1)->first();
        $auszug2Pdf = ReceiptAddress::where('id',$auszugId2)->first();
        $auszug3Pdf = ReceiptAddress::where('id',$auszugId3)->first();
        $einzug1Pdf = ReceiptAddress::where('id',$einzugId1)->first();
        $einzug2Pdf = ReceiptAddress::where('id',$einzugId2)->first();
        $einzug3Pdf = ReceiptAddress::where('id',$einzugId3)->first();
        $extraPdf = ReceiptExtra::where('id',$receiptExtraId)->first();
        $discountPdf = ReceiptDiscount::where('id',$receiptDiscountId)->first();

        $pdfData = [
            'receiptNumber' => $id,
            'receipt' => $receiptPdf,
            'customer' => $customerData,
            'auszug1' => $auszug1Pdf,
            'auszug2' => $auszug2Pdf,
            'auszug3' => $auszug3Pdf,
            'einzug1' => $einzug1Pdf,
            'einzug2' => $einzug2Pdf,
            'einzug3' => $einzug3Pdf,
            'receiptExtra' => $extraPdf,
            'receiptDiscount' => $discountPdf,
        ];

        $pdf = Pdf::loadView('receiptUmzugPdf', $pdfData);
        $pdf->setPaper('A4');
        
        $emailData = [
            'receiptNumber' => $id,
            'name' => $customer,
            'surname' => $customerSurname,
            'gender' => $gender,
            'sub' => $sub,
            'from' => $from,
            'companyName' => $companyName,
            'email' => $request->email,
            'emailContent'=> $request->emailContent,
            'isCustomEmailSend' => $isCustomEmailSend,
            'customEmailContent' => $customEmail,
            'pdf' => $pdf,
        ];

        if ($isCustomEmailSend)
        {
            Arr::set($emailData, 'customEmailContent', $customEmail);
        }

        if($update)
        {
            $mailSuccess = '';
            if($isEmailSend)
            {
                Mail::to($emailData['email'])->send(new ReceiptStandartMail($emailData));
                $mailSuccess = ', Mail ve Makbuz Başarıyla Gönderildi';
            } 
            return redirect()
                ->route('customer.detail', ['id' => $d['customerId']])
                ->with('status','Makbuz Başarıyla Düzenlendi.'.' '.'Makbuz NO:'.' '.$id.$mailSuccess)
                ->with('cat', 'Quittung')
                ->withInput()
                ->with('keep_status', true);
        }
        else {
            return redirect()->back()->with('status','Hata:Makbuz Düzenlenemedi');
        }
    }
    public function data(Request $request)
    {
        $receiptType = $request->get('receiptType');

        $array = [];
        $i = 0;

        $customerId = $request->route('id');
        
        $table=DB::table('receipt_umzugs')->where('customerId','=', $customerId)->get()->toArray();
        if($table)
        {
            foreach($table as $k=>$v)
            {
                $array[$i]["aid"] = $i+1;
                $array[$i]["id"] = $v->id;
                $array[$i]["makbuzNo"] = $v->offerId.'.'.$v->id;
                $array[$i]["receiptType"] = 'Umzug';
                $array[$i]["orderDate"] = $v->orderDate ? date('d-m-Y', strtotime($v->orderDate)) : '-'.' '.$v->orderTime;
                $array[$i]["created_at"] = date('d-m-Y', strtotime($v->created_at));
                $array[$i]["tutar"] = $v->totalPrice;
                $array[$i]["payType"] = $v->payType;
                $array[$i]["status"] = $v->status;
                $i++;

            }
        }

        $table2 = DB::table('receipt_reinigungs')->where('customerId','=', $customerId)->get()->toArray();
        if($table2)
        {
            foreach($table2 as $k=>$v)
            {
                $array[$i]["aid"] = $i+1;
                $array[$i]["id"] = $v->id;
                $array[$i]["makbuzNo"] = $v->offerId.'.'.$v->id;
                $array[$i]["receiptType"] = 'Reinigung';
                $array[$i]["orderDate"] = $v->reinigungDate ? date('d-m-Y', strtotime($v->reinigungDate)) : '-'.' '.$v->reinigungTime;
                $array[$i]["created_at"] = date('d-m-Y', strtotime($v->created_at));
                $array[$i]["tutar"] = $v->totalPrice;
                $array[$i]["payType"] = $v->payType;
                $array[$i]["status"] = $v->status;
                $i++;

            }
        }
        $data=DataTables::of($array)

        ->editColumn('tutar', function($array) {
            return 'CHF'.' '.$array['tutar'];
        })
        ->addColumn('option',function($array) 
        {
            switch($array['receiptType'])
            {
                case('Umzug');
                    return '
                    <a class="btn btn-sm  btn-primary" href="'.route('receipt.detail',['id'=>$array['id']]).'"><i class="feather feather-eye" ></i></a> 
                    <a class="btn btn-sm  btn-edit" href="'.route('receipt.edit',['id'=>$array['id']]).'"><i class="feather feather-edit" ></i></a> 
                    <a class="btn btn-sm  btn-warning" href="'.route('expense.editUmzug',['id'=>$array['id']]).'"><i class="feather feather-info" ></i></a>
                    <a class="btn btn-sm  btn-danger"  href="'.route('receipt.delete',['id'=>$array['id']]).'"><i class="feather feather-trash-2" ></i></a>';
                break;
                case('Reinigung');
                    return '
                    <a class="btn btn-sm  btn-primary" href="'.route('receiptReinigung.detail',['id'=>$array['id']]).'"><i class="feather feather-eye" ></i></a> 
                    <a class="btn btn-sm  btn-edit" href="'.route('receiptReinigung.edit',['id'=>$array['id']]).'"><i class="feather feather-edit" ></i></a> 
                    <a class="btn btn-sm  btn-warning" href="'.route('expense.editReinigung',['id'=>$array['id']]).'"><i class="feather feather-info" ></i></a>
                    <a class="btn btn-sm  btn-danger"  href="'.route('receiptReinigung.delete',['id'=>$array['id']]).'"><i class="feather feather-trash-2" ></i></a>';
                break;
            }
        })
        ->rawColumns(['option'])
        ->make(true);

        return $data;
    }

    public function storeStandart(Request $request)
    {
        $auszugId1 = NULL;
        $auszugId2 = NULL;
        $auszugId3 = NULL;
        $einzugId1 = NULL;
        $einzugId2 = NULL;
        $einzugId3 = NULL;
        $extraId = NULL;
        $discountId = NULL;
        $customerId = $request->route('customer');
        $offerId = $request->route('id');

        // Mail Variables
            $mailSuccess = NULL;
            $isEmailSend = $request->get('isEmail');
            $isCustomEmailSend = $request->get('isCustomEmail');
            $customEmail = $request->get('customEmail');
        // Mail Variables

        // Auszug Adresleri
            if($request->aus1Street)
            {
                $auszug1 = [
                    'addressType' => 0,
                    'line1' => $request->aus1Street,
                    'line2' => $request->aus1PostCode
                ];
                ReceiptAddress::create($auszug1);
                $auszug1 = DB::table('receipt_addresses')->where('addressType' ,'=', 0)->orderBy('id','DESC')->first();
                $auszugId1 = $auszug1->id;
            }
            if($request->aus2Street)
            {
                $auszug2 = [
                    'addressType' => 0,
                    'line1' => $request->aus2Street,
                    'line2' => $request->aus2PostCode
                ];
                ReceiptAddress::create($auszug2);
                $auszug2 = DB::table('receipt_addresses')->where('addressType' ,'=', 0)->orderBy('id','DESC')->first();
                $auszugId2 = $auszug2->id;
            }
            if($request->aus3Street)
            {
                $auszug3 = [
                    'addressType' => 0,
                    'line1' => $request->aus3Street,
                    'line2' => $request->aus3PostCode
                ];
                ReceiptAddress::create($auszug3);
                $auszug3 = DB::table('receipt_addresses')->where('addressType' ,'=', 0)->orderBy('id','DESC')->first();
                $auszugId3 = $auszug3->id;
            }
        // Auszug Adresleri

        // Einzug Adresleri
            if($request->ein1Street)
            {
                $einzug1 = [
                    'addressType' => 1,
                    'line1' => $request->ein1Street,
                    'line2' => $request->ein1PostCode
                ];
                ReceiptAddress::create($einzug1);
                $einzug1 = DB::table('receipt_addresses')->where('addressType' ,'=', 1)->orderBy('id','DESC')->first();
                $einzugId1 = $einzug1->id;
            }
            if($request->ein2Street)
            {
                $einzug2 = [
                    'addressType' => 1,
                    'line1' => $request->ein2Street,
                    'line2' => $request->ein2PostCode
                ];
                ReceiptAddress::create($einzug2);
                $einzug2 = DB::table('receipt_addresses')->where('addressType' ,'=', 1)->orderBy('id','DESC')->first();
                $einzugId2 = $einzug2->id;
            }
            if($request->ein3Street)
            {
                $einzug3 = [
                    'addressType' => 1,
                    'line1' => $request->ein3Street,
                    'line2' => $request->ein3PostCode
                ];
                ReceiptAddress::create($einzug3);
                $einzug3 = DB::table('receipt_addresses')->where('addressType' ,'=', 1)->orderBy('id','DESC')->first();
                $einzugId3 = $einzug3->id;
            }
        // Einzug Adresleri

        // Extralar
            $extra = [
                'extra1Text' => $request->addCost1Text,
                'extra1' => $request->addCost1,
                'extra2Text' => $request->addCost2Text,
                'extra2' => $request->addCost2,
                'extra3Text' => $request->addCost3Text,
                'extra3' => $request->addCost3,
                'extra4Text' => $request->addCost4Text,
                'extra4' => $request->addCost4,
                'extra5Text' => $request->addCost5Text,
                'extra5' => $request->addCost5,
                'extra6Text' => $request->addCost6Text,
                'extra6' => $request->addCost6,
                'extra7Text' => $request->addCost7Text,
                'extra7' => $request->addCost7,
                'extra8Text' => $request->addCost8Text,
                'extra8' => $request->addCost8,
                'extra9Text' => $request->addCost9Text,
                'extra9' => $request->addCost9,
                'extra10Text' => $request->addCost10Text,
                'extra10' => $request->addCost10,
                'extra11Text' => $request->addCost11Text,
                'extra11' => $request->addCost11,
                'extra12Text' => $request->addCost12Text,
                'extra12' => $request->addCost12,
                'extra13Text' => $request->addCost13Text,
                'extra13' => $request->addCost13,
                'extra14Text' => $request->addCost14Text,
                'extra14' => $request->addCost14,
                'extra15Text' => $request->addCost15Text,
                'extra15' => $request->addCost15,
                'extra16Text' => $request->addCost16Text,
                'extra16' => $request->addCost16, 
            ];
            ReceiptExtra::create($extra);
            $extraIdBul = DB::table('receipt_extras')->orderBy('id','DESC')->first();
            $extraId = $extraIdBul->id;
        // Extralar

        // Discountlar
            $discount = [
                'discount1Text' => $request->addDiscount1Text,
                'discount1' => $request->addDiscount1,
                'discount2Text' => $request->addDiscount2Text,
                'discount2' => $request->addDiscount2,
                'discount3Text' => $request->addDiscount3Text,
                'discount3' => $request->addDiscount3,
                'discount4Text' => $request->addDiscount4Text,
                'discount4' => $request->addDiscount4,
                'discount5Text' => $request->addDiscount5Text,
                'discount5' => $request->addDiscount5,
                'discount6Text' => $request->addDiscount6Text,
                'discount6' => $request->addDiscount6,
                'discount7Text' => $request->addDiscount7Text,
                'discount7' => $request->addDiscount7,
            ];
            ReceiptDiscount::create($discount);
            $discountIdBul = DB::table('receipt_discounts')->orderBy('id','DESC')->first();
            $discountId = $discountIdBul->id;
        // Discountlar

        $receiptStandart = [
            'customerId' => $customerId,
            'offerId' => $offerId,
            'receiptType' => 0,
            'payType' => 'Rechnung',
            'status' => 'Offen',
            'customerGender' => $request->customerGender,
            'customerName' => $request->customerName,
            'customerStreet' => $request->customerStreet,
            'customerAddress' => $request->customerPostCode,
            'customerPhone' => $request->customerPhone,
            'auszugId1' => $auszugId1,
            'auszugId2' => $auszugId2,
            'auszugId3' => $auszugId3,
            'einzugId1' => $einzugId1,
            'einzugId2' => $einzugId2,
            'einzugId3' => $einzugId3,
            'receiptExtraId' => $extraId,
            'receiptDiscountId' => $discountId,
            'orderDate' => $request->umzugDate,
            'orderTime' => $request->umzugTime,
            'umzugHour' => $request->umzugHour,
            'umzugChf' => $request->umzugChf,
            'umzugTotalChf' => $request->umzugCost,
            'umzugCharge' => $request->umzugSpesenCost,
            'umzugRoadChf' => $request->umzugRoadChf,
            'materialPrice' => $request->umzugPackCost,
            'entsorgungVolume' => $request->entsorgungVolume,
            'entsorgungChf' => $request->entsorgungRate,
            'entsorgungTotalChf' => $request->entsorgungCost,
            'entsorgungFixedChf' => $request->entsorgungFixed,
            'fixedPrice' => $request->costFix,
            'topPrice' => $request->costHigh,
            'totalPrice' => $request->totalCost,
            'withTax' => $request->withTax,
            'withoutTax'=> $request->withoutTax,
            'freeTax'=> $request->freeTax,
            'inBar'=> $request->payedCash,
            'inRechnung'=> $request->payedBill,
            'cashPrice' => $request->payedCashCost,
            'invoicePrice' => $request->payedBillCost,
            'signerName' => $request->signatureName,
        ];

        $create = ReceiptUmzug::create($receiptStandart);
        $receiptStandartIdBul = DB::table('receipt_umzugs')->orderBy('id','DESC')->first();
        $receiptStandartId = $receiptStandartIdBul->id;

        $sub = 'Ihre Quittung wurde erstellt';
        $from = Company::InfoCompany('email'); // gösterilen mail.
        $companyName = Company::InfoCompany('name'); // şirket adı buraya yaz veritabanında yok çünkü.
        $customer=DB::table('customers')->where('id','=', $customerId)->value('name'); 
        $gender=DB::table('customers')->where('id','=', $customerId)->value('gender');// Customer Name
        $customerSurname=DB::table('customers')->where('id','=', $customerId)->value('surname');

        $customerData =  Customer::where('id',$customerId)->first();
        $receiptPdf = ReceiptUmzug::where('id',$receiptStandartId)->first();
        $auszug1Pdf = ReceiptAddress::where('id',$auszugId1)->first();
        $auszug2Pdf = ReceiptAddress::where('id',$auszugId2)->first();
        $auszug3Pdf = ReceiptAddress::where('id',$auszugId3)->first();
        $einzug1Pdf = ReceiptAddress::where('id',$einzugId1)->first();
        $einzug2Pdf = ReceiptAddress::where('id',$einzugId2)->first();
        $einzug3Pdf = ReceiptAddress::where('id',$einzugId3)->first();
        $extraPdf = ReceiptExtra::where('id',$extraId)->first();
        $discountPdf = ReceiptDiscount::where('id',$discountId)->first();

        $pdfData = [
            'receiptNumber' => $receiptStandartId,
            'receipt' => $receiptPdf,
            'customer' => $customerData,
            'auszug1' => $auszug1Pdf,
            'auszug2' => $auszug2Pdf,
            'auszug3' => $auszug3Pdf,
            'einzug1' => $einzug1Pdf,
            'einzug2' => $einzug2Pdf,
            'einzug3' => $einzug3Pdf,
            'receiptExtra' => $extraPdf,
            'receiptDiscount' => $discountPdf,
        ];

        $pdf = Pdf::loadView('receiptUmzugPdf', $pdfData);
        $pdf->setPaper('A4');

        $emailData = [
            'receiptNumber' => $receiptStandartId,
            'name' => $customer,
            'surname' => $customerSurname,
            'gender' => $gender,
            'sub' => $sub,
            'from' => $from,
            'companyName' => $companyName,
            'email' => $request->email,
            'emailContent'=> $request->emailContent,
            'isCustomEmailSend' => $isCustomEmailSend,
            'customEmailContent' => $customEmail,
            'pdf' => $pdf,
        ];

        if ($isCustomEmailSend)
        {
            Arr::set($emailData, 'customEmailContent', $customEmail);
        }

        if($create)
        {
            $mailSuccess = '';
            if($isEmailSend)
            {
                Mail::to($emailData['email'])->send(new ReceiptStandartMail($emailData));
                $mailSuccess = ', Mail ve Makbuz Başarıyla Gönderildi';
            } 
            return redirect()
                ->route('customer.detail', ['id' => $customerId])
                ->with('status','Makbuz Başarıyla Oluşturuldu.'.' '.'Makbuz NO:'.' '.$receiptStandartId.$mailSuccess)
                ->with('cat', 'Quittung')
                ->withInput()
                ->with('keep_status', true);
        }
        else {
            return redirect()->back()->with('status','Hata:Makbuz Oluşturulamadı');
        }
    }

    public function delete ($id)
    {
        $c = ReceiptUmzug::where('id',$id)->count();
        if($c !=0)
        {
            $data = ReceiptUmzug::where('id',$id)->first();
            $auszug1 = ReceiptAddress::where('id',$data['auszugId1'])->delete();
            $auszug2 = ReceiptAddress::where('id',$data['auszugId2'])->delete();
            $auszug3 = ReceiptAddress::where('id',$data['auszugId3'])->delete();

            $einzug1 = ReceiptAddress::where('id',$data['einzugId1'])->delete();
            $einzug2 = ReceiptAddress::where('id',$data['einzugId2'])->delete();
            $einzug3 = ReceiptAddress::where('id',$data['einzugId3'])->delete();

            $extra = ReceiptExtra::where('id',$data['receiptExtraId'])->delete();
            $discount = ReceiptDiscount::where('id',$data['receiptDiscountId'])->delete();
            $expense = Expense::where('quittungId','=',$id)->where('exType','=', 'Umzug')->delete();
            ReceiptUmzug::where('id',$id)->delete();

            return redirect()->back()->with('status','Makbuz Başarıyla Silindi');
        }
        else {
            return redirect('/');
        }
    }
    
    public function showPdf($id)
    {
        $receiptUmzug = ReceiptUmzug::where('id',$id)->first();
        $customerData =  Customer::where('id',$receiptUmzug['customerId'])->first();
        $auszug1Pdf = ReceiptAddress::where('id',$receiptUmzug['auszugId1'])->first();
        $auszug2Pdf = ReceiptAddress::where('id',$receiptUmzug['auszugId2'])->first();
        $auszug3Pdf = ReceiptAddress::where('id',$receiptUmzug['auszugId3'])->first();
        $einzug1Pdf = ReceiptAddress::where('id',$receiptUmzug['einzugId1'])->first();
        $einzug2Pdf = ReceiptAddress::where('id',$receiptUmzug['einzugId2'])->first();
        $einzug3Pdf = ReceiptAddress::where('id',$receiptUmzug['einzugId3'])->first();
        $extraPdf = ReceiptExtra::where('id',$receiptUmzug['receiptExtraId'])->first();
        $discountPdf = ReceiptDiscount::where('id',$receiptUmzug['receiptDiscountId'])->first();

        $pdfData = [
            'receiptNumber' => $id,
            'receipt' => $receiptUmzug,
            'customer' => $customerData,
            'auszug1' => $auszug1Pdf,
            'auszug2' => $auszug2Pdf,
            'auszug3' => $auszug3Pdf,
            'einzug1' => $einzug1Pdf,
            'einzug2' => $einzug2Pdf,
            'einzug3' => $einzug3Pdf,
            'receiptExtra' => $extraPdf,
            'receiptDiscount' => $discountPdf,
        ];

        $pdf = Pdf::loadView('receiptUmzugPdf', $pdfData);
        return $pdf->stream();
    }
}
