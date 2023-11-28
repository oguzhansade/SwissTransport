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
                    <h6 class="page-title-heading mr-0 mr-r-5">Benutzer Bearbeiten</h6>
                </div>
                <!-- /.page-title-left -->
                <div class="page-title-right d-none d-sm-inline-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Panel</a>
                        </li>
                        <li class="breadcrumb-item active">Benutzer</li>
                    </ol>
                    {{-- <div class="d-none d-md-inline-flex justify-center align-items-center">
                        <a href="{{ route('user.update',['id' => $data[0]['id']]) }}" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple">Kullanıcı Düzenle</a>
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

<div class="widget-list">
                <div class="row">
                    <div class="col-md-12 widget-holder">
                        <div class="widget-bg">
                            <div class="widget-body clearfix">
                                <form action="{{ route('user.update',['id'=>$data[0]['id']]) }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="col-form-label" >Nutzername</label>
                                            <input class="form-control" required name="name" type="text" value="{{ $data[0]['name'] }}">
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <label class="col-form-label" >E-mail</label>
                                            <input class="form-control" required name="email" type="email" value="{{ $data[0]['email'] }}">
                                        </div>

                                        <div class="col-md-12">
                                            <label class="col-form-label" >Passwort</label>
                                            <input class="form-control"  name="password" type="password" >
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="col-form-label" >Genehmigung </label>
                                            </div>
                                            <div class="radiobox colors">
                                                <label class="mt-1 ">
                                                    <input type="radio" class=""  name="permName" value="superAdmin" @if($data[0]['permName'] == 'superAdmin') checked @endif> 
                                                    <span class="label-text pl-4 ml-1 col-form-label default" >Super Admin</span>
                                                </label>
                                                <label class="mt-1 ">
                                                    <input type="radio" class=""  name="permName" value="chef" @if($data[0]['permName'] == 'chef') checked @endif> 
                                                    <span class="label-text pl-4 ml-1 col-form-label default" >Chef</span>
                                                </label>
                                                <label class="mt-1 ">
                                                    <input type="radio" class=""  name="permName" value="officer" @if($data[0]['permName'] == 'officer') checked @endif> 
                                                    <span class="label-text pl-4 ml-1 col-form-label default" >Officer</span>
                                                </label>
                                            </div>
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
@endsection