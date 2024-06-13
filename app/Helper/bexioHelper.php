<?php
namespace App\Helper;

use App\Models\Customer;
use App\Models\ReceiptUmzug;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Facades\Http;


class bexioHelper
{
    // Ortak işlevler
    public static function getBexioHeaders()
    {
        $apiToken = 'Bearer'.' '.'eyJraWQiOiI2ZGM2YmJlOC1iMjZjLTExZTgtOGUwZC0wMjQyYWMxMTAwMDIiLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOiJpbmZvQGhlbHZldGlhdHJhbnNwb3J0ZS5jaCIsImxvZ2luX2lkIjoiNGU2MTIyOTEtZGQ5Ni00Mjg2LTk2MjQtNTJlMDUzY2JkNjgyIiwiY29tcGFueV9pZCI6IjNvMG9kcHRzbTd2aSIsInVzZXJfaWQiOjI1ODE4NywiYXpwIjoiZXZlcmxhc3QtdG9rZW4tb2ZmaWNlLWNsaWVudCIsInNjb3BlIjoib3BlbmlkIHByb2ZpbGUgZW1haWwgYWxsIHRlY2huaWNhbCIsImlzcyI6Imh0dHBzOlwvXC9pZHAuYmV4aW8uY29tIiwiZXhwIjozMjkwNjc5MzI0LCJpYXQiOjE3MTM4NzkzMjQsImNvbXBhbnlfdXNlcl9pZCI6MSwianRpIjoiMTM3NjM5OGYtNGI3YS00MjVhLWE5N2EtYWMyYzI5ZDQ3NzI1In0.ofzalW34nZiwWct9Ud8tpCgSwL44z7RDlVh6K5Pm_l9DIT_PihHJbW56LGtclmCxvlRIZvBBdQJCxADDc6LzgxRAzBLpZ7EoQxVeEl5oDnfmF-u2cP9qSVCZg2uLxSmki2i7yAQxyuYYY9Aa9WjU7rPYq7M0dt-O_Q-1m5nEJRvRXoCIM1Ax_fqhHDhfh9cq3t1DXeCOPyOGklRkufqerFzkDcYDhLRuajFUALttCLBTh21Z-mZIEuW3NFjINySDdz202-vm72EUdkndJAwICp3WMmci0SMMP_3fAYsEanxzLgPcAYVP2WNafVCA_V_h2OwvN8MT2zps6S7sj0HAltDDfJU8NJ46v33syZjWJtrj8dmaGVfOASYcXN78CDCVaiUJ4bdZ-d0ObxWCcOwTh7dGjKqwHJ92-8ii221D5NZpzpXvrdAhzTamBIuZVIieIA_nLBXuIMVHM6s-MtYl0hfyyIpWzOZ1ith9H-u1vFMSKGUPTo2maWSmS6YPCqLXlHA8i2nf4PVoIdPIiLJaSXaSUVXFjYkXlwY0GTrHWCTqyIf7YuddF6M8wo_25F7ZbNXh0von94Ni6Znzv-JmZd318YTDY757WNCiwkBJpWzXGp4qewF45Cs0owe2668oyM4qj-_OLvgMTyQvDIT77I7qJy22xUiICG08laRp3N4';
        return [
            'Accept' => 'application/json',
            'Authorization' => $apiToken, // Gerçek erişim belirteciyle değiştir
            'Content-Type' => 'application/json',
        ];
    }

    public static function getBexioClient()
    {
        return new Client();
    }

    // Bexio Başlangıç
    public static function bexioInitiate($customerId,$receiptId)
    {
        $customer = Customer::where('id', $customerId)->first();
        $receipt = ReceiptUmzug::where('id',$receiptId)->first();

        // İlk Çalışacak Fonksiyon
        $customerSearch = self::customerSearch($customer);


        // Müşteri Varsa Ya da Yoksa Koşulları
        if (count($customerSearch) != 0) {
            $invoiceSearch = self::bexioInvoiceSearch($customerSearch[0]['id']);
            return view('front.bexioApi.index',['customer' => $customerSearch,'receipt' => $receipt,'invoice' => $invoiceSearch]); // Bexio Anasayfası
        } else {

            $headers = self::getBexioHeaders();
            $client = self::getBexioClient();


            $url = 'https://api.bexio.com/2.0/country';

            try {
                $response = $client->request('GET', $url, array(
                    'headers' => $headers,
                ));

                $json_response = $response->getBody()->getContents();
                $countryList = json_decode($json_response, true); // Json çıktıyı php dizisine dönüştür
            }
            catch (\GuzzleHttp\Exception\BadResponseException $e) {
                // handle exception or api errors.
                return $e->getMessage();
            }

            return view('front.bexioApi.customerCreate',['customer' => $customer,'receipt' => $receipt,'countryList' => $countryList]);
        }

    }

