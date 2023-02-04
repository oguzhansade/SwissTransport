@if (App\Models\UserPermission::getMyControl(4))

@endif


@extends('layouts.app')
@section('content')
<!-- Page Title Area -->
<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">@if (App\Models\UserPermission::getMyControl(4)) Worker Panel @else Admin Panel @endif</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Panel</a>
            </li>
            <li class="breadcrumb-item active">Homepage</li>
        </ol>
    </div>
    <!-- /.page-title-right -->
</div>
<!-- /.page-title -->
<!-- =================================== -->
<!-- Different data widgets ============ -->
<!-- =================================== -->

@if (App\Models\UserPermission::getMyControl(4))

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Welcome <b>{{ App\Models\User::getUser(Auth::id(),'name') }}</b></h3>
        </div>
    </div>

    <div class="row">
        <a href="{{ route('workerPanel.index') }}">Tasks</a>
    </div>
</div>
@else
<h3>Willkommen im Admin-Panel Datum: {{ \Carbon\Carbon::now() }}</h3>
{{-- <div class="widget-list row">
    <!-- /.widget-holder -->
    <div class="widget-holder widget-sm widget-border-radius col-md-3">
        <div class="widget-bg">
            <div class="widget-heading bg-purple"><span class="widget-title my-0 color-white fs-12 fw-600">Gelir Faturası</span>
            </div>
            <!-- /.widget-heading -->
            <div class="widget-body">
                <div class="counter-w-info">
                    <div class="counter-title color-color-scheme"><span class="counter"></span>Adet</div>
                </div>
                <!-- /.counter-w-info -->
            </div>
            <!-- /.widget-body -->
        </div>
        <!-- /.widget-bg -->
    </div>
    <div class="widget-holder widget-sm widget-border-radius col-md-3">
        <div class="widget-bg">
            <div class="widget-heading bg-purple"><span class="widget-title my-0 color-white fs-12 fw-600">Gider Faturası</span>
            </div>
            <!-- /.widget-heading -->
            <div class="widget-body">
                <div class="counter-w-info">
                    <div class="counter-title color-color-scheme"><span class="counter"></span>Adet</div>
                </div>
                <!-- /.counter-w-info -->
            </div>
            <!-- /.widget-body -->
        </div>
        <!-- /.widget-bg -->
    </div>
    <div class="widget-holder widget-sm widget-border-radius col-md-3">
        <div class="widget-bg">
            <div class="widget-heading bg-purple"><span class="widget-title my-0 color-white fs-12 fw-600">Toplam Ödeme</span>
            </div>
            <!-- /.widget-heading -->
            <div class="widget-body">
                <div class="counter-w-info">
                    <div class="counter-title color-color-scheme"><span class="counter"></span>TL</div>
                </div>
                <!-- /.counter-w-info -->
            </div>
            <!-- /.widget-body -->
        </div>
        <!-- /.widget-bg -->
    </div>
    <div class="widget-holder widget-sm widget-border-radius col-md-3">
        <div class="widget-bg">
            <div class="widget-heading bg-purple"><span class="widget-title my-0 color-white fs-12 fw-600">Toplam Tahsilat</span>
            </div>
            <!-- /.widget-heading -->
            <div class="widget-body">
                <div class="counter-w-info">
                    <div class="counter-title color-color-scheme"><span class="counter"></span>TL</div>
                </div>
                <!-- /.counter-w-info -->
            </div>
            <!-- /.widget-body -->
        </div>
        <!-- /.widget-bg -->
    </div>
</div> --}}
@endif

<!-- /.widget-list -->
<hr>
{{-- <div class="widget-list row">
    <div class="widget-holder widget-full-height col-md-12">
        <div class="widget-bg">
            <div class="widget-heading widget-heading-border">
                <h5 class="widget-title">Son Yapılan İşlemler</h5>
                <div class="widget-actions">
                    <div class="predefinedRanges badge bg-success-contrast px-3 cursor-pointer heading-font-family" data-plugin-options='{

        "locale": {

          "format": "MMM YYYY"

        }

       }'><span></span>  <i class="feather feather-chevron-down ml-1"></i>
                    </div>
                </div>
                <!-- /.widget-actions -->
            </div>
            <!-- /.widget-heading -->
            <div class="widget-body">
                <table class="widget-latest-transactions">

                    <!-- /.single -->
                </table>
                <!-- /.widget-latest-transactions -->
            </div>
            <!-- /.widget-body -->
        </div>
        <!-- /.widget-bg -->
    </div>

</div> --}}
<!-- /.widget-list -->

<!-- /.widget-list -->
@endsection