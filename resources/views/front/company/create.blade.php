@extends('layouts.app')
@section('content')
@section('sidebarType') sidebar-collapse @endsection
<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Neue Firma Erfassen</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Panel</a>
            </li>
            <li class="breadcrumb-item active">Firma</li>
        </ol>
        {{-- <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Yeni Firma Ekle</a>
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
                    <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-5" style="border-bottom: 2px solid #6931E7">
                                <h3>Firmeninfo</h3>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0" >Name der Firma</label>
                                <input class="form-control" name="name"  type="text" required>                                
                            </div>

                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0">Strasse</label>
                                <input class="form-control"  name="street"  type="text" required>                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0">PLZ</label>
                                <input class="form-control" name="post_code"  type="number" required>                                
                            </div>

                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0">Ort</label>
                                <input class="form-control"  name="city"  type="text" required>                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class=" col-form-label" for="l0">Telefon</label>
                                <input class="form-control"  name="phone"  type="tel" required>                                
                            </div>

                            <div class="col-md-4">
                                <label class=" col-form-label" for="l0">Mobile</label>
                                <input class="form-control"  name="mobile"  type="tel" required>                                
                            </div>

                            <div class="col-md-4">
                                <label class=" col-form-label" for="l0">Bezugsperson/Plattform</label>
                                <input class="form-control"  name="contact_person"  type="text" required>                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0">E-mail</label>
                                <input class="form-control" name="email"  type="email" required>                                
                            </div>

                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0">Web</label>
                                <input class="form-control"  name="website"  type="url" required>                                
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
    </div>
</div>

@endsection

@section('footer')
    <script>
        $(".change-customerType").click(function() {
            var value = $(this).val();
            if(value == 1)
            {
                $(".firma--area").show();
            }
            else {
                $(".firma--area").hide();
            }
        });
    </script>
@endsection