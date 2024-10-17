<?php

namespace App\Http\Controllers\front\bexio;

use App\Helper\bexioHelper;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\ReceiptUmzug;
use Google\Service\CustomSearchAPI\Search;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Facades\Http;


class indexController extends Controller
{
    public function bexioSearchCustomer(Request $request)
    {
        $customerId = $request->route('customerId');
        $receiptId = $request->route('receiptId');
        $result = bexioHelper::bexioInitiate($customerId,$receiptId);

        return  $result;
    }

    public function bexioNotification()
    {
        return view('front.bexioApi.notification');
    }

    public function emptyBexioId($id)
    {
        $updateReceipt = ReceiptUmzug::where('id',$id)->update([
            'bexioId' => null
        ]);

        if($updateReceipt){
            return redirect()->back()->with('success', 'Quittung Bexio Id Boşaltıldı.');
        }
        else {
            return redirect()->back()->with('error', 'HATA: Bexio Id Silinemedi.');
        }
    }

    public function bexioShowPdf(Request $request)
    {
        $invoiceId = $request->route('invoiceId');
        $showPdf = bexioHelper::bexioShowPdf($invoiceId);
        return $showPdf;
    }

    public function bexioStoreCustomer(Request $request)
    {
        $customerInputs = $request->except('_token');
        $customerStore = bexioHelper::bexioCustomerStore($customerInputs);
        return $customerStore;
    }

    public function bexioCreateInvoice(Request $request)
    {
        $customerId = $request->route('customerId');
        $receiptId = $request->route('receiptId');
        $createInvoice = bexioHelper::bexioStoreInvoice($customerId,$receiptId);
        return $createInvoice;


    }

    public function bexioSendInvoice(Request $request)
    {
        $customerId = $request->route('customerId'); //CRMDEKİ id yi çekmeliyiz
        $receiptId = $request->route('receiptId');
        $invoiceId = $request->route('invoiceId');
        $sendInvoice = bexioHelper::bexioSendInvoice($customerId,$receiptId,$invoiceId);
        return $sendInvoice;
    }


    public function bexioKbPosition(Request $request)
    {
        $customerId = $request->route('customerId'); //CRMDEKİ id yi çekmeliyiz
        $receiptId = $request->route('receiptId');
        $invoiceId = $request->route('invoiceId');

        $kbPosition = bexioHelper::createKbPositionCustom($customerId,$receiptId,$invoiceId);
        return $kbPosition;
    }

    public function bexioHelper(Request $request)
    {


        $customerId = $request->route('customerId');
        $customer = Customer::where('id',$customerId)->first();
        $bexioToken= 'Bearer '.env('BEXIO_TOKEN');

        $client = new Client();

        // Gerçek erişim belirteciyle headers'ı güncelle
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => $bexioToken, // Gerçek erişim belirteciyle değiştir
            'Content-Type' => 'application/json',
        ];

         // İstek gövdesi
        $request_body = json_encode([
            [
                "field" => "mail",
                "value" => $customer['email'],
                "criteria" => "="
            ]
        ]);

        $url = 'https://api.bexio.com/2.0/contact/search';


        try {
            // Müşteri Sorgulama
            // Guzzle ile POST isteği gönder
            $response = $client->request('POST', $url, [
                'headers' => $headers,
                'body' => $request_body,
            ]);

            // Yanıtı görüntüle
            $result = $response->getBody()->getContents();




            // Yanıtın JSON formatında olduğunu kontrol et
            if ($result && is_string($result)) {
                $data = json_decode($result, true); // JSON verisini diziye dönüştür

                // "id" değerini al, ancak yanıtın bir dizi olduğundan emin olun
                if (is_array($data) && isset($data[0]['id'])) {
                    $result = $data[0]['id']; // "id" değerini al
                } else {
                    // $result boş olacak şekilde ayarla, çünkü id bulunamadı
                    $result = null;
                }
            } else {
                // $result boş olacak şekilde ayarla, çünkü JSON verisi geçerli değil
                $result = null;
            }


        // $result'in boş olup olmadığını kontrol et
        if (!empty($result)) {
            // $result boş değilse yapılacak işlemler
            // Müşteri Varsa Id ye göre Faturayı Bulma
            $request_body = json_encode([
                [
                    "field" => "contact_id",
                    "value" => $result,
                    "criteria" => "="
                ]
            ]);


            $url = 'https://api.bexio.com/2.0/kb_invoice/search';

            try {
                $response = Http::withHeaders($headers)->post($url, json_decode($request_body, true));

                return response()->json(json_decode($response->body()), $response->status());
            } catch (\Exception $e) {
                // handle exception or API errors
                return response()->json(['error' => $e->getMessage()], 500);
            }
        } else {
            $request_body = '{
                "contact_type_id": 2,
                "name_1": "Camdali",
                "name_2": "Koray",
                "salutation_id": 1,
                "address": "Smith Street 22",
                "postcode": 8004,
                "city": "Zurich",
                "country_id": 1,
                "mail": "camdalikoray@gmail.com",
                "mail_second": "",
                "phone_fixed": "",
                "phone_fixed_second": "",
                "phone_mobile": "76 399 50 02",
                "fax": "",
                "url": "",
                "skype_name": "",
                "remarks": "",
                "contact_group_ids": "1,2",
                "user_id": 1,
                "owner_id": 1
            }';
            $url = 'https://api.bexio.com/2.0/contact';

            try {
                $response = $client->request('POST', $url, [
                    'headers' => $headers,
                    'body' => $request_body,
                ]);

                return $response->getBody()->getContents();
            } catch (BadResponseException $e) {
                return $e->getMessage();
            }
            // $result boşsa yapılacak işlemler
            return "Result is empty.";
        }



        } catch (BadResponseException $e) {
            // Hata durumunda isteği işle
            return $e->getMessage();
        }
    }

}
