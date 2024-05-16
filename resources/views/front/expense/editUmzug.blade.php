@extends('layouts.app')
@section('header')

<style>
    select[readonly]
{
    pointer-events: none;
}
</style>
@endsection
@section('content')
@section('sidebarType') sidebar-collapse @endsection
<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Spesen Bearbeiten</h6>
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

<div class="widget-list">
    <div class="row">
        <div class="col-md-12 widget-holder task-area">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <form action="{{ route('expense.updateUmzug',['id' => $data['id']]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row p-3">
                            <div class="col-md-12">
                                <div class="table-reponsive">
                                    <table id="faturaData" class="table">
                                        <thead class="text-dark">
                                            <tr>
                                                <th>Spesenname</th>
                                                <th>Kostenpreis</th>
                                                <th>Löschen</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($data && $expense)


                                            {{-- Kaç Ürün Varsa O kadar Tekrarlanacak --}}
                                            @foreach ($expense as $a => $b)
                                                <tr class="islem_field" >
                                                    <td><select class="form-control expense "  name="islem[{{ $a }}][expense]" @if($b['expenseName'] == 'Arbeiter') readonly @endif>
                                                    <option class="form-control" value="0"> Bitte wählen </option>
                                                    @foreach ($expenseList as $key => $value)
                                                            <option class="form-control" value="{{ $value }}" @if($b['expenseName'] == $value) selected @endif >{{ $value }}</option>
                                                    @endforeach
                                                    </select></td>
                                                    <td><input type="text" class="form-control expenseValue" id="tutar" name="islem[{{ $a }}][expenseValue]" value="{{ $b['expenseValue'] }}" @if($b['expenseName'] == 'Arbeiter') readonly @endif></td>
                                                    <td>
                                                        @if($b['expenseName'] == 'Arbeiter')
                                                        <a class="btn btn-edit" href="{{ route('task.edit',['id'=>$task['id']]) }}" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;"><i class="feather feather-edit"></i></a>
                                                        @else
                                                        <button id="removeButton" type="button" class="btn btn-danger" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">X</button>
                                                        @endif

                                                    </td>
                                                </tr>
                                            @endforeach


                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row p-3">
                            <div class="col-md-12 d-flex justify-content-center">
                                <button type="button" id="addRowBtn" class="box-shadow btn-rounded btn btn-primary " style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;"> <i class="feather feather-plus "></i> Aufgaben hinzufügen</button>
                                <button type="button" id="removeAllButton" class="btn-rounded btn btn-danger ml-1" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">Alles löschen</button>
                            </div>
                        </div>

                        <div class="row p-3">
                            <div class="col-md-6">
                                <label class="col-form-label" for="l0">Total</label>
                                <input id="totalExpense" class="form-control ara_toplam" name="totalExpense" type="text" value="{{ $data['expensePrice'] }}">
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="form-group row">
                                <div class="col-md-12 ml-md-auto btn-list">
                                    <button id="erstellenButton" class="btn btn-primary btn-rounded" type="submit">Erstellen</button>
                                </div>
                                <div class="col-md-12 ml-md-auto btn-list">
                                    <button id="allesLoeschenButton" class="btn btn-danger btn-rounded" type="submit">Alles Löschen</button>
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
    let deleteAllAction = 0;
    $(document).ready(function(){


        // Erstellen button click event
        $('#erstellenButton').on('click', function() {
            // Set the form action to the updateUmzug route
            $('form').attr('action', '{{ route("expense.updateUmzug", ["id" => $data["id"]]) }}');
        });

        // Alles Löschen button click event
        $('#allesLoeschenButton').on('click', function() {
            // Set the form action to the deleteUmzug route
            removeAll()
            deleteAllAction = 1;
            $('form').attr('action', '{{ route("expense.deleteUmzug", ["id" => $data["id"]]) }}');
        });

        calc();
        let totalExpense = $("#totalExpense").val();
        console.log($("#arbeiterPrice").val(), 'İşçi Ücreti')
        console.log(deleteAllAction,'Hepsini Sill Aksiyonu')

    })
    var i = $(".islem_field").length || 0;

    console.log(i);
    let giderler = [
    'Möbellift Miete',
    'Lieferwagen Miete',
    'Schutzmaterial',
    'Schaden',
    'Busse',
    'Entgegenkommen',
    'Arbeiter',
    'Diesel',
    'Other'
    ];
    $('#deleteAll').click(function() {
        $('input[name=totalExpense]').val('');
    })
    $("#addRowBtn").click(function () {
        var newRow =
        '<tr class="islem_field">' +
        '<td><select class="m-b-10 form-control expense" name="islem['+i+'][expense]" data-toggle="select2">'+
        '<option class="form-control" value="0"> Bitte Wahlen </option>';
        giderler.forEach(function(gider, index) {
            if (gider !== "Arbeiter") {
                newRow += '<option class="form-control" data-fiyat="" data-name="" value="' + gider + '">' + gider + '</option>';
            }
        });
        //value="' + defaultHour + '"
        newRow+='</select></td>'+
        '<td><input type="text" class="form-control expenseValue" id="tutar" name="islem['+i+'][expenseValue]" value="0" ></td>'+
        '<td><button id="removeButton" type="button" class="btn btn-danger" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">X</button></td>'+
        '</tr>'

        $("#faturaData").append(newRow);

        i++;
    });

    $("form").submit(function(event) {
        let checkMaterial = expenseValidation();

        if (!checkMaterial) {
            console.log('Material Validasyon False')
            return false;
        }

    })

    function expenseValidation() {

       let isValid = true;
       $("body").on("change",".islem_field", function (){

    })
    $('.islem_field').each(function(index) {
        let expenseName = $(this).closest('.islem_field').find('.expense').find(":selected").val();
        let expensePrice = $(this).closest('.islem_field').find('.expenseValue').val();
        if (!expenseName || expenseName == 0) {
            $(this).closest('.islem_field').find('.expense').focus().css(
                'border-color', 'red')
            toastr.error('Sparname fehlt', 'Fehler!');
            isValid = false;

            console.log(index,'İndex')
            return false;

        } else {
            $(this).closest('.islem_field').find('.expense').css('border-color',
            ''); // önceki uyarı mesajını kaldır
            isValid = true;
        }
        if (!expensePrice || expensePrice == 0) {
            $(this).closest('.islem_field').find('.expenseValue').focus().css(
                'border-color', 'red')
            toastr.error('Preis für Ausgaben fehlt', 'Fehler!');
            isValid = false;
            return false;

        } else {
            $(this).closest('.islem_field').find('.expenseValue').css('border-color',
            ''); // önceki uyarı mesajını kaldır
            isValid = true;
        }
    });

        if ($('.expense').length === 0) { // ürün yoksa
            if(deleteAllAction === 0)
            {
                toastr.error('Sie haben keine Ausgaben hinzugefügt', 'Fehler!');
                isValid = false;
                console.log(isValid, 'Urun Sayısı')
                return false; // işlemi durdur
            }
        }

       return isValid;
   }

    $("body").on("change",".islem_field", function (){
        let tutar = $(this).closest(".islem_field").find("#tutar").val() || 0;
        tutar = parseFloat(tutar)
        $(this).closest(".islem_field").find("#tutar").val(tutar.toFixed(2));
        calc()
        console.log(i,'Sayaç')
    })

    $("body").on("click","#removeButton", function () {
        $(this).closest(".islem_field").remove();
        calc();
    })
    function removeAll()
    {
        let expenseNameToRemove = "Arbeiter";

        $("[id=tutar]").each(function () {
            let expenseName = $(this).closest('.islem_field').find('.expense').find(":selected").val();

            if (expenseName !== expenseNameToRemove) {
                $(this).closest(".islem_field").remove();
            }
        });

        calc();
    }
    $("body").on("click", "#removeAllButton", function () {
        removeAll()
    });



    function calc() {
        var ara_toplam = 0;
        var arbeiterValue = 0;
        $("[id=tutar]").each(function () {
           ara_toplam = parseFloat(ara_toplam) + parseFloat($(this).val());
        });
        arbeiterValue = parseFloat($("#arbeiterPrice").val());
        // ara_toplam += arbeiterValue;
        $(".ara_toplam").val(ara_toplam.toFixed(2));
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.0/metisMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/js/perfect-scrollbar.jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/3.1.2/jquery.bootstrap-touchspin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.1.7/js/ion.rangeSlider.min.js"></script>
@endsection
