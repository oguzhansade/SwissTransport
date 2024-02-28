<div class="form-group row">
    <div class="col-md-12 lagerung-control">
        <label for="" class="col-form-label">Lagerung</label><br>
        <input type="checkbox" name="isLagerung" id="isLagerung" class="js-switch " data-color="#286090" data-switchery="false" >  
    </div>                            
</div>

<div class="rounded lagerung--area bg-service-primary" style="display:none;">
    <div class="row p-3">
        <div class="col-md-6">
            <label class=" col-form-label" for="l0">Tarif</label>
            <select class="form-control" class="lagerungTariff" name="lagerungTariff" id="lagerungTariff" >
                <option data-selection="bos" value>Bitte wählen</option>
                @foreach (\App\Models\Tariff::getList(5) as $key=>$value )
                    <option data-selection="0" data-ma="{{ $value['ma'] }}" data-lkw="{{ $value['lkw'] }}" data-an="{{ $value['anhanger'] }}" data-chf ="{{ $value['chf'] }}" value="{{ $value['id'] }}">{{ $value['description'] }}</option>
                @endforeach
            </select>

            <div class="row lagerung-tariffs--area" style="display: none;">
                <div class="col">
                    <label class=" col-form-label" for="l0">CHF-Ansatz</label>
                    <input class="form-control"  name="lagerungChf" placeholder="0"  type="number" >                                
                </div>
            </div>
            
            <label class=" col-form-label" for="l0">Volumen [m3]</label>
            <input class="form-control" class="date"  name="lagerungVolume"  type="text" > 
        </div>
        <div class="col-md-6">
            <div class="lagerung--extra--cost--area" >
                <div class="form-group">
                    <label class=" col-form-label" for="l0">Weitere Kosten</label>
                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="lagerungCostText1" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="lagerungCost1" placeholder="0"  type="number" value="0">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="lagerungCostText2" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="lagerungCost2" placeholder="0"  type="number" value="0">
                        </div>
                    </div>
                </div>
            </div>
            
            <label class="col-form-label mt-1 " for="l0">Kosten</label>
            <input class="form-control" id="lagerungCost"  name="lagerungCostPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;"> 

            <div class="row">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Rabatt[%]</label>
                    <input class="form-control"  name="lagerungDiscountPercent" placeholder="0"  type="number" value="0">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="lagerungExtraDiscountText" placeholder="Freier Text"  type="text" >
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="lagerungExtraDiscount" placeholder="0"  type="number" value="0">
                </div>
            </div>

            <label class="col-form-label mt-1 " for="l0">GESCHÄTZTE KOSTEN</label>
            <input class="form-control" id="lagerungCost"  name="lagerungCost" placeholder="0"  type="text" style="background-color: #286090;color:white;"> 

            <div class="mt-2 lagerung-fixed-control">
                <label class="col-form-label" for="l0">Pauschal</label>
                <input type="checkbox" name="isLagerungFixedPrice" id="isLagerungFixedPrice" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
            </div>

            <div class="lagerung-fixed-area" style="display: none;">
                <input class="form-control"  name="lagerungFixedPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;">

                <div class="mt-2">
                    <small class=" text-primary">manuell gesetzt</small>
                    <input type="checkbox" name="isLagerungFxPrice" id="isLagerungFxPrice" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
                </div>
            </div>
            
        </div>
    </div>
</div>
@section('offerFooterLagerung')

<script>

var morebutton9 = $("div.lagerung-control");

morebutton9.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".lagerung--area").show(700);
            $("select[name=lagerungTariff]").prop('required',true);      
        }
        else{
            $(".lagerung--area").hide(500);
            $("select[name=lagerungTariff]").prop('required',false);      
        }
    })

    var lagerungFixed = $("div.lagerung-fixed-control");
    lagerungFixed.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".lagerung-fixed-area").show(700);
            
        }
        else{
            $(".lagerung-fixed-area").hide(500);
        }
    })
</script>
<script>
     $("select[name=lagerungTariff]").on("change",function () {
     let chf = $(this).find(":selected").data("chf");
     let control = $(this).find(":selected").data('selection');
     if (control != 'bos')
     {
        $('.lagerung-tariffs--area').show(300)  
     }
     else
     {
        $('input[name=lagerungChf]').val(0);
        $('.lagerung-tariffs--area').hide(300)
     }
     $('input[name=lagerungChf]').val(chf);
    })
</script>

<script>
    $(document).ready(function(){
        lagerungCost = 0;
        var lagerungFixedPrice = 0;
        var lagerungCost = 0;
        $("body").on("change",".lagerung--area",function(){      
            var extraCost1 = parseFloat($('input[name=lagerungCost1]').val());               
            var extraCost2 = parseFloat($('input[name=lagerungCost2]').val()); 
            var discount = parseFloat($('input[name=lagerungExtraDiscount]').val());  
            var discountPercent = parseFloat($('input[name=lagerungDiscountPercent]').val());     
            
            var chf = $('input[name=lagerungChf]').val();
            var Volume = $('input[name=lagerungVolume]').val();

            let allVolume = Volume.split("-");
            let leftVolume= parseFloat(allVolume[0]);
            let rightVolume = parseFloat(allVolume[1]);

            lagerungCostLeft = chf * leftVolume + extraCost1 + extraCost2 - discount;
            lagerungCostRight = chf * rightVolume + extraCost1 + extraCost2 - discount;

            lagerungCostLeftPrice = chf * leftVolume + extraCost1 + extraCost2
            lagerungCostRightPrice = chf * rightVolume + extraCost1 + extraCost2

                if(rightVolume){
                    if(discountPercent)
                    {
                        lagerungCostRight = lagerungCostRightPrice-(lagerungCostRightPrice*discountPercent/100) - discount
                    }
                    $('input[name=lagerungCost]').val(lagerungCostRight)
                    $('input[name=lagerungCostPrice]').val(lagerungCostRightPrice)
                }
                if(leftVolume){
                    if(discountPercent)
                    {
                        lagerungCostLeft = lagerungCostLeftPrice-(lagerungCostLeftPrice*discountPercent/100)  - discount
                    }
                    $('input[name=lagerungCost]').val(lagerungCostLeft)
                    $('input[name=lagerungCostPrice]').val(lagerungCostLeftPrice)
                }
                if(leftVolume && rightVolume ){
                    lagerungCostRight = lagerungCostRightPrice-(lagerungCostRightPrice*discountPercent/100) - discount
                    lagerungCostLeft = lagerungCostLeftPrice-(lagerungCostLeftPrice*discountPercent/100) - discount
                    $('input[name=lagerungCost]').val(lagerungCostLeft+'-'+lagerungCostRight) 
                    $('input[name=lagerungCostPrice]').val(lagerungCostLeftPrice+'-'+lagerungCostRightPrice)
                }
                if(leftVolume == null && rightVolume == null){
                    $('input[name=lagerungCost]').val('')
                }



                lagerungPrices = $('input[name=lagerungCost]').val();

                let allPrices = lagerungPrices.split("-");

                let leftPrice= parseFloat(allPrices[0]);
                let rightPrice = parseFloat(allPrices[1]);

            
                if(leftPrice >= rightPrice)
                {
                    lagerungCost = leftPrice 
                }
                else if(rightPrice >= leftPrice)
                {
                    lagerungCost = rightPrice
                }
                else{
                    lagerungCost = parseFloat($('input[name=lagerungCost]').val())
                }

                if($('input[name=isLagerungFxPrice]').is(":checked"))
                {
                    $('input[name=lagerungFixedPrice]').val();
                }
                else{
                    lagerungFixedPrice = lagerungCost + parseFloat(chf)
                    $('input[name=lagerungFixedPrice]').val(lagerungFixedPrice);
                }
        })  
        
    })
</script>
{{-- Tarife Fiyatları --}}
    <script>        
        $('select[name=lagerungTariff]').on('change', function () {
            let chf = $(this).find(":selected").data("chf");
            let control = $(this).find(":selected").data('selection');

            if(control != 'bos')
            {
                $(".lagerung-tariffs--area").show(300);
            }
            else
            {
                $('input[name=lagerungChf]').val(0);
                $(".lagerung-tariffs--area").hide(300);
            }
            $('input[name=lagerungChf]').val(chf);
        })        
    </script>
@endsection