<div class="form-group row">
    <div class="col-md-12 reinigung-control">
        <label for="" class="col-form-label">Reinigung</label><br>
        <input type="checkbox" name="isReinigung" id="isReinigung" class="js-switch " data-color="#286090" data-switchery="false" @if ($reinigung) checked @endif>  
    </div>                            
</div>

<div class="rounded reinigung--area" style="background-color: #C8DFF3; @if($reinigung == NULL) display:none;  @endif">
    <div class="row p-3">
        <div class="col-md-6">
            <label class=" col-form-label" for="l0">Reinigungsart</label>
            <select class="form-control" class="reinigungType" name="reinigungType" id="reinigungType" >
                <option data-selection="14" value="">Bitte wählen</option>
                <option data-selection="0" value="Wohnungsreinigung inkl. Abnahmegarantie" @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'reinigungType') == 'Wohnungsreinigung inkl. Abnahmegarantie') selected @endif>Wohnungsreinigung inkl. Abnahmegarantie</option>
                <option data-selection="1" value="Wohnungsreinigung inkl. Besenrein" @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'reinigungType') == 'Wohnungsreinigung inkl. Besenrein') selected @endif>Wohnungsreinigung inkl. Besenrein</option>
                <option data-selection="2" value="EFH-Reinigung inkl. Abnahmegarantie" @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'reinigungType') == 'EFH-Reinigung inkl. Abnahmegarantie') selected @endif>EFH-Reinigung inkl. Abnahmegarantie</option>
                <option data-selection="3" value="EFH-Reinigung inkl. Besenrein" @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'reinigungType') == 'EFH-Reinigung inkl. Besenrein') selected @endif>EFH-Reinigung inkl. Besenrein</option>
                <option data-selection="4" value="RFH-Reinigung inkl. Abnahmegarantie" @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'reinigungType') == 'RFH-Reinigung inkl. Abnahmegarantie') selected @endif>RFH-Reinigung inkl. Abnahmegarantie</option>
                <option data-selection="5" value="RFH-Reinigung inkl. Besenrein" @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'reinigungType') == 'RFH-Reinigung inkl. Besenrein') selected @endif>RFH-Reinigung inkl. Besenrein</option>
                <option data-selection="6" value="Baureinigung" @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'reinigungType') == 'Baureinigung') selected @endif>Baureinigung</option>
                <option data-selection="7" value="Baureinigung inkl. Abnahmegarantie" @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'reinigungType') == 'Baureinigung inkl. Abnahmegarantie') selected @endif>Baureinigung inkl. Abnahmegarantie</option>
                <option data-selection="8" value="Baureinigung inkl. Besenrein" @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'reinigungType') == 'Baureinigung inkl. Besenrein') selected @endif>Baureinigung inkl. Besenrein</option>
                <option data-selection="9" value="Unterhaltsreinigung" @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'reinigungType') == 'Unterhaltsreinigung') selected @endif>Unterhaltsreinigung</option>
                <option data-selection="10" value="Geschäftsreinigung" @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'reinigungType') == 'Geschäftsreinigung') selected @endif>Geschäftsreinigung</option>
                <option data-selection="11" value="Büroreinigung" @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'reinigungType') == 'Büroreinigung') selected @endif>Büroreinigung</option>
                <option data-selection="12" value="Lagerraum-Reinigung" @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'reinigungType') == 'Lagerraum-Reinigung') selected @endif>Lagerraum-Reinigung</option>           
            </select>

            <label class="col-form-label" for="l0">Manuelle Eingabe (Reinigungsart)</label>
            <input class="form-control" class="extraReinigung"  name="extraReinigung"  type="text" 
            @if($reinigung) 
                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extraReinigung') }}"
            @endif>

            
            <label class="col-form-label" for="l0">Tarif (Pauschal)</label>
            <select class="form-control" class="reinigungFixedPrice" name="reinigungFixedPrice" id="reinigungFixedPrice" >
                <option data-selection="bos"  value="">Bitte wählen</option>
                @foreach (\App\Models\Tariff::getList(8) as $key=>$value )
                <option data-selection="0" data-ma="{{ $value['ma'] }}" data-lkw="{{ $value['lkw'] }}" data-an="{{ $value['anhanger'] }}" data-chf ="{{ $value['chf'] }}" value="{{ $value['id'] }}" 
                @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'fixedTariff') == $value['id']) selected @endif>{{ $value['description'] }}</option>
                @endforeach           
            </select>
            

            <div class="row reinigung-fixed--area p-2 mt-1 rounded" style="background-color:#286090;@if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'fixedTariff')) display: block; @else display: none;  @endif" >
                <div class="col-md-6">
                    <label class="col-form-label text-white" for="l0">Tarifpreis</label>
                    <input class="form-control"   name="reinigungFixedPriceValue" placeholder="0"  type="number"
                    @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'fixedTariff') != NULL) 
                        value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung,'fixedTariffPrice') }}"
                    @endif>                                
                </div>
            </div>

            <small class="text-primary"> <i>Entweder "Tarifpreis (Pauschal)" oder "Tarif (Stundenansatz)" ausfüllen. Falls Tarifpreis gefüllt ist, wird dieser genommen.</i> </small><br>
            <label class="col-form-label" for="l0">Tarif (Stundenansatz)</label>
            <select class="form-control" class="reinigungPriceTariff" name="reinigungPriceTariff" id="reinigungPriceTariff" >
                <option data-selection="bos"  value="">Bitte wählen</option>
                @foreach (\App\Models\Tariff::getList(9) as $key=>$value )
                <option data-selection="0" data-ma="{{ $value['ma'] }}" data-lkw="{{ $value['lkw'] }}" data-an="{{ $value['anhanger'] }}" data-chf ="{{ $value['chf'] }}" value="{{ $value['id'] }}"
                @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'standartTariff') == $value['id']) selected @endif>{{ $value['description'] }}</option>
                @endforeach  
            </select>
            

            <div class="row reinigung-price--area p-2 mt-1 rounded" style="background-color:#286090;
            @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'standartTariff')) display: block; @else display: none;  @endif">
                <div class="col-md-6">
                    <label class="col-form-label" for="l0">MA</label>
                    <input class="form-control"  name="reinigungmaValue"   type="number" 
                    @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'standartTariff') != NULL) 
                        value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung,'ma') }}"
                        @else value="{{ 0 }}"
                    @endif>                                
                </div>

                <div class="col-md-6">
                    <label class="col-form-label" for="l0">CHF-Ansatz</label>
                    <input class="form-control"  name="reinigungchfValue"   type="number" 
                    @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'standartTariff') != NULL) 
                        value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung,'chf') }}"
                        @else value="{{ 0 }}"
                    @endif>                                
                </div>

                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Dauer [h]</label>
                    <input class="form-control"  name="reinigunghourValue"   type="text"  placeholder="4-5"
                    @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'standartTariff') != NULL) 
                        value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung,'hours') }}"
                        @else value="{{ 0 }}"
                    @endif>                                
                </div>
            </div>

            
            
            <div class=" row">
                <div class="col-md-12">
                    <label for="" class="col-form-label">Dübellöcher zuspachteln</label>  
                    <div class="radiobox">                                                
                        <label class="text-dark">
                            <input type="radio" class="extraReinigungService1"  name="extraReinigungService1" value="1" 
                            @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extraService1') == 1) checked @endif> <span class="label-text">Ja</span>
                        </label>
                        <label class="text-dark ml-1">
                            <input type="radio"  class="extraReinigungService1"  name="extraReinigungService1" value="0"
                            @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extraService2') == 0) checked @endif> <span class="label-text">Nein</span>
                        </label>
                    </div>                                        
                </div>                            
            </div>
        </div>
        <div class="col-md-6">

            <label class=" col-form-label" for="l0">Reinigungstermin</label>
            <input class="form-control" class="date"  name="reinigungdate"  type="date" 
            @if($reinigung) 
                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung,'startDate') }}"
            @endif>   
            <label class=" col-form-label" for="l0">Arbeitsbeginn</label>
            <input class="form-control" class="time"  name="reinigungtime"  type="time" 
            @if($reinigung) 
                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung,'startTime') }}"
            @endif> 

            <label class=" col-form-label" for="l0">Abgabetermin</label>
            <input class="form-control" class="date"  name="reinigungEnddate"  type="date" 
            @if($reinigung) 
                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung,'endDate') }}"
            @endif>   
            
            <label class=" col-form-label" for="l0">Abgabezeit</label>
            <input class="form-control" class="time"  name="reinigungEndtime"  type="time" 
            @if($reinigung) 
                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung,'endTime') }}"
            @endif> 

            <div class="extra-cost-reinigung mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="reinigungisExtra" id="reinigungisExtra" class="js-switch " data-color="#286090" data-switchery="false" 
                @if($reinigung
                    && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extra1') == NULL 
                    && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extra2') == NULL
                    && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extra3') == NULL
                    && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'customCostValue1') == NULL
                    && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'customCostValue2') == NULL
                    ) 
                    unchecked
                    @else checked
                @endif>  
            </div>  

            <div class="reinigung--extra--cost--area" 
                @if($reinigung
                    && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extra1') == NULL 
                    && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extra2') == NULL
                    && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extra3') == NULL
                    && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'customCostValue1') == NULL
                    && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'customCostValue2') == NULL
                    ) 
                    style="display: none;"
                @endif>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="reinigungmasraf"
                                    @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extra1')) checked @endif> 
                                    <span class="label-text text-dark"><strong>Hochdruckreiniger</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="reinigungextra1" type="number" 
                            @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extra1')) 
                                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extra1') }}" 
                                @else value="{{ 200 }}" 
                            @endif>
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="reinigungmasraf2"
                                    @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extra2')) checked @endif> 
                                    <span class="label-text text-dark"><strong>Stein- und Parkettböden</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="reinigungextra2" type="number" 
                            @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extra2')) 
                                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extra2') }}" 
                                @else value="{{ 350 }}" 
                            @endif>
                        </div>
                    </div> 

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="reinigungmasraf3"
                                    @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extra3')) checked @endif> 
                                    <span class="label-text text-dark"><strong>Teppichschamponieren</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="reinigungextra3" type="number" 
                            @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extra3')) 
                                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extra3') }}" 
                                @else value="{{ 200 }}" 
                            @endif>
                        </div>
                    </div>  
    
                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="reinigungCostText1" placeholder="Ekstra Ücret 1"  type="text" 
                            @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extraCostText1')) 
                                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extraCostText1') }}" 
                            @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="reinigungCost1" placeholder="0"  type="number" 
                            @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extraCostValue1')) 
                                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extraCostValue1') }}" 
                                @else value="{{ 0 }}"
                            @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="reinigungCostText2" placeholder="Ekstra Ücret 2"  type="text" 
                            @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extraCostText2')) 
                                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extraCostText2') }}" 
                            @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="reinigungCost2" placeholder="0"  type="number" 
                            @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extraCostValue2')) 
                                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung,'extraCostValue2') }}" 
                                @else value="{{ 0 }}"
                            @endif>
                        </div>
                    </div>
                </div>
            </div>
            
            <label class="col-form-label" for="l0">Kosten</label>
            <input class="form-control"  name="reinigungCostPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;"
            @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'costPrice')) 
                        value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung,'costPrice') }}" 
                    @endif>

            <div class="row">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0"> Rabatt[%]</label>
                    <input class="form-control"  name="reinigungDiscountPercent" placeholder="0"  type="number" 
                    @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'discountPercent')) 
                        value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung,'discountPercent') }}" 
                    @endif>
                </div>
            </div>

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Abzug</label>
                    <input class="form-control"  name="reinigungExtraDiscountText" placeholder="Freier Text"  type="text" 
                    @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'discountText')) 
                        value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung,'discountText') }}" 
                    @endif>
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0"> Abzug</label>
                    <input class="form-control"  name="reinigungExtraDiscount" placeholder="0"  type="number" 
                    @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'discount')) 
                        value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung,'discount') }}" 
                        @else value="{{ 0 }}"
                    @endif>
                </div>
            </div>

            <label class="col-form-label" for="l0">Geschätzte Kosten</label>
            <input class="form-control"  name="reinigungTotalPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;"
            @if($reinigung && \App\Models\OfferteReinigung::InfoReinigung($reinigung,'totalPrice')) 
                value="{{ \App\Models\OfferteReinigung::InfoReinigung($reinigung,'totalPrice') }}" 
            @endif>
        </div>
    </div>
</div>
