<div class="form-group row">
    <div class="col-md-12 einpack-control">
        <label for="" class="col-form-label">Einpack</label><br>
        <input type="checkbox" name="isEinpack" id="isEinpack" class="js-switch " data-color="#9c27b0" data-switchery="false" @if($einpack) checked @endif>  
    </div>                            
</div>  

<div id="einpack--area" class="rounded einpack--area" style="background-color: #CBB4FF; @if($einpack == NULL) display:none; @endif">
    <div class="row p-3">
        <div class="col-md-6">
            <label class=" col-form-label" for="l0">Datum</label>
            <input class="form-control" class="date"  name="einpackDate"  type="date" @if($einpack && $einpack['einpackDate']) value="{{ $einpack['einpackDate'] }}" @endif> 

            <div class="row">
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Anzahl Std</label>
                    <input id="einpackHours" class="form-control" class="time"  name="einpackHours"  type="number" @if($einpack && $einpack['moveHours']) value="{{ $einpack['moveHours'] }}" @else value="0" @endif> 
                    <a onclick="extraAreaEinpack()" class="extraTimeEinpack text-primary" style="cursor: pointer;">+ Weitere Zeiteingabe</a>
                </div>
    
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Ansatz [CHF]</label>
                    <input class="form-control" class="date"  name="einpackChf"  type="number" 
                    @if($einpack && $einpack['chf']) value="{{ $einpack['chf'] }}" @else value="0" @endif> 
                </div>
            </div>

            <div class="row extraTime-einpack-area"  style="display: none;" >
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Anzahl Std </label>
                    <input class="form-control" class="time"  name="einpackHours2"  type="number"  value="0"> 
                </div>
    
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Ansatz  [CHF]</label>
                    <input class="form-control" class="date"  name="einpackChf2"  type="number"  value="0" > 
                </div>
            </div>

            <label class=" col-form-label" for="l0">Anfahrt/Rückfahrt [CHF]</label>
            <input class="form-control" class="date"  name="einpackRoadChf"  type="number" @if($einpack && $einpack['arrivalReturn']) value="{{ $einpack['arrivalReturn'] }}" @else value="0" @endif> 

            <div class="einpack-extra-cost mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="isEinpackExtra" id="isEinpackExtra" class="js-switch " data-color="#9c27b0" data-switchery="false" 
                @if($einpack
                && $einpack['extra'] == NULL
                && $einpack['extra1'] == NULL
                && $einpack['extraValue1'] == NULL
                && $einpack['extraValue2'] == NULL
                ) 
                unchecked
                @else checked
                @endif>  
            </div>  

            <div class="einpack-extra-cost-area" 
            @if($einpack
            && $einpack['extra'] == NULL
            && $einpack['extra1'] == NULL
            && $einpack['extraValue1'] == NULL
            && $einpack['extraValue2'] == NULL
            ) 
            style="display: none;"
            @endif>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="einpackMasraf" @if ($einpack && $einpack['extra']) checked @endif> 
                                    <span class="label-text text-dark"><strong>Spesen</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="einpackExtra1" type="number" 
                            @if ($einpack && $einpack['extra']) value="{{ $einpack['extra'] }}" @else value="10" @endif>
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="einpackMasraf1" @if ($einpack && $einpack['extra1']) checked @endif> 
                                    <span class="label-text text-dark"><strong>Verpackungsmaterial</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="einpackExtra2" type="number" 
                            @if ($einpack && $einpack['extra1']) value="{{ $einpack['extra1'] }}" @else value="0" @endif>
                        </div>
                    </div>  

                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="einpackExtra1CostText" placeholder="Freier Text"  type="text" 
                            @if ($einpack && $einpack['customCostPrice1']) value="{{ $einpack['customCostName1'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="einpackExtra1Cost" placeholder="0"  type="text"
                            @if ($einpack && $einpack['customCostPrice1']) value="{{ $einpack['customCostPrice1'] }}" @else value="0.00" @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="einpackExtra2CostText" placeholder="Freier Text"  type="text" 
                            @if ($einpack && $einpack['customCostPrice2']) value="{{ $einpack['customCostName2'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="einpackExtra2Cost" placeholder="0"  type="text" 
                            @if ($einpack && $einpack['customCostPrice2']) value="{{ $einpack['customCostPrice2'] }}" @else value="0.00" @endif>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Rabatt</label>
            <input class="form-control"  name="einpackDiscount" placeholder="0"  type="text" @if($einpack && $einpack['discount']) value="{{ $einpack['discount'] }}" @else value="0.00" @endif> 

            <label class="col-form-label" for="l0">Entgegenkommen</label>
            <input class="form-control"  name="einpackDiscount2" placeholder="0"  type="text" @if($einpack && $einpack['compromiser']) value="{{ $einpack['compromiser'] }}" @else value="0.00" @endif>

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="einpackExtraDiscountText" placeholder="Freier Text"  type="text"
                    @if($einpack && $einpack['extraCostPrice']) value="{{ $einpack['extraCostName'] }}" @endif>
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="einpackExtraDiscount" placeholder="0"  type="text" 
                    @if($einpack && $einpack['extraCostPrice']) value="{{ $einpack['extraCostPrice'] }}" @else value="0.00" @endif>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-md-7">
                    <input class="form-control"  name="einpackExtraDiscountText2" placeholder="Freier Text"  type="text">
                </div>
                <div class="col-md-5">
                    <input class="form-control"  name="einpackExtraDiscount2" placeholder="0"  type="text"  value="0.00">
                </div>
            </div>
            
            <label class="col-form-label mt-1 " for="l0">Zwischenbetrag</label>
            <input class="form-control" id="einpackCost"  name="einpackCost" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
            @if($einpack && $einpack['costPrice']) value="{{ $einpack['costPrice'] }}" @else value="0.00" @endif> 

            <div class="einpack-fixed-price mt-1">
                <label for="" class="col-form-label">Pauschal</label><br>
                <input type="checkbox" name="isEinpackFixedPrice" id="isEinpackFixedPrice" class="js-switch " data-color="#9c27b0" data-size="small" data-switchery="false" 
                @if($einpack && $einpack['fixedPrice']) checked @endif>  
            </div> 

            <div class="einpack-fixed-price-area mt-1 mb-1" @if($einpack && $einpack['fixedPrice'] == NULL) style="display: none;" @endif>
                <input class="form-control"  name="einpackFixedPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
                @if($einpack && $einpack['fixedPrice']) value="{{ $einpack['fixedPrice'] }}" @else value="0.00" @endif>
            </div>

            <label class="col-form-label" for="l0">Schadenzahlung</label>
            <input class="form-control"  name="einpackPaid1" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00" >

            <label class="col-form-label" for="l0">Anzahlung</label>
            <input class="form-control"  name="einpackPaid2" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">

            <label class="col-form-label" for="l0">Bar Bezahlt</label>
            <input class="form-control"  name="einpackPaid3" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00" >

            <label class="col-form-label" for="l0">Betrag</label>
            <input class="form-control total-piece"  name="einpackTotalPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
            @if($einpack && $einpack['fixedPrice']) value="{{ $einpack['fixedPrice'] }}" @elseif($einpack && $einpack['costPrice']) value="{{ $einpack['fixedPrice'] }}" @else value="0.00" @endif>
        </div>
    </div>
