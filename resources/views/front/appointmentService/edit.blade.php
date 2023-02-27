@extends('layouts.app')

@section('header')
<script src="https://cdn.tiny.cloud/1/qa7zzv3hb9nmr5ary4ucaw8bbt8744dzibxuf6hdomgsuchu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('content')
@section('sidebarType') sidebar-collapse @endsection

<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Termin Bearbeiten - Auftragsbestätigung</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Panel</a>
            </li>
            <li class="breadcrumb-item active">Termin</li>
        </ol>
        {{-- <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="{{ route('appointment.create',['id' => $data['customerId']]) }}" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Yeni Randevu Ekle</a>
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
        <div class="col-md-12">
            <strong class="h5 mr-1"> <b>Kunde:</b> </strong> <span class="h5 text-primary ">
                {{ App\Models\Customer::getPublicName($data2['id']) }}</span>
        </div>
        <div class="col-md-12 widget-holder">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <p><form id="myform" name="myForm" action="{{ route('appointmentService.update',['id' => $data['id']]) }}"  method="POST" enctype="multipart/form-data"></p>
                       @csrf
                         {{-- Onay Alanı Başlangıç --}}
                         <div class="confirmation--area" >
                            <div class="form-group row">
                                <div class="col-md-12 umzug-control">
                                    <label for="" class="col-form-label">Payment Type</label><br>
                                    <select class="form-control" name="paymentType" id="paymentType">
                                        <option value="0" @if ($data['paymentType'] == 0) selected @endif>Bar</option>
                                        <option value="1" @if ($data['paymentType'] == 1) selected @endif>Invoice</option>
                                    </select> 
                                </div>                            
                            </div>

                            {{-- Umzug Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 umzug-control ">
                                    <label for="" class="col-form-label">Umzug</label><br>
                                    <input type="checkbox" name="isUmzug" @if ($data['umzugId']) checked @endif  id="isUmzug" class="js-switch" data-size="small" data-color="#9c27b0" data-switchery="false" >  
                                </div>                            
                            </div>
                            {{-- Umzug Alanı Kontrolü Bitiş --}}

                            {{-- Umzug Alanı --}}
                            <div class="form-group row umzug--area" @if ($data['umzugId'] == NULL) style="display: none;" @endif>
                                {{-- 1.Umzug Alanı Başlangıç --}}
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Umzugstermin Am</label>
                                    <input class="form-control" class="date"  name="umzug1date"  type="date" @if ($dataUmzug) value="{{ $dataUmzug['umzugDate'] }}" @endif required>                                
                                </div>
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Umzugstermin Stunde</label>
                                    <input class="form-control"  name="umzug1time"  type="time" @if ($dataUmzug) value="{{ $dataUmzug['umzugTime'] }}" @endif>                                
                                </div>

                                <div class="w-100 row rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Dauer [h]</label>
                                        <input class="form-control"  name="umzug1hours" placeholder="4-5"  type="text" @if ($dataUmzug) value="{{ $dataUmzug['workHours'] }}" @endif>                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">MA</label>
                                        <input class="form-control"  name="umzug1ma" placeholder="0"  type="number" @if ($dataUmzug) value="{{ $dataUmzug['ma'] }}" @endif>                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">LKW</label>
                                        <input class="form-control"  name="umzug1lkw" placeholder="0"  type="number" @if ($dataUmzug) value="{{ $dataUmzug['lkw'] }}" @endif>                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Anhänger</label>
                                        <input class="form-control"  name="umzug1anhanger" placeholder="0"  type="number" @if ($dataUmzug) value="{{ $dataUmzug['anhanger'] }}" @endif>                                
                                    </div>
                                </div>
                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control"  name="umzug1calendarTitle" placeholder="CalendarTitle"  type="text" @if ($dataUmzug) value="{{ $dataUmzug['calendarTitle'] }}"  @endif>
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarComment</label>
                                        <textarea class="form-control" name="umzug1calendarComment" id="" cols="30" rows="1" placeholder="CalendarComment"> @if ($dataUmzug) {{ $dataUmzug['calendarComment'] }}  @endif</textarea> 
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarLocation</label>
                                        <input class="form-control"  name="umzug1calendarLocation" placeholder="CalendarLocation"  type="text" 
                                        @if ($dataUmzug) value="{{   $dataUmzug['calendarLocation'] }}"  @endif>
                                    </div>
                                </div>
                                {{-- 1.Umzug Alanı Bitiş --}}
                                
                                {{-- 2.Umzug Alanı Kontrolü --}}
                                <div class="col-md-12 umzug-control2">
                                    <label for="" class="col-form-label">Weitere Umzugstermine</label><br>
                                    <input type="checkbox" name="isUmzug2" @if ($data['umzug2Id'] or $data['umzug3Id'] ) checked @endif id="isUmzug2" class="js-switch" data-size="small" data-color="#9c27b0" data-switchery="false" >  
                                </div>
                                
                                {{-- 2.Umzug Alanı Kontrolü --}}
                                <div class="w-100 umzug--area2" @if ($data['umzug2Id'] == null  and $data['umzug3Id'] == null) style="display: none;"   @endif >
                                    
                                {{-- 2.Umzug Alanı Başlangıç --}}
                                <div class="form-group row w-100 ">                                    
                                    <div class="col-md-6">
                                        <label class=" col-form-label" for="l0">Umzugstermin 2 Am</label>
                                        <input class="form-control" class="date"  name="umzug2date"  type="date" @if ($dataUmzug2) value="{{ $dataUmzug2['umzugDate'] }}" @endif>                                
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class=" col-form-label" for="l0">Umzugstermin 2 Stunde</label>
                                        <input class="form-control"  name="umzug2time"  type="time" @if ($dataUmzug2) value="{{ $dataUmzug2['umzugTime'] }}" @endif>                                
                                    </div>
    
                                    <div class="w-100 row rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">Dauer [h]</label>
                                            <input class="form-control"  name="umzug2hours" placeholder="4-5"  type="text" @if ($dataUmzug2) value="{{ $dataUmzug2['workHours'] }}" @endif>                                
                                        </div>
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">MA</label>
                                            <input class="form-control"  name="umzug2ma" placeholder="0"  type="number" @if ($dataUmzug2) value="{{ $dataUmzug2['ma'] }}" @endif>                                
                                        </div>
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">LKW</label>
                                            <input class="form-control"  name="umzug2lkw" placeholder="0"  type="number" @if ($dataUmzug2) value="{{ $dataUmzug2['lkw'] }}" @endif>                                
                                        </div>
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">Anhänger</label>
                                            <input class="form-control"  name="umzug2anhanger" placeholder="0"  type="number" @if ($dataUmzug2) value="{{ $dataUmzug2['anhanger'] }}" @endif>                                
                                        </div>
                                    </div>      
                                    
                                    <div class="row w-100 rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                        <div class="col-md-4">
                                            <label class=" col-form-label" for="l0">CalendarTitle</label>
                                            <input class="form-control"  name="umzug2calendarTitle" placeholder="CalendarTitle"  type="text" @if ($dataUmzug2) value="{{ $dataUmzug2['calendarTitle'] }}"@endif>
                                        </div>
    
                                        <div class="col-md-4">
                                            <label class=" col-form-label" for="l0">CalendarComment</label>
                                            <textarea class="form-control" name="umzug2calendarComment" id="" cols="30" rows="1" placeholder="CalendarComment">@if ($dataUmzug2) {{ $dataUmzug2['calendarComment'] }}@endif</textarea> 
                                        </div>
    
                                        <div class="col-md-4">
                                            <label class=" col-form-label" for="l0">CalendarLocation</label>
                                            <input class="form-control"  name="umzug2calendarLocation" placeholder="CalendarLocation"  type="text" 
                                            @if ($dataUmzug2) value="{{   $dataUmzug2['calendarLocation'] }}" @endif>
                                        </div>
                                    </div>
                                </div>
                                {{-- 2.Umzug Alanı Bitiş --}}

                                {{-- 3.Umzug Alanı Başlangıç --}}
                                <div class="form-group row w-100 "   >                                    
                                    <div class="col-md-6">
                                        <label class=" col-form-label" for="l0">Umzugstermin 3 Am</label>
                                        <input class="form-control" class="date"  name="umzug3date"  type="date" @if ($dataUmzug3) value="{{ $dataUmzug3['umzugDate'] }}" @endif>                                
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class=" col-form-label" for="l0">Umzugstermin 3 Stunde</label>
                                        <input class="form-control"  name="umzug3time"  type="time" @if ($dataUmzug3) value="{{ $dataUmzug3['umzugTime'] }}" @endif>                                
                                    </div>
    
                                    <div class="w-100 row rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">Dauer [h]</label>
                                            <input class="form-control"  name="umzug3hours" placeholder="4-5"  type="text" @if ($dataUmzug3) value="{{ $dataUmzug3['workHours'] }}" @endif>                                
                                        </div>
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">MA</label>
                                            <input class="form-control"  name="umzug3ma" placeholder="0"  type="number" @if ($dataUmzug3) value="{{ $dataUmzug3['ma'] }}" @endif>                                
                                        </div>
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">LKW</label>
                                            <input class="form-control"  name="umzug3lkw" placeholder="0"  type="number" @if ($dataUmzug3) value="{{ $dataUmzug3['lkw'] }}" @endif>                                
                                        </div>
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">Anhänger</label>
                                            <input class="form-control"  name="umzug3anhanger" placeholder="0"  type="number" @if ($dataUmzug3) value="{{ $dataUmzug3['anhanger'] }}" @endif>                                
                                        </div>
                                    </div>     
                                    
                                    <div class="row w-100 rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                        <div class="col-md-4">
                                            <label class=" col-form-label" for="l0">CalendarTitle</label>
                                            <input class="form-control"  name="umzug3calendarTitle" placeholder="CalendarTitle"  type="text" @if ($dataUmzug3) value="{{ $dataUmzug3['calendarTitle'] }}"@endif>
                                        </div>
    
                                        <div class="col-md-4">
                                            <label class=" col-form-label" for="l0">CalendarComment</label>
                                            <textarea class="form-control" name="umzug3calendarComment" id="" cols="30" rows="1" placeholder="CalendarComment">@if ($dataUmzug3) {{ $dataUmzug3['calendarComment'] }}@endif</textarea> 
                                        </div>
    
                                        <div class="col-md-4">
                                            <label class=" col-form-label" for="l0">CalendarLocation</label>
                                            <input class="form-control"  name="umzug3calendarLocation" placeholder="CalendarLocation"  type="text" 
                                            @if ($dataUmzug3) value="{{   $dataUmzug3['calendarLocation'] }}" @endif>
                                        </div>
                                    </div>
                                </div>
                                {{-- 3.Umzug Alanı Bitiş --}}
                                </div>                                 
                            </div>
                            {{-- Umzug Alanı Bitiş --}} 

                            

                            {{-- Einpackservice Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 einpackservice-control">
                                    <label for="" class="col-form-label">Einpackservice</label><br>
                                    <input type="checkbox" name="isEinpackservice" @if ($data['einpackId']) checked @endif id="isEinpackservice" class="js-switch" data-size="small" data-color="#9c27b0" data-switchery="false" >  
                                </div>                            
                            </div>
                            {{-- Einpackservice Alanı Kontrolü Bitiş --}}

                            {{-- Einpackservice Alanı Başlangıç --}}
                            <div class="form-group row einpackservice--area" @if ($data['einpackId'] == 0) style="display: none;"  @endif >
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Packtermin Am</label>
                                    <input class="form-control" class="date"  name="einpackdate"  type="date" @if ($dataEinpack) value="{{ $dataEinpack['einpackDate'] }}" @endif >                                
                                </div>
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Packtermin Stunde</label>
                                    <input class="form-control"  name="einpacktime"  type="time" @if ($dataEinpack) value="{{ $dataEinpack['einpackTime'] }}" @endif>                                
                                </div>
                                <div class="row w-100  mt-1 pl-1 text-primary" style="font-style: italic;">Tarih, umzug tarihi ile aynıysa boş bırakabilirsiniz.</div>
                                
                                <div class="w-100 row rounded p-1 mt-3" style="background-color:  #CBB4FF;">
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Dauer [h]</label>
                                        <input class="form-control" class="einpacksuresi" id="einpacksuresi"  aria-required=""  name="einpackhours" placeholder="4-5"  type="text" @if ($dataEinpack) value="{{ $dataEinpack['workHours'] }}" @endif>                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">MA</label>
                                        <input class="form-control"  name="einpackma" placeholder="0"  type="number" @if ($dataEinpack) value="{{ $dataEinpack['ma'] }}" @endif>                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">LKW</label>
                                        <input class="form-control"  name="einpacklkw" placeholder="0"  type="number" @if ($dataEinpack) value="{{ $dataEinpack['lkw'] }}" @endif>                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Anhänger</label>
                                        <input class="form-control"  name="einpackanhanger" placeholder="0"  type="number" @if ($dataEinpack) value="{{ $dataEinpack['anhanger'] }}" @endif>                                
                                    </div>
                                </div> 

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control"  name="einpackcalendarTitle" placeholder="CalendarTitle"  type="text" @if ($dataEinpack) value="{{ $dataEinpack['calendarTitle'] }}" @endif>
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarComment</label>
                                        <textarea class="form-control" name="einpackcalendarComment" id="" cols="30" rows="1" placeholder="CalendarComment">@if ($dataEinpack) {{ $dataEinpack['calendarComment'] }} @endif</textarea> 
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarLocation</label>
                                        <input class="form-control"  name="einpackcalendarLocation" placeholder="CalendarLocation"  type="text" 
                                        @if ($dataEinpack) value="{{ $dataEinpack['calendarLocation'] }}" @endif>
                                    </div>
                                </div>
                            </div>
                            {{-- Einpackservice Alanı Bitiş --}}


                             {{-- Auspackservice Alanı Kontrolü --}}
                             <div class="form-group row">
                                <div class="col-md-12 auspackservice-control">
                                    <label for="" class="col-form-label">Auspackservice</label><br>
                                    <input type="checkbox" name="isAuspackservice" @if ($data['auspackId']) checked @endif id="isAuspackservice" class="js-switch" data-size="small" data-color="#9c27b0" data-switchery="false" >  
                                </div>                            
                            </div>
                            {{-- Auspackservice Alanı Kontrolü Bitiş --}}

                            {{-- Auspackservice Alanı Başlangıç --}}
                            <div class="form-group row auspackservice--area"  @if ($data['auspackId'] == 0) style="display: none; " @endif >
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Packtermin Am</label>
                                    <input class="form-control" class="date"  name="auspackdate"  type="date" @if ($dataAuspack) value="{{ $dataAuspack['auspackDate'] }}" @endif>                                
                                </div>
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Packtermin Stunde</label>
                                    <input class="form-control"  name="auspacktime"  type="time" @if ($dataAuspack) value="{{ $dataAuspack['auspackTime'] }}" @endif>                                
                                </div>
                                <div class="row w-100  mt-1 pl-1 text-primary" style="font-style: italic;">Tarih, umzug tarihi ile aynıysa boş bırakabilirsiniz.</div>
                                
                                <div class="w-100 row rounded p-1 mt-3" style="background-color:  #CBB4FF;">
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Dauer [h]</label>
                                        <input class="form-control" class="auspacksuresi" id="auspacksuresi" aria-required=""  name="auspackhours" placeholder="4-5"  type="text" @if ($dataAuspack) value="{{ $dataAuspack['workHours'] }}" @endif>                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">MA</label>
                                        <input class="form-control"  name="auspackma" placeholder="0"  type="number" @if ($dataAuspack) value="{{ $dataAuspack['ma'] }}" @endif>                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">LKW</label>
                                        <input class="form-control"  name="auspacklkw" placeholder="0"  type="number" @if ($dataAuspack) value="{{ $dataAuspack['lkw'] }}" @endif>                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Anhänger</label>
                                        <input class="form-control"  name="auspackanhanger" placeholder="0"  type="number" @if ($dataAuspack) value="{{ $dataAuspack['anhanger'] }}" @endif>                                
                                    </div>
                                </div> 

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control"  name="auspackcalendarTitle" placeholder="CalendarTitle"  type="text" @if ($dataAuspack) value="{{ $dataAuspack['calendarTitle'] }}" @endif>
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarComment</label>
                                        <textarea class="form-control" name="auspackcalendarComment" id="" cols="30" rows="1" placeholder="CalendarComment">@if ($dataAuspack) {{ $dataAuspack['calendarComment'] }} @endif</textarea> 
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarLocation</label>
                                        <input class="form-control"  name="auspackcalendarLocation" placeholder="CalendarLocation"  type="text" 
                                        @if ($dataAuspack) value="{{ $dataAuspack['calendarLocation'] }}" @endif>
                                    </div>
                                </div>
                            </div>
                            {{-- Auspackservice Alanı Bitiş --}}

                            {{-- Reinigung Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 reinigung-control">
                                    <label for="" class="col-form-label">Reinigung</label><br>
                                    <input type="checkbox" name="isReinigung" id="isReinigung" @if ($data['reinigungId']) checked @endif class="js-switch" data-size="small" data-color="#9c27b0" data-switchery="false" >  
                                </div>                            
                            </div>
                            {{-- Reinigung Alanı Kontrolü Bitiş --}}

                            {{-- Reinigung Alanı Başlangıç --}}
                            <div class="form-group row reinigung--area" @if ($data['reinigungId'] == 0) style="display: none; " @endif >
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Reinigungstermin Am</label>
                                    <input class="form-control" class="date"  name="reinigung1Startdate"  type="date" @if ($dataReinigung) value="{{ $dataReinigung['reinigungStartDate'] }}" @endif>                                
                                </div>
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Reinigungstermin Stunde</label>
                                    <input class="form-control"  name="reinigung1Starttime"  type="time" @if ($dataReinigung) value="{{ $dataReinigung['reinigungStartTime'] }}" @endif>                                
                                </div>
                                <div class="row w-100 mb-2  mt-1 pl-1 text-primary" style="font-style: italic;">Tarih, umzug tarihi ile aynıysa boş bırakabilirsiniz.</div>  
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Abgabetermin</label>
                                    <input class="form-control" class="date"  name="reinigung1Enddate"  type="date" @if ($dataReinigung) value="{{ $dataReinigung['reinigungEndDate'] }}" @endif>                                
                                </div>
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Abgabetermin Stunde</label>
                                    <input class="form-control"  name="reinigung1Endtime"  type="time" @if ($dataReinigung) value="{{ $dataReinigung['reinigungEndTime'] }}" @endif>                                
                                </div>

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control"  name="reinigungcalendarTitle" placeholder="CalendarTitle"  type="text" @if ($dataReinigung) value="{{ $dataReinigung['calendarTitle'] }}" @endif>
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarComment</label>
                                        <textarea class="form-control" name="reinigungcalendarComment" id="" cols="30" rows="1" placeholder="CalendarComment">@if ($dataReinigung) {{ $dataReinigung['calendarComment'] }} @endif</textarea> 
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarLocation</label>
                                        <input class="form-control"  name="reinigungcalendarLocation" placeholder="CalendarLocation"  type="text" 
                                        @if ($dataReinigung) value="{{ $dataReinigung['calendarLocation'] }}" @endif>
                                    </div>
                                </div>
                            </div>          
                            
                            
                            {{-- Reinigung Alanı Bitiş --}}

                            {{-- 2.Reinigung Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 reinigung2-control">
                                    <label for="" class="col-form-label">Reinigung 2</label><br>
                                    <input type="checkbox" name="isReinigung2" id="isReinigung2"  @if ($data['reinigung2Id']) checked @endif class="js-switch" data-size="small" data-color="#9c27b0" data-switchery="false" >  
                                </div>                            
                            </div>
                            {{-- 2.Reinigung Alanı Kontrolü Bitiş --}}

                            {{-- 2.Reinigung Alanı Başlangıç --}}
                            <div class="form-group row reinigung2--area" @if ($data['reinigung2Id'] == 0) style="display: none; " @endif >
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Reinigungstermin 2 Am</label>
                                    <input class="form-control" class="date"  name="reinigung2Startdate"  type="date" @if ($dataReinigung2) value="{{ $dataReinigung2['reinigungStartDate'] }}" @endif>                                
                                </div>
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Reinigungstermin 2 Stunde</label>
                                    <input class="form-control"  name="reinigung2Starttime"  type="time" @if ($dataReinigung2) value="{{ $dataReinigung2['reinigungStartTime'] }}" @endif>                                
                                </div>
                                <div class="row w-100 mb-2  mt-1 pl-1 text-primary" style="font-style: italic;">Tarih, umzug tarihi ile aynıysa boş bırakabilirsiniz.</div>  
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Abgabetermin</label>
                                    <input class="form-control" class="date"  name="reinigung2Enddate"  type="date" @if ($dataReinigung2) value="{{ $dataReinigung2['reinigungEndDate'] }}" @endif >                                
                                </div>
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Abgabetermin Stunde</label>
                                    <input class="form-control"  name="reinigung2Endtime"  type="time" @if ($dataReinigung2) value="{{ $dataReinigung2['reinigungEndTime'] }}" @endif>                                
                                </div>

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control"  name="reinigung2calendarTitle" placeholder="CalendarTitle"  type="text" @if ($dataReinigung2) value="{{ $dataReinigung2['calendarTitle'] }}" @endif>
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarComment</label>
                                        <textarea class="form-control" name="reinigung2calendarComment" id="" cols="30" rows="1" placeholder="CalendarComment">@if ($dataReinigung2) {{ $dataReinigung2['calendarComment'] }} @endif</textarea> 
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarLocation</label>
                                        <input class="form-control"  name="reinigung2calendarLocation" placeholder="CalendarLocation"  type="text" 
                                        @if ($dataReinigung2) value="{{ $dataReinigung2['calendarLocation'] }}" @endif>
                                    </div>
                                </div>
                            </div>                           
                            {{-- 2.Reinigung Alanı Bitiş --}}

                            {{-- Entsorgung Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 entsorgung-control">
                                    <label for="" class="col-form-label">Entsorgung</label><br>
                                    <input type="checkbox" name="isEntsorgung" id="isEntsorgung" @if ($data['entsorgungId']) checked @endif class="js-switch" data-size="small" data-color="#9c27b0" data-switchery="false" >  
                                </div>                            
                            </div>
                            {{-- Entsorgung Alanı Kontrolü Bitiş --}}

                            {{-- Entsorgung Alanı Başlangıç --}}
                            <div class="form-group row entsorgung--area" @if ($data['entsorgungId'] == 0) style="display: none; " @endif>
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Entsorgungstermin Am</label>
                                    <input class="form-control" class="date"  name="entsorgungdate"  type="date" @if ($dataEntsorgung) value="{{ $dataEntsorgung['entsorgungDate'] }}" @endif>                                
                                </div>
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Entsorgungstermin Stunde</label>
                                    <input class="form-control"  name="entsorgungtime"  type="time" @if ($dataEntsorgung) value="{{ $dataEntsorgung['entsorgungTime'] }}" @endif>                                
                                </div>
                                <div class="row w-100  mt-1 pl-1 text-primary" style="font-style: italic;">Tarih, umzug tarihi ile aynıysa boş bırakabilirsiniz.</div>
                                
                                <div class="w-100 row rounded p-1 mt-3" style="background-color:  #CBB4FF;">
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Dauer [h]</label>
                                        <input class="form-control" class="entsorgungsuresi" id="entsorgungsuresi" aria-required=""  name="entsorgunghours" placeholder="4-5"  type="text" @if ($dataEntsorgung) value="{{ $dataEntsorgung['workHours'] }}" @endif>                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">MA</label>
                                        <input class="form-control"  name="entsorgungma" placeholder="0"  type="number" @if ($dataEntsorgung) value="{{ $dataEntsorgung['ma'] }}" @endif>                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">LKW</label>
                                        <input class="form-control"  name="entsorgunglkw" placeholder="0"  type="number" @if ($dataEntsorgung) value="{{ $dataEntsorgung['lkw'] }}" @endif>                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Anhänger</label>
                                        <input class="form-control"  name="entsorgunganhanger" placeholder="0"  type="number" @if ($dataEntsorgung) value="{{ $dataEntsorgung['anhanger'] }}" @endif>                                
                                    </div>
                                </div> 

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control"  name="entsorgungcalendarTitle" placeholder="CalendarTitle"  type="text" @if ($dataEntsorgung) value="{{ $dataEntsorgung['calendarTitle'] }}" @endif>
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarComment</label>
                                        <textarea class="form-control" name="entsorgungcalendarComment" id="" cols="30" rows="1" placeholder="CalendarComment">@if ($dataEntsorgung) {{ $dataEntsorgung['calendarComment'] }} @endif</textarea> 
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarLocation</label>
                                        <input class="form-control"  name="entsorgungcalendarLocation" placeholder="CalendarLocation"  type="text" 
                                        @if ($dataEntsorgung) value="{{ $dataEntsorgung['calendarLocation'] }}" @endif>
                                    </div>
                                </div>
                            </div>                        
                            {{-- Entsorgung Alanı Bitiş --}}

                            {{-- Transport Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 transport-control">
                                    <label for="" class="col-form-label">Transport</label><br>
                                    <input type="checkbox" name="isTransport" id="isTransport" @if ($data['transportId']) checked @endif class="js-switch" data-size="small" data-color="#9c27b0" data-switchery="false" >  
                                </div>                            
                            </div>
                            {{-- Transport Alanı Kontrolü Bitiş --}}

                            {{-- Transport Alanı Başlangıç --}}
                            <div class="form-group row transport--area" @if ($data['transportId'] == 0) style="display: none; " @endif>
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Transport Am</label>
                                    <input class="form-control" class="date"  name="transportdate"  type="date" @if ($dataTransport) value="{{ $dataTransport['transportDate'] }}" @endif>                                
                                </div>
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Transport Stunde</label>
                                    <input class="form-control"  name="transporttime"  type="time" @if ($dataTransport) value="{{ $dataTransport['transportTime'] }}" @endif>                                
                                </div>
                                <div class="row w-100  mt-1 pl-1 text-primary" style="font-style: italic;">Tarih, umzug tarihi ile aynıysa boş bırakabilirsiniz.</div>
                                
                                <div class="w-100 row rounded p-1 mt-3" style="background-color:  #CBB4FF;">
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Dauer [h]</label>
                                        <input class="form-control" class="transportsuresi" id="transportsuresi" aria-required=""  name="transporthours" placeholder="4-5"  type="text" @if ($dataTransport) value="{{ $dataTransport['workHours'] }}" @endif>                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">MA</label>
                                        <input class="form-control"  name="transportma" placeholder="0"  type="number" @if ($dataTransport) value="{{ $dataTransport['ma'] }}" @endif>                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">LKW</label>
                                        <input class="form-control"  name="transportlkw" placeholder="0"  type="number" @if ($dataTransport) value="{{ $dataTransport['lkw'] }}" @endif>                                
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Anhänger</label>
                                        <input class="form-control"  name="transportanhanger" placeholder="0"  type="number" @if ($dataTransport) value="{{ $dataTransport['anhanger'] }}" @endif>                                
                                    </div>

                                    <div class="col-md-6">
                                        <label class=" col-form-label" for="l0">von</label>
                                        <input class="form-control"  name="destination" placeholder="Destination"  type="text" @if ($dataTransport) value="{{ $dataTransport['destination'] }}" @endif>                                
                                    </div>

                                    <div class="col-md-6">
                                        <label class=" col-form-label" for="l0">nach</label>
                                        <input class="form-control"  name="arrival" placeholder="Arrival"  type="text" @if ($dataTransport) value="{{ $dataTransport['arrival'] }}" @endif>                                
                                    </div>
                                </div> 
                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control"  name="transportcalendarTitle" placeholder="CalendarTitle"  type="text" @if ($dataTransport) value="{{ $dataTransport['calendarTitle'] }}" @endif>
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarComment</label>
                                        <textarea class="form-control" name="transportcalendarComment" id="" cols="30" rows="1" placeholder="CalendarComment">@if ($dataTransport) {{ $dataTransport['calendarComment'] }} @endif</textarea> 
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarLocation</label>
                                        <input class="form-control"  name="transportcalendarLocation" placeholder="CalendarLocation"  type="text" 
                                        @if ($dataTransport) {{ $dataTransport['calendarLocation'] }} @endif>
                                    </div>
                                </div>
                            </div>                        
                            {{-- Transport Alanı Bitiş --}}

                            {{-- Lagerung Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 lagerung-control">
                                    <label for="" class="col-form-label">Lagerung</label><br>
                                    <input type="checkbox" name="isLagerung" id="isLagerung" @if ($data['lagerungId']) checked @endif class="js-switch" data-size="small" data-color="#9c27b0" data-switchery="false" >  
                                </div>                            
                            </div>
                            {{-- Lagerung Alanı Kontrolü Bitiş --}}

                            {{-- Lagerung Alanı Başlangıç --}}
                            <div class="form-group row lagerung--area" @if ($data['lagerungId'] == 0) style="display: none;"  @endif >
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Lagerung Am</label>
                                    <input class="form-control" class="date"  name="lagerungdate"  type="date" @if ($dataLagerung) value="{{ $dataLagerung['lagerungDate'] }}" @endif>                                
                                </div>
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Lagerung Stunde</label>
                                    <input class="form-control"  name="lagerungtime"  type="time" @if ($dataLagerung) value="{{ $dataLagerung['lagerungTime'] }}" @endif>                                
                                </div>
                                <div class="row w-100  mt-1 pl-1 text-primary" style="font-style: italic;">Tarih, umzug tarihi ile aynıysa boş bırakabilirsiniz.</div>
                                      
                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control"  name="lagerungcalendarTitle" placeholder="CalendarTitle"  type="text" @if ($dataLagerung) value="{{ $dataLagerung['calendarTitle'] }}" @endif>
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarComment</label>
                                        <textarea class="form-control" name="lagerungcalendarComment" id="" cols="30" rows="1" placeholder="CalendarComment">@if ($dataLagerung) {{ $dataLagerung['calendarComment'] }} @endif</textarea> 
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarLocation</label>
                                        <input class="form-control"  name="lagerungcalendarLocation" placeholder="CalendarLocation"  type="text" 
                                        @if ($dataLagerung) value="{{ $dataLagerung['calendarLocation'] }}" @endif>
                                    </div>
                                </div>
                            </div>                        
                            {{-- Transport Alanı Bitiş --}}
                        </div>
                        {{-- Onay Alanı Bitiş --}}

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class=" col-form-label" for="l0">Wo</label>
                                <input class="form-control" name="address"  type="text" value="{{   $data['address']  }} " required>                                
                            </div>                           
                        </div>

                      
                            
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">Kalender Titel-Zusatz</label>
                                    <input class="form-control" name="calendarTitle"  type="text" required value="{{ $data['calendarTitle'] }}">                                
                                </div>
    
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">Kalender Kommentar</label>
                                    <textarea class="form-control" name="calendarContent" id="" cols="30" rows="10" required>{{ $data['calendarContent'] }}</textarea>                                
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <div class="col-md-12 email-send">
                                    <label for="" class="col-form-label">E-Mail an Kunden</label><br>
                                    <input type="checkbox" name="isEmail" id="isEmail" class="js-switch" data-color="#9c27b0" data-switchery="false" >  
                                </div>                            
                            </div>

                            <div class="row form-group email--area" style="display: none;">
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">E-Mail Adresse</label>
                                    <input class="form-control" name="email"  type="text" value="{{ $data2['email'] }}" required>                                
                                </div>
    
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">Email Kommentar</label>
                                    
                                    <textarea class="form-control" name="emailContent" id="" cols="30" rows="10"></textarea>                                
                                </div>

                                
                                <div class="col-md-12 email-format">
                                    <label for="" class="col-form-label">STANDARD EMAILTEXT BEARBEITEN</label><br>
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
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
</div>


@endsection

@section('footer')

{{-- Onay Alanı Ayarları --}}
<script>
    var umzugbutton = $("div.umzug-control");
    var umzugbutton2 = $("div.umzug-control2");
    var einpackservicebutton = $("div.einpackservice-control");
    var auspackservicebutton = $("div.auspackservice-control");
    var reinigungbutton = $("div.reinigung-control");
    var reinigungbutton2 = $("div.reinigung2-control");
    var entsorgungbutton2 = $("div.entsorgung-control");
    var transportbutton = $("div.transport-control");
    var lagerungbutton = $("div.lagerung-control");

    $(document).ready(function(){
        umzugbutton.click(function(){
        if($(this).hasClass("checkbox-checked") && $("#isUmzug").is(':checked'))
        {
            $(".umzug--area").show(300);
            $("input[name=umzug1date]").prop('required',true);     
            $("input[name=umzug1date]").prop('required',true);    
            $("input[name=umzug1calendarTitle]").prop('required',true);   
        }
        else
        {           
            $(".umzug--area").hide(300);
            $("input[name=umzug1date]").prop('required',false);      
            $("input[name=umzug1time]").prop('required',false);   
            $("input[name=umzug1calendarTitle]").prop('required',false);   
        }
    })

    umzugbutton2.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".umzug--area2").show(300);
            $("input[name=umzug2date]").prop('required',true);      
            $("input[name=umzug2time]").prop('required',true);   
            $("input[name=umzug2calendarTitle]").prop('required',true);   
        }
        else
        {
            $(".umzug--area2").hide(300);
            $("input[name=umzug2date]").prop('required',false);      
            $("input[name=umzug2time]").prop('required',false); 
            $("input[name=umzug2calendarTitle]").prop('required',false);     
        }
    })

    einpackservicebutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".einpackservice--area").show(300);
            $("input[name=einpackdate]").prop('required',true);      
            $("input[name=einpacktime]").prop('required',true); 
            $("input[name=einpackcalendarTitle]").prop('required',true); 
        }
        else
        {
            $(".einpackservice--area").hide(300);
            $("input[name=einpackdate]").prop('required',false);      
            $("input[name=einpacktime]").prop('required',false); 
            $("input[name=einpackcalendarTitle]").prop('required',false); 
        }
    })

    auspackservicebutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".auspackservice--area").show(300);
            $("input[name=auspackdate]").prop('required',true);      
            $("input[name=auspacktime]").prop('required',true);
            $("input[name=auspackcalendarTitle]").prop('required',true);
        }
        else
        {
            $(".auspackservice--area").hide(300);
            $("input[name=auspackdate]").prop('required',false);      
            $("input[name=auspacktime]").prop('required',false);
            $("input[name=auspackcalendarTitle]").prop('required',false);
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
            $("input[name=reinigungcalendarTitle]").prop('required',true);
        }
        else
        {
            $(".reinigung--area").hide(300);
            $("input[name=reinigung1Startdate]").prop('required',false);      
            $("input[name=reinigung1Starttime]").prop('required',false);   
            $("input[name=reinigung1Enddate]").prop('required',false);  
            $("input[name=reinigung1Endtime]").prop('required',false); 
            $("input[name=reinigungcalendarTitle]").prop('required',false);
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
            $("input[name=reinigung2calendarTitle]").prop('required',true);
        }
        else
        {
            $(".reinigung2--area").hide(300);
            $("input[name=reinigung2Startdate]").prop('required',false);      
            $("input[name=reinigung2Starttime]").prop('required',false);   
            $("input[name=reinigung2Enddate]").prop('required',false);  
            $("input[name=reinigung2Endtime]").prop('required',false); 
            $("input[name=reinigung2calendarTitle]").prop('required',false);
        }
    })

    entsorgungbutton2.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".entsorgung--area").show(300);
            $("input[name=entsorgungdate]").prop('required',true);      
            $("input[name=entsorgungtime]").prop('required',true); 
            $("input[name=entsorgungcalendarTitle]").prop('required',true);
        }
        else
        {
            $(".entsorgung--area").hide(300);
            $("input[name=entsorgungdate]").prop('required',false);      
            $("input[name=entsorgungtime]").prop('required',false);
            $("input[name=entsorgungcalendarTitle]").prop('required',false); 
        }
    })

    transportbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".transport--area").show(300);
            $("input[name=transportdate]").prop('required',true);      
            $("input[name=transporttime]").prop('required',true); 
            $("input[name=transportcalendarTitle]").prop('required',true);
        }
        else
        {
            $(".transport--area").hide(300);
            $("input[name=transportdate]").prop('required',false);      
            $("input[name=transporttime]").prop('required',false); 
            $("input[name=transportcalendarTitle]").prop('required',false);
        }
    })

    lagerungbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".lagerung--area").show(300);
            $("input[name=lagerungdate]").prop('required',true);      
            $("input[name=lagerungtime]").prop('required',true);
            $("input[name=lagerungcalendarTitle]").prop('required',true);
        }
        else
        {
            $(".lagerung--area").hide(300);
            $("input[name=lagerungdate]").prop('required',false);      
            $("input[name=lagerungtime]").prop('required',false);
            $("input[name=lagerungcalendarTitle]").prop('required',false);
        }
    })
    })

