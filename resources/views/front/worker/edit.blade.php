@extends('layouts.app')
@section('header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
@section('sidebarType') sidebar-collapse @endsection
<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Arbeiter Bearbeiten</h6>
        
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Panel</a>
            </li>
            <li class="breadcrumb-item active">Arbeiter</li>
        </ol>
        {{-- <div class="d-none d-md-inline-flex justify-center align-items-center">
            <a href="{{ route('worker.store') }}" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple">Yeni İşçi Ekle</a>
        </div> --}}
    </div>
    <!-- /.page-title-right -->
</div>

@if(session("status"))
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="alert alert-success">{{ session("status") }}</div>
        </div>
    </div>  
@endif

@if(session("status2"))
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="alert alert-danger">{{ session("status2") }}</div>
        </div>
    </div>  
@endif

<div class="widget-list">
                <div class="row">
                    <div class="col-md-12 widget-holder">
                        <div class="widget-bg">
                            <div class="widget-body clearfix">
                                <form action="{{ route('worker.update',['id'=>$data['id']]) }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="col-form-label">Name</label>
                                            <input class="form-control" required name="name" type="text" placeholder="Worker Name" value="{{ $data['name'] }}">
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label class="col-form-label">Nachname</label>
                                            <input class="form-control" required name="surname" type="text" placeholder="Worker Surname" value="{{ $data['surname'] }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="col-form-label" >E-mail</label>
                                            <input class="form-control" required  name="email" type="email" placeholder="worker@example.com" value="{{ $data['email'] }}">
                                            <i class="text-primary">Erforderlich für die Panel-Anmeldung</i>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="col-form-label" >Passwort</label>
                                            <input class="form-control"  name="password" type="password" placeholder="Password">
                                            <i class="text-primary">Erforderlich für die Panel-Anmeldung</i>
                                        </div>

                                        <div class="col-md-12">
                                            <label class=" col-form-label" for="l0">Telefon</label>
                                            <input class="form-control" type="text" id="phone"  placeholder="Worker Number" name="phone" value="{{ $data['phone'] }}">
                                            <small class="text-primary"><i>Important For Notifications</i></small>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="col-form-label" >Preis/Stunde</label>
                                            <input class="form-control" required name="workPrice" type="number" placeholder="[CHF]" value="{{ $data['workPrice'] }}">
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <div class="form-group row">
                                            <div class="col-md-12 ml-md-auto btn-list">
                                                <button class="btn btn-primary btn-rounded" type="submit">Speichern</button>
                                            </div>
                                        </div>
                                    </div>


                                </form>
                            </div>
                            <!-- /.widget-body -->
                        </div>
                        <!-- /.widget-bg -->
</div>
@endsection
@section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
    // Vanilla Javascript
    var input = document.querySelector("#phone");
    window.intlTelInput(input,({
        preferredCountries : ["ch","tr","de","li","at","it","fr"],
        formatOnDisplay:true,
        nationalMode:true,
    }));
 
    $(document).ready(function() {
        $('.iti__flag-container').click(function() { 
          var countryCode = $('.iti__selected-flag').attr('title');
          var countryCode = countryCode.replace(/[^0-9]/g,'')
          $('#phone').val("");
          $('#phone').val("+"+countryCode+ $('#phone').val());
       });
    });
</script>
@endsection