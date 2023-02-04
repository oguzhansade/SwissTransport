

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
<div>
    <strong>@if($data['gender'] == 'male') Herr, @else Frau, @endif</strong>
    {{ $data['name'] }} {{ $data['surname'] }}
</div>

<div id="degisken">
    
    {{ $data['emailContent'] }}
</div>
<br />
<div>Vielen herzlichen Dank für Ihr Vertrauen und Ihre AuftragserteilungWir freuen uns, Sie bei Ihrem Umzug </div>
<br />
<div>unterstützen zu dürfen. Sollten Sie das definitive Startdatum und Uhrzeit noch nicht erhalten haben,werden diese in Kürze folgen. </div>
<br />
<br />
@if ($data['appDate'])
@foreach ($data['appDate'] as $item)
<strong>  {{ $item['serviceName'] }} - {{ $item['date'] }} </strong><br>
@endforeach
@endif


Falls Sie in der Zwischenzeit noch Fragen haben, freuen wir uns auf Ihre Kontaktaufnahme.</div>
<br /> <br />
<div class="footer">
<br />
<br />
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











