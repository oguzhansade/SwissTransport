
@extends('layouts.app')

@section('header')
<script src="https://cdn.tiny.cloud/1/qa7zzv3hb9nmr5ary4ucaw8bbt8744dzibxuf6hdomgsuchu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://camdalio.test/tinymce.min.js" referrerpolicy="origin"></script>
<style>
    .checkbox .label-text:after {
        border-color: #999494;
    }
</style>
@endsection

@section('content')

<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Offerte anschauen</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Panel</a>
            </li>
            <li class="breadcrumb-item active">Offerte</li>
        </ol>
        <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="{{ route('offer.create',['id' => $customer['id']]) }}" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Neue Offerte erfassen</a>
        </div>
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
        <div class="col-md-12 widget-holder">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <form action="" id="bestForm" method="POST" enctype="multipart/form-data" disabled>
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                                <span class="h5 font-weight-bolder"> <strong>Kunde:</strong>  </span> <span class="h5 ml-3 text-primary">{{ $customer['name'] }} {{ $customer['surname'] }}</span>
                            </div>
                            <div class="col-md-12">
                                <span class="h5 font-weight-bolder"> <strong>Offertennr:</strong> </span> <span class="h5 ml-3 text-primary">{{ $data['id'] }}</span>
                            </div>
                            <div class="col-md-12">
                                <span class="h5 font-weight-bold text-dark"> <strong>Stand:</strong> </span> <span class="h5 ml-3 font-weight-bold text-primary">
                                    @if($data['offerteStatus']  &&  $data['offerteStatus']  == 'Onaylandı') Bestätigt 
                                    @elseif($data['offerteStatus']  &&  $data['offerteStatus']  == 'Onaylanmadı') Nicht Bestätigt  
                                    @else in Wartestellung
                                    @endif</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="" class="col-form-label">Besichtigung</label><br>
                                <select class="form-control" name="appOfferType" id="appOfferType">
                                    <option value="0" @if($data['appType'] == 0) selected @endif>Nein</option>
                                    <option value="1" @if($data['appType'] == 1) selected @endif>Gemacht</option>
                                    <option value="2" @if($data['appType'] == 2) selected @endif>Wünscht keine</option>
                                </select> 
                            </div>                            
                        </div>

                            
                        
                            {{-- Offerte Umzug  Alanı --}}
                                @include('front.offer.detailComponents.offerUmzug',[
                                    'auszug1' => $data['auszugaddressId'],
                                    'auszug2' => $data['auszugaddressId2'],
                                    'auszug3' => $data['auszugaddressId3'],
                                    'einzug1' => $data['einzugaddressId'],
                                    'einzug2' => $data['einzugaddressId2'],
                                    'einzug3' => $data['einzugaddressId3'],
                                    ])
                            {{-- Offerte Umzug Alanı --}}
                            
                            {{-- Offerte Umzug 2 Alanı --}}
                                @include('front.offer.detailComponents.offerUmzug2',['umzug' => $data['offerteUmzugId']])
                            {{-- Offerte Umzug 2 Alanı --}}

                            {{-- Offerte Einpack Alanı --}}
                                @include('front.offer.detailComponents.offerEinpack',['einpack' => $data['offerteEinpackId']])
                            {{-- Offerte Einpack Alanı --}}

                            {{-- Offerte Auspack Alanı --}}
                                @include('front.offer.detailComponents.offerAuspack',['auspack' => $data['offerteAuspackId']])
                            {{-- Offerte Auspack Alanı --}}

                            {{-- Offerte Reinigung Alanı --}}
                                @include('front.offer.detailComponents.offerReinigung',['reinigung' => $data['offerteReinigungId']])
                            {{-- Offerte Reinigung Alanı --}}

                            {{-- Offerte Reinigung2 Alanı --}}
                                @include('front.offer.detailComponents.offerReinigung2',['reinigung2' => $data['offerteReinigung2Id']])
                            {{-- Offerte Reinigung2 Alanı --}}

                            {{-- Offerte Entsorgung Alanı --}}
                                @include('front.offer.detailComponents.offerEntsorgung',['entsorgung' => $data['offerteEntsorgungId']])
                            {{-- Offerte Entsorgung Alanı --}}

                            {{-- Offerte Transport Alanı --}}
                                @include('front.offer.detailComponents.offerTransport',['transport' => $data['offerteTransportId']])
                            {{-- Offerte Transport Alanı --}}

                            {{-- Offerte Lagerung Alanı --}}
                                @include('front.offer.detailComponents.offerLagerung',['lagerung' => $data['offerteLagerungId']])
                            {{-- Offerte Lagerung Alanı --}}

                            {{-- Offerte Material Alanı --}}
                                @include('front.offer.detailComponents.offerMaterial',['material' => $data['offerteMaterialId']])
                            {{-- Offerte Material Alanı --}}

                            

                            <div class="form-group row">
                                <div class="col-md-12 ">
                                    <label for="" class="col-form-label">Bemerkung (in Offerte)</label><br>
                                    <textarea class="form-control" name="offertePdfNote" id="" cols="15" rows="5" >{{ $data['offerteNote'] }}</textarea>    
                                </div>                            
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 ">
                                    <label for="" class="col-form-label">Notiz (<u>Nicht</u> in Offerte)</label><br>
                                    <textarea  class="form-control" name="offerteNote" id="" cols="15" rows="5" >{{ $data['panelNote'] }}</textarea>    
                                </div>                            
                            </div>

                            <div class="col-md-12  p-3 rounded" style="background-color: #eae9ec;">
                                <label class="col-form-label" >Zusätzliche Merkmale</label>                                                   
                                <div class="col-md-12 ">                                                    
                                    <div class="checkbox checkbox-rounded checkbox-primary " >
                                        <label class="">
                                            <input type="checkbox" name="kdvType"  value="1" @if($data['kostenInkl'] == 1) checked @endif> <span class="label-text text-dark"><strong>Kosten inkl. MwSt.</strong></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 ">                                                    
                                    <div class="checkbox checkbox-rounded checkbox-primary">
                                        <label class="">
                                            <input type="checkbox" name="kdvType1"  value="1" @if($data['kostenExkl'] == 1) checked @endif> <span class="label-text text-dark"><strong> Kosten exkl. MwSt.</strong></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 ">                                                    
                                    <div class="checkbox checkbox-rounded checkbox-primary">
                                        <label class="">
                                            <input type="checkbox" name="kdvType3"  value="1" @if($data['kostenFrei'] == 1) checked @endif> <span class="label-text text-dark "><strong>Kostenfrei MwSt.</strong></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="" class="col-form-label">Kontaktperson</label><br>
                                    <select class="form-control" name="contactPerson" id="contactPerson">
                                        <option value="0" selected>Bitte wählen </option>
                                        @foreach (\App\Models\ContactPerson::all() as $key => $value)
                                            <option value="{{ $value['id'] }}" >{{ $value['name'] }}</option>
                                        @endforeach
                                    </select> 
                                </div>
                                <div class="col-md-6 customContactPerson" style="display:block;">
                                    <label class=" col-form-label" for="l0">Kontaktperson (Freitext)</label>
                                    <input class="form-control" name="customContactPerson"  type="text" value="{{ $data['contactPerson'] }}">  
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
                                    <label class=" col-form-label" for="l0">E-Mail Adresse </label>
                                    <input class="form-control" name="email"  type="text" value="{{   $customer['email']  }}">                                
                                </div>  
    

                                <div class="col-md-12 email-format">
                                    <label for="" class="col-form-label">Standard Emailtext bearbeiten</label><br>
                                    <input type="checkbox" name="isCustomEmail" id="isCustomEmail" class="js-switch isCustomEmail" data-color="#9c27b0" data-switchery="false" >   
                                </div>   
                            </div>

                            <div class="row form-group email--format" style="display: none;">
                                <div class="col-md-12 mt-3">
                                    <textarea class="editor" name="customEmail" id="customEmail" cols="30" rows="10">
                                        {{-- @include('../../offerEmail',['data2' => $data]) --}}
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 sms-send">
                                    <label for="" class="col-form-label">SMS an Kunden</label><br>
                                    <input type="checkbox" name="isSMS" id="isSMS" class="js-switch " data-color="#9c27b0" data-switchery="false" checked>  
                                </div>                            
                            </div>

                            <div class="col-md-12 sms-format mb-3">
                                <label for="" class="col-form-label">Standard SMStext bearbeiten</label><br>
                                <input type="checkbox" name="isCustomSMS" id="isCustomSMS" class="js-switch isCustomSMS" data-color="#9c27b0" data-switchery="false" >   
                            </div>  

                            <div class="row form-group sms-format-area" style="display: none;">
                                <div class="col-md-12 mt-3">
                                    <textarea maxlength="190" id="editor2" class="form-control" name="customSMS" id="customSMS" cols="10" rows="5" >Offer Updated</textarea>
                                    <small class="text-primary"><i>Max Characters:190</i></small>
                                </div>
                            </div>

                        <div class="form-actions">
                            <div class="form-group row">
                                <div class="col-md-12 ml-md-auto btn-list">
                                    <button class="btn btn-primary btn-rounded" type="submit">Erstellen</button>
                                    @if (App\Models\UserPermission::getMyControl(6)) 
                                    <a id="createapp"  href="{{ route('appointment.createFromOffer',['id' => $data['id'],'customer' => $data['customerId']]) }}" 
                                        class="btn btn-rounded text-white" target="_blank" style="background-color:#F0AD4E"> <strong>Termin trotzdem erstellen</strong> 
                                    </a>
                                    @endif

                                    <a id="createapp"  href="{{ route('offer.edit',['id' => $data['id']]) }}" 
                                        class="btn btn-info btn-rounded text-white" target="_blank"> <strong>Bearbeiten</strong> 
                                    </a>

                                    @if (App\Models\UserPermission::getMyControl(11)) 
                                    <a href="#" class="btn btn-success btn-rounded text-white" data-toggle="modal" data-target="#receiptModal"> <strong>Quittung erstellen</strong> 
                                    </a>
                                    @endif

                                    @if (App\Models\UserPermission::getMyControl(10))
                                    <a id="createInvoice"  href="{{ route('invoice.createFromOffer',['id' => $data['id'],'customer' => $data['customerId']]) }}" 
                                        class="btn btn-rounded text-white" target="_blank" style="background-color:#5BC0DE"> <strong>Rechnung erstellen</strong> 
                                    </a>
                                    @endif
                                    @if (App\Models\UserPermission::getMyControl(5))
                                    <a id="createTask"  href="{{ route('task.createFromOffer',['id' => $data['id']]) }}" 
                                        class="btn btn-rounded text-white" target="_blank" style="background-color:#F0AD4E"> <strong>Aufgabe erstellen</strong> 
                                    </a>
                                    @endif
                                    <a id="createTask"  href="{{ route('offer.showPdf',['id' => $data['id']]) }}" 
                                        class="btn btn-rounded text-white" style="background-color:#ff0000"> <strong>Ausdrucken</strong> 
                                    </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="receiptModalLabel" aria-hidden="true" >
            <div class="modal-dialog" role="document" >
              <div class="modal-content" style="border-radius: 30px;">
                <div class="modal-header bg-primary text-white" style="border-top-right-radius: 30px;border-top-left-radius: 30px;">
                  <h5 class="modal-title" id="receiptModalLabel">Quittungsart auswählen</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="text-dark h6">Für welche Dienstleistung möchten Sie die Quittung erstellen?</span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a id="createUmzug" href="{{ route('receipt.createStandart',['id' => $data['id'],'customer' => $data['customerId']]) }}" 
                                class="btn btn-primary btn-rounded text-white">Standart: Umzug/Entsorgung/Transport</a>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a id="createReinigung1" href="{{ route('receiptReinigung.createReinigung',['id' => $data['id'],'customer' => $data['customerId']]) }}" class="btn btn-info btn-rounded text-white" >Reinigung</a>
                            @if ($data['offerteReinigung2Id'])
                                <a id="createReinigung2" href="{{ route('receiptReinigung.createReinigung2',['id' => $data['id'],'customer' => $data['customerId']]) }}" class="btn btn-info btn-rounded text-white" >Reinigung 2</a>
                            @endif
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>

