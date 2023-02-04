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
                    <h6 class="page-title-heading mr-0 mr-r-5">Benutzer</h6>
                 
                </div>
                <!-- /.page-title-left -->
                <div class="page-title-right d-none d-sm-inline-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Panel</a>
                        </li>
                        <li class="breadcrumb-item active">Benutzer</li>
                    </ol>
                    {{-- <div class="d-none d-md-inline-flex justify-center align-items-center">
                        <a href="{{ route('user.store') }}" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple">Yeni Kullanıcı Ekle</a>
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
                                <form action="{{ route('user.store') }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="col-form-label" >Nutzername</label>
                                            <input class="form-control" required name="name" type="text">
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <label class="col-form-label" >E-mail</label>
                                            <input class="form-control" required name="email" type="email">
                                        </div>

                                        <div class="col-md-12">
                                            <label class="col-form-label" >Passwort</label>
                                            <input class="form-control" required name="password" type="password">
                                        </div>

                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="col-form-label" >Genehmigung</label>
                                            </div>
                                            @foreach ( \Illuminate\Support\Facades\Config::get('app.permissions') as $k => $v )
                                                @if($k == 4 && $v == 'workerPanel')@continue; @endif
                                                <div class="col-md-4 ">                                                    
                                                    <div class="checkbox checkbox-rounded checkbox-primary">
                                                        <label class="checkbox-checked">
                                                            <input type="checkbox" name="permission[]"  value="{{ $k }}"> <span class="label-text">{{ $v }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
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
                            <!-- /.widget-body -->
                        </div>
                        <!-- /.widget-bg -->
</div>
@endsection
@section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
@endsection