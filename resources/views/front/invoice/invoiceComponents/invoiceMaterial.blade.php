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

<div class="form-group row">
    <div class="col-md-12 verpackungsmaterial-control">
        <label for="" class="col-form-label">Verpackungsmaterial</label><br>
        <input type="checkbox" name="isVerpackungsmaterial" id="isVerpackungsmaterial" class="js-switch " data-color="#9c27b0" data-switchery="false">  
    </div>                            
</div>

<div class="rounded verpackungsmaterial--area" style="background-color: #CBB4FF;  display:none;">
    <div class="row p-3">
        <div class="col-md-12">
            <div class="table-reponsive">
                <table id="faturaData" class="table">
                    <thead>
                        <tr class="text-dark" style="display: none;">
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
            <button type="button" id="addRowBtn" class="box-shadow btn-rounded btn btn-primary " style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;"> <i class="feather feather-plus "></i>Hinzufügen</button>
            <button type="button" id="removeAllButton" class="btn-rounded btn btn-danger ml-1" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">Alles löschen</button>
        </div>
    </div>
    <div id="faturaData">
        <div class="row p-3">
            <div class="col-md-6">
                <label class="col-form-label" for="l0">Reduktion</label>
                <input class="form-control indirim" name="materialDiscount" type="number" value="0" min="0">
            </div>

            <div class="col-md-6">
                <label class="col-form-label" for="l0">Reduktion[%]</label>
                <input class="form-control indirimYuzde" name="materialDiscountPercent" type="number" value="0.00"  min="0">
            </div>
        </div>

        <div class="row p-3">
            <div class="col-md-3">
                <label class="col-form-label" for="l0">Weitere Abzüge</label>
                <input class="form-control customIndirimText" name="materialExtraDiscount" placeholder="Freier Text" type="text" >
            </div>
            <div class="col-md-3">
                <label class="col-form-label" for="l0">Weitere Abzüge</label>
                <input class="form-control customIndirimValue" name="materialExtraDiscountValue" type="number" value="0" min="0">
            </div>
        </div>
        
        <div class="row p-3">
            <div class="col-md-6">
                <label class="col-form-label" for="l0">Lieferung</label>
                <input class="form-control teslimat_ucreti" name="materialShipPrice" type="number" value="0" min="0">
            </div>
        </div>

        <div class="row p-3">
            <div class="col-md-6">
                <label class="col-form-label" for="l0">Abholung</label>
                <input class="form-control toplama_ucreti" name="materialRecievePrice" type="number" value="0" min="0">
            </div>
        </div>
    </div>
    <div class="row p-3">
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Betrag</label>
            <input class="form-control ara_toplam total-piece" name="materialTotalPrice" type="text" value="0">
        </div>
    </div>
</div>



@section('invoiceMaterial')
<script>

    var morebutton10 = $("div.verpackungsmaterial-control");
    morebutton10.click(function() {
            if ($(this).hasClass("checkbox-checked")) {
                $(".verpackungsmaterial--area").show(700);
            } else {
                $(".verpackungsmaterial--area").hide(500);
            }
        })

    var say= 0;
    var i = $(".islem_field").lenght || 0;
    $("#addRowBtn").click(function () {
        
        var topitop = 0;
        $("[id=toplam]").each(function () {
           topitop++; 
                         
        });
        
        $(".urun_adet").html(say+1+' '+'Stück Produkte');
        console.log(topitop+1,'ADET')
        var newRow = 
        '<tr class="islem_field">' +
        '<td><select class="form-control urun"  name="islem['+i+'][urunId]">'+
        '<option class="form-control" value="0"> Bitte wählen </option>';
        @foreach (\App\Models\Product::all() as $key => $value)
            newRow+= '<option class="form-control" data-kirala="{{ $value['rentPrice'] }}" data-fiyat ="{{ $value['buyPrice']  }}" data-urunadi="{{ $value['productName'] }}"  value="{{ $value['id'] }}">{{ $value['productName'] }}</option>';  
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
        
        $("#faturaData").append(newRow);
        
        i++;
        say++; 
    });


    $("body").on("change",".islem_field", function (){


        let fiyat = $(this).find('.urun').find(":selected").data("fiyat")
        let kirala = $(this).find('.urun').find(":selected").data("kirala")
        let   adet = $(this).closest(".islem_field").find("#adet").val();
        const buyType = $(this).find('.buyType').find(":selected").data("buy")
        let tutar = $(this).closest(".islem_field").find("#tutar").val() || 0;


        console.log(fiyat, kirala, buyType, 'fkb')

        switch(buyType) {
            case 1:
                tutar = fiyat;
                break;
            case 2:
                tutar = kirala
                break;
        }

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
            var ekstra;
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
        var indirim = parseFloat($(".indirim").val());
        var indirimYuzde = parseFloat($(".indirimYuzde").val());
        var ekstraIndirim = parseFloat($(".customIndirimValue").val())
        var teslimat_ucreti = parseFloat($(".teslimat_ucreti").val());
        var teslimalma_ucreti = parseFloat($(".toplama_ucreti").val());
        
        $("[id=toplam]").each(function () {
           ara_toplam = parseFloat(ara_toplam) + parseFloat($(this).val());          
        });
        ara_toplam = ara_toplam+teslimat_ucreti+teslimalma_ucreti - indirim - (ara_toplam*indirimYuzde/100) - ekstraIndirim
        $(".ara_toplam").val(ara_toplam.toFixed(2));
    }
</script>

@endsection