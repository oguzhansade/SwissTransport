<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/demo/logo-collapse.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pace.css') }}">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>{{ \App\Models\Company::InfoCompany('name') }}</title>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <!-- Head Libs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script data-pace-options='{ "ajax": false, "selectors": [ "img" ]}' src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/intlTelInput.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css">

    <script src="https://cdn.tiny.cloud/1/uahyyxnxqnfnc9o1hi72dmh0xvtn65ars5um69t1xufdw2g2/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <style>
        /* Header Rengi */
        .navbar {
            background: {{ App\Models\Company::InfoCompany('crmPrimaryColor') }};
        }

        .bg-primary {
            background: {{ App\Models\Company::InfoCompany('crmSecondaryColor') }}
        }

        .bg-service-primary{
            background: {{ App\Models\Company::InfoCompany('crmSecondaryColor') }}
        }
        /* Footer Rengi */
        .footer {
            background: {{ App\Models\Company::InfoCompany('crmPrimaryColor') }} ;
        }

        /* Sol Menü icon renkleri */
        .sidebar-nav .list-icon {
            color: {{ App\Models\Company::InfoCompany('crmPrimaryColor') }}!important ;
        }

        /* Sol menü açılır menüdeki link renkleri */
        .menu-item-has-children .sub-menu a{
            color: {{ App\Models\Company::InfoCompany('crmPrimaryColor') }}!important;
        }

        /* Loading icon rengi */
        .pace-activity::before {
            border-right-color: {{ App\Models\Company::InfoCompany('crmPrimaryColor') }};
        }
        .pace-activity::after {
            border-left-color: {{ App\Models\Company::InfoCompany('crmPrimaryColor') }};
        }

        /* Breadcrumb rengi */
        .breadcrumb > .active {
            color: {{ App\Models\Company::InfoCompany('crmPrimaryColor') }};
        }

        .text-primary {
            color: {{ App\Models\Company::InfoCompany('crmPrimaryColor') }}!important;
        }
        .dropdown .ripple:hover{
            filter: brightness(90%)!important;
        }
       .sidebar-toggle .ripple:hover{
        filter: brightness(90%)!important;
       }
       .sidebar-toggle .ripple{
            background-color: {{ App\Models\Company::InfoCompany('crmPrimaryColor') }}!important;
        }
        .dropdown .ripple{
            background-color: {{ App\Models\Company::InfoCompany('crmPrimaryColor') }}!important;
        }


        .note-btn-group .note-btn { color:black;}

        .btn-edit {
            background-color: #007BFF;
            color:white;
            border-color:#007BFF;
        }
        .btn-edit:hover {
            background-color: #0464cc;
            color:white;
            border-color:#0464cc;
        }
        .dev-badge{
            display: inline-block;
        padding: 0.4em 0.4em;
        font-size: 90%;
        font-weight: 400;
        line-height: 1;
        color:white;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
        background-color:#007BFF;
        cursor: pointer;
        }

        .back-button {
            cursor: pointer;
            border-radius: 35px !important;
            font-size: 1rem;
            box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
        }

    </style>
    <style>
        .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.5); /* Opaklık değerini buradan ayarlayabilirsiniz */
        }
        #loading-body{
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.7);
            z-index: 10;
        }
        #loadingIndicator {

            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100px;
            background-color: white;
            color: white;
            font-weight: bold;
            border-radius: 50%;
            text-align: center;
            z-index: 11;
            box-shadow: rgba(0, 0, 0, 0.56) 0px 22px 70px 4px;
            padding-top:20px;
            padding-bottom:20px;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
            }
        }

        .logo-loading-collapse {
            max-width: 100%;
            height: auto;

            z-index: 12;
            animation: pulse 1.5s infinite;
        }
   </style>


    @yield('header')
</head>

