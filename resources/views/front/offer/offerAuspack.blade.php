<div class="row p-3">
    <div class="col-md-6">
        <label class=" col-form-label" for="l0">Tarif</label>
        <select class="form-control" class="auspackTariff" name="auspackTariff" id="auspackTariff" >
            <option data-selection="bos"  value>Bitte wählen</option>
            @foreach (\App\Models\Tariff::getList(7) as $key=>$value )
            <option data-selection="0" data-ma="{{ $value['ma'] }}" data-lkw="{{ $value['lkw'] }}" data-an="{{ $value['anhanger'] }}" data-chf ="{{ $value['chf'] }}" value="{{ $value['id'] }}">{{ $value['description'] }}</option>
            @endforeach
        </select>

        <div class="row auspack-tariffs--area" style="display: none;">
            <div class="col">
                <label class=" col-form-label" for="l0">MA</label>
                <input class="form-control"  name="auspack1ma" placeholder="0"  type="number" >                                
            </div>
            <div class="col">
                <label class=" col-form-label" for="l0">CHF-Ansatz</label>
                <input class="form-control"  name="auspack1chf" placeholder="0"  type="number" >                                
            </div>
        </div>
        
        <label class=" col-form-label" for="l0">Packtermin</label>
        <input class="form-control" class="date"  name="auspackdate"  type="date" > 

        <label class=" col-form-label" for="l0">Arbeitsbeginn</label>
        <input class="form-control" class="time"  name="auspacktime"  type="time" > 

        <label class=" col-form-label" for="l0">Anfahrt/Rückfahrt [CHF]</label>
        <input class="form-control" class="date"  name="auspackroadChf"  type="number" value="0"> 

    </div>
    <div class="col-md-6">
        <label class="col-form-label" for="l0">Dauer [h]</label>
        <input class="form-control"  name="auspackHours" placeholder="4-5"  type="text" >  
        
        <div class="extra-cost-auspack mt-1">
            <label for="" class="col-form-label">Zusatzkosten</label><br>
            <input type="checkbox" name="auspackisExtra" id="auspackisExtra" class="js-switch " data-color="#286090" data-switchery="false" checked>  
        </div>  

        <div class="auspack--extra--cost--area" style="display: block;">

            <div class="form-group">
                <div class="row">
                    <div class="col-md-7">
                        <div class="checkbox checkbox-rounded checkbox-color-scheme">
                            <label class="checkbox">
                                <input type="checkbox" name="auspackmasraf" checked> <span class="label-text text-dark"><strong>Spesen</strong></span>                       
                            </label>                   
                        </div>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" name="auspackextra1" type="number" value="20">
                    </div>
                </div> 
                
                <div class="row">
                    <div class="col-md-7">
                        <div class="checkbox checkbox-rounded checkbox-color-scheme">
                            <label class="checkbox">
                                <input type="checkbox" name="auspackmasraf1"> <span class="label-text text-dark"><strong>Verpackungsmaterial</strong></span>                       
                            </label>                   
                        </div>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" name="auspackextra2" type="number" value="250">
                    </div>
                </div>  
  
                <div class="row ">
                    <div class="col-md-7">
                        <input class="form-control"  name="auspackCostText1" placeholder="Freier Text"  type="text" >
                    </div>
                    <div class="col-md-5">
                        <input class="form-control"  name="auspackCost1" placeholder="0"  type="number" value="0">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-7">
                        <input class="form-control"  name="auspackCostText2" placeholder="Freier Text"  type="text" >
                    </div>
                    <div class="col-md-5">
                        <input class="form-control"  name="auspackCost2" placeholder="0"  type="number" value="0">
                    </div>
                </div>
            </div>

            
                        
        </div>
        
        <label class="col-form-label mt-1 " for="l0">Kosten</label>
        <input class="form-control" id="auspackCost"  name="auspackCost" placeholder="0"  type="text" style="background-color: #286090;color:white;"> 

        <label class="col-form-label" for="l0">Rabatt</label>
        <input class="form-control"  name="auspackDiscount" placeholder="0"  type="number" > 

        <label class="col-form-label" for="l0">Rabatt[%]</label>
        <input class="form-control"  name="auspackDiscountPercent" placeholder="0"  type="number" >

        <label class="col-form-label" for="l0">Entgegenkommen</label>
        <input class="form-control"  name="auspackCompromiser" placeholder="0"  type="number" >

        <div class="row ">
            <div class="col-md-7">
                <label class="col-form-label" for="l0">Weitere Abzüge</label>
                <input class="form-control"  name="auspackExtraDiscountText" placeholder="Freier Text"  type="text" >
            </div>
            <div class="col-md-5">
                <label class="col-form-label" for="l0">Weitere Abzüge</label>
                <input class="form-control"  name="auspackExtraDiscount" placeholder="0"  type="number" >
            </div>
        </div>

        <label class="col-form-label" for="l0">Geschätzte Kosten</label>
        <input class="form-control"  name="auspackTotalPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;">

        <div class="mt-2 isAuspackKostendach">
            <label class="col-form-label" for="l0">Kostendach</label>
            <input type="checkbox"  name="isAuspackKostendach" id="isAuspackKostendach" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
        </div>

        <div class="auspack-kostendach-area" style="display: none;">
            <input class="form-control"  name="auspackTopPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;">

            <div class="mt-2">
                <small class=" text-primary">manuell gesetzt</small>
                <input type="checkbox" name="isAuspackMTPrice" id="isAuspackMTPrice" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
            </div>
        </div>

        <div class="mt-3 isAuspackPauschal">
            <label class="col-form-label" for="l0">Pauschal</label>
            <input type="checkbox"  name="isAuspackPauschal" id="isAuspackPauschal" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
        </div>

        <div class="auspack-pauschal-area " style="display:none;">
            <input class="form-control"  name="auspackDefaultPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;">

            <div class="mt-2">
                <small class=" text-primary">manuell gesetzt</small>
                <input type="checkbox" name="isAuspackFxPrice" id="isAuspackFxPrice" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
            </div>
        </div>
    </div>
