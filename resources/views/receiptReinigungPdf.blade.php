<!DOCTYPE html>
<html>
<head>
    <title>Quittung - Reinigung {{ $receipt['id'] }}(PDF) </title>
    <meta charset="UTF-8">
    <style>
        *{ font-family: Arial, Helvetica, sans-serif !important;
            font-size:12px; 
            line-height: 12px;
            }
            @page {
                margin: 100px 70px;
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
            .pagenum:before {
            content: counter(page);
            }
    </style>
    @include('bootstrap')
    
</head>
<body> 
    <header>
        <header >
            <table style="width: 100%;">
                <tr  style="padding-top:0px;width: 100%;" >
                    <td align="left" >
                        <a href="https://www.swisstransport.ch/" target="_blank"><img style="padding:0px;" src="{{ asset('assets/demo/swiss-logo.png') }}" width="300" /></a>
                    </td>
                </tr>
            </table>
        </header>
    </header>
    <footer>
        <p style="font-size:9px;">Swiss Transport AG | Wehntalerstrasse 190 | CH-8105 Regensdorf | Telefon: 044 731 96 58 | info@swisstransport.ch | www.swisstransport.ch</p>
    </footer>
    <main>
        <div class="teklif-boyutu">
            <table border="0" style="width:100%;" >
    
                <tr style="width: 100%;margin-top:20px;">
                    <td colspan="4" align="left"><h1><b style="font-size:18px;">Quittung / Rechnung</b></h1></td>
                </tr>
    
                <tr style="width:100%;margin-top:20px;">
                    <td valign="top" style="padding-top:20px;">
                        <b>Auftraggeber:</b><br>
                        {{ $receipt['customerGender'] }} <br>
                        {{ $receipt['customerName'] }} <br>
                        {{ $receipt['customerStreet'] }} <br>
                        {{ $receipt['customerAddress'] }} <br>
                        {{ $receipt['customerPhone'] }} <br>
                    </td>
                    <td valign="top" style="padding-top:20px;">
                        <b>Reinigungsadresse:</b><br>
                        {{ $receipt['reinigungStreet'] }}<br>
                        {{ $receipt['reinigungAddress'] }}<br>
                    </td>
                    <td valign="top" style="padding-top:20px;">
                        <b>Reinigungstermin:</b><br>
                        @if($receipt['reinigungDate'])
                        {{ date('d.m.Y', strtotime($receipt['reinigungDate'])) }},
                        @endif
                        @if($receipt['reinigungTime']) {{ date('H:i', strtotime($receipt['reinigungTime'])) }} Uhr @endif
                        
                    </td>
                    <td valign="top" style="padding-top:20px;">
                        <b>Abgabetermin:</b><br>
                        @if($receipt['endDate'])
                        {{ date('d.m.Y', strtotime($receipt['endDate'])) }},
                        @endif
                        @if($receipt['endTime']) {{ date('H:i', strtotime($receipt['endTime'])) }} Uhr @endif
                    </td>
                </tr>
            </table>
    
            <div style="border:1px solid black;margin-top:20px;">
                <table  style="padding:10px;width:100%;">
    
                    {{-- Reinigung --}}
                    <tr valign="top" style="width: 100%;">
                        <td>
                            <b>{{ $receipt['reinigungType'] }} </b>
                        </td>
                        <td colspan="2" align="left">
                            
                        </td>
                        <td>
                            {{ $receipt['reinigungExtraText'] }} 
                        </td>
                    </tr> <br>
    
                    @if($receipt['extraReinigung']) 
                        <tr valign="top" style="width: 100%;">
                            <td>
                                Leistungen:
                            </td>
                            <td colspan="2">
                                {{ $receipt['extraReinigung'] }}
                            </td>
                            <td></td>
                        </tr>
                    @endif
    
                    @if($receipt['fixedPrice']) 
                        <tr valign="top" style="width: 100%;">
                            <td>
                                Preis:
                            </td>
                            <td colspan="2">
                                
                            </td>
                            <td>CHF {{ $receipt['fixedPrice'] }}</td>
                        </tr>
    
                        @else
    
                        <tr valign="top" style="width: 100%;">
                            <td>
                                Aufwand:
                            </td>
                            <td colspan="2">
                                @if ( $receipt['reinigungHours'] ) {{ $receipt['reinigungHours'] }} @else _____ @endif h â
                                @if ( $receipt['reinigungChf'] ) CHF {{ $receipt['reinigungChf'] }} @else CHF_______ @endif
                            </td>
                            <td>@if ( $receipt['reinigungPrice'] ) CHF {{ $receipt['reinigungPrice'] }} @else CHF_______ @endif</td>
                        </tr> <br>
                    @endif
                    
                    {{-- Ekstralar --}}
                    <tr valign="top" style="width:100%;margin-top:20px;">
                        <td>Zuschläge:</td>
                        <td colspan="2">
                            @if ( $receiptExtra['extra1Text'] ) {{ $receiptExtra['extra1Text'] }} @else ______________________ @endif<br><br>
                            @if ( $receiptExtra['extra2Text'] ) {{ $receiptExtra['extra2Text'] }} @else ______________________ @endif<br><br>
                            @if ( $receiptExtra['extra3Text'] ) {{ $receiptExtra['extra3Text'] }} @else ______________________ @endif<br><br>
                            @if ( $receiptExtra['extra4Text'] ) {{ $receiptExtra['extra4Text'] }} @else ______________________ @endif<br><br>
                            @if ( $receiptExtra['extra5Text'] ) {{ $receiptExtra['extra5Text'] }} @else ______________________ @endif<br><br>
                            @if ( $receiptExtra['extra6Text'] ) {{ $receiptExtra['extra6Text'] }} @else ______________________ @endif<br><br>
                            @if ( $receiptExtra['extra7Text'] ) {{ $receiptExtra['extra7Text'] }} @else ______________________ @endif<br><br>
                        </td>
                        <td>
                            @if ( $receiptExtra['extra1'] ) CHF {{ $receiptExtra['extra1'] }} @else CHF_______ @endif <br><br>
                            @if ( $receiptExtra['extra2'] ) CHF {{ $receiptExtra['extra2'] }} @else CHF_______ @endif <br><br>
                            @if ( $receiptExtra['extra3'] ) CHF {{ $receiptExtra['extra3'] }} @else CHF_______ @endif <br><br>
                            @if ( $receiptExtra['extra4'] ) CHF {{ $receiptExtra['extra4'] }} @else CHF_______ @endif <br><br>
                            @if ( $receiptExtra['extra5'] ) CHF {{ $receiptExtra['extra5'] }} @else CHF_______ @endif <br><br>
                            @if ( $receiptExtra['extra6'] ) CHF {{ $receiptExtra['extra6'] }} @else CHF_______ @endif <br><br>
                            @if ( $receiptExtra['extra7'] ) CHF {{ $receiptExtra['extra7'] }} @else CHF_______ @endif <br><br>
                        </td>
                    </tr>
    
                    {{-- Discountlar --}}
                    <tr valign="top" style="width:100%;margin-top:20px;">
                        <td >Abzüge:</td>
                        <td colspan="2">
                            @if ( $receiptDiscount['discount1Text'] ) {{ $receiptDiscount['discount1Text'] }} @else ______________________ @endif<br><br>
                            @if ( $receiptDiscount['discount2Text'] ) {{ $receiptDiscount['discount2Text'] }} @else ______________________ @endif<br><br>
                            @if ( $receiptDiscount['discount3Text'] ) {{ $receiptDiscount['discount3Text'] }} @else ______________________ @endif<br><br>
                        </td>
                        <td >
                            @if ( $receiptDiscount['discount1'] ) CHF {{ $receiptDiscount['discount1'] }} @else CHF_______ @endif <br><br>
                            @if ( $receiptDiscount['discount2'] ) CHF {{ $receiptDiscount['discount2'] }} @else CHF_______ @endif <br><br>
                            @if ( $receiptDiscount['discount3'] ) CHF {{ $receiptDiscount['discount3'] }} @else CHF_______ @endif <br><br>
                        </td>
                    </tr>
                    
                    @if ( $receipt['withTax'] )
                    <tr valign="top" style="width:100%;margin-top:20px;">
                        <td ></td>
                        <td colspan="2">
                             7.7% MwSt <br><br>
                        </td>
                        <td >
                            CHF_____<br><br>
                        </td>
                    </tr>
                    @endif
    
                    <tr valign="top" style="width:100%;margin-top:20px;">
                        <td ><b>Total Kosten:</b></td>
                        <td colspan="2"></td>
                        <td>
                            <b>CHF {{ $receipt['totalPrice'] }}</b><br><br>
                        </td>
                    </tr>
                    {{-- <tr valign="top" style="width:100%;margin-top:20px;">
                        <td style="font-size:8px;">Alle Kosten sind inkl. MwSt.</td>
                        <td colspan="2" style="font-size:8px;">
                            MwSt.-Nummer: CHE-100.582.488
                        </td>
                        <td></td>
                    </tr> --}}
                </table>
            </div>
    
            @if($receipt['inBar'] || $receipt['inRechnung'])
                <div style="margin-top:20px;">
                    <b>Zahlung: @if ($receipt['inBar']) Bar @elseif($receipt['inRechnung']) Rechnung @elseif($receipt['inBar'] && $receipt['inRechnung']) Bar & Rechnung @endif</b><br><br>
                    Der Auftragsgeber bestätigt die korrekte Auftragsausführung und akzeptiert die ausgewiesenen Leistungen. Der  <br>
                    Kunde ist verpflichtet, direkt nach dem Abladen am Bestimmungsort das Umzugsgut zu überprüfen. Schäden und<br>
                    Reklamationen sind sofort dem Teamleiter mitzuteilen.
                </div>
            @endif
            <table align="center" style="width: 100%;margin-top:20px;">
                <tr valign="top" style="width:100%;padding-left:5px;">
                    <td align="left"><b>Ort/Datum</b></td>
                    <td align="left" colspan="2"><b>{{ App\Models\Company::InfoCompany('name') }}</b></td>
                    <td align="left"><b>{{ $receipt['signerName'] }}</b></td>
                </tr>
                <tr style="width:100%;margin-top:30px;padding-left:5px;">
                    <td align="left" style="padding-top: 50px;">________________</td>
                    <td align="left" colspan="2" style="padding-top: 50px;">________________</td>
                    <td align="left" style="padding-top: 50px;">________________</td>
                </tr>
            </table>
        </div>
    </main>
</body>
</html>