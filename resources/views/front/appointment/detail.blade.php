@extends('layouts.app')

@section('header')
<script src="https://cdn.tiny.cloud/1/qa7zzv3hb9nmr5ary4ucaw8bbt8744dzibxuf6hdomgsuchu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://camdalio.test/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('content')

<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Termin Anschauen - Besichtigung</h6>
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
                    <form id="appForm1" action="{{ route('appointment.update',['id' => $data['id']]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="" class="col-form-label">Besichtigungsort</label>
                                <div class="radiobox">
                                    <label>
                                        <input type="radio"   name="contactType" value="0" @if ($data['contactType'] == 0) checked @endif> <span class="label-text">Beim Kunden</span>
                                    </label>
                                </div>
    
                                <div class="radiobox">
                                    <label>
                                        <input type="radio"   name="contactType" value="1" @if ($data['contactType'] == 1) checked @endif> <span class="label-text">Per Telefon</span>
                                    </label>
                                </div>
    
                                <div class="radiobox">
                                    <label>
                                        <input type="radio"   name="contactType" value="2" @if ($data['contactType'] == 2) checked @endif> <span class="label-text">Andere</span>
                                    </label>
                                </div>
                            </div> 

                                                    
                        </div>

                        

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">Wo</label>
                                    <input class="form-control" name="address"  type="text" value="{{   $data['address']  }} " required>                                
                                </div>
    
                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">Datum</label>
                                    <input class="form-control" class="date" id="datepicker"  name="date"  type="date" required value="{{   $data['date']  }}">                                
                                </div>

                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">Stunde</label>
                                    <input class="form-control"  name="time"  type="time" required value="{{   $data['time']  }}">                                
                                </div>
                            </div>

                            

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">Kalender Titel-Zusatz</label>
                                    <input class="form-control" name="calendarTitle"  type="text" required value="{{   $data['calendarTitle']  }}">                                
                                </div>

    
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">Kalender Kommentar</label>
                                    <textarea class="form-control" name="calendarContent" id="" cols="30" rows="10">{{$data['calendarContent']}}</textarea>                                
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-12 email-send">
                                    <label for="" class="col-form-label">E-Mail an Kunden</label><br>
                                    <input type="checkbox" name="isEmail" id="isEmail" class="js-switch " data-color="#286090" data-switchery="false" >  
                                </div>                            
                            </div>
                            

                            <div class="row form-group email--area" style="display: none;">
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">E-Mail Adresse</label>
                                    <input class="form-control" name="email"  type="text" value="{{   $data2['email']  }}">                                
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
                                            {{-- @include('../../email') --}}
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
</div>

@endsection

@section('footer')
<script> 

$("#appForm1 :input").prop("disabled", true);

</script>


@endsection