</div>

@section('offerFooterAus')

{{-- Tarife Fiyatları --}}
<script>
    $("input[name=auspack1ma]").on('change', function() {
        let ma = $("input[name=auspack1ma]").val();
        let spesen = $("input[name=auspackextra1]").val();
        spesen = ma * 20;
        $("input[name=auspackextra1]").val(spesen);
    })

    $("select[name=auspackTariff]").on("change",function () {

    let chf = $(this).find(":selected").data("chf");
    let ma = $(this).find(":selected").data("ma");
    let lkw = $(this).find(":selected").data("lkw");
    let anhanger = $(this).find(":selected").data("an");
    let control = $(this).find(":selected").data('selection');
    let spesen = $("input[name=auspackextra1]").val(20);

    if (control != 'bos')
    {
    $('.auspack-tariffs--area').show(300)
    }
    else
    {
    $('input[name=auspack1chf]').val(0);
    $('input[name=auspack1ma]').val(0);
    $('.auspack-tariffs--area').hide(300)
    }

    $('input[name=auspack1chf]').val(chf);
    $('input[name=auspack1ma]').val(ma);
    spesen = ma * 20;
    $("input[name=auspackextra1]").val(spesen);
    })

    var isAuspackKostendachButton = $("div.isAuspackKostendach");
    var isAuspackPauschalbutton = $("div.isAuspackPauschal");
    isAuspackKostendachButton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".auspack-kostendach-area").show(700);
        }
        else{
            $(".auspack-kostendach-area").hide(500);
        }
    })

    isAuspackPauschalbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".auspack-pauschal-area").show(700);
        }
        else{
            $(".auspack-pauschal-area").hide(500);
        }
    })
</script>

{{-- İlave ücret Aç/kapa --}}
<script>
    var extracostbutton = $("div.extra-cost-auspack");
    extracostbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".auspack--extra--cost--area").show(700);
            
        }
        else{
            $(".auspack--extra--cost--area").hide(500);
            
        }
    })
