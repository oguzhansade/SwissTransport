
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
        <h6 class="page-title-heading mr-0 mr-r-5">Quittung Anschauen</h6>
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
            <strong class="h5 mr-1"> <b>Kunde:</b> </strong> <span class="h5 text-primary ">  {{ $data2['name'] }} {{ $data2['surname'] }}</span>
        </div>
        <div class="col-md-12 widget-holder makbuz-alanı">
            <div class="widget-bg">
                <div class="widget-body clearfix ">
                    <form id="receiptForm" action="{{ route('receipt.update',['id' => $data['id']]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            {{-- Makbuz ve Teklif Bilgileri --}}
                            <div id="makbuzAlanı" >
                                <div class="form-group row">
                                    <div class="col-md-12 border-bottom">
                                        <span class="h5 font-weight-bolder">Quittungsnr.: </span> <span class="h5 ml-3 text-primary">{{ $data['offerId'] }}.{{ $data['id'] }}</span>
                                    </div>
                                    <div class="col-md-12 border-bottom mt-3">
                                        <span class="h5 font-weight-bold text-dark">Quittungsart: </span> <span class="h5 ml-3 font-weight-bold text-primary">Standart: Umzug / Entsorgung</span><br>
                                        <span class="text-dark"><i>Quittung erstellt am: </i> <i class="pl-4">{{ $data['created_at'] }}</i></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-1 align-self-center">
                                        <b class="text-dark h5 font-weight-bolder">Status:</b>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control" name="status" id="status">
                                            <option value="Offen" @if($data['status'] == 'Offen') selected @endif>Offen</option>
                                            <option value="Abgeschlossen" @if($data['status'] == 'Abgeschlossen') selected @endif>Abgeschlossen</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row p-3 bg-service-primary">
                                    <div class="col-md-3">
                                        <b class="text-dark">Auftraggeber</b>
                                        <input class="form-control" name="customerGender"  type="text" value="{{ $data['customerGender'] }}">
                                        <input class="form-control mt-1" name="customerName"  type="text" value="{{ $data['customerName'] }}">
                                        <input class="form-control mt-1" name="customerStreet"  type="text" value="{{ $data['customerStreet'] }}">
                                        <input class="form-control mt-1" name="customerPostCode"  type="text" value="{{ $data['customerAddress'] }} ">
                                        <input class="form-control mt-1" name="customerPhone"  type="text" value="{{ $data['customerPhone'] }}">
                                        <input class="form-control mt-1" name="customerMail"  type="text" value="{{ $data['customerMail'] }}">
                                    </div>
                                    <div class="col-md-3">
                                        <b class="text-dark">Auszugsadresse</b>
                                        <input class="form-control" name="aus1Street"  type="text" placeholder="Adr1: Strasse/Nr."
                                        @if ($data['auszugId1'] && \App\Models\ReceiptAddress::InfoAddress($data['auszugId1'],'line1'))
                                        value="{{  \App\Models\ReceiptAddress::InfoAddress($data['auszugId1'],'line1')  }}" @else value="" @endif>
                                        <input class="form-control mt-1" name="aus1PostCode"  type="text" placeholder="Adr1: Ort"
                                        @if ($data['auszugId1'] && \App\Models\ReceiptAddress::InfoAddress($data['auszugId1'],'line2'))
                                        value="{{  \App\Models\ReceiptAddress::InfoAddress($data['auszugId1'],'line2')  }}" @else value="" @endif>
                                        <input class="form-control mt-1" name="aus2Street"  type="text" placeholder="Adr2: Strasse/Nr."
                                        @if ($data['auszugId2'] && \App\Models\ReceiptAddress::InfoAddress($data['auszugId2'],'line1'))
                                        value="{{  \App\Models\ReceiptAddress::InfoAddress($data['auszugId2'],'line1') }}" @else value="" @endif>
                                        <input class="form-control mt-1" name="aus2PostCode"  type="text" placeholder="Adr2: Ort"
                                        @if ($data['auszugId2'] &&  \App\Models\ReceiptAddress::InfoAddress($data['auszugId2'],'line2'))
                                        value="{{  \App\Models\ReceiptAddress::InfoAddress($data['auszugId2'],'line2')  }}" @else value="" @endif>
                                        <input class="form-control mt-1" name="aus3Street"  type="text" placeholder="Adr3: Strasse/Nr."
                                        @if ($data['auszugId3'] && \App\Models\ReceiptAddress::InfoAddress($data['auszugId3'],'line1'))
                                        value="{{  \App\Models\ReceiptAddress::InfoAddress($data['auszugId3'],'line1')  }}" @else value="" @endif>
                                        <input class="form-control mt-1" name="aus3PostCode"  type="text" placeholder="Adr3: Ort"
                                        @if ($data['auszugId3'] && \App\Models\ReceiptAddress::InfoAddress($data['auszugId3'],'line2'))
                                        value="{{  \App\Models\ReceiptAddress::InfoAddress($data['auszugId3'],'line2')  }}" @else value="" @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <b class="text-dark">Einzugsadresse</b>
                                        <input class="form-control" name="ein1Street"  type="text" placeholder="Adr1: Strasse/Nr."
                                        @if ($data['einzugId1'] && \App\Models\ReceiptAddress::InfoAddress($data['einzugId1'],'line1'))
                                        value="{{  \App\Models\ReceiptAddress::InfoAddress($data['einzugId1'],'line1')  }}" @else value="" @endif>
                                        <input class="form-control mt-1" name="ein1PostCode"  type="text" placeholder="Adr1: Ort"
                                        @if ($data['einzugId1'] && \App\Models\ReceiptAddress::InfoAddress($data['einzugId1'],'line2'))
                                        value="{{  \App\Models\ReceiptAddress::InfoAddress($data['einzugId1'],'line2')  }}" @else value="" @endif>
                                        <input class="form-control mt-1" name="ein2Street"  type="text" placeholder="Adr2: Strasse/Nr."
                                        @if ($data['einzugId2'] && \App\Models\ReceiptAddress::InfoAddress($data['einzugId2'],'line1'))
                                        value="{{  \App\Models\ReceiptAddress::InfoAddress($data['einzugId2'],'line1')  }}" @else value="" @endif>
                                        <input class="form-control mt-1" name="ein2PostCode"  type="text" placeholder="Adr2: Ort"
                                        @if ($data['einzugId2'] && \App\Models\ReceiptAddress::InfoAddress($data['einzugId2'],'line2'))
                                        value="{{  \App\Models\ReceiptAddress::InfoAddress($data['einzugId2'],'line2')  }}" @else value="" @endif>
                                        <input class="form-control mt-1" name="ein3Street"  type="text" placeholder="Adr3: Strasse/Nr."
                                        @if ($data['einzugId3'] && \App\Models\ReceiptAddress::InfoAddress($data['einzugId3'],'line1'))
                                        value="{{  \App\Models\ReceiptAddress::InfoAddress($data['einzugId3'],'line1')  }}" @else value="" @endif>
                                        <input class="form-control mt-1" name="ein3PostCode"  type="text" placeholder="Adr3: Ort"
                                        @if ($data['einzugId3'] && \App\Models\ReceiptAddress::InfoAddress($data['einzugId3'],'line2'))
                                        value="{{  \App\Models\ReceiptAddress::InfoAddress($data['einzugId3'],'line2')  }}" @else value="" @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <b class="text-dark">Auftragstermin</b>
                                        <input class="form-control" name="umzugDate"  type="date"
                                        value="{{ $data['orderDate'] }}" >
                                        <input class="form-control mt-1" name="umzugTime"  type="time"
                                        value="{{ $data['orderTime'] }}">
                                    </div>
                                </div>
                            </div>

                            {{-- Harcamalar --}}
                            <div id="harcamaAlanı" class="border-bottom border-primary">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <strong class="text-underline h5 text-dark "><b>Aufwand</b></strong>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <b class="text-dark">Dauer  [h]</b>
                                        <input class="form-control" name="umzugHour"  type="text" value="{{ $data['umzugHour'] }}">
                                    </div>
                                    <div class="col-md-4">
                                        <b class="text-dark">Ansatz  [CHF]</b>
                                        <input class="form-control" name="umzugChf"  type="text" value="{{ $data['umzugChf'] }}">
                                    </div>
                                    <div class="col-md-4">
                                        <b class="text-dark">Total  [CHF]</b>
                                        <input class="form-control" name="umzugCost"  type="text" value="{{ $data['umzugTotalChf'] }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <b class="text-dark">Spesen</b>
                                        <input class="form-control" name="umzugSpesenCost"  type="text" value="{{ $data['umzugCharge'] }}">
                                    </div>
                                    <div class="col-md-4">
                                        <table class="table">
                                            <tr>
                                                <td class="p-0">
                                                    <b class="text-dark">Anfahrt</b>
                                                    <input class="form-control" name="umzugArrivalGas"  type="text" placeholder="[CHF]" value="{{ $data['umzugArrivalGas'] }}">
                                                </td>
                                                <td style="vertical-align: middle;" class=" px-2">_</td>
                                                <td class="p-0">
                                                    <b class="text-dark">Rückfahrt</b>
                                                    <input class="form-control" name="umzugReturnGas"  type="text" placeholder="[CHF]" {{ $data['umzugReturnGas'] }}>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-4">
                                        <b class="text-dark">Verpackungsmaterial</b>
                                        <input class="form-control" name="umzugPackCost"  type="text" placeholder="[CHF]" value="{{ $data['materialPrice'] }}">
                                    </div>
                                </div>
                            </div>

                            {{-- Entsorgung Alanı --}}
                            <div id="entsorgungAlanı" class="border-bottom border-primary mt-3">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <strong class="text-underline h5 text-dark "><b>Entsorgung</b></strong>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <b class="text-dark">Volume  [m3]</b>
                                        <input class="form-control" name="entsorgungVolume"  type="text" value="{{ $data['entsorgungVolume'] }}">
                                    </div>
                                    <div class="col-md-4">
                                        <b class="text-dark">Ansatz  [CHF]</b>
                                        <input class="form-control" name="entsorgungRate"  type="text"  value="{{ $data['entsorgungChf'] }}">
                                    </div>
                                    <div class="col-md-4">
                                        <b class="text-dark">Total  [CHF]</b>
                                        <input class="form-control" name="entsorgungCost"  type="text" value="{{ $data['entsorgungTotalChf'] }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <b class="text-dark">Aufwand an der Entsorgungsstelle</b>
                                        <input class="form-control" name="entsorgungFixed"  type="text" placeholder="[CHF]" value="{{ $data['entsorgungFixedChf'] }}">
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


                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addCost1Text" placeholder="Text"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra1'))
                                            value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra1Text') }}"
                                            @endif>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ek" name="addCost1" placeholder="[CHF]"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra1'))
                                            value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra1') }}"
                                            @endif>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addCost2Text" placeholder="Text"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra2'))
                                            value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra2Text') }}"
                                            @endif>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ek" name="addCost2" placeholder="[CHF]"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra2'))
                                             value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra2') }}"
                                             @endif>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addCost3Text" placeholder="Text"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra3'))
                                            value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra3Text') }}"
                                            @endif>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ek" name="addCost3" placeholder="[CHF]"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra3'))
                                            value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra3') }}"
                                            @endif>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addCost4Text" placeholder="Text"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra4'))
                                            value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra4Text') }}"
                                            @endif>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ek" name="addCost4" placeholder="[CHF]"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra4'))
                                             value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra4') }}"
                                             @endif>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addCost5Text" placeholder="Text"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra5'))
                                            value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra5Text') }}"
                                            @endif>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ek" name="addCost5" placeholder="[CHF]"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra5'))
                                            value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra5') }}"
                                            @endif>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addCost6Text" placeholder="Text"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra6'))
                                            value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra6Text') }}"
                                            @endif>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ek" name="addCost6" placeholder="[CHF]"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra6'))
                                             value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra6') }}"
                                             @endif>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addCost7Text" placeholder="Text"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra7'))
                                            value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra7Text') }}"
                                            @endif>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ek" name="addCost7" placeholder="[CHF]"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra7'))
                                             value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra7') }}"
                                             @endif>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addCost8Text" placeholder="Text"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra8'))
                                            value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra8Text') }}"
                                            @endif>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ek" name="addCost8" placeholder="[CHF]"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra8'))
                                            value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra8') }}"
                                            @endif>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addCost9Text" placeholder="Text"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra9'))
                                            value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra9Text') }}"
                                            @endif>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ek" name="addCost9" placeholder="[CHF]"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra9'))
                                             value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra9') }}"
                                             @endif>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addCost10Text" placeholder="Text"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra10'))
                                            value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra10Text') }}"
                                            @endif>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ek" name="addCost10" placeholder="[CHF]"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra10'))
                                           value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra10') }}"
                                           @endif>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addCost11Text" placeholder="Text"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra11'))
                                            value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra11Text') }}"
                                            @endif>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ek" name="addCost11" placeholder="[CHF]"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra11'))
                                            value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra11') }}"
                                            @endif>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addCost12Text" placeholder="Text"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra12'))
                                            value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra12Text') }}"
                                            @endif>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ek" name="addCost12" placeholder="[CHF]"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra12'))
                                            value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra12') }}"
                                            @endif>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addCost13Text" placeholder="Text"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra13'))
                                            value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra13Text') }}"
                                            @endif>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ek" name="addCost13" placeholder="[CHF]"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra13'))
                                            value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra13') }}"
                                            @endif>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addCost14Text" placeholder="Text"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra14'))
                                            value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra14Text') }}"
                                            @endif>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ek" name="addCost14" placeholder="[CHF]"  type="text"
                                            @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra14'))
                                            value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra14') }}"
                                            @endif>
                                        </div>
                                    </div>


                                {{-- Ekstra Custom Harcama --}}
                                <div class="form-group row">
                                    <div class="col-md-7">
                                        <input class="form-control" name="addCost15Text" placeholder="Text"  type="text"
                                        @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra15'))
                                        value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra15Text') }}"@endif>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control ek" name="addCost15" placeholder="[CHF]"  type="text"
                                        @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra15'))
                                        value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra15') }}"@endif>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-7">
                                        <input class="form-control" name="addCost16Text" placeholder="Text"  type="text"
                                        @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra16'))
                                        value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra16Text') }}" @endif>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control ek" name="addCost16" placeholder="[CHF]"  type="text"
                                        @if ($data['receiptExtraId'] && \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra16'))
                                        value="{{ \App\Models\ReceiptExtra::InfoExtra($data['receiptExtraId'],'extra16') }}"@endif>
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


                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addDiscount1Text" placeholder="Text"  type="text"
                                            @if ($data['receiptDiscountId'] && \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount1'))
                                            value="{{ \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount1Text') }}"
                                            @endif>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ekc" name="addDiscount1" placeholder="[CHF]"  type="text"
                                            @if ($data['receiptDiscountId'] && \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount1'))
                                             value="{{ \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount1') }}"
                                             @endif>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addDiscount2Text" placeholder="Text"  type="text"
                                            @if ($data['receiptDiscountId'] && \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount2'))
                                            value="{{ \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount2Text') }}"
                                            @endif>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ekc" name="addDiscount2" placeholder="[CHF]"  type="text"
                                            @if ($data['receiptDiscountId'] && \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount2'))
                                            value="{{ \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount2') }}"
                                            @endif>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addDiscount3Text" placeholder="Text"  type="text"
                                            @if ($data['receiptDiscountId'] && \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount3'))
                                            value="{{ \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount3Text') }}"
                                            @endif>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ekc" name="addDiscount3" placeholder="[CHF]"  type="text"
                                            @if ($data['receiptDiscountId'] && \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount3'))
                                            value="{{ \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount3') }}"
                                            @endif>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addDiscount4Text" placeholder="Text"  type="text"
                                            @if ($data['receiptDiscountId'] && \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount4'))
                                            value="{{ \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount4Text') }}"
                                            @endif>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ekc" name="addDiscount4" placeholder="[CHF]"  type="text"
                                            @if ($data['receiptDiscountId'] && \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount4'))
                                             value="{{ \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount4') }}"
                                             @endif>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <div class="col-md-7">
                                            <input class="form-control" name="addDiscount5Text" placeholder="Text"  type="text"
                                            @if ($data['receiptDiscountId'] && \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount5'))
                                            value="{{ \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount5Text') }}"
                                            @endif>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control ekc" name="addDiscount5" placeholder="[CHF]"  type="text"
                                            @if ($data['receiptDiscountId'] && \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount5'))
                                            value="{{ \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount5') }}"
                                            @endif>
                                        </div>
                                    </div>


                                {{-- Ekstra Custom Kesinti --}}
                                <div class="form-group row">
                                    <div class="col-md-7">
                                        <input class="form-control" name="addDiscount6Text" placeholder="Text"  type="text"
                                        @if ($data['receiptDiscountId'] && \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount6'))
                                        value="{{ \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount6Text') }}" @endif>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control ekc" name="addDiscount6" placeholder="[CHF]"  type="text"
                                        @if ($data['receiptDiscountId'] && \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount6'))
                                        value="{{ \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount6') }}" @endif>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-7">
                                        <input class="form-control" name="addDiscount7Text" placeholder="Text"  type="text"
                                        @if ($data['receiptDiscountId'] && \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount7'))
                                        value="{{ \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount7Text') }}" @endif>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control ekc" name="addDiscount7" placeholder="[CHF]"  type="text"
                                        @if ($data['receiptDiscountId'] && \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount7'))
                                        value="{{ \App\Models\ReceiptDiscount::InfoDiscount($data['receiptDiscountId'],'discount7') }}" @endif>
                                    </div>
                                </div>

                            </div>

                            {{-- Maliyetler Alanı --}}
                            <div id="maliyetAlanı" class="mt-3 p-3 rounded bg-service-primary">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <strong class="text-underline h5 text-dark "><b>Kosten</b></strong>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <b class="text-dark">Pauschal</b>
                                        <input class="form-control" name="costFix" placeholder="[CHF]"  type="text" value="{{ $data['fixedPrice'] }}">
                                        <i class="text-dark"><u>ACHTUNG:</u> Betrag aus Umzug Pauschalpreis</i>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <b class="text-dark">Kostendach</b>
                                        <input class="form-control" name="costHigh" placeholder="[CHF]"  type="text" value="{{ $data['topPrice'] }}">
                                    </div>
                                </div>

                                <div class="form-group row taxArea">
                                    <div class="col-md-12">
                                        <b class="text-dark">Total  [CHF]</b>
                                        <input class="form-control" name="totalCost" placeholder="[CHF]"  type="text" value="{{ $data['totalPrice'] }}">
                                        <label for="">Mwst [CHF]:</label>
                                        <small class="text-primary"><b id="taxValue"></b></small> <br>
                                        <label for="">Total Inkl. [CHF]:</label>
                                        <small class="text-primary"><b id="totalWithTax"></b></small>
                                    </div>
                                    <div class="taxType">
                                        <div class="col-md-12 ">
                                            <div class="checkbox checkbox-rounded checkbox-primary " >
                                                <label class="">
                                                    <input type="checkbox" name="withTax"  value="1" @if($data['withTax']) checked @endif>
                                                    <span class="label-text text-dark"><strong>Kosten inkl. MwSt.</strong></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 ">
                                            <div class="checkbox checkbox-rounded checkbox-primary">
                                                <label class="">
                                                    <input type="checkbox" name="withoutTax"  value="1" @if($data['withoutTax']) checked @endif>
                                                    <span class="label-text text-dark"><strong>Kosten exkl. MwSt.</strong></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 ">
                                            <div class="checkbox checkbox-rounded checkbox-primary">
                                                <label class="">
                                                    <input type="checkbox" name="freeTax"  value="1" @if($data['freeTax']) checked @endif>
                                                    <span class="label-text text-dark "><strong>Kostenfrei MwSt. </strong></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Ödeme Alanı --}}
                            <div id="maliyetAlanı" class="mt-3 p-3  rounded text-dark bg-service-primary">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <strong class="text-underline h5 text-dark "><b>Zahlung</b></strong>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <div class="checkbox checkbox-rounded checkbox-primary " >
                                            <label class="">
                                                <input type="checkbox" name="payedCash"  value="1" @if($data['inBar']) checked @endif>
                                                <span class="label-text text-dark"><strong>In Bar</strong></span>
                                            </label>
                                        </div>
                                        <input class="form-control" name="payedCashCost" placeholder="CHF [Betrag]"  type="text" value="{{ $data['cashPrice'] }}">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox checkbox-rounded checkbox-primary " >
                                            <label class="">
                                                <input type="checkbox" name="payedBill"  value="1" @if($data['inRechnung']) checked @endif>
                                                <span class="label-text text-dark"><strong>In Rechnung</strong></span>
                                            </label>
                                        </div>
                                        <input class="form-control" name="payedBillCost" placeholder="CHF [Betrag]"  type="text" value="{{ $data['invoicePrice'] }}">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox checkbox-rounded checkbox-primary " >
                                            <label class="">
                                                <input type="checkbox" name="inTwint"  value="1" @if($data['inTwint']) checked @endif>
                                                <span class="label-text text-dark"><strong>In Twint</strong></span>
                                            </label>
                                        </div>
                                        <input class="form-control" name="twintPrice" placeholder="CHF [Betrag]"  type="text" value="{{ $data['twintPrice'] }}">
                                    </div>
                                </div>
                            </div>

                            {{-- İmza Alanı --}}
                            <div id="maliyetAlanı" class="mt-3  pt-3 pb-2 px-2  rounded text-dark bg-service-primary">
                                <div class="form-group row d-flex justify-content-right">
                                    <div class="col-md-5">
                                        <strong class=" h5 text-dark "><b>Kundenname für Unterschriftsfeld</b></strong>
                                        <input class="form-control" name="signatureName" placeholder="Müşteri Adı"  type="text"
                                        value="{{ $data['signerName'] }}">
                                    </div>
                                </div>
                            </div>

                            {{-- Mail Alanı --}}
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

                                <div class="col-md-12 email-format">
                                    <label for="" class="col-form-label">Standard Emailtext bearbeiten</label><br>
                                    <input type="checkbox" name="isCustomEmail" id="isCustomEmail" class="js-switch isCustomEmail" data-color="#286090" data-switchery="false" >
                                </div>
                            </div>

                            <div class="row form-group email--format" style="display: none;">
                                <div class="col-md-12 mt-3">
                                    <textarea class="editor" name="customEmail" id="customEmail" cols="30" rows="10">
                                            {{-- @include('../../offerEmail') --}}
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="form-group row">
                                    <div class="col-md-12 ml-md-auto btn-list">
                                        <button class="btn btn-primary btn-rounded" type="submit">Erstellen</button>
                                        <a class="btn btn-info btn-rounded" href="{{ route('receipt.edit',['id'=>$data['id']]) }}"> <strong>Bearbeiten</strong></a>

                                        {{-- Officer Aufgabe erstellen Yapamaz --}}
                                        @if (in_array(Auth::user()->permName, ['superAdmin', 'chef']))
                                            <a id="createTask"  href="{{ route('task.createFromReceipt',['id' => $data['id']]) }}"
                                                class="btn btn-rounded text-white" target="_blank" style="background-color:#F0AD4E"> <strong>Aufgabe erstellen</strong>
                                            </a>
                                        @endif

                                        <a id="createTask"  href="{{ route('receipt.showPdf',['id' => $data['id']]) }}"
                                            class="btn btn-rounded text-white" target="_blank" style="background-color:#ff0000"> <strong>Ausdrucken</strong>
                                        </a>
                                        @if (in_array(Auth::user()->permName, ['superAdmin', 'chef']))
                                        <a class="btn btn-warning btn-rounded" href="{{ route('expense.editUmzug',['id'=>$data['id']]) }}"> <strong>Aufwand</strong></a>
                                        @endif

                                        @if (in_array(Auth::user()->permName, ['superAdmin']))
                                        <a class="btn btn-dark btn-rounded" href="{{ route('receipt.bexioSearchCustomer',['customerId'=>$data['customerId'],'receiptId' => $data['id']]) }}"> <strong>Bexio (Development)</strong></a>
                                        @endif

                                        <a class="btn  btn-success btn-rounded" href="#" data-toggle="modal" data-target="#addSignatureModal" data-id=""><strong>Unterschrift</strong></a>
                                    </div>
                                </div>
                            </div>
                    </form>

                    {{-- Add Signature Modal --}}
                    <div class="modal fade custom-modal mt-2" id="addSignatureModal" tabindex="-1" role="dialog" aria-labelledby="addSignatureModal" aria-hidden="true" >
                        <div class="modal-dialog" role="document">
                            <div class="modal-content " style="background-color: #F5F7FA">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title " id="addSignatureModal">Signature Area </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" >
                                    <div class="row d-flex mt-2 " >
                                        <div class="col-md-12 ">
                                            @if($data['signature'])
                                            <span class="text-primary">Signature:</span>
                                            <div class="col-md-3 bg-white mb-3">
                                                <img src="{{ $data['signature'] }}" width="150" alt="Signature Image">
                                            </div>
                                            @endif
                                            <canvas id="signature-pad" class="signature-pad bg-white" width="500" height="200"></canvas>
                                            <input id="signatureData" type="hidden" name="signature_image">
                                            <input id="receiptType" type="hidden" value="{{ $data['receiptType'] }}">
                                            <input id="receiptId" type="hidden" value="{{ $data['id'] }}">
                                            <button class="btn btn-sm btn-danger" onclick="signatureClear()">Clear</button>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12 d-flex justify-content-center">
                                            <a href="#" id="addNewNotiz" class="btn btn-success justify-content-end" data-id=""  onclick="saveSignature(this)">@if($data['signature']) Aktualisieren @else Erstellen @endif</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
{{-- İmza İşemleri --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>

<script>
    $(document).ready(function(){
        let totalCHF = $("input[name=totalCost]").val();
        let taxValue = totalCHF*(8.1/100);
        taxValue = taxValue.toFixed(2);
        $('#taxValue').text(taxValue);


        let totalWithTax = parseFloat(totalCHF) + parseFloat(taxValue);
        $('#totalWithTax').text(totalWithTax);
    })
</script>
<script>
    var canvas = document.getElementById('signature-pad');
    var signaturePad = new SignaturePad(canvas);
    var type = $('#receiptType').val();
    var id = $('#receiptId').val();
    // optional settings
    signaturePad.minWidth = 1;
    signaturePad.maxWidth = 3;

    // Clear the canvas on click
    document.querySelector('button[type="submit"]').addEventListener('click', function() {
        document.querySelector('input[name="signature_image"]').value = signaturePad.toDataURL();
        signaturePad.clear();
    });

    function signatureClear()
    {
        signaturePad.clear();
    }

    function saveSignature(element) {
        console.log(type,'tip',id, 'id');
        var url = '{{ route('receipt.signatureSave', ['id' => $data['id'],'type' => $data['receiptType']]) }}'
        console.log(url);
        var signature = signaturePad.toDataURL();
        if(signature)
        {
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                type: 'POST',
                dataType: 'json',
                data: {
                '_token': '{{ csrf_token() }}', // CSRF token
                'signature': signature // signature değeri
                },
                success: function (response) {
                    toastr.success('Quittung erfolgreich signiert. Seite wird neu geladen. Bitte warten...')
                    signaturePad.clear();
                    $('#addSignatureModal').modal('hide');
                    setTimeout(function(){
                        location.reload(); // 3 saniye sonra sayfayı yenile
                    }, 3000); // 3 saniye = 3000 milisaniye
                },
                error: function (response) {
                    toastr.error(response,'HATA! Quittung konnte nicht unterschrieben werden.')
                    console.log(response,'Add New Erstellen Error')
                }
            })
        }
        else{
            toastr.error('No Signature')
        }
    }

</script>



{{-- Hesaplamalar --}}
<script>
    $(document).ready(function(){
        $("#receiptForm :input").prop("disabled", true);
    })
</script>
@endsection
