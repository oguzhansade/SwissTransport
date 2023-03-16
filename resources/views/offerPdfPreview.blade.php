<!DOCTYPE html>
<html>
    <head>
        <title>Offerte</title>
        <meta charset="UTF-8">
        <style>
            * {
                font-family: DejaVu Sans !important;
                font-size: 10px;
                line-height: 9.5px;
                
            }
    
            @page {
                margin: 0;
            }
            body {
                margin:100px 25px;
            }
    
            header {
                position: fixed;
                margin-left:25px;
                margin-right: 25px;
                top: 20px;
                left: 0px;
                right: 0px;
                bottom: 20px;
                /** Extra personal styles **/
                text-align: center;
                padding: 0px;
                line-height: 12px;
                z-index: -5;
    
            }
    
            footer {
                margin-left:25px;
                margin-right: 25px;
                position: fixed;
                bottom: 0px;
                left: 0px;
                right: 0px;
                border-top: black 1px solid;
                padding-bottom: 5px;
                /** Extra personal styles **/
                text-align: center;
                z-index: -5;
            }
    
            .certificate {
                position: fixed;
                bottom: 30px;
                right: 25px;
                padding-bottom: 5px;
                /** Extra personal styles **/
                text-align: right;
            }
    
            .pagenum:before {
                content: counter(page);
            }
        </style>
    
        <style>
            @media print {
    
                /* avoid cutting tr's in half */
                th div,
                td div {
                    margin-top: -8px;
                    padding-top: 8px;
                    page-break-inside: avoid;
                }
            }
        </style>
        <style>
            .kapak {
                margin: -100px -25px;
                height: 100%;
                width: 100%;
                padding: 0;
                position: fixed;
                z-index: 5;
                background: url({{ asset('assets/img/offer-pdf-cover.png') }});
                background-position: top left;
                background-repeat: no-repeat;
                background-size: 100%;
                padding-top:130px;
                width: 100%;
                height: 100%;
            }
    
    
            .kapak-icerik {
                margin-top: 700px;
                margin-left: 18px;
                z-index: 6;
                position: relative;
            }
    
            .kapak-icerik-firma {
                margin-top: 0px;
                z-index: 6;
                position: relative;
            }
    
            .icerik-contactperson {
                z-index: 7;
                position: relative;
                top: 130px;
                left: 330px;
            }
        </style>
    
    </head>

