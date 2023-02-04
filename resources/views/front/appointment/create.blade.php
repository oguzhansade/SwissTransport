@extends('layouts.app')
@section('header')
<script src="https://cdn.tiny.cloud/1/qa7zzv3hb9nmr5ary4ucaw8bbt8744dzibxuf6hdomgsuchu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
@endsection
@section('content')
@section('sidebarType') sidebar-collapse @endsection

<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Termine</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Panel</a>
            </li>
            <li class="breadcrumb-item active">Termine </li>
        </ol>
        {{-- <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Yeni Randevu Ekle</a>
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

@if (session("status-err"))
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="alert alert-danger">
                {{ session("status-err") }}
            </div>
        </div>
    </div>
@endif

<div class="widget-list">
    <div class="row">
        <div class="col-md-12">
            <strong class="h5 mr-1"> <b>Kunde:</b> </strong> <span class="h5 text-primary ">
                {{ App\Models\Customer::getPublicName($data['id']) }}</span>
        </div>
        <div class="col-md-12 widget-holder">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <p><form id="myform" name="myForm" action="{{ route('appointment.store',['id' => $data['id']]) }}"  method="POST" enctype="multipart/form-data"></p>
                       @csrf
                        
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="" class="col-form-label">Art</label>
                                <div class="radiobox">
                                    <label>
                                        <input type="radio" class="appointment-type"  name="appType" value="1" checked> <span class="label-text">Besichtigung</span>
                                    </label>
                                </div>

                                <div class="radiobox">
                                    <label>
                                        <input type="radio"  class="appointment-type"  name="appType" value="2" > <span class="label-text">Auftragsbestätigung</span>
                                    </label>
                                </div>

                                <div class="radiobox">
                                    <label>
                                        <input type="radio" class="appointment-type"  name="appType" value="3" > <span class="label-text">Lieferung</span>
                                    </label>
                                </div>
                            </div>                            
                        </div>

                        {{-- Onay Alanı Başlangıç --}}
                        <div class="confirmation--area" style="display:none;">
                            <div class="form-group row">
                                <div class="col-md-12 umzug-control">
                                    <label for="" class="col-form-label">Payment Type</label><br>
                                    <select class="form-control" name="paymentType" id="paymentType">
                                        <option value="0">Bar</option>
                                        <option value="1">Invoice</option>
                                    </select> 
                                </div>                            
                            </div>

                            {{-- Umzug Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 umzug-control">
                                    <label for="" class="col-form-label">Umzug</label><br>
                                    <input type="checkbox" name="isUmzug" id="isUmzug" class="js-switch" data-size="small" data-color="#9c27b0" data-switchery="false" >  
                                </div>                            
                            </div>
                            {{-- Umzug Alanı Kontrolü Bitiş --}}

                            {{-- Umzug Alanı --}}
                            <div class="form-group row umzug--area" style="display: none;">
                                {{-- 1.Umzug Alanı Başlangıç --}}
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Umzugstermin Am</label>
                                    <input class="form-control" class="date" id="umzug1date" name="umzug1date"  type="date" >                                
                                </div>
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Umzugstermin Stunde</label>
                                    <input class="form-control"  name="umzug1time"  type="time" >                                
                                </div>

                                <div class="w-100 row rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Dauer [h]</label>
                                        <input class="form-control"  name="umzug1hours" placeholder="4-5"  type="text" >                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">MA</label>
                                        <input class="form-control"  name="umzug1ma" placeholder="0"  type="number" >                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">LKW</label>
                                        <input class="form-control"  name="umzug1lkw" placeholder="0"  type="number">                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Anhänger</label>
                                        <input class="form-control"  name="umzug1anhanger" placeholder="0"  type="number" >                                
                                    </div>
                                </div>
                                {{-- 1.Umzug Alanı Bitiş --}}
                                
                                {{-- 2.Umzug Alanı Kontrolü --}}
                                <div class="col-md-12 umzug-control2">
                                    <label for="" class="col-form-label">Weitere Umzugstermine</label><br>
                                    <input type="checkbox" name="isUmzug2" id="isUmzug2" class="js-switch" data-size="small" data-color="#9c27b0" data-switchery="false" >  
                                </div>
                                {{-- 2.Umzug Alanı Kontrolü --}}

                                {{-- 2.Umzug Alanı Başlangıç --}}
                                <div class="form-group row w-100 umzug--area2" style="display: none;">                                    
                                    <div class="col-md-6">
                                        <label class=" col-form-label" for="l0">Umzugstermin 2 Am</label>
                                        <input class="form-control" class="date" id="umzug2date"  name="umzug2date"  type="date" >                                
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class=" col-form-label" for="l0">Umzugstermin 2 Stunde</label>
                                        <input class="form-control"  name="umzug2time"  type="time" >                                
                                    </div>
    
                                    <div class="w-100 row rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">Dauer [h]</label>
                                            <input class="form-control"  name="umzug2hours" placeholder="4-5"  type="text" >                                
                                        </div>
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">MA</label>
                                            <input class="form-control"  name="umzug2ma" placeholder="0"  type="number" >                                
                                        </div>
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">LKW</label>
                                            <input class="form-control"  name="umzug2lkw" placeholder="0"  type="number" >                                
                                        </div>
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">Anhänger</label>
                                            <input class="form-control"  name="umzug2anhanger" placeholder="0"  type="number" >                                
                                        </div>
                                    </div>                                                                   
                                </div>
                                {{-- 2.Umzug Alanı Bitiş --}}

                                {{-- 3.Umzug Alanı Başlangıç --}}
                                <div class="form-group row w-100 umzug--area2" style="display: none;">                                    
                                    <div class="col-md-6">
                                        <label class=" col-form-label" for="l0">Umzugstermin 3 Am</label>
                                        <input class="form-control" class="date"  name="umzug3date"  type="date" >                                
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class=" col-form-label" for="l0">Umzugstermin 3 Stunde</label>
                                        <input class="form-control"  name="umzug3time"  type="time" >                                
                                    </div>
    
                                    <div class="w-100 row rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">Dauer [h]</label>
                                            <input class="form-control"  name="umzug3hours" placeholder="4-5"  type="text" >                                
                                        </div>
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">MA</label>
                                            <input class="form-control"  name="umzug3ma" placeholder="0"  type="number" >                                
                                        </div>
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">LKW</label>
                                            <input class="form-control"  name="umzug3lkw" placeholder="0"  type="number" >                                
                                        </div>
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">Anhänger</label>
                                            <input class="form-control"  name="umzug3anhanger" placeholder="0"  type="number" >                                
                                        </div>
                                    </div>                                                                   
                                </div>
                                {{-- 3.Umzug Alanı Bitiş --}}                                 
                            </div>
                            {{-- Umzug Alanı Bitiş --}} 

                            

                            {{-- Einpackservice Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 einpackservice-control">
                                    <label for="" class="col-form-label">Einpackservice</label><br>
                                    <input type="checkbox" name="isEinpackservice" id="isEinpackservice" class="js-switch" data-size="small" data-color="#9c27b0" data-switchery="false" >  
                                </div>                            
                            </div>
                            {{-- Einpackservice Alanı Kontrolü Bitiş --}}

                            {{-- Einpackservice Alanı Başlangıç --}}
                            <div class="form-group row einpackservice--area" style="display: none; ">
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Packtermin Am</label>
                                    <input class="form-control" class="date"  name="einpackdate"  type="date" >                                
                                </div>
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Packtermin Stunde</label>
                                    <input class="form-control"  name="einpacktime"  type="time" >                                
                                </div>
                                <div class="row w-100  mt-1 pl-1 text-primary" style="font-style: italic;">Falls gleiches Datum wie Umzug, dann leer lassen.</div>
                                
                                <div class="w-100 row rounded p-1 mt-3" style="background-color:  #CBB4FF;">
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Dauer [h]</label>
                                        <input class="form-control" class="einpacksuresi" id="einpacksuresi" aria-required=""  name="einpackhours" placeholder="4-5"  type="text" >                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">MA</label>
                                        <input class="form-control"  name="einpackma" placeholder="0"  type="number" >                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">LKW</label>
                                        <input class="form-control"  name="einpacklkw" placeholder="0"  type="number" >                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Anhänger</label>
                                        <input class="form-control"  name="einpackanhanger" placeholder="0"  type="number" >                                
                                    </div>
                                </div> 
                            </div>
                            {{-- Einpackservice Alanı Bitiş --}}


                             {{-- Auspackservice Alanı Kontrolü --}}
                             <div class="form-group row">
                                <div class="col-md-12 auspackservice-control">
                                    <label for="" class="col-form-label">Auspackservice</label><br>
                                    <input type="checkbox" name="isAuspackservice" id="isAuspackservice" class="js-switch" data-size="small" data-color="#9c27b0" data-switchery="false" >  
                                </div>                            
                            </div>
                            {{-- Auspackservice Alanı Kontrolü Bitiş --}}

                            {{-- Auspackservice Alanı Başlangıç --}}
                            <div class="form-group row auspackservice--area" style="display: none; ">
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Packtermin Am</label>
                                    <input class="form-control" class="date"  name="auspackdate"  type="date" >                                
                                </div>
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Packtermin Stunde</label>
                                    <input class="form-control"  name="auspacktime"  type="time" >                                
                                </div>
                                <div class="row w-100  mt-1 pl-1 text-primary" style="font-style: italic;">Falls gleiches Datum wie Umzug, dann leer lassen.</div>
                                
                                <div class="w-100 row rounded p-1 mt-3" style="background-color:  #CBB4FF;">
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Dauer [h]</label>
                                        <input class="form-control" class="auspacksuresi" id="auspacksuresi" aria-required=""  name="auspackhours" placeholder="4-5"  type="text" >                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">MA</label>
                                        <input class="form-control"  name="auspackma" placeholder="0"  type="number" >                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">LKW</label>
                                        <input class="form-control"  name="auspacklkw" placeholder="0"  type="number" >                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Anhänger</label>
                                        <input class="form-control"  name="auspackanhanger" placeholder="0"  type="number" >                                
                                    </div>
                                </div> 
                            </div>
                            {{-- Auspackservice Alanı Bitiş --}}

                            {{-- Reinigung Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 reinigung-control">
                                    <label for="" class="col-form-label">Reinigung</label><br>
                                    <input type="checkbox" name="isReinigung" id="isReinigung" class="js-switch" data-size="small" data-color="#9c27b0" data-switchery="false" >  
                                </div>                            
                            </div>
                            {{-- Reinigung Alanı Kontrolü Bitiş --}}

                            {{-- Reinigung Alanı Başlangıç --}}
                            <div class="form-group row reinigung--area" style="display: none; ">
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Reinigungstermin Am</label>
                                    <input class="form-control" class="date"  name="reinigung1Startdate"  type="date" >                                
                                </div>
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Reinigungstermin Stunde</label>
                                    <input class="form-control"  name="reinigung1Starttime"  type="time" >                                
                                </div>
                                <div class="row w-100 mb-2  mt-1 pl-1 text-primary" style="font-style: italic;">Falls gleiches Datum wie Umzug, dann leer lassen.</div>  
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Abgabetermin</label>
                                    <input class="form-control" class="date"  name="reinigung1Enddate"  type="date" >                                
                                </div>
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Abgabetermin Stunde</label>
                                    <input class="form-control"  name="reinigung1Endtime"  type="time" >                                
                                </div>
                            </div>                           
                            {{-- Reinigung Alanı Bitiş --}}

                            {{-- 2.Reinigung Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 reinigung2-control">
                                    <label for="" class="col-form-label">Reinigung 2</label><br>
                                    <input type="checkbox" name="isReinigung2" id="isReinigung2" class="js-switch" data-size="small" data-color="#9c27b0" data-switchery="false" >  
                                </div>                            
                            </div>
                            {{-- 2.Reinigung Alanı Kontrolü Bitiş --}}

                            {{-- 2.Reinigung Alanı Başlangıç --}}
                            <div class="form-group row reinigung2--area" style="display: none; ">
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Reinigungstermin 2 Am</label>
                                    <input class="form-control" class="date"  name="reinigung2Startdate"  type="date" >                                
                                </div>
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Reinigungstermin 2 Stunde</label>
                                    <input class="form-control"  name="reinigung2Starttime"  type="time" >                                
                                </div>
                                <div class="row w-100 mb-2  mt-1 pl-1 text-primary" style="font-style: italic;">Falls gleiches Datum wie Umzug, dann leer lassen.</div>  
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Abgabetermin </label>
                                    <input class="form-control" class="date"  name="reinigung2Enddate"  type="date" >                                
                                </div>
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Abgabetermin Stunde</label>
                                    <input class="form-control"  name="reinigung2Endtime"  type="time" >                                
                                </div>
                            </div>                           
                            {{-- 2.Reinigung Alanı Bitiş --}}

                            {{-- Entsorgung Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 entsorgung-control">
                                    <label for="" class="col-form-label">Entsorgung</label><br>
                                    <input type="checkbox" name="isEntsorgung" id="isEntsorgung" class="js-switch" data-size="small" data-color="#9c27b0" data-switchery="false" >  
                                </div>                            
                            </div>
                            {{-- Entsorgung Alanı Kontrolü Bitiş --}}

                            {{-- Entsorgung Alanı Başlangıç --}}
                            <div class="form-group row entsorgung--area" style="display: none; ">
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Entsorgungstermin Am</label>
                                    <input class="form-control" class="date"  name="entsorgungdate"  type="date" >                                
                                </div>
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Entsorgungstermin Stunde</label>
                                    <input class="form-control"  name="entsorgungtime"  type="time" >                                
                                </div>
                                <div class="row w-100  mt-1 pl-1 text-primary" style="font-style: italic;">Falls gleiches Datum wie Umzug, dann leer lassen.</div>
                                
                                <div class="w-100 row rounded p-1 mt-3" style="background-color:  #CBB4FF;">
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Dauer [h]</label>
                                        <input class="form-control" class="entsorgungsuresi" id="entsorgungsuresi" aria-required=""  name="entsorgunghours" placeholder="4-5"  type="text" >                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">MA</label>
                                        <input class="form-control"  name="entsorgungma" placeholder="0"  type="number" >                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">LKW</label>
                                        <input class="form-control"  name="entsorgunglkw" placeholder="0"  type="number" >                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Anhänger</label>
                                        <input class="form-control"  name="entsorgunganhanger" placeholder="0"  type="number" >                                
                                    </div>
                                </div> 
                            </div>                        
                            {{-- Entsorgung Alanı Bitiş --}}

                            {{-- Transport Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 transport-control">
                                    <label for="" class="col-form-label">Transport</label><br>
                                    <input type="checkbox" name="isTransport" id="isTransport" class="js-switch" data-size="small" data-color="#9c27b0" data-switchery="false" >  
                                </div>                            
                            </div>
                            {{-- Transport Alanı Kontrolü Bitiş --}}

                            {{-- Transport Alanı Başlangıç --}}
                            <div class="form-group row transport--area" style="display: none; ">
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Transport Am</label>
                                    <input class="form-control" class="date"  name="transportdate"  type="date" >                                
                                </div>
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Transport Stunde</label>
                                    <input class="form-control"  name="transporttime"  type="time" >                                
                                </div>
                                <div class="row w-100  mt-1 pl-1 text-primary" style="font-style: italic;">Falls gleiches Datum wie Umzug, dann leer lassen.</div>
                                
                                <div class="w-100 row rounded p-1 mt-3" style="background-color:  #CBB4FF;">
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Dauer [h]</label>
                                        <input class="form-control" class="transportsuresi" id="transportsuresi" aria-required=""  name="transporthours" placeholder="4-5"  type="text" >                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">MA</label>
                                        <input class="form-control"  name="transportma" placeholder="0"  type="number" >                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">LKW</label>
                                        <input class="form-control"  name="transportlkw" placeholder="0"  type="number" >                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Anhänger</label>
                                        <input class="form-control"  name="transportanhanger" placeholder="0"  type="number" >                                
                                    </div>

                                    <div class="col-md-6">
                                        <label class=" col-form-label" for="l0">von</label>
                                        <input class="form-control"  name="destination" placeholder="Destination"  type="text" >                                
                                    </div>

                                    <div class="col-md-6">
                                        <label class=" col-form-label" for="l0">nach</label>
                                        <input class="form-control"  name="arrival" placeholder="Arrival"  type="text" >                                
                                    </div>
                                </div> 
                            </div>                        
                            {{-- Transport Alanı Bitiş --}}

                            {{-- Lagerung Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 lagerung-control">
                                    <label for="" class="col-form-label">Lagerung</label><br>
                                    <input type="checkbox" name="isLagerung" id="isLagerung" class="js-switch" data-size="small" data-color="#9c27b0" data-switchery="false" >  
                                </div>                            
                            </div>
                            {{-- Lagerung Alanı Kontrolü Bitiş --}}

                            {{-- Lagerung Alanı Başlangıç --}}
                            <div class="form-group row lagerung--area" style="display: none; ">
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Lagerung Am</label>
                                    <input class="form-control" class="date"  name="lagerungdate"  type="date" >                                
                                </div>
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Lagerung Stunde</label>
                                    <input class="form-control"  name="lagerungtime"  type="time" >                                
                                </div>
                                <div class="row w-100  mt-1 pl-1 text-primary" style="font-style: italic;">Falls gleiches Datum wie Umzug, dann leer lassen.</div>
                                                               
                            </div>                        
                            {{-- Transport Alanı Bitiş --}}
                        </div>
                        {{-- Onay Alanı Bitiş --}}



                        <div class="deliverable--area" style="display: none;">
                            <div class="form-group row " >
                                <div class="col-md-12">
                                    <label for="" class="col-form-label">Lieferobjekt</label>
                                    <div class="radiobox">
                                        <label>
                                            <input type="radio" class="deliverable"  name="deliverable" value="0" checked> <span class="label-text">Verpackungsmaterial</span>
                                        </label>
                                    </div>
    
                                    <div class="radiobox">
                                        <label>
                                            <input type="radio" class="deliverable"  name="deliverable" value="1" > <span class="label-text">Schlossatelier</span>
                                        </label>
                                    </div>
                                </div> 
                            </div>

                            <div class="form-group row deliveryType--area" >
                                <div class="col-md-12">
                                    <label for="" class="col-form-label">Lieferungsart</label>
                                    <div class="radiobox">
                                        <label>
                                            <input type="radio" class="deliveryType"  name="deliveryType" value="0" checked> <span class="label-text">Lieferung</span>
                                        </label>
                                    </div>
    
                                    <div class="radiobox">
                                        <label>
                                            <input type="radio" class="deliveryType"  name="deliveryType" value="1" > <span class="label-text">Abholung</span>
                                        </label>
                                    </div>
                                </div> 
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">Termin</label>
                                    <input class="form-control" id="teslimatDate" name="meetingDate"  type="date" value="" >                                
                                </div>
    
                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">Zwischen</label>
                                    <input class="form-control"  name="meetingHour1"  type="time" >                                
                                </div>
    
                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">bis</label>
                                    <input class="form-control"  name="meetingHour2"  type="time" >                                
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row contactType--area">
                            <div class="col-md-12">
                                <label for="" class="col-form-label">Besichtigungsort</label>
                                <div class="radiobox">
                                    <label>
                                        <input type="radio"   name="contactType" value="0" checked> <span class="label-text">Beim Kunden</span>
                                    </label>
                                </div>

                                <div class="radiobox">
                                    <label>
                                        <input type="radio"   name="contactType" value="1" > <span class="label-text">Per Telefon</span>
                                    </label>
                                </div>

                                <div class="radiobox">
                                    <label>
                                        <input type="radio"   name="contactType" value="2" > <span class="label-text">Andere</span>
                                    </label>
                                </div>
                            </div>                            
                        </div>

                        

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class=" col-form-label" for="l0">Wo</label>
                                <input class="form-control" name="address"  type="text" value="{{   $data['street']  }} , {{ $data['postCode']}} , {{ $data['country']  }}" required>                                
                            </div>                           
                        </div>

                        <div class="form-group row dateHour--area">
                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0">Datum</label>
                                <input class="form-control" class="date" id="datepicker"  name="date"  type="date" >                                
                            </div>

                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0">Stunde</label>
                                <input class="form-control"  name="time"  type="time" >                                
                            </div>
                        </div>
                            
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">Kalender Titel-Zusatz</label>
                                    <input class="form-control" name="calendarTitle"  type="text" required>                                
                                </div>
    
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">Kalender Kommentar</label>
                                    <textarea class="form-control" name="calendarContent" id="" cols="30" rows="10" required></textarea>                                
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <div class="col-md-12 email-send">
                                    <label for="" class="col-form-label">E-Mail an Kunden</label><br>
                                    <input type="checkbox" name="isEmail" id="isEmail" class="js-switch" data-color="#9c27b0" data-switchery="true" >  
                                </div>                            
                            </div>

                            <div class="row form-group email--area" style="display: none;">
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">E-Mail Adresse</label>
                                    <input class="form-control" name="email"  type="text" value="{{ $data['email'] }}" >                                
                                </div>
    
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">Email Kommentar</label>
                                    
                                    <textarea class="form-control" name="emailContent" id="" cols="30" rows="10"></textarea>                                
                                </div>

                                
                                <div class="col-md-12 email-format">
                                    <label for="" class="col-form-label">Standard Emailtext bearbeiten</label><br>
                                    <input type="checkbox" name="isCustomEmail" id="isCustomEmail" class="js-switch isCustomEmail" data-color="#9c27b0" data-switchery="false" >   
                                </div>                                                           
                            </div>

                            <div class="row form-group email--format" style="display: none;">
                                <div class="col-md-12 mt-3">
                                   
                                    <textarea class="editor" id="customEmail"  name="customEmail"  cols="30" rows="10">
                                             {{-- @include('../../email',['date' => '']) --}}
                                    </textarea>
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

{{-- Onay Alanı Ayarları --}}
<script>

console.log($("input[name=isCustomEmail]").val(),'EMAİL CUSTOM')

        var umzugbutton = $("div.umzug-control");
        var umzugbutton2 = $("div.umzug-control2");
        var einpackservicebutton = $("div.einpackservice-control");
        var auspackservicebutton = $("div.auspackservice-control");
        var reinigungbutton = $("div.reinigung-control");
        var reinigungbutton2 = $("div.reinigung2-control");
        var entsorgungbutton2 = $("div.entsorgung-control");
        var transportbutton = $("div.transport-control");
        var lagerungbutton = $("div.lagerung-control");

    umzugbutton.click(function(){
        if($(this).hasClass("checkbox-checked") && $("#isUmzug").is(':checked'))
        {
            $(".umzug--area").show(300);
            $("input[name=umzug1date]").prop('required',true);      
            $("input[name=umzug1time]").prop('required',true);   
        }
        else
        {           
            $(".umzug--area").hide(300);
            $("input[name=umzug1date]").prop('required',false);      
            $("input[name=umzug1time]").prop('required',false);   
        }
    })

    umzugbutton2.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".umzug--area2").show(300);
            $("input[name=umzug2date]").prop('required',true);      
            $("input[name=umzug2time]").prop('required',true);   
        }
        else
        {
            $(".umzug--area2").hide(300);
            $("input[name=umzug2date]").prop('required',false);      
            $("input[name=umzug2time]").prop('required',false);   
        }
    })

    einpackservicebutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".einpackservice--area").show(300);
            $("input[name=einpackdate]").prop('required',true);      
            $("input[name=einpacktime]").prop('required',true); 
        }
        else
        {
            $(".einpackservice--area").hide(300);
            $("input[name=einpackdate]").prop('required',false);      
            $("input[name=einpacktime]").prop('required',false); 
        }
    })

    auspackservicebutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".auspackservice--area").show(300);
            $("input[name=auspackdate]").prop('required',true);      
            $("input[name=auspacktime]").prop('required',true);
        }
        else
        {
            $(".auspackservice--area").hide(300);
            $("input[name=auspackdate]").prop('required',false);      
            $("input[name=auspacktime]").prop('required',false);
        }
    })

    reinigungbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".reinigung--area").show(300);
            $("input[name=reinigung1Startdate]").prop('required',true);      
            $("input[name=reinigung1Starttime]").prop('required',true);   
            $("input[name=reinigung1Enddate]").prop('required',true);  
            $("input[name=reinigung1Endtime]").prop('required',true); 
        }
        else
        {
            $(".reinigung--area").hide(300);
            $("input[name=reinigung1Startdate]").prop('required',false);      
            $("input[name=reinigung1Starttime]").prop('required',false);   
            $("input[name=reinigung1Enddate]").prop('required',false);  
            $("input[name=reinigung1Endtime]").prop('required',false); 
        }
    })

    reinigungbutton2.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".reinigung2--area").show(300);
            $("input[name=reinigung2Startdate]").prop('required',true);      
            $("input[name=reinigung2Starttime]").prop('required',true);   
            $("input[name=reinigung2Enddate]").prop('required',true);  
            $("input[name=reinigung2Endtime]").prop('required',true); 
        }
        else
        {
            $(".reinigung2--area").hide(300);
            $("input[name=reinigung2Startdate]").prop('required',false);      
            $("input[name=reinigung2Starttime]").prop('required',false);   
            $("input[name=reinigung2Enddate]").prop('required',false);  
            $("input[name=reinigung2Endtime]").prop('required',false); 
        }
    })

    entsorgungbutton2.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".entsorgung--area").show(300);
            $("input[name=entsorgungdate]").prop('required',true);      
            $("input[name=entsorgungtime]").prop('required',true); 
        }
        else
        {
            $(".entsorgung--area").hide(300);
            $("input[name=entsorgungdate]").prop('required',false);      
            $("input[name=entsorgungtime]").prop('required',false); 
        }
    })

    transportbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".transport--area").show(300);
            $("input[name=transportdate]").prop('required',true);      
            $("input[name=transporttime]").prop('required',true); 
        }
        else
        {
            $(".transport--area").hide(300);
            $("input[name=transportdate]").prop('required',false);      
            $("input[name=transporttime]").prop('required',false); 
        }
    })

    lagerungbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".lagerung--area").show(300);
            $("input[name=lagerungdate]").prop('required',true);      
            $("input[name=lagerungtime]").prop('required',true);
        }
        else
        {
            $(".lagerung--area").hide(300);
            $("input[name=lagerungdate]").prop('required',false);      
            $("input[name=lagerungtime]").prop('required',false);
        }
    })
