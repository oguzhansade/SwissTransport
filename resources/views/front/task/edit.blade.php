@extends('layouts.app')
@section('content')

<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Aufgaben Anschauen</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Panel</a>
            </li>
            <li class="breadcrumb-item active">Aufgaben</li>
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

<div  class="widget-list " >
    <div class="row">
        <div class="col-md-12 widget-holder task-area">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <form id="taskFormDetail" action="{{ route('task.update',['id' => $data['id']]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row p-3 mb-3">
                            <div class="col-md-4">
                                <label class=" col-form-label" for="l0">Quittungnnr</label>
                                <select id="receiptUmzug" name="receiptUmzugId" class="m-b-10 form-control" data-placeholder="Bitte Wahlen" data-toggle="select2" required>
                                    <option class="form-control" value="">Bitte Wahlen</option>
                                    @foreach (\App\Models\ReceiptUmzug::all() as $k => $v)
                                        <option class="form-control" data-umzugHour="{{ $v['umzugHour'] }}" value="{{ $v['id'] }}"
                                        @if($data['receiptUmzugId'] == $v['id']) selected @endif>{{ $v['id'] }}</option>
                                    @endforeach
                                </select>   
                                <small id="defaultHour" class="text-primary"></small>
                            </div>

                            <div class="col-md-4">
                                <label class=" col-form-label" for="l0">Aufgaben Am</label>
                                <input class="form-control" class="date"  name="taskDate"  type="date" required value="{{ $data['taskDate'] }}"> 
                            </div>

                            <div class="col-md-4">
                                <label class=" col-form-label" for="l0">Aufgaben Stunde</label>
                                <input class="form-control" class="time"  name="taskTime"  type="time" required value="{{ $data['taskTime'] }}"> 
                            </div>
                        </div>
                        <div class="row p-3">
                            <div class="col-md-12">
                                <div class="table-reponsive">
                                    <table id="faturaData" class="table">
                                        <thead class="text-dark">
                                            <tr>
                                                <th>Aufgaben Name</th>
                                                <th>Preis[h]</th>
                                                <th>Stunde</th>
                                                <th>Total</th>
                                                <th>Löschen</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if($data)
                                            {{-- Kaç Ürün Varsa O kadar Tekrarlanacak --}}
                                            @foreach ($basket as $a => $b)
                                            <tr class="islem_field"> 
                                                <td><select class="m-b-10 form-control isci" name="islem[{{ $a }}][workerId]" data-toggle="select2">
                                                <option class="form-control" value="0"> Arbeiter auswählen </option>;
                                                @foreach (\App\Models\Worker::all() as $key => $value)
                                                <option class="form-control" data-fiyat="{{ $value['workPrice'] }}" data-name="{{ $value['name'] }} {{ $value['surname'] }}"  value="{{ $value['id'] }}"
                                                @if($b['workerId'] == $value['id']) selected @endif>{{ $value['name'] }} {{ $value['surname'] }}</option> 
                                                @endforeach
                                        
                                                </select></td>
                                                <td><input type="text" class="form-control" id="tutar" name="islem[{{ $a }}][tutar]" value="{{ $b['workerPrice'] }}" ></td>
                                                <td><input type="text" class="form-control" id="saat" name="islem[{{ $a }}][saat]" value="{{ $b['workHour'] }}"></td>
                                               
                                                <td><input type="text" class="form-control" id="toplam" name="islem[{{ $a }}][toplam]" value="{{ $b['totalPrice'] }}"></td>
                                                <td><button id="removeButton" type="button" class="btn btn-danger" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">X</button></td>
                                                </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3  d-flex justify-content-right align-items-center text-center text-white ">
                            <div class="col-md-12 ">
                                <span id="urun_adet"  class="h5 urun_adet p-3 rounded " style="color:white;box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;"></span>
                            </div>
                        </div>
                        <div class="row p-3">
                            <div class="col-md-12 d-flex justify-content-center">
                                <button type="button" id="addRowBtn" class="box-shadow btn-rounded btn btn-primary " style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;"> <i class="feather feather-plus "></i> Arbeiter hinzufügen</button>
                                <button type="button" id="removeAllButton" class="btn-rounded btn btn-danger ml-1" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">Alles löschen</button>
                            </div>
                        </div>
                        
                        <div class="row p-3">
                            <div class="col-md-6">
                                <label class="col-form-label" for="l0">Total</label>
                                <input class="form-control ara_toplam" name="taskTotalPrice" type="text" value="{{ $data['taskTotalPrice'] }}">
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
<script>
    
