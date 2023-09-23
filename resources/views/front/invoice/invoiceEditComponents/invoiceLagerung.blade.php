<div class="form-group row">
    <div class="col-md-12 lagerung-control">
        <label for="" class="col-form-label">Lagerung</label><br>
        <input type="checkbox" name="isLagerung" id="isLagerung" class="js-switch " data-color="#286090" data-switchery="false" @if($lagerung) checked @endif>  
    </div>                            
</div>

<div id="lagerung--area" class="rounded lagerung--area" style="background-color: #C8DFF3; @if($lagerung == NULL) display:none; @endif">
    <div class="row p-3">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Periode von</label>
                    <input class="form-control" class="date"  name="lagerungStartDate"  type="date" @if($lagerung) value="{{ $lagerung['lagerungStartDate'] }}" @endif> 
                </div>
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">bis</label>
                    <input class="form-control" class="date"  name="lagerungEndDate"  type="date" @if($lagerung) value="{{ $lagerung['lagerungEndDate'] }}" @endif> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Volumen  [m3]</label>
                    <input class="form-control" class="date"  name="lagerungVolume"  type="number" min="0" 
                    @if($lagerung) value="{{ $lagerung['lagerungVolume'] }}" @else value="0" @endif> 
                </div>

                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Ansatz  [CHF]</label>
                    <input class="form-control" class="date"  name="lagerungChf"  type="number" min="0" 
                    @if($lagerung) value="{{ $lagerung['lagerungChf'] }}" @else value="0" @endif> 
                </div>
            </div>

            
            <div class="lagerung--extra--cost--area" >
                <div class="form-group">
                    <label class=" col-form-label" for="l0">Weitere Kosten</label>
                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="lagerungExtra1CostText" placeholder="Freier Text"  type="text" 
                            @if ($lagerung && $lagerung['extraValue1']) value="{{ $lagerung['extraText1'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="lagerungExtra1Cost" placeholder="0"  type="text" 
                            @if ($lagerung && $lagerung['extraValue1']) value="{{ $lagerung['extraValue1'] }}" @else value="0.00" @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="lagerungExtra2CostText" placeholder="Freier Text"  type="text" 
                            @if ($lagerung && $lagerung['extraValue2']) value="{{ $lagerung['extraText2'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="lagerungExtra2Cost" placeholder="0"  type="text" 
                            @if ($lagerung && $lagerung['extraValue2']) value="{{ $lagerung['extraValue2'] }}" @else value="0.00" @endif>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <label class="col-form-label" for="l0">Rabatt</label>
            <input class="form-control"  name="lagerungDiscount" placeholder="0"  type="text" @if($lagerung && $lagerung['discount']) value="{{ $lagerung['discount'] }}" @else value="0.00" @endif> 

            <label class="col-form-label" for="l0">Rabatt[%]</label>
            <input class="form-control"  name="lagerungDiscountPercent" placeholder="0"  type="text" @if($lagerung && $lagerung['discountPercent']) value="{{ $lagerung['discountPercent'] }}" @else value="0.00" @endif>

            <label class="col-form-label" for="l0">Entgegenkommen</label>
            <input class="form-control"  name="lagerungDiscount2" placeholder="0"  type="text" @if($lagerung && $lagerung['discount2']) value="{{ $lagerung['discount2'] }}" @else value="0.00" @endif>

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="lagerungExtraDiscountText" placeholder="Freier Text"  type="text"
                    @if($lagerung && $lagerung['extraDiscountValue1']) value="{{ $lagerung['extraDiscountText1'] }}" @endif>
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="lagerungExtraDiscount" placeholder="0"  type="text" 
                    @if($lagerung && $lagerung['extraDiscountValue1']) value="{{ $lagerung['extraDiscountValue1'] }}" @else value="0.00" @endif>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-md-7">
                    <input class="form-control"  name="lagerungExtraDiscountText2" placeholder="Freier Text"  type="text" 
                    @if($lagerung && $lagerung['extraDiscountValue2']) value="{{ $lagerung['extraDiscountText2'] }}" @endif>
                </div>
                <div class="col-md-5">
                    <input class="form-control"  name="lagerungExtraDiscount2" placeholder="0"  type="text"  
                    @if($lagerung && $lagerung['extraDiscountValue2']) value="{{ $lagerung['extraDiscountValue2'] }}" @else value="0.00" @endif>
                </div>
            </div>

            <label class="col-form-label mt-1 " for="l0">Zwischenbetrag</label>
            <input class="form-control" id="lagerungCost"  name="lagerungCost" placeholder="0"  type="text" style="background-color: #286090;color:white;" 
            @if($lagerung && $lagerung['lagerungCost']) value="{{ $lagerung['lagerungCost'] }}" @else value="0.00" @endif> 

            <div class="lagerung-fixed-price mt-1">
                <label for="" class="col-form-label">Pauschal</label><br>
                <input type="checkbox" name="isLagerungFixedPrice" id="isLagerungFixedPrice" class="js-switch " data-color="#286090" data-size="small" data-switchery="false" 
                @if($lagerung && $lagerung['lagerungFixedCost']) checked @endif>  
            </div> 

            <div class="lagerung-fixed-price-area mt-1 mb-1" @if($lagerung && $lagerung['lagerungFixedCost'] == NULL) style="display: none;" @endif>
                <input class="form-control"  name="lagerungFixedPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;" 
                @if($lagerung && $lagerung['lagerungFixedCost']) value="{{ $lagerung['lagerungFixedCost'] }}" @else value="0.00" @endif>
            </div>

            <label class="col-form-label" for="l0">Anzahlung</label>
            <input class="form-control"  name="lagerungPaid1" placeholder="0"  type="text" style="background-color: #286090;color:white;" 
            @if($lagerung && $lagerung['lagerungPaid1']) value="{{ $lagerung['lagerungPaid1'] }}" @else value="0.00" @endif>

            <label class="col-form-label" for="l0">Bar Bezahlt</label>
            <input class="form-control"  name="lagerungPaid2" placeholder="0"  type="text" style="background-color: #286090;color:white;" 
            @if($lagerung && $lagerung['lagerungPaid2']) value="{{ $lagerung['lagerungPaid2'] }}" @else value="0.00" @endif>

            <label class="col-form-label" for="l0">Betrag</label>
            <input class="form-control total-piece"  name="lagerungTotalPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;" 
            @if($lagerung && $lagerung['lagerungTotalPrice']) value="{{ $lagerung['lagerungTotalPrice'] }}" @else value="0.00" @endif>
        </div>
    </div>
