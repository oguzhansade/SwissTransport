@extends('layouts.app')

@section('header')

    <style>
        .checkbox .label-text:after {
            border-color: #999494;
        }

        /* Notification kutusunun stilini değiştirme */
        .toast {
            opacity: 1;
        }

        /* Butonların stilini değiştirme */
        .toast .toast-close-button {
            /* buton arka plan rengi */
            color: #ffffff;
            /* buton yazı rengi */
        }
    </style>
@endsection

@section('content')
@section('sidebarType')
    sidebar-collapse
@endsection
<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Neue Offerte erfassen </h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Panel</a>
            </li>
            <li class="breadcrumb-item active">Offerte</li>
        </ol>
        <div class="d-none d-md-inline-flex justify-center align-items-center"><a
                href="{{ route('offer.create', ['id' => $data['id']]) }}"
                class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple"
                target="_blank">Neue Offerte erfassen</a>
        </div>
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

<div class="widget-list">
    <div class="row">
        <div class="col-md-12">
            <strong class="h5 mr-1"> <b>Kunde:</b> </strong> <span class="h5 text-primary ">
                {{ App\Models\Customer::getPublicName(request()->route('id')) }}</span>
        </div>
        <div class="col-md-12 widget-holder">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <form id="offerForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="" class="col-form-label">Besichtigung</label><br>
                                <input id="termineCount" type="hidden" value="{{ $termineCount }}">
                                <select class="form-control" name="appOfferType" id="appOfferType">
                                    <option value="0" selected>Nein</option>
                                    <option value="1">Gemacht</option>
                                    <option value="2">Reinigung Nein </option>
                                    <option value="3">Reinigung Gemacht </option>
                                </select>
                            </div>
                        </div>

                        <div class="componentArea">
                            {{-- Offerte Umzug  Alanı --}}
                            @include('front.offer.offerUmzug')
                            {{-- Offerte Umzug Alanı --}}


                            {{-- Offerte Umzug 2 Alanı --}}
                            @include('front.offer.offerUmzug2')
                            {{-- Offerte Umzug 2 Alanı --}}

                            <div class="form-group row">
                                <div class="col-md-12 einpack-control">
                                    <label for="" class="col-form-label">Einpack</label><br>
                                    <input type="checkbox" name="isEinpack" id="isEinpack" class="js-switch "
                                        data-color="#286090" data-switchery="false">
                                </div>
                            </div>

                            {{-- Offerte Einpack Alanı --}}
                            <div class="rounded einpack--area bg-service-primary" style=" display:none;">
                                @include('front.offer.offerEinpack')
                            </div>
                            {{-- Offerte Einpack Alanı --}}


                            <div class="form-group row">
                                <div class="col-md-12 auspack-control">
                                    <label for="" class="col-form-label">Auspack</label><br>
                                    <input type="checkbox" name="isAuspack" id="isAuspack" class="js-switch "
                                        data-color="#286090" data-switchery="false">
                                </div>
                            </div>

                            {{-- Offerte Auspack Alanı --}}
                            <div class="rounded auspack--area bg-service-primary" style="display:none;">
                                @include('front.offer.offerAuspack')
                            </div>
                            {{-- Offerte Auspack Alanı --}}



                            {{-- Offerte Reinigung Alanı --}}
                            @include('front.offer.offerReinigung')
                            {{-- Offerte Reinigung Alanı --}}

                            <div class="form-group row">
                                <div class="col-md-12 reinigung2-control">
                                    <label for="" class="col-form-label">Reinigung 2</label><br>
                                    <input type="checkbox" name="isReinigung2" id="isReinigung2" class="js-switch "
                                        data-color="#286090" data-switchery="false">
                                </div>
                            </div>

                            {{-- Offerte Reinigung2 Alanı --}}
                            @include('front.offer.offerReinigung2')
                            {{-- Offerte Reinigung2 Alanı --}}



                            {{-- Offerte Entsorgung Alanı --}}
                            @include('front.offer.offerEntsorgung')
                            {{-- Offerte Entsorgung Alanı --}}


                            {{-- Offerte Transport Alanı --}}
                            @include('front.offer.offerTransport')
                            {{-- Offerte Transport Alanı --}}




                            {{-- Offerte Lagerung Alanı --}}
                            @include('front.offer.offerLagerung')
                            {{-- Offerte Lagerung Alanı --}}


                            <div class="form-group row">
                                <div class="col-md-12 verpackungsmaterial-control">
                                    <label for="" class="col-form-label">Verpackungsmaterial</label><br>
                                    <input type="checkbox" name="isVerpackungsmaterial" id="isVerpackungsmaterial"
                                        class="js-switch " data-color="#286090" data-switchery="false">
                                </div>
                            </div>

                            {{-- Offerte Material Alanı --}}
                            <div class="rounded verpackungsmaterial--area bg-service-primary" style="display:none;">
                                @include('front.offer.offerMaterial')
                            </div>
                            {{-- Offerte Material Alanı --}}

                        </div>

                        <div class="form-group row d-none">
                            <div class="col-md-5">
                                <label for="" class="col-form-label">Esimated Income</label><br>
                                <input class="form-control text-white" type="text" name="offerteEsimatedIncome" style="background-color: #8778AA">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 ">
                                <label for="" class="col-form-label">Bemerkung (in Offerte)</label><br>
                                <textarea class="form-control pdfNoteOfferte " name="offertePdfNote" id="" cols="15" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 ">
                                <label for="" class="col-form-label">Notiz (<u>nicht</u> in Offerte)</label><br>
                                <textarea class="form-control  text-dark" name="offerteNote" id="" cols="15" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12  p-3 rounded" style="background-color: #eae9ec;">
                            <label class="col-form-label">Zusätzliche Merkmale</label>
                            <div class="col-md-12 ">
                                <div class="checkbox checkbox-rounded checkbox-primary ">
                                    <label class="">
                                        <input type="checkbox" name="kdvType" value="1"> <span
                                            class="label-text text-dark"><strong>Kosten inkl. MwSt.</strong></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="checkbox checkbox-rounded checkbox-primary">
                                    <label class="">
                                        <input type="checkbox" name="kdvType1" value="1" checked> <span
                                            class="label-text text-dark"><strong>Kosten exkl. MwSt.</strong></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="checkbox checkbox-rounded checkbox-primary">
                                    <label class="">
                                        <input type="checkbox" name="kdvType3" value="1"> <span
                                            class="label-text text-dark "><strong>Kostenfrei MwSt.</strong></span>
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
                                        <option value="{{ $value['name'] . ' ' . $value['surname'] }}">
                                            {{ $value['name'] }}
                                            {{ $value['surname'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 customContactPerson" style="display:block;">
                                <label class=" col-form-label" for="l0">Kontaktperson (Freitext)</label>
                                <input class="form-control" name="customContactPerson" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 email-send">
                                <label for="" class="col-form-label"> E-Mail an Kunden</label><br>
                                <input type="checkbox" name="isEmail" id="isEmail" class="js-switch "
                                    data-color="#286090" data-switchery="false" >
                            </div>
                        </div>


                        <div class="row form-group email--area" style="display: block;">
                            <div class="col-md-12">
                                <label class=" col-form-label" for="l0">E-Mail Adresse</label>
                                <input class="form-control" name="email" type="text"
                                    value="{{ $data['email'] }}">
                            </div>

                            <div class="col-md-12 email-format">
                                <label for="" class="col-form-label">Standard Emailtext bearbeiten</label><br>
                                <input type="checkbox" name="isCustomEmail" id="isCustomEmail"
                                    class="js-switch isCustomEmail" data-color="#286090" data-switchery="false">
                            </div>
                        </div>

                        <div class="row form-group email--format" style="display: none;">
                            <div class="col-md-12 mt-3">
                                <textarea class="editor" name="customEmail" id="customEmail" cols="30" rows="10">
                                            @include('../../offerMailHeader', [
                                                'data2' => $data,
                                                'appType' => '0',
                                            ])
                                    </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 sms-send">
                                <label for="" class="col-form-label">SMS an Kunden</label><br>
                                <input type="checkbox" name="isSMS" id="isSMS" class="js-switch "
                                    data-color="#286090" data-switchery="false">
                            </div>
                        </div>



                        <div class="mobile-area" style="display:none;">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">Mobile</label>
                                    <input class="form-control" name="mobile" type="text"
                                        value="{{ $data['mobile'] }}">
                                    <small class="text-primary">Beispiel: +41 20 211 12 21</small>
                                </div>
                            </div>

                            <div class="col-md-12 sms-format">
                                <label for="" class="col-form-label">Standard SMStext bearbeiten</label><br>
                                <input type="checkbox" name="isCustomSMS" id="isCustomSMS"
                                    class="js-switch isCustomSMS" data-color="#286090" data-switchery="false">
                            </div>

                            <div class="row form-group sms-format-area" style="display: none;">
                                <div class="col-md-12 mt-3">
                                    <textarea maxlength="190" id="editor2" class="form-control" name="customSMS" id="customSMS" cols="10"
                                        rows="5">Offer Created</textarea>
                                    <small class="text-primary"><i>Max Characters:190</i></small>
                                </div>
                            </div>

                        </div>


                        <div class="form-group row">
                            <div class="col-md-12 campaing">
                                <label for="" class="col-form-label">Kampanya (UMZUG)</label><br>
                                <input type="checkbox" name="isCampaign" id="isCampaign" class="js-switch isCampaign" data-color="#286090" data-switchery="false" >
                            </div>
                        </div>

                        <div class="row form-group campaign-value-area" style="display: none;">
                            <div class="col-md-3 ">
                                <div class="input-group">
                                    <div class="input-group-addon bg-primary">
                                      %
                                    </div>
                                    <input type="number" name="campaignValue" class="form-control"  placeholder="0" value="20">
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="form-group row mt-3">
                                <div class="col-md-12 ml-md-auto btn-list">
                                    <input id="submitButton" class="btn btn-primary btn-rounded" type="submit" value="Erstellen"
                                        formaction="{{ route('offer.store', ['id' => $data['id']]) }}">
                                    <input class="btn btn-danger btn-rounded" type="submit" value="PDF Preview"
                                        formtarget="_blank"
                                        formaction="{{ route('offer.offerPdfPreview', ['id' => $data['id']]) }}">
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
    });
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
    });


    $("form").submit(function(event) {
        let checkMobile = phoneValidation();
        let checkMaterial = materialValidation();
        if ($("div.sms-send").hasClass("checkbox-checked")) {
            if (!checkMobile) {
                console.log('Telefon Validasyon False')
                return false;
            }
        }
        if ($("div.verpackungsmaterial-control").hasClass("checkbox-checked")) {
            if (!checkMaterial) {
                console.log('Material Validasyon False')
                return false;
            }
        }
    })


    function materialValidation() {
        let isValid = true;
        if ($("div.verpackungsmaterial-control").hasClass("checkbox-checked")) {
            $('.islem_field').each(function(index) {
                let urunIsmi = $(this).closest('.islem_field').find('.urun').find(
                    ":selected").data("urunadi")
                let buyType = $(this).closest('.islem_field').find('.buyType').find(
                    ":selected").data("buy")
                if (!urunIsmi) {
                    $(this).closest('.islem_field').find('.urun').focus().css(
                        'border-color', 'red')
                    toastr.error('Produktname ist leer', 'Fehler!');
                    console.log('URUN İSMİ HATASI');
                    isValid = false;
                    console.log(isValid, 'Ürün İsmi')
                    return false;

                } else {
                    $(this).closest('.islem_field').find('.urun').css('border-color',
                    ''); // önceki uyarı mesajını kaldır
                    isValid = true;
                }
                if (!buyType) {

                    $(this).closest('.islem_field').find('.buyType').focus().css(
                        'border-color', 'red');
                    toastr.error('Kauf/Mieten ist leer', 'Fehler!');
                    // alert('Die Miet/Kauf Option in Zeile ' + (index+1) + ' ist leer!');
                    console.log('buyType HATASI');
                    isValid = false;
                    console.log(isValid, 'BuyType')
                    return false;
                } else {
                    $(this).closest('.islem_field').find('.buyType').css('border-color', '')
                    isValid = true;
                }
            });

            if ($('.urun').length === 0) { // ürün yoksa
                toastr.error('Fügen Sie mindestens ein Produkt hinzu', 'Fehler!');
                console.log('urun Sayısı HATASI');
                isValid = false;
                console.log(isValid, 'Urun Sayısı')
                return false; // işlemi durdur
            }
        }
        return isValid;
    }

    function phoneValidation() {
        let isValid = true;
        if ($("div.sms-send").hasClass("checkbox-checked")) {
            var phoneNum = $("input[name=mobile]").val();

            // Tüm boşlukları kaldır
            phoneNum = phoneNum.replace(/\s/g, '');

            // Ülke kodu ve telefon numarasını ayırma
            var countryCode = phoneNum.substring(0, 3);
            var areaCode = phoneNum.substring(3, 5);
            var phoneNumber = phoneNum.substring(5);

            // Ülke kodu kontrolü
            var countryRegex = /^\+\d{1,3}$/;

            // Telefon numarası kontrolü
            var phoneRegex = /^\d{6,}$/;

            if (!countryRegex.test(countryCode) || !phoneRegex.test(phoneNumber)) {
                console.log("Yanlış Telefon Formatı");
                toastr.error('Falsches Telefonformat.', 'Fehler!');
                let isValid = false;
                return false; // Form gönderimini durdur

            }

                console.log("Telefon numarası doğru formatlıdır. Ülke kodu: " + countryCode);
                console.log("Telefon numarası doğru formatlıdır. Alan kodu: " + areaCode);
                console.log("Telefon numarası doğru formatlıdır. Numara: " + phoneNumber);



        }
        return isValid;
    }
    $("input[name=mobile]").on("input", function() {
        phoneValidation()
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

    var smsFormatbutton = $("div.sms-format");
    smsFormatbutton.click(function() {
        if ($(this).hasClass("checkbox-checked")) {
            $(".sms-format-area").show(700);
        } else {
            $(".sms-format-area").hide(500);
        }
    })

    var mobilePhonebutton = $("div.sms-send");
    mobilePhonebutton.click(function() {
        if ($(this).hasClass("checkbox-checked")) {
            $(".mobile-area").show(500);
            $("input[name=mobile]").prop('required', true)
        } else {
            $(".mobile-area").hide(300);
            $("input[name=mobile]").prop('required', false)
        }
    })
</script>

<script>
    $(document).ready(function() {
        contactPerson()
        esimatedIncome();
    })
    var defaultContactPerson = @json(App\Models\Company::InfoCompany('name'));
    $("body").on("change",".componentArea",function(){
        esimatedIncome()
    })

    function contactPerson() {
        if ($('select[name=contactPerson]').val() != 'Bitte wählen') {
            $(".customContactPerson").hide(300)
        } else {
            $(".customContactPerson").show(300)
            $("input[name=customContactPerson]").val(defaultContactPerson + ' ' + 'Team')
        }
    }

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
        $("input[name=offerteEsimatedIncome]").val(esimatedIncome);
    }


    console.log($('select[name=contactPerson]').val(), 'contact')
    $('select[name=contactPerson]').on('change', function() {
        if ($('select[name=contactPerson]').val() != 'Bitte wählen') {
            $(".customContactPerson").hide(300)
        } else {
            $(".customContactPerson").show(300)
            $("input[name=customContactPerson]").val(defaultContactPerson+ ' ' + 'Team')
        }
    })
</script>
<script>
    var morebutton = $("div.email-send");
    var morebutton3 = $("div.einpack-control");
    var morebutton4 = $("div.auspack-control");
    var morebutton10 = $("div.verpackungsmaterial-control");

    morebutton10.click(function() {
        if ($(this).hasClass("checkbox-checked")) {
            $(".verpackungsmaterial--area").show(700);
        } else {
            $(".verpackungsmaterial--area").hide(500);
        }
    })

    morebutton4.click(function() {
        if ($(this).hasClass("checkbox-checked")) {
            $(".auspack--area").show(700);
            $("input[name=auspackisExtra]").prop('checked', true);
            $("input[name=auspackmasraf]").prop('checked', true);
            $("select[name=auspackTariff]").prop('required', true);
            $("input[name=auspackHours]").prop('required', true);
            $("input[name=auspack1ma]").prop('required', true);
            $("input[name=auspack1chf]").prop('required', true);
        } else {
            $(".auspack--area").hide(500);
            $("input[name=auspackisExtra]").prop('checked', false);
            $("input[name=auspackmasraf]").prop('checked', false);
            $("select[name=auspackTariff]").prop('required', false);
            $("input[name=auspackHours]").prop('required', false);
            $("input[name=auspack1ma]").prop('required', false);
            $("input[name=auspack1chf]").prop('required', false);

        }
    })

    morebutton3.click(function() {
        if ($(this).hasClass("checkbox-checked")) {
            $(".einpack--area").show(700);
            $("select[name=einpackTariff]").prop('required', true);
            $("input[name=einpackHours]").prop('required', true);
            $("input[name=einpack1ma]").prop('required', true);
            $("input[name=einpack1chf]").prop('required', true);

        } else {
            $(".einpack--area").hide(500);
            $("select[name=einpackTariff]").prop('required', false);
            $("input[name=einpackHours]").prop('required', false);
            $("input[name=einpack1ma]").prop('required', false);
            $("input[name=einpack1chf]").prop('required', false);
        }
    })

    morebutton.click(function() {
        if ($(this).hasClass("checkbox-checked")) {
            $(".email--area").show(700);
            $("input[name=email]").prop('required', true);
        } else {
            $(".email--area").hide(500);
            $("input[name=email]").prop('required', false);
        }
    })
</script>

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

<script>
    tinymce.init({
        selector: 'textarea.pdfNoteOfferte',
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
        toolbar_mode: 'floating',
        apply_source_formatting: true,
        plugins: 'code',
    });
</script>

<script>
    tinymce.init({
        selector: 'textarea.editor',
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
        toolbar_mode: 'floating',
        apply_source_formatting: true,
        plugins: 'code',
    });
</script>
<script>
    $("select[name=appOfferType]").on("change", function() {
        value = $(this).val();
        tinymce.execCommand("mceRepaint");
        console.log(value, 'AppType')
        switch (value) {
            case '0':
                // TODO: bu bölüm blade import değil api olarak kullanılacak
                tinymce.get("customEmail").setContent(`@include('../../offerMailHeader', ['data2' => '${data}', 'appType' => '0'])`);
                tinymce.execCommand("mceRepaint");
                break;
            case '1':
                // TODO: bu bölüm blade import değil api olarak kullanılacak
                tinymce.get("customEmail").setContent(`@include('../../offerMailHeader', ['data2' => '${data}', 'appType' => '1'])`);
                tinymce.execCommand("mceRepaint");
                break;
            case '2':
                // TODO: bu bölüm blade import değil api olarak kullanılacak
                tinymce.get("customEmail").setContent(`@include('../../offerMailHeader', ['data2' => '${data}', 'appType' => '2'])`);
                tinymce.execCommand("mceRepaint");
                break;
            default:
                tinymce.get("customEmail").setContent(`@include('../../offerMailHeader', ['data2' => '${data}', 'appType' => '0'])`);
                tinymce.execCommand("mceRepaint");
        }
    })
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
@yield('offerMaterialCreate')
@endsection
