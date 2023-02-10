<div class="form-group row">
    <div class="col-md-12 reinigung-control">
        <label for="" class="col-form-label">Reinigung</label><br>
        <input type="checkbox" name="isReinigung" id="isReinigung" class="js-switch " data-color="#9c27b0" data-switchery="false" >  
    </div>                            
</div>

<div class="rounded reinigung--area" style="background-color: #CBB4FF;display:none; ">
    <div class="row p-3">
        <div class="col-md-6">
            <label class=" col-form-label" for="l0">Reinigungsart</label>
            <select class="form-control" class="reinigungType" name="reinigungType" id="reinigungType" >
                <option data-selection="14" value>Bitte wählen</option>
                <option data-selection="0" value="Wohnungsreinigung inkl. Abnahmegarantie">Wohnungsreinigung inkl. Abnahmegarantie</option>
                <option data-selection="1" value="Wohnungsreinigung inkl. Besenrein">Wohnungsreinigung inkl. Besenrein</option>
                <option data-selection="2" value="EFH-Reinigung inkl. Abnahmegarantie">EFH-Reinigung inkl. Abnahmegarantie</option>
                <option data-selection="3" value="EFH-Reinigung inkl. Besenrein">EFH-Reinigung inkl. Besenrein</option>
                <option data-selection="4" value="RFH-Reinigung inkl. Abnahmegarantie">RFH-Reinigung inkl. Abnahmegarantie</option>
                <option data-selection="5" value="RFH-Reinigung inkl. Besenrein">RFH-Reinigung inkl. Besenrein</option>
                <option data-selection="6" value="Baureinigung">Baureinigung</option>
                <option data-selection="7" value="Baureinigung inkl. Abnahmegarantie">Baureinigung inkl. Abnahmegarantie</option>
                <option data-selection="8" value="Baureinigung inkl. Besenrein">Baureinigung inkl. Besenrein</option>
                <option data-selection="9" value="Unterhaltsreinigung">Unterhaltsreinigung</option>
                <option data-selection="10" value="Geschäftsreinigung">Geschäftsreinigung</option>
                <option data-selection="11" value="Büroreinigung">Büroreinigung</option>
                <option data-selection="12" value="Lagerraum-Reinigung">Lagerraum-Reinigung</option>
            </select>

            <label class="col-form-label" for="l0">Manuelle Eingabe (Reinigungsart)</label>
            <input class="form-control" class="extraReinigung"  name="extraReinigung"  type="text" >

            
            <label class="col-form-label" for="l0">Tarif (Pauschal)</label>
            <select class="form-control" class="reinigungFixedPrice" name="reinigungFixedPrice" id="reinigungFixedPrice" >
                <option data-selection="bos"  value>Bitte wählen</option>
                @foreach (\App\Models\Tariff::getList(8) as $key=>$value )
                <option data-selection="0" data-ma="{{ $value['ma'] }}" data-lkw="{{ $value['lkw'] }}" data-an="{{ $value['anhanger'] }}" data-chf ="{{ $value['chf'] }}" value="{{ $value['id'] }}">{{ $value['description'] }}</option>
                @endforeach           
            </select>
            

            <div class="row reinigung-fixed--area p-2 mt-1 rounded" style="display: none;background-color:#8778aa;">
                <div class="col-md-6">
                    <label class="col-form-label" for="l0">Tarifpreis</label>
                    <input class="form-control"  name="reinigungFixedPriceValue" placeholder="0"  type="number">                                
                </div>
            </div>

            <small class="text-primary"> <i>Entweder "Tarifpreis (Pauschal)" oder "Tarif (Stundenansatz)" ausfüllen. Falls Tarifpreis gefüllt ist, wird dieser genommen.</i> </small><br>
            <label class="col-form-label" for="l0">Tarif (Stundenansatz)</label>
            <select class="form-control" class="reinigungPriceTariff" name="reinigungPriceTariff" id="reinigungPriceTariff" >
                <option data-selection="bos"  value>Bitte wählen</option>
                @foreach (\App\Models\Tariff::getList(9) as $key=>$value )
                <option data-selection="0" data-ma="{{ $value['ma'] }}" data-lkw="{{ $value['lkw'] }}" data-an="{{ $value['anhanger'] }}" data-chf ="{{ $value['chf'] }}" value="{{ $value['id'] }}">{{ $value['description'] }}</option>
                @endforeach  
            </select>
            

            <div class="row reinigung-price--area p-2 mt-1 rounded" style="display: none;background-color:#8778aa;">
                <div class="col-md-6">
                    <label class="col-form-label" for="l0">MA</label>
                    <input class="form-control"  name="reinigungmaValue"   type="number" value="0">                                
                </div>

                <div class="col-md-6">
                    <label class="col-form-label" for="l0">CHF-Ansatz</label>
                    <input class="form-control"  name="reinigungchfValue"   type="number" value="0">                                
                </div>

                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Dauer [h]</label>
                    <input class="form-control"  name="reinigunghourValue" placeholder="4-5"   type="text" >                                
                </div>
            </div>
            
            <div class=" row">
                <div class="col-md-12">
                    <label for="" class="col-form-label">Dübellöcher zuspachteln</label>  
                    <div class="radiobox">                                                
                        <label class="text-dark">
                            <input type="radio" class="extraReinigungService1"  name="extraReinigungService1" value="1" > <span class="label-text">Ja</span>
                        </label>
                        <label class="text-dark ml-1">
                            <input type="radio"  class="extraReinigungService1"  name="extraReinigungService1" value="0"checked > <span class="label-text">Nein</span>
                        </label>
                    </div>                                        
                </div>                            
            </div>

            <div class=" row">
                <div class="col-md-12">
                    <label for="" class="col-form-label">Mit Hochdruckreiniger</label>  
                    <div class="radiobox">                                                
                        <label class="text-dark">
                            <input type="radio" class="extraReinigungService2"  name="extraReinigungService2" value="1" > <span class="label-text">Ja</span>
                        </label>
                        <label class="text-dark ml-1">
                            <input type="radio"  class="extraReinigungService2"  name="extraReinigungService2" value="0"checked > <span class="label-text">Nein</span>
                        </label>
                    </div>                                        
                </div>                            
            </div> 
        </div>
        
        <div class="col-md-6">
            <label class=" col-form-label" for="l0">Reinigungstermin</label>
            <input class="form-control" class="date"  name="reinigungdate"  type="date" >   
            
            <label class=" col-form-label" for="l0">Arbeitsbeginn</label>
            <input class="form-control" class="time"  name="reinigungtime"  type="time" > 

            <label class=" col-form-label" for="l0">Abgabetermin</label>
            <input class="form-control" class="date"  name="reinigungEnddate"  type="date" >   
            
            <label class=" col-form-label" for="l0">Abgabezeit</label>
            <input class="form-control" class="time"  name="reinigungEndtime"  type="time" > 

            <div class="extra-cost-reinigung mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="reinigungisExtra" id="reinigungisExtra" class="js-switch " data-color="#9c27b0" data-switchery="false"  >  
            </div>  

            <div class="reinigung--extra--cost--area" style="display: none;">

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="reinigungmasraf"> <span class="label-text text-dark"><strong>Hochdruckreiniger</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="reinigungextra1" type="number" value="200">
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="reinigungmasraf2"> <span class="label-text text-dark"><strong>Stein- und Parkettböden</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="reinigungextra2" type="number" value="350">
                        </div>
                    </div> 

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="reinigungmasraf3"> <span class="label-text text-dark"><strong>Teppichschamponieren</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="reinigungextra3" type="number" value="200">
                        </div>
                    </div>  
    
                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="reinigungCostText1" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="reinigungCost1" placeholder="0"  type="number" value="0">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="reinigungCostText2" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="reinigungCost2" placeholder="0"  type="number" value="0">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0"> Rabatt[%]</label>
                    <input class="form-control"  name="reinigungDiscountPercent" placeholder="0"  type="number" value="0">
                </div>
            </div>
            
            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Abzug</label>
                    <input class="form-control"  name="reinigungExtraDiscountText" placeholder="Freier Text"  type="text" >
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0"> Abzug</label>
                    <input class="form-control"  name="reinigungExtraDiscount" placeholder="0"  type="number" value="0">
                </div>
            </div>

            <label class="col-form-label" for="l0">Kosten</label>
            <input class="form-control"  name="reinigungTotalPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;">
        </div>
    </div>
</div>
@section('offerFooterReinigung')

    {{-- Tarife Ücretleri --}}
    <script>
       
        var morebutton5 = $("div.reinigung-control");
        morebutton5.click(function(){
            if($(this).hasClass("checkbox-checked"))
            {
                $(".reinigung--area").show(700);
                $("select[name=reinigungType]").prop('required',true);      
                $("select[name=reinigungFixedPrice]").prop("required",true);
                $("select[name=reinigungPriceTariff]").prop("required",true);
                $("input[name=reinigungTotalPrice]").prop('required',true); 
                
            }
            else{
                $(".reinigung--area").hide(500);
                $("select[name=reinigungType]").prop('required',false);      
                $("input[name=reinigungTotalPrice]").prop('required',false); 
                $("select[name=reinigungPriceTariff]").prop("required",false);
                $("select[name=reinigungFixedPrice]").prop("required",false);
            }
        })
        
        $("select[name=reinigungFixedPrice]").on("change",function () {
            let chf = $(this).find(":selected").data("chf");
            let ma = $(this).find(":selected").data("ma");
            let lkw = $(this).find(":selected").data("lkw");
            let anhanger = $(this).find(":selected").data("an");
            let control = $(this).find(":selected").data('selection');

            if (control != 'bos')
            {
                $('.reinigung-fixed--area').show(300)
                $("select[name=reinigungPriceTariff]").prop("required",false);
            }
            else
            {
                $('input[name=reinigungFixedPriceValue]').val(0);
                $('.reinigung-fixed--area').hide(300)
            }

            $('input[name=reinigungFixedPriceValue]').val(chf);
        })

        $("select[name=reinigungPriceTariff]").on("change",function () {

            let chf = $(this).find(":selected").data("chf");
            let ma = $(this).find(":selected").data("ma");
            let lkw = $(this).find(":selected").data("lkw");
            let anhanger = $(this).find(":selected").data("an");
            let control = $(this).find(":selected").data('selection');

            if (control != 'bos')
            {
                $('.reinigung-price--area').show(300)
                $("select[name=reinigungFixedPrice]").prop("required",false);
            }
            else
            {
                $('input[name=reinigungmaValue]').val(0);
                $('input[name=reinigungchfValue]').val(0);
                $('.reinigung-price--area').hide(300)
            }

            $('input[name=reinigungmaValue]').val(ma);
            $('input[name=reinigungchfValue]').val(chf);
            })
    </script>



    {{-- İlave ücret Aç/kapa --}}
    <script>
        var extracostbutton = $("div.extra-cost-reinigung");
        extracostbutton.click(function(){
            if($(this).hasClass("checkbox-checked"))
            {
                $(".reinigung--extra--cost--area").show(700);
            }
            else{
                $(".reinigung--extra--cost--area").hide(500);
            }
        })
    </script>
    <script>
        $(document).ready(function(){
            var extra1 = 0;
            var extra2 = 0;
            var extra3 = 0;
            var extra12Cost = 0;
            var extra13Cost = 0;
            var reinigungDiscount = 0;
            var reinigungDiscountPercent = 0;
            
            $('body').on('change','.reinigung--area',function(){
                var SabitFiyat = $('select[name=reinigungFixedPrice]').val();
                
                if($('input[name=reinigungmasraf]').is(":checked")){
                    extra1 = parseFloat($('input[name=reinigungextra1]').val());  
                }
                else {
                    extra1 = 0;
                }
                if ($('input[name=reinigungmasraf2]').is(":checked")){
                    extra2 = parseFloat($('input[name=reinigungextra2]').val());               
                }
                else {
                    extra2 = 0;
                }
                if ($('input[name=reinigungmasraf3]').is(":checked")){
                extra3 = parseFloat($('input[name=reinigungextra3]').val());               
                }
                else {
                    extra3 = 0;
                }

                extra12Cost = parseFloat($('input[name=reinigungCost1]').val());               
                extra13Cost = parseFloat($('input[name=reinigungCost2]').val());
                reinigungDiscount = parseFloat($('input[name=reinigungExtraDiscount]').val());
                reinigungDiscountPercent = parseFloat($('input[name=reinigungDiscountPercent]').val());

                if (SabitFiyat == 0)
                {
                    let reinigungHour = $('input[name=reinigunghourValue]').val()
                    let reinigungChf = $('input[name=reinigungchfValue]').val()
                    let reinigungHours = reinigungHour.split("-");
                    let leftHour = parseFloat(reinigungHours[0]);
                    let rightHour = parseFloat(reinigungHours[1]);

                    calcReinigungPriceLeft = reinigungChf * leftHour +extra1+extra2+extra3+extra12Cost+extra13Cost - reinigungDiscount;
                    calcReinigungPriceRight = reinigungChf * rightHour +extra1+extra2+extra3+extra12Cost+extra13Cost - reinigungDiscount;
                    
                    if(rightHour){
                        if(reinigungDiscountPercent)
                        {
                            calcReinigungPriceRight = calcReinigungPriceRight-(calcReinigungPriceRight*reinigungDiscountPercent/100)
                        }
                        $('input[name=reinigungTotalPrice]').val(calcReinigungPriceRight)
                    }
                    if(leftHour){
                        if(reinigungDiscountPercent)
                        {
                            calcReinigungPriceLeft = calcReinigungPriceLeft-(calcReinigungPriceLeft*reinigungDiscountPercent/100)
                        }
                        $('input[name=reinigungTotalPrice]').val(calcReinigungPriceLeft)
                    }
                    if(leftHour && rightHour ){
                        if(reinigungDiscountPercent)
                        {
                            calcReinigungPriceLeft = calcReinigungPriceLeft-(calcReinigungPriceLeft*reinigungDiscountPercent/100)
                            calcReinigungPriceRight = calcReinigungPriceRight-(calcReinigungPriceRight*reinigungDiscountPercent/100)
                        }
                        $('input[name=reinigungTotalPrice]').val(calcReinigungPriceLeft+'-'+calcReinigungPriceRight) 
                    }
                    if(leftHour == null && rightHour == null)
                    {
                        $('input[name=reinigungTotalPrice]').val('')
                    }
                }
                else
                {
                    var SabitFiyatDegeri = parseFloat($('input[name=reinigungFixedPriceValue]').val());
                    var sabitHesapla = SabitFiyatDegeri + extra1+extra2+extra3+extra12Cost+extra13Cost-reinigungDiscount;
                    if(reinigungDiscountPercent)
                    {
                        sabitHesapla = sabitHesapla-(sabitHesapla*reinigungDiscountPercent/100)
                    }
                    $('input[name=reinigungTotalPrice]').val(sabitHesapla);
                }
            })  
        })
    </script>
@endsection