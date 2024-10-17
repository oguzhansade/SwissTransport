@section('header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" rel="stylesheet" type="text/css">
<style>
#removeButton {
    box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
}
</style>
@endsection

<div class="row p-3">
    <div id="alert-container" class="col-md-12">

    </div>
    <div class="col-md-12">
        <div class="table-reponsive">
            <table id="faturaData" class="table">
                <thead>
                    <tr class="text-dark">
                        <th>Produktname</th>
                        <th>Mieten/Kaufen</th>
                        <th>Preis</th>
                        <th>Anzahl</th>
                        <th>Total</th>
                        <th>Löschen</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div class="row  d-flex justify-content-center align-items-center text-center">
    <div class="col-md-12">
        <span id="urun_adet"  class="h5 urun_adet">Sie haben noch keine Produkte hinzugefügt</span>
    </div>
</div>
<div class="row p-3">
    <div class="col-md-12 d-flex justify-content-center">
        <button type="button"  id="addRowBtn" class="box-shadow btn-rounded btn btn-primary " style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;"> <i class="feather feather-plus "></i>Hinzufügen</button>
        <button type="button" id="removeAllButton" class="btn-rounded btn btn-danger ml-1" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">Alles löschen</button>
    </div>
</div>
<div id="faturaData">

    <div class="row p-3">
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Reduktion </label>
            <input class="form-control indirim" name="materialDiscount" type="number" value="0" min="0">
        </div>
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Reduktion[%]</label>
            <input class="form-control indirim_yuzde" name="materialDiscountPercent" type="number" value="0" min="0">
        </div>
    </div>

    <div class="row p-3">
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Lieferung</label>
            <input class="form-control teslimat_ucreti" name="materialShipPrice" type="number" value="40" min="0">
        </div>
    </div>

    <div class="row p-3">
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Abholung</label>
            <input class="form-control toplama_ucreti" name="materialRecievePrice" type="number" value="40" min="0">
        </div>
    </div>
</div>


<div class="row p-3">
    <div class="col-md-6">
        <label class="col-form-label" for="l0">Total</label>
        <input class="form-control ara_toplam" name="materialTotalPrice" type="text" value="0">
    </div>
</div>

