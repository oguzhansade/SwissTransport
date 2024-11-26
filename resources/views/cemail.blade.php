
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width" />
    <title></title>
    <style type="text/css">
        .big-container {
            font-family: arial, helvetica, sans-serif;
            font-size: 12px !important;
        }

        .big-container table tbody tr td {
            font-size: 12px !important;
        }

        .footer img {
            height: auto;
            max-width: 420px;
        }

        @media only screen and (max-width: 480px) {
            .footer img {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <div class="big-container">
        <div>
            @if (isset($data2) && $data2)
            @if ($data2['gender'] == 'male')
                Sehr geehrter Herr
            @else
                Sehr geehrte Frau
            @endif
            {{ $data2['surname'] }}
        @elseif (isset($data) && $data)
            @if ($data['gender'] == 'male')
                Sehr geehrter Herr
            @else
                Sehr geehrte Frau
            @endif
            {{ $data['surname'] }}
        @endif

        </div>

        <div id="degisken">
            <br>{{ $data['emailContent'] }}
        </div>
        @if ($AppTypeC == 'Besichtigung')
            <br><div>Vielen Dank für Ihr Interesse an unseren Dienstleistungen. </div>
            <br />
            <div>Hiermit bestätigen wir Ihnen den kostenlosen und unverbindlichen <br>Besichtigungstermin wie folgt:</div>
            <br />
            <br />
            <b>{{ $date }}</b><br><br>

            Falls Sie weitere Fragen an uns haben oder weitere Informationen benötigen, <br> können Sie sich gerne jederzeit direkt mit uns in Verbindung setzen. <br><br>
            Wir hoffen, dass wir Ihr Interesse wecken konnten, und würden uns freuen, Sie <br> schon bald als einen unserer zufriedenen Kunden begrüssen zu können <br><br>
            Für allfällige Fragen stehen wir Ihnen gerne zur Verfügung.
            </div>
            @elseif ($AppTypeC == 'Auftragsbestätigung')
                <div>
                    Wir bedanken uns herzlichst für die Auftragserteilung und Ihr entgegengebrachtes Vertrauen. <br>
                    Hiermit bestätigen wir Ihren Auftrag wie folgt:
                </div>
                <br />
                <br />
                {{ $date }}<br>
                <br /> <br /><br />
                <span style="color:#CF2E2E;font-size:18px;"><strong>Die Dienstleistungen sind in bar zu bezahlen, gemäss unseren AGB's der ASTAG.</strong> <br><br></span>
                Für allfällige Fragen stehen wir Ihnen gerne zur Verfügung.
                </div>
                </div>
                <br /> <br />
            @elseif($AppTypeC == 'Lieferung')
            <div>Besten Dank für Ihre Bestellung!   </div> <br>
            <div>Gerne bestätigen wir Ihnen den Liefertermin wie folgt: </div>
            <br /><br />
                <b>{{ $date }}</b><br>
                <br>Sollten Sie oder eine beauftragte Person die Sendung nicht persönlich in Empfang nehmen können,
                stellen wir diese an der angegebenen Adresse vor die Wohnungstüre. <br>

                Für allfällige Fragen stehen wir Ihnen gerne zur Verfügung.
            @elseif($AppTypeC == 'Abholung')
            <div>Wir bedanken uns für Ihren Umzugsauftrag und freuen uns, dass wir Sie mit unserem Packmaterial unterstützen konnten.</div> <br>
            <div>Gerne bestätigen wir Ihnen den Abholtermin wie folgt:</div>
            <br /><br />
                <b>{{ $date }}</b><br>
                <br>Für allfällige Fragen stehen wir Ihnen gerne zur Verfügung.<br>
        @endif

            <br><br>
            <div>Freundliche Grüsse</div>
            <div><strong>Ihr {{ \App\Models\Company::InfoCompany('name') }} Team</strong></div> <br><br>
            <div><img src="{{ asset('assets/demo/logo-expand.png') }}" width="200" /></div><br>
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
