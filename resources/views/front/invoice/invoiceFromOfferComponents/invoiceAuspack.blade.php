<div class="form-group row">
    <div class="col-md-12 auspack-control">
        <label for="" class="col-form-label">Auspack</label><br>
        <input type="checkbox" name="isAuspack" id="isAuspack" class="js-switch " data-color="#9c27b0" data-switchery="false" @if($auspack) checked @endif>  
    </div>                            
</div>  

<div id="auspack--area" class="rounded auspack--area" style="background-color: #CBB4FF; @if($auspack == NULL) display:none; @endif">
    <div class="row p-3">
        <div class="col-md-6">
            <label class=" col-form-label" for="l0">Datum</label>
            <input class="form-control" class="date"  name="auspackDate"  type="date" @if($auspack && $auspack['auspackDate']) value="{{ $auspack['auspackDate'] }}"  @endif> 

            <div class="row">
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Anzahl Std</label>
                    <?php
                    if ($auspack && $auspack['moveHours']) {
                        $auspackHours = is_numeric($auspack['moveHours']) ? $auspack['moveHours'] : explode('-', $auspack['moveHours'])[1];
                        $eauspackHours = (int) $auspackHours; // "$umzugHours" değişkenini integer'a dönüştürür
                    }
                    ?>
                    <input id="auspackHours" class="form-control" class="time"  name="auspackHours"  type="number" @if($auspack && $auspack['moveHours']) value="{{ $auspackHours }}" @else value="0" @endif> 
                    <a onclick="extraAreaAuspack()" class="extraTimeAuspack text-primary" style="cursor: pointer;">+ Weitere Zeiteingabe</a>
                </div>
    
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Ansatz [CHF]</label>
                    <input class="form-control" class="date"  name="auspackChf"  type="number" 
                    @if($auspack) value="{{ $auspack['chf'] }}" @endif> 
                </div>
            </div>

            <div class="row extraTime-auspack-area"  style="display: none;" >
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Anzahl Std</label>
                    <input class="form-control" class="time"  name="auspackHours2"  type="number" value="0"> 
                </div>
    
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Ansatz [CHF]</label>
                    <input class="form-control" class="date"  name="auspackChf2"  type="number"  value="0" > 
                </div>
            </div>

            <label class=" col-form-label" for="l0">Anfahrt/Rückfahrt [CHF]</label>
            <input class="form-control" class="date"  name="auspackRoadChf"  type="number" @if($auspack && $auspack['arrivalReturn']) value="{{ $auspack['arrivalReturn'] }}" @else value="0" @endif> 

            <div class="auspack-extra-cost mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="isAuspackExtra" id="isAuspackExtra" class="js-switch " data-color="#9c27b0" data-switchery="false" 
                @if($auspack
                && $auspack['extra'] == NULL
                && $auspack['extra1'] == NULL
                && $auspack['extraValue1'] == NULL
                && $auspack['extraValue2'] == NULL
                ) 
                unchecked
                @else checked
                @endif>  
            </div>  

            <div class="auspack-extra-cost-area" 
            @if($auspack
            && $auspack['extra'] == NULL
            && $auspack['extra1'] == NULL
            && $auspack['extraValue1'] == NULL
            && $auspack['extraValue2'] == NULL
            ) 
            style="display: none;"
            @endif>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="auspackMasraf" @if ($auspack && $auspack['extra']) checked @endif> 
                                    <span class="label-text text-dark"><strong>Spesen</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="auspackExtra1" type="number" 
                            @if ($auspack && $auspack['extra']) value="{{ $auspack['extra'] }}" @else value="10" @endif>
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="auspackMasraf1" @if ($auspack && $auspack['extra1']) checked @endif> 
                                    <span class="label-text text-dark"><strong>Verpackungsmaterial</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="auspackExtra2" type="number" 
                            @if ($auspack && $auspack['extra1']) value="{{ $auspack['extra1'] }}" @else value="0" @endif>
                        </div>
                    </div>  

                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="auspackExtra1CostText" placeholder="Freier Text"  type="text" 
                            @if ($auspack && $auspack['customCostPrice1']) value="{{ $auspack['customCostName1'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="auspackExtra1Cost" placeholder="0"  type="text"
                            @if ($auspack && $auspack['customCostPrice1']) value="{{ $auspack['customCostPrice1'] }}" @else value="0.00" @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="auspackExtra2CostText" placeholder="Freier Text"  type="text" 
                            @if ($auspack && $auspack['customCostPrice2']) value="{{ $auspack['customCostName2'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="auspackExtra2Cost" placeholder="0"  type="text" 
                            @if ($auspack && $auspack['customCostPrice2']) value="{{ $auspack['customCostPrice2'] }}" @else value="0.00" @endif>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Rabatt</label>
            <input class="form-control"  name="auspackDiscount" placeholder="0"  type="text" @if($auspack && $auspack['discount']) value="{{ $auspack['discount'] }}" @else value="0.00" @endif> 

            <label class="col-form-label" for="l0">Rabatt[%]</label>
            <input class="form-control"  name="auspackDiscountPercent" placeholder="0"  type="text" 
            @if($auspack && $auspack['discountPercent']) value="{{ $auspack['discountPercent'] }}" @else value="0.00" @endif> 

            <label class="col-form-label" for="l0">Entgegenkommen</label>
            <input class="form-control"  name="auspackDiscount2" placeholder="0"  type="text" @if($auspack && $auspack['compromiser']) value="{{ $auspack['compromiser'] }}" @else value="0.00" @endif>

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="auspackExtraDiscountText" placeholder="Freier Text"  type="text"
                    @if($auspack && $auspack['extraCostPrice']) value="{{ $auspack['extraCostName'] }}" @endif>
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="auspackExtraDiscount" placeholder="0"  type="text" 
                    @if($auspack && $auspack['extraCostPrice']) value="{{ $auspack['extraCostPrice'] }}" @else value="0.00" @endif>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-md-7">
                    <input class="form-control"  name="auspackExtraDiscountText2" placeholder="Freier Text"  type="text">
                </div>
                <div class="col-md-5">
                    <input class="form-control"  name="auspackExtraDiscount2" placeholder="0"  type="text"  value="0.00" >
                </div>
            </div>
            
            <label class="col-form-label mt-1 " for="l0">Zwischenbetrag</label>
            <?php
            if ($auspack && $auspack['costPrice']) {
                $auspackCost = is_numeric($auspack['costPrice']) ? $auspack['costPrice'] : explode('-', $auspack['costPrice'])[1];
                $auspackCost = floatval($auspackCost); // "$auspackCost" değişkenini integer'a dönüştürür
            }
            ?>
            <input class="form-control" id="auspackCost"  name="auspackCost" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
            @if($auspack && $auspack['costPrice']) value="{{ $auspackCost }}" @else value="0.00" @endif> 

            <div class="auspack-fixed-price mt-1">
                <label for="" class="col-form-label">Pauschal</label><br>
                <input type="checkbox" name="isAuspackFixedPrice" id="isAuspackFixedPrice" class="js-switch " data-color="#9c27b0" data-size="small" data-switchery="false" 
                @if($auspack && $auspack['fixedPrice']) checked @endif>  
            </div> 

            <div class="auspack-fixed-price-area mt-1 mb-1" @if($auspack && $auspack['fixedPrice'] == NULL) style="display: none;" @endif>
                <input class="form-control"  name="auspackFixedPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
                @if($auspack && $auspack['fixedPrice']) value="{{ $auspack['fixedPrice'] }}" @else value="0.00" @endif>
            </div>

            <label class="col-form-label" for="l0">Schadenzahlung</label>
            <input class="form-control"  name="auspackPaid1" placeholder="0"  type="text" style="background-color: #8778aa;color:white;"  value="0.00" >

            <label class="col-form-label" for="l0">Anzahlung</label>
            <input class="form-control"  name="auspackPaid2" placeholder="0"  type="text" style="background-color: #8778aa;color:white;"  value="0.00" >

            <label class="col-form-label" for="l0">Bar Bezahlt</label>
            <input class="form-control"  name="auspackPaid3" placeholder="0"  type="text" style="background-color: #8778aa;color:white;"  value="0.00" >

            <label class="col-form-label" for="l0">Betrag</label>
            <?php
            if ($auspack && $auspack['costPrice']) {
                $auspackCost = is_numeric($auspack['costPrice']) ? $auspack['costPrice'] : explode('-', $auspack['costPrice'])[1];
                $auspackCost = floatval($auspackCost); // "$auspackCost" değişkenini integer'a dönüştürür
            }
            ?>
            <input class="form-control total-piece"  name="auspackTotalPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
            @if($auspack && $auspack['fixedPrice']) value="{{ $auspack['fixedPrice'] }}" @elseif($auspack && $auspack['costPrice']) value="{{ $auspackCost }}" @else value="0.00" @endif>
        </div>
    </div>
