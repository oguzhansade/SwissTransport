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
                                <div class="col-md-12 ">
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
                                    <input type="checkbox" name="isUmzug" @if ($data['umzugId']) checked @endif  id="isUmzug" class="js-switch" data-size="small" data-color="#286090" data-switchery="false" >  
                                </div>                            
                            </div>
                            {{-- Umzug Alanı Kontrolü Bitiş --}}

                            {{-- Umzug Alanı --}}
                            <div class="form-group row umzug--area" @if ($data['umzugId'] == NULL) style="display: none;" @endif>
                                {{-- 1.Umzug Alanı Başlangıç --}}
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Umzugstermin Am</label>
                                    <input class="form-control" class="date"  name="umzug1date"  type="date" @if ($dataUmzug) value="{{ $dataUmzug['umzugDate'] }}" @endif >                                
                                </div>
                                
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Umzugstermin Stunde</label>
                                    <input class="form-control"  name="umzug1time"  type="time" @if ($dataUmzug) value="{{ $dataUmzug['umzugTime'] }}" @endif>                                
                                </div>

                                <div class="w-100 row rounded p-1 mt-1" style="background-color:  #C8DFF3;">
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
                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #C8DFF3;">
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
                                        @if ($dataUmzug) value="{{   $dataUmzug['calendarLocation'] }}"  @else value=" {{ $data2['street'] }} , {{ $data2['postCode'] }} , {{ $data2['Ort'] }} , {{ $data2['country'] }} " @endif>
                                    </div>
                                </div>
                                {{-- 1.Umzug Alanı Bitiş --}}
                                
                                {{-- 2.Umzug Alanı Kontrolü --}}
                                <div class="col-md-12 umzug-control2">
                                    <label for="" class="col-form-label">Weitere Umzugstermine</label><br>
                                    <input type="checkbox" name="isUmzug2" @if ($data['umzug2Id'] or $data['umzug3Id'] ) checked @endif id="isUmzug2" class="js-switch" data-size="small" data-color="#286090" data-switchery="false" >  
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
    
                                    <div class="w-100 row rounded p-1 mt-1" style="background-color:  #C8DFF3;">
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
                                    
                                    <div class="row w-100 rounded p-1 mt-1" style="background-color:  #C8DFF3;">
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
                                            @if ($dataUmzug2) value="{{   $dataUmzug2['calendarLocation'] }}" @else value=" {{ $data2['street'] }} , {{ $data2['postCode'] }} , {{ $data2['Ort'] }} , {{ $data2['country'] }} "  @endif>
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
    
                                    <div class="w-100 row rounded p-1 mt-1" style="background-color:  #C8DFF3;">
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
                                    
                                    <div class="row w-100 rounded p-1 mt-1" style="background-color:  #C8DFF3;">
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
                                            @if ($dataUmzug3) value="{{   $dataUmzug3['calendarLocation'] }}" @else value=" {{ $data2['street'] }} , {{ $data2['postCode'] }} , {{ $data2['Ort'] }} , {{ $data2['country'] }} "  @endif>
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
                                    <input type="checkbox" name="isEinpackservice" @if ($data['einpackId']) checked @endif id="isEinpackservice" class="js-switch" data-size="small" data-color="#286090" data-switchery="false" >  
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
                                
                                <div class="w-100 row rounded p-1 mt-3" style="background-color:  #C8DFF3;">
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

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #C8DFF3;">
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
                                        @if ($dataEinpack) value="{{ $dataEinpack['calendarLocation'] }}" @else value=" {{ $data2['street'] }} , {{ $data2['postCode'] }} , {{ $data2['Ort'] }} , {{ $data2['country'] }} " @endif>
                                    </div>
                                </div>
                            </div>
                            {{-- Einpackservice Alanı Bitiş --}}


                             {{-- Auspackservice Alanı Kontrolü --}}
                             <div class="form-group row">
                                <div class="col-md-12 auspackservice-control">
                                    <label for="" class="col-form-label">Auspackservice</label><br>
                                    <input type="checkbox" name="isAuspackservice" @if ($data['auspackId']) checked @endif id="isAuspackservice" class="js-switch" data-size="small" data-color="#286090" data-switchery="false" >  
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
                                
                                <div class="w-100 row rounded p-1 mt-3" style="background-color:  #C8DFF3;">
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

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #C8DFF3;">
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
                                        @if ($dataAuspack) value="{{ $dataAuspack['calendarLocation'] }}" @else value=" {{ $data2['street'] }} , {{ $data2['postCode'] }} , {{ $data2['Ort'] }} , {{ $data2['country'] }} "  @endif>
                                    </div>
                                </div>
                            </div>
                            {{-- Auspackservice Alanı Bitiş --}}

                            {{-- Reinigung Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 reinigung-control">
                                    <label for="" class="col-form-label">Reinigung</label><br>
                                    <input type="checkbox" name="isReinigung" id="isReinigung" @if ($data['reinigungId']) checked @endif class="js-switch" data-size="small" data-color="#286090" data-switchery="false" >  
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

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #C8DFF3;">
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
                                        @if ($dataReinigung) value="{{ $dataReinigung['calendarLocation'] }}"  @else value=" {{ $data2['street'] }} , {{ $data2['postCode'] }} , {{ $data2['Ort'] }} , {{ $data2['country'] }} " @endif>
                                    </div>
                                </div>
                            </div>          
                            
                            
                            {{-- Reinigung Alanı Bitiş --}}

                            {{-- 2.Reinigung Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 reinigung2-control">
                                    <label for="" class="col-form-label">Reinigung 2</label><br>
                                    <input type="checkbox" name="isReinigung2" id="isReinigung2"  @if ($data['reinigung2Id']) checked @endif class="js-switch" data-size="small" data-color="#286090" data-switchery="false" >  
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

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #C8DFF3;">
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
                                        @if ($dataReinigung2) value="{{ $dataReinigung2['calendarLocation'] }}" @else value=" {{ $data2['street'] }} , {{ $data2['postCode'] }} , {{ $data2['Ort'] }} , {{ $data2['country'] }} "  @endif>
                                    </div>
                                </div>
                            </div>                           
                            {{-- 2.Reinigung Alanı Bitiş --}}

                            {{-- Entsorgung Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 entsorgung-control">
                                    <label for="" class="col-form-label">Entsorgung</label><br>
                                    <input type="checkbox" name="isEntsorgung" id="isEntsorgung" @if ($data['entsorgungId']) checked @endif class="js-switch" data-size="small" data-color="#286090" data-switchery="false" >  
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
                                
                                <div class="w-100 row rounded p-1 mt-3" style="background-color:  #C8DFF3;">
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

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #C8DFF3;">
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
                                        @if ($dataEntsorgung) value="{{ $dataEntsorgung['calendarLocation'] }}"  @else value=" {{ $data2['street'] }} , {{ $data2['postCode'] }} , {{ $data2['Ort'] }} , {{ $data2['country'] }} " @endif>
                                    </div>
                                </div>
                            </div>                        
                            {{-- Entsorgung Alanı Bitiş --}}

                            {{-- Transport Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 transport-control">
                                    <label for="" class="col-form-label">Transport</label><br>
                                    <input type="checkbox" name="isTransport" id="isTransport" @if ($data['transportId']) checked @endif class="js-switch" data-size="small" data-color="#286090" data-switchery="false" >  
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
                                
                                <div class="w-100 row rounded p-1 mt-3" style="background-color:  #C8DFF3;">
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
                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #C8DFF3;">
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
                                        @if ($dataTransport) {{ $dataTransport['calendarLocation'] }} @else value=" {{ $data2['street'] }} , {{ $data2['postCode'] }} , {{ $data2['Ort'] }} , {{ $data2['country'] }} "  @endif>
                                    </div>
                                </div>
                            </div>                        
                            {{-- Transport Alanı Bitiş --}}

                            {{-- Lagerung Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 lagerung-control">
                                    <label for="" class="col-form-label">Lagerung</label><br>
                                    <input type="checkbox" name="isLagerung" id="isLagerung" @if ($data['lagerungId']) checked @endif class="js-switch" data-size="small" data-color="#286090" data-switchery="false" >  
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
                                      
                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #C8DFF3;">
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
                                        @if ($dataLagerung) value="{{ $dataLagerung['calendarLocation'] }}" @else value=" {{ $data2['street'] }} , {{ $data2['postCode'] }} , {{ $data2['Ort'] }} , {{ $data2['country'] }} "  @endif>
                                    </div>
                                </div>
                            </div>                        
                            {{-- Transport Alanı Bitiş --}}
                        </div>
                        {{-- Onay Alanı Bitiş --}}
                            <div class="form-group row">
                                <div class="col-md-12 email-send">
                                    <label for="" class="col-form-label">E-Mail an Kunden</label><br>
                                    <input type="checkbox" name="isEmail" id="isEmail" class="js-switch" data-color="#286090" data-switchery="false" >  
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
                                    <input type="checkbox" name="isCustomEmail" id="isCustomEmail" class="js-switch isCustomEmail" data-color="#286090" data-switchery="false" >   
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

{{-- Title Oto Doldurma --}}
<script>
    
    let umzugTitle = $('input[name=umzug1calendarTitle]').val();
    let umzug2Title = $('input[name=umzug2calendarTitle]').val();
    let umzug3Title = $('input[name=umzug3calendarTitle]').val();
    let einpackTitle = $('input[name=einpackcalendarTitle]').val();
    let auspackTitle = $('input[name=auspackcalendarTitle]').val();
    let entsorgungTitle = $('input[name=entsorgungcalendarTitle]').val();
    let transportTitle = $('input[name=transportcalendarTitle]').val();
    let lagerungTitle = $('input[name=lagerungcalendarTitle]').val();
    let reinigungTitle = $('input[name=reinigungcalendarTitle]').val();
    let reinigung2Title = $('input[name=reinigung2calendarTitle]').val();
    let bescTitle = $('input[name=calendarTitle]').val();
    
    // Edit gibi çalışıyor bu yüzden fonksiyonlaştırdık
    function umzugFunc ()
    {
        let serviceName = 'Umzug';
        let gender = '';
        let genderType = '{{ $data2['gender'] }}';
        let hours,ma,lkw,time,anhanger;
        if(genderType == 'male')
        {
            gender = 'Herr'
        }
        else{
            gender = 'Frau'
        }
        let name = '{{ $data2['name'] }}';
        let surname = '{{ $data2['surname'] }}';
        let mobile = '{{ $data2['mobile'] }}';
        if($('input[name=umzug1hours]').val()){ hours = 'ca.'+' '+$('input[name=umzug1hours]').val()+' '+'Std'}else{ hours = ''}
        if($('input[name=umzug1ma]').val()>0){  ma = $('input[name=umzug1ma]').val()+' '+'MA';} else { ma = ''}
        if($('input[name=umzug1lkw]').val()>0){  lkw = $('input[name=umzug1lkw]').val()+' '+'LW';}else{ lkw = ''}
        if($('input[name=umzug1anhanger]').val()>0){  anhanger = $('input[name=umzug1anhanger]').val()+' '+'Anh';}else{ anhanger = ''}
        if($('input[name=umzug1time]').val()){  time = $('input[name=umzug1time]').val()+' '+'Uhr';}else{ time = ''}
    
        let newTitle = serviceName+' '+'/'+' '+gender+' '+name+' '+surname+' '+mobile+' '+'/'+' '+ma+' '+lkw+' '+anhanger+' '+hours+' '+'/'+' '+time;

        if(newTitle !== umzugTitle) { // only update if the new title is different
            $('input[name=umzug1calendarTitle]').val(newTitle);
            umzugTitle = newTitle; // save the new title
        }
    }
    
    function umzug2Func ()
    {
        let umzug2serviceName = 'Umzug 2';
        let umzug2gender = '';
        let umzug2genderType = '{{ $data2['gender'] }}';
        let umzug2hours,umzug2ma,umzug2lkw,umzug2time,umzug2anhanger;
        if(umzug2genderType == 'male')
        {
            umzug2gender = 'Herr'
        }
        else{
            umzug2gender = 'Frau'
        }
        let umzug2name = '{{ $data2['name'] }}';
        let umzug2surname = '{{ $data2['surname'] }}';
        let umzug2mobile = '{{ $data2['mobile'] }}';
        if($('input[name=umzug2hours]').val()){ umzug2hours = 'ca.'+' '+$('input[name=umzug2hours]').val()+' '+'Std'}else{ umzug2hours = ''}
        if($('input[name=umzug2ma]').val()>0){  umzug2ma = $('input[name=umzug2ma]').val()+' '+'MA';} else { umzug2ma = ''}
        if($('input[name=umzug2lkw]').val()>0){  umzug2lkw = $('input[name=umzug2lkw]').val()+' '+'LW';}else{ umzug2lkw = ''}
        if($('input[name=umzug2anhanger]').val()>0){  umzug2anhanger = $('input[name=umzug2anhanger]').val()+' '+'ANH';}else{ umzug2anhanger = ''}
        if($('input[name=umzug2time]').val()){  umzug2time = $('input[name=umzug2time]').val()+' '+'Uhr';}else{ umzug2time = ''}
    
        let umzug2newTitle = umzug2serviceName+' '+'/'+' '+umzug2gender+' '+umzug2name+' '+umzug2surname+' '+umzug2mobile+' '+'/'+' '+umzug2ma+' '+umzug2lkw+' '+umzug2anhanger+' '+umzug2hours+' '+'/'+' '+umzug2time;

        if(umzug2newTitle !== umzug2Title) { // only update if the new title is different
            $('input[name=umzug2calendarTitle]').val(umzug2newTitle);
            umzug2Title = umzug2newTitle; // save the new title
        }
    }

    function umzug3Func()
    {
        let umzug3serviceName = 'Umzug 3';
        let umzug3gender = '';
        let umzug3genderType = '{{ $data2['gender'] }}';
        let umzug3hours,umzug3ma,umzug3lkw,umzug3time,umzug3anhanger;
        if(umzug3genderType == 'male')
        {
            umzug3gender = 'Herr'
        }
        else{
            umzug3gender = 'Frau'
        }
        let umzug3name = '{{ $data2['name'] }}';
        let umzug3surname = '{{ $data2['surname'] }}';
        let umzug3mobile = '{{ $data2['mobile'] }}';
        if($('input[name=umzug3hours]').val()){ umzug3hours = 'ca.'+' '+$('input[name=umzug3hours]').val()+' '+'Std'}else{ umzug3hours = ''}
        if($('input[name=umzug3ma]').val()>0){  umzug3ma = $('input[name=umzug3ma]').val()+' '+'MA';} else { umzug3ma = ''}
        if($('input[name=umzug3lkw]').val()>0){  umzug3lkw = $('input[name=umzug3lkw]').val()+' '+'LW ';}else{ umzug3lkw = ''}
        if($('input[name=umzug3anhanger]').val()>0){  umzug3anhanger = $('input[name=umzug3anhanger]').val()+' '+'ANH';}else{ umzug3anhanger = ''}
        if($('input[name=umzug3time]').val()){  umzug3time = $('input[name=umzug3time]').val()+' '+'Uhr';}else{ umzug3time = ''}
    
        let umzug3newTitle = umzug3serviceName+' '+'/'+' '+umzug3gender+' '+umzug3name+' '+umzug3surname+' '+umzug3mobile+' '+'/'+' '+umzug3ma+' '+umzug3lkw+' '+umzug3anhanger+' '+umzug3hours+' '+'/'+' '+umzug3time;

        if(umzug3newTitle !== umzug3Title) { // only update if the new title is different
            $('input[name=umzug3calendarTitle]').val(umzug3newTitle);
            umzug3Title = umzug3newTitle; // save the new title
        }
    }

    function einpackFunc()
    {
        let einpackserviceName = 'Einpack';
            let einpackgender = '';
            let einpackgenderType = '{{ $data2['gender'] }}';
            let einpackhours,einpackma,einpacklkw,einpacktime,einpackanhanger;
            if(einpackgenderType == 'male')
            {
                einpackgender = 'Herr'
            }
            else{
                einpackgender = 'Frau'
            }
            let einpackname = '{{ $data2['name'] }}';
            let einpacksurname = '{{ $data2['surname'] }}';
            let einpackmobile = '{{ $data2['mobile'] }}';
            if($('input[name=einpackhours]').val()){ einpackhours = 'ca.'+' '+$('input[name=einpackhours]').val()+' '+'Std'}else{ einpackhours = ''}
            if($('input[name=einpackma]').val()>0){  einpackma = $('input[name=einpackma]').val()+' '+'MA';} else { einpackma = ''}
            if($('input[name=einpacklkw]').val()>0){  einpacklkw = $('input[name=einpacklkw]').val()+' '+'LW';}else{ einpacklkw = ''}
            if($('input[name=einpackanhanger]').val()>0){  einpackanhanger = $('input[name=einpackanhanger]').val()+' '+'ANH';}else{ einpackanhanger = ''}
            if($('input[name=einpacktime]').val()){  einpacktime = $('input[name=einpacktime]').val()+' '+'Uhr';}else{ einpacktime = ''}
        
            let einpacknewTitle = einpackserviceName+' '+'/'+' '+einpackgender+' '+einpackname+' '+einpacksurname+' '+einpackmobile+' '+'/'+' '+einpackma+' '+einpacklkw+' '+einpackanhanger+' '+einpackhours+' '+'/'+' '+einpacktime;

            if(einpacknewTitle !== einpackTitle) { // only update if the new title is different
                $('input[name=einpackcalendarTitle]').val(einpacknewTitle);
                einpackTitle = einpacknewTitle; // save the new title
            }
    }

    function auspackFunc()
    {
        let auspackserviceName = 'Auspack';
        let auspackgender = '';
        let auspackgenderType = '{{ $data2['gender'] }}';
        let auspackhours,auspackma,auspacklkw,auspacktime,auspackanhanger;
        if(auspackgenderType == 'male')
        {
            auspackgender = 'Herr'
        }
        else{
            auspackgender = 'Frau'
        }
        let auspackname = '{{ $data2['name'] }}';
        let auspacksurname = '{{ $data2['surname'] }}';
        let auspackmobile = '{{ $data2['mobile'] }}';
        if($('input[name=auspackhours]').val()){ auspackhours = 'ca.'+' '+$('input[name=auspackhours]').val()+' '+'Std'}else{ auspackhours = ''}
        if($('input[name=auspackma]').val()>0){  auspackma = $('input[name=auspackma]').val()+' '+'MA';} else { auspackma = ''}
        if($('input[name=auspacklkw]').val()>0){  auspacklkw = $('input[name=auspacklkw]').val()+' '+'LW';}else{ auspacklkw = ''}
        if($('input[name=auspackanhanger]').val()>0){  auspackanhanger = $('input[name=auspackanhanger]').val()+' '+'ANH';}else{ auspackanhanger = ''}
        if($('input[name=auspacktime]').val()){  auspacktime = $('input[name=auspacktime]').val()+' '+'Uhr';}else{ auspacktime = ''}
    
        let auspacknewTitle = auspackserviceName+' '+'/'+' '+auspackgender+' '+auspackname+' '+auspacksurname+' '+auspackmobile+' '+'/'+' '+auspackma+' '+auspacklkw+' '+auspackanhanger+' '+auspackhours+' '+'/'+' '+auspacktime;

        if(auspacknewTitle !== auspackTitle) { // only update if the new title is different
            $('input[name=auspackcalendarTitle]').val(auspacknewTitle);
            auspackTitle = auspacknewTitle; // save the new title
        }
    }

    function entsorgungFunc()
    {
        let entsorgungserviceName = 'Entsorgung';
            let entsorgunggender = '';
            let entsorgunggenderType = '{{ $data2['gender'] }}';
            let entsorgunghours,entsorgungma,entsorgunglkw,entsorgungtime;
            if(entsorgunggenderType == 'male')
            {
                entsorgunggender = 'Herr'
            }
            else{
                entsorgunggender = 'Frau'
            }
            let entsorgungname = '{{ $data2['name'] }}';
            let entsorgungsurname = '{{ $data2['surname'] }}';
            let entsorgungmobile = '{{ $data2['mobile'] }}';
            if($('input[name=entsorgunghours]').val()){ entsorgunghours = 'ca.'+' '+$('input[name=entsorgunghours]').val()+' '+'Std'}else{ entsorgunghours = ''}
            if($('input[name=entsorgungma]').val()>0){  entsorgungma = $('input[name=entsorgungma]').val()+' '+'MA';} else { entsorgungma = ''}
            if($('input[name=entsorgunglkw]').val()>0){  entsorgunglkw = $('input[name=entsorgunglkw]').val()+' '+'LW';}else{ entsorgunglkw = ''}
            if($('input[name=entsorgunganhanger]').val()>0){  entsorgunganhanger = $('input[name=entsorgunganhanger]').val()+' '+'ANH';}else{ entsorgunganhanger = ''}
            if($('input[name=entsorgungtime]').val()){  entsorgungtime = $('input[name=entsorgungtime]').val()+' '+'Uhr';}else{ entsorgungtime = ''}
        
            let entsorgungnewTitle = entsorgungserviceName+' '+'/'+' '+entsorgunggender+' '+entsorgungname+' '+entsorgungsurname+' '+entsorgungmobile+' '+'/'+' '+entsorgungma+' '+entsorgunglkw+' '+entsorgunganhanger+' '+entsorgunghours+' '+'/'+' '+entsorgungtime;

            if(entsorgungnewTitle !== entsorgungTitle) { // only update if the new title is different
                $('input[name=entsorgungcalendarTitle]').val(entsorgungnewTitle);
                entsorgungTitle = entsorgungnewTitle; // save the new title
            }
    }

    function transportFunc()
    {
        let transportserviceName = 'Transport';
        let transportgender = '';
        let transportgenderType = '{{ $data2['gender'] }}';
        let transporthours,transportma,transportlkw,transporttime,transportanhanger;
        if(transportgenderType == 'male')
        {
            transportgender = 'Herr'
        }
        else{
            transportgender = 'Frau'
        }
        let transportname = '{{ $data2['name'] }}';
        let transportsurname = '{{ $data2['surname'] }}';
        let transportmobile = '{{ $data2['mobile'] }}';
        if($('input[name=transporthours]').val()){ transporthours = 'ca.'+' '+$('input[name=transporthours]').val()+' '+'Std'}else{ transporthours = ''}
        if($('input[name=transportma]').val()>0){  transportma = $('input[name=transportma]').val()+' '+'MA';} else { transportma = ''}
        if($('input[name=transportlkw]').val()>0){  transportlkw = $('input[name=transportlkw]').val()+' '+'LW';}else{ transportlkw = ''}
        if($('input[name=transportanhanger]').val()>0){  transportanhanger = $('input[name=transportanhanger]').val()+' '+'ANH';}else{ transportanhanger = ''}
        if($('input[name=transporttime]').val()){  transporttime = $('input[name=transporttime]').val()+' '+'Uhr';}else{ transporttime = ''}
    
        let transportnewTitle = transportserviceName+' '+'/'+' '+transportgender+' '+transportname+' '+transportsurname+' '+transportmobile+' '+'/'+' '+transportma+' '+transportlkw+' '+transportanhanger+' '+transporthours+' '+'/'+' '+transporttime;

        if(transportnewTitle !== transportTitle) { // only update if the new title is different
            $('input[name=transportcalendarTitle]').val(transportnewTitle);
            transportTitle = transportnewTitle; // save the new title
        }
    }

    function reinigungFunc()
    {
        // Reinigung / Herr Ali Yurdakul +41 76 399 50 02 / Abgabetermin 28. April 2023 um 09:00 Uhr
        let reinigungserviceName = 'Reinigung';
        let reinigunggender = '';
        let reinigunggenderType = '{{ $data2['gender'] }}';
        let reinigungEndDate,reinigungEndTime;
        if(reinigunggenderType == 'male')
        {
            reinigunggender = 'Herr'
        }
        else{
            reinigunggender = 'Frau'
        }
        let reinigungname = '{{ $data2['name'] }}';
        let reinigungsurname = '{{ $data2['surname'] }}';
        let reinigungmobile = '{{ $data2['mobile'] }}';
        if($('input[name=reinigung1Enddate]').val()){  reinigungEndDate = 'Abgabetermin'+' '+$('input[name=reinigung1Enddate]').val()+' '+'um'}else{ reinigungEndDate = ''}
        if($('input[name=reinigung1Endtime]').val()){  reinigungEndTime = $('input[name=reinigung1Endtime]').val()+' '+'Uhr';}else{ reinigungEndTime = ''}
    
        let reinigungnewTitle = reinigungserviceName+' '+'/'+' '+reinigunggender+' '+reinigungname+' '+reinigungsurname+' '+reinigungmobile+' '+'/'+' '+reinigungEndDate+' '+reinigungEndTime;

        if(reinigungnewTitle !== reinigungTitle) { // only update if the new title is different
            $('input[name=reinigungcalendarTitle]').val(reinigungnewTitle);
            reinigungTitle = reinigungnewTitle; // save the new title
        }
    }

    function reinigung2Func()
    {
        // Reinigung / Herr Ali Yurdakul +41 76 399 50 02 / Abgabetermin 28. April 2023 um 09:00 Uhr
        let reinigung2serviceName = 'Reinigung 2';
        let reinigung2gender = '';
        let reinigung2genderType = '{{ $data2['gender'] }}';
        let reinigung2EndDate,reinigung2EndTime;
        if(reinigung2genderType == 'male')
        {
            reinigung2gender = 'Herr'
        }
        else{
            reinigung2gender = 'Frau'
        }
        let reinigung2name = '{{ $data2['name'] }}';
        let reinigung2surname = '{{ $data2['surname'] }}';
        let reinigung2mobile = '{{ $data2['mobile'] }}';
        if($('input[name=reinigung2Enddate]').val()){  reinigung2EndDate = 'Abgabetermin'+' '+$('input[name=reinigung2Enddate]').val()+' '+'um'}else{ reinigung2EndDate = ''}
        if($('input[name=reinigung2Endtime]').val()){  reinigung2EndTime = $('input[name=reinigung2Endtime]').val()+' '+'Uhr';}else{ reinigung2EndTime = ''}
    
        let reinigung2newTitle = reinigung2serviceName+' '+'/'+' '+reinigung2gender+' '+reinigung2name+' '+reinigung2surname+' '+reinigung2mobile+' '+'/'+' '+reinigung2EndDate+' '+reinigung2EndTime;

        if(reinigung2newTitle !== reinigung2Title) { // only update if the new title is different
            $('input[name=reinigung2calendarTitle]').val(reinigung2newTitle);
            reinigung2Title = reinigung2newTitle; // save the new title
        }
    }

    function lagerungFunc()
    {
        let lagerungserviceName = 'Lagerung';
        let lagerunggender = '';
        let lagerunggenderType = '{{ $data2['gender'] }}';
        let lagerunghours,lagerungma,lagerunglkw,lagerungtime,lagerunganhanger;
        if(lagerunggenderType == 'male')
        {
            lagerunggender = 'Herr'
        }
        else{
            lagerunggender = 'Frau'
        }
        let lagerungname = '{{ $data2['name'] }}';
        let lagerungsurname = '{{ $data2['surname'] }}';
        let lagerungmobile = '{{ $data2['mobile'] }}';
        if($('input[name=lagerunghours]').val()){ lagerunghours = 'ca.'+' '+$('input[name=lagerunghours]').val()+' '+'Std'}else{ lagerunghours = ''}
        if($('input[name=lagerungma]').val()>0){  lagerungma = $('input[name=lagerungma]').val()+' '+'MA';} else { lagerungma = ''}
        if($('input[name=lagerunglkw]').val()>0){  lagerunglkw = $('input[name=lagerunglkw]').val()+' '+'LW';}else{ lagerunglkw = ''}
        if($('input[name=lagerunganhanger]').val()>0){  lagerunganhanger = $('input[name=lagerunganhanger]').val()+' '+'ANH';}else{ lagerunganhanger = ''}
        if($('input[name=lagerungtime]').val()){  lagerungtime = $('input[name=lagerungtime]').val()+' '+'Uhr';}else{ lagerungtime = ''}
    
        let lagerungnewTitle = lagerungserviceName+' '+'/'+' '+lagerunggender+' '+lagerungname+' '+lagerungsurname+' '+lagerungmobile+' '+'/'+' '+lagerungtime;

        if(lagerungnewTitle !== lagerungTitle) { // only update if the new title is different
            $('input[name=lagerungcalendarTitle]').val(lagerungnewTitle);
            lagerungTitle = lagerungnewTitle; // save the new title
        }
    }

    

    $(".appointment-type").click(function() {
        var valueQq = $("input[name=appType]:checked").val();
        let AppserviceName = '';
        if (valueQq == 1)
        {
            AppserviceName = 'Bes.';
        }
        if(valueQq == 3)
        {
            AppserviceName = 'Liefe.';
        }
        
        let Appgender = '';
        let AppgenderType = '{{ $data2['gender'] }}';
        if(AppgenderType == 'male')
        {
            Appgender = 'Herr'
        }
        else{
            Appgender = 'Frau'
        }
        let Appname = '{{ $data2['name'] }}';
        let Appsurname = '{{ $data2['surname'] }}';
        let Appmobile = '{{ $data2['mobile'] }}';
        let ApppostCode = '{{ $data2['postCode'] }}';
        let bescnewTitle = ApppostCode+' '+'/'+' '+AppserviceName+' '+Appgender+' '+Appname+' '+Appsurname+' '+Appmobile;

        if(bescnewTitle !== bescTitle) { // only update if the new title is different
            $('input[name=calendarTitle]').val(bescnewTitle);
            bescTitle = bescnewTitle; // save the new title
        }
        console.log(valueQq,'VBALL')
    })

    // Umzug / Herr Ali Yurdakul +41 76 399 50 02 / 4 MA 2 LW ca. 7-8 Std / 08:00 Uhr
    $('body').on('change','.umzug--area',function(){
        umzugFunc();
    })

    $('body').on('change','.umzug--area2',function(){
        umzug2Func();
    })
    
    $('body').on('change','.umzug--area3',function(){
        umzug3Func()
    })
    // Einpack
    $('body').on('change','.einpackservice--area',function(){
        einpackFunc()
    })
    // Auspack
    $('body').on('change','.auspackservice--area',function(){
        auspackFunc()
    })

    // Entsorgung
    $('body').on('change','.entsorgung--area',function(){
        entsorgungFunc()
    })

    // Transport
    $('body').on('change','.transport--area',function(){
        transportFunc()
    })

    // Reinigung
    $('body').on('change','.reinigung--area',function(){
        reinigungFunc()
    })

    // Reinigung 2
    $('body').on('change','.reinigung2--area',function(){
        reinigung2Func()
    })
    $('body').on('change','.lagerung--area',function(){
        lagerungFunc()
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
    var saat1 = $('input[name=umzug1time]').val();
    var tarih2 = $('input[name=umzug2date]').val();
    var saat2 = $('input[name=umzug2time]').val();
    var tarih3 = $('input[name=umzug3date]').val();
    var saat3 = $('input[name=umzug3time]').val();
    var tarih4 = $('input[name=einpackdate]').val();
    var saat4 = $('input[name=einpacktime]').val();
    var tarih5 = $('input[name=auspackdate]').val();
    var saat5 = $('input[name=auspacktime]').val();
    var tarih6 = $('input[name=reinigung1Startdate]').val();
    var saat6 = $('input[name=reinigung1Starttime]').val();
    var tarih7 = $('input[name=reinigung2Startdate]').val();
    var saat7 = $('input[name=reinigung2Starttime]').val();
    var tarih8 = $('input[name=entsorgungdate]').val();
    var saat8 = $('input[name=entsorgungtime]').val();
    var tarih9 = $('input[name=transportdate]').val();
    var saat9 = $('input[name=transporttime]').val();
    var tarih10 = $('input[name=lagerungdate]').val();
    var saat10 = $('input[name=lagerungtime]').val();

    if (tarih1 != null || tarih1 != undefined) {
        dateArray2.push({
            name: '<b>Umzug:</b> ',
            date: tarih1,
            time: saat1
        })
    }
    if (tarih2 != null || tarih2 != undefined) {
        dateArray2.push({
            name: '<b>Umzug 2:</b>> ',
            date: tarih2,
            time: saat2
        })
    }
    if (tarih3 != null || tarih3 != undefined) {
        dateArray2.push({
            name: '<b>Umzug 3:</b> ',
            date: tarih3,
            time: saat3
        })
    }
    if (tarih4 != null || tarih4 != undefined) {
        dateArray2.push({
            name: '<b>Einpack:</b> ',
            date: tarih4,
            time: saat4
        })
    }
    if (tarih5 != null || tarih5 != undefined) {
        dateArray2.push({
            name: '<b>Auspack:</b> ',
            date: tarih5,
            time: saat5
        })
    }
    if (tarih6 != null || tarih6 != undefined) {
        dateArray2.push({
            name: '<b>Reinigung:</b> ',
            date: tarih6,
            time: saat6
        })
    }
    if (tarih7 != null || tarih7 != undefined) {
        dateArray2.push({
            name: '<b>Reinigung 2:</b> ',
            date: tarih7,
            time: saat7
        })
    }
    if (tarih8 != null || tarih8 != undefined) {
        dateArray2.push({
            name: '<b>Entsorgung:</b> ',
            date: tarih8,
            time: saat8
        })
    }
    if (tarih9 != null || tarih9 != undefined) {
        dateArray2.push({
            name: '<b>Transport:</b> ',
            date: tarih9,
            time: saat9
        })
    }
    if (tarih10 != null || tarih10 != undefined) {
        dateArray2.push({
            name: '<b>Lagerung:</b> ',
            date: tarih10,
            time: saat10
        })
    }
    eventChanges();
    $("body").on("change", ".widget-body", function() {
        eventChanges();
    });
    function momentConvertValue(value){
        moment.locale('de');
        return moment(value, "YYYY-MM-DD").format("dddd, DD. MMMM YYYY");
    }
    function momentConvertTimeValue(value){
        moment.locale('de');
        return moment(value, "HH:mm:ss").format("HH:mm");
    }
    function eventChanges() {
        tinymce.execCommand("mceRepaint");
        $("body").on("change", ".widget-body", function() {
            var tarih1 = $('input[name=umzug1date]').val();
            var saat1 = $('input[name=umzug1time]').val();
            var tarih2 = $('input[name=umzug2date]').val();
            var saat2 = $('input[name=umzug2time]').val();
            var tarih3 = $('input[name=umzug3date]').val();
            var saat3 = $('input[name=umzug3time]').val();
            var tarih4 = $('input[name=einpackdate]').val();
            var saat4 = $('input[name=einpacktime]').val();
            var tarih5 = $('input[name=auspackdate]').val();
            var saat5 = $('input[name=auspacktime]').val();
            var tarih6 = $('input[name=reinigung1Startdate]').val();
            var saat6 = $('input[name=reinigung1Starttime]').val();
            var tarih7 = $('input[name=reinigung2Startdate]').val();
            var saat7 = $('input[name=reinigung2Starttime]').val();
            var tarih8 = $('input[name=entsorgungdate]').val();
            var saat8 = $('input[name=entsorgungtime]').val();
            var tarih9 = $('input[name=transportdate]').val();
            var saat9 = $('input[name=transporttime]').val();
            var tarih10 = $('input[name=lagerungdate]').val();
            var saat10 = $('input[name=lagerungtime]').val();
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
                if(tarih1!=""){
                    dateArray2.push({
                        name: '<b>Umzug:</b> ',
                        date: momentConvertValue(tarih1),
                        time: momentConvertTimeValue(saat1)
                    })
                }
            }
            if ($("input[name=isUmzug2]:checked").val()) {
                if(tarih2!=""){
                    dateArray2.push({
                    name: '<b>Umzug 2:</b> ',
                    date: momentConvertValue(tarih2),
                    time: momentConvertTimeValue(saat2)
                })
                }
                if(tarih3!=""){
                    dateArray2.push({
                    name: '<b>Umzug 3:</b> ',
                    date: momentConvertValue(tarih3),
                    time: momentConvertTimeValue(saat3)
                })
                }
            }
            if ($("input[name=isEinpackservice]:checked").val()) {
                if(tarih4!=""){
                    dateArray2.push({
                        name: '<b>Einpack:</b> ',
                        date: momentConvertValue(tarih4),
                        time: momentConvertTimeValue(saat4)
                    })
                }
            }
            if ($("input[name=isAuspackservice]:checked").val()) {
                if(tarih5!=""){
                    dateArray2.push({
                        name: '<b>Auspack:</b> ',
                        date: momentConvertValue(tarih5),
                        time: momentConvertTimeValue(saat5)
                    })
                }
            }
            if ($("input[name=isReinigung]:checked").val()) {
                if(tarih6!=""){
                    dateArray2.push({
                        name: '<b>Reinigung:</b> ',
                        date: momentConvertValue(tarih6),
                        time: momentConvertTimeValue(saat6)
                    })
                }
            }
            if ($("input[name=isReinigung2]:checked").val()) {
                if(tarih7!=""){
                    dateArray2.push({
                        name: '<b>Reinigung 2:</b> ',
                        date: momentConvertValue(tarih7),
                        time: momentConvertTimeValue(saat7)
                    })
                }
            }
            if ($("input[name=isEntsorgung]:checked").val()) {
                if(tarih8!=""){
                    dateArray2.push({
                        name: '<b>Entsorgung:</b> ',
                        date: momentConvertValue(tarih8),
                        time: momentConvertTimeValue(saat8)
                    })
                }
            }
            if ($("input[name=isTransport]:checked").val()) {
                if(tarih9!=""){
                    dateArray2.push({
                        name: '<b>Transport:</b> ',
                        date: momentConvertValue(tarih9),
                        time: momentConvertTimeValue(saat9)
                    })
                }
            }
            if ($("input[name=isLagerung]:checked").val()) {
                if(tarih10!=""){
                    dateArray2.push({
                        name: '<b>Lagerung:</b> ',
                        date: momentConvertValue(tarih10),
                        time: momentConvertTimeValue(saat10)
                    })
                }
            }
            
            var requestDate = "";
            for (var i = 0; i <= dateArray2.length - 1; i++) {
                if(dateArray2[i].time)
                {
                    requestDate += dateArray2[i].name + " " + dateArray2[i].date + ' ' +dateArray2[i].time + ' '+'Uhr'+"<br>";
                }
                else {
                    requestDate += dateArray2[i].name + " " + dateArray2[i].date +"<br>";
                }
                
            }
            
            tinymce.get("customEmail").setContent(`@include('../../cemail', ['date' => '${requestDate}','AppTypeC' => 'Auftragsbestätigung'])`);
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

