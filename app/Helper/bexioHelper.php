<?php
namespace App\Helper;

use App\Models\Customer;
use App\Models\ReceiptDiscount;
use App\Models\ReceiptExtra;
use App\Models\ReceiptUmzug;
use Carbon\Carbon;
use Google\Service\Docs\Request;
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

            return redirect()->back()->with('success', 'BAŞARILI: MÜŞTERİ OLUŞTURULDU.');
            // return $response->getBody()->getContents();
        } catch (BadResponseException $e) {
            return redirect()->back()->with('error', 'ERROR: MÜŞTERİ OLUŞTURULAMADI.');
            // return $e->getMessage();
        }
    }

    // Draft Fatura Oluşturma
    public static function bexioStoreInvoice($bexioCustomerId,$receiptId,$receiptType)
    {
        dd('Store',$receiptType);
        $validFrom = Carbon::now()->format('Y-m-d');
        $validTo = Carbon::now()->addDays(30)->format('Y-m-d');// Faturaya 30 gün eklemek için
        $headers = self::getBexioHeaders();
        $client = new Client();
        $receipt = ReceiptUmzug::where('id',$receiptId )->first();
        $crmCustomer = Customer::where('id',$receipt['customerId'])->first();

        $request_body = [
            "title" => "Umzug",
            "contact_id" => $bexioCustomerId,
            "user_id" => 1,
            "logopaper_id" => 1,
            "language_id" => 1,
            "bank_account_id" => 1,
            "currency_id" => 1,
            "payment_type_id" => 1,
            "header" => "Guten Tag Marcel Reichen Vielen dank für Ihr Vertrauen. Ihre Rechnung setzt sich wie folgt zusammen:", //MAİLLE GÖNDERİLEN PDFTEKİ İLK METİN
            "footer" => "Haben Sie Fragen? Melden Sie sich bei uns, gerne sind wir für Sie da. Freundliche Grüsse Filipa Machado.", //MAİLLE GÖNDERİLEN PDFTEKİ SON METİN
            "mwst_type" => 0,
            "mwst_is_net" => true,
            "show_position_taxes" => false,
            "is_valid_from" => $validFrom, //TODO: TARİHLER SORULACAK PDFTE: DATUM
            "is_valid_to" => $validTo, //TODO: TARİHLER SORULACAK PDFTE: ZAHLBAR BİS:
            "template_slug" => "616547ba098cae573e7fbaa5"
        ];

        $url = 'https://api.bexio.com/2.0/kb_invoice';

        try {
            //RECHNUNG U OLUŞTUR
            $response = $client->request('POST', $url, [
                'headers' => $headers,
                'json' => $request_body,
            ]);

            //id yi almak için gerekli
            $responseContent = $response->getBody()->getContents();
            $data = json_decode($responseContent, true); // JSON verisini diziye dönüştürme

            $id = $data['id'];

            // CRM DEN MÜŞTERİYİ GÖNDER
            $customerSearch = self::customerSearch($crmCustomer);



            if($id)
            {
                $createPosition = self::createKbPositionCustom($id,$receiptId); // Pozisyonlar Ekleniyor
                $createDiscount = self::createKbPositionDiscount($id,$receiptId); // Discountlar Ekleniyor
                $sendMail = self::bexioSendInvoice($receiptId,$id); // Mail Gönderiliyor Mail gönderince fatura Offen oluyor BEXIO tarafında //TODO: Test Edildikten sonra aktif edilecek. (Bir checkbox koyulabilir)
                $createPayment = self::createPayment($id,$receiptId); // Mail gönderilmeden CreatePayment oluşturamıyorsun
                $invoiceIdRegister = ReceiptUmzug::where('id',$receiptId)->update([
                    'bexioId' => $id
                ]);
            }

            return redirect()->back()->with('success', 'BAŞARILI: FATURA OLUŞTURULDU.');
            // return redirect()->bakc('receipt.bexioNotification')->with('data','success');
            // return view('front.bexioApi.notification',['data' => 'success','message' => '',]);
            // return $response->getBody()->getContents();
        } catch (BadResponseException $e) {
            return redirect()->back()->with('error', 'ERROR: FATURA OLUŞTURULAMADI.');
            // handle exception or api errors.
            // return view('front.bexioApi.notification',['data' => 'error','message' => $e->getMessage(),]);
        }

    }

    // UNIT IDS
    // Stk: 1
    // h: 2
    // chf :3
    // Pauschal :5
    // p.M : 6
    // Kubikmeter: 7

    public static function createPayment($invoiceId,$receiptId)
    {

        $headers = self::getBexioHeaders();
        $client = self::getBexioClient();

        $receipt = ReceiptUmzug::where('id',$receiptId)->first();
        $receiptPrePayment = 0;

        if (isset($receipt['cashPrice']) && $receipt['cashPrice']) {
            $receiptPrePayment += $receipt['cashPrice'];
        }

        if (isset($receipt['twintPrice']) && $receipt['twintPrice']) {
            $receiptPrePayment += $receipt['twintPrice'];
        }

        $request_body = [
            'date' => Carbon::now(), // ödeme tarihi quittigung'a eklenecek veya eklenmeyecek sorulacak olmazsa bugün alınır
            'value' =>  $receiptPrePayment, // ödeme değeri
            'bank_account_id' => 1, // banka hesap id si genelde 1
        ];

        $url = 'https://api.bexio.com/2.0/kb_invoice/'.$invoiceId.'/payment'; // 1353 invoice id payment ise ödeme route u apinin


        try {
            $response = Http::withHeaders($headers)->post($url, $request_body);

            print_r($response->body());
        } catch (\Illuminate\Http\Client\RequestException $e) {
            // handle exception or api errors.
            print_r($e->getMessage());
        }
    }

    // Faturayı Doldurma
    public static function createKbPositionCustom($invoiceId,$receiptId)
    {
        $headers = self::getBexioHeaders();
        $client = self::getBexioClient();

        $receipt = ReceiptUmzug::where('id',$receiptId)->first();
        $receiptExtras = ReceiptExtra::where('id',$receipt['receiptExtraId'])->first();

        // Pozisyon verilerini dinamik olarak tanımlama
        $positionsData = [
            ["text" => "Umzug", "amount" => $receipt['umzugHour'], "unit_price" => $receipt['umzugChf'], "unit_id" => 2], // Unit id 2 olacak
            ["text" => "Spesen", "amount" => 1, "unit_price" => $receipt['umzugCharge'], "unit_id" => 3], // Unit id boş gidecek
            ["text" => "Anfahrt", "amount" => 1, "unit_price" => $receipt['umzugArrivalGas'], "unit_id" => 3],
            ["text" => "Rückfahrt", "amount" => 1, "unit_price" => $receipt['umzugReturnGas'], "unit_id" => 3],
            ["text" => "Verpackungsmaterial", "amount" => 1, "unit_price" => $receipt['materialPrice'], "unit_id" => 3],
            ["text" => "Entsorgung", "amount" => $receipt['entsorgungVolume'], "unit_price" => $receipt['entsorgungChf'], "unit_id" => 7], // Unit id 6 olacak
            ["text" => "EntsorgungAufwand", "amount" => 1, "unit_price" => $receipt['entsorgungFixedChf'], "unit_id" => 3],
        ];

        // Ekstra pozisyonlar 16 Tane olduğu için 16 tanesi kontrol ediliyor
        for ($i = 1; $i <= 16; $i++) {
            $extraTextKey = 'extra' . $i . 'Text';
            $extraPriceKey = 'extra' . $i;

            if (isset($receiptExtras[$extraTextKey]) && isset($receiptExtras[$extraPriceKey])) {
                $positionsData[] = [
                    "text" => $receiptExtras[$extraTextKey],
                    "amount" => 1,
                    "unit_price" => $receiptExtras[$extraPriceKey],
                    "unit_id" => 3
                ];
            }
        }

        $url = 'https://api.bexio.com/2.0/kb_invoice/'.$invoiceId.'/kb_position_article';

        $responses = [];

        foreach ($positionsData as $position) {
            if ($position['unit_price'] > 0) {
                $request_body = array_merge($position, [
                    "account_id" => 221,
                    "tax_id" => 43,
                    "discount_in_percent" => "0.000000",
                    "article_id" => 6
                ]);

                try {
                    $response = $client->request('POST', $url, [
                        'headers' => $headers,
                        'json' => $request_body,
                    ]);
                    $responses[] = $response->getBody()->getContents();
                } catch (BadResponseException $e) {
                    // handle exception or api errors.
                    $responses[] = $e->getMessage();
                }
            }
        }
        return $responses;

    }


    //Fatura Discountları ekleme
    public static function createKbPositionDiscount($invoiceId, $receiptId)
    {
        $headers = self::getBexioHeaders();
        $client = new Client();

        $receipt = ReceiptUmzug::where('id', $receiptId)->first();
        $receiptDiscounts = ReceiptDiscount::where('id', $receipt['receiptDiscountId'])->first();

        $url = 'https://api.bexio.com/2.0/kb_invoice/'.$invoiceId.'/kb_position_discount';
        $responses = [];

        for ($i = 1; $i <= 7; $i++) {
            $discountTextKey = 'discount' . $i . 'Text';
            $discountValueKey = 'discount' . $i;

            if (isset($receiptDiscounts[$discountTextKey]) && isset($receiptDiscounts[$discountValueKey])) {
                $request_body = [
                    'text' => $receiptDiscounts[$discountTextKey],
                    'is_percentual' => false,
                    'value' => $receiptDiscounts[$discountValueKey],
                ];

                try {
                    $response = Http::withHeaders($headers)->post($url, $request_body);
                    $responses[] = $response->body();
                } catch (\Illuminate\Http\Client\RequestException $e) {
                    // handle exception or api errors.
                    $responses[] = $e->getMessage();
                }
            }
        }

        return $responses;
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
    public static function bexioSendInvoice($receiptId,$invoiceId)
    {

        // dd('Burası');
        $receiptCRM = ReceiptUmzug::where('id',$receiptId)->first();
        $customer = Customer::where('id',$receiptCRM['customerId'])->first();

        $headers = self::getBexioHeaders();
        $client = self::getBexioClient();

        $requestBody = [
            "recipient_email" => $customer['email'],
            "subject" => "Rechnung - Helvetia Transporte & Umzüge AG",
            "message" => "Sehr geehrter Herr Yurdakul, <br> <br> Gerne möchten wir uns nochmals für die angenehme Zusammenarbeit bedanken. <br><br> Im Anhang finden Sie die Rechnung zu unserer Dienstleistung: [Network Link] <br><br> Sollten sich Abweichungen eingeschlichen haben, bitten wir Sie uns diese zu melden. <br><br>Für Rückfragen oder zur Klärung der Rechnung stehen wir Ihnen gerne zur Verfügung.",
            "mark_as_open" => true,
            "attach_pdf" => false
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

    // Bildirim
    public static function bexioApiNotification($bildirim){
        return 'Bildirim: ' . $bildirim;
    }

    // Show PDF
    public static function bexioShowPdf($bexioInvoiceId){
        $headers = self::getBexioHeaders();
        $client = self::getBexioClient();

        $url = 'https://api.bexio.com/2.0/kb_invoice/'.$bexioInvoiceId.'/pdf';

        try {
            // API'ye GET isteği gönderme
            $response = $client->request('GET', $url, array(
                'headers' => $headers,
            ));

            // Yanıt gövdesini al
            $responseBody = $response->getBody()->getContents();

            // JSON yanıtını ayrıştırma
            $responseData = json_decode($responseBody, true);

            // Base64 formatındaki içeriği çözme
            $pdfContent = base64_decode($responseData['content']);

            // Tarayıcıya PDF olarak gösterme
            header('Content-Type: ' . $responseData['mime']);
            header('Content-Disposition: inline; filename="' . $responseData['name'] . '"');
            header('Content-Length: ' . strlen($pdfContent));

            // PDF içeriğini göster
            echo $pdfContent;
            exit;
        }
        catch (\GuzzleHttp\Exception\BadResponseException $e) {
            // Hata durumunda mesajı döndür
            return $e->getMessage();
        }
    }

}
