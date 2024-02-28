@extends('layouts.app')
@section('header')
<style>
    .color-box {
        display: inline-block;
        width: 40px;
        height: 40px;
        border: 1px solid #ccc;
        margin-right: 10px;
        border-radius: 0.25rem;
    }
    .color-box-preview {
        display: inline-block;
        width: 40px;
        height: 40px;
        border: 1px solid #ccc;
        margin-right: 10px;
        border-radius: 0.25rem;
    }
</style>
@endsection
@section('content')
@section('sidebarType') sidebar-collapse @endsection
<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Firma Ayarları </h6>
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
                    <form action="{{ route('company.updateOptions') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-5" style="border-bottom: 2px solid #6931E7">
                                <h3>Stil Ayarları</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <h6>Logo</h6>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="formFile" class="form-label">Logo-Expand</label>
                                    <img class="img-responsive " alt="" src="{{ asset('assets/demo/test-expand.png') }}" >
                                    <input class="form-control" type="file" id="formFile" name="logoExpand">
                                    <small>Dosya PNG formatında olmalı boyutu (300x100)</small>
                                </div>
                               
                                <div class="col-md-6 ">
                                    <label for="formFile" class="form-label">Logo-Collapse</label><br>
                                    <img class="img-responsive " alt="" src="{{ asset('assets/demo/test-collapse.png') }}" style="margin-top:30px">
                                    <input class="form-control " type="file" id="formFile" name="logoCollapse" style="margin-top:30px">    
                                    <small>Dosya PNG formatında olmalı boyutu (40x40)</small>                         
                                </div>
                                
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-2">
                                <label for="formFile" class="form-label">Crm-PrimaryColor</label><br>
                                <table>
                                    <tr>
                                        <td><div class="color-box-preview" id="color-box-preview"></div></td>
                                        <td>-></td>
                                        <td><div class="color-box ml-1" id="color-box"></div></td>
                                    </tr>
                                </table>
                                <input class="form-control" type="text" id="colorPicker" name="crmPrimaryColor"  value="{{ $company['crmPrimaryColor'] }}">   
                            </div>
                            <div class="col-md-2">
                                <label for="formFile" class="form-label">Crm-SecondaryColor</label><br>
                                <table>
                                    <tr>
                                        <td><div class="color-box-preview" id="color-box-preview2"></div></td>
                                        <td>-></td>
                                        <td><div class="color-box ml-1" id="color-box2"></div></td>
                                    </tr>
                                </table>
                                <input class="form-control" type="text" id="colorPicker2" name="crmSecondaryColor" value="{{ $company['crmSecondaryColor'] }}">   
                            </div>
                            <div class="col-md-2">
                                <label for="formFile" class="form-label">Pdf-PrimaryColor</label><br>
                                <table>
                                    <tr>
                                        <td><div class="color-box-preview" id="color-box-preview3"></div></td>
                                        <td>-></td>
                                        <td><div class="color-box ml-1" id="color-box3"></div></td>
                                    </tr>
                                </table>
                                <input class="form-control" type="text" id="colorPicker3" name="pdfPrimaryColor" value="{{ $company['pdfPrimaryColor'] }}">   
                            </div>
                        </div>

                        <div class="form-actions mt-3">
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

<script>
    $(document).ready(function(){
        var color = $('#colorPicker').val();

        $('#color-box').css('background-color', color);
        $('#color-box-preview').css('background-color', color);

        $('#colorPicker').on('input', function() {
            var color = $(this).val();
            $('#color-box').css('background-color', color);
        });

        var color2 = $('#colorPicker2').val();
        $('#color-box-preview2').css('background-color', color2);
        $('#color-box2').css('background-color', color2);
        $('#colorPicker2').on('input', function() {
            var color2 = $(this).val();
            $('#color-box2').css('background-color', color2);
        });
        var color3 = $('#colorPicker3').val();
        $('#color-box-preview3').css('background-color', color3);
        $('#color-box3').css('background-color', color3);
        $('#colorPicker3').on('input', function() {
            var color3 = $(this).val();
            $('#color-box3').css('background-color', color3);
        });
    });
</script>
@endsection