</div>
@section('invoiceEditFooterLagerung')
<script>
    function isRequiredLagerung()
    {
        $("input[name=lagerungStartDate]").prop('required',true);      
        $("input[name=lagerungEndDate]").prop('required',true);   
        $("input[name=lagerungVolume]").prop('required',true); 
        $("input[name=lagerungChf]").prop('required',true); 
    }

    function isNotRequiredLagerung()
    {
        $("input[name=lagerungStartDate]").prop('required',false);      
        $("input[name=lagerungEndDate]").prop('required',false);   
        $("input[name=lagerungVolume]").prop('required',false); 
        $("input[name=lagerungChf]").prop('required',false); 
    }

    $("body").on("change",".lagerung--area",function (){
        isRequiredLagerung();
    })
    var morebutton9 = $("div.lagerung-control");
    morebutton9.click(function() {
        if ($(this).hasClass("checkbox-checked")) {
            $(".lagerung--area").show(700);
            isRequiredLagerung();
        } else {
            $(".lagerung--area").hide(500);
            isNotRequiredLagerung()
        }
    })

    $(document).ready(function() {
        if($("div.lagerung--area").is(":visible"))
        {
            isRequiredLagerung()
        }
    })

    var isLagerungFixedbutton = $("div.lagerung-fixed-price");
    isLagerungFixedbutton.click(function(){
    if($(this).hasClass("checkbox-checked"))
    {
        $(".lagerung-fixed-price-area").show(700);
    }
    else{
        $(".lagerung-fixed-price-area").hide(500);
    }
    })

    $("body").on("change",".lagerung--area", function() {
        let lagerungVolume = parseInt($("input[name=lagerungVolume]").val()) || 0;
        let lagerungChf = parseInt($("input[name=lagerungChf]").val()) || 0;

        let lagerungCost = 0;
        let lagerungTotalPrice = 0;

        let lagerungExtra1Cost = parseFloat($('input[name=lagerungExtra1Cost]').val()) || 0;               
        let lagerungExtra2Cost = parseFloat($('input[name=lagerungExtra2Cost]').val()) || 0; 

        let lagerungDiscount = parseFloat($('input[name=lagerungDiscount]').val()) || 0;
        let lagerungDiscountPercent = parseFloat($('input[name=lagerungDiscountPercent]').val()) || 0;
        let lagerungDiscount2 = parseFloat($('input[name=lagerungDiscount2]').val()) || 0;
        let lagerungExtraDiscount = parseFloat($('input[name=lagerungExtraDiscount]').val()) || 0;
        let lagerungExtraDiscount2 = parseFloat($('input[name=lagerungExtraDiscount2]').val()) || 0;

        lagerungTotalPrice = parseFloat($('input[name=lagerungTotalPrice]').val()) || 0;

        let lagerungPaid1 = parseFloat($('input[name=lagerungPaid1]').val()) || 0;
        let lagerungPaid2 = parseFloat($('input[name=lagerungPaid2]').val()) || 0;

        let minusPercent = (lagerungVolume*lagerungChf) + lagerungExtra1Cost + 
        lagerungExtra2Cost;
        lagerungCost = (lagerungVolume*lagerungChf) + lagerungExtra1Cost + 
        lagerungExtra2Cost - lagerungDiscount - lagerungDiscount2 - lagerungExtraDiscount - lagerungExtraDiscount2 - (minusPercent*lagerungDiscountPercent/100);
        lagerungCost = parseFloat(lagerungCost);
        lagerungCost = lagerungCost.toFixed(2);
        
        $("input[name=lagerungCost]").val(lagerungCost);

        if ($('input[name=isLagerungFixedPrice]').is(":checked")){
            let lagerungFixedCalc = parseFloat($('input[name=lagerungFixedPrice]').val());
            lagerungTotalPrice = lagerungFixedCalc - lagerungPaid1 - lagerungPaid2;
            $("input[name=lagerungTotalPrice]").val(lagerungTotalPrice.toFixed(2));
        }
        else {
            lagerungTotalPrice = lagerungCost - lagerungPaid1 - lagerungPaid2;
            $("input[name=lagerungTotalPrice]").val(lagerungTotalPrice.toFixed(2));
        }
    })
   
</script>
@endsection