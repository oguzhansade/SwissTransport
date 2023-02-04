@extends('layouts.app')
@section('content')
@section('sidebarType') sidebar-collapse @endsection
<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Tarif Bearbeiten</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Panel</a>
            </li>
            <li class="breadcrumb-item active">Tarif</li>
        </ol>
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

<div class="widget-list">
    <div class="row">
        <div class="col-md-12 widget-holder">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <form action="{{ route('tariff.update',['id'=>$data['id']]) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">Tarifbeschreibung</label>
                                    <input class="form-control" name="tariffDescription"  type="text" required value="{{ $data['description'] }}">                                
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class=" col-form-label" for="l0">Tariftyp</label>
                                <select class="form-control" class="tariffCategory" name="tariffCategory" id="tariffCategory" >
                                    {{-- <option data-selection="24" value>Lütfen Seçin</option> --}}
                                    @foreach (\App\Models\TariffCategory::get() as $key=>$value )
                                        <option  value="{{ $value['id'] }}" @if ($value['id'] == $data['tariffType']) selected @endif >{{ $value['categoryName'] }}</option>
                                    @endforeach
                                </select> 
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label class=" col-form-label" for="l0">MA</label>
                                    <input class="form-control"  name="ma"   type="number"  required value="{{ $data['ma'] }}">                                
                                </div>

                                <div class="col">
                                    <label class=" col-form-label" for="l0">LKW</label>
                                    <input class="form-control"  name="lkw"   type="number"  required value="{{ $data['lkw'] }}">                                
                                </div>

                                <div class="col">
                                    <label class=" col-form-label" for="l0">ANHANGER</label>
                                    <input class="form-control"  name="anhanger"   type="number"  required value="{{ $data['anhanger'] }}">                                
                                </div>

                                <div class="col">
                                    <label class=" col-form-label" for="l0">CHF</label>
                                    <input class="form-control"  name="chf"  type="number"  required value="{{ $data['chf'] }}">                                
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.0/metisMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/js/perfect-scrollbar.jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/3.1.2/jquery.bootstrap-touchspin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.1.7/js/ion.rangeSlider.min.js"></script>
@endsection