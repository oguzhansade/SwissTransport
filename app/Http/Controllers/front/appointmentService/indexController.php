<?php

namespace App\Http\Controllers\front\appointmentService;

use App\Helper\calendarEditHelper;
use App\Helper\calendarHelper;
use App\Helper\calendarUpdate;
use App\Http\Controllers\Controller;
use App\Mail\CompanyMail;
use App\Mail\InformationMail;
use App\Models\AppoinmentService;
use App\Models\Appointment;
use App\Models\AppointmentService;
use App\Models\AuspackService;
use App\Models\Calendar;
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
use Spatie\GoogleCalendar\Event;

class indexController extends Controller
{
    public function edit(Request $request)
    {
        $id = $request->route('id');
        $c = AppoinmentService::where('id', $id)->count();

        if ($c != 0) {
            $data = AppoinmentService::where('id', $id)->first();
            $data2 = Customer::where('id', $data['customerId'])->first();
            $dataUmzug = UmzugService::where('id', $data['umzugId'])->first();
            $dataUmzug2 = UmzugService::where('id', $data['umzug2Id'])->first();
            $dataUmzug3 = UmzugService::where('id', $data['umzug3Id'])->first();
            $dataEinpack = EinpackService::where('id', $data['einpackId'])->first();
            $dataAuspack = AuspackService::where('id', $data['auspackId'])->first();
            $dataReinigung = ReinigungService::where('id', $data['reinigungId'])->first();
            $dataReinigung2 = ReinigungService::where('id', $data['reinigung2Id'])->first();
            $dataEntsorgung = EntsorgungService::where('id', $data['entsorgungId'])->first();
            $dataTransport = TransportService::where('id', $data['transportId'])->first();
            $dataLagerung = LagerungService::where('id', $data['lagerungId'])->first();
            return view(
                'front.appointmentService.edit',
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
        $c = AppoinmentService::where('id', $id)->count();

        if ($c != 0) {
            $data = AppoinmentService::where('id', $id)->first();
            $data2 = Customer::where('id', $data['customerId'])->first();
            $dataUmzug = UmzugService::where('id', $data['umzugId'])->first();
            $dataUmzug2 = UmzugService::where('id', $data['umzug2Id'])->first();
            $dataUmzug3 = UmzugService::where('id', $data['umzug3Id'])->first();
            $dataEinpack = EinpackService::where('id', $data['einpackId'])->first();
            $dataAuspack = AuspackService::where('id', $data['auspackId'])->first();
            $dataReinigung = ReinigungService::where('id', $data['reinigungId'])->first();
            $dataReinigung2 = ReinigungService::where('id', $data['reinigung2Id'])->first();
            $dataEntsorgung = EntsorgungService::where('id', $data['entsorgungId'])->first();
            $dataTransport = TransportService::where('id', $data['transportId'])->first();
            $dataLagerung = LagerungService::where('id', $data['lagerungId'])->first();
            return view(
                'front.appointmentService.detail',
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
        $c = AppoinmentService::where('id', $id)->count();

        $d = AppoinmentService::where('id', $id)->first();
        $customerId = Customer::where('id', '=', $d['customerId'])->first();
        $isEmailSend = $request->get('isEmail');
        $isCustomEmailSend = $request->get('isCustomEmail');
        $customEmail = $request->get('customEmail');


        $appDateArray = [];
        $ADC = 0;


        $sub = 'Ihr Auftragsbestätigungstermin wurde aktualisiert';

        $from = Company::InfoCompany('email'); // gösterilen mail.
        $companyName = Company::InfoCompany('name'); // şirket adı buraya yaz veritabanında yok çünkü.
        $customer = DB::table('customers')->where('id', '=', $customerId['id'])->value('name');
        $customerSurname = DB::table('customers')->where('id', '=', $customerId['id'])->value('surname');
        $customerData = Customer::where('id', $customerId['id'])->first();


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


        if ($isCustomEmailSend) {
            Arr::set($emailData, 'customEmailContent', $customEmail);
        }

        if ($c != 0) {
            // Umzug Güncelleme
            $isUmzug = $request->get('isUmzug');
            if ($isUmzug && $request->umzug1date) {
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

                $umzug1Date = UmzugService::where('id', $d['umzugId'])->first();
                if ($umzug1Date) {
                    $umzug1Guncelle = UmzugService::where('id', $d['umzugId'])->update($umzug1);
                    $umzugId = $d['umzugId'];

                    $appDateArray[$ADC]['serviceId'] =  $umzugId;
                    $appDateArray[$ADC]['date'] = $umzug1['umzugDate'];
                    $appDateArray[$ADC]['time'] = $umzug1['umzugTime'];
                    $appDateArray[$ADC]['endDate'] = $umzug1['umzugDate'];
                    $appDateArray[$ADC]['endTime'] = $umzug1['umzugTime'];
                    $appDateArray[$ADC]['calendarTitle'] = $umzug1['calendarTitle'];
                    $appDateArray[$ADC]['calendarComment'] = $umzug1['calendarComment'];
                    $appDateArray[$ADC]['calendarLocation'] = $umzug1['calendarLocation'];
                    $appDateArray[$ADC]['serviceName'] = 'Umzug';
                    $ADC++;
                    $calendar = Calendar::where('serviceId', $umzugId)->first();
                    $eventId = $calendar['eventId'];
                } else {
                    $umzug1Olustur = UmzugService::create($umzug1);
                    $umzugIdBul = DB::table('umzug_services')->orderBy('id', 'DESC')->first(); // Son Eklenen Umzug un id'si
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
            } else {
                UmzugService::where('id', $d['umzugId'])->delete(); // Düğme Kapanırsa Silinir
                $calendar = Calendar::where('serviceId', $d['umzugId'])->first();
                if ($calendar) {
                    $event = Event::find($calendar['eventId']);
                    $event->delete($calendar['eventId']);
                    Calendar::where('serviceId', $d['umzugId'])->delete();
                }
            }
            // Umzug 2 Güncelleme
            $isUmzug2 = $request->get('isUmzug2');
            if ($isUmzug2 && $request->umzug2date) {
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

                $umzug2Date = UmzugService::where('id', $d['umzug2Id'])->first();
                if ($umzug2Date) {

                    $umzug2Guncelle = UmzugService::where('id', $d['umzug2Id'])->update($umzug2);
                    $umzug2Id = $d['umzug2Id'];
                    $appDateArray[$ADC]['serviceId'] = $umzug2Id;
                    $appDateArray[$ADC]['date'] = $umzug2['umzugDate'];
                    $appDateArray[$ADC]['time'] = $umzug2['umzugTime'];
                    $appDateArray[$ADC]['endDate'] = $umzug2['umzugDate'];
                    $appDateArray[$ADC]['endTime'] = $umzug2['umzugTime'];
                    $appDateArray[$ADC]['calendarTitle'] = $umzug2['calendarTitle'];
                    $appDateArray[$ADC]['calendarComment'] = $umzug2['calendarComment'];
                    $appDateArray[$ADC]['calendarLocation'] = $umzug2['calendarLocation'];
                    $appDateArray[$ADC]['serviceName'] = 'Umzug 2';

                    $ADC++;
                } else {
                    $umzug2Olustur = UmzugService::create($umzug2);
                    $umzug2IdBul = DB::table('umzug_services')->orderBy('id', 'DESC')->first(); // Son Eklenen Umzug un id'si
                    $umzug2Id = $umzug2IdBul->id;
                    $appDateArray[$ADC]['serviceId'] = $umzug2Id;
                    $appDateArray[$ADC]['date'] = $umzug2IdBul->umzugDate;
                    $appDateArray[$ADC]['time'] = $umzug2IdBul->umzugTime;
                    $appDateArray[$ADC]['endDate'] = $umzug2IdBul->umzugDate;
                    $appDateArray[$ADC]['endTime'] = $umzug2IdBul->umzugTime;
                    $appDateArray[$ADC]['calendarTitle'] = $umzug2IdBul->calendarTitle;
                    $appDateArray[$ADC]['calendarComment'] = $umzug2IdBul->calendarComment;
                    $appDateArray[$ADC]['calendarLocation'] = $umzug2IdBul->calendarLocation;
                    $appDateArray[$ADC]['serviceName'] = 'Umzug 2';
                    $ADC++;
                }
            } else {
                UmzugService::where('id', $d['umzug2Id'])->delete();
                $calendar = Calendar::where('serviceId', $d['umzug2Id'])->first();

                if ($calendar) {
                    $event = Event::find($calendar['eventId']);
                    $event->delete($calendar['eventId']);
                    Calendar::where('serviceId', $d['umzug2Id'])->delete();
                }
                // Düğme Kapanırsa Silinir

            }
            // Umzug 3 Güncelleme
            $isUmzug3 = $request->get('umzug3date');
            if ($isUmzug3) {
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

                $umzug3Date = UmzugService::where('id', $d['umzug3Id'])->first();

                if ($umzug3Date) {
                    $umzug3Guncelle = UmzugService::where('id', $d['umzug3Id'])->update($umzug3);
                    $umzug3Id = $d['umzug3Id'];
                    $appDateArray[$ADC]['serviceId'] = $umzug3Id;
                    $appDateArray[$ADC]['date'] = $umzug3['umzugDate'];
                    $appDateArray[$ADC]['time'] = $umzug3['umzugTime'];
                    $appDateArray[$ADC]['endDate'] = $umzug3['umzugDate'];
                    $appDateArray[$ADC]['endTime'] = $umzug3['umzugTime'];
                    $appDateArray[$ADC]['calendarTitle'] = $umzug3['calendarTitle'];
                    $appDateArray[$ADC]['calendarComment'] = $umzug3['calendarComment'];
                    $appDateArray[$ADC]['calendarLocation'] = $umzug3['calendarLocation'];
                    $appDateArray[$ADC]['serviceName'] = 'Umzug 3';
                    $ADC++;
                } else {
                    $umzug3Olustur = UmzugService::create($umzug3);
                    $umzug3IdBul = DB::table('umzug_services')->orderBy('id', 'DESC')->first(); // Son Eklenen Umzug un id'si
                    $umzug3Id = $umzug3IdBul->id;
                    $appDateArray[$ADC]['serviceId'] = $umzug3Id;
                    $appDateArray[$ADC]['date'] = $umzug3IdBul->umzugDate;
                    $appDateArray[$ADC]['time'] = $umzug3IdBul->umzugTime;
                    $appDateArray[$ADC]['endDate'] = $umzug3IdBul->umzugDate;
                    $appDateArray[$ADC]['endTime'] = $umzug3IdBul->umzugTime;
                    $appDateArray[$ADC]['calendarTitle'] = $umzug3IdBul->calendarTitle;
                    $appDateArray[$ADC]['calendarComment'] = $umzug3IdBul->calendarComment;
                    $appDateArray[$ADC]['calendarLocation'] = $umzug3IdBul->calendarLocation;
                    $appDateArray[$ADC]['serviceName'] = 'Umzug 3';
                    $ADC++;
                }
            } else {
                UmzugService::where('id', $d['umzug3Id'])->delete();
                $calendar = Calendar::where('serviceId', $d['umzug3Id'])->first();
                if ($calendar) {
                    $event = Event::find($calendar['eventId']);
                    $event->delete($calendar['eventId']);
                    Calendar::where('serviceId', $d['umzug3Id'])->delete();
                }
            }


            // Einpack Güncelleme
            $isEinpack = $request->get('isEinpackservice');
            if ($isEinpack && $request->einpackdate) {
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

                $einpackDate = EinpackService::where('id', $d['einpackId'])->first();
                if ($einpackDate) {

                    $einpackGuncelle = EinpackService::where('id', $d['einpackId'])->update($einpack);
                    $einpackId = $d['einpackId'];
                    $appDateArray[$ADC]['serviceId'] = $einpackId;
                    $appDateArray[$ADC]['date'] = $einpack['einpackDate'];
                    $appDateArray[$ADC]['time'] = $einpack['einpackTime'];
                    $appDateArray[$ADC]['endDate'] = $einpack['einpackDate'];
                    $appDateArray[$ADC]['endTime'] = $einpack['einpackTime'];
                    $appDateArray[$ADC]['calendarTitle'] = $einpack['calendarTitle'];
                    $appDateArray[$ADC]['calendarComment'] = $einpack['calendarComment'];
                    $appDateArray[$ADC]['calendarLocation'] = $einpack['calendarLocation'];
                    $appDateArray[$ADC]['serviceName'] = 'Einpack';
                    $ADC++;
                } else {
                    $einpackOlustur = EinpackService::create($einpack);
                    $einpackIdBul = DB::table('einpack_services')->orderBy('id', 'DESC')->first(); // Son Eklenen Umzug un id'si
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
            } else {
                EinpackService::where('id', $d['einpackId'])->delete(); // Düğme Kapanırsa Silinir
                $calendar = Calendar::where('serviceId', $d['einpackId'])->first();
                if ($calendar) {
                    $event = Event::find($calendar['eventId']);
                    $event->delete($calendar['eventId']);
                    Calendar::where('serviceId', $d['einpackId'])->delete();
                }
            }

            // Auspack Güncelleme
            $isAuspack = $request->get('isAuspackservice');
            if ($isAuspack && $request->auspackdate) {
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

                $auspackDate = AuspackService::where('id', $d['auspackId'])->first();
                if ($auspackDate) {
                    $auspackGuncelle = AuspackService::where('id', $d['auspackId'])->update($auspack);
                    $auspackId = $d['auspackId'];
                    $appDateArray[$ADC]['serviceId'] = $auspackId;
                    $appDateArray[$ADC]['date'] = $auspack['auspackDate'];
                    $appDateArray[$ADC]['time'] = $auspack['auspackTime'];
                    $appDateArray[$ADC]['endDate'] = $auspack['auspackDate'];
                    $appDateArray[$ADC]['endTime'] = $auspack['auspackTime'];
                    $appDateArray[$ADC]['calendarTitle'] = $auspack['calendarTitle'];
                    $appDateArray[$ADC]['calendarComment'] = $auspack['calendarComment'];
                    $appDateArray[$ADC]['calendarLocation'] = $auspack['calendarLocation'];
                    $appDateArray[$ADC]['serviceName'] = 'Auspack';
                    $ADC++;
                } else {
                    $auspackOlustur = AuspackService::create($auspack);
                    $auspackIdBul = DB::table('auspack_services')->orderBy('id', 'DESC')->first(); // Son Eklenen Umzug un id'si
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
            } else {
                AuspackService::where('id', $d['auspackId'])->delete(); // Düğme Kapanırsa Silinir
                $calendar = Calendar::where('serviceId', $d['auspackId'])->first();
                if ($calendar) {
                    $event = Event::find($calendar['eventId']);
                    $event->delete($calendar['eventId']);
                    Calendar::where('serviceId', $d['auspackId'])->delete();
                }
            }


            // Reinigung Güncelleme
            $isReinigung = $request->get('isReinigung');
            if ($isReinigung && $request->reinigung1Startdate) {
                $reinigung = [
                    'reinigungStartDate' => $request->reinigung1Startdate,
                    'reinigungStartTime' => $request->reinigung1Starttime,
                    'reinigungEndDate' => $request->reinigung1Enddate,
                    'reinigungEndTime' => $request->reinigung1Endtime,
                    'calendarTitle' => $request->reinigungcalendarTitle,
                    'calendarComment' => $request->reinigungcalendarComment,
                    'calendarLocation' => $request->reinigungcalendarLocation,
                ];
                $reinigungDate = ReinigungService::where('id', $d['reinigungId'])->first();
                if ($reinigungDate) {
                    $reinigungGuncelle = ReinigungService::where('id', $d['reinigungId'])->update($reinigung);
                    $reinigungId = $d['reinigungId'];
                    $appDateArray[$ADC]['serviceId'] = $reinigungId;
                    $appDateArray[$ADC]['date'] = $reinigung['reinigungStartDate'];
                    $appDateArray[$ADC]['time'] = $reinigung['reinigungStartTime'];
                    $appDateArray[$ADC]['endDate'] = $reinigung['reinigungEndDate'] ? $reinigung['reinigungEndDate'] : $reinigung['reinigungStartDate'];
                    $appDateArray[$ADC]['endTime'] = $reinigung['reinigungEndTime'];
                    $appDateArray[$ADC]['calendarTitle'] = $reinigung['calendarTitle'];
                    $appDateArray[$ADC]['calendarComment'] = $reinigung['calendarComment'];
                    $appDateArray[$ADC]['calendarLocation'] = $reinigung['calendarLocation'];
                    $appDateArray[$ADC]['serviceName'] = 'Reinigung';

                    $ADC++;
                } else {
                    $reinigungOlustur = ReinigungService::create($reinigung);
                    $reinigungIdBul = DB::table('reinigung_services')->orderBy('id', 'DESC')->first(); // Son Eklenen Reinigung un id'si
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
            } else {
                ReinigungService::where('id', $d['reinigungId'])->delete(); // Düğme Kapanırsa Silinir
                $calendar = Calendar::where('serviceId', $d['reinigungId'])->first();
                if ($calendar) {
                    $event = Event::find($calendar['eventId']);
                    $event->delete($calendar['eventId']);
                    Calendar::where('serviceId', $d['reinigungId'])->delete();
                }
            }

            // Reinigung 2 Güncelleme
            $isReinigung2 = $request->get('isReinigung2');
            if ($isReinigung2 && $request->reinigung2Startdate) {
                $reinigung2 = [
                    'reinigungStartDate' => $request->reinigung2Startdate,
                    'reinigungStartTime' => $request->reinigung2Starttime,
                    'reinigungEndDate' => $request->reinigung2Enddate,
                    'reinigungEndTime' => $request->reinigung2Endtime,
                    'calendarTitle' => $request->reinigung2calendarTitle,
                    'calendarComment' => $request->reinigung2calendarComment,
                    'calendarLocation' => $request->reinigung2calendarLocation,
                ];
                $reinigung2Date = ReinigungService::where('id', $d['reinigung2Id'])->first();
                if ($reinigung2Date) {
                    $reinigung2Guncelle = ReinigungService::where('id', $d['reinigung2Id'])->update($reinigung2);
                    $reinigung2Id = $d['reinigung2Id'];
                    $appDateArray[$ADC]['serviceId'] = $reinigung2Id;
                    $appDateArray[$ADC]['date'] = $reinigung2['reinigungStartDate'];
                    $appDateArray[$ADC]['time'] = $reinigung2['reinigungStartTime'];
                    $appDateArray[$ADC]['endDate'] = $reinigung2['reinigungEndDate'] ? $reinigung2['reinigungEndDate'] : $reinigung2['reinigungStartDate'];
                    $appDateArray[$ADC]['endTime'] = $reinigung2['reinigungEndTime'];
                    $appDateArray[$ADC]['calendarTitle'] = $reinigung2['calendarTitle'];
                    $appDateArray[$ADC]['calendarComment'] = $reinigung2['calendarComment'];
                    $appDateArray[$ADC]['calendarLocation'] = $reinigung2['calendarLocation'];
                    $appDateArray[$ADC]['serviceName'] = 'Reinigung 2';

                    $ADC++;
                } else {
                    $reinigung2Olustur = ReinigungService::create($reinigung);
                    $reinigung2IdBul = DB::table('reinigung_services')->orderBy('id', 'DESC')->first(); // Son Eklenen Reinigung un id'si
                    $reinigung2Id = $reinigung2IdBul->id;
                    $appDateArray[$ADC]['serviceId'] = $reinigung2Id;
                    $appDateArray[$ADC]['date'] = $reinigung2IdBul->reinigungStartDate;
                    $appDateArray[$ADC]['time'] = $reinigung2IdBul->reinigungStartTime;
                    $appDateArray[$ADC]['endDate'] = $reinigung2IdBul->reinigungEndDate ? $reinigung2IdBul->reinigungEndDate : $reinigung2IdBul->reinigungStartDate;
                    $appDateArray[$ADC]['endTime'] = $reinigung2IdBul->reinigungEndTime;
                    $appDateArray[$ADC]['calendarTitle'] = $reinigung2IdBul->calendarTitle;
                    $appDateArray[$ADC]['calendarComment'] = $reinigung2IdBul->calendarComment;
                    $appDateArray[$ADC]['calendarLocation'] = $reinigung2IdBul->calendarLocation;
                    $appDateArray[$ADC]['serviceName'] = 'Reinigung 2';
                    $ADC++;
                }
            } else {
                ReinigungService::where('id', $d['reinigung2Id'])->delete(); // Düğme Kapanırsa Silinir
                $calendar = Calendar::where('serviceId', $d['reinigung2Id'])->first();
                if ($calendar) {
                    $event = Event::find($calendar['eventId']);
                    $event->delete($calendar['eventId']);
                    Calendar::where('serviceId', $d['reinigung2Id'])->delete();
                }
            }


            // Entsorgung Güncelleme
            $isEntsorgung = $request->get('isEntsorgung');
            if ($isEntsorgung && $request->entsorgungdate) {
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
                $entsorgungDate = EntsorgungService::where('id', $d['entsorgungId'])->first();
                if ($entsorgungDate) {
                    $entsorgungGuncelle = EntsorgungService::where('id', $d['entsorgungId'])->update($entsorgung);
                    $entsorgungId = $d['entsorgungId'];
                    $appDateArray[$ADC]['serviceId'] = $entsorgungId;
                    $appDateArray[$ADC]['date'] = $entsorgung['entsorgungDate'];
                    $appDateArray[$ADC]['time'] = $entsorgung['entsorgungTime'];
                    $appDateArray[$ADC]['endDate'] = $entsorgung['entsorgungDate'];
                    $appDateArray[$ADC]['endTime'] = $entsorgung['entsorgungTime'];
                    $appDateArray[$ADC]['calendarTitle'] = $entsorgung['calendarTitle'];
                    $appDateArray[$ADC]['calendarComment'] = $entsorgung['calendarComment'];
                    $appDateArray[$ADC]['calendarLocation'] = $entsorgung['calendarLocation'];
                    $appDateArray[$ADC]['serviceName'] = 'Entsorgung';
                    $ADC++;
                } else {
                    $entsorgungOlustur = EntsorgungService::create($entsorgung);
                    $entsorgungIdBul = DB::table('entsorgung_services')->orderBy('id', 'DESC')->first(); // Son Eklenen Entsorgung un id'si
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
            } else {
                EntsorgungService::where('id', $d['entsorgungId'])->delete(); // Düğme Kapanırsa Silinir
                $calendar = Calendar::where('serviceId', $d['entsorgungId'])->first();
                if ($calendar) {
                    $event = Event::find($calendar['eventId']);
                    $event->delete($calendar['eventId']);
                    Calendar::where('serviceId', $d['entsorgungId'])->delete();
                }
            }
            // Transport Güncelleme
            $isTransport = $request->get('isTransport');
            if ($isTransport && $request->transportdate) {
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
                $transportDate = TransportService::where('id', $d['transportId'])->first();
                if ($transportDate) {
                    $transportGuncelle = TransportService::where('id', $d['transportId'])->update($transport);
                    $transportId = $d['transportId'];
                    $appDateArray[$ADC]['serviceId'] = $transportId;
                    $appDateArray[$ADC]['date'] = $transport['transportDate'];
                    $appDateArray[$ADC]['time'] = $transport['transportTime'];
                    $appDateArray[$ADC]['endDate'] = $transport['transportDate'];
                    $appDateArray[$ADC]['endTime'] = $transport['transportTime'];
                    $appDateArray[$ADC]['calendarTitle'] = $transport['calendarTitle'];
                    $appDateArray[$ADC]['calendarComment'] = $transport['calendarComment'];
                    $appDateArray[$ADC]['calendarLocation'] = $transport['calendarLocation'];
                    $appDateArray[$ADC]['serviceName'] = 'Transport';
                    $ADC++;
                } else {
                    $transportOlustur = TransportService::create($transport);
                    $transportIdBul = DB::table('transport_services')->orderBy('id', 'DESC')->first(); // Son Eklenen Transport un id'si
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
            } else {
                TransportService::where('id', $d['transportId'])->delete(); // Düğme Kapanırsa Silinir
                $calendar = Calendar::where('serviceId', $d['transportId'])->first();
                if ($calendar) {
                    $event = Event::find($calendar['eventId']);
                    $event->delete($calendar['eventId']);
                    Calendar::where('serviceId', $d['transportId'])->delete();
                }
            }

            // Lagerung Güncelleme
            $isLagerung = $request->get('isLagerung');
            if ($isLagerung && $request->lagerungdate) {
                $lagerung = [
                    'lagerungDate' => $request->lagerungdate,
                    'lagerungTime' => $request->lagerungtime,
                    'calendarTitle' => $request->lagerungcalendarTitle,
                    'calendarComment' => $request->lagerungcalendarComment,
                    'calendarLocation' => $request->lagerungcalendarLocation,
                ];
                $lagerungDate = LagerungService::where('id', $d['lagerungId'])->first();
                if ($lagerungDate) {
                    $lagerungGuncelle = LagerungService::where('id', $d['lagerungId'])->update($lagerung);
                    $lagerungId = $d['lagerungId'];
                    $appDateArray[$ADC]['serviceId'] = $lagerungId;
                    $appDateArray[$ADC]['date'] = $lagerung['lagerungDate'];
                    $appDateArray[$ADC]['time'] = $lagerung['lagerungTime'];
                    $appDateArray[$ADC]['endDate'] = $lagerung['lagerungDate'];
                    $appDateArray[$ADC]['endTime'] = $lagerung['lagerungTime'];
                    $appDateArray[$ADC]['calendarTitle'] = $lagerung['calendarTitle'];
                    $appDateArray[$ADC]['calendarComment'] = $lagerung['calendarComment'];
                    $appDateArray[$ADC]['calendarLocation'] = $lagerung['calendarLocation'];
                    $appDateArray[$ADC]['serviceName'] = 'Lagerung';
                    $ADC++;
                } else {
                    $lagerungOlustur = LagerungService::create($lagerung);
                    $lagerungIdBul = DB::table('lagerung_services')->orderBy('id', 'DESC')->first(); // Son Eklenen Lagerung un id'si
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
            } else {
                LagerungService::where('id', $d['lagerungId'])->delete(); // Düğme Kapanırsa Silinir
                $calendar = Calendar::where('serviceId', $d['lagerungId'])->first();
                if ($calendar) {
                    $event = Event::find($calendar['eventId']);
                    $event->delete($calendar['eventId']);
                    Calendar::where('serviceId', $d['lagerungId'])->delete();
                }
            }
            // AppointmentService Güncelleme
            $appointmentService = [
                'paymentType' => $request->paymentType,
                'address' => $request->address,
                'calendarTitle' => $request->calendarTitle,
                'calendarContent' => $request->calendarContent,
                'umzugId' => $umzugId,
                'umzug2Id' => $umzug2Id,
                'umzug3Id' => $umzug3Id,
                'einpackId' => $einpackId,
                'auspackId' => $auspackId,
                'reinigungId' => $reinigungId,
                'reinigung2Id' => $reinigung2Id,
                'entsorgungId' => $entsorgungId,
                'transportId' => $transportId,
                'lagerungId' => $lagerungId,
            ];



            $update = AppoinmentService::where('id', $id)->update($appointmentService);
            $randevuTipi = 'Auftragsbestätigung';
            $emailData = [
                'name' => $customer,
                'gender' => $customerData['gender'],
                'surname' => $customerSurname,
                'address' => $request->address,
                'sub' => $sub,
                'from' => $from,
                'companyName' => $companyName,
                'appDate' => $appDateArray,
                'email' => $request->email,
                'emailContent' => $request->emailContent,
                'isCustomEmailSend' => $isCustomEmailSend,
                'customEmailContent' => $customEmail,
                'randevuTipi' => $randevuTipi,
            ];



            if ($update) {
                $mailSuccess = '';
                if ($isEmailSend) {
                    Mail::to($emailData['email'])->send(new InformationMail($emailData));
                    // Mail::to($from)->send(new CompanyMail($emailData)); //Firmaya Takvime Eklendi Bildirimi
                    $mailSuccess = 'Mail Başarıyla Gönderildi';
                }
                foreach ($appDateArray as $item) {

                    $fullDate = $item['date'] . ' ' . $item['time'];
                    $endDate = $item['endDate'] . ' ' . $item['endTime'];
                    $location = $item['calendarLocation'];
                    $title = $item['calendarTitle'];
                    $comment =  $item['calendarComment'];
                    $event = Calendar::where('serviceId', $item['serviceId'])->first();
                    $serviceId = $item['serviceId'];
                    $colorId = '10';
                    if ($event) {
                        $eventId = $event['eventId'];
                        calendarEditHelper::companyMailEdit($item['serviceName'], $fullDate, $location, $title, $comment, $endDate, $serviceId, $eventId);
                    } else {
                        calendarHelper::companyMail($item['serviceName'], $fullDate, $location, $title, $comment, $endDate, $serviceId, $colorId);
                    }
                }

                return redirect()
                    ->route('customer.detail', ['id' => $customerId])
                    ->with('status', $randevuTipi . ' ' . 'Auftragsbestätigung Randevusu Düzenlendi' . ' ' . $mailSuccess)
                    ->with('cat', 'Termine')
                    ->withInput()
                    ->with('keep_status', true);
                // return redirect()->back()->with('status','Auftragsbestätigung Randevusu Düzenlendi'.' '.$mailSuccess);
            } else {
                return redirect()->back()->with('status-danger', 'HATA:Auftragsbestätigung Randevusu Düzenlenemedi');
            }
        }
    }

    public function delete($id)
    {

        $c = AppoinmentService::where('id', $id)->count();

        if ($c != 0) {
            $data = AppoinmentService::where('id', $id)->first();
            $customerId = $data['customerId'];
            UmzugService::where('id', $data['umzugId'])->delete();
            UmzugService::where('id', $data['umzug2Id'])->delete();
            UmzugService::where('id', $data['umzug3Id'])->delete();
            EinpackService::where('id', $data['einpackId'])->delete();
            AuspackService::where('id', $data['auspackId'])->delete();
            ReinigungService::where('id', $data['reinigungId'])->delete();
            ReinigungService::where('id', $data['reinigung2Id'])->delete();
            EntsorgungService::where('id', $data['entsorgungId'])->delete();
            TransportService::where('id', $data['transportId'])->delete();
            LagerungService::where('id', $data['lagerungId'])->delete();

            $calendarUmzug = Calendar::where('serviceId', $data['umzugId'])->first();
            if ($calendarUmzug) {
                $event = Event::find($calendarUmzug['eventId']);
                if ($event) {
                    $event->delete($calendarUmzug['eventId']);
                    Calendar::where('serviceId', $data['umzugId'])->delete();
                } else {
                    Calendar::where('serviceId', $data['umzugId'])->delete(); // Event Google Takvim Üzerinden Elle Silinmişse
                }
            }


            $calendarUmzug2 = Calendar::where('serviceId', $data['umzug2Id'])->first();
            if ($calendarUmzug2) {
                $event = Event::find($calendarUmzug2['eventId']);
                if ($event) {
                    $event->delete($calendarUmzug2['eventId']);
                    Calendar::where('serviceId', $data['umzug2Id'])->delete();
                } else {
                    Calendar::where('serviceId', $data['umzug2Id'])->delete(); // Event Google Takvim Üzerinden Elle Silinmişse
                }
            }

            $calendarUmzug3 = Calendar::where('serviceId', $data['umzug3Id'])->first();
            if ($calendarUmzug3) {
                $event = Event::find($calendarUmzug3['eventId']);
                if ($event) {
                    $event->delete($calendarUmzug3['eventId']);
                    Calendar::where('serviceId', $data['umzug3Id'])->delete();
                } else {
                    Calendar::where('serviceId', $data['umzug3Id'])->delete(); // Event Google Takvim Üzerinden Elle Silinmişse
                }
            }

            $calendarEinpack = Calendar::where('serviceId', $data['einpackId'])->first();
            if ($calendarEinpack) {
                $event = Event::find($calendarEinpack['eventId']);
                if ($event) {
                    $event->delete($calendarEinpack['eventId']);
                    Calendar::where('serviceId', $data['einpackId'])->delete();
                } else {
                    Calendar::where('serviceId', $data['einpackId'])->delete(); // Event Google Takvim Üzerinden Elle Silinmişse
                }
            }

            $calendarAuspack = Calendar::where('serviceId', $data['auspackId'])->first();
            if ($calendarAuspack) {
                $event = Event::find($calendarAuspack['eventId']);
                if ($event) {
                    $event->delete($calendarAuspack['eventId']);
                    Calendar::where('serviceId', $data['auspackId'])->delete();
                } else {
                    Calendar::where('serviceId', $data['auspackId'])->delete(); // Event Google Takvim Üzerinden Elle Silinmişse
                }
            }

            $calendarReinigung = Calendar::where('serviceId', $data['reinigungId'])->first();
            if ($calendarReinigung) {
                $event = Event::find($calendarReinigung['eventId']);
                if ($event) {
                    $event->delete($calendarReinigung['eventId']);
                    Calendar::where('serviceId', $data['reinigungId'])->delete();
                } else {
                    Calendar::where('serviceId', $data['reinigungId'])->delete(); // Event Google Takvim Üzerinden Elle Silinmişse
                }
            }

            $calendarReinigung2 = Calendar::where('serviceId', $data['reinigung2Id'])->first();
            if ($calendarReinigung2) {
                $event = Event::find($calendarReinigung2['eventId']);
                if ($event) {
                    $event->delete($calendarReinigung2['eventId']);
                    Calendar::where('serviceId', $data['reinigung2Id'])->delete();
                } else {
                    Calendar::where('serviceId', $data['reinigung2Id'])->delete(); // Event Google Takvim Üzerinden Elle Silinmişse
                }
            }

            $calendarEntsorgung = Calendar::where('serviceId', $data['entsorgungId'])->first();
            if ($calendarEntsorgung) {
                $event = Event::find($calendarEntsorgung['eventId']);
                if ($event) {
                    $event->delete($calendarEntsorgung['eventId']);
                    Calendar::where('serviceId', $data['entsorgungId'])->delete();
                } else {
                    Calendar::where('serviceId', $data['entsorgungId'])->delete(); // Event Google Takvim Üzerinden Elle Silinmişse
                }
            }

            $calendarTransport = Calendar::where('serviceId', $data['transportId'])->first();
            if ($calendarTransport) {
                $event = Event::find($calendarTransport['eventId']);
                if ($event) {
                    $event->delete($calendarTransport['eventId']);
                    Calendar::where('serviceId', $data['transportId'])->delete();
                } else {
                    Calendar::where('serviceId', $data['transportId'])->delete(); // Event Google Takvim Üzerinden Elle Silinmişse
                }
            }

            $calendarLagerung = Calendar::where('serviceId', $data['lagerungId'])->first();
            if ($calendarLagerung) {
                $event = Event::find($calendarLagerung['eventId']);
                if ($event) {
                    $event->delete($calendarLagerung['eventId']);
                    Calendar::where('serviceId', $data['lagerungId'])->delete();
                } else {
                    Calendar::where('serviceId', $data['lagerungId'])->delete(); // Event Google Takvim Üzerinden Elle Silinmişse
                }
            }


            AppoinmentService::where('id', $id)->delete();
            return redirect()
                ->route('customer.detail', ['id' => $customerId])
                ->with('status', 'Onay Randevusu Başarıyla Silindi')
                ->with('cat', 'Termine')
                ->withInput()
                ->with('keep_status', true);
        } else {
            return redirect('/');
        }
    }
}
