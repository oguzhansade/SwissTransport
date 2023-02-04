<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <title></title>
    <style type="text/css">
        body {
            font-family: arial, helvetica, sans-serif;
            font-size: 12px !important;
        }
        table tbody tr td {
            font-size: 12px !important;
        }
        .footer img {
            height: auto;
            max-width: 420px;
        }
        @media only screen and (max-width: 480px)
        {
            .footer img {
                width: 100% !important;
            }
        }
    </style>
</head>
<body>
    <div>
        @if ($data['name'])
        <strong>
            @if($data['gender'] == 'male') 
            Herr, 
            @else Frau, 
            @endif
        </strong>
            {{ $data['name'] }} {{ $data['surname'] }}
            <br><br><br>
    
        @elseif ($customer['name'])
            <strong>
                @if($customer['gender'] == 'male') 
                Herr, 
                @else Frau, 
                @endif
            </strong>
            {{ $customer['name'] }} {{ $customer['surname'] }}  <br><br><br>
        @endif 
    </div>
    <div>
        @if($data['appType'] == 1)
            Besten Dank für Ihre Anfrage <br><br>

            Aufgrund Ihrer Daten haben wir Ihnen basierend auf unserer Erfahrung ein Richtangebot erstellt. <br>
            Eine individuelle und exakte Offerte, erstellen wir Ihnen gerne nach Erhalt des Umzugsvolumens <br><br>

            Falls das Angebot Ihren Erwartungen entspricht, können Sie das Dokument unterschrieben per Post, E-Mail oder  <br>
            Fax retournieren. <br><br>

            Nach Überprüfung auf möglichen Termin bestätigen wir Ihnen gerne den Auftrag verbindlich zurück. <br> <br>

            Wir freuen uns sehr, wenn wir Sie bei Ihrem Umzug unterstützen dürfen und stehen für Rückfragen gerne zur  Verfügung.<br><br>
        @else
        Besten Dank für Ihr Interesse an unseren Dienstleistungen.<br>
        Anbei erhalten Sie Ihr individuelles Angebot.<br>
        Falls Ihnen unser Angebot zusagt, bitten wir Sie dieses online zu bestätigen.<br>
        Nach Eingang erhalten Sie Ihre verbindliche Rückbestätigung.<br><br>
        @endif


        @if ($data['token2'])
        Offerte <a href="{{ route('customerOfferView', $data['token2']) }}"
        style="background-color: #713CE8;
        border-radius: 30px;
        color: white!important;
        padding: 7px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 4px 2px;
        cursor: pointer;">Ansicht </a>
        @endif 
        {{-- /
        @if ($data['token'])
        <a href="{{ route('acceptOfferView', $data['token']) }}"
        style="background-color: #1c9226;
        border-radius: 30px;
        color: white!important;
        padding: 7px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 4px 2px;
        cursor: pointer;">Genehmigen</a>
        @endif --}}
    </div>
    <div class="footer">
        <table >
            <tbody>
            <tr>
                <td valign="top" style="padding:10px;">
                    <div><strong>Büro</strong></div>
                    <div>{{ \App\Models\Company::InfoCompany('street') }}</div>
                    <div>{{ \App\Models\Company::InfoCompany('post_code') }} {{ \App\Models\Company::InfoCompany('city') }}</div>
                    <br />
                    <div><strong>Lager</strong></div>
                    <div>Adlikerstrasse 280</div>
                    <div>8105 Regensdorf ZH</div>
                </td>
                <td valign="top" style="padding:10px;">
                    <div><strong>{{ \App\Models\Company::InfoCompany('contact_person') }}</strong></div>
                    <div>Ihr persönlicher Umzugsberater</div>
                    <br />
                    <div>Tel : {{ \App\Models\Company::InfoCompany('phone') }}</div>
                    <div>Mobile : {{ \App\Models\Company::InfoCompany('mobile') }}</div>
                    <br />
                    <div>{{ \App\Models\Company::InfoCompany('email') }}</div>
                    <div><a href="{{ \App\Models\Company::InfoCompany('website') }}" target="_blank">swisstransport.ch</a></div>
                </td>
            </tr>
            </tbody>
        </table>
        
        <br />
        <div><img src="{{ asset('assets/demo/swiss-logo.png') }}" width="420" /></div>
        <br />
        <div><img src="https://menspower-umzuege-crm.ch/Content/accountdata/7/mail/img/freferences.png" width="840" /></div>
        <br />
        <div><span style="font-size: 11.0px;">Der Inhalt dieser E-Mail ist vertraulich und nur für den bezeichneten Adressaten bestimmt. Wenn Sie nicht der Adressat oder Vertreter dieser E-Mail sind, beachten Sie bitte, dass jede Entgegennahme, Veröffentlichung, Vervielfältigung oder Übermittlung des Inhalts dieser E-Mail untersagt ist. Wenden Sie sich in diesem Fall bitte an den Absender.</span></div>
        </div>
    </div>
</body>
</html>