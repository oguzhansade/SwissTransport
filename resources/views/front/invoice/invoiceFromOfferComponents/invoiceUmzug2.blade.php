<div class="form-group row">
    <div class="col-md-12 umzug-control">
        <label for="" class="col-form-label">Umzug </label><br>
        <input type="checkbox" name="isUmzug" id="isUmzug" class="js-switch " data-color="#9c27b0" data-switchery="false" @if($umzug) checked @endif>  
    </div>                            
</div>

<div class="rounded umzug--area" style="background-color: #CBB4FF; @if($umzug == NULL) display:none; @endif">
    <div class="row p-3">
        <div class="col-md-6">
            <label class=" col-form-label" for="l0">Datum</label>
            <input class="form-control" class="date"  name="umzugDate"  type="date" @if($umzug) value="{{ $umzug['moveDate'] }}" @endif> 

            <div class="row">
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Anzahl Std</label>
                    <input  class="form-control" class="time"  name="umzugHours"  type="number" @if($umzug) value="{{ $umzug['moveHours'] }}" @endif> 
                    <a onclick="extraAreaUmzug()" class="extraTimeUmzug text-primary" style="cursor: pointer;">+ Weitere Zeiteingabe</a>
                </div>
    
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Ansatz  [CHF]</label>
                    <input class="form-control" class="date"  name="umzugChf"  type="number"
                    @if($umzug) value="{{ $umzug['chf'] }}" @endif> 
                </div>
            </div>

            <div class="row extraTime-umzug-area" @if($umzug && $umzug['umzugHour2'] == NULL  && $umzug['umzugChf2'] == NULL) style="display: none;" @endif>
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Anzahl Std</label>
                    <input class="form-control" class="time"  name="umzugHours2"  type="number" @if ($umzug)
                    value="{{ $umzug['umzugHour2'] }}" @else value="0.00"
                    @endif > 
                </div>
    
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Ansatz  [CHF]</label>
                    <input class="form-control" class="date"  name="umzugChf2"  type="number" @if($umzug) value="{{ $umzug['umzugChf2']  }}" @else value="0.00" @endif > 
                </div>
            </div>

            <label class=" col-form-label" for="l0">Anfahrt/Rückfahrt [CHF]</label>
            <input class="form-control" class="date"  name="umzugRoadChf"  type="number" @if($umzug) value="{{ $umzug['arrivalReturn'] }}" @else value="0.00" @endif > 

            <div class="umzug-extra-cost mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="isUmzugExtra" id="isUmzugExtra" class="js-switch " data-color="#9c27b0" data-switchery="false" 
                @if($umzug
                && $umzug['extra'] == NULL
                && $umzug['extra1'] == NULL
                && $umzug['extra2'] == NULL
                && $umzug['extra3'] == NULL
                && $umzug['extra4'] == NULL
                && $umzug['extra5'] == NULL
                && $umzug['extra6'] == NULL
                && $umzug['extra7'] == NULL
                && $umzug['extra8'] == NULL
                && $umzug['extra9'] == NULL
                && $umzug['extra10'] == NULL
                && $umzug['extraValue1'] == NULL
                && $umzug['extraValue2'] == NULL
                ) 
                unchecked
                @else checked
                @endif>  
            </div>  

            <div class="umzug-extra-cost-area"  
            @if($umzug
            && $umzug['extra'] == NULL
            && $umzug['extra1'] == NULL
            && $umzug['extra2'] == NULL
            && $umzug['extra3'] == NULL
            && $umzug['extra4'] == NULL
            && $umzug['extra5'] == NULL
            && $umzug['extra6'] == NULL
            && $umzug['extra7'] == NULL
            && $umzug['extra8'] == NULL
            && $umzug['extra9'] == NULL
            && $umzug['extra10'] == NULL
            && $umzug['extraValue1'] == NULL
            && $umzug['extraValue2'] == NULL
            ) 
            style="display: none;"
            @endif>
                <div class="form-group">

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="masraf" @if ($umzug && $umzug['extra']) checked @endif> 
                                    <span class="label-text text-dark"><strong>Spesen</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="extra1" type="number" 
                            @if ($umzug && $umzug['extra']) value="{{ $umzug['extra'] }}" @else value="10" @endif>
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="masraf1" @if ($umzug && $umzug['extra1']) checked @endif> 
                                    <span class="label-text text-dark"><strong>Klavier 250.-</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="extra2" type="number" 
                            @if ($umzug && $umzug['extra1']) value="{{ $umzug['extra1'] }}" @else value="250" @endif >
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="masraf2" @if ($umzug && $umzug['extra2']) checked @endif> 
                                    <span class="label-text text-dark"><strong>Klavier 350.-</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="extra3" type="number" 
                            @if ($umzug && $umzug['extra2']) value="{{ $umzug['extra2'] }}" @else value="350" @endif >
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="masraf3" @if ($umzug && $umzug['extra3']) checked @endif> 
                                    <span class="label-text text-dark"><strong> Möbellift 0.-</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="extra4" type="number" 
                            @if ($umzug && $umzug['extra3']) value="{{ $umzug['extra3'] }}" @else value="0" @endif>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="masraf4" @if ($umzug && $umzug['extra4']) checked @endif> 
                                    <span class="label-text text-dark"><strong>Möbellift 250.-</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="extra5" type="number"
                            @if ($umzug && $umzug['extra4']) value="{{ $umzug['extra4'] }}" @else value="250" @endif>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="masraf5" @if ($umzug && $umzug['extra5']) checked @endif> 
                                    <span class="label-text text-dark"><strong>Möbellift 350.-</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="extra6" type="number" 
                            @if ($umzug && $umzug['extra5']) value="{{ $umzug['extra5'] }}" @else value="350" @endif>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="masraf6" @if ($umzug && $umzug['extra6']) checked @endif> 
                                    <span class="label-text text-dark"><strong>Schwergutzuschlag  150.-</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="extra7" type="number" 
                            @if ($umzug && $umzug['extra6']) value="{{ $umzug['extra6'] }}" @else value="150" @endif>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="masraf7" @if ($umzug && $umzug['extra7']) checked @endif> 
                                    <span class="label-text text-dark"><strong>Schwergutzuschlag  250.-</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="extra8" type="number" 
                            @if ($umzug && $umzug['extra7']) value="{{ $umzug['extra7'] }}" @else value="250" @endif>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="masraf8" @if ($umzug && $umzug['extra8']) checked @endif> 
                                    <span class="label-text text-dark"><strong>Tresor  350.-</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="extra9" type="number" 
                            @if ($umzug && $umzug['extra8']) value="{{ $umzug['extra8'] }}" @else value="350" @endif>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="masraf9" @if ($umzug && $umzug['extra9']) checked @endif> 
                                    <span class="label-text text-dark"><strong>Tresor  450.-</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="extra10" type="number" 
                            @if ($umzug && $umzug['extra9']) value="{{ $umzug['extra9'] }}" @else value="450" @endif>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="masraf10" @if ($umzug && $umzug['extra10']) checked @endif> 
                                    <span class="label-text text-dark"><strong>Wasserbett</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="extra11" type="number" 
                            @if ($umzug && $umzug['extra10']) value="{{ $umzug['extra10'] }}" @else value="500" @endif>
                        </div>
                    </div>
                    
                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="extra12CostText" placeholder="Freier Text"  type="text" 
                            @if ($umzug && $umzug['customCostPrice1']) value="{{ $umzug['customCostName1'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="extra12Cost" placeholder="0"  type="text" 
                            @if ($umzug && $umzug['customCostPrice1']) value="{{ $umzug['customCostPrice1'] }}" @else value="0.00" @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="extra13CostText" placeholder="Freier Text"  type="text" 
                            @if ($umzug && $umzug['customCostPrice2']) value="{{ $umzug['customCostName2'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="extra13Cost" placeholder="0"  type="text" 
                            @if ($umzug && $umzug['customCostPrice2']) value="{{ $umzug['customCostPrice2'] }}" @else value="0.00" @endif>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            
            <label class="col-form-label" for="l0">Rabatt</label>
            <input class="form-control"  name="umzugDiscount" placeholder="0"  type="text" @if($umzug && $umzug['discount']) value="{{ $umzug['discount'] }}" @else value="0.00" @endif> 

            <label class="col-form-label" for="l0">Entgegenkommen</label>
            <input class="form-control"  name="umzugDiscount2" placeholder="0"  type="text" @if($umzug && $umzug['compromiser']) value="{{ $umzug['compromiser'] }}" @else value="0.00" @endif>

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="umzugExtraDiscountText" placeholder="Freier Text"  type="text"
                    @if($umzug && $umzug['extraCostPrice']) value="{{ $umzug['extraCostName'] }}" @endif>
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="umzugExtraDiscount" placeholder="0"  type="text" 
                    @if($umzug && $umzug['extraCostPrice']) value="{{ $umzug['extraCostPrice'] }}" @else value="0.00" @endif>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-md-7">
                    <input class="form-control"  name="umzugExtraDiscountText2" placeholder="Freier Text"  type="text" >
                </div>
                <div class="col-md-5">
                    <input class="form-control"  name="umzugExtraDiscount2" placeholder="0"  type="text"  value="0.00" >
                </div>
            </div>
            
            <label class="col-form-label mt-1 " for="l0">Zwischenbetrag</label>
            <input class="form-control" id="umzugCost"  name="umzugCost" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
            @if($umzug && $umzug['costPrice']) value="{{ $umzug['costPrice'] }}" @else value="0.00" @endif> 

            <div class="fixed-price mt-1">
                <label for="" class="col-form-label">Pauschal</label><br>
                <input type="checkbox" name="isUmzugFixedPrice" id="isUmzugFixedPrice" class="js-switch " data-color="#9c27b0" data-size="small" data-switchery="false"  
                @if($umzug && $umzug['fixedPrice']) checked @endif>  
            </div> 

            <div class="fixed-price-area mt-1 mb-1" @if($umzug && $umzug['fixedPrice'] == NULL) style="display: none;" @endif >
                <input class="form-control"  name="umzugFixedPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
                @if($umzug && $umzug['fixedPrice']) value="{{ $umzug['fixedPrice'] }}" @else value="0.00" @endif>
            </div>

            <label class="col-form-label" for="l0">Schadenzahlung</label>
            <input class="form-control"  name="umzugPaid1" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
            @if($umzug && $umzug['umzugPaid1']) value="{{ $umzug['umzugPaid1'] }}" @else value="0.00" @endif>

            <label class="col-form-label" for="l0">Anzahlung</label>
            <input class="form-control"  name="umzugPaid2" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
            @if($umzug && $umzug['umzugPaid2']) value="{{ $umzug['umzugPaid2'] }}" @else value="0.00" @endif>

            <label class="col-form-label" for="l0">Bar Bezahlt</label>
            <input class="form-control"  name="umzugPaid3" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
            @if($umzug && $umzug['umzugPaid3']) value="{{ $umzug['umzugPaid3'] }}" @else value="0.00" @endif>

            <label class="col-form-label" for="l0">Betrag</label>
            <input class="form-control total-piece"  name="umzugTotalPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
            @if($umzug && $umzug['fixedPrice']) value="{{ $umzug['fixedPrice'] }}" @elseif($umzug && $umzug['costPrice']) value="{{ $umzug['fixedPrice'] }}" @else value="0.00" @endif>
        </div>
    </div>
