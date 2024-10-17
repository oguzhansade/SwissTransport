@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <style>
        .custom-shadow {
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            border-radius: 25px;
        }
    </style>
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
@endsection
@section('content')
 <!-- Page Title Area -->
 <div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Bexio Index Müşteri Sayfası</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Panel</a>
            </li>
            <li class="breadcrumb-item active">Bexio</li>
        </ol>
        {{-- <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Müşteri Listesi</a>
        </div> --}}
    </div>
    <!-- /.page-title-right -->
</div>
<div class="widget-list">
    <div class="row d-flex justify-content-center ">
        <div class="col-md-12 widget-holder ">
            <div class="widget-bg custom-shadow">
                <div class="widget-body clearfix">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center align-items-center">
                            <h1>BEXIO NOTIFICATION</h1>
                        </div>
                        @if($data == 'success1')
                        <div class="col-md-12 text-center">
                            <div class="row">
                                <div class="col"><h1 class="text-success text-center "><i class="feather feather-check-circle" ></i></h1></div>
                            </div>
                            <div class="row">
                                <div class="col"><h6 class="text-success">SUCCESS: BEXIO FATURASI OLUŞTURULDU {{ $message }}</h6></div>
                            </div>
                        </div>
                            @else
                        <div class="col-md-12 text-center">
                            <div class="row">
                                <div class="col"><h1 class="text-danger text-center "><i class="feather feather-x-circle" ></i></h1></div>
                            </div>
                            <div class="row">
                                <div class="col"><h6 class="text-danger">ERROR: BEXIO FATURASI OLUŞTURULDU {{ $message }}</h6></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
    </div>
</div>
<!-- /.widget-list -->
@endsection

@section('footer')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
@endsection
