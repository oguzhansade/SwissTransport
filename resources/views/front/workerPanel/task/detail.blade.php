@extends('layouts.app')
@section('header')
<style>
    fieldset.scheduler-border {
    border: 2px groove #8254E2 !important;
    border-radius: 10px;
    color: #8254E2;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
    .h6 {
        font-size: 1rem !important;
    }
    td {
        vertical-align: top;
    }
    .feather-check-circle:before {
        font-weight: 700;
    }
    .feather-x-circle:before {
        font-weight: 700;
    }
</style>
<style>
    .rounded-custom {
   border-radius: 35px;
}
.b-shadow {
   box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
}
.back-button {
   cursor: pointer;
}
</style>
@endsection
@section('content')
@section('sidebarType') sidebar-collapse @endsection
<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Aufgabendetail</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Panel</a>
            </li>
            <li class="breadcrumb-item active">Aufgabendetail</li>
        </ol>
        {{-- <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Yeni Görev Ekle</a>
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

<div class="row d-flex p-0 justify-content-between" >
    <div class="col-md-6 d-flex justify-content-start">
        <a href="{{ route('workerPanel.task',['id'=> Auth::id()]) }}" class="h4 px-4 py-2 bg-primary text-white b-shadow rounded-custom text-center d-flex align-items-center back-button">
            <i class="feather feather-arrow-left align-self-center pr-1"></i>Zurück</b>
        </a> 
    </div>
    <div class="col-md-6 d-flex justify-content-end">
        <span class="h4 px-4 py-2 bg-primary text-white b-shadow rounded-custom">Arbeiter: <b>{{ App\Models\Worker::fullName($data['workerId']) }}</b></span> 
    </div>
</div>


    <div class="widget-list">
        <div class="row mt-3">
            <div class="col-md-12 widget-holder task-area">
                <div class="widget-bg">
                    <div class="widget-body clearfix">
                        <div class="col-md-12">

                            <div class="row p-3">
                                {{-- İşçi Bilgileri --}}
                                <div class="col">
                                    <fieldset class="scheduler-border">
                                        <legend class="scheduler-border">Assigned Worker Details</legend>
                                        <table class="table-sm">
                                            <tr>
                                                <td><span class="h6 ">Arbeiter: </span></td>
                                                <td class="pl-3"><span class=" h6 text-primary "> <b>{{ App\Models\Worker::fullName($data['workerId']) }}</b></span></td>
                                            </tr>
                                            <tr>
                                                <td><span class="h6">Offerte No:  </span></td>
                                                <td class="pl-3"><span class=" h6 text-primary"><b> {{ $data['offerteId'] }}</b></span></td>
                                            </tr>
                                            <tr>
                                                <td><span class="h6">Missionsdatum:  </span></td>
                                                <td class="pl-3"><span class=" h6 text-primary"><b> {{  date('d-m-Y', strtotime($task['taskDate'])); }}</b></span></td>
                                            </tr>
    
                                            <tr>
                                                <td><span class="h6">Dienststunde:  </span></td>
                                                <td class="pl-3"><span class=" h6 text-primary"><b> {{ $task['taskTime'] }}</b></span></td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </div>

                                {{-- Müşteri Bilgileri --}}
                                <div class="col">
                                    <fieldset class="scheduler-border">
                                        <legend class="scheduler-border">Kundendetails</legend>
                                        <table class="table-sm">
                                            <tr>
                                                <td><span class="h6 ">Name: </span></td>
                                                <td class="pl-3"><span class=" h6 text-primary "> <b>{{ $customer['name'] }} {{ $customer['surname'] }}</b></span></td>
                                            </tr>
                                            <tr>
                                                <td><span class="h6">Telefon:  </span></td>
                                                <td class="pl-3"><span class=" h6 text-primary"><b> {{ $customer['mobile'] }}</b></span></td>
                                            </tr>
                                            <tr>
                                                <td><span class="h6">E-Mail:  </span></td>
                                                <td class="pl-3"><span class=" h6 text-primary"><b> {{ $customer['email'] }}</b></span></td>
                                            </tr>
                                            <tr>
                                                <td valign="top"><span class="h6">Strasse:  </span></td>
                                                <td class="pl-3"><span class=" h6 text-primary"><b> {{ $customer['street'] }}</b></span></td>
                                            </tr>
                                            <tr>
                                                <td><span class="h6">PLZ/Ort:  </span></td>
                                                <td class="pl-3"><span class=" h6 text-primary"><b> CH-{{ $customer['postCode'] }} {{ $customer['country'] }}</b></span></td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </div>

                                {{-- Teklif Bilgileri --}}
                                <div class="col">
                                    <fieldset class="scheduler-border">
                                        <legend class="scheduler-border">Offerte Details</legend>
                                        <table class="table-sm">
                                            <tr>
                                                <td><span class="h6">No: </span></td>
                                                <td class="pl-3"><span class=" h6 text-primary "> <b>{{ $offerte['id'] }} </b></span></td>
                                            </tr>
                                            <tr>
                                                <td><span class="h6">Status:  </span></td>
                                                <td class="pl-3"><span class="h6 text-primary"><b> {{ $offerte['offerteStatus'] }}</b></span></td>
                                            </tr>
                                            <tr>
                                                <td valign="top">
                                                    <span class="h6">Services:  </span>
                                                </td>
                                                <td align="left" class="pl-3">
                                                    <span class=" h6 text-primary ">
                                                        @if($offerte['offerteUmzugId']) <small class="text-primary"><b>Umzug</b></small> @endif
                                                        @if($offerte['offerteEinpackId']) <small class="text-primary"><b>, Einpack</b></small> @endif
                                                        @if($offerte['offerteAuspackId']) <small class="text-primary"><b>, Auspack</b></small> @endif
                                                        @if($offerte['offerteReinigungId']) <small class="text-primary"><b>, Reinigung</b></small> @endif
                                                        @if($offerte['offerteReinigung2Id']) <small class="text-primary"><b>, Reinigung 2</b></small> @endif
                                                        @if($offerte['offerteEntsorgungId']) <small class="text-primary"><b>, Entsorgung</b></small> @endif
                                                        @if($offerte['offerteTransportId']) <small class="text-primary"><b>, Transport</b></small> @endif
                                                        @if($offerte['offerteLagerungId']) <small class="text-primary"><b>, Lagerung</b></small> @endif
                                                        @if($offerte['offerteMaterialId']) <small class="text-primary"><b>, Material</b></small> @endif
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="h6">Notiz:  </span></td>
                                                <td class="pl-3"><span class=" h6 text-primary"><b> {{ $offerte['offerteNote'] }}</b></span></td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </div>
                            </div>

                            {{-- 1. Adresler --}}
                            @if($ausAdres1 || $einAdres1)
                                <div class="row p-3">
                                    <div class="col-md-12 address1-control">
                                        <label for="" class="col-form-label">Address 1</label><br>
                                        <input type="checkbox" name="address1-control" id="address1-control" class="js-switch " data-color="#9c27b0" data-switchery="false" >  
                                    </div>                            
                                </div>
                                <div class="address-area-1" style="display: none;">
                                    <div class="row p-3">
                                        {{-- Aus 1 Bilgileri --}}
                                        @if($ausAdres1) 
                                        <div class="col">
                                            <fieldset class="scheduler-border">
                                                <legend class="scheduler-border">Auszug Address</legend>
                                                <table class="table-sm">
                                                    <tr>
                                                        <td><span class="h6 ">Strasse: </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary "> <b>{{ $ausAdres1['street'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">PLZ/Ort:  </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary"><b> CH-{{ $ausAdres1['postCode'] }} {{ $ausAdres1['city'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">Land:  </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary"><b> {{ $ausAdres1['country'] }}</b></span></td>
                                                    </tr>

                                                    <tr>
                                                        <td><span class="h6">Gebäude:  </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary"><b> {{ $ausAdres1['buildType'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">Etage:  </span></td>
                                                        <td class="pl-3"><span class="h6 text-primary"><b> {{ $ausAdres1['floor'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">Lift:  </span></td>
                                                        <td class="pl-3"><span class="h6 text-primary" > 
                                                            @if($ausAdres1['lift'] == 1)
                                                            <b><i class="feather feather-check-circle" style="font-weight: 700!important;"></i><b>
                                                            @else
                                                            <i class="feather feather-x-circle" ></i>
                                                            @endif
                                                        </b></span></td>
                                                    </tr>
                                                </table>
                                            </fieldset>
                                        </div>
                                        @endif
                                        
                                        {{-- Ein 1 Bilgileri --}}
                                        @if($einAdres1) 
                                        <div class="col">
                                            <fieldset class="scheduler-border">
                                                <legend class="scheduler-border">Einzug Address</legend>
                                                <table class="table-sm">
                                                    <tr>
                                                        <td><span class="h6 ">Strasse: </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary "> <b>{{ $einAdres1['street'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">PLZ/Ort:  </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary"><b> CH-{{ $einAdres1['postCode'] }} {{ $einAdres1['city'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">Land:  </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary"><b> {{ $einAdres1['country'] }}</b></span></td>
                                                    </tr>

                                                    <tr>
                                                        <td><span class="h6">Gebäude:  </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary"><b> {{ $einAdres1['buildType'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">Etage:  </span></td>
                                                        <td class="pl-3"><span class="h6 text-primary"><b> {{ $einAdres1['floor'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">Lift:  </span></td>
                                                        <td class="pl-3"><span class="h6 text-primary"><b> 
                                                            @if($einAdres1['lift'] == 1)
                                                            <i class="feather feather-check-circle" ></i>
                                                            @else
                                                            <i class="feather feather-x-circle" ></i>
                                                            @endif
                                                        </b></span></td>
                                                    </tr>
                                                </table>
                                            </fieldset>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            {{-- 2. Adresler --}}
                            @if($ausAdres2 || $einAdres2)
                                <div class="row p-3">
                                    <div class="col-md-12 address2-control">
                                        <label for="" class="col-form-label">Address 2</label><br>
                                        <input type="checkbox" name="address2-control" id="address2-control" class="js-switch " data-color="#9c27b0" data-switchery="false" >  
                                    </div>                            
                                </div>

                                <div class="address-area-2" style="display: none;">
                                    <div class="row p-3">
                                        {{-- Aus 2 Bilgileri --}}
                                        @if($ausAdres2) 
                                        <div class="col">
                                            <fieldset class="scheduler-border">
                                                <legend class="scheduler-border">Auszug Address 2</legend>
                                                <table class="table-sm">
                                                    <tr>
                                                        <td><span class="h6 ">Strasse: </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary "> <b>{{ $ausAdres2['street'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">PLZ/Ort:  </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary"><b> CH-{{ $ausAdres2['postCode'] }} {{ $ausAdres2['city'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">Land:  </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary"><b> {{ $ausAdres2['country'] }}</b></span></td>
                                                    </tr>
            
                                                    <tr>
                                                        <td><span class="h6">Gebäude:  </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary"><b> {{ $ausAdres2['buildType'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">Etage:  </span></td>
                                                        <td class="pl-3"><span class="h6 text-primary"><b> {{ $ausAdres2['floor'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">Lift:  </span></td>
                                                        <td class="pl-3"><span class="h6 text-primary" > 
                                                            @if($ausAdres2['lift'] == 1)
                                                            <b><i class="feather feather-check-circle" style="font-weight: 700!important;"></i><b>
                                                            @else
                                                            <i class="feather feather-x-circle" ></i>
                                                            @endif
                                                        </b></span></td>
                                                    </tr>
                                                </table>
                                            </fieldset>
                                        </div>
                                        @endif
                                        
                                        {{-- Ein 2 Bilgileri --}}
                                        @if($einAdres2) 
                                        <div class="col">
                                            <fieldset class="scheduler-border">
                                                <legend class="scheduler-border">Einzug Address 2</legend>
                                                <table class="table-sm">
                                                    <tr>
                                                        <td><span class="h6 ">Strasse: </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary "> <b>{{ $einAdres2['street'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">PLZ/Ort:  </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary"><b> CH-{{ $einAdres2['postCode'] }} {{ $einAdres2['city'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">Land:  </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary"><b> {{ $einAdres2['country'] }}</b></span></td>
                                                    </tr>
            
                                                    <tr>
                                                        <td><span class="h6">Gebäude:  </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary"><b> {{ $einAdres2['buildType'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">Etage:  </span></td>
                                                        <td class="pl-3"><span class="h6 text-primary"><b> {{ $einAdres2['floor'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">Lift:  </span></td>
                                                        <td class="pl-3"><span class="h6 text-primary"><b> 
                                                            @if($einAdres2['lift'] == 1)
                                                            <i class="feather feather-check-circle" ></i>
                                                            @else
                                                            <i class="feather feather-x-circle" ></i>
                                                            @endif
                                                        </b></span></td>
                                                    </tr>
                                                </table>
                                            </fieldset>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            {{-- 3. Adresler --}}
                            @if($ausAdres3 || $einAdres3)
                                <div class="row p-3">
                                    <div class="col-md-12 address3-control">
                                        <label for="" class="col-form-label">Address 3</label><br>
                                        <input type="checkbox" name="address3-control" id="address3-control" class="js-switch " data-color="#9c27b0" data-switchery="false" >  
                                    </div>                            
                                </div>

                                <div class="address-area-3" style="display: none;">
                                    <div class="row p-3">
                                        {{-- Aus 3 Bilgileri --}}
                                        @if($ausAdres3) 
                                        <div class="col">
                                            <fieldset class="scheduler-border">
                                                <legend class="scheduler-border">Auszug Address 3</legend>
                                                <table class="table-sm">
                                                    <tr>
                                                        <td><span class="h6 ">Strasse: </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary "> <b>{{ $ausAdres3['street'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">PLZ/ORT:  </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary"><b> CH-{{ $ausAdres3['postCode'] }} {{ $ausAdres3['city'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">Land:  </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary"><b> {{ $ausAdres3['country'] }}</b></span></td>
                                                    </tr>
            
                                                    <tr>
                                                        <td><span class="h6">Gebäude:  </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary"><b> {{ $ausAdres3['buildType'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">Etage:  </span></td>
                                                        <td class="pl-3"><span class="h6 text-primary"><b> {{ $ausAdres3['floor'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">Lift:  </span></td>
                                                        <td class="pl-3"><span class="h6 text-primary" > 
                                                            @if($ausAdres3['lift'] == 1)
                                                            <b><i class="feather feather-check-circle" style="font-weight: 700!important;"></i><b>
                                                            @else
                                                            <i class="feather feather-x-circle" ></i>
                                                            @endif
                                                        </b></span></td>
                                                    </tr>
                                                </table>
                                            </fieldset>
                                        </div>
                                        @endif
                                        
                                        {{-- Ein 3 Bilgileri --}}
                                        @if($einAdres3) 
                                        <div class="col">
                                            <fieldset class="scheduler-border">
                                                <legend class="scheduler-border">Einzug Address 3</legend>
                                                <table class="table-sm">
                                                    <tr>
                                                        <td><span class="h6 ">Strasse: </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary "> <b>{{ $einAdres3['street'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">PLZ/Ort:  </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary"><b> CH-{{ $einAdres3['postCode'] }} {{ $einAdres3['city'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">Land:  </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary"><b> {{ $einAdres3['country'] }}</b></span></td>
                                                    </tr>
            
                                                    <tr>
                                                        <td><span class="h6">Gebäude:  </span></td>
                                                        <td class="pl-3"><span class=" h6 text-primary"><b> {{ $einAdres3['buildType'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">Etage:  </span></td>
                                                        <td class="pl-3"><span class="h6 text-primary"><b> {{ $einAdres3['floor'] }}</b></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h6">Lift:  </span></td>
                                                        <td class="pl-3"><span class="h6 text-primary"><b> 
                                                            @if($einAdres3['lift'] == 1)
                                                            <i class="feather feather-check-circle" ></i>
                                                            @else
                                                            <i class="feather feather-x-circle" ></i>
                                                            @endif
                                                        </b></span></td>
                                                    </tr>
                                                </table>
                                            </fieldset>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
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
    var adress1control = $("div.address1-control");
    var adress2control = $("div.address2-control");
    var adress3control = $("div.address3-control");

    adress3control.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".address-area-3").show(700);
        }
        else{
            $(".address-area-3").hide(500);
        }
    })

    adress2control.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".address-area-2").show(700);
        }
        else{
            $(".address-area-2").hide(500);
        }
    })

    adress1control.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".address-area-1").show(700);
        }
        else{
            $(".address-area-1").hide(500);
        }
    })
</script>
<script>
    $(document).ready(function(){
        $('body').on('change','.task-area',function () {
        var saat = $('input[name=workHour]').val();
        var fiyat = $('input[name=workPrice]').val();
        $("body").on("change",".isci",function () {
            fiyat = $(this).find(":selected").data("fiyat");
            $('input[name=workPrice]').val(fiyat);
        })
        $('input[name=totalPrice]').val(saat*fiyat);
    })
    })
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.0/metisMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/js/perfect-scrollbar.jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/3.1.2/jquery.bootstrap-touchspin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.1.7/js/ion.rangeSlider.min.js"></script>
@endsection