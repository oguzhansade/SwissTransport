<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ App\Models\Company::InfoCompany('name') }} - Offerte ({{ $offer['id'] }})</title>
    <!-- CSS only -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> --}}

    <link rel="stylesheet" href="{{ asset('assets/css/pace.css') }}">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>{{ App\Models\Company::InfoCompany('name') }}</title>
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600|Roboto:400" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/vendors/material-icons/material-icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendors/mono-social-icons/monosocialiconsfont.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/vendors/feather-icons/feather.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/css/perfect-scrollbar.min.css"
        rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet"
        type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet"
        type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css" rel="stylesheet"
        type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.css"
        rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <!-- Head Libs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script data-pace-options='{ "ajax": false, "selectors": [ "img" ]}'
        src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"
        type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css"
        rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" type="text/css" href="https://www.provenexpert.com/css/widget_landing.css"
        media="screen,print">

    <style>
        .bg-container {
            background-color: white;
            padding-left: 20px;
            padding-right: 20px;
            padding-bottom: 20px;
            border-radius: 20px;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }

        .text-primary {

            color: {{ App\Models\Company::InfoCompany('pdfPrimaryColor') }}!important;

        }

        .bg-preview-primary {
            background: {{ App\Models\Company::InfoCompany('pdfPrimaryColor') }}!important;

        }

        .bg-offer {
            background-color: #8259B4;
        }

        .b-shadow {
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }

        .custom-font {
            color: white;
            font-weight: 700;
        }

        .rounded-custom {
            border-radius: 20px;
        }

        .rounded-custom-2 {
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .rounded-custom-3 {
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .c-border {
            border-bottom-color: black;
            border-bottom-style: solid;
            border-bottom-width: 1px;
        }

        .banner {}

        .pewl {
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            border: none !important;
            border-radius: 30px;
            border-color: transparent !important;
            background-color: white !important;
            z-index: -1;
        }

        @media only screen and (max-width: 767px) {
            .h6 {
                font-size: 14px;
                /* veya istediğiniz boyut */
            }
        }



    </style>
    {{-- dil --}}
    <style>
        .goog-te-menu-value span img {
            vertical-align: middle;
        }
    </style>
</head>

@php
    $countryCodes = [
        'Schweiz' => 'CH',
        'Ausland' => 'AU',
        'Fürstentum Liechtenstein' => 'LI',
        'Deutschland' => 'DE',
        'Österreich' => 'AT',
        'Italien' => 'IT',
        'Frankreich' => 'FR',
    ];
@endphp


<body onload="resizeDiv()">
    <div class="container-fluid ">
        <div class="row shadow ">
            <div class="col-md-12 p-3  d-flex justify-content-center b-shadow " style="position: relative;z-index: 5;">
                <a href="{{ App\Models\Company::InfoCompany('website') }}"><img class="logo-expand" alt="" width="300"
                        src="{{ asset('assets/demo/logo-expand.png') }}"></a>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12  p-0 banner draw" style="position: relative;z-index: 3;">
                <img src="{{ asset('assets/img/umzugsfirma-zuerich.jpg') }}" width="1920" height="450"
                    alt="" style="object-fit: cover">
            </div>
        </div>

    </div>

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <div id="google_translate_element"></div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 mt-5 ">
                <div id="pewl" class="p-3 block"></div>
            </div>
        </div>
        <div class="row d-flex p-0 justify-content-start mt-5">
            <div class="col-md-12 d-flex justify-content-start">
                <span class="h4 px-3 py-1  text-white b-shadow rounded bg-preview-primary" >Offerte: <span
                        class="custom-font">{{ $offer['id'] }}</span> </span>
            </div>
        </div>
    </div>
    <div class="mt-1">
        <div class="container p-1 text-dark">
            <div class="row mb-3">
                {{-- Sol Kısım --}}
                <div class="col-md-8 pr-3">
                    <span class="text-dark">
                        <strong>Datum: </strong>{{ $offer['created_at'] }} <br>

                    </span><br><br>
                    <span class="text-dark">
                        <strong>Sehr
                            @if (App\Models\Customer::getCustomer($offer['customerId'], 'gender') === 'male')
                                geehrter Herr
                            @else
                                geehrte Frau
                            @endif
                            {{ App\Models\Customer::getCustomer($offer['customerId'], 'name') }}
                            {{ App\Models\Customer::getCustomer($offer['customerId'], 'surname') }}
                        </strong> <br>
                        Wir danken Ihnen herzlich für Ihre Anfrage und freuen uns, Ihnen folgendes Angebot vorlegen zu
                        können:
                    </span>

                    {{-- Adres Alanı --}}
                        <div class="bg-container">
                            <div class="row">

                                {{-- Auszug1 Adress --}}
                                @if($auszug1)
                                <div class="col-md-6 ">
                                    <h4> <strong class="text-primary">Auszug: </strong> </h4>
                                    <table border='0'>
                                        <tr>
                                            <td><b>Strasse:</b></td>
                                            <td>{{ $auszug1['street'] }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>PLZ/Ort:</b></td>
                                            <td>
                                                @php
                                                $zipType = $countryCodes[$auszug1['country']] ?? 'CH'; // Varsayılan CH
                                                @endphp
                                                {{ $zipType }} - {{ $auszug1['postCode'] }} {{ $auszug1['city'] }} / {{ $auszug1['country'] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Gebäude:</b></td>
                                            <td>{{ $auszug1['buildType'] }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Etage:</b></td>
                                            <td>{{ $auszug1['floor'] }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Lift:</b></td>
                                            <td>@if($auszug1['lift'] == 1) Ja @else Nein @endif</td>
                                        </tr>
                                        <tr>
                                            <td><b>Parkplatz:</b></td>
                                            <td>@if($auszug1['parkPlatz'] == 1) Ja @else Nein @endif</td>
                                        </tr>
                                    </table>
                                </div>
                                @endif

                                {{-- Einzug1 Adress --}}
                                @if($einzug1)
                                    <div class="col-md-6  border-left">
                                        <h4> <strong class="text-primary">Einzug: </strong> </h4>
                                        <table border='0'>
                                            <tr>
                                                <td><b>Strasse:</b></td>
                                                <td>{{ $einzug1['street'] }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>PLZ/Ort:</b></td>
                                                <td>
                                                    @php
                                                    $zipType = $countryCodes[$einzug1['country']] ?? 'CH'; // Varsayılan CH
                                                    @endphp
                                                    {{ $zipType }} - {{ $einzug1['postCode'] }} {{ $einzug1['city'] }} / {{ $einzug1['country'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Gebäude:</b></td>
                                                <td>{{ $einzug1['buildType'] }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Etage:</b></td>
                                                <td>{{ $einzug1['floor'] }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Lift:</b></td>
                                                <td>@if($einzug1['lift'] == 1) Ja @else Nein @endif</td>
                                            </tr>
                                            <tr>
                                                <td><b>Parkplatz:</b></td>
                                                <td>@if($einzug1['parkPlatz'] == 1) Ja @else Nein @endif</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endif

                                {{-- Auszug2 Adress --}}
                                @if($auszug2)
                                    <div class="col-md-6  border-left">
                                        <h4> <strong class="text-primary">Auszug2: </strong> </h4>
                                        <table border='0'>
                                            <tr>
                                                <td><b>Strasse:</b></td>
                                                <td>{{ $auszug2['street'] }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>PLZ/Ort:</b></td>
                                                <td>
                                                    @php
                                                    $zipType = $countryCodes[$auszug2['country']] ?? 'CH'; // Varsayılan CH
                                                    @endphp
                                                    {{ $zipType }} - {{ $auszug2['postCode'] }} {{ $auszug2['city'] }} / {{ $auszug2['country'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Gebäude:</b></td>
                                                <td>{{ $auszug2['buildType'] }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Etage:</b></td>
                                                <td>{{ $auszug2['floor'] }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Lift:</b></td>
                                                <td>@if($auszug2['lift'] == 1) Ja @else Nein @endif</td>
                                            </tr>
                                            <tr>
                                                <td><b>Parkplatz:</b></td>
                                                <td>@if($auszug2['parkPlatz'] == 1) Ja @else Nein @endif</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endif

                                {{-- Einzug2 Adress --}}
                                @if($einzug2)
                                    <div class="col-md-6  border-left">
                                        <h4> <strong class="text-primary">Einzug2: </strong> </h4>
                                        <table border='0'>
                                            <tr>
                                                <td><b>Strasse:</b></td>
                                                <td>{{ $einzug2['street'] }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>PLZ/Ort:</b></td>
                                                <td>
                                                    @php
                                                    $zipType = $countryCodes[$einzug2['country']] ?? 'CH'; // Varsayılan CH
                                                    @endphp
                                                    {{ $zipType }} - {{ $einzug2['postCode'] }} {{ $einzug2['city'] }} / {{ $einzug2['country'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Gebäude:</b></td>
                                                <td>{{ $einzug2['buildType'] }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Etage:</b></td>
                                                <td>{{ $einzug2['floor'] }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Lift:</b></td>
                                                <td>@if($einzug2['lift'] == 1) Ja @else Nein @endif</td>
                                            </tr>
                                            <tr>
                                                <td><b>Parkplatz:</b></td>
                                                <td>@if($einzug2['parkPlatz'] == 1) Ja @else Nein @endif</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endif

                                {{-- Auszug3 Adress --}}
                                @if($auszug3)
                                    <div class="col-md-6  border-left">
                                        <h4> <strong class="text-primary">Auszug3: </strong> </h4>
                                        <table border='0'>
                                            <tr>
                                                <td><b>Strasse:</b></td>
                                                <td>{{ $auszug3['street'] }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>PLZ/Ort:</b></td>
                                                <td>
                                                    @php
                                                    $zipType = $countryCodes[$auszug3['country']] ?? 'CH'; // Varsayılan CH
                                                    @endphp
                                                    {{ $zipType }} - {{ $auszug3['postCode'] }} {{ $auszug3['city'] }} / {{ $auszug3['country'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Gebäude:</b></td>
                                                <td>{{ $auszug3['buildType'] }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Etage:</b></td>
                                                <td>{{ $auszug3['floor'] }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Lift:</b></td>
                                                <td>@if($auszug3['lift'] == 1) Ja @else Nein @endif</td>
                                            </tr>
                                            <tr>
                                                <td><b>Parkplatz:</b></td>
                                                <td>@if($auszug3['parkPlatz'] == 1) Ja @else Nein @endif</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endif

                                {{-- Einzug3 Adress --}}
                                @if($einzug3)
                                    <div class="col-md-6  border-left">
                                        <h4> <strong class="text-primary">Einzug3: </strong> </h4>
                                        <table border='0'>
                                            <tr>
                                                <td><b>Strasse:</b></td>
                                                <td>{{ $einzug3['street'] }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>PLZ/Ort:</b></td>
                                                <td>
                                                    @php
                                                    $zipType = $countryCodes[$einzug3['country']] ?? 'CH'; // Varsayılan CH
                                                    @endphp
                                                    {{ $zipType }} - {{ $einzug3['postCode'] }} {{ $einzug3['city'] }} / {{ $einzug3['country'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Gebäude:</b></td>
                                                <td>{{ $einzug3['buildType'] }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Etage:</b></td>
                                                <td>{{ $einzug3['floor'] }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Lift:</b></td>
                                                <td>@if($einzug3['lift'] == 1) Ja @else Nein @endif</td>
                                            </tr>
                                            <tr>
                                                <td><b>Parkplatz:</b></td>
                                                <td>@if($einzug3['parkPlatz'] == 1) Ja @else Nein @endif</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>

                    {{-- Umzug Alanı --}}
                    @if ($isUmzug)

                        <div class="form-group row mt-3">
                            <div class="col-md-12 umzug-control">
                                <label for="" class="col-form-label">Umzug</label><br>
                                <input type="checkbox" name="isUmzug" id="isUmzug" class="js-switch "
                                    data-color="{{ App\Models\Company::InfoCompany('pdfPrimaryColor') }}" data-switchery="false" checked>
                            </div>
                        </div>

                        <div class="umzug--area bg-container" style="display: block;">
                            <div class="row">
                                <div class="col-md-12 text-primary">
                                    <h4> <strong class="text-primary">Umzug: </strong> </h4>
                                </div>
                            </div>
                            <div class="c-border"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Umzugstermin
                                </div>
                                <div class="col-md-6">
                                    @if ($umzug['moveDate'])
                                        {{ date('d/m/Y', strtotime($umzug['moveDate'])) }}
                                    @else
                                        -
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    Arbeitsbeginn
                                </div>
                                <div class="col-md-6">
                                    @if ($umzug['moveTime'])
                                        {{ $umzug['moveTime'] }}
                                    @else
                                        -
                                    @endif Uhr
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Tarif
                                </div>
                                <div class="col-md-6">
                                    {{ $umzug['ma'] }} Umzugsmitarbeiter mit {{ $umzug['lkw'] }} Lieferwagen
                                    @if ($umzug['anhanger'])
                                        und {{ $umzug['anhanger'] }} Anhänger
                                    @endif à CHF {{ $umzug['chf'] }}.-/Stunde
                                </div>
                                <div class="col-md-6">
                                    Anfahrt/Rückfahrt
                                </div>
                                <div class="col-md-6">
                                    {{ $umzug['arrivalReturn'] }} CHF
                                </div>
                                <div class="col-md-6">
                                    Möbel Ab-/Aufbau
                                </div>
                                <div class="col-md-6">
                                    @if ($umzug['montage'] == 0)
                                        Kunde
                                    @else
                                    {{ App\Models\Company::InfoCompany('name') }}
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    Geschätzter Arbeitsaufwand
                                </div>
                                <div class="col-md-6">
                                    {{ $umzug['moveHours'] }} Std
                                </div>

                                <div class="col-md-6">
                                    Zusatzkosten
                                </div>
                                <div class="col-md-6">
                                    @if ($umzug['extra'])
                                        Spesen {{ $umzug['extra'] }} CHF <br>
                                    @endif
                                    @if ($umzug['extra1'])
                                        Klavier {{ $umzug['extra1'] }} CHF <br>
                                    @endif
                                    @if ($umzug['extra2'])
                                        Klavier {{ $umzug['extra2'] }} CHF <br>
                                    @endif
                                    @if ($umzug['extra3'])
                                        Möbellift {{ $umzug['extra3'] }} CHF <br>
                                    @endif
                                    @if ($umzug['extra4'])
                                        Möbellift {{ $umzug['extra4'] }} CHF <br>
                                    @endif
                                    @if ($umzug['extra5'])
                                        Möbellift {{ $umzug['extra5'] }} CHF <br>
                                    @endif
                                    @if ($umzug['extra6'])
                                        Schwergutzuschlag {{ $umzug['extra6'] }} CHF <br>
                                    @endif
                                    @if ($umzug['extra7'])
                                        Schwergutzuschlag {{ $umzug['extra7'] }} CHF <br>
                                    @endif
                                    @if ($umzug['extra8'])
                                        Tresor {{ $umzug['extra8'] }} CHF <br>
                                    @endif
                                    @if ($umzug['extra9'])
                                        Tresor {{ $umzug['extra9'] }} CHF <br>
                                    @endif
                                    @if ($umzug['extra10'])
                                        Wasserbett {{ $umzug['extra10'] }} CHF <br>
                                    @endif
                                    @if ($umzug['customCostPrice1'])
                                        @if ($umzug['customCostName1'])
                                            {{ $umzug['customCostName1'] }}
                                        @else
                                            Freier Text 1
                                        @endif {{ $umzug['customCostPrice1'] }} CHF
                                    @endif
                                    @if ($umzug['customCostPrice2'])
                                        @if ($umzug['customCostName2'])
                                            {{ $umzug['customCostName2'] }}
                                        @else
                                            Freier Text 2
                                        @endif {{ $umzug['customCostPrice2'] }} CHF
                                    @endif
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Kosten:
                                </div>
                                <div class="col-md-6">
                                    <span class="text-primary"> <strong>{{ $umzug['costPrice'] }} CHF</strong>
                                    </span>
                                </div>
                            </div>
                            @if ($umzug['discount'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Rabatt
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $umzug['discount'] }} CHF
                                    </div>
                                </div>
                            @endif

                            @if ($umzug['discountPercent'])
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Rabatt
                                    </div>
                                    <div class="col-md-6">
                                        {{ $umzug['discountPercent'] }}%
                                    </div>
                                </div>
                            @endif

                            @if ($umzug['compromiser'])
                                <div class="row mt-3">
                                    <div class="col-md-6">Entgegenkommen</div>
                                    <div class="col-md-6">
                                        - {{ $umzug['compromiser'] }} CHF
                                    </div>
                                </div>
                            @endif

                            @if ($umzug['extraCostPrice'])
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        @if ($umzug['extraCostName'])
                                            {{ $umzug['extraCostName'] }}:
                                        @else
                                            Custom Entgegenkommen:
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $umzug['extraCostPrice'] }} CHF
                                    </div>
                                </div>
                            @endif

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Geschätzte Kosten:
                                </div>
                                <div class="col-md-6">
                                    <span class="text-primary"> <strong>{{ $umzug['defaultPrice'] }} CHF</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Einpack Alanı --}}
                    @if ($isEinpack)

                        <div class="form-group row mt-3">
                            <div class="col-md-12 einpack-control">
                                <label for="" class="col-form-label">Einpack</label><br>
                                <input type="checkbox" name="isEinpack" id="isEinpack" class="js-switch "
                                    data-color="{{ App\Models\Company::InfoCompany('pdfPrimaryColor') }}" data-switchery="false" checked>
                            </div>
                        </div>

                        <div class="einpack--area bg-container" style="display: block;">
                            <div class="row mt-3">
                                <div class="col-md-12 text-primary">
                                    <h4> <strong class="text-primary">Einpack: </strong></h4>
                                </div>
                            </div>
                            <div class="c-border"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Packtermin:
                                </div>
                                <div class="col-md-6">
                                    @if ($einpack['einpackDate'])
                                        {{ date('d/m/Y', strtotime($einpack['einpackDate'])) }}
                                    @else
                                        -
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    Arbeitsbeginn
                                </div>
                                <div class="col-md-6">
                                    @if ($einpack['einpackTime'])
                                        {{ $einpack['einpackTime'] }}
                                    @else
                                        -
                                    @endif Uhr
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Tarif
                                </div>
                                <div class="col-md-6">
                                    {{ $einpack['ma'] }} Packmitarbeiter à CHF {{ $einpack['chf'] }}.-/Stunde
                                </div>

                                <div class="col-md-6">
                                    Anfahrt/Rückfahrt
                                </div>
                                <div class="col-md-6">
                                    {{ $einpack['arrivalReturn'] }} CHF
                                </div>

                                <div class="col-md-6">
                                    Geschätzter Arbeitsaufwand
                                </div>
                                <div class="col-md-6">
                                    {{ $einpack['moveHours'] }} Std
                                </div>

                                <div class="col-md-6">
                                    Zusatzkosten
                                </div>
                                <div class="col-md-6">
                                    @if ($einpack['extra'])
                                        Spesen {{ $einpack['extra'] }} CHF <br>
                                    @endif
                                    @if ($einpack['extra1'])
                                        Verpackungsmaterial {{ $einpack['extra1'] }} CHF <br>
                                    @endif
                                    @if ($einpack['customCostPrice1'])
                                        @if ($einpack['customCostName1'])
                                            {{ $einpack['customCostName1'] }}
                                        @else
                                            Freier Text 1
                                        @endif {{ $einpack['customCostPrice1'] }} CHF
                                    @endif
                                    @if ($einpack['customCostPrice2'])
                                        @if ($einpack['customCostName2'])
                                            {{ $einpack['customCostName2'] }}
                                        @else
                                            Freier Text 2
                                        @endif {{ $einpack['customCostPrice2'] }} CHF
                                    @endif
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Kosten:
                                </div>
                                <div class="col-md-6">
                                    <span class="text-primary"> <strong>{{ $einpack['costPrice'] }} CHF</strong>
                                    </span>
                                </div>
                            </div>
                            @if ($einpack['discount'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Rabatt
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $einpack['discount'] }} CHF
                                    </div>
                                </div>
                            @endif

                            @if ($einpack['discountPercent'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Rabatt
                                    </div>
                                    <div class="col-md-6">
                                        {{ $einpack['discountPercent'] }}%
                                    </div>
                                </div>
                            @endif

                            @if ($einpack['compromiser'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Entgegenkommen
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $einpack['compromiser'] }} CHF
                                    </div>
                                </div>
                            @endif

                            @if ($einpack['extraCostPrice'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        @if ($einpack['extraCostName'])
                                            {{ $einpack['extraCostName'] }}:
                                        @else
                                            Custom Entgegenkommen:
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $einpack['extraCostPrice'] }} CHF
                                    </div>
                                </div>
                            @endif

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Geschätzte Kosten:
                                </div>
                                <div class="col-md-6">
                                    <span class="text-primary"> <strong>{{ $einpack['defaultPrice'] }} CHF</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Auspack Alanı --}}
                    @if ($isAuspack)
                        <div class="form-group row mt-3">
                            <div class="col-md-12 auspack-control">
                                <label for="" class="col-form-label">Auspack</label><br>
                                <input type="checkbox" name="isAuspack" id="isAuspack" class="js-switch "
                                    data-color="{{ App\Models\Company::InfoCompany('pdfPrimaryColor') }}" data-switchery="false" checked>
                            </div>
                        </div>

                        <div class="auspack--area bg-container" style="display: block;">
                            <div class="row mt-3">
                                <div class="col-md-12 text-primary">
                                    <h4> <strong class="text-primary">Auspack: </strong></h4>
                                </div>
                            </div>
                            <div class="c-border"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Packtermin:
                                </div>
                                <div class="col-md-6">
                                    @if ($auspack['auspackDate'])
                                        {{ date('d/m/Y', strtotime($auspack['auspackDate'])) }}
                                    @else
                                        -
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    Arbeitsbeginn
                                </div>
                                <div class="col-md-6">
                                    @if ($auspack['auspackTime'])
                                        {{ $auspack['auspackTime'] }}
                                    @else
                                        -
                                    @endif Uhr
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Tarif
                                </div>
                                <div class="col-md-6">
                                    {{ $auspack['ma'] }} Packmitarbeiter à CHF {{ $auspack['chf'] }}.-/Stunde
                                </div>

                                <div class="col-md-6">
                                    Anfahrt/Rückfahrt
                                </div>
                                <div class="col-md-6">
                                    {{ $auspack['arrivalReturn'] }} CHF
                                </div>

                                <div class="col-md-6">
                                    Geschätzter Arbeitsaufwand
                                </div>
                                <div class="col-md-6">
                                    {{ $auspack['moveHours'] }} Std
                                </div>

                                <div class="col-md-6">
                                    Zusatzkosten
                                </div>
                                <div class="col-md-6">
                                    @if ($auspack['extra'])
                                        Spesen {{ $auspack['extra'] }} CHF <br>
                                    @endif
                                    @if ($auspack['extra1'])
                                        Verpackungsmaterial {{ $auspack['extra1'] }} CHF <br>
                                    @endif
                                    @if ($auspack['customCostPrice1'])
                                        @if ($auspack['customCostName1'])
                                            {{ $auspack['customCostName1'] }}
                                        @else
                                            Freier Text 1
                                        @endif {{ $auspack['customCostPrice1'] }} CHF
                                    @endif
                                    @if ($auspack['customCostPrice2'])
                                        @if ($auspack['customCostName2'])
                                            {{ $auspack['customCostName2'] }}
                                        @else
                                            Freier Text 2
                                        @endif {{ $auspack['customCostPrice2'] }} CHF
                                    @endif
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Kosten:
                                </div>
                                <div class="col-md-6">
                                    <span class="text-primary"> <strong>{{ $auspack['costPrice'] }} CHF</strong>
                                    </span>
                                </div>
                            </div>

                            @if ($auspack['discount'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Rabatt
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $auspack['discount'] }} CHF
                                    </div>
                                </div>
                            @endif

                            @if ($auspack['discountPercent'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Rabatt
                                    </div>
                                    <div class="col-md-6">
                                        {{ $auspack['discountPercent'] }}%
                                    </div>
                                </div>
                            @endif

                            @if ($auspack['compromiser'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Entgegenkommen
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $auspack['compromiser'] }} CHF
                                    </div>
                                </div>
                            @endif

                            @if ($auspack['extraCostPrice'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        @if ($auspack['extraCostName'])
                                            {{ $auspack['extraCostName'] }}:
                                        @else
                                            Custom Entgegenkommen:
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $auspack['extraCostPrice'] }} CHF
                                    </div>
                                </div>
                            @endif

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Geschätzte Kosten:
                                </div>
                                <div class="col-md-6">
                                    <span class="text-primary"> <strong>{{ $auspack['defaultPrice'] }} CHF</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Reinigung Alanı --}}
                    @if ($isReinigung)

                        <div class="form-group row mt-3">
                            <div class="col-md-12 reinigung-control">
                                <label for="" class="col-form-label">Reinigung</label><br>
                                <input type="checkbox" name="isReinigung" id="isReinigung" class="js-switch "
                                    data-color="{{ App\Models\Company::InfoCompany('pdfPrimaryColor') }}" data-switchery="false" checked>
                            </div>
                        </div>

                        <div class="reinigung--area bg-container" style="display: block;">
                            <div class="row mt-3">
                                <div class="col-md-12 text-dark">
                                    <h4> <strong class="text-primary">Reinigung: </strong>
                                        {{ $reinigung['reinigungType'] }} </h4>
                                </div>
                            </div>
                            <div class="c-border"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Reinigungstermin
                                </div>
                                <div class="col-md-6">
                                    @if ($reinigung['startDate'])
                                        {{ date('d/m/Y', strtotime($reinigung['startDate'])) }}
                                    @else
                                        -
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    Arbeitsbeginn
                                </div>
                                <div class="col-md-6">
                                    @if ($reinigung['startTime'])
                                        {{ $reinigung['startTime'] }}
                                    @else
                                        -
                                    @endif Uhr
                                </div>

                                <div class="col-md-6">
                                    Abgabetermin
                                </div>
                                <div class="col-md-6">
                                    @if ($reinigung['endDate'])
                                        {{ date('d/m/Y', strtotime($reinigung['endDate'])) }}
                                    @else
                                        -
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    Abgabezeit
                                </div>
                                <div class="col-md-6">
                                    @if ($reinigung['endTime'])
                                        {{ $reinigung['endTime'] }}
                                    @else
                                        -
                                    @endif Uhr
                                </div>

                                <div class="col-md-6">
                                    Dübellöcher zuspachteln
                                </div>
                                <div class="col-md-6">
                                    @if ($reinigung['extraService1'] == 1)
                                        Ja
                                    @else
                                        Nein
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    Mit Hochdruckreiniger
                                </div>
                                <div class="col-md-6">
                                    @if ($reinigung['extraService2'] == 1)
                                        Ja
                                    @else
                                        Nein
                                    @endif
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    @if ($reinigung['fixedTariff'])
                                        Zimmer:
                                    @else
                                        Tariff:
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    @if ($reinigung['fixedTariff'])
                                        {{ Str::substr(\App\Models\Tariff::infoTariff($reinigung['fixedTariff'], 'description'), 0, 12) }}
                                        à CHF {{ $reinigung['fixedTariffPrice'] }}
                                    @else
                                        {{ $reinigung['ma'] }} Mitarbeiter à CHF {{ $reinigung['chf'] }}.- / Stunde
                                    @endif
                                </div>

                                @if ($reinigung['fixedTariff'])
                                    <div class="col-md-6">
                                        Pauchal
                                    </div>
                                    <div class="col-md-6">
                                        {{ $reinigung['fixedTariffPrice'] }} CHF
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        Geschätzter Arbeitsaufwand
                                    </div>
                                    <div class="col-md-6">
                                        {{ $reinigung['hours'] }} Std
                                    </div>
                                @endif

                                <div class="col-md-6">
                                    Zusatzkosten
                                </div>
                                <div class="col-md-6">
                                    @if ($reinigung['extra1'])
                                        Hochdruckreiniger {{ $reinigung['extra1'] }} CHF <br>
                                    @endif
                                    @if ($reinigung['extra2'])
                                        Stein- und Parkettböden {{ $reinigung['extra2'] }} CHF <br>
                                    @endif
                                    @if ($reinigung['extra3'])
                                        Teppichschamponieren {{ $reinigung['extra3'] }} CHF <br>
                                    @endif
                                    @if ($reinigung['extraCostValue1'])
                                        @if ($reinigung['extraCostText1'])
                                            {{ $reinigung['extraCostText1'] }}
                                        @else
                                            Zusatzkosten 1
                                        @endif {{ $reinigung['extraCostValue1'] }} CHF
                                    @endif
                                    @if ($reinigung['extraCostValue2'])
                                        @if ($reinigung['extraCostText2'])
                                            {{ $reinigung['extraCostText2'] }}
                                        @else
                                            Zusatzkosten 2
                                        @endif {{ $reinigung['extraCostValue2'] }} CHF
                                    @endif
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Kosten:
                                </div>
                                <div class="col-md-6">
                                    <span class="text-primary"> <strong>{{ $reinigung['costPrice'] }} CHF</strong>
                                    </span>
                                </div>
                            </div>

                            @if ($reinigung['discount'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        @if ($reinigung['discountText'])
                                            {{ $reinigung['discountText'] }}:
                                        @else
                                            Rabatt:
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $reinigung['discount'] }} CHF
                                    </div>
                                </div>
                            @endif

                            @if ($reinigung['discountPercent'])
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Rabatt
                                    </div>
                                    <div class="col-md-6">
                                        {{ $reinigung['discountPercent'] }}%
                                    </div>
                                </div>
                            @endif

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    @if ($reinigung['fixedTariff'])
                                        Pauschal:
                                    @else
                                        Geschätzte Kosten:
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <span class="text-primary"> <strong>{{ $reinigung['totalPrice'] }} CHF</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Reinigung 2 Alanı --}}
                    @if ($isReinigung2)
                        <div class="form-group row mt-3">
                            <div class="col-md-12 reinigung2-control">
                                <label for="" class="col-form-label">Reinigung 2</label><br>
                                <input type="checkbox" name="isReinigung2" id="isReinigung2" class="js-switch "
                                    data-color="{{ App\Models\Company::InfoCompany('pdfPrimaryColor') }}" data-switchery="false" checked>
                            </div>
                        </div>

                        <div class="reinigung2--area bg-container" style="display: block;">
                            <div class="row mt-3">
                                <div class="col-md-12 text-dark">
                                    <h4> <strong class="text-primary">Reinigung 2: </strong>
                                        {{ $reinigung2['reinigungType'] }} </h4>
                                </div>
                            </div>
                            <div class="c-border"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Reinigungstermin
                                </div>
                                <div class="col-md-6">
                                    @if ($reinigung2['startDate'])
                                        {{ date('d/m/Y', strtotime($reinigung2['startDate'])) }}
                                    @else
                                        -
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    Arbeitsbeginn
                                </div>
                                <div class="col-md-6">
                                    @if ($reinigung2['startTime'])
                                        {{ $reinigung2['startTime'] }}
                                    @else
                                        -
                                    @endif Uhr
                                </div>

                                <div class="col-md-6">
                                    Abgabetermin
                                </div>
                                <div class="col-md-6">
                                    @if ($reinigung2['endDate'])
                                        {{ date('d/m/Y', strtotime($reinigung2['endDate'])) }}
                                    @else
                                        -
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    Abgabezeit
                                </div>
                                <div class="col-md-6">
                                    @if ($reinigung2['endTime'])
                                        {{ $reinigung2['endTime'] }}
                                    @else
                                        -
                                    @endif Uhr
                                </div>

                                <div class="col-md-6">
                                    Dübellöcher zuspachteln
                                </div>
                                <div class="col-md-6">
                                    @if ($reinigung2['extraService1'] == 1)
                                        Ja
                                    @else
                                        Nein
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    Mit Hochdruckreiniger
                                </div>
                                <div class="col-md-6">
                                    @if ($reinigung2['extraService2'] == 1)
                                        Ja
                                    @else
                                        Nein
                                    @endif
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Kosten:
                                </div>
                                <div class="col-md-6">
                                    <span class="text-primary"> <strong>{{ $reinigung2['costPrice'] }} CHF</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    @if ($reinigung2['fixedTariff'])
                                        Zimmer:
                                    @else
                                        Tariff:
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    @if ($reinigung2['fixedTariff'])
                                        {{ Str::substr(\App\Models\Tariff::infoTariff($reinigung2['fixedTariff'], 'description'), 0, 12) }}
                                        à CHF {{ $reinigung2['fixedTariffPrice'] }}
                                    @else
                                        {{ $reinigung2['ma'] }} Mitarbeiter à CHF {{ $reinigung2['chf'] }}.- /
                                        Stunde
                                    @endif
                                </div>

                                @if ($reinigung2['fixedTariff'])
                                    <div class="col-md-6">
                                        Pauchal
                                    </div>
                                    <div class="col-md-6">
                                        {{ $reinigung2['fixedTariffPrice'] }} CHF
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        Geschätzter Arbeitsaufwand
                                    </div>
                                    <div class="col-md-6">
                                        {{ $reinigung2['hours'] }} Std
                                    </div>
                                @endif

                                <div class="col-md-6">
                                    Zusatzkosten
                                </div>
                                <div class="col-md-6">
                                    @if ($reinigung2['extra1'])
                                        Hochdruckreiniger {{ $reinigung2['extra1'] }} CHF <br>
                                    @endif
                                    @if ($reinigung2['extra2'])
                                        Stein- und Parkettböden {{ $reinigung2['extra2'] }} CHF <br>
                                    @endif
                                    @if ($reinigung2['extra3'])
                                        Teppichschamponieren {{ $reinigung2['extra3'] }} CHF <br>
                                    @endif
                                    @if ($reinigung2['extraCostValue1'])
                                        @if ($reinigung2['extraCostText1'])
                                            {{ $reinigung2['extraCostText1'] }}
                                        @else
                                            Zusatzkosten 1
                                        @endif {{ $reinigung2['extraCostValue1'] }} CHF
                                    @endif
                                    @if ($reinigung2['extraCostValue2'])
                                        @if ($reinigung2['extraCostText2'])
                                            {{ $reinigung2['extraCostText2'] }}
                                        @else
                                            Zusatzkosten 2
                                        @endif {{ $reinigung2['extraCostValue2'] }} CHF
                                    @endif
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            @if ($reinigung2['discount'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        @if ($reinigung2['discountText'])
                                            {{ $reinigung2['discountText'] }}:
                                        @else
                                            Rabatt:
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $reinigung2['discount'] }} CHF
                                    </div>
                                </div>
                            @endif

                            @if ($reinigung2['discountPercent'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Rabatt
                                    </div>
                                    <div class="col-md-6">
                                        {{ $reinigung2['discountPercent'] }}%
                                    </div>
                                </div>
                            @endif

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    @if ($reinigung2['fixedTariff'])
                                        Pauschal:
                                    @else
                                        Geschätzte Kosten:
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <span class="text-primary"> <strong>{{ $reinigung2['totalPrice'] }} CHF</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Entsorgung Alanı --}}
                    @if ($isEntsorgung)
                        <div class="form-group row mt-3">
                            <div class="col-md-12 entsorgung-control">
                                <label for="" class="col-form-label">Entsorgung</label><br>
                                <input type="checkbox" name="isEntsorgung" id="isEntsorgung" class="js-switch "
                                    data-color="{{ App\Models\Company::InfoCompany('pdfPrimaryColor') }}" data-switchery="false" checked>
                            </div>
                        </div>

                        <div class="entsorgung--area bg-container" style="display: block;">
                            <div class="row mt-3">
                                <div class="col-md-12 text-dark">
                                    <h4> <strong class="text-primary">Entsorgung: </strong></h4>
                                </div>
                            </div>
                            <div class="c-border"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Entsorgungstermin:
                                </div>
                                <div class="col-md-6">
                                    @if ($entsorgung['entsorgungDate'])
                                        {{ date('d/m/Y', strtotime($entsorgung['entsorgungDate'])) }}
                                    @else
                                        -
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    Arbeitsbeginn
                                </div>
                                <div class="col-md-6">
                                    @if ($entsorgung['entsorgungTime'])
                                        {{ $entsorgung['entsorgungTime'] }}
                                    @else
                                        -
                                    @endif Uhr
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    @if ($entsorgung['tariff'])
                                    <b>Tarif</b>
                                    @else
                                    <b>Entsorgungstarif</b>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    @if ($entsorgung['tariff'])
                                        {{ $entsorgung['ma'] }} Mitarbeiter mit {{ $entsorgung['lkw'] }} Lieferwagen
                                        @if ($entsorgung['anhanger'])
                                            und {{ $entsorgung['anhanger'] }} Anhänger
                                        @endif à CHF {{ $entsorgung['chf'] }}.- / Stunde
                                    @endif

                                    @if ($entsorgung['volume'])
                                        CHF {{ $entsorgung['volumeCHF'] }}.- pro m3
                                    @endif
                                </div>

                                <div class="col-md-6">
                                   <b>Anfahrt/Rückfahrt</b>
                                </div>
                                <div class="col-md-6">
                                    {{ $entsorgung['arrivalReturn'] }} CHF
                                </div>

                                <div class="col-md-6">

                                    @if ($entsorgung['fixedCost'])
                                    <b>Entsorgungsaufwand</b>
                                    @else
                                    <b>Geschätzter Arbeitsaufwand</b>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    @if ($entsorgung['fixedCost'])
                                        {{ $entsorgung['fixedCost'] }} CHF - pauschal (Aufwand an der Entsorgungsstelle)
                                        @else {{ $entsorgung['hour'] }} Std
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <b>Geschätztes Volumen</b>
                                </div>
                                <div class="col-md-6">
                                    {{ $entsorgung['m3'] }} m³
                                </div>

                                <div class="col-md-6">
                                    <b>Zusatzkosten</b>
                                </div>
                                <div class="col-md-6">
                                    @if ($entsorgung['entsorgungExtra1'])
                                        Spesen {{ $entsorgung['entsorgungExtra1'] }} CHF <br>
                                    @endif
                                    @if ($entsorgung['extraCostValue1'])
                                        @if ($entsorgung['extraCostText1'])
                                            <b>{{ $entsorgung['extraCostText1'] }}</b>
                                        @else
                                            <b>Freier Text 1</b>
                                        @endif {{ $entsorgung['extraCostValue1'] }} CHF
                                    @endif
                                    @if ($entsorgung['extraCostValue2'])
                                        @if ($entsorgung['extraCostText2'])
                                            <b>{{ $entsorgung['extraCostText2'] }}</b>
                                        @else
                                            <b>Freier Text 2</b>
                                        @endif {{ $entsorgung['extraCostValue2'] }} CHF
                                    @endif
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            @if ($entsorgung['discount'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        @if ($entsorgung['discountText'])
                                            {{ $entsorgung['discountText'] }}:
                                        @else
                                            Rabatt:
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $entsorgung['discount'] }} CHF
                                    </div>
                                </div>
                            @endif

                            @if ($entsorgung['discountPercent'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Rabatt
                                    </div>
                                    <div class="col-md-6">
                                        {{ $entsorgung['discountPercent'] }}%
                                    </div>
                                </div>
                            @endif

                            @if ($entsorgung['extraDiscountPrice'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        @if ($entsorgung['extraDiscountText'])
                                            {{ $entsorgung['extraDiscountText'] }}:
                                        @else
                                            Rabatt:
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $entsorgung['extraDiscountPrice'] }} CHF
                                    </div>
                                </div>
                            @endif

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Geschätzte Kosten:
                                </div>
                                <div class="col-md-6">
                                    <span class="text-primary"> <strong>{{ $entsorgung['defaultPrice'] }}
                                            CHF</strong> </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Transport Alanı --}}
                    @if ($isTransport)
                        <div class="form-group row mt-3">
                            <div class="col-md-12 transport-control">
                                <label for="" class="col-form-label">Transport</label><br>
                                <input type="checkbox" name="isTransport" id="isTransport" class="js-switch "
                                    data-color="{{ App\Models\Company::InfoCompany('pdfPrimaryColor') }}" data-switchery="false" checked>
                            </div>
                        </div>

                        <div class="transport--area bg-container" style="display: block;">
                            <div class="row mt-3">
                                <div class="col-md-12 text-dark">
                                    <h4> <strong class="text-primary">Transport: </strong></h4>
                                </div>
                            </div>
                            <div class="c-border"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Transporttermin:
                                </div>
                                <div class="col-md-6">
                                    @if ($transport['transportDate'])
                                        {{ date('d/m/Y', strtotime($transport['transportDate'])) }}
                                    @else
                                        -
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    Arbeitsbeginn
                                </div>
                                <div class="col-md-6">
                                    @if ($transport['transportTime'])
                                        {{ $transport['transportTime'] }}
                                    @else
                                        -
                                    @endif Uhr
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            <div class="row mt-3">

                                @if ($transport['fixedChf'])
                                    <div class="col-md-6">
                                        Pauschal
                                    </div>
                                    <div class="col-md-6">
                                        {{ $transport['fixedChf'] }} CHF
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        Tarif
                                    </div>
                                    <div class="col-md-6">
                                        {{ $transport['ma'] }} Mitarbeiter mit {{ $transport['lkw'] }} Lieferwagen
                                        @if ($transport['anhanger'])
                                            und {{ $transport['anhanger'] }} Anhänger
                                        @endif à CHF {{ $transport['chf'] }}.- / Stunde
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    Anfahrt/Rückfahrt
                                </div>
                                <div class="col-md-6">
                                    {{ $transport['arrivalReturn'] }} CHF
                                </div>

                                <div class="col-md-6">
                                    Geschätzter Arbeitsaufwand
                                </div>
                                <div class="col-md-6">
                                    {{ $transport['hour'] }} Std
                                </div>

                                <div class="col-md-6">
                                    Zusatzkosten
                                </div>
                                <div class="col-md-6">
                                    @if ($transport['extraCostValue1'] != 0)
                                        @if ($transport['extraCostText1'])
                                            {{ $transport['extraCostText1'] }}
                                        @else
                                            Zusatzkosten 1
                                        @endif {{ $transport['extraCostValue1'] }} CHF <br>
                                    @endif
                                    @if ($transport['extraCostValue2'] != 0)
                                        @if ($transport['extraCostText2'])
                                            {{ $transport['extraCostText2'] }}
                                        @else
                                            Zusatzkosten 2
                                        @endif {{ $transport['extraCostValue2'] }} CHF <br>
                                    @endif
                                    @if ($transport['extraCostValue3'] != 0)
                                        @if ($transport['extraCostText3'])
                                            {{ $transport['extraCostText3'] }}
                                        @else
                                            Zusatzkosten 3
                                        @endif {{ $transport['extraCostValue3'] }} CHF <br>
                                    @endif
                                    @if ($transport['extraCostValue4'] != 0)
                                        @if ($transport['extraCostText4'])
                                            {{ $transport['extraCostText4'] }}
                                        @else
                                            Zusatzkosten 4
                                        @endif {{ $transport['extraCostValue4'] }} CHF <br>
                                    @endif
                                    @if ($transport['extraCostValue5'] != 0)
                                        @if ($transport['extraCostText5'])
                                            {{ $transport['extraCostText5'] }}
                                        @else
                                            Zusatzkosten 5
                                        @endif {{ $transport['extraCostValue5'] }} CHF <br>
                                    @endif
                                    @if ($transport['extraCostValue6'] != 0)
                                        @if ($transport['extraCostText6'])
                                            {{ $transport['extraCostText6'] }}
                                        @else
                                            Zusatzkosten 6
                                        @endif {{ $transport['extraCostValue6'] }} CHF <br>
                                    @endif
                                    @if ($transport['extraCostValue7'] != 0)
                                        @if ($transport['extraCostText7'])
                                            {{ $transport['extraCostText7'] }}
                                        @else
                                            Zusatzkosten 7
                                        @endif {{ $transport['extraCostValue7'] }} CHF <br>
                                    @endif
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    @if ($transport['fixedChf'] != 0)
                                        Pauschal:
                                    @else
                                        Kosten:
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <span class="text-primary"> <strong>
                                        @if($transport['fixedChf'] != 0)
                                        {{ $transport['fixedChf'] }} CHF
                                        @else {{ $transport['totalPrice'] }} CHF
                                        @endif
                                    </strong>
                                    </span>
                                </div>
                            </div>

                            @if ($transport['discount'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Rabatt
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $transport['discount'] }} CHF
                                    </div>
                                </div>
                            @endif

                            @if ($transport['discountPercent'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Rabatt
                                    </div>
                                    <div class="col-md-6">
                                        {{ $transport['discountPercent'] }}%
                                    </div>
                                </div>
                            @endif

                            @if ($transport['compromiser'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Entgegenkommen
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $transport['compromiser'] }} CHF
                                    </div>
                                </div>
                            @endif

                            @if ($transport['extraDiscountValue'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        @if ($transport['extraDiscountText'])
                                            {{ $transport['extraDiscountText'] }}:
                                        @else
                                            Rabatt:
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $transport['extraDiscountValue'] }} CHF
                                    </div>
                                </div>
                            @endif

                            @if ($transport['extraDiscountValue2'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        @if ($transport['extraDiscountText2'])
                                            {{ $transport['extraDiscountText2'] }}:
                                        @else
                                            Rabatt 2:
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $transport['extraDiscountValue2'] }} CHF
                                    </div>
                                </div>
                            @endif

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    @if ($transport['fixedChf'] != 0)
                                        Pauschal:
                                    @else
                                        Geschätzte Kosten:
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <span class="text-primary"> <strong>{{ $transport['defaultPrice'] }} CHF</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Lagerung Alanı --}}
                    @if ($isLagerung)

                        <div class="form-group row mt-3">
                            <div class="col-md-12 lagerung-control">
                                <label for="" class="col-form-label">Lagerung</label><br>
                                <input type="checkbox" name="isLagerung" id="isLagerung" class="js-switch "
                                    data-color="{{ App\Models\Company::InfoCompany('pdfPrimaryColor') }}" data-switchery="false" checked>
                            </div>
                        </div>

                        <div class="lagerung--area bg-container" style="display: block;">
                            <div class="row mt-3">
                                <div class="col-md-12 text-dark">
                                    <h4> <strong class="text-primary">Lagerung: </strong></h4>
                                </div>
                            </div>
                            <div class="c-border"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Volumen:
                                </div>
                                <div class="col-md-6">
                                    {{ $lagerung['volume'] }} m³
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Tarif
                                </div>
                                <div class="col-md-6">
                                    CHF {{ $lagerung['chf'] }}.- pro m3 im Monat
                                </div>

                                <div class="col-md-6">
                                    Zusatzkosten
                                </div>
                                <div class="col-md-6">
                                    @if ($lagerung['extraCostValue1'] != 0)
                                        @if ($lagerung['extraCostText1'])
                                            {{ $lagerung['extraCostText1'] }}
                                        @else
                                            Zusatzkosten 1
                                        @endif {{ $lagerung['extraCostValue1'] }} CHF <br>
                                    @endif
                                    @if ($lagerung['extraCostValue2'] != 0)
                                        @if ($lagerung['extraCostText2'])
                                            {{ $lagerung['extraCostText2'] }}
                                        @else
                                            Zusatzkosten 2
                                        @endif {{ $lagerung['extraCostValue2'] }} CHF <br>
                                    @endif
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Kosten:
                                </div>
                                <div class="col-md-6">
                                    <span class="text-primary"> <strong>{{ $lagerung['costPrice'] }} CHF</strong>
                                    </span>
                                </div>
                            </div>

                            @if ($lagerung['discountValue'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        @if ($lagerung['discountText'])
                                            {{ $lagerung['discountText'] }}:
                                        @else
                                            Rabatt:
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $lagerung['discountValue'] }} CHF
                                    </div>
                                </div>
                            @endif

                            @if ($lagerung['discountPercent'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Rabatt
                                    </div>
                                    <div class="col-md-6">
                                        {{ $lagerung['discountPercent'] }}%
                                    </div>
                                </div>
                            @endif

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Geschätzte Kosten:
                                </div>
                                <div class="col-md-6">
                                    <span class="text-primary"> <strong>{{ $lagerung['totalPrice'] }} CHF</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Material Alanı --}}
                    @if ($isMaterial)
                        <div class="form-group row mt-3">
                            <div class="col-md-12 material-control">
                                <label for="" class="col-form-label">Material</label><br>
                                <input type="checkbox" name="isMaterial" id="isMaterial" class="js-switch "
                                    data-color="{{ App\Models\Company::InfoCompany('pdfPrimaryColor') }}" data-switchery="false" checked>
                            </div>
                        </div>

                        <div class="material--area bg-container" style="display: block;">
                            <div class="row mt-3">
                                <div class="col-md-12 text-dark">
                                    <h4> <strong class="text-primary">Verpackungsmaterial </strong> </h4>
                                </div>
                            </div>
                            <div class="c-border"></div>

                            <div class="row mt-5">
                                <div class="col"> <strong>Art</strong></div>
                                <div class="col"> <strong>zur Miete/Kauf</strong></div>
                                <div class="col"> <strong>Preis pro Stk</strong></div>
                                <div class="col"> <strong>Anzahl</strong></div>
                                <div class="col"> <strong>Total</strong></div>
                            </div>
                            <div class="c-border"></div>
                            @foreach ($basket as $k => $v)
                                <div class="row mt-2">
                                    <div class="col">{{ \App\Models\Product::productName($v['productId']) }}</div>
                                    <div class="col">
                                        @if ($v['buyType'] == 1)
                                            Kauf
                                        @elseif($v['buyType'] == 2)
                                            Miete
                                        @else
                                            -
                                        @endif
                                    </div>
                                    <div class="col">
                                        @if ($v['buyType'] == 1)
                                            {{ \App\Models\Product::buyPrice($v['productId']) }}
                                        @elseif ($v['buyType'] == 2)
                                            {{ \App\Models\Product::rentPrice($v['productId']) }}
                                        @else
                                            -
                                        @endif
                                    </div>
                                    <div class="col">{{ $v['quantity'] }}</div>
                                    <div class="col">{{ $v['totalPrice'] }}</div>
                                    <hr>
                                </div>
                            @endforeach
                            <div class="c-border"></div>

                            @if ($material['discountPercent'])
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Rabatt:
                                    </div>
                                    <div class="col-md-6">
                                        {{ $material['discountPercent'] }}%
                                    </div>
                                </div>
                            @endif

                            @if ($material['discount'])
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Rabatt:
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $material['discount'] }} CHF
                                    </div>
                                </div>
                            @endif

                            @if ($material['deliverPrice'])
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Lieferung:
                                    </div>
                                    <div class="col-md-6">
                                        {{ $material['deliverPrice'] }} CHF
                                    </div>
                                </div>
                            @endif

                            @if ($material['recievePrice'] != 0)
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Abholung:
                                    </div>
                                    <div class="col-md-6">
                                        {{ $material['recievePrice'] }} CHF
                                    </div>
                                </div>
                            @endif

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Geschätzte Kosten:
                                </div>
                                <div class="col-md-6">
                                    <span class="text-primary"> <strong>{{ $material['totalPrice'] }} CHF</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Sağ Kısım --}}
                <div id="rightDiv" class="col-md-4 bg-white  mt-5  b-shadow rounded-custom sticky-top"
                    style="top:20px;">
                    <div class="row mt-1">

                        <div class="col-md-12  text-white py-2 rounded-custom-2 mb-1 d-flex justify-content-center align-items-center bg-preview-primary"
                            style="margin-top:-10px!important;">
                            <b class=" text-white custom-font" style="font-size:20px;">Angebotsübersicht</b><br><br>
                        </div>

                        <div class="col-md-12 px-3 py-3">

                            @if ($isUmzug)
                                <div class="row d-flex justify-content-center align-items-center">
                                    <table class="w-100 ">
                                        <tr>
                                            <td><b class="h6 text-dark custom-font">Umzug:</b></td>
                                            <td align="right"><b class="h6 text-primary custom-font"><span
                                                        class="ucret">{{ $umzug['defaultPrice'] }}</span> CHF</b>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            @if ($isEinpack)
                                <div class="row d-flex justify-content-center align-items-center mt-1">
                                    <table class="w-100 ">
                                        <tr>
                                            <td><b class="h6 text-dark custom-font">Einpack:</b></td>
                                            <td align="right"><b class="h6 text-primary custom-font"><span
                                                        class="ucret">{{ $einpack['defaultPrice'] }}</span> CHF</b>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            @if ($isAuspack)
                                <div class="row d-flex justify-content-center align-items-center mt-1">
                                    <table class="w-100 ">
                                        <tr>
                                            <td><b class="h6 text-dark custom-font">Auspack:</b></td>
                                            <td align="right"><b class="h6 text-primary custom-font"><span
                                                        class="ucret">{{ $auspack['defaultPrice'] }}</span> CHF</b>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            @if ($isReinigung)
                                <div class="row d-flex justify-content-center align-items-center mt-1">
                                    <table class="w-100 ">
                                        <tr>
                                            <td><b class="h6 text-dark custom-font">Reinigung:</b></td>
                                            <td align="right"><b class="h6 text-primary custom-font"><span
                                                        class="ucret">{{ $reinigung['totalPrice'] }}</span> CHF</b>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            @if ($isReinigung2)
                                <div class="row d-flex justify-content-center align-items-center mt-1">
                                    <table class="w-100 ">
                                        <tr>
                                            <td><b class="h6 text-dark custom-font">Reinigung 2:</b></td>
                                            <td align="right"><b class="h6 text-primary custom-font"><span
                                                        class="ucret">{{ $reinigung2['totalPrice'] }}</span> CHF</b>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            @if ($isEntsorgung)
                                <div class="row d-flex justify-content-center align-items-center mt-1">
                                    <table class="w-100 ">
                                        <tr>
                                            <td><b class="h6 text-dark custom-font">Entsorgung:</b></td>
                                            <td align="right"><b class="h6 text-primary custom-font"><span
                                                        class="ucret">{{ $entsorgung['defaultPrice'] }}</span>
                                                    CHF</b></td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            @if ($isTransport)
                                <div class="row d-flex justify-content-center align-items-center mt-1">
                                    <table class="w-100 ">
                                        <tr>
                                            <td><b class="h6 text-dark custom-font">Transport:</b></td>
                                            <td align="right"><b class="h6 text-primary custom-font"><span
                                                        class="ucret">{{ $transport['defaultPrice'] }}</span>
                                                    CHF</b></td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            @if ($isLagerung)
                                <div class="row d-flex justify-content-center align-items-center mt-1">
                                    <table class="w-100 ">
                                        <tr>
                                            <td><b class="h6 text-dark custom-font">Lagerung:</b></td>
                                            <td align="right"><b class="h6 text-primary custom-font"><span
                                                        class="ucret">{{ $lagerung['totalPrice'] }}</span> CHF</b>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            @if ($isMaterial)
                                <div class="row d-flex justify-content-center align-items-center mt-1">
                                    <table class="w-100 ">
                                        <tr>
                                            <td><b class="h6 text-dark custom-font">Material:</b></td>
                                            <td align="right"><b class="h6 text-primary custom-font"><span
                                                        class="ucret">{{ $material['totalPrice'] }}</span> CHF</b>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            @endif

                            {{-- <div class="row d-flex justify-content-center align-items-center mt-3 pt-1" style="border-top-width:1px;border-top-style:solid; border-top-color:#c3aaf8;">
                                <div class="col-md-6 text-left"><b class="h6 text-dark custom-font">Total:</b></div>
                                <div class="col-md-6 text-right"><b class="h6 text-primary custom-font"><span id="toplamUcret">0</span> CHF</b></div>
                            </div> --}}
                        </div>

                        <div class="col-md-12 mt-3  d-flex justify-content-center">
                            <table>
                                <tr>
                                    <td align="center">
                                        <a href="{{ route('showPdf', ['token' => $token]) }}" target="_blank"
                                            class="text-primary text-center">
                                            <img src="{{ asset('assets/img/PDF_icon.png') }}" alt=""
                                                width="50"></a>
                                    </td>
                                    <td align="center" class="pl-3">
                                        <a href="{{ asset('assets/demo/AGB.pdf') }}"
                                            class="text-primary text-center" target="_blank">
                                            <img src="{{ asset('assets/img/PDF_icon.png') }}" alt=""
                                                width="50"></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">Offerte</td>
                                    <td align="center" class="pl-3">AGB</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-12 mt-1 d-flex justify-content-center align-items-center p-2">
                            @if ($offer['offerteStatus'] == 'Onaylandı')
                                <span class="btn h6 text-white  p-3" style="background-color: #28A745"><b>Dieses
                                        Angebot wurde bereits bestätigt.</b></span>
                            @elseif($offer['offerteStatus'] == 'Onaylanmadı')
                                <span class="btn h6 text-white  p-3" style="background-color: #DC3545"><b>Dieses
                                        Angebot wurde bereits ablehnen.</b></span>
                            @elseif($offer['offerteStatus'] == 'Beklemede')
                                <form action="" method="POST">
                                    @csrf
                                    <div class="col-md-12 d-flex justify-content-center align-items-center p-0">
                                        <div class="row form-group m-0">
                                            <div class="col-md-12 ">
                                                <label for="" class="col-form-label">Mitteilung an den
                                                    Kundenberater</label><br>
                                                <textarea class="form-control" name="offerteVerifyNote" id="" cols="5" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 d-flex justify-content-center align-items-center p-1">
                                        <div class="row d-flex">
                                            <div class="form-actions d-flex justify-content-center">
                                                <div class="form-group row d-flex justify-content-center">
                                                    <span class=" mt-3 h5"><strong>Angebot:</strong></span>
                                                    <div
                                                        class="col-md-12 d-flex justify-content-center  ml-md-auto mt-1 btn-list">
                                                        <input class="btn btn-success btn-rounded " type="submit"
                                                            value=" Annehmen "
                                                            formaction="{{ URL::to('/verifyoffer', ['token' => $oToken]) }}">
                                                        <input class="btn btn-rounded text-white bg-preview-primary" type="submit"
                                                            value=" Ablehnen"
                                                            formaction="{{ URL::to('/rejectoffer', ['token' => $oToken]) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endif
                            {{-- <a href="{{ route('acceptOfferView', App\Models\OfferVerify::getToken($offer['id'])) }}" target="_blank" class="btn btn-primary w-100 d-flex justify-content-center align-items-center rounded-custom"><strong>Genehmigen oder ablehnen</strong></a> --}}
                        </div>
                    </div>
                    <div class="row">

                    </div>
                </div>
            </div>
            <div class="sag" style=" ">

            </div>

            <div class="row border-top mt-3 mb-3">
                <div class="col-md-12 px-1 pt-1 text-dark justify-content-left">
                    <img src="{{ asset('assets/img/swiss-pdf-last-page.png') }}" class="img-fluid mt-3" alt="">
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.2/umd/popper.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.0/metisMenu.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/js/perfect-scrollbar.jquery.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/1.9.2/countUp.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mithril/1.1.1/mithril.js"></script>
    <script src="{{ asset('assets/vendors/theme-widgets/widgets.js') }}"></script>
    <script type="text/javascript"
        src="https://www.provenexpert.com/widget/landing_swiss-transport-ag.js?feedback=1&avatar=1&competence=1&style=white"
        async></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script>
        function resizeDiv() {
            var div = document.getElementById("rightDiv");
            var content = div.innerHTML;
            var lines = content.split(/\r\n|\r|\n/);
            var numLines = lines.length;
            var lineHeight = 7.5; // varsayılan satır yüksekliği
            var maxHeight = numLines * lineHeight;
            div.style.maxHeight = maxHeight + "px";

        }
    </script>
    <script>
        var morebutton2 = $("div.umzug-control");
        morebutton2.click(function() {
            if ($(this).hasClass("checkbox-checked")) {
                $(".umzug--area").show(700);
            } else {
                $(".umzug--area").hide(500);
            }
        })

        var morebutton3 = $("div.einpack-control");
        morebutton3.click(function() {
            if ($(this).hasClass("checkbox-checked")) {
                $(".einpack--area").show(700);
            } else {
                $(".einpack--area").hide(500);
            }
        })

        var morebutton4 = $("div.auspack-control");
        morebutton4.click(function() {
            if ($(this).hasClass("checkbox-checked")) {
                $(".auspack--area").show(700);
            } else {
                $(".auspack--area").hide(500);
            }
        })

        var morebutton5 = $("div.reinigung-control");
        morebutton5.click(function() {
            if ($(this).hasClass("checkbox-checked")) {
                $(".reinigung--area").show(700);
            } else {
                $(".reinigung--area").hide(500);
            }
        })

        var morebutton6 = $("div.reinigung2-control");
        morebutton6.click(function() {
            if ($(this).hasClass("checkbox-checked")) {
                $(".reinigung2--area").show(700);
            } else {
                $(".reinigung2--area").hide(500);
            }
        })

        var morebutton7 = $("div.entsorgung-control");
        morebutton7.click(function() {
            if ($(this).hasClass("checkbox-checked")) {
                $(".entsorgung--area").show(700);
            } else {
                $(".entsorgung--area").hide(500);
            }
        })

        var morebutton8 = $("div.transport-control");
        morebutton8.click(function() {
            if ($(this).hasClass("checkbox-checked")) {
                $(".transport--area").show(700);
            } else {
                $(".transport--area").hide(500);
            }
        })

        var morebutton9 = $("div.lagerung-control");
        morebutton9.click(function() {
            if ($(this).hasClass("checkbox-checked")) {
                $(".lagerung--area").show(700);
            } else {
                $(".lagerung--area").hide(500);
            }
        })

        var morebutton10 = $("div.material-control");
        morebutton10.click(function() {
            if ($(this).hasClass("checkbox-checked")) {
                $(".material--area").show(700);
            } else {
                $(".material--area").hide(500);
            }
        })
    </script>

    <script>
        let TotalPriceLeft = 0;
        let TotalPriceRight = 0;
        let array = $(".ucret").each(function() {

            var Prices = $('.ucret').text();
            let allPrices = Prices.split("-");

            let leftPrice = parseInt(allPrices[0]);
            let rightPrice = parseInt(allPrices[1]);

            TotalPriceLeft = parseInt(TotalPriceLeft) + parseInt(leftPrice);
            TotalPriceRight = parseInt(TotalPriceRight) + parseInt(rightPrice);
        });
        TotalPriceLeft = parseInt(TotalPriceLeft);
        TotalPriceRight = parseInt(TotalPriceRight);
        $("#toplamUcret").text(TotalPriceLeft + '-' + TotalPriceRight);

        console.log(array)
    </script>
    {{-- Dil Plugin i --}}
    <script type="text/javascript">
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({
            pageLanguage: 'de',
            includedLanguages: 'de,en,fr,it',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
            autoDisplay: true,
            gaTrack: true,
            gaId: 'YOUR_ANALYTICS_TRACKING_ID', // Replace 'YOUR_ANALYTICS_TRACKING_ID' with your Google Analytics Tracking ID (if using)
            multilanguagePage: true,
            isDropdown: true,
            language: 'de',
            controlFlag: true,
            controlFlagUI: {
              renderInline: false
            }
          }, 'google_translate_element');
        }
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>

</html>
