@extends('layouts.app')


@section('content')

<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Termin Anschauen - Lieferung</h6>
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
        <div class="col-md-12">
            <strong class="h5 mr-1"> <b>Kunde:</b> </strong> <span class="h5 text-primary ">
                {{ App\Models\Customer::getPublicName($data2['id']) }}</span>
        </div>
        <div class="col-md-12 widget-holder">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <p><form id="appMaterial" name="myForm" action="{{ route('appointmentMaterial.update',['id' => $data['id']]) }}"  method="POST" enctype="multipart/form-data"></p>
                       @csrf
                        <div class="deliverable--area">
                            <div class="form-group row " >
                                <div class="col-md-12">
                                    <label for="" class="col-form-label">Lieferobjekt</label>
                                    <div class="radiobox">
                                        <label>
                                            <input type="radio" class="deliverable"  name="deliverable" value="0" @if ($data['deliverable'] == 0) checked @endif > <span class="label-text">Verpackungsmaterial</span>
                                        </label>
                                    </div>

                                    <div class="radiobox">
                                        <label>
                                            <input type="radio" class="deliverable"  name="deliverable" value="1" @if ($data['deliverable'] == 1) checked @endif> <span class="label-text">Schlossatelier</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row deliveryType--area" @if ($data['deliverable'] == 1) style="display: none;" @endif>
                                <div class="col-md-12">
                                    <label for="" class="col-form-label">Lieferungsart</label>
                                    <div class="radiobox">
                                        <label>
                                            <input type="radio" class="deliveryType"  name="deliveryType" value="0" @if ($data['deliveryType'] == 0) checked @endif > <span class="label-text">Lieferung</span>
                                        </label>
                                    </div>

                                    <div class="radiobox @if ($data['deliveryType'] == 0) d-none @endif">
                                        <label>
                                            <input type="radio" class="deliveryType"  name="deliveryType" value="1" @if ($data['deliveryType'] == 1) checked @endif> <span class="label-text">Abholung</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">Termin</label>
                                    <input class="form-control" id="meetingDate" name="meetingDate"  type="date" value="{{ $data['meetingDate'] }}" >
                                </div>

                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">zwischen</label>
                                    <input class="form-control"  name="meetingHour1"  type="time" value="{{ $data['meetingHour1'] }}">
                                </div>

                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">bis</label>
                                    <input class="form-control"  name="meetingHour2"  type="time" value="{{ $data['meetingHour2'] }}">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class=" col-form-label" for="l0">Wo</label>
                                <input class="form-control" name="address"  type="text" value="{{   $data['address'] }}" required>
                            </div>
                        </div>



                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">Kalender Titel-Zusatz</label>
                                    <input class="form-control" name="calendarTitle"  type="text" value="{{   $data['calendarTitle'] }}">
                                </div>

                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">Kalender Kommentar</label>
                                    <textarea class="form-control" name="calendarContent" id="" cols="30" rows="10">{{   $data['calendarContent'] }}</textarea>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-12 email-send">
                                    <label for="" class="col-form-label">E-Mail an Kunden</label><br>

                                    <input type="checkbox" name="isEmail"  class="js-switch " data-color="#286090" data-switchery="false" >


                                </div>
                            </div>

                            <div class="row form-group email--area" style="display: none;">
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">E-Mail Adresse </label>
                                    <input class="form-control" name="email"  type="text" value="{{ $data2['email'] }}" >
                                </div>

                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">Email Kommentar</label>
                                    <textarea class="form-control" name="emailContent" id="" cols="30" rows="10"></textarea>
                                </div>

                                <div class="col-md-12 email-format">
                                    <label for="" class="col-form-label">Standard Emailtext bearbeiten</label><br>
                                    <input type="checkbox" name="isCustomEmail" id="isCustomEmail" class="js-switch isCustomEmail" data-color="#286090" data-switchery="false" >
                                </div>
                            </div>

                            <div class="row form-group email--format" style="display: none;">
                                <div class="col-md-12 mt-3">
                                    <textarea class="editor" name="customEmail" id="customEmail" cols="30" rows="10">

                                    </textarea>
                                </div>
                            </div>

                        <div class="form-actions">
                            <div class="form-group row">
                                <div class="col-md-12 ml-md-auto btn-list">
                                    <button class="btn btn-primary btn-rounded" type="submit">Erstellen</button>
                                        <a href="{{ route('appointmentMaterial.edit',['id' => $data['id']]) }}" class="btn btn-info btn-rounded text-white"><b>Bearbeiten</b></a>
                                    @if($data['abholungId'])
                                        <a href="{{ route('appointmentMaterial.detailAbholung',['id' => $data['abholungId']]) }}" class="btn btn-warning btn-rounded text-white"><b>Abholung Detail</b></a>
                                    @else
                                        <a href="{{ route('appointmentMaterial.createAbholung',['lieferungId' => $data['id']]) }}" class="btn btn-warning btn-rounded text-white"><b>Abholung Create</b></a>
                                    @endif

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

$(document).ready( function(){
    $("#appMaterial :input").prop("disabled", true);
});
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

<script>
    $(".appointment-type").click(function() {
        var value = $(this).val();
        if(value == 3)
        {
            $(".deliverable--area").show(500);
            $(".contactType--area").hide(300);

        }
        else {
            $(".deliverable--area").hide(300);
            $(".contactType--area").show(500);
        }
    });
</script>

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

@endsection

