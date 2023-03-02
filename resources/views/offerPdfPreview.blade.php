<!DOCTYPE html>
<html>
<head>
    
    <title>Offerte</title>
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
                bottom: -100px; 
                left: 0px; 
                right: 0px;
                border-top:black 1px solid;
                padding-bottom:5px;
                /** Extra personal styles **/
                text-align: center;
            }
            .certificate{
                position: fixed; 
                bottom: -70px; 
                right: 0px;
                padding-bottom:5px;
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
        th div, td div {
            margin-top:-8px;
            padding-top:8px;
            page-break-inside:avoid;
        }
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
        <span style="font-size:9px;">Swiss Transport AG | Wehntalerstrasse 190 | CH-8105 Regensdorf | Telefon: 044 731 96 59 | info@swisstransport.ch | www.swisstransport.ch | CHE-478.905.969</span>
    </footer>

    <main>
        <div>
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
                            @if($offer['contactPerson'] == "Bitte wählen") - @else {{ $offer['contactPerson'] }} @endif<br>
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
                <table border="0" style="width: 100%;margin-top:20px;@if($einpack && $auspack && $reinigung) page-break-after: always; @endif">
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
                        <td colspan="2" >{{ $reinigung['reinigungType'] }}</td>
                        </tr>
                        <tr style="width:100%;">
                            <td colspan="2"><b style="">@if ($reinigung['fixedTariff'])Zimmer: @else Tarif: @endif</b></td>
                            <td colspan="2"> @if ($reinigung['fixedTariff'])
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
                                            @if ( $entsorgung['extraCostValue2'] )
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
    
            <div class="bemerkungen" >
                <span ><b style="font-size:18px!important;line-height:18px;">Bemerkungen</b></span>
                <p class="mt-3"> <b>Relevante Bestimmungen:</b> </p>
                
                <ul>
                    <li><b>Arbeitsaufwand:</b> es wird bei einem Mindestaufwand von 3 Stunden auf 15 Minuten genau nach effektivem Aufwand abgerechnet.</li>
                    <li><b>Pausen:</b> betragen für die Mitarbeiter pro Vor- und Nachmittag je 15 Minuten. Die Mittagspause beträgt i.d.R. eine Stunde und gilt
                        nicht als Arbeitszeit.</li>
                    <li><b>Preise:</b> sämtliche Preise unserer Offerten verstehen sich zzgl. 7.7% MwSt.
                    </li>
                    <li><b>Entstehung des Vertrag:</b> für einen rechtsgültigen Vertrag bedarf es beidseitiger elektronischer Bestätigung des Angebots.
                    </li>
                    <li><b>Gültigkeit des Angebots</b> 21 Tage
                    </li>
                    <li><b>Versicherung:</b> Haftpflichtversicherung bis CHF 10 Mio. und Transportversicherung CHF 100'000.- (ohne Selbstbehalt für den
                        Kunden)
                    </li>
                    <li><b>All-Risk Versicherung</b> (auf Wunsch separat). Deckt z. Bsp. Kunst, Hightech-Geräte, Luxus und Wertgegenstände etc.
                    </li>
                    <li><b>Abschliessende Bemerkung:</b> sofern keine anderweitigen Vereinbarungen im Angebotsfenster vorhanden sind, gelten obige
                        Bestimmungen.
                    </li>
                </ul>
    
                <p>Endreinigungen beinhalten eine 100% Abgabegarantie mit folgenden Leistungen:
                </p>
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

                <div class="certificate" style="align:right;">
                    <a href="https://www.provenexpert.com/swiss-transport-ag/?utm_source=Widget&utm_medium=Widget&utm_campaign=Widget" target="_blank"><img style="padding:0px!important;align:right;" src="{{ asset('assets/demo/certificate.png') }}" width="300" /></a>
                </div>
            </div>


            {{-- <div class="a" style="page-break-after: always;">
                <table style="line-height:7px;">
                    <tr>
                        <td valign="top" style="width: 50%">
                            <b>Allgemeine Umzugsbedingungen der Swiss Transport AG</b><br><br>
                            <b >Art. 1 Geltungsbereich</b><br>
                            <span>
                            Die Ausführung eines Auftrages erfolgt zu den nachstehenden
                            Bedingungen der Swiss Transport AG soweit ihnen nicht
                            zwingende gesetzliche Vorschriften entgegenstehen.<br><br>
    
                            Grundlage der Bedingungen bilden die Bestimmungen des
                            Schweizerischen Obligationenrechts (OR) sowie das Abkommen
                            zwischen der Schweizerischen Eidgenossenschaft und der Europäischen Gemeinschaft über den Güter- und Personenverkehr auf
                            Schiene und Strasse (AS 2002, 1649)<br><br>
    
                            Die Allgemeinen Bedingungen dienen dazu, die gesetzlichen
                            Bestimmungen zu ergänzen. Von den Bedingungen abweichende
                            Vereinbarungen sind schriftlich zu treffen<br><br>
                            </span>
    
                            <b>Art. 2 Allgemeines</b><br>
                            <span>
                            Der Auftrag hat alle für eine ordentliche Ausführung notwendigen
                            Angaben, wie Hinweise auf reglementierte Güter (z.B. Gefahrengut) sowiesolche, dieeinerbesonderen Behandlung bedürfen, zu
                            enthalten.<br><br>
    
                            Der Frachtführer überprüft den ihm erteilten Auftrag sorgfältig; er
                            ist jedoch nicht verpflichtet, den Inhalt von Transportgefässen oder
                            Sendungen zu überprüfen, noch Gewichts- oder Masskontrollen
                            vorzunehmen. Stellt derFrachtführer Unklarheiten fest, soklärt er
                            sie raschmöglichst mit demAuftraggeber ab<br><br>
    
                            Der über das mit dem Auftraggeber vereinbarte Volumen
                            hinausgehende Laderaum bleibt zur Verfügung des Frachtführers.
                            Dieser ist berechtigt, die Ausführung des übernommenen
                            Auftrages einem anderen Frachtführer zu übertragen<br><br>
                            </span>
    
                            <b>Art. 3 Transportübernahme im Allgemeinen</b><br>
                            <span>
                            Jeder Auftrag setzt voraus, dass er unter normalen Verhältnissen
                            durchgeführt werden kann; die Hauptverkehrsstrassen sowie die
                            Strassen und Wege zu den Häusern, wo Belad und Entlad
                            stattfinden, müssen fürdieTransportfahrzeugebefahrbar sein.<br><br>
    
                            Bei Vorgärten und dergleichen gelten als normale Zufahrtsverhältnisse höchstens 15 Meter Distanz zwischen Fahrzeug und
                            Hauseingang. Korridore, Treppen usw. sollen einen reibungslosen
                            Transport ermöglichen. Ferner wird vorausgesetzt, dass die
                            behördlichen Bestimmungen die Ausführung in der vorgesehenen
                            Weise zulassen<br><br>
    
                            In allen anderen Fällen erhöht sich der Umzugspreis nach
                            Massgabe der Mehraufwendungen.<br><br>
                            </span>
    
                            <b>Art. 4 Pflichten des Frachtführers</b><br>
                            <span>
                            Der Frachtführer ist dazu verpflichtet, die für die Ausführung des
                            Auftrages notwendigen Transportmittel auf den vereinbarten
                            Zeitpunkt bereitzustellen. Der Frachtführer führt den Auftrag
                            vertragsgemäss und mit der notwendigen Sorgfalt aus. Die
                            Ablieferung des Frachtgutes am Bestimmungsort hat sofort nach
                            Ankunft desTransportes oder nach Vereinbarung zuerfolgen.<br><br>
                            </span>
    
                            <b>Art. 5 Pflichten des Auftraggebers</b><br>
                            <span >
                            Der Auftraggeber hat für geeignete Verpackung zu sorgen. Er hat
                            dem Frachtführer rechtzeitig die Adresse des Empfängers, den Ort
                            der Ablieferung und die örtlichen Verhältnisse genau zu bezeichnen.<br>
    
                            Der Auftraggeber ist verpflichtet, den Frachtführer auf die besondere Beschaffenheit des Transportgutes und dessen
                            Schadenanfälligkeit aufmerksam zu machen<br>
    
                            Der Auftraggeber hat dafür zu sorgen, dass die Transportarbeiten,
                            dieVer-undEntladung imvereinbarten Zeitpunkt bzw. sofortnach
                            Eintreffen der Transportfahrzeuge begonnen werden können.<br>
    
                            Vorbehältlich anderer Vereinbarung obliegt die Besorgung aller für
                            die Durchführung des Transportes erforderlichen Dokumente,
                            Bewilligungen und Absperrungen dem Auftraggeber <br>
    
    
                            Der Auftraggeber ist zur wahrheitsgetreuen Deklaration des
                            Transportgutes verpflichtet und übernimmt gegenüber dem
                            Frachtführer sowie den Bahn- und Zollorganen oder weiteren Behörden dievolleVerantwortung.Ohne diesbezüglicheWeisung<br><br>
                            </span>
                        </td>
    
                        <td valign="top">
                            durch den Auftraggeber ist der Frachtführer berechtigt, das Transportgut als Übersiedlungsgut zu behandeln. <br><br>
    
                            Der Auftraggeber hat für die Beschaffung der erforderlichen
                            Zolldokumente besorgt zu sein und ist für deren Richtigkeit
                            verantwortlich. Für alle Folgen, die durch das Fehlen, die
                            verspätete Zustellung und die Unvollständigkeit oder Unrichtigkeit
                            dieser Dokumente entstehen, hat der Auftraggeber aufzukommen.
                            Er haftet dem Frachtführer für alle sich aus der Zollbehandlung
                            des Transportgutes ergebenden Auslagen. Der Preis für die
                            Zollabfertigungskosten setzt eine normale Abwicklung voraus.
                            Verlängerte Zollaufenthalte und besondere Verhandlungen mit den
                            zuständigen Behörden sind dem Frachtführer entsprechend zu
                            vergüten. Der Frachtführer ist nicht verpflichtet, Frachten, Zölle
                            und Abgaben zu bevorschussen. Er kann vom Auftraggeber
                            Vorschüsse inderjeweiligen Währungverlangen. TrittderFrachtführerinVorlage, so sind ihm Vorlageprovision und Zins sowie ein
                            angemessener Kursverlust zu ersetzen.<br><br>
    
                            Für alle Umtriebe und Mehrkosten, die infolge verspäteter
                            Abnahme des Transportgutes durch den Auftraggeber entstehen,
                            hat dieser aufzukommen. Kann innerhalb einer Wartezeit von vier
                            Stunden die Entladung nicht begonnen werden, ist der Frachtführer berechtigt, auf Rechnung und Gefahr des Auftraggebers das
                            Transportgut einzulagern. Dabei beschränkt sich seine Haftung auf
                            die sorgfältige Auswahl des Einlagerungsortes. <br><br>
    
                            Ausdrücklich vom Transport ausgeschlossen sind Bargeld, Inhaberpapiere, inklusive Effekten im Sinne des Börsengesetzes, die
                            Inhabereigenschaften haben, oder Edelmetalle<br><br>
                            <b >Art. 6 Preise</b><br>
                            Der Preis berechnet sich nach Aufwand oder pauschal. Im Preis
                            nicht eingeschlossen sind dagegen, besondere Vereinbarungen
                            vorbehalten, folgende Aufwendungen: <br>
    
                            a) dasEin- und Auspacken des Umzugsgutes, insbesondere für
                            Verpackungsarbeiten, die am Umzugstag durch den Frachtführer vorgenommen werden müssen;<br>
                            b) spezieller Hin- oder Rücktransport von Packmaterial sowie
                            dessen Miete oder Kauf; <br>
                            c) das Demontieren und Montieren von komplizierten oder neuen
                            Möbeln, die besonderen Zeitaufwand oder den Beizug eines
                            Spezialisten benötigen;<br>
                            d) der Transport vonKühlschränken/Truhen von über 200 I,KIavieren, Flügeln, Kassenschränken und anderen Gegenständen
                            vom mehr als 100 kg Eigengewicht;<br>
                            e) das Abnehmen und Anbringen von Bildern, Spiegeln, Uhren,
                            Lampen, Vorhängen, Einbauten usw.;<br>
                            f) der Mehraufwand für Gegenstände, deren Transport durch
                            Fenster oder über Balkone zu erfolgenhat;<br>
                            g) die Prämien von Transportversicherungen;<br>
                            h) Zollabfertigung, Zoll undZollspesen;<br>
                            i) Strassensteuern und Fährkosten sowie amtliche Gebühren
                            aller Art;<br>
                            j) Mehraufwendungen bzw. Mehrleistungen im Interesse des
                            Umzuges auch ohne besonderen Auftrag;<br>
                            k) Mehraufwendungen durch Witterungsverhältnisse oder falls in
                            gesperrten oder aufgerissenen Strassen das Transportfahrzeug nicht vor das Haus gefahren werden kann, desgleichen
                            für Wartezeiten des Transportfahrzeuges und des Personals,
                            die der Frachtführer nicht verschuldet hat;<br>
                            l) ferner angemessene Zuschläge für das Tragen der Güter auf
                            weiten oder ungewöhnlichen Wegen, soweit nicht bei der
                            Preisvereinbarung eine ausdrückliche Berücksichtigung dieser
                            Umstände stattgefunden hat sowie Mehrkosten, die durch Umwege entstehen, falls die direkten Wege gesperrt oder nicht
                            benutzbar sind;     <br><br>
                            
                            Das Abnehmen und Anbringen von Beleuchtungskörpern und
                            anderen an das Stromnetz angeschlossenen Apparaten darf zufolge gesetzlicher Bestimmungen nicht durch das Transportpersonal
                            vorgenommen werden<br><br>
    
                            <b >Art. 7 Bezahlung</b><br>
                            Umzüge sind grundsätzlich bar zu bezahlen. Der Transportpreis ist
                            vor dem Auslad fällig. Bei Transporten ins Ausland ist Vorauszahlung zu leisten. <br>
                        </td>
                    </tr>
                </table>
            </div>
    
            <div class="b" style="line-height:7px;width:100%;height:100%;">
                <table >
                    <tr >
                        <td valign="top" style="width: 50%;">
                            <b >Art. 8 Umdisponierung / Rücktritt des Auftraggebers</b><br>
                            <span >
                            Der Auftraggeber hat das Recht, einen in Ausführung begriffenen
                            Transport umzudisponieren, gegen vollständige Abgeltung des
                            dadurch dem Frachtführer entstehenden Schadens<br>
    
                            Die erste Umdisponierung ist kostenlos und muss mindestens 3
                            Wochen vor dem vereinbarten Umzugstermin erfolgen. Bei jeder
                            weiteren Umdisponierung fällt eine Bearbeitungsgebühr von CHF
                            65.- an<br><br>
    
                            Bei einer Umdisponierung innerhalb von 3 Wochen vor dem
                            Umzugstermin ist eine Bearbeitungsgebühr von 30% des in der
                            Offerte gestellten Betrages fällig<br><br>
    
                            Ein allfälliger Rücktritt des Auftraggebers hat schriftlich zu erfolgen<br><br>
    
                            Bei Rücktritt innerhalb von 14 Kalendertagen vor dem geplanten
                            Umzug sind 30 % des in der Offerte gestellten Betrages im Sinne
                            einer pauschalierten Abgeltung für Aufwendungen, Bemühungen
                            und Umtriebe geschuldet<br><br>
    
                            Bei Rücktritt desAuftraggebers innerhalb von 48Stunden vor dem
                            geplanten Umzug sind 80 % des in der Offerte gestellten Betrages
                            geschuldet. Beweist der Frachtführer einen grösseren Schaden, ist
                            auch dieser zu entschädigen<br><br>
                            </span>
    
                            <b>Art. 9 Retentionsrecht</b><br>
                            <span >
                            Wenn das Frachtgut nicht angenommen oder die Zahlung der auf
                            denselben haftenden Forderungen nicht geleistet wird, kann der
                            Frachtführer das Frachtgut bis zum Wert des geschuldeten
                            Betrages retinieren oder auf Kosten des Auftraggebers hinterlegen. Es gelten insbesondere die Bestimmungen von Art. 444,
                            445 und 451 OR<br><br>
    
                            <b>IndiesemFall kannderFrachtführer denAuftraggeber schriftlich auffordern, die Forderung innerhalb von 30 Tagen zu
                            begleichen. Diese Aufforderung hat die Androhung zu enthalten, dass der Frachtführer das Recht hat, bei Unterlassung
                            der Zahlung, die betreffenden Güter ohne weitere Formalitäten
                            freihändig bestens zu verwerten (nach eigenem Ermessen
                            freihändiger Verkauf oder, falls die Güter keinen materiellen
                            Wert aufweisen, Entsorgung).</b>  <br><br>
                            </span>
    
                            <b>Art. 10 Haftung</b><br>
                            <span >
                            Der Frachtführer haftet nicht für Schäden, welche durch ihn oder
                            sein Personal durch leichte Fahrlässigkeit entstanden sind. Er
                            haftet nur bei vorsätzlicher Beschädigung oder bei Schäden,
                            welche durch grobe Fahrlässigkeit entstanden sind. Dann jedoch
                            nur, wenn er nicht nachweist, dass er alle nach den Umständen
                            gebotene Sorgfalt angewendet hat, um einen Schaden dieser Art
                            zu verhüten oder dass der Schaden auch bei Anwendung dieser
                            Sorgfalt eingetreten wäre. Bei Schäden zufolge Vorsatz oder
                            grober Fahrlässigkeit ist die Haftung auf den jeweiligen Zeitwert
                            der Güter beschränkt<br><br>
    
                            Seine Haftung reicht in keinem Falle weiter als diejenige der am
                            Transport beteiligten Transportanstalten (Eisenbahn, Schifffahrtsoder Luftverkehrsgesellschaft, Post usw.)<br><br>
    
                            Der Frachtführer haftet nur für Transportgut, dessen Verpackung
                            den normalen Transportanforderungen entspricht. So bedürfen
                            zerbrechliche Gegenstände, Lampen, Lampenschirme, Pflanzen,
                            technische Geräte (Fernseher, Computer usw.) einer geeigneten
                            Verpackung (Art. 442 OR). Bei Beschädigungen des Inhalts von
                            Kisten undanderenBehältnissen haftet derFrachtführer nur, wenn
                            deren Ein- und Auspacken durch seine eigenen oder von ihm beauftragten Hilfspersonen besorgt worden sind. Die Haftung des
                            Frachtführers beschränkt sich in jedem Fall auf die Kosten einer
                            allfälligen möglichen Reparatur oder einer Entschädigung für Wertminderung, unter Ausschluss jeglicher Ersatzleistung<br><br>
    
                            Die Haftung des Frachtführers beginnt mit der Übernahme des
                            Transportgutes und endigt in der Regel mit dessenAblieferung am
                            Bestimmungsort des Auftraggebers, der Einlagerung in einem
                            Lagerhaus oder der Übergabe der Ladung an einen anderen
                            Frachtführer. Soweit der Frachtführer den Auftrag
                            berechtigterweise einem anderen Frachtführer oder Lagerhalter
                            übergibt, haftet ernurfürderen gehörigeAuswahl undInstruktion<br><br>
    
                            Pro Ereignis ist die Haftung des Frachtführers auf CHF 25'000.—
                            beschränkt. Vorbehalten bleiben besonders vereinbarte Versicherungsabsprachen (Art. 12 nachfolgend).
                            </span>
                        </td>
    
                        
                    </tr>
                </table>
            </div>

            <div class="c" style="line-height:7px;width:100%;height:100%;">
                <table style="height: 100%">
                    <tr >
                        <td valign="top">
                            <b>Art. 11 Haftungsausschluss</b><br>
                            
                                Der Frachtführer ist von seiner Haftung befreit, wenn Verlust oder
                                Beschädigung durch ein Verschulden des Auftraggebers, eine von
                                ihm ohne Zutun des Frachtführers erteilte Weisung, eigene Mängel
                                des Umzugsgutes oder durch Umstände verursacht wurde, auf
                                welche der Unternehmer keinen Einfluss hat.<br>
    
                                Bei Bruch oder Beschädigung besonders gefahrdeter Sachen wie
                                Marmor, Glas- und Porzellanplatten, Stuckrahmen, Leuchter,
                                Lampenschirme, Radio- und Fernsehgeräte, Computer-Hard- und
                                Software sowie Datenverlusten und anderen Gegenständen von
                                grosser Empfindlichkeit (Pflanzen, Tiere etc.), ist der Frachtführer
                                von der Haftung befreit, vorausgesetzt, dass er die üblichen
                                Vorsichtsmassnahmen angewandt hat.<br>
    
                                Bargeld und Werttitel sind von der Haftung ausgeschlossen (Art. 5
                                Abs. 7 oben). FürKostbarkeiten wieSchmuck, Dokumente, Kunstgegenstände, Antiquitäten, Sammlerobjekte übernimmt der
                                Frachtführer keine Haftung.<br>
    
                                Wird dem Frachtführer ein Verzeichnis solcher Gegenstände mit
                                detaillierter Wertangabe übergeben und anhand dieser Unterlagen
                                eine Transportversicherung abgeschlossen, so geniesst der Auftraggeber diesen Versicherungsschutz.<br>
    
                                Der Frachtführer haftet nicht für Beschädigungen der Güter
                                während des Be- und Entladens oder Ab- und Aufseilens, wenn
                                ihre Grösse oderSchwere den Raumverhältnissen an derBe- oder
                                Entladestelle nicht entspricht, der Frachtführer den Auftraggeber
                                oder Empfänger vorher darauf hingewiesen, der Auftraggeber aber
                                auf Durchführung der Leistung bestanden hat oder für
                                Beschädigungen an Wänden, Fenstern, Böden oder Stiegengelander, wenn dieGrösse oderSchwere der zutransportierenden
                                Güter dem Raumverhältnis nichtentsprechen<br>
    
                                Der Frachtführer haftet nicht für Schäden am Frachtgut, die durch
                                Feuer, Unfälle, Kriege, Streiks, höhere Gewalt oder einen dem
                                Transportmittel durch Dritte verursachten Schaden entstehen<br>
    
    
                                Wird die Beladung oder Ablieferung wegen Panne, Unfall,
                                Witterungseinflüssen oder aus anderen Gründen, für welche den
                                Frachtführer keine Schuld trifft, verzögert, hat der Auftraggeber
                                keinerlei Anspruch auf irgendwelche Entschädigung.<br>
    
    
                                Ohne gegenseitige Vereinbarung ist der Frachtführer für Verzögerungen, die durch nicht rechtzeitige Bereitstellung von
                                Transportmitteln oder durch Nichteinhaltung der reglementarischen Fristen durch andere am Transport beteiligte Transportanstalten entstehen, nicht haftbar. Die dadurch entstandenen
                                Kosten (Standgelder, Zwischenlagerungen usw.) gehen zulasten
                                des Auftraggebers. Auch haftet der Frachtführer nicht für Schäden
                                und Verluste, die aus solchen Umständen entstehen können<br>
                           
    
    
                            <b >Art. 12 Transportversicherung</b><br>
                            
                                Zur Deckung der Transportrisiken lässt der Frachtführer den
                            Auftraggeber auf dessen ausdrückliche Weisung und gegen Bezahlung der Mehrkosten an einer entsprechenden Versicherung
                            teilhaben<br><br>
    
    
                            Eine Versicherung des Bruchrisikos setzt voraus, dass die
                            betreffenden Gegenstände vom Frachtführer oder seinen
                            Beauftragten ein- und ausgepackt werden. Die Versicherungssummen sind durch denAuftraggeber festzusetzen. DieVersicherung gilt in jedem Fall zu den üblichen Klauseln der in der Schweiz
                            jeweils angewandten „Allgemeinen Bedingungen für dieVersicherung vonGütertransporten“(ABVT)für gebrauchtes Umzugsgut.<br><br>
                            
                            Lässt der Auftraggeber keine Versicherung abschliessen, so trägt
                            er selbst alle Risiken, für die der Frachtführer nach dem Wortlaut
                            dieser Bedingungen nicht haftet.<br><br>
                            
    
                            <b>Art. 13 Mängelrüge</b><br>
                            
                                Der Auftraggeber hat das Frachtgut sofort nach Auslad zu prüfen.
                            Reklamationen wegen Verlust oder Beschädigung sind sofort bei
                            Ablieferung des Transportgutes anzubringen und überdies dem
                            Frachtführer innerhalb von drei Tagen schriftlich zu bestätigen.
                            Äusserlich nicht sofort erkennbareSchädensind dem Frachtführer
                            innerhalb von drei Tagen seit Erbringen der Dienstleistung
                            schriftlich anzuzeigen.<br><br>
    
                            Nach Ablauf dieser Fristen können keine Reklamationen mehr
                            berücksichtigt werden.<br><br>
    
                            
                            <b>Art. 14 Gerichtsstand und anwendbares Recht</b><br>
                            
                                Für die Beurteilung von strittigen Ansprüchen für die nicht
                            dem üblichen Gebrauch bzw. nicht den persönlichen oder
                            familiären Bedürfnissen dienenden Dienstleistungen sind die
                            Gerichte am Sitz des Frachtführers zuständig.
                            Es gilt schweizerisches Recht.<br><br>
                            
    
                        </td>
                    </tr>
                    
                </table>
            </div> --}}
        </div>
    </main>
</body>
</html>