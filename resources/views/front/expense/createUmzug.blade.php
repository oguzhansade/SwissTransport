@extends('layouts.app')
@section('content')
@section('sidebarType') sidebar-collapse @endsection
<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5"> Neue Ausgabe hinzufügen</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Panel</a>
            </li>
            <li class="breadcrumb-item active">Ausgabe</li>
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
        <div class="col-md-12 widget-holder islem_field">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <form action="{{ route('expense.storeUmzug',['id' => $data['id']]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row p-3 mb-3">

                            
                        </div>
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
                                <input class="form-control ara_toplam" name="totalExpense" type="text" value="0">
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="form-group row">
                                <div class="col-md-12 ml-md-auto btn-list">
                                    <button class="btn btn-primary btn-rounded" type="submit" onclick="">Erstellen</button>
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
   
    var say= 0;
    var i = $(".islem_field").lenght || 0;
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
    $("#addRowBtn").click(function () {
        
        var newRow = 
        '<tr class="islem_field">' +
        '<td><select class="m-b-10 form-control expense" name="islem['+i+'][expense]" data-toggle="select2">'+
        '<option class="form-control" value="0"> Bitte Wahlen </option>';
        giderler.forEach(function(gider, index) {
            newRow += '<option class="form-control" data-fiyat="" data-name="" value="' + gider + '">' + gider + '</option>';  
        });
        //value="' + defaultHour + '"
        newRow+='</select></td>'+
        '<td><input type="text" class="form-control expenseValue" id="tutar" name="islem['+i+'][expenseValue]" value="0" ></td>'+
        '<td><button id="removeButton" type="button" class="btn btn-danger" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">X</button></td>'+
        '</tr>'
        
        $("#faturaData").append(newRow);
        
        i++;
        say++; 
    });

    $("form").submit(function(event) {
        let checkMaterial = expenseValidation();
        
        
        if (!checkMaterial) {
            console.log('Material Validasyon False')
            return false;
        }
        
    })

    function expenseValidation() {
       
        let isValid = false;
    
        $('.islem_field').each(function(index) {
            let expenseName = $(this).closest('.islem_field').find('.expense').find(
                ":selected").val();
            let expensePrice = $(this).closest('.islem_field').find('.expenseValue').val();
            if (!expenseName || expenseName == 0) {
                $(this).closest('.islem_field').find('.expense').focus().css(
                    'border-color', 'red')
                toastr.error('Sparname fehlt', 'Fehler!');
                isValid = false;
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
            toastr.error('Sie haben keine Ausgaben hinzugefügt', 'Fehler!');
            isValid = false;
            console.log(isValid, 'Urun Sayısı')
            return false; // işlemi durdur
        }
        
        return isValid;
    }


    $("body").on("change",".islem_field", function (){
       
        let tutar = $(this).closest(".islem_field").find("#tutar").val() || 0;
        tutar = parseFloat(tutar)
        $(this).closest(".islem_field").find("#tutar").val(tutar.toFixed(2));
        calc()
    })

    $("body").on("click","#removeButton", function () {
        say = say-1;
        $(".isciadet").html(say+' '+'Anzahl der Arbeiter');
        $(this).closest(".islem_field").remove();
        console.log(say,'Silerken')
        calc();
    })

    $("body").on("click","#removeAllButton", function () {
        say = 0;
        $(".isciadet").html(say+' '+'Anzahl der Arbeiter');
        
        $("[id=tutar]").each(function () {
            $(this).closest(".islem_field").remove();
        });
        
        calc();
    })

    

    function calc() {
        var ara_toplam = 0;
        $("[id=tutar]").each(function () {
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