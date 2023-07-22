<?php

namespace App\Http\Controllers\front\receiptReinigung;

use App\Http\Controllers\Controller;
use App\Mail\ReceiptReinigungMail;
use App\Models\Company;
use App\Models\Customer;
use App\Models\offerte;
use App\Models\ReceiptDiscount;
use App\Models\ReceiptExtra;
use App\Models\ReceiptReinigung;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class indexController extends Controller
{
    public function createReinigung($id,$customer)
    {
        $offer = offerte::where('id',$id)->first();
        $data = Customer::where('id',$customer)->first();
        return view('front.receipt.createReinigung',['offer'=>$offer,'data'=>$data]);
    }

    public function createReinigung2($id,$customer)
    {
        $offer = offerte::where('id',$id)->first();
        $data = Customer::where('id',$customer)->first();
        return view('front.receipt.createReinigung2',['offer'=>$offer,'data'=>$data]);
    }
    
    public function storeReinigung(Request $request)
    {
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
            ];
            ReceiptDiscount::create($discount);
            $discountIdBul = DB::table('receipt_discounts')->orderBy('id','DESC')->first();
            $discountId = $discountIdBul->id;
        // Discountlar

        $receiptReinigung = [
            'customerId' => $customerId,
            'offerId' => $offerId,
            'receiptType' => 1,
            'payType' => 'Rechnung',
            'status' => 'Açık',
            'customerGender' => $request->customerGender,
            'customerName' => $request->customerName,
            'customerStreet' => $request->customerStreet,
            'customerAddress' => $request->customerPostCode,
            'customerPhone' => $request->customerPhone,
            'reinigungStreet' => $request->reinigungStreet,
            'reinigungAddress' => $request->reinigungPostCode,
            'reinigungDate' =>$request->reinigungStartDate,
            'reinigungTime' => $request->reinigungStartTime,
            'endDate' => $request->reinigungEndDate,
            'endTime'=> $request->reinigungEndTime,
            'reinigungType' => $request->reinigungType,
            'reinigungExtraText' => $request->reinigungExText,
            'extraReinigung' => $request->extraReinigung,
            'fixedPrice' => $request->reinigungFixedChf,
            'reinigungHours' => $request->reinigungHour,
            'reinigungChf' => $request->reinigungChf,
            'reinigungPrice' => $request->reinigungCost,
            'receiptExtraId' => $extraId,
            'receiptDiscountId' => $discountId,
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

        $create = ReceiptReinigung::create($receiptReinigung);
        $receiptReinigungIdBul = DB::table('receipt_reinigungs')->orderBy('id','DESC')->first();
        $receiptReinigungId = $receiptReinigungIdBul->id;

        $sub = 'Ihre Reinigungsquittung wurde erstellt';
        $from = Company::InfoCompany('email'); // gösterilen mail.
        $companyName = Company::InfoCompany('name'); // şirket adı buraya yaz veritabanında yok çünkü.
        $customer=DB::table('customers')->where('id','=', $customerId)->value('name'); // Customer Name
        $gender=DB::table('customers')->where('id','=', $customerId)->value('gender');// Customer Name
        $customerSurname=DB::table('customers')->where('id','=', $customerId)->value('surname');

        $customerData =  Customer::where('id',$customerId)->first();
        $receiptPdf = ReceiptReinigung::where('id',$receiptReinigungId)->first();
        $extraPdf = ReceiptExtra::where('id',$extraId)->first();
        $discountPdf = ReceiptDiscount::where('id',$discountId)->first();

        $pdfData = [
            'receiptNumber' => $receiptReinigungId,
            'receipt' => $receiptPdf,
            'customer' => $customerData,
            'receiptExtra' => $extraPdf,
            'receiptDiscount' => $discountPdf,
        ];

        $pdf = Pdf::loadView('receiptReinigungPdf', $pdfData);
        $pdf->setPaper('A4');

        $emailData = [
            'receiptNumber' => $receiptReinigungId,
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
                Mail::to($emailData['email'])->send(new ReceiptReinigungMail($emailData));
                $mailSuccess = ', E-Mail und Beleg erfolgreich versendet';
            } 
            return redirect()
                ->route('customer.detail', ['id' => $customerId])
                ->with('status','Reinigungsbeleg erfolgreich erstellt.'.' '.'Belegnummer:'.' '.$receiptReinigungId.$mailSuccess)
                ->with('cat', 'Quittung')
                ->withInput()
                ->with('keep_status', true);
        }
        else {
            return redirect()->back()->with('status','Hata:Makbuz Oluşturulamadı');
        }
    }

    public function edit(Request $request)
    {
        $id = $request->route('id');
        $c = ReceiptReinigung::where('id',$id)->count();

        if($c !=0)
        {
            $data = ReceiptReinigung::where('id',$id)->first();
            $data2 = Customer::where('id',$data['customerId'])->first();
            return view ('front.receipt.editReinigung', ['data' => $data,'data2' => $data2]);
        }
    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = ReceiptReinigung::where('id',$id)->count();
        $d = ReceiptReinigung::where('id',$id)->first();
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

        $receiptExtraId = $d['receiptExtraId'] ? $d['receiptExtraId'] : NULL;
        $receiptDiscountId = $d['receiptDiscountId'] ? $d['receiptDiscountId'] : NULL;

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
                ];
    
                ReceiptDiscount::create($discount);
                $discountIdBul = DB::table('receipt_discounts')->orderBy('id','DESC')->first();
                $receiptDiscountId = $discountIdBul->id;
            }
        // Discountlar

        $receiptReinigung = [
            'customerId' => $d['customerId'],
            'offerId' => $d['offerId'],
            'receiptType' => 1,
            'payType' => 'Rechnung',
            'status' => $request->status,
            'customerGender' => $request->customerGender,
            'customerName' => $request->customerName,
            'customerStreet' => $request->customerStreet,
            'customerAddress' => $request->customerPostCode,
            'customerPhone' => $request->customerPhone,
            'reinigungStreet' => $request->reinigungStreet,
            'reinigungAddress' => $request->reinigungPostCode,
            'reinigungDate' =>$request->reinigungStartDate,
            'reinigungTime' => $request->reinigungStartTime,
            'endDate' => $request->reinigungEndDate,
            'endTime'=> $request->reinigungEndTime,
            'reinigungType' => $request->reinigungType,
            'reinigungExtraText' => $request->reinigungExText,
            'extraReinigung' => $request->extraReinigung,
            'fixedPrice' => $request->reinigungFixedChf,
            'reinigungHours' => $request->reinigungHour,
            'reinigungChf' => $request->reinigungChf,
            'reinigungPrice' => $request->reinigungCost,
            'receiptExtraId' => $receiptExtraId,
            'receiptDiscountId' => $receiptDiscountId,
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

        $update = ReceiptReinigung::where('id',$id)->update($receiptReinigung);

        $sub = 'Ihre Reinigungsquittung wurde aktualisiert';
        $from = Company::InfoCompany('email'); // gösterilen mail.
        $companyName = Company::InfoCompany('name'); // şirket adı buraya yaz veritabanında yok çünkü.
        $customer=DB::table('customers')->where('id','=', $d['customerId'])->value('name'); // Customer Name
        $customerSurname=DB::table('customers')->where('id','=', $d['customerId'])->value('surname');
        $gender=DB::table('customers')->where('id','=', $d['customerId'])->value('gender');// Customer Name
        $receiptPdf = ReceiptReinigung::where('id',$id)->first();
        $customerData =  Customer::where('id',$d['customerId'])->first();
        $extraPdf = ReceiptExtra::where('id',$receiptExtraId)->first();
        $discountPdf = ReceiptDiscount::where('id',$receiptDiscountId)->first();

        $pdfData = [
            'receiptNumber' => $id,
            'receipt' => $receiptPdf,
            'customer' => $customerData,
            'receiptExtra' => $extraPdf,
            'receiptDiscount' => $discountPdf,
        ];

        $pdf = Pdf::loadView('receiptReinigungPdf', $pdfData);
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
                Mail::to($emailData['email'])->send(new ReceiptReinigungMail($emailData));
                $mailSuccess = ', Mail ve Makbuz Başarıyla Gönderildi';
            } 
            return redirect()->back()->with('status','Temizlik Makbuzu Başarıyla Düzenlendi.'.' '.'Makbuz NO:'.' '.$id.$mailSuccess);
            return redirect()
                ->route('customer.detail', ['id' => $d['customerId']])
                ->with('status','Temizlik Makbuzu Başarıyla Düzenlendi.'.' '.'Makbuz NO:'.' '.$id.$mailSuccess)
                ->with('cat', 'Quittung')
                ->withInput()
                ->with('keep_status', true);
        }
        else {
            return redirect()->back()->with('status','Hata:Makbuz Düzenlenemedi');
        }
    }

    public function detail(Request $request)
    {
        $id = $request->route('id');
        $c = ReceiptReinigung::where('id',$id)->count();

        if($c !=0)
        {
            $data = ReceiptReinigung::where('id',$id)->first();
            $data2 = Customer::where('id',$data['customerId'])->first();
            return view ('front.receipt.detailReinigung', ['data' => $data,'data2' => $data2]);
        }
    }

    public function delete($id)
    {
        $c = ReceiptReinigung::where('id',$id)->count();
        if($c !=0)
        {
            $data = ReceiptReinigung::where('id',$id)->first();
            $extra = ReceiptExtra::where('id',$data['receiptExtraId'])->delete();
            $discount = ReceiptDiscount::where('id',$data['receiptDiscountId'])->delete();

            ReceiptReinigung::where('id',$id)->delete();

            return redirect()->back()->with('status','Makbuz Başarıyla Silindi');
        }
        else {
            return redirect('/');
        }
    }

    public function showPdf($id)
    {
        $receiptPdf = ReceiptReinigung::where('id',$id)->first();
        $customerData =  Customer::where('id',$receiptPdf['customerId'])->first();
        $extraPdf = ReceiptExtra::where('id',$receiptPdf['receiptExtraId'])->first();
        $discountPdf = ReceiptDiscount::where('id',$receiptPdf['receiptDiscountId'])->first();

        $pdfData = [
            'receiptNumber' => $id,
            'receipt' => $receiptPdf,
            'customer' => $customerData,
            'receiptExtra' => $extraPdf,
            'receiptDiscount' => $discountPdf,
        ];

        $pdf = Pdf::loadView('receiptReinigungPdf', $pdfData);
        return $pdf->stream();
    }
}
