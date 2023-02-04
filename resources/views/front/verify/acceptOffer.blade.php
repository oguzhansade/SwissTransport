
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Swiss Transport - Angebotsbestätigung</title>
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
</style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 p-3 mt-3 d-flex justify-content-center">
                <img class="logo-expand" alt="" width="350" src="{{ asset('assets/demo/swiss-logo.png') }}">
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
        <div class="container bg-white m-auto b-shadow  rounded-custom p-5">
            <div class="row mb-3">
                <div class="col-md-12 px-2">
                    <span class="text-dark">
                        <strong>Sehr geehrte/r, </strong>
                        {{ App\Models\Customer::getCustomer($offer['customerId'],'name') }} 
                        {{ App\Models\Customer::getCustomer($offer['customerId'],'surname') }}
                    </span><br><br>
                    <span class="text-dark">
                        Besten Dank für Ihr Vertrauen in unser Unternehmen. <br> 
                        Wir würden uns freuen, diesen Auftrag für Sie ausführen zu dürfen und sichern Ihnen schon heute einen termingerechten und fachmännischen Service zu. <br> 
                        Sie können Ihren Auftrag hier direkt bestätigen. Ihr Kundenberater wird sich raschmöglichst sich bei Ihnen für das weitere Vorgehen melden.
                    </span>
                </div>
            </div>
            
            
            <div class="col-md-12 d-flex  justify-content-center">
                <div class="col-md-12 widget-holder">
                    <div class="widget-bg">
                        <div class="widget-body clearfix p-0">
                            <form action="{{ route('acceptOffer',['token' => $token]) }}" method="POST">
                                @csrf
                                <div class="row form-group mt-0">
                                    <div class="col-md-12">
                                        <label for="" class="col-form-label">Mitteilung an den Kundenberater</label><br>
                                        <textarea class="form-control" name="offerteVerifyNote" id="" cols="15" rows="5" ></textarea>    
                                    </div>                            
                                </div>
                                <div class="form-actions d-flex justify-content-center">
                                    <div class="form-group row d-flex justify-content-center">
                                        <div class="col-md-12 ml-md-auto btn-list">
                                            <button class="btn btn-primary btn-rounded" type="submit">Angebot bestätigen</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>  
                </div>
            </div>

            <div class="row border-top ">
                <div class="col-md-12 px-1 pt-3 text-dark justify-content-left">
                    <span class="">Für allfällige Fragen stehen wir Ihnen jederzeit gerne zur Verfügung:</span><br>
                    <span>
                        Ihr Kundenberater: <strong>{{ \App\Models\Company::InfoCompany('name') }}</strong><br>
                        {{ \App\Models\Company::InfoCompany('street') }} <br>
                        {{ \App\Models\Company::InfoCompany('post_code') }} {{ \App\Models\Company::InfoCompany('city') }}
                    </span><br><br>
                    <span>
                        Tel:  {{ \App\Models\Company::InfoCompany('phone') }}
                    </span><br>
                    <span>
                        Email: <a href="mailto:{{ \App\Models\Company::InfoCompany('email') }}">{{ \App\Models\Company::InfoCompany('email') }}</a> 
                    </span>
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
</body>
</html>