</div>
@section('invoiceOfferAuspack')

{{-- Tarife Fiyatları --}}
<script>


    function isRequiredAuspack()
    {
        $("input[name=auspackDate]").prop('required',true);      
        $("input[name=auspackHours]").prop('required',true);   
        $("input[name=auspackChf]").prop('required',true); 
        $("input[name=auspackHours]").attr({'min':1}); 
        $("input[name=auspackChf]").attr({'min':1}); 
    }

    function isNotRequiredAuspack()
    {
        $("input[name=auspackDate]").prop('required',false);      
        $("input[name=auspackHours]").prop('required',false);   
        $("input[name=auspackChf]").prop('required',false);  
        $("input[name=auspackHours]").removeAttr('min'); 
        $("input[name=auspackChf]").removeAttr('min');
        $("input[name=auspackChf2]").removeAttr('min');
        $("input[name=auspackHours2]").removeAttr('min');
    }

    function extraAreaAuspack()
    {
        $(".extraTime-auspack-area").show(300);
        $(".extraTimeAuspack").hide();
        $("input[name=auspackChf2]").attr({'min':1});
        $("input[name=auspackHours2]").attr({'min':1});
    }

    $("body").on("change",".auspack--area",function (){
        isRequiredAuspack()
        auspackInvoiceCalc()
    })
   
    var morebutton4 = $("div.auspack-control");
    morebutton4.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".auspack--area").show(700);
            isRequiredAuspack()
        }
        else{
            $(".auspack--area").hide(500);
            isNotRequiredAuspack()
        }
    })

    var isAuspackFixedbutton = $("div.auspack-fixed-price");
    isAuspackFixedbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".auspack-fixed-price-area").show(700);
        }
        else{
            $(".auspack-fixed-price-area").hide(500);
        }
    })

    $(document).ready(function() {
        auspackInvoiceCalc()
        if($("div.auspack--area").is(":visible"))
        {
            isRequiredAuspack()
        }
    })

    function auspackInvoiceCalc() {
        const auspackChf = parseInt($("input[name=auspackChf]").val()) || 0;
        const auspackHours = parseInt($("input[name=auspackHours]").val()) || 0;
        const auspackChf2 = parseInt($("input[name=auspackChf2]").val()) || 0;
        const auspackHours2 = parseInt($("input[name=auspackHours2]").val()) || 0;
        const auspackRoadChf = parseInt($("input[name=auspackRoadChf]").val()) || 0;
        const auspackExtras = [
            {name: 'auspackExtra1', masraf: 'auspackMasraf'},
            {name: 'auspackExtra2', masraf: 'auspackMasraf1'},
        ];
        let auspackExtrasTotal = 0;
        for (const auspackExtra of auspackExtras) {
            if ($(`input[name=${auspackExtra.masraf}]`).is(':checked')) {
            const value = parseInt($(`input[name=${auspackExtra.name}]`).val()) || 0;
            auspackExtrasTotal += isNaN(value) ? 0 : value;
            }
        }

        const auspackExtra1Cost = parseFloat($('input[name=auspackExtra1Cost]').val()) || 0;
        const auspackExtra2Cost = parseFloat($('input[name=auspackExtra2Cost]').val()) || 0;
        const auspackDiscount = parseFloat($('input[name=auspackDiscount]').val()) || 0 ;
        const auspackDiscount2 = parseFloat($('input[name=auspackDiscount2]').val()) || 0;
        const auspackExtraDiscount = parseFloat($('input[name=auspackExtraDiscount]').val()) || 0;
        const auspackExtraDiscount2 = parseFloat($('input[name=auspackExtraDiscount]').val()) || 0;
        const auspackDiscountPercent = parseFloat($('input[name=auspackDiscountPercent]').val()) || 0;

        const auspackPaid1 = parseFloat($('input[name=auspackPaid1]').val()) || 0;
        const auspackPaid2 = parseFloat($('input[name=auspackPaid2]').val()) || 0;
        const auspackPaid3 = parseFloat($('input[name=auspackPaid3]').val()) || 0;
        let auspackTotalPrice;

        const auspackPreCost = (auspackHours * auspackChf) + (auspackHours2 * auspackChf2) +
            (auspackRoadChf + auspackExtrasTotal + auspackExtra1Cost + auspackExtra2Cost);

        const auspackCost = (auspackHours * auspackChf) + (auspackHours2 * auspackChf2) +
            (auspackRoadChf + auspackExtrasTotal + auspackExtra1Cost + auspackExtra2Cost) - (auspackPreCost*auspackDiscountPercent/100) -
            auspackDiscount - auspackDiscount2 - auspackExtraDiscount - auspackExtraDiscount2;
        $("input[name=auspackCost]").val(auspackCost);

        const isAuspackFixedPrice = $('input[name=isAuspackFixedPrice]').is(":checked");
        const auspackFixedPrice = parseFloat($('input[name=auspackFixedPrice]').val()) || 0;
        auspackTotalPrice = isAuspackFixedPrice ? auspackFixedPrice : auspackCost;
        auspackTotalPrice -= auspackPaid1 + auspackPaid2 + auspackPaid3;
        $("input[name=auspackTotalPrice]").val(auspackTotalPrice);
        
    }
</script>
{{-- İlave ücret Aç/kapa --}}
<script>
    var auspackextracostbutton = $("div.auspack-extra-cost");
    auspackextracostbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".auspack-extra-cost-area").show(700);
        }
        else{
            $(".auspack-extra-cost-area").hide(500);
        }
    })
</script>
@endsection