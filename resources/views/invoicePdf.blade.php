<!DOCTYPE html>
<html>
<head>
    <title>Rechnung - {{ $invoiceNumber }}</title>
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
                                Rechnung: 
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
        <p style="font-size:9px;">Swiss Transport GmbH | Trockenloostrasse 37 | CH-8105 Regensdorf | Telefon: 044 731 96 59 | info@swisstransport.ch | www.swisstransport.ch | CHE-478.905.969</p>
    </footer>
    <main>
        <div class="teklif-boyutu">
            <table border="0" style="width:100%;page-break-after: always;" >
    
                <tr style="width:100%;">
                    <td colspan="4" class="py-1 " style="background-color:#E5E5E5;">
                        <b style="font-size:13px;">Rechnung {{ $invoice['id'] }} vom {{ date('d.m.Y', strtotime($invoice['created_at'])); }} für Herr {{ $customer['name'] }} {{ $customer['surname'] }}</b>
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
                        {{ $invoice['street'] }} {{ $invoice['plz'] }}<br>
                        {{ $invoice['ort'] }} {{ $invoice['land'] }} <br>
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

                {{-- Umzug Alanı --}}
                @if ($isUmzug) 
                    <tr style="width: 100%">
                        <td valign="top" style="padding-top:5px;">
                            <b>Umzug</b>
                        </td>
                        <td valign="top" style="padding-top:5px;">
                            {{ $umzug['umzugDate'] }}
                        </td>
                        <td colspan="2">
                            <table style="width: 100%">
                                <tr style="width:100%;">
                                    <td>{{ $umzug['umzugHour'] }} Std. à {{ $umzug['umzugChf'] }}</td>
                                    <td style="padding-left:10px;"> {{ $umzug['umzugHour']*$umzug['umzugChf'] }} CHF</td>
                                </tr>
    
                                @if($umzug['umzugHour2'])
                                <tr style="width:100%;">
                                    <td>{{ $umzug['umzugHour2'] }} Std. à {{ $umzug['umzugChf2'] }}</td>
                                    <td style="padding-left:10px;"> {{ $umzug['umzugHour2']*$umzug['umzugChf2'] }} CHF</td>
                                </tr>
                                @endif
    
                                <tr style="width:100%;">
                                    <td>Anfahrt/Rückfahrt</td>
                                    <td style="padding-left:10px;"> {{ $umzug['umzugRoadChf'] }} CHF</td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                
    
                                @if($umzug['extra1'])<tr style="width:100%;"><td>Masraflar</td><td style="padding-left:10px;"> {{ $umzug['extra1'] }} CHF</td></tr>@endif
                                @if($umzug['extra2'])<tr style="width:100%;"><td>piyano 250</td><td style="padding-left:10px;"> {{ $umzug['extra2'] }} CHF</td></tr>@endif
                                @if($umzug['extra3'])<tr style="width:100%;"><td>piyano 350</td><td style="padding-left:10px;"> {{ $umzug['extra3'] }} CHF</td></tr>@endif
                                @if($umzug['extra4'])<tr style="width:100%;"><td>Mobilya asansörü 0</td><td style="padding-left:10px;"> {{ $umzug['extra4'] }} CHF</td></tr>@endif
                                @if($umzug['extra5'])<tr style="width:100%;"><td>mobilya asansörü 250</td><td style="padding-left:10px;"> {{ $umzug['extra5'] }} CHF</td></tr>@endif
                                @if($umzug['extra6'])<tr style="width:100%;"><td>mobilya asansörü 350</td><td style="padding-left:10px;"> {{ $umzug['extra6'] }} CHF</td></tr>@endif
                                @if($umzug['extra7'])<tr style="width:100%;"><td>Ağır mal ek ücreti 150</td><td style="padding-left:10px;"> {{ $umzug['extra7'] }} CHF</td></tr>@endif
                                @if($umzug['extra8'])<tr style="width:100%;"><td>Ağır mal ek ücreti 250</td><td style="padding-left:10px;"> {{ $umzug['extra8'] }} CHF</td></tr>@endif
                                @if($umzug['extra9'])<tr style="width:100%;"><td>Güvenli 350</td><td style="padding-left:10px;"> {{ $umzug['extra9'] }} CHF</td></tr>@endif
                                @if($umzug['extra10'])<tr style="width:100%;"><td>Güvenli 450</td><td style="padding-left:10px;"> {{ $umzug['extra10'] }} CHF</td></tr>@endif
                                @if($umzug['extra11'])<tr style="width:100%;"><td>Su Yatağı</td><td style="padding-left:10px;"> {{ $umzug['extra11'] }} CHF</td></tr>@endif
                                @if($umzug['extraValue1'])<tr style="width:100%;"><td>@if ( $umzug['extraText1']) {{  $umzug['extraText1'] }} @else Ek Masraf 1 @endif</td><td style="padding-left:10px;"> {{ $umzug['extraValue1'] }} CHF</td></tr>@endif
                                @if($umzug['extraValue2'])<tr style="width:100%;"><td>@if ( $umzug['extraText2']) {{  $umzug['extraText2'] }} @else Ek Masraf 2 @endif</td><td style="padding-left:10px;"> {{ $umzug['extraValue2'] }} CHF</td></tr>@endif
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                @if($umzug['discount'])<tr style="width:100%;"><td>Rabatt</td><td style="padding-left:10px;">-{{ $umzug['discount'] }} CHF</td></tr>@endif
                                @if($umzug['discount2'])<tr style="width:100%;"><td>Rabatt 2</td><td style="padding-left:10px;">-{{ $umzug['discount2'] }} CHF</td></tr>@endif
                                @if($umzug['extraDiscountValue1'])<tr style="width:100%;"><td>@if ( $umzug['extraDiscountText1']) {{  $umzug['extraDiscountText1'] }} @else Ek İndirim 1 @endif</td><td style="padding-left:10px;">-{{ $umzug['extraDiscountValue1'] }} CHF</td></tr>@endif
                                @if($umzug['extraDiscountValue2'])<tr style="width:100%;"><td>@if ( $umzug['extraDiscountText2']) {{  $umzug['extraDiscountText2'] }} @else Ek İndirim 2 @endif</td><td style="padding-left:10px;">-{{ $umzug['extraDiscountValue2'] }} CHF</td></tr>@endif
    
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                               
    
                                @if($umzug['umzugFixedCost'])
                                <tr style="width:100%;">
                                    <td><b>Pauschalpreis</b></td>
                                    <td style="padding-left:10px;"> {{ $umzug['umzugFixedCost']}} CHF</td>
                                </tr>
                                @endif
    
                                <tr style="width:100%;">
                                    <td>Schadenzahlung</td>
                                    <td style="padding-left:10px;">-{{ $umzug['umzugPaid1']}} CHF</td>
                                </tr style="width:100%;">
                                <tr style="width:100%;">
                                    <td>Anzahlung</td>
                                    <td style="padding-left:10px;">-{{ $umzug['umzugPaid2']}} CHF</td>
                                </tr style="width:100%;">
                                <tr style="width:100%;">
                                    <td>Bar Bezahlt</td>
                                    <td style="padding-left:10px;">-{{ $umzug['umzugPaid3']}} CHF</td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td><b>Kosten</b></td>
                                    <td style="padding-left:10px;"> <span style="color:#835AB1;"><b>{{ $umzug['umzugTotalPrice'] }} CHF</b></span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endif
    
                {{-- Einpack Alanı --}}
                @if ($isEinpack) 
                    <tr style="width:100%;">
                        <td valign="top" style="padding-top:15px;">
                            <b>Einpack</b>
                        </td>
                        <td valign="top" style="padding-top:15px;">
                            {{ $einpack['einpackDate'] }}
                        </td>
                        <td colspan="2" style="padding-top:15px;">
                            <table style="width:100%;">
                                <tr style="width:100%;">
                                    <td>{{ $einpack['einpackHour'] }} Std. à {{ $einpack['einpackChf'] }}</td>
                                    <td  style="padding-left:10px;"> {{ $einpack['einpackHour']*$einpack['einpackChf'] }} CHF</td>
                                </tr>
    
                                @if($einpack['einpackHour2'])
                                <tr style="width:100%;">
                                    <td>{{ $einpack['einpackHour2'] }} Std. à {{ $einpack['einpackChf2'] }}</td>
                                    <td style="padding-left:10px;"> {{ $einpack['einpackHour2']*$einpack['einpackChf2'] }} CHF</td>
                                </tr>
                                @endif
    
                                <tr style="width:100%;">
                                    <td>Anfahrt/Rückfahrt</td>
                                    <td style="padding-left:10px;"> {{ $einpack['einpackRoadChf'] }} CHF</td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                @if($einpack['extra1'])<tr style="width:100%;"><td>Masraflar</td><td style="padding-left:10px;"> {{ $einpack['extra1'] }} CHF</td></tr>@endif
                                @if($einpack['extra2'])<tr style="width:100%;"><td>piyano 250</td><td style="padding-left:10px;"> {{ $einpack['extra2'] }} CHF</td></tr>@endif
                                @if($einpack['extraValue1'])<tr style="width:100%;"><td>@if ( $einpack['extraText1']) {{  $einpack['extraText1'] }} @else Ek Masraf 1 @endif</td><td style="padding-left:10px;"> {{ $einpack['extraValue1'] }} CHF</td></tr>@endif
                                @if($einpack['extraValue2'])<tr style="width:100%;"><td>@if ( $einpack['extraText2']) {{  $einpack['extraText2'] }} @else Ek Masraf 2 @endif</td><td style="padding-left:10px;"> {{ $einpack['extraValue2'] }} CHF</td></tr>@endif
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                @if($einpack['discount'])<tr style="width:100%;"><td>Rabatt</td><td style="padding-left:10px;">-{{ $einpack['discount'] }} CHF </td></tr>@endif
                                @if($einpack['discount2'])<tr style="width:100%;"><td>Rabatt 2</td><td style="padding-left:10px;">-{{ $einpack['discount2'] }} CHF </td></tr>@endif
                                @if($einpack['extraDiscountValue1'])<tr style="width:100%;"><td>@if ( $einpack['extraDiscountText1']) {{  $einpack['extraDiscountText1'] }} @else Ek İndirim 1 @endif</td><td style="padding-left:10px;">-{{ $einpack['extraDiscountValue1'] }} CHF</td></tr>@endif
                                @if($einpack['extraDiscountValue2'])<tr style="width:100%;"><td>@if ( $einpack['extraDiscountText2']) {{  $einpack['extraDiscountText2'] }} @else Ek İndirim 2 @endif</td><td style="padding-left:10px;">-{{ $einpack['extraDiscountValue2'] }} CHF</td></tr>@endif
    
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                               
    
                                @if($einpack['einpackFixedCost'])
                                <tr style="width:100%;">
                                    <td><b>Pauschalpreis</b></td>
                                    <td style="padding-left:10px;">{{ $einpack['einpackFixedCost']}} CHF</td>
                                </tr>
                                @endif
    
                                <tr style="width:100%;">
                                    <td>Schadenzahlung</td>
                                    <td style="padding-left:10px;">-{{ $einpack['einpackPaid1']}} CHF</td>
                                </tr>
                                <tr style="width:100%;">
                                    <td>Anzahlung</td>
                                    <td style="padding-left:10px;">-{{ $einpack['einpackPaid2']}} CHF</td>
                                </tr>
                                <tr style="width:100%;">
                                    <td>Bar Bezahlt</td>
                                    <td style="padding-left:10px;">-{{ $einpack['einpackPaid3']}} CHF</td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td><b>Kosten</b></td>
                                    <td style="padding-left:10px;"><span style="color:#835AB1;"><b>{{ $einpack['einpackTotalPrice'] }} CHF</b></span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endif
    
                {{-- Auspack Alanı --}}
                @if ($isAuspack) 
                    <tr style="width:100%;">
                        <td valign="top" style="padding-top:15px;">
                            <b>Auspack</b>
                        </td>
                        <td valign="top" style="padding-top:15px;">
                            {{ $auspack['auspackDate'] }}
                        </td>
                        <td colspan="2" style="padding-top:15px;">
                            <table style="width:100%;">
                                <tr style="width:100%;">
                                    <td>{{ $auspack['auspackHour'] }} Std. à {{ $auspack['auspackChf'] }}</td>
                                    <td style="padding-left:10px;">{{ $auspack['auspackHour']*$auspack['auspackChf'] }} CHF </td>
                                </tr>
    
                                @if($auspack['auspackHour2'])
                                <tr style="width:100%;">
                                    <td>{{ $auspack['auspackHour2'] }} Std. à {{ $auspack['auspackChf2'] }}</td>
                                    <td style="padding-left:10px;">{{ $auspack['auspackHour2']*$auspack['auspackChf2'] }} CHF </td>
                                </tr>
                                @endif
    
                                <tr style="width:100%;">
                                    <td>Anfahrt/Rückfahrt</td>
                                    <td style="padding-left:10px;"> {{ $auspack['auspackRoadChf'] }} CHF</td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                @if($auspack['extra1'])<tr style="width:100%;"><td>Masraflar</td><td style="padding-left:10px;">{{ $auspack['extra1'] }} CHF</td></tr>@endif
                                @if($auspack['extra2'])<tr style="width:100%;"><td>piyano 250</td><td style="padding-left:10px;">{{ $auspack['extra2'] }} CHF</td></tr>@endif
                                @if($auspack['extraValue1'])<tr style="width:100%;"><td>@if ( $auspack['extraText1']) {{  $auspack['extraText1'] }} @else Ek Masraf 1 @endif</td><td style="padding-left:10px;">{{ $auspack['extraValue1'] }} CHF </td></tr>@endif
                                @if($auspack['extraValue2'])<tr style="width:100%;"><td>@if ( $auspack['extraText2']) {{  $auspack['extraText2'] }} @else Ek Masraf 2 @endif</td><td style="padding-left:10px;">{{ $auspack['extraValue2'] }} CHF </td></tr>@endif
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                @if($auspack['discount'])<tr style="width:100%;"><td>Rabatt</td><td style="padding-left:10px;">-{{ $auspack['discount'] }} CHF </td></tr>@endif
                                @if($auspack['discount2'])<tr style="width:100%;"><td>Rabatt 2</td><td style="padding-left:10px;">-{{ $auspack['discount2'] }} CHF </td></tr>@endif
                                @if($auspack['extraDiscountValue1'])<tr style="width:100%;"><td>@if ( $auspack['extraDiscountText1']) {{  $auspack['extraDiscountText1'] }} @else Ek İndirim 1 @endif</td><td style="padding-left:10px;">-{{ $auspack['extraDiscountValue1'] }} CHF </td></tr>@endif
                                @if($auspack['extraDiscountValue2'])<tr style="width:100%;"><td>@if ( $auspack['extraDiscountText2']) {{  $auspack['extraDiscountText2'] }} @else Ek İndirim 2 @endif</td><td style="padding-left:10px;">-{{ $auspack['extraDiscountValue2'] }} CHF </td></tr>@endif
    
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                
    
                                @if($auspack['auspackFixedCost'])
                                <tr style="width:100%;">
                                    <td><b>Pauschalpreis</b></td>
                                    <td style="padding-left:10px;"> {{ $auspack['auspackFixedCost']}} CHF</td>
                                </tr>
                                @endif
    
                                <tr style="width:100%;">
                                    <td>Schadenzahlung</td>
                                    <td style="padding-left:10px;">-{{ $auspack['auspackPaid1']}} CHF</td>
                                </tr>
                                <tr style="width:100%;">
                                    <td>Anzahlung</td>
                                    <td style="padding-left:10px;">-{{ $auspack['auspackPaid2']}} CHF</td>
                                </tr>
                                <tr style="width:100%;">
                                    <td>Bar Bezahlt</td>
                                    <td style="padding-left:10px;">-{{ $auspack['auspackPaid3']}} CHF</td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td><b>Kosten</b></td>
                                    <td style="padding-left:10px;"><span style="color:#835AB1;"><b>{{ $auspack['auspackTotalPrice'] }} CHF</b> </span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endif
    
                {{-- Reinigung Alanı --}}
                @if ($isReinigung) 
                    <tr style="width:100%;">
                        <td valign="top" style="padding-top:15px;">
                            <b>Reinigung</b> <br>
                            @if($reinigung['extraReinigung']) (<i>{{ $reinigung['extraReinigung'] }}</i>) @endif
                        </td>
                        <td valign="top" style="padding-top:15px;">
                            {{ $reinigung['reinigungDate'] }}
                        </td>
                        <td colspan="2" style="padding-top:15px;">
                            <table style="width:100%;">
                                <tr style="width:100%;">
                                    @if ($reinigung['reinigungFixedPrice'])
                                        <td>{{ $reinigung['reinigungRoom'] }} ({{ $reinigung['reinigungType'] }})</td>
                                        <td style="padding-left:10px;"> {{ $reinigung['reinigungFixedPrice'] }} CHF</td>
                                        @else
                                        <td>{{ $reinigung['reinigungHours'] }} Std. à {{ $reinigung['reinigungChf'] }}</td>
                                        <td style="padding-left:10px;">{{ $reinigung['reinigungHours']*$reinigung['reinigungChf'] }} CHF</td>
                                    @endif
                                </tr>
    
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                @if($reinigung['extra1'])<tr style="width:100%;"><td>Yüksek basınçlı temizleyici</td><td style="padding-left:10px;"> {{ $reinigung['extra1'] }} CHF</td></tr>@endif
                                @if($reinigung['extra2'])<tr style="width:100%;"><td>Taş ve parke zeminler</td><td style="padding-left:10px;"> {{ $reinigung['extra2'] }} CHF</td></tr>@endif
                                @if($reinigung['extra2'])<tr style="width:100%;"><td>halı yıkama</td><td style="padding-left:10px;"> {{ $reinigung['extra2'] }} CHF</td></tr>@endif
                                @if($reinigung['extraValue1'])<tr style="width:100%;"><td>@if ( $reinigung['extraText1']) {{  $reinigung['extraText1'] }} @else Ek Masraf 1 @endif</td><td style="padding-left:10px;"> {{ $reinigung['extraValue1'] }} CHF</td></tr>@endif
                                @if($reinigung['extraValue2'])<tr style="width:100%;"><td>@if ( $reinigung['extraText2']) {{  $reinigung['extraText2'] }} @else Ek Masraf 2 @endif</td><td style="padding-left:10px;"> {{ $reinigung['extraValue2'] }} CHF</td></tr>@endif
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                @if($reinigung['discount'])<tr style="width:100%;"><td>Rabatt</td><td style="padding-left:10px;">-{{ $reinigung['discount'] }}  CHF</td></tr>@endif
                                @if($reinigung['discount2'])<tr style="width:100%;"><td>Rabatt 2</td><td style="padding-left:10px;">-{{ $reinigung['discount2'] }}  CHF</td></tr>@endif
                                @if($reinigung['extraDiscountValue1'])<tr style="width:100%;"><td>@if ( $reinigung['extraDiscountText1']) {{  $reinigung['extraDiscountText1'] }} @else Ek İndirim 1 @endif</td><td style="padding-left:10px;">CHF - {{ $reinigung['extraDiscountValue1'] }}  CHF</td></tr>@endif
                                @if($reinigung['extraDiscountValue2'])<tr style="width:100%;"><td>@if ( $reinigung['extraDiscountText2']) {{  $reinigung['extraDiscountText2'] }} @else Ek İndirim 2 @endif</td><td style="padding-left:10px;">CHF - {{ $reinigung['extraDiscountValue2'] }}  CHF</td></tr>@endif
    
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td>Schadenzahlung</td>
                                    <td style="padding-left:10px;">-{{ $reinigung['reinigungPaid1']}}  CHF</td>
                                </tr>
                                <tr style="width:100%;">
                                    <td>Anzahlung</td>
                                    <td style="padding-left:10px;">-{{ $reinigung['reinigungPaid2']}}  CHF</td>
                                </tr>
                                <tr style="width:100%;">
                                    <td>Bar Bezahlt</td>
                                    <td style="padding-left:10px;">-{{ $reinigung['reinigungPaid3']}}  CHF</td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td><b>Kosten</b></td>
                                    <td style="padding-left:10px;"><span style="color:#835AB1;"><b>{{ $reinigung['reinigungTotalPrice'] }}  CHF</b></span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endif
    
                {{-- Reinigung 2 Alanı --}}
                @if ($isReinigung2) 
                    <tr style="width:100%;">
                        <td valign="top" style="padding-top:15px;">
                            <b>Reinigung 2</b> <br>
                            @if($reinigung2['extraReinigung']) (<i>{{ $reinigung2['extraReinigung'] }}</i>) @endif
                        </td>
                        <td valign="top" style="padding-top:15px;">
                            {{ $reinigung2['reinigungDate'] }}
                        </td>
                        <td colspan="2" style="padding-top:15px;">
                            <table style="width:100%;">
                                <tr style="width:100%;">
                                    @if ($reinigung2['reinigungFixedPrice'])
                                        <td>{{ $reinigung2['reinigungRoom'] }} ({{ $reinigung2['reinigungType'] }})</td>
                                        <td style="padding-left:10px;"> {{ $reinigung2['reinigungFixedPrice'] }} CHF</td>
                                        @else
                                        <td>{{ $reinigung2['reinigungHours'] }} Std. à {{ $reinigung2['reinigungChf'] }}</td>
                                        <td style="padding-left:10px;"> {{ $reinigung2['reinigungHours']*$reinigung2['reinigungChf'] }} CHF</td>
                                    @endif
                                </tr>
    
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                @if($reinigung2['extra1'])<tr style="width:100%;"><td>Yüksek basınçlı temizleyici</td><td style="padding-left:10px;"> {{ $reinigung2['extra1'] }} CHF</td></tr>@endif
                                @if($reinigung2['extra2'])<tr style="width:100%;"><td>Taş ve parke zeminler</td><td style="padding-left:10px;"> {{ $reinigung2['extra2'] }} CHF</td></tr>@endif
                                @if($reinigung2['extra2'])<tr style="width:100%;"><td>halı yıkama</td><td style="padding-left:10px;"> {{ $reinigung2['extra2'] }} CHF</td></tr>@endif
                                @if($reinigung2['extraValue1'])<tr style="width:100%;"><td>@if ( $reinigung2['extraText1']) {{  $reinigung2['extraText1'] }} @else Ek Masraf 1 @endif</td><td style="padding-left:10px;"> {{ $reinigung2['extraValue1'] }} CHF</td></tr>@endif
                                @if($reinigung2['extraValue2'])<tr style="width:100%;"><td>@if ( $reinigung2['extraText2']) {{  $reinigung2['extraText2'] }} @else Ek Masraf 2 @endif</td><td style="padding-left:10px;"> {{ $reinigung2['extraValue2'] }} CHF</td></tr>@endif
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                @if($reinigung2['discount'])<tr style="width:100%;"><td>Rabatt</td><td style="padding-left:10px;">-{{ $reinigung2['discount'] }} CHF</td></tr>@endif
                                @if($reinigung2['discount2'])<tr style="width:100%;"><td>Rabatt 2</td><td style="padding-left:10px;">-{{ $reinigung2['discount2'] }} CHF</td></tr>@endif
                                @if($reinigung2['extraDiscountValue1'])<tr style="width:100%;"><td>@if ( $reinigung2['extraDiscountText1']) {{  $reinigung2['extraDiscountText1'] }} @else Ek İndirim 1 @endif</td><td style="padding-left:10px;">-{{ $reinigung2['extraDiscountValue1'] }} CHF</td></tr>@endif
                                @if($reinigung2['extraDiscountValue2'])<tr style="width:100%;"><td>@if ( $reinigung2['extraDiscountText2']) {{  $reinigung2['extraDiscountText2'] }} @else Ek İndirim 2 @endif</td><td style="padding-left:10px;">-{{ $reinigung2['extraDiscountValue2'] }} CHF</td></tr>@endif
    
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td>Schadenzahlung</td>
                                    <td style="padding-left:10px;">-{{ $reinigung2['reinigungPaid1']}} CHF</td>
                                </tr>
                                <tr style="width:100%;">
                                    <td>Anzahlung</td>
                                    <td style="padding-left:10px;">-{{ $reinigung2['reinigungPaid2']}} CHF</td>
                                </tr>
                                <tr style="width:100%;">
                                    <td>Bar Bezahlt</td>
                                    <td style="padding-left:10px;">-{{ $reinigung2['reinigungPaid3']}} CHF</td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td><b>Kosten</b></td>
                                    <td style="padding-left:10px;"> <span style="color:#835AB1;"><b>{{ $reinigung2['reinigungTotalPrice'] }} CHF</b></span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endif
    
                {{-- Entsorgung Alanı --}}
                @if ($isEntsorgung) 
                    <tr style="width:100%;">
                        <td valign="top" style="padding-top:15px;">
                            <b>Entsorgung</b>
                        </td>
                        <td valign="top" style="padding-top:15px;">
                            {{ $entsorgung['entsorgungDate'] }}
                        </td>
                        <td colspan="2" style="padding-top:15px;">
                            <table style="width:100%;">
                                <tr style="width:100%;">
                                    <td>{{ $entsorgung['entsorgungHours'] }} Std. à {{ $entsorgung['entsorgungChf'] }}</td>
                                    <td style="padding-left:10px;"> {{ $entsorgung['entsorgungHours']*$entsorgung['entsorgungChf'] }} CHF</td>
                                </tr>
    
                                
                                <tr style="width:100%;">
                                    <td>{{ $entsorgung['entsorgungVolume'] }} m3 à {{ $entsorgung['entsorgungFixedChf'] }}</td>
                                    <td style="padding-left:10px;"> {{ $entsorgung['entsorgungVolume']*$entsorgung['entsorgungFixedChf'] }} CHF</td>
                                </tr>
                                
    
                                <tr style="width:100%;">
                                    <td>Anfahrt/Rückfahrt</td>
                                    <td style="padding-left:10px;"> {{ $entsorgung['entsorgungRoadChf'] }} CHF</td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                @if($entsorgung['extra1'])<tr style="width:100%;"><td>Masraflar</td><td style="padding-left:10px;"> {{ $entsorgung['extra1'] }} CHF</td></tr>@endif
                                @if($entsorgung['extraValue1'])<tr style="width:100%;"><td>@if ( $entsorgung['extraText1']) {{  $entsorgung['extraText1'] }} @else Ek Masraf 1 @endif</td><td style="padding-left:10px;"> {{ $entsorgung['extraValue1'] }} CHF</td></tr>@endif
                                @if($entsorgung['extraValue2'])<tr style="width:100%;"><td>@if ( $entsorgung['extraText2']) {{  $entsorgung['extraText2'] }} @else Ek Masraf 2 @endif</td><td style="padding-left:10px;"> {{ $entsorgung['extraValue2'] }} CHF</td></tr>@endif
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                @if($entsorgung['discount'])<tr style="width:100%;"><td>Rabatt</td><td style="padding-left:10px;">-{{ $entsorgung['discount'] }} CHF</td></tr>@endif
                                @if($entsorgung['discount2'])<tr style="width:100%;"><td>Rabatt 2</td><td style="padding-left:10px;">-{{ $entsorgung['discount2'] }} CHF</td></tr>@endif
                                @if($entsorgung['extraDiscountValue1'])<tr style="width:100%;"><td>@if ( $entsorgung['extraDiscountText1']) {{  $entsorgung['extraDiscountText1'] }} @else Ek İndirim 1 @endif</td><td style="padding-left:10px;">-{{ $entsorgung['extraDiscountValue1'] }} CHF</td></tr>@endif
                                @if($entsorgung['extraDiscountValue2'])<tr style="width:100%;"><td>@if ( $entsorgung['extraDiscountText2']) {{  $entsorgung['extraDiscountText2'] }} @else Ek İndirim 2 @endif</td><td style="padding-left:10px;">-{{ $entsorgung['extraDiscountValue2'] }} CHF</td></tr>@endif
    
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                
    
                                @if($entsorgung['entsorgungFixedCost'])
                                <tr style="width:100%;">
                                    <td><b>Pauschalpreis</b></td>
                                    <td style="padding-left:10px;"> {{ $entsorgung['entsorgungFixedCost']}} CHF</td>
                                </tr>
                                @endif
    
                                
                                <tr style="width:100%;">
                                    <td>Anzahlung</td>
                                    <td style="padding-left:10px;">-{{ $entsorgung['entsorgungPaid1']}} CHF</td>
                                </tr>
                                <tr style="width:100%;">
                                    <td>Bar Bezahlt</td>
                                    <td style="padding-left:10px;">-{{ $entsorgung['entsorgungPaid2']}} CHF</td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td><b>Kosten</b></td>
                                    <td style="padding-left:10px;"> <span style="color:#835AB1;"><b>{{ $entsorgung['entsorgungTotalPrice'] }} CHF</b></span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endif
    
    
                {{-- Transport Alanı --}}
                @if ($isTransport) 
                    <tr style="width:100%;">
                        <td valign="top" style="padding-top:15px;">
                            <b>Transport</b>
                        </td>
                        <td valign="top" style="padding-top:15px;">
                            {{ $transport['transportDate'] }}
                        </td>
                        <td colspan="2" style="padding-top:15px;">
                            <table style="width:100%;">
                                @if($transport['pdfText']) 
                                    <tr style="width:100%;">
                                        <td>{{ $transport['pdfText'] }}</td>
                                        <td style="padding-left:10px;"></td>
                                    </tr>
                                @endif
                               
                                @if($transport['transportFixedTariff'])
                                    <tr style="width:100%;">
                                        <td>{{ $transport['transportFixedTariff'] }} Std. à</td>
                                        <td style="padding-left:10px;"></td>
                                    </tr>
                                    @elseif($transport['transportHours2'])
                                    <tr style="width:100%;">
                                        <td>{{ $transport['transportHours'] }} Std. à {{ $transport['transportChf'] }}</td>
                                        <td style="padding-left:10px;"> {{ $transport['transportHours']*$transport['transportChf'] }} CHF</td>
                                    </tr>
    
                                    <tr style="width:100%;">
                                        <td>{{ $transport['transportHours2'] }} Std. à {{ $transport['transportChf2'] }}</td>
                                        <td style="padding-left:10px;"> {{ $transport['transportHours2']*$transport['transportChf2'] }} CHF</td>
                                    </tr>
                                    @else 
                                    <tr style="width:100%;">
                                        <td>{{ $transport['transportHours'] }} Std. à {{ $transport['transportChf'] }}</td>
                                        <td style="padding-left:10px;"> {{ $transport['transportHours']*$transport['transportChf'] }} CHF</td>
                                    </tr>
                                @endif
                                
                                <tr style="width:100%;">
                                    <td>Anfahrt/Rückfahrt</td>
                                    <td style="padding-left:10px;"> {{ $transport['transportRoadChf'] }} CHF</td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                @if($transport['extraValue1'])<tr style="width:100%;"><td>@if ( $transport['extraText1']) {{  $transport['extraText1'] }} @else Ek Masraf 1 @endif</td><td style="padding-left:10px;"> {{ $transport['extraValue1'] }} CHF</td></tr>@endif
                                @if($transport['extraValue2'])<tr style="width:100%;"><td>@if ( $transport['extraText2']) {{  $transport['extraText2'] }} @else Ek Masraf 2 @endif</td><td style="padding-left:10px;"> {{ $transport['extraValue2'] }} CHF</td></tr>@endif
                                @if($transport['extraValue3'])<tr style="width:100%;"><td>@if ( $transport['extraText3']) {{  $transport['extraText3'] }} @else Ek Masraf 3 @endif</td><td style="padding-left:10px;"> {{ $transport['extraValue3'] }} CHF</td></tr>@endif
                                @if($transport['extraValue4'])<tr style="width:100%;"><td>@if ( $transport['extraText4']) {{  $transport['extraText4'] }} @else Ek Masraf 4 @endif</td><td style="padding-left:10px;"> {{ $transport['extraValue4'] }} CHF</td></tr>@endif
                                @if($transport['extraValue5'])<tr style="width:100%;"><td>@if ( $transport['extraText5']) {{  $transport['extraText5'] }} @else Ek Masraf 5 @endif</td><td style="padding-left:10px;"> {{ $transport['extraValue5'] }} CHF</td></tr>@endif
                                @if($transport['extraValue6'])<tr style="width:100%;"><td>@if ( $transport['extraText6']) {{  $transport['extraText6'] }} @else Ek Masraf 6 @endif</td><td style="padding-left:10px;"> {{ $transport['extraValue6'] }} CHF</td></tr>@endif
                                @if($transport['extraValue7'])<tr style="width:100%;"><td>@if ( $transport['extraText7']) {{  $transport['extraText7'] }} @else Ek Masraf 7 @endif</td><td style="padding-left:10px;"> {{ $transport['extraValue7'] }} CHF</td></tr>@endif
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                @if($transport['discount'])<tr style="width:100%;"><td>Rabatt</td><td style="padding-left:10px;">-{{ $transport['discount'] }} CHF</td></tr>@endif
                                @if($transport['discount2'])<tr style="width:100%;"><td>Rabatt 2</td><td style="padding-left:10px;">-{{ $transport['discount2'] }} CHF</td></tr>@endif
                                @if($transport['extraDiscountValue1'])<tr style="width:100%;"><td>@if ( $transport['extraDiscountText1']) {{  $transport['extraDiscountText1'] }} @else Ek İndirim 1 @endif</td><td style="padding-left:10px;">-{{ $transport['extraDiscountValue1'] }} CHF</td></tr>@endif
                                @if($transport['extraDiscountValue2'])<tr style="width:100%;"><td>@if ( $transport['extraDiscountText2']) {{  $transport['extraDiscountText2'] }} @else Ek İndirim 2 @endif</td><td style="padding-left:10px;">-{{ $transport['extraDiscountValue2'] }} CHF</td></tr>@endif
    
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                @if($transport['transportFixedCost'])
                                <tr style="width:100%;">
                                    <td><b>Pauschalpreis</b></td>
                                    <td style="padding-left:10px;"> {{ $transport['transportFixedCost']}} CHF</td>
                                </tr>
                                @endif
    
                                <tr style="width:100%;">
                                    <td>Schadenzahlung</td>
                                    <td style="padding-left:10px;">-{{ $transport['transportPaid1']}} CHF</td>
                                </tr>
                                <tr style="width:100%;">
                                    <td>Anzahlung</td>
                                    <td style="padding-left:10px;">-{{ $transport['transportPaid2']}} CHF</td>
                                </tr>
                                <tr style="width:100%;">
                                    <td>Bar Bezahlt</td>
                                    <td style="padding-left:10px;">-{{ $transport['transportPaid3']}} CHF</td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td><b>Kosten</b></td>
                                    <td style="padding-left:10px;"> <span style="color:#835AB1;"><b>{{ $transport['transportTotalPrice'] }} CHF</b></span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endif
                
    
                {{-- Lagerung Alanı --}}
                @if ($isLagerung) 
                    <tr style="width: 100%">
                        <td colspan="2" valign="top" style="padding-top:15px;">
                            <b>Lagerung</b>
                        </td>
                        <td valign="top" style="padding-top:15px;">
                            {{ $lagerung['lagerungVolume'] }} m3 à {{ $lagerung['lagerungChf'] }} im Monat
                        </td>
                        <td valign="top" style="padding-top:15px;padding-left:40px;">
                            CHF {{ $lagerung['lagerungVolume']*$lagerung['lagerungChf'] }}
                        </td>
                        </tr>
                        <tr style="width:100%;">
                            <td valign="top" style="padding-top:15px;">
                                <b>Verrechnungsperiode</b>
                            </td>
                            <td valign="top" style="padding-top:15px;">
                                {{ $lagerung['lagerungStartDate'] }} - {{ $lagerung['lagerungEndDate'] }}
                            </td>
                            <td colspan="2" style="padding-top:15px;">
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
                                        <td><b>Kosten</b></td>
                                        <td style="padding-left:10px;"> <span style="color:#835AB1;"><b>{{ $lagerung['lagerungTotalPrice'] }} CHF</b></span></td>
                                    </tr>
                                </table>
                            </td>
                    </tr>
                @endif
    
                {{-- Material Alanı --}}
                @if ($isMaterial) 
                    <tr style="width:100%;">
                        <td colspan="2" valign="top" style="padding-top:15px;">
                            <b>Verpackungsmaterial</b>
                        </td>
                        <td colspan="2" style="padding-top:15px;">
                            <table style="width:100%;">
    
                                @if($material['discount'])<tr style="width:100%;"><td>Rabatt</td><td style="padding-left:10px;">-{{ $material['discount'] }} CHF</td></tr>@endif
                                @if($material['customDiscountValue'])<tr style="width:100%;"><td>@if ( $material['customDiscountText']) {{  $material['customDiscountText'] }} @else Ek İndirim @endif</td><td style="padding-left:10px;">-{{ $material['customDiscountValue'] }} CHF</td></tr>@endif
    
    
                                <tr style="width:100%;">
                                    <td>Deliver Price</td>
                                    <td style="padding-left:10px;"> {{ $material['deliverPrice']}} CHF</td>
                                </tr>
                                <tr style="width:100%;">
                                    <td>Recieve Price</td>
                                    <td style="padding-left:10px;"> {{ $material['recievePrice']}} CHF</td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td colspan="2" style="padding-top:5px;"></td>
                                </tr>
    
                                <tr style="width:100%;">
                                    <td><b>Kosten</b></td>
                                    <td style="padding-left:10px;"> <span style="color:#835AB1;"><b>{{ $material['totalPrice'] }} CHF</b></span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endif
    
    
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
                                <span>Swiss Transport GmbH</span><br>
                                <span>Trockenloostrasse 37</span><br>
                                <span>8105 Regensdorf</span><br>
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
                                            <span style="font-size:12px!important;line-height:10px;">Swiss Transport GmbH</span><br>
                                            <span style="font-size:12px!important;line-height:10px;">Trockenloostrasse 37</span><br>
                                            <span style="font-size:12px!important;line-height:10px;">8105 Regensdorf</span><br>
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