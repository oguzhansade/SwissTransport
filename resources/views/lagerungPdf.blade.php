<!DOCTYPE html>
<html>
<head>
    <title>Invoice - {{ $invoiceNumber }}</title>
    <meta charset="UTF-8">
    <style>
        *{ font-family: DejaVu Sans !important;
            font-size:10px;
            line-height: 9.5px;
            }
            @page {
                margin: 100px 25px;
            }

            header {
                position: fixed;
                top: -90px;
                left: 0px;
                right: 0px;
                bottom: 20px;
                /** Extra personal styles **/
                text-align: center;
                padding: 0px;
                line-height: 12px;
                
            }

            footer {
                position: fixed; 
                bottom: -80px; 
                left: 0px; 
                right: 0px;
                border-top:black 1px solid;
                /** Extra personal styles **/
                text-align: center;
            }

            .qr {
                position: fixed; 
                bottom: -50px; 
                left: 0px; 
                right: 0px;
                
                text-align: center;
            }
            .pagenum:before {
            content: counter(page);
            }
    </style>
    @include('bootstrap')
    
</head>
<body> 
    <header >
        <table style="width: 100%;">
            <tr  style="padding-top:0px;width: 100%;" >
                <td>
                    <table style="width: 100%;">
                        <tr style="width: 100%;">
                            <td align="left">
                                Invoice: 
                            </td>
                            <td  align="left">
                                {{ $invoiceNumber }}
                            </td>
                        </tr>
                        <tr  style="width: 100%;">
                            <td >Datum:</td>
                            <td >{{ date('d.m.Y', strtotime($invoice['created_at'])); }}</td>
                        </tr>
                        <tr>
                            <td>Page</td>
                            <td><span class="pagenum"></span></td>
                        </tr>
                    </table>
                </td>
                <td align="right" >
                    <a href="{{ App\Models\Company::InfoCompany('website') }}" target="_blank"><img style="padding:0px;" src="{{ asset('assets/demo/logo-expand.png') }}" width="300" /></a>
                </td>
            </tr>
        </table>
    </header>
    <footer>
        <p style="font-size:9px;">{{ App\Models\Company::InfoCompany('name') }} | {{ App\Models\Company::InfoCompany('street') }} | CH-{{ App\Models\Company::InfoCompany('post_code') }} {{ App\Models\Company::InfoCompany('city') }} | Telefon: {{ App\Models\Company::InfoCompany('phone') }} | {{ App\Models\Company::InfoCompany('email') }} | {{ App\Models\Company::InfoCompany('website') }}</p>
    </footer>
    <main>
        <div class="teklif-boyutu">
            <table border="0" style="width:100%;page-break-after: always;" >
    
                <tr style="width:100%;">
                    <td colspan="4" class="py-1 " style="background-color:#E5E5E5;">
                        <b style="font-size:13px;">Rechnung {{ $invoiceNumber }} vom {{ date('d.m.Y', strtotime($invoice['created_at'])); }} für Herr {{ $customer['name'] }} {{ $customer['surname'] }}</b>
                    </td>
                </tr>
                <tr  style="width:100%;">
                    <td class="pt-3" colspan="2" >
                    {{-- Şirket Adı --}}
                    <b>{{ App\Models\Company::InfoCompany('name') }}</b><br>
                    {{ App\Models\Company::InfoCompany('street') }}<br>
                    {{ App\Models\Company::InfoCompany('post_code') }} {{ App\Models\Company::InfoCompany('city') }}<br>

                    </td>
                    <td class="pt-4" colspan="2">
                        {{-- Müşteri Bilgileri --}}
                        <span style="color:#835AB1;font-size:9px;">Auftraggeber:</span><br>
                        {{ $customer['name'] }} {{ $customer['surname'] }}<br>
                        {{ $customer['street'] }} <br>
                        {{ $customer['postCode'] }} {{ $customer['country'] }} <br>
                    </td>
                </tr>
        
                <tr  style="width:100%;">
                    <td class="pt-3" >
                        <span style="color:#835AB1;font-size:9px;">Unsere Angaben:</span><br>
                        Ihr direkter Ansprechpartner:
                    </td>
                    <td class="pt-3">
                        {{-- Müşteri Bilgileri --}}
                        <br>
                        {{ \App\Models\Company::InfoCompany('contact_person') }}<br>
                    </td>
                </tr>

                <tr  style="width:100%;">
                    <td class="pt-3" >
                        E-Mail:<br>
                        Hotline:
                    </td>
                    <td class="pt-3">
                        {{ App\Models\Company::InfoCompany('email') }} <br>
                        {{ App\Models\Company::InfoCompany('phone') }} 
                    </td>
                </tr>

                <tr style="width:100%;">
                    <td colspan="4" style="padding-top:30px">
                        <b>Sehr geehrter Herr {{ $customer['surname'] }} <br>
                            Entsprechend unserer Vereinbarung erlauben wir uns, Ihnen die folgenden Leistungen wie folgt zu berechnen:</b>
                    </td>
                </tr>
    
                <tr style="width:100%;">
                    <td colspan="4" style="padding-top:5px;"></td>
                </tr>
    
                <tr style="width:100%;">
                    <td class="p-1 " style="background-color:#E5E5E5;">
                        <b >Bezeichnung</b>
                    </td>
                    <td class="p-1 " style="background-color:#E5E5E5;">
                        <b >Datum</b>
                    </td>
                    <td class="p-1 " style="background-color:#E5E5E5;">
                        <b >Aufwand</b>
                    </td>
                    <td class="p-1 " style="background-color:#E5E5E5;">
                        <b >Betrag inkl. MwSt.</b>
                    </td>
                </tr>

                {{-- Lagerung Alanı --}}
                
                    <tr style="width: 100%">
                        <td colspan="2" valign="top" style="padding-top:5px;">
                            <b>Lagerung</b>
                        </td>
                        <td valign="top" style="padding-top:5px;">
                            {{ $lagerung['lagerungVolume'] }} m3 à {{ $lagerung['lagerungChf'] }} im Monat
                        </td>
                        <td valign="top" style="padding-top:5px;padding-left:40px;">
                            CHF {{ $lagerung['lagerungVolume']*$lagerung['lagerungChf'] }}
                        </td>
                        </tr>
                        <tr style="width:100%;">
                            <td valign="top" style="padding-top:5px;">
                                <b>Verrechnungsperiode</b>
                            </td>
                            <td valign="top" style="padding-top:5px;">
                                {{ $lagerung['lagerungStartDate'] }} - {{ $lagerung['lagerungEndDate'] }}
                            </td>
                            <td colspan="2">
                                <table style="width:100%;">
                                    <tr style="width:100%;">
                                        <td colspan="2" style="padding-top:5px;"></td>
                                    </tr>
    
                                    @if($lagerung['extraValue1'])<tr style="width:100%;"><td>@if ( $lagerung['extraText1']) {{  $lagerung['extraText1'] }} @else Ek Masraf 1 @endif</td><td style="padding-left:10px;"> {{ $lagerung['extraValue1'] }} CHF</td></tr>@endif
                                    @if($lagerung['extraValue2'])<tr style="width:100%;"><td>@if ( $lagerung['extraText2']) {{  $lagerung['extraText2'] }} @else Ek Masraf 2 @endif</td><td style="padding-left:10px;"> {{ $lagerung['extraValue2'] }} CHF</td></tr>@endif
                                
                                    <tr style="width:100%;">
                                        <td colspan="2" style="padding-top:5px;"></td>
                                    </tr>
    
                                    @if($lagerung['discount'])<tr style="width:100%;"><td>Rabatt</td><td style="padding-left:10px;">-{{ $lagerung['discount'] }} CHF</td></tr>@endif
                                    @if($lagerung['discount2'])<tr style="width:100%;"><td>Rabatt 2</td><td style="padding-left:10px;">-{{ $lagerung['discount2'] }} CHF</td></tr>@endif
                                    @if($lagerung['extraDiscountValue1'])<tr style="width:100%;"><td>@if ( $lagerung['extraDiscountText1']) {{  $lagerung['extraDiscountText1'] }} @else Ek İndirim 1 @endif</td><td style="padding-left:10px;">-{{ $lagerung['extraDiscountValue1'] }} CHF</td></tr>@endif
                                    @if($lagerung['extraDiscountValue2'])<tr style="width:100%;"><td>@if ( $lagerung['extraDiscountText2']) {{  $lagerung['extraDiscountText2'] }} @else Ek İndirim 2 @endif</td><td style="padding-left:10px;">-{{ $lagerung['extraDiscountValue2'] }} CHF</td></tr>@endif
    
    
                                    <tr style="width:100%;">
                                        <td colspan="2" style="padding-top:5px;"></td>
                                    </tr>
    
                                    @if($lagerung['lagerungFixedCost'])
                                    <tr style="width:100%;">
                                        <td><b>Pauschalpreis</b></td>
                                        <td style="padding-left:10px;"> {{ $lagerung['lagerungFixedCost']}} CHF</td>
                                    </tr>
                                    @endif
    
                                    <tr style="width:100%;">
                                        <td>Anzahlung</td>
                                        <td style="padding-left:10px;">-{{ $lagerung['lagerungPaid1']}} CHF</td>
                                    </tr>
                                    <tr style="width:100%;">
                                        <td>Bar Bezahlt</td>
                                        <td style="padding-left:10px;">-{{ $lagerung['lagerungPaid2']}} CHF</td>
                                    </tr>
    
                                    <tr style="width:100%;">
                                        <td colspan="2" style="padding-top:5px;"></td>
                                    </tr>
    
                                    <tr style="width:100%;">
                                        <td><b>Cost</b></td>
                                        <td style="padding-left:10px;"> <span style="color:#835AB1;"><b>{{ $lagerung['lagerungTotalPrice'] }} CHF</b></span></td>
                                    </tr>
                                </table>
                            </td>
                    </tr>
                
    
                {{-- Son Hesaplar --}}
                <tr style="width:100%;">
                    <td colspan="3"><b>Mahnungsgebühr</b></td>
                    <td style="padding-left:58px;"><b> {{ $invoice['warningPrice'] }} CHF</b></td>
                </tr>
    
    
                <tr class="p-1" style="background-color: #E5E5E5;">
                    <td colspan="3"><b>Total Kosten</b></td>
                    <td style="padding-left:58px;"><b>  {{ $invoice['totalPrice'] }} CHF</b> </td>
                </tr>
    
                <tr style="width:100%;">
                    <td colspan="4" style="padding-top:5px;"></td>
                </tr>
    
                <tr style="width:100%;">
                    <td ><b>Zahlungskonditionen:</b></td>
                    <td>In @if ($invoice['payCondition'] == 1)
                        7 @elseif ($invoice['payCondition'] == 2) 14 @else 31
                    @endif Tagen zu zahlen</td>
                </tr>
    
                <tr style="width:100%;">
                    <td><b>Bankverbindung:</b></td>
                    <td>CREDIT SUISSE (Schweiz) AG</td>
                </tr>
    
                <tr style="width:100%;">
                    <td><b>IBAN-Nummer:</b></td>
                    <td>CH14 0483 5325 9484 0100 0</td>
                </tr>
    
                <tr style="width:100%;">
                    <td><b>BIC/SWIFT:</b></td>
                    <td>CRESCHZZ80A</td>
                </tr>
    
                <tr>
                    <td>Herzlichen Dank für den geschätzten Auftrag.</td>
                </tr>
    
                <tr>
                    <td>{{ App\Models\Company::InfoCompany('name') }}</td>
                </tr>
                
                <tr>
                    <td>{{ App\Models\Company::InfoCompany('name') }}</td>
                    <td>Telefon:</td>
                    <td>{{ App\Models\Company::InfoCompany('mobile') }}</td>
                </tr>
    
                <tr>
                    <td>{{ App\Models\Company::InfoCompany('street') }}</td>
                    <td>Email:</td>
                    <td>{{ App\Models\Company::InfoCompany('email') }}</td>
                </tr>
            </table>
        </div>

        <div class="bemerkungen" style="page-break-after: always;">
            <span class="mb-5"><b style="font-size:24px!important;line-height:24px;">Bemerkungen</b></span>
            <p class="mt-5">Endreinigungen beinhalten eine 100% Abgabegarantie mit folgenden Leistungen:</p>
            <ul>
                <li>Grundreinigung der Küche (Backofen, Dampfabzug, Kühlschrank, Küchenschränke)</li>
                <li>Reinigung der Badezimmer und Sanitäranlagen</li>
                <li>Innen- und Aussenreinigung von Fensterrahmen, Storen, Vorhangleisten, Fenstersimsen und Fenstergläsern
                </li>
                <li>Reinigung von Türen, Türgriffen, Einbauschränken, Leisten, Schaltern, Steckdosen, Radiatoren und Böden
                </li>
                <li>Reinigung von Waschmaschine und Tumbler, Sonnenstoren
                </li>
                <li>Terrassen, Sitzplätze und Balkone besenrein putzen
                </li>
                <li>Reinigung von Nebenräumen (Keller, Estrich, Briefkasten und Garage)
                </li>
                <li>Einfache Kaminreinigung (besenrein)
                </li>
            </ul>
            <p>Spezielle Dienstleistungen werden, falls nötig, separat verrechnet:
            </p>
            <ul>
                <li>Spezialreinigungen (z. Bsp. eingefressener Schmutz)
                </li>
                <li>Schimmel Entfernung
                </li>
                <li>schamponieren</li>
                <li>Dübellöcher (ohne Gewähr)
                </li>
                <li>Dampfreinigung</li>
                <li>Kleber, Kleberreste, Selbstklebefolien und selbstklebende Haken
                </li>
                <li>Hochdruckreinigung (bis zu 20m2 CHF 150.-)
                </li>
                <li>intensive Kaminreinigung, Kaminfegerarbeiten
                </li>
                <li>schwer erreichbare Flächen, welche mit spezieller Fördertechnik gereinigt werden müssen (z.Bsp Aussenfenster / Fassaden etc.)</li>
            </ul>
        </div>

        <div class="qr" >
            <div class="mb-1">Vor der Einzahlung abzutrennen</div>
            <div style="border-top-color:black;border-top-style:dotted;border-top-width:1px">
                <table >
                    <tr>
                        <td valign="top" style="border-right-color:black;border-right-style:dotted;border-right-width:1px; padding-right:50px; padding-left:30px;padding-top:10px;">
                            <span ><b style="font-size:14px!important;line-height:14px;">Empfangsschein</b></span><br>
    
                            <div style="padding-top: 10px;">
                                <span><b style="font-size:8px!important;line-height:8px;padding-top:10px;">Konto / Zahlbar an</b></span><br>
                                <span>CH53 3000 0001 1563 8103 1</span><br>
                                <span>{{ App\Models\Company::InfoCompany('name') }}</span><br>
                                <span>{{ App\Models\Company::InfoCompany('street') }}</span><br>
                                <span>{{ App\Models\Company::InfoCompany('post_code') }} {{ App\Models\Company::InfoCompany('city') }}</span><br>
                            </div>
    
                            <div style="padding-top:10px!important;">
                                <span ><b  style="font-size:8px!important;line-height:8px;">Referenz</b></span><br>
                                <span>00 00000 00000 04254 00230 00025</span><br>
                            </div>
    
                            <div style="padding-top:10px!important;">
                                <span><b class=" mb-3 pl-1" style="font-size:8px!important;line-height:8px;">Zahlbar durch</b></span><br>
                                <span>Riccardo Esposito</span><br>
                                <span>Seestrasse 37</span><br>
                                <span>8702 Zollikon</span><br>
                            </div>
    
                            <div style="padding-top:10px!important;padding-bottom:20px;">
                                <table>
                                    <tr>
                                        <td><b class=" mb-3 pl-1" style="font-size:8px!important;line-height:8px;">Währung</b></td>
                                        <td class="pl-3" style="padding-left:10px;"><b class="mb-3" style="font-size:8px!important;line-height:8px;">Betrag</b></td>
                                    </tr>
                                    <tr>
                                        <td>CHF</td>
                                        <td class="pl-3" style="padding-left:10px;">{{ $invoice['totalPrice'] }}</td>
                                    </tr>
                                </table>
                            </div>
                        </td>

                        <td valign="top" style=" padding-right:50px; padding-left:30px; padding-bottom:50px;padding-top:10px;">
                            <table>
                                <tr>
                                    <td>
                                        <span ><b style="font-size:14px!important;line-height:14px;">Zahlteil </b></span><br>
                                        <img style="padding-top:10px;" src="{{ asset('assets/demo/qr.png') }}" alt="" width="150"><br>
                                        
                                        <div style="padding-top:10px!important;padding-bottom:20px;">
                                            <table >
                                                <tr>
                                                    <td><b class=" mb-3 pl-1" style="font-size:12px!important;line-height:12px;">Währung</b></td>
                                                    <td class="pl-3" style="padding-left:10px;"><b class="mb-3" style="font-size:12px!important;line-height:12px;">Betrag</b></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:12px!important;line-height:12px;">CHF</td>
                                                    <td class="pl-3" style="padding-left:10px;font-size:12px!important;line-height:12px;">{{ $invoice['totalPrice'] }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                    <td valign="top" >
                                        <div style="font-size:12px;padding-left:20px;">
                                            <span><b style="font-size:10px!important;line-height:10px;padding-top:30px;">Konto / Zahlbar an</b></span><br>
                                            <span style="font-size:12px!important;line-height:10px;">CH53 3000 0001 1563 8103 1</span><br>
                                            <span style="font-size:12px!important;line-height:10px;">{{ App\Models\Company::InfoCompany('name') }}</span><br>
                                            <span style="font-size:12px!important;line-height:10px;">{{ App\Models\Company::InfoCompany('street') }}</span><br>
                                            <span style="font-size:12px!important;line-height:10px;">{{ App\Models\Company::InfoCompany('post_code') }} {{ App\Models\Company::InfoCompany('city') }}</span><br>
                                        </div>
                
                                        <div style="padding-top:10px!important;padding-left:20px;">
                                            <span ><b  style="font-size:10px!important;line-height:10px;">Referenz</b></span><br>
                                            <span style="font-size:12px!important;line-height:10px;">00 00000 00000 04254 00230 00025</span><br>
                                        </div>

                                        <div style="padding-top:10px!important;padding-left:20px;">
                                            <span ><b  style="font-size:10px!important;line-height:10px;">Zusätzliche Informationen</b></span><br>
                                            <span style="font-size:12px!important;line-height:10px;">//S1/10/RG2300002/11/230103/32/7.7</span><br>
                                        </div>
                
                                        <div style="padding-top:10px!important;padding-left:20px;">
                                            <span><b  style="font-size:10px!important;line-height:10px;">Zahlbar durch</b></span><br>
                                            <span style="font-size:12px!important;line-height:10px;">Riccardo Esposito</span><br>
                                            <span style="font-size:12px!important;line-height:10px;">Seestrasse 37</span><br>
                                            <span style="font-size:12px!important;line-height:10px;">8702 Zollikon</span><br>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </main>
    
</body>
</html>