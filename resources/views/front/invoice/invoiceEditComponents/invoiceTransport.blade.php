<div class="form-group row">
    <div class="col-md-12 transport-control">
        <label for="" class="col-form-label">Transport</label><br>
        <input type="checkbox" name="isTransport" id="isTransport" class="js-switch " data-color="#9c27b0" data-switchery="false"  @if($transport) checked @endif>  
    </div>                            
</div>

<div class="rounded transport--area" style="background-color: #CBB4FF; @if($transport == NULL) display:none; @endif">
    <div class="row p-3">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Optional: Transport-Art Text (kommt in Pdf)</label>
                    <input class="form-control"  name="pdfText"   type="text" @if($transport) value="{{ $transport['pdfText'] }}" @endif>    
                </div>
                <div class="col-md-12">
                    <label class=" col-form-label" for="l0">Datum</label>
                    <input class="form-control" class="date"  name="transportDate"  type="date" @if($transport) value="{{ $transport['transportDate'] }}" @endif> 
                </div>
            </div>
            <div class="row mt-1 p-2 rounded" style="background-color: #8778aa">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Pauschalpreis-Tarif</label>
                    <input class="form-control"  name="transportFixedTariff" placeholder="0"  type="number" 
                    @if($transport) value="{{ $transport['transportFixedTariff'] }}" @else value="0" @endif min="0">    
                </div>
            </div>

            <div class="row " >
                <div class="col-md-12">
                    <label class=" col-form-label" for="l0">Anzahl Std</label>
                    <input class="form-control" class="date"  name="transportHours"  type="number" 
                    @if($transport) value="{{ $transport['transportHours'] }}" @else value="0" @endif>
                </div>

                <div class="col-md-12">
                    <label class=" col-form-label" for="l0">Stundenansatz  [CHF]</label>
                    <input class="form-control" class="date"  name="transportChf"  type="number" 
                    @if($transport) value="{{ $transport['transportChf'] }}" @else value="0" @endif>
                    <a onclick="extraAreaTransport()" class="extraTimeTransport text-primary mt-1" style="cursor: pointer;
                    @if($transport && $transport['transportHours2'] && $transport['transportChf2'] ) display: none; @endif">+ Weitere Zeiteingabe</a>
                </div>
            </div>
            
            <div class="row extraTime-transport-area" 
            @if($transport && $transport['transportHours2'] == NULL  && $transport['transportChf2'] == NULL) style="display: none;" @endif>
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Anzahl Std </label>
                    <input class="form-control" class="time"  name="transportHours2"  type="number" 
                    @if($transport) value="{{ $transport['transportHours2'] }}" @else value="0" @endif> 
                </div>
    
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Stundenansatz  [CHF]</label>
                    <input class="form-control" class="date"  name="transportChf2"  type="number" 
                    @if($transport) value="{{ $transport['transportChf2'] }}" @else value="0" @endif> 
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label class=" col-form-label" for="l0">Anfahrt/Rückfahrt [CHF]</label>
                    <input class="form-control" class="date"  name="transportRoadChf"  type="number" 
                    @if($transport) value="{{ $transport['transportRoadChf'] }}" @else value="0" @endif>   
                </div>
            </div>

            <div class="extra-cost-transport mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="isTransportExtra" id="isTransportExtra" class="js-switch " data-color="#9c27b0" data-switchery="false" 
                @if($transport
                && $transport['extraValue1'] == NULL
                && $transport['extraValue2'] == NULL
                && $transport['extraValue3'] == NULL
                && $transport['extraValue4'] == NULL
                && $transport['extraValue5'] == NULL
                && $transport['extraValue6'] == NULL
                && $transport['extraValue7'] == NULL
                ) 
                unchecked
                @else checked
                @endif>  
            </div>

            <div class="transport--extra--cost--area mt-3" 
            @if($transport
            && $transport['extraValue1'] == NULL
            && $transport['extraValue2'] == NULL
            && $transport['extraValue3'] == NULL
            && $transport['extraValue4'] == NULL
            && $transport['extraValue5'] == NULL
            && $transport['extraValue6'] == NULL
            && $transport['extraValue7'] == NULL
            ) 
            style="display: none;"
            @endif>
                <div class="form-group">
                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportExtra1CostText" placeholder="Freier Text"  type="text" 
                            @if ($transport && $transport['extraValue1']) value="{{ $transport['extraText1'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportExtra1Cost" placeholder="0"  type="number" 
                            @if ($transport && $transport['extraValue1']) value="{{ $transport['extraValue1'] }}" @else value="0" @endif>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportExtra2CostText" placeholder="Freier Text"  type="text" 
                            @if ($transport && $transport['extraValue2']) value="{{ $transport['extraText2'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportExtra2Cost" placeholder="0"  type="number" 
                            @if ($transport && $transport['extraValue2']) value="{{ $transport['extraValue2'] }}" @else value="0" @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportExtra3CostText" placeholder="Freier Text"  type="text" 
                            @if ($transport && $transport['extraValue3']) value="{{ $transport['extraText3'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportExtra3Cost" placeholder="0"  type="number" 
                            @if ($transport && $transport['extraValue3']) value="{{ $transport['extraValue3'] }}" @else value="0" @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportExtra4CostText" placeholder="Freier Text"  type="text" 
                            @if ($transport && $transport['extraValue4']) value="{{ $transport['extraText4'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportExtra4Cost" placeholder="0"  type="number" 
                            @if ($transport && $transport['extraValue4']) value="{{ $transport['extraValue4'] }}" @else value="0" @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportExtra5CostText" placeholder="Freier Text"  type="text" 
                            @if ($transport && $transport['extraValue5']) value="{{ $transport['extraText5'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportExtra5Cost" placeholder="0"  type="number" 
                            @if ($transport && $transport['extraValue5']) value="{{ $transport['extraValue5'] }}" @else value="0" @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportExtra6CostText" placeholder="Freier Text"  type="text" 
                            @if ($transport && $transport['extraValue6']) value="{{ $transport['extraText6'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportExtra6Cost" placeholder="0"  type="number" 
                            @if ($transport && $transport['extraValue6']) value="{{ $transport['extraValue6'] }}" @else value="0" @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportExtra7CostText" placeholder="Freier Text"  type="text" 
                            @if ($transport && $transport['extraValue7']) value="{{ $transport['extraText7'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportExtra7Cost" placeholder="0"  type="number" 
                            @if ($transport && $transport['extraValue7']) value="{{ $transport['extraValue7'] }}" @else value="0" @endif>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            
            <label class="col-form-label" for="l0">Rabatt</label>
            <input class="form-control"  name="transportDiscount" placeholder="0"  type="text" 
            @if($transport && $transport['discount']) value="{{ $transport['discount'] }}" @else value="0.00" @endif> 

            <label class="col-form-label" for="l0">Entgegenkommen</label>
            <input class="form-control"  name="transportDiscount2" placeholder="0"  type="text" 
            @if($transport && $transport['discount2']) value="{{ $transport['discount2'] }}" @else value="0.00" @endif>

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="transportExtraDiscountText" placeholder="Freier Text"  type="text"
                    @if($transport && $transport['extraDiscountValue1']) value="{{ $transport['extraDiscountText1'] }}" @endif>
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="transportExtraDiscount" placeholder="0"  type="text" 
                    @if($transport && $transport['extraDiscountValue1']) value="{{ $transport['extraDiscountValue1'] }}" @else value="0.00" @endif>
                </div>
            </div>
            
            <div class="row mt-1">
                <div class="col-md-7">
                    <input class="form-control"  name="transportExtraDiscountText2" placeholder="Freier Text"  type="text" 
                    @if($transport && $transport['extraDiscountValue2']) value="{{ $transport['extraDiscountText2'] }}" @endif>
                </div>
                <div class="col-md-5">
                    <input class="form-control"  name="transportExtraDiscount2" placeholder="0"  type="text"  
                    @if($transport && $transport['extraDiscountValue2']) value="{{ $transport['extraDiscountValue2'] }}" @else value="0.00" @endif>
                </div>
            </div>

            <label class="col-form-label mt-1 " for="l0">Zwischenbetrag</label>
            <input class="form-control" id="transportCost"  name="transportCost" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
            @if($transport && $transport['transportCost']) value="{{ $transport['transportCost'] }}" @else value="0.00" @endif>
            
            <div class="transport-fixed-price mt-1">
                <label for="" class="col-form-label">Pauschal</label><br>
                <input type="checkbox" name="isTransportFixedPrice" id="isTransportFixedPrice" class="js-switch " data-color="#9c27b0" data-size="small" data-switchery="false" 
                @if($transport && $transport['transportFixedCost']) checked @endif>  
            </div> 

            <div class="transport-fixed-price-area mt-1 mb-1" @if($transport && $transport['transportFixedCost'] == NULL) style="display: none;" @endif>
                <input class="form-control"  name="transportFixedPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
                @if($transport && $transport['transportFixedCost']) value="{{ $transport['transportFixedCost'] }}" @else value="0.00" @endif>
            </div>

            <label class="col-form-label" for="l0">Schadenzahlung</label>
            <input class="form-control"  name="transportPaid1" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
            @if($transport && $transport['transportPaid1']) value="{{ $transport['transportPaid1'] }}" @else value="0.00" @endif>

            <label class="col-form-label" for="l0">Anzahlung</label>
            <input class="form-control"  name="transportPaid2" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
            @if($transport && $transport['transportPaid2']) value="{{ $transport['transportPaid2'] }}" @else value="0.00" @endif>

            <label class="col-form-label" for="l0">Bar Bezahlt</label>
            <input class="form-control"  name="transportPaid3" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
            @if($transport && $transport['transportPaid3']) value="{{ $transport['transportPaid3'] }}" @else value="0.00" @endif>

            <label class="col-form-label" for="l0">Betrag </label>
            <input class="form-control total-piece"  name="transportTotalPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
            @if($transport && $transport['transportTotalPrice']) value="{{ $transport['transportTotalPrice'] }}" @else value="0.00" @endif>
        </div>
    </div>
