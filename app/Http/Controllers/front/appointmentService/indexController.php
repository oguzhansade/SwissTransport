<?php

namespace App\Http\Controllers\front\appointmentService;

use App\Http\Controllers\Controller;
use App\Mail\CompanyMail;
use App\Mail\InformationMail;
use App\Models\AppoinmentService;
use App\Models\Appointment;
use App\Models\AppointmentService;
use App\Models\AuspackService;
use App\Models\Company;
use App\Models\Customer;
use App\Models\EinpackService;
use App\Models\EntsorgungService;
use App\Models\LagerungService;
use App\Models\ReinigungService;
use App\Models\TransportService;
use App\Models\UmzugService;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class indexController extends Controller
{
    public function edit(Request $request)
    {
        $id = $request->route('id');
        $c = AppoinmentService::where('id',$id)->count();
        
        if($c !=0)
        {
            $data = AppoinmentService::where('id',$id)->first();
            $data2 = Customer::where('id',$data['customerId'])->first();
            $dataUmzug = UmzugService::where('id',$data['umzugId'])->first();
            $dataUmzug2 = UmzugService::where('id',$data['umzug2Id'])->first();
            $dataUmzug3 = UmzugService::where('id',$data['umzug3Id'])->first();
            $dataEinpack = EinpackService::where('id',$data['einpackId'])->first();
            $dataAuspack = AuspackService::where('id',$data['auspackId'])->first();
            $dataReinigung = ReinigungService::where('id',$data['reinigungId'])->first();
            $dataReinigung2 = ReinigungService::where('id',$data['reinigung2Id'])->first();
            $dataEntsorgung = EntsorgungService::where('id',$data['entsorgungId'])->first();
            $dataTransport = TransportService::where('id',$data['transportId'])->first();
            $dataLagerung = LagerungService::where('id',$data['lagerungId'])->first();
            return view ('front.appointmentService.edit', 
                [
                'data' => $data,
                'data2' => $data2,
                'dataUmzug' => $dataUmzug,
                'dataUmzug2' => $dataUmzug2,
                'dataUmzug3' => $dataUmzug3,
                'dataEinpack' => $dataEinpack,
                'dataAuspack' => $dataAuspack,
                'dataReinigung' => $dataReinigung,
                'dataReinigung2' => $dataReinigung2,
                'dataEntsorgung' => $dataEntsorgung,
                'dataTransport' => $dataTransport,
                'dataLagerung' => $dataLagerung,
                ]
            );
        }
    }

    public function detail(Request $request)
    {
        $id = $request->route('id');
        $c = AppoinmentService::where('id',$id)->count();
        
        if($c !=0)
        {
            $data = AppoinmentService::where('id',$id)->first();
            $data2 = Customer::where('id',$data['customerId'])->first();
            $dataUmzug = UmzugService::where('id',$data['umzugId'])->first();
            $dataUmzug2 = UmzugService::where('id',$data['umzug2Id'])->first();
            $dataUmzug3 = UmzugService::where('id',$data['umzug3Id'])->first();
            $dataEinpack = EinpackService::where('id',$data['einpackId'])->first();
            $dataAuspack = AuspackService::where('id',$data['auspackId'])->first();
            $dataReinigung = ReinigungService::where('id',$data['reinigungId'])->first();
            $dataReinigung2 = ReinigungService::where('id',$data['reinigung2Id'])->first();
            $dataEntsorgung = EntsorgungService::where('id',$data['entsorgungId'])->first();
            $dataTransport = TransportService::where('id',$data['transportId'])->first();
            $dataLagerung = LagerungService::where('id',$data['lagerungId'])->first();
            return view ('front.appointmentService.detail', 
                [
                'data' => $data,
                'data2' => $data2,
                'dataUmzug' => $dataUmzug,
                'dataUmzug2' => $dataUmzug2,
                'dataUmzug3' => $dataUmzug3,
                'dataEinpack' => $dataEinpack,
                'dataAuspack' => $dataAuspack,
                'dataReinigung' => $dataReinigung,
                'dataReinigung2' => $dataReinigung2,
                'dataEntsorgung' => $dataEntsorgung,
                'dataTransport' => $dataTransport,
                'dataLagerung' => $dataLagerung,
                ]
            );
        }
    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = AppoinmentService::where('id',$id)->count();

        $d = AppoinmentService::where('id',$id)->first();       
        $customerId = Customer::where('id','=',$d['customerId'])->first();
        $isEmailSend = $request->get('isEmail');
        $isCustomEmailSend = $request->get('isCustomEmail');
        $customEmail = $request->get('customEmail');

        
        $appDateArray = [];
        $ADC = 0;


        $sub = 'Ihr Auftragsbestätigungstermin wurde aktualisiert';
        
        $from = Company::InfoCompany('email'); // gösterilen mail.
        $companyName = Company::InfoCompany('name'); // şirket adı buraya yaz veritabanında yok çünkü.
        $customer=DB::table('customers')->where('id','=', $customerId['id'])->value('name');
        $customerSurname=DB::table('customers')->where('id','=', $customerId['id'])->value('surname');
        $customerData = Customer::where('id',$customerId['id'])->first();
          

        // Servis Tanımlamaları
        $umzugId = NULL; // Umzug 1 Id
        $umzug2Id = NULL; // Umzug 2 Id
        $umzug3Id = NULL; // Umzug 3 Id
        $einpackId = NULL; // Einpack Id
        $auspackId = NULL; // Auspack Id
        $reinigungId = NULL; // Reinigung Id
        $reinigung2Id = NULL; // Reinigung 2 Id
        $entsorgungId = NULL; // Entsorgung Id
        $transportId = NULL; // Transport Id
        $lagerungId = NULL; // Lagerung Id
        

        if ($isCustomEmailSend)
        {
            Arr::set($emailData, 'customEmailContent', $customEmail);
        }

        if($c !=0)
        {
                // Umzug Güncelleme
                    $isUmzug = $request->get('isUmzug');
                    if($isUmzug && $request->umzug1date)
                        {         
                            $umzug1 = [
                                'umzugDate' => $request->umzug1date,
                                'umzugTime' => $request->umzug1time,
                                'workHours' => $request->umzug1hours,
                                'ma' => $request->umzug1ma,
                                'lkw' => $request->umzug1lkw,
                                'anhanger' => $request->umzug1anhanger,               
                            ];
                            
                            
                            if ($d['umzugId'])
                            {
                                $umzug1Guncelle = UmzugService::where('id',$d['umzugId'])->update($umzug1);
                                $umzugId = $d['umzugId'];
                                
                                $umzug1Date = UmzugService::where('id',$d['umzugId'])->first();
                                $appDateArray[$ADC]['date'] = $umzug1Date['umzugDate'];
                                $appDateArray[$ADC]['time'] = $umzug1Date['umzugTime'];
                                $appDateArray[$ADC]['serviceName'] = 'Umzug';
                                $ADC++; 
                            }
                            else
                            {
                                $umzug1Olustur = UmzugService::create($umzug1);
                                $umzugIdBul = DB::table('umzug_services')->orderBy('id','DESC')->first(); // Son Eklenen Umzug un id'si
                                $umzugId = $umzugIdBul->id;
                                $appDateArray[$ADC]['date'] = $umzugIdBul->umzugDate;
                                $appDateArray[$ADC]['time'] = $umzugIdBul->umzugTime;
                                $appDateArray[$ADC]['serviceName'] = 'Umzug';
                                $ADC++; 
                            }
                                            
                        }
                        else
                        {
                            UmzugService::where('id',$d['umzugId'])->delete(); // Düğme Kapanırsa Silinir
                        }
                // Umzug 2 Güncelleme
                    $isUmzug2 = $request->get('umzug2date');
                    if($isUmzug2 )
                    {         
                        $umzug2 = [
                            'umzugDate' => $request->umzug1date,
                            'umzugTime' => $request->umzug1time,
                            'workHours' => $request->umzug1hours,
                            'ma' => $request->umzug1ma,
                            'lkw' => $request->umzug1lkw,
                            'anhanger' => $request->umzug1anhanger,               
                        ];
                        
                        $umzug2Date = UmzugService::where('id',$d['umzug2Id'])->first();
                        if ($umzug2Date)
                        {
                            
                            $umzug2Guncelle = UmzugService::where('id',$d['umzug2Id'])->update($umzug2);
                            $umzug2Id = $d['umzug2Id'];
                            
                            $appDateArray[$ADC]['date'] = $umzug2Date['umzugDate'];
                            $appDateArray[$ADC]['time'] = $umzug2Date['umzugTime'];

                            $appDateArray[$ADC]['serviceName'] = 'Umzug 2';
                            $ADC++; 
                        }
                        
                        else
                        {
                            $umzug2Olustur = UmzugService::create($umzug2);
                            $umzug2IdBul = DB::table('umzug_services')->orderBy('id','DESC')->first(); // Son Eklenen Umzug un id'si
                            $umzug2Id = $umzug2IdBul->id;
                            $appDateArray[$ADC]['date'] = $umzug2IdBul->umzugDate;
                            $appDateArray[$ADC]['time'] = $umzug2IdBul->umzugTime;
                            $appDateArray[$ADC]['serviceName'] = 'Umzug 2';
                            $ADC++; 
                        }
                                        
                    }

                    else
                    {
                       UmzugService::where('id',$d['umzug2Id'])->delete();
                        // Düğme Kapanırsa Silinir
                        
                    }
                // Umzug 3 Güncelleme
                    $isUmzug3 = $request->get('umzug3date');
                    if($isUmzug3)
                    {         
                        $umzug3 = [
                            'umzugDate' => $request->umzug1date,
                            'umzugTime' => $request->umzug1time,
                            'workHours' => $request->umzug1hours,
                            'ma' => $request->umzug1ma,
                            'lkw' => $request->umzug1lkw,
                            'anhanger' => $request->umzug1anhanger,               
                        ];
                        
                        $umzug3Date = UmzugService::where('id',$d['umzug3Id'])->first();
                        
                        if ($umzug3Date)
                        {
                            $umzug3Guncelle = UmzugService::where('id',$d['umzug3Id'])->update($umzug3);                            
                            $umzug3Id = $d['umzug3Id'];
                            $appDateArray[$ADC]['date'] = $umzug3Date['umzugDate'];    
                            $appDateArray[$ADC]['time'] = $umzug3Date['umzugTime'];                         
                            $appDateArray[$ADC]['serviceName'] = 'Umzug 3';
                            $ADC++; 
                        }
                        else
                        {
                            $umzug3Olustur = UmzugService::create($umzug3);
                            $umzug3IdBul = DB::table('umzug_services')->orderBy('id','DESC')->first(); // Son Eklenen Umzug un id'si
                            $umzug3Id = $umzug3IdBul->id;
                            $appDateArray[$ADC]['date'] = $umzug3IdBul->umzugDate;
                            $appDateArray[$ADC]['time'] = $umzug3IdBul->umzugTime;
                            $appDateArray[$ADC]['serviceName'] = 'Umzug 3';
                            $ADC++; 
                        }
                                        
                    }
                    else{
                        UmzugService::where('id',$d['umzug3Id'])->delete();
                        
                    }
                    
                
                // Einpack Güncelleme
                    $isEinpack = $request->get('einpackdate');
                    if($isEinpack)
                    {         
                        $einpack = [
                            'einpackDate' => $request->einpackdate,
                            'einpackTime' => $request->einpacktime,
                            'workHours' => $request->einpackhours,
                            'ma' => $request->einpackma,
                            'lkw' => $request->einpacklkw,
                            'anhanger' => $request->einpackanhanger,               
                        ];
                        
                        $einpackDate = EinpackService::where('id',$d['einpackId'])->first();
                        if ($einpackDate)
                        {
                            
                            $einpackGuncelle = EinpackService::where('id',$d['einpackId'])->update($einpack);
                            $einpackId = $d['einpackId'];                            
                            $appDateArray[$ADC]['date'] = $einpackDate['einpackDate'];
                            $appDateArray[$ADC]['time'] = $einpackDate['einpackTime'];
                            $appDateArray[$ADC]['serviceName'] = 'Einpack';
                            $ADC++; 
                        }
                        
                        else
                        {
                            $einpackOlustur = EinpackService::create($einpack);
                            $einpackIdBul = DB::table('einpack_services')->orderBy('id','DESC')->first(); // Son Eklenen Umzug un id'si
                            $einpackId = $einpackIdBul->id;
                            $appDateArray[$ADC]['date'] = $einpackIdBul->einpackDate;
                            $appDateArray[$ADC]['time'] = $einpackIdBul->einpackTime;
                            $appDateArray[$ADC]['serviceName'] = 'Einpack';
                            $ADC++; 
                        }
                                        
                    }
                    else
                    {
                        EinpackService::where('id',$d['einpackId'])->delete(); // Düğme Kapanırsa Silinir
                    }

                // Auspack Güncelleme
                    $isAuspack = $request->get('auspackdate');
                    if($isAuspack)
                    {         
                        $auspack = [
                            'auspackDate' => $request->auspackdate,
                            'auspackTime' => $request->auspacktime,
                            'workHours' => $request->auspackhours,
                            'ma' => $request->auspackma,
                            'lkw' => $request->auspacklkw,
                            'anhanger' => $request->auspackanhanger,               
                        ];
                        
                        $auspackDate = AuspackService::where('id',$d['auspackId'])->first();
                        if ($auspackDate)
                        {
                            $auspackGuncelle = AuspackService::where('id',$d['auspackId'])->update($auspack);
                            $auspackId = $d['auspackId'];
                            
                            $appDateArray[$ADC]['date'] = $auspackDate['auspackDate'];
                            $appDateArray[$ADC]['time'] = $auspackDate['auspackTime'];
                            $appDateArray[$ADC]['serviceName'] = 'Auspack';
                            $ADC++; 
                        }
                        else
                        {
                            $auspackOlustur = AuspackService::create($auspack);
                            $auspackIdBul = DB::table('auspack_services')->orderBy('id','DESC')->first(); // Son Eklenen Umzug un id'si
                            $auspackId = $auspackIdBul->id;
                            $appDateArray[$ADC]['date'] = $auspackIdBul->auspackDate;
                            $appDateArray[$ADC]['time'] = $auspackIdBul->auspackTime;
                            $appDateArray[$ADC]['serviceName'] = 'Auspack';
                            $ADC++; 
                        }
                                        
                    }
                    else
                    {
                        AuspackService::where('id',$d['auspackId'])->delete(); // Düğme Kapanırsa Silinir
                    }
                    

                // Reinigung Güncelleme
                    $isReinigung = $request->get('reinigung1Startdate');
                    if($isReinigung)
                    {
                        $reinigung = [
                            'reinigungStartDate' => $request->reinigung1Startdate,
                            'reinigungStartTime' => $request->reinigung1Starttime,
                            'reinigungEndDate' => $request->reinigung1Enddate,
                            'reinigungEndTime' => $request->reinigung1Endtime,               
                        ];
                        $reinigungDate = ReinigungService::where('id',$d['reinigungId'])->first();
                        if ($reinigungDate)
                        {
                            $reinigungGuncelle = ReinigungService::where('id',$d['reinigungId'])->update($reinigung);
                            $reinigungId = $d['reinigungId'];                           
                            $appDateArray[$ADC]['date'] = $reinigungDate['reinigungStartDate'];
                            $appDateArray[$ADC]['time'] = $reinigungDate['reinigungStartTime'];
                            $appDateArray[$ADC]['serviceName'] = 'Reinigung';
                            $ADC++; 
                        }
                        else
                        {
                            $reinigungOlustur = ReinigungService::create($reinigung);
                            $reinigungIdBul = DB::table('reinigung_services')->orderBy('id','DESC')->first(); // Son Eklenen Reinigung un id'si
                            $reinigungId = $reinigungIdBul->id;
                            $appDateArray[$ADC]['date'] = $reinigungIdBul->reinigungStartDate;
                            $appDateArray[$ADC]['time'] = $reinigungIdBul->reinigungStartTime;
                            $appDateArray[$ADC]['serviceName'] = 'Reinigung';
                            $ADC++;
                        }
                       
                    }
                    else
                    {
                        ReinigungService::where('id',$d['reinigungId'])->delete(); // Düğme Kapanırsa Silinir
                    }
                
                // Reinigung 2 Güncelleme
                    $isReinigung2 = $request->get('reinigung2Startdate');
                    if($isReinigung2)
                    {
                        $reinigung2 = [
                            'reinigungStartDate' => $request->reinigung2Startdate,
                            'reinigungStartTime' => $request->reinigung2Starttime,
                            'reinigungEndDate' => $request->reinigung2Enddate,
                            'reinigungEndTime' => $request->reinigung2Endtime,               
                        ];
                        $reinigung2Date = ReinigungService::where('id',$d['reinigung2Id'])->first();
                        if ($reinigung2Date)
                        {
                            $reinigung2Guncelle = ReinigungService::where('id',$d['reinigung2Id'])->update($reinigung);
                            $reinigung2Id = $d['reinigung2Id'];                           
                            $appDateArray[$ADC]['date'] = $reinigung2Date['reinigungStartDate'];
                            $appDateArray[$ADC]['time'] = $reinigung2Date['reinigungStartTime'];
                            $appDateArray[$ADC]['serviceName'] = 'Reinigung 2';
                            $ADC++; 
                        }
                        else
                        {
                            $reinigung2Olustur = ReinigungService::create($reinigung);
                            $reinigung2IdBul = DB::table('reinigung_services')->orderBy('id','DESC')->first(); // Son Eklenen Reinigung un id'si
                            $reinigung2Id = $reinigung2IdBul->id;
                            $appDateArray[$ADC]['date'] = $reinigung2IdBul->reinigungStartDate;
                            $appDateArray[$ADC]['time'] = $reinigung2IdBul->reinigungStartTime;
                            $appDateArray[$ADC]['serviceName'] = 'Reinigung 2';
                            $ADC++;
                        }
                    
                    }
                    else
                    {
                        ReinigungService::where('id',$d['reinigung2Id'])->delete(); // Düğme Kapanırsa Silinir
                    }
                    

                // Entsorgung Güncelleme
                    $isEntsorgung = $request->get('entsorgungdate');
                    if($isEntsorgung)
                    {
                        $entsorgung = [
                            'entsorgungDate' => $request->entsorgungdate,
                            'entsorgungTime' => $request->entsorgungtime,
                            'workHours' => $request->entsorgunghours,
                            'ma' => $request->entsorgungma,   
                            'lkw' => $request->entsorgunglkw,     
                            'anhanger' => $request->entsorgunganhanger,                 
                        ];
                        $entsorgungDate = EntsorgungService::where('id',$d['entsorgungId'])->first();
                        if ($entsorgungDate)
                        {
                            $entsorgungGuncelle = EntsorgungService::where('id',$d['entsorgungId'])->update($entsorgung);
                            $entsorgung = $d['entsorgungId'];                           
                            $appDateArray[$ADC]['date'] = $entsorgungDate['entsorgungDate'];
                            $appDateArray[$ADC]['time'] = $entsorgungDate['entsorgungTime'];
                            $appDateArray[$ADC]['serviceName'] = 'Entsorgung';
                            $ADC++; 
                        }
                        else
                        {
                            $entsorgungOlustur = EntsorgungService::create($entsorgung);
                            $entsorgungIdBul = DB::table('entsorgung_services')->orderBy('id','DESC')->first(); // Son Eklenen Entsorgung un id'si
                            $entsorgungId = $entsorgungIdBul->id;
                            $appDateArray[$ADC]['date'] = $entsorgungIdBul->entsorgungDate;
                            $appDateArray[$ADC]['time'] = $entsorgungIdBul->entsorgungTime;
                            $appDateArray[$ADC]['serviceName'] = 'Entsorgung';
                            $ADC++;
                        }
                    }
                    else
                    {
                        EntsorgungService::where('id',$d['entsorgungId'])->delete(); // Düğme Kapanırsa Silinir
                    }
                // Transport Güncelleme
                    $isTransport = $request->get('transportdate');
                    if($isTransport )
                    {
                        
                        $transport = [
                            'transportDate' => $request->transportdate,
                            'transportTime' => $request->transporttime,
                            'destination' => $request->destination,
                            'arrival' => $request->arrival,
                            'workHours' => $request->transporthours,
                            'ma' => $request->transportma,   
                            'lkw' => $request->transportlkw,     
                            'anhanger' => $request->transportanhanger,
                                        
                        ];
                        $transportDate = TransportService::where('id',$d['transportId'])->first();
                        if($transportDate)
                        {                            
                            $transportGuncelle = TransportService::where('id',$d['transportId'])->update($transport);
                            $transportId = $d['transportId'];                               
                            $appDateArray[$ADC]['date'] = $transportDate['transportDate'];
                            $appDateArray[$ADC]['time'] = $transportDate['transportTime'];
                            $appDateArray[$ADC]['serviceName'] = 'Transport';
                            $ADC++;  
                                                    
                        }
                        
                        else
                        {                            
                            $transportOlustur = TransportService::create($transport);                        
                            $transportIdBul = DB::table('transport_services')->orderBy('id','DESC')->first(); // Son Eklenen Transport un id'si
                            $transportId = $transportIdBul->id;                       
                            $appDateArray[$ADC]['date'] = $transportIdBul->transportDate;
                            $appDateArray[$ADC]['time'] = $transportIdBul->transportTime;
                            $appDateArray[$ADC]['serviceName'] = 'Transport';
                            $ADC++;
                        }
                    }
                    else
                    {
                        TransportService::where('id',$d['transportId'])->delete(); // Düğme Kapanırsa Silinir
                    }

                // Lagerung Güncelleme
                    $isLagerung = $request->get('lagerungdate');
                    if($isLagerung)
                    {
                        $lagerung = [
                            'lagerungDate' => $request->lagerungdate,
                            'lagerungTime' => $request->lagerungtime,                
                        ];
                        $lagerungDate = LagerungService::where('id',$d['lagerungId'])->first();
                        if($lagerungDate)
                        {                            
                            $lagerungGuncelle = LagerungService::where('id',$d['lagerungId'])->update($lagerung);
                            $lagerungId = $d['lagerungId'];                            
                            $appDateArray[$ADC]['date'] = $lagerungDate['lagerungDate'];
                            $appDateArray[$ADC]['time'] = $lagerungDate['lagerungTime'];
                            $appDateArray[$ADC]['serviceName'] = 'Lagerung';
                            $ADC++;                            
                        }
                        else
                        {
                            $lagerungOlustur = LagerungService::create($lagerung);
                            $lagerungIdBul = DB::table('lagerung_services')->orderBy('id','DESC')->first(); // Son Eklenen Lagerung un id'si
                            $lagerungId = $lagerungIdBul->id;
                            $appDateArray[$ADC]['date'] = $lagerungIdBul->lagerungDate;
                            $appDateArray[$ADC]['time'] = $lagerungIdBul->lagerungTime;
                            $appDateArray[$ADC]['serviceName'] = 'Lagerung';
                            $ADC++;
                        }
                        
                    }
                    else
                    {
                        LagerungService::where('id',$d['lagerungId'])->delete(); // Düğme Kapanırsa Silinir
                    }
                // AppointmentService Güncelleme
                    $appointmentService = [
                    'paymentType' => $request->paymentType,
                    'address' => $request->address,
                    'calendarTitle' => $request->calendarTitle,
                    'calendarContent' => $request->calendarContent,                   
                    'umzugId' => $umzugId,
                    'umzug2Id'=> $umzug2Id,
                    'umzug3Id' => $umzug3Id,
                    'einpackId' => $einpackId,
                    'auspackId' => $auspackId,
                    'reinigungId' => $reinigungId,
                    'reinigung2Id' => $reinigung2Id,
                    'entsorgungId' => $entsorgungId,
                    'transportId' => $transportId,
                    'lagerungId' => $lagerungId,                   
                    ];
                
                
                    
                    $update = AppoinmentService::where('id',$id)->update($appointmentService);
                
                    $emailData = [
                        'name' => $customer,
                        'gender' => $customerData['gender'],
                        'surname' => $customerSurname,
                        'address' => $request->address,
                        'sub' => $sub,
                        'from' => $from,
                        'companyName' => $companyName,
                        'appDate' =>$appDateArray,
                        'email' => $request->email,
                        'emailContent'=> $request->emailContent,
                        'isCustomEmailSend' => $isCustomEmailSend,
                        'customEmailContent' => $customEmail
                    ];
                
                
                
                    if($update) 
                {
                    $mailSuccess = '';
                    if($isEmailSend)
                    {
                        Mail::to($emailData['email'])->send(new InformationMail($emailData));
                        Mail::to($from)->send(new CompanyMail($emailData));
                        $mailSuccess = 'Mail Başarıyla Gönderildi';
                    }  
                    return redirect()->back()->with('status','Auftragsbestätigung Randevusu Düzenlendi'.' '.$mailSuccess);
                }
                else {
                    return redirect()->back()->with('status-danger','HATA:Auftragsbestätigung Randevusu Düzenlenemedi');
                }
        }
    }

    public function delete($id)
    {

        $c = AppoinmentService::where('id',$id)->count();       
        
        if($c != 0)
        {   
            $data = AppoinmentService::where('id',$id)->get();
            UmzugService::where('id',$data[0]['umzugId'])->delete();
            UmzugService::where('id',$data[0]['umzug2Id'])->delete();
            UmzugService::where('id',$data[0]['umzug3Id'])->delete();
            EinpackService::where('id',$data[0]['einpackId'])->delete();
            AuspackService::where('id',$data[0]['auspackId'])->delete();
            ReinigungService::where('id',$data[0]['reinigungId'])->delete();
            ReinigungService::where('id',$data[0]['reinigung2Id'])->delete();
            EntsorgungService::where('id',$data[0]['entsorgungId'])->delete();
            TransportService::where('id',$data[0]['transportId'])->delete();
            LagerungService::where('id',$data[0]['lagerungId'])->delete();

            AppoinmentService::where('id',$id)->delete();
            return redirect()->back()->with('status','Keşif Randevusu Başarıyla Silindi');
        }
        else {
            return redirect('/');
        }
    }
}
