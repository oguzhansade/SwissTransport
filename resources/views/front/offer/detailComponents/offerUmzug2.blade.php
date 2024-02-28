<div class="form-group row">
    <div class="col-md-12 umzug-control">
        <label for="" class="col-form-label">Umzug</label><br>
        <input type="checkbox" name="isUmzug" id="isUmzug" class="js-switch " data-color="#286090" data-switchery="false" @if ($umzug) checked @endif>  
    </div>                            
</div>

<div class="rounded umzug--area bg-service-primary" style=" @if($umzug == NULL) display:none;  @endif">
    <div class="row p-3">
        <div class="col-md-6">
            <label class=" col-form-label" for="l0">Tarif</label>
            <select class="form-control" class="umzugTariff2" name="umzugTariff" id="umzugTariff" >
                <option data-selection="bos" value="">Bitte wählen</option>
                @foreach (\App\Models\Tariff::getList(1) as $key=>$value )
                    <option data-selection="0" data-ma="{{ $value['ma'] }}" data-lkw="{{ $value['lkw'] }}" data-an="{{ $value['anhanger'] }}" data-chf ="{{ $value['chf'] }}" value="{{ $value['id'] }}" @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'tariff') == $value['id']) selected @endif>{{ $value['description'] }}</option>
                @endforeach
            </select>   

            <div class="row umzug--tariffs--area umzug-tarif-area" @if($umzug == NULL) style="display: none;" @endif>
                <div class="col">
                    <label class=" col-form-label" for="l0">MA</label>
                    <input class="form-control"  name="umzug1ma" placeholder="0"  type="number"  
                    @if($umzug) 
                    value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'ma') }}"
                    @endif
                    >                                
                </div>
                <div class="col">
                    <label class=" col-form-label" for="l0">LKW</label>
                    <input class="form-control"  name="umzug1lkw" placeholder="0"  type="number" 
                    @if($umzug) 
                    value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'lkw') }}"
                    @endif
                    >                                
                </div>
                <div class="col">
                    <label class=" col-form-label" for="l0">Anhänger</label>
                    <input class="form-control"  name="umzug1anhanger" placeholder="0"  type="number" 
                    @if($umzug) 
                    value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'anhanger') }}"
                    @endif
                    >                                
                </div>
                <div class="col">
                    <label class=" col-form-label" for="l0">CHF-Ansatz</label>
                    <input class="form-control" id="umzug1chf"  name="umzug1chf" placeholder="0"  type="number" 
                    @if($umzug) 
                    value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'chf') }}"
                    @endif
                    >                                
                </div>
            </div>
            
            <label class=" col-form-label" for="l0">Umzugstermin</label>
            <input class="form-control" class="date"  name="umzugausdate"  type="date" 
                @if($umzug) 
                    value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'moveDate') }}"
                @endif
            > 

            <label class=" col-form-label" for="l0">Arbeitsbeginn</label>
            <input class="form-control" class="time"  name="umzug1time"  type="time" 
                @if($umzug) 
                        value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'moveTime') }}"
                @endif
            > 

            <label class=" col-form-label" for="l0">Einzugstermin</label>
            <input class="form-control" class="date"  name="umzugeindate"  type="date" 
                @if($umzug) 
                        value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'moveDate2') }}"
                @endif
            > 

            <label class=" col-form-label" for="l0">Anfahrt/Rückfahrt [CHF]</label>
            <input class="form-control" class="date"  name="umzugroadChf"  type="number" 
                @if($umzug) 
                        value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'arrivalReturn') }}"
                        @else value="0"
                @endif
            > 

            <label class=" col-form-label" for="l0">Ab- und Aufbau</label>
            <select class="form-control" class="umzugMontaj" name="umzugMontaj" id="umzugMontaj" >
                <option value="1" @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'montage') == 1) selected @endif>Bitte wählen</option>
                <option value="2" @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'montage') == 2) selected @endif>Kunde</option>
                <option value="3" @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'montage') == 3) selected @endif>Firma</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Dauer [h]</label>
            <input class="form-control"  name="umzugHours" placeholder="4-5"  type="text" 
                @if($umzug) 
                    value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'moveHours') }}"
                @endif
            >  
            
            <div class="extra-cost mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="isExtra" id="isExtra" class="js-switch " data-color="#286090" data-switchery="false" 
                @if($umzug
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra') == NULL 
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra1') == NULL
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra2') == NULL
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra3') == NULL
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra4') == NULL
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra5') == NULL
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra6') == NULL
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra7') == NULL
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra8') == NULL
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra9') == NULL
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra10') == NULL
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'customCostPrice1') == NULL
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'customCostPrice2') == NULL
                ) 
                unchecked
                @else checked
                @endif>  
            </div>  

            <div class="extra--cost--area" 
            @if($umzug
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra') == NULL 
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra1') == NULL
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra2') == NULL
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra3') == NULL
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra4') == NULL
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra5') == NULL
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra6') == NULL
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra7') == NULL
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra8') == NULL
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra9') == NULL
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra10') == NULL
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'customCostPrice1') == NULL
                && \App\Models\OfferteUmzug::InfoUmzug($umzug,'customCostPrice2') == NULL
                ) 
                style="display: none;"
                @endif>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="masraf" 
                                    @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra')) checked @endif> 
                                    <span class="label-text text-dark"><strong>Spesen</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="extra1" type="number"  
                            @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra')) 
                                value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra') }}" 
                                @else value="20" 
                            @endif> 
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="masraf1"
                                    @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra1')) checked @endif> 
                                    <span class="label-text text-dark"><strong>Klavier 250.-</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="extra2" type="number" 
                            @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra1')) 
                                value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra1') }}" 
                                @else value="{{ 250 }}" 
                            @endif>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="masraf2"
                                    @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra2')) checked @endif> 
                                    <span class="label-text text-dark"><strong>Klavier 350.-</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="extra3" type="number" 
                            @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra2')) 
                                value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra2') }}" 
                                @else value="{{ 350 }}" 
                            @endif>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="masraf3"
                                    @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra3')) checked @endif> 
                                    <span class="label-text text-dark"><strong>Möbellift 0.-</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="extra4" type="number" 
                            @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra3')) 
                                value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra3') }}" 
                                @else value="{{ 0 }}" 
                            @endif>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="masraf4"
                                    @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra4')) checked @endif> 
                                    <span class="label-text text-dark"><strong>Möbellift 250.-</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="extra5" type="number" 
                            @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra4')) 
                                value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra4') }}" 
                                @else value="{{ 250 }}" 
                            @endif>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="masraf5"
                                    @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra5')) checked @endif> 
                                    <span class="label-text text-dark"><strong>Möbellift 350.-</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="extra6" type="number" 
                            @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra5')) 
                                value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra5') }}" 
                                @else value="{{ 350 }}" 
                            @endif>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="masraf6"
                                    @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra6')) checked @endif> 
                                    <span class="label-text text-dark"><strong>Schwergutzuschlag 150.-</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="extra7" type="number" 
                            @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra6')) 
                                value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra6') }}" 
                                @else value="{{ 150 }}" 
                            @endif>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="masraf7"
                                    @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra7')) checked @endif> 
                                    <span class="label-text text-dark"><strong>Schwergutzuschlag 250.-</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="extra8" type="number" 
                            @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra7')) 
                                value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra7') }}" 
                                @else value="{{ 250 }}" 
                            @endif>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="masraf8"
                                    @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra8')) checked @endif> 
                                    <span class="label-text text-dark"><strong>Tresor 350.-</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="extra9" type="number" 
                            @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra8')) 
                                value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra8') }}" 
                                @else value="{{ 350 }}" 
                            @endif>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="masraf9"
                                    @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra9')) checked @endif> 
                                    <span class="label-text text-dark"><strong>Tresor 450.-</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="extra10" type="number" 
                            @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra9')) 
                                value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra9') }}" 
                                @else value="{{ 450 }}" 
                            @endif>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="masraf10"
                                    @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra10')) checked @endif> 
                                    <span class="label-text text-dark"><strong>Wasserbett</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="extra11" type="number" 
                            @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra10')) 
                                value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'extra10') }}" 
                                @else value="{{ 500 }}" 
                            @endif>
                        </div>
                    </div>
                    
                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="extra12CostText" placeholder="Freier Text"  type="text" 
                            @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'customCostName1')) 
                                value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'customCostName1') }}" 
                            @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="extra12Cost" placeholder="0"  type="number" 
                            @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'customCostPrice1')) 
                                value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'customCostPrice1') }}"
                                @else value="{{ 0 }}"
                            @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="extra13CostText" placeholder="Freier Text"  type="text" 
                            @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'customCostName2')) 
                                value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'customCostName2') }}" 
                            @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="extra13Cost" placeholder="0"  type="number" 
                            @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'customCostPrice2')) 
                                value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'customCostPrice2') }}"
                                @else value="{{ 0 }}"
                            @endif>
                        </div>
                    </div>
                </div>

            </div>
            
            <label class="col-form-label mt-1 " for="l0">Kosten</label>
            <input class="form-control" id="umzugCost"  name="umzugCost" placeholder="0"  type="text" style="background-color: #286090;color:white;"
            @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'costPrice')) 
                value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'costPrice') }}"
                @else value="{{ 0 }}"
            @endif> 

            <label class="col-form-label" for="l0">Rabatt</label>
            <input class="form-control"  name="umzugDiscount" placeholder="0"  type="number" 
            @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'discount')) 
                value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'discount') }}"
                @else value="{{ 0 }}"
            @endif> 

            <label class="col-form-label" for="l0">Rabatt[%]</label>
            <input class="form-control"  name="umzugDiscountPercent" placeholder="0"  type="number" 
            @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'discountPercent')) 
                value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'discountPercent') }}"
                @else value="{{ 0 }}"
            @endif> 

            <label class="col-form-label" for="l0">Entgegenkommen</label>
            <input class="form-control"  name="umzugCompromiser" placeholder="0"  type="number" 
            @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'compromiser')) 
                value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'compromiser') }}"
                @else value="{{ 0 }}"
            @endif>

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="umzugExtraDiscountText" placeholder="Freier Text"  type="text" 
                    @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extraCostName')) 
                        value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'extraCostName') }}"
                    @endif>
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="umzugExtraDiscount" placeholder="0"  type="number" 
                    @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'extraCostPrice')) 
                        value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'extraCostPrice') }}"
                        @else value="{{ 0 }}"
                    @endif>
                </div>
            </div>

            <label class="col-form-label" for="l0">Geschätzte Kosten</label>
            <input class="form-control"  name="umzugTotalPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;"
            @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'defaultPrice')) 
                value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'defaultPrice') }}"
                @else value="{{ 0 }}"
            @endif>

            <div class="mt-2 isKostendach">
                <label class="col-form-label" for="l0">Kostendach </label>
                <input type="checkbox"  name="isKostendach" id="isKostendach" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" 
                @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'topCost')) checked @endif>
            </div>

            <div class="kostendach-area" @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'topCost')) style="display: block;" @else style="display: none;" @endif >
                <input class="form-control"  name="umzugTopPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;"
                @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'topCost')) 
                    value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'topCost') }}"
                    @else value="{{ 0 }}"
                @endif>

                <div class="mt-2">
                    <small class=" text-primary">manuell gesetzt</small>
                    <input type="checkbox" name="isUmzugMTPrice" id="isUmzugMTPrice" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
                </div>
            </div>
             
            <div class="mt-3 isPauschal">
                <label class="col-form-label" for="l0">Pauschal</label>
                <input type="checkbox"  name="isPauschal" id="isPauschal" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" 
                @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'fixedPrice')) checked @endif>
            </div>

            <div class="pauschal-area "  @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'fixedPrice')) style="display: block;" @else style="display:none;" @endif>
                <input class="form-control"  name="umzugDefaultPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;"
                @if($umzug && \App\Models\OfferteUmzug::InfoUmzug($umzug,'fixedPrice')) 
                    value="{{ \App\Models\OfferteUmzug::InfoUmzug($umzug,'fixedPrice') }}"
                @endif>

                <div class="mt-2">
                    <small class=" text-primary">manuell gesetzt</small>
                    <input type="checkbox" name="isUmzugFxPrice" id="isUmzugFxPrice" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
                </div>
            </div>
        </div>
    </div>
</div>