    // Müşteri Arama
    public static function customerSearch($customer)
    {
        $headers = self::getBexioHeaders();
        $client = new Client();

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
            // Guzzle ile POST isteği gönder
            $response = $client->request('POST', $url, [
                'headers' => $headers,
                'body' => $request_body,
            ]);

            // Yanıtı görüntüle
            $json_response = $response->getBody()->getContents();
            $data = json_decode($json_response, true); // Json çıktıyı php dizisine dönüştür
            return $data;
        } catch (BadResponseException $e) {
            // Hata durumunda isteği işle
            return $e->getMessage();
        }
    }

    // Müşteri Oluşturma
    public static function bexioCustomerStore($customerInputs)
    {
        $headers = self::getBexioHeaders();
        $client = self::getBexioClient();

        $request_body = json_encode([
            "contact_type_id" => $customerInputs['customerType'], // Zorunlu*
            "name_1"=> $customerInputs['surname'], // Şirket Müşterisi olarak gelirse bu alan Şirket ismi olarak alınır // Zorunlu*
            "name_2"=> $customerInputs['name'],
            "salutation_id"=> $customerInputs['gender'],
            "address"=> $customerInputs['street'],
            "postcode"=> $customerInputs['postCode'],
            "city"=> $customerInputs['Ort'],
            "country_id"=> $customerInputs['country'],
            "mail"=> $customerInputs['email'],
            "mail_second"=> "",
            "phone_fixed"=> "",
            "phone_fixed_second"=> "",
            "phone_mobile"=> $customerInputs['mobile'],
            "fax"=> "",
            "url"=> "",
            "skype_name"=>"",
            "remarks"=> "",
            "contact_group_ids"=> "1,2",
            "user_id"=> 1, // Zorunlu*
            "owner_id"=> 1 // Zorunlu*
        ]);

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
    }

    // Draft Fatura Oluşturma
    public static function bexioStoreInvoice($customerId,$receiptId)
    {
        $headers = self::getBexioHeaders();
        $client = new Client();

        $request_body = [
            "title" => "Umzug",
            "contact_id" => $customerId,
            "user_id" => 1,
            "logopaper_id" => 1,
            "language_id" => 1,
            "bank_account_id" => 1,
            "currency_id" => 1,
            "payment_type_id" => 1,
            "header" => "Thank you very much for your inquiry. We would be pleased to make you the following offer:",
            "footer" => "We hope that our offer meets your expectations and will be happy to answer your questions.",
            "mwst_type" => 0,
            "mwst_is_net" => true,
            "show_position_taxes" => false,
            "is_valid_from" => "2024-06-24",
            "is_valid_to" => "2024-07-24",
            "template_slug" => "616547ba098cae573e7fbaa5"
        ];

        $url = 'https://api.bexio.com/2.0/kb_invoice';

        try {
            $response = $client->request('POST', $url, [
                'headers' => $headers,
                'json' => $request_body,
            ]);

            return $response->getBody()->getContents();
        } catch (BadResponseException $e) {
            // handle exception or api errors.
            return $e->getMessage();
        }
    }

    // Fatura Arama
    public static function bexioInvoiceSearch($id)
    {
        $headers = self::getBexioHeaders();
        $client = new Client();

        // İstek gövdesi
        $request_body = json_encode([
            [
                "field" => "contact_id",
                "value" => $id,
                "criteria" => "="
            ]
        ]);

        $url = 'https://api.bexio.com/2.0/kb_invoice/search';

        try {
             // API'ye POST isteği gönder
            $response = Http::withHeaders($headers)->post($url, json_decode($request_body, true));

            // JSON yanıtını PHP dizisine dönüştür
            $invoices = json_decode($response->body(), true);

            // Yanıtın başarılı olup olmadığını kontrol et
            if ($response->successful()) {
                return $invoices; // PHP dizisini döndür
            } else {
                return response()->json(['error' => 'API request failed'], $response->status());
            }
        } catch (\Exception $e) {
            // handle exception or API errors
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Mail Gönderme
    public static function bexioSendInvoice($customerId,$receiptId,$invoiceId)
    {

        $receiptCRM = ReceiptUmzug::where('id',$receiptId)->first();
        $customer = Customer::where('id',$receiptCRM['customerId'])->first();

        $headers = self::getBexioHeaders();
        $client = self::getBexioClient();

        $requestBody = [
            "recipient_email" => $customer['email'],
            "subject" => "test subject",
            "message" => "Please find the document at [Network Link]",
            "mark_as_open" => true,
            "attach_pdf" => true
        ];

        $url = "https://api.bexio.com/2.0/kb_invoice/".$invoiceId."/send"; // Invoice Id Gerekli

        try {
            $response = $client->post($url, [
                'headers' => $headers,
                'json' => $requestBody,
            ]);

            return $response->getBody()->getContents();
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            // handle exception or api errors.
            return $e->getMessage();
        }
    }

    // Faturayı Doldurma
    public function createKbPositionCustom()
    {
        $headers = self::getBexioHeaders();
        $client = self::getBexioClient();

        $request_body = json_encode([
            "amount" => "5.000000",
            "unit_id" => 2,
            "account_id" => 221,
            "tax_id" => 43,
            "text" => "3 Mitarbeiter mit 1 Lieferwagen",
            "unit_price" => "450.000000",
            "discount_in_percent" => "0.000000",
            "article_id" => 6
        ]);

        $url = 'https://api.bexio.com/2.0/kb_invoice/1347/kb_position_article';

        try {
            $response = $client->request('POST', $url, [
                'headers' => $headers,
                'json' => $request_body,
            ]);

            return $response->getBody()->getContents();
        } catch (BadResponseException $e) {
            // handle exception or api errors.
            return $e->getMessage();
        }
    }

    // Bildirim
    public static function bexioApiNotification($bildirim){
        return 'Bildirim: ' . $bildirim;
    }
}
