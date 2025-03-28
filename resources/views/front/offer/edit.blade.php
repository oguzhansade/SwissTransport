
@extends('layouts.app')

@section('header')

<style>
    .checkbox .label-text:after {
        border-color: #999494;
    }
</style>
@endsection

@section('content')
@section('sidebarType') sidebar-collapse @endsection
<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Offerte bearbeiten</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Panel</a>
            </li>
            <li class="breadcrumb-item active">Offerte</li>
        </ol>
        <div class="d-none d-md-inline-flex justify-center align-items-center">
            <a href="{{ route('offer.create',['id' => $customer['id']]) }}" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Neue Offerte erfassen</a>
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
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <span class="h5 font-weight-bolder"> <strong>Kunde:</strong>  </span> <span class="h5 ml-3 text-primary"> <a href="{{ route('customer.detail',['id' => $data['customerId']]) }}"> <u>{{ $customer['name'] }} {{ $customer['surname'] }}</u></a></span>
                                </div>
                                <div class="col-md-12">
                                    <span class="h5 font-weight-bolder"> <strong>Offertennr:</strong> </span> <span class="h5 ml-3 text-primary">{{ $data['id'] }}</span>
                                </div>
                                <div class="col-md-12">
                                    <span class="h5 font-weight-bold text-dark"> <strong>Stand:</strong> </span> <span class="h5 ml-3 font-weight-bold text-primary">@if($data['offerteStatus']  &&  $data['offerteStatus']  == 'Onaylandı') Zugelassen @else Nicht Bestätigt  @endif</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="" class="col-form-label">Besichtigung</label><br>
                                    <select class="form-control" name="appOfferType" id="appOfferType">
                                        <option value="0" @if($data['appType'] == 0) selected @endif>Nein</option>
                                        <option value="1" @if($data['appType'] == 1) selected @endif>Gemacht</option>
                                        <option value="2" @if($data['appType'] == 2) selected @endif>Reinigung Nein</option>
                                        <option value="3" @if($data['appType'] == 3) selected @endif>Reinigung Gemacht</option>
                                    </select>
                                </div>
                            </div>



                            <div class="componentArea">
                                {{-- Offerte Umzug  Alanı --}}
                                @include('front.offer.editComponents.offerUmzug',[
                                    'auszug1' => $data['auszugaddressId'],
                                    'auszug2' => $data['auszugaddressId2'],
                                    'auszug3' => $data['auszugaddressId3'],
                                    'einzug1' => $data['einzugaddressId'],
                                    'einzug2' => $data['einzugaddressId2'],
                                    'einzug3' => $data['einzugaddressId3'],
                                    ])
                            {{-- Offerte Umzug Alanı --}}

                            {{-- Offerte Umzug 2 Alanı --}}
                                @include('front.offer.editComponents.offerUmzug2',['umzug' => $data['offerteUmzugId']])
                            {{-- Offerte Umzug 2 Alanı --}}

                            {{-- Offerte Einpack Alanı --}}
                                @include('front.offer.editComponents.offerEinpack',['einpack' => $data['offerteEinpackId']])
                            {{-- Offerte Einpack Alanı --}}

                            {{-- Offerte Auspack Alanı --}}
                                @include('front.offer.editComponents.offerAuspack',['auspack' => $data['offerteAuspackId']])
                            {{-- Offerte Auspack Alanı --}}

                            {{-- Offerte Reinigung Alanı --}}
                                @include('front.offer.editComponents.offerReinigung',['reinigung' => $data['offerteReinigungId']])
                            {{-- Offerte Reinigung Alanı --}}

                            {{-- Offerte Reinigung2 Alanı --}}
                                @include('front.offer.editComponents.offerReinigung2',['reinigung2' => $data['offerteReinigung2Id']])
                            {{-- Offerte Reinigung2 Alanı --}}

                            {{-- Offerte Entsorgung Alanı --}}
                                @include('front.offer.editComponents.offerEntsorgung',['entsorgung' => $data['offerteEntsorgungId']])
                            {{-- Offerte Entsorgung Alanı --}}

                            {{-- Offerte Transport Alanı --}}
                                @include('front.offer.editComponents.offerTransport',['transport' => $data['offerteTransportId']])
                            {{-- Offerte Transport Alanı --}}

                            {{-- Offerte Lagerung Alanı --}}
                                @include('front.offer.editComponents.offerLagerung',['lagerung' => $data['offerteLagerungId']])
                            {{-- Offerte Lagerung Alanı --}}

                            {{-- Offerte Material Alanı --}}
                                @include('front.offer.editComponents.offerMaterial',['material' => $data['offerteMaterialId']])
                            {{-- Offerte Material Alanı --}}
                            </div>

                            <div class="form-group row d-none">
                                <div class="col-md-5">
                                    <label for="" class="col-form-label">Esimated Income</label><br>
                                    <input class="form-control text-white" type="text" name="offerteEsimatedIncome" style="background-color: #286090" readonly>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-12 ">
                                    <label for="" class="col-form-label ">Bemerkung (in Offerte)</label><br>
                                    <textarea id="offertePdfNote" class="form-control pdfNoteOfferte" name="offertePdfNote" id="" cols="15" rows="5" >{{ $data['offerteNote'] }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 ">
                                    <label for="" class="col-form-label">Notiz (<u>Nicht</u> in Offerte)</label><br>
                                    <textarea id="offertePdfNote"  class="form-control" name="offerteNote" id="" cols="15" rows="5" >{{ $data['panelNote'] }}</textarea>
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
                                        <option selected>Bitte wählen</option>
                                        @foreach (\App\Models\ContactPerson::all() as $key => $value)
                                        <option value=" {{ $value['name'] .' '. $value['surname'] }}" @if ($data['contactPerson'] == $value['name'].' '.$value['surname']) selected @endif>{{ $value['name']  }} {{ $value['surname'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 customContactPerson" style="display:block;">
                                    <label class=" col-form-label" for="l0">Kontaktperson (Freitext)</label>
                                    <input class="form-control" name="customContactPerson"  type="text"@if($data['contactPerson'] == 'Bitte wählen') value="{{ \App\Models\Company::InfoCompany('name') }} Team" @else value="{{ $data['contactPerson'] }}" @endif>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 email-send">
                                    <label for="" class="col-form-label">E-Mail an Kunden</label><br>
                                    <input type="checkbox" name="isEmail" id="isEmail" class="js-switch " data-color="#286090" data-switchery="false"  >
                                </div>
                            </div>


                            <div class="row form-group email--area" style="display: block;">
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">E-Mail Adresse </label>
                                    <input class="form-control" name="email"  type="text" value="{{   $customer['email']  }}" >
                                </div>


                                <div class="col-md-12 email-format">
                                    <label for="" class="col-form-label">Standard Emailtext bearbeiten</label><br>
                                    <input type="checkbox" name="isCustomEmail" id="isCustomEmail" class="js-switch isCustomEmail" data-color="#286090" data-switchery="false" >
                                </div>
                            </div>

                            <div class="row form-group email--format" style="display: none;">
                                <div class="col-md-12 mt-3">
                                    <textarea class="editor" name="customEmail" id="customEmail" cols="30" rows="10">
                                        @if($customEmail) {{ $customEmail['content'] }}
                                            @else
                                                @include('../../offerMailHeader',['data2' => $data,'appType' => $data['appType']])
                                        @endif
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 sms-send">
                                    <label for="" class="col-form-label">SMS an Kunden</label><br>
                                    <input type="checkbox" name="isSMS" id="isSMS" class="js-switch " data-color="#286090" data-switchery="false" >
                                </div>
                            </div>

                            <div class="col-md-12 sms-format">
                                <label for="" class="col-form-label">Standard SMStext bearbeiten</label><br>
                                <input type="checkbox" name="isCustomSMS" id="isCustomSMS" class="js-switch isCustomSMS" data-color="#286090" data-switchery="false" >
                            </div>

                            <div class="row form-group sms-format-area" style="display: none;">
                                <div class="col-md-12 mt-3">
                                    <textarea maxlength="190" id="editor2" class="form-control" name="customSMS" id="customSMS" cols="10" rows="5" >Offer Updated</textarea>
                                    <small class="text-primary"><i>Max Characters:190</i></small>
                                </div>
                            </div>

                            <div class="form-group row ">
                                <div class="col-md-12 campaing">
                                    <label for="" class="col-form-label">Kampanya (UMZUG)</label><br>
                                    <input type="checkbox" name="isCampaign" id="isCampaign" class="js-switch isCampaign" data-color="#286090" data-switchery="false" @if($data["isCampaign"]) checked @endif>
                                </div>
                            </div>

                            <div class="row form-group campaign-value-area" @if($data['isCampaign'] == NULL) style="display: none;" @endif>
                                <div class="col-md-3 ">
                                    <div class="input-group">
                                        <div class="input-group-addon bg-primary">
                                          %
                                        </div>
                                        <input type="number" name="campaignValue" class="form-control"  placeholder="0" @if($data['isCampaign']) value="{{ $data['isCampaign'] }}" @else value="20" @endif>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="form-group row mt-3">
                                    <div class="col-md-12 ml-md-auto btn-list">
                                        <input id="submitButton" class="btn btn-primary btn-rounded" type="submit" value="Erstellen" formaction="{{ route('offer.update',['id' => $data['id']]) }}">
                                        <input class="btn btn-danger btn-rounded" type="submit" value="PDF Preview" formtarget="_blank" formaction="{{ route('offer.offerPdfPreviewEdit',['id' => $data['id']]) }}">
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

{{-- Offerte oluştururken loading bar --}}
<script>

    //Bemerkungen Summernote Disable
    $('#offertePdfNote').summernote({
            height: '130px',
            spellCheck: false,
    });

    $(document).ready(function() {
        $('#submitButton').on('click', function(event) {
            // Form geçerli mi kontrol ediliyor
            if (!$('#offerForm')[0].checkValidity()) {
                // Form geçerli değilse 'loading-body' gizlenir
                $('#loading-body').hide();
                return; // Gönderimi durdurur
            }

            // Form geçerliyse 'loading-body' gösterilir
            $('#loading-body').show();
        });

        // Sayfa tamamen yüklendiğinde 'loading-body' gizlenir
        $(window).on('load', function() {
            $('#loading-body').hide();
        });

        $('#offertePdfNote').summernote({
            height: '130px',
        });

        $('#customEmail').summernote({
            height: '130px',
        });
    });
</script>

<script>
    var smsFormatbutton = $("div.sms-format");
    smsFormatbutton.click(function() {
    if ($(this).hasClass("checkbox-checked"))
    {
        $(".sms-format-area").show(700);
    }
    else {
        $(".sms-format-area").hide(500);
    }
    })

</script>

<script>

    let serviceCheckboxes = ['#isUmzug', '#isEinpack', '#isAuspack', '#isReinigung', '#isReinigung2', '#isEntsorgung', '#isTransport', '#isLagerung', '#isVerpackungsmaterial'];
    $("body").on("change",".componentArea",function () {
        // Check if isReinigung is selected and no other checkboxes are selected
        if ($('#isReinigung').is(':checked') && $(serviceCheckboxes.join(':checked,') + ':checked').length === 1 && $('#termineCount').val() > 0) {
            console.log('sadece Reinigung termine var')
            $('#appOfferType').val('3');
        }
        else if($('#isReinigung').is(':checked') && $(serviceCheckboxes.join(':checked,') + ':checked').length === 1 && $('#termineCount').val() <= 0){
            console.log('sadece Reinigung termine yok')
            $('#appOfferType').val('2');
        }
        if($('input[name=umzugTotalPrice]').val())
        {
            let ilkTotal = $('input[name=umzugTotalPrice]').val();
            var prices = ilkTotal.split('-');

            var lowerPrice = parseInt(prices[0], 10);
            var upperPrice = parseInt(prices[1], 10);

            console.log('Lower Price:', lowerPrice);
            console.log('Upper Price:', upperPrice);
        }
    });

    $(document).ready(function(){
        contactPerson()
        esimatedIncome()
    })

    $("body").on("change",".componentArea",function(){
        esimatedIncome()
    })

    function contactPerson() {
        if($('select[name=contactPerson]').val() != 'Bitte wählen')
        {
        $(".customContactPerson").hide(300)
        }
        else {
        $(".customContactPerson").show(300)
        }
    }
    console.log($('select[name=contactPerson]').val(),'contact')
    $('select[name=contactPerson]').on('change', function() {
        if($('select[name=contactPerson]').val() != 'Bitte wählen')
        {
        $(".customContactPerson").hide(300)
        }
        else {
        $(".customContactPerson").show(300)
        }
    })
    function priceSplitter(value){
        const splitValues = value.split("-");
        return finalValue = parseFloat(splitValues[1]);
    }
    function esimatedIncome() {
        let esimatedIncome = 0;
        let umzug = $("input[name=umzugTotalPrice]").val();
        let einpack = $("input[name=einpackTotalPrice]").val();
        let auspack = $("input[name=auspackTotalPrice]").val();
        let reinigung = $("input[name=reinigungTotalPrice]").val();
        let reinigung2 = $("input[name=reinigungTotalPrice2]").val();
        let entsorgung = $("input[name=entsorgungTotalPrice]").val();
        let transport = $("input[name=transportDefaultPrice]").val();
        let lagerung = $("input[name=lagerungCost]").val();
        let material = $("input[name=materialTotalPrice]").val();

        if (umzug) {
            if(umzug.includes("-")) {
                umzug = priceSplitter(umzug);
            }else{
                umzug = parseFloat(umzug);
            }
        }else{umzug = 0}

        if (einpack) {
            if(einpack.includes("-")) {
                einpack = priceSplitter(einpack);
            }else{
                einpack = parseFloat(einpack);
            }
        }else{einpack = 0}

        if (auspack) {
            if(auspack.includes("-")) {
                auspack = priceSplitter(auspack);
            }else{
                auspack = parseFloat(auspack);
            }
        }else{auspack = 0}

        if (reinigung) {
            if(reinigung.includes("-")) {
                reinigung = priceSplitter(reinigung);
            }else{
                reinigung = parseFloat(reinigung);
            }
        }else{reinigung = 0}

        if (reinigung2) {
            if(reinigung2.includes("-")) {
                reinigung2 = priceSplitter(reinigung2);
            }else{
                reinigung2 = parseFloat(reinigung2);
            }
        }else{reinigung2 = 0}

        if (entsorgung) {
            if(entsorgung.includes("-")) {
                entsorgung = priceSplitter(entsorgung);
            }else{
                entsorgung = parseFloat(entsorgung);
            }
        }else{entsorgung = 0}

        if (transport) {
            if(transport.includes("-")) {
                transport = priceSplitter(transport);
            }else{
                transport = parseFloat(transport);
            }
        }else{transport = 0}

        if (lagerung) {
            if(lagerung.includes("-")) {
                lagerung = priceSplitter(lagerung);
            }else{
                lagerung = parseFloat(lagerung);
            }
        }else{lagerung = 0}

        if (material) {
            if(material.includes("-")) {
                material = priceSplitter(material);
            }else{
                material = parseFloat(material);
            }
        }else{material = 0}

        esimatedIncome =
        parseFloat(umzug) +
        parseFloat(einpack) +
        parseFloat(auspack) +
        parseFloat(reinigung) +
        parseFloat(reinigung2) +
        parseFloat(entsorgung) +
        parseFloat(transport) +
        parseFloat(lagerung) +
        parseFloat(material);
        $("input[name=offerteEsimatedIncome]").val(esimatedIncome.toFixed(2));
    }
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

    var campaignShowButton = $("div.campaing");
    campaignShowButton.click(function() {
        if ($(this).hasClass("checkbox-checked")) {
            $(".campaign-value-area").show(700);
        } else {
            $(".campaign-value-area").hide(500);
        }
    })

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

<script>
    $("select[name=appOfferType]").on("change", function() {
        value = $(this).val();
        console.log(value, 'AppType')
        switch (value) {
            case '0':
                // TODO: bu bölüm blade import değil api olarak kullanılacak
                $('#customEmail').summernote('code', `@include('../../offerMailHeader', ['data2' => '${data}', 'appType' => '0'])`);
                break;
            case '1':
                // TODO: bu bölüm blade import değil api olarak kullanılacak
                $('#customEmail').summernote('code', `@include('../../offerMailHeader', ['data2' => '${data}', 'appType' => '1'])`);
                break;
            case '2':
                // TODO: bu bölüm blade import değil api olarak kullanılacak
                $('#customEmail').summernote('code', `@include('../../offerMailHeader', ['data2' => '${data}', 'appType' => '2'])`);
                break;
            default:
                $('#customEmail').summernote('code', `@include('../../offerMailHeader', ['data2' => '${data}', 'appType' => '0'])`);

        }
    })
</script>

@yield('offerAuspackEdit')
@yield('offerEinpackEdit')
@yield('offerEntsorgungEdit')
@yield('offerLagerungEdit')
@yield('offerMaterialEdit')
@yield('offerReinigungEdit')
@yield('offerReinigung2Edit')
@yield('offerTransportEdit')
@yield('offerUmzugEdit')
@yield('offerUmzug2Edit')
@endsection
