<div class="form-group row">
    <div class="col-md-12 auspack-control">
        <label for="" class="col-form-label">Auspack</label><br>
        <input type="checkbox" name="isAuspack" id="isAuspack" class="js-switch " data-color="#9c27b0" data-switchery="false" >  
    </div>                            
</div>

<div class="rounded auspack--area" style="background-color: #CBB4FF; display:none;">
    <div class="row p-3">
        <div class="col-md-6">
            <label class=" col-form-label" for="l0">Datum</label>
            <input class="form-control" class="date"  name="auspackDate"  type="date" > 

            <div class="row">
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Anzahl Std </label>
                    <input class="form-control" class="time"  name="auspackHours"  type="number" value="0"> 
                    <a onclick="extraAreaAuspack()" class="extraTimeAuspack text-primary" style="cursor: pointer;">+ Weitere Zeiteingabe</a>
                </div>
    
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Ansatz [CHF]</label>
                    <input class="form-control" class="date"  name="auspackChf"  type="number" value="0"> 
                </div>
            </div>

            <div class="row extraTime-auspack-area" style="display: none;">
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Anzahl Std </label>
                    <input class="form-control" class="time"  name="auspackHours2"  type="number" value="0"> 
                </div>
    
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Ansatz [CHF]</label>
                    <input class="form-control" class="date"  name="auspackChf2"  type="number" value="0"> 
                </div>
            </div>

            <label class=" col-form-label" for="l0">Anfahrt/Rückfahrt [CHF]</label>
            <input class="form-control" class="date"  name="auspackRoadChf"  type="number" value="0"> 

            <div class="auspack-extra-cost mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="isAuspackExtra" id="isAuspackExtra" class="js-switch " data-color="#9c27b0" data-switchery="false" >  
            </div>  

            <div class="auspack-extra-cost-area" style="display: none;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="auspackMasraf"> <span class="label-text text-dark"><strong>Spesen</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="auspackExtra1" type="number" value="10">
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="auspackMasraf1"> <span class="label-text text-dark"><strong>Verpackungsmaterial</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="auspackExtra2" type="number" value="0">
                        </div>
                    </div>  

                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="auspackExtra1CostText" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="auspackExtra1Cost" placeholder="0"  type="text" value="0.00">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="auspackExtra2CostText" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="auspackExtra2Cost" placeholder="0"  type="text" value="0.00">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Rabatt</label>
            <input class="form-control"  name="auspackDiscount" placeholder="0"  type="text" value="0.00"> 

            <label class="col-form-label" for="l0">Entgegenkommen</label>
            <input class="form-control"  name="auspackDiscount2" placeholder="0"  type="text" value="0.00">

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="auspackExtraDiscountText" placeholder="Freier Text"  type="text">
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="auspackExtraDiscount" placeholder="0"  type="text" value="0.00">
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-md-7">
                    <input class="form-control"  name="auspackExtraDiscountText2" placeholder="Freier Text"  type="text" >
                </div>
                <div class="col-md-5">
                    <input class="form-control"  name="auspackExtraDiscount2" placeholder="0"  type="text"  value="0.00">
                </div>
            </div>
            
            <label class="col-form-label mt-1 " for="l0">Zwischenbetrag</label>
            <input class="form-control" id="auspackCost"  name="auspackCost" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00"> 

            <div class="auspack-fixed-price mt-1">
                <label for="" class="col-form-label">Pauschal</label><br>
                <input type="checkbox" name="isAuspackFixedPrice" id="isAuspackFixedPrice" class="js-switch " data-color="#9c27b0" data-size="small" data-switchery="false" >  
            </div> 

            <div class="auspack-fixed-price-area mt-1 mb-1" style="display: none;">
                <input class="form-control"  name="auspackFixedPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">
            </div>

            <label class="col-form-label" for="l0">Schadenzahlung</label>
            <input class="form-control"  name="auspackPaid1" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">

            <label class="col-form-label" for="l0">Anzahlung</label>
            <input class="form-control"  name="auspackPaid2" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">

            <label class="col-form-label" for="l0">Bar Bezahlt</label>
            <input class="form-control"  name="auspackPaid3" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">

            <label class="col-form-label" for="l0">Betrag </label>
            <input class="form-control total-piece"  name="auspackTotalPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">
        </div>
    </div>
</div>
@section('invoiceFooter3')

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

    $("body").on("change",".auspack--area", function() {
        let auspackChf = parseInt($("input[name=auspackChf]").val());
        let auspackHours = parseInt($("input[name=auspackHours]").val());

        let auspackChf2 = parseInt($("input[name=auspackChf2]").val());
        let auspackHours2 = parseInt($("input[name=auspackHours2]").val());

        let auspackRoadChf = parseInt($("input[name=auspackRoadChf]").val());
        let auspackCost = 0;
        let auspackTotalPrice = 0;
        if ($('input[name=auspackMasraf]').is(":checked")){
            var extra1 = parseInt($('input[name=auspackExtra1]').val());               
            }
            else {
                extra1 = 0;
            }
            if ($('input[name=auspackMasraf1]').is(":checked")){
               var extra2 = parseInt($('input[name=auspackExtra2]').val());               
            }
            else {
                extra2 = 0;
            }
        
            

            let auspackExtra1Cost = parseFloat($('input[name=auspackExtra1Cost]').val());               
            let auspackExtra2Cost = parseFloat($('input[name=auspackExtra2Cost]').val()); 

            let auspackDiscount = parseFloat($('input[name=auspackDiscount]').val());
            let auspackDiscount2 = parseFloat($('input[name=auspackDiscount2]').val());
            
            let auspackExtraDiscount = parseFloat($('input[name=auspackExtraDiscount]').val());
            let auspackExtraDiscount2 = parseFloat($('input[name=auspackExtraDiscount2]').val());

            auspackTotalPrice = parseFloat($('input[name=auspackTotalPrice]').val());

            let auspackPaid1 = parseFloat($('input[name=auspackPaid1]').val());
            let auspackPaid2 = parseFloat($('input[name=auspackPaid2]').val());
            let auspackPaid3 = parseFloat($('input[name=auspackPaid3]').val());

            auspackCost = (auspackHours*auspackChf) + (auspackHours2*auspackChf2) + 
            (auspackRoadChf+auspackExtra1Cost+auspackExtra2Cost+extra1+extra2)-
            auspackDiscount-auspackDiscount2-auspackExtraDiscount-auspackExtraDiscount2;
            auspackCost = parseFloat(auspackCost);

            $("input[name=auspackCost]").val(auspackCost.toFixed(2))

            if ($('input[name=isAuspackFixedPrice]').is(":checked")){
                let auspackFixedCalc = parseFloat($('input[name=auspackFixedPrice]').val());
                auspackTotalPrice = auspackFixedCalc - auspackPaid1 - auspackPaid2 - auspackPaid3;
                $("input[name=auspackTotalPrice]").val(auspackTotalPrice.toFixed(2));
            }
            else {
                auspackTotalPrice = auspackCost - auspackPaid1 - auspackPaid2 - auspackPaid3;
                $("input[name=auspackTotalPrice]").val(auspackTotalPrice.toFixed(2));
            }

    })
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