<body>  
    <header >
        <table style="width: 100%;">
            <tr  style="padding-top:0px;width: 100%;" >
                <td>
                    <table style="width: 100%;">
                        <tr style="width: 100%;">
                            <td align="left">
                                Offertennr: 
                            </td>
                            <td  align="left">
                                1
                            </td>
                        </tr>
                        <tr  style="width: 100%;">
                            <td >Datum:</td>
                            <td >{{ date('d.m.Y', strtotime(Carbon\Carbon::now())); }}</td>
                        </tr>
                        <tr>
                            <td>Seiten</td>
                            <td><span class="pagenum"></span></td>
                        </tr>
                    </table>
                </td>
                <td align="right" >
                    <a href="https://www.swisstransport.ch/" target="_blank"><img style="padding:0px;" src="{{ asset('assets/demo/swiss-logo.png') }}" width="300" /></a>
                </td>
            </tr>
        </table>
    </header>
    <footer>
        <span style="font-size:9px;">Swiss Transport AG | Wehntalerstrasse 190 | CH-8105 Regensdorf | Telefon: 044 731 96 59 | info@swisstransport.ch | www.swisstransport.ch</span>
    </footer>

    

    <main>
        <div class="kapak" style="page-break-after: always;">
            <div class="kapak-icerik" >
                <div class="kapak-icerik-firma">
                    <strong style="font-size:14px;">{{ $company['name'] }}</strong><br><br>
                    <span style="font-size:12px;">{{ $company['street'] }}</span><br>
                    <span style="font-size:12px;">{{ $company['post_code'] }} {{ $company['city'] }}</span>
                </div>
                <div class="icerik-contactperson">
                    <strong style="font-size:14px;">IHR KUNDENBERATER</strong><br><br>
                    <span style="font-size:12px;">@if($offer['contactPerson'] == 'Bitte wählen') Swiss Transport Team @else {{ $offer['contactPerson'] }} @endif</strong><br>
                </div>
            </div>
        </div>
            <div class="teklif-boyutu" style="page-break-after: always;">
                <table border="0" style="width:100%;">
                    <tr style="width:100%;">
                        <td colspan="4" class="py-1 " style="background-color:#E5E5E5;">
                            <b style="font-size:13px;">Offerte 1 vom  für {{ $customer['gender'] === "male" ? "Herr" : "Frau" }} {{ $customer['name'] }} {{ $customer['surname'] }}</b>
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
                            @if( $customer['companyName'] ) {{ $customer['companyName'] }} <br> @endif
                            {{ $customer['name'] }} {{ $customer['surname'] }}<br>
                            {{ $customer['street'] }} <br>
                            CH-{{ $customer['postCode'] }} {{ $customer['Ort'] }} @if( $customer['country'] == 'Schweiz' ) @else {{ $customer['country'] }} @endif<br>
                        </td>
                    </tr>
            
                    @if($offer['contactPerson'])
                    <tr  style="width:100%;">
                        <td class="pt-3" >
                            <span style="color:#835AB1;font-size:9px;">Unsere Angaben:</span><br>
                            Ihr direkter Ansprechpartner:
                        </td>
                        <td class="pt-3">
                            {{-- Müşteri Bilgileri --}}
                            <br>
                            @if($offer['contactPerson'] == "Bitte wählen") Swiss Transport Team @else {{ $offer['contactPerson'] }} @endif<br>
                        </td>
                        <td class="pt-3" >
                            <span style="color:#835AB1;font-size:9px;">Ihre Angaben:</span><br>
                        </td>
                    </tr>
                    @endif
    
                    <tr  style="width:100%;">
                        <td class="pt-3" >
                            E-Mail:<br>
                            Hotline:
                        </td>
                        <td class="pt-3">
                            {{ App\Models\Company::InfoCompany('email') }} <br>
                            {{ App\Models\Company::InfoCompany('phone') }} 
                        </td>

                        <td class="pt-3" >
                            
                            Mobile Phone :<br>
                            E-Mail:
                        </td>
                        <td class="pt-3">
                            {{ $customer['mobile'] }} <br>
                            {{ $customer['email'] }}
                        </td>
                    </tr>

                    <tr  style="width:100%;">
                        <td colspan="4" style="padding-top:30px">
                            <img src="{{ asset('assets/img/prowen-expert.png') }}" width="750" alt="">
                        </td>
                    </tr>

                    <tr  style="width:100%;">
                        <td colspan="4" style="padding-top:30px">
                            <b>Sehr {{ $customer['gender'] === "male" ? "geehrter Herr" : "geehrte Frau" }} {{ $customer['surname'] }} <br><br>
                                Entsprechend unserer Vereinbarung erlauben wir uns, Ihnen die folgenden Leistungen wie folgt zu berechnen:</b>
                        </td>
                    </tr>
            
                    <tr style="width:100%;">
                        <td colspan="4" style="padding-top:10px;"></td>
                    </tr>
            
                    {{-- Umzug Alanı --}}
                    @if ($isUmzug)
    
                        {{-- Aus ve Einler --}}
                        <tr style="width:100%;">
                            <td colspan="2" class="p-1 " style="background-color:#E5E5E5; border-right:5px solid white;">
                                <b style="font-size:13px;line-height:13px;">Auszug</b>
                            </td>
                            @if ($isEinzug1)
                            <td colspan="2" class="p-1 " style="background-color:#E5E5E5;">
                                <b style="font-size:13px;line-height:13px;">Einzug</b>
                            </td>
                            @endif
                        </tr>
                        
                        <tr>
                            @if ($auszug1)
                                <td>
                                    Strasse: <br>
                                    PLZ / Ort: <br>
                                    Gebäude: <br>
                                    Etage: <br>
                                    Lift:
                                </td>
                                <td align="left" >
                                    @if ($auszug1['street']) {{ $auszug1['street'] }} @endif <br>
                                    @if ($auszug1['postCode']) CH - {{ $auszug1['postCode'] }} @endif @if ($auszug1['city']) {{ $auszug1['city'] }} @endif <br>
                                    @if ($auszug1['buildType']){{ $auszug1['buildType'] }}@endif<br>
                                    @if($auszug1['floor']) {{ $auszug1['floor'] }} @endif<br>
                                    @if($auszug1['lift'] == 1) Ja @else Nein @endif
                                </td>
                            @endif
    
                            @if($isEinzug1)
                                <td>
                                    Strasse: <br>
                                    PLZ / Ort: <br>
                                    Gebäude: <br>
                                    Etage: <br>
                                    Lift:
                                </td>
                                <td align="left" >
                                    @if($einzug1['street']){{ $einzug1['street'] }} @endif <br>
                                    CH - {{ $einzug1['postCode'] }} {{ $einzug1['city'] }} <br>
                                    {{ $einzug1['buildType'] }}<br>
                                    {{ $einzug1['floor'] }}<br>
                                    @if($einzug1['lift'] == 1) Ja @else Nein @endif
                                </td>
                            @endif
                            
                        </tr>
    
                        {{-- Boşluk Bırakma --}}
                        <tr style="width:100%;">
                            <td colspan="4" style="padding-top:5px;"></td>
                        </tr>
            
                        {{-- 2.Adresler --}}
                        <tr style="width:100%;">
                            @if($isAuszug2) 
                                <td colspan="2" class="p-1 " style="background-color:#E5E5E5; border-right:5px solid white;">
                                    <b style="font-size:13px;line-height:13px;">Auszug 2</b>
                                </td>
                            @endif
                            @if($isEinzug2)
                                <td colspan="2" class="p-1 " style="background-color:#E5E5E5;">
                                    <b style="font-size:13px;line-height:13px;">Einzug 2</b>
                                </td>
                            @endif
                        </tr>
                        
                        <tr>
                            @if($isAuszug2)
                                <td>
                                    Strasse: <br>
                                    PLZ / Ort: <br>
                                    Gebäude: <br>
                                    Etage: <br>
                                    Lift:
                                </td>
                                <td align="left" >
                                    {{ $auszug2['street'] }} <br>
                                    CH - {{ $auszug2['postCode'] }} {{ $auszug2['city'] }} <br>
                                    {{ $auszug2['buildType'] }}<br>
                                    {{ $auszug2['floor'] }}<br>
                                    @if($auszug2['lift'] == 1) Ja @else Nein @endif
                                </td>
                            @endif
                            
                            @if($isEinzug2)
                                <td>
                                    Strasse: <br>
                                    PLZ / Ort: <br>
                                    Gebäude: <br>
                                    Etage: <br>
                                    Lift:
                                </td>
                                <td align="left" >
                                    {{ $einzug2['street'] }} <br>
                                    CH - {{ $einzug2['postCode'] }} {{ $einzug2['city'] }} <br>
                                    {{ $einzug2['buildType'] }}<br>
                                    {{ $einzug2['floor'] }}<br>
                                    @if($einzug2['lift'] == 1) Ja @else Nein @endif
                                </td>
                            @endif
                        </tr>
            
                        {{-- Boşluk Bırakma --}}
                        <tr style="width:100%;">
                            <td colspan="4" style="padding-top:5px;"></td>
                        </tr>
    
                        {{-- 3.Adresler --}}
                        <tr style="width:100%;">
                            @if($isAuszug3) 
                                <td colspan="2" class="p-1 " style="background-color:#E5E5E5; border-right:5px solid white;">
                                    <b style="font-size:13px;line-height:13px;">Auszug 3</b>
                                </td>
                            @endif
                            @if($isEinzug3)
                                <td colspan="2" class="p-1 " style="background-color:#E5E5E5;">
                                    <b style="font-size:13px;line-height:13px;">Einzug 3</b>
                                </td>
                            @endif
                        </tr>
                        
                        <tr>
                            @if($isAuszug3)
                                <td>
                                    Strasse: <br>
                                    PLZ / Ort: <br>
                                    Gebäude: <br>
                                    Etage: <br>
                                    Lift:
                                </td>
                                <td align="left" >
                                    {{ $auszug3['street'] }} <br>
                                    CH - {{ $auszug3['postCode'] }} {{ $auszug3['city'] }} <br>
                                    {{ $auszug3['buildType'] }}<br>
                                    {{ $auszug3['floor'] }}<br>
                                    @if($auszug3['lift'] == 1) Ja @else Nein @endif
                                </td>
                            @endif
                            
                            @if($isEinzug3)
                                <td>
                                    Strasse: <br>
                                    PLZ / Ort: <br>
                                    Gebäude: <br>
                                    Etage: <br>
                                    Lift:
                                </td>
                                <td align="left" >
                                    {{ $einzug3['street'] }} <br>
                                    CH - {{ $einzug3['postCode'] }} {{ $einzug3['city'] }} <br>
                                    {{ $einzug3['buildType'] }}<br>
                                    {{ $einzug3['floor'] }}<br>
                                    @if($einzug3['lift'] == 1) Ja @else Nein @endif
                                </td>
                            @endif
                        </tr>
    
                        {{-- Boşluk Bırakma --}}
                        <tr style="width:100%;">
                            <td colspan="4" style="padding-top:15px;"></td>
                        </tr>
            
                        <tr style="width:100%;">
                            <td colspan="4" class="p-1 " style="background-color:#E5E5E5;">
                                <b style="font-size:13px;line-height:13px;">Umzug</b>
                            </td>
                        </tr>
    
                        <tr style="width:100%;">
                            <td colspan="2" style="padding-top:5px;"><b style="">Tarif:</b></td>
                            <td colspan="2" style="padding-top:5px;">{{ $umzug['ma'] }} Umzugsmitarbeiter mit {{ $umzug['lkw'] }} Lieferwagen @if($umzug['anhanger']) und {{ $umzug['anhanger'] }} Anhänger  @endif  à CHF {{ $umzug['chf'] }}.-/Stunde </td>
                        </tr>
            
                        {{-- Boşluk Bırakma --}}
                        <tr style="width:100%;">
                            <td colspan="4" style="padding-top:5px;"></td>
                        </tr>
            
                        {{-- Umzug Servis Alanı PDF --}}
                        <tr  style="width:100%;">
                            <td valign="top" >
                                Umzugstermin:<br>
                                Arbeitsbeginn:<br>
                                Einzugstermin:<br>
                                Anfahrt/Rückfahrt:<br>
                                De- und Montage:
                            </td>
                
                            <td valign="top" style="padding-left:10px;">
                                @if($umzug['moveDate']){{ date("d/m/Y", strtotime($umzug['moveDate'])); }} @else - @endif<br>
                                @if($umzug['moveTime']){{ $umzug['moveTime'] }} @else - @endif<br>
                                @if($umzug['moveDate2']){{ date("d/m/Y", strtotime($umzug['moveDate2'])); }} @else - @endif<br>
                                {{ $umzug['arrivalReturn'] }} CHF<br>
                                    @if ($umzug['montage'] == 2) Kunde @elseif($umzug['montage'] == 3) Swiss Transport @else - @endif
                            </td>
                            <td  valign="top" colspan="2">
                                <table  border="0">
                                    <tr style="width:100%;">
                                        <td valign="top">Geschätzter Aufwand: </td>
                                        <td >{{ $umzug['moveHours'] }} Stunden</td>
                                    </tr>
                                    
                                    <tr>
                                        <td valign="top">Zusatzkosten: <br></td>
                                        <td >
                                            @if ( $umzug['extra'] )
                                                <tr>
                                                    <td style="padding-left:15px;">Spesen</td>
                                                    <td>{{ $umzug['extra'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $umzug['extra1'] )
                                                <tr>
                                                    <td style="padding-left:15px;">Klavier</td>
                                                    <td>{{ $umzug['extra1'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $umzug['extra2'] )
                                                <tr>
                                                    <td style="padding-left:15px;">Klavier </td>
                                                    <td>{{ $umzug['extra2'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $umzug['extra3'] )
                                                <tr>
                                                    <td style="padding-left:15px;">Möbellift </td>
                                                    <td>{{ $umzug['extra3'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $umzug['extra4'] )
                                                <tr>
                                                    <td style="padding-left:15px;">Möbellift </td>
                                                    <td>{{ $umzug['extra4'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $umzug['extra5'] )
                                                <tr>
                                                    <td style="padding-left:15px;">Möbellift </td>
                                                    <td>{{ $umzug['extra5'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $umzug['extra6'] )
                                                <tr>
                                                    <td style="padding-left:15px;">Schwergutzuschlag</td>
                                                    <td>{{ $umzug['extra6'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $umzug['extra7'] )
                                                <tr>
                                                    <td style="padding-left:15px;">Schwergutzuschlag</td>
                                                    <td>{{ $umzug['extra7'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $umzug['extra8'] )
                                                <tr>
                                                    <td style="padding-left:15px;">Tresor</td>
                                                    <td>{{ $umzug['extra8'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $umzug['extra9'] )
                                                <tr>
                                                    <td style="padding-left:15px;">Tresor</td>
                                                    <td>{{ $umzug['extra9'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $umzug['extra10'] )
                                                <tr>
                                                    <td style="padding-left:15px;">Wasserbett</td>
                                                    <td>{{ $umzug['extra10'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $umzug['customCostPrice1'] )
                                                <tr>
                                                    <td style="padding-left:15px;">
                                                        @if ( $umzug['customCostName1'] ) {{ $umzug['customCostName1'] }} @else Freier Text 1 @endif
                                                    </td>
                                                    <td>{{ $umzug['customCostPrice1'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $umzug['customCostPrice2'] )
                                                <tr>
                                                    <td style="padding-left:15px;">
                                                        @if ( $umzug['customCostName2'] ) {{ $umzug['customCostName2'] }} @else Freier Text 2 @endif
                                                    </td>
                                                    <td>{{ $umzug['customCostPrice2'] }} CHF</td>
                                                </tr>
                                            @endif
                                        </td>
                                    </tr>
            
                                    @if($umzug['discount'] !=0)
                                    <tr>
                                        <td align="left" valign="top">Rabatt:</td>
                                        <td><span >-{{ $umzug['discount'] }} CHF</span></td>
                                    </tr>
                                    @endif

                                    @if($umzug['discountPercent'] !=0)
                                    <tr>
                                        <td align="left" valign="top">Rabatt[%]:</td>
                                        <td><span >- %{{ $umzug['discountPercent'] }}</span></td>
                                    </tr>
                                    @endif
            
                                    @if($umzug['compromiser'] !=0)
                                    <tr>
                                        <td align="left" valign="top">Entgegenkommen:</td>
                                        <td><span >-{{ $umzug['compromiser'] }} CHF</span></td>
                                    </tr>
                                    @endif
            
                                    @if ($umzug['extraCostPrice'] !=0)
                                        <tr>
                                            <td align="left" valign="top">@if ($umzug['extraCostName']) {{ $umzug['extraCostName'] }}: @else Custom Entgegenkommen: @endif</td>
                                            <td><span >-{{ $umzug['extraCostPrice'] }} CHF</span></td>
                                        </tr>
                                    @endif
                                    
                                    <tr>
                                        <td align="left" valign="top">Geschätzte Kosten:</td>
                                        <td><span style="color:#835AB1;"><b>{{ $umzug['defaultPrice'] }} CHF</b></span></td>
                                    </tr>
                                    
                                    @if($umzug['topCost'] != NULL)
                                    <tr>
                                        <td align="left" valign="top">Kostendach:</td>
                                        <td><span style="color:#835AB1;"><b>{{ $umzug['topCost'] }} CHF</b></span></td>
                                    </tr>
                                    @endif

                                    @if($offer['kostenExkl'])
                                        <tr>
                                            <td colspan="2">
                                                <span style="font-size:8px;">Unsere Preise verstehen sich exkl. 7.7%MwSt.</span>
                                            </td>
                                        </tr>
                                    @endif
    
                                    @if($offer['kostenInkl'])
                                        <tr>
                                            <td colspan="2">
                                                <span style="font-size:8px;">Unsere Preise verstehen sich inkl. 7.7%MwSt.</span>
                                            </td>
                                        </tr>
                                    @endif
    
                                    @if($offer['kostenFrei'])
                                        <tr>
                                            <td colspan="2">
                                                <span style="font-size:8px;">Unsere Preise verstehen sich frei. 7.7%MwSt.</span>
                                            </td>
                                        </tr>
                                    @endif
    
                                </table>
                            </td>
                        </tr>
                    @endif
                   {{-- Umzug Alanı --}}
            
                   
                    
                </table>
                {{-- Einpack Alanı --}}
                @if ($isEinpack)
                <table border="0" style="width: 100%;margin-top:20px;">
                        <tr style="width:100%;">
                            <td colspan="4" class="p-1 " style="background-color:#E5E5E5;">
                                <b style="font-size:13px;line-height:13px;">Einpackservice</b>
                            </td>
                        </tr>
            
                        <tr style="width:100%;">
                            <td colspan="2" style="padding-top:5px;"><b style="">Tarif:</b></td>
                            <td colspan="2" style="padding-top:5px;">{{ $einpack['ma'] }} Packmitarbeiter à CHF {{ $einpack['chf'] }}.-/Stunde </td>
                        </tr>
            
                        {{-- Boşluk Bırakma --}}
                        <tr style="width:100%;">
                            <td colspan="4" style="padding-top:5px;"></td>
                        </tr>
            
                        <tr  style="width:100%;">
                            <td valign="top" >
                                Packtermin:<br>
                                Arbeitsbeginn<br>
                                Anfahrt/Rückfahrt<br>
                            </td>
            
                            <td valign="top" style="padding-left:10px;">
                                @if($einpack['einpackDate']){{ date("d/m/Y", strtotime($einpack['einpackDate'])); }} @else - @endif<br>
                                @if($einpack['einpackTime']){{ $einpack['einpackTime'] }} @else - @endif<br>
                                {{ $einpack['arrivalReturn'] }} CHF<br>
                            </td>
                            
                            <td  valign="top" colspan="2">
                                <table  border="0">
                                    <tr style="width:100%;">
                                        <td valign="top">Geschätzter Aufwand: </td>
                                        <td >{{ $einpack['moveHours'] }} Stunde</td>
                                    </tr>
    
                                    <tr>
                                        <td valign="top">Zusatzkosten: <br></td>
                                        <td>
                                            @if ( $einpack['extra'] )
                                                <tr>
                                                    <td style="padding-left:15px;">Spesen</td>
                                                    <td>{{ $einpack['extra'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $einpack['extra1'] )
                                                <tr>
                                                    <td style="padding-left:15px;">Verpackungsmaterial</td>
                                                    <td>{{ $einpack['extra1'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $einpack['customCostPrice1'] )
                                                <tr>
                                                    <td style="padding-left:15px;">@if ( $einpack['customCostName1'] ) {{ $einpack['customCostName1'] }} @else Freier Text 1 @endif</td>
                                                    <td>{{ $einpack['customCostPrice1'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $einpack['customCostPrice2'] )
                                                <tr>
                                                    <td style="padding-left:15px;">@if ( $einpack['customCostName2'] ) {{ $einpack['customCostName2'] }} @else Freier Text 1 @endif</td>
                                                    <td>{{ $einpack['customCostPrice2'] }} CHF</td>
                                                </tr>
                                            @endif
                                        </td>
                                    </tr>
            
                                    @if($einpack['discount'] !=0)
                                    <tr>
                                        <td align="left" valign="top">Rabatt:</td>
                                        <td><span >-{{ $einpack['discount'] }} CHF</span></td>
                                    </tr>
                                    @endif

                                    @if($einpack['discountPercent'] !=0)
                                    <tr>
                                        <td align="left" valign="top">Rabatt[%]: </td>
                                        <td><span >- %{{ $einpack['discountPercent'] }}</span></td>
                                    </tr>
                                    @endif
            
                                    @if($einpack['compromiser'] !=0)
                                    <tr>
                                        <td align="left" valign="top">Entgegenkommen:</td>
                                        <td><span >-{{ $einpack['compromiser'] }} CHF</span></td>
                                    </tr>
                                    @endif
            
                                    @if ($einpack['extraCostPrice'] !=0)
                                        <tr>
                                            <td align="left" valign="top">@if ($einpack['extraCostName']) {{ $einpack['extraCostName'] }}: @else Custom Entgegenkommen: @endif</td>
                                            <td><span >-{{ $einpack['extraCostPrice'] }} CHF</span></td>
                                        </tr>
                                    @endif
                                    
                                    <tr>
                                        <td align="left" valign="top">Geschätzte Kosten:</td>
                                        <td><span style="color:#835AB1;"><b>{{ $einpack['defaultPrice'] }} CHF</b></span></td>
                                    </tr>
                                    
                                    @if($einpack['topCost'] != NULL)
                                    <tr>
                                        <td align="left" valign="top">Kostendach:</td>
                                        <td><span style="color:#835AB1;"><b>{{ $einpack['topCost'] }} CHF</b></span></td>
                                    </tr>
                                    @endif

                                    @if($offer['kostenExkl'])
                                        <tr>
                                            <td colspan="2">
                                                <span style="font-size:8px;">Unsere Preise verstehen sich exkl. 7.7%MwSt.</span>
                                            </td>
                                        </tr>
                                    @endif
    
                                    @if($offer['kostenInkl'])
                                        <tr>
                                            <td colspan="2">
                                                <span style="font-size:8px;">Unsere Preise verstehen sich inkl. 7.7%MwSt.</span>
                                            </td>
                                        </tr>
                                    @endif
    
                                    @if($offer['kostenFrei'])
                                        <tr>
                                            <td colspan="2">
                                                <span style="font-size:8px;">Unsere Preise verstehen sich frei. 7.7%MwSt.</span>
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                            </td>
                        </tr>
                </table>
                @endif
                {{-- Auspack Alanı --}}
                @if ($isAuspack)
                <table border="0" style="width: 100%;margin-top:20px;" >
                        <tr style="width:100%;">
                            <td colspan="4" class="p-1 " style="background-color:#E5E5E5;">
                                <b style="font-size:13px;line-height:13px;">Auspackservice</b>
                            </td>
                        </tr>
             
                        <tr style="width:100%;">
                            <td colspan="2" style="padding-top:5px;"><b style="">Tarif:</b></td>
                            <td colspan="2" style="padding-top:5px;">{{ $auspack['ma'] }} Packmitarbeiter à CHF {{ $auspack ['chf'] }}.-/Stunde </td>
                        </tr>
            
                        {{-- Boşluk Bırakma --}}
                        <tr style="width:100%;">
                            <td colspan="4" style="padding-top:5px;"></td>
                        </tr>
            
                        <tr style="width:100%;">
                            <td valign="top" >
                                Packtermin:<br>
                                Arbeitsbeginn<br>
                                Anfahrt/Rückfahrt<br>
                            </td>
            
                            <td valign="top" style="padding-left:10px;">
                                @if($auspack['auspackDate']){{ date("d/m/Y", strtotime($auspack['auspackDate'])); }} @else - @endif<br>
                                @if($auspack['auspackTime']){{ $auspack['auspackTime'] }} @else - @endif<br>
                                {{ $auspack['arrivalReturn'] }} CHF<br>
                            </td>
                            <td valign="top" colspan="3">
                                <table  border="0">
                                    <tr style="width:100%;">
                                        <td valign="top">Geschätzter Aufwand: </td>
                                        <td >{{ $auspack['moveHours'] }} Stunde</td>
                                    </tr>
                                    <tr>
                                        <td valign="top">Zusatzkosten: <br></td>
                                        <td>
                                            @if ( $auspack['extra'] )
                                                <tr>
                                                    <td style="padding-left:15px;">Spesen</td>
                                                    <td>{{ $auspack['extra'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $auspack['extra1'] )
                                                <tr>
                                                    <td style="padding-left:15px;">Verpackungsmaterial</td>
                                                    <td>{{ $auspack['extra1'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $auspack['customCostPrice1'] )
                                                <tr>
                                                    <td style="padding-left:15px;">@if ( $auspack['customCostName1'] ) {{ $auspack['customCostName1'] }} @else Freier Text 1 @endif</td>
                                                    <td>{{ $auspack['customCostPrice1'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $auspack['customCostPrice2'] )
                                                <tr>
                                                    <td style="padding-left:15px;">@if ( $auspack['customCostName2'] ) {{ $auspack['customCostName2'] }} @else Freier Text 2 @endif</td>
                                                    <td>{{ $auspack['customCostPrice2'] }} CHF</td>
                                                </tr>
                                            @endif
                                        </td>
                                    </tr>
            
                                    @if($auspack['discount'] !=0)
                                    <tr>
                                        <td align="left" valign="top">Rabatt:</td>
                                        <td><span >-{{ $auspack['discount'] }} CHF</span></td>
                                    </tr>
                                    @endif
            
                                    @if($auspack['discountPercent'] !=0)
                                    <tr>
                                        <td align="left" valign="top">Rabatt[%]:</td>
                                        <td><span >- %{{ $auspack['discountPercent'] }}</span></td>
                                    </tr>
                                    @endif

                                    @if($auspack['compromiser'] !=0)
                                    <tr>
                                        <td align="left" valign="top">Entgegenkommen:</td>
                                        <td><span >-{{ $auspack['compromiser'] }} CHF</span></td>
                                    </tr>
                                    @endif
            
                                    @if ($auspack['extraCostPrice'] !=0)
                                        <tr>
                                            <td align="left" valign="top">@if ($auspack['extraCostName']) {{ $auspack['extraCostName'] }}: @else Custom Entgegenkommen: @endif</td>
                                            <td><span >-{{ $auspack['extraCostPrice'] }} CHF</span></td>
                                        </tr>
                                    @endif
                                    
                                    <tr>
                                        <td align="left" valign="top">Geschätzte Kosten:</td>
                                        <td><span style="color:#835AB1;"><b>{{ $auspack['defaultPrice'] }} CHF</b></span></td>
                                    </tr>
                                    
                                    @if($auspack['topCost'] != NULL)
                                    <tr>
                                        <td align="left" valign="top">Kostendach:</td>
                                        <td><span style="color:#835AB1;"><b>{{ $auspack['topCost'] }} CHF</b></span></td>
                                    </tr>
                                    @endif

                                    @if($offer['kostenExkl'])
                                        <tr>
                                            <td colspan="2">
                                                <span style="font-size:8px;">Unsere Preise verstehen sich exkl. 7.7%MwSt.</span>
                                            </td>
                                        </tr>
                                    @endif
    
                                    @if($offer['kostenInkl'])
                                        <tr>
                                            <td colspan="2">
                                                <span style="font-size:8px;">Unsere Preise verstehen sich inkl. 7.7%MwSt.</span>
                                            </td>
                                        </tr>
                                    @endif
    
                                    @if($offer['kostenFrei'])
                                        <tr>
                                            <td colspan="2">
                                                <span style="font-size:8px;">Unsere Preise verstehen sich frei. 7.7%MwSt.</span>
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                            </td>
                        </tr>
                    </table>
                @endif
            
                {{-- Reinigung Alanı --}}
                @if ($isReinigung)
                <table border="0" style="width: 100%;margin-top:20px;">
                        <tr style="width:100%;">
                            <td colspan="4" class="p-1 " style="background-color:#E5E5E5;">
                                <b style="font-size:13px;line-height:13px;">Reinigung</b>
                            </td>
                        </tr>
             
                        {{-- Boşluk Bırakma --}}
                        <tr style="width:100%;">
                            <td colspan="4" style="padding-top:5px;"></td>
                        </tr>
            
                        <tr style="width: 100%">
                        <td colspan="2" ><b>Reinigungsart:</b></td>
                        <td colspan="2"  >{{ $reinigung['reinigungType'] }}</td>
                        </tr>
                        <tr style="width:100%;">
                            <td colspan="2"><b style="">@if ($reinigung['fixedTariff'])Zimmer: @else Tarif: @endif</b></td>
                            <td colspan="2" > @if ($reinigung['fixedTariff'])
                            {{ Str::substr(\App\Models\Tariff::infoTariff($reinigung['fixedTariff'],'description'), 0, 12); }} à CHF {{ $reinigung['fixedTariffPrice'] }}  
                            @else 
                            {{ $reinigung['ma'] }} Mitarbeiter à CHF {{ $reinigung['chf'] }}.- / Stunde
                            @endif</td>
                        </tr>
        
                        @if ($reinigung['extraReinigung'])
                        <tr style="width: 100%;">
                            <td colspan="2"><b>Leistungen:</b></td>
                            <td colspan="2">{{ $reinigung['extraReinigung'] }}</td>
                        </tr>
                        @endif
                        
            
                        {{-- Boşluk Bırakma --}}
                        <tr style="width:100%;">
                            <td colspan="4" style="padding-top:5px;"></td>
                        </tr>
            
                        <tr  style="width:100%;">
                            <td valign="top" >
                            Reinigungstermin:<br>
                            Arbeitsbeginn:<br>
                            Abgabetermin:<br>
                            Abgabezeit:<br>
                            Dübellöcher zuspachteln:<br>
                            Mit Hochdruckreiniger:
                            </td>
            
                            <td valign="top" style="padding-left:10px;">
                                @if($reinigung['startDate']){{ date("d/m/Y", strtotime($reinigung['startDate'])); }} @else - @endif<br>
                                @if($reinigung['startTime']){{ $reinigung['startTime'] }} @else - @endif<br>
                                @if($reinigung['endDate']){{ date("d/m/Y", strtotime($reinigung['endDate'])); }} @else - @endif<br>
                                @if($reinigung['endTime']){{ $reinigung['endTime'] }} @else - @endif<br>
                            @if ($reinigung['extraService1'] == 1) Ja @else Nein  @endif<br>
                            @if ($reinigung['extraService2'] == 1) Ja @else Nein  @endif<br>
                            </td>
                            <td valign="top" colspan="2">
                                <table  border="0">
                                    <tr>
                                        <td valign="top">Zusatzkosten: <br></td>
                                        <td>
                                            @if($reinigung['extra1'])
                                                <tr>
                                                    <td style="padding-left:15px;">Hochdruckreiniger</td>
                                                    <td>{{ $reinigung['extra1'] }} CHF</td>
                                                </tr>
                                            @endif
    
                                            @if($reinigung['extra2'])
                                                <tr>
                                                    <td style="padding-left:15px;">Stein- und Parkettböden</td>
                                                    <td>{{ $reinigung['extra2'] }} CHF</td>
                                                </tr>
                                            @endif
    
                                            @if($reinigung['extra3'])
                                                <tr>
                                                    <td style="padding-left:15px;">Teppichschamponieren</td>
                                                    <td>{{ $reinigung['extra3'] }} CHF</td>
                                                </tr>
                                            @endif
    
                                            @if($reinigung['extraCostValue1'])
                                                <tr>
                                                    <td style="padding-left:15px;">@if ( $reinigung['extraCostText1'] ) {{ $reinigung['extraCostText1'] }} @else Zusatzkosten @endif</td>
                                                    <td>{{ $reinigung['extraCostValue1'] }} CHF</td>
                                                </tr>
                                            @endif
    
                                            @if($reinigung['extraCostValue2'])
                                                <tr>
                                                    <td style="padding-left:15px;">@if ( $reinigung['extraCostText2'] ) {{ $reinigung['extraCostText2'] }} @else Zusatzkosten @endif</td>
                                                    <td>{{ $reinigung['extraCostValue2'] }} CHF</td>
                                                </tr>
                                            @endif
                                        </td>
                                    </tr>
            
                                    @if($reinigung['discount'] !=0)
                                    <tr>
                                        <td align="left" valign="top">@if( $reinigung['discountText'] ) {{ $reinigung['discountText'] }}: @else Rabatt: @endif</td>
                                        <td><span >-{{ $reinigung['discount'] }} CHF</span></td>
                                    </tr>
                                    @endif
            
                                    @if($reinigung['discountPercent'] !=0)
                                    <tr>
                                        <td align="left" valign="top"> Rabatt[%]: </td>
                                        <td><span >- %{{ $reinigung['discountPercent'] }}</span></td>
                                    </tr>
                                    @endif

                                    <tr>
                                        <td align="left" valign="top">@if($reinigung['fixedTariff'])Pauschal:  @else Geschätzte Kosten:  @endif</td>
                                        <td><span style="color:#835AB1;"><b>{{ $reinigung['totalPrice'] }} CHF</b></span></td>
                                    </tr>
        
                                    @if($offer['kostenExkl'])
                                        <tr>
                                            <td colspan="2">
                                                <span style="font-size:8px;">Unsere Preise verstehen sich exkl. 7.7%MwSt.</span>
                                            </td>
                                        </tr>
                                    @endif
    
                                    @if($offer['kostenInkl'])
                                        <tr>
                                            <td colspan="2">
                                                <span style="font-size:8px;">Unsere Preise verstehen sich inkl. 7.7%MwSt.</span>
                                            </td>
                                        </tr>
                                    @endif
    
                                    @if($offer['kostenFrei'])
                                        <tr>
                                            <td colspan="2">
                                                <span style="font-size:8px;">Unsere Preise verstehen sich frei. 7.7%MwSt.</span>
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                            </td>
                        </tr>
                    </table>
                @endif
    
                {{-- Reinigung 2 Alanı --}}
                @if ($isReinigung2)
                <table border="0" style="width: 100%;margin-top:20px;">
                        <tr style="width:100%;">
                            <td colspan="4" class="p-1 " style="background-color:#E5E5E5;">
                                <b style="font-size:13px;line-height:13px;">Reinigung 2</b>
                            </td>
                        </tr>
             
                        {{-- Boşluk Bırakma --}}
                        <tr style="width:100%;">
                            <td colspan="4" style="padding-top:5px;"></td>
                        </tr>
            
                        <tr style="width: 100%">
                        <td colspan="2" ><b>Reinigungsart:</b></td>
                        <td colspan="2" >{{ $reinigung2['reinigungType'] }}</td>
                        </tr>
                        <tr style="width:100%;">
                            <td colspan="2"><b style="">@if ($reinigung2['fixedTariff'])Zimmer: @else Tarif: @endif</b></td>
                            <td colspan="2"> @if ($reinigung2['fixedTariff'])
                                {{ Str::substr(\App\Models\Tariff::infoTariff($reinigung2['fixedTariff'],'description'), 0, 12); }} à CHF {{ $reinigung2['fixedTariffPrice'] }}  
                                @else 
                                {{ $reinigung2['ma'] }} Mitarbeiter à CHF {{ $reinigung2['chf'] }}.- / Stunde
                                @endif</td>
                        </tr>
        
                        @if ($reinigung2['extraReinigung'])
                        <tr style="width: 100%;">
                            <td colspan="2"><b>Leistungen:</b></td>
                            <td colspan="2">{{ $reinigung2['extraReinigung'] }}</td>
                        </tr>
                        @endif
                        
            
                        {{-- Boşluk Bırakma --}}
                        <tr style="width:100%;">
                            <td colspan="4" style="padding-top:5px;"></td>
                        </tr>
            
                        <tr  style="width:100%;">
                            <td valign="top" >
                            Reinigungstermin:<br>
                            Arbeitsbeginn:<br>
                            Abgabetermin:<br>
                            Abgabezeit:<br>
                            Dübellöcher zuspachteln:<br>
                            Mit Hochdruckreiniger:
                            </td>
            
                            <td valign="top" style="padding-left:10px;">
                                @if($reinigung2['startDate']){{ date("d/m/Y", strtotime($reinigung2['startDate'])); }} @else - @endif<br>
                                @if($reinigung2['startTime']){{ $reinigung2['startTime'] }} @else - @endif<br>
                                @if($reinigung2['endDate']){{ date("d/m/Y", strtotime($reinigung2['endDate'])); }} @else - @endif<br>
                                @if($reinigung2['endTime']){{ $reinigung2['endTime'] }} @else - @endif<br>
                            @if ($reinigung2['extraService1'] == 1) Ja @else Nein  @endif<br>
                            @if ($reinigung2['extraService2'] == 1) Ja @else Nein  @endif<br>
                            </td>
                            <td valign="top" colspan="2">
                                <table  border="0">
                                    <tr>
                                        <td valign="top">Zusatzkosten: <br></td>
                                        <td>
                                            @if($reinigung2['extra1'])
                                                <tr>
                                                    <td style="padding-left:15px;">Hochdruckreiniger</td>
                                                    <td>{{ $reinigung2['extra1'] }} CHF</td>
                                                </tr>
                                            @endif
    
                                            @if($reinigung2['extra2'])
                                                <tr>
                                                    <td style="padding-left:15px;">Stein- und Parkettböden</td>
                                                    <td>{{ $reinigung2['extra2'] }} CHF</td>
                                                </tr>
                                            @endif
    
                                            @if($reinigung2['extra3'])
                                                <tr>
                                                    <td style="padding-left:15px;">Teppichschamponieren</td>
                                                    <td>{{ $reinigung2['extra3'] }} CHF</td>
                                                </tr>
                                            @endif
    
                                            @if($reinigung2['extraCostValue1'])
                                                <tr>
                                                    <td style="padding-left:15px;">@if ( $reinigung2['extraCostText1'] ) {{ $reinigung2['extraCostText1'] }} @else Freier Text 1 @endif</td>
                                                    <td>{{ $reinigung2['extraCostValue1'] }} CHF</td>
                                                </tr>
                                            @endif
    
                                            @if($reinigung2['extraCostValue2'])
                                                <tr>
                                                    <td style="padding-left:15px;">@if ( $reinigung2['extraCostText2'] ) {{ $reinigung2['extraCostText2'] }} @else Freier Text 2 @endif</td>
                                                    <td>{{ $reinigung2['extraCostValue2'] }} CHF</td>
                                                </tr>
                                            @endif
                                        </td>
                                    </tr>
            
                                    @if($reinigung2['discount'] !=0)
                                    <tr>
                                        <td align="left" valign="top">@if( $reinigung2['discountText'] ) {{ $reinigung2['discountText'] }}: @else Rabatt: @endif</td>
                                        <td><span >-{{ $reinigung2['discount'] }} CHF</span></td>
                                    </tr>
                                    @endif
            
                                    @if($reinigung2['discountPercent'] !=0)
                                    <tr>
                                        <td align="left" valign="top">Rabatt[%]: </td>
                                        <td><span >- %{{ $reinigung2['discountPercent'] }}</span></td>
                                    </tr>
                                    @endif

                                    <tr>
                                        <td align="left" valign="top">@if($reinigung2['fixedTariff'])Pauschal:  @else Geschätzte Kosten:  @endif</td>
                                        <td><span style="color:#835AB1;"><b>{{ $reinigung2['totalPrice'] }} CHF</b></span></td>
                                    </tr>
        
                                    @if($offer['kostenExkl'])
                                        <tr>
                                            <td colspan="2">
                                                <span style="font-size:8px;">Unsere Preise verstehen sich exkl. 7.7%MwSt.</span>
                                            </td>
                                        </tr>
                                    @endif
    
                                    @if($offer['kostenInkl'])
                                        <tr>
                                            <td colspan="2">
                                                <span style="font-size:8px;">Unsere Preise verstehen sich inkl. 7.7%MwSt.</span>
                                            </td>
                                        </tr>
                                    @endif
    
                                    @if($offer['kostenFrei'])
                                        <tr>
                                            <td colspan="2">
                                                <span style="font-size:8px;">Unsere Preise verstehen sich frei. 7.7%MwSt.</span>
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                            </td>
                        </tr>
                    </table>
                @endif
    
                {{-- Entsorgung Alanı --}}
                @if($isEntsorgung)
                    <table  border="0" style="width: 100%;margin-top:20px;">
                        <tr style="width:100%;">
                            <td colspan="4" class="p-1 " style="background-color:#E5E5E5;">
                                <b style="font-size:13px;line-height:13px;">Entsorgung</b>
                            </td>
                        </tr>
            
                        {{-- Boşluk Bırakma --}}
                        <tr style="width:100%;">
                            <td colspan="4" style="padding-top:5px;"></td>
                        </tr>
                        
                        @if ($entsorgung['tariff'])
                        <tr style="width:100%;" >
                            <td colspan="3"><b style="">Tarif: </b></td>
                            <td colspan="1"> {{ $entsorgung['ma'] }} Mitarbeiter mit {{ $entsorgung['lkw'] }} Lieferwagen @if($entsorgung['anhanger']) und {{ $entsorgung['anhanger'] }} Anhänger @endif à CHF {{ $entsorgung['chf'] }}.- / Stunde</td>
                        </tr>
                        @endif

                        @if($entsorgung['volume'])
                        <tr style="width:100%;" >
                            <td colspan="3"><b style="">Entsorgungstarif: </b></td>
                            <td colspan="1"> CHF {{ $entsorgung['volumeCHF'] }}.- pro m3 </td>
                        </tr>
                        @endif

                        @if($entsorgung['fixedCost'])
                        <tr style="width:100%;" >
                            <td colspan="3"><b style="">Entsorgungsaufwand: </b></td>
                            <td colspan="1"> {{$entsorgung['fixedCost'] }} CHF - pauschal (Aufwand an der Entsorgungsstelle)
                            </td>
                        </tr>
                        @endif
                        
                        {{-- Boşluk Bırakma --}}
                        <tr style="width:100%;">
                            <td colspan="4" style="padding-top:5px;"></td>
                        </tr>
            
                        <tr  style="width:100%;">
                            <td valign="top" colspan="2">
                            Entsorgungstermin:<br>
                            Geschätzter Aufwand: <br>
                            Geschätztes Volumen: <br>
                            Anfahrt/Rückfahrt:
                            </td>
            
                            <td valign="top" style="padding-left:10px;" >
                                @if($entsorgung['entsorgungDate']){{ date("d/m/Y", strtotime($entsorgung['entsorgungDate'])); }} @else - @endif<br>
                                {{ $entsorgung['hour'] }} Stunden<br>
                                {{ $entsorgung['m3'] }} m³<br>
                                {{ $entsorgung['arrivalReturn'] }} CHF<br>
                            </td>
                        
                            <td valign="top" align="right" >
                            <table  border="0" >
                                    <tr style="width:100%;">
                                        <td>
                                            @if ( $entsorgung['entsorgungExtra1'] )
                                                <tr>
                                                    <td style="padding-left:15px;">Spesen</td>
                                                    <td>{{ $entsorgung['entsorgungExtra1'] }} CHF</td>
                                                </tr>
                                            @endif
                                            
                                            @if ( $entsorgung['extraCostValue1'] )
                                                <tr>
                                                    <td style="padding-left:15px;">@if ( $entsorgung['extraCostText1'] ) {{ $entsorgung['extraCostText1'] }} @else Extra Kosten @endif</td>
                                                    <td>{{ $entsorgung['extraCostValue1'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ($entsorgung['extraCostValue2'])
                                                <tr>
                                                    <td style="padding-left:15px;">@if ( $entsorgung['extraCostText2'] ) {{ $entsorgung['extraCostText2'] }} @else Extra Kosten @endif</td>
                                                    <td>{{ $entsorgung['extraCostValue2'] }} CHF</td>
                                                </tr>
                                            @endif
                                        </td>
                                    </tr>
                
                
                                    @if($entsorgung['discount'] !=0)
                                    <tr>
                                        <td align="left" valign="top">@if( $entsorgung['discountText'] ) {{ $entsorgung['discountText'] }}: @else Rabatt: @endif</td>
                                        <td><span >-{{ $entsorgung['discount'] }} CHF</span></td>
                                    </tr>
                                    @endif
                                    
                                    @if($entsorgung['discountPercent'] !=0)
                                    <tr>
                                        <td align="left" valign="top"> Rabatt[%]:</td>
                                        <td><span >- %{{ $entsorgung['discountPercent'] }}</span></td>
                                    </tr>
                                    @endif

                                    @if($entsorgung['extraDiscountPrice'] !=0)
                                    <tr>
                                        <td align="left" valign="top">@if( $entsorgung['extraDiscountText'] ) {{ $entsorgung['extraDiscountText'] }}: @else Extra Rabatt: @endif</td>
                                        <td><span >-{{ $entsorgung['extraDiscountPrice'] }} CHF</span></td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td align="left" valign="top"> Kosten: </td>
                                        <td><span style="color:#835AB1;"><b>{{ $entsorgung['defaultPrice'] }} CHF</b></span></td>
                                    </tr>
                
                                    <tr>
                                        <td align="left" valign="top"> Pauschal: </td>
                                        <td><span style="color:#835AB1;"><b>{{ $entsorgung['fixedPrice'] }} CHF</b></span></td>
                                    </tr>
                
                                    @if($offer['kostenExkl'])
                                        <tr>
                                            <td colspan="2">
                                                <span style="font-size:8px;">Unsere Preise verstehen sich exkl. 7.7%MwSt.</span>
                                            </td>
                                        </tr>
                                    @endif

                                    @if($offer['kostenInkl'])
                                        <tr>
                                            <td colspan="2">
                                                <span style="font-size:8px;">Unsere Preise verstehen sich inkl. 7.7%MwSt.</span>
                                            </td>
                                        </tr>
                                    @endif

                                    @if($offer['kostenFrei'])
                                        <tr>
                                            <td colspan="2">
                                                <span style="font-size:8px;">Unsere Preise verstehen sich frei. 7.7%MwSt.</span>
                                            </td>
                                        </tr>
                                    @endif
                            </table>
                            </td>
                        </tr>
                </table>
                @endif
                {{-- Transport Alanı --}}
                @if ($isTransport)
                <table border="0" style="width: 100%;margin-top:20px;">
                        <tr style="width:100%;">
                            <td colspan="4" class="p-1 " style="background-color:#E5E5E5;">
                                <b style="font-size:13px;line-height:13px;">Transport</b>
                            </td>
                        </tr>
             
                        {{-- Boşluk Bırakma --}}
                        <tr style="width:100%;">
                            <td colspan="4" style="padding-top:5px;"></td>
                        </tr>
                        
                    @if($transport['pdfText'])
                        <tr style="width:100%;">
                            <td colspan="2"><b style="">Transportart: </b></td>
                            <td colspan="2"> {{ $transport['pdfText'] }}</td>
                        </tr>
                    @endif
                    
                    @if($transport['fixedChf'])
                    <tr style="width:100%;">
                        <td colspan="2"><b style="">Pauschal: </b></td>
                        <td colspan="2"> {{ $transport['fixedChf'] }}</td>
                    </tr>
        
                    @else 
                    <tr style="width:100%;">
                        <td colspan="2"><b style="">Tarif: </b></td>
                        <td colspan="2">{{ $transport['ma'] }} Mitarbeiter mit {{ $transport['lkw'] }} Lieferwagen @if($transport['anhanger']) und {{ $transport['anhanger'] }} Anhänger @endif à CHF {{ $transport['chf'] }}.- / Stunde </td>
                        
                    </tr>
                    @endif
                        
                        {{-- Boşluk Bırakma --}}
                        <tr style="width:100%;">
                            <td colspan="4" style="padding-top:5px;"></td>
                        </tr>
            
                        <tr  style="width:100%;">
                            <td valign="top">
                            Transporttermin:<br>
                            Arbeitsbeginn:<br>
                            Anfahrt/Rückfahrt:<br>
                            </td>
            
                            <td valign="top" style="padding-left:10px;">
                                @if($transport['transportDate']){{ date("d/m/Y", strtotime($transport['transportDate'])); }} @else - @endif<br>
                                @if($transport['transportTime']){{ $transport['transportTime'] }} @else - @endif<br>
                                {{ $transport['arrivalReturn'] }} CHF <br>
                            </td>
                        
                            <td valign="top" colspan="2">
                                <table  border="0">
                                <tr style="width:100%;">
                                    <td valign="top">Geschätzter Aufwand: </td>
                                    <td >{{ $transport['hour'] }} Stunde</td>
                                </tr>
                                <tr>
                                        <td valign="top">Zusatzkosten: <br></td>
                                        <td>
                                            @if ( $transport['extraCostValue1'] !=0)
                                                <tr>
                                                    <td style="padding-left:15px;">{{ $transport['extraCostText1'] }}</td>
                                                    <td>{{ $transport['extraCostValue1'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $transport['extraCostValue2'] !=0)
                                                <tr>
                                                    <td style="padding-left:15px;">{{ $transport['extraCostText2'] }}</td>
                                                    <td>{{ $transport['extraCostValue2'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $transport['extraCostValue3'] !=0)
                                                <tr>
                                                    <td style="padding-left:15px;">{{ $transport['extraCostText3'] }}</td>
                                                    <td>{{ $transport['extraCostValue3'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $transport['extraCostValue4'] !=0)
                                                <tr>
                                                    <td style="padding-left:15px;">{{ $transport['extraCostText4'] }}</td>
                                                    <td>{{ $transport['extraCostValue4'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $transport['extraCostValue5'] !=0)
                                                <tr>
                                                    <td style="padding-left:15px;">{{ $transport['extraCostText5'] }}</td>
                                                    <td>{{ $transport['extraCostValue5'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $transport['extraCostValue6'] !=0)
                                                <tr>
                                                    <td style="padding-left:15px;">{{ $transport['extraCostText6'] }}</td>
                                                    <td>{{ $transport['extraCostValue6'] }} CHF</td>
                                                </tr>
                                            @endif
                                            @if ( $transport['extraCostValue7'] !=0)
                                                <tr>
                                                    <td style="padding-left:15px;">{{ $transport['extraCostText7'] }}</td>
                                                    <td>{{ $transport['extraCostValue7'] }} CHF</td>
                                                </tr>
                                            @endif
                                        </td>
                                </tr>
            
                                @if($transport['discount'] !=0)
                                <tr>
                                    <td align="left" valign="top"> Rabatt: </td>
                                    <td><span >-{{ $transport['discount'] }} CHF</span></td>
                                </tr>
                                @endif
        
                                @if($transport['discountPercent'] !=0)
                                    <tr>
                                        <td align="left" valign="top"> Rabatt[%]: </td>
                                        <td><span >- %{{ $transport['discountPercent'] }}</span></td>
                                    </tr>
                                @endif

                                @if($transport['compromiser'] !=0)
                                <tr>
                                    <td align="left" valign="top"> Entgegenkommen: </td>
                                    <td><span >-{{ $transport['compromiser'] }} CHF</span></td>
                                </tr>
                                @endif
        
                                @if($transport['extraDiscountValue'] !=0)
                                <tr>
                                    <td align="left" valign="top">@if( $transport['extraDiscountText'] ) {{ $transport['extraDiscountText'] }}: @else Rabatt: @endif</td>
                                    <td><span >-{{ $transport['extraDiscountValue'] }} CHF</span></td>
                                </tr>
                                @endif
        
                                @if($transport['extraDiscountValue2'] !=0)
                                <tr>
                                    <td align="left" valign="top">@if( $transport['extraDiscountText2'] ) {{ $transport['extraDiscountText2'] }}: @else Rabatt 2: @endif</td>
                                    <td><span >-{{ $transport['extraDiscountValue2'] }} CHF</span></td>
                                </tr>
                                @endif
        
                                
                                <tr>
                                    <td align="left" valign="top">@if( $transport['fixedChf'] !=0 ) Pauschal: @else Geschätzte Kosten: @endif  </td>
                                    <td><span style="color:#835AB1;"><b>{{ $transport['defaultPrice'] }} CHF</b></span></td>
                                </tr>
                                
                                @if($transport['topCost'] != NULL)
                                <tr>
                                    <td align="left" valign="top"> Kostendach: </td>
                                    <td><span style="color:#835AB1;"><b>{{ $transport['topCost'] }} CHF</b></span></td>
                                </tr>
                                @endif
                            
        
                                @if($offer['kostenExkl'])
                                    <tr>
                                        <td colspan="2">
                                            <span style="font-size:8px;">Unsere Preise verstehen sich exkl. 7.7%MwSt.</span>
                                        </td>
                                    </tr>
                                @endif
    
                                @if($offer['kostenInkl'])
                                    <tr>
                                        <td colspan="2">
                                            <span style="font-size:8px;">Unsere Preise verstehen sich inkl. 7.7%MwSt.</span>
                                        </td>
                                    </tr>
                                @endif
    
                                @if($offer['kostenFrei'])
                                    <tr>
                                        <td colspan="2">
                                            <span style="font-size:8px;">Unsere Preise verstehen sich frei. 7.7%MwSt.</span>
                                        </td>
                                    </tr>
                                @endif
                                </table>
                            </td>
                        </tr>
                    </table>
                @endif
    
                {{-- Lagerung Alanı --}}
                @if ($isLagerung)
                    <table  border="0" style="width: 100%;margin-top:20px;">
                            <tr style="width:100%;">
                                <td colspan="4" class="p-1 " style="background-color:#E5E5E5;">
                                    <b style="font-size:13px;line-height:13px;">Lagerung</b>
                                </td>
                            </tr>
                
                            {{-- Boşluk Bırakma --}}
                            <tr style="width:100%;">
                                <td colspan="4" style="padding-top:5px;"></td>
                            </tr>
                            
                            <tr style="width:100%;" >
                                <td colspan="3"><b style="">Tarif: </b></td>
                                <td colspan="1">CHF {{ $lagerung['chf'] }}.- pro m3 im Monat</td>
                            </tr>
                            
                            {{-- Boşluk Bırakma --}}
                            <tr style="width:100%;">
                                <td colspan="4" style="padding-top:5px;"></td>
                            </tr>
                
                            <tr  style="width:100%;">
                                <td valign="top" colspan="2">
                                Volumen:<br>
                                </td>
                
                                <td valign="top" style="padding-left:10px;" >
                                    {{ $lagerung['volume'] }} m³<br>
                                </td>
                            
                                <td valign="top" align="right" >
                                <table  border="0" >
                                        <tr style="width:100%;">
                                            <td valign="top">Zusatzkosten: <br></td>
                                            <td>
                                                @if ( $lagerung['extraCostValue1'] !=0)
                                                    <tr>
                                                        <td style="padding-left:15px;">{{ $lagerung['extraCostText1'] }}</td>
                                                        <td>{{ $lagerung['extraCostValue1'] }} CHF</td>
                                                    </tr>
                                                @endif
                                                @if ( $lagerung['extraCostValue2'] !=0)
                                                    <tr>
                                                        <td style="padding-left:15px;">{{ $lagerung['extraCostText2'] }}</td>
                                                        <td>{{ $lagerung['extraCostValue2'] }} CHF</td>
                                                    </tr>
                                                @endif
                                            </td>
                                        </tr>
                    
                    
                                        @if($lagerung['discountValue'] !=0)
                                        <tr>
                                            <td align="left" valign="top">@if( $lagerung['discountText'] ) {{ $lagerung['discountText'] }}: @else Rabatt: @endif</td>
                                            <td><span >-{{ $lagerung['discountValue'] }} CHF</span></td>
                                        </tr>
                                        @endif

                                        @if($lagerung['discountPercent'] !=0)
                                        <tr>
                                            <td align="left" valign="top">Rabatt[%]: </td>
                                            <td><span >- %{{ $lagerung['discountPercent'] }}</span></td>
                                        </tr>
                                        @endif

                                        <tr>
                                            <td align="left" valign="top"> Kosten: </td>
                                            <td><span style="color:#835AB1;"><b>{{ $lagerung['totalPrice'] }} CHF</b></span></td>
                                        </tr>
                    
                                        <tr>
                                            <td align="left" valign="top"> Pauschal: </td>
                                            <td><span style="color:#835AB1;"><b>{{ $lagerung['fixedPrice'] }} CHF</b></span></td>
                                        </tr>
                    
                                        @if($offer['kostenExkl'])
                                            <tr>
                                                <td colspan="2">
                                                    <span style="font-size:8px;">Unsere Preise verstehen sich exkl. 7.7%MwSt.</span>
                                                </td>
                                            </tr>
                                        @endif
    
                                        @if($offer['kostenInkl'])
                                            <tr>
                                                <td colspan="2">
                                                    <span style="font-size:8px;">Unsere Preise verstehen sich inkl. 7.7%MwSt.</span>
                                                </td>
                                            </tr>
                                        @endif
    
                                        @if($offer['kostenFrei'])
                                            <tr>
                                                <td colspan="2">
                                                    <span style="font-size:8px;">Unsere Preise verstehen sich frei. 7.7%MwSt.</span>
                                                </td>
                                            </tr>
                                        @endif
                                </table>
                                </td>
                            </tr>
                    </table>
                @endif
    
                {{-- Material Alanı --}}
                @if($isMaterial)
                    <table border="0" style="width: 100%;margin-top:20px;">
                        <tr style="width:100%;">
                            <td colspan="5" class="p-1 " style="background-color:#E5E5E5;">
                                <b style="font-size:13px;line-height:13px;">Verpackungsmaterial</b>
                            </td>
                        </tr>
            
                        <tr>
                            <td  style="font-weight: bold;">Art</td>
                            <td  style="font-weight: bold;">zur Miete/Kauf</td>
                            <td  style="font-weight: bold;">Preis pro Stk</td>
                            <td  style="font-weight: bold;">Anzahl</td>
                            <td  style="font-weight: bold;">Total</td>
                        </tr>
            
                        {{-- Boşluk Bırakma --}}
                        <tr style="width:100%;">
                            <td colspan="5" style="padding-top:5px;"></td>
                        </tr>
            
                        @foreach ($basket as $k => $v)
                        <tr>
                            <td >{{ \App\Models\Product::productName($v['productId'])}} </td>
                            <td >@if ($v['buyType'] == 1) Kauf @elseif ($v['buyType'] == 2) Miete @else - @endif</td>
                            <td >
                                @if ($v['buyType'] == 1) {{ \App\Models\Product::buyPrice($v['productId'])}} 
                                    @elseif ($v['buyType'] == 2) {{ \App\Models\Product::rentPrice($v['productId'])}}
                                    @else - 
                                @endif
                            </td>
                            <td style="padding-left: 10px;">{{ $v['quantity'] }}</td>
                            <td style="padding-left: 10px;">{{ $v['totalPrice'] }}</td>
                        </tr>
                        @endforeach
                        
            
                        {{-- Boşluk Bırakma --}}
                        <tr style="width:100%;">
                            <td colspan="4" style="padding-top:10px;"></td>
                        </tr>
            
                        <tr>
                            <td >Reduktion:</td>
                            <td align="left" colspan="4">{{ $material['discount'] }} CHF</td>
                        </tr>
            
                        <tr>
                            <td >Lieferung:</td>
                            <td align="left" colspan="4">{{ $material['deliverPrice'] }} CHF</td>
                        </tr>
            
                        <tr>
                            <td >Abholung:</td>
                            <td align="left" colspan="4">{{ $material['recievePrice'] }} CHF</td>
                        </tr>
            
                        <tr>
                            <td style="font-weight: bold;">Total:</td>
                            <td align="left" colspan="4"><span  style="color:#835AB1;font-weight: bold;">{{ $material['totalPrice'] }} CHF</span></td>
                        </tr>
    
                        @if($offer['kostenExkl'])
                            <tr>
                                <td colspan="2">
                                    <span style="font-size:8px;">Unsere Preise verstehen sich exkl. 7.7%MwSt.</span>
                                </td>
                            </tr>
                        @endif
    
                        @if($offer['kostenInkl'])
                            <tr>
                                <td colspan="2">
                                    <span style="font-size:8px;">Unsere Preise verstehen sich inkl. 7.7%MwSt.</span>
                                </td>
                            </tr>
                        @endif
    
                        @if($offer['kostenFrei'])
                            <tr>
                                <td colspan="2">
                                    <span style="font-size:8px;">Unsere Preise verstehen sich frei. 7.7%MwSt.</span>
                                </td>
                            </tr>
                        @endif
                    </table>
                @endif

                {{-- Bemerkung Alanı --}}
                @if ($offer['offerteNote'])
                    <table  border="0" style="width: 100%;margin-top:20px;">
                            <tr style="width:100%;">
                                <td colspan="4" class="p-1 " style="background-color:#E5E5E5;">
                                    <b style="font-size:13px;line-height:13px;">Bemerkung</b>
                                </td>
                            </tr>
                
                            {{-- Boşluk Bırakma --}}
                            <tr style="width:100%;">
                                <td colspan="4" style="padding-top:5px;"></td>
                            </tr>
                            
                            <tr style="width:100%;">
                                <td colspan="4" align="left" style="padding-top:5px;">
                                    {{ $offer['offerteNote'] }}
                                </td>
                            </tr>
                    </table>
                @endif
            </div>
    
            <div class="bemerkungen" style="width:100%;height:100%;">
                <span ><b style="font-size:26px!important;line-height:26px;color:red;">Erstklassiger Full-Service aus einer Hand</b></span>
                <p class="mt-3" style="font-size:14px!important;line-height:14px;"> 
                    Eine durchdachte Umzugsplanung ist unerlässlich und hilft Ihnen Kosten, Nerven und Zeit zu sparen. <br>
                    Wir planen, organisieren und führen Ihren Umzug durch. Ihre Zufriedenheit steht dabei an erster <br>
                    Stelle. Unsere erfahrenen und langjährigen Mitarbeiter übernehmen die organisatorische sowie <br>
                    praktische Umsetzung Ihres Umzugs.    
                </p>
                <span >
                    <strong style="font-size:16px!important;line-height:18px;color:red;">Qualität beim Umziehen garantiert mit Swiss Transport:</strong> 
                </span>
                <ul >
                    <li style="font-size:14px!important;line-height:14px;">Persönliche Betreuung vor, während und nach dem Umzug</li>
                    <li style="font-size:14px!important;line-height:14px;">Breite Palette an Verpackungsmaterial, zum Kauf oder zur Miete</li>
                    <li style="font-size:14px!important;line-height:14px;">Qualifizierte und motivierte Fachleute mit langjähriger Berufserfahrung</li>
                    <li style="font-size:14px!important;line-height:14px;">Professionell ausgerüstete Möbelwagen und Zügellifte</li>
                    <li style="font-size:14px!important;line-height:14px;">Fachmännisches Ein- und Auspacken Ihres Hausrates</li>
                    <li style="font-size:14px!important;line-height:14px;">De- und Montage der Möbel von versierten Möbelmonteuren</li>
                    <li style="font-size:14px!important;line-height:14px;">Umweltgerechte Entsorgung / Räumung alter Möbel und Hausrat</li>
                    <li style="font-size:14px!important;line-height:14px;">Lagerungsmöglichkeiten in unserem Möbellagerhaus</li>
                </ul>
    
                <span>
                    <strong style="font-size:16px!important;line-height:18px;color:red;">Folgende Kosten sind im Preis inbegriffen:</strong>
                </span>

                <ul>
                    <li style="font-size:14px!important;line-height:14px;">Schutzmaterial für Bilder, elektronische Geräte und Matratzenhüllen</li>
                    <li style="font-size:14px!important;line-height:14px;">Bodenvlies zum Schutz heikler Bodenbeläge, falls erforderlich</li>
                    <li style="font-size:14px!important;line-height:14px;">Stretchfolie für den optimalen Schutz heikler Möbel am Umzugstag</li>
                    <li style="font-size:14px!important;line-height:14px;">Glas und Spiegel werden mit Luftpolsterfolie vor dem Transport geschützt</li>
                    <li style="font-size:14px!important;line-height:14px;">Selbstverständlich führen wir Traggurten, Werkzeuge und genügend Wolldecken mit</li>
                </ul>

                <span >
                    <strong style="font-size:16px!important;line-height:18px;color:red;">Versicherung:</strong> <br>
                </span>
                <span style="font-size:14px!important;line-height:14px;">
                    Haftpflichtversicherung bis CHF 10 Mio. und Transportversicherung CHF 100&#39;000.- (ohne Selbstbehalt)
                </span> <br><br>

                <span >
                    <strong style="font-size:16px!important;line-height:18px;color:red;">Arbeitsaufwand:</strong> <br>
                </span>
                <span style="font-size:14px!important;line-height:14px;">
                    Es wird bei einem Mindestaufwand von 3 Stunden auf 15 Minuten genau nach effektivem Aufwand abgerechnet.
                </span> <br><br>

                <span >
                    <strong style="font-size:16px!important;line-height:18px;color:red;">Pausen:</strong> <br>
                </span>
                <span style="font-size:14px!important;line-height:14px;">
                    Betragen für die Mitarbeiter pro Vor- und Nachmittag je 15 Minuten. Die Mittagspause beträgt i.d.R. <br>
                    eine Stunde und gilt nicht als Arbeitszeit.
                </span> <br><br>

                <span >
                    <strong style="font-size:16px!important;line-height:18px;color:red;">Gewichtszuschläge:</strong> <br>
                </span>
                <span style="font-size:14px!important;line-height:14px;">
                    Gewichtszuschlag von CHF 150.– für Gegenstände mit einem Eigengewicht von über 100kg. <br>
                    Klavierzuschlag ab CHF 250.–
                </span> <br><br>

                <span style="font-size:14px!important;line-height:14px;"> Wir hoffen, dass wir Ihr Interesse wecken konnten, und würden uns freuen, Sie schon bald als einen <br>
                unserer zufriedenen Kunden begrüssen zu können. <br><br>

                Freundliche Grüsse <br> <br>

                Ihr Swiss Transport Team 
                </span>
                <div class="certificate" style="align:right;">
                    <a href="https://www.provenexpert.com/swiss-transport-ag/?utm_source=Widget&utm_medium=Widget&utm_campaign=Widget" target="_blank"><img style="padding:0px!important;align:right;" src="{{ asset('assets/demo/certificate.png') }}" width="300" /></a>
                </div>
            </div>
    </main>
</body>
</html>