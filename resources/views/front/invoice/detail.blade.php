@extends('layouts.app')

@section('header')
    <style>
        .checkbox .label-text:after {
            border-color: #999494;
        }
    </style>
@endsection

@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Rechnung Anschauen</h6>
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
                    {{ App\Models\Customer::getPublicName($data2['id']) }}</span>
            </div>
            <div class="col-md-12 widget-holder">
                <div class="widget-bg">
                    <div class="widget-body clearfix">
                        <form id="invoiceFormDetail" action="{{ route('invoice.update', ['id' => $data['id']]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row form-group">
                                <div class="col-md-3">
                                    <b class="text-dark h5">Fälligkeit am: </b> <span class="pl-5 text-dark h5">{{ date('d-m-Y', strtotime($data['expiryDate'] ))}}</span>  <br>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-1 align-self-center">
                                    <b class="text-dark h5 font-weight-bolder">Status:</b>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" name="status" id="status">
                                        <option value="Bezahlt" @if($data['status'] == 'Bezahlt') selected @endif>Bezahlt</option>
                                        <option value="Nicht Bezahlt" @if($data['status'] == 'Nicht Bezahlt') selected @endif>Nicht Bezahlt</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row border-bottom mb-2">
                                <div class="col-md-12 mb-2">
                                    <label for="" class="col-form-label">Zahlungsfrist:</label>
                                    <div class="radiobox">
                                        <label class="text-dark">
                                            <input type="radio" class="payCondition" name="payCondition" value="1" @if($data['payCondition'] == 1) checked @endif>
                                            <span class="label-text">In 7 Tagen</span>
                                        </label>
                                        <label class="text-dark ml-1">
                                            <input type="radio" class="payCondition" name="payCondition" value="2" @if($data['payCondition'] == 2) checked @endif>
                                            <span class="label-text">In 14 Tagen</span>
                                        </label>
                                        <label class="text-dark ml-1">
                                            <input type="radio" class="payCondition" name="payCondition" value="3" @if($data['payCondition'] == 3) checked @endif>
                                            <span class="label-text">In 31 Tagen</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- Invoice Umzug 2 Alanı --}}
                            @include('front.invoice.invoiceDetailComponents.invoiceUmzug2',['umzug' => $umzug])
                            {{-- Invoice Umzug 2 Alanı --}}

                            {{-- Invoice Einpackservice Alanı --}}
                            @include('front.invoice.invoiceDetailComponents.invoiceEinpack',['einpack' => $einpack])
                            {{-- Invoice Einpackservice Alanı --}}

                            {{-- Invoice Auspackservice Alanı --}}
                            @include('front.invoice.invoiceDetailComponents.invoiceAuspack',['auspack' => $auspack])
                            {{-- Invoice Auspackservice Alanı --}}

                            {{-- Invoice Reinigung Alanı --}}
                            @include('front.invoice.invoiceDetailComponents.invoiceReinigung',['reinigung' => $reinigung])
                            {{-- Invoice Reinigung Alanı --}}

                            {{-- Invoice Reinigung2 Alanı --}}
                            @include('front.invoice.invoiceDetailComponents.invoiceReinigung2',['reinigung2' => $reinigung2])
                            {{-- Invoice Reinigung2 Alanı --}}

                            {{-- Invoice Entsorgung Alanı --}}
                            @include('front.invoice.invoiceDetailComponents.invoiceEntsorgung',['entsorgung' => $entsorgung])
                            {{-- Invoice Entsorgung Alanı --}}

                            {{-- Invoice Transport Alanı --}}
                            @include('front.invoice.invoiceDetailComponents.invoiceTransport',['transport' => $transport])
                            {{-- Invoice Transport Alanı --}}

                            {{-- Invoice Lagerung Alanı --}}
                            @include('front.invoice.invoiceDetailComponents.invoiceLagerung',['lagerung' => $lagerung])
                            {{-- Invoice Lagerung Alanı --}}

                            {{-- Invoice Lagerung Alanı --}}
                            @include('front.invoice.invoiceDetailComponents.invoiceMaterial',['material' => $material,'basket' => $basket])
                            {{-- Invoice Lagerung Alanı --}}

                            <div class="row">
                                <div class="col-md-3">
                                    <label class="col-form-label" for="l0">Mahngebühr</label>
                                    <input class="form-control" name="invoiceWarningPrice" placeholder="0" type="text"
                                        style="background-color: #286090;color:white;"
                                        @if($data['warningPrice']) value="{{ $data['warningPrice'] }}" @else value="0.00" @endif>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-3">
                                    <label class="col-form-label" for="l0">Betrag Total</label>
                                    <input class="form-control" name="invoiceTotalPrice" placeholder="0" type="text"
                                        style="background-color: #286090;color:white;"
                                        @if($data['totalPrice']) value="{{ $data['totalPrice'] }}" @else value="0.00" @endif>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3  p-3 rounded" style="background-color: #eae9ec;">
                                <div class="col-md-12 ">
                                    <div class="checkbox checkbox-rounded checkbox-primary ">
                                        <label class="">
                                            <input type="checkbox" name="kdvType" value="1"> <span
                                                class="label-text text-dark"
                                                @if ($data['withTax']) checked @endif><strong>inkl. MwSt.</strong></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="checkbox checkbox-rounded checkbox-primary">
                                        <label class="">
                                            <input type="checkbox" name="kdvType1" value="1" @if ($data['withoutTax']) checked @endif> <span
                                                class="label-text text-dark"><strong>Ohne MwSt</strong></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="checkbox checkbox-rounded checkbox-primary">
                                        <label class="">
                                            <input type="checkbox" name="kdvType3" value="1" @if ($data['freeTax']) checked @endif> <span
                                                class="label-text text-dark "><strong>MwSt. Frei </strong></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <h5><strong>Rechnung Adresse</strong></h5>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <label for="" class="col-form-label"> Strasse</label><br>
                                    <input type="text" class="form-control" name="invoiceStreet" placeholder="Strasse"   required
                                    @if($data['street']) value="{{ $data['street']  }}" @else value="{{ $customer['street']  }}" @endif>
                                </div>
                                <div class="col-md-2">
                                    <label for="" class="col-form-label"> Plz</label><br>
                                    <input type="text" class="form-control" name="invoicePostCode" placeholder="PLZ"   required
                                    @if($data['plz']) value="{{ $data['plz']  }}" @else value="{{ $customer['postCode']  }}" @endif>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <label for="" class="col-form-label"> Ort</label><br>
                                    <input type="text" class="form-control" name="invoiceOrt" placeholder="Ort"   required
                                    @if($data['ort']) value="{{ $data['ort']  }}" @else value="{{ $customer['Ort']  }}" @endif>
                                </div>
                                <div class="col-md-2">
                                    <label for="" class="col-form-label"> Land</label><br>
                                    <input type="text" class="form-control" name="invoiceLand" placeholder="Land"  required
                                    @if($data['land']) value="{{ $data['land']  }}" @else value="{{ $customer['country']  }}" @endif>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 email-send">
                                    <label for="" class="col-form-label">E-Mail an Kunden</label><br>
                                    <input type="checkbox" name="isEmail" id="isEmail" class="js-switch "
                                        data-color="#9c27b0" data-switchery="false">
                                </div>
                            </div>


                            <div class="row form-group email--area" style="display: none;">
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">E-Mail Adresse</label>
                                    <input class="form-control" name="email" type="text"
                                        value="{{ $customer['email'] }}">
                                </div>

                            </div>

                            <div class="row form-group email--format" style="display: none;">
                                <div class="col-md-12 mt-3">
                                    <textarea class="editor" name="customEmail" id="customEmail" cols="30" rows="10">
                                            @include('../../invoiceEmail')
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="form-group row">
                                    <div class="col-md-12 ml-md-auto btn-list">
                                        <button class="btn btn-primary btn-rounded" type="submit">Erstellen</button>
                                        <a id="createTask"  href="{{ route('invoice.showPdf',['id' => $data['id']]) }}"
                                            class="btn btn-rounded text-white" style="background-color:#ff0000"> <strong>Ausdrucken</strong>
                                        </a>
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
       $(document).ready(function(){
        $("#invoiceFormDetail :input").prop("disabled", true);
       })
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
        tinymce.init({
            selector: 'textarea.editor',
            plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
            toolbar_mode: 'floating',
            apply_source_formatting: true,
            plugins: 'code',
        });
    </script>

@yield('invoiceEditFooter1')
@yield('invoiceEditFooter2')
@yield('invoiceEditFooter3')
@yield('invoiceEditFooterReinigung')
@yield('invoiceEditFooterReinigung2')
@yield('invoiceEditEntsorgung')
@yield('invoiceEditFooterTransport')
@yield('invoiceEditFooterLagerung')
@yield('invoiceEditMaterial')

@endsection