@section('offerMaterialCreate')
<script>

    let say= 0;
    var i = $(".islem_field").lenght || 0;
    $("#addRowBtn").click(function () {
        var topitop = 0;
        $("[id=toplam]").each(function () {
           topitop++;

        });
        let adet = say+1;
        $(".urun_adet").html(adet+' '+'Stück Produkte');
        console.log(topitop+1,'ADET')


        var newRow =
        '<tr class="islem_field">' +
        '<td><select class="form-control urun"  name="islem['+i+'][urunId]">'+
        '<option class="form-control" value="0"> Bitte wählen </option>';
        @foreach (\App\Models\Product::all() as $key => $value)
            newRow+= '<option class="form-control" data-id="{{ $value['id'] }}" data-kirala="{{ $value['rentPrice'] }}" data-fiyat ="{{ $value['buyPrice']  }}" data-urunadi="{{ $value['productName'] }}"  value="{{ $value['id'] }}">{{ $value['productName'] }}</option>';
        @endforeach
        newRow+='</select></td>'+
        '<td><select class="form-control buyType"  name="islem['+i+'][buyType]">'+
        '<option class="form-control" data-buy="0" value="0" >Bitte wählen</option>'+
        '<option class="form-control" data-buy="1" value="1">Kaufen</option>'+
        '<option class="form-control" data-buy="2" value="2">Mieten</option>'+
        '</select></td>'+
        '<td><input type="text" class="form-control" id="tutar" name="islem['+i+'][tutar]" value="0" ></td>'+

        '<td><input type="text" class="form-control" id="adet" name="islem['+i+'][adet]" value="1"></td>'+
        '<td><input type="text" class="form-control" id="toplam" name="islem['+i+'][toplam]" value="0"></td>'+
        '<td><button id="removeButton" type="button" class="btn btn-danger" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">X</button></td>'+
        '</tr>'

        $(newRow).appendTo("#faturaData").find(".urun, .buyType").prop("required", true);

        i++;
        say++;
    });


    $("body").on("change",".islem_field", function (){

        let fiyat = $(this).find('.urun').find(":selected").data("fiyat")
        let kirala = $(this).find('.urun').find(":selected").data("kirala")
        let urunIsmi = $(this).find('.urun').find(":selected").data("urunadi")
        let   adet = $(this).closest(".islem_field").find("#adet").val();
        const buyType = $(this).find('.buyType').find(":selected").data("buy")
        let tutar = $(this).closest(".islem_field").find("#tutar").val() || 0;
        let customTutar = $(this).closest(".islem_field").find("#tutar").val();

        console.log(urunIsmi,fiyat, kirala, buyType, 'fkb')


        $(".buyType").on("change", function() {
            const $buyType = $(this);
            const buyType = $buyType.find(":selected").data("buy");
            const $islemField = $buyType.closest(".islem_field");
            const fiyat = $islemField.find(".urun").find(":selected").data("fiyat");
            const kirala = $islemField.find(".urun").find(":selected").data("kirala");
            let tutar = $islemField.find("#tutar").val()


            switch (buyType) {
                case 0:
                tutar = 0;
                break;
                case 1:
                tutar = fiyat;
                break;
                case 2:
                tutar = kirala;
                break;
            }

            const adet = parseFloat($islemField.find("#adet").val());
            $islemField.find("#tutar").val(tutar.toFixed(2));
            $islemField.find("#toplam").val((tutar * adet).toFixed(2));
            console.log(buyType,'BuyTypeDeğişti')
            calc()
        })


        tutar = parseFloat(tutar)
        adet = parseFloat(adet)
        $(this).closest(".islem_field").find("#tutar").val(tutar.toFixed(2));
        $(this).closest(".islem_field").find("#toplam").val((tutar * adet).toFixed(2));

        calc()
    })

    $("body").on("click","#removeButton", function () {

        say = say-1;
        $(".urun_adet").html(say+' '+'Stück Produkte');
        $(this).closest(".islem_field").remove();
        console.log(say,'Silerken')
        calc();
    })

    $("body").on("click","#removeAllButton", function () {

        say = 0;
        $(".urun_adet").html('Sie haben noch keine Produkte hinzugefügt');

        $("[id=toplam]").each(function () {
            $(this).closest(".islem_field").remove();
        });

        calc();
    })

    $("body").on("change","#faturaData input", function (){

        var $this = $(this);
        if($this.is("#tutar, #adet, #toplam"))
        {
            var adet = $this.closest("tr").find("#adet").val();
            var tutar = $this.closest("tr").find("#tutar").val();
            var toplam;
            var genel_tutar;
            var indirim;
            var teslimalma_ucreti;
            var teslimat_ucreti ;

            if(adet =="" && tutar =="")
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
                toplam = adet*tutar;
            }
                toplam = adet * tutar ;
            toplam = toplam.toFixed(2);

            $this.closest("tr").find("#toplam").val(toplam);




        }
        calc();
    });

    function calc() {
        var ara_toplam = 0;
        var indirim = parseFloat($("input[name=materialDiscount]").val());
        var indirimyuzde = parseFloat($(".indirim_yuzde").val());
        var teslimat_ucreti = parseFloat($(".teslimat_ucreti").val());
        var teslimalma_ucreti = parseFloat($(".toplama_ucreti").val());

        $("[id=toplam]").each(function () {
           ara_toplam = parseFloat(ara_toplam) + parseFloat($(this).val());
        });
        ara_toplam = ara_toplam+teslimat_ucreti+teslimalma_ucreti - indirim - (ara_toplam*indirimyuzde/100)
        $(".ara_toplam").val(ara_toplam.toFixed(2));
    }
</script>

@endsection