</script>

{{-- TinyMce Email Format Ayarları --}}
<script>
    //TinyMce Ayarları 
    tinymce.init({
        selector: 'textarea.editor',
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
        toolbar_mode: 'floating',
        apply_source_formatting: true,
        plugins: 'code',
    });
    
    let dateArray2 = [];
    var tarih1 = $('input[name=umzug1date]').val();
    var tarih2 = $('input[name=umzug2date]').val();
    var tarih3 = $('input[name=umzug3date]').val();
    var tarih4 = $('input[name=einpackdate]').val();
    var tarih5 = $('input[name=auspackdate]').val();
    var tarih6 = $('input[name=reinigung1Startdate]').val();
    var tarih7 = $('input[name=reinigung2Startdate]').val();
    var tarih8 = $('input[name=entsorgungdate]').val();
    var tarih9 = $('input[name=transportdate]').val();
    var tarih10 = $('input[name=lagerungdate]').val();
    
    if (tarih1 != null || tarih1 != undefined) {
        dateArray2.push({
            name: '<b>Umzug:</b> ',
            date: tarih1
        })
    }
    if (tarih2 != null || tarih2 != undefined) {
        dateArray2.push({
            name: '<b>Umzug 2:</b>> ',
            date: tarih2
        })
    }
    if (tarih3 != null || tarih3 != undefined) {
        dateArray2.push({
            name: '<b>Umzug 3:</b> ',
            date: tarih3
        })
    }
    if (tarih4 != null || tarih4 != undefined) {
        dateArray2.push({
            name: '<b>Einpack:</b> ',
            date: tarih4
        })
    }
    if (tarih5 != null || tarih5 != undefined) {
        dateArray2.push({
            name: '<b>Auspack:</b> ',
            date: tarih5
        })
    }
    if (tarih6 != null || tarih6 != undefined) {
        dateArray2.push({
            name: '<b>Reinigung:</b> ',
            date: tarih6
        })
    }
    if (tarih7 != null || tarih7 != undefined) {
        dateArray2.push({
            name: '<b>Reinigung 2:</b> ',
            date: tarih7
        })
    }
    if (tarih8 != null || tarih8 != undefined) {
        dateArray2.push({
            name: '<b>Entsorgung:</b> ',
            date: tarih8
        })
    }
    if (tarih9 != null || tarih9 != undefined) {
        dateArray2.push({
            name: '<b>Transport:</b> ',
            date: tarih9
        })
    }
    if (tarih10 != null || tarih10 != undefined) {
        dateArray2.push({
            name: '<b>Lagerung:</b> ',
            date: tarih10
        })
    }
    eventChanges();
    $("body").on("change", ".widget-body", function() {
        eventChanges();
    });
    function momentConvertValue(value){
        return moment(value, "YYYY-MM-DD").format("DD.MM.YYYY");
    }
    function eventChanges() {
        valueZ = $("input[name=appType]:checked").val();
        tinymce.execCommand("mceRepaint");
      
            $("body").on("change", ".widget-body", function() {
                var tarih1 = $('input[name=umzug1date]').val();
                var tarih2 = $('input[name=umzug2date]').val();
                var tarih3 = $('input[name=umzug3date]').val();
                var tarih4 = $('input[name=einpackdate]').val();
                var tarih5 = $('input[name=auspackdate]').val();
                var tarih6 = $('input[name=reinigung1Startdate]').val();
                var tarih7 = $('input[name=reinigung2Startdate]').val();
                var tarih8 = $('input[name=entsorgungdate]').val();
                var tarih9 = $('input[name=transportdate]').val();
                var tarih10 = $('input[name=lagerungdate]').val();
                var found;
                dateArray2.some(function(entry) {
                    if (entry.name == "<b>Umzug:</b> ") {
                        found = entry;
                        dateArray2.splice(found);
                    }
                    if (entry.name == "<b>Umzug 2:</b> ") {
                        found = entry;
                        dateArray2.splice(found);
                    }
                    if (entry.name == "<b>Umzug 3:</b> ") {
                        found = entry;
                        dateArray2.splice(found);
                    }
                    if (entry.name == "<b>Einpack:</b> ") {
                        found = entry;
                        dateArray2.splice(found);
                    }
                    if (entry.name == "<b>Auspack:</b> ") {
                        found = entry;
                        dateArray2.splice(found);
                    }
                    if (entry.name == "<b>Reinigung:</b> ") {
                        found = entry;
                        dateArray2.splice(found);
                    }
                    if (entry.name == "<b>Reinigung 2:</b> ") {
                        found = entry;
                        dateArray2.splice(found);
                    }
                    if (entry.name == "<b>Entsorgung:</b> ") {
                        found = entry;
                        dateArray2.splice(found);
                    }
                    if (entry.name == "<b>Transport:</b> ") {
                        found = entry;
                        dateArray2.splice(found);
                    }
                    if (entry.name == "<b>Lagerung:</b> ") {
                        found = entry;
                        dateArray2.splice(found);
                    }
                });
                if ($("input[name=isUmzug]:checked").val()) {
                    dateArray2.push({
                        name: '<b>Umzug:</b> ',
                        date: momentConvertValue(tarih1)
                    })
                }
                if ($("input[name=isUmzug2]:checked").val()) {
                    if(tarih2!=""){
                        dateArray2.push({
                        name: '<b>Umzug 2:</b> ',
                        date: momentConvertValue(tarih2)
                    })
                    }
                    if(tarih3!=""){
                        dateArray2.push({
                        name: '<b>Umzug 3:</b> ',
                        date: momentConvertValue(tarih3)
                    })
                    }
                }
                if ($("input[name=isEinpackservice]:checked").val()) {
                    dateArray2.push({
                        name: '<b>Einpack:</b> ',
                        date: momentConvertValue(tarih4)
                    })
                }
                if ($("input[name=isAuspackservice]:checked").val()) {
                    dateArray2.push({
                        name: '<b>Auspack:</b> ',
                        date: momentConvertValue(tarih5)
                    })
                }
                if ($("input[name=isReinigung]:checked").val()) {
                    dateArray2.push({
                        name: '<b>Reinigung:</b> ',
                        date: momentConvertValue(tarih6)
                    })
                }
                if ($("input[name=isReinigung2]:checked").val()) {
                    dateArray2.push({
                        name: '<b>Reinigung 2:</b> ',
                        date: momentConvertValue(tarih7)
                    })
                }
                if ($("input[name=isEntsorgung]:checked").val()) {
                    dateArray2.push({
                        name: '<b>Entsorgung:</b> ',
                        date: momentConvertValue(tarih8)
                    })
                }
                if ($("input[name=isTransport]:checked").val()) {
                    dateArray2.push({
                        name: '<b>Transport:</b> ',
                        date: momentConvertValue(tarih9)
                    })
                }
                if ($("input[name=isLagerung]:checked").val()) {
                    dateArray2.push({
                        name: '<b>Lagerung:</b> ',
                        date: momentConvertValue(tarih10)
                    })
                }
                

                var requestDate = "";
                for (var i = 0; i <= dateArray2.length - 1; i++) {
                    requestDate += dateArray2[i].name + " " + dateArray2[i].date + "<br>";
                }
                
                tinymce.get("customEmail").setContent(`@include('../../cemail', ['date' => '${requestDate}'])`);
                tinymce.execCommand("mceRepaint");
            })
    }
</script>

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

@endsection

