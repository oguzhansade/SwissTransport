<?php

namespace App\Http\Controllers\front\bexio;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Google\Service\CustomSearchAPI\Search;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Facades\Http;


class indexController extends Controller
{
    public function searchCustomer(Request $request)
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
            // $result boşsa yapılacak işlemler
            return "Result is empty.";
        }



        } catch (BadResponseException $e) {
            // Hata durumunda isteği işle
            return $e->getMessage();
        }


    }


}
