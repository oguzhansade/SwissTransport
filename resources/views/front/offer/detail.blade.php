
@extends('layouts.app')

@section('header')
<style>
    .checkbox .label-text:after {
        border-color: #999494;
    }
    .b-shadow {
            box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
        }
    .b-shadow2 {
        box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
    }
        .back-button {
            cursor: pointer;
            border-radius: 35px !important;
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
<div class="col-md-3 mb-5">
    <a href="{{ route('customer.detail',['id' => $data['customerId']])}}"
        class="h6 px-4 py-2 bg-primary text-white b-shadow  text-center d-flex align-items-center back-button rounded-custom">
        <i class="feather feather-arrow-left align-self-center pr-1"></i>{{ $customer['name'] }} {{ $customer['surname'] }}s Angebote</b>
    </a>
</div>

<div class="widget-list">
    <div class="row">
        <div class="col-md-12 widget-holder">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <form action="" id="bestForm" method="POST" enctype="multipart/form-data" disabled>
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                                <table>
                                    <tr>
                                        <td><span class="h5 font-weight-bolder"> <strong>Kunde:</strong>  </span> </td>
                                        <td><span class="h5 ml-3 text-primary"><a href="{{ route('customer.detail',['id' => $data['customerId']]) }}"> <u>{{ $customer['name'] }} {{ $customer['surname'] }}</u></a></span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="h5 font-weight-bolder"> <strong>Offertennr:</strong> </span></td>
                                        <td><span class="h5 ml-3 text-primary">{{ $data['id'] }}</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="h5 font-weight-bold text-dark"> <strong>Stand:</strong> </span></td>
                                        <td>
                                            <span class="h5 ml-3 font-weight-bold text-primary">
                                                @if($data['offerteStatus']  &&  $data['offerteStatus']  == 'Onaylandı') Bestätigt
                                                @elseif($data['offerteStatus']  &&  $data['offerteStatus']  == 'Onaylanmadı') Nicht Bestätigt
                                                @elseif($data['offerteStatus']  &&  $data['offerteStatus']  == 'Beklemede') in Wartestellung
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top"><span class="h5 font-weight-bold text-dark"> <strong>Stand Changer:</strong></span> </td>
                                        <td class="pl-3">
                                            <a href="#" id="manuelAccept" class="text-underline " data-toggle="modal" data-target="#manuelAcceptModal">Bestätigt</a> <br>
                                            <a href="#" id="manuelReject" class="text-underline " data-toggle="modal" data-target="#manuelAcceptModal">Abgesagt</a><br>
                                            <a href="#" id="manuelDefault" class="text-underline " data-toggle="modal" data-target="#manuelAcceptModal">is Offen</a>
                                        </td>
                                    </tr>
                                </table>
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
                                        <option value=" {{ $value['name'] }} {{ $value['surname'] }}" @if ($data['contactPerson'] == $value['name'].$value['surname']) selected @endif>{{ $value['name']  }} {{ $value['surname'] }}</option>
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
                                    <input type="checkbox" name="isEmail" id="isEmail" class="js-switch " data-color="#286090" data-switchery="false" >
                                </div>
                            </div>


                            <div class="row form-group email--area" style="display: none;">
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">E-Mail Adresse </label>
                                    <input class="form-control" name="email"  type="text" value="{{   $customer['email']  }}">
                                </div>


                                <div class="col-md-12 email-format">
                                    <label for="" class="col-form-label">Standard Emailtext bearbeiten</label><br>
                                    <input type="checkbox" name="isCustomEmail" id="isCustomEmail" class="js-switch isCustomEmail" data-color="#286090" data-switchery="false" >
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
                                    <input type="checkbox" name="isSMS" id="isSMS" class="js-switch " data-color="#286090" data-switchery="false" >
                                </div>
                            </div>

                            <div class="col-md-12 sms-format mb-3">
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
                                <div class="form-group row">
                                    <div class="col-md-12 ml-md-auto btn-list">
                                        <button class="btn btn-primary btn-rounded" type="submit">Erstellen</button>
                                        @if (in_array(Auth::user()->permName, ['superAdmin', 'chef','officer']))
                                        <a id="createapp"  href="{{ route('appointment.createFromOffer',['id' => $data['id'],'customer' => $data['customerId']]) }}"
                                            class="btn btn-rounded text-white" target="_blank" style="background-color:#F0AD4E"> <strong>Auftragsbestätigung</strong>
                                        </a>
                                        @endif

                                        <a id="createapp"  href="{{ route('offer.edit',['id' => $data['id']]) }}"
                                            class="btn btn-info btn-rounded text-white"> <strong>Bearbeiten</strong>
                                        </a>

                                        @if (in_array(Auth::user()->permName, ['superAdmin', 'chef','officer']))
                                        <a href="#" class="btn btn-success btn-rounded text-white" data-toggle="modal" data-target="#receiptModal"> <strong>Quittung erstellen</strong>
                                        </a>
                                        @endif

                                        @if (in_array(Auth::user()->permName, ['superAdmin', 'chef','officer']))
                                        <a id="createInvoice"  href="{{ route('invoice.createFromOffer',['id' => $data['id'],'customer' => $data['customerId']]) }}"
                                            class="btn btn-rounded text-white" target="_blank" style="background-color:#5BC0DE"> <strong>Rechnung erstellen</strong>
                                        </a>
                                        @endif

                                        <a href="{{ route('offer.showPdf',['id' => $data['id']]) }}"
                                            class="btn btn-rounded text-white" style="background-color:#ff0000" target="_blank"> <strong>Ausdrucken</strong>
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
        {{-- Loglar --}}
        <div class="col-md-12">
            <p>
                <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                  Logs
                </a>
              </p>

              <div class="collapse" id="collapseExample">

                @if(count($logs) > 0)
                    @foreach ($logs->reverse() as $key => $value )
                            <div class="card card-body">
                                @if($value['oldValue'] && $value['newValue'])
                                Log- {{ $key }} : <span > <span class="text-primary"><b>{{ $value['userName'] }}</b>  </span> Tarafından <span class="text-primary">{{ $value['created_at'] }}</span> tarihinde <span class="text-primary">{{ $value['serviceType'] }}</span> içindeki <span class="text-primary">
                                {{ $value['inputName'] }}
                                    </span>, <span class="text-danger">
                                        @if($value['inputName'] == 'TARIF' || $value['inputName'] == 'TARIF (PAUSCHAL)' || $value['inputName'] == 'TARIF (STUNDENANSATZ)')
                                        {{ App\Models\Tariff::InfoTariff($value['oldValue']) }}
                                        @elseif($value['serviceType'] == 'Umzug' && $value['inputName'] == 'AB- UND AUFBAU' && $value['oldValue'] == '1')
                                        Bitte Wahlen
                                        @elseif($value['serviceType'] == 'Umzug' && $value['inputName'] == 'AB- UND AUFBAU' && $value['oldValue'] == '2')
                                        Kunde
                                        @elseif($value['serviceType'] == 'Umzug' && $value['inputName'] == 'AB- UND AUFBAU' && $value['oldValue'] == '3')
                                        Firma
                                        @elseif($value['inputName'] == 'MIT HOCHDRUCKREINIGER' && $value['oldValue'] == '0')
                                        Nein
                                        @elseif($value['inputName'] == 'MIT HOCHDRUCKREINIGER' && $value['oldValue'] == '1')
                                        Ja
                                        @elseif($value['inputName'] == 'DÜBELLÖCHER ZUSPACHTELN' && $value['oldValue'] == '0')
                                        Nein
                                        @elseif($value['inputName'] == 'DÜBELLÖCHER ZUSPACHTELN' && $value['oldValue'] == '1')
                                        Ja
                                        @elseif($value['inputName'] == 'LIFT' && $value['oldValue'] == '0')
                                        Ja
                                        @elseif($value['inputName'] == 'LIFT' && $value['oldValue'] == '1')
                                        Nein
                                        @else
                                        {{ $value['oldValue'] }}
                                        @endif
                                    </span>' den <span class="text-success">
                                        @if($value['inputName'] == 'TARIF' || $value['inputName'] == 'TARIF (PAUSCHAL)' || $value['inputName'] == 'TARIF (STUNDENANSATZ)')
                                        {{ App\Models\Tariff::InfoTariff($value['newValue']) }}
                                        @elseif($value['serviceType'] == 'Umzug' && $value['inputName'] == 'AB- UND AUFBAU' && $value['newValue'] == '1')
                                        Bitte Wahlen
                                        @elseif($value['serviceType'] == 'Umzug' && $value['inputName'] == 'AB- UND AUFBAU' && $value['newValue'] == '2')
                                        Kunde
                                        @elseif($value['serviceType'] == 'Umzug' && $value['inputName'] == 'AB- UND AUFBAU' && $value['newValue'] == '3')
                                        Firma
                                        @elseif($value['inputName'] == 'DÜBELLÖCHER ZUSPACHTELN' && $value['newValue'] == '1')
                                        Ja
                                        @elseif($value['inputName'] == 'DÜBELLÖCHER ZUSPACHTELN' && $value['newValue'] == '0')
                                        Nein
                                        @elseif($value['inputName'] == 'MIT HOCHDRUCKREINIGER' && $value['newValue'] == '1')
                                        Ja
                                        @elseif($value['inputName'] == 'MIT HOCHDRUCKREINIGER' && $value['newValue'] == '0')
                                        Nein
                                        @elseif($value['inputName'] == 'LIFT' && $value['newValue'] == '0')
                                        Ja
                                        @elseif($value['inputName'] == 'LIFT' && $value['newValue'] == '1')
                                        Nein
                                        @else
                                        {{ $value['newValue'] }}
                                        @endif
                                    </span> olarak değiştirildi. </span>
                                @elseif (empty($value['oldValue']) && !empty($value['newValue']))
                                Log- {{ $key }} : <span > <span class="text-primary"><b>{{ $value['userName'] }}</b>  </span> Tarafından <span class="text-primary">{{ $value['created_at'] }}</span> tarihinde <span class="text-primary">{{ $value['serviceType'] }}</span> içindeki
                                    @if (strpos($value['inputName'], 'Adresse') !== false
                                    || strpos($value['inputName'], 'Umzug') !== false
                                    || strpos($value['inputName'], 'Einpack') !== false
                                    || strpos($value['inputName'], 'Auspack') !== false
                                    || strpos($value['inputName'], 'Reinigung') !== false
                                    || strpos($value['inputName'], 'Reinigung-2') !== false
                                    || strpos($value['inputName'], 'Entsorgung') !== false
                                    || strpos($value['inputName'], 'Transport') !== false
                                    || strpos($value['inputName'], 'Lagerung') !== false
                                    || strpos($value['inputName'], 'Material') !== false)
                                        <span class="text-success">{{ $value['inputName'] }}</span>, Eklendi
                                    @else
                                        <span class="text-success">{{ $value['inputName'] }}[{{ $value['newValue'] }}]</span>, Eklendi
                                    @endif

                                @elseif (empty($value['newValue']) && !empty($value['oldValue']))
                                Log- {{ $key }} : <span > <span class="text-primary"><b>{{ $value['userName'] }}</b>  </span> Tarafından <span class="text-primary">{{ $value['created_at'] }}</span> tarihinde <span class="text-primary">{{ $value['serviceType'] }}</span> içindeki
                                    @if (strpos($value['inputName'], 'Adresse') !== false
                                    || strpos($value['inputName'], 'Umzug') !== false
                                    || strpos($value['inputName'], 'Einpack') !== false
                                    || strpos($value['inputName'], 'Auspack') !== false
                                    || strpos($value['inputName'], 'Reinigung') !== false
                                    || strpos($value['inputName'], 'Reinigung-2') !== false
                                    || strpos($value['inputName'], 'Entsorgung') !== false
                                    || strpos($value['inputName'], 'Transport') !== false
                                    || strpos($value['inputName'], 'Lagerung') !== false
                                    || strpos($value['inputName'], 'Material') !== false)
                                        <span class="text-danger">{{ $value['inputName'] }}</span>, Silindi
                                    @else
                                        <span class="text-danger">{{ $value['inputName'] }}[{{ $value['oldValue'] }}]</span>, Silindi
                                    @endif
                                @endif
                            </div>
                    @endforeach
                @else
                <div class="card card-body">
                    Keine Änderung vorgenommen
                </div>

                @endif
              </div>



        </div>
        <div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="receiptModalLabel" aria-hidden="true" >
            <div class="modal-dialog" role="document" >
              <div class="modal-content" style="border-radius: 30px;">
                <div class="modal-header bg-primary text-white" style="border-top-right-radius: 30px;border-top-left-radius: 30px;">
                  <h5 class="modal-title" id="receiptModalLabel">Quittungsart auswählen</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">
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
        <div class="modal fade" id="manuelAcceptModal" tabindex="-1" role="dialog" aria-labelledby="manuelAcceptModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content" style="border-radius: 30px;">
                <div class="modal-header bg-primary text-white" style="border-top-right-radius: 30px;border-top-left-radius: 30px;">
                  <h5 class="modal-title">Offerte Status Changer</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="cursor:pointer;">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span id="offerteStatusChangerText" class="text-dark h6">Möchten Sie den Status des Angebots in 'Bestätigt' ändern?</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top:none;padding-top:0px;">
                <a id="offerteStatusChangerButton" class="btn btn-primary" href="">Ja</a>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Nein</button>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')


<script>
    // // Offerte Status Changer Accept
    // document.getElementById('manuelAccept').onclick = function(event) {
    //   // Varsayılan davranışı engelle
    //   event.preventDefault();

    //   // Kullanıcıya bir "confirm" mesajı göster
    //   var confirmResult = confirm("Möchten Sie den Status des Angebots in 'Bestätigt' ändern?");

    //   // Kullanıcının seçimine göre işlem yap
    //   if (confirmResult) {
    //     // Evet'e tıklandığında linkin orijinal URL'ine yönlendir
    //     window.location.href = this.href;
    //   } else {

    //   }
    // };


    $("#manuelAccept").click(function(e) {
        e.preventDefault(); // Öntanımlı tıklama işlemini engeller

        var newHref = "{{ route('offer.manuelAccept',['id' => $data['id']]) }}"; // Yeni href değeri
        $("#offerteStatusChangerButton").attr("href", newHref); // href değerini değiştirir
        $("#offerteStatusChangerText").html("Möchten Sie den Status des Angebots in <strong class='text-primary'>Bestätigt</strong> ändern?");
    });

    $("#manuelReject").click(function(e) {
        e.preventDefault(); // Öntanımlı tıklama işlemini engeller

        var newHref = "{{ route('offer.manuelReject',['id' => $data['id']]) }}"; // Yeni href değeri
        $("#offerteStatusChangerButton").attr("href", newHref); // href değerini değiştirir
        $("#offerteStatusChangerText").html("Möchten Sie den Status des Angebots in <strong class='text-primary'>Abgesagt</strong> ändern?");
    });

    $("#manuelDefault").click(function(e) {
        e.preventDefault(); // Öntanımlı tıklama işlemini engeller

        var newHref = "{{ route('offer.manuelDefault',['id' => $data['id']]) }}"; // Yeni href değeri
        $("#offerteStatusChangerButton").attr("href", newHref); // href değerini değiştirir
        $("#offerteStatusChangerText").html("Möchten Sie den Status des Angebots in <strong class='text-primary'>is Offen</strong> ändern?");
    });

    // // Offerte Status Changer Reject
    // document.getElementById('manuelReject').onclick = function(event) {
    //   // Varsayılan davranışı engelle
    //   event.preventDefault();

    //   // Kullanıcıya bir "confirm" mesajı göster
    //   var confirmResult = confirm("Möchten Sie den Status des Angebots in 'Nicht bestätigt' ändern?");

    //   // Kullanıcının seçimine göre işlem yap
    //   if (confirmResult) {
    //     // Evet'e tıklandığında linkin orijinal URL'ine yönlendir
    //     window.location.href = this.href;
    //   } else {

    //   }
    // };

    // // Offerte Status Changer Default
    // document.getElementById('manuelDefault').onclick = function(event) {
    //   // Varsayılan davranışı engelle
    //   event.preventDefault();

    //   // Kullanıcıya bir "confirm" mesajı göster
    //   var confirmResult = confirm("Möchten Sie den Status des Angebots in 'In Wartestellung' ändern?");

    //   // Kullanıcının seçimine göre işlem yap
    //   if (confirmResult) {
    //     // Evet'e tıklandığında linkin orijinal URL'ine yönlendir
    //     window.location.href = this.href;
    //   } else {

    //   }
    // };
</script>

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
        if(status == "Onaylanmadı" || "Beklemede")
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
    $(document).ready(function(){
        contactPerson()
    })
    function contactPerson() {
        if($('select[name=contactPerson]').val() != 0)
        {
        $(".customContactPerson").hide(300)
        }
        else {
        $(".customContactPerson").show(300)
        }
    }
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



@yield('offerFooterAusDetail')
@yield('offerFooterEinDetail')
@yield('offerFooterEntsorgungDetail')
@yield('offerFooterLagerungDetail')
@yield('offerMaterialDetail')
@yield('offerFooterReinigungDetail')
@yield('offerFooterReinigung2Detail')
@yield('offerFooterTransportDetail')
@yield('offerFooterUmzugDetail')
@yield('offerFooterUmzug2Detail')
@endsection