</script>

{{-- Email Ayarları --}}
<script>       
    var morebutton = $("div.email-send");
    morebutton.click(function() {
        if ($(this).hasClass("checkbox-checked"))
        {
            $(".email--area").show(700);
        }
        else {
            $(".email--area").hide(500);
        }
    })
</script>

{{-- Custom Email Format Ayarlamaları --}}
<script>
            var emailFormatbutton = $("div.email-format");
    emailFormatbutton.click(function() {
        if ($(this).hasClass("checkbox-checked"))
        {
            $(".email--format").show(700);
        }
        else {
            $(".email--format").hide(500);
        }
    })
</script>

{{-- Randevu Tipi Ayarları --}}
<script>
    $(".appointment-type").click(function() {
        var value = $(this).val();
        switch(value) {
            case '1':                
                $(".deliverable--area").hide(300);
                $(".confirmation--area").hide(300);
                $(".contactType--area").show(500);
                $(".dateHour--area").show(300);
                break;
            case '2':
                $(".confirmation--area").show(300);
                $(".deliverable--area").hide(300);
                $(".contactType--area").hide(500);
                $(".dateHour--area").hide(300);
                break;
            case '3':
                $(".confirmation--area").hide(300);
                $(".deliverable--area").show(500);
                $(".contactType--area").hide(300);
                $(".dateHour--area").hide(300);
                break;
        }
        
    });
