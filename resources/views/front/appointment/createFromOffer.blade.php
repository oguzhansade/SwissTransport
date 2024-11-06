@extends('layouts.app')
@section('header')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>

    .default:before{
        border-color: #039be5!important;
    }
    .default:after {
        background: #039be5!important;
    }
    .lavender:before{
        border-color: #7986CB!important;
    }
    .lavender:after {
        background: #7986CB!important;
    }

    .sage:before{
        border-color: #33b679!important;
    }
    .sage:after {
        background: #33b679!important;
    }

    .grape:before{
        border-color: #8e24aa!important;
    }
    .grape:after {
        background: #8e24aa!important;
    }

    .flamingo:before{
        border-color: #e67c73!important;
    }
    .flamingo:after {
        background: #e67c73!important;
    }
    .banana:before{
        border-color: #f6c026!important;
    }
    .banana:after {
        background: #f6c026!important;
    }

    .tangerine:before{
        border-color: #f5511d!important;
    }
    .tangerine:after {
        background: #f5511d!important;
    }

    .peacock:before{
        border-color: #039be5!important;
    }
    .peacock:after {
        background: #039be5!important;
    }

    .graphite:before{
        border-color: #616161!important;
    }
    .graphite:after {
        background: #616161!important;
    }

    .blueberry:before{
        border-color: #3f51b5!important;
    }
    .blueberry:after {
        background: #3f51b5!important;
    }

    .basil:before{
        border-color: #0b8043!important;
    }
    .basil:after {
        background: #0b8043!important;
    }

    .tomato:before{
        border-color: #d60000!important;
    }
    .tomato:after {
        background: #d60000!important;
    }
    </style>
@endsection
@section('content')
@section('sidebarType')
    sidebar-collapse
@endsection

