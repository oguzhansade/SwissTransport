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
     <link href="{{ asset('assets/vendors/feather-icons/feather.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
    <div>
        @if ($data['name'])
            @if($data['gender'] == 'male') 
            Sehr geehrter Herr
            @else Sehr geehrte Frau
            @endif
            {{ $data['surname'] }}
            <br><br><br>
    
        @elseif ($customer['name'])
                @if($customer['gender'] == 'male') 
                Sehr geehrter Herr
                @else Sehr geehrte Frau
                @endif
            {{ $customer['surname'] }}  <br><br><br>
        @endif 
    </div>
    <div>
        @if($appType == '0')
        
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
            
        @elseif($appType == '1')
        
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
        @elseif($appType == '2')
        
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