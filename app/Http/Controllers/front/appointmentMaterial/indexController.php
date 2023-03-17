<?php

namespace App\Http\Controllers\front\appointmentMaterial;

use App\Helper\calendarEditHelper;
use App\Helper\calendarHelper;
use App\Http\Controllers\Controller;
use App\Mail\CompanyMail;
use App\Mail\InformationMail;
use App\Models\AppoinmentService;
use App\Models\AppointmentMaterial;
use App\Models\Calendar;
use App\Models\Company;
use App\Models\Customer;
use App\Models\UmzugService;
use Spatie\GoogleCalendar\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class indexController extends Controller
{
    public function index(Request $request)
    {

        return view('front.appointmentMaterial.index');
    }


    public function edit(Request $request)
    {
        $id = $request->route('id');
        $c = AppointmentMaterial::where('id', $id)->count();

        if ($c != 0) {
            $data = AppointmentMaterial::where('id', $id)->first();
            $data2 = Customer::where('id', $data['customerId'])->first();
            return view('front.appointmentMaterial.edit', ['data' => $data, 'data2' => $data2]);
        }
    }

    public function detail(Request $request)
    {
        $id = $request->route('id');
        $c = AppointmentMaterial::where('id', $id)->count();

        if ($c != 0) {
            $data = AppointmentMaterial::where('id', $id)->first();
            $data2 = Customer::where('id', $data['customerId'])->first();
            return view('front.appointmentMaterial.detail', ['data' => $data, 'data2' => $data2]);
        }
    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = AppointmentMaterial::where('id', $id)->count();
        $deliveryAble = $request->get('deliverable');

        $d = AppointmentMaterial::where('id', $id)->first();
        $customerId = Customer::where('id', '=', $d['customerId'])->first();
        $isEmailSend = $request->get('isEmail');
        $isCustomEmailSend = $request->get('isCustomEmail');
        $customEmail = $request->get('customEmail');

        $ADC = 0;

        $appDateArray = [];
        $appDateArray[$ADC]['serviceId'] = $id;
        $appDateArray[$ADC]['date'] = $request->meetingDate;
        $appDateArray[$ADC]['time'] = $request->meetingHour1;
        $appDateArray[$ADC]['endDate'] = $request->meetingDate;
        $appDateArray[$ADC]['endTime'] = $request->meetingHour1;
        $appDateArray[$ADC]['calendarTitle'] = $request->calendarTitle;
        $appDateArray[$ADC]['calendarComment'] = $request->calendarContent;
        $appDateArray[$ADC]['calendarLocation'] = $request->address;
        $appDateArray[$ADC]['serviceName'] = 'Lieferung';
        $appDateArray[$ADC]['colorId'] = '10';
        $ADC++;


        $sub = ' Ihr Lieferungstermin wurde aktualisiert';

        $from = Company::InfoCompany('email'); // gösterilen mail.
        $companyName = Company::InfoCompany('name'); // şirket adı buraya yaz veritabanında yok çünkü.
        $customer = DB::table('customers')->where('id', '=', $customerId['id'])->value('name');
        $customerSurname = DB::table('customers')->where('id', '=', $customerId['id'])->value('surname');
        $customerData = Customer::where('id', $customerId['id'])->first();
        $randevuTipi = 'Lieferung';
        $emailData = [
            'name' => $customer,
            'gender' => $customerData['gender'],
            'surname' => $customerSurname,
            'address' => $request->address,
            'sub' => $sub,
            'from' => $from,
            'companyName' => $companyName,
            'email' => $request->email,
            'appDate' => $appDateArray,
            'emailContent' => $request->emailContent,
            'isCustomEmailSend' => $isCustomEmailSend,
            'customEmailContent' => $customEmail,
            'randevuTipi' => $randevuTipi
        ];

        if ($isCustomEmailSend) {
            Arr::set($emailData, 'customEmailContent', $customEmail);
        }

        if ($c != 0) {
            $appointmentMaterial = [
                'deliverable' => $request->deliverable,
                'deliveryType' => $request->deliveryType,
                'meetingDate' => $request->meetingDate,
                'meetingHour1' => $request->meetingHour1,
                'meetingHour2' => $request->meetingHour2,
                'address' => $request->address,
                'calendarTitle' => $request->calendarTitle,
                'calendarContent' => $request->calendarContent,
            ];

            if ($deliveryAble == 1) {
                $appointmentMaterial['deliveryType'] = NULL;
            }
            $update = AppointmentMaterial::where('id', $id)->update($appointmentMaterial);
            if ($update) {
                $mailSuccess = '';
                if ($isEmailSend) {
                    Mail::to($emailData['email'])->send(new InformationMail($emailData));
                    // Mail::to($from)->send(new CompanyMail($emailData)); // Firmaya Takvime Eklendi Bildirimi
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
                    $colorId = $item['colorId'];
                    if ($event) {
                        $eventId = $event['eventId'];
                        calendarEditHelper::companyMailEdit($item['serviceName'], $fullDate, $location, $title, $comment, $endDate, $serviceId, $eventId);
                    } else {
                        calendarHelper::companyMail($item['serviceName'], $fullDate, $location, $title, $comment, $endDate, $serviceId, $colorId);
                    }
                }
                return redirect()->back()->with('status', 'Teslimat Randevusu Düzenlendi' . ' ' . $mailSuccess);
            } else {
                return redirect()->back()->with('status-danger', 'HATA:Teslimat Randevusu Düzenlenemedi');
            }
        }
    }



    public function delete($id)
    {

        $c = AppointmentMaterial::where('id', $id)->count();
        $appointment = AppointmentMaterial::where('id', $id)->first();

        $customer = Customer::where('id', $appointment['customerId'])->first();

        if ($c != 0) {
            $data = AppointmentMaterial::where('id', $id)->get();

            $calendarLiefe = Calendar::where('serviceId', $id)->first();
            if ($calendarLiefe) {
                $event = Event::find($calendarLiefe['eventId']);
                if ($event) {
                    $event->delete($calendarLiefe['eventId']);
                    Calendar::where('serviceId', $id)->delete();
                } else {
                    Calendar::where('serviceId', $id)->delete();
                }
            }
            AppointmentMaterial::where('id', $id)->delete();
            return redirect()
                ->route('customer.detail', ['id' => $customer['id']])
                ->with('status', 'Onay Randevusu Başarıyla Silindi')
                ->with('cat', 'Termine')
                ->withInput()
                ->with('keep_status', true);
            return redirect()->back()->with('status', 'Teslimat Randevusu Başarıyla Silindi');
        } else {
            return redirect('/');
        }
    }
}