</script>
<script>
    
    var say = {{ App\Models\WorkerBasket::getBasket($data['id'])->count()}}
    $(document).ready(function(){
       

        let defaultHour = $(this).find("option:selected").attr("data-umzugHour") || 0;
        if(!isNaN(defaultHour))
        {
            $("#defaultHour").text('Standardstunde: '+defaultHour);
        }
        else{
            defaultHour = 0;
            $("#defaultHour").text('Standardstunde: 0');
        }
   
        $("#receiptUmzug").on("change", function() {
            defaultHour = $(this).find("option:selected").attr("data-umzugHour");
            defaultHour = parseInt(defaultHour)
            if(!isNaN(defaultHour))
            {
                $("#defaultHour").text('Standardstunde: '+defaultHour);
            }
            else{
                defaultHour = 0;
                $("#defaultHour").text('Standardstunde: 0');
            }
        })

        var tutaring = parseFloat($("#tutar").val()).toFixed(2);
        var toplaming = parseFloat($("#toplam").val()).toFixed(2);
        $("#tutar").val(tutaring)
        $("#toplam").val(toplaming)

        
        $(".urun_adet").html(say+' '+'Anzahl der Arbeiter');

        $("body").on("click","#removeButton", function () {
        say = say-1;
        if(say==0)
            {
            $(".urun_adet").html('Es wurden keine Arbeitnehmer eingestellt');
            }
        else{
            $(".urun_adet").html(say+' '+'Anzahl der Arbeiter');
        }
        
        $(this).closest(".islem_field").remove();
        console.log(say,'Silerken')
        calc();
        })

        var i = $(".islem_field").length || 0;
        $("#addRowBtn").click(function () {
        
        $(".urun_adet").html(say+1+' '+'Anzahl der Arbeiter');
            var newRow = 
            '<tr class="islem_field">' +
            '<td><select class="m-b-10 form-control isci" name="islem['+i+'][workerId]" data-toggle="select2">'+
            '<option class="form-control" value="0"> Arbeiter auswählen </option>';
            @foreach (\App\Models\Worker::all() as $key => $value)
                
            newRow+= '<option class="form-control" data-fiyat="{{ $value['workPrice'] }}" data-name="{{ $value['name'] }} {{ $value['surname'] }}"  value="{{ $value['id'] }}">{{ $value['name'] }} {{ $value['surname'] }}</option>';  
            @endforeach

            newRow+='</select></td>'+
            '<td><input type="text" class="form-control" id="tutar" name="islem['+i+'][tutar]" value="0" ></td>'+
            '<td><input type="text" class="form-control" id="saat" name="islem['+i+'][saat]" value="' + defaultHour + '"></td>'+
            ''+
            '<td><input type="text" class="form-control" id="toplam" name="islem['+i+'][toplam]" value="0"></td>'+
            '<td><button id="removeButton" type="button" class="btn btn-danger" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">X</button></td>'+
            '</tr>'
            
            $("#faturaData").append(newRow);
            
            i++;
            say++; 
        });
    })


    $("body").on("change",".isci",function () {
        var fiyat = $(this).find(":selected").data("fiyat");
        $(this).closest(".islem_field").find("#tutar").val(fiyat);
        calc();
    })
    

    $("body").on("change",".islem_field", function (){

        let fiyat = $(this).find('.isci').find(":selected").data("fiyat")
        let   saat = $(this).closest(".islem_field").find("#saat").val();
        let tutar = $(this).closest(".islem_field").find("#tutar").val() || 0;
        tutar = parseFloat(tutar)
        saat = parseFloat(saat)
        $(this).closest(".islem_field").find("#tutar").val(tutar.toFixed(2));
        $(this).closest(".islem_field").find("#toplam").val((tutar * saat).toFixed(2));

        calc()
    })


    $("body").on("click","#removeAllButton", function () {
        say = 0;
        $(".urun_adet").html('Es wurden keine Arbeitnehmer eingestellt');
        
        $("[id=toplam]").each(function () {
            $(this).closest(".islem_field").remove();
        });
        
        calc();
    })

    $("body").on("change","#faturaData input", function (){
        var $this = $(this);
        if($this.is("#tutar, #saat, #toplam"))
        {
            var saat = $this.closest("tr").find("#saat").val();
            var tutar = $this.closest("tr").find("#tutar").val();
            var toplam;
            var genel_tutar;
            if(saat =="" && tutar =="")
            {
                toplam = $this.closest("tr").find("#toplam").val();
                if(toplam == "")
                {
                    genel_tutar = parseFloat($this.closest("tr").find("#toplam").val());
                }
                else {
                    toplam = parseFloat($this.closest("tr").find("#toplam").val());
                }
            }
            else
            {
                toplam = saat*tutar;
            }
                toplam = saat * tutar ;
            toplam = toplam.toFixed(2);
            
            $this.closest("tr").find("#toplam").val(toplam);
        }
        calc();
    });

    function calc() {
        var ara_toplam = 0;
        $("[id=toplam]").each(function () {
           ara_toplam = parseFloat(ara_toplam) + parseFloat($(this).val());          
        });
        $(".ara_toplam").val(ara_toplam.toFixed(2));
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.0/metisMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/js/perfect-scrollbar.jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/3.1.2/jquery.bootstrap-touchspin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.1.7/js/ion.rangeSlider.min.js"></script>
@endsection