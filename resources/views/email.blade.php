

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
    <div>Freundliche Grüsse</div>
    <div><strong>Ihr Swiss Transport Team</strong></div> <br><br>
    <div><img src="https://www.swisstransport-crm.ch/public/assets/demo/swiss-logo.png" width="200" /></div><br>
    <div><strong>{{ \App\Models\Company::InfoCompany('name') }}</strong></div>
    <div>{{ \App\Models\Company::InfoCompany('street') }}</div>
    <div>CH-{{ \App\Models\Company::InfoCompany('post_code') }} {{ \App\Models\Company::InfoCompany('city') }}</div> <br>
    <table valign="top" align="left" style="padding:0px!important;">
        <tbody valign="top" align="left" style="padding:0px!important;">
        <tr valign="top" align="left" style="padding:0px!important;">
            <td valign="top" align="left" style="padding:0px!important;">
                Telefon: <br>
                E-Mail: <br>
                Internet:
            </td>
            <td valign="top" align="left" style="padding:0px!important;">
                {{ \App\Models\Company::InfoCompany('phone') }} <br>
                {{ \App\Models\Company::InfoCompany('email') }} <br>
                <a href="{{ \App\Models\Company::InfoCompany('website') }}" target="_blank">{{ \App\Models\Company::InfoCompany('name') }}</a>
            </td>
        </tr>
        </tbody>
    </table> <br> <br>
    <div><br> <br><img src="https://www.swisstransport-crm.ch/public/assets/demo/topservice_300.png" width="200" /></div>
    <div><strong><i>- Gegenseitiges Vertrauen ist beidseitig gewinnbringend -</i></strong></div>
    <br />
    <div><span style="font-size: 11.0px;">Diese E-Mail ist ausschliesslich für den angeführten Empfänger bestimmt. Sie enthält vertrauliche Informationen. Falls Sie diese E-Mail versehentlich erhalten haben, informieren Sie bitte unverzüglich den Absender.</span></div>
    </div>
</div>
</body>
</html>











