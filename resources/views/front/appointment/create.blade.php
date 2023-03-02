@extends('layouts.app')
@section('header')
    <script src="https://cdn.tiny.cloud/1/qa7zzv3hb9nmr5ary4ucaw8bbt8744dzibxuf6hdomgsuchu/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
@endsection
@section('content')
@section('sidebarType')
    sidebar-collapse
@endsection

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

@if (session('status'))
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        </div>
    </div>
@endif

@if (session('status-err'))
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="alert alert-danger">
                {{ session('status-err') }}
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
                    <p>
                    <form id="myform" name="myForm" action="{{ route('appointment.store', ['id' => $data['id']]) }}"
                        method="POST" enctype="multipart/form-data">
                        </p>
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="" class="col-form-label">Art</label>
                                <div class="radiobox">
                                    <label>
                                        <input type="radio" class="appointment-type" name="appType" value="1"
                                            checked> <span class="label-text">Besichtigung</span>
                                    </label>
                                </div>

                                <div class="radiobox">
                                    <label>
                                        <input type="radio" class="appointment-type" name="appType" value="2">
                                        <span class="label-text">Auftragsbestätigung</span>
                                    </label>
                                </div>

                                <div class="radiobox">
                                    <label>
                                        <input type="radio" class="appointment-type" name="appType" value="3">
                                        <span class="label-text">Lieferung</span>
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
                                    <input type="checkbox" name="isUmzug" id="isUmzug" class="js-switch"
                                        data-size="small" data-color="#9c27b0" data-switchery="false">
                                </div>
                            </div>
                            {{-- Umzug Alanı Kontrolü Bitiş --}}

                            {{-- Umzug Alanı --}}
                            <div class="form-group row umzug--area" style="display: none;">
                                {{-- 1.Umzug Alanı Başlangıç --}}
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Umzugstermin Am</label>
                                    <input class="form-control" class="date" id="umzug1date" name="umzug1date"
                                        type="date">
                                </div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Umzugstermin Stunde</label>
                                    <input class="form-control" name="umzug1time" type="time">
                                </div>

                                <div class="w-100 row rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Dauer [h]</label>
                                        <input class="form-control" name="umzug1hours" placeholder="4-5" type="text">
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">MA</label>
                                        <input class="form-control" name="umzug1ma" placeholder="0" type="number">
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">LKW</label>
                                        <input class="form-control" name="umzug1lkw" placeholder="0" type="number">
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Anhänger</label>
                                        <input class="form-control" name="umzug1anhanger" placeholder="0"
                                            type="number">
                                    </div>
                                </div>

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control" name="umzug1calendarTitle"
                                            placeholder="CalendarTitle" type="text" value="@if($data['gender'] == 'male') Herr @else Frau @endif {{ $data['name'] }} {{ $data['surname'] }} / {{ $data['mobile'] }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarComment</label>
                                        <textarea class="form-control" name="umzug1calendarComment" id="" cols="30" rows="1"
                                            placeholder="CalendarComment"></textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarLocation</label>
                                        <input class="form-control" name="umzug1calendarLocation"
                                            placeholder="CalendarLocation" type="text"
                                            value="{{ $data['street'] }} , {{ $data['postCode'] }} , {{ $data['Ort'] }} , {{ $data['country'] }}">
                                    </div>
                                </div>
                                {{-- 1.Umzug Alanı Bitiş --}}

                                {{-- 2.Umzug Alanı Kontrolü --}}
                                <div class="col-md-12 umzug-control2">
                                    <label for="" class="col-form-label">Weitere Umzugstermine</label><br>
                                    <input type="checkbox" name="isUmzug2" id="isUmzug2" class="js-switch"
                                        data-size="small" data-color="#9c27b0" data-switchery="false">
                                </div>
                                {{-- 2.Umzug Alanı Kontrolü --}}

                                {{-- 2.Umzug Alanı Başlangıç --}}
                                <div class="form-group row w-100 umzug--area2" style="display: none;">
                                    <div class="col-md-6">
                                        <label class=" col-form-label" for="l0">Umzugstermin 2 Am</label>
                                        <input class="form-control" class="date" id="umzug2date" name="umzug2date"
                                            type="date">
                                    </div>

                                    <div class="col-md-6">
                                        <label class=" col-form-label" for="l0">Umzugstermin 2 Stunde</label>
                                        <input class="form-control" name="umzug2time" type="time">
                                    </div>

                                    <div class="w-100 row rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">Dauer [h]</label>
                                            <input class="form-control" name="umzug2hours" placeholder="4-5"
                                                type="text">
                                        </div>
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">MA</label>
                                            <input class="form-control" name="umzug2ma" placeholder="0"
                                                type="number">
                                        </div>
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">LKW</label>
                                            <input class="form-control" name="umzug2lkw" placeholder="0"
                                                type="number">
                                        </div>
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">Anhänger</label>
                                            <input class="form-control" name="umzug2anhanger" placeholder="0"
                                                type="number">
                                        </div>
                                    </div>

                                    <div class="row w-100 rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                        <div class="col-md-4">
                                            <label class=" col-form-label" for="l0">CalendarTitle</label>
                                            <input class="form-control" name="umzug2calendarTitle"
                                                placeholder="CalendarTitle" type="text" value="@if($data['gender'] == 'male') Herr @else Frau @endif {{ $data['name'] }} {{ $data['surname'] }} / {{ $data['mobile'] }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label class=" col-form-label" for="l0">CalendarComment</label>
                                            <textarea class="form-control" name="umzug2calendarComment" id="" cols="30" rows="1"
                                                placeholder="CalendarComment"></textarea>
                                        </div>

                                        <div class="col-md-4">
                                            <label class=" col-form-label" for="l0">CalendarLocation</label>
                                            <input class="form-control" name="umzug2calendarLocation"
                                                placeholder="CalendarLocation" type="text"
                                                value="{{ $data['street'] }} , {{ $data['postCode'] }} , {{ $data['Ort'] }} , {{ $data['country'] }}">
                                        </div>
                                    </div>
                                </div>
                                {{-- 2.Umzug Alanı Bitiş --}}

                                {{-- 3.Umzug Alanı Başlangıç --}}
                                <div class="form-group row w-100 umzug--area2" style="display: none;">
                                    <div class="col-md-6">
                                        <label class=" col-form-label" for="l0">Umzugstermin 3 Am</label>
                                        <input class="form-control" class="date" name="umzug3date" type="date">
                                    </div>

                                    <div class="col-md-6">
                                        <label class=" col-form-label" for="l0">Umzugstermin 3 Stunde</label>
                                        <input class="form-control" name="umzug3time" type="time">
                                    </div>

                                    <div class="w-100 row rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">Dauer [h]</label>
                                            <input class="form-control" name="umzug3hours" placeholder="4-5"
                                                type="text">
                                        </div>
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">MA</label>
                                            <input class="form-control" name="umzug3ma" placeholder="0"
                                                type="number">
                                        </div>
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">LKW</label>
                                            <input class="form-control" name="umzug3lkw" placeholder="0"
                                                type="number">
                                        </div>
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">Anhänger</label>
                                            <input class="form-control" name="umzug3anhanger" placeholder="0"
                                                type="number">
                                        </div>
                                    </div>

                                    <div class="row w-100 rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                        <div class="col-md-4">
                                            <label class=" col-form-label" for="l0">CalendarTitle</label>
                                            <input class="form-control" name="umzug3calendarTitle"
                                                placeholder="CalendarTitle" type="text" value="@if($data['gender'] == 'male') Herr @else Frau @endif {{ $data['name'] }} {{ $data['surname'] }} / {{ $data['mobile'] }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label class=" col-form-label" for="l0">CalendarComment</label>
                                            <textarea class="form-control" name="umzug3calendarComment" id="" cols="30" rows="1"
                                                placeholder="CalendarComment"></textarea>
                                        </div>

                                        <div class="col-md-4">
                                            <label class=" col-form-label" for="l0">CalendarLocation</label>
                                            <input class="form-control" name="umzug3calendarLocation"
                                                placeholder="CalendarLocation" type="text"
                                                value="{{ $data['street'] }} , {{ $data['postCode'] }} , {{ $data['Ort'] }} , {{ $data['country'] }}">
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
                                    <input type="checkbox" name="isEinpackservice" id="isEinpackservice"
                                        class="js-switch" data-size="small" data-color="#9c27b0"
                                        data-switchery="false">
                                </div>
                            </div>
                            {{-- Einpackservice Alanı Kontrolü Bitiş --}}

                            {{-- Einpackservice Alanı Başlangıç --}}
                            <div class="form-group row einpackservice--area" style="display: none; ">
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Packtermin Am</label>
                                    <input class="form-control" class="date" name="einpackdate" type="date">
                                </div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Packtermin Stunde</label>
                                    <input class="form-control" name="einpacktime" type="time">
                                </div>
                                <div class="row w-100  mt-1 pl-1 text-primary" style="font-style: italic;">Falls
                                    gleiches Datum wie Umzug, dann leer lassen.</div>

                                <div class="w-100 row rounded p-1 mt-3" style="background-color:  #CBB4FF;">
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Dauer [h]</label>
                                        <input class="form-control" class="einpacksuresi" id="einpacksuresi"
                                            aria-required="" name="einpackhours" placeholder="4-5" type="text">
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">MA</label>
                                        <input class="form-control" name="einpackma" placeholder="0" type="number">
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">LKW</label>
                                        <input class="form-control" name="einpacklkw" placeholder="0"
                                            type="number">
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Anhänger</label>
                                        <input class="form-control" name="einpackanhanger" placeholder="0"
                                            type="number">
                                    </div>
                                </div>

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control" name="einpackcalendarTitle"
                                            placeholder="CalendarTitle" type="text" value="@if($data['gender'] == 'male') Herr @else Frau @endif {{ $data['name'] }} {{ $data['surname'] }} / {{ $data['mobile'] }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarComment</label>
                                        <textarea class="form-control" name="einpackcalendarComment" id="" cols="30" rows="1"
                                            placeholder="CalendarComment"></textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarLocation</label>
                                        <input class="form-control" name="einpackcalendarLocation"
                                            placeholder="CalendarLocation" type="text"
                                            value="{{ $data['street'] }} , {{ $data['postCode'] }} , {{ $data['Ort'] }} , {{ $data['country'] }}">
                                    </div>
                                </div>
                            </div>
                            {{-- Einpackservice Alanı Bitiş --}}


                            {{-- Auspackservice Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 auspackservice-control">
                                    <label for="" class="col-form-label">Auspackservice</label><br>
                                    <input type="checkbox" name="isAuspackservice" id="isAuspackservice"
                                        class="js-switch" data-size="small" data-color="#9c27b0"
                                        data-switchery="false">
                                </div>
                            </div>
                            {{-- Auspackservice Alanı Kontrolü Bitiş --}}

                            {{-- Auspackservice Alanı Başlangıç --}}
                            <div class="form-group row auspackservice--area" style="display: none; ">
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Packtermin Am</label>
                                    <input class="form-control" class="date" name="auspackdate" type="date">
                                </div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Packtermin Stunde</label>
                                    <input class="form-control" name="auspacktime" type="time">
                                </div>
                                <div class="row w-100  mt-1 pl-1 text-primary" style="font-style: italic;">Falls
                                    gleiches Datum wie Umzug, dann leer lassen.</div>

                                <div class="w-100 row rounded p-1 mt-3" style="background-color:  #CBB4FF;">
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Dauer [h]</label>
                                        <input class="form-control" class="auspacksuresi" id="auspacksuresi"
                                            aria-required="" name="auspackhours" placeholder="4-5" type="text">
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">MA</label>
                                        <input class="form-control" name="auspackma" placeholder="0" type="number">
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">LKW</label>
                                        <input class="form-control" name="auspacklkw" placeholder="0"
                                            type="number">
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Anhänger</label>
                                        <input class="form-control" name="auspackanhanger" placeholder="0"
                                            type="number">
                                    </div>
                                </div>

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control" name="auspackcalendarTitle"
                                            placeholder="CalendarTitle" type="text" value="@if($data['gender'] == 'male') Herr @else Frau @endif {{ $data['name'] }} {{ $data['surname'] }} / {{ $data['mobile'] }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarComment</label>
                                        <textarea class="form-control" name="auspackcalendarComment" id="" cols="30" rows="1"
                                            placeholder="CalendarComment"></textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarLocation</label>
                                        <input class="form-control" name="auspackcalendarLocation"
                                            placeholder="CalendarLocation" type="text"
                                            value="{{ $data['street'] }} , {{ $data['postCode'] }} , {{ $data['Ort'] }} , {{ $data['country'] }}">
                                    </div>
                                </div>
                            </div>
                            {{-- Auspackservice Alanı Bitiş --}}

                            {{-- Reinigung Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 reinigung-control">
                                    <label for="" class="col-form-label">Reinigung</label><br>
                                    <input type="checkbox" name="isReinigung" id="isReinigung" class="js-switch"
                                        data-size="small" data-color="#9c27b0" data-switchery="false">
                                </div>
                            </div>
                            {{-- Reinigung Alanı Kontrolü Bitiş --}}

                            {{-- Reinigung Alanı Başlangıç --}}
                            <div class="form-group row reinigung--area" style="display: none; ">
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Reinigungstermin Am</label>
                                    <input class="form-control" class="date" name="reinigung1Startdate"
                                        type="date">
                                </div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Reinigungstermin Stunde</label>
                                    <input class="form-control" name="reinigung1Starttime" type="time">
                                </div>
                                <div class="row w-100 mb-2  mt-1 pl-1 text-primary" style="font-style: italic;">Falls
                                    gleiches Datum wie Umzug, dann leer lassen.</div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Abgabetermin</label>
                                    <input class="form-control" class="date" name="reinigung1Enddate"
                                        type="date">
                                </div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Abgabetermin Stunde</label>
                                    <input class="form-control" name="reinigung1Endtime" type="time">
                                </div>

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control" name="reinigungcalendarTitle"
                                            placeholder="CalendarTitle" type="text" value="@if($data['gender'] == 'male') Herr @else Frau @endif {{ $data['name'] }} {{ $data['surname'] }} / {{ $data['mobile'] }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarComment</label>
                                        <textarea class="form-control" name="reinigungcalendarComment" id="" cols="30" rows="1"
                                            placeholder="CalendarComment"></textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarLocation</label>
                                        <input class="form-control" name="reinigungcalendarLocation"
                                            placeholder="CalendarLocation" type="text"
                                            value="{{ $data['street'] }} , {{ $data['postCode'] }} , {{ $data['Ort'] }} , {{ $data['country'] }}">
                                    </div>
                                </div>
                            </div>
                            {{-- Reinigung Alanı Bitiş --}}

                            {{-- 2.Reinigung Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 reinigung2-control">
                                    <label for="" class="col-form-label">Reinigung 2</label><br>
                                    <input type="checkbox" name="isReinigung2" id="isReinigung2" class="js-switch"
                                        data-size="small" data-color="#9c27b0" data-switchery="false">
                                </div>
                            </div>
                            {{-- 2.Reinigung Alanı Kontrolü Bitiş --}}

                            {{-- 2.Reinigung Alanı Başlangıç --}}
                            <div class="form-group row reinigung2--area" style="display: none; ">
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Reinigungstermin 2 Am</label>
                                    <input class="form-control" class="date" name="reinigung2Startdate"
                                        type="date">
                                </div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Reinigungstermin 2 Stunde</label>
                                    <input class="form-control" name="reinigung2Starttime" type="time">
                                </div>
                                <div class="row w-100 mb-2  mt-1 pl-1 text-primary" style="font-style: italic;">Falls
                                    gleiches Datum wie Umzug, dann leer lassen.</div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Abgabetermin </label>
                                    <input class="form-control" class="date" name="reinigung2Enddate"
                                        type="date">
                                </div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Abgabetermin Stunde</label>
                                    <input class="form-control" name="reinigung2Endtime" type="time">
                                </div>

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control" name="reinigung2calendarTitle"
                                            placeholder="CalendarTitle" type="text" value="@if($data['gender'] == 'male') Herr @else Frau @endif {{ $data['name'] }} {{ $data['surname'] }} / {{ $data['mobile'] }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarComment</label>
                                        <textarea class="form-control" name="reinigung2calendarComment" id="" cols="30" rows="1"
                                            placeholder="CalendarComment"></textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarLocation</label>
                                        <input class="form-control" name="reinigung2calendarLocation"
                                            placeholder="CalendarLocation" type="text"
                                            value="{{ $data['street'] }} , {{ $data['postCode'] }} , {{ $data['Ort'] }} , {{ $data['country'] }}">
                                    </div>
                                </div>
                            </div>
                            {{-- 2.Reinigung Alanı Bitiş --}}

                            {{-- Entsorgung Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 entsorgung-control">
                                    <label for="" class="col-form-label">Entsorgung</label><br>
                                    <input type="checkbox" name="isEntsorgung" id="isEntsorgung" class="js-switch"
                                        data-size="small" data-color="#9c27b0" data-switchery="false">
                                </div>
                            </div>
                            {{-- Entsorgung Alanı Kontrolü Bitiş --}}

                            {{-- Entsorgung Alanı Başlangıç --}}
                            <div class="form-group row entsorgung--area" style="display: none; ">
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Entsorgungstermin Am</label>
                                    <input class="form-control" class="date" name="entsorgungdate" type="date">
                                </div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Entsorgungstermin Stunde</label>
                                    <input class="form-control" name="entsorgungtime" type="time">
                                </div>
                                <div class="row w-100  mt-1 pl-1 text-primary" style="font-style: italic;">Falls
                                    gleiches Datum wie Umzug, dann leer lassen.</div>

                                <div class="w-100 row rounded p-1 mt-3" style="background-color:  #CBB4FF;">
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Dauer [h]</label>
                                        <input class="form-control" class="entsorgungsuresi" id="entsorgungsuresi"
                                            aria-required="" name="entsorgunghours" placeholder="4-5"
                                            type="text">
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">MA</label>
                                        <input class="form-control" name="entsorgungma" placeholder="0"
                                            type="number">
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">LKW</label>
                                        <input class="form-control" name="entsorgunglkw" placeholder="0"
                                            type="number">
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Anhänger</label>
                                        <input class="form-control" name="entsorgunganhanger" placeholder="0"
                                            type="number">
                                    </div>
                                </div>

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control" name="entsorgungcalendarTitle"
                                            placeholder="CalendarTitle" type="text" value="@if($data['gender'] == 'male') Herr @else Frau @endif {{ $data['name'] }} {{ $data['surname'] }} / {{ $data['mobile'] }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarComment</label>
                                        <textarea class="form-control" name="entsorgungcalendarComment" id="" cols="30" rows="1"
                                            placeholder="CalendarComment"></textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarLocation</label>
                                        <input class="form-control" name="entsorgungcalendarLocation"
                                            placeholder="CalendarLocation" type="text"
                                            value="{{ $data['street'] }} , {{ $data['postCode'] }} , {{ $data['Ort'] }} , {{ $data['country'] }}">
                                    </div>
                                </div>
                            </div>
                            {{-- Entsorgung Alanı Bitiş --}}

                            {{-- Transport Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 transport-control">
                                    <label for="" class="col-form-label">Transport</label><br>
                                    <input type="checkbox" name="isTransport" id="isTransport" class="js-switch"
                                        data-size="small" data-color="#9c27b0" data-switchery="false">
                                </div>
                            </div>
                            {{-- Transport Alanı Kontrolü Bitiş --}}

                            {{-- Transport Alanı Başlangıç --}}
                            <div class="form-group row transport--area" style="display: none; ">
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Transport Am</label>
                                    <input class="form-control" class="date" name="transportdate" type="date">
                                </div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Transport Stunde</label>
                                    <input class="form-control" name="transporttime" type="time">
                                </div>
                                <div class="row w-100  mt-1 pl-1 text-primary" style="font-style: italic;">Falls
                                    gleiches Datum wie Umzug, dann leer lassen.</div>

                                <div class="w-100 row rounded p-1 mt-3" style="background-color:  #CBB4FF;">
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Dauer [h]</label>
                                        <input class="form-control" class="transportsuresi" id="transportsuresi"
                                            aria-required="" name="transporthours" placeholder="4-5" type="text">
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">MA</label>
                                        <input class="form-control" name="transportma" placeholder="0"
                                            type="number">
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">LKW</label>
                                        <input class="form-control" name="transportlkw" placeholder="0"
                                            type="number">
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Anhänger</label>
                                        <input class="form-control" name="transportanhanger" placeholder="0"
                                            type="number">
                                    </div>

                                    <div class="col-md-6">
                                        <label class=" col-form-label" for="l0">von</label>
                                        <input class="form-control" name="destination" placeholder="Destination"
                                            type="text">
                                    </div>

                                    <div class="col-md-6">
                                        <label class=" col-form-label" for="l0">nach</label>
                                        <input class="form-control" name="arrival" placeholder="Arrival"
                                            type="text">
                                    </div>
                                </div>

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control" name="transportcalendarTitle"
                                            placeholder="CalendarTitle" type="text" value="@if($data['gender'] == 'male') Herr @else Frau @endif {{ $data['name'] }} {{ $data['surname'] }} / {{ $data['mobile'] }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarComment</label>
                                        <textarea class="form-control" name="transportcalendarComment" id="" cols="30" rows="1"
                                            placeholder="CalendarComment"></textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarLocation</label>
                                        <input class="form-control" name="transportcalendarLocation"
                                            placeholder="CalendarLocation" type="text"
                                            value="{{ $data['street'] }} , {{ $data['postCode'] }} , {{ $data['Ort'] }} , {{ $data['country'] }}">
                                    </div>
                                </div>
                            </div>
                            {{-- Transport Alanı Bitiş --}}

                            {{-- Lagerung Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 lagerung-control">
                                    <label for="" class="col-form-label">Lagerung</label><br>
                                    <input type="checkbox" name="isLagerung" id="isLagerung" class="js-switch"
                                        data-size="small" data-color="#9c27b0" data-switchery="false">
                                </div>
                            </div>
                            {{-- Lagerung Alanı Kontrolü Bitiş --}}

                            {{-- Lagerung Alanı Başlangıç --}}
                            <div class="form-group row lagerung--area" style="display: none; ">
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Lagerung Am</label>
                                    <input class="form-control" class="date" name="lagerungdate" type="date">
                                </div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Lagerung Stunde</label>
                                    <input class="form-control" name="lagerungtime" type="time">
                                </div>
                                <div class="row w-100  mt-1 pl-1 text-primary" style="font-style: italic;">Falls
                                    gleiches Datum wie Umzug, dann leer lassen.</div>

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #CBB4FF;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control" name="lagerungcalendarTitle"
                                            placeholder="CalendarTitle" type="text" value="@if($data['gender'] == 'male') Herr @else Frau @endif {{ $data['name'] }} {{ $data['surname'] }} / {{ $data['mobile'] }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarComment</label>
                                        <textarea class="form-control" name="lagerungcalendarComment" id="" cols="30" rows="1"
                                            placeholder="CalendarComment"></textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarLocation</label>
                                        <input class="form-control" name="lagerungcalendarLocation"
                                            placeholder="CalendarLocation" type="text"
                                            value="{{ $data['street'] }} , {{ $data['postCode'] }} , {{ $data['Ort'] }} , {{ $data['country'] }}">
                                    </div>
                                </div>
                            </div>
                            {{-- Transport Alanı Bitiş --}}
                        </div>
                        {{-- Onay Alanı Bitiş --}}

                        <div class="deliverable--area" style="display: none;">
                            <div class="form-group row ">
                                <div class="col-md-12">
                                    <label for="" class="col-form-label">Lieferobjekt</label>
                                    <div class="radiobox">
                                        <label>
                                            <input type="radio" class="deliverable" name="deliverable"
                                                value="0" checked> <span
                                                class="label-text">Verpackungsmaterial</span>
                                        </label>
                                    </div>

                                    <div class="radiobox">
                                        <label>
                                            <input type="radio" class="deliverable" name="deliverable"
                                                value="1"> <span class="label-text">Schlossatelier</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row deliveryType--area">
                                <div class="col-md-12">
                                    <label for="" class="col-form-label">Lieferungsart</label>
                                    <div class="radiobox">
                                        <label>
                                            <input type="radio" class="deliveryType" name="deliveryType"
                                                value="0" checked> <span class="label-text">Lieferung</span>
                                        </label>
                                    </div>

                                    <div class="radiobox">
                                        <label>
                                            <input type="radio" class="deliveryType" name="deliveryType"
                                                value="1"> <span class="label-text">Abholung</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">Termin</label>
                                    <input class="form-control" id="teslimatDate" name="meetingDate" type="date"
                                        value="">
                                </div>

                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">Zwischen</label>
                                    <input class="form-control" name="meetingHour1" type="time">
                                </div>

                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">bis</label>
                                    <input class="form-control" name="meetingHour2" type="time">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row contactType--area">
                            <div class="col-md-12">
                                <label for="" class="col-form-label">Besichtigungsort</label>
                                <div class="radiobox">
                                    <label>
                                        <input type="radio" name="contactType" value="0" checked> <span
                                            class="label-text">Beim Kunden</span>
                                    </label>
                                </div>

                                <div class="radiobox">
                                    <label>
                                        <input type="radio" name="contactType" value="1"> <span
                                            class="label-text">Per Telefon</span>
                                    </label>
                                </div>

                                <div class="radiobox">
                                    <label>
                                        <input type="radio" name="contactType" value="2"> <span
                                            class="label-text">Andere</span>
                                    </label>
                                </div>
                            </div>
                        </div>



                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class=" col-form-label" for="l0">Wo</label>
                                <input class="form-control" name="address" type="text"
                                    value="{{ $data['street'] }} , {{ $data['postCode'] }} , {{ $data['Ort'] }}, {{ $data['country'] }}"
                                    required>
                            </div>
                        </div>

                        <div class="form-group row dateHour--area">
                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0">Datum</label>
                                <input class="form-control" class="date" id="datepicker" name="date"
                                    type="date">
                            </div>

                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0">Stunde</label>
                                <input class="form-control" name="time" type="time">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class=" col-form-label" for="l0">Kalender Titel-Zusatz</label>
                                <input class="form-control" name="calendarTitle" type="text" required value="@if($data['gender'] == 'male') Herr @else Frau @endif {{ $data['name'] }} {{ $data['surname'] }} / {{ $data['mobile'] }}">
                            </div>

                            <div class="col-md-12">
                                <label class=" col-form-label" for="l0">Kalender Kommentar</label>
                                <textarea class="form-control" name="calendarContent" id="" cols="30" rows="10" ></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 email-send">
                                <label for="" class="col-form-label">E-Mail an Kunden</label><br>
                                <input type="checkbox" name="isEmail" id="isEmail" class="js-switch"
                                    data-color="#9c27b0" data-switchery="true">
                            </div>
                        </div>

                        <div class="row form-group email--area" style="display: none;">
                            <div class="col-md-12">
                                <label class=" col-form-label" for="l0">E-Mail Adresse</label>
                                <input class="form-control" name="email" type="text"
                                    value="{{ $data['email'] }}">
                            </div>

                            <div class="col-md-12">
                                <label class=" col-form-label" for="l0">Email Kommentar</label>

                                <textarea class="form-control" name="emailContent" id="" cols="30" rows="10"></textarea>
                            </div>


                            <div class="col-md-12 email-format">
                                <label for="" class="col-form-label">Standard Emailtext bearbeiten</label><br>
                                <input type="checkbox" name="isCustomEmail" id="isCustomEmail"
                                    class="js-switch isCustomEmail" data-color="#9c27b0" data-switchery="false">
                            </div>
                        </div>

                        <div class="row form-group email--format" style="display: none;">
                            <div class="col-md-12 mt-3">

                                <textarea class="editor" id="customEmail" name="customEmail" cols="30" rows="10">
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
    console.log($("input[name=isCustomEmail]").val(), 'EMAİL CUSTOM')

    var umzugbutton = $("div.umzug-control");
    var umzugbutton2 = $("div.umzug-control2");
    var einpackservicebutton = $("div.einpackservice-control");
    var auspackservicebutton = $("div.auspackservice-control");
    var reinigungbutton = $("div.reinigung-control");
    var reinigungbutton2 = $("div.reinigung2-control");
    var entsorgungbutton2 = $("div.entsorgung-control");
    var transportbutton = $("div.transport-control");
    var lagerungbutton = $("div.lagerung-control");

    umzugbutton.click(function() {
        if ($(this).hasClass("checkbox-checked") && $("#isUmzug").is(':checked')) {
            $(".umzug--area").show(300);
            $("input[name=umzug1date]").prop('required', true);
            $("input[name=umzug1time]").prop('required', true);
            $("input[name=umzug1calendarTitle]").prop('required', true);
        } else {
            $(".umzug--area").hide(300);
            $("input[name=umzug1date]").prop('required', false);
            $("input[name=umzug1time]").prop('required', false);
            $("input[name=umzug1calendarTitle]").prop('required', false);
        }
    })

    umzugbutton2.click(function() {
        if ($(this).hasClass("checkbox-checked")) {
            $(".umzug--area2").show(300);
            $("input[name=umzug2date]").prop('required', true);
            $("input[name=umzug2time]").prop('required', true);
            $("input[name=umzug2calendarTitle]").prop('required', true);
        } else {
            $(".umzug--area2").hide(300);
            $("input[name=umzug2date]").prop('required', false);
            $("input[name=umzug2time]").prop('required', false);
            $("input[name=umzug2calendarTitle]").prop('required', false);
        }
    })

    einpackservicebutton.click(function() {
        if ($(this).hasClass("checkbox-checked")) {
            $(".einpackservice--area").show(300);
            $("input[name=einpackdate]").prop('required', true);
            $("input[name=einpacktime]").prop('required', true);
            $("input[name=einpackcalendarTitle]").prop('required', true);
        } else {
            $(".einpackservice--area").hide(300);
            $("input[name=einpackdate]").prop('required', false);
            $("input[name=einpacktime]").prop('required', false);
            $("input[name=einpackcalendarTitle]").prop('required', false);
        }
    })

    auspackservicebutton.click(function() {
        if ($(this).hasClass("checkbox-checked")) {
            $(".auspackservice--area").show(300);
            $("input[name=auspackdate]").prop('required', true);
            $("input[name=auspacktime]").prop('required', true);
            $("input[name=auspackcalendarTitle]").prop('required', true);
        } else {
            $(".auspackservice--area").hide(300);
            $("input[name=auspackdate]").prop('required', false);
            $("input[name=auspacktime]").prop('required', false);
            $("input[name=auspackcalendarTitle]").prop('required', false);
        }
    })

    reinigungbutton.click(function() {
        if ($(this).hasClass("checkbox-checked")) {
            $(".reinigung--area").show(300);
            $("input[name=reinigung1Startdate]").prop('required', true);
            $("input[name=reinigung1Starttime]").prop('required', true);
            $("input[name=reinigung1Enddate]").prop('required', true);
            $("input[name=reinigung1Endtime]").prop('required', true);
            $("input[name=reinigungcalendarTitle]").prop('required', true);
        } else {
            $(".reinigung--area").hide(300);
            $("input[name=reinigung1Startdate]").prop('required', false);
            $("input[name=reinigung1Starttime]").prop('required', false);
            $("input[name=reinigung1Enddate]").prop('required', false);
            $("input[name=reinigung1Endtime]").prop('required', false);
            $("input[name=reinigungcalendarTitle]").prop('required', false);
        }
    })

    reinigungbutton2.click(function() {
        if ($(this).hasClass("checkbox-checked")) {
            $(".reinigung2--area").show(300);
            $("input[name=reinigung2Startdate]").prop('required', true);
            $("input[name=reinigung2Starttime]").prop('required', true);
            $("input[name=reinigung2Enddate]").prop('required', true);
            $("input[name=reinigung2Endtime]").prop('required', true);
            $("input[name=reinigung2calendarTitle]").prop('required', true);
        } else {
            $(".reinigung2--area").hide(300);
            $("input[name=reinigung2Startdate]").prop('required', false);
            $("input[name=reinigung2Starttime]").prop('required', false);
            $("input[name=reinigung2Enddate]").prop('required', false);
            $("input[name=reinigung2Endtime]").prop('required', false);
            $("input[name=reinigung2calendarTitle]").prop('required', false);
        }
    })

    entsorgungbutton2.click(function() {
        if ($(this).hasClass("checkbox-checked")) {
            $(".entsorgung--area").show(300);
            $("input[name=entsorgungdate]").prop('required', true);
            $("input[name=entsorgungtime]").prop('required', true);
            $("input[name=entsorgungcalendarTitle]").prop('required', true);
        } else {
            $(".entsorgung--area").hide(300);
            $("input[name=entsorgungdate]").prop('required', false);
            $("input[name=entsorgungtime]").prop('required', false);
            $("input[name=entsorgungcalendarTitle]").prop('required', false);
        }
    })

    transportbutton.click(function() {
        if ($(this).hasClass("checkbox-checked")) {
            $(".transport--area").show(300);
            $("input[name=transportdate]").prop('required', true);
            $("input[name=transporttime]").prop('required', true);
            $("input[name=transportcalendarTitle]").prop('required', true);
        } else {
            $(".transport--area").hide(300);
            $("input[name=transportdate]").prop('required', false);
            $("input[name=transporttime]").prop('required', false);
            $("input[name=transportcalendarTitle]").prop('required', false);
        }
    })

    lagerungbutton.click(function() {
        if ($(this).hasClass("checkbox-checked")) {
            $(".lagerung--area").show(300);
            $("input[name=lagerungdate]").prop('required', true);
            $("input[name=lagerungtime]").prop('required', true);
            $("input[name=lagerungcalendarTitle]").prop('required', true);
        } else {
            $(".lagerung--area").hide(300);
            $("input[name=lagerungdate]").prop('required', false);
            $("input[name=lagerungtime]").prop('required', false);
            $("input[name=lagerungcalendarTitle]").prop('required', false);
        }
    })
</script>

{{-- Title Oto Doldurma --}}
<script>
    
    let umzugTitle = $('input[name=umzug1calendarTitle]').val();
    // Umzug / Herr Ali Yurdakul +41 76 399 50 02 / 4 MA 2 LW ca. 7-8 Std / 08:00 Uhr
    $('body').on('change','.umzug--area',function(){
        let serviceName = 'Umzug';
        let gender = '';
        let genderType = '{{ $data['gender'] }}';
        let hours,ma,lkw,time;
        if(genderType == 'male')
        {
            gender = 'Herr'
        }
        else{
            gender = 'Frau'
        }
        let name = '{{ $data['name'] }}';
        let surname = '{{ $data['surname'] }}';
        let mobile = '{{ $data['mobile'] }}';
        if($('input[name=umzug1hours]').val()){ hours = $('input[name=umzug1hours]').val()+' '+'Std'}else{ hours = ''}
        if($('input[name=umzug1ma]').val()){  ma = $('input[name=umzug1ma]').val()+' '+'MA';} else { ma = ''}
        if($('input[name=umzug1lkw]').val()){  lkw = $('input[name=umzug1lkw]').val()+' '+'LW ca.';}else{ lkw = ''}
        if($('input[name=umzug1time]').val()){  time = $('input[name=umzug1time]').val()+' '+'Uhr';}else{ time = ''}
      
        let newTitle = serviceName+' '+'/'+' '+gender+' '+name+' '+surname+' '+mobile+' '+'/'+' '+ma+' '+lkw+' '+hours+' '+'/'+' '+time;

        if(newTitle !== umzugTitle) { // only update if the new title is different
            $('input[name=umzug1calendarTitle]').val(newTitle);
            umzugTitle = newTitle; // save the new title
        }
    })
    
</script>
{{-- Email Ayarları --}}
<script>
    var morebutton = $("div.email-send");
    morebutton.click(function() {
        if ($(this).hasClass("checkbox-checked")) {
            $(".email--area").show(700);
        } else {
            $(".email--area").hide(500);
        }
    })
</script>

{{-- Custom Email Format Ayarlamaları --}}
<script>
    var emailFormatbutton = $("div.email-format");
    emailFormatbutton.click(function() {
        if ($(this).hasClass("checkbox-checked")) {
            $(".email--format").show(700);
        } else {
            $(".email--format").hide(500);
        }
    })
</script>

{{-- Randevu Tipi Ayarları --}}
<script>
    $(".appointment-type").click(function() {
        var value = $(this).val();
        switch (value) {
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
        if (value == 0) {
            $(".deliveryType--area").show(500);
        } else {
            $(".deliveryType--area").hide(300);
        }
    });
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
    var valueZ = $("input[name=appType]:checked").val();
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

        if (valueZ == 1) {
            $("body").on("change", ".widget-body", function() {
                let dateArray = [];
                var tarih1 = $('input[name=date]').val();
                dateArray.some(function(entry) {
                    if (entry.name == "<b>Besichtigung:</b> ") {
                        found = entry;
                        dateArray.splice(found);
                    }
                });
                if(tarih1!=""){
                    dateArray.push({
                    name: '<b>Besichtigung:</b> ',
                    date: momentConvertValue(tarih1)
                    })
                }
                var requestDate = "";
                for (var i = 0; i <= dateArray.length - 1; i++) {
                    requestDate += dateArray[i].name + " " + dateArray[i].date + "<br>";
                }
                tinymce.get("customEmail").setContent(`@include('../../cemail', ['date' => '${requestDate}'])`);
                tinymce.execCommand("mceRepaint");
            });
        }

        if (valueZ == 2) {
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

        if (valueZ == 3) {
            $("body").on("change", ".widget-body", function() {
                let dateArray = [];
                var tarih1 = $('input[name=meetingDate]').val();
                dateArray3.some(function(entry) {
                    if (entry.name == "<b>Lieferung:</b> ") {
                        found = entry;
                        dateArray.splice(found);
                    }
                });
                if(tarih1!=""){
                    dateArray3.push({
                    name: '<b>Lieferung:</b> ',
                    date: momentConvertValue(tarih1)
                    })
                }
                var requestDate = "";
                for (var i = 0; i <= dateArray3.length - 1; i++) {
                    requestDate += dateArray3[i].name + " " + dateArray3[i].date + "<br>";
                }
                tinymce.get("customEmail").setContent(`@include('../../cemail', ['date' => '${requestDate}'])`);
                tinymce.execCommand("mceRepaint");
            });
        }
    }
</script>
@endsection
