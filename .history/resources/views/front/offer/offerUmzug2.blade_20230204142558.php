<div class="row p-3">
    <div class="col-md-6">
        <label class=" col-form-label" for="l0">Tarif</label>
        <select class="form-control" class="umzugTariff2" name="umzugTariff" id="umzugTariff" >
            <option data-selection="bos" value>Bitte wählen</option>
            @foreach (\App\Models\Tariff::getList(1) as $key=>$value )
                <option data-selection="0" data-ma="{{ $value['ma'] }}" data-lkw="{{ $value['lkw'] }}" data-an="{{ $value['anhanger'] }}" data-chf ="{{ $value['chf'] }}" value="{{ $value['id'] }}">{{ $value['description'] }}</option>
            @endforeach
        </select>   

        <div class="row umzug--tariffs--area umzug-tarif-area" style="display: none;">
            <div class="col">
                <label class=" col-form-label" for="l0">MA</label>
                <input class="form-control"  name="umzug1ma" placeholder="0"  type="number" >                                
            </div>
            <div class="col">
                <label class=" col-form-label" for="l0">LKW</label>
                <input class="form-control"  name="umzug1lkw" placeholder="0"  type="number" >                                
            </div>
            <div class="col">
                <label class=" col-form-label" for="l0">Anhänger</label>
                <input class="form-control"  name="umzug1anhanger" placeholder="0"  type="number" >                                
            </div>
            <div class="col">
                <label class=" col-form-label" for="l0">CHF-Ansatz</label>
                <input class="form-control" id="umzug1chf"  name="umzug1chf" placeholder="0"  type="number" value="0">                                
            </div>
        </div>
        
        <label class=" col-form-label" for="l0">Umzugstermin</label>
        <input class="form-control" class="date"  name="umzugausdate"  type="date" > 

        <label class=" col-form-label" for="l0">Arbeitsbeginn</label>
        <input class="form-control" class="time"  name="umzug1time"  type="time" > 

        <label class=" col-form-label" for="l0">Einzugstermin</label>
        <input class="form-control" class="date"  name="umzugeindate"  type="date" > 

        <label class=" col-form-label" for="l0">Anfahrt/Rückfahrt [CHF]</label>
        <input class="form-control" class="date"  name="umzugroadChf"  type="number" value="0"> 

        <label class=" col-form-label" for="l0">Ab- und Aufbau</label>
        <select class="form-control" class="umzugMontaj" name="umzugMontaj" id="umzugMontaj" >
            <option value="1">Bitte wählen</option>
            <option value="2">Kunde</option>
            <option value="3">Firma</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="col-form-label" for="l0">Dauer [h]</label>
        <input class="form-control"  name="umzugHours" placeholder="4-5"  type="text" >  
        
        <div class="extra-cost mt-1">
            <label for="" class="col-form-label">Zusatzkosten</label><br>
            <input type="checkbox" name="isExtra" id="isExtra" class="js-switch " data-color="#9c27b0" data-switchery="false" >  
        </div>  

        <div class="extra--cost--area" style="display: none;">

            <div class="form-group">
                <div class="row">
                    <div class="col-md-7">
                        <div class="checkbox checkbox-rounded checkbox-color-scheme">
                            <label class="checkbox">
                                <input type="checkbox" name="masraf"> <span class="label-text text-dark"><strong>Spesen</strong></span>                       
                            </label>                   
                        </div>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" name="extra1" type="number" value="10">
                    </div>
                </div> 
                
                <div class="row">
                    <div class="col-md-7">
                        <div class="checkbox checkbox-rounded checkbox-color-scheme">
                            <label class="checkbox">
                                <input type="checkbox" name="masraf1"> <span class="label-text text-dark"><strong>Klavier 250.-</strong></span>                       
                            </label>                   
                        </div>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" name="extra2" type="number" value="250">
                    </div>
                </div>  

                <div class="row">
                    <div class="col-md-7">
                        <div class="checkbox checkbox-rounded checkbox-color-scheme">
                            <label class="checkbox">
                                <input type="checkbox" name="masraf2"> <span class="label-text text-dark"><strong>Klavier 350.-</strong></span>                       
                            </label>                   
                        </div>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" name="extra3" type="number" value="350">
                    </div>
                </div>  

                <div class="row">
                    <div class="col-md-7">
                        <div class="checkbox checkbox-rounded checkbox-color-scheme">
                            <label class="checkbox">
                                <input type="checkbox" name="masraf3"> <span class="label-text text-dark"><strong>Möbellift 0.-</strong></span>                       
                            </label>                   
                        </div>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" name="extra4" type="number" value="0">
                    </div>
                </div>  

                <div class="row">
                    <div class="col-md-7">
                        <div class="checkbox checkbox-rounded checkbox-color-scheme">
                            <label class="checkbox">
                                <input type="checkbox" name="masraf4"> <span class="label-text text-dark"><strong>Möbellift 250.-</strong></span>                       
                            </label>                   
                        </div>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" name="extra5" type="number" value="250">
                    </div>
                </div>  

                <div class="row">
                    <div class="col-md-7">
                        <div class="checkbox checkbox-rounded checkbox-color-scheme">
                            <label class="checkbox">
                                <input type="checkbox" name="masraf5"> <span class="label-text text-dark"><strong>Möbellift 350.-</strong></span>                       
                            </label>                   
                        </div>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" name="extra6" type="number" value="350">
                    </div>
                </div>  

                <div class="row">
                    <div class="col-md-7">
                        <div class="checkbox checkbox-rounded checkbox-color-scheme">
                            <label class="checkbox">
                                <input type="checkbox" name="masraf6"> <span class="label-text text-dark"><strong>Schwergutzuschlag 150.-</strong></span>                       
                            </label>                   
                        </div>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" name="extra7" type="number" value="150">
                    </div>
                </div>  

                <div class="row">
                    <div class="col-md-7">
                        <div class="checkbox checkbox-rounded checkbox-color-scheme">
                            <label class="checkbox">
                                <input type="checkbox" name="masraf7"> <span class="label-text text-dark"><strong>Schwergutzuschlag 250.-</strong></span>                       
                            </label>                   
                        </div>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" name="extra8" type="number" value="250">
                    </div>
                </div>  

                <div class="row">
                    <div class="col-md-7">
                        <div class="checkbox checkbox-rounded checkbox-color-scheme">
                            <label class="checkbox">
                                <input type="checkbox" name="masraf8"> <span class="label-text text-dark"><strong>Tresor 350.-</strong></span>                       
                            </label>                   
                        </div>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" name="extra9" type="number" value="350">
                    </div>
                </div>  

                <div class="row">
                    <div class="col-md-7">
                        <div class="checkbox checkbox-rounded checkbox-color-scheme">
                            <label class="checkbox">
                                <input type="checkbox" name="masraf9"> <span class="label-text text-dark"><strong>Tresor 450.-</strong></span>                       
                            </label>                   
                        </div>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" name="extra10" type="number" value="450">
                    </div>
                </div>  

                <div class="row">
                    <div class="col-md-7">
                        <div class="checkbox checkbox-rounded checkbox-color-scheme">
                            <label class="checkbox">
                                <input type="checkbox" name="masraf10"> <span class="label-text text-dark"><strong>Wasserbett</strong></span>                       
                            </label>                   
                        </div>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" name="extra11" type="number" value="500">
                    </div>
                </div>
                
                <div class="row ">
                    <div class="col-md-7">
                        <input class="form-control"  name="extra12CostText" placeholder="Freier Text"  type="text" >
                    </div>
                    <div class="col-md-5">
                        <input class="form-control"  name="extra12Cost" placeholder="0"  type="number" value="0">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-7">
                        <input class="form-control"  name="extra13CostText" placeholder="Freier Text"  type="text" >
                    </div>
                    <div class="col-md-5">
                        <input class="form-control"  name="extra13Cost" placeholder="0"  type="number" value="0">
                    </div>
                </div>
            </div>
        </div>
        
        <label class="col-form-label mt-1 " for="l0">Kosten</label>
        <input class="form-control" id="umzugCost"  name="umzugCost" placeholder="0"  type="text" style="background-color: #8778aa;color:white;"> 

        <label class="col-form-label" for="l0">Rabatt</label>
        <input class="form-control"  name="umzugDiscount" placeholder="0"  type="number" > 

        <label class="col-form-label" for="l0">Rabatt[%]</label>
        <input class="form-control"  name="umzugDiscountPercent" placeholder="0"  type="number" > 

        <label class="col-form-label" for="l0">Entgegenkommen</label>
        <input class="form-control"  name="umzugCompromiser" placeholder="0"  type="number" >

        <div class="row ">
            <div class="col-md-7">
                <label class="col-form-label" for="l0">Weitere Abzüge</label>
                <input class="form-control"  name="umzugExtraDiscountText" placeholder="Freier Text"  type="text" >
            </div>
            <div class="col-md-5">
                <label class="col-form-label" for="l0">Weitere Abzüge</label>
                <input class="form-control"  name="umzugExtraDiscount" placeholder="0"  type="number" >
            </div>
        </div>

        <label class="col-form-label" for="l0">Geschätzte Kosten</label>
        <input class="form-control"  name="umzugTotalPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;">

        <div class="mt-2 isKostendach">
            <label class="col-form-label" for="l0">Kostendach</label>
            <input type="checkbox"  name="isKostendach" id="isKostendach" class="js-switch mt-1" data-color="#9c27b0" data-size="small" data-switchery="false" >
        </div>

        <div class="kostendach-area" style="display: none;">
            <input class="form-control"  name="umzugTopPrice" placeholder="0"  type="number" style="background-color: #8778aa;color:white;">
            
            <div class="mt-2">
                <small class=" text-primary">manuell gesetzt</small>
                <input type="checkbox" name="isUmzugMTPrice" id="isUmzugMTPrice" class="js-switch mt-1" data-color="#9c27b0" data-size="small" data-switchery="false" >
            </div><br>
        </div>  
        

        <label class="col-form-label" for="l0">Pauschal</label>
        <input class="form-control"  name="umzugDefaultPrice" placeholder="0"  type="number" style="background-color: #8778aa;color:white;">
    </div>
</div>

@section('offerFooter1')
{{-- Tarife Fiyatları --}}
<script>        
    $("select[name=umzugTariff]").on("change",function () {
        let chf = $(this).find(":selected").data("chf");
        let ma = $(this).find(":selected").data("ma");
        let lkw = $(this).find(":selected").data("lkw");
        let anhanger = $(this).find(":selected").data("an");
        let control = $(this).find(":selected").data('selection');
        let spesen = $("input[name=extra1]").val();
        if (control != 'bos')
        {
        $('.umzug-tarif-area').show(300)

        }
        else
        {
        $('input[name=umzug1chf]').val(0);
        $('input[name=umzug1ma]').val(0);
        $('input[name=umzug1lkw]').val(0);
        $('input[name=umzug1anhanger]').val(0);
        $('.umzug-tarif-area').hide(300)
        }

        $('input[name=umzug1chf]').val(chf);
        $('input[name=umzug1ma]').val(ma);
        $('input[name=umzug1lkw]').val(lkw);
        $('input[name=umzug1anhanger]').val(anhanger);
        spesen = ma * 20;
        $("input[name=extra1]").val(spesen);
    })
    var isKostendachbutton = $("div.isKostendach");
    isKostendachbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".kostendach-area").show(700);
        }
        else{
            $(".kostendach-area").hide(500);
        }
    })
    
       
</script>
{{-- İlave ücret Aç/kapa --}}
<script>
    var extracostbutton = $("div.extra-cost");
    extracostbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".extra--cost--area").show(700);
        }
        else{
            $(".extra--cost--area").hide(500);
        }
    })
</script>
<script>
    $(document).ready(function(){
        umzugCost = 0;
        var umzugTotalPrice = 0;
        var umzugTopPrice = 0;
        var umzugDefaultPrice = 0;
        
        $('input[name=umzugCost]').on('click',function () {         
            if ($('input[name=masraf]').is(":checked")){
               var extra1 = parseFloat($('input[name=extra1]').val());               
            }
            else {
                extra1 = 0;
            }
            if ($('input[name=masraf1]').is(":checked")){
               var extra2 = parseFloat($('input[name=extra2]').val());               
            }
            else {
                extra2 = 0;
            }
            if ($('input[name=masraf2]').is(":checked")){
                var extra3 = parseFloat($('input[name=extra3]').val());               
            }
            else {
                extra3 = 0;
            }
            if ($('input[name=masraf3]').is(":checked")){
                var extra4 = parseFloat($('input[name=extra4]').val());               
            }
            else {
                extra4 = 0;
            }
            if ($('input[name=masraf4]').is(":checked")){
                var extra5 = parseFloat($('input[name=extra5]').val());               
            }
            else {
                extra5 = 0;
            }
            if ($('input[name=masraf5]').is(":checked")){
                var extra6 = parseFloat($('input[name=extra6]').val());               
            }
            else {
                extra6 = 0;
            }
            if ($('input[name=masraf6]').is(":checked")){
                var extra7 = parseFloat($('input[name=extra7]').val());               
            }
            else {
                extra7 = 0;
            }
            if ($('input[name=masraf7]').is(":checked")){
                var extra8 = parseFloat($('input[name=extra8]').val());               
            }
            else {
                extra8 = 0;
            }
            if ($('input[name=masraf8]').is(":checked")){
                var extra9 = parseFloat($('input[name=extra9]').val());               
            }
            else {
                extra9 = 0;
            }
            if ($('input[name=masraf9]').is(":checked")){
                var extra10 = parseFloat($('input[name=extra10]').val());               
            }
            else {
                extra10 = 0;
            }
            if ($('input[name=masraf10]').is(":checked")){
                var extra11 = parseFloat($('input[name=extra11]').val());               
            }
            else {
                extra11 = 0;
            }

            var extra12Cost = parseFloat($('input[name=extra12Cost]').val());               
            var extra13Cost = parseFloat($('input[name=extra13Cost]').val()); 
            var umzugTotalChf = parseFloat($('input[name=umzugroadChf]').val());              
            
            var chf = $('input[name=umzug1chf]').val();
            var Hours = $('input[name=umzugHours]').val();
            let allHours = Hours.split("-");

            let leftHour = parseFloat(allHours[0]);
            let rightHour = parseFloat(allHours[1]);

            umzugCostLeft = chf * leftHour + extra1+extra2+extra3+extra4+extra5+extra6+extra7+extra8+extra9+extra10+extra11+extra12Cost+extra13Cost+umzugTotalChf;
            umzugCostRight = chf * rightHour + extra1+extra2+extra3+extra4+extra5+extra6+extra7+extra8+extra9+extra10+extra11+extra12Cost+extra13Cost+umzugTotalChf;
            
            if(rightHour){
                $('input[name=umzugCost]').val(umzugCostRight)
            }
            if(leftHour){
                $('input[name=umzugCost]').val(umzugCostLeft)
            }
            if(leftHour && rightHour ){
                $('input[name=umzugCost]').val(umzugCostLeft+'-'+umzugCostRight) 
            }
            if(leftHour == null && rightHour == null)
            {
                $('input[name=umzugCost]').val('')
            }
           
            
            
        })  
        $('input[name=umzugTotalPrice]').on('click',function () {
            var chf = $('input[name=umzug1chf]').val();
            var Hours = $('input[name=umzugHours]').val();
            let allHours = Hours.split("-");

            let leftHour = parseFloat(allHours[0]);
            let rightHour = parseFloat(allHours[1]);
            var discount = $('input[name=umzugDiscount]').val();
            var discountPercent = $('input[name=umzugDiscountPercent]').val();
            var compromiser = $('input[name=umzugCompromiser]').val();
            var extraDiscount = $('input[name=umzugExtraDiscount]').val();
            
            umzugTotalPriceLeft = umzugCostLeft - discount - (umzugCostLeft*discountPercent/100) - compromiser - extraDiscount;
            umzugTotalPriceRight = umzugCostRight - discount - (umzugCostLeft*discountPercent/100) - compromiser - extraDiscount;

            if(rightHour){
                $('input[name=umzugTotalPrice]').val(umzugTotalPriceRight)
            }
            if(leftHour){
                $('input[name=umzugTotalPrice]').val(umzugTotalPriceLeft)
            }
            if(leftHour && rightHour ){
                $('input[name=umzugTotalPrice]').val(umzugTotalPriceLeft+'-'+umzugTotalPriceRight) 
            }
            if(leftHour == null && rightHour == null)
            {
                $('input[name=umzugTotalPrice]').val('')
            }
        }) 
        
        $('input[name=umzugTopPrice]').on('click',function(){
            
            var chf = $('input[name=umzug1chf]').val();
            var Hours = $('input[name=umzugHours]').val();
            let umzugTotalPrices = $('input[name=umzugTotalPrice]').val();
            umzugTotalPricesARR = umzugTotalPrices.split("-");
            let umzugTotalPrice = 0;

            leftTotal = parseFloat(umzugTotalPricesARR[0]);
            rightTotal = parseFloat(umzugTotalPricesARR[1]);

            if(leftTotal >= rightTotal)
            {
                umzugTotalPrice = leftTotal;
            }
            else if(rightTotal >= leftTotal)
            {
                umzugTotalPrice = rightTotal;
            }
            else{
                umzugTotalPrice = parseFloat($('input[name=umzugTotalPrice]').val());
            }

            if($('input[name=isUmzugMTPrice]').is(":checked"))
            {
                $('input[name=umzugTopPrice]').val();
            }
            else{
                umzugTopPrice = umzugTotalPrice + parseFloat(chf);
                $('input[name=umzugTopPrice]').val(umzugTopPrice);
            }
            
            if($('input[name=isKostendach]').is(":checked"))
            {
                $('.kostendach-area').show(300)
                $('input[name=umzugTopPrice]').val();
            }
            else{
                $('.kostendach-area').hide(300)
                umzugTopPrice = umzugTotalPrice + parseFloat(chf);
                $('input[name=umzugTopPrice]').val(umzugTopPrice);
            }

            umzugDefaultPrice = umzugTotalPrice + parseFloat(chf);
            $('input[name=umzugDefaultPrice]').val(umzugDefaultPrice);
        })  
        
    })
</script>

@endsection