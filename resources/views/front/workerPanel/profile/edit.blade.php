@extends('layouts.app')
@section('header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" rel="stylesheet" type="text/css">
<style>
    .rounded-custom {
   border-radius: 35px;
}
.b-shadow {
   box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
}
.back-button {
   cursor: pointer;
}
</style>
@endsection

@section('content')
@section('sidebarType') sidebar-collapse @endsection
<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Profil</h6>
        
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Panel</a>
            </li>
            <li class="breadcrumb-item active">Profil</li>
        </ol>
        <div class="d-none d-md-inline-flex justify-center align-items-center">
            <a href="{{ route('worker.store') }}" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple">Yeni İşçi Ekle</a>
        </div>
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
<div class="row d-flex p-0 justify-content-between" >
    <div class="col-md-6 d-flex justify-content-start">
        <a href="/" class="h4 px-4 py-2 bg-primary text-white b-shadow rounded-custom text-center d-flex align-items-center back-button">
            <i class="feather feather-arrow-left align-self-center pr-1"></i>Zurück</b>
        </a> 
    </div>
    <div class="col-md-6 d-flex justify-content-end">
        <span class="h4 px-4 py-2 bg-primary text-white b-shadow rounded-custom">Arbeiter: <b>{{ App\Models\Worker::fullName2(Auth::id()) }}</b></span> 
    </div>
</div>

<div class="widget-list">
    <div class="row">
        <div class="col-md-12 widget-holder">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <form action="{{ route('workerPanel.profileUpdate',['userId'=> Auth::id()]) }}" autocomplete="off" method="POST" enctype="multipart/form-data">
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
                                <small><i class="text-primary">Important for panel login</i></small>
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label" >Passwort</label>
                                <input class="form-control"  name="password" type="password" placeholder="Password">
                                <small><i class="text-primary">Important for panel login</i></small>
                            </div>

                            <div class="col-md-12">
                                {{-- <label class="col-form-label" >Preis/Stunde</label> --}}
                                <input class="form-control" required name="workPrice" type="hidden" value="{{ $data['workPrice'] }}">
                            </div>

                            <div class="col-md-12">
                                <label class="col-form-label" >Telefon</label>
                                <input class="form-control" required name="phone" type="text" placeholder="Worker Phone" value="{{ $data['phone'] }}" readonly>
                                <small><i class="text-primary">Ask admin to change phone number</i></small>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="form-group row">
                                <div class="col-md-12 ml-md-auto btn-list">
                                    <button class="btn btn-primary btn-rounded" type="submit">Erstellen</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
@endsection