</div>
@section('invoiceOfferEinpack')

{{-- Tarife Fiyatları --}}
<script>

    function isRequiredEinpack()
    {
        $("input[name=einpackDate]").prop('required',true);      
        $("input[name=einpackHours]").prop('required',true);   
        $("input[name=einpackChf]").prop('required',true); 
        $("input[name=einpackHours]").attr({'min':1}); 
        $("input[name=einpackChf]").attr({'min':1}); 
    }

    function isNotRequiredEinpack()
    {
        $("input[name=einpackDate]").prop('required',false);      
        $("input[name=einpackHours]").prop('required',false);   
        $("input[name=einpackChf]").prop('required',false);  
        $("input[name=einpackHours]").removeAttr('min'); 
        $("input[name=einpackChf]").removeAttr('min');
        $("input[name=einpackChf2]").removeAttr('min');
        $("input[name=einpackHours2]").removeAttr('min');
    }

    function extraAreaEinpack()
    {
        $(".extraTime-einpack-area").show(300);
        $(".extraTimeEinpack").hide();
        $("input[name=einpackChf2]").attr({'min':1});
        $("input[name=einpackHours2]").attr({'min':1});
    }

    $("body").on("change",".einpack--area",function (){
        isRequiredEinpack()
    })

    var morebutton3 = $("div.einpack-control");
    morebutton3.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".einpack--area").show(700);
            isRequiredEinpack()
        }
        else{
            $(".einpack--area").hide(500);
            isNotRequiredEinpack()
        }
    })

    var isEinpackFixedbutton = $("div.einpack-fixed-price");
    isEinpackFixedbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".einpack-fixed-price-area").show(700);
        }
        else{
            $(".einpack-fixed-price-area").hide(500);
        }
    })

    $("body").on("change",".einpack--area", function() {
        let einpackChf = parseInt($("input[name=einpackChf]").val());
        let einpackHours = parseInt($("input[name=einpackHours]").val());

        let einpackChf2 = parseInt($("input[name=einpackChf2]").val());
        let einpackHours2 = parseInt($("input[name=einpackHours2]").val());

        if(einpackChf2 && einpackChf2 > 0)
        {
            einpackChf2 = einpackChf2
        }
        else {
            einpackChf2 = 0;
        }

        if(einpackHours2 && einpackHours2 > 0)
        {
            einpackHours2 = einpackHours2
        }
        else {
            einpackHours2 = 0;
        }

        let einpackRoadChf = parseInt($("input[name=einpackRoadChf]").val());
        let einpackCost = 0;
        let einpackTotalPrice = 0;
        if ($('input[name=einpackMasraf]').is(":checked")){
            var extra1 = parseInt($('input[name=einpackExtra1]').val());               
            }
            else {
                extra1 = 0;
            }
            if ($('input[name=einpackMasraf1]').is(":checked")){
               var extra2 = parseInt($('input[name=einpackExtra2]').val());               
            }
            else {
                extra2 = 0;
            }

            let einpackExtra1Cost = parseFloat($('input[name=einpackExtra1Cost]').val());               
            let einpackExtra2Cost = parseFloat($('input[name=einpackExtra2Cost]').val()); 
            let einpackDiscount = parseFloat($('input[name=einpackDiscount]').val());
            let einpackDiscount2 = parseFloat($('input[name=einpackDiscount2]').val());
            let einpackExtraDiscount = parseFloat($('input[name=einpackExtraDiscount]').val());
            let einpackExtraDiscount2 = parseFloat($('input[name=einpackExtraDiscount2]').val());

            einpackTotalPrice = parseFloat($('input[name=einpackTotalPrice]').val());

            let einpackPaid1 = parseFloat($('input[name=einpackPaid1]').val());
            let einpackPaid2 = parseFloat($('input[name=einpackPaid2]').val());
            let einpackPaid3 = parseFloat($('input[name=einpackPaid3]').val());

            einpackCost = (einpackHours*einpackChf) + (einpackHours2*einpackChf2) + 
            (einpackRoadChf+einpackExtra1Cost+einpackExtra2Cost+extra1+extra2)-
            einpackDiscount-einpackDiscount2-einpackExtraDiscount-einpackExtraDiscount2;
            einpackCost = parseFloat(einpackCost);

            $("input[name=einpackCost]").val(einpackCost.toFixed(2))

            if ($('input[name=isEinpackFixedPrice]').is(":checked")){
                let einpackFixedCalc = parseFloat($('input[name=einpackFixedPrice]').val());
                einpackTotalPrice = einpackFixedCalc - einpackPaid1 - einpackPaid2 - einpackPaid3;
                $("input[name=einpackTotalPrice]").val(einpackTotalPrice.toFixed(2));
            }
            else {
                einpackTotalPrice = einpackCost - einpackPaid1 - einpackPaid2 - einpackPaid3;
                $("input[name=einpackTotalPrice]").val(einpackTotalPrice.toFixed(2));
            }
        })
</script>
{{-- İlave ücret Aç/kapa --}}
<script>
    var einpackextracostbutton = $("div.einpack-extra-cost");
    einpackextracostbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".einpack-extra-cost-area").show(700);
        }
        else{
            $(".einpack-extra-cost-area").hide(500);
        }
    })
</script>
@endsection