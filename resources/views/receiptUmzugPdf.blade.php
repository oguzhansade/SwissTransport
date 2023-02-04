<!DOCTYPE html>
<html>
<head>
    <title>Quittung - Umzug {{ $receipt['id'] }}(PDF) </title>
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
                    <td>
                        <table style="width: 100%;">
                            <tr style="width: 100%;">
                                <td align="left">
                                    Receipt: 
                                </td>
                                <td  align="left">
                                    {{ $receipt['id'] }}
                                </td>
                            </tr>
                            <tr  style="width: 100%;">
                                <td >Tarih:</td>
                                <td >{{ date('d.m.Y', strtotime($receipt['created_at'])); }}</td>
                            </tr>
                            <tr>
                                <td>Page</td>
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
    </header>
    <footer>
        <p style="font-size:9px;">Swiss Transport AG | Wehntalerstrasse 190 | CH-8105 Regensdorf | Telefon: 044 731 96 59 | info@swisstransport.ch | www.swisstransport.ch | CHE-478.905.969</p>
    </footer>
    <main>
        <div class="teklif-boyutu">
            <table border="0" style="width:100%;" >
    
                <tr style="width: 100%;margin-top:20px;">
                    <td colspan="4" align="left"><h1><b style="font-size:18px;">Quittung / Rechnung</b></h1></td>
                </tr>
    
                <tr style="width:100%;margin-top:20px;">
                    <td valign="top">
                        <b>Auftraggeber:</b><br>
                        {{ $receipt['customerGender'] }} <br>
                        {{ $receipt['customerName'] }} <br>
                        {{ $receipt['customerStreet'] }} <br>
                        {{ $receipt['customerAddress'] }} <br>
                        {{ $receipt['customerPhone'] }} <br>
                    </td>
                    <td valign="top">
                        <b>Auszugsadresse:</b><br>
                        @if($auszug1){{ $auszug1['line1'] }} @endif<br>
                        @if($auszug1){{ $auszug1['line2'] }} @endif<br>
                        @if($auszug2){{ $auszug2['line1'] }} @endif<br>
                        @if($auszug2){{ $auszug2['line2'] }} @endif<br>
                        @if($auszug3){{ $auszug3['line1'] }} @endif<br>
                        @if($auszug3){{ $auszug3['line2'] }} @endif<br>
                    </td>
                    <td valign="top">
                        <b>Einzugsadresse:</b><br>
                        @if($einzug1){{ $einzug1['line1'] }} @endif<br>
                        @if($einzug1){{ $einzug1['line2'] }} @endif<br>
                        @if($einzug2){{ $einzug2['line1'] }} @endif<br>
                        @if($einzug2){{ $einzug2['line2'] }} @endif<br>
                        @if($einzug3){{ $einzug3['line1'] }} @endif<br>
                        @if($einzug3){{ $einzug3['line2'] }} @endif<br>
                    </td>
                    <td valign="top">
                        <b>Auftragstermin:</b><br>
                        {{ $receipt['orderDate'] }}, {{ $receipt['orderTime'] }}
                    </td>
                </tr>
            </table>
    
            <div style="border:1px solid black;margin-top:20px;">
                <table  style="padding:10px;width:100%;">
    
                    {{-- Umzug --}}
                    <tr valign="top" style="width:100%;">
                        <td >Aufwand:</td>
                        <td colspan="2">
                            @if ( $receipt['umzugHour'] ) {{ $receipt['umzugHour'] }} @else _____ @endif h â
                            @if ( $receipt['umzugChf'] ) CHF {{ $receipt['umzugChf'] }} @else CHF_______ @endif <br>
                            Spesen <br>
                            Anfahrt / Rückfahrt <br>
                            Verpackungsmaterial <br>
                        </td>
                        <td>
                            @if ( $receipt['umzugTotalChf'] ) CHF {{ $receipt['umzugTotalChf'] }} @else CHF_______ @endif <br>
                            @if ( $receipt['umzugCharge'] ) CHF {{ $receipt['umzugCharge'] }} @else CHF_______ @endif<br>
                            @if ( $receipt['umzugRoadChf'] ) CHF {{ $receipt['umzugRoadChf'] }} @else CHF_______ @endif<br>
                            @if ( $receipt['materialPrice'] ) CHF {{ $receipt['materialPrice'] }} @else CHF_______ @endif<br>
                        </td>
                    </tr>
    
                    {{-- Entsorgung --}}
                    <tr valign="top" style="width:100%;margin-top:20px;">
                        <td >Entsorgung:</td>
                        <td colspan="2">
                            @if ( $receipt['entsorgungVolume'] ) {{ $receipt['entsorgungVolume'] }} @else _____ @endif m3 â 
                            @if ( $receipt['entsorgungChf'] ) CHF {{ $receipt['entsorgungChf'] }} @else CHF_______ @endif <br>
                            Aufwand an der Entsorgungsstelle<br>
                        </td>
                        <td >
                            @if ( $receipt['entsorgungTotalChf'] ) CHF {{ $receipt['entsorgungTotalChf'] }} @else CHF_______ @endif <br>
                            @if ( $receipt['entsorgungFixedChf'] ) CHF {{ $receipt['entsorgungFixedChf'] }} @else CHF_______ @endif<br>
                        </td>
                    </tr>
    
                    {{-- Ekstralar --}}
                    <tr valign="top" style="width:100%;margin-top:20px;">
                        <td style="padding-left:5px;">Zuschläge:</td>
                        <td colspan="2">
                            @if ( $receiptExtra['extra1Text'] ) {{ $receiptExtra['extra1Text'] }} <br>@endif 
                            @if ( $receiptExtra['extra2Text'] ) {{ $receiptExtra['extra2Text'] }} <br>@endif 
                            @if ( $receiptExtra['extra3Text'] ) {{ $receiptExtra['extra3Text'] }} <br>@endif
                            @if ( $receiptExtra['extra4Text'] ) {{ $receiptExtra['extra4Text'] }} <br>@endif
                            @if ( $receiptExtra['extra5Text'] ) {{ $receiptExtra['extra5Text'] }} <br>@endif
                            @if ( $receiptExtra['extra6Text'] ) {{ $receiptExtra['extra6Text'] }} <br>@endif
                            @if ( $receiptExtra['extra7Text'] ) {{ $receiptExtra['extra7Text'] }} <br>@endif
                            @if ( $receiptExtra['extra8Text'] ) {{ $receiptExtra['extra8Text'] }} <br>@endif
                            @if ( $receiptExtra['extra9Text'] ) {{ $receiptExtra['extra9Text'] }} <br>@endif
                            @if ( $receiptExtra['extra10Text'] ) {{ $receiptExtra['extra10Text'] }} <br>@endif
                            @if ( $receiptExtra['extra11Text'] ) {{ $receiptExtra['extra11Text'] }} <br>@endif
                            @if ( $receiptExtra['extra12Text'] ) {{ $receiptExtra['extra12Text'] }} <br>@endif
                            @if ( $receiptExtra['extra13Text'] ) {{ $receiptExtra['extra13Text'] }} <br>@endif
                            @if ( $receiptExtra['extra14Text'] ) {{ $receiptExtra['extra14Text'] }} @else ______________________ @endif<br>
                            @if ( $receiptExtra['extra15Text'] ) {{ $receiptExtra['extra15Text'] }} @else ______________________ @endif<br>
                            @if ( $receiptExtra['extra16Text'] ) {{ $receiptExtra['extra16Text'] }} @else ______________________ @endif<br>
                        </td>
                        <td >
                            @if ( $receiptExtra['extra1'] ) CHF {{ $receiptExtra['extra1'] }}<br>@endif 
                            @if ( $receiptExtra['extra2'] ) CHF {{ $receiptExtra['extra2'] }}<br>@endif 
                            @if ( $receiptExtra['extra3'] ) CHF {{ $receiptExtra['extra3'] }}<br>@endif 
                            @if ( $receiptExtra['extra4'] ) CHF {{ $receiptExtra['extra4'] }}<br>@endif 
                            @if ( $receiptExtra['extra5'] ) CHF {{ $receiptExtra['extra5'] }}<br>@endif 
                            @if ( $receiptExtra['extra6'] ) CHF {{ $receiptExtra['extra6'] }}<br>@endif 
                            @if ( $receiptExtra['extra7'] ) CHF {{ $receiptExtra['extra7'] }}<br>@endif 
                            @if ( $receiptExtra['extra8'] ) CHF {{ $receiptExtra['extra8'] }}<br>@endif 
                            @if ( $receiptExtra['extra9'] ) CHF {{ $receiptExtra['extra9'] }}<br>@endif 
                            @if ( $receiptExtra['extra10'] ) CHF {{ $receiptExtra['extra10'] }}<br>@endif 
                            @if ( $receiptExtra['extra11'] ) CHF {{ $receiptExtra['extra11'] }}<br>@endif 
                            @if ( $receiptExtra['extra12'] ) CHF {{ $receiptExtra['extra12'] }}<br>@endif 
                            @if ( $receiptExtra['extra13'] ) CHF {{ $receiptExtra['extra13'] }}<br>@endif 
                            @if ( $receiptExtra['extra14'] ) CHF {{ $receiptExtra['extra14'] }} @else CHF_______ @endif <br>
                            @if ( $receiptExtra['extra15'] ) CHF {{ $receiptExtra['extra15'] }} @else CHF_______ @endif <br>
                            @if ( $receiptExtra['extra16'] ) CHF {{ $receiptExtra['extra16'] }} @else CHF_______ @endif <br>
                        </td>
                    </tr>
    
                    {{-- Discountlar --}}
                    <tr valign="top" style="width:100%;margin-top:20px;">
                        <td >Abzüge:</td>
                        <td colspan="2">
                            @if ( $receiptDiscount['discount1Text'] ) {{ $receiptDiscount['discount1Text'] }} <br>@endif 
                            @if ( $receiptDiscount['discount2Text'] ) {{ $receiptDiscount['discount2Text'] }} <br>@endif 
                            @if ( $receiptDiscount['discount3Text'] ) {{ $receiptDiscount['discount3Text'] }} <br>@endif
                            @if ( $receiptDiscount['discount4Text'] ) {{ $receiptDiscount['discount4Text'] }} <br>@endif
                            @if ( $receiptDiscount['discount5Text'] ) {{ $receiptDiscount['discount5Text'] }} @else ______________________ @endif<br>
                            @if ( $receiptDiscount['discount6Text'] ) {{ $receiptDiscount['discount6Text'] }} @else ______________________ @endif<br>
                            @if ( $receiptDiscount['discount7Text'] ) {{ $receiptDiscount['discount7Text'] }} @else ______________________ @endif<br>
                        </td>
                        <td >
                            @if ( $receiptDiscount['discount1'] ) CHF {{ $receiptDiscount['discount1'] }}<br>@endif 
                            @if ( $receiptDiscount['discount2'] ) CHF {{ $receiptDiscount['discount2'] }}<br>@endif 
                            @if ( $receiptDiscount['discount3'] ) CHF {{ $receiptDiscount['discount3'] }}<br>@endif 
                            @if ( $receiptDiscount['discount4'] ) CHF {{ $receiptDiscount['discount4'] }}<br>@endif 
                            @if ( $receiptDiscount['discount5'] ) CHF {{ $receiptDiscount['discount5'] }} @else CHF_______ @endif <br>
                            @if ( $receiptDiscount['discount6'] ) CHF {{ $receiptDiscount['discount6'] }} @else CHF_______ @endif <br>
                            @if ( $receiptDiscount['discount7'] ) CHF {{ $receiptDiscount['discount7'] }} @else CHF_______ @endif <br>
                        </td>
                    </tr>
                    
                    @if ( $receipt['withTax'] )
                    <tr valign="top" style="width:100%;margin-top:20px;">
                        <td ></td>
                        <td colspan="2">
                             7.7% MwSt <br>
                        </td>
                        <td >
                            CHF_____<br>
                        </td>
                    </tr>
                    @endif
    
                    <tr valign="top" style="width:100%;margin-top:20px;">
                        <td ><b>Total Kosten:</b></td>
                        <td colspan="2"></td>
                        <td>
                            <b>CHF {{ $receipt['totalPrice'] }}</b><br>
                        </td>
                    </tr>
                    <tr valign="top" style="width:100%;margin-top:20px;">
                        <td style="font-size:8px;">Alle Kosten sind inkl. MwSt.</td>
                        <td colspan="2" style="font-size:8px;">
                            MwSt.-Nummer: CHE-100.582.488
                        </td>
                        <td></td>
                    </tr>
                </table>
            </div>
    
            @if($receipt['cashPrice'] || $receipt['invoicePrice'])
                <div style="margin-top:20px;">
                    <b>Zahlung: @if ($receipt['cashPrice']) Bar @elseif ($receipt['invoicePrice']) Rechnung @elseif ($receipt['cashPrice'] && $receipt['invoicePrice']) Bar/Rechnung @endif</b><br>
                    Der Auftragsgeber bestätigt die korrekte Auftragsausführung und akzeptiert die ausgewiesenen Leistungen. Der Kunde ist <br>
                    verpflichtet, direkt nach dem Abladen am Bestimmungsort das Umzugsgut zu überprüfen. Schäden und Reklamationen sind<br>
                    sofort dem Teamleiter mitzuteilen.
                </div>
            @endif
            <table style="width: 100%;margin-top:20px;">
                <tr valign="top" style="width:100%;padding-left:5px;">
                    <td align="center"><b>Ort/Datum</b></td>
                    <td align="center" colspan="2"><b>{{ App\Models\Company::InfoCompany('name') }}</b></td>
                    <td align="center"><b>{{ $receipt['signerName'] }}</b></td>
                </tr>
                <tr style="width:100%;margin-top:30px;padding-left:5px;">
                    <td align="center" style="padding-top: 50px;">________________</td>
                    <td align="center" colspan="2" style="padding-top: 50px;">________________</td>
                    <td align="center" style="padding-top: 50px;">________________</td>
                </tr>
            </table>
        </div>
    </main>
   
</body>
</html>