<div class="form-group row">
    <div class="col-md-12 transport-control">
        <label for="" class="col-form-label">Transport</label><br>
        <input type="checkbox" name="isTransport" id="isTransport" class="js-switch " data-color="#9c27b0" data-switchery="false" >  
    </div>                            
</div>

<div class="rounded transport--area" style="background-color: #CBB4FF;display:none;">
    <div class="row p-3">
        <div class="col-md-6">

            <div class="row">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Optional: Transport-Art Text (kommt in Pdf)</label>
                    <input class="form-control"  name="pdfText"   type="text" >    
                </div>
            </div>
            <div class="row p-2 mt-1 rounded" style="background-color: #8778aa">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Pauschalpreis-Tarif</label>
                    <input class="form-control"  name="transportFixedTariff" placeholder="0"  type="number" >    
                </div>
            </div>
            <small class="text-primary"><i>Entweder "Pauschalpreis-Tarif" oder "Stundenansatz-Tarif" ausfüllen. Falls Pauschalpreis-Tarif gefüllt ist, wird dieser genommen.</i></small><br>

            <label class=" col-form-label" for="l0">Tarif</label>
            <select class="form-control" class="transportTariff" name="transportTariff" id="transportTariff" >
                <option data-selection="bos" value>Bitte wählen</option>
                @foreach (\App\Models\Tariff::getList(4) as $key=>$value )
                    <option data-selection="0" data-ma="{{ $value['ma'] }}" data-lkw="{{ $value['lkw'] }}" data-an="{{ $value['anhanger'] }}" data-chf ="{{ $value['chf'] }}" value="{{ $value['id'] }}">{{ $value['description'] }}</option>
                @endforeach
            </select>

            <div class="row transport-tariffs--area p-2 mt-1 rounded" style="display: none;background-color: #8778aa;">
                <div class="col">
                    <label class=" col-form-label" for="l0">MA</label>
                    <input class="form-control"  name="transportma" placeholder="0"  type="number" >                                
                </div>

                <div class="col">
                    <label class=" col-form-label" for="l0">LKW</label>
                    <input class="form-control"  name="transportlkw" placeholder="0"  type="number" >                                
                </div>

                <div class="col">
                    <label class=" col-form-label" for="l0">Anhänger</label>
                    <input class="form-control"  name="transportanhanger" placeholder="0"  type="number" >                                
                </div>

                <div class="col">
                    <label class=" col-form-label" for="l0">CHF-Ansatz</label>
                    <input class="form-control"  name="transportchf" placeholder="0"  type="number" >                                
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label class=" col-form-label" for="l0">Dauer [h]</label>
                    <input class="form-control"  name="transporthour" placeholder="4-5"  type="text" > 
                </div>
            </div>
            
            <label class=" col-form-label" for="l0">Transporttermin</label>
            <input class="form-control" class="date"  name="transportDate"  type="date" > 

            <label class=" col-form-label" for="l0">Arbeitsbeginn</label>
            <input class="form-control" class="time"  name="transportTime"  type="time" > 

            <label class=" col-form-label" for="l0">Anfahrt/Rückfahrt [CHF]</label>
            <input class="form-control" class="date"  name="transportRoadChf"  type="number" value="0"> 

        </div>
        <div class="col-md-6">
            <div class="extra-cost-transport mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="transportisExtra" id="transportisExtra" class="js-switch " data-color="#9c27b0" data-switchery="false" checked>  
            </div>  

            <div class="transport--extra--cost--area mt-3" style="display: block;">

                <div class="form-group">
                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportCostText1" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportCost1" placeholder="0"  type="number" value="0">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportCostText2" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportCost2" placeholder="0"  type="number" value="0">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportCostText3" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportCost3" placeholder="0"  type="number" value="0">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportCostText4" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportCost4" placeholder="0"  type="number" value="0">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportCostText5" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportCost5" placeholder="0"  type="number" value="0">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportCostText6" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportCost6" placeholder="0"  type="number" value="0">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportCostText7" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportCost7" placeholder="0"  type="number" value="0">
                        </div>
                    </div>
                </div>
            </div>
            
            <label class="col-form-label mt-1 " for="l0">Kosten</label>
            <input class="form-control" id="transportCost"  name="transportCost" placeholder="0"  type="text" style="background-color: #8778aa;color:white;"> 

            <label class="col-form-label" for="l0">Rabatt</label>
            <input class="form-control"  name="transportDiscount" placeholder="0"  type="number" value="0"> 

            <label class="col-form-label" for="l0">Rabatt[%]</label>
            <input class="form-control"  name="transportDiscountPercent" placeholder="0"  type="number" value="0"> 

            <label class="col-form-label" for="l0">Entgegenkommen</label>
            <input class="form-control"  name="transportCompromiser" placeholder="0"  type="number" value="0">

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="transportExtraDiscountText" placeholder="Freier Text"  type="text" >
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="transportExtraDiscount" placeholder="0"  type="number" value="0">
                </div>
            </div>

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="transportExtraDiscountText2" placeholder="Freier Text"  type="text" >
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="transportExtraDiscount2" placeholder="0"  type="number" >
                </div>
            </div>

            <label class="col-form-label" for="l0">Geschätzte Kosten</label>
            <input class="form-control"  name="transportDefaultPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;">

            <div class="mt-2 isTransportKostendach">
                <label class="col-form-label" for="l0">Kostendach</label>
                <input type="checkbox"  name="isTransportKostendach" id="isTransportKostendach" class="js-switch mt-1" data-color="#9c27b0" data-size="small" data-switchery="false" >
            </div>

            <div class="transport-kostendach-area" style="display: none;">
                <input class="form-control"  name="transportTopPrice" placeholder="0"  type="number" style="background-color: #8778aa;color:white;">

                <div class="mt-2">
                    <small class=" text-primary">manuell gesetzt</small>
                    <input type="checkbox" name="isTransportMTPrice" id="isTransportMTPrice" class="js-switch mt-1" data-color="#9c27b0" data-size="small" data-switchery="false" >
                </div>
            </div>

            <div class="mt-3 isTransportPauschal">
                <label class="col-form-label" for="l0">Pauschal</label>
                <input type="checkbox"  name="isTransportPauschal" id="isTransportPauschal" class="js-switch mt-1" data-color="#9c27b0" data-size="small" data-switchery="false" >
            </div>

            <div class="transport-pauschal-area " style="display:none;">
                <input class="form-control"  name="transportFixedPrice" placeholder="0"  type="number" style="background-color: #8778aa;color:white;">

                <div class="mt-2">
                    <small class=" text-primary">manuell gesetzt</small>
                    <input type="checkbox" name="isTransportFxPrice" id="isTransportFxPrice" class="js-switch mt-1" data-color="#9c27b0" data-size="small" data-switchery="false" >
                </div>
            </div>
        </div>
    </div>
</div>
@section('offerFooterTransport')

{{-- Tarife Fiyatları --}}
<script>        
   var morebutton8 = $("div.transport-control");
    morebutton8.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".transport--area").show(700);
            $("input[name=transportFixedTariff]").prop('required',true);      
            $("select[name=transportTariff]").prop('required',true); 
            $("input[name=transporthour]").prop('required',true); 
            $("input[name=transportma]").prop('required',true); 
            $("input[name=transportlkw]").prop('required',true); 
            $("input[name=transportanhanger]").prop('required',true); 
            $("input[name=transportchf]").prop('required',true); 
        }
        else{
            $(".transport--area").hide(500);
            $("input[name=transportFixedTariff]").prop('required',false);      
            $("select[name=transportTariff]").prop('required',false); 
            $("input[name=transporthour]").prop('required',false); 
            $("input[name=transportma]").prop('required',false); 
            $("input[name=transportlkw]").prop('required',false); 
            $("input[name=transportanhanger]").prop('required',false); 
            $("input[name=transportchf]").prop('required',false); 
        }
    })

    $("select[name=transportTariff]").on("change",function () {
        let chf = $(this).find(":selected").data("chf");
        let ma = $(this).find(":selected").data("ma");
        let lkw = $(this).find(":selected").data("lkw");
        let anhanger = $(this).find(":selected").data("an");
        let control = $(this).find(":selected").data('selection');

        if (control != 'bos')
        {
        $('.transport-tariffs--area').show(300)
        $("input[name=transportFixedTariff]").prop("required",false);
        }
        else{
            $('input[name=transportchf]').val(0);
            $('input[name=transportma]').val(0);
            $('input[name=transportlkw]').val(0);
            $('input[name=transportanhanger]').val(0);
            $('.transport-tariffs--area').hide(300)
        }

        $('input[name=transportchf]').val(chf);
        $('input[name=transportma]').val(ma);
        $('input[name=transportlkw]').val(lkw);
        $('input[name=transportanhanger]').val(anhanger);
    })
    $("input[name=transportFixedTariff]").on("change",function (){
        if($("input[name=transportFixedTariff]").val())
        {
            $("select[name=transportTariff]").prop('required',false); 
            $("input[name=transportma]").prop('required',false); 
            $("input[name=transportlkw]").prop('required',false); 
            $("input[name=transportanhanger]").prop('required',false); 
            $("input[name=transportchf]").prop('required',false); 
        }
    })

    var isTransportKostendachButton = $("div.isTransportKostendach");
    var isTransportPauschalbutton = $("div.isTransportPauschal");
    isTransportKostendachButton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".transport-kostendach-area").show(700);
        }
        else{
            $(".transport-kostendach-area").hide(500);
        }
    })

    isTransportPauschalbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".transport-pauschal-area").show(700);
        }
        else{
            $(".transport-pauschal-area").hide(500);
        }
    })

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
</script>

<script>
    $(document).ready(function(){
        transportCost = 0;
        var transportTopPrice = 0;
        var transportDefaultPrice = 0;
        $("body").on("change",".transport--area",function(){            
            var roadchf = parseFloat($('input[name=transportRoadChf]').val());
            var chf = parseFloat($('input[name=transportchf]').val());
            var Hours = $('input[name=transporthour]').val();
            let allHours = Hours.split("-");
            let leftHour = parseFloat(allHours[0]);
            let rightHour = parseFloat(allHours[1]);

            var transportFixedTariff = $('input[name=transportFixedTariff]').val();
            var extra1 = parseFloat($('input[name=transportCost1]').val())
            var extra2 = parseFloat($('input[name=transportCost2]').val())
            var extra3 = parseFloat($('input[name=transportCost3]').val())
            var extra4 = parseFloat($('input[name=transportCost4]').val())
            var extra5 = parseFloat($('input[name=transportCost5]').val())
            var extra6 = parseFloat($('input[name=transportCost6]').val())
            var extra7 = parseFloat($('input[name=transportCost7]').val())

            transportCostLeft = chf * leftHour + roadchf + extra1 + extra2 + extra3 + extra4 + extra5 + extra6 + extra7;
            transportCostRight = chf * rightHour + roadchf + extra1 + extra2 + extra3 + extra4 + extra5 + extra6 + extra7;

            if(transportFixedTariff == 0)
            {
                if(rightHour){
                $('input[name=transportCost]').val(transportCostRight)
                }
                if(leftHour){
                    $('input[name=transportCost]').val(transportCostLeft)
                }
                if(leftHour && rightHour ){
                    $('input[name=transportCost]').val(transportCostLeft+'-'+transportCostRight) 
                }
                if(leftHour == null && rightHour == null)
                {
                    $('input[name=transportCost]').val('')
                }
            }
            else {
                $('input[name=transportCost]').val(transportFixedTariff)
            }
           console.log(leftHour,rightHour,roadchf,chf,extra1,extra2,extra3,extra4,extra5,extra6,extra7)
        })  
        $("body").on("change",".transport--area",function(){      
            var transportFixedTariff = $('input[name=transportFixedTariff]').val();
            var discount = $('input[name=transportDiscount]').val();
            var discountPercent = $('input[name=transportDiscountPercent]').val();
            var compromiser = $('input[name=transportCompromiser]').val();
            var extraDiscount = $('input[name=transportExtraDiscount]').val();
            var extraDiscount2 = $('input[name=transportExtraDiscount2]').val();
            var Hours = $('input[name=transporthour]').val();
            let allHours = Hours.split("-");
            let leftHour = parseFloat(allHours[0]);
            let rightHour = parseFloat(allHours[1]);

            transportDefaultPriceLeft = transportCostLeft - discount - (transportCostLeft*discountPercent/100) - compromiser - extraDiscount - extraDiscount2;
            transportDefaultPriceRight = transportCostRight - discount - (transportCostLeft*discountPercent/100) - compromiser - extraDiscount - extraDiscount2;

            if(transportFixedTariff == 0)
            {
                if(rightHour){
                $('input[name=transportDefaultPrice]').val(transportDefaultPriceRight)
                }
                if(leftHour){
                    $('input[name=transportDefaultPrice]').val(transportDefaultPriceLeft)
                }
                if(leftHour && rightHour ){
                    $('input[name=transportDefaultPrice]').val(transportDefaultPriceLeft+'-'+transportDefaultPriceRight) 
                }
                if(leftHour == null && rightHour == null)
                {
                    $('input[name=transportDefaultPrice]').val('')
                }
            }
            else{
                $('input[name=transportDefaultPrice]').val(transportFixedTariff);
            }
            
        })
        $("body").on("change",".transport--area",function(){      
            var chf = $('input[name=transportchf]').val();
            var Hours = $('input[name=transporthour]').val();

            let transportTotalPrices = $('input[name=transportDefaultPrice]').val();
            transportTotalPricesARR = transportTotalPrices.split("-");
            let transportTotalPrice = 0;
            
            leftTotal = parseFloat(transportTotalPricesARR[0]);
            rightTotal = parseFloat(transportTotalPricesARR[1]);
            if(leftTotal >= rightTotal)
            {
                transportTotalPrice = leftTotal;
            }
            else if(rightTotal >= leftTotal)
            {
                transportTotalPrice = rightTotal;
            }
            else{
                transportTotalPrice = parseFloat($('input[name=transportDefaultPrice]').val());
            }
            if($('input[name=isTransportMTPrice]').is(":checked"))
            {
                $('input[name=transportTopPrice]').val();
            }
            else{
                transportTopPrice = transportTotalPrice + parseFloat(chf);
                $('input[name=transportTopPrice]').val(transportTopPrice);
            }

            if($('input[name=isTransportFxPrice]').is(":checked"))
            {
                $('input[name=transportFixedPrice]').val();
            }
            else{
                transportFixedPrice = transportTotalPrice + parseFloat(chf);
                $('input[name=transportFixedPrice]').val(transportFixedPrice);
            }
        })  
    })
</script>

    
@endsection