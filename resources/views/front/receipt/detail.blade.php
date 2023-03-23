
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
                                
                                <div class="form-group row p-3" style="background-color:#c3a7f5;">
                                    <div class="col-md-3">
                                        <b class="text-dark">Auftraggeber</b>
                                        <input class="form-control" name="customerGender"  type="text" value="{{ $data['customerGender'] }}">
                                        <input class="form-control mt-1" name="customerName"  type="text" value="{{ $data['customerName'] }}">
                                        <input class="form-control mt-1" name="customerStreet"  type="text" value="{{ $data['customerStreet'] }}">
                                        <input class="form-control mt-1" name="customerPostCode"  type="text" value="{{ $data['customerAddress'] }} ">
                                        <input class="form-control mt-1" name="customerPhone"  type="text" value="{{ $data['customerPhone'] }}">
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
                                        <b class="text-dark">Anfahrt/Rückfahrt</b>
                                        <input class="form-control" name="umzugRoadChf"  type="text" placeholder="[CHF]" value="{{ $data['umzugRoadChf'] }}">
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
                            <div id="maliyetAlanı" class="mt-3 p-3 rounded" style="background-color: #c3a7f5;">
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

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <b class="text-dark">Total  [CHF]</b>
                                        <input class="form-control" name="totalCost" placeholder="[CHF]"  type="text" value="{{ $data['totalPrice'] }}">
                                    </div>
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
                                                <input type="checkbox" name="payedCash"  value="1" @if($data['cashPrice']) checked @endif> 
                                                <span class="label-text text-dark"><strong>In Bar</strong></span>
                                            </label>
                                        </div>
                                        <input class="form-control" name="payedCashCost" placeholder="CHF [Betrag]"  type="text" value="{{ $data['cashPrice'] }}">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkbox checkbox-rounded checkbox-primary " >
                                            <label class="">
                                                <input type="checkbox" name="payedBill"  value="1" @if($data['invoicePrice']) checked @endif> 
                                                <span class="label-text text-dark"><strong>In Rechnung</strong></span>
                                            </label>
                                        </div>
                                        <input class="form-control" name="payedBillCost" placeholder="CHF [Betrag]"  type="text" value="{{ $data['invoicePrice'] }}">
                                    </div>
                                </div>
                            </div>

                            {{-- İmza Alanı --}}
                            <div id="maliyetAlanı" class="mt-3  pt-3 pb-2 px-2  rounded text-dark" style="background-color: #c3a7f5;">
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
                                    <input type="checkbox" name="isEmail" id="isEmail" class="js-switch " data-color="#9c27b0" data-switchery="false" >  
                                </div>                            
                            </div>
                            
                            <div class="row form-group email--area" style="display: none;">
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">E-Mail Adresse</label>
                                    <input class="form-control" name="email"  type="text" value="{{   $data2['email']  }}">                                
                                </div>  
    
                                <div class="col-md-12 email-format">
                                    <label for="" class="col-form-label">Standard Emailtext bearbeiten</label><br>
                                    <input type="checkbox" name="isCustomEmail" id="isCustomEmail" class="js-switch isCustomEmail" data-color="#9c27b0" data-switchery="false" >   
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
                                        <a class="btn btn-info btn-rounded" href="{{ route('receipt.edit',['id'=>$data['id']]) }}"> Bearbeiten</a>

                                        <a id="createTask"  href="{{ route('receipt.showPdf',['id' => $data['id']]) }}" 
                                            class="btn btn-rounded text-white" target="_blank" style="background-color:#ff0000"> <strong>Ausdrucken</strong> 
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
{{-- Hesaplamalar --}}
<script>
    $(document).ready(function(){
        $("#receiptForm :input").prop("disabled", true);
        calc()
    })

    $("body").on("change",".makbuz-alanı",function () {
        calc()
    })
        
    function calc(){
            
            let umzugHour = parseFloat($("input[name=umzugHour]").val());
            let umzugChf = parseFloat($("input[name=umzugChf]").val());
            let umzugCost = 0;
            if(umzugHour && umzugChf)
            {
                umzugCost = umzugHour*umzugChf;
                umzugCost = umzugCost.toFixed(2);
                $("input[name=umzugCost]").val(umzugCost);
            }
            else{
                $("input[name=umzugCost]").val('');
            }
            let entsorgungVolume = parseFloat($("input[name=entsorgungVolume]").val());
            let entsorgungRate = parseFloat($("input[name=entsorgungRate]").val());
            let entsorgungCost =0;
            if(entsorgungVolume && entsorgungRate)
            {
                entsorgungCost=entsorgungVolume*entsorgungRate;
                entsorgungCost = entsorgungCost.toFixed(2);
                $("input[name=entsorgungCost]").val(entsorgungCost);
            }
            else{
                $("input[name=entsorgungCost]").val('');
            }
            let umzugSpesenCost =  $("input[name=umzugSpesenCost]").val() ? parseFloat($("input[name=umzugSpesenCost]").val()) : 0 ;
            let umzugRoadChf = $("input[name=umzugRoadChf]").val() ? parseFloat($("input[name=umzugRoadChf]").val()) : 0 ;
            let umzugPackCost = $("input[name=umzugPackCost]").val() ? parseFloat($("input[name=umzugPackCost]").val()) : 0 ;
            let entsorgungFixed = $("input[name=entsorgungFixed]").val() ? parseFloat($("input[name=entsorgungFixed]").val()) : 0 ;
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
            let costFix = parseFloat($("input[name=costFix]").val());
            let costHigh = parseFloat($("input[name=costHigh]").val());
            totalCost = 0;

            if(costHigh)
            {
                costHigh=costHigh.toFixed(2);
                $("input[name=totalCost]").val(costHigh);
            }

            else if(costFix)
            {
                costFix = costFix.toFixed(2);
                $("input[name=totalCost]").val(costFix);
            }
            else{
                
                if($("input[name=umzugCost]").val())
                {
                    umzugCost = parseFloat($("input[name=umzugCost]").val());
                }
                else{
                    umzugCost = 0;
                }
                if($("input[name=entsorgungCost]").val())
                {
                    entsorgungCost = parseFloat($("input[name=entsorgungCost]").val());
                }
                else {
                    entsorgungCost = 0;
                }
                
                
                totalCost = umzugCost + umzugSpesenCost + umzugRoadChf + umzugPackCost + entsorgungCost + entsorgungFixed + ekler - kesintiler;
                totalCost = totalCost.toFixed(2);
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