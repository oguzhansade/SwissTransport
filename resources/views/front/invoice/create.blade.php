@extends('layouts.app')

@section('header')
    <style>
        .checkbox .label-text:after {
            border-color: #999494;
        }
    </style>
@endsection

@section('content')
    @section('sidebarType')
        sidebar-collapse
    @endsection
<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Neue Rechnung Erstellen</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Panel</a>
            </li>
            <li class="breadcrumb-item active">Rechnung</li>
        </ol>
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

<div class="widget-list invoice-area">
    <div class="row">
        <div class="col-md-12">
            <strong class="h5 mr-1"> <b>Kunde:</b> </strong> <span class="h5 text-primary ">
                {{ App\Models\Customer::getPublicName(request()->route('id')) }}</span>
        </div>
        <div class="col-md-12 widget-holder">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <form id="invoiceForm" action="{{ route('invoice.store', ['id' => $data['id']]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row border-bottom mb-2">
                            <div class="col-md-12 mb-2">
                                <label for="" class="col-form-label">Zahlungsfrist:</label>
                                <div class="radiobox">
                                    <label class="text-dark">
                                        <input type="radio" class="payCondition" name="payCondition" value="1"
                                            checked>
                                        <span class="label-text">In 7 Tagen</span>
                                    </label>
                                    <label class="text-dark ml-1">
                                        <input type="radio" class="payCondition" name="payCondition" value="2">
                                        <span class="label-text">In 14 Tagen</span>
                                    </label>
                                    <label class="text-dark ml-1">
                                        <input type="radio" class="payCondition" name="payCondition" value="3">
                                        <span class="label-text">In 31 Tagen</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- Invoice Umzug 2 Alanı --}}
                        @include('front.invoice.invoiceComponents.invoiceUmzug2')
                        {{-- Invoice Umzug 2 Alanı --}}

                        {{-- Invoice Einpackservice Alanı --}}
                        @include('front.invoice.invoiceComponents.invoiceEinpack')
                        {{-- Invoice Einpackservice Alanı --}}

                        {{-- Invoice Auspackservice Alanı --}}
                        @include('front.invoice.invoiceComponents.invoiceAuspack')
                        {{-- Invoice Auspackservice Alanı --}}

                        {{-- Invoice Reinigung Alanı --}}
                        @include('front.invoice.invoiceComponents.invoiceReinigung')
                        {{-- Invoice Reinigung Alanı --}}

                        {{-- Invoice Reinigung2 Alanı --}}
                        @include('front.invoice.invoiceComponents.invoiceReinigung2')
                        {{-- Invoice Reinigung2 Alanı --}}

                        {{-- Invoice Entsorgung Alanı --}}
                        @include('front.invoice.invoiceComponents.invoiceEntsorgung')
                        {{-- Invoice Entsorgung Alanı --}}

                        {{-- Invoice Transport Alanı --}}
                        @include('front.invoice.invoiceComponents.invoiceTransport')
                        {{-- Invoice Transport Alanı --}}

                        {{-- Invoice Lagerung Alanı --}}
                        @include('front.invoice.invoiceComponents.invoiceLagerung')
                        {{-- Invoice Lagerung Alanı --}}

                        {{-- Invoice Lagerung Alanı --}}
                        @include('front.invoice.invoiceComponents.invoiceMaterial')
                        {{-- Invoice Lagerung Alanı --}}

                        <div class="row">
                            <div class="col-md-3">
                                <label class="col-form-label" for="l0">Mahngebühr</label>
                                <input class="form-control" name="invoiceWarningPrice" placeholder="0" type="text"
                                    style="background-color: #286090;color:white;" value="0.00">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <label class="col-form-label" for="l0">Betrag Total</label>
                                <input class="form-control" name="invoiceTotalPrice" placeholder="0" type="text"
                                    style="background-color: #286090;color:white;" value="0.00">
                            </div>
                        </div>

                        <div class="col-md-12 mt-3  p-3 rounded" style="background-color: #eae9ec;">
                            <div class="col-md-12 ">
                                <div class="checkbox checkbox-rounded checkbox-primary ">
                                    <label class="">
                                        <input type="checkbox" name="kdvType" value="1"> <span
                                            class="label-text text-dark"><strong>inkl. MwSt.</strong></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="checkbox checkbox-rounded checkbox-primary">
                                    <label class="">
                                        <input type="checkbox" name="kdvType1" value="1" checked> <span
                                            class="label-text text-dark"><strong>Ohne MwSt</strong></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="checkbox checkbox-rounded checkbox-primary">
                                    <label class="">
                                        <input type="checkbox" name="kdvType3" value="1"> <span
                                            class="label-text text-dark "><strong>MwSt. Frei </strong></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- Rechnung Address Area --}}

                        <div class="row form-group">
                            <div class="col-md-12">
                                <h5><strong>Rechnung Adresse</strong></h5>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3">
                                <label for="" class="col-form-label"> Strasse</label><br>
                                <input type="text" class="form-control" name="invoiceStreet" placeholder="Strasse "  value="{{ $data['street'] }}" required>
                            </div>
                            <div class="col-md-2">
                                <label for="" class="col-form-label"> Plz</label><br>
                                <input type="text" class="form-control" name="invoicePostCode" placeholder="PLZ "  value="{{ $data['postCode'] }}" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3">
                                <label for="" class="col-form-label"> Ort</label><br>
                                <input type="text" class="form-control" name="invoiceOrt" placeholder="Ort "  value="{{ $data['Ort'] }}" required>
                            </div>
                            <div class="col-md-2">
                                <label for="" class="col-form-label"> Land</label><br>
                                <input type="text" class="form-control" name="invoiceLand" placeholder="Land "  value="{{ $data['country'] }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 email-send">
                                <label for="" class="col-form-label"> E-Mail an Kunden</label><br>
                                <input type="checkbox" name="isEmail" id="isEmail" class="js-switch "
                                    data-color="#9c27b0" data-switchery="false">
                            </div>
                        </div>


                        <div class="row form-group email--area" style="display: none;">
                            <div class="col-md-12">
                                <label class=" col-form-label" for="l0">E-Mail Adresse</label>
                                <input class="form-control" name="email" type="text"
                                    value="{{ $data['email'] }}">
                            </div>

                            <div class="col-md-12 email-format">
                                <label for="" class="col-form-label">Standard Emailtext bearbeiten</label><br>
                                <input type="checkbox" name="isCustomEmail" id="isCustomEmail"
                                    class="js-switch isCustomEmail" data-color="#9c27b0" data-switchery="false">
                            </div>
                        </div>

                        <div class="row form-group email--format" style="display: none;">
                            <div class="col-md-12 mt-3">
                                <textarea class="editor" name="customEmail" id="customEmail" cols="30" rows="10">
                                            @include('../../invoiceEmail')
                                    </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 sms-send">
                                <label for="" class="col-form-label">SMS an Kunden</label><br>
                                <input type="checkbox" name="isSMS" id="isSMS" class="js-switch "
                                    data-color="#9c27b0" data-switchery="false">
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
                                    class="js-switch isCustomSMS" data-color="#9c27b0" data-switchery="false">
                            </div>

                            <div class="row form-group sms-format-area" style="display: none;">
                                <div class="col-md-12 mt-3">
                                    <textarea maxlength="190" id="editor2" class="form-control" name="customSMS" id="customSMS" cols="10"
                                        rows="5">Offer Created</textarea>
                                    <small class="text-primary"><i>Max Characters:190</i></small>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions mt-3">
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
                    console.log(urunIsmi,'Ürün İsmi')
                    console.log(index,'İndex')
                    return false;

                }
                else {
                    $(this).closest('.islem_field').find('.urun').css('border-color', ''); // önceki uyarı mesajını kaldır
                    isValid = true;
                }
                if (!buyType) {

                    $(this).closest('.islem_field').find('.buyType').focus().css(
                        'border-color', 'red');
                    toastr.error('Kauf/Mieten ist leer', 'Fehler!');
                    // alert('Die Miet/Kauf Option in Zeile ' + (index+1) + ' ist leer!');
                    console.log('buyType HATASI');
                    isValid = false;
                    console.log(isValid,'BuyType')
                    return false;
                }
                else {
                    $(this).closest('.islem_field').find('.buyType').css('border-color', '')
                    isValid = true;
                }
            });

            if ($('.urun').length === 0) { // ürün yoksa
                toastr.error('Fügen Sie mindestens ein Produkt hinzu', 'Fehler!');
                console.log('urun Sayısı HATASI');
                isValid = false;
                console.log(isValid,'Urun Sayısı')
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
</script>



{{-- SMS --}}
<script>
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
    function calculator() {
        let warningPrice = parseFloat($("input[name=invoiceWarningPrice]").val());

        let invoiceTotalPrice = 0;
        $(".total-piece").each(function() {
            var div = $(this).parent().parent();
            if (div.is(':visible')) {
                invoiceTotalPrice = parseFloat(invoiceTotalPrice) + parseFloat($(this).val());
            }
        });

        invoiceTotalPrice = invoiceTotalPrice + warningPrice;
        invoiceTotalPrice = parseFloat(invoiceTotalPrice);
        $("input[name=invoiceTotalPrice]").val(invoiceTotalPrice.toFixed(2));
    };

    $("body").on('change', '.invoice-area', function() {
        setTimeout(() => {
            calculator();
        }, 700);
    })

    $(document).ready(function() {
        setTimeout(() => {
            calculator();
        }, 700);
    })
</script>

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
    $('#customEmail').summernote({
            height: '130px',
    });
</script>

@yield('invoiceFooter1')
@yield('invoiceFooter2')
@yield('invoiceFooter3')
@yield('invoiceFooterReinigung')
@yield('invoiceFooterReinigung2')
@yield('invoiceEntsorgung')
@yield('invoiceFooterTransport')
@yield('invoiceFooterLagerung')
@yield('invoiceMaterial')
@endsection