</div>

@section('invoiceEditFooterTransport')

{{-- Tarife Fiyatları --}}
<script>        


    function isRequiredTransport()
    {
        $("input[name=transportDate]").prop('required',true);  
        $("input[name=transportHours]").prop('required',true);   
        $("input[name=transportChf]").prop('required',true); 
        $("input[name=transportFixedTariff]").prop("required",true);
        $("input[name=transportHours]").attr({'min':1}); 
        $("input[name=transportChf]").attr({'min':1});  
    }

    function isNotRequiredTransport()
    {
        $("input[name=transportDate]").prop('required',false); 
        $("input[name=transportHours]").prop('required',false);   
        $("input[name=transportChf]").prop('required',false);  
        $("input[name=transportFixedTariff]").prop("required",false);
        $("input[name=transportHours]").removeAttr('min'); 
        $("input[name=transportChf]").removeAttr('min');
    }

    $("body").on("change",".reinigung--area",function (){
        let isFixedPrice = parseInt($('input[name=transportFixedTariff]').val());
        if(isFixedPrice != 0){
            $("input[name=transportHours]").prop("required",false);
            $("input[name=transportChf]").prop("required",false);
            $("input[name=transportHours]").removeAttr('min'); 
            $("input[name=transportChf]").removeAttr('min');
        }
        else{
            $("input[name=transportFixedTariff]").prop("required",false);
            $("input[name=transportHours]").prop("required",true);
            $("input[name=transportChf]").prop("required",true);
            $("input[name=transportHours]").removeAttr('min'); 
            $("input[name=transportChf]").removeAttr('min');
        }
    })

    var isTransportFixedbutton = $("div.transport-fixed-price");
    isTransportFixedbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".transport-fixed-price-area").show(700);
        }
        else{
            $(".transport-fixed-price-area").hide(500);
        }
    })

    var morebutton8 = $("div.transport-control");

    morebutton8.click(function() {
            if ($(this).hasClass("checkbox-checked")) {
                $(".transport--area").show(700);
                isRequiredTransport()
            } else {
                $(".transport--area").hide(500);
                isNotRequiredTransport()
            }
        })

    function extraAreaTransport()
    {
        $(".extraTime-transport-area").show(300);
        $(".extraTimeTransport").hide();
        $("input[name=transportChf2]").attr({'min':1});
        $("input[name=transportHours2]").attr({'min':1});
    }