</script>

{{-- Randevu Tipi Teslimat Ayarları --}}
<script>
    $(".deliverable").click(function() {
        var value = $(this).val();
        if(value == 0)
        {
            $(".deliveryType--area").show(500);
        }
        else {
            $(".deliveryType--area").hide(300);
        }
    });
</script>

{{-- TinyMce Ayarları--}}
<script>
    tinymce.init({
      selector: 'textarea.editor',
      plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
      toolbar_mode: 'floating',
      apply_source_formatting : true,
      plugins: 'code',
    });
</script>

{{-- TinyMce Email Format Ayarları --}}
<script> 

var value;

$(document).ready(function(){
    $(".appointment-type").on("input",function() {
        value = $(this).val();
        tinymce.execCommand("mceRepaint");

        if (value == 1)
        {
            $("#datepicker").on("input", function(){           
            let dateArray = [];
            var tarih1 = $(this).val();
            dateArray[dateArray.length] = tarih1;
            console.log(dateArray,'Tarihler');
            // TODO: bu bölüm blade import değil api olarak kullanılacak
            tinymce.get("customEmail").setContent(`@include('../../cemail',['date' => '${dateArray}'])`);
            tinymce.execCommand("mceRepaint");      
            });
        }

        if (value == 2)
        {
            console.log(value)
            let dateArray = [];

            
                let umzug1ke = $("input[name=umzug1date]").on("input", function(){   
                var tarih1 = $('input[name=umzug1date]').val();                      
                
                // dateArray[dateArray.length] = 'Umzug 1' + ' ' + 'Tarihi:' +' '+ tarih1 + '<br>'
                dateArray[dateArray.length] = '<tr>' + '<td>Umzug</td>' + '<td> ' + tarih1 +'</td>'+ '</tr>' + '<br>'
                // console.log(dateArray,'Tarihler');
                // TODO: bu bölüm blade import değil api olarak kullanılacak
                tinymce.get("customEmail").setContent(`@include('../../cemail',['date' => '${dateArray}'])`);
                tinymce.execCommand("mceRepaint");      
            });
           
            
            
            $("input[name=umzug2date]").on("input", function(){                      
                var tarih1 = $(this).val();
                dateArray[dateArray.length] = '<tr>' + '<td>Umzug 2</td>' + '<td> ' + tarih1 +'</td>'+ '</tr>' + '<br>'
                console.log(dateArray,'Tarihler');
                // TODO: bu bölüm blade import değil api olarak kullanılacak
                tinymce.get("customEmail").setContent(`@include('../../cemail',['date' => '${dateArray}'])`);
                tinymce.execCommand("mceRepaint");      
            });

            $("input[name=umzug3date]").on("input", function(){                      
                var tarih1 = $(this).val();
                dateArray[dateArray.length] = '<tr>' + '<td>Umzug 3</td>' + '<td> ' + tarih1 +'</td>'+ '</tr>'
                console.log(dateArray,'Tarihler');
                // TODO: bu bölüm blade import değil api olarak kullanılacak
                tinymce.get("customEmail").setContent(`@include('../../cemail',['date' => '${dateArray}'])`);
                tinymce.execCommand("mceRepaint");      
            });

            $("input[name=einpackdate]").on("input", function(){                      
                var tarih1 = $(this).val();
                dateArray[dateArray.length] = '<tr>' + '<td>Einpack Service</td>' + '<td> ' + tarih1 +'</td>'+ '</tr>'
                console.log(dateArray,'Tarihler');
                // TODO: bu bölüm blade import değil api olarak kullanılacak
                tinymce.get("customEmail").setContent(`@include('../../cemail',['date' => '${dateArray}'])`);
                tinymce.execCommand("mceRepaint");      
            });

            $("input[name=auspackdate]").on("input", function(){                      
                var tarih1 = $(this).val();
                dateArray[dateArray.length] = '<tr>' + '<td>Auspack Service</td>' + '<td> ' + tarih1 +'</td>'+ '</tr>'
                console.log(dateArray,'Tarihler');
                // TODO: bu bölüm blade import değil api olarak kullanılacak
                tinymce.get("customEmail").setContent(`@include('../../cemail',['date' => '${dateArray}'])`);
                tinymce.execCommand("mceRepaint");      
            });

            $("input[name=reinigungStartDate]").on("input", function(){                      
                var tarih1 = $(this).val();
                dateArray[dateArray.length] = '<tr>' + '<td>Reinigung Service</td>' + '<td> ' + tarih1 +'</td>'+ '</tr>'
                console.log(dateArray,'Tarihler');
                // TODO: bu bölüm blade import değil api olarak kullanılacak
                tinymce.get("customEmail").setContent(`@include('../../cemail',['date' => '${dateArray}'])`);
                tinymce.execCommand("mceRepaint");      
            });

            $("input[name=reinigung2StartDate]").on("input", function(){                      
                var tarih1 = $(this).val();
                dateArray[dateArray.length] = '<tr>' + '<td>Reinigung Service 2</td>' + '<td> ' + tarih1 +'</td>'+ '</tr>'
                console.log(dateArray,'Tarihler');
                // TODO: bu bölüm blade import değil api olarak kullanılacak
                tinymce.get("customEmail").setContent(`@include('../../cemail',['date' => '${dateArray}'])`);
                tinymce.execCommand("mceRepaint");      
            });

            $("input[name=entsorgungdate]").on("input", function(){                      
                var tarih1 = $(this).val();
                dateArray[dateArray.length] = '<tr>' + '<td>Entsorgung Service</td>' + '<td> ' + tarih1 +'</td>'+ '</tr>'
                console.log(dateArray,'Tarihler');
                // TODO: bu bölüm blade import değil api olarak kullanılacak
                tinymce.get("customEmail").setContent(`@include('../../cemail',['date' => '${dateArray}'])`);
                tinymce.execCommand("mceRepaint");      
            });

            $("input[name=transportdate]").on("input", function(){                      
                var tarih1 = $(this).val();
                dateArray[dateArray.length] = '<tr>' + '<td>Transport Service</td>' + '<td> ' + tarih1 +'</td>'+ '</tr>'
                console.log(dateArray,'Tarihler');
                // TODO: bu bölüm blade import değil api olarak kullanılacak
                tinymce.get("customEmail").setContent(`@include('../../cemail',['date' => '${dateArray}'])`);
                tinymce.execCommand("mceRepaint");      
            });

            $("input[name=lagerungdate]").on("input", function(){                      
                var tarih1 = $(this).val();
                dateArray[dateArray.length] = '<tr>' + '<td>Lagerung Service</td>' + '<td> ' + tarih1 +'</td>'+ '</tr>'
                console.log(dateArray,'Tarihler');
                // TODO: bu bölüm blade import değil api olarak kullanılacak
                tinymce.get("customEmail").setContent(`@include('../../cemail',['date' => '${dateArray}'])`);
                tinymce.execCommand("mceRepaint");      
            });

        }

        if (value == 3)
        {
            console.log(value)
            $("#teslimatDate").on("input", function(){           
            let dateArray = [];
            var tarih1 = $(this).val();
            dateArray[dateArray.length] = tarih1;
            console.log(dateArray,'Tarihler');
            // TODO: bu bölüm blade import değil api olarak kullanılacak
            tinymce.get("customEmail").setContent(`@include('../../cemail',['date' => '${dateArray}'])`);
            tinymce.execCommand("mceRepaint");      
        });
        }

    });
});

</script>

@endsection

