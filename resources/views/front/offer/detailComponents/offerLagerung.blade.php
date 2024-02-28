
<div class="form-group row">
    <div class="col-md-12 lagerung-control">
        <label for="" class="col-form-label">Lagerung</label><br>
        <input type="checkbox" name="isLagerung" id="isLagerung" class="js-switch " data-color="#286090" data-switchery="false" @if($lagerung) checked @endif>  
    </div>                            
</div>

<div class="rounded lagerung--area bg-service-primary" style=" @if($lagerung == NULL) display:none; @endif">
    <div class="row p-3">
        <div class="col-md-6">
            <label class=" col-form-label" for="l0">Tarif</label>
            <select class="form-control" class="lagerungTariff" name="lagerungTariff" id="lagerungTariff" >
                <option data-selection="bos" value>Bitte wählen</option>
                @foreach (\App\Models\Tariff::getList(5) as $key=>$value )
                    <option data-selection="0" data-ma="{{ $value['ma'] }}" data-lkw="{{ $value['lkw'] }}" data-an="{{ $value['anhanger'] }}" data-chf ="{{ $value['chf'] }}" value="{{ $value['id'] }}"
                    @if($lagerung && \App\Models\OfferteLagerung::InfoLagerung($lagerung,'tariff') == $value['id']) selected @endif>{{ $value['description'] }}</option>
                @endforeach
            </select>

            <div class="row lagerung-tariffs--area" 
            @if($lagerung && \App\Models\OfferteLagerung::InfoLagerung($lagerung,'chf')) 
                style="display: block;" @else style="display: none;"
            @endif>
                <div class="col">
                    <label class=" col-form-label" for="l0">CHF-Ansatz</label>
                    <input class="form-control"  name="lagerungChf" placeholder="0"  type="number" 
                    @if($lagerung && \App\Models\OfferteLagerung::InfoLagerung($lagerung,'chf') != NULL) 
                        value="{{ \App\Models\OfferteLagerung::InfoLagerung($lagerung,'chf') }}"
                    @endif>                                
                </div>
            </div>
            
            <label class=" col-form-label" for="l0">Volumen [m3]</label>
            <input class="form-control" class="date"  name="lagerungVolume"  type="text" min="1"
            @if($lagerung && \App\Models\OfferteLagerung::InfoLagerung($lagerung,'volume') != NULL) 
                value="{{ \App\Models\OfferteLagerung::InfoLagerung($lagerung,'volume') }}"
            @endif> 


        </div>
        <div class="col-md-6">
            <div class="lagerung--extra--cost--area" >
                <div class="form-group">
                    <label class=" col-form-label" for="l0">Weitere Kosten</label>
                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="lagerungCostText1" placeholder="Freier Text"  type="text" 
                            @if($lagerung && \App\Models\OfferteLagerung::InfoLagerung($lagerung,'extraCostText1') != NULL) 
                                value="{{ \App\Models\OfferteLagerung::InfoLagerung($lagerung,'extraCostText1') }}"
                            @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="lagerungCost1" placeholder="0"  type="number" 
                            @if($lagerung && \App\Models\OfferteLagerung::InfoLagerung($lagerung,'extraCostValue1') != NULL) 
                                value="{{ \App\Models\OfferteLagerung::InfoLagerung($lagerung,'extraCostValue1') }}"
                                @else value="{{ 0 }}"
                            @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="lagerungCostText2" placeholder="Freier Text"  type="text" 
                            @if($lagerung && \App\Models\OfferteLagerung::InfoLagerung($lagerung,'extraCostText2') != NULL) 
                                value="{{ \App\Models\OfferteLagerung::InfoLagerung($lagerung,'extraCostText2') }}"
                            @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="lagerungCost2" placeholder="0"  type="number" 
                            @if($lagerung && \App\Models\OfferteLagerung::InfoLagerung($lagerung,'extraCostValue2') != NULL) 
                                value="{{ \App\Models\OfferteLagerung::InfoLagerung($lagerung,'extraCostValue2') }}"
                                @else value="{{ 0 }}"
                            @endif>
                        </div>
                    </div>
                </div>
            </div>
            <label class="col-form-label mt-1 " for="l0">Kosten</label>
            <input class="form-control" id="lagerungCostPrice"  name="lagerungCostPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;"
            @if($lagerung && \App\Models\OfferteLagerung::InfoLagerung($lagerung,'costPrice') != NULL) 
                value="{{ \App\Models\OfferteLagerung::InfoLagerung($lagerung,'costPrice') }}"
                @else value="{{ 0 }}"
            @endif> 
            <div class="row">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Rabatt[%]</label>
                    <input class="form-control"  name="lagerungDiscountPercent" placeholder="0"  type="number" 
                    @if($lagerung && \App\Models\OfferteLagerung::InfoLagerung($lagerung,'discountPercent') != NULL) 
                        value="{{ \App\Models\OfferteLagerung::InfoLagerung($lagerung,'discountPercent') }}"
                    @endif>
                </div>
            </div>

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="lagerungExtraDiscountText" placeholder="Kesinti Adı"  type="text" 
                    @if($lagerung && \App\Models\OfferteLagerung::InfoLagerung($lagerung,'discountText') != NULL) 
                        value="{{ \App\Models\OfferteLagerung::InfoLagerung($lagerung,'discountText') }}"
                    @endif>
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="lagerungExtraDiscount" placeholder="0"  type="number" 
                    @if($lagerung && \App\Models\OfferteLagerung::InfoLagerung($lagerung,'discountValue') != NULL) 
                        value="{{ \App\Models\OfferteLagerung::InfoLagerung($lagerung,'discountValue') }}"
                        @else value="{{ 0 }}"
                    @endif>
                </div>
            </div>

            <label class="col-form-label mt-1 " for="l0">GESCHÄTZTE KOSTEN</label>
            <input class="form-control" id="lagerungCost"  name="lagerungCost" placeholder="0"  type="text" style="background-color: #286090;color:white;"
            @if($lagerung && \App\Models\OfferteLagerung::InfoLagerung($lagerung,'totalPrice') != NULL) 
                value="{{ \App\Models\OfferteLagerung::InfoLagerung($lagerung,'totalPrice') }}"
                @else value="{{ 0 }}"
            @endif> 

            <div class="mt-2 lagerung-fixed-control">
                <label class="col-form-label" for="l0">Pauschal</label>
                <input type="checkbox" name="isLagerungFixedPrice" id="isLagerungFixedPrice" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" 
                @if($lagerung && \App\Models\OfferteLagerung::InfoLagerung($lagerung,'fixedPrice')) checked @endif>
            </div>


            <div class="lagerung-fixed-area" style="display: none;">
                <input class="form-control"  name="lagerungFixedPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;"
                @if($lagerung && \App\Models\OfferteLagerung::InfoLagerung($lagerung,'fixedPrice') != NULL) 
                    value="{{ \App\Models\OfferteLagerung::InfoLagerung($lagerung,'fixedPrice') }}"
                @endif>

                <div class="mt-2">
                    <small class=" text-primary">manuell gesetzt</small>
                    <input type="checkbox" name="isLagerungFxPrice" id="isLagerungFxPrice" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
                </div>
            </div>
        </div>
    </div>
</div>
