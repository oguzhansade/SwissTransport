<?php

namespace App\Http\Controllers\front\appointment;

use App\Helper\calendarHelper;
use App\Http\Controllers\Controller;
use App\Mail\InformationMail;
use App\Mail\CompanyMail;
use App\Models\AppoinmentService;
use App\Models\Appointment;
use App\Models\AppointmentMaterial;
use App\Models\AuspackService;
use App\Models\Company;
use App\Models\Customer;
use App\Models\EinpackService;
use App\Models\EntsorgungService;
use App\Models\LagerungService;
use App\Models\offerte;
use App\Models\ReinigungService;
use App\Models\TransportService;
use App\Models\UmzugService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Spatie\GoogleCalendar\Event;


class indexController extends Controller
{
    public function index()
    {
        return view('front.appointment.index');
    }
    public function create($id)
    { 
        $data = Customer::where('id',$id)->first();
        $data2 = Customer::where('id',$id)->first();
        return view('front.appointment.create',['data'=>$data,'data2' => $data2]);
    }

    public function createFromOffer($id,$customer)
    {
        $offer = offerte::where('id',$id)->first();
        $data = Customer::where('id',$customer)->first();
        $data2 = Customer::where('id',$customer)->first();
        return view('front.appointment.createFromOffer',['offer'=>$offer,'data'=>$data,'data2' => $data2]);
    }

