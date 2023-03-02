<div class="row p-3">
    <div class="col-md-6">
        <label class=" col-form-label" for="l0">Tarif</label>
        <select class="form-control" class="einpackTariff" name="einpackTariff" id="einpackTariff" >
            <option data-selection="bos"  value>Bitte wählen</option>
            @foreach (\App\Models\Tariff::getList(6) as $key=>$value )
            <option data-selection="0" data-ma="{{ $value['ma'] }}" data-lkw="{{ $value['lkw'] }}" data-an="{{ $value['anhanger'] }}" data-chf ="{{ $value['chf'] }}" value="{{ $value['id'] }}">{{ $value['description'] }}</option>
            @endforeach
        </select>

        <div class="row einpack-tariffs--area" style="display: none;">
            <div class="col">
                <label class=" col-form-label" for="l0">MA</label>
                <input class="form-control"  name="einpack1ma" placeholder="0"  type="number" >                                
            </div>
            <div class="col">
                <label class=" col-form-label" for="l0">CHF-Ansatz</label>
                <input class="form-control"  name="einpack1chf" placeholder="0"  type="number" >                                
            </div>
        </div>
        
        <label class=" col-form-label" for="l0">Packtermin</label>
        <input class="form-control" class="date"  name="einpackdate"  type="date" > 

        <label class=" col-form-label" for="l0">Arbeitsbeginn</label>
        <input class="form-control" class="time"  name="einpacktime"  type="time" > 

        <label class=" col-form-label" for="l0">Anfahrt/Rückfahrt [CHF]</label>
        <input class="form-control" class="date"  name="einpackroadChf"  type="number" value="0"> 

    </div>
    <div class="col-md-6">
        <label class="col-form-label" for="l0">Dauer [h]</label>
        <input class="form-control"  name="einpackHours" placeholder="4-5"  type="text" >  
        
        <div class="extra-cost-einpack mt-1">
            <label for="" class="col-form-label">Zusatzkosten</label><br>
            <input type="checkbox" name="einpackisExtra" id="einpackisExtra" class="js-switch " data-color="#9c27b0" data-switchery="false" checked>  
        </div>  

        <div class="einpack--extra--cost--area" style="display: block;">

            <div class="form-group">
                <div class="row">
                    <div class="col-md-7">
                        <div class="checkbox checkbox-rounded checkbox-color-scheme">
                            <label class="checkbox">
                                <input type="checkbox" name="einpackmasraf" checked> <span class="label-text text-dark"><strong>Spesen</strong></span>                       
                            </label>                   
                        </div>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" name="einpackextra1" type="number" value="10">
                    </div>
                </div> 
                
                <div class="row">
                    <div class="col-md-7">
                        <div class="checkbox checkbox-rounded checkbox-color-scheme">
                            <label class="checkbox">
                                <input type="checkbox" name="einpackmasraf1"> <span class="label-text text-dark"><strong>Verpackungsmaterial</strong></span>                       
                            </label>                   
                        </div>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" name="einpackextra2" type="number" value="250">
                    </div>
                </div>  
  
                <div class="row ">
                    <div class="col-md-7">
                        <input class="form-control"  name="einpackCostText1" placeholder="Freier Text"  type="text" >
                    </div>
                    <div class="col-md-5">
                        <input class="form-control"  name="einpackCost1" placeholder="0"  type="number" value="0">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-7">
                        <input class="form-control"  name="einpackCostText2" placeholder="Freier Text"  type="text" >
                    </div>
                    <div class="col-md-5">
                        <input class="form-control"  name="einpackCost2" placeholder="0"  type="number" value="0">
                    </div>
                </div>
            </div>

            
                        
        </div>
        
        <label class="col-form-label mt-1 " for="l0">Kosten</label>
        <input class="form-control" id="einpackCost"  name="einpackCost" placeholder="0"  type="text" style="background-color: #8778aa;color:white;"> 

        <label class="col-form-label" for="l0">Rabatt</label>
        <input class="form-control"  name="einpackDiscount" placeholder="0"  type="number" > 

        <label class="col-form-label" for="l0">Rabatt[%]</label>
        <input class="form-control"  name="einpackDiscountPercent" placeholder="0"  type="number" >

        <label class="col-form-label" for="l0">Entgegenkommen</label>
        <input class="form-control"  name="einpackCompromiser" placeholder="0"  type="number" >

        <div class="row ">
            <div class="col-md-7">
                <label class="col-form-label" for="l0">Weitere Abzüge</label>
                <input class="form-control"  name="einpackExtraDiscountText" placeholder="Freier Text"  type="text" >
            </div>
            <div class="col-md-5">
                <label class="col-form-label" for="l0">Weitere Abzüge</label>
                <input class="form-control"  name="einpackExtraDiscount" placeholder="0"  type="number" >
            </div>
        </div>

        <label class="col-form-label" for="l0">Geschätzte Kosten</label>
        <input class="form-control"  name="einpackTotalPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;">

        <div class="mt-2 isEinpackKostendach">
            <label class="col-form-label" for="l0">Kostendach</label>
            <input type="checkbox"  name="isEinpackKostendach" id="isEinpackKostendach" class="js-switch mt-1" data-color="#9c27b0" data-size="small" data-switchery="false" >
        </div>

        <div class="einpack-kostendach-area" style="display: none;">
            <input class="form-control"  name="einpackTopPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;">

            <div class="mt-2">
                <small class=" text-primary">manuell gesetzt</small>
                <input type="checkbox" name="isEinpackMTPrice" id="isEinpackMTPrice" class="js-switch mt-1" data-color="#9c27b0" data-size="small" data-switchery="false" >
            </div>
        </div>

        <div class="mt-3 isEinpackPauschal">
            <label class="col-form-label" for="l0">Pauschal</label>
            <input type="checkbox"  name="isEinpackPauschal" id="isEinpackPauschal" class="js-switch mt-1" data-color="#9c27b0" data-size="small" data-switchery="false" >
        </div>

        <div class="einpack-pauschal-area " style="display:none;">
            <input class="form-control"  name="einpackDefaultPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;">

            <div class="mt-2">
                <small class=" text-primary">manuell gesetzt</small>
                <input type="checkbox" name="isEinpackFxPrice" id="isEinpackFxPrice" class="js-switch mt-1" data-color="#9c27b0" data-size="small" data-switchery="false" >
            </div>
        </div>
       
    </div>
</div>

@section('offerFooter2')

{{-- Tarife Fiyatları --}}
<script>
    $("input[name=einpack1ma]").on('change', function() {
        let ma = $("input[name=einpack1ma]").val();
        let spesen = $("input[name=einpackextra1]").val();
        spesen = ma * 20;
        $("input[name=einpackextra1]").val(spesen);
    })

    $("select[name=einpackTariff]").on("change",function () {

    let chf = $(this).find(":selected").data("chf");
    let ma = $(this).find(":selected").data("ma");
    let lkw = $(this).find(":selected").data("lkw");
    let anhanger = $(this).find(":selected").data("an");
    let control = $(this).find(":selected").data('selection');
    let spesen = $("input[name=einpackextra1]").val(20);

    if (control != 'bos')
    {
    $('.einpack-tariffs--area').show(300)
    }
    else
    {
    $('input[name=einpack1chf]').val(0);
    $('input[name=einpack1ma]').val(0);
    $('.einpack-tariffs--area').hide(300)
    }

    $('input[name=einpack1chf]').val(chf);
    $('input[name=einpack1ma]').val(ma);
    spesen = ma * 20;
    $("input[name=einpackextra1]").val(spesen);
    })

    var isEinpackKostendachButton = $("div.isEinpackKostendach");
    var isEinpackPauschalbutton = $("div.isEinpackPauschal");
    isEinpackKostendachButton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".einpack-kostendach-area").show(700);
        }
        else{
            $(".einpack-kostendach-area").hide(500);
        }
    })

    isEinpackPauschalbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".einpack-pauschal-area").show(700);
        }
        else{
            $(".einpack-pauschal-area").hide(500);
        }
    })

</script>

{{-- İlave ücret Aç/kapa --}}
<script>
    var extracostbutton = $("div.extra-cost-einpack");
    extracostbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".einpack--extra--cost--area").show(700);
        }
        else{
            $(".einpack--extra--cost--area").hide(500);
        }
    })
</script>

<script>
    $(document).ready(function(){
        einpackCost = 0;
        var einpackTopPrice = 0;
        var einpackDefaultPrice = 0;
        $("body").on("change",".einpack--area",function(){     
            if ($('input[name=einpackmasraf]').is(":checked")){
               var extra1 = parseFloat($('input[name=einpackextra1]').val());               
            }
            else {
                extra1 = 0;
            }
            if ($('input[name=einpackmasraf1]').is(":checked")){
               var extra2 = parseFloat($('input[name=einpackextra2]').val());               
            }
            else {
                extra2 = 0;
            }
            

            var extra12Cost = parseFloat($('input[name=einpackCost1]').val());               
            var extra13Cost = parseFloat($('input[name=einpackCost2]').val()); 
            var einpackTotalChf = parseFloat($('input[name=einpackroadChf]').val());              
            
            var chf = $('input[name=einpack1chf]').val();
            var Hours = $('input[name=einpackHours]').val();
            let allHours = Hours.split("-");
            let leftHour = parseFloat(allHours[0]);
            let rightHour = parseFloat(allHours[1]);
            
            einpackCostLeft = chf * leftHour + extra1+extra2+extra12Cost+extra13Cost+einpackTotalChf;
            einpackCostRight = chf * rightHour + extra1+extra2+extra12Cost+extra13Cost+einpackTotalChf;
            
            if(rightHour){
                $('input[name=einpackCost]').val(einpackCostRight)
            }
            if(leftHour){
                $('input[name=einpackCost]').val(einpackCostLeft)
            }
            if(leftHour && rightHour ){
                $('input[name=einpackCost]').val(einpackCostLeft+'-'+einpackCostRight) 
            }
            if(leftHour == null && rightHour == null)
            {
                $('input[name=einpackCost]').val('')
            }
        })  

        $("body").on("change",".einpack--area",function(){
            var chf = $('input[name=einpack1chf]').val();
            var Hours = $('input[name=einpackHours]').val();
            let allHours = Hours.split("-");
            let leftHour = parseFloat(allHours[0]);
            let rightHour = parseFloat(allHours[1]);

            var discount = $('input[name=einpackDiscount]').val();
            var discountPercent = $('input[name=einpackDiscountPercent]').val();
            var compromiser = $('input[name=einpackCompromiser]').val();
            var extraDiscount = $('input[name=einpackExtraDiscount]').val();
            
            einpackTotalPriceLeft = einpackCostLeft - discount - (einpackCostLeft*discountPercent/100) - compromiser - extraDiscount;
            einpackTotalPriceRight = einpackCostRight - discount - (einpackCostRight*discountPercent/100) - compromiser - extraDiscount;

            if(rightHour){
                $('input[name=einpackTotalPrice]').val(einpackTotalPriceRight)
            }
            if(leftHour){
                $('input[name=einpackTotalPrice]').val(einpackTotalPriceLeft)
            }
            if(leftHour && rightHour ){
                $('input[name=einpackTotalPrice]').val(einpackTotalPriceLeft+'-'+einpackTotalPriceRight) 
            }
            if(leftHour == null && rightHour == null)
            {
                $('input[name=einpackTotalPrice]').val('')
            }

        })
        $("body").on("change",".einpack--area",function(){
            var chf = $('input[name=einpack1chf]').val();
            var Hours = $('input[name=einpackHours]').val();

            let einpackTotalPrices = $('input[name=einpackTotalPrice]').val();
            einpackTotalPricesARR = einpackTotalPrices.split("-");
            let einpackTotalPrice = 0;
            
            leftTotal = parseFloat(einpackTotalPricesARR[0]);
            rightTotal = parseFloat(einpackTotalPricesARR[1]);
            if(leftTotal >= rightTotal)
            {
                einpackTotalPrice = leftTotal;
            }
            else if(rightTotal >= leftTotal)
            {
                einpackTotalPrice = rightTotal;
            }
            else{
                einpackTotalPrice = parseFloat($('input[name=einpackTotalPrice]').val());
            }
            if($('input[name=isEinpackMTPrice]').is(":checked"))
            {
                $('input[name=einpackTopPrice]').val();
            }
            else{
                einpackTopPrice = einpackTotalPrice + parseFloat(chf);
                $('input[name=einpackTopPrice]').val(einpackTopPrice);
            }

            if($('input[name=isEinpackFxPrice]').is(":checked"))
            {
                $('input[name=einpackDefaultPrice]').val();
            }
            else{
                einpackDefaultPrice = einpackTotalPrice + parseFloat(chf);
            $('input[name=einpackDefaultPrice]').val(einpackDefaultPrice);
            }
           
        })  
    })
</script>
@endsection