@endsection

@section('footer')

<script>

// Temizlik 1 Makbuz Kontrol
$(function() {
    $('#createReinigung1').click(function(e) {
        let reinigungKontrol1 = '{{ $data['offerteReinigungId'] }}';
        console.log(reinigungKontrol1,'STATUS')
        e.preventDefault();
        if(reinigungKontrol1)
        {
            location.href = this.href;
        }
        else{
            if (window.confirm("Sie haben keine Reinigung offeriert. Sie können zwar eine Quittung erstellen, aber die Daten müssen Sie selbst eingeben. Fortfahren?")) 
            {
            location.href = this.href;
            }
        }
    });
});

// Temizlik 2 Makbuz Kontrol
$(function() {
    $('#createReinigung2').click(function(e) {
        let reinigungKontrol2 = '{{ $data['offerteReinigung2Id'] }}';
        console.log(reinigungKontrol2,'STATUS')
        e.preventDefault();
        if(reinigungKontrol2)
        {
            location.href = this.href;
        }
        else{
            if (window.confirm("Sie haben keine Reinigung 2 offeriert. Sie können zwar eine Quittung erstellen, aber die Daten müssen Sie selbst eingeben. Fortfahren?")) 
            {
            location.href = this.href;
            }
        }
    });
});

// Teklif Dosyası Onay Kontrol
$(function() {
    $('#createUmzug').click(function(e) {
        let status = '{{ $data['offerteStatus'] }}';
        console.log(status,'STATUS')
        e.preventDefault();
        if(status == "Onaylanmadı")
        {
            if (window.confirm("Noch NICHT bestätigt durch den Kunden, möchten Sie trotzdem einen Termin erstellen?")) 
            {
            location.href = this.href;
            }
        }
        else{
            location.href = this.href;
        }
        
    });
});

    $("#bestForm :input").prop("disabled", true);

    console.log($('select[name=contactPerson]').val(),'contact')
    $('select[name=contactPerson]').on('change', function() {
        if($('select[name=contactPerson]').val() != 0)
        {
        $(".customContactPerson").hide(300)
        }
        else {
        $(".customContactPerson").show(300)
        }
    })
    
</script>
<script>       
    var morebutton = $("div.email-send");
    var morebutton10 = $("div.verpackungsmaterial-control");

    morebutton10.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            
            $(".verpackungsmaterial--area").show(700);
        }
        else{
            $(".verpackungsmaterial--area").hide(500);
        }
    })

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
    tinymce.init({
      selector: 'textarea.editor',
      plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
      toolbar_mode: 'floating',
      apply_source_formatting : true,
      plugins: 'code',
    });
</script>

@yield('offerFooter')
@yield('offerFooter1')
@yield('offerFooter2')
@yield('offerFooterAus')
@yield('offerFooterReinigung')
@yield('offerFooterReinigung2')
@yield('offerEntsorgung')
@yield('offerFooterTransport')
@yield('offerFooterLagerung')
@yield('offerMaterial')
@endsection