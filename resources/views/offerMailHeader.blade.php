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
        Sehr geehrter
        @if ($data['name'])
        <strong>
            @if($data['gender'] == 'male') 
            Herr, 
            @else Frau, 
            @endif
        </strong>
            {{ $data['surname'] }}
            <br><br><br>
    
        @elseif ($customer['name'])
            <strong>
                @if($customer['gender'] == 'male') 
                Herr, 
                @else Frau, 
                @endif
            </strong>
            {{ $customer['surname'] }}  <br><br><br>
        @endif 
    </div>
    <div>
        @if($data['appType'] == 0)
            Besten Dank für Ihr Interesse an unseren Dienstleistungen. <br>
            Resultierend aus der Besichtigung, finden Sie anbei unser Angebot für Ihren Umzug.<br><br>

            Ein Umzug erfordert eine detaillierte Planung und qualifiziertes Umzugspersonal. Wir verfügen über ein Team von professionell geschulten Umzugsexperten. Ihre Habseligkeiten sind bei uns in guten Händen. Darüber hinaus <br>
            handeln wir, dank unserer mehrjährigen Erfahrung, bei unerwartet auftretenden Problemen, schnell und lösungsorientiert. <br> <br>

            <strong>Ihre Nutzen, unsere Stärken:</strong> <br> <br>
            <ul>
                <li>Schutzmaterial für Bilder, elektronische Geräte und Matratzenhüllen</li>
                <li>De- und Remontage des gesamten Mobiliars durch einen qualifizierten Monteur</li>
                <li>Bodenvlies zum Schutz heikler Bodenbeläge</li>
                <li>Stretchfolie für den optimalen Schutz heikler Möbel am Umzugstag</li>
                <li>Glas und Spiegel werden mit Luftpolsterfolie vor dem Transport geschützt</li>
                <li>Selbstverständlich führen wir Traggurte, Werkzeuge und genügend Wolldecken mit</li>
                <li>Die Transportversicherung beträgt CHF 100.000.– pro Lieferwagen (im Preis inbegriffen)</li>
                <li>Die Haftpflichtversicherung beträgt CHF 10.000.000.– (im Preis inbegriffen)</li>
            </ul> <br><br>

            Wenn unser Angebot Ihren Vorstellungen entspricht, können Sie unsere Offerte ganz einfach über unser Webformular bestätigen (optional auch per E-Mail): <br> <br> <br>
            
        @elseif($data['appType'] == 1)
            Vielen Dank, dass wir Sie heute besuchen durften. <br>
            Resultierend aus der Besichtigung, finden Sie anbei unser Angebot für Ihren Umzug.<br><br>

            Ein Umzug erfordert eine detaillierte Planung und qualifiziertes Umzugspersonal. Wir verfügen über ein Team von professionell geschulten Umzugsexperten. Ihre Habseligkeiten sind bei uns in guten Händen. Darüber hinaus <br>
            handeln wir, dank unserer mehrjährigen Erfahrung, bei unerwartet auftretenden Problemen, schnell und lösungsorientiert. <br> <br>

            <strong>Ihre Nutzen, unsere Stärken:</strong> <br> <br>
            <ul>
                <li>Schutzmaterial für Bilder, elektronische Geräte und Matratzenhüllen</li>
                <li>De- und Remontage des gesamten Mobiliars durch einen qualifizierten Monteur</li>
                <li>Bodenvlies zum Schutz heikler Bodenbeläge</li>
                <li>Stretchfolie für den optimalen Schutz heikler Möbel am Umzugstag</li>
                <li>Glas und Spiegel werden mit Luftpolsterfolie vor dem Transport geschützt</li>
                <li>Selbstverständlich führen wir Traggurte, Werkzeuge und genügend Wolldecken mit</li>
                <li>Die Transportversicherung beträgt CHF 100.000.– pro Lieferwagen (im Preis inbegriffen)</li>
                <li>Die Haftpflichtversicherung beträgt CHF 10.000.000.– (im Preis inbegriffen)</li>
            </ul> <br><br>

            Wenn unser Angebot Ihren Vorstellungen entspricht, können Sie unsere Offerte ganz einfach über unser Webformular bestätigen (optional auch per E-Mail):  <br> <br> <br>
        @else
            Besten Dank für Ihr Interesse an unseren Dienstleistungen. <br>
            Resultierend aus der Besichtigung, finden Sie anbei unser Angebot für Ihren Umzug.<br><br>

            Ein Umzug erfordert eine detaillierte Planung und qualifiziertes Umzugspersonal. Wir verfügen über ein Team von professionell geschulten Umzugsexperten. Ihre Habseligkeiten sind bei uns in guten Händen. Darüber hinaus <br>
            handeln wir, dank unserer mehrjährigen Erfahrung, bei unerwartet auftretenden Problemen, schnell und lösungsorientiert. <br> <br>

            <strong>Ihre Nutzen, unsere Stärken:</strong> <br> <br>
            <ul>
                <li>Schutzmaterial für Bilder, elektronische Geräte und Matratzenhüllen</li>
                <li>De- und Remontage des gesamten Mobiliars durch einen qualifizierten Monteur</li>
                <li>Bodenvlies zum Schutz heikler Bodenbeläge</li>
                <li>Stretchfolie für den optimalen Schutz heikler Möbel am Umzugstag</li>
                <li>Glas und Spiegel werden mit Luftpolsterfolie vor dem Transport geschützt</li>
                <li>Selbstverständlich führen wir Traggurte, Werkzeuge und genügend Wolldecken mit</li>
                <li>Die Transportversicherung beträgt CHF 100.000.– pro Lieferwagen (im Preis inbegriffen)</li>
                <li>Die Haftpflichtversicherung beträgt CHF 10.000.000.– (im Preis inbegriffen)</li>
            </ul> <br><br>

            Wenn unser Angebot Ihren Vorstellungen entspricht, können Sie unsere Offerte ganz einfach über unser Webformular bestätigen (optional auch per E-Mail): <br> <br> <br>
        @endif
    </div>