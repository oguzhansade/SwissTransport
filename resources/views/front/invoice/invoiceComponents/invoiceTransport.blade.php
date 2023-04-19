<div class="form-group row">
    <div class="col-md-12 transport-control">
        <label for="" class="col-form-label">Transport</label><br>
        <input type="checkbox" name="isTransport" id="isTransport" class="js-switch " data-color="#9c27b0" data-switchery="false" >  
    </div>                            
</div>

<div class="rounded transport--area" style="background-color: #CBB4FF; display:none;">
    <div class="row p-3">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Optional: Transport-Art Text (kommt in Pdf)</label>
                    <input class="form-control"  name="pdfText"   type="text" >    
                </div>
                <div class="col-md-12">
                    <label class=" col-form-label" for="l0">Datum</label>
                    <input class="form-control" class="date"  name="transportDate"  type="date" > 
                </div>
            </div>
            <div class="row mt-1 p-2 rounded" style="background-color: #8778aa">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Pauschalpreis-Tarif</label>
                    <input class="form-control"  name="transportFixedTariff" placeholder="0"  type="number" value="0" min="0">    
                </div>
            </div>

            <div class="row " >
                <div class="col-md-12">
                    <label class=" col-form-label" for="l0">Anzahl Std</label>
                    <input class="form-control" class="date"  name="transportHours"  type="number" value="0">
                </div>

                <div class="col-md-12">
                    <label class=" col-form-label" for="l0">Stundenansatz [CHF]</label>
                    <input class="form-control" class="date"  name="transportChf"  type="number" value="0">
                    <a onclick="extraAreaTransport()" class="extraTimeTransport text-primary mt-1" style="cursor: pointer;">+ Weitere Zeiteingabe</a>
                </div>
            </div>
            
            <div class="row extraTime-transport-area" style="display: none;">
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Anzahl Std</label>
                    <input class="form-control" class="time"  name="transportHours2"  type="number" value="0"> 
                </div>
    
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Stundenansatz [CHF]</label>
                    <input class="form-control" class="date"  name="transportChf2"  type="number" value="0"> 
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label class=" col-form-label" for="l0">Anfahrt/Rückfahrt [CHF]</label>
                    <input class="form-control" class="date"  name="transportRoadChf"  type="number" value="0">   
                </div>
            </div>

            <div class="extra-cost-transport mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="isTransportExtra" id="isTransportExtra" class="js-switch " data-color="#9c27b0" data-switchery="false" >  
            </div>

            <div class="transport--extra--cost--area mt-3" style="display: none;">
                <div class="form-group">
                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportExtra1CostText" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportExtra1Cost" placeholder="0"  type="number" value="0">
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportExtra2CostText" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportExtra2Cost" placeholder="0"  type="number" value="0">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportExtra3CostText" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportExtra3Cost" placeholder="0"  type="number" value="0">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportExtra4CostText" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportExtra4Cost" placeholder="0"  type="number" value="0">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportExtra5CostText" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportExtra5Cost" placeholder="0"  type="number" value="0">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportExtra6CostText" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportExtra6Cost" placeholder="0"  type="number" value="0">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportExtra7CostText" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportExtra7Cost" placeholder="0"  type="number" value="0">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            
            <label class="col-form-label" for="l0">Rabatt</label>
            <input class="form-control"  name="transportDiscount" placeholder="0"  type="text" value="0.00"> 

            <label class="col-form-label" for="l0">Rabatt[%]</label>
            <input class="form-control"  name="transportDiscountPercent" placeholder="0"  type="text" value="0.00"> 

            <label class="col-form-label" for="l0">Entgegenkommen</label>
            <input class="form-control"  name="transportDiscount2" placeholder="0"  type="text" value="0.00">

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="transportExtraDiscountText" placeholder="Freier Text"  type="text">
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="transportExtraDiscount" placeholder="0"  type="text" value="0.00">
                </div>
            </div>
            
            <div class="row mt-1">
                <div class="col-md-7">
                    <input class="form-control"  name="transportExtraDiscountText2" placeholder="Freier Text"  type="text" >
                </div>
                <div class="col-md-5">
                    <input class="form-control"  name="transportExtraDiscount2" placeholder="0"  type="text"  value="0.00">
                </div>
            </div>

            <label class="col-form-label mt-1 " for="l0">Zwischenbetrag</label>
            <input class="form-control" id="transportCost"  name="transportCost" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">
            
            <div class="transport-fixed-price mt-1">
                <label for="" class="col-form-label">Pauschal</label><br>
                <input type="checkbox" name="isTransportFixedPrice" id="isTransportFixedPrice" class="js-switch " data-color="#9c27b0" data-size="small" data-switchery="false" >  
            </div> 

            <div class="transport-fixed-price-area mt-1 mb-1" style="display: none;">
                <input class="form-control"  name="transportFixedPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">
            </div>

            <label class="col-form-label" for="l0">Schadenzahlung</label>
            <input class="form-control"  name="transportPaid1" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">

            <label class="col-form-label" for="l0">Anzahlung</label>
            <input class="form-control"  name="transportPaid2" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">

            <label class="col-form-label" for="l0"> Bar Bezahlt</label>
            <input class="form-control"  name="transportPaid3" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">

            <label class="col-form-label" for="l0">Betrag </label>
            <input class="form-control total-piece"  name="transportTotalPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">
        </div>
    </div>
