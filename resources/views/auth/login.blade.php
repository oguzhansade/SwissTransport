
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/demo/logo-collapse.png') }}">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login - Swiss Transport CRM</title>
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600|Roboto:400" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendors/material-icons/material-icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendors/mono-social-icons/monosocialiconsfont.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendors/feather-icons/feather.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <!-- Head Libs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script> --}}
</head>

<body class="body-bg-full profile-page">
    <div id="wrapper" class="wrapper">
        <div class="row container-min-full-height">
            <div class="col-lg-12 p-3 login-left">
                <div class="w-50">
                    <h2 class="mb-4 text-center"><img alt="" class="logo-expand" src="{{ asset('assets/demo/logo-expand.png') }}"></h2>
                    <form class="text-center" method="POST" action="{{ route('login') }}">
                        @csrf
                        @if(Session::has('error'))
                        <div class="alert alert-danger">
                        {{ Session::get('error')}}
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="text-muted" for="example-email">Email</label>
                            <input type="email" placeholder="example@email.com" class="form-control form-control-line" name="email" >
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-muted" for="example-password">Passwort</label>
                            <input type="password" placeholder="password" class="form-control form-control-line" name="password" value="111111">
                        </div>

                        <div class="form-group no-gutters mb-5 text-center"><a href="page-forgot-pwd.html" id="to-recover" class="text-muted fw-700 text-uppercase heading-font-family fs-12">Forgot Password?</a>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group mr-b-20">
                            <button class="btn btn-block btn-rounded btn-md btn-color-scheme text-uppercase fw-600 ripple" type="submit">Login</button>
                        </div>
                    </form>
                    <!-- /form -->
                    
                </div>
                <!-- /.w-75 -->
            </div>
            
            <!-- /.login-right -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.wrapper -->
    <!-- Scripts -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/material-design.js') }}"></script>
</body>

</html>




@extends('layouts.app')

