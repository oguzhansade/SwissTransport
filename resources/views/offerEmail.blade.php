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
        Sehr
        @if ($data['name'])

            @if($data['gender'] == 'male')
            geehrter Herr
            @else geehrte Frau
            @endif

        {{ $data['surname'] }}
        <br><br>

        @elseif ($customer['name'])
                @if($customer['gender'] == 'male')
                geehrter Herr
                @else geehrte Frau
                @endif

         {{ $customer['surname'] }}
         <br><br>
        @endif
    </div>
    <div>
        @if($data['appType'] == 0)
            Vielen Dank für Ihre Anfrage. <br><br>

            Ein Umzug ist Vertrauenssache. Durch unsere sorgfältige Planung, Koordination <br>
            und professionelle Durchführung ist Ihr bevorstehender Umzug bei uns in besten Händen. <br><br>

            Mit uns haben Sie einen kompetenten Partner, der Ihr Auftrag sorgfältig plant und <br>
            pünktlich ausführt. Wir verfügen über erfahrene Mitarbeiter und zeichnen uns durch <br>
            Gründlichkeit, Umsichtigkeit und Fachkompetenz aus.<br> <br>

            <strong>Unkompliziert und preiswert umziehen:</strong> <br> <br>

            Unsere erfahrenen Mitarbeiter gehen bei Ihrem Auftrag gründlich und qualitativ vor. <br>
            Die Möbel werden für den Transport fachgerecht gesichert, um Schäden zu <br>
            vermeiden. <br><br>

            Ein Umzug bringt teilweise grosse Herausforderungen mit sich. Dies ist unseren <br>
            geschulten Mitarbeitern bewusst, deshalb arbeiten wir bei Ihrem Umzug mit extra viel <br>
            Fingerspitzengefühl. Der erweiterte Umzugsservice basiert auf langjährigen <br>
            Erfahrungswerten und bieten Ihnen genau die richtige Hilfe, die Sie brauchen.  <br><br>

            <strong style="font-size: 18px;">Ihre Vorteile</strong><br><br>
            <i style="color:red"><b>✓</b></i> Kompetente Beratung <br>
            <i style="color:red"><b>✓</b></i> Reibungslose Umzugsplanung <br>
            <i style="color:red"><b>✓</b></i> Leistungen aus einer Hand <br>
            <i style="color:red"><b>✓</b></i> Full-Service-Umzüge <br>
            <i style="color:red"><b>✓</b></i> Jahrelange Erfahrung <br>
            <i style="color:red"><b>✓</b></i> Geschultes Personal <br>
            <br>

            Wenn unser Angebot Ihren Vorstellungen entspricht, können Sie unsere Offerte ganz <br>
            einfach über unser Webformular bestätigen (optional auch per E-Mail):  <br> <br> <br>

        @elseif($data['appType'] == 1)
            Vielen Dank für die Zeit die Sie sich heute für uns genommen haben.  <br><br>
            Ein Umzug ist Vertrauenssache. Durch unsere sorgfältige Planung, Koordination <br>
            und professionelle Durchführung ist Ihr bevorstehender Umzug bei uns in besten Händen. <br><br>

            Mit uns haben Sie einen kompetenten Partner, der Ihr Auftrag sorgfältig plant und <br>
            pünktlich ausführt. Wir verfügen über erfahrene Mitarbeiter und zeichnen uns durch <br>
            Gründlichkeit, Umsichtigkeit und Fachkompetenz aus.<br> <br>

            <strong>Unkompliziert und preiswert umziehen:</strong> <br> <br>

            Unsere erfahrenen Mitarbeiter gehen bei Ihrem Auftrag gründlich und qualitativ vor. <br>
            Die Möbel werden für den Transport fachgerecht gesichert, um Schäden zu <br>
            vermeiden. <br><br>

            Ein Umzug bringt teilweise grosse Herausforderungen mit sich. Dies ist unseren <br>
            geschulten Mitarbeitern bewusst, deshalb arbeiten wir bei Ihrem Umzug mit extra viel <br>
            Fingerspitzengefühl. Der erweiterte Umzugsservice basiert auf langjährigen <br>
            Erfahrungswerten und bieten Ihnen genau die richtige Hilfe, die Sie brauchen.  <br><br>

            <strong style="font-size: 18px;">Ihre Vorteile</strong><br><br>
            <i style="color:red"><b>✓</b></i> Kompetente Beratung <br>
            <i style="color:red"><b>✓</b></i> Reibungslose Umzugsplanung <br>
            <i style="color:red"><b>✓</b></i> Leistungen aus einer Hand <br>
            <i style="color:red"><b>✓</b></i> Full-Service-Umzüge <br>
            <i style="color:red"><b>✓</b></i> Jahrelange Erfahrung <br>
            <i style="color:red"><b>✓</b></i> Geschultes Personal <br>
            <br>

            Wenn unser Angebot Ihren Vorstellungen entspricht, können Sie unsere Offerte ganz <br>
            einfach über unser Webformular bestätigen (optional auch per E-Mail):  <br> <br> <br>

        {{-- Reinigung Nein --}}
        @elseif($data['appType'] == 2)
            Vielen Dank für Ihre Anfrage.  <br><br>
            Durch unsere sorgfältige Planung, Koordination und professionelle Durchführung ist Ihre
            bevorstehende Reinigung bei uns in besten Händen.<br>

            Mit uns haben Sie einen kompetenten Partner, der Ihr Auftrag sorgfältig plant und
            pünktlich ausführt. Wir verfügen über erfahrene Mitarbeiter und zeichnen uns durch
            Gründlichkeit, Umsichtigkeit und Fachkompetenz aus.<br><br>

            Unsere erfahrenen Mitarbeiter gehen bei Ihrem Auftrag gründlich und qualitativ vor.
            Eine Reinigung bringt teilweise grosse Herausforderungen mit sich. Dies ist unseren
            geschulten Mitarbeitern bewusst, deshalb arbeiten wir bei Ihrer Reinigung mit extra
            viel Fingerspitzengefühl. Der erweiterte Reinigungsservice basiert auf langjährigen
            Erfahrungswerten und bieten Ihnen genau die richtige Hilfe, die Sie brauchen<br> <br>

            <strong style="font-size: 18px;">Unsere Endreinigungen beinhalten eine 100% Abgabegarantie mit folgenden
                Leistungsübersicht:</strong><br><br>
            <i ><b>•</b></i> Reinigung und Entkalkung der gesamten Küche: elektrischen Geräte, Kühlschränke,
            Küchenschränke, Spülbecken sowie Boden- und Wandbeläge <br>
            <i ><b>•</b></i> Reinigung und Entkalkung der Nasszellen inkl. Sanitäranlagen sowie Boden- und
            Wandbeläge <br>
            <i ><b>•</b></i> Innen- und Aussenreinigung von Fensterrahmen, Storen, Vorhangleisten, Fenstersimsen
            und Fenstergläsern <br>
            <i ><b>•</b></i> Reinigung von Türen, Türgriffen, Einbauschränken, Bodenleisten, Schaltern, Steckdosen,
            Radiatoren und<br>
            <i ><b>•</b></i> Reinigung von Bodenbelägen (staubsaugen und feucht aufnehmen)<br>
            <i ><b>•</b></i> Reinigung von Waschmaschinen und Tumbler <br>
            <i ><b>•</b></i> Reinigung Wände, Decken, Balken: ggf. von Spinnenweben befreien <br>
            <i ><b>•</b></i> Terrassen, Sitzplätze und Balkone besenrein putzen <br>
            <i ><b>•</b></i> Reinigung von Nebenräumen (Keller, Estrich, Briefkasten und Garage besenrein <br>
            <i ><b>•</b></i> Schliessen von Dübellöcher ohne Gewähr <br>
            <br>

            Wenn unser Angebot Ihren Vorstellungen entspricht, können Sie unsere Offerte ganz <br>
            einfach über unser Webformular bestätigen (optional auch per E-Mail):  <br> <br> <br>

        {{-- Reinigung Gemacht --}}
        @elseif($data['appType'] == 3)
            Vielen Dank für die Zeit die Sie sich heute für uns genommen haben.  <br><br>

            Durch unsere sorgfältige Planung, Koordination und professionelle Durchführung ist Ihre
            bevorstehende Reinigung bei uns in besten Händen<br>

            Mit uns haben Sie einen kompetenten Partner, der Ihr Auftrag sorgfältig plant und
            pünktlich ausführt. Wir verfügen über erfahrene Mitarbeiter und zeichnen uns durch
            Gründlichkeit, Umsichtigkeit und Fachkompetenz aus.<br><br>

            Unsere erfahrenen Mitarbeiter gehen bei Ihrem Auftrag gründlich und qualitativ vor.
            Eine Reinigung bringt teilweise grosse Herausforderungen mit sich. Dies ist unseren
            geschulten Mitarbeitern bewusst, deshalb arbeiten wir bei Ihrer Reinigung mit extra
            viel Fingerspitzengefühl. Der erweiterte Reinigungsservice basiert auf langjährigen
            Erfahrungswerten und bieten Ihnen genau die richtige Hilfe, die Sie brauchen<br> <br>

            <strong style="font-size: 18px;">Unsere Endreinigungen beinhalten eine 100% Abgabegarantie mit folgenden
                Leistungsübersicht:</strong><br><br>
            <i ><b>•</b></i> Reinigung und Entkalkung der gesamten Küche: elektrischen Geräte, Kühlschränke,
            Küchenschränke, Spülbecken sowie Boden- und Wandbeläge <br>
            <i ><b>•</b></i> Reinigung und Entkalkung der Nasszellen inkl. Sanitäranlagen sowie Boden- und
            Wandbeläge <br>
            <i ><b>•</b></i> Innen- und Aussenreinigung von Fensterrahmen, Storen, Vorhangleisten, Fenstersimsen
            und Fenstergläsern <br>
            <i ><b>•</b></i> Reinigung von Türen, Türgriffen, Einbauschränken, Bodenleisten, Schaltern, Steckdosen,
            Radiatoren und<br>
            <i ><b>•</b></i> Reinigung von Bodenbelägen (staubsaugen und feucht aufnehmen)<br>
            <i ><b>•</b></i> Reinigung von Waschmaschinen und Tumbler <br>
            <i ><b>•</b></i> Reinigung Wände, Decken, Balken: ggf. von Spinnenweben befreien <br>
            <i ><b>•</b></i> Terrassen, Sitzplätze und Balkone besenrein putzen <br>
            <i ><b>•</b></i> Reinigung von Nebenräumen (Keller, Estrich, Briefkasten und Garage besenrein <br>
            <i ><b>•</b></i> Schliessen von Dübellöcher ohne Gewähr <br>
            <br>

            Wenn unser Angebot Ihren Vorstellungen entspricht, können Sie unsere Offerte ganz <br>
            einfach über unser Webformular bestätigen (optional auch per E-Mail):  <br> <br> <br>
        @else
            Vielen Dank für Ihre Anfrage. <br><br>

            Ein Umzug ist Vertrauenssache. Durch unsere sorgfältige Planung, Koordination <br>
            und professionelle Durchführung ist Ihr bevorstehender Umzug bei uns in besten Händen. <br><br>

            Mit uns haben Sie einen kompetenten Partner, der Ihr Auftrag sorgfältig plant und <br>
            pünktlich ausführt. Wir verfügen über erfahrene Mitarbeiter und zeichnen uns durch <br>
            Gründlichkeit, Umsichtigkeit und Fachkompetenz aus.<br> <br>

            <strong>Unkompliziert und preiswert umziehen:</strong> <br> <br>

            Unsere erfahrenen Mitarbeiter gehen bei Ihrem Auftrag gründlich und qualitativ vor. <br>
            Die Möbel werden für den Transport fachgerecht gesichert, um Schäden zu <br>
            vermeiden. <br><br>

            Ein Umzug bringt teilweise grosse Herausforderungen mit sich. Dies ist unseren <br>
            geschulten Mitarbeitern bewusst, deshalb arbeiten wir bei Ihrem Umzug mit extra viel <br>
            Fingerspitzengefühl. Der erweiterte Umzugsservice basiert auf langjährigen <br>
            Erfahrungswerten und bieten Ihnen genau die richtige Hilfe, die Sie brauchen.  <br><br>

            <strong style="font-size: 18px;">Ihre Vorteile</strong><br><br>
            <i style="color:red"><b>✓</b></i> Kompetente Beratung <br>
            <i style="color:red"><b>✓</b></i> Reibungslose Umzugsplanung <br>
            <i style="color:red"><b>✓</b></i> Leistungen aus einer Hand <br>
            <i style="color:red"><b>✓</b></i> Full-Service-Umzüge <br>
            <i style="color:red"><b>✓</b></i> Jahrelange Erfahrung <br>
            <i style="color:red"><b>✓</b></i> Geschultes Personal <br>
            <br>

            Wenn unser Angebot Ihren Vorstellungen entspricht, können Sie unsere Offerte ganz <br>
            einfach über unser Webformular bestätigen (optional auch per E-Mail):  <br> <br> <br>
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
        style="background-color: #28A745;
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
