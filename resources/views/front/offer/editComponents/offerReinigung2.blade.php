<div class="form-group row">
    <div class="col-md-12 reinigung2-control">
        <label for="" class="col-form-label">Reinigung 2</label><br>
        <input type="checkbox" name="isReinigung2" id="isReinigung2" class="js-switch " data-color="#286090" data-switchery="false" @if($reinigung2) checked @endif>  
    </div>                            
</div>

<div class="rounded reinigung2--area bg-service-primary" style="@if($reinigung2 == NULL) display:none; @endif">
    <div class="row p-3">
        <div class="col-md-6">
            <label class=" col-form-label" for="l0">Reinigungsart</label>
            <select class="form-control" class="reinigungType2" name="reinigungType2" id="reinigungType2" >
                <option data-selection="14" value="">Bitte wählen</option>
                <option data-selection="0" value="Wohnungsreinigung inkl. Abnahmegarantie" @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'reinigungType') == 'Wohnungsreinigung inkl. Abnahmegarantie') selected @endif>Wohnungsreinigung inkl. Abnahmegarantie</option>
                <option data-selection="1" value="Wohnungsreinigung inkl. Besenrein" @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'reinigungType') == 'Wohnungsreinigung inkl. Besenrein') selected @endif>Wohnungsreinigung inkl. Besenrein</option>
                <option data-selection="2" value="EFH-Reinigung inkl. Abnahmegarantie" @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'reinigungType') == 'EFH-Reinigung inkl. Abnahmegarantie') selected @endif>EFH-Reinigung inkl. Abnahmegarantie</option>
                <option data-selection="3" value="EFH-Reinigung inkl. Besenrein" @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'reinigungType') == 'EFH-Reinigung inkl. Besenrein') selected @endif>EFH-Reinigung inkl. Besenrein</option>
                <option data-selection="4" value="RFH-Reinigung inkl. Abnahmegarantie" @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'reinigungType') == 'RFH-Reinigung inkl. Abnahmegarantie') selected @endif>RFH-Reinigung inkl. Abnahmegarantie</option>
                <option data-selection="5" value="RFH-Reinigung inkl. Besenrein" @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'reinigungType') == 'RFH-Reinigung inkl. Besenrein') selected @endif>RFH-Reinigung inkl. Besenrein</option>
                <option data-selection="6" value="Baureinigung" @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'reinigungType') == 'Baureinigung') selected @endif>Baureinigung</option>
                <option data-selection="7" value="Baureinigung inkl. Abnahmegarantie" @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'reinigungType') == 'Baureinigung') selected @endif>Baureinigung</option>
                <option data-selection="8" value="Baureinigung inkl. Besenrein" @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'reinigungType') == 'Baureinigung inkl. Besenrein') selected @endif>Baureinigung inkl. Besenrein</option>
                <option data-selection="9" value="Unterhaltsreinigung" @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'reinigungType') == 'Unterhaltsreinigung') selected @endif>Unterhaltsreinigung</option>
                <option data-selection="10" value="Geschäftsreinigung" @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'reinigungType') == 'Geschäftsreinigung') selected @endif>Geschäftsreinigung</option>
                <option data-selection="11" value="Büroreinigung" @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'reinigungType') == 'Büroreinigung') selected @endif>Büroreinigung</option>
                <option data-selection="12" value="Lagerraum-Reinigung" @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'reinigungType') == 'Lagerraum-Reinigung') selected @endif>Lagerraum-Reinigung</option>
            </select>

            <label class="col-form-label" for="l0">Manuelle Eingabe (Reinigungsart)</label>
            <input class="form-control" class="extraReinigung2"  name="extraReinigung2"  type="text" maxlength="255"
            @if($reinigung2) 
                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extraReinigung') }}"
            @endif>
            <small class="mb-3 text-primary"><i>Maximal 255 Zeichen</i></small><br>
            
            <label class="col-form-label" for="l0">Tarif (Pauschal)</label>
            <select class="form-control" class="reinigungFixedPrice2" name="reinigungFixedPrice2" id="reinigungFixedPrice2" >
                <option data-selection="bos"  value>Bitte wählen</option>
                @foreach (\App\Models\Tariff::getList(8) as $key=>$value )
                <option data-selection="0" data-ma="{{ $value['ma'] }}" data-lkw="{{ $value['lkw'] }}" data-an="{{ $value['anhanger'] }}" data-chf ="{{ $value['chf'] }}" value="{{ $value['id'] }}"
                @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'fixedTariff') == $value['id']) selected @endif>{{ $value['description'] }}</option>
                @endforeach              
            </select>
            

            <div class="row reinigung2-fixed--area p-2 mt-1 rounded" style="background-color:#286090;@if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'fixedTariff')) display: block; @else display:none; @endif" >
                <div class="col-md-6">
                    <label class="col-form-label text-white" for="l0">Tarifpreis</label>
                    <input class="form-control"  name="reinigungFixedPriceValue2" placeholder="0"  type="number" 
                    @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'fixedTariff') != NULL) 
                        value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'fixedTariffPrice') }}"
                    @endif>                                
                </div>
            </div>

            <small class="text-primary"> <i>Entweder "Tarifpreis (Pauschal)" oder "Tarif (Stundenansatz)" ausfüllen. Falls Tarifpreis gefüllt ist, wird dieser genommen.</i> </small><br>
            <label class="col-form-label" for="l0">Tarif (Stundenansatz)</label>
            <select class="form-control" class="reinigungPriceTariff2" name="reinigungPriceTariff2" id="reinigungPriceTariff2" >
                <option data-selection="bos"  value>Bitte wählen</option>
                @foreach (\App\Models\Tariff::getList(9) as $key=>$value )
                <option data-selection="0" data-ma="{{ $value['ma'] }}" data-lkw="{{ $value['lkw'] }}" data-an="{{ $value['anhanger'] }}" data-chf ="{{ $value['chf'] }}" value="{{ $value['id'] }}"
                @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'standartTariff') == $value['id']) selected @endif>{{ $value['description'] }}</option>
                @endforeach      
            </select>
            

            <div class="row reinigung2-price--area p-2 mt-1 rounded" style="background-color:#286090;@if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'standartTariff')) display: block; @else display:none; @endif">
                <div class="col-md-6">
                    <label class="col-form-label" for="l0">MA</label>
                    <input class="form-control"  name="reinigungmaValue2" placeholder="0"  type="number" 
                    @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'standartTariff') != NULL) 
                        value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'ma') }}"
                        @else value="{{ 0 }}"
                    @endif>                                
                </div>

                <div class="col-md-6">
                    <label class="col-form-label" for="l0">CHF-Ansatz</label>
                    <input class="form-control"  name="reinigungchfValue2" placeholder="0"  type="number" 
                    @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'standartTariff') != NULL) 
                        value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'chf') }}"
                        @else value="{{ 0 }}"
                    @endif>                                
                </div>

                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Dauer [h]</label>
                    <input class="form-control"  name="reinigunghourValue2" placeholder="4-5"  type="text" 
                    @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'standartTariff') != NULL) 
                        value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'hours') }}"
                        @else value="{{ 0 }}"
                    @endif>                                
                </div>
            </div>

            
            
            <div class=" row">
                <div class="col-md-12">
                    <label for="" class="col-form-label">Dübellöcher zuspachteln</label>  
                    <div class="radiobox">                                                
                        <label class="text-dark">
                            <input type="radio" class="extraReinigungService12"  name="extraReinigungService12" value="1" 
                            @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extraService1') == "1") checked @endif> <span class="label-text">Ja</span>
                        </label>
                        <label class="text-dark ml-1">
                            <input type="radio"  class="extraReinigungService12"  name="extraReinigungService12" value="0"
                            @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extraService1') == "0") checked @endif> <span class="label-text">Nein</span>
                        </label>
                    </div>                                        
                </div>                            
            </div>
        </div>
        <div class="col-md-6">

            <label class=" col-form-label" for="l0">Reinigungstermin</label>
            <input class="form-control" class="date"  name="reinigungdate2"  type="date" 
            @if($reinigung2) 
                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'startDate') }}"
            @endif>   
            
            <label class=" col-form-label" for="l0">Arbeitsbeginn</label>
            <input class="form-control" class="time"  name="reinigungtime2"  type="time" 
            @if($reinigung2) 
                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'startTime') }}"
            @endif> 

            <label class=" col-form-label" for="l0">Abgabetermin</label>
            <input class="form-control" class="date"  name="reinigungEnddate2"  type="date" 
            @if($reinigung2) 
                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'endDate') }}"
            @endif>   
            
            <label class=" col-form-label" for="l0">Abgabezeit</label>
            <input class="form-control" class="time"  name="reinigungEndtime2"  type="time" 
            @if($reinigung2) 
                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'endTime') }}"
            @endif> 

            <div class="extra-cost-reinigung2 mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="reinigungisExtra2" id="reinigungisExtra2" class="js-switch " data-color="#286090" data-switchery="false" 
                @if($reinigung2
                    && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extra1') == NULL 
                    && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extra2') == NULL
                    && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extra3') == NULL
                    && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'customCostValue1') == NULL
                    && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'customCostValue2') == NULL
                    ) 
                    unchecked
                    @else checked
                @endif>  
            </div>  

            <div class="reinigung2--extra--cost--area"
            @if($reinigung2
                && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extra1') == NULL 
                && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extra2') == NULL
                && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extra3') == NULL
                && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'customCostValue1') == NULL
                && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'customCostValue2') == NULL
                ) 
                style="display: none;"
            @endif>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="reinigungmasraf2"
                                    @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extra1')) checked @endif> 
                                    <span class="label-text text-dark"><strong>Hochdruckreiniger</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="reinigungextra12" type="number" 
                            @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extra1')) 
                                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extra1') }}" 
                                @else value="{{ 200 }}" 
                            @endif>
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="reinigungmasraf22"
                                    @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extra2')) checked @endif> 
                                    <span class="label-text text-dark"><strong>Stein- und Parkettböden</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="reinigungextra22" type="number" 
                            @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extra2')) 
                                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extra2') }}" 
                                @else value="{{ 350 }}" 
                            @endif>
                        </div>
                    </div> 

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="reinigungmasraf32"
                                    @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extra3')) checked @endif> 
                                    <span class="label-text text-dark"><strong>Teppichschamponieren</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="reinigungextra32" type="number" 
                            @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extra3')) 
                                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extra3') }}" 
                                @else value="{{ 200 }}" 
                            @endif>
                        </div>
                    </div>  
    
                    <div class="row">
                        <div class="col-md-7">
                            <input class="form-control"  name="reinigungCostText12" placeholder="Freier Text"  type="text" 
                            @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extraCostText1')) 
                                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extraCostText1') }}" 
                            @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="reinigungCost12" placeholder="0"  type="number" 
                            @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extraCostValue1')) 
                                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extraCostValue1') }}" 
                                @else value="{{ 0 }}"
                            @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="reinigungCostText22" placeholder="Freier Text"  type="text" 
                            @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extraCostText2')) 
                                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extraCostText2') }}" 
                            @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="reinigungCost22" placeholder="0"  type="number" 
                            @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extraCostValue2')) 
                                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'extraCostValue2') }}" 
                                @else value="{{ 0 }}"
                            @endif>
                        </div>
                    </div>
                </div>
            </div>
            
            <label class="col-form-label" for="l0">Kosten</label>
            <input class="form-control"  name="reinigungCostPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;"
            @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'costPrice')) 
                        value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'costPrice') }}" 
                    @endif>

            <div class="row">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0"> Rabatt[%]</label>
                    <input class="form-control"  name="reinigungDiscountPercent2" placeholder="0"  type="number" 
                    @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'discountPercent')) 
                        value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'discountPercent') }}" 
                    @endif>
                </div>
            </div>
            
            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Abzug</label>
                    <input class="form-control"  name="reinigungExtraDiscountText2" placeholder="Kesinti Adı"  type="text" 
                    @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'discountText')) 
                        value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'discountText') }}" 
                    @endif>
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0"> Abzug</label>
                    <input class="form-control"  name="reinigungExtraDiscount2" placeholder="0"  type="number" 
                    @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'discount')) 
                        value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'discount') }}" 
                        @else value="{{ 0 }}"
                    @endif>
                </div>
            </div>

            <label class="col-form-label" for="l0">Geschätzte Kosten</label>
            <input class="form-control"  name="reinigungTotalPrice2" placeholder="0"  type="text" style="background-color: #286090;color:white;"
            @if($reinigung2 && \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'totalPrice')) 
                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung2,'totalPrice') }}" 
            @endif>
        </div>
    </div>
</div>
@section('offerReinigung2Edit')

    {{-- Tarife Ücretleri --}}
    <script>
        var morebutton6 = $("div.reinigung2-control");
        morebutton6.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".reinigung2--area").show(700);
            $("select[name=reinigungType2]").prop('required',true);      
            $("select[name=reinigungFixedPrice2]").prop("required",true);
            $("select[name=reinigungPriceTariff2]").prop("required",true);
            $("input[name=reinigungFixedPriceValue2]").prop('required',true); 
            $("input[name=reinigungmaValue2]").prop('required',true);
            $("input[name=reinigungchfValue2]").prop('required',true);
            $("input[name=reinigunghourValue2]").prop('required',true);
        }
        else{
            $(".reinigung2--area").hide(500);
            $("select[name=reinigungType2]").prop('required',false);      
            $("select[name=reinigungFixedPrice2]").prop("required",false);
            $("select[name=reinigungPriceTariff2]").prop("required",false);
            $("input[name=reinigungFixedPriceValue2]").prop('required',false); 
            $("input[name=reinigungmaValue2]").prop('required',false);
            $("input[name=reinigungchfValue2]").prop('required',false);
            $("input[name=reinigunghourValue2]").prop('required',false);
        }
    })

    $("select[name=reinigungFixedPrice2]").on("change",function () {

        let chf = $(this).find(":selected").data("chf");
        let ma = $(this).find(":selected").data("ma");
        let lkw = $(this).find(":selected").data("lkw");
        let anhanger = $(this).find(":selected").data("an");
        let control = $(this).find(":selected").data('selection');

        if (control != 'bos')
        {
            $('.reinigung2-fixed--area').show(300)
            $("select[name=reinigungPriceTariff2]").prop("required",false);
            $("input[name=reinigungmaValue2]").prop('required',false);
            $("input[name=reinigungchfValue2]").prop('required',false);
            $("input[name=reinigunghourValue2]").prop('required',false);

        }
        else
        {
            $('input[name=reinigungFixedPriceValue2]').val(0);
            $('.reinigung2-fixed--area').hide(300)
        }

        $('input[name=reinigungFixedPriceValue2]').val(chf);
    })

    $("select[name=reinigungPriceTariff2]").on("change",function () {

        let chf = $(this).find(":selected").data("chf");
        let ma = $(this).find(":selected").data("ma");
        let lkw = $(this).find(":selected").data("lkw");
        let anhanger = $(this).find(":selected").data("an");
        let control = $(this).find(":selected").data('selection');

        if (control != 'bos')
        {
            $('.reinigung2-price--area').show(300)
            $("select[name=reinigungFixedPrice2]").prop("required",false);
            $("input[name=reinigungFixedPriceValue2]").prop('required',false);

        }
        else
        {
            $('input[name=reinigungmaValue2]').val(0);
            $('input[name=reinigungchfValue2]').val(0);
            $('.reinigung2-price--area').hide(300)
        }

        $('input[name=reinigungmaValue2]').val(ma);
        $('input[name=reinigungchfValue2]').val(chf);
        })
</script>

{{-- İlave ücret Aç/kapa --}}
<script>
    var extracostbutton = $("div.extra-cost-reinigung2");
    extracostbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".reinigung2--extra--cost--area").show(700);
        }
        else{
            $(".reinigung2--extra--cost--area").hide(500);
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
        $('body').on('change','.reinigung2--area',function(){   
            var SabitFiyat = $('select[name=reinigungFixedPrice2]').val();
            
            if($('input[name=reinigungmasraf2]').is(":checked")){
                extra1 = parseFloat($('input[name=reinigungextra12]').val());  
            }
            else {
                extra1 = 0;
            }
            if ($('input[name=reinigungmasraf22]').is(":checked")){
            extra2 = parseFloat($('input[name=reinigungextra22]').val());               
            }
            else {
                extra2 = 0;
            }
            if ($('input[name=reinigungmasraf32]').is(":checked")){
            extra3 = parseFloat($('input[name=reinigungextra32]').val());               
            }
            else {
                extra3 = 0;
            }

            extra12Cost = parseFloat($('input[name=reinigungCost12]').val());               
            extra13Cost = parseFloat($('input[name=reinigungCost22]').val());
            reinigungDiscount = parseFloat($('input[name=reinigungExtraDiscount2]').val());
            reinigungDiscountPercent = parseFloat($('input[name=reinigungDiscountPercent2]').val());

            if (SabitFiyat == 0)
            {
                let reinigungHour = $('input[name=reinigunghourValue2]').val()
                let reinigungChf = $('input[name=reinigungchfValue2]').val()
                let reinigungHours = reinigungHour.split("-");
                let leftHour = parseFloat(reinigungHours[0]);
                let rightHour = parseFloat(reinigungHours[1]);

                calcReinigungPriceLeft = reinigungChf * leftHour +extra1+extra2+extra3+extra12Cost+extra13Cost - reinigungDiscount;
                calcReinigungPriceRight = reinigungChf * rightHour +extra1+extra2+extra3+extra12Cost+extra13Cost - reinigungDiscount;
                
                calcReinigungLeft = reinigungChf * leftHour +extra1+extra2+extra3+extra12Cost+extra13Cost;
                calcReinigungRight = reinigungChf * rightHour +extra1+extra2+extra3+extra12Cost+extra13Cost;

                if(rightHour){
                    if(reinigungDiscountPercent)
                    {
                        calcReinigungPriceRight = calcReinigungRight-(calcReinigungRight*reinigungDiscountPercent/100)
                    }
                    $('input[name=reinigungTotalPrice2]').val(calcReinigungPriceRight)
                    $('input[name=reinigung2CostPrice]').val(calcReinigungRight);
                }
                if(leftHour){
                    if(reinigungDiscountPercent)
                    {
                        calcReinigungPriceLeft = calcReinigungLeft-(calcReinigungLeft*reinigungDiscountPercent/100)
                    }
                    $('input[name=reinigungTotalPrice2]').val(calcReinigungPriceLeft)
                    $('input[name=reinigung2CostPrice]').val(calcReinigungLeft);
                }
                if(leftHour && rightHour ){
                    if(reinigungDiscountPercent)
                    {
                        calcReinigungPriceLeft = calcReinigungLeft-(calcReinigungLeft*reinigungDiscountPercent/100)
                        calcReinigungPriceRight = calcReinigungRight-(calcReinigungRight*reinigungDiscountPercent/100)
                    }
                    $('input[name=reinigungTotalPrice2]').val(calcReinigungPriceLeft+'-'+calcReinigungPriceRight) 
                    $('input[name=reinigung2CostPrice]').val(calcReinigungLeft+'-'+calcReinigungRight);
                }
                if(leftHour == null && rightHour == null)
                {
                    $('input[name=reinigungTotalPrice2]').val('')
                    $('input[name=reinigung2CostPrice]').val('');
                }
            }
            else
            {
                var SabitFiyatDegeri = parseFloat($('input[name=reinigungFixedPriceValue2]').val());
                var sabitHesapla = SabitFiyatDegeri + extra1+extra2+extra3+extra12Cost+extra13Cost-reinigungDiscount;
                var SabitDeger = SabitFiyatDegeri + extra1+extra2+extra3+extra12Cost+extra13Cost;
                if(reinigungDiscountPercent)
                {
                    sabitHesapla = sabitHesapla-(sabitHesapla*reinigungDiscountPercent/100)
                }
                $('input[name=reinigungTotalPrice2]').val(sabitHesapla);
                $('input[name=reinigung2CostPrice]').val(SabitDeger);
            }
        })  
    })
</script>
@endsection