    public function store(Request $request)
    {        
        
        $customerId = $request->route('id');
        $cekboks = $request->get('appType');
        $deliveryAble = $request->get('deliverable');
        $isEmailSend = $request->get('isEmail');
        $isCustomEmailSend = $request->get('isCustomEmail');
        $customEmail = $request->get('customEmail');
        

        // Tanımlamalar
        $sub = '';
        $from = Company::InfoCompany('email'); // gösterilen mail.
        $companyName = Company::InfoCompany('name'); // şirket adı buraya yaz veritabanında yok çünkü.
        $customer=DB::table('customers')->where('id','=', $customerId)->value('name'); // Customer Name
        $customerSurname=DB::table('customers')->where('id','=', $customerId)->value('surname'); // Customer Surname
        $appointmentDate = collect([]);
        $appDateArray = [];
        $ADC = 0;

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

        if($cekboks == 2)
        {
        // Servis ekleme Alanı
            // Umzug Ekleme Alanı     
                $isUmzug = $request->get('isUmzug');
                $isUmzug2 = $request->get('isUmzug2');
                $isUmzug3 = $request->get('umzug3date');

                if($isUmzug)
                {            
                    $umzug1 = [
                        'umzugDate' => $request->umzug1date,
                        'umzugTime' => $request->umzug1time,
                        'workHours' => $request->umzug1hours,
                        'ma' => $request->umzug1ma,
                        'lkw' => $request->umzug1lkw,
                        'anhanger' => $request->umzug1anhanger, 
                        'calendarTitle' => $request->umzug1calendarTitle,
                        'calendarComment' => $request->umzug1calendarComment,
                        'calendarLocation' => $request->umzug1calendarLocation,             
                    ];
                    
                    $umzug1Olustur = UmzugService::create($umzug1);
                    
                    $umzugIdBul = DB::table('umzug_services')->orderBy('id','DESC')->first(); // Son Eklenen Umzug un id'si
                    $umzugId = $umzugIdBul->id;
                    $appDateArray[$ADC]['serviceId'] = $umzugId;
                    $appDateArray[$ADC]['date'] = $umzugIdBul->umzugDate;
                    $appDateArray[$ADC]['time'] = $umzugIdBul->umzugTime;
                    $appDateArray[$ADC]['endDate'] = $umzugIdBul->umzugDate;
                    $appDateArray[$ADC]['endTime'] = $umzugIdBul->umzugTime;
                    $appDateArray[$ADC]['calendarTitle'] = $umzugIdBul->calendarTitle;
                    $appDateArray[$ADC]['calendarComment'] = $umzugIdBul->calendarComment;
                    $appDateArray[$ADC]['calendarLocation'] = $umzugIdBul->calendarLocation;
                    $appDateArray[$ADC]['serviceName'] = 'Umzug';
                    $ADC++;
                    
                    
                }
                
                if($isUmzug2)
                {
                    $umzug2 = [
                        'umzugDate' => $request->umzug2date,
                        'umzugTime' => $request->umzug2time,
                        'workHours' => $request->umzug2hours,
                        'ma' => $request->umzug2ma,
                        'lkw' => $request->umzug2lkw,
                        'anhanger' => $request->umzug2anhanger,
                        'calendarTitle' => $request->umzug2calendarTitle,
                        'calendarComment' => $request->umzug2calendarComment,
                        'calendarLocation' => $request->umzug2calendarLocation,
                        
                    ];

                    $umzug2Olustur = UmzugService::create($umzug2);                   

                    $umzugId2Bul = DB::table('umzug_services')->orderBy('id','DESC')->first(); // Son Eklenen Umzug un id'si
                    $umzug2Id = $umzugId2Bul->id;
                    $appDateArray[$ADC]['serviceId'] = $umzug2Id;
                    $appDateArray[$ADC]['date'] = $umzugId2Bul->umzugDate;
                    $appDateArray[$ADC]['time'] = $umzugId2Bul->umzugTime;
                    $appDateArray[$ADC]['endDate'] = $umzugId2Bul->umzugDate;
                    $appDateArray[$ADC]['endTime'] = $umzugId2Bul->umzugTime;
                    $appDateArray[$ADC]['calendarTitle'] = $umzugId2Bul->calendarTitle;
                    $appDateArray[$ADC]['calendarComment'] = $umzugId2Bul->calendarComment;
                    $appDateArray[$ADC]['calendarLocation'] = $umzugId2Bul->calendarLocation;
                    $appDateArray[$ADC]['serviceName'] = 'Umzug 2';
                    
                    $ADC++;
                }

                
                if($isUmzug3)
                {
                    $umzug3 = [
                        'umzugDate' => $request->umzug3date,
                        'umzugTime' => $request->umzug3time,
                        'workHours' => $request->umzug3hours,
                        'ma' => $request->umzug3ma,
                        'lkw' => $request->umzug3lkw,
                        'anhanger' => $request->umzug3anhanger,
                        'calendarTitle' => $request->umzug3calendarTitle,
                        'calendarComment' => $request->umzug3calendarComment,
                        'calendarLocation' => $request->umzug3calendarLocation,
                        
                    ];

                    $umzug3Olustur = UmzugService::create($umzug3);
                    
                    $umzugId3Bul = DB::table('umzug_services')->orderBy('id','DESC')->first(); // Son Eklenen Umzug un id'si
                    $umzug3Id = $umzugId3Bul->id;
                    $appDateArray[$ADC]['serviceId'] = $umzug3Id;
                    $appDateArray[$ADC]['date'] = $umzugId3Bul->umzugDate;
                    $appDateArray[$ADC]['time'] = $umzugId3Bul->umzugTime;
                    $appDateArray[$ADC]['endDate'] = $umzugId3Bul->umzugDate;
                    $appDateArray[$ADC]['endTime'] = $umzugId3Bul->umzugTime;
                    $appDateArray[$ADC]['calendarTitle'] = $umzugId3Bul->calendarTitle;
                    $appDateArray[$ADC]['calendarComment'] = $umzugId3Bul->calendarComment;
                    $appDateArray[$ADC]['calendarLocation'] = $umzugId3Bul->calendarLocation;
                    $appDateArray[$ADC]['serviceName'] = 'Umzug 3';
                    $ADC++;
                }           
            // Umzug Ekleme Alanı Bitiş
        
            // Einpackservice Ekleme Alanı
                $isEinpack = $request->get('isEinpackservice');
                if($isEinpack)
                {
                    $einpack = [
                        'einpackDate' => $request->einpackdate,
                        'einpackTime' => $request->einpacktime,
                        'workHours' => $request->einpackhours,
                        'ma' => $request->einpackma,
                        'lkw' => $request->einpacklkw,
                        'anhanger' => $request->einpackanhanger,    
                        'calendarTitle' => $request->einpackcalendarTitle,
                        'calendarComment' => $request->einpackcalendarComment,
                        'calendarLocation' => $request->einpackcalendarLocation,           
                    ];

                    $einpackOlustur = EinpackService::create($einpack);
                    $einpackIdBul = DB::table('einpack_services')->orderBy('id','DESC')->first(); // Son Eklenen Einpack un id'si
                    $einpackId = $einpackIdBul->id;
                    $appDateArray[$ADC]['serviceId'] = $einpackId;
                    $appDateArray[$ADC]['date'] = $einpackIdBul->einpackDate;
                    $appDateArray[$ADC]['time'] = $einpackIdBul->einpackTime;
                    $appDateArray[$ADC]['endDate'] = $einpackIdBul->einpackDate;
                    $appDateArray[$ADC]['endTime'] = $einpackIdBul->einpackTime;
                    $appDateArray[$ADC]['calendarTitle'] = $einpackIdBul->calendarTitle;
                    $appDateArray[$ADC]['calendarComment'] = $einpackIdBul->calendarComment;
                    $appDateArray[$ADC]['calendarLocation'] = $einpackIdBul->calendarLocation;
                    $appDateArray[$ADC]['serviceName'] = 'Einpack';
                    $ADC++;
                }
            // Einpackservice Ekleme Alanı Bitiş

            // Auspackservice Ekleme Alanı
                $isAuspack = $request->get('isAuspackservice');
                if($isAuspack)
                {
                    $auspack = [
                        'auspackDate' => $request->auspackdate,
                        'auspackTime' => $request->auspacktime,
                        'workHours' => $request->auspackhours,
                        'ma' => $request->auspackma,
                        'lkw' => $request->auspacklkw,
                        'anhanger' => $request->auspackanhanger,    
                        'calendarTitle' => $request->auspackcalendarTitle,
                        'calendarComment' => $request->auspackcalendarComment,
                        'calendarLocation' => $request->auspackcalendarLocation,             
                    ];
        
                    $auspackOlustur = AuspackService::create($auspack);

                    $auspackIdBul = DB::table('auspack_services')->orderBy('id','DESC')->first(); // Son Eklenen Auspackservice un id'si
                    $auspackId = $auspackIdBul->id;
                    $appDateArray[$ADC]['serviceId'] = $auspackId;
                    $appDateArray[$ADC]['date'] = $auspackIdBul->auspackDate;
                    $appDateArray[$ADC]['time'] = $auspackIdBul->auspackTime;
                    $appDateArray[$ADC]['endDate'] = $auspackIdBul->auspackDate;
                    $appDateArray[$ADC]['endTime'] = $auspackIdBul->auspackTime;
                    $appDateArray[$ADC]['calendarTitle'] = $auspackIdBul->calendarTitle;
                    $appDateArray[$ADC]['calendarComment'] = $auspackIdBul->calendarComment;
                    $appDateArray[$ADC]['calendarLocation'] = $auspackIdBul->calendarLocation;
                    $appDateArray[$ADC]['serviceName'] = 'Auspack';
                    $ADC++;
                }
            // Auspackservice Ekleme Alanı Bitiş

            // Reinigung Ekleme Alanı
                $isReinigung = $request->get('isReinigung');
                if($isReinigung)
                {
                    $reinigung = [
                        'reinigungStartDate' => $request->reinigung1Startdate,
                        'reinigungStartTime' => $request->reinigung1Starttime,
                        'reinigungEndDate' => $request->reinigung1Enddate,
                        'reinigungEndTime' => $request->reinigung1Endtime,    
                        'calendarTitle' => $request->reinigungcalendarTitle,
                        'calendarComment' => $request->reinigungcalendarComment,
                        'calendarLocation' => $request->reinigungcalendarLocation,            
                    ];
        
                    $reinigungOlustur = ReinigungService::create($reinigung);

                    $reinigungIdBul = DB::table('reinigung_services')->orderBy('id','DESC')->first(); // Son Eklenen Reinigung un id'si
                    $reinigungId = $reinigungIdBul->id;
                    $appDateArray[$ADC]['serviceId'] = $reinigungId;
                    $appDateArray[$ADC]['date'] = $reinigungIdBul->reinigungStartDate;
                    $appDateArray[$ADC]['time'] = $reinigungIdBul->reinigungStartTime;
                    $appDateArray[$ADC]['endDate'] = $reinigungIdBul->reinigungEndDate ? $reinigungIdBul->reinigungEndDate : $reinigungIdBul->reinigungStartDate;
                    $appDateArray[$ADC]['endTime'] = $reinigungIdBul->reinigungEndTime;
                    $appDateArray[$ADC]['calendarTitle'] = $reinigungIdBul->calendarTitle;
                    $appDateArray[$ADC]['calendarComment'] = $reinigungIdBul->calendarComment;
                    $appDateArray[$ADC]['calendarLocation'] = $reinigungIdBul->calendarLocation;
                    $appDateArray[$ADC]['serviceName'] = 'Reinigung';
                    $ADC++;
                }
            // Reinigung Ekleme Alanı Bitiş

            // Reinigung 2 Ekleme Alanı
                $isReinigung2 = $request->get('isReinigung2');
                if($isReinigung2)
                {
                    $reinigung2 = [
                        'reinigungStartDate' => $request->reinigung2Startdate,
                        'reinigungStartTime' => $request->reinigung2Starttime,
                        'reinigungEndDate' => $request->reinigung2Enddate,
                        'reinigungEndTime' => $request->reinigung2Endtime,      
                        'calendarTitle' => $request->reinigung2calendarTitle,
                        'calendarComment' => $request->reinigung2calendarComment,
                        'calendarLocation' => $request->reinigung2calendarLocation,            
                    ];

                    $reinigung2Olustur = ReinigungService::create($reinigung2);
                    $reinigungId2Bul = DB::table('reinigung_services')->orderBy('id','DESC')->first(); // Son Eklenen Reinigung un id'si
                    $reinigung2Id = $reinigungId2Bul->id;
                    $appDateArray[$ADC]['serviceId'] = $reinigung2Id;
                    $appDateArray[$ADC]['date'] = $reinigungId2Bul->reinigungStartDate;
                    $appDateArray[$ADC]['time'] = $reinigungId2Bul->reinigungStartTime;
                    $appDateArray[$ADC]['endDate'] = $reinigungId2Bul->reinigungEndDate ? $reinigungId2Bul->reinigungEndDate : $reinigungId2Bul->reinigungStartDate;
                    $appDateArray[$ADC]['endTime'] = $reinigungId2Bul->reinigungEndTime;
                    $appDateArray[$ADC]['calendarTitle'] = $reinigungId2Bul->calendarTitle;
                    $appDateArray[$ADC]['calendarComment'] = $reinigungId2Bul->calendarComment;
                    $appDateArray[$ADC]['calendarLocation'] = $reinigungId2Bul->calendarLocation;
                    $appDateArray[$ADC]['serviceName'] = 'Reinigung 2';
                    $ADC++;
                }
            // Reinigung 2 Ekleme Alanı Bitiş

            // Entsorgung Ekleme Alanı
                $isEntsorgung = $request->get('isEntsorgung');
                if($isEntsorgung)
                {
                    $entsorgung = [
                        'entsorgungDate' => $request->entsorgungdate,
                        'entsorgungTime' => $request->entsorgungtime,
                        'workHours' => $request->entsorgunghours,
                        'ma' => $request->entsorgungma,   
                        'lkw' => $request->entsorgunglkw,     
                        'anhanger' => $request->entsorgunganhanger,     
                        'calendarTitle' => $request->entsorgungcalendarTitle,
                        'calendarComment' => $request->entsorgungcalendarComment,
                        'calendarLocation' => $request->entsorgungcalendarLocation,             
                    ];

                    $entsorgungOlustur = EntsorgungService::create($entsorgung);
                    $entsorgungIdBul = DB::table('entsorgung_services')->orderBy('id','DESC')->first(); // Son Eklenen Entsorgung un id'si
                    $entsorgungId = $entsorgungIdBul->id;
                    $appDateArray[$ADC]['serviceId'] = $entsorgungId;
                    $appDateArray[$ADC]['date'] = $entsorgungIdBul->entsorgungDate;
                    $appDateArray[$ADC]['time'] = $entsorgungIdBul->entsorgungTime;
                    $appDateArray[$ADC]['endDate'] = $entsorgungIdBul->entsorgungDate;
                    $appDateArray[$ADC]['endTime'] = $entsorgungIdBul->entsorgungTime;
                    $appDateArray[$ADC]['calendarTitle'] = $entsorgungIdBul->calendarTitle;
                    $appDateArray[$ADC]['calendarComment'] = $entsorgungIdBul->calendarComment;
                    $appDateArray[$ADC]['calendarLocation'] = $entsorgungIdBul->calendarLocation;
                    $appDateArray[$ADC]['serviceName'] = 'Entsorgung';
                    $ADC++;
                }
            // Entsorgung Ekleme Alanı Bitiş

            // Transport Ekleme Alanı
                $isTransport = $request->get('isTransport');
                if($isTransport)
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
                        'calendarTitle' => $request->transportcalendarTitle,
                        'calendarComment' => $request->transportcalendarComment,
                        'calendarLocation' => $request->transportcalendarLocation,                 
                    ];

                    $transportOlustur = TransportService::create($transport);
                    $transportIdBul = DB::table('transport_services')->orderBy('id','DESC')->first(); // Son Eklenen Transport un id'si
                    $transportId = $transportIdBul->id;
                    $appDateArray[$ADC]['serviceId'] = $transportId;
                    $appDateArray[$ADC]['date'] = $transportIdBul->transportDate;
                    $appDateArray[$ADC]['time'] = $transportIdBul->transportTime;
                    $appDateArray[$ADC]['endDate'] = $transportIdBul->transportDate;
                    $appDateArray[$ADC]['endTime'] = $transportIdBul->transportTime;
                    $appDateArray[$ADC]['calendarTitle'] = $transportIdBul->calendarTitle;
                    $appDateArray[$ADC]['calendarComment'] = $transportIdBul->calendarComment;
                    $appDateArray[$ADC]['calendarLocation'] = $transportIdBul->calendarLocation;
                    $appDateArray[$ADC]['serviceName'] = 'Transport';
                    $ADC++;
                }
            // Transport Ekleme Alanı Bitiş

