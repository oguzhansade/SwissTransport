

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
        <strong>Sehr geehrte @if($data['gender'] == 'male') Herr @else Frau @endif</strong>
        {{ $data['surname'] }}
    </div>
        <div id="degisken">
            {{ $data['emailContent'] }}
        </div>
        <br />
    @if ($data['randevuTipi'] == 'Besichtigung')
        <div>Vielen Dank für Ihr Interesse an unseren Dienstleistungen. </div>
        <br />
        <div>Hiermit bestätigen wir Ihnen den kostenlosen und unverbindlichen <br>Besichtigungstermin wie folgt:</div>
        <br />
        <br />
        @if ($data['appDate'])
        @foreach ($data['appDate'] as $item)
        @php 
        Carbon\Carbon::setLocale('de');
        @endphp
        <strong> {{  Carbon\Carbon::parse($item['date'].' '.$item['time'])->translatedFormat('l j F Y H:i')  }} Uhr</strong>
        <br>
        @endforeach
        @endif
        
        
        <br><br>Falls Sie weitere Fragen an uns haben oder weitere Informationen benötigen, <br> können Sie sich gerne jederzeit direkt mit uns in Verbindung setzen. <br><br>
        Wir hoffen, dass wir Ihr Interesse wecken konnten, und würden uns freuen, Sie <br> schon bald als einen unserer zufriedenen Kunden begrüssen zu können <br><br>
        Für allfällige Fragen stehen wir Ihnen gerne zur Verfügung. 
        </div>
        <br /> <br />

    @elseif ($data['randevuTipi'] == 'Auftragsbestätigung')
        <div>
            Wir bedanken uns herzlichst für die Auftragserteilung und Ihr entgegengebrachtes Vertrauen. <br>
            Hiermit bestätigen wir Ihren Auftrag wie folgt:
        </div>
        <br />
        <br />
        @if ($data['appDate'])
        @foreach ($data['appDate'] as $item)
        @php 
        Carbon\Carbon::setLocale('de');
        @endphp

        <strong>  {{ $item['serviceName'] }}: {{  Carbon\Carbon::parse($item['date'].' '.$item['time'])->translatedFormat('l j F Y H:i')  }} Uhr</strong><br>
        @endforeach
        @endif
        
        <br><br>
        <span style="color:#CF2E2E;font-size:18px;"><strong>Die Dienstleistungen sind in bar zu bezahlen, gemäss unseren AGB's der ASTAG.</strong> <br><br></span>
        Für allfällige Fragen stehen wir Ihnen gerne zur Verfügung. 
        </div>
        </div>
        <br /> <br />
    @else
        <div>Vielen Dank für Ihr Interesse an unseren Dienstleistungen. </div>
        <br />
        <div>Hiermit bestätigen wir Ihnen den kostenlosen und unverbindlichen <br>Besichtigungstermin wie folgt:</div>
        <br />
        <br />
        @if ($data['appDate'])
        @foreach ($data['appDate'] as $item)
        @php 
        Carbon\Carbon::setLocale('de');
        @endphp
        <strong> {{  Carbon\Carbon::parse($item['date'].' '.$item['time'])->translatedFormat('l j F Y H:i')  }} Uhr</strong>
        <br>
        @endforeach
        @endif
        
        <br><br>Falls Sie weitere Fragen an uns haben oder weitere Informationen benötigen, <br> können Sie sich gerne jederzeit direkt mit uns in Verbindung setzen. <br><br>
        Wir hoffen, dass wir Ihr Interesse wecken konnten, und würden uns freuen, Sie <br> schon bald als einen unserer zufriedenen Kunden begrüssen zu können <br><br>
        Für allfällige Fragen stehen wir Ihnen gerne zur Verfügung. 
        </div>
        <br /> <br />

@endif
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











