
<div class="form-group row">
    <div class="col-md-12 auspack-control">
        <label for="" class="col-form-label">Auspack</label><br>
        <input type="checkbox" name="isAuspack" id="isAuspack" class="js-switch " data-color="#286090" data-switchery="false" @if ($auspack) checked @endif>  
    </div>                            
</div>

<div class="rounded auspack--area" style="background-color: #C8DFF3; @if($auspack == NULL) display:none;  @endif">
    <div class="row p-3">
        <div class="col-md-6">
            <label class=" col-form-label" for="l0">Tarif</label>
            <select class="form-control" class="auspackTariff" name="auspackTariff" id="auspackTariff" >
                <option data-selection="bos"  value>Bitte wählen</option>
                @foreach (\App\Models\Tariff::getList(7) as $key=>$value )
                <option data-selection="0" data-ma="{{ $value['ma'] }}" data-lkw="{{ $value['lkw'] }}" data-an="{{ $value['anhanger'] }}" data-chf ="{{ $value['chf'] }}" value="{{ $value['id'] }}"
                @if($auspack && \App\Models\OfferteAuspack::InfoAuspack($auspack,'tariff') == $value['id']) selected @endif>{{ $value['description'] }}</option>
                @endforeach
            </select>

            <div class="row auspack-tariffs--area"  @if($auspack == NULL) style="display: none;" @endif>
                <div class="col">
                    <label class=" col-form-label" for="l0">MA</label>
                    <input class="form-control"  name="auspack1ma" placeholder="0"  type="number" 
                    @if($auspack) 
                    value="{{ \App\Models\OfferteAuspack::InfoAuspack($auspack,'ma') }}"
                    @endif>                                
                </div>
                <div class="col">
                    <label class=" col-form-label" for="l0">CHF-Ansatz</label>
                    <input class="form-control"  name="auspack1chf" placeholder="0"  type="number" 
                    @if($auspack) 
                    value="{{ \App\Models\OfferteAuspack::InfoAuspack($auspack,'chf') }}"
                    @endif>                                
                </div>
            </div>
            
            <label class=" col-form-label" for="l0">Packtermin</label>
            <input class="form-control" class="date"  name="auspackdate"  type="date" 
            @if($auspack) 
                value="{{ \App\Models\OfferteAuspack::InfoAuspack($auspack,'auspackDate') }}"
            @endif> 

            <label class=" col-form-label" for="l0">Arbeitsbeginn</label>
            <input class="form-control" class="time"  name="auspacktime"  type="time" 
            @if($auspack) 
                value="{{ \App\Models\OfferteAuspack::InfoAuspack($auspack,'auspackTime') }}"
            @endif> 

            <label class=" col-form-label" for="l0">Anfahrt/Rückfahrt [CHF]</label>
            <input class="form-control" class="date"  name="auspackroadChf"  type="number" 
            @if($auspack) 
                value="{{ \App\Models\OfferteAuspack::InfoAuspack($auspack,'arrivalReturn') }}"
                @else value="{{ 0 }}"
            @endif> 

        </div>
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Dauer [h]</label>
            <input class="form-control"  name="auspackHours" placeholder="4-5"  type="text" 
            @if($auspack) 
                value="{{ \App\Models\OfferteAuspack::InfoAuspack($auspack,'moveHours') }}"
                @else value="{{ 0 }}"
            @endif>  
            
            <div class="extra-cost-auspack mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="auspackisExtra" id="auspackisExtra" class="js-switch " data-color="#286090" data-switchery="false" 
                @if($auspack
                && \App\Models\OfferteAuspack::InfoAuspack($auspack,'extra') == NULL 
                && \App\Models\OfferteAuspack::InfoAuspack($auspack,'extra1') == NULL
                && \App\Models\OfferteAuspack::InfoAuspack($auspack,'customCostPrice1') == NULL
                && \App\Models\OfferteAuspack::InfoAuspack($auspack,'customCostPrice2') == NULL
                ) 
                unchecked
                @else checked
                @endif>  
            </div>  

            <div class="auspack--extra--cost--area" 
            @if($auspack
                && \App\Models\OfferteAuspack::InfoAuspack($auspack,'extra') == NULL 
                && \App\Models\OfferteAuspack::InfoAuspack($auspack,'extra1') == NULL
                && \App\Models\OfferteAuspack::InfoAuspack($auspack,'customCostPrice1') == NULL
                && \App\Models\OfferteAuspack::InfoAuspack($auspack,'customCostPrice2') == NULL
                ) 
                style="display: none;"
            @endif>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="auspackmasraf"
                                    @if($auspack && \App\Models\OfferteAuspack::InfoAuspack($auspack,'extra')) checked @endif> 
                                    <span class="label-text text-dark"><strong>Spesen</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="auspackextra1" type="number" 
                            @if($auspack && \App\Models\OfferteAuspack::InfoAuspack($auspack,'extra')) 
                                value="{{ \App\Models\OfferteAuspack::InfoAuspack($auspack,'extra') }}" 
                                @else value="{{ 20 }}" 
                            @endif>
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="auspackmasraf1"
                                    @if($auspack && \App\Models\OfferteAuspack::InfoAuspack($auspack,'extra1')) checked @endif> 
                                    <span class="label-text text-dark"><strong>Verpackungsmaterial</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="auspackextra2" type="number" 
                            @if($auspack && \App\Models\OfferteAuspack::InfoAuspack($auspack,'extra1')) 
                                value="{{ \App\Models\OfferteAuspack::InfoAuspack($auspack,'extra1') }}" 
                                @else value="{{ 250 }}" 
                            @endif>
                        </div>
                    </div>  
    
                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="auspackCostText1" placeholder="Freier Text" 
                            @if($auspack && \App\Models\OfferteAuspack::InfoAuspack($auspack,'customCostName1')) 
                                value="{{ \App\Models\OfferteAuspack::InfoAuspack($auspack,'customCostName1') }}" 
                            @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="auspackCost1" placeholder="0"  type="number" 
                            @if($auspack && \App\Models\OfferteAuspack::InfoAuspack($auspack,'customCostPrice1')) 
                                value="{{ \App\Models\OfferteAuspack::InfoAuspack($auspack,'customCostPrice1') }}" 
                                @else value="{{ 0 }}" 
                            @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="auspackCostText2" placeholder="Freier Text"  type="text" 
                            @if($auspack && \App\Models\OfferteAuspack::InfoAuspack($auspack,'customCostName2')) 
                                value="{{ \App\Models\OfferteAuspack::InfoAuspack($auspack,'customCostName2') }}" 
                            @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="auspackCost2" placeholder="0"  type="number" 
                            @if($auspack && \App\Models\OfferteAuspack::InfoAuspack($auspack,'customCostPrice2')) 
                                value="{{ \App\Models\OfferteAuspack::InfoAuspack($auspack,'customCostPrice2') }}" 
                                @else value="{{ 0 }}" 
                            @endif>
                        </div>
                    </div>
                </div>

                
                            
            </div>
            
            <label class="col-form-label mt-1 " for="l0">Kosten</label>
            <input class="form-control" id="auspackCost"  name="auspackCost" placeholder="0"  type="text" style="background-color: #286090;color:white;"
            @if($auspack && \App\Models\OfferteAuspack::InfoAuspack($auspack,'costPrice')) 
                value="{{ \App\Models\OfferteAuspack::InfoAuspack($auspack,'costPrice') }}" 
                @else value="{{ 0 }}" 
            @endif> 

            <label class="col-form-label" for="l0">Rabatt</label>
            <input class="form-control"  name="auspackDiscount" placeholder="0"  type="number" 
            @if($auspack && \App\Models\OfferteAuspack::InfoAuspack($auspack,'discount')) 
                value="{{ \App\Models\OfferteAuspack::InfoAuspack($auspack,'discount') }}" 
                @else value="{{ 0 }}" 
            @endif> 

            <label class="col-form-label" for="l0">Rabatt[%] </label>
            <input class="form-control"  name="auspackDiscountPercent" placeholder="0"  type="number" 
            @if($auspack && \App\Models\OfferteAuspack::InfoAuspack($auspack,'discountPercent')) 
                value="{{ \App\Models\OfferteAuspack::InfoAuspack($auspack,'discountPercent') }}" 
                @else value="{{ 0 }}" 
            @endif> 

            <label class="col-form-label" for="l0">Entgegenkommen</label>
            <input class="form-control"  name="auspackCompromiser" placeholder="0"  type="number" 
            @if($auspack && \App\Models\OfferteAuspack::InfoAuspack($auspack,'compromiser')) 
                value="{{ \App\Models\OfferteAuspack::InfoAuspack($auspack,'compromiser') }}" 
                @else value="{{ 0 }}" 
            @endif>

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="auspackExtraDiscountText" placeholder="Freier Text"  type="text" 
                    @if($auspack && \App\Models\OfferteAuspack::InfoAuspack($auspack,'extraCostName')) 
                        value="{{ \App\Models\OfferteAuspack::InfoAuspack($auspack,'extraCostName') }}"
                    @endif>
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="auspackExtraDiscount" placeholder="0"  type="number" 
                    @if($auspack && \App\Models\OfferteAuspack::InfoAuspack($auspack,'extraCostPrice')) 
                        value="{{ \App\Models\OfferteAuspack::InfoAuspack($auspack,'extraCostPrice') }}"
                        @else value="{{ 0 }}"
                    @endif>
                </div>
            </div>

            <label class="col-form-label" for="l0">Geschätzte Kosten</label>
            <input class="form-control"  name="auspackTotalPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;"
            @if($auspack && \App\Models\OfferteAuspack::InfoAuspack($auspack,'defaultPrice')) 
                value="{{ \App\Models\OfferteAuspack::InfoAuspack($auspack,'defaultPrice') }}" 
            @endif>

            <div class="mt-2 isAuspackKostendach">
                <label class="col-form-label" for="l0">Kostendach</label>
                <input type="checkbox"  name="isAuspackKostendach" id="isAuspackKostendach" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" 
                @if($auspack && \App\Models\OfferteAuspack::InfoAuspack($auspack,'topCost')) checked @endif>
            </div>

            <div class="auspack-kostendach-area" @if($auspack && \App\Models\OfferteAuspack::InfoAuspack($auspack,'topCost')) style="display: block;" @else style="display: none;" @endif >
                <input class="form-control"  name="auspackTopPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;"
                @if($auspack && \App\Models\OfferteAuspack::InfoAuspack($auspack,'topCost')) 
                    value="{{ \App\Models\OfferteAuspack::InfoAuspack($auspack,'topCost') }}" 
                @endif>

                <div class="mt-2">
                    <small class=" text-primary">manuell gesetzt</small>
                    <input type="checkbox" name="isAuspackMTPrice" id="isAuspackMTPrice" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
                </div>
            </div>
            
            <div class="mt-3 isAuspackPauschal">
                <label class="col-form-label" for="l0">Pauschal</label>
                <input type="checkbox"  name="isAuspackPauschal" id="isAuspackPauschal" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" 
                @if($auspack && \App\Models\OfferteAuspack::InfoAuspack($auspack,'fixedPrice')) checked @endif>
            </div>

            <div class="auspack-pauschal-area " @if($auspack && \App\Models\OfferteAuspack::InfoAuspack($auspack,'fixedPrice')) style="display: block;" @else style="display: none;" @endif>
                <input class="form-control"  name="auspackDefaultPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;"
                @if($auspack && \App\Models\OfferteAuspack::InfoAuspack($auspack,'fixedPrice')) 
                    value="{{ \App\Models\OfferteAuspack::InfoAuspack($auspack,'fixedPrice') }}" 
                @endif>

                <div class="mt-2">
                    <small class=" text-primary">manuell gesetzt</small>
                    <input type="checkbox" name="isAuspackFxPrice" id="isAuspackFxPrice" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
                </div>
            </div>
        </div>
    </div>
</div>