            // Lagerung Ekleme Alanı
                $isLagerung = $request->get('isLagerung');
                if($isLagerung)
                {
                    $lagerung = [
                        'lagerungDate' => $request->lagerungdate,
                        'lagerungTime' => $request->lagerungtime, 
                        'calendarTitle' => $request->lagerungcalendarTitle,
                        'calendarComment' => $request->lagerungcalendarComment,
                        'calendarLocation' => $request->lagerungcalendarLocation,                 
                    ];

                    $lagerungOlustur = LagerungService::create($lagerung);
                    $lagerungIdBul = DB::table('lagerung_services')->orderBy('id','DESC')->first(); // Son Eklenen Lagerung un id'si
                    $lagerungId = $lagerungIdBul->id;
                    $appDateArray[$ADC]['serviceId'] = $lagerungId;
                    $appDateArray[$ADC]['date'] = $lagerungIdBul->lagerungDate;
                    $appDateArray[$ADC]['time'] = $lagerungIdBul->lagerungTime;
                    $appDateArray[$ADC]['endDate'] = $lagerungIdBul->lagerungDate;
                    $appDateArray[$ADC]['endTime'] = $lagerungIdBul->lagerungTime;
                    $appDateArray[$ADC]['calendarTitle'] = $lagerungIdBul->calendarTitle;
                    $appDateArray[$ADC]['calendarComment'] = $lagerungIdBul->calendarComment;
                    $appDateArray[$ADC]['calendarLocation'] = $lagerungIdBul->calendarLocation;
                    $appDateArray[$ADC]['serviceName'] = 'Lagerung';
                    $ADC++;
                }
            // Lagerung Ekleme Alanı Bitiş
    
            
        // Servis ekleme Alanı Bitiş
        }

        // Keşif Randevusu
        $appointment = [
            'contactType' => $request->contactType,
            'address' => $request->address,
            'date'=> $request->date,
            'time'=> $request->time,
            'calendarTitle'=>$request->calendarTitle,
            'calendarContent'=>$request->calendarContent,
            'customerId' => $customerId
        ];

        

        // Onay Randevusu
        $appointmentService = [
            'paymentType' => $request->paymentType,
            'address' => $request->address,
            'calendarTitle' => $request->calendarTitle,
            'calendarContent' => $request->calendarContent,
            'customerId' => $customerId,
            'umzugId' => $umzugId,
            'umzug2Id'=> $umzug2Id,
            'umzug3Id' => $umzug3Id,
            'einpackId' => $einpackId,
            'auspackId' => $auspackId,
            'reinigungId' => $reinigungId,
            'reinigung2Id' => $reinigung2Id,
            'entsorgungId' => $entsorgungId,
            'transportId' => $transportId,
            'lagerungId' => $lagerungId

        ];

        // Teslimat Randevusu
        $appointmentMaterial = [
            'deliverable' => $request->deliverable,
            'deliveryType' => $request->deliveryType,
            'meetingDate'=> $request->meetingDate,
            'meetingHour1'=> $request->meetingHour1,
            'meetingHour2'=>$request->meetingHour2,
            'address' => $request->address,
            'calendarTitle' => $request->calendarTitle,
            'calendarContent' => $request->calendarContent,
            'customerId' => $customerId
        ];

        if ($deliveryAble == 1)
        {
            $appointmentMaterial['deliveryType'] = NULL;
        }
        
        
        $all = NULL;
        switch($cekboks){
            case(1);
                $sub = 'Terminbestätigung Swiss Transport';
                $appDateArray = [];
                $appDateArray[$ADC]['serviceId'] = NULL;
                $appDateArray[$ADC]['date'] = $appointment['date'];
                $appDateArray[$ADC]['time'] = $appointment['time'];
                $appDateArray[$ADC]['endDate'] =  $appointment['date'];
                $appDateArray[$ADC]['endTime'] = $appointment['time'];
                $appDateArray[$ADC]['calendarTitle'] =$request->calendarTitle;
                $appDateArray[$ADC]['calendarComment'] = $request->calendarContent;
                $appDateArray[$ADC]['calendarLocation'] = $request->address;
                $appDateArray[$ADC]['serviceName'] = 'Besichtigung';
                $ADC++;
                $appointmentDate =  $appDateArray;
                           
                $all = Appointment::create($appointment);
                $randevuTipi = 'Besichtigung';
            break;
            case(2);
                $sub = 'Terminbestätigung Swiss Transport';
                $randevuTipi = 'Auftragsbestätigung';
                $appointmentDate = $appDateArray;
                $all = AppoinmentService::create($appointmentService);

            break;
            case(3);
                $sub = 'Terminbestätigung Swiss Transport';
                $appDateArray = [];
                $appDateArray[$ADC]['serviceId'] = NULL;
                $appDateArray[$ADC]['date'] = $appointmentMaterial['meetingDate'];
                $appDateArray[$ADC]['time'] = $appointmentMaterial['meetingHour1'];
                $appDateArray[$ADC]['endDate'] =  $appointmentMaterial['meetingDate'];
                $appDateArray[$ADC]['endTime'] = $appointmentMaterial['meetingHour1'];
                $appDateArray[$ADC]['calendarTitle'] =$request->calendarTitle;
                $appDateArray[$ADC]['calendarComment'] = $request->calendarContent;
                $appDateArray[$ADC]['calendarLocation'] = $request->address;
                $appDateArray[$ADC]['serviceName'] = 'Lieferung';
                $ADC++;
                $all = AppointmentMaterial::create($appointmentMaterial);
                $randevuTipi = 'Lieferung';
            break;
            

        }
          
        $customerData = Customer::where('id',$customerId)->first();
        $emailData = [
            'name' => $customer,
            'gender' => $customerData['gender'],
            'surname' => $customerSurname,
            'address' => $request->address,
            'sub' => $sub,
            'from' => $from,
            'companyName' => $companyName,
            'email' => $request->email,
            'appDate' =>$appDateArray,
            'emailContent'=> $request->emailContent,
            'isCustomEmailSend' => $isCustomEmailSend,
            'customEmailContent' => $customEmail,
            'randevuTipi' => $randevuTipi,
        ];

      

        if ($isCustomEmailSend)
        {
            Arr::set($emailData, 'customEmailContent', $customEmail);
        }
        


        if($all)
        {   
            $mailSuccess = '';
            if($isEmailSend)
            {
                Mail::to($emailData['email'])->send(new InformationMail($emailData));
                // Mail::to($from)->send(new CompanyMail($emailData)); // Firmaya Takvime Eklendi Bildirimi
                $mailSuccess = ', Mail Başarıyla Gönderildi';
            }             
            foreach ($appDateArray as $item) {
                $fullDate = $item['date'].' '.$item['time'];
                $endDate = $item['endDate'].' '.$item['endTime'];
                $location = $item['calendarLocation'];
                $title = $item['calendarTitle'];
                $comment =  $item['calendarComment'];
                $serviceId = $item['serviceId'];
                calendarHelper::companyMail($item['serviceName'],$fullDate,$customer,$customerSurname,$customerData['gender'],$location,$title,$comment,$endDate,$serviceId);
            }     
            return redirect()
            ->route('customer.detail', ['id' => $customerId])
            ->with('status', $randevuTipi.' '.'Randevusu Başarıyla Eklendi'.' '.$mailSuccess)
            ->with('cat','Termine')
            ->withInput()
            ->with('keep_status', true);
        }
        else {
            return redirect()->back()->with('status-err','Hata:Randevu Eklenemedi, Mail Gönderilemedi');
        }
    }

    public function data(Request $request)
    {
        $appType = $request->get('appType');

        $array = [];
        $i = 0;

        $customerId = $request->route('id');
        
        $table=DB::table('appointments')->where('customerId','=', $customerId)->get()->toArray();   
        if($table)
        {
            foreach($table as $k=>$v)
            {
                $array[$i]["aid"] = $i+1;
                $array[$i]["id"] = $v->id;
                $array[$i]["appType"] = 1 ? 'Besichtigung' : '*';
                $array[$i]["adres"] = $v->address;
                $array[$i]["tarih"] = date('d-m-Y H:i:s', strtotime($v->created_at)); 
                
                $i++;

            }
        }

        $table2=DB::table('appointment_materials')->where('customerId','=', $customerId)->get()->toArray();   
        if($table2)
        {
            foreach($table2 as $k=>$v)
            {
                $array[$i]["aid"] = $i+1;
                $array[$i]["id"] = $v->id;
                $array[$i]["appType"] = 3 ? 'Lieferung': '*';
                $array[$i]["adres"] = $v->address;
                $array[$i]["tarih"] = date('d-m-Y H:i:s', strtotime($v->created_at)); 
                $i++;

            }
        }

        

        $table3=DB::table('appoinment_services')->where('customerId','=', $customerId)->get()->toArray();   
        if($table3)
        {
            $j = 0;
            $tableService=AppoinmentService::where('customerId',$customerId)->get()->toArray();
            foreach($table3 as $k=>$v)
            {
               
                $array[$i]["aid"] = $i+1;
                $array[$i]["id"] = $v->id;
                $array[$i]["appType"] = 3 ? 'Auftragsbestätigung': '*';
                $array[$i]["adres"] = $v->address;
                $array[$i]["tarih"] = date('d-m-Y H:i:s', strtotime($v->created_at));                
                $i++;   
                $j++;             

            }
        }
       

        $data=DataTables::of($array)
        ->addColumn('option',function($array) 
        {
            switch($array['appType'])
            {
                case('Besichtigung');
                    return '
                    <a class="btn btn-sm  btn-primary" href="'.route('appointment.detail',['id'=>$array['id']]).'"><i class="feather feather-eye" ></i></a> <span class="text-primary">|</span>
                    <a class="btn btn-sm  btn-edit" href="'.route('appointment.edit',['id'=>$array['id']]).'"><i class="feather feather-edit" ></i></a> <span class="text-primary">|</span>
                    <a class="btn btn-sm  btn-danger"  href="'.route('appointment.delete',['id'=>$array['id']]).'"><i class="feather feather-trash-2" ></i></a>';
                break;
                case('Auftragsbestätigung');
                    return '
                    <a class="btn btn-sm  btn-primary" href="'.route('appointmentService.detail',['id'=>$array['id']]).'"><i class="feather feather-eye" ></i></a> <span class="text-primary">|</span>
                    <a class="btn btn-sm  btn-edit" href="'.route('appointmentService.edit',['id'=>$array['id']]).'"><i class="feather feather-edit" ></i></a> <span class="text-primary">|</span>
                    <a class="btn btn-sm  btn-danger"  href="'.route('appointmentService.delete',['id'=>$array['id']]).'"><i class="feather feather-trash-2" ></i></a>';
                break;
                case('Lieferung');
                    return '
                    <a class="btn btn-sm  btn-primary" href="'.route('appointmentMaterial.detail',['id'=>$array['id']]).'"><i class="feather feather-eye" ></i></a> <span class="text-primary">|</span>
                    <a class="btn btn-sm  btn-edit" href="'.route('appointmentMaterial.edit',['id'=>$array['id']]).'"><i class="feather feather-edit" ></i></a> <span class="text-primary">|</span>
                    <a class="btn btn-sm  btn-danger"  href="'.route('appointmentMaterial.delete',['id'=>$array['id']]).'"><i class="feather feather-trash-2" ></i></a>';
                break;
            }

        })
        
        ->rawColumns(['option'])
        ->make(true);


        return $data;
    }

    public function edit(Request $request)
    {
        $id = $request->route('id');
        $c = Appointment::where('id',$id)->count();

        if($c !=0)
        {
            $data = Appointment::where('id',$id)->first();
            $data2 = Customer::where('id',$data['customerId'])->first();
            return view ('front.appointment.edit', ['data' => $data,'data2' => $data2]);
        }
    }

    public function detail(Request $request)
    {
        $id = $request->route('id');
        $c = Appointment::where('id',$id)->count();

        if($c !=0)
        {
            $data = Appointment::where('id',$id)->first();
            $data2 = Customer::where('id',$data['customerId'])->first();
            return view ('front.appointment.detail', ['data' => $data,'data2' => $data2]);
        }
    }


    public function update(Request $request)
    {


        $id = $request->route('id');
        $c = Appointment::where('id',$id)->count();
        $d = Appointment::where('id',$id)->first();  
        $customer = Customer::where('id',$d['customerId'])->first();
        
             
        $customerId = Customer::where('id','=',$d['customerId'])->first('id');
        $isEmailSend = $request->get('isEmail');
        $isCustomEmailSend = $request->get('isCustomEmail');
        $customEmail = $request->get('customEmail');

        $ADC = 0;

        $appDateArray = [];
        $appDateArray[$ADC]['date'] = $request->date;
        $appDateArray[$ADC]['endDate'] = $request->date;
        $appDateArray[$ADC]['time'] = $request->time;
        $appDateArray[$ADC]['endTime'] = $request->time;
        $appDateArray[$ADC]['calendarTitle'] = $request->calendarTitle;
        $appDateArray[$ADC]['calendarComment'] = $request->calendarContent;
        $appDateArray[$ADC]['calendarLocation'] = $request->address;
        $appDateArray[$ADC]['serviceName'] = 'Besichtigung';
        $ADC++;
       

        $sub = 'Terminbestätigung Swiss Transport';
        $from = Company::InfoCompany('email'); // gösterilen mail.
        $companyName = Company::InfoCompany('name'); // şirket adı buraya yaz veritabanında yok çünkü.
        $randevuTipi = 'Besichtigung';
        
        $emailData = [
            'name' => $customer['name'],
            'gender' => $customer['gender'],
            'surname' => $customer['surname'],
            'address' => $request->address,
            'sub' => $sub,
            'from' => $from,
            'companyName' => $companyName,
            'email' => $request->email,
            'appDate' =>$appDateArray,
            'emailContent'=> $request->emailContent,
            'isCustomEmailSend' => $isCustomEmailSend,
            'customEmailContent' => $customEmail,
            'randevuTipi' => $randevuTipi,
        ];

        if ($isCustomEmailSend)
        {
            Arr::set($emailData, 'customEmailContent', $customEmail);
        }


        if($c !=0)
        {
 
            
            $all = $request->except('_token','email','customEmail','isEmail','emailContent','isCustomEmail');
            

            $update = Appointment::where('id',$id)->update($all);
            if($update) 
            {
                $mailSuccess = '';
                if($isEmailSend)
                {
                    
                    Mail::to($emailData['email'])->send(new InformationMail($emailData));
                    // Mail::to($from)->send(new CompanyMail($emailData)); // Firmaya Takvime Eklendi Bildirimi
                    $mailSuccess = 'Mail Başarıyla Gönderildi';
                }          
                return redirect()
                ->route('customer.detail', ['id' => $customerId])
                ->with('status', 'Keşif Randevusu Başarıyla Düzenlendi'.' '.$mailSuccess)
                ->with('cat','Termine')
                ->withInput()
                ->with('keep_status', true);
                return redirect()->back()->with('status','Keşif Randevusu Başarıyla Düzenlendi'.' '.$mailSuccess );
            }
            else {
                return redirect()->back()->with('status-danger','HATA:Keşif Randevusu Düzenlenemedi');
            }
        }
    }

    public function delete($id)
    {

        $c = Appointment::where('id',$id)->count();
        $appointment = Appointment::where('id',$id)->first();
        $customerId = $appointment['customerId'];
        if($c !=0)
        {
            $data = Appointment::where('id',$id)->get();
            Appointment::where('id',$id)->delete();
            return redirect()
                ->route('customer.detail', ['id' => $customerId])
                ->with('status', 'Keşif Randevusu Başarıyla Silindi')
                ->with('cat','Termine')
                ->withInput()
                ->with('keep_status', true);
        }
        else {
            return redirect('/');
        }
    }
    
}