</div>

@section('invoiceFooterTransport')

{{-- Tarife Fiyatları --}}
<script>        

    $(document).ready(function() {
        transportInvoiceCalc()
        if($("div.transport--area").is(":visible"))
        {
            isRequiredTransport()
        }
    })
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

    $("body").on("change",".transport--area",function (){
        let isFixedPrice = parseInt($('input[name=transportFixedTariff]').val());
        if(isFixedPrice && isFixedPrice != 0){
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
        transportInvoiceCalc()
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

    function transportInvoiceCalc() {
            const transportChf = parseInt($("input[name=transportChf]").val()) || 0;
            const transportHours = parseInt($("input[name=transportHours]").val()) || 0;
            const transportChf2 = parseInt($("input[name=transportChf2]").val()) || 0;
            const transportHours2 = parseInt($("input[name=transportHours2]").val()) || 0;
            const transportRoadChf = parseInt($("input[name=transportRoadChf]").val()) || 0;
            const transportDiscountPercent = parseInt($("input[name=transportDiscountPercent]").val()) || 0;

            const transportExtras = [
                {name: 'transportExtra1Cost'},
                {name: 'transportExtra2Cost'},
                {name: 'transportExtra3Cost'},
                {name: 'transportExtra4Cost'},
                {name: 'transportExtra5Cost'},
                {name: 'transportExtra6Cost'},
                {name: 'transportExtra7Cost'},
            ];
            let transportExtrasTotal = 0;
            for (const transportExtra of transportExtras) {
                const value = parseInt($(`input[name=${transportExtra.name}]`).val()) || 0;
                transportExtrasTotal += isNaN(value) ? 0 : value;
            }

            const transportDiscount = parseFloat($('input[name=transportDiscount]').val()) || 0 ;
            const transportDiscount2 = parseFloat($('input[name=transportDiscount2]').val()) || 0;
            const transportExtraDiscount = parseFloat($('input[name=transportExtraDiscount]').val()) || 0;
            const transportExtraDiscount2 = parseFloat($('input[name=transportExtraDiscount2]').val()) || 0;

            const transportPaid1 = parseFloat($('input[name=transportPaid1]').val()) || 0;
            const transportPaid2 = parseFloat($('input[name=transportPaid2]').val()) || 0;
            const transportPaid3 = parseFloat($('input[name=transportPaid3]').val()) || 0;
            
            const transportFixedPrice = parseFloat($('input[name=transportFixedTariff]').val()) || 0;

            if(transportFixedPrice > 0) {
                $("input[name=transportCost]").val(transportFixedPrice);
                transportTotalPrice = transportFixedPrice;
            }
            else {
                const transportPreCost = (transportHours * transportChf)  + (transportHours2 * transportChf2) +
                (transportRoadChf + transportExtrasTotal );

                const transportCost = (transportHours * transportChf) +  (transportHours2 * transportChf2) +
                (transportRoadChf + transportExtrasTotal ) - transportDiscount - (transportPreCost*transportDiscountPercent/100) -
                 transportDiscount2 - transportExtraDiscount - transportExtraDiscount2;
           
                $("input[name=transportCost]").val(transportCost);
                transportTotalPrice = transportCost;
            }
            
            transportTotalPrice -= transportPaid1 + transportPaid2 + transportPaid3;
            transportTotalPrice = parseFloat(transportTotalPrice);
            $("input[name=transportTotalPrice]").val(transportTotalPrice.toFixed(2));
            console.log(transportPaid1, transportPaid2 , transportPaid3)
    }

</script>
@endsection