</div>
@section('invoiceOfferUmzug')
{{-- Tarife Fiyatları --}}
<script>        
    function isRequiredUmzug()
    {
        $("input[name=umzugDate]").prop('required',true);      
        $("input[name=umzugHours]").prop('required',true);   
        $("input[name=umzugChf]").prop('required',true);  
        $("input[name=umzugHours]").attr({'min':1}); 
        $("input[name=umzugChf]").attr({'min':1});
    }

    function isNotRequiredUmzug()
    {
        $("input[name=umzugDate]").prop('required',false);      
        $("input[name=umzugHours]").prop('required',false);   
        $("input[name=umzugChf]").prop('required',false);  
        $("input[name=umzugHours]").removeAttr('min'); 
        $("input[name=umzugChf]").removeAttr('min');
        $("input[name=umzugChf2]").removeAttr('min');
        $("input[name=umzugHours2]").removeAttr('min');
    }

    function extraAreaUmzug()
    {
        $(".extraTime-umzug-area").show(300);
        $(".extraTimeUmzug").hide();
        $("input[name=umzugChf2]").attr({'min':1});
        $("input[name=umzugHours2]").attr({'min':1});
    }
    
    var morebutton2 = $("div.umzug-control");
    morebutton2.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".umzug--area").show(700);
            isRequiredUmzug()
            
        }
        else{
            $(".umzug--area").hide(500);
            isNotRequiredUmzug()
        }
    })

    var isFixedbutton = $("div.fixed-price");
    isFixedbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".fixed-price-area").show(700);
        }
        else{
            $(".fixed-price-area").hide(500);
        }
    })

   

    $("body").on("change",".umzug--area", function() {
        let chf = parseInt($("input[name=umzugChf]").val());
        let hours = parseInt($("input[name=umzugHours]").val());

        let chf2 = parseInt($("input[name=umzugChf2]").val());
        let hours2 = parseInt($("input[name=umzugHours2]").val());

        if(chf2 && chf2 > 0)
        {
            chf2 = chf2
        }
        else {
            chf2 = 0;
        }

        if(hours2 && hours2 > 0)
        {
            hours2 = hours2
        }
        else {
            hours2 = 0;
        }

        let umzugRoadChf = parseInt($("input[name=umzugRoadChf]").val());
        let umzugCost = 0;
        let umzugTotalPrice = 0;
        if ($('input[name=masraf]').is(":checked")){
               var extra1 = parseInt($('input[name=extra1]').val());               
            }
            else {
                extra1 = 0;
            }
            if ($('input[name=masraf1]').is(":checked")){
               var extra2 = parseInt($('input[name=extra2]').val());               
            }
            else {
                extra2 = 0;
            }
            if ($('input[name=masraf2]').is(":checked")){
                var extra3 = parseInt($('input[name=extra3]').val());               
            }
            else {
                extra3 = 0;
            }
            if ($('input[name=masraf3]').is(":checked")){
                var extra4 = parseInt($('input[name=extra4]').val());               
            }
            else {
                extra4 = 0;
            }
            if ($('input[name=masraf4]').is(":checked")){
                var extra5 = parseInt($('input[name=extra5]').val());               
            }
            else {
                extra5 = 0;
            }
            if ($('input[name=masraf5]').is(":checked")){
                var extra6 = parseInt($('input[name=extra6]').val());               
            }
            else {
                extra6 = 0;
            }
            if ($('input[name=masraf6]').is(":checked")){
                var extra7 = parseInt($('input[name=extra7]').val());               
            }
            else {
                extra7 = 0;
            }
            if ($('input[name=masraf7]').is(":checked")){
                var extra8 = parseInt($('input[name=extra8]').val());               
            }
            else {
                extra8 = 0;
            }
            if ($('input[name=masraf8]').is(":checked")){
                var extra9 = parseInt($('input[name=extra9]').val());               
            }
            else {
                extra9 = 0;
            }
            if ($('input[name=masraf9]').is(":checked")){
                var extra10 = parseInt($('input[name=extra10]').val());               
            }
            else {
                extra10 = 0;
            }
            if ($('input[name=masraf10]').is(":checked")){
                var extra11 = parseInt($('input[name=extra11]').val());               
            }
            else {
                extra11 = 0;
            }

            let extra12Cost = parseFloat($('input[name=extra12Cost]').val());               
            let extra13Cost = parseFloat($('input[name=extra13Cost]').val()); 
            let umzugDiscount = parseFloat($('input[name=umzugDiscount]').val());
            let umzugDiscount2 = parseFloat($('input[name=umzugDiscount2]').val());
            let umzugExtraDiscount = parseFloat($('input[name=umzugExtraDiscount]').val());
            let umzugExtraDiscount2 = parseFloat($('input[name=umzugExtraDiscount2]').val());

            umzugTotalPrice = parseFloat($('input[name=umzugTotalPrice]').val());

            let umzugPaid1 = parseFloat($('input[name=umzugPaid1]').val());
            let umzugPaid2 = parseFloat($('input[name=umzugPaid2]').val());
            let umzugPaid3 = parseFloat($('input[name=umzugPaid3]').val());

            umzugCost = (hours*chf) + (hours2*chf2) + 
            (umzugRoadChf+extra1+extra2+extra3+extra4+extra5+extra6+extra7+extra8+extra9+extra10+extra11+extra12Cost+extra13Cost)-
            umzugDiscount-umzugDiscount2-umzugExtraDiscount-umzugExtraDiscount2;
            umzugCost = parseFloat(umzugCost);

            $("input[name=umzugCost]").val(umzugCost.toFixed(2))

            if ($('input[name=isUmzugFixedPrice]').is(":checked")){
                let umzugFixedCalc = parseFloat($('input[name=umzugFixedPrice]').val());
                umzugTotalPrice = umzugFixedCalc - umzugPaid1 - umzugPaid2 - umzugPaid3;
                $("input[name=umzugTotalPrice]").val(umzugTotalPrice.toFixed(2));
            }
            else {
                umzugTotalPrice = umzugCost - umzugPaid1 - umzugPaid2 - umzugPaid3;
                $("input[name=umzugTotalPrice]").val(umzugTotalPrice.toFixed(2));
            }

    })
</script>
{{-- İlave ücret Aç/kapa --}}
<script>
    var umzugextracostbutton = $("div.umzug-extra-cost");
    umzugextracostbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".umzug-extra-cost-area").show(700);
        }
        else{
            $(".umzug-extra-cost-area").hide(500);
        }
    })
</script>


@endsection