<body class="header-dark sidebar-light   @hasSection('sidebarType') @yield('sidebarType')  @else sidebar-expand @endif">
    @if (Auth::user())
    <div id="wrapper" class="wrapper">
        <!-- HEADER & TOP NAVIGATION -->
        <nav class="navbar" >
            <!-- Logo Area -->
            <div class="navbar-header" >
                <a href="/" class="navbar-brand">
                    <img class="logo-expand p-1" alt="" src="{{ asset('assets/demo/logo-expand.png') }}">
                    <img class="logo-collapse p-1" alt="" src="{{ asset('assets/demo/logo-collapse.png') }}">
                    <!-- <p>BonVue</p> -->
                </a>
            </div>
            <!-- /.navbar-header -->
            <!-- Left Menu & Sidebar Toggle -->
            <ul class="nav navbar-nav">
                <li class="sidebar-toggle"><a href="javascript:void(0)" class="ripple"><i class="feather feather-menu list-icon fs-20"></i></a>
                </li>
            </ul>
            <!-- /.navbar-left -->
            <!-- Search Form -->

            <!-- /.navbar-search -->
            <div class="spacer"></div>
            <!-- Button: Create New -->

            <!-- /.btn-list -->
            <!-- User Image with Dropdown -->
            <ul class="nav navbar-nav">
                <li class="dropdown"><a href="javascript:void(0);" class="dropdown-toggle ripple" data-toggle="dropdown">
                <i class="feather feather-user list-icon"></i></span></a>
                <div class="dropdown-menu dropdown-left dropdown-card dropdown-card-profile animated flipInY">
                    <div class="card">
                        <ul class="list-unstyled card-body">
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span><span class="align-middle">Logout</span></span></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            </ul>
            <!-- /.navbar-right -->
            <!-- Right Menu -->
            <ul class="nav navbar-nav d-none d-lg-flex ml-2 ml-0-rtl">
                <li class="dropdown"><a href="javascript:void(0);" class="dropdown-toggle ripple" data-toggle="dropdown"><i class="feather feather-bell list-icon"></i></a>
                    <div class="dropdown-menu dropdown-left dropdown-card animated flipInY">
                        <div class="card">
                            <header class="card-header d-flex align-items-center mb-0"></i></a>  <span class="heading-font-family flex-1 text-center fw-400">Bildirimler</span>
                            </header>
                            <ul class="card-body list-unstyled dropdown-list-group">

                            </ul>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.dropdown-menu -->
                </li>
                <!-- /.dropdown -->

            </ul>
            <!-- /.navbar-right -->
            </nav>
    <!-- /.navbar -->
    <div class="content-wrapper">
        <!-- SIDEBAR -->
        <aside class="site-sidebar scrollbar-enabled" data-suppress-scroll-x="true">
            <!-- User Details -->
            <div class="side-user">
                <div class="col-sm-12 text-center p-0 clearfix">
                    <div class="d-inline-block pos-relative mr-b-10">
                        <figure class="thumb-sm mr-b-0 user--online">
                            <img src="{{ asset('assets/demo/profile-icon.png') }}" class="rounded-circle" alt="">
                        </figure><a href="" class="text-muted side-user-link"><i class="feather feather-settings list-icon"></i></a>
                    </div>
                    <!-- /.d-inline-block -->
                    <div class="lh-14 mr-t-5">
                        <a href="" class="hide-menu mt-3 mb-0 side-user-heading fw-500">
                           @if (Auth::user())
                            {{ Auth::user()->name }}


                           @endif
                        </a>
                        <br><small class="hide-menu text-primary">
                            @if (Auth::user()->permName == 'worker')
                                Worker
                            @else
                            Admin
                            @endif
                        </small>
                    </div>
                </div>
                <!-- /.col-sm-12 -->
            </div>
            <!-- /.side-user -->
            <!-- Sidebar Menu -->
            @if (Auth::user())

            @endif
            @include('layouts.sidebar')
            <!-- /.sidebar-nav -->

            <!-- /.nav-contact-info -->
            </aside>
        <!-- /.site-sidebar -->
        <main class="main-wrapper clearfix">
            <div id="loading-body" >
                <div id="loadingIndicator" >
                    <img class="logo-loading-collapse" alt="" src="{{ asset('assets/demo/logo-collapse.png') }}">
                </div>
            </div>
            @yield('content')
        </main>
        <!-- /.main-wrappper -->
        <!-- /.chat-panel -->
    </div>
    @endif

    <!-- /.content-wrapper -->
    <!-- FOOTER -->
    {{-- style="background-color: red;" --}}
    <footer class="footer" ><span class="heading-font-family">Copyright @ {{ date("Y") }} </span>
    </footer>
    </div>
    <!--/ #wrapper -->
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.2/umd/popper.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.0/metisMenu.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/js/perfect-scrollbar.jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/1.9.2/countUp.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment-with-locales.min.js"></script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300,
                lang: 'tr-TR', // Türkçe dil desteği için
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['black',]],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ]
            });
        });
    </script>
    <script>
        function formLoading() {

            // Sayfanın başına git
            $('html, body').animate({
                scrollTop: 0
            }, 'slow');

            // Loading mesajını göster
            $('#loading-body').show();

            // Form elemanlarını devre dışı bırak
            $('form :input').prop('readonly', true);
            toastr.options.onShown = function () {
                var toastrType = $('.toast').last().hasClass('toast-success') ? 'success' : 'error';
                console.log('Toastr type is:', toastrType);

                // Do something based on the toastr type
                if (toastrType === 'error') {
                console.log('tost hatalı');
                $('#loading-body').hide();
                $('form :input').prop('readonly', false);
                } else if (toastrType === 'success') {
                console.log('tost başarılı');
                }

                // Reset onShown
                toastr.options.onShown = function () {};
            };

        }
    </script>
    <script>

        $(document).on('click', '.btn-danger', function(e) {
            var href = $(this).attr('href');
            if(href.includes("delete"))
            {
                formLoading();
            }
        })
    </script>
    <script>
        $(document).ready(function(){
            // Check toastr type onShown
            toastr.options.onShown = function () {
                var toastrType = $('.toast').last().hasClass('toast-success') ? 'success' : 'error';
                console.log('Toastr type is:', toastrType);

                // Do something based on the toastr type
                if (toastrType === 'success') {
                console.log('tost başarılı');
                } else if (toastrType === 'error') {
                console.log('tost hata verdi');
                }

                // Reset onShown
                toastr.options.onShown = function () {};
            };
        })
    </script>


    @yield('footer')


</body>
</html>