<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Termin</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Panel</a>
            </li>
            <li class="breadcrumb-item active">Termin</li>
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
                                <div>
                                    <input type="text" name="offerId" value="{{ $offer['id'] }}" hidden>
                                    <label for="" class="col-form-label">Offerten Nr.</label>
                                    <a href="{{ route('offer.detail', ['id' => $offer['id']]) }}"
                                        class="col-form-label text-underline">{{ $offer['id'] }}</a>
                                </div>

                                <label for="" class="col-form-label">Art</label>
                                <div class="radiobox">
                                    <label>
                                        <input type="radio" class="appointment-type" name="appType" value="1">
                                        <span class="label-text">Besichtigung</span>
                                    </label>
                                </div>

                                <div class="radiobox">
                                    <label>
                                        <input type="radio" class="appointment-type" name="appType" value="2"
                                            checked> <span class="label-text">Auftragsbestätigung</span>
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
                        <div class="confirmation--area" style="display: block;">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="" class="col-form-label">Payment Type</label><br>
                                    <select class="form-control" name="paymentType" id="paymentType">
                                        <option value="0">Bar</option>
                                        <option value="1">Rechnung</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Umzug Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 umzug-control">
                                    <label for="" class="col-form-label">Umzug</label><br>
                                    <input type="checkbox" name="isUmzug" id="isUmzug" class="js-switch"
                                        data-size="small" data-color="#286090" data-switchery="false"
                                        @if ($offer['offerteUmzugId']) checked @endif>
                                </div>
                            </div>
                            {{-- Umzug Alanı Kontrolü Bitiş --}}

                            {{-- Umzug Alanı --}}
                            <div class="form-group row umzug--area"
                                @if ($offer['offerteUmzugId'] == null) style="display: none;" @endif>
                                {{-- 1.Umzug Alanı Başlangıç --}}
                                <div class="form-group row umzug-area">
                                    <div class="col-md-6">
                                        <label class=" col-form-label" for="l0">Umzugstermin Am</label>
                                        <input class="form-control" class="date" id="umzug1date" name="umzug1date"
                                            type="date"
                                            @if ($offer['offerteUmzugId'] && \App\Models\OfferteUmzug::InfoUmzug($offer['offerteUmzugId'], 'moveDate')) value="{{ \App\Models\OfferteUmzug::InfoUmzug($offer['offerteUmzugId'], 'moveDate') }}" @endif>
                                    </div>

                                    <div class="col-md-6">
                                        <label class=" col-form-label" for="l0">Umzugstermin Stunde</label>
                                        <input class="form-control" name="umzug1time" type="time"
                                            @if ($offer['offerteUmzugId'] && \App\Models\OfferteUmzug::InfoUmzug($offer['offerteUmzugId'], 'moveTime')) value="{{ \App\Models\OfferteUmzug::InfoUmzug($offer['offerteUmzugId'], 'moveTime') }}" @endif>
                                    </div>

                                    <div class="w-100 row rounded p-1 mt-1" style="background-color:  #C8DFF3;">
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">Dauer [h]</label>
                                            <input class="form-control" name="umzug1hours" placeholder="4-5" type="text"
                                                @if ($offer['offerteUmzugId'] && \App\Models\OfferteUmzug::InfoUmzug($offer['offerteUmzugId'], 'moveHours')) value="{{ \App\Models\OfferteUmzug::InfoUmzug($offer['offerteUmzugId'], 'moveHours') }}" @endif>
                                        </div>
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">MA</label>
                                            <input class="form-control" name="umzug1ma" placeholder="0" type="number"
                                                @if ($offer['offerteUmzugId'] && \App\Models\OfferteUmzug::InfoUmzug($offer['offerteUmzugId'], 'ma')) value="{{ \App\Models\OfferteUmzug::InfoUmzug($offer['offerteUmzugId'], 'ma') }}" @endif>
                                        </div>
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">LKW</label>
                                            <input class="form-control" name="umzug1lkw" placeholder="0" type="number"
                                                @if ($offer['offerteUmzugId'] && \App\Models\OfferteUmzug::InfoUmzug($offer['offerteUmzugId'], 'lkw')) value="{{ \App\Models\OfferteUmzug::InfoUmzug($offer['offerteUmzugId'], 'lkw') }}" @else value="0" @endif>
                                        </div>
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">Anhänger</label>
                                            <input class="form-control" name="umzug1anhanger" placeholder="0"
                                                type="number"
                                                @if ($offer['offerteUmzugId'] && \App\Models\OfferteUmzug::InfoUmzug($offer['offerteUmzugId'], 'anhanger')) value="{{ \App\Models\OfferteUmzug::InfoUmzug($offer['offerteUmzugId'], 'anhanger') }}"
                                             @else value="{{ 0 }}" @endif>
                                        </div>
                                    </div>


                                    <div class="row w-100 rounded p-1 mt-1" style="background-color:  #C8DFF3;">
                                        <div class="col-md-4">
                                            <label class=" col-form-label" for="l0">CalendarTitle</label>
                                            <input class="form-control" name="umzug1calendarTitle"
                                                placeholder="gender/name/surname/telefon" type="text" value="@if($data['companyName']) {{ $data['companyName'] }} @endif / @if($data['gender'] == 'male') Herr @else Frau @endif {{ $data['name'] }} {{ $data['surname'] }} / {{ $data['mobile'] }}">
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


                                    <div class="row w-100 rounded p-1 mt-1 d-flex justify-content-center align-items-center">
                                        <div class="col-md-12 d-flex justify-content-center align-items-center">
                                            <label class=" col-form-label " ><strong>CalendarColors</strong></label>
                                        </div>

                                        <div class="radiobox colors">
                                            <label class="mt-1 ">
                                                <input type="radio" class=""  name="calendarUmzugColor" value="15"
                                                    > <span
                                                    class="label-text pl-4 ml-1 col-form-label default">Default</span>
                                            </label>
                                            <label class="mt-1 ">
                                                <input type="radio"  name="calendarUmzugColor" value="1"> <span
                                                    class="label-text pl-4 ml-1 col-form-label lavender">Lavender</span>
                                            </label>
                                            <label class="mt-1 ">
                                                <input type="radio"  name="calendarUmzugColor" value="2"> <span
                                                    class="label-text pl-4 ml-1 col-form-label sage">Sage</span>
                                            </label>
                                            <label class="mt-1 ">
                                                <input type="radio"  name="calendarUmzugColor" value="3"> <span
                                                    class="label-text pl-4 ml-1 col-form-label grape">Grape</span>
                                            </label>
                                            <label class="mt-1 ">
                                                <input type="radio"  name="calendarUmzugColor" value="4"> <span
                                                    class="label-text pl-4 ml-1 col-form-label flamingo">Flamingo</span>
                                            </label>
                                            <label class="mt-1 ">
                                                <input type="radio"  name="calendarUmzugColor" value="5"> <span
                                                    class="label-text pl-4 ml-1 col-form-label banana">Banana</span>
                                            </label>
                                            <label class="mt-1 red">
                                                <input type="radio"  name="calendarUmzugColor" value="6"> <span
                                                    class="label-text pl-4 ml-1 col-form-label tangerine">Tangerine</span>
                                            </label>
                                            <label class="mt-1 red">
                                                <input type="radio"  name="calendarUmzugColor" value="7"> <span
                                                    class="label-text pl-4 ml-1 col-form-label peacock">Peacock</span>
                                            </label>
                                            <label class="mt-1 red">
                                                <input type="radio"  name="calendarUmzugColor" value="8"> <span
                                                    class="label-text pl-4 ml-1 col-form-label graphite">Graphite</span>
                                            </label>
                                            <label class="mt-1 red">
                                                <input type="radio"  name="calendarUmzugColor" value="9"> <span
                                                    class="label-text pl-4 ml-1 col-form-label blueberry">Blueberry</span>
                                            </label>
                                            <label class="mt-1 red">
                                                <input type="radio"  name="calendarUmzugColor" value="10" checked="checked"> <span
                                                    class="label-text pl-4 ml-1 col-form-label basil">Basil</span>
                                            </label>
                                            <label class="mt-1 red">
                                                <input type="radio"  name="calendarUmzugColor" value="11"> <span
                                                    class="label-text pl-4 ml-1 col-form-label tomato">Tomato</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{-- 1.Umzug Alanı Bitiş --}}

                                {{-- 2.Umzug Alanı Kontrolü --}}
                                <div class="col-md-12 umzug-control2">
                                    <label for="" class="col-form-label">Weitere Umzugstermine</label><br>
                                    <input type="checkbox" name="isUmzug2" id="isUmzug2" class="js-switch"
                                        data-size="small" data-color="#286090" data-switchery="false">
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

                                    <div class="w-100 row rounded p-1 mt-1" style="background-color:  #C8DFF3;">
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
                                                type="number" value="0">
                                        </div>
                                        <div class="col-md-3">
                                            <label class=" col-form-label" for="l0">Anhänger</label>
                                            <input class="form-control" name="umzug2anhanger" placeholder="0"
                                                type="number">
                                        </div>
                                    </div>

                                    <div class="row w-100 rounded p-1 mt-1" style="background-color:  #C8DFF3;">
                                        <div class="col-md-4">
                                            <label class=" col-form-label" for="l0">CalendarTitle</label>
                                            <input class="form-control" name="umzug2calendarTitle"
                                                placeholder="CalendarTitle" type="text" value="@if($data['companyName']) {{ $data['companyName'] }} @endif / @if($data['gender'] == 'male') Herr @else Frau @endif {{ $data['name'] }} {{ $data['surname'] }} / {{ $data['mobile'] }}">
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

                                    <div class="row w-100 rounded p-1 mt-1 d-flex justify-content-center align-items-center">
                                        <div class="col-md-12 d-flex justify-content-center align-items-center">
                                            <label class=" col-form-label " ><strong>CalendarColors</strong></label>
                                        </div>

                                        <div class="radiobox colors">
                                            <label class="mt-1 ">
                                                <input type="radio" class=""  name="calendarUmzug2Color" value="15"
                                                    > <span
                                                    class="label-text pl-4 ml-1 col-form-label default">Default</span>
                                            </label>
                                            <label class="mt-1 ">
                                                <input type="radio"  name="calendarUmzug2Color" value="1"> <span
                                                    class="label-text pl-4 ml-1 col-form-label lavender">Lavender</span>
                                            </label>
                                            <label class="mt-1 ">
                                                <input type="radio"  name="calendarUmzug2Color" value="2"> <span
                                                    class="label-text pl-4 ml-1 col-form-label sage">Sage</span>
                                            </label>
                                            <label class="mt-1 ">
                                                <input type="radio"  name="calendarUmzug2Color" value="3"> <span
                                                    class="label-text pl-4 ml-1 col-form-label grape">Grape</span>
                                            </label>
                                            <label class="mt-1 ">
                                                <input type="radio"  name="calendarUmzug2Color" value="4"> <span
                                                    class="label-text pl-4 ml-1 col-form-label flamingo">Flamingo</span>
                                            </label>
                                            <label class="mt-1 ">
                                                <input type="radio"  name="calendarUmzug2Color" value="5"> <span
                                                    class="label-text pl-4 ml-1 col-form-label banana">Banana</span>
                                            </label>
                                            <label class="mt-1 red">
                                                <input type="radio"  name="calendarUmzug2Color" value="6"> <span
                                                    class="label-text pl-4 ml-1 col-form-label tangerine">Tangerine</span>
                                            </label>
                                            <label class="mt-1 red">
                                                <input type="radio"  name="calendarUmzug2Color" value="7"> <span
                                                    class="label-text pl-4 ml-1 col-form-label peacock">Peacock</span>
                                            </label>
                                            <label class="mt-1 red">
                                                <input type="radio"  name="calendarUmzug2Color" value="8"> <span
                                                    class="label-text pl-4 ml-1 col-form-label graphite">Graphite</span>
                                            </label>
                                            <label class="mt-1 red">
                                                <input type="radio"  name="calendarUmzug2Color" value="9"> <span
                                                    class="label-text pl-4 ml-1 col-form-label blueberry">Blueberry</span>
                                            </label>
                                            <label class="mt-1 red">
                                                <input type="radio"  name="calendarUmzug2Color" value="10" checked="checked"> <span
                                                    class="label-text pl-4 ml-1 col-form-label basil">Basil</span>
                                            </label>
                                            <label class="mt-1 red">
                                                <input type="radio"  name="calendarUmzug2Color" value="11"> <span
                                                    class="label-text pl-4 ml-1 col-form-label tomato">Tomato</span>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                                {{-- 2.Umzug Alanı Bitiş --}}

                                {{-- 3.Umzug Alanı Başlangıç --}}
                                <div class="form-group row w-100 umzug--area2" style="display: none;">
                                    <div class="form-group row w-100 umzug--area3">
                                        <div class="col-md-6">
                                            <label class=" col-form-label" for="l0">Umzugstermin 3 Am</label>
                                            <input class="form-control" class="date" name="umzug3date" type="date">
                                        </div>

                                        <div class="col-md-6">
                                            <label class=" col-form-label" for="l0">Umzugstermin 3 Stunde</label>
                                            <input class="form-control" name="umzug3time" type="time">
                                        </div>

                                        <div class="w-100 row rounded p-1 mt-1" style="background-color:  #C8DFF3;">
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
                                                    type="number" value="0">
                                            </div>
                                            <div class="col-md-3">
                                                <label class=" col-form-label" for="l0">Anhänger</label>
                                                <input class="form-control" name="umzug3anhanger" placeholder="0"
                                                    type="number">
                                            </div>
                                        </div>

                                        <div class="row w-100 rounded p-1 mt-1" style="background-color:  #C8DFF3;">
                                            <div class="col-md-4">
                                                <label class=" col-form-label" for="l0">CalendarTitle</label>
                                                <input class="form-control" name="umzug3calendarTitle"
                                                    placeholder="CalendarTitle" type="text" value="@if($data['companyName']) {{ $data['companyName'] }} @endif / @if($data['gender'] == 'male') Herr @else Frau @endif {{ $data['name'] }} {{ $data['surname'] }} / {{ $data['mobile'] }}">
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
                                        <div class="row w-100 rounded p-1 mt-1 d-flex justify-content-center align-items-center">
                                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                                <label class=" col-form-label " ><strong>CalendarColors</strong></label>
                                            </div>

                                            <div class="radiobox colors">
                                                <label class="mt-1 ">
                                                    <input type="radio" class=""  name="calendarUmzug3Color" value="15"
                                                        > <span
                                                        class="label-text pl-4 ml-1 col-form-label default">Default</span>
                                                </label>
                                                <label class="mt-1 ">
                                                    <input type="radio"  name="calendarUmzug3Color" value="1"> <span
                                                        class="label-text pl-4 ml-1 col-form-label lavender">Lavender</span>
                                                </label>
                                                <label class="mt-1 ">
                                                    <input type="radio"  name="calendarUmzug3Color" value="2"> <span
                                                        class="label-text pl-4 ml-1 col-form-label sage">Sage</span>
                                                </label>
                                                <label class="mt-1 ">
                                                    <input type="radio"  name="calendarUmzug3Color" value="3"> <span
                                                        class="label-text pl-4 ml-1 col-form-label grape">Grape</span>
                                                </label>
                                                <label class="mt-1 ">
                                                    <input type="radio"  name="calendarUmzug3Color" value="4"> <span
                                                        class="label-text pl-4 ml-1 col-form-label flamingo">Flamingo</span>
                                                </label>
                                                <label class="mt-1 ">
                                                    <input type="radio"  name="calendarUmzug3Color" value="5"> <span
                                                        class="label-text pl-4 ml-1 col-form-label banana">Banana</span>
                                                </label>
                                                <label class="mt-1 red">
                                                    <input type="radio"  name="calendarUmzug3Color" value="6"> <span
                                                        class="label-text pl-4 ml-1 col-form-label tangerine">Tangerine</span>
                                                </label>
                                                <label class="mt-1 red">
                                                    <input type="radio"  name="calendarUmzug3Color" value="7"> <span
                                                        class="label-text pl-4 ml-1 col-form-label peacock">Peacock</span>
                                                </label>
                                                <label class="mt-1 red">
                                                    <input type="radio"  name="calendarUmzug3Color" value="8"> <span
                                                        class="label-text pl-4 ml-1 col-form-label graphite">Graphite</span>
                                                </label>
                                                <label class="mt-1 red">
                                                    <input type="radio"  name="calendarUmzug3Color" value="9"> <span
                                                        class="label-text pl-4 ml-1 col-form-label blueberry">Blueberry</span>
                                                </label>
                                                <label class="mt-1 red">
                                                    <input type="radio"  name="calendarUmzug3Color" value="10" checked="checked"> <span
                                                        class="label-text pl-4 ml-1 col-form-label basil">Basil</span>
                                                </label>
                                                <label class="mt-1 red">
                                                    <input type="radio"  name="calendarUmzug3Color" value="11"> <span
                                                        class="label-text pl-4 ml-1 col-form-label tomato">Tomato</span>
                                                </label>
                                            </div>
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
                                        class="js-switch" data-size="small" data-color="#286090"
                                        data-switchery="false" @if ($offer['offerteEinpackId']) checked @endif>
                                </div>
                            </div>
                            {{-- Einpackservice Alanı Kontrolü Bitiş --}}

                            {{-- Einpackservice Alanı Başlangıç --}}
                            <div class="form-group row einpackservice--area"
                                @if ($offer['offerteEinpackId'] == null) style="display: none;" @endif>
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Packtermin Am</label>
                                    <input class="form-control" class="date" name="einpackdate" type="date"
                                        @if ($offer['offerteEinpackId'] && \App\Models\OfferteEinpack::InfoEinpack($offer['offerteEinpackId'], 'einpackDate')) value="{{ \App\Models\OfferteEinpack::InfoEinpack($offer['offerteEinpackId'], 'einpackDate') }}" @endif>
                                </div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Packtermin Stunde</label>
                                    <input class="form-control" name="einpacktime" type="time"
                                        @if ($offer['offerteEinpackId'] && \App\Models\OfferteEinpack::InfoEinpack($offer['offerteEinpackId'], 'einpackTime')) value="{{ \App\Models\OfferteEinpack::InfoEinpack($offer['offerteEinpackId'], 'einpackTime') }}" @endif>
                                </div>

                                <div class="w-100 row rounded p-1 mt-3" style="background-color:  #C8DFF3;">
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Dauer [h]</label>
                                        <input class="form-control" class="einpacksuresi" id="einpacksuresi"
                                            aria-required="" name="einpackhours" placeholder="4-5" type="text"
                                            @if ($offer['offerteEinpackId'] && \App\Models\OfferteEinpack::InfoEinpack($offer['offerteEinpackId'], 'moveHours')) value="{{ \App\Models\OfferteEinpack::InfoEinpack($offer['offerteEinpackId'], 'moveHours') }}" @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">MA</label>
                                        <input class="form-control" name="einpackma" placeholder="0" type="number"
                                            @if ($offer['offerteEinpackId'] && \App\Models\OfferteEinpack::InfoEinpack($offer['offerteEinpackId'], 'ma')) value="{{ \App\Models\OfferteEinpack::InfoEinpack($offer['offerteEinpackId'], 'ma') }}" @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">LKW</label>
                                        <input class="form-control" name="einpacklkw" placeholder="0" type="number"
                                            value="0">
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Anhänger</label>
                                        <input class="form-control" name="einpackanhanger" placeholder="0"
                                            type="number" value="0">
                                    </div>
                                </div>

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #C8DFF3;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control" name="einpackcalendarTitle"
                                            placeholder="CalendarTitle" type="text" value="@if($data['companyName']) {{ $data['companyName'] }} @endif / @if($data['gender'] == 'male') Herr @else Frau @endif {{ $data['name'] }} {{ $data['surname'] }} / {{ $data['mobile'] }}">
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

                                <div class="row w-100 rounded p-1 mt-1 d-flex justify-content-center align-items-center">
                                    <div class="col-md-12 d-flex justify-content-center align-items-center">
                                        <label class=" col-form-label " ><strong>CalendarColors</strong></label>
                                    </div>

                                    <div class="radiobox colors">
                                        <label class="mt-1 ">
                                            <input type="radio" class=""  name="calendarEinpackColor" value="15"
                                                > <span
                                                class="label-text pl-4 ml-1 col-form-label default">Default</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarEinpackColor" value="1"> <span
                                                class="label-text pl-4 ml-1 col-form-label lavender">Lavender</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarEinpackColor" value="2"> <span
                                                class="label-text pl-4 ml-1 col-form-label sage">Sage</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarEinpackColor" value="3"> <span
                                                class="label-text pl-4 ml-1 col-form-label grape">Grape</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarEinpackColor" value="4"> <span
                                                class="label-text pl-4 ml-1 col-form-label flamingo">Flamingo</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarEinpackColor" value="5"> <span
                                                class="label-text pl-4 ml-1 col-form-label banana">Banana</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarEinpackColor" value="6"> <span
                                                class="label-text pl-4 ml-1 col-form-label tangerine">Tangerine</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarEinpackColor" value="7"> <span
                                                class="label-text pl-4 ml-1 col-form-label peacock">Peacock</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarEinpackColor" value="8"> <span
                                                class="label-text pl-4 ml-1 col-form-label graphite">Graphite</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarEinpackColor" value="9"> <span
                                                class="label-text pl-4 ml-1 col-form-label blueberry">Blueberry</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarEinpackColor" value="10" checked="checked"> <span
                                                class="label-text pl-4 ml-1 col-form-label basil">Basil</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarEinpackColor" value="11"> <span
                                                class="label-text pl-4 ml-1 col-form-label tomato">Tomato</span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            {{-- Einpackservice Alanı Bitiş --}}


                            {{-- Auspackservice Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 auspackservice-control">
                                    <label for="" class="col-form-label">Auspackservice</label><br>
                                    <input type="checkbox" name="isAuspackservice" id="isAuspackservice"
                                        class="js-switch" data-size="small" data-color="#286090"
                                        data-switchery="false" @if ($offer['offerteAuspackId']) checked @endif>
                                </div>
                            </div>
                            {{-- Auspackservice Alanı Kontrolü Bitiş --}}

                            {{-- Auspackservice Alanı Başlangıç --}}
                            <div class="form-group row auspackservice--area"
                                @if ($offer['offerteAuspackId'] == null) style="display: none;" @endif>
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Packtermin Am</label>
                                    <input class="form-control" class="date" name="auspackdate" type="date"
                                        @if ($offer['offerteAuspackId'] && \App\Models\OfferteAuspack::InfoAuspack($offer['offerteAuspackId'], 'auspackDate')) value="{{ \App\Models\OfferteAuspack::InfoAuspack($offer['offerteAuspackId'], 'auspackDate') }}" @endif>
                                </div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Packtermin Stunde</label>
                                    <input class="form-control" name="auspacktime" type="time"
                                        @if ($offer['offerteAuspackId'] && \App\Models\OfferteAuspack::InfoAuspack($offer['offerteAuspackId'], 'auspackTime')) value="{{ \App\Models\OfferteAuspack::InfoAuspack($offer['offerteAuspackId'], 'auspackTime') }}" @endif>
                                </div>
                                <div class="row w-100  mt-1 pl-1 text-primary" style="font-style: italic;">Falls
                                    gleiches Datum wie Umzug, dann leer lassen.</div>

                                <div class="w-100 row rounded p-1 mt-3" style="background-color:  #C8DFF3;">
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Dauer [h]</label>
                                        <input class="form-control" class="auspacksuresi" id="auspacksuresi"
                                            aria-required="" name="auspackhours" placeholder="4-5" type="text"
                                            @if ($offer['offerteAuspackId'] && \App\Models\OfferteAuspack::InfoAuspack($offer['offerteAuspackId'], 'moveHours')) value="{{ \App\Models\OfferteAuspack::InfoAuspack($offer['offerteAuspackId'], 'moveHours') }}" @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">MA</label>
                                        <input class="form-control" name="auspackma" placeholder="0" type="number"
                                            @if ($offer['offerteAuspackId'] && \App\Models\OfferteAuspack::InfoAuspack($offer['offerteAuspackId'], 'ma')) value="{{ \App\Models\OfferteAuspack::InfoAuspack($offer['offerteAuspackId'], 'ma') }}" @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">LKW</label>
                                        <input class="form-control" name="auspacklkw" placeholder="0" type="number"
                                            value="0">
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Anhänger</label>
                                        <input class="form-control" name="auspackanhanger" placeholder="0"
                                            type="number" value="0">
                                    </div>
                                </div>

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #C8DFF3;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control" name="auspackcalendarTitle"
                                            placeholder="CalendarTitle" type="text" value="@if($data['companyName']) {{ $data['companyName'] }} @endif / @if($data['gender'] == 'male') Herr @else Frau @endif {{ $data['name'] }} {{ $data['surname'] }} / {{ $data['mobile'] }}">
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

                                <div class="row w-100 rounded p-1 mt-1 d-flex justify-content-center align-items-center">
                                    <div class="col-md-12 d-flex justify-content-center align-items-center">
                                        <label class=" col-form-label " ><strong>CalendarColors</strong></label>
                                    </div>

                                    <div class="radiobox colors">
                                        <label class="mt-1 ">
                                            <input type="radio" class=""  name="calendarAuspackColor" value="15"
                                                > <span
                                                class="label-text pl-4 ml-1 col-form-label default">Default</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarAuspackColor" value="1"> <span
                                                class="label-text pl-4 ml-1 col-form-label lavender">Lavender</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarAuspackColor" value="2"> <span
                                                class="label-text pl-4 ml-1 col-form-label sage">Sage</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarAuspackColor" value="3"> <span
                                                class="label-text pl-4 ml-1 col-form-label grape">Grape</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarAuspackColor" value="4"> <span
                                                class="label-text pl-4 ml-1 col-form-label flamingo">Flamingo</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarAuspackColor" value="5"> <span
                                                class="label-text pl-4 ml-1 col-form-label banana">Banana</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarAuspackColor" value="6"> <span
                                                class="label-text pl-4 ml-1 col-form-label tangerine">Tangerine</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarAuspackColor" value="7"> <span
                                                class="label-text pl-4 ml-1 col-form-label peacock">Peacock</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarAuspackColor" value="8"> <span
                                                class="label-text pl-4 ml-1 col-form-label graphite">Graphite</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarAuspackColor" value="9"> <span
                                                class="label-text pl-4 ml-1 col-form-label blueberry">Blueberry</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarAuspackColor" value="10" checked="checked"> <span
                                                class="label-text pl-4 ml-1 col-form-label basil">Basil</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarAuspackColor" value="11"> <span
                                                class="label-text pl-4 ml-1 col-form-label tomato">Tomato</span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            {{-- Auspackservice Alanı Bitiş --}}

                            {{-- Reinigung Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 reinigung-control">
                                    <label for="" class="col-form-label">Reinigung</label><br>
                                    <input type="checkbox" name="isReinigung" id="isReinigung" class="js-switch"
                                        data-size="small" data-color="#286090" data-switchery="false"
                                        @if ($offer['offerteReinigungId']) checked @endif>
                                </div>
                            </div>
                            {{-- Reinigung Alanı Kontrolü Bitiş --}}

                            {{-- Reinigung Alanı Başlangıç --}}
                            <div class="form-group row reinigung--area"
                                @if ($offer['offerteReinigungId'] == null) style="display: none;" @endif>
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Reinigungstermin Am</label>
                                    <input class="form-control" class="date" name="reinigung1Startdate"
                                        type="date"
                                        @if (
                                            $offer['offerteReinigungId'] &&
                                                \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'], 'startDate')) value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'], 'startDate') }}" @endif>
                                </div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Reinigungstermin Stunde</label>
                                    <input class="form-control" name="reinigung1Starttime" type="time"
                                        @if (
                                            $offer['offerteReinigungId'] &&
                                                \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'], 'startTime')) value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'], 'startTime') }}" @endif>
                                </div>
                                <div class="row w-100 mb-2  mt-1 pl-1 text-primary" style="font-style: italic;">Falls
                                    gleiches Datum wie Umzug, dann leer lassen.</div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Abgabetermin</label>
                                    <input class="form-control" class="date" name="reinigung1Enddate"
                                        type="date"
                                        @if (
                                            $offer['offerteReinigungId'] &&
                                                \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'], 'endDate')) value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'], 'endDate') }}" @endif>
                                </div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Abgabetermin Stunde</label>
                                    <input class="form-control" name="reinigung1Endtime" type="time"
                                        @if (
                                            $offer['offerteReinigungId'] &&
                                                \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'], 'endTime')) value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'], 'endTime') }}" @endif>
                                </div>

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #C8DFF3;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control" name="reinigungcalendarTitle"
                                            placeholder="CalendarTitle" type="text" value="@if($data['companyName']) {{ $data['companyName'] }} @endif / @if($data['gender'] == 'male') Herr @else Frau @endif {{ $data['name'] }} {{ $data['surname'] }} / {{ $data['mobile'] }}">
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

                                <div class="row w-100 rounded p-1 mt-1 d-flex justify-content-center align-items-center">
                                    <div class="col-md-12 d-flex justify-content-center align-items-center">
                                        <label class=" col-form-label " ><strong>CalendarColors</strong></label>
                                    </div>

                                    <div class="radiobox colors">
                                        <label class="mt-1 ">
                                            <input type="radio" class=""  name="calendarReinigungColor" value="15"
                                                > <span
                                                class="label-text pl-4 ml-1 col-form-label default">Default</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarReinigungColor" value="1"> <span
                                                class="label-text pl-4 ml-1 col-form-label lavender">Lavender</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarReinigungColor" value="2"> <span
                                                class="label-text pl-4 ml-1 col-form-label sage">Sage</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarReinigungColor" value="3"> <span
                                                class="label-text pl-4 ml-1 col-form-label grape">Grape</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarReinigungColor" value="4"> <span
                                                class="label-text pl-4 ml-1 col-form-label flamingo">Flamingo</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarReinigungColor" value="5"> <span
                                                class="label-text pl-4 ml-1 col-form-label banana">Banana</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarReinigungColor" value="6"> <span
                                                class="label-text pl-4 ml-1 col-form-label tangerine">Tangerine</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarReinigungColor" value="7"> <span
                                                class="label-text pl-4 ml-1 col-form-label peacock">Peacock</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarReinigungColor" value="8"> <span
                                                class="label-text pl-4 ml-1 col-form-label graphite">Graphite</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarReinigungColor" value="9"> <span
                                                class="label-text pl-4 ml-1 col-form-label blueberry">Blueberry</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarReinigungColor" value="10" checked="checked"> <span
                                                class="label-text pl-4 ml-1 col-form-label basil">Basil</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarReinigungColor" value="11"> <span
                                                class="label-text pl-4 ml-1 col-form-label tomato">Tomato</span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            {{-- Reinigung Alanı Bitiş --}}

                            {{-- 2.Reinigung Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 reinigung2-control">
                                    <label for="" class="col-form-label">Reinigung 2</label><br>
                                    <input type="checkbox" name="isReinigung2" id="isReinigung2" class="js-switch"
                                        data-size="small" data-color="#286090" data-switchery="false"
                                        @if ($offer['offerteReinigung2Id']) checked @endif>
                                </div>
                            </div>
                            {{-- 2.Reinigung Alanı Kontrolü Bitiş --}}

                            {{-- 2.Reinigung Alanı Başlangıç --}}
                            <div class="form-group row reinigung2--area"
                                @if ($offer['offerteReinigung2Id'] == null) style="display: none;" @endif>
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Reinigungstermin 2 Am</label>
                                    <input class="form-control" class="date" name="reinigung2Startdate"
                                        type="date"
                                        @if (
                                            $offer['offerteReinigung2Id'] &&
                                                \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigung2Id'], 'startDate')) value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigung2Id'], 'startDate') }}" @endif>
                                </div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Reinigungstermin 2 Stunde</label>
                                    <input class="form-control" name="reinigung2Starttime" type="time"
                                        @if (
                                            $offer['offerteReinigung2Id'] &&
                                                \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigung2Id'], 'startTime')) value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigung2Id'], 'startTime') }}" @endif>
                                </div>
                                <div class="row w-100 mb-2  mt-1 pl-1 text-primary" style="font-style: italic;">Falls
                                    gleiches Datum wie Umzug, dann leer lassen.</div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Abgabetermin</label>
                                    <input class="form-control" class="date" name="reinigung2Enddate"
                                        type="date"
                                        @if (
                                            $offer['offerteReinigung2Id'] &&
                                                \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigung2Id'], 'endDate')) value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigung2Id'], 'endDate') }}" @endif>
                                </div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Abgabetermin Stunde</label>
                                    <input class="form-control" name="reinigung2Endtime" type="time"
                                        @if (
                                            $offer['offerteReinigung2Id'] &&
                                                \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigung2Id'], 'endTime')) value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigung2Id'], 'endTime') }}" @endif>
                                </div>

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #C8DFF3;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control" name="reinigung2calendarTitle"
                                            placeholder="CalendarTitle" type="text" value="@if($data['companyName']) {{ $data['companyName'] }} @endif / @if($data['gender'] == 'male') Herr @else Frau @endif {{ $data['name'] }} {{ $data['surname'] }} / {{ $data['mobile'] }}">
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

                                <div class="row w-100 rounded p-1 mt-1 d-flex justify-content-center align-items-center">
                                    <div class="col-md-12 d-flex justify-content-center align-items-center">
                                        <label class=" col-form-label " ><strong>CalendarColors</strong></label>
                                    </div>

                                    <div class="radiobox colors">
                                        <label class="mt-1 ">
                                            <input type="radio" class=""  name="calendarReinigung2Color" value="15"
                                                > <span
                                                class="label-text pl-4 ml-1 col-form-label default">Default</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarReinigung2Color" value="1"> <span
                                                class="label-text pl-4 ml-1 col-form-label lavender">Lavender</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarReinigung2Color" value="2"> <span
                                                class="label-text pl-4 ml-1 col-form-label sage">Sage</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarReinigung2Color" value="3"> <span
                                                class="label-text pl-4 ml-1 col-form-label grape">Grape</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarReinigung2Color" value="4"> <span
                                                class="label-text pl-4 ml-1 col-form-label flamingo">Flamingo</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarReinigung2Color" value="5"> <span
                                                class="label-text pl-4 ml-1 col-form-label banana">Banana</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarReinigung2Color" value="6"> <span
                                                class="label-text pl-4 ml-1 col-form-label tangerine">Tangerine</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarReinigung2Color" value="7"> <span
                                                class="label-text pl-4 ml-1 col-form-label peacock">Peacock</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarReinigung2Color" value="8"> <span
                                                class="label-text pl-4 ml-1 col-form-label graphite">Graphite</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarReinigung2Color" value="9"> <span
                                                class="label-text pl-4 ml-1 col-form-label blueberry">Blueberry</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarReinigung2Color" value="10" checked="checked"> <span
                                                class="label-text pl-4 ml-1 col-form-label basil">Basil</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarReinigung2Color" value="11"> <span
                                                class="label-text pl-4 ml-1 col-form-label tomato">Tomato</span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            {{-- 2.Reinigung Alanı Bitiş --}}

                            {{-- Entsorgung Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 entsorgung-control">
                                    <label for="" class="col-form-label">Entsorgung</label><br>
                                    <input type="checkbox" name="isEntsorgung" id="isEntsorgung" class="js-switch"
                                        data-size="small" data-color="#286090" data-switchery="false"
                                        @if ($offer['offerteEntsorgungId']) checked @endif>
                                </div>
                            </div>
                            {{-- Entsorgung Alanı Kontrolü Bitiş --}}

                            {{-- Entsorgung Alanı Başlangıç --}}
                            <div class="form-group row entsorgung--area"
                                @if ($offer['offerteEntsorgungId'] == null) style="display: none;" @endif>
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Entsorgungstermin Am</label>
                                    <input class="form-control" class="date" name="entsorgungdate" type="date"
                                        @if (
                                            $offer['offerteEntsorgungId'] &&
                                                \App\Models\OfferteEntsorgung::InfoEntsorgung($offer['offerteEntsorgungId'], 'entsorgungDate')) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($offer['offerteEntsorgungId'], 'entsorgungDate') }}" @endif>
                                </div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Entsorgungstermin Stunde</label>
                                    <input class="form-control" name="entsorgungtime" type="time"
                                        @if (
                                            $offer['offerteEntsorgungId'] &&
                                                \App\Models\OfferteEntsorgung::InfoEntsorgung($offer['offerteEntsorgungId'], 'entsorgungTime')) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($offer['offerteEntsorgungId'], 'entsorgungTime') }}" @endif>
                                </div>

                                <div class="w-100 row rounded p-1 mt-3" style="background-color:  #C8DFF3;">
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Dauer [h]</label>
                                        <input class="form-control" class="entsorgungsuresi" id="entsorgungsuresi"
                                            aria-required="" name="entsorgunghours" placeholder="4-5" type="text"
                                            @if (
                                                $offer['offerteEntsorgungId'] &&
                                                    \App\Models\OfferteEntsorgung::InfoEntsorgung($offer['offerteEntsorgungId'], 'hour')) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($offer['offerteEntsorgungId'], 'hour') }}" @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">MA</label>
                                        <input class="form-control" name="entsorgungma" placeholder="0"
                                            type="number"
                                            @if ($offer['offerteEntsorgungId'] && \App\Models\OfferteEntsorgung::InfoEntsorgung($offer['offerteEntsorgungId'], 'ma')) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($offer['offerteEntsorgungId'], 'ma') }}" @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">LKW</label>
                                        <input class="form-control" name="entsorgunglkw" placeholder="0"
                                            type="number"
                                            @if (
                                                $offer['offerteEntsorgungId'] &&
                                                    \App\Models\OfferteEntsorgung::InfoEntsorgung($offer['offerteEntsorgungId'], 'lkw')) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($offer['offerteEntsorgungId'], 'lkw') }}" @else value="0" @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Anhänger</label>
                                        <input class="form-control" name="entsorgunganhanger" placeholder="0"
                                            type="number"
                                            @if (
                                                $offer['offerteEntsorgungId'] &&
                                                    \App\Models\OfferteEntsorgung::InfoEntsorgung($offer['offerteEntsorgungId'], 'anhanger')) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($offer['offerteEntsorgungId'], 'anhanger') }}" @endif>
                                    </div>
                                </div>

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #C8DFF3;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control" name="entsorgungcalendarTitle"
                                            placeholder="CalendarTitle" type="text" value="@if($data['companyName']) {{ $data['companyName'] }} @endif / @if($data['gender'] == 'male') Herr @else Frau @endif {{ $data['name'] }} {{ $data['surname'] }} / {{ $data['mobile'] }}">
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

                                <div class="row w-100 rounded p-1 mt-1 d-flex justify-content-center align-items-center">
                                    <div class="col-md-12 d-flex justify-content-center align-items-center">
                                        <label class=" col-form-label " ><strong>CalendarColors</strong></label>
                                    </div>

                                    <div class="radiobox colors">
                                        <label class="mt-1 ">
                                            <input type="radio" class=""  name="calendarEntsorgungColor" value="15"
                                                > <span
                                                class="label-text pl-4 ml-1 col-form-label default">Default</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarEntsorgungColor" value="1"> <span
                                                class="label-text pl-4 ml-1 col-form-label lavender">Lavender</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarEntsorgungColor" value="2"> <span
                                                class="label-text pl-4 ml-1 col-form-label sage">Sage</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarEntsorgungColor" value="3"> <span
                                                class="label-text pl-4 ml-1 col-form-label grape">Grape</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarEntsorgungColor" value="4"> <span
                                                class="label-text pl-4 ml-1 col-form-label flamingo">Flamingo</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarEntsorgungColor" value="5"> <span
                                                class="label-text pl-4 ml-1 col-form-label banana">Banana</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarEntsorgungColor" value="6"> <span
                                                class="label-text pl-4 ml-1 col-form-label tangerine">Tangerine</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarEntsorgungColor" value="7"> <span
                                                class="label-text pl-4 ml-1 col-form-label peacock">Peacock</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarEntsorgungColor" value="8"> <span
                                                class="label-text pl-4 ml-1 col-form-label graphite">Graphite</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarEntsorgungColor" value="9"> <span
                                                class="label-text pl-4 ml-1 col-form-label blueberry">Blueberry</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarEntsorgungColor" value="10" checked="checked"> <span
                                                class="label-text pl-4 ml-1 col-form-label basil">Basil</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarEntsorgungColor" value="11"> <span
                                                class="label-text pl-4 ml-1 col-form-label tomato">Tomato</span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            {{-- Entsorgung Alanı Bitiş --}}

                            {{-- Transport Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 transport-control">
                                    <label for="" class="col-form-label">Transport</label><br>
                                    <input type="checkbox" name="isTransport" id="isTransport" class="js-switch"
                                        data-size="small" data-color="#286090" data-switchery="false"
                                        @if ($offer['offerteTransportId']) checked @endif>
                                </div>
                            </div>
                            {{-- Transport Alanı Kontrolü Bitiş --}}

                            {{-- Transport Alanı Başlangıç --}}
                            <div class="form-group row transport--area"
                                @if ($offer['offerteTransportId'] == null) style="display: none;" @endif>
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Transport Am</label>
                                    <input class="form-control" class="date" name="transportdate" type="date"
                                        @if (
                                            $offer['offerteTransportId'] &&
                                                \App\Models\OfferteTransport::InfoTransport($offer['offerteTransportId'], 'transportDate')) value="{{ \App\Models\OfferteTransport::InfoTransport($offer['offerteTransportId'], 'transportDate') }}" @endif>
                                </div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Transport Stunde</label>
                                    <input class="form-control" name="transporttime" type="time"
                                        @if (
                                            $offer['offerteTransportId'] &&
                                                \App\Models\OfferteTransport::InfoTransport($offer['offerteTransportId'], 'transportTime')) value="{{ \App\Models\OfferteTransport::InfoTransport($offer['offerteTransportId'], 'transportTime') }}" @endif>
                                </div>

                                <div class="w-100 row rounded p-1 mt-3" style="background-color:  #C8DFF3;">
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Dauer [h]</label>
                                        <input class="form-control" class="transportsuresi" id="transportsuresi"
                                            aria-required="" name="transporthours" placeholder="4-5" type="text"
                                            @if ($offer['offerteTransportId'] && \App\Models\OfferteTransport::InfoTransport($offer['offerteTransportId'], 'hour')) value="{{ \App\Models\OfferteTransport::InfoTransport($offer['offerteTransportId'], 'hour') }}" @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">MA</label>
                                        <input class="form-control" name="transportma" placeholder="0"
                                            type="number"
                                            @if ($offer['offerteTransportId'] && \App\Models\OfferteTransport::InfoTransport($offer['offerteTransportId'], 'ma')) value="{{ \App\Models\OfferteTransport::InfoTransport($offer['offerteTransportId'], 'ma') }}" @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">LKW</label>
                                        <input class="form-control" name="transportlkw" placeholder="0"
                                            type="number"
                                            @if ($offer['offerteTransportId'] && \App\Models\OfferteTransport::InfoTransport($offer['offerteTransportId'], 'lkw')) value="{{ \App\Models\OfferteTransport::InfoTransport($offer['offerteTransportId'], 'lkw') }}" @else value="0" @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" col-form-label" for="l0">Anhänger</label>
                                        <input class="form-control" name="transportanhanger" placeholder="0"
                                            type="number"
                                            @if (
                                                $offer['offerteTransportId'] &&
                                                    \App\Models\OfferteTransport::InfoTransport($offer['offerteTransportId'], 'anhanger')) value="{{ \App\Models\OfferteTransport::InfoTransport($offer['offerteTransportId'], 'anhanger') }}" @endif>
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

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #C8DFF3;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control" name="transportcalendarTitle"
                                            placeholder="CalendarTitle" type="text" value="@if($data['companyName']) {{ $data['companyName'] }} @endif / @if($data['gender'] == 'male') Herr @else Frau @endif {{ $data['name'] }} {{ $data['surname'] }} / {{ $data['mobile'] }}">
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

                                <div class="row w-100 rounded p-1 mt-1 d-flex justify-content-center align-items-center">
                                    <div class="col-md-12 d-flex justify-content-center align-items-center">
                                        <label class=" col-form-label " ><strong>CalendarColors</strong></label>
                                    </div>

                                    <div class="radiobox colors">
                                        <label class="mt-1 ">
                                            <input type="radio" class=""  name="calendarTransportColor" value="15"
                                                > <span
                                                class="label-text pl-4 ml-1 col-form-label default">Default</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarTransportColor" value="1"> <span
                                                class="label-text pl-4 ml-1 col-form-label lavender">Lavender</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarTransportColor" value="2"> <span
                                                class="label-text pl-4 ml-1 col-form-label sage">Sage</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarTransportColor" value="3"> <span
                                                class="label-text pl-4 ml-1 col-form-label grape">Grape</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarTransportColor" value="4"> <span
                                                class="label-text pl-4 ml-1 col-form-label flamingo">Flamingo</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarTransportColor" value="5"> <span
                                                class="label-text pl-4 ml-1 col-form-label banana">Banana</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarTransportColor" value="6"> <span
                                                class="label-text pl-4 ml-1 col-form-label tangerine">Tangerine</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarTransportColor" value="7"> <span
                                                class="label-text pl-4 ml-1 col-form-label peacock">Peacock</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarTransportColor" value="8"> <span
                                                class="label-text pl-4 ml-1 col-form-label graphite">Graphite</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarTransportColor" value="9"> <span
                                                class="label-text pl-4 ml-1 col-form-label blueberry">Blueberry</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarTransportColor" value="10" checked="checked"> <span
                                                class="label-text pl-4 ml-1 col-form-label basil">Basil</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarTransportColor" value="11"> <span
                                                class="label-text pl-4 ml-1 col-form-label tomato">Tomato</span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            {{-- Transport Alanı Bitiş --}}

                            {{-- Lagerung Alanı Kontrolü --}}
                            <div class="form-group row">
                                <div class="col-md-12 lagerung-control">
                                    <label for="" class="col-form-label">Lagerung</label><br>
                                    <input type="checkbox" name="isLagerung" id="isLagerung" class="js-switch"
                                        data-size="small" data-color="#286090" data-switchery="false"
                                        @if ($offer['offerteLagerungId']) checked @endif>
                                </div>
                            </div>
                            {{-- Lagerung Alanı Kontrolü Bitiş --}}

                            {{-- Lagerung Alanı Başlangıç --}}
                            <div class="form-group row lagerung--area"
                                @if ($offer['offerteLagerungId'] == null) style="display: none;" @endif>
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

                                <div class="row w-100 rounded p-1 mt-1" style="background-color:  #C8DFF3;">
                                    <div class="col-md-4">
                                        <label class=" col-form-label" for="l0">CalendarTitle</label>
                                        <input class="form-control" name="lagerungcalendarTitle"
                                            placeholder="CalendarTitle" type="text" value="@if($data['companyName']) {{ $data['companyName'] }} @endif / @if($data['gender'] == 'male') Herr @else Frau @endif {{ $data['name'] }} {{ $data['surname'] }} / {{ $data['mobile'] }}">
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
                                            value="{{ $data['street'] }} , {{ $data['postCode'] }} , {{ $data['Ort'] }} ,  {{ $data['country'] }}">
                                    </div>
                                </div>

                                <div class="row w-100 rounded p-1 mt-1 d-flex justify-content-center align-items-center">
                                    <div class="col-md-12 d-flex justify-content-center align-items-center">
                                        <label class=" col-form-label " ><strong>CalendarColors</strong></label>
                                    </div>

                                    <div class="radiobox colors">
                                        <label class="mt-1 ">
                                            <input type="radio" class=""  name="calendarLagerungColor" value="15"
                                                > <span
                                                class="label-text pl-4 ml-1 col-form-label default">Default</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarLagerungColor" value="1"> <span
                                                class="label-text pl-4 ml-1 col-form-label lavender">Lavender</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarLagerungColor" value="2"> <span
                                                class="label-text pl-4 ml-1 col-form-label sage">Sage</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarLagerungColor" value="3"> <span
                                                class="label-text pl-4 ml-1 col-form-label grape">Grape</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarLagerungColor" value="4"> <span
                                                class="label-text pl-4 ml-1 col-form-label flamingo">Flamingo</span>
                                        </label>
                                        <label class="mt-1 ">
                                            <input type="radio"  name="calendarLagerungColor" value="5"> <span
                                                class="label-text pl-4 ml-1 col-form-label banana">Banana</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarLagerungColor" value="6"> <span
                                                class="label-text pl-4 ml-1 col-form-label tangerine">Tangerine</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarLagerungColor" value="7"> <span
                                                class="label-text pl-4 ml-1 col-form-label peacock">Peacock</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarLagerungColor" value="8"> <span
                                                class="label-text pl-4 ml-1 col-form-label graphite">Graphite</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarLagerungColor" value="9"> <span
                                                class="label-text pl-4 ml-1 col-form-label blueberry">Blueberry</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarLagerungColor" value="10" checked="checked"> <span
                                                class="label-text pl-4 ml-1 col-form-label basil">Basil</span>
                                        </label>
                                        <label class="mt-1 red">
                                            <input type="radio"  name="calendarLagerungColor" value="11"> <span
                                                class="label-text pl-4 ml-1 col-form-label tomato">Tomato</span>
                                        </label>
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

                        <div class="form-group row contactType--area" style="display:none;">
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



                        <div class="wo--area" style="display: none;">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">Wo</label>
                                    <input class="form-control" name="address" type="text"
                                        value="{{ $data['street'] }} , {{ $data['postCode'] }} , {{ $data['Ort'] }} , {{ $data['country'] }}"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row dateHour--area" style="display:none;">
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

                        <div class="calendar--area" style="display: none;">
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">Kalender Titel-Zusatz</label>
                                    <input class="form-control" name="calendarTitle" type="text" required value="@if($data['companyName']) {{ $data['companyName'] }} @endif / @if($data['gender'] == 'male') Herr @else Frau @endif {{ $data['name'] }} {{ $data['surname'] }} / {{ $data['mobile'] }}">
                                </div>

                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">Kalender Kommentar</label>
                                    <textarea class="form-control" name="calendarContent" id="" cols="30" rows="10" ></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 email-send">
                                <label for="" class="col-form-label">E-Mail an Kunden</label><br>
                                <input type="checkbox" name="isEmail" id="isEmail" class="js-switch"
                                    data-color="#286090" data-switchery="true">
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
                                    class="js-switch isCustomEmail" data-color="#286090" data-switchery="false">
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
            $("input[name=umzug1date]").prop('required', true);
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
    function momentConverter(value){
        moment.locale('de');
        return moment(value, "YYYY-MM-DD").format("dddd, DD. MMMM YYYY");
    }
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
        // Full string alması için ünlemler gerekli
        let companyName = '{!! $data['companyName'] !!}';
        let genderType = '{{ $data['gender'] }}';
        let hours,ma,lkw,time,anhanger;
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
        if($('input[name=umzug1hours]').val()){ hours = 'ca.'+' '+$('input[name=umzug1hours]').val()+' '+'Std'}else{ hours = ''}
        if($('input[name=umzug1ma]').val()>0){  ma = $('input[name=umzug1ma]').val()+' '+'MA';} else { ma = ''}
        if($('input[name=umzug1lkw]').val()>0){  lkw = $('input[name=umzug1lkw]').val()+' '+'LW';}else{ lkw = ''}
        if($('input[name=umzug1anhanger]').val()>0){  anhanger = $('input[name=umzug1anhanger]').val()+' '+'Anh';}else{ anhanger = ''}
        if($('input[name=umzug1time]').val()){  time = $('input[name=umzug1time]').val()+' '+'Uhr';}else{ time = ''}

        let newTitle = serviceName+' '+'/'+' '+companyName+' '+'/'+' '+gender+' '+name+' '+surname+' '+mobile+' '+'/'+' '+ma+' '+lkw+' '+anhanger+' '+hours+' '+'/'+' '+time;

        if(newTitle !== umzugTitle) { // only update if the new title is different
            $('input[name=umzug1calendarTitle]').val(newTitle);
            umzugTitle = newTitle; // save the new title
        }
    }

    function umzug2Func ()
    {
        let umzug2serviceName = 'Umzug 2';
        let umzug2gender = '';
        // Full string alması için ünlemler gerekli
        let companyName = '{!! $data['companyName'] !!}';
        let umzug2genderType = '{{ $data['gender'] }}';
        let umzug2hours,umzug2ma,umzug2lkw,umzug2time,umzug2anhanger;
        if(umzug2genderType == 'male')
        {
            umzug2gender = 'Herr'
        }
        else{
            umzug2gender = 'Frau'
        }
        let umzug2name = '{{ $data['name'] }}';
        let umzug2surname = '{{ $data['surname'] }}';
        let umzug2mobile = '{{ $data['mobile'] }}';
        if($('input[name=umzug2hours]').val()){ umzug2hours = 'ca.'+' '+$('input[name=umzug2hours]').val()+' '+'Std'}else{ umzug2hours = ''}
        if($('input[name=umzug2ma]').val()>0){  umzug2ma = $('input[name=umzug2ma]').val()+' '+'MA';} else { umzug2ma = ''}
        if($('input[name=umzug2lkw]').val()>0){  umzug2lkw = $('input[name=umzug2lkw]').val()+' '+'LW';}else{ umzug2lkw = ''}
        if($('input[name=umzug2anhanger]').val()>0){  umzug2anhanger = $('input[name=umzug2anhanger]').val()+' '+'ANH';}else{ umzug2anhanger = ''}
        if($('input[name=umzug2time]').val()){  umzug2time = $('input[name=umzug2time]').val()+' '+'Uhr';}else{ umzug2time = ''}

        let umzug2newTitle = umzug2serviceName+' '+'/'+' '+companyName+' '+'/'+' '+umzug2gender+' '+umzug2name+' '+umzug2surname+' '+umzug2mobile+' '+'/'+' '+umzug2ma+' '+umzug2lkw+' '+umzug2anhanger+' '+umzug2hours+' '+'/'+' '+umzug2time;

        if(umzug2newTitle !== umzug2Title) { // only update if the new title is different
            $('input[name=umzug2calendarTitle]').val(umzug2newTitle);
            umzug2Title = umzug2newTitle; // save the new title
        }
    }

    function umzug3Func()
    {
        let umzug3serviceName = 'Umzug 3';
        let umzug3gender = '';
        // Full string alması için ünlemler gerekli
        let companyName = '{!! $data['companyName'] !!}';
        let umzug3genderType = '{{ $data['gender'] }}';
        let umzug3hours,umzug3ma,umzug3lkw,umzug3time,umzug3anhanger;
        if(umzug3genderType == 'male')
        {
            umzug3gender = 'Herr'
        }
        else{
            umzug3gender = 'Frau'
        }
        let umzug3name = '{{ $data['name'] }}';
        let umzug3surname = '{{ $data['surname'] }}';
        let umzug3mobile = '{{ $data['mobile'] }}';
        if($('input[name=umzug3hours]').val()){ umzug3hours = 'ca.'+' '+$('input[name=umzug3hours]').val()+' '+'Std'}else{ umzug3hours = ''}
        if($('input[name=umzug3ma]').val()>0){  umzug3ma = $('input[name=umzug3ma]').val()+' '+'MA';} else { umzug3ma = ''}
        if($('input[name=umzug3lkw]').val()>0){  umzug3lkw = $('input[name=umzug3lkw]').val()+' '+'LW ';}else{ umzug3lkw = ''}
        if($('input[name=umzug3anhanger]').val()>0){  umzug3anhanger = $('input[name=umzug3anhanger]').val()+' '+'ANH';}else{ umzug3anhanger = ''}
        if($('input[name=umzug3time]').val()){  umzug3time = $('input[name=umzug3time]').val()+' '+'Uhr';}else{ umzug3time = ''}

        let umzug3newTitle = umzug3serviceName+' '+'/'+' '+companyName+' '+'/'+' '+umzug3gender+' '+umzug3name+' '+umzug3surname+' '+umzug3mobile+' '+'/'+' '+umzug3ma+' '+umzug3lkw+' '+umzug3anhanger+' '+umzug3hours+' '+'/'+' '+umzug3time;

        if(umzug3newTitle !== umzug3Title) { // only update if the new title is different
            $('input[name=umzug3calendarTitle]').val(umzug3newTitle);
            umzug3Title = umzug3newTitle; // save the new title
        }
    }

    function einpackFunc()
    {
        let einpackserviceName = 'Einpack';
            let einpackgender = '';
            // Full string alması için ünlemler gerekli
        let companyName = '{!! $data['companyName'] !!}';
            let einpackgenderType = '{{ $data['gender'] }}';
            let einpackhours,einpackma,einpacklkw,einpacktime,einpackanhanger;
            if(einpackgenderType == 'male')
            {
                einpackgender = 'Herr'
            }
            else{
                einpackgender = 'Frau'
            }
            let einpackname = '{{ $data['name'] }}';
            let einpacksurname = '{{ $data['surname'] }}';
            let einpackmobile = '{{ $data['mobile'] }}';
            if($('input[name=einpackhours]').val()){ einpackhours = 'ca.'+' '+$('input[name=einpackhours]').val()+' '+'Std'}else{ einpackhours = ''}
            if($('input[name=einpackma]').val()>0){  einpackma = $('input[name=einpackma]').val()+' '+'MA';} else { einpackma = ''}
            if($('input[name=einpacklkw]').val()>0){  einpacklkw = $('input[name=einpacklkw]').val()+' '+'LW';}else{ einpacklkw = ''}
            if($('input[name=einpackanhanger]').val()>0){  einpackanhanger = $('input[name=einpackanhanger]').val()+' '+'ANH';}else{ einpackanhanger = ''}
            if($('input[name=einpacktime]').val()){  einpacktime = $('input[name=einpacktime]').val()+' '+'Uhr';}else{ einpacktime = ''}

            let einpacknewTitle = einpackserviceName+' '+'/'+' '+companyName+' '+'/'+' '+einpackgender+' '+einpackname+' '+einpacksurname+' '+einpackmobile+' '+'/'+' '+einpackma+' '+einpacklkw+' '+einpackanhanger+' '+einpackhours+' '+'/'+' '+einpacktime;

            if(einpacknewTitle !== einpackTitle) { // only update if the new title is different
                $('input[name=einpackcalendarTitle]').val(einpacknewTitle);
                einpackTitle = einpacknewTitle; // save the new title
            }
    }

    function auspackFunc()
    {
        let auspackserviceName = 'Auspack';
        let auspackgender = '';
        // Full string alması için ünlemler gerekli
        let companyName = '{!! $data['companyName'] !!}';
        let auspackgenderType = '{{ $data['gender'] }}';
        let auspackhours,auspackma,auspacklkw,auspacktime,auspackanhanger;
        if(auspackgenderType == 'male')
        {
            auspackgender = 'Herr'
        }
        else{
            auspackgender = 'Frau'
        }
        let auspackname = '{{ $data['name'] }}';
        let auspacksurname = '{{ $data['surname'] }}';
        let auspackmobile = '{{ $data['mobile'] }}';
        if($('input[name=auspackhours]').val()){ auspackhours = 'ca.'+' '+$('input[name=auspackhours]').val()+' '+'Std'}else{ auspackhours = ''}
        if($('input[name=auspackma]').val()>0){  auspackma = $('input[name=auspackma]').val()+' '+'MA';} else { auspackma = ''}
        if($('input[name=auspacklkw]').val()>0){  auspacklkw = $('input[name=auspacklkw]').val()+' '+'LW';}else{ auspacklkw = ''}
        if($('input[name=auspackanhanger]').val()>0){  auspackanhanger = $('input[name=auspackanhanger]').val()+' '+'ANH';}else{ auspackanhanger = ''}
        if($('input[name=auspacktime]').val()){  auspacktime = $('input[name=auspacktime]').val()+' '+'Uhr';}else{ auspacktime = ''}

        let auspacknewTitle = auspackserviceName+' '+'/'+' '+companyName+' '+'/'+' '+auspackgender+' '+auspackname+' '+auspacksurname+' '+auspackmobile+' '+'/'+' '+auspackma+' '+auspacklkw+' '+auspackanhanger+' '+auspackhours+' '+'/'+' '+auspacktime;

        if(auspacknewTitle !== auspackTitle) { // only update if the new title is different
            $('input[name=auspackcalendarTitle]').val(auspacknewTitle);
            auspackTitle = auspacknewTitle; // save the new title
        }
    }

    function entsorgungFunc()
    {
        let entsorgungserviceName = 'Entsorgung';
            let entsorgunggender = '';
            // Full string alması için ünlemler gerekli
        let companyName = '{!! $data['companyName'] !!}';
            let entsorgunggenderType = '{{ $data['gender'] }}';
            let entsorgunghours,entsorgungma,entsorgunglkw,entsorgungtime;
            if(entsorgunggenderType == 'male')
            {
                entsorgunggender = 'Herr'
            }
            else{
                entsorgunggender = 'Frau'
            }
            let entsorgungname = '{{ $data['name'] }}';
            let entsorgungsurname = '{{ $data['surname'] }}';
            let entsorgungmobile = '{{ $data['mobile'] }}';
            if($('input[name=entsorgunghours]').val()){ entsorgunghours = 'ca.'+' '+$('input[name=entsorgunghours]').val()+' '+'Std'}else{ entsorgunghours = ''}
            if($('input[name=entsorgungma]').val()>0){  entsorgungma = $('input[name=entsorgungma]').val()+' '+'MA';} else { entsorgungma = ''}
            if($('input[name=entsorgunglkw]').val()>0){  entsorgunglkw = $('input[name=entsorgunglkw]').val()+' '+'LW';}else{ entsorgunglkw = ''}
            if($('input[name=entsorgunganhanger]').val()>0){  entsorgunganhanger = $('input[name=entsorgunganhanger]').val()+' '+'ANH';}else{ entsorgunganhanger = ''}
            if($('input[name=entsorgungtime]').val()){  entsorgungtime = $('input[name=entsorgungtime]').val()+' '+'Uhr';}else{ entsorgungtime = ''}

            let entsorgungnewTitle = entsorgungserviceName+' '+'/'+' '+companyName+' '+'/'+' '+entsorgunggender+' '+entsorgungname+' '+entsorgungsurname+' '+entsorgungmobile+' '+'/'+' '+entsorgungma+' '+entsorgunglkw+' '+entsorgunganhanger+' '+entsorgunghours+' '+'/'+' '+entsorgungtime;

            if(entsorgungnewTitle !== entsorgungTitle) { // only update if the new title is different
                $('input[name=entsorgungcalendarTitle]').val(entsorgungnewTitle);
                entsorgungTitle = entsorgungnewTitle; // save the new title
            }
    }

    function transportFunc()
    {
        let transportserviceName = 'Transport';
        let transportgender = '';
        // Full string alması için ünlemler gerekli
        let companyName = '{!! $data['companyName'] !!}';
        let transportgenderType = '{{ $data['gender'] }}';
        let transporthours,transportma,transportlkw,transporttime,transportanhanger;
        if(transportgenderType == 'male')
        {
            transportgender = 'Herr'
        }
        else{
            transportgender = 'Frau'
        }
        let transportname = '{{ $data['name'] }}';
        let transportsurname = '{{ $data['surname'] }}';
        let transportmobile = '{{ $data['mobile'] }}';
        if($('input[name=transporthours]').val()){ transporthours = 'ca.'+' '+$('input[name=transporthours]').val()+' '+'Std'}else{ transporthours = ''}
        if($('input[name=transportma]').val()>0){  transportma = $('input[name=transportma]').val()+' '+'MA';} else { transportma = ''}
        if($('input[name=transportlkw]').val()>0){  transportlkw = $('input[name=transportlkw]').val()+' '+'LW';}else{ transportlkw = ''}
        if($('input[name=transportanhanger]').val()>0){  transportanhanger = $('input[name=transportanhanger]').val()+' '+'ANH';}else{ transportanhanger = ''}
        if($('input[name=transporttime]').val()){  transporttime = $('input[name=transporttime]').val()+' '+'Uhr';}else{ transporttime = ''}

        let transportnewTitle = transportserviceName+' '+'/'+' '+companyName+' '+'/'+' '+transportgender+' '+transportname+' '+transportsurname+' '+transportmobile+' '+'/'+' '+transportma+' '+transportlkw+' '+transportanhanger+' '+transporthours+' '+'/'+' '+transporttime;

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
        // Full string alması için ünlemler gerekli
        let companyName = '{!! $data['companyName'] !!}';
        let reinigunggenderType = '{{ $data['gender'] }}';
        let reinigungEndDate,reinigungEndTime;
        if(reinigunggenderType == 'male')
        {
            reinigunggender = 'Herr'
        }
        else{
            reinigunggender = 'Frau'
        }
        let reinigungname = '{{ $data['name'] }}';
        let reinigungsurname = '{{ $data['surname'] }}';
        let reinigungmobile = '{{ $data['mobile'] }}';
        if($('input[name=reinigung1Enddate]').val()){  reinigungEndDate = 'Abgabetermin'+' '+momentConverter($('input[name=reinigung1Enddate]').val())+' '+'um'}else{ reinigungEndDate = ''}
        if($('input[name=reinigung1Endtime]').val()){  reinigungEndTime = $('input[name=reinigung1Endtime]').val()+' '+'Uhr';}else{ reinigungEndTime = ''}

        let reinigungnewTitle = reinigungserviceName+' '+'/'+' '+companyName+' '+'/'+' '+reinigunggender+' '+reinigungname+' '+reinigungsurname+' '+reinigungmobile+' '+'/'+' '+reinigungEndDate+' '+reinigungEndTime;

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
        // Full string alması için ünlemler gerekli
        let companyName = '{!! $data['companyName'] !!}';
        let reinigung2genderType = '{{ $data['gender'] }}';
        let reinigung2EndDate,reinigung2EndTime;
        if(reinigung2genderType == 'male')
        {
            reinigung2gender = 'Herr'
        }
        else{
            reinigung2gender = 'Frau'
        }
        let reinigung2name = '{{ $data['name'] }}';
        let reinigung2surname = '{{ $data['surname'] }}';
        let reinigung2mobile = '{{ $data['mobile'] }}';
        if($('input[name=reinigung2Enddate]').val()){  reinigung2EndDate = 'Abgabetermin'+' '+momentConverter($('input[name=reinigung2Enddate]').val())+' '+'um'}else{ reinigung2EndDate = ''}
        if($('input[name=reinigung2Endtime]').val()){  reinigung2EndTime = $('input[name=reinigung2Endtime]').val()+' '+'Uhr';}else{ reinigung2EndTime = ''}

        let reinigung2newTitle = reinigung2serviceName+' '+'/'+' '+companyName+' '+'/'+' '+reinigung2gender+' '+reinigung2name+' '+reinigung2surname+' '+reinigung2mobile+' '+'/'+' '+reinigung2EndDate+' '+reinigung2EndTime;

        if(reinigung2newTitle !== reinigung2Title) { // only update if the new title is different
            $('input[name=reinigung2calendarTitle]').val(reinigung2newTitle);
            reinigung2Title = reinigung2newTitle; // save the new title
        }
    }

    function lagerungFunc()
    {
        let lagerungserviceName = 'Transport';
        let lagerunggender = '';
        // Full string alması için ünlemler gerekli
        let companyName = '{!! $data['companyName'] !!}';
        let lagerunggenderType = '{{ $data['gender'] }}';
        let lagerunghours,lagerungma,lagerunglkw,lagerungtime,lagerunganhanger;
        if(lagerunggenderType == 'male')
        {
            lagerunggender = 'Herr'
        }
        else{
            lagerunggender = 'Frau'
        }
        let lagerungname = '{{ $data['name'] }}';
        let lagerungsurname = '{{ $data['surname'] }}';
        let lagerungmobile = '{{ $data['mobile'] }}';
        if($('input[name=lagerunghours]').val()){ lagerunghours = 'ca.'+' '+$('input[name=lagerunghours]').val()+' '+'Std'}else{ lagerunghours = ''}
        if($('input[name=lagerungma]').val()>0){  lagerungma = $('input[name=lagerungma]').val()+' '+'MA';} else { lagerungma = ''}
        if($('input[name=lagerunglkw]').val()>0){  lagerunglkw = $('input[name=lagerunglkw]').val()+' '+'LW';}else{ lagerunglkw = ''}
        if($('input[name=lagerunganhanger]').val()>0){  lagerunganhanger = $('input[name=lagerunganhanger]').val()+' '+'ANH';}else{ lagerunganhanger = ''}
        if($('input[name=lagerungtime]').val()){  lagerungtime = $('input[name=lagerungtime]').val()+' '+'Uhr';}else{ lagerungtime = ''}

        let lagerungnewTitle = lagerungserviceName+' '+'/'+' '+companyName+' '+'/'+' '+lagerunggender+' '+lagerungname+' '+lagerungsurname+' '+lagerungmobile+' '+'/'+' '+lagerungtime;

        if(lagerungnewTitle !== lagerungTitle) { // only update if the new title is different
            $('input[name=lagerungcalendarTitle]').val(lagerungnewTitle);
            lagerungTitle = lagerungnewTitle; // save the new title
        }
    }

    $(document).ready(function(){
        umzugFunc();
        umzug2Func();
        umzug3Func()
        einpackFunc()
        auspackFunc()
        entsorgungFunc()
        transportFunc()
        reinigungFunc()
        reinigung2Func()
        lagerungFunc()
    })

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
        // Full string alması için ünlemler gerekli
        let companyName = '{!! $data['companyName'] !!}';
        let AppgenderType = '{{ $data['gender'] }}';
        if(AppgenderType == 'male')
        {
            Appgender = 'Herr'
        }
        else{
            Appgender = 'Frau'
        }
        let Appname = '{{ $data['name'] }}';
        let Appsurname = '{{ $data['surname'] }}';
        let Appmobile = '{{ $data['mobile'] }}';
        let ApppostCode = '{{ $data['postCode'] }}';
        let bescnewTitle = ApppostCode+' '+'/'+' '+AppserviceName+' '+companyName+' '+Appgender+' '+Appname+' '+Appsurname+' '+Appmobile;

        if(bescnewTitle !== bescTitle) { // only update if the new title is different
            $('input[name=calendarTitle]').val(bescnewTitle);
            bescTitle = bescnewTitle; // save the new title
        }
        console.log(valueQq,'VBALL')
    })

    // Umzug / Herr Ali Yurdakul +41 76 399 50 02 / 4 MA 2 LW ca. 7-8 Std / 08:00 Uhr
    $('body').on('change','.umzug-area',function(){
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
    $('body').on('change','.reinigung2--area',function(){
        lagerungFunc()
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
        valueA = $(this).val();
        switch (valueA) {
            case '1':
                $(".deliverable--area").hide(300);
                $(".confirmation--area").hide(300);
                $(".contactType--area").show(500);
                $(".dateHour--area").show(300);
                $(".calendar--area").show(300);
                $(".wo--area").show(300);
                break;
            case '2':
                $(".confirmation--area").show(300);
                $(".deliverable--area").hide(300);
                $(".contactType--area").hide(500);
                $(".dateHour--area").hide(300);
                $(".calendar--area").hide(300);
                $(".wo--area").hide(300);
                break;
            case '3':
                $(".confirmation--area").hide(300);
                $(".deliverable--area").show(500);
                $(".contactType--area").hide(300);
                $(".dateHour--area").hide(300);
                $(".calendar--area").show(300);
                $(".wo--area").show(300);
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
    function eventChanges() {
        valueZ = $("input[name=appType]:checked").val();
        tinymce.execCommand("mceRepaint");

        if (valueZ == 1) {
            $("body").on("change", ".widget-body", function() {
                let dateArray = [];
                var tarih1 = $('input[name=date]').val();
                var saat1 = $('input[name=time]').val();
                dateArray.some(function(entry) {
                    if (entry.name == "<b>Besichtigung:</b> ") {
                        found = entry;
                        dateArray.splice(found);
                    }
                });
                if(tarih1!=""){
                    dateArray.push({
                    name: '<b>Besichtigung:</b>',
                    date: momentConvertValue(tarih1),
                    time: saat1
                    })
                }
                var requestDate = "";
                for (var i = 0; i <= dateArray.length - 1; i++) {
                    if(dateArray[i].time)
                    {
                        requestDate +=  dateArray[i].date +' '+dateArray[i].time+' '+'Uhr'+"<br>";
                    }
                    else{
                        requestDate +=  dateArray[i].date +"<br>";
                    }

                }
                tinymce.get("customEmail").setContent(`@include('../../cemail', ['date' => '${requestDate}','AppTypeC' => 'Besichtigung'])`);
                tinymce.execCommand("mceRepaint");
            });
        }

        if (valueZ == 2) {
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
                            time: saat1
                        })
                    }
                }
                if ($("input[name=isUmzug2]:checked").val()) {
                    if(tarih2!=""){
                        dateArray2.push({
                        name: '<b>Umzug 2:</b> ',
                        date: momentConvertValue(tarih2),
                        time: saat2
                    })
                    }
                    if(tarih3!=""){
                        dateArray2.push({
                        name: '<b>Umzug 3:</b> ',
                        date: momentConvertValue(tarih3),
                        time: saat3
                    })
                    }
                }
                if ($("input[name=isEinpackservice]:checked").val()) {
                    if(tarih4!=""){
                        dateArray2.push({
                            name: '<b>Einpack:</b> ',
                            date: momentConvertValue(tarih4),
                            time: saat4
                        })
                    }
                }
                if ($("input[name=isAuspackservice]:checked").val()) {
                    if(tarih5!=""){
                        dateArray2.push({
                            name: '<b>Auspack:</b> ',
                            date: momentConvertValue(tarih5),
                            time: saat5
                        })
                    }
                }
                if ($("input[name=isReinigung]:checked").val()) {
                    if(tarih6!=""){
                        dateArray2.push({
                            name: '<b>Reinigung:</b> ',
                            date: momentConvertValue(tarih6),
                            time: saat6
                        })
                    }
                }
                if ($("input[name=isReinigung2]:checked").val()) {
                    if(tarih7!=""){
                        dateArray2.push({
                            name: '<b>Reinigung 2:</b> ',
                            date: momentConvertValue(tarih7),
                            time: saat7
                        })
                    }
                }
                if ($("input[name=isEntsorgung]:checked").val()) {
                    if(tarih8!=""){
                        dateArray2.push({
                            name: '<b>Entsorgung:</b> ',
                            date: momentConvertValue(tarih8),
                            time: saat8
                        })
                    }
                }
                if ($("input[name=isTransport]:checked").val()) {
                    if(tarih9!=""){
                        dateArray2.push({
                            name: '<b>Transport:</b> ',
                            date: momentConvertValue(tarih9),
                            time: saat9
                        })
                    }
                }
                if ($("input[name=isLagerung]:checked").val()) {
                    if(tarih10!=""){
                        dateArray2.push({
                            name: '<b>Lagerung:</b> ',
                            date: momentConvertValue(tarih10),
                            time: saat10
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

        if (valueZ == 3) {
            $("body").on("change", ".widget-body", function() {
                let dateArray3 = [];
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
                    requestDate += '<span style="display:none;">'+ dateArray3[i].name +  '</span>'+" " + dateArray3[i].date + "<br>";
                }
                tinymce.get("customEmail").setContent(`@include('../../cemail', ['date' => '${requestDate}','AppTypeC' => 'Lieferung'])`);
                tinymce.execCommand("mceRepaint");
            });
        }
    }
</script>
@endsection
