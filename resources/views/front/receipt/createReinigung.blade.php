
@extends('layouts.app')

@section('header')
<script src="https://cdn.tiny.cloud/1/qa7zzv3hb9nmr5ary4ucaw8bbt8744dzibxuf6hdomgsuchu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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
        <h6 class="page-title-heading mr-0 mr-r-5">Neue Quittung Erstellen</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Panel</a>
            </li>
            <li class="breadcrumb-item active">Quittung</li>
        </ol>
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
            <strong class="h5 mr-1"> <b>Kunde:</b> </strong> <span class="h5 text-primary ">  {{ App\Models\Customer::getPublicName($data['id']) }}</span>
        </div>
        <div class="col-md-12 widget-holder makbuz-alanı">
            <div class="widget-bg">
                <div class="widget-body clearfix ">
                    <form action="{{ route('receiptReinigung.storeReinigung',['id' => $offer['id'],'customer' => $data['id']]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            {{-- Makbuz ve Teklif Bilgileri --}}
                            <div id="makbuzAlanı" >
                                <div class="form-group row">
                                    <div class="col-md-12 border-bottom">
                                        <span class="h5 font-weight-bolder">Quittungsnr.: </span> <span class="h5 ml-3 text-primary">{{ $offer['id'] }}.1</span>
                                    </div>
                                    <div class="col-md-12 border-bottom mt-3">
                                        <span class="h5 font-weight-bold text-dark">Quittungsart: </span> <span class="h5 ml-3 font-weight-bold text-primary">Reinigung</span>
                                    </div>
                                </div>
    
                                <div class="form-group row p-3" style="background-color:#c3a7f5;">
                                    <div class="col-md-3">
                                        <b class="text-dark">Auftraggeber</b>
                                        <input class="form-control" name="customerGender"  type="text" @if ($data['gender'] == "male")
                                            value="Herr" @else value="Frau"
                                        @endif>
                                        
                                        <input class="form-control mt-1" name="customerName"  type="text" value="{{ $data['surname'] }} {{ $data['name'] }}">
                                        <input class="form-control mt-1" name="customerStreet"  type="text" value="{{ $data['street'] }}">
                                        <input class="form-control mt-1" name="customerPostCode"  type="text" value="CH-{{ $data['postCode'] }} {{ $data['country'] }}">
                                        <input class="form-control mt-1" name="customerPhone"  type="text" value="{{ $data['mobile'] }}">
                                    </div>
                                    <div class="col-md-3">
                                        <b class="text-dark">Reinigungsadresse</b>
                                        <input class="form-control" name="reinigungStreet"  type="text" placeholder="Strasse/Nr." value="{{ $data['street'] }}">
                                        <input class="form-control mt-1" name="reinigungPostCode"  type="text" placeholder="Ort" value="CH-{{ $data['postCode'] }} {{ $data['country'] }}">
                                    </div>
                                    <div class="col-md-3">
                                        <b class="text-dark">Reinigungstermin</b>
                                        <input class="form-control" name="reinigungStartDate"  type="date" 
                                        @if ($offer['offerteReinigungId']) value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'startDate') }}" @endif>
                                        <input class="form-control mt-1" name="reinigungStartTime"  type="time" 
                                        @if ($offer['offerteReinigungId']) value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'startTime') }}" @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <b class="text-dark">Abgabetermin</b>
                                        <input class="form-control" name="reinigungEndDate"  type="date" 
                                        @if ($offer['offerteReinigungId']) value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'endDate') }}" @endif>
                                        <input class="form-control mt-1" name="reinigungEndTime"  type="time" 
                                        @if ($offer['offerteReinigungId']) value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'endTime') }}" @endif>
                                    </div>
                                </div>
                            </div>

                            {{-- Tarif --}}
                            <div id="harcamaAlanı" class="border-bottom border-primary">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <strong class="text-underline h5 text-dark "><b>Tarif</b></strong>
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <div class="col-md-7">
                                        <b class="text-dark">Reinigungsart-Text</b>
                                        <input class="form-control" name="reinigungType"  type="text" 
                                        @if ($offer['offerteReinigungId']) value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'reinigungType') }}" @endif>
                                    </div>
                                    <div class="col-md-5">
                                        <b class="text-dark">Zusatztext (Bsp. Zimmer-Anzahl)</b>
                                        <?php 
                                        $reiningungFixedTariffId = \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'fixedTariff');
                                        if ($offer['offerteReinigungId'] && $reiningungFixedTariffId) {
                                            $reinigungZimmer = \App\Models\Tariff::InfoTariff($reiningungFixedTariffId);
                                            $reinigungZimmer2 = $reinigungZimmer ? explode('à', $reinigungZimmer)[0] : '';
                                        }
                                        
                                        ?>
                                        <input class="form-control" name="reinigungExText"  type="text" 
                                        @if ($offer['offerteReinigungId'] && $reiningungFixedTariffId)
                                        value="{{ $reinigungZimmer2 }}">
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <b class="text-dark">Optional: Leistungen (für Teilreinigung oder Baureinigungsleistungen)</b>
                                        <input class="form-control" name="extraReinigung"  type="text" 
                                        @if ($offer['offerteReinigungId']) value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'extraReinigung') }}" @endif>
                                    </div>
                                </div>

                                <i class="text-primary">Entweder Pauschaltarif ausfüllen oder Stundenansatz-Tarif. Falls Stundenansatz-Feld (Ansatz [CHF]) ausgefüllt ist, wird in PDF dieser angezeigt, ansonsten der Pauschaltarif:</i>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <b class="text-dark">Pauschaltarif</b>
                                        <input class="form-control" name="reinigungFixedChf"  type="text" 
                                        @if ($offer['offerteReinigungId']) value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'fixedTariffPrice') }}" @endif>
                                    </div>
                                </div>

                                <i class="text-primary">oder:</i>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <b class="text-dark">Dauer  [h]</b>
                                        <input class="form-control" name="reinigungHour"  type="text">
                                    </div>
                                    <div class="col-md-4">
                                        <b class="text-dark">Ansatz  [CHF]</b>
                                        <input class="form-control" name="reinigungChf"  type="text" 
                                        @if ($offer['offerteUmzugId']) value="{{ \App\Models\OfferteUmzug::InfoUmzug($offer['offerteUmzugId'],'chf') }}" @endif>
                                    </div>
                                    <div class="col-md-4">
                                        <b class="text-dark">Total  [CHF]</b>
                                        <input class="form-control" name="reinigungCost"  type="text">
                                    </div>
                                </div>
                            </div>

                            
                            {{-- Ek Ücretler --}}
                            <div id="ekucretAlanı" class="mt-3">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <strong class="text-underline h5 text-dark "><b>Zuschläge</b></strong>
                                    </div>
                                </div>

                                @if ($offer['offerteReinigungId'] && \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'extra1')) 
                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addCost1Text" placeholder="Text"  type="text" value="Hochdruckreiniger">
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ek" name="addCost1" placeholder="[CHF]"  type="text"
                                             value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'extra1') }}">
                                        </div>
                                    </div>
                                @endif
                                
                                @if ($offer['offerteReinigungId'] && \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'extra2'))
                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addCost2Text" placeholder="Text"  type="text" value="Stein- und Parkettböden" >
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ek" name="addCost2" placeholder="[CHF]"  type="text"
                                             value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'extra2') }}">
                                        </div>
                                    </div>
                                @endif
                                
                                @if ($offer['offerteReinigungId'] && \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'extra3'))
                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addCost3Text" placeholder="Text"  type="text" value="Teppichschamponieren">
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ek" name="addCost3" placeholder="[CHF]"  type="text"
                                            value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'extra3') }}" >
                                        </div>
                                    </div>
                                @endif


                                @if ($offer['offerteReinigungId'] && \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'extraCostValue1'))
                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addCost4Text" placeholder="Text"  type="text"
                                            value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'extraCostText1') }}">
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ek" name="addCost4" placeholder="[CHF]"  type="text"
                                            value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'extraCostValue1') }}">
                                        </div>
                                    </div>
                                @endif

                                @if ($offer['offerteReinigungId'] && \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'extraCostValue2'))
                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addCost5Text" placeholder="Text"  type="text"
                                            value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'extraCostText2') }}" >
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ek" name="addCost5" placeholder="[CHF]"  type="text"
                                            value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'extraCostValue2') }}">
                                        </div>
                                    </div>
                                @endif

                                {{-- Ekstra Custom Harcama --}}
                                <div class="form-group row">
                                    <div class="col-md-7">
                                        <input class="form-control" name="addCost6Text" placeholder="Text"  type="text">
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control ek" name="addCost6" placeholder="[CHF]"  type="text">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-7">
                                        <input class="form-control" name="addCost7Text" placeholder="Text"  type="text">
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control ek" name="addCost7" placeholder="[CHF]"  type="text">
                                    </div>
                                </div>
                            </div>

                            {{-- Ek Kesintiler --}}
                            <div id="kesintiAlanı" class="mt-3">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <strong class="text-underline h5 text-dark "><b>Abzüge</b></strong>
                                    </div>
                                </div>

                                @if ($offer['offerteReinigungId'] && \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'discount')) 
                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addDiscount1Text" placeholder="Text"  type="text" 
                                            value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'discountText') }}" >
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ekc" name="addDiscount1" placeholder="[CHF]"  type="text"
                                             value="{{ \App\Models\OfferteReinigung::InfoReinigung($offer['offerteReinigungId'],'discount') }}">
                                        </div>
                                    </div>
                                @endif

                                {{-- Ekstra Custom Kesinti --}}
                                <div class="form-group row">
                                    <div class="col-md-7">
                                        <input class="form-control" name="addDiscount2Text" placeholder="Text"  type="text">
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control ekc" name="addDiscount2" placeholder="[CHF]"  type="text">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-7">
                                        <input class="form-control" name="addDiscount3Text" placeholder="Text"  type="text">
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control ekc" name="addDiscount3" placeholder="[CHF]"  type="text">
                                    </div>
                                </div>

                            </div>

                            {{-- Maliyetler Alanı --}}
                            <div id="maliyetAlanı" class="mt-3 p-3 rounded" style="background-color: #c3a7f5;">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <strong class="text-underline h5 text-dark "><b>Kosten</b></strong>
                                    </div>
                                </div>
                                 
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <b class="text-dark">Total  [CHF]</b>
                                        <input class="form-control" name="totalCost" placeholder="[CHF]"  type="text">
                                    </div>
                                    <div class="col-md-12 ">                                                    
                                        <div class="checkbox checkbox-rounded checkbox-primary " >
                                            <label class="">
                                                <input type="checkbox" name="withTax"  value="1"> <span class="label-text text-dark"><strong>Kosten inkl. MwSt.</strong></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 ">                                                    
                                        <div class="checkbox checkbox-rounded checkbox-primary">
                                            <label class="">
                                                <input type="checkbox" name="withoutTax"  value="1" checked> <span class="label-text text-dark"><strong>Kosten exkl. MwSt.</strong></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 ">                                                    
                                        <div class="checkbox checkbox-rounded checkbox-primary">
                                            <label class="">
                                                <input type="checkbox" name="freeTax"  value="1"> <span class="label-text text-dark "><strong>Kostenfrei MwSt. </strong></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Ödeme Alanı --}}
                            <div id="maliyetAlanı" class="mt-3 p-3  rounded text-dark" style="background-color: #c3a7f5;">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <strong class="text-underline h5 text-dark "><b>Zahlung</b></strong>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="checkbox checkbox-rounded checkbox-primary " >
                                            <label class="">
                                                <input type="checkbox" name="payedCash"  value="1"> <span class="label-text text-dark"><strong> In Bar</strong></span>
                                            </label>
                                        </div>
                                        <input class="form-control" name="payedCashCost" placeholder="CHF [Betrag]"  type="text">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkbox checkbox-rounded checkbox-primary " >
                                            <label class="">
                                                <input type="checkbox" name="payedBill"  value="1"> <span class="label-text text-dark"><strong>In Rechnung</strong></span>
                                            </label>
                                        </div>
                                        <input class="form-control" name="payedBillCost" placeholder="CHF [Betrag]"  type="text">
                                    </div>
                                </div>
                            </div>

                            {{-- İmza Alanı --}}
                            <div id="maliyetAlanı" class="mt-3  pt-3 pb-2 px-2  rounded text-dark" style="background-color: #c3a7f5;">
                                <div class="form-group row d-flex justify-content-right">
                                    <div class="col-md-5">
                                        <strong class=" h5 text-dark "><b>Kundenname für Unterschriftsfeld</b></strong>
                                        <input class="form-control" name="signatureName"   type="text"
                                        value="{{ $data['surname'] }} {{ $data['name'] }}">
                                    </div>
                                </div>
                            </div>

                            {{-- Mail Alanı --}}
                            <div class="form-group row">
                                <div class="col-md-12 email-send">
                                    <label for="" class="col-form-label">E-Mail an Kunden</label><br>
                                    <input type="checkbox" name="isEmail" id="isEmail" class="js-switch " data-color="#9c27b0" data-switchery="false" >  
                                </div>                            
                            </div>
                            
                            <div class="row form-group email--area" style="display: none;">
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">E-Mail Adresse</label>
                                    <input class="form-control" name="email"  type="text" value="{{   $data['email']  }}">                                
                                </div>  
    
                                <div class="col-md-12 email-format">
                                    <label for="" class="col-form-label">Standard Emailtext bearbeiten</label><br>
                                    <input type="checkbox" name="isCustomEmail" id="isCustomEmail" class="js-switch isCustomEmail" data-color="#9c27b0" data-switchery="false" >   
                                </div>   
                            </div>

                            <div class="row form-group email--format" style="display: none;">
                                <div class="col-md-12 mt-3">
                                    <textarea class="editor" name="customEmail" id="customEmail" cols="30" rows="10">
                                        @include('../../receiptReinigungMail')
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
{{-- Hesaplamalar --}}
<script>
    $(document).ready(function(){
        calc()
    })

    $("body").on("change",".makbuz-alanı",function () {
        calc()
    })
        
    function calc(){
            
            let reinigungHour = parseFloat($("input[name=reinigungHour]").val());
            let reinigungChf = parseFloat($("input[name=reinigungChf]").val());
            let reinigungCost = 0;
            if(reinigungHour && reinigungChf)
            {
                reinigungCost = reinigungHour*reinigungChf;
                reinigungCost = reinigungCost.toFixed(2);
                $("input[name=reinigungCost]").val(reinigungCost);
            }
            else{
                $("input[name=reinigungCost]").val('');
            }
            
            let reinigungFixedChf = $("input[name=reinigungFixedChf]").val() ? parseFloat($("input[name=reinigungFixedChf]").val()) : 0 ;
            let ekler= 0;
            let kesintiler = 0;

            $(".ek").each(function() {
                if($(this).val())
                {
                    ekler = parseFloat(ekler) + parseFloat($(this).val());
                }
            });
            $(".ekc").each(function() {
                if($(this).val())
                {
                    kesintiler = parseFloat(kesintiler) + parseFloat($(this).val());
                }
            });

            totalCost = 0;
            if(reinigungFixedChf)
            {
                totalCost = (reinigungFixedChf+ekler)-kesintiler;
                totalCost=totalCost.toFixed(2);
                $("input[name=totalCost]").val(totalCost);
            }

            else {
                reinigungCost= parseFloat(reinigungCost);
                totalCost = (reinigungCost+ekler)-kesintiler;
                totalCost=totalCost.toFixed(2);
                $("input[name=totalCost]").val(totalCost);
            }
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

<script>
    tinymce.init({
      selector: 'textarea.editor',
      plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
      toolbar_mode: 'floating',
      apply_source_formatting : true,
      plugins: 'code',
    });
</script>


@endsection