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
        <strong>Sehr
        @if ($data['name'])
        
            @if($data['gender'] == 'male') 
            geehrter Herr 
            @else geehrte Frau 
            @endif
        
        {{ $data['name'] }} {{ $data['surname'] }}</strong>
        <br><br>
    
        @elseif ($customer['name'])
            
                @if($customer['gender'] == 'male') 
                geehrter Herr 
                @else geehrte Frau 
                @endif
            
         {{ $customer['name'] }} {{ $customer['surname'] }}</strong>
         <br><br>
        @endif 
    </div>
    <div>
        @if($data['appType'] == 0)
            Besten Dank für Ihr Interesse an unseren Dienstleistungen. <br>
            Resultierend aus der Besichtigung, finden Sie anbei unser Angebot für Ihren Umzug.<br><br>

            Ein Umzug erfordert eine detaillierte Planung und qualifiziertes Umzugspersonal. Wir verfügen über ein Team von professionell geschulten Umzugsexperten. Ihre Habseligkeiten sind bei uns in guten Händen. Darüber hinaus <br>
            handeln wir, dank unserer mehrjährigen Erfahrung, bei unerwartet auftretenden Problemen, schnell und lösungsorientiert. <br> <br>

            <strong>Ihre Nutzen, unsere Stärken:</strong> <br>
            <ul>
                <li>Schutzmaterial für Bilder, elektronische Geräte und Matratzenhüllen</li>
                <li>De- und Remontage des gesamten Mobiliars durch einen qualifizierten Monteur</li>
                <li>Bodenvlies zum Schutz heikler Bodenbeläge</li>
                <li>Stretchfolie für den optimalen Schutz heikler Möbel am Umzugstag</li>
                <li>Glas und Spiegel werden mit Luftpolsterfolie vor dem Transport geschützt</li>
                <li>Selbstverständlich führen wir Traggurte, Werkzeuge und genügend Wolldecken mit</li>
                <li>Die Transportversicherung beträgt CHF 100.000.– pro Lieferwagen (im Preis inbegriffen)</li>
                <li>Die Haftpflichtversicherung beträgt CHF 10.000.000.– (im Preis inbegriffen)</li>
            </ul> <br>

            Wenn unser Angebot Ihren Vorstellungen entspricht, können Sie unsere Offerte ganz einfach über unser Webformular bestätigen (optional auch per E-Mail): <br> <br> <br>
            
        @elseif($data['appType'] == 1)
            Vielen Dank, dass wir Sie heute besuchen durften. <br>
            Resultierend aus der Besichtigung, finden Sie anbei unser Angebot für Ihren Umzug.<br><br>

            Ein Umzug erfordert eine detaillierte Planung und qualifiziertes Umzugspersonal. Wir verfügen über ein Team von professionell geschulten Umzugsexperten. Ihre Habseligkeiten sind bei uns in guten Händen. Darüber hinaus <br>
            handeln wir, dank unserer mehrjährigen Erfahrung, bei unerwartet auftretenden Problemen, schnell und lösungsorientiert. <br> <br>

            <strong>Ihre Nutzen, unsere Stärken:</strong> <br>
            <ul>
                <li>Schutzmaterial für Bilder, elektronische Geräte und Matratzenhüllen</li>
                <li>De- und Remontage des gesamten Mobiliars durch einen qualifizierten Monteur</li>
                <li>Bodenvlies zum Schutz heikler Bodenbeläge</li>
                <li>Stretchfolie für den optimalen Schutz heikler Möbel am Umzugstag</li>
                <li>Glas und Spiegel werden mit Luftpolsterfolie vor dem Transport geschützt</li>
                <li>Selbstverständlich führen wir Traggurte, Werkzeuge und genügend Wolldecken mit</li>
                <li>Die Transportversicherung beträgt CHF 100.000.– pro Lieferwagen (im Preis inbegriffen)</li>
                <li>Die Haftpflichtversicherung beträgt CHF 10.000.000.– (im Preis inbegriffen)</li>
            </ul> <br>

            Wenn unser Angebot Ihren Vorstellungen entspricht, können Sie unsere Offerte ganz einfach über unser Webformular bestätigen (optional auch per E-Mail):  <br> <br> <br>
        @else
            Besten Dank für Ihr Interesse an unseren Dienstleistungen. <br>
            Resultierend aus der Besichtigung, finden Sie anbei unser Angebot für Ihren Umzug.<br><br>

            Ein Umzug erfordert eine detaillierte Planung und qualifiziertes Umzugspersonal. Wir verfügen über ein Team von professionell geschulten Umzugsexperten. Ihre Habseligkeiten sind bei uns in guten Händen. Darüber hinaus <br>
            handeln wir, dank unserer mehrjährigen Erfahrung, bei unerwartet auftretenden Problemen, schnell und lösungsorientiert. <br> <br>

            <strong>Ihre Nutzen, unsere Stärken:</strong> <br>
            <ul>
                <li>Schutzmaterial für Bilder, elektronische Geräte und Matratzenhüllen</li>
                <li>De- und Remontage des gesamten Mobiliars durch einen qualifizierten Monteur</li>
                <li>Bodenvlies zum Schutz heikler Bodenbeläge</li>
                <li>Stretchfolie für den optimalen Schutz heikler Möbel am Umzugstag</li>
                <li>Glas und Spiegel werden mit Luftpolsterfolie vor dem Transport geschützt</li>
                <li>Selbstverständlich führen wir Traggurte, Werkzeuge und genügend Wolldecken mit</li>
                <li>Die Transportversicherung beträgt CHF 100.000.– pro Lieferwagen (im Preis inbegriffen)</li>
                <li>Die Haftpflichtversicherung beträgt CHF 10.000.000.– (im Preis inbegriffen)</li>
            </ul> <br>

            Wenn unser Angebot Ihren Vorstellungen entspricht, können Sie unsere Offerte ganz einfach über unser Webformular bestätigen (optional auch per E-Mail): <br> <br> <br>
        @endif
    </div>


        @if ($data['token2'])
        <a href="{{ route('customerOfferView', $data['token2']) }}"
        style="background-color: #835AB2;
        border-radius: 30px;
        color: white!important;
        padding: 7px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 4px 2px;
        cursor: pointer;">Offerten Ansicht </a> <br>
        @endif 

        @if ($data['token'])
        <a class="text-info" href="{{ route('acceptOffer', $data['token']) }}"
        style="background-color: #007BFF;
        border-radius: 30px;
        color: white!important;
        padding: 7px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 4px 2px;
        cursor: pointer;">Offerte Annehmen</a>  <br>
        @endif

        @if ($data['token'])
        <a href="{{ route('rejectOffer', $data['token']) }}"
        style="background-color: #DC3545;
        border-radius: 30px;
        color: white!important;
        padding: 7px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 4px 2px;
        cursor: pointer;">Offerte Ablehnen </a>
        @endif
    </div>
    <div class="footer">
        <br><br>Falls Sie weitere Fragen an uns haben oder weitere Informationen benötigen, können Sie sich gerne jederzeit direkt mit uns in Verbindung setzen. <br><br>
        Wir hoffen, dass wir Ihr Interesse wecken konnten und würden uns freuen, Sie schon bald als einen unserer zufriedenen Kunden begrüssen zu können. <br><br>
    
        Für allfällige Fragen stehen wir Ihnen gerne zur Verfügung.  <br> <br>
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