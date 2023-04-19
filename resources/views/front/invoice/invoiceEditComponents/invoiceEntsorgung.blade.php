<div class="form-group row">
    <div class="col-md-12 entsorgung-control">
        <label for="" class="col-form-label">Entsorgung</label><br>
        <input type="checkbox" name="isEntsorgung" id="isEntsorgung" class="js-switch " data-color="#9c27b0" data-switchery="false" @if($entsorgung) checked @endif>  
    </div>                            
</div>

<div class="rounded entsorgung--area" style="background-color: #CBB4FF; @if($entsorgung == NULL) display:none; @endif">
    <div class="row p-3">
        <div class="col-md-6">
            <label class=" col-form-label" for="l0">Datum</label>
            <input class="form-control" class="date"  name="entsorgungDate"  type="date" @if($entsorgung) value="{{ $entsorgung['entsorgungDate'] }}" @endif> 

            <div class="row mt-1 p-2 rounded" style="background-color:#8778aa;">
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Volumen  [m3] </label>
                    <input class="form-control" class="time"  name="entsorgungVolume"  type="number" 
                    @if($entsorgung) value="{{ $entsorgung['entsorgungVolume'] }}" @else value="0" @endif> 
                </div>
    
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Ansatz  [CHF]</label>
                    <input class="form-control" class="date"  name="entsorgungFixedChf"  type="number" 
                    @if($entsorgung) value="{{ $entsorgung['entsorgungFixedChf'] }}" @else value="0" @endif> 
                </div>

                <div class="col-md-12">
                    <label class=" col-form-label" for="l0">Entsorgungsaufwand Pauschal </label>
                    <input class="form-control" class="time"  name="entsorgungFixedChfCost"  type="number" 
                    @if($entsorgung) value="{{ $entsorgung['entsorgungFixedChfCost'] }}" @else value="0" @endif> 
                </div>
            </div>

            <div class="row mt-1 p-2 rounded" style="background-color:#8778aa;">
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Anzahl Std </label>
                    <input class="form-control" class="time"  name="entsorgungHours"  type="number" 
                    @if($entsorgung) value="{{ $entsorgung['entsorgungHours'] }}" @else value="0" @endif> 
                </div>
    
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Ansatz  [CHF]</label>
                    <input class="form-control" class="date"  name="entsorgungChf"  type="number" 
                    @if($entsorgung) value="{{ $entsorgung['entsorgungChf'] }}" @else value="0" @endif> 
                </div>

                <div class="col-md-12">
                    <label class=" col-form-label" for="l0">Anfahrt/Rückfahrt [CHF]</label>
                    <input class="form-control" class="date"  name="entsorgungRoadChf"  type="number" 
                    @if($entsorgung) value="{{ $entsorgung['entsorgungRoadChf'] }}" @else value="0" @endif>  
                </div>
            </div>

           

            <div class="entsorgung-extra-cost mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="isEntsorgungExtra" id="isEntsorgungExtra" class="js-switch " data-color="#9c27b0" data-switchery="false" 
                @if($entsorgung
                && $entsorgung['extra1'] == NULL
                && $entsorgung['extraValue1'] == NULL
                && $entsorgung['extraValue2'] == NULL
                ) 
                unchecked
                @else checked
                @endif>  
            </div>  

            <div class="entsorgung-extra-cost-area" 
            @if($entsorgung
            && $entsorgung['extra1'] == NULL
            && $entsorgung['extraValue1'] == NULL
            && $entsorgung['extraValue2'] == NULL
            ) 
            style="display: none;"
            @endif>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="entsorgungMasraf" @if ($entsorgung && $entsorgung['extra1']) checked @endif> 
                                    <span class="label-text text-dark"><strong>Spesen</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="entsorgungExtra1" type="number" 
                            @if ($entsorgung && $entsorgung['extra1']) value="{{ $entsorgung['extra1'] }}" @else value="20" @endif>
                        </div>
                    </div> 

                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="entsorgungExtra1CostText" placeholder="Freier Text"  type="text" 
                            @if ($entsorgung && $entsorgung['extraValue1']) value="{{ $entsorgung['extraText1'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="entsorgungExtra1Cost" placeholder="0"  type="text" 
                            @if ($entsorgung && $entsorgung['extraValue1']) value="{{ $entsorgung['extraValue1'] }}" @else value="0.00" @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="entsorgungExtra2CostText" placeholder="Freier Text"  type="text" 
                            @if ($entsorgung && $entsorgung['extraValue2']) value="{{ $entsorgung['extraText2'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="entsorgungExtra2Cost" placeholder="0"  type="text" 
                            @if ($entsorgung && $entsorgung['extraValue2']) value="{{ $entsorgung['extraValue2'] }}" @else value="0.00" @endif>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Rabatt</label>
            <input class="form-control"  name="entsorgungDiscount" placeholder="0"  type="text" 
            @if($entsorgung && $entsorgung['discount']) value="{{ $entsorgung['discount'] }}" @else value="0.00" @endif> 

            <label class="col-form-label" for="l0">Rabatt[%]</label>
            <input class="form-control"  name="entsorgungDiscountPercent" placeholder="0"  type="text" 
            @if($entsorgung && $entsorgung['discountPercent']) value="{{ $entsorgung['discountPercent'] }}" @else value="0.00" @endif> 

            <label class="col-form-label" for="l0">Entgegenkommen</label>
            <input class="form-control"  name="entsorgungDiscount2" placeholder="0"  type="text" 
            @if($entsorgung && $entsorgung['discount2']) value="{{ $entsorgung['discount2'] }}" @else value="0.00" @endif>

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="entsorgungExtraDiscountText" placeholder="Freier Text"  type="text"
                    @if($entsorgung && $entsorgung['extraDiscountValue1']) value="{{ $entsorgung['extraDiscountText1'] }}" @endif>
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="entsorgungExtraDiscount" placeholder="0"  type="text" 
                    @if($entsorgung && $entsorgung['extraDiscountValue1']) value="{{ $entsorgung['extraDiscountValue1'] }}" @else value="0.00" @endif>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-md-7">
                    <input class="form-control"  name="entsorgungExtraDiscountText2" placeholder="Freier Text"  type="text" 
                    @if($entsorgung && $entsorgung['extraDiscountValue2']) value="{{ $entsorgung['extraDiscountText2'] }}" @endif>
                </div>
                <div class="col-md-5">
                    <input class="form-control"  name="entsorgungExtraDiscount2" placeholder="0"  type="text"  
                    @if($entsorgung && $entsorgung['extraDiscountValue2']) value="{{ $entsorgung['extraDiscountValue2'] }}" @else value="0.00" @endif>
                </div>
            </div>
            
            <label class="col-form-label mt-1 " for="l0">Zwischenbetrag</label>
            <input class="form-control" id="entsorgungCost"  name="entsorgungCost" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
            @if($entsorgung && $entsorgung['entsorgungCost']) value="{{ $entsorgung['entsorgungCost'] }}" @else value="0.00" @endif> 

            <div class="entsorgung-fixed-price mt-1">
                <label for="" class="col-form-label">Pauschal</label><br>
                <input type="checkbox" name="isEntsorgungFixedPrice" id="isEntsorgungFixedPrice" class="js-switch " data-color="#9c27b0" data-size="small" data-switchery="false" 
                @if($entsorgung && $entsorgung['entsorgungFixedCost']) checked @endif>  
            </div> 

            <div class="entsorgung-fixed-price-area mt-1 mb-1" @if($entsorgung && $entsorgung['entsorgungFixedCost'] == NULL) style="display: none;" @endif>
                <input class="form-control"  name="entsorgungFixedPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
                @if($entsorgung && $entsorgung['entsorgungFixedCost']) value="{{ $entsorgung['entsorgungFixedCost'] }}" @else value="0.00" @endif>
            </div>

            <label class="col-form-label" for="l0">Anzahlung</label>
            <input class="form-control"  name="entsorgungPaid1" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
            @if($entsorgung && $entsorgung['entsorgungPaid1']) value="{{ $entsorgung['entsorgungPaid1'] }}" @else value="0.00" @endif>

            <label class="col-form-label" for="l0">Bar Bezahlt</label>
            <input class="form-control"  name="entsorgungPaid2" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
            @if($entsorgung && $entsorgung['entsorgungPaid2']) value="{{ $entsorgung['entsorgungPaid2'] }}" @else value="0.00" @endif>

            <label class="col-form-label" for="l0">Betrag </label>
            <input class="form-control total-piece"  name="entsorgungTotalPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
            @if($entsorgung && $entsorgung['entsorgungTotalPrice']) value="{{ $entsorgung['entsorgungTotalPrice'] }}" @else value="0.00" @endif>
        </div>
    </div>
</div>
@section('invoiceEditEntsorgung')

{{-- Tarife Fiyatları --}}
<script>
    function isRequiredEntsorgung()
    {
        $("input[name=entsorgungDate]").prop('required',true);      
        $("input[name=entsorgungHours]").prop('required',true);   
        $("input[name=entsorgungChf]").prop('required',true); 
        $("input[name=entsorgungHours]").attr({'min':1}); 
        $("input[name=entsorgungChf]").attr({'min':1});  
    }

    function isNotRequiredEntsorgung()
    {
        $("input[name=entsorgungDate]").prop('required',false);      
        $("input[name=entsorgungHours]").prop('required',false);   
        $("input[name=entsorgungChf]").prop('required',false); 
        $("input[name=entsorgungVolume]").prop('required',false); 
        $("input[name=entsorgungFixedChf]").prop('required',false);  
        $("input[name=entsorgungHours]").removeAttr('min'); 
        $("input[name=entsorgungChf]").removeAttr('min');
    }

    $("body").on("change",".entsorgung--area",function (){
        let c1 = $("input[name=entsorgungHours]").val();
        let c2 = $("input[name=entsorgungChf]").val();
        if(c1 && c2 != 0){
            $("input[name=entsorgungVolume]").prop('required',false); 
            $("input[name=entsorgungFixedChf]").prop('required',false); 
        }
        else
        {
            $("input[name=entsorgungVolume]").prop('required',true); 
            $("input[name=entsorgungFixedChf]").prop('required',true);
            $("input[name=entsorgungHours]").prop('required',false); 
            $("input[name=entsorgungChf]").prop('required',false);
            $("input[name=entsorgungHours]").removeAttr('min'); 
            $("input[name=entsorgungChf]").removeAttr('min');
        }
    })

    $(document).ready(function() {
        if($("div.entsorgung--area").is(":visible"))
        {
            isRequiredEntsorgung()
        }
    })
    var isEntsorgungFixedbutton = $("div.entsorgung-fixed-price");
    isEntsorgungFixedbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".entsorgung-fixed-price-area").show(700);
            isRequiredEntsorgung();
        }
        else{
            $(".entsorgung-fixed-price-area").hide(500);
            isNotRequiredEntsorgung();
        }
    })

    var morebutton32 = $("div.entsorgung-control");
    morebutton32.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".entsorgung--area").show(500);
            isRequiredEntsorgung()
        }
        else{
            $(".entsorgung--area").hide(500);
            isNotRequiredEntsorgung()
        }
    })

    $("body").on("change",".entsorgung--area", function() {
        let entsorgungVolume = parseInt($("input[name=entsorgungVolume]").val()) || 0;
        let entsorgungFixedChf = parseInt($("input[name=entsorgungFixedChf]").val()) || 0;
        let entsorgungFixedChfCost = parseInt($("input[name=entsorgungFixedChfCost]").val()) || 0;

        let entsorgungChf = parseInt($("input[name=entsorgungChf]").val()) || 0;
        let entsorgungHours = parseInt($("input[name=entsorgungHours]").val()) || 0;

        let entsorgungRoadChf = parseInt($("input[name=entsorgungRoadChf]").val()) || 0;

        let entsorgungCost = 0;
        let entsorgungTotalPrice = 0;
        if ($('input[name=entsorgungMasraf]').is(":checked")){
            var extra1 = parseInt($('input[name=entsorgungExtra1]').val());               
            }
            else {
                extra1 = 0;
            }

            let entsorgungExtra1Cost = parseFloat($('input[name=entsorgungExtra1Cost]').val()) || 0;               
            let entsorgungExtra2Cost = parseFloat($('input[name=entsorgungExtra2Cost]').val()) || 0; 

            let entsorgungDiscount = parseFloat($('input[name=entsorgungDiscount]').val()) || 0;
            let entsorgungDiscount2 = parseFloat($('input[name=entsorgungDiscount2]').val()) || 0;

            let entsorgungExtraDiscount = parseFloat($('input[name=entsorgungExtraDiscount]').val()) || 0;
            let entsorgungExtraDiscount2 = parseFloat($('input[name=entsorgungExtraDiscount2]').val()) || 0;
            let entsorgungExtraDiscountPercent = parseFloat($('input[name=entsorgungExtraDiscountPercent]').val()) || 0;

            entsorgungTotalPrice = parseFloat($('input[name=entsorgungTotalPrice]').val()) || 0;

            let entsorgungPaid1 = parseFloat($('input[name=entsorgungPaid1]').val()) || 0; 
            let entsorgungPaid2 = parseFloat($('input[name=entsorgungPaid2]').val()) || 0;

            let entPreCost = (entsorgungVolume*entsorgungFixedChf) + entsorgungFixedChfCost  + (entsorgungChf*entsorgungHours) + 
            (entsorgungRoadChf+entsorgungExtra1Cost+entsorgungExtra2Cost+extra1);
            entsorgungCost = (entsorgungVolume*entsorgungFixedChf) + entsorgungFixedChfCost  + (entsorgungChf*entsorgungHours) + 
            (entsorgungRoadChf+entsorgungExtra1Cost+entsorgungExtra2Cost+extra1)- (entPreCost*entsorgungExtraDiscountPercent/100) -
            entsorgungDiscount-entsorgungDiscount2-entsorgungExtraDiscount-entsorgungExtraDiscount2;
            entsorgungCost = parseFloat(entsorgungCost);

            $("input[name=entsorgungCost]").val(entsorgungCost.toFixed(2))

            if ($('input[name=isEntsorgungFixedPrice]').is(":checked")){
                let entsorgungFixedCalc = parseFloat($('input[name=entsorgungFixedPrice]').val()) || 0;
                entsorgungTotalPrice = entsorgungFixedCalc - entsorgungPaid1 - entsorgungPaid2;
                $("input[name=entsorgungTotalPrice]").val(entsorgungTotalPrice.toFixed(2));
            }
            else {
                entsorgungTotalPrice = entsorgungCost - entsorgungPaid1 - entsorgungPaid2 ;
                $("input[name=entsorgungTotalPrice]").val(entsorgungTotalPrice.toFixed(2));
            }

    })
</script>

{{-- İlave ücret Aç/kapa --}}
<script>
    var entsorgungextracostbutton = $("div.entsorgung-extra-cost");
    entsorgungextracostbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".entsorgung-extra-cost-area").show(700);
        }
        else{
            $(".entsorgung-extra-cost-area").hide(500);
        }
    })
</script>
@endsection