</script>

{{-- İlave ücret Aç/kapa --}}
<script>
    var extracostbutton = $("div.extra-cost-transport");
    extracostbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".transport--extra--cost--area").show(700);
        }
        else{
            $(".transport--extra--cost--area").hide(500);
        }
    })

    $("body").on("change",".transport--area", function() {
        let transportFixedTariff = parseInt($("input[name=transportFixedTariff]").val());

        let transportHours = parseInt($("input[name=transportHours]").val());
        let transportChf = parseInt($("input[name=transportChf]").val());

        let transportHours2 = parseInt($("input[name=transportHours2]").val());
        let transportChf2 = parseInt($("input[name=transportChf2]").val());

        let transportRoadChf = parseInt($("input[name=transportRoadChf]").val());

        let transportCost = 0;
        let transportTotalPrice = 0;

        let transportExtra1Cost = parseFloat($('input[name=transportExtra1Cost]').val());               
        let transportExtra2Cost = parseFloat($('input[name=transportExtra2Cost]').val()); 
        let transportExtra3Cost = parseFloat($('input[name=transportExtra3Cost]').val()); 
        let transportExtra4Cost = parseFloat($('input[name=transportExtra4Cost]').val()); 
        let transportExtra5Cost = parseFloat($('input[name=transportExtra5Cost]').val()); 
        let transportExtra6Cost = parseFloat($('input[name=transportExtra6Cost]').val()); 
        let transportExtra7Cost = parseFloat($('input[name=transportExtra7Cost]').val()); 

        let transportDiscount = parseFloat($('input[name=transportDiscount]').val());
        let transportDiscount2 = parseFloat($('input[name=transportDiscount2]').val());

        let transportExtraDiscount = parseFloat($('input[name=transportExtraDiscount]').val());
        let transportExtraDiscount2 = parseFloat($('input[name=transportExtraDiscount2]').val());

        transportTotalPrice = parseFloat($('input[name=transportTotalPrice]').val());

        let transportPaid1 = parseFloat($('input[name=transportPaid1]').val());
        let transportPaid2 = parseFloat($('input[name=transportPaid2]').val());
        let transportPaid3 = parseFloat($('input[name=transportPaid3]').val());

        if(transportFixedTariff != 0)
        {
            let transportFixedTariffCalc = transportFixedTariff - transportDiscount - transportDiscount2 - transportExtraDiscount - transportExtraDiscount2;
            transportFixedTariffCalc = parseFloat(transportFixedTariffCalc);
            transportFixedTariffCalc = transportFixedTariffCalc.toFixed(2);
            $("input[name=transportCost]").val(transportFixedTariffCalc);

            if ($('input[name=isTransportFixedPrice]').is(":checked")){
                let transportTotalPriceCalc = parseFloat($('input[name=transportFixedPrice]').val());
                transportTotalPrice = transportTotalPriceCalc - transportPaid1 - transportPaid2 - transportPaid3;
                $("input[name=transportTotalPrice]").val(transportTotalPrice.toFixed(2));
            }
            else{
                transportTotalPrice = transportFixedTariffCalc - transportPaid1 - transportPaid2 - transportPaid3;
                $("input[name=transportTotalPrice]").val(transportTotalPrice.toFixed(2));
            }
        }
        else
        {
            transportCostCalc = (transportHours*transportChf) + (transportHours2*transportChf2) + 
            transportRoadChf + transportExtra1Cost + transportExtra2Cost + transportExtra3Cost + 
            transportExtra4Cost + transportExtra5Cost + transportExtra6Cost + transportExtra7Cost - transportDiscount - transportDiscount2 - transportExtraDiscount - transportExtraDiscount2;
            transportCostCalc = parseFloat(transportCostCalc);
            transportCostCalc = transportCostCalc.toFixed(2);
            $("input[name=transportCost]").val(transportCostCalc);

            if ($('input[name=isTransportFixedPrice]').is(":checked")){
                let transportTotalPriceCalc = parseFloat($('input[name=transportFixedPrice]').val());
                transportTotalPrice = transportTotalPriceCalc - transportPaid1 - transportPaid2 - transportPaid3;
                $("input[name=transportTotalPrice]").val(transportTotalPrice.toFixed(2));
            }
            else{
                transportTotalPrice = transportCostCalc - transportPaid1 - transportPaid2 - transportPaid3;
                $("input[name=transportTotalPrice]").val(transportTotalPrice.toFixed(2));
            }
        }
    })
</script>
<script>

</script>

    
@endsection