
@if ($data['mailType'] == 'beforeOneWeek')
    
    Sehr geehrte  @if($data['customer']['gender'] == 'male') Herr  @else Frau @endif{{ $data['customer']['surname'] }} <br><br>

    Wir bedanken uns für Ihren Auftrag  und freuen uns, dass wir Ihren Umzug am {{ $data['umzugDate'] }} (um {{ $data['umzugTime'] }} Uhr beginnend) durchführen werden.<br><br>

    Damit wir Ihnen am Umzugstag einen reibungslosen Umzug sowie optimalen Schutz für Ihre Möbel gewährleisten, ist unser Umzugsteam bereits mit ausreichend Schutzmaterial wie Schutzfolien, Stretchfolien und Decken ausgestattet. Dennoch wollen wir Sie fragen, ob Sie noch etwas brauchen oder uns etwas mitteilen möchten?<br><br>

    Sollten sich irgendwelche Fehler eingeschlichen haben, so bitten wir Sie, dies uns umgehend zu melden.<br><br>

    Für allfällige Fragen stehen wir Ihnen gerne zur Verfügung.

@elseif ($data['mailType'] == 'twoWeeksAfter')
    
    Sehr geehrte  @if($data['customer']['gender'] == 'male') Herr  @else Frau @endif{{ $data['customer']['surname'] }} <br><br>

    Wir bedanken uns, dass Sie sich für die Swiss Transporte GmbH entschieden haben und wir Ihren Umzug gestalten durften.<br><br>

    Um unsere Qualität weiter zu verbessern, sind wir an Ihrem Feedback interessiert. Ihre Meinung ist uns wichtig und hilft uns dabei, unseren Service kontinuierlich zu optimieren. <br><br>

    Waren Sie mit unserem Service zufrieden oder haben Sie sogar Vorschläge zur Verbesserung? Und würden Sie uns weiterempfehlen? Sehen Sie hierzu bitte unsere "Kunden-werben- Kunden-Programm" auf unserer Homepage. Sie können die Swiss Transporte GmbH weiterempfehlen und Prämien sichern.<br><br>

    Wir möchten uns bereits im Voraus für Ihre Zeit und Mühe bedanken.
    

@elseif ($data['mailType'] == 'afterOneMonth')
    
    Sehr geehrte  @if($data['customer']['gender'] == 'male') Herr  @else Frau @endif{{ $data['customer']['surname'] }} <br><br>

    Sie sind begeisterter Swiss Transporte Kunde und wollen, dass auch andere Unternehmen oder Freunde in Ihrem Umfeld von den Vorzügen unseres Services profitieren? Dann empfehlen Sie uns weiter!<br><br>

    Mit unserem Kunden-werben- Kunden Programm belohnen wir Swiss Transporte Kunden!<br><br>

    Für jede erfolgreiche Weiterempfehlung von unserem Unternehmen kassieren Sie eine Prämie von CHF 50.00. Nicht nur das - der geworbene Neukunde erhält ausserdem einen Rabatt von 10% auf den Auftrag.
    Interesse geweckt? <br><br>

    Bitte setzen Sie sich mit unserem Team in Verbindung:
    Tel: 044 731 96 58 oder ganz einfach per E-Mail:  info@swisstransport.ch <br><br>

    Für allfällige Fragen stehen wir Ihnen gerne zur Verfügung. 
    
@else 

@endif
<div class="footer">
    <br>Falls Sie weitere Fragen an uns haben oder weitere Informationen benötigen,  <br>
    können Sie sich gerne jederzeit direkt mit uns in Verbindung setzen.  <br><br>

    
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
                <a href="{{ \App\Models\Company::InfoCompany('website') }}" target="_blank">www.swisstransport.ch</a>
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