</script>
<script>
    $(document).ready(function(){
        auspackCost = 0;
        var auspackTopPrice = 0;
        var auspackDefaultPrice = 0;

        $("body").on("change",".auspack--area",function(){
            if ($('input[name=auspackmasraf]').is(":checked")){
               var extra1 = parseFloat($('input[name=auspackextra1]').val());               
            }
            else {
                extra1 = 0;
            }
            if ($('input[name=auspackmasraf1]').is(":checked")){
               var extra2 = parseFloat($('input[name=auspackextra2]').val());               
            }
            else {
                extra2 = 0;
            }
            

            var extra12Cost = parseFloat($('input[name=auspackCost1]').val());               
            var extra13Cost = parseFloat($('input[name=auspackCost2]').val()); 
            var auspackTotalChf = parseFloat($('input[name=auspackroadChf]').val());              
            
            var chf = $('input[name=auspack1chf]').val();
            var Hours = $('input[name=auspackHours]').val();

            let allHours = Hours.split("-");
            let leftHour = parseFloat(allHours[0]);
            let rightHour = parseFloat(allHours[1]);
            auspackCostLeft = chf * leftHour + extra1+extra2+extra12Cost+extra13Cost+auspackTotalChf;
            auspackCostRight = chf * rightHour + extra1+extra2+extra12Cost+extra13Cost+auspackTotalChf;
            
            if(rightHour){
                $('input[name=auspackCost]').val(auspackCostRight)
            }
            if(leftHour){
                $('input[name=auspackCost]').val(auspackCostLeft)
            }
            if(leftHour && rightHour ){
                $('input[name=auspackCost]').val(auspackCostLeft+'-'+auspackCostRight) 
            }
            if(leftHour == null && rightHour == null)
            {
                $('input[name=auspackCost]').val('')
            }
        })  
        $("body").on("change",".auspack--area",function(){
            var chf = $('input[name=auspack1chf]').val();
            var Hours = $('input[name=auspackHours]').val();

            let allHours = Hours.split("-");
            let leftHour = parseFloat(allHours[0]);
            let rightHour = parseFloat(allHours[1]);

            var discount = $('input[name=auspackDiscount]').val();
            var discountPercent = $('input[name=auspackDiscountPercent]').val();
            var compromiser = $('input[name=auspackCompromiser]').val();
            var extraDiscount = $('input[name=auspackExtraDiscount]').val();
            
            auspackTotalPriceLeft = auspackCostLeft - discount - (auspackCostLeft*discountPercent/100) - compromiser - extraDiscount;
            auspackTotalPriceRight = auspackCostRight - discount - (auspackCostRight*discountPercent/100) - compromiser - extraDiscount;
            if(rightHour){
                $('input[name=auspackTotalPrice]').val(auspackTotalPriceRight)
            }
            if(leftHour){
                $('input[name=auspackTotalPrice]').val(auspackTotalPriceLeft)
            }
            if(leftHour && rightHour ){
                $('input[name=auspackTotalPrice]').val(auspackTotalPriceLeft+'-'+auspackTotalPriceRight) 
            }
            if(leftHour == null && rightHour == null)
            {
                $('input[name=auspackTotalPrice]').val('')
            }
            
        })
        $("body").on("change",".auspack--area",function(){
            var chf = $('input[name=auspack1chf]').val();
            var Hours = $('input[name=auspackHours]').val();

            let auspackTotalPrices = $('input[name=auspackTotalPrice]').val();
            auspackTotalPricesARR = auspackTotalPrices.split("-");
            let auspackTotalPrice = 0;
            
            leftTotal = parseFloat(auspackTotalPricesARR[0]);
            rightTotal = parseFloat(auspackTotalPricesARR[1]);
            if(leftTotal >= rightTotal)
            {
                auspackTotalPrice = leftTotal;
            }
            else if(rightTotal >= leftTotal)
            {
                auspackTotalPrice = rightTotal;
            }
            else{
                auspackTotalPrice = parseFloat($('input[name=auspackTotalPrice]').val());
            }
            if($('input[name=isAuspackMTPrice]').is(":checked"))
            {
                $('input[name=auspackTopPrice]').val();
            }
            else{
                auspackTopPrice = auspackTotalPrice + parseFloat(chf);
                $('input[name=auspackTopPrice]').val(auspackTopPrice);
            }

            if($('input[name=isAuspackFxPrice]').is(":checked"))
            {
                $('input[name=auspackDefaultPrice]').val();
            }
            else{
                auspackDefaultPrice = auspackTotalPrice + parseFloat(chf);
                $('input[name=auspackDefaultPrice]').val(auspackTopPrice);
            }
            
        })  
    })
</script>
@endsection