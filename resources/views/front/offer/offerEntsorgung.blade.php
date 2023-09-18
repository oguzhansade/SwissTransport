
<div class="form-group row">
    <div class="col-md-12 entsorgung-control">
        <label for="" class="col-form-label">Entsorgung</label><br>
        <input type="checkbox" name="isEntsorgung" id="isEntsorgung" class="js-switch " data-color="#286090" data-switchery="false" >  
    </div>                            
</div>

<div class="rounded entsorgung--area" style="background-color: #c8dff3;display:none;">
    <div class="row p-3">
        <div class="col-md-6">
            <label class=" col-form-label" for="l0">Volumen-Tarif</label>
            <select class="form-control" class="entsorgungVolume" name="entsorgungVolume" id="entsorgungVolume" >
                <option data-selection="bos" value>Bitte wählen</option>
                @foreach (\App\Models\Tariff::getList(2) as $key=>$value )
                    <option data-selection="0" data-ma="{{ $value['ma'] }}" data-lkw="{{ $value['lkw'] }}" data-an="{{ $value['anhanger'] }}" data-chf ="{{ $value['chf'] }}" value="{{ $value['id'] }}">{{ $value['description'] }}</option>
                @endforeach
    
            </select>


            <div class="row entsorgung-chfVolume--area p-2 mt-1 rounded" style="display: none;background-color:#286090;">
                <label class="col-form-label text-white" for="l0">CHF-Ansatz</label>
                <input class="form-control" class="entsorgungVolumeChf"  name="entsorgungVolumeChf"  type="text" >
            </div>
            

            <div class="row  rounded" >
                <label class="col-form-label" for="l0">Entsorgungsaufwand Pauschal</label>
                <input class="form-control" class="entsorgungFixedChf"  name="entsorgungFixedChf"  type="text" value="160">
            </div>

            <div class="row  rounded" >
                <label class="col-form-label" for="l0">Geschätztes Volumen [m3]</label>
                <input class="form-control" class="estimatedVolume"  name="estimatedVolume" placeholder="4-5"  type="text" >
            </div>
            <small class="text-primary"><i>Entweder Mitarbeiter-Tarif oder Volumen-Tarif ausfüllen. Oder beides zusammen.</i></small><br>
            <label class=" col-form-label" for="l0">Tarif</label>
            <select class="form-control" class="entsorgungTariff" name="entsorgungTariff" id="entsorgungTariff" >
                <option data-selection="bos"  value>Bitte wählen</option>
                @foreach (\App\Models\Tariff::getList(3) as $key=>$value )
                <option data-selection="0" data-ma="{{ $value['ma'] }}" data-lkw="{{ $value['lkw'] }}" data-an="{{ $value['anhanger'] }}" data-chf ="{{ $value['chf'] }}" value="{{ $value['id'] }}">{{ $value['description'] }}</option>
                @endforeach
            </select>
            
            <div class="row entsorgung-tariffs--area p-2 mt-1 rounded" style="display: none;background-color: rgb(135, 120, 170);">
                <div class="col">
                    <label class=" col-form-label" for="l0">MA</label>
                    <input class="form-control"  name="entsorgungma" placeholder="0"  type="number" >                                
                </div>
                <div class="col">
                    <label class=" col-form-label" for="l0">LKW</label>
                    <input class="form-control"  name="entsorgunglkw" placeholder="0"  type="number" >                                
                </div>
                <div class="col">
                    <label class=" col-form-label" for="l0">Anhänger</label>
                    <input class="form-control"  name="entsorgunganhanger" placeholder="0"  type="number" >                                
                </div>
                <div class="col">
                    <label class=" col-form-label" for="l0">CHF-Ansatz</label>
                    <input class="form-control"  name="entsorgungchf" placeholder="0"  type="number" >                                
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label class=" col-form-label" for="l0">Dauer [h]</label>
                    <input class="form-control"  name="entsorgungHours" placeholder="4-5"  type="text" >                                
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Entsorgungstermin</label>
                    <input class="form-control"  name="entsorgungDate" placeholder="0"  type="date" >                                
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Arbeitsbeginn</label>
                    <input class="form-control"  name="entsorgungTime" placeholder="0"  type="time" >                                
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Anfahrt/Rückfahrt [CHF]</label>
                    <input class="form-control"  name="entsorgungroadChf" placeholder="0"  type="number" value="0">                                
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="extra-cost-entsorgung mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="entsorgungisExtra" id="entsorgungisExtra" class="js-switch " data-color="#286090" data-switchery="false" checked>  
            </div>  

            <div class="entsorgung--extra--cost--area" style="display: block;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="entsorgungmasraf" checked> <span class="label-text text-dark"><strong>Spesen</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="entsorgungextra1" type="number" value="20">
                        </div>
                    </div> 
    
                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="entsorgungCostText1" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="entsorgungCost1" placeholder="0"  type="number" value="0">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="entsorgungCostText2" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="entsorgungCost2" placeholder="0"  type="number" value="0">
                        </div>
                    </div>
                </div>
            </div>
            
            <label class="col-form-label" for="l0">Kosten</label>
            <input class="form-control"  name="entsorgungCostPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;">


            <div class="row">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Rabatt</label>
                    <input class="form-control"  name="entsorgungDiscount"  type="number" value="0">
                </div>
                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Rabatt[%]</label>
                    <input class="form-control"  name="entsorgungDiscountPercent"  type="number" value="0">
                </div>
            </div>

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="entsorgungExtraDiscountText" placeholder="Freier Text"  type="text" >
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="entsorgungExtraDiscount" placeholder="0"  type="number" value="0">
                </div>
            </div>

            <label class="col-form-label" for="l0">Geschätzte Kosten</label>
            <input class="form-control"  name="entsorgungTotalPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;">

            <div class="mt-2 isEntsorgungKostendach">
                <label class="col-form-label" for="l0">Kostendach</label>
                <input type="checkbox"  name="isEntsorgungKostendach" id="isEntsorgungKostendach" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
            </div>

            <div class="entsorgung-kostendach-area" style="display: none;">
                <input class="form-control"  name="entsorgungTopPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;">

                <div class="mt-2">
                    <small class=" text-primary">manuell gesetzt</small>
                    <input type="checkbox" name="isEntsorgungMTPrice" id="isEntsorgungMTPrice" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
                </div> 
            </div>

            <div class="mt-3 isEntsorgungPauschal">
                <label class="col-form-label" for="l0">Pauschal</label>
                <input type="checkbox"  name="isEntsorgungPauschal" id="isEntsorgungPauschal" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
            </div>

            <div class="entsorgung-pauschal-area " style="display:none;">
                <input class="form-control"  name="entsorgungDefaultPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;">

                <div class="mt-2">
                    <small class=" text-primary">manuell gesetzt</small>
                    <input type="checkbox" name="isEntsorgungFxPrice" id="isEntsorgungFxPrice" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
                </div> 
            </div>
        </div>
    </div>
</div>

@section('offerEntsorgung')

<script>        
    $("input[name=entsorgungma]").on('change', function() {
        let ma = $("input[name=entsorgungma]").val();
        let spesen = $("input[name=entsorgungextra1]").val();
        spesen = ma * 20;
        $("input[name=entsorgungextra1]").val(spesen);
    })

    var morebutton7 = $("div.entsorgung-control");
    morebutton7.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".entsorgung--area").show(700);
            $("select[name=entsorgungVolume]").prop('required',true);      
            $("select[name=entsorgungTariff]").prop('required',true);  
            
            $("input[name=entsorgungVolumeChf]").prop('required',true); 
            $("input[name=entsorgungma]").prop('required',true); 
            $("input[name=entsorgunglkw]").prop('required',true);
            $("input[name=entsorgunganhanger]").prop('required',true);
            $("input[name=entsorgungchf]").prop('required',true);
            
        }
        else{
            $(".entsorgung--area").hide(500);
            $("select[name=entsorgungVolume]").prop('required',false);      
            $("select[name=entsorgungTariff]").prop('required',false);  
            $("input[name=entsorgungTotalPrice]").prop('required',false); 
            $("input[name=entsorgungVolumeChf]").prop('required',false); 
            $("input[name=entsorgungma]").prop('required',false); 
            $("input[name=entsorgunglkw]").prop('required',false);
            $("input[name=entsorgunganhanger]").prop('required',false);
            $("input[name=entsorgungchf]").prop('required',false);
        }
    })

    $("select[name=entsorgungVolume]").on("change",function () {
     let chf = $(this).find(":selected").data("chf");
     let control = $(this).find(":selected").data('selection');
     if (control != 'bos')
     {
        $('.entsorgung-chfVolume--area').show(300)  
        $("select[name=entsorgungTariff]").prop('required',false);  
        $("input[name=entsorgungma]").prop('required',false); 
        $("input[name=entsorgunglkw]").prop('required',false);
        $("input[name=entsorgunganhanger]").prop('required',false);
        $("input[name=entsorgungchf]").prop('required',false);
     }
     else
     {
        $('input[name=entsorgungVolumeChf]').val(0);
        $('.entsorgung-chfVolume--area').hide(300)
     }
     $('input[name=entsorgungVolumeChf]').val(chf);
    })


    $("select[name=entsorgungTariff]").on("change",function () {

       let chf = $(this).find(":selected").data("chf");
       let ma = $(this).find(":selected").data("ma");
       let lkw = $(this).find(":selected").data("lkw");
       let anhanger = $(this).find(":selected").data("an");
       let control = $(this).find(":selected").data('selection');
       let spesen = $("input[name=entsorgungextra1]").val(20);

       if (control != 'bos')
       {
          $('.entsorgung-tariffs--area').show(300)
          $("select[name=entsorgungVolume]").prop('required',false);   
          $("input[name=entsorgungVolumeChf]").prop('required',false);    
       }
       else
       {
          $('input[name=entsorgungchf]').val(0);
          $('input[name=entsorgungma]').val(0);
          $('input[name=entsorgunglkw]').val(0);
          $('input[name=entsorgunganhanger]').val(0);
          $('.entsorgung-tariffs--area').hide(300)
       }
  
        $('input[name=entsorgungchf]').val(chf);
        $('input[name=entsorgungma]').val(ma);
        $('input[name=entsorgunglkw]').val(lkw);
        $('input[name=entsorgunganhanger]').val(anhanger);
        spesen = ma * 20;
        $("input[name=entsorgungextra1]").val(spesen);
      })

    var isEntsorgungKostendachButton = $("div.isEntsorgungKostendach");
    var isEntsorgungPauschalbutton = $("div.isEntsorgungPauschal");
    isEntsorgungKostendachButton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".entsorgung-kostendach-area").show(700);
        }
        else{
            $(".entsorgung-kostendach-area").hide(500);
        }
    })

    isEntsorgungPauschalbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".entsorgung-pauschal-area").show(700);
        }
        else{
            $(".entsorgung-pauschal-area").hide(500);
        }
    })
</script>


{{-- İlave ücret Aç/kapa --}}
<script>
    var extracostbutton = $("div.extra-cost-entsorgung");
    extracostbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".entsorgung--extra--cost--area").show(700);
        }
        else{
            $(".entsorgung--extra--cost--area").hide(500);
        }
    })
</script>
<script>
    $(document).ready(function(){
        
        $('body').on('change','.entsorgung--area',function(){
            if ($('input[name=entsorgungmasraf]').is(":checked")){
                var extra1 = parseFloat($('input[name=entsorgungextra1]').val());               
            }
            else {
                extra1 = 0;
            }

            let entsorgungDiscount = $('input[name=entsorgungDiscount]').val();
            let entsorgungDiscountPercent = $('input[name=entsorgungDiscountPercent]').val();
            let volumeChf = $('input[name=entsorgungVolumeChf]').val();
            let fixedChf = parseFloat($('input[name=entsorgungFixedChf]').val());
            if(fixedChf > 0){
                fixedChf = fixedChf
            }
            else{
                fixedChf = 0
            }
            let tariffChf = $('input[name=entsorgungchf]').val();
            let entsorgungHours = $('input[name=entsorgungHours]').val();
            let allHours = entsorgungHours.split("-");
            let leftHour = parseFloat(allHours[0]);
            let rightHour = parseFloat(allHours[1]);

            let roadChf = $('input[name=entsorgungroadChf]').val();
            
            let calcEntTariffLeft = (tariffChf*leftHour)+parseFloat(roadChf)
            let calcEntTariffRight = (tariffChf*rightHour)+parseFloat(roadChf)

            let esVolume = $('input[name=estimatedVolume]').val();
            let allVolume = esVolume.split("-");
            let leftVolume = parseFloat(allVolume[0]);
            let rightVolume = parseFloat(allVolume[1]);

            let entsorgungExtraDiscount = $('input[name=entsorgungExtraDiscount]').val();
            let entsorgungCost1 = parseFloat($('input[name=entsorgungCost1]').val())
            let entsorgungCost2 = parseFloat($('input[name=entsorgungCost2]').val())

            let entsorgungTotalPriceLeft = 0
            let entsorgungTotalPriceRight = 0

            let entsorgungTotalPriceLeftH = 0
            let entsorgungTotalPriceRightH = 0

            if(leftVolume)
            {
                if(leftHour)
                {
                    entsorgungTotalPriceLeft = volumeChf * leftVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungLeftCost = volumeChf * leftVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2;
                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceLeft = entsorgungTotalPriceLeft - (entsorgungTotalPriceLeft*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceLeft)
                    $('input[name=entsorgungCostPrice]').val(entsorgungLeftCost)
                }
                if(rightHour)
                {
                    entsorgungTotalPriceLeft = volumeChf * leftVolume + fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungRightCost = entsorgungTotalPriceLeft = volumeChf * leftVolume + fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2;
                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceLeft = entsorgungTotalPriceLeft - (entsorgungTotalPriceLeft*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceLeft)
                    $('input[name=entsorgungCostPrice]').val(entsorgungRightCost)
                }
                if(leftHour && rightHour)
                {
                    entsorgungTotalPriceLeft = volumeChf * leftVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalPriceRight = volumeChf * leftVolume + fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                   
                    entsorgungLeftCost = volumeChf * leftVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2;
                    entsorgungRightCost = entsorgungTotalPriceLeft = volumeChf * leftVolume + fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2;
                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceLeft = entsorgungTotalPriceLeft - (entsorgungTotalPriceLeft*entsorgungDiscountPercent/100);
                        entsorgungTotalPriceRight = entsorgungTotalPriceRight - (entsorgungTotalPriceRight*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceLeft+'-'+entsorgungTotalPriceRight);
                    $('input[name=entsorgungCostPrice]').val(entsorgungLeftCost+'-'+entsorgungRightCost);
                }
               
                if(!leftHour && !rightHour)
                {
                    entsorgungTotalPriceLeft = volumeChf * leftVolume + fixedChf + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungLeftCost = volumeChf * leftVolume + fixedChf + extra1 + entsorgungCost1 + entsorgungCost2;
                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceLeft = entsorgungTotalPriceLeft - (entsorgungTotalPriceLeft*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceLeft)
                    $('input[name=entsorgungCostPrice]').val(entsorgungLeftCost);
                    
                }
                
            }

            if(rightVolume)
            {
                if(rightHour)
                {
                    entsorgungTotalPriceRight = volumeChf * rightVolume + fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalRight = volumeChf * rightVolume + fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2
                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceRight = entsorgungTotalPriceRight - (entsorgungTotalPriceRight*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceRight)
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalRight);
                }
                if(leftHour)
                {
                    entsorgungTotalPriceRight = volumeChf * rightVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalLeft = volumeChf * rightVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2;
                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceRight = entsorgungTotalPriceRight - (entsorgungTotalPriceRight*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceRight)
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalLeft);
                }
                if(leftHour && rightHour)
                {
                    entsorgungTotalPriceLeft = volumeChf * rightVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalPriceRight = volumeChf * rightVolume + fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    
                    entsorgungTotalLeft = volumeChf * rightVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2;
                    entsorgungTotalRight = volumeChf * rightVolume + fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2

                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceLeft = entsorgungTotalPriceLeft - (entsorgungTotalPriceLeft*entsorgungDiscountPercent/100);
                        entsorgungTotalPriceRight = entsorgungTotalPriceRight - (entsorgungTotalPriceRight*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceLeft+'-'+entsorgungTotalPriceRight);
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalLeft+'-'+entsorgungTotalRight);
                }
                if(!leftHour && !rightHour)
                {
                    entsorgungTotalPriceRight = volumeChf * rightVolume + fixedChf + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalRight = volumeChf * rightVolume + fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2;

                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceRight = entsorgungTotalPriceRight - (entsorgungTotalPriceRight*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceRight)
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalRight);
                }

                
            }

            if(leftVolume && rightVolume )
            {
                if(leftHour)
                {
                    entsorgungTotalPriceLeft = volumeChf * leftVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalPriceRight = volumeChf * rightVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    
                    entsorgungTotalLeft = volumeChf * leftVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2;
                    entsorgungTotalRight = volumeChf * rightVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2;

                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceLeft = entsorgungTotalPriceLeft - (entsorgungTotalPriceLeft*entsorgungDiscountPercent/100);
                        entsorgungTotalPriceRight = entsorgungTotalPriceRight - (entsorgungTotalPriceRight*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceLeft+'-'+entsorgungTotalPriceRight) 
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalLeft+'-'+entsorgungTotalRight);
                }
                if(rightHour)
                {
                    entsorgungTotalPriceLeft = volumeChf * leftVolume + fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalPriceRight = volumeChf * rightVolume + fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    
                    entsorgungTotalLeft = volumeChf * leftVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2;
                    entsorgungTotalRight = volumeChf * rightVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2;
                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceLeft = entsorgungTotalPriceLeft - (entsorgungTotalPriceLeft*entsorgungDiscountPercent/100);
                        entsorgungTotalPriceRight = entsorgungTotalPriceRight - (entsorgungTotalPriceRight*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceLeft+'-'+entsorgungTotalPriceRight) 
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalLeft+'-'+entsorgungTotalRight);
                }
                if(leftHour && rightHour)
                {
                    entsorgungTotalPriceLeft = volumeChf * leftVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalPriceRight = volumeChf * rightVolume + fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    
                    entsorgungTotalLeft = volumeChf * leftVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2;
                    entsorgungTotalRight = volumeChf * rightVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2;

                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceLeft = entsorgungTotalPriceLeft - (entsorgungTotalPriceLeft*entsorgungDiscountPercent/100);
                        entsorgungTotalPriceRight = entsorgungTotalPriceRight - (entsorgungTotalPriceRight*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceLeft+'-'+entsorgungTotalPriceRight) 
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalLeft+'-'+entsorgungTotalRight);
                }
                if(!leftHour && !rightHour)
                {
                    entsorgungTotalPriceLeft = volumeChf * leftVolume + fixedChf +  extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalPriceRight = volumeChf * rightVolume + fixedChf +  extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                   
                    entsorgungTotalLeft = volumeChf * leftVolume + fixedChf +  extra1 + entsorgungCost1 + entsorgungCost2;
                    entsorgungTotalRight = volumeChf * rightVolume + fixedChf +  extra1 + entsorgungCost1 + entsorgungCost2;
                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceLeft = entsorgungTotalPriceLeft - (entsorgungTotalPriceLeft*entsorgungDiscountPercent/100);
                        entsorgungTotalPriceRight = entsorgungTotalPriceRight - (entsorgungTotalPriceRight*entsorgungDiscountPercent/100);
                    }

                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceLeft+'-'+entsorgungTotalPriceRight)
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalLeft+'-'+entsorgungTotalRight);
                }
                 
            }

            if(!leftVolume && !rightVolume)
            {
                if(leftHour)
                {
                    entsorgungTotalPriceLeftH =   calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalLeftH = calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2;
                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceLeftH = entsorgungTotalPriceLeftH - (entsorgungTotalPriceLeftH*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceLeftH)
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalLeftH);
                }
                if(rightHour)
                {
                    entsorgungTotalPriceRightH =  calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalRightH = calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2;
                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceRightH = entsorgungTotalPriceRightH - (entsorgungTotalPriceRightH*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceRightH)
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalRightH);
                }
                if(leftHour && rightHour)
                {
                    entsorgungTotalPriceLeftH = calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalPriceRightH = calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    
                    entsorgungTotalLeftH = calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2 ;
                    entsorgungTotalRightH = calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2;
                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceLeftH = entsorgungTotalPriceLeftH - (entsorgungTotalPriceLeftH*entsorgungDiscountPercent/100);
                        entsorgungTotalPriceRightH = entsorgungTotalPriceRightH - (entsorgungTotalPriceRightH*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceLeftH+'-'+entsorgungTotalPriceRightH)
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalLeftH+'-'+entsorgungTotalRightH)
                }
                
            }

            if(leftHour)
            {
                if(leftVolume)
                {
                    entsorgungTotalPriceLeftH = volumeChf * leftVolume +  fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalLeftH = volumeChf * leftVolume +  fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2 

                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceLeftH = entsorgungTotalPriceLeftH - (entsorgungTotalPriceLeftH*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceLeftH)
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalLeftH)
                }
                if(rightVolume)
                {
                    entsorgungTotalPriceLeftH = volumeChf * rightVolume +  fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalLeftH = volumeChf * rightVolume +  fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2

                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceLeftH = entsorgungTotalPriceLeftH - (entsorgungTotalPriceLeftH*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceLeftH)
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalLeftH)
                }
                if(leftVolume && rightVolume)
                {
                    entsorgungTotalPriceLeftH = volumeChf * leftVolume +  fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalPriceLeftH2 = volumeChf * rightVolume +  fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    
                    entsorgungTotalLeftH = volumeChf * leftVolume +  fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2
                    entsorgungTotalLeftH2 = volumeChf * rightVolume +  fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2
                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceLeftH = entsorgungTotalPriceLeftH - (entsorgungTotalPriceLeftH*entsorgungDiscountPercent/100);
                        entsorgungTotalPriceLeftH2 = entsorgungTotalPriceLeftH2 - (entsorgungTotalPriceLeftH2*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceLeftH+'-'+entsorgungTotalPriceLeftH2)
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalLeftH+'-'+entsorgungTotalLeftH2)
                }
                if(!leftVolume && !rightVolume)
                {
                    entsorgungTotalPriceLeftH =  fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalLeftH =  fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2
                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceLeftH = entsorgungTotalPriceLeftH - (entsorgungTotalPriceLeftH*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceLeftH)
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalLeftH)
                }
            }

            if(rightHour)
            {
                if(leftVolume)
                {
                    entsorgungTotalPriceRightH = volumeChf * leftVolume +  fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalRightH = volumeChf * leftVolume +  fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2
                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceRightH = entsorgungTotalPriceRightH - (entsorgungTotalPriceRightH*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceRightH)
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalRightH)
                }
                if(rightVolume)
                {
                    entsorgungTotalPriceRightH = volumeChf * rightVolume +  fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalRightH = volumeChf * rightVolume +  fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2

                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceRightH = entsorgungTotalPriceRightH - (entsorgungTotalPriceRightH*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceRightH)
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalRightH)
                }
                if(leftVolume && rightVolume)
                {
                    entsorgungTotalPriceRightH = volumeChf * leftVolume +  fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalPriceRightH2 = volumeChf * rightVolume +  fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    
                    entsorgungTotalRightH = volumeChf * leftVolume +  fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2 
                    entsorgungTotalRightH2 = volumeChf * rightVolume +  fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2
                    

                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceRightH = entsorgungTotalPriceRightH - (entsorgungTotalPriceRightH*entsorgungDiscountPercent/100);
                        entsorgungTotalPriceRightH2 = entsorgungTotalPriceRightH2 - (entsorgungTotalPriceRightH2*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceRightH+'-'+entsorgungTotalPriceRightH2);
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalRightH+'-'+entsorgungTotalRightH2);
                }
                if(!leftVolume && !rightVolume)
                {
                    entsorgungTotalPriceRightH =  fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalRightH =  fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2
                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceRightH = entsorgungTotalPriceRightH - (entsorgungTotalPriceRightH*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceRightH)
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalRightH)
                }
            }

            if(leftHour && rightHour)
            {
                if(leftVolume)
                {
                    entsorgungTotalPriceLeftH = volumeChf * leftVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalPriceRightH = volumeChf * leftVolume + fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;

                    entsorgungTotalLeftH = volumeChf * leftVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2
                    entsorgungTotalRightH = volumeChf * leftVolume + fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2

                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceLeftH = entsorgungTotalPriceLeftH - (entsorgungTotalPriceLeftH*entsorgungDiscountPercent/100);
                        entsorgungTotalPriceRightH = entsorgungTotalPriceRightH - (entsorgungTotalPriceRightH*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceLeftH+'-'+entsorgungTotalPriceRightH) 
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalLeftH+'-'+entsorgungTotalRightH) 
                }
                if(rightVolume)
                {
                    entsorgungTotalPriceLeftH = volumeChf * rightVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalPriceRightH = volumeChf * rightVolume + fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;

                    entsorgungTotalLeftH = volumeChf * rightVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2
                    entsorgungTotalRightH = volumeChf * rightVolume + fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2

                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceLeftH = entsorgungTotalPriceLeftH - (entsorgungTotalPriceLeftH*entsorgungDiscountPercent/100);
                        entsorgungTotalPriceRightH = entsorgungTotalPriceRightH - (entsorgungTotalPriceRightH*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceLeftH+'-'+entsorgungTotalPriceRightH) 
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalLeftH+'-'+entsorgungTotalRightH) 
                }
            
                if(leftVolume && rightVolume)
                {
                    entsorgungTotalPriceLeftH = volumeChf * leftVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalPriceRightH = volumeChf * rightVolume + fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;

                    entsorgungTotalLeftH = volumeChf * leftVolume + fixedChf + calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2
                    entsorgungTotalRightH = volumeChf * rightVolume + fixedChf + calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2

                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceLeftH = entsorgungTotalPriceLeftH - (entsorgungTotalPriceLeftH*entsorgungDiscountPercent/100);
                        entsorgungTotalPriceRightH = entsorgungTotalPriceRightH - (entsorgungTotalPriceRightH*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceLeftH+'-'+entsorgungTotalPriceRightH) 
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalLeftH+'-'+entsorgungTotalRightH) 
                }
                if(!leftVolume && !rightVolume)
                {
                    entsorgungTotalPriceLeftH = calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalPriceRightH = calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;

                    entsorgungTotalLeftH = calcEntTariffLeft + extra1 + entsorgungCost1 + entsorgungCost2
                    entsorgungTotalRightH = calcEntTariffRight + extra1 + entsorgungCost1 + entsorgungCost2

                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceLeftH = entsorgungTotalPriceLeftH - (entsorgungTotalPriceLeftH*entsorgungDiscountPercent/100);
                        entsorgungTotalPriceRightH = entsorgungTotalPriceRightH - (entsorgungTotalPriceRightH*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceLeftH+'-'+entsorgungTotalPriceRightH) 
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalLeftH+'-'+entsorgungTotalRightH) 
                }
            }

            if(!leftHour && !rightHour)
            {
                if(leftVolume)
                {
                    entsorgungTotalPriceLeftH = volumeChf * leftVolume +  fixedChf  + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalLeftH = volumeChf * leftVolume +  fixedChf  + extra1 + entsorgungCost1 + entsorgungCost2
                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceLeftH = entsorgungTotalPriceLeftH - (entsorgungTotalPriceLeftH*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceLeftH)
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalLeftH)
                }
                if(rightVolume)
                {
                    entsorgungTotalPriceLeftH = volumeChf * rightVolume +  fixedChf  + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalLeftH = volumeChf * rightVolume +  fixedChf  + extra1 + entsorgungCost1 + entsorgungCost2
                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceLeftH = entsorgungTotalPriceLeftH - (entsorgungTotalPriceLeftH*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceLeftH)
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalLeftH)
                }
                if(leftVolume && rightVolume)
                {
                    entsorgungTotalPriceLeftH = volumeChf * leftVolume +  fixedChf  + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;
                    entsorgungTotalPriceRightH = volumeChf * rightVolume +  fixedChf  + extra1 + entsorgungCost1 + entsorgungCost2 - entsorgungDiscount - entsorgungExtraDiscount;

                    entsorgungTotalLeftH = volumeChf * leftVolume +  fixedChf  + extra1 + entsorgungCost1 + entsorgungCost2
                    entsorgungTotalRightH = volumeChf * rightVolume +  fixedChf  + extra1 + entsorgungCost1 + entsorgungCost2
                    if(entsorgungDiscountPercent)
                    {
                        entsorgungTotalPriceLeftH = entsorgungTotalPriceLeftH - (entsorgungTotalPriceLeftH*entsorgungDiscountPercent/100);
                        entsorgungTotalPriceRightH = entsorgungTotalPriceRightH - (entsorgungTotalPriceRightH*entsorgungDiscountPercent/100);
                    }
                    $('input[name=entsorgungTotalPrice]').val(entsorgungTotalPriceLeftH + '-' + entsorgungTotalPriceRightH)
                    $('input[name=entsorgungCostPrice]').val(entsorgungTotalLeftH + '-' + entsorgungTotalRightH)
                }
                if(!leftVolume && !rightVolume)
                {
                    $('input[name=entsorgungTotalPrice]').val('');
                    $('input[name=entsorgungCostPrice]').val('');
                }
            }
        })
        $('body').on('change','.entsorgung--area',function(){
            let tariffChf2 = $('input[name=entsorgungchf]').val();
            let volumeChf = $('input[name=entsorgungVolumeChf]').val();
            let entTotalPrices = $('input[name=entsorgungTotalPrice]').val();
            entTotalPricesARR = entTotalPrices.split("-");
            let entTotalPrice = 0;
            
            leftTotal = parseFloat(entTotalPricesARR[0]);
            rightTotal = parseFloat(entTotalPricesARR[1]);

            if(leftTotal >= rightTotal)
            {
                entTotalPrice = leftTotal;
            }
            else if(rightTotal >= leftTotal)
            {
                entTotalPrice = rightTotal;
            }
            else{
                entTotalPrice = parseFloat($('input[name=entsorgungTotalPrice]').val());
            }

            if($('input[name=isEntsorgungMTPrice]').is(":checked"))
            {
                $('input[name=entsorgungTopPrice]').val();
            }
            else{
                if(tariffChf2)
                {
                    entTopPrice = entTotalPrice + parseFloat(tariffChf2);
                    if(!isNaN(entTopPrice))
                    {
                        $('input[name=entsorgungTopPrice]').val(entTopPrice);
                    }
                    else {
                        $('input[name=entsorgungTopPrice]').val(0);
                    }
                    
                }
                else{
                    entTopPrice = entTotalPrice + parseFloat(volumeChf);
                    if(!isNaN(entTopPrice))
                    {
                        $('input[name=entsorgungTopPrice]').val(entTopPrice);
                    }
                    else {
                        $('input[name=entsorgungTopPrice]').val(0);
                    }
                }
            }

            if($('input[name=isEntsorgungFxPrice]').is(":checked"))
            {
                $('input[name=entsorgungDefaultPrice]').val();
            }
            else{
                if(tariffChf2)
                {
                    entsorgungDefaultPrice = entTotalPrice + parseFloat(tariffChf2);
                    $('input[name=entsorgungDefaultPrice]').val(entsorgungDefaultPrice);
                }
                else{
                    entsorgungDefaultPrice = entTotalPrice + parseFloat(volumeChf);
                    $('input[name=entsorgungDefaultPrice]').val(entsorgungDefaultPrice);
                }
            }

            
            
        })  
    })
</script>
@endsection