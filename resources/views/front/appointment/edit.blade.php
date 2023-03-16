@extends('layouts.app')

@section('header')
<script src="https://cdn.tiny.cloud/1/qa7zzv3hb9nmr5ary4ucaw8bbt8744dzibxuf6hdomgsuchu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

@endsection

@section('content')
@section('sidebarType') sidebar-collapse @endsection

<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Termin Bearbeiten - Besichtigung</h6>
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
                    <form action="{{ route('appointment.update',['id' => $data['id']]) }}" method="POST" enctype="multipart/form-data">
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

                        

                            <div class="form-group row besc-area">
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
                                    <input type="checkbox" name="isEmail" id="isEmail" class="js-switch " data-color="#9c27b0" data-switchery="false" >  
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
                                    <input type="checkbox" name="isCustomEmail" id="isCustomEmail" class="js-switch isCustomEmail" data-color="#9c27b0" data-switchery="false" >   
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
{{-- TinyMce Email Format Ayarları --}}

<script>
    function bescFunc(){
        let bescTitle = $('input[name=calendarTitle]').val();
        var valueQq = 1;
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
    }

</script>
<script>
    
</script>
<script>
    
    //TinyMce Ayarları 
    tinymce.init({
        selector: 'textarea.editor',
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
        toolbar_mode: 'floating',
        apply_source_formatting: true,
        plugins: 'code',
    });
    
    let dateArray = [];
    var tarih1 = $('input[name=date]').val();
    
    if (tarih1 != null || tarih1 != undefined) {
        dateArray.push({
            name: '<b>Besichtigung:</b> ',
            date: tarih1
        })
    }
    
    eventChanges();
    $("body").on("change", ".widget-body", function() {
        eventChanges();
        
    });
    $("body").on("change",".besc-area", function(){
        bescFunc();
    })
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
                    time: momentConvertTimeValue(saat1)
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

