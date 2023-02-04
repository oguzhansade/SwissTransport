<!DOCTYPE html>
<html>
<head>
    <title>Quittung - Reinigung {{ $receipt['id'] }}(PDF) </title>
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
                                <td >Datum:</td>
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
                        <b>Reinigungsadresse:</b><br>
                        {{ $receipt['reinigungStreet'] }}<br>
                        {{ $receipt['reinigungAddress'] }}<br>
                    </td>
                    <td valign="top">
                        <b>Reinigungstermin:</b><br>
                        {{ $receipt['reinigungDate'] }}, {{ $receipt['reinigungTime'] }}
                    </td>
                    <td valign="top">
                        <b>Abgabetermin:</b><br>
                        {{ $receipt['endDate'] }}, {{ $receipt['endTime'] }}
                    </td>
                </tr>
            </table>
    
            <div style="border:1px solid black;margin-top:20px;">
                <table  style="padding:10px;width:100%;">
    
                    {{-- Reinigung --}}
                    <tr valign="top" style="width: 100%;">
                        <td colspan="2">
                            <b>{{ $receipt['reinigungType'] }}</b>
                        </td>
                        <td colspan="2">
                            {{ $receipt['reinigungExtraText'] }}
                        </td>
                    </tr>
    
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
                        </tr>
                    @endif
                    
                    {{-- Ekstralar --}}
                    <tr valign="top" style="width:100%;margin-top:20px;">
                        <td>Zuschläge:</td>
                        <td colspan="2">
                            @if ( $receiptExtra['extra1Text'] ) {{ $receiptExtra['extra1Text'] }} @else ______________________ @endif<br>
                            @if ( $receiptExtra['extra2Text'] ) {{ $receiptExtra['extra2Text'] }} @else ______________________ @endif<br>
                            @if ( $receiptExtra['extra3Text'] ) {{ $receiptExtra['extra3Text'] }} @else ______________________ @endif<br>
                            @if ( $receiptExtra['extra4Text'] ) {{ $receiptExtra['extra4Text'] }} @else ______________________ @endif<br>
                            @if ( $receiptExtra['extra5Text'] ) {{ $receiptExtra['extra5Text'] }} @else ______________________ @endif<br>
                            @if ( $receiptExtra['extra6Text'] ) {{ $receiptExtra['extra6Text'] }} @else ______________________ @endif<br>
                            @if ( $receiptExtra['extra7Text'] ) {{ $receiptExtra['extra7Text'] }} @else ______________________ @endif<br>
                        </td>
                        <td>
                            @if ( $receiptExtra['extra1'] ) CHF {{ $receiptExtra['extra1'] }} @else CHF_______ @endif <br>
                            @if ( $receiptExtra['extra2'] ) CHF {{ $receiptExtra['extra2'] }} @else CHF_______ @endif <br>
                            @if ( $receiptExtra['extra3'] ) CHF {{ $receiptExtra['extra3'] }} @else CHF_______ @endif <br>
                            @if ( $receiptExtra['extra4'] ) CHF {{ $receiptExtra['extra4'] }} @else CHF_______ @endif <br>
                            @if ( $receiptExtra['extra5'] ) CHF {{ $receiptExtra['extra5'] }} @else CHF_______ @endif <br>
                            @if ( $receiptExtra['extra6'] ) CHF {{ $receiptExtra['extra6'] }} @else CHF_______ @endif <br>
                            @if ( $receiptExtra['extra7'] ) CHF {{ $receiptExtra['extra7'] }} @else CHF_______ @endif <br>
                        </td>
                    </tr>
    
                    {{-- Discountlar --}}
                    <tr valign="top" style="width:100%;margin-top:20px;">
                        <td >Abzüge:</td>
                        <td colspan="2">
                            @if ( $receiptDiscount['discount1Text'] ) {{ $receiptDiscount['discount1Text'] }} @else ______________________ @endif<br>
                            @if ( $receiptDiscount['discount2Text'] ) {{ $receiptDiscount['discount2Text'] }} @else ______________________ @endif<br>
                            @if ( $receiptDiscount['discount3Text'] ) {{ $receiptDiscount['discount3Text'] }} @else ______________________ @endif<br>
                        </td>
                        <td >
                            @if ( $receiptDiscount['discount1'] ) CHF {{ $receiptDiscount['discount1'] }} @else CHF_______ @endif <br>
                            @if ( $receiptDiscount['discount2'] ) CHF {{ $receiptDiscount['discount2'] }} @else CHF_______ @endif <br>
                            @if ( $receiptDiscount['discount3'] ) CHF {{ $receiptDiscount['discount3'] }} @else CHF_______ @endif <br>
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
                <tr style="width:100%;padding-left:5px;">
                    <td align="center" style="padding-top:50px">________________</td>
                    <td align="center" colspan="2" style="padding-top:50px">________________</td>
                    <td align="center" style="padding-top:50px">________________</td>
                </tr>
            </table>
        </div>
    </main>
</body>
</html>