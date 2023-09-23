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
        <input type="checkbox" name="isVerpackungsmaterial" id="isVerpackungsmaterial" class="js-switch " data-color="#286090" data-switchery="false"
        @if($material) checked @endif>  
    </div>                            
</div>

<div class="rounded verpackungsmaterial--area" style="background-color: #C8DFF3;  @if($material == NULL) display:none; @endif">
    <div class="row p-3 islem_field">
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
                    <tbody>
                        @if($material)
                        {{-- Kaç Ürün Varsa O kadar Tekrarlanacak --}}
                        @foreach ($basket as $a => $b)
                        <tr class="islem_field">
                            <td><select class="form-control urun"  name="islem[{{ $a }}][urunId]">
                            <option class="form-control" value="0"> Bitte wählen </option>
                            @foreach (\App\Models\Product::all() as $key => $value)
                                <option class="form-control" data-id="{{ $value['id'] }}" data-kirala="{{ $value['rentPrice'] }}" data-fiyat ="{{ $value['buyPrice']  }}"  data-urunadi="{{ $value['productName'] }}" value="{{ $value['id'] }}"
                                @if($b['productId'] == $value['id']) selected @endif>{{ $value['productName'] }}</option>  
                            @endforeach
                    
                            </select></td>
                            <td><select class="form-control buyType"  name="islem[{{ $a }}][buyType]">
                            <option class="form-control" data-buy="0" value="0" @if($b['buyType'] == 0) selected @endif>Bitte wählen</option>
                            <option class="form-control" data-buy="1" value="1" @if($b['buyType'] == 1) selected @endif>Kaufen</option>
                            <option class="form-control" data-buy="2" value="2" @if($b['buyType'] == 2) selected @endif>Mieten</option>
                            </select></td>
                            <td><input type="text" class="form-control" id="tutar" name="islem[{{ $a }}][tutar]" 
                                @if($b['buyType'] == 1) value="{{ App\Models\Product::buyPrice($b['productId']) }}" 
                                    @elseif ($b['buyType'] == 2)  value="{{ App\Models\Product::rentPrice($b['productId']) }}" 
                                @endif></td>
                            
                            <td><input type="text" class="form-control" id="adet" name="islem[{{ $a }}][adet]" value="{{ $b['quantity'] }}"></td>
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
    <div class="row  d-flex justify-content-center align-items-center text-center">
        <div class="col-md-12">
            <span id="urun_adet"  class="h5 urun_adet">Sie haben noch keine Produkte hinzugefügt</span>
        </div>
    </div>
    <div class="row p-3">
        <div class="col-md-12 d-flex justify-content-center">
            <button type="button" id="addRowBtn" class="box-shadow btn-rounded btn btn-primary " style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;"> <i class="feather feather-plus "></i> Hinzufügen</button>
            <button type="button" id="removeAllButton" class="btn-rounded btn btn-danger ml-1" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">Alles löschen</button>
        </div>
    </div>
    <div id="faturaData">
        <div class="row p-3">
            <div class="col-md-6">
                <label class="col-form-label" for="l0">Reduktion</label>
                <input class="form-control indirim" name="materialDiscount" type="number" 
                @if($material && $material['discount']) value="{{ $material['discount'] }}" @else value="0.00" @endif min="0">
            </div>

            <div class="col-md-6">
                <label class="col-form-label" for="l0">Reduktion[%]</label>
                <input class="form-control indirimYuzde" name="materialDiscountPercent" type="number" 
                @if($material && $material['discountPercent']) value="{{ $material['discountPercent'] }}" @else value="0.00" @endif min="0">
            </div>
        </div>

        <div class="row p-3">
            <div class="col-md-3">
                <label class="col-form-label" for="l0">Weitere Abzüge</label>
                <input class="form-control customIndirimText" name="materialExtraDiscount" placeholder="Freier Text " type="text" 
                @if($material && $material['customDiscountValue']) value="{{ $material['customDiscountText'] }}" @endif>
            </div>
            <div class="col-md-3">
                <label class="col-form-label" for="l0">Weitere Abzüge</label>
                <input class="form-control customIndirimValue" name="materialExtraDiscountValue" type="number" 
                @if($material && $material['customDiscountValue']) value="{{ $material['customDiscountValue'] }}" @else value="0.00" @endif min="0">
            </div>
        </div>
        
        <div class="row p-3">
            <div class="col-md-6">
                <label class="col-form-label" for="l0">Lieferung</label>
                <input class="form-control teslimat_ucreti" name="materialShipPrice" type="number" 
                @if($material && $material['deliverPrice']) value="{{ $material['deliverPrice'] }}" @else value="0.00" @endif min="0">
            </div>
        </div>

        <div class="row p-3">
            <div class="col-md-6">
                <label class="col-form-label" for="l0">Abholung</label>
                <input class="form-control toplama_ucreti" name="materialRecievePrice" type="number" 
                @if($material && $material['recievePrice']) value="{{ $material['recievePrice'] }}" @else value="0.00" @endif min="0">
            </div>
        </div>
    </div>
    <div class="row p-3">
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Betrag</label>
            <input class="form-control ara_toplam total-piece" name="materialTotalPrice" type="text" 
            @if($material && $material['totalPrice']) value="{{ $material['totalPrice'] }}" @else value="0" @endif>
        </div>
    </div>
</div>



@section('invoiceOfferMaterial')
<script>
    let say = 0;
    
    @if ($material && $material['id'])
        say = {{ App\Models\InvoiceBasket::getBasket($material['id'])->count()}}
    @endif
    
    var morebutton10 = $("div.verpackungsmaterial-control");
    morebutton10.click(function() {
            if ($(this).hasClass("checkbox-checked")) {
                $(".verpackungsmaterial--area").show(700);
            } else {
                $(".verpackungsmaterial--area").hide(500);
            }
        })

    
    var i = $(".islem_field").lenght;
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
            newRow+= '<option class="form-control" data-id="{{ $value['id'] }} data-kirala="{{ $value['rentPrice'] }}" data-fiyat ="{{ $value['buyPrice']  }}" data-urunadi="{{ $value['productName'] }}"  value="{{ $value['id'] }}">{{ $value['productName'] }}</option>';  
        @endforeach

        newRow+='</select></td>'+
        '<td><select class="form-control buyType"  name="islem['+i+'][buyType]">'+
        '<option class="form-control" data-buy="0" value="0" >Bitte wählen</option>'+  
        '<option class="form-control" data-buy="1" value="1">Kaufen</option>'+
        '<option class="form-control" data-buy="2" value="2">Mieten</option>'+
        '</select></td>'+
        '<td><input type="text" class="form-control" id="tutar" name="islem[