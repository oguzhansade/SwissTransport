<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Swiss Transport - Offerte ({{ $offer['id'] }})</title>
    <!-- CSS only -->
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> --}}

<link rel="stylesheet" href="{{ asset('assets/css/pace.css') }}">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Swiss Transport</title>
<!-- CSS -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600|Roboto:400" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/vendors/material-icons/material-icons.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/vendors/mono-social-icons/monosocialiconsfont.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/vendors/feather-icons/feather.css') }}" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.css" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
<!-- Head Libs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script data-pace-options='{ "ajax": false, "selectors": [ "img" ]}' src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" rel="stylesheet" type="text/css">

<style>
    .bg-container {
        background-color: #dbc7f3;
        padding-left: 20px;
        padding-right: 20px;
        padding-bottom: 20px;
        border-radius: 20px;
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
</style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 p-3 mt-3 d-flex justify-content-center">
                <img class="logo-expand" alt="" width="300" src="{{ asset('assets/demo/swiss-logo.png') }}">
            </div>
            <div class="row d-flex p-0 justify-content-start" >
                <div class="col-md-12 d-flex justify-content-start">
                    <span class="h4 px-3 py-1 bg-primary  text-white b-shadow rounded">Offerte: <span class="custom-font">{{ $offer['id'] }}</span> </span>
                </div>
            </div>
        </div>
        <div>

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
                        @if (App\Models\Customer::getCustomer($offer['customerId'],'gender') === "male")
                        geehrter Herr
                        @else
                        geehrte Frau
                        @endif 
                        {{ App\Models\Customer::getCustomer($offer['customerId'],'name') }} {{ App\Models\Customer::getCustomer($offer['customerId'],'surname') }}</strong> <br>
                        Wir danken Ihnen herzlich für Ihre Anfrage und freuen uns, Ihnen folgendes Angebot vorlegen zu können:
                    </span>

                    {{-- Umzug Alanı --}}
                    @if($isUmzug)

                        <div class="form-group row mt-3">
                            <div class="col-md-12 umzug-control">
                                <label for="" class="col-form-label">Umzug</label><br>
                                <input type="checkbox" name="isUmzug" id="isUmzug" class="js-switch " data-color="#9c27b0" data-switchery="false" checked>  
                            </div>                            
                        </div>

                        <div class="umzug--area bg-container" style="display: block;">
                            <div class="row">
                                <div class="col-md-12 text-dark">
                                    <h4> <strong>Umzug: </strong> </h4>
                                </div>
                            </div>
                            <div class="c-border"></div>
    
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Umzugstermin
                                </div>
                                <div class="col-md-6">
                                    @if($umzug['moveDate']){{ date("d/m/Y", strtotime($umzug['moveDate'])); }} @else - @endif
                                </div>
                                <div class="col-md-6">
                                    Arbeitsbeginn
                                </div>
                                <div class="col-md-6">
                                    @if($umzug['moveTime']){{ $umzug['moveTime'] }} @else - @endif Uhr
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>
    
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Tarif
                                </div>
                                <div class="col-md-6">
                                    {{ $umzug['ma'] }} Umzugsmitarbeiter mit {{ $umzug['lkw'] }} Lieferwagen @if($umzug['anhanger']) und {{ $umzug['anhanger'] }} Anhänger  @endif  à CHF {{ $umzug['chf'] }}.-/Stunde 
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
                                    @if ($umzug['montage'] == 0) Kunde @else Swiss Transport @endif
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
                                    @if ( $umzug['extra'] ) Spesen  {{ $umzug['extra'] }} CHF <br>@endif
                                        @if ( $umzug['extra1'] ) Klavier  {{ $umzug['extra1'] }} CHF <br>@endif
                                        @if ( $umzug['extra2'] ) Klavier  {{ $umzug['extra2'] }} CHF <br>@endif
                                        @if ( $umzug['extra3'] ) Möbellift  {{ $umzug['extra3'] }} CHF <br>@endif
                                        @if ( $umzug['extra4'] ) Möbellift  {{ $umzug['extra4'] }} CHF <br>@endif
                                        @if ( $umzug['extra5'] ) Möbellift  {{ $umzug['extra5'] }} CHF <br>@endif
                                        @if ( $umzug['extra6'] ) Schwergutzuschlag  {{ $umzug['extra6'] }} CHF <br>@endif
                                        @if ( $umzug['extra7'] ) Schwergutzuschlag  {{ $umzug['extra7'] }} CHF <br>@endif
                                        @if ( $umzug['extra8'] ) Tresor  {{ $umzug['extra8'] }} CHF <br>@endif
                                        @if ( $umzug['extra9'] ) Tresor  {{ $umzug['extra9'] }} CHF <br>@endif
                                        @if ( $umzug['extra10'] ) Wasserbett  {{ $umzug['extra10'] }} CHF <br>@endif
                                        @if ( $umzug['customCostName1'] ) {{ $umzug['customCostName1'] }} @else Freier Text 1 @endif @if ( $umzug['customCostPrice1'] ) {{ $umzug['customCostPrice1'] }} CHF  @endif <br>
                                        @if ( $umzug['customCostName2'] ) {{ $umzug['customCostName2'] }} @else Freier Text 2 @endif @if ( $umzug['customCostPrice2'] ) {{ $umzug['customCostPrice2'] }} CHF <br> @endif
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>
    
                            @if($umzug['discount'] !=0) 
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Rabatt
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $umzug['discount'] }} CHF
                                    </div>
                                </div>
                            @endif
                            
                            @if($umzug['compromiser'] !=0) 
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Entgegenkommen
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $umzug['compromiser'] }} CHF
                                    </div>
                                </div>
                            @endif
    
                            @if($umzug['extraCostPrice'] !=0) 
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        @if ($umzug['extraCostName']) {{ $umzug['extraCostName'] }}: @else Custom Entgegenkommen: @endif
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
                                    <span class="text-primary"> <strong>{{ $umzug['defaultPrice'] }} CHF</strong> </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Einpack Alanı --}}
                    @if($isEinpack)

                        <div class="form-group row mt-3">
                            <div class="col-md-12 einpack-control">
                                <label for="" class="col-form-label">Einpack</label><br>
                                <input type="checkbox" name="isEinpack" id="isEinpack" class="js-switch " data-color="#9c27b0" data-switchery="false" checked >  
                            </div>                            
                        </div>

                        <div class="einpack--area bg-container" style="display: block;">
                            <div class="row mt-3">
                                <div class="col-md-12 text-dark">
                                    <h4> <strong>Einpack: </strong></h4>
                                </div>
                            </div>
                            <div class="c-border"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Packtermin:
                                </div>
                                <div class="col-md-6">
                                    @if($einpack['einpackDate']){{ date("d/m/Y", strtotime($einpack['einpackDate'])); }} @else - @endif
                                </div>
                                <div class="col-md-6">
                                    Arbeitsbeginn
                                </div>
                                <div class="col-md-6">
                                    @if($einpack['einpackTime']){{ $einpack['einpackTime'] }} @else - @endif Uhr
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
                                    @if ( $einpack['extra'] ) Spesen  {{ $einpack['extra'] }} CHF <br>@endif
                                    @if ( $einpack['extra1'] ) Verpackungsmaterial  {{ $einpack['extra1'] }} CHF <br>@endif
                                    @if ( $einpack['customCostName1'] ) {{ $einpack['customCostName1'] }} @else Freier Text 1 @endif @if ( $einpack['customCostPrice1'] ) {{ $einpack['customCostPrice1'] }} CHF <br> @endif
                                    @if ( $einpack['customCostName2'] ) {{ $einpack['customCostName2'] }} @else Freier Text 2 @endif @if ( $einpack['customCostPrice2'] ) {{ $einpack['customCostPrice2'] }} CHF <br> @endif
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            @if($einpack['discount'] !=0) 
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Rabatt
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $einpack['discount'] }} CHF
                                    </div>
                                </div>
                            @endif
                            
                            @if($einpack['compromiser'] !=0) 
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Entgegenkommen
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $einpack['compromiser'] }} CHF
                                    </div>
                                </div>
                            @endif

                            @if($einpack['extraCostPrice'] !=0) 
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        @if ($einpack['extraCostName']) {{ $einpack['extraCostName'] }}: @else Custom Entgegenkommen: @endif
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
                                    <span class="text-primary"> <strong>{{ $einpack['defaultPrice'] }} CHF</strong> </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Auspack Alanı --}}
                    @if($isAuspack)
                        <div class="form-group row mt-3">
                            <div class="col-md-12 auspack-control">
                                <label for="" class="col-form-label">Auspack</label><br>
                                <input type="checkbox" name="isAuspack" id="isAuspack" class="js-switch " data-color="#9c27b0" data-switchery="false" checked>  
                            </div>                            
                        </div>

                        <div class="auspack--area bg-container" style="display: block;">
                            <div class="row mt-3">
                                <div class="col-md-12 text-dark">
                                    <h4> <strong>Auspack: </strong></h4>
                                </div>
                            </div>
                            <div class="c-border"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Packtermin:
                                </div>
                                <div class="col-md-6">
                                    @if($auspack['auspackDate']){{ date("d/m/Y", strtotime($auspack['auspackDate'])); }} @else - @endif
                                </div>
                                <div class="col-md-6">
                                    Arbeitsbeginn
                                </div>
                                <div class="col-md-6">
                                    @if($auspack['auspackTime']){{ $auspack['auspackTime'] }} @else - @endif Uhr
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Tarif
                                </div>
                                <div class="col-md-6">
                                    {{ $auspack['ma'] }} Packmitarbeiter à CHF {{ $auspack ['chf'] }}.-/Stunde
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
                                    @if ( $auspack['extra'] ) Spesen  {{ $auspack['extra'] }} CHF <br>@endif
                                    @if ( $auspack['extra1'] ) Verpackungsmaterial  {{ $auspack['extra1'] }} CHF <br>@endif
                                    @if ( $auspack['customCostName1'] ) {{ $auspack['customCostName1'] }} @else Freier Text 1 @endif @if ( $auspack['customCostPrice1'] ) {{ $auspack['customCostPrice1'] }} CHF <br> @endif
                                    @if ( $auspack['customCostName2'] ) {{ $auspack['customCostName2'] }} @else Freier Text 2 @endif @if ( $auspack['customCostPrice2'] ) {{ $auspack['customCostPrice2'] }} CHF <br> @endif
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            @if($auspack['discount'] !=0) 
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Rabatt
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $auspack['discount'] }} CHF
                                    </div>
                                </div>
                            @endif
                            
                            @if($auspack['compromiser'] !=0) 
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Entgegenkommen
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $auspack['compromiser'] }} CHF
                                    </div>
                                </div>
                            @endif

                            @if($auspack['extraCostPrice'] !=0) 
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        @if ($auspack['extraCostName']) {{ $auspack['extraCostName'] }}: @else Custom Entgegenkommen: @endif
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
                                    <span class="text-primary"> <strong>{{ $auspack['defaultPrice'] }} CHF</strong> </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Reinigung Alanı --}}
                    @if($isReinigung)

                        <div class="form-group row mt-3">
                            <div class="col-md-12 reinigung-control">
                                <label for="" class="col-form-label">Reinigung</label><br>
                                <input type="checkbox" name="isReinigung" id="isReinigung" class="js-switch " data-color="#9c27b0" data-switchery="false" checked>  
                            </div>                            
                        </div>

                        <div class="reinigung--area bg-container" style="display: block;">
                            <div class="row mt-3">
                                <div class="col-md-12 text-dark">
                                    <h4> <strong>Reinigung: </strong> {{ $reinigung['reinigungType'] }} </h4>
                                </div>
                            </div>
                            <div class="c-border"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Reinigungstermin
                                </div>
                                <div class="col-md-6">
                                    @if($reinigung['startDate']){{ date("d/m/Y", strtotime($reinigung['startDate'])); }} @else - @endif
                                </div>

                                <div class="col-md-6">
                                    Arbeitsbeginn
                                </div>
                                <div class="col-md-6">
                                    @if($reinigung['startTime']){{ $reinigung['startTime'] }} @else - @endif Uhr
                                </div>

                                <div class="col-md-6">
                                    Abgabetermin
                                </div>
                                <div class="col-md-6">
                                    @if($reinigung['endDate']){{ date("d/m/Y", strtotime($reinigung['endDate'])); }} @else - @endif
                                </div>

                                <div class="col-md-6">
                                    Abgabezeit
                                </div>
                                <div class="col-md-6">
                                    @if($reinigung['endTime']){{ $reinigung['endTime'] }} @else - @endif Uhr
                                </div>

                                <div class="col-md-6">
                                    Dübellöcher zuspachteln
                                </div>
                                <div class="col-md-6">
                                    @if ($reinigung['extraService1'] == 1) Ja @else Nein  @endif
                                </div>

                                <div class="col-md-6">
                                    Mit Hochdruckreiniger
                                </div>
                                <div class="col-md-6">
                                    @if ($reinigung['extraService2'] == 1) Ja @else Nein  @endif
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    @if ($reinigung['fixedTariff'])Zimmer: @else Tariff: @endif
                                </div>
                                <div class="col-md-6">
                                    @if ($reinigung['fixedTariff'])
                                    {{ Str::substr(\App\Models\Tariff::infoTariff($reinigung['fixedTariff'],'description'), 0, 12); }} à CHF {{ $reinigung['fixedTariffPrice'] }} 
                                    @else  
                                    {{ $reinigung['ma'] }} Mitarbeiter à CHF {{ $reinigung['chf'] }}.- / Stunde
                                    @endif
                                </div>

                                @if($reinigung['fixedTariff'])
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
                                    @if ( $reinigung['extra1'] ) Hochdruckreiniger  {{ $reinigung['extra1'] }} CHF <br>@endif
                                    @if ( $reinigung['extra2'] ) Stein- und Parkettböden  {{ $reinigung['extra2'] }} CHF <br>@endif
                                    @if ( $reinigung['extra3'] ) Teppichschamponieren  {{ $reinigung['extra3'] }} CHF <br>@endif
                                    @if ( $reinigung['extraCostText1'] ) {{ $reinigung['extraCostText1'] }} @else Zusatzkosten 1 @endif @if ( $reinigung['extraCostValue1'] ) {{ $reinigung['extraCostValue1'] }} CHF <br> @endif
                                    @if ( $reinigung['extraCostText2'] ) {{ $reinigung['extraCostText2'] }} @else Zusatzkosten 2 @endif @if ( $reinigung['extraCostValue2'] ) {{ $reinigung['extraCostValue2'] }} CHF <br> @endif
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            @if($reinigung['discount'] !=0) 
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        @if( $reinigung['discountText'] ) {{ $reinigung['discountText'] }}: @else Rabatt: @endif
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $reinigung['discount'] }} CHF
                                    </div>
                                </div>
                            @endif
                            
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    @if($reinigung['fixedTariff'])Pauschal:  @else Geschätzte Kosten:  @endif
                                </div>
                                <div class="col-md-6">
                                    <span class="text-primary"> <strong>{{ $reinigung['totalPrice'] }} CHF</strong> </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Reinigung 2 Alanı --}}
                    @if($isReinigung2)
                        <div class="form-group row mt-3">
                            <div class="col-md-12 reinigung2-control">
                                <label for="" class="col-form-label">Reinigung 2</label><br>
                                <input type="checkbox" name="isReinigung2" id="isReinigung2" class="js-switch " data-color="#9c27b0" data-switchery="false" checked>  
                            </div>                            
                        </div>

                        <div class="reinigung2--area bg-container" style="display: block;">
                            <div class="row mt-3">
                                <div class="col-md-12 text-dark">
                                    <h4> <strong>Reinigung 2: </strong> {{ $reinigung2['reinigungType'] }} </h4>
                                </div>
                            </div>
                            <div class="c-border"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Reinigungstermin
                                </div>
                                <div class="col-md-6">
                                    @if($reinigung2['startDate']){{ date("d/m/Y", strtotime($reinigung2['startDate'])); }} @else - @endif
                                </div>

                                <div class="col-md-6">
                                    Arbeitsbeginn
                                </div>
                                <div class="col-md-6">
                                    @if($reinigung2['startTime']){{ $reinigung2['startTime'] }} @else - @endif Uhr
                                </div>

                                <div class="col-md-6">
                                    Abgabetermin
                                </div>
                                <div class="col-md-6">
                                    @if($reinigung2['endDate']){{ date("d/m/Y", strtotime($reinigung2['endDate'])); }} @else - @endif
                                </div>

                                <div class="col-md-6">
                                    Abgabezeit
                                </div>
                                <div class="col-md-6">
                                    @if($reinigung2['endTime']){{ $reinigung2['endTime'] }} @else - @endif Uhr
                                </div>

                                <div class="col-md-6">
                                    Dübellöcher zuspachteln
                                </div>
                                <div class="col-md-6">
                                    @if ($reinigung2['extraService1'] == 1) Ja @else Nein  @endif
                                </div>

                                <div class="col-md-6">
                                    Mit Hochdruckreiniger
                                </div>
                                <div class="col-md-6">
                                    @if ($reinigung2['extraService2'] == 1) Ja @else Nein  @endif
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    @if ($reinigung2['fixedTariff'])Zimmer: @else Tariff: @endif
                                </div>
                                <div class="col-md-6">
                                    @if ($reinigung2['fixedTariff'])
                                    {{ Str::substr(\App\Models\Tariff::infoTariff($reinigung2['fixedTariff'],'description'), 0, 12); }} à CHF {{ $reinigung2['fixedTariffPrice'] }}  
                                    @else  
                                    {{ $reinigung2['ma'] }} Mitarbeiter à CHF {{ $reinigung2['chf'] }}.- / Stunde
                                    @endif
                                </div>

                                @if($reinigung2['fixedTariff'])
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
                                    @if ( $reinigung2['extra1'] ) Hochdruckreiniger  {{ $reinigung2['extra1'] }} CHF <br>@endif
                                    @if ( $reinigung2['extra2'] ) Stein- und Parkettböden  {{ $reinigung2['extra2'] }} CHF <br>@endif
                                    @if ( $reinigung2['extra3'] ) Teppichschamponieren  {{ $reinigung2['extra3'] }} CHF <br>@endif
                                    @if ( $reinigung2['extraCostText1'] ) {{ $reinigung2['extraCostText1'] }} @else Zusatzkosten 1 @endif @if ( $reinigung2['extraCostValue1'] ) {{ $reinigung2['extraCostValue1'] }} CHF <br> @endif
                                    @if ( $reinigung2['extraCostText2'] ) {{ $reinigung2['extraCostText2'] }} @else Zusatzkosten 2 @endif @if ( $reinigung2['extraCostValue2'] ) {{ $reinigung2['extraCostValue2'] }} CHF <br> @endif
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            @if($reinigung2['discount'] !=0) 
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        @if( $reinigung2['discountText'] ) {{ $reinigung2['discountText'] }}: @else Rabatt: @endif
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $reinigung2['discount'] }} CHF
                                    </div>
                                </div>
                            @endif
                            
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    @if($reinigung2['fixedTariff'])Pauschal:  @else Geschätzte Kosten:  @endif
                                </div>
                                <div class="col-md-6">
                                    <span class="text-primary"> <strong>{{ $reinigung2['totalPrice'] }} CHF</strong> </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Entsorgung Alanı --}}
                    @if($isEntsorgung)
                        <div class="form-group row mt-3">
                            <div class="col-md-12 entsorgung-control">
                                <label for="" class="col-form-label">Entsorgung</label><br>
                                <input type="checkbox" name="isEntsorgung" id="isEntsorgung" class="js-switch " data-color="#9c27b0" data-switchery="false" checked>  
                            </div>                            
                        </div>

                        <div class="entsorgung--area bg-container" style="display: block;">
                            <div class="row mt-3">
                                <div class="col-md-12 text-dark">
                                    <h4> <strong>Entsorgung: </strong></h4>
                                </div>
                            </div>
                            <div class="c-border"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Entsorgungstermin:
                                </div>
                                <div class="col-md-6">
                                    @if($entsorgung['entsorgungDate']){{ date("d/m/Y", strtotime($entsorgung['entsorgungDate'])); }} @else - @endif
                                </div>

                                <div class="col-md-6">
                                    Arbeitsbeginn
                                </div>
                                <div class="col-md-6">
                                    @if($entsorgung['entsorgungTime']){{ $entsorgung['entsorgungTime'] }} @else - @endif Uhr
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Tarif
                                </div>
                                <div class="col-md-6">
                                    {{ $entsorgung['ma'] }} Mitarbeiter mit {{ $entsorgung['lkw'] }} Lieferwagen @if($entsorgung['anhanger']) und {{ $entsorgung['anhanger'] }} Anhänger @endif à CHF {{ $entsorgung['chf'] }}.- / Stunde
                                </div>

                                <div class="col-md-6">
                                    Anfahrt/Rückfahrt
                                </div>
                                <div class="col-md-6">
                                    {{ $entsorgung['arrivalReturn'] }} CHF
                                </div>

                                <div class="col-md-6">
                                    Geschätzter Arbeitsaufwand
                                </div>
                                <div class="col-md-6">
                                    {{ $entsorgung['hour'] }} Std
                                </div>

                                <div class="col-md-6">
                                    Geschätztes Volumen
                                </div>
                                <div class="col-md-6">
                                    {{ $entsorgung['volume'] }} m³
                                </div>

                                <div class="col-md-6">
                                    Zusatzkosten
                                </div>
                                <div class="col-md-6">
                                    @if ( $entsorgung['entsorgungExtra1'] ) Spesen  {{ $entsorgung['entsorgungExtra1'] }} CHF <br>@endif
                                    @if ( $entsorgung['extraCostValue1'] ) {{ $entsorgung['extraCostText1'] }}  {{ $entsorgung['extraCostValue1'] }} CHF <br> @endif
                                    @if ( $entsorgung['extraCostValue2'] ) {{ $entsorgung['extraCostText2'] }}  {{ $entsorgung['extraCostValue2'] }} CHF <br> @endif
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            @if($auspack['discount'] !=0) 
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        @if( $entsorgung['discountText'] ) {{ $entsorgung['discountText'] }}: @else Rabatt: @endif
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $auspack['discount'] }} CHF
                                    </div>
                                </div>
                            @endif
                            
                            @if($entsorgung['extraDiscountPrice'] !=0) 
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        @if( $entsorgung['extraDiscountText'] ) {{ $entsorgung['extraDiscountText'] }}: @else Rabatt: @endif
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
                                    <span class="text-primary"> <strong>{{ $entsorgung['defaultPrice'] }} CHF</strong> </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Transport Alanı --}}
                    @if($isTransport)
                        <div class="form-group row mt-3">
                            <div class="col-md-12 transport-control">
                                <label for="" class="col-form-label">Transport</label><br>
                                <input type="checkbox" name="isTransport" id="isTransport" class="js-switch " data-color="#9c27b0" data-switchery="false" checked>  
                            </div>                            
                        </div>

                        <div class="transport--area bg-container" style="display: block;">
                            <div class="row mt-3">
                                <div class="col-md-12 text-dark">
                                    <h4> <strong>Transport: </strong></h4>
                                </div>
                            </div>
                            <div class="c-border"></div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Transporttermin:
                                </div>
                                <div class="col-md-6">
                                    @if($transport['transportDate']){{ date("d/m/Y", strtotime($transport['transportDate'])); }} @else - @endif
                                </div>
                                <div class="col-md-6">
                                    Arbeitsbeginn
                                </div>
                                <div class="col-md-6">
                                    @if($transport['transportTime']){{ $transport['transportTime'] }} @else - @endif Uhr
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            <div class="row mt-3">

                                @if($transport['fixedChf'])
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
                                        {{ $transport['ma'] }} Mitarbeiter mit {{ $transport['lkw'] }} Lieferwagen @if($transport['anhanger']) und {{ $transport['anhanger'] }} Anhänger @endif à CHF {{ $transport['chf'] }}.- / Stunde
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
                                    @if ( $transport['extraCostValue1'] !=0) {{ $transport['extraCostText1'] }}   {{ $transport['extraCostValue1'] }} CHF <br> @endif
                                    @if ( $transport['extraCostValue2'] !=0) {{ $transport['extraCostText2'] }}   {{ $transport['extraCostValue2'] }} CHF <br> @endif
                                    @if ( $transport['extraCostValue3'] !=0) {{ $transport['extraCostText3'] }}   {{ $transport['extraCostValue3'] }} CHF <br> @endif
                                    @if ( $transport['extraCostValue4'] !=0) {{ $transport['extraCostText4'] }}   {{ $transport['extraCostValue4'] }} CHF <br> @endif
                                    @if ( $transport['extraCostValue5'] !=0) {{ $transport['extraCostText5'] }}   {{ $transport['extraCostValue5'] }} CHF <br> @endif
                                    @if ( $transport['extraCostValue6'] !=0) {{ $transport['extraCostText6'] }}   {{ $transport['extraCostValue6'] }} CHF <br> @endif
                                    @if ( $transport['extraCostValue7'] !=0) {{ $transport['extraCostText7'] }}   {{ $transport['extraCostValue7'] }} CHF <br> @endif
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            @if($transport['discount'] !=0) 
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Rabatt
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $transport['discount'] }} CHF
                                    </div>
                                </div>
                            @endif
                            
                            @if($transport['compromiser'] !=0) 
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Entgegenkommen
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $transport['compromiser'] }} CHF
                                    </div>
                                </div>
                            @endif

                            @if($transport['extraDiscountValue'] !=0) 
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        @if( $transport['extraDiscountText'] ) {{ $transport['extraDiscountText'] }}: @else Rabatt: @endif
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $transport['extraDiscountValue'] }} CHF
                                    </div>
                                </div>
                            @endif

                            @if($transport['extraDiscountValue2'] !=0) 
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        @if( $transport['extraDiscountText2'] ) {{ $transport['extraDiscountText2'] }}: @else Rabatt 2: @endif
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $transport['extraDiscountValue2'] }} CHF
                                    </div>
                                </div>
                            @endif

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    @if( $transport['fixedChf'] !=0 ) Pauschal: @else Geschätzte Kosten: @endif
                                </div>
                                <div class="col-md-6">
                                    <span class="text-primary"> <strong>{{ $transport['defaultPrice'] }} CHF</strong> </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Lagerung Alanı --}}
                    @if($isLagerung)

                        <div class="form-group row mt-3">
                            <div class="col-md-12 lagerung-control">
                                <label for="" class="col-form-label">Lagerung</label><br>
                                <input type="checkbox" name="isLagerung" id="isLagerung" class="js-switch " data-color="#9c27b0" data-switchery="false" checked>  
                            </div>                            
                        </div>

                        <div class="lagerung--area bg-container" style="display: block;">
                            <div class="row mt-3">
                                <div class="col-md-12 text-dark">
                                    <h4> <strong>Lagerung: </strong></h4>
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
                                    @if ( $lagerung['extraCostValue1'] !=0) {{ $lagerung['extraCostText1'] }}   {{ $lagerung['extraCostValue1'] }} CHF <br> @endif
                                    @if ( $lagerung['extraCostValue2'] !=0) {{ $lagerung['extraCostText2'] }}   {{ $lagerung['extraCostValue2'] }} CHF <br> @endif
                                </div>
                            </div>
                            <div class="c-border mt-3"></div>

                            @if($lagerung['discountValue'] !=0) 
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        @if( $lagerung['discountText'] ) {{ $lagerung['discountText'] }}: @else Rabatt: @endif
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $lagerung['discountValue'] }} CHF
                                    </div>
                                </div>
                            @endif
                            
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    Geschätzte Kosten:
                                </div>
                                <div class="col-md-6">
                                    <span class="text-primary"> <strong>{{ $lagerung['totalPrice'] }} CHF</strong> </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Material Alanı --}}
                    @if($isMaterial)
                        <div class="form-group row mt-3">
                            <div class="col-md-12 material-control">
                                <label for="" class="col-form-label">Material</label><br>
                                <input type="checkbox" name="isMaterial" id="isMaterial" class="js-switch " data-color="#9c27b0" data-switchery="false" checked>  
                            </div>                            
                        </div>

                        <div class="material--area bg-container" style="display: block;">
                            <div class="row mt-3">
                                <div class="col-md-12 text-dark">
                                    <h4> <strong>Verpackungsmaterial </strong> </h4>
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
                                <div class="col">{{ \App\Models\Product::productName($v['productId'])}}</div>
                                <div class="col">@if ($v['buyType'] == 1) Kauf @elseif ($v['buyType'] == 2) Miete @else - @endif</div>
                                <div class="col">@if ($v['buyType'] == 1) {{ \App\Models\Product::buyPrice($v['productId'])}} 
                                    @elseif ($v['buyType'] == 2) {{ \App\Models\Product::rentPrice($v['productId'])}}
                                    @else - 
                                @endif</div>
                                <div class="col">{{ $v['quantity'] }}</div>
                                <div class="col">{{ $v['totalPrice'] }}</div><hr>
                            </div> 
                            @endforeach
                            <div class="c-border"></div>

                            @if($material['discount'] !=0) 
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                         Rabatt:
                                    </div>
                                    <div class="col-md-6">
                                        - {{ $material['discount'] }} CHF
                                    </div>
                                </div>
                            @endif

                            @if($material['deliverPrice'] !=0) 
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        Lieferung:
                                    </div>
                                    <div class="col-md-6">
                                        {{ $material['deliverPrice'] }} CHF
                                    </div>
                                </div>
                            @endif

                            @if($material['recievePrice'] !=0) 
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
                                    <span class="text-primary"> <strong>{{ $material['totalPrice'] }} CHF</strong> </span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Sağ Kısım --}}
                <div class="col-md-4 bg-white  mt-2  b-shadow rounded-custom sticky-top" style="max-height: 510px; top:20px;" >
                    <div class="row">
                        <div class="col-md-12 bg-primary text-white p-1 rounded-custom-2 m-0 d-flex justify-content-center align-items-center">
                            <b class=" text-white custom-font" style="font-size:20px;">Auftragserteilung</b><br><br>
                        </div>
                        <div class="col-md-12 px-3 py-3">
                            @if($isUmzug)
                                <div class="row d-flex justify-content-center align-items-center" >
                                    <div class="col-md-6 text-left"><b class="h6 text-dark custom-font">Umzug:</b></div>
                                    <div class="col-md-6 text-right"><b class="h6 text-primary custom-font"><span class="ucret">{{ $umzug['defaultPrice'] }}</span> CHF</b></div>
                                </div>
                            @endif
                            @if($isEinpack)
                                <div class="row d-flex justify-content-center align-items-center mt-1" >
                                    <div class="col-md-6 text-left"><b class="h6 text-dark custom-font">Einpack:</b></div>
                                    <div class="col-md-6 text-right"><b class="h6 text-primary custom-font"><span class="ucret">{{ $einpack['defaultPrice'] }}</span> CHF</b></div>
                                </div>
                            @endif
                            @if($isAuspack)
                                <div class="row d-flex justify-content-center align-items-center mt-1" >
                                    <div class="col-md-6 text-left"><b class="h6 text-dark custom-font">Auspack:</b></div>
                                    <div class="col-md-6 text-right"><b class="h6 text-primary custom-font"><span class="ucret">{{ $auspack['defaultPrice'] }}</span> CHF</b></div>
                                </div>
                            @endif
                            @if($isReinigung)
                                <div class="row d-flex justify-content-center align-items-center mt-1" >
                                    <div class="col-md-6 text-left"><b class="h6 text-dark custom-font">Reinigung:</b></div>
                                    <div class="col-md-6 text-right"><b class="h6 text-primary custom-font"><span class="ucret">{{ $reinigung['totalPrice'] }}</span> CHF</b></div>
                                </div>
                            @endif
                            @if($isReinigung2)
                                <div class="row d-flex justify-content-center align-items-center mt-1" >
                                    <div class="col-md-6 text-left"><b class="h6 text-dark custom-font">Reinigung 2:</b></div>
                                    <div class="col-md-6 text-right"><b class="h6 text-primary custom-font"><span class="ucret">{{ $reinigung2['totalPrice'] }}</span> CHF</b></div>
                                </div>
                            @endif
                            @if($isEntsorgung)
                                <div class="row d-flex justify-content-center align-items-center mt-1" >
                                    <div class="col-md-6 text-left"><b class="h6 text-dark custom-font">Entsorgung:</b></div>
                                    <div class="col-md-6 text-right"><b class="h6 text-primary custom-font"><span class="ucret">{{ $entsorgung['defaultPrice'] }}</span> CHF</b></div>
                                </div>
                            @endif
                            @if($isTransport)
                                <div class="row d-flex justify-content-center align-items-center mt-1" >
                                    <div class="col-md-6 text-left"><b class="h6 text-dark custom-font">Transport:</b></div>
                                    <div class="col-md-6 text-right"><b class="h6 text-primary custom-font"><span class="ucret">{{ $transport['defaultPrice'] }}</span> CHF</b></div>
                                </div>
                            @endif
                            @if($isLagerung)
                                <div class="row d-flex justify-content-center align-items-center mt-1" >
                                    <div class="col-md-6 text-left"><b class="h6 text-dark custom-font">Lagerung:</b></div>
                                    <div class="col-md-6 text-right"><b class="h6 text-primary custom-font"><span class="ucret">{{ $lagerung['totalPrice'] }}</span> CHF</b></div>
                                </div>
                            @endif
                            @if($isMaterial)
                                <div class="row d-flex justify-content-center align-items-center mt-1" >
                                    <div class="col-md-6 text-left"><b class="h6 text-dark custom-font">Material:</b></div>
                                    <div class="col-md-6 text-right"><b class="h6 text-primary custom-font"><span class="ucret">{{ $material['totalPrice'] }}</span> CHF</b></div>
                                </div>
                            @endif

                            {{-- <div class="row d-flex justify-content-center align-items-center mt-3 pt-1" style="border-top-width:1px;border-top-style:solid; border-top-color:#c3aaf8;">
                                <div class="col-md-6 text-left"><b class="h6 text-dark custom-font">Total:</b></div>
                                <div class="col-md-6 text-right"><b class="h6 text-primary custom-font"><span id="toplamUcret">0</span> CHF</b></div>
                            </div> --}}
                        </div>
                        <div class="col-md-6 mt-3 px-3">
                           <table>
                            <tr>
                                <td align="center">
                                    <a href="{{ route('showPdf',['token' => $token]) }}" target="_blank" class="text-primary text-center">
                                    <img src="{{ asset('assets/img/PDF_icon.png') }}" alt="" width="50"></a>
                                </td>
                                <td align="center" class="pl-2">
                                    <a href="{{ asset('assets/demo/AGB.pdf') }}" class="text-primary text-center" target="_blank">
                                    <img src="{{ asset('assets/img/PDF_icon.png') }}" alt="" width="50"></a>
                                </td>
                            </tr>
                            <tr >
                               <td align="center" >Offerte</td>
                               <td align="center" class="pl-2">AGB</td>
                            </tr>
                           </table>
                        </div>

                        <div class="col-md-12 mt-3 d-flex justify-content-center align-items-center p-2">
                            @if ($offer['offerteStatus'] == 'Onaylandı')
                                    <span class="btn h6 text-white  p-3" style="background-color: #28A745"><b>Dieses Angebot wurde bereits bestätigt.</b></span>
                                @elseif($offer['offerteStatus'] == 'Onaylanmadı')
                                    <span class="btn h6 text-white  p-3" style="background-color: #DC3545"><b>Dieses Angebot wurde bereits ablehnen.</b></span>
                                @elseif($offer['offerteStatus'] == 'Beklemede')
                                <form action="" method="POST">
                                    @csrf
                                    <div class="row form-group mt-0">
                                        <div class="col-md-12 p-3">
                                            <label for="" class="col-form-label">Mitteilung an den Kundenberater</label><br>
                                            <textarea class="form-control" name="offerteVerifyNote" id="" cols="15" rows="5" ></textarea>    
                                        </div>                            
                                    </div>
                                    <div class="row ">
                                        <div class="form-actions d-flex justify-content-center">
                                            <div class="form-group row d-flex justify-content-center">
                                                <div class="col-md-12 d-flex pl-3  ml-md-auto btn-list">
                                                    <input class="btn btn-primary btn-rounded" type="submit" value="Angebot annehmen " formaction="{{ URL::to('/verifyoffer',['token' =>$oToken]) }}">
                                                    <input class="btn btn-danger btn-rounded" type="submit" value="Angebot ablehnen" formaction="{{ URL::to('/rejectoffer',['token' =>$oToken]) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endif
                            {{-- <a href="{{ route('acceptOfferView', App\Models\OfferVerify::getToken($offer['id'])) }}" target="_blank" class="btn btn-primary w-100 d-flex justify-content-center align-items-center rounded-custom"><strong>Genehmigen oder ablehnen</strong></a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="sag" style=" ">
                
            </div>
            
            <div class="row border-top mt-3 mb-3">
                <div class="col-md-12 px-1 pt-1 text-dark justify-content-left">
                    <h5 class="font-weight-bold text-dark">Im Preis inbegriffen</h5>
                    <p>Spesen, Versicherung, Fahrkilometer / Treibstoff, De- und Montage der Möbel die für den Umzug erforderlich sind Baumwolldecken, Strechfolie, Matratzenhüllen, Hilfsmaterialen wie Werkzeuge, Rollis, Packdecken, Tragegurte etc.</p>
                    
                    <h5 class="font-weight-bold text-dark">Versicherung (ohne Selbstbehalt)</h5>
                    <p>Eine Betriebshaftpflichtversicherung von CHF 5 Mio. pro Ereignis ist inbegriffen. Eine Frachtführerhaftpflichtversicherung von CHF 100’000.00 pro Transport ist inbegriffen.</p>

                    <h5 class="font-weight-bold text-dark">Zeitberechnung (Mindestaufwand 3h)</h5>
                    <p>Die Arbeitszeit beginnt bei der Ankunft am Aufladeort und endet nach dem Umzug am Abladeort. Abweichungen der An- Abreise werden im Umzugstarif angegeben. Unsere Umzugspreise basieren auf dem effektiven Zeitaufwand, der durch Ihre Eigenleistung mitbeeinflusst werden kann. Die Arbeitszeit wird auf die nächste 1/4 Stunde aufgerundet.</p>

                    <h5 class="font-weight-bold text-dark">Schaden / Reklamationen</h5>
                    <p>Der Auftraggeber ist verpflichtet sein Umzugsgut sofort nach dem Ausladen zu prüfen. Schäden müssen sofort nach dem Umzug den Umzugsmitarbeitern mitgeteilt und schriftlich auf der Quittung mit Unterschrift des Kunden und des Umzugschefs festgehalten werden. Spätere Schadensmeldungen können nicht mehr berücksichtigt werden.</p>

                    <h5 class="font-weight-bold text-dark">Zuschlag Schwercolli</h5>
                    <p>Schwergutzuschlag für Gegenstände über 100 kg - CHF 150.00
                        Klavierzuschlag ab 250 CHF</p>

                    <h5 class="font-weight-bold text-dark">Pausen</h5>
                    <p>Verpflegungsspesen, wie zum Beispiel für Znüni, Mittag- und Nachtessen sind inbegriffen. Bei mehr als 3 Std. Arbeitszeit wird eine Pause von 20 Min. verrechnet, hingegegen werden Mittags- und Nachtessenpausen nicht als Arbeitszeit verrechnet.</p>

                    <h5 class="font-weight-bold text-dark">Allgemeine Geschäftsbedingungen</h5>
                    <p>Wir arbeiten nach den allgemeinen Umzugsbedingungen der Fachgruppe Möbeltransporte der ASTAG.</p>
                
                </div>
            </div>
        </div>
    </div>

   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.2/umd/popper.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.0/metisMenu.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/js/perfect-scrollbar.jquery.js"></script>
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
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script>
        var morebutton2 = $("div.umzug-control");
        morebutton2.click(function(){
            if($(this).hasClass("checkbox-checked"))
            {
                $(".umzug--area").show(700);
            }
            else{
                $(".umzug--area").hide(500);
            }
        })

        var morebutton3 = $("div.einpack-control");
        morebutton3.click(function(){
            if($(this).hasClass("checkbox-checked"))
            {
                $(".einpack--area").show(700);
            }
            else{
                $(".einpack--area").hide(500);
            }
        })

        var morebutton4 = $("div.auspack-control");
        morebutton4.click(function(){
            if($(this).hasClass("checkbox-checked"))
            {
                $(".auspack--area").show(700);
            }
            else{
                $(".auspack--area").hide(500);
            }
        })

        var morebutton5 = $("div.reinigung-control");
        morebutton5.click(function(){
            if($(this).hasClass("checkbox-checked"))
            {
                $(".reinigung--area").show(700);
            }
            else{
                $(".reinigung--area").hide(500);
            }
        })

        var morebutton6 = $("div.reinigung2-control");
        morebutton6.click(function(){
            if($(this).hasClass("checkbox-checked"))
            {
                $(".reinigung2--area").show(700);
            }
            else{
                $(".reinigung2--area").hide(500);
            }
        })

        var morebutton7 = $("div.entsorgung-control");
        morebutton7.click(function(){
            if($(this).hasClass("checkbox-checked"))
            {
                $(".entsorgung--area").show(700);
            }
            else{
                $(".entsorgung--area").hide(500);
            }
        })

        var morebutton8 = $("div.transport-control");
        morebutton8.click(function(){
            if($(this).hasClass("checkbox-checked"))
            {
                $(".transport--area").show(700);
            }
            else{
                $(".transport--area").hide(500);
            }
        })

        var morebutton9 = $("div.lagerung-control");
        morebutton9.click(function(){
            if($(this).hasClass("checkbox-checked"))
            {
                $(".lagerung--area").show(700);
            }
            else{
                $(".lagerung--area").hide(500);
            }
        })

        var morebutton10 = $("div.material-control");
        morebutton10.click(function(){
            if($(this).hasClass("checkbox-checked"))
            {
                $(".material--area").show(700);
            }
            else{
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

                let leftPrice= parseInt(allPrices[0]);
                let rightPrice = parseInt(allPrices[1]);

                TotalPriceLeft = parseInt(TotalPriceLeft) + parseInt(leftPrice);
                TotalPriceRight = parseInt(TotalPriceRight) + parseInt(rightPrice);
            });
            TotalPriceLeft = parseInt(TotalPriceLeft);
            TotalPriceRight= parseInt(TotalPriceRight);
            $("#toplamUcret").text(TotalPriceLeft+'-'+TotalPriceRight);

        console.log(array)
    </script>
</body>
</html>