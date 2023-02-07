@extends('layouts.app')
@section('header')
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
        <h6 class="page-title-heading mr-0 mr-r-5">Aufgaben</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Panel</a>
            </li>
            <li class="breadcrumb-item active">Aufgaben</li>
        </ol>
        {{-- <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Yeni Görev Ekle</a>
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

@if (session("status2"))
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="alert alert-danger">
                {{ session("status2") }}
            </div>
        </div>
    </div>
@endif

<div class="row d-flex p-0 justify-content-between" >
    <div class="col-md-6 d-flex justify-content-start">
        <a href="{{ route('workerPanel.task',['id'=> Auth::id()]) }}" class="h4 px-4 py-2 bg-primary text-white b-shadow rounded-custom text-center d-flex align-items-center back-button">
            <i class="feather feather-arrow-left align-self-center pr-1"></i>Zurück</b>
        </a> 
    </div>
    <div class="col-md-6 d-flex justify-content-end">
        <span class="h4 px-4 py-2 bg-primary text-white b-shadow rounded-custom">Arbeiter: <b>{{ App\Models\Worker::fullName($data['workerId']) }}</b></span> 
    </div>
</div>

    <div class="widget-list">
        <div class="row">
            <div class="col-md-12 widget-holder task-area">
                <div class="widget-bg">
                    <div class="widget-body clearfix">
                        <form action="{{ route('workerPanel.taskUpdate',['userId' => $data['userId'],'id'=>$data['id']]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
    
                            <div class="row p-3">
                                <div class="col-md-12">
                                    <table >
                                        <tr>
                                            <td><span class="h6 ">Arbeiter: </span></td>
                                            <td><span class="pl-3 h6 text-primary "> <b>{{ App\Models\Worker::fullName($data['workerId']) }}</b></span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="h6">Offerte No:  </span></td>
                                            <td><span class="pl-3 h6 text-primary"><b> {{ $data['offerteId'] }}</b></span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="h6">Missionsdatum:  </span></td>
                                            <td><span class="pl-3 h6 text-primary"><b> {{  date('d-m-Y', strtotime($task['taskDate'])); }}</b></span></td>
                                        </tr>

                                        <tr>
                                            <td><span class="h6">Dienststunde:  </span></td>
                                            <td><span class="pl-3 h6 text-primary"><b> {{ $task['taskTime'] }}</b></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="l0">Arbeitsstunden</label>
                                    <input class="form-control" class="workerHour"  name="workerHour"  type="text" value="{{ $data['workerHour'] }}"> 
                                </div>
                            </div>
          
                            <div class="form-actions p-3 mt-3">
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
    $(document).ready(function(){
        $('body').on('change','.task-area',function () {
        var saat = $('input[name=workHour]').val();
        var fiyat = $('input[name=workPrice]').val();
        $("body").on("change",".isci",function () {
            fiyat = $(this).find(":selected").data("fiyat");
            $('input[name=workPrice]').val(fiyat);
        })
        $('input[name=totalPrice]').val(saat*fiyat);
    })
    })
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.0/metisMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/js/perfect-scrollbar.jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/3.1.2/jquery.bootstrap-touchspin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.1.7/js/ion.rangeSlider.min.js"></script>
@endsection