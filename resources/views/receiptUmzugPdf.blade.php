<!DOCTYPE html>
<html>
<head>
    <title>Quittung - Umzug {{ $receipt['id'] }}(PDF) </title>
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
                        <a href="{{ App\Models\Company::InfoCompany('website') }}" target="_blank"><img style="padding:0px;" src="{{ asset('assets/demo/logo-expand.png') }}" width="300" /></a>
                    </td>
                </tr>
            </table>
        </header>
    </header>
    <footer>
        <span style="font-size:9px;">{{ App\Models\Company::InfoCompany('name') }} | {{ App\Models\Company::InfoCompany('street') }} | CH-{{ App\Models\Company::InfoCompany('post_code') }} {{ App\Models\Company::InfoCompany('city') }} | Telefon: {{ App\Models\Company::InfoCompany('phone') }} | {{ App\Models\Company::InfoCompany('email') }} | {{ App\Models\Company::InfoCompany('website') }}</span>
    </footer>
    <main>
        <div class="teklif-boyutu">
            <table border="0" style="width:100%;" >

                <tr style="width: 100%;margin-top:20px;">
                    <td colspan="4" align="left"><h1><b style="font-size:18px;">Quittung / Rechnung</b></h1></td>
                </tr>

                <tr style="width:100%;">
                    <td valign="top" style="padding-top:20px;">
                        <b>Auftraggeber:</b><br>
                        {{ $receipt['customerGender'] }} <br>
                        {{ $receipt['customerName'] }} <br>
                        {{ $receipt['customerStreet'] }} <br>
                        {{ $receipt['customerAddress'] }} <br>
                        {{ $receipt['customerPhone'] }} <br>
                        {{ $receipt['customerMail'] }} <br>
                    </td>
                    <td valign="top" style="padding-top:20px;">
                        <b>Auszugsadresse:</b><br>
                        @if($auszug1){{ $auszug1['line1'] }} @endif<br>
                        @if($auszug1){{ $auszug1['line2'] }} @endif<br>
                        @if($auszug2){{ $auszug2['line1'] }} @endif<br>
                        @if($auszug2){{ $auszug2['line2'] }} @endif<br>
                        @if($auszug3){{ $auszug3['line1'] }} @endif<br>
                        @if($auszug3){{ $auszug3['line2'] }} @endif<br>
                    </td>
                    <td valign="top" style="padding-top:20px;">
                        <b>Einzugsadresse:</b><br>
                        @if($einzug1){{ $einzug1['line1'] }} @endif<br>
                        @if($einzug1){{ $einzug1['line2'] }} @endif<br>
                        @if($einzug2){{ $einzug2['line1'] }} @endif<br>
                        @if($einzug2){{ $einzug2['line2'] }} @endif<br>
                        @if($einzug3){{ $einzug3['line1'] }} @endif<br>
                        @if($einzug3){{ $einzug3['line2'] }} @endif<br>
                    </td>
                    <td valign="top" style="padding-top:20px;">
                        <b>Auftragstermin:</b><br>
                        @if($receipt['orderDate'])
                        {{ date('d.m.Y', strtotime($receipt['orderDate'])) }},
                        @endif
                        @if($receipt['orderTime']) {{ date('H:i', strtotime($receipt['orderTime'])) }} Uhr @endif

                    </td>
                </tr>
            </table>

            <div style="border:1px solid black;margin-top:20px;">
                <table  style="padding:10px;width:100%;">

                    {{-- Umzug --}}
                    <tr valign="top" style="width:100%;">
                        <td >Aufwand:</td>
                        <td colspan="2" >
                            @if ( $receipt['umzugHour'] ) {{ $receipt['umzugHour'] }} @else _____ @endif h á
                            @if ( $receipt['umzugChf'] ) CHF {{ $receipt['umzugChf'] }} @else CHF_______ @endif <br><br>
                            Spesen <br><br>

                            @if(!empty($receipt['umzugArrivalGas']) && !empty($receipt['umzugReturnGas']))
                                Anfahrt - Rückfahrt:<br><br>
                            @elseif(!empty($receipt['umzugArrivalGas']))
                                Anfahrt:<br><br>
                            @elseif(!empty($receipt['umzugReturnGas']))
                                Rückfahrt: <br><br>
                            @endif

                            Verpackungsmaterial <br><br>
                        </td>
                        <td>
                            @if ( $receipt['umzugTotalChf'] ) CHF {{ $receipt['umzugTotalChf'] }} @else CHF_______ @endif <br><br>
                            @if ( $receipt['umzugCharge'] ) CHF {{ $receipt['umzugCharge'] }} @else CHF_______ @endif<br><br>

                            @if(!empty($receipt['umzugArrivalGas']) && !empty($receipt['umzugReturnGas']))
                            CHF {{ $receipt['umzugArrivalGas'] }} - {{ $receipt['umzugReturnGas'] }}  <br><br>
                            @elseif(!empty($receipt['umzugArrivalGas']))
                            CHF {{ $receipt['umzugArrivalGas'] }}  <br><br>
                            @elseif(!empty($receipt['umzugReturnGas']))
                            CHF {{ $receipt['umzugReturnGas'] }}  <br><br>
                            @endif


                            @if ( $receipt['materialPrice'] ) CHF {{ $receipt['materialPrice'] }} @else CHF_______ @endif<br><br>
                        </td>
                    </tr>

                    {{-- Entsorgung --}}
                    <tr valign="top" style="width:100%;margin-top:20px;">
                        <td >Entsorgung:</td>
                        <td colspan="2">
                            @if ( $receipt['entsorgungVolume'] ) {{ $receipt['entsorgungVolume'] }} @else _____ @endif m3 á
                            @if ( $receipt['entsorgungChf'] ) CHF {{ $receipt['entsorgungChf'] }} @else CHF_______ @endif <br><br>
                            Aufwand an der Entsorgungsstelle<br><br>
                        </td>
                        <td >
                            @if ( $receipt['entsorgungTotalChf'] ) CHF {{ $receipt['entsorgungTotalChf'] }} @else CHF_______ @endif <br><br>
                            @if ( $receipt['entsorgungFixedChf'] ) CHF {{ $receipt['entsorgungFixedChf'] }} @else CHF_______ @endif<br><br>
                        </td>
                    </tr>

                    {{-- Ekstralar --}}
                    <tr valign="top" style="width:100%;margin-top:20px;">
                        <td >Zuschläge:</td>
                        <td colspan="2">
                            @if ( $receiptExtra['extra1Text'] ) {{ $receiptExtra['extra1Text'] }} <br><br>@endif
                            @if ( $receiptExtra['extra2Text'] ) {{ $receiptExtra['extra2Text'] }} <br><br>@endif
                            @if ( $receiptExtra['extra3Text'] ) {{ $receiptExtra['extra3Text'] }} <br><br>@endif
                            @if ( $receiptExtra['extra4Text'] ) {{ $receiptExtra['extra4Text'] }} <br><br>@endif
                            @if ( $receiptExtra['extra5Text'] ) {{ $receiptExtra['extra5Text'] }} <br><br>@endif
                            @if ( $receiptExtra['extra6Text'] ) {{ $receiptExtra['extra6Text'] }} <br><br>@endif
                            @if ( $receiptExtra['extra7Text'] ) {{ $receiptExtra['extra7Text'] }} <br><br>@endif
                            @if ( $receiptExtra['extra8Text'] ) {{ $receiptExtra['extra8Text'] }} <br><br>@endif
                            @if ( $receiptExtra['extra9Text'] ) {{ $receiptExtra['extra9Text'] }} <br><br>@endif
                            @if ( $receiptExtra['extra10Text'] ) {{ $receiptExtra['extra10Text'] }} <br><br>@endif
                            @if ( $receiptExtra['extra11Text'] ) {{ $receiptExtra['extra11Text'] }} <br><br>@endif
                            @if ( $receiptExtra['extra12Text'] ) {{ $receiptExtra['extra12Text'] }} <br><br>@endif
                            @if ( $receiptExtra['extra13Text'] ) {{ $receiptExtra['extra13Text'] }} <br><br>@endif
                            @if ( $receiptExtra['extra14Text'] ) {{ $receiptExtra['extra14Text'] }} @else ______________________ @endif<br><br>
                            @if ( $receiptExtra['extra15Text'] ) {{ $receiptExtra['extra15Text'] }} @else ______________________ @endif<br><br>
                            @if ( $receiptExtra['extra16Text'] ) {{ $receiptExtra['extra16Text'] }} @else ______________________ @endif<br><br>
                        </td>
                        <td >
                            @if ( $receiptExtra['extra1'] ) CHF {{ $receiptExtra['extra1'] }}<br><br>@endif
                            @if ( $receiptExtra['extra2'] ) CHF {{ $receiptExtra['extra2'] }}<br><br>@endif
                            @if ( $receiptExtra['extra3'] ) CHF {{ $receiptExtra['extra3'] }}<br><br>@endif
                            @if ( $receiptExtra['extra4'] ) CHF {{ $receiptExtra['extra4'] }}<br><br>@endif
                            @if ( $receiptExtra['extra5'] ) CHF {{ $receiptExtra['extra5'] }}<br><br>@endif
                            @if ( $receiptExtra['extra6'] ) CHF {{ $receiptExtra['extra6'] }}<br><br>@endif
                            @if ( $receiptExtra['extra7'] ) CHF {{ $receiptExtra['extra7'] }}<br><br>@endif
                            @if ( $receiptExtra['extra8'] ) CHF {{ $receiptExtra['extra8'] }}<br><br>@endif
                            @if ( $receiptExtra['extra9'] ) CHF {{ $receiptExtra['extra9'] }}<br><br>@endif
                            @if ( $receiptExtra['extra10'] ) CHF {{ $receiptExtra['extra10'] }}<br><br>@endif
                            @if ( $receiptExtra['extra11'] ) CHF {{ $receiptExtra['extra11'] }}<br><br>@endif
                            @if ( $receiptExtra['extra12'] ) CHF {{ $receiptExtra['extra12'] }}<br><br>@endif
                            @if ( $receiptExtra['extra13'] ) CHF {{ $receiptExtra['extra13'] }}<br><br>@endif
                            @if ( $receiptExtra['extra14'] ) CHF {{ $receiptExtra['extra14'] }} @else CHF_______ @endif <br><br>
                            @if ( $receiptExtra['extra15'] ) CHF {{ $receiptExtra['extra15'] }} @else CHF_______ @endif <br><br>
                            @if ( $receiptExtra['extra16'] ) CHF {{ $receiptExtra['extra16'] }} @else CHF_______ @endif <br><br>
                        </td>
                    </tr>

                    {{-- Discountlar --}}
                    <tr valign="top" style="width:100%;margin-top:20px;">
                        <td >Abzüge:</td>
                        <td colspan="2">
                            @if ( $receiptDiscount['discount1Text'] ) {{ $receiptDiscount['discount1Text'] }} <br><br>@endif
                            @if ( $receiptDiscount['discount2Text'] ) {{ $receiptDiscount['discount2Text'] }} <br><br>@endif
                            @if ( $receiptDiscount['discount3Text'] ) {{ $receiptDiscount['discount3Text'] }} <br><br>@endif
                            @if ( $receiptDiscount['discount4Text'] ) {{ $receiptDiscount['discount4Text'] }} <br><br>@endif
                            @if ( $receiptDiscount['discount5Text'] ) {{ $receiptDiscount['discount5Text'] }} @else ______________________ @endif<br><br>
                            @if ( $receiptDiscount['discount6Text'] ) {{ $receiptDiscount['discount6Text'] }} @else ______________________ @endif<br><br>
                            @if ( $receiptDiscount['discount7Text'] ) {{ $receiptDiscount['discount7Text'] }} @else ______________________ @endif<br><br>
                        </td>
                        <td >
                            @if ( $receiptDiscount['discount1'] ) CHF {{ $receiptDiscount['discount1'] }}<br><br>@endif
                            @if ( $receiptDiscount['discount2'] ) CHF {{ $receiptDiscount['discount2'] }}<br><br>@endif
                            @if ( $receiptDiscount['discount3'] ) CHF {{ $receiptDiscount['discount3'] }}<br><br>@endif
                            @if ( $receiptDiscount['discount4'] ) CHF {{ $receiptDiscount['discount4'] }}<br><br>@endif
                            @if ( $receiptDiscount['discount5'] ) CHF {{ $receiptDiscount['discount5'] }} @else CHF_______ @endif <br><br>
                            @if ( $receiptDiscount['discount6'] ) CHF {{ $receiptDiscount['discount6'] }} @else CHF_______ @endif <br><br>
                            @if ( $receiptDiscount['discount7'] ) CHF {{ $receiptDiscount['discount7'] }} @else CHF_______ @endif <br><br>
                        </td>
                    </tr>

                    @if ( $receipt['withoutTax'] )
                    <tr valign="top" style="width:100%;margin-top:20px;">
                        <td ></td>
                        <td colspan="2">
                             8.1% MwSt <br><br>
                        </td>
                        <td>
                            @php
                                $tax = $receipt['totalPrice'] * (8.1 / 100);
                            @endphp

                            @if (is_null($receipt['umzugTotalChf']) && is_null($receipt['entsorgungTotalChf']))
                                CHF_______<br><br>
                            @else
                                CHF {{ number_format($tax, 2) }} <br><br> {{-- Vergiyi 2 ondalık basamağa yuvarlar --}}
                            @endif
                        </td>
                    </tr>
                    @endif

                    @if($receipt['withTax'])
                        <tr valign="top" style="width:100%;margin-top:20px;">
                            <td style="font-size:8px;">Alle Kosten sind inkl. MwSt.</td>
                            <td colspan="2" style="font-size:8px;">
                                MwSt.-Nummer: CHE-100.582.488
                            </td>
                            <td></td>
                        </tr>
                    @endif

                    @if($receipt['freeTax'])
                        <tr valign="top" style="width:100%;margin-top:20px;">
                            <td style="font-size:8px;">Alle Kostenfrei MwSt.</td>
                            <td colspan="2" style="font-size:8px;">
                                MwSt.-Nummer: CHE-100.582.488
                            </td>
                            <td></td>
                        </tr>
                    @endif

                    @if($receipt['fixedPrice'])
                    <tr valign="top" style="width:100%;margin-top:20px;">
                        <td ><b>Pauschal:</b></td>
                        <td colspan="2"></td>
                        <td>
                            <b>CHF_____</b><br><br>
                        </td>
                    </tr>
                    @endif

                    @if($receipt['topPrice'])
                    <tr valign="top" style="width:100%;margin-top:20px;">
                        <td ><b>Kostendach:</b></td>
                        <td colspan="2"></td>
                        <td>
                            <b>CHF_____</b><br><br>
                        </td>
                    </tr>
                    @endif

                    <tr valign="top" style="width:100%;margin-top:20px;">
                        <td ><b>Total Kosten:</b></td>
                        <td colspan="2"></td>
                        <td>
                            <b>CHF_____</b><br><br>
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
                    @if ($receipt['signature'])
                    <td align="left" style="padding-top: 10px;"><img src="{{ $receipt['signature'] }}" width="150" alt="Signature Image"></td>
                        @else
                        <td align="left" style="padding-top: 50px;">________________</td>
                    @endif
                </tr>

                <tr>
                    <td colspan="4" align="right" style="padding-top: 50px;"><img src="{{ asset('assets/demo/swiss-twint-qr-1.png') }}" width="120" alt="twint_qr"></td>
                </tr>
            </table>



        </div>
    </main>

</body>
</html>
