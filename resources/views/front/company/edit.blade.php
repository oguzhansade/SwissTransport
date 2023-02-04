@extends('layouts.app')
@section('content')
@section('sidebarType') sidebar-collapse @endsection
<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Firma Bearbeiten</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Panel</a>
            </li>
            <li class="breadcrumb-item active">Firma</li>
        </ol>
        {{-- <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Firma Düzenle</a>
        </div> --}}
    </div>
    <!-- /.page-title-right -->
</div> 

@if (session("status"))
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="alert alert-success">
                {{ session("status") }}
            </div>
        </div>
    </div>

@endif

<div class="widget-list">
    <div class="row">
        <div class="col-md-12 widget-holder">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <form action="{{ route('company.update',['id'=>$data[0]['id']]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-5" style="border-bottom: 2px solid #6931E7">
                                <h3>Firmeninfo</h3>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0" >Name der Firma</label>
                                <input class="form-control" name="name"  type="text" value="{{ $data[0]['name'] }}">                                
                            </div>

                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0">Strasse</label>
                                <input class="form-control"  name="street"  type="text" value="{{ $data[0]['street'] }}">                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0">PLZ</label>
                                <input class="form-control" name="post_code"  type="number" value="{{ $data[0]['post_code'] }}">                                
                            </div>

                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0">Ort</label>
                                <input class="form-control"  name="city"  type="text" value="{{ $data[0]['city'] }}">                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class=" col-form-label" for="l0">Telefon</label>
                                <input class="form-control"  name="phone"  type="tel" value="{{ $data[0]['phone'] }}">                                
                            </div>

                            <div class="col-md-4">
                                <label class=" col-form-label" for="l0">Mobile</label>
                                <input class="form-control"  name="mobile"  type="tel" value="{{ $data[0]['mobile'] }}">                                
                            </div>

                            <div class="col-md-4">
                                <label class=" col-form-label" for="l0">Bezugsperson/Plattform</label>
                                <input class="form-control"  name="contact_person"  type="text" value="{{ $data[0]['contact_person'] }}">                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0">E-mail</label>
                                <input class="form-control" name="email"  type="email" value="{{ $data[0]['email'] }}">                                
                            </div>

                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0">Web</label>
                                <input class="form-control"  name="website"  type="url" value="{{ $data[0]['website'] }}">                                
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-5" style="border-bottom: 2px solid #6931E7">
                                <h3>E-Mail-Informationen des Unternehmens</h3>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0" >Host</label>
                                <input class="form-control" name="host"  type="text" value="{{ $data2[0]['host'] }}">                                
                            </div>

                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0">Port</label>
                                <input class="form-control"  name="port"  type="text" value="{{ $data2[0]['port'] }}">                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0" >SSL</label>
                                <input class="form-control" name="ssl"  type="checkbox" @if($data2[0]['ssl'] == 1) checked @endif>                                
                            </div>

                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0">Username</label>
                                <input class="form-control"  name="username"  type="text" value="{{ $data2[0]['username'] }}">                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class=" col-form-label" for="l0" >Password</label>
                                <input class="form-control" name="password"  type="text" value="{{ $data2[0]['password'] }}">                                
                            </div>

                            <div class="col-md-4">
                                <label class=" col-form-label" for="l0">Display Name</label>
                                <input class="form-control"  name="display_name"  type="text" value="{{ $data2[0]['display_name'] }}">                                
                            </div>

                            
                            <div class="col-md-4">
                                <label class=" col-form-label" for="l0">Reply Address</label>
                                <input class="form-control"  name="reply_address"  type="text" value="{{ $data2[0]['reply_address'] }}">                                
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
    </div>
</div>

@endsection

@section('footer')

@endsection