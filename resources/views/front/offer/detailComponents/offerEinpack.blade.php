<div class="form-group row">
    <div class="col-md-12 einpack-control">
        <label for="" class="col-form-label">Einpack</label><br>
        <input type="checkbox" name="isEinpack" id="isEinpack" class="js-switch " data-color="#286090" data-switchery="false" @if ($einpack) checked @endif >
    </div>
</div>


<div class="rounded einpack--area bg-service-primary" style="  @if($einpack == NULL) display:none;  @endif">
    <div class="row p-3">
        <div class="col-md-6">
            <label class=" col-form-label" for="l0">Tarif</label>
            <select class="form-control" class="einpackTariff" name="einpackTariff" id="einpackTariff" >
                <option data-selection="bos"  value="">Bitte wählen</option>
                @foreach (\App\Models\Tariff::getList(6) as $key=>$value )
                <option data-selection="0" data-ma="{{ $value['ma'] }}" data-lkw="{{ $value['lkw'] }}" data-an="{{ $value['anhanger'] }}" data-chf ="{{ $value['chf'] }}" value="{{ $value['id'] }}"
                @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'tariff') == $value['id']) selected @endif>{{ $value['description'] }}</option>
                @endforeach
            </select>

            <div class="row einpack-tariffs--area" @if($einpack == NULL) style="display: none;" @endif>
                <div class="col">
                    <label class=" col-form-label" for="l0">MA</label>
                    <input class="form-control"  name="einpack1ma" placeholder="0"  type="number"
                    @if($einpack)
                    value="{{ \App\Models\OfferteEinpack::InfoEinpack($einpack,'ma') }}"
                    @endif>
                </div>
                <div class="col">
                    <label class=" col-form-label" for="l0">CHF-Ansatz</label>
                    <input class="form-control"  name="einpack1chf" placeholder="0"  type="number"
                    @if($einpack)
                    value="{{ \App\Models\OfferteEinpack::InfoEinpack($einpack,'chf') }}"
                    @endif>
                </div>
            </div>

            <label class=" col-form-label" for="l0">Packtermin</label>
            <input class="form-control" class="date"  name="einpackdate"  type="date"
            @if($einpack)
                value="{{ \App\Models\OfferteEinpack::InfoEinpack($einpack,'einpackDate') }}"
            @endif>
            <label class=" col-form-label" for="l0">Arbeitsbeginn</label>
            <input class="form-control" class="time"  name="einpacktime"  type="time"
            @if($einpack)
                value="{{ \App\Models\OfferteEinpack::InfoEinpack($einpack,'einpackTime') }}"
                @else value="{{ 0 }}"
            @endif>

            <div class="row">
                <div class="col">
                    <label class=" col-form-label" for="l0">Anfahrt [CHF]</label>
                    <input class="form-control" class="date"  name="einpackArrivalGas"  type="number"
                    @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'arrivalGas'))
                        value="{{ \App\Models\OfferteEinpack::InfoEinpack($einpack,'arrivalGas') }}"
                        @else value="0"
                    @endif>
                </div>
                <div class="col">
                    <label class=" col-form-label" for="l0">Rückfahrt [CHF]</label>
                    <input class="form-control" class="date"  name="einpackReturnGas"  type="number"
                    @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'returnGas'))
                        value="{{ \App\Models\OfferteEinpack::InfoEinpack($einpack,'returnGas') }}"
                        @else value="0"
                    @endif>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Dauer [h]</label>
            <input class="form-control"  name="einpackHours" placeholder="4-5"  type="text"
            @if($einpack)
                value="{{ \App\Models\OfferteEinpack::InfoEinpack($einpack,'moveHours') }}"
                @else value="{{ 0 }}"
            @endif>

            <div class="extra-cost-einpack mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="einpackisExtra" id="einpackisExtra" class="js-switch " data-color="#286090" data-switchery="false"
                @if($einpack
                && \App\Models\OfferteEinpack::InfoEinpack($einpack,'extra') == NULL
                && \App\Models\OfferteEinpack::InfoEinpack($einpack,'extra1') == NULL
                && \App\Models\OfferteEinpack::InfoEinpack($einpack,'customCostPrice1') == NULL
                && \App\Models\OfferteEinpack::InfoEinpack($einpack,'customCostPrice2') == NULL
                )
                unchecked
                @else checked
                @endif>
            </div>

            <div class="einpack--extra--cost--area"
                @if($einpack
                    && \App\Models\OfferteEinpack::InfoEinpack($einpack,'extra') == NULL
                    && \App\Models\OfferteEinpack::InfoEinpack($einpack,'extra1') == NULL
                    && \App\Models\OfferteEinpack::InfoEinpack($einpack,'customCostPrice1') == NULL
                    && \App\Models\OfferteEinpack::InfoEinpack($einpack,'customCostPrice2') == NULL
                    )
                    style="display: none;"
                @endif>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="einpackmasraf"
                                    @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'extra')) checked @endif>
                                    <span class="label-text text-dark"><strong>Spesen</strong></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="einpackextra1" type="number"
                            @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'extra'))
                                value="{{ \App\Models\OfferteEinpack::InfoEinpack($einpack,'extra') }}"
                                @else value="{{ 20 }}"
                            @endif>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="einpackmasraf1"
                                    @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'extra1')) checked @endif>
                                    <span class="label-text text-dark"><strong>Verpackungsmaterial</strong></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="einpackextra2" type="number"
                            @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'extra1'))
                                value="{{ \App\Models\OfferteEinpack::InfoEinpack($einpack,'extra1') }}"
                                @else value="{{ 250 }}"
                            @endif>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="einpackCostText1" placeholder="Freier Text"  type="text"
                            @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'customCostName1'))
                                value="{{ \App\Models\OfferteEinpack::InfoEinpack($einpack,'customCostName1') }}"
                            @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="einpackCost1" placeholder="0"  type="number"
                            @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'customCostPrice1'))
                                value="{{ \App\Models\OfferteEinpack::InfoEinpack($einpack,'customCostPrice1') }}"
                                @else value="{{ 0 }}"
                            @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="einpackCostText2" placeholder="Freier Text"  type="text"
                            @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'customCostName2'))
                                value="{{ \App\Models\OfferteEinpack::InfoEinpack($einpack,'customCostName2') }}"
                            @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="einpackCost2" placeholder="0"  type="number"
                            @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'customCostPrice2'))
                                value="{{ \App\Models\OfferteEinpack::InfoEinpack($einpack,'customCostPrice2') }}"
                                @else value="{{ 0 }}"
                            @endif>
                        </div>
                    </div>
                </div>
            </div>

            <label class="col-form-label mt-1 " for="l0">Kosten</label>
            <input class="form-control" id="einpackCost"  name="einpackCost" placeholder="0"  type="text" style="background-color: #286090;color:white;"
            @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'costPrice'))
                value="{{ \App\Models\OfferteEinpack::InfoEinpack($einpack,'costPrice') }}"
                @else value="{{ 0 }}"
            @endif>

            <label class="col-form-label" for="l0">Rabatt</label>
            <input class="form-control"  name="einpackDiscount" placeholder="0"  type="number"
            @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'discount'))
                value="{{ \App\Models\OfferteEinpack::InfoEinpack($einpack,'discount') }}"
                @else value="{{ 0 }}"
            @endif>

            <label class="col-form-label" for="l0">Rabatt[%]</label>
            <input class="form-control"  name="einpackDiscountPercent" placeholder="0"  type="number"
            @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'discountPercent'))
                value="{{ \App\Models\OfferteEinpack::InfoEinpack($einpack,'discountPercent') }}"
                @else value="{{ 0 }}"
            @endif>

            <label class="col-form-label" for="l0">Entgegenkommen</label>
            <input class="form-control"  name="einpackCompromiser" placeholder="0"  type="number"
            @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'compromiser'))
                value="{{ \App\Models\OfferteEinpack::InfoEinpack($einpack,'compromiser') }}"
                @else value="{{ 0 }}"
            @endif>

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="einpackExtraDiscountText" placeholder="Freier Text"  type="text"
                    @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'extraCostName'))
                        value="{{ \App\Models\OfferteEinpack::InfoEinpack($einpack,'extraCostName') }}"
                    @endif>
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="einpackExtraDiscount" placeholder="0"  type="number"
                    @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'extraCostPrice'))
                        value="{{ \App\Models\OfferteEinpack::InfoEinpack($einpack,'extraCostPrice') }}"
                        @else value="{{ 0 }}"
                    @endif>
                </div>
            </div>

            <label class="col-form-label" for="l0">Geschätzte Kosten</label>
            <input class="form-control"  name="einpackTotalPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;"
            @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'defaultPrice'))
                value="{{ \App\Models\OfferteEinpack::InfoEinpack($einpack,'defaultPrice') }}"
            @endif>

            <div class="mt-2 isEinpackKostendach">
                <label class="col-form-label" for="l0">Kostendach</label>
                <input type="checkbox"  name="isEinpackKostendach" id="isEinpackKostendach" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false"
                @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'topCost')) checked @endif>
            </div>

            <div class="einpack-kostendach-area" @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'topCost')) style="display: block;" @else style="display: none;" @endif >
                <input class="form-control"  name="einpackTopPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;"
                @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'topCost'))
                    value="{{ \App\Models\OfferteEinpack::InfoEinpack($einpack,'topCost') }}"
                    @else value="{{ 0 }}"
                @endif>

                <div class="mt-2">
                    <small class=" text-primary">manuell gesetzt</small>
                    <input type="checkbox" name="isEinpackMTPrice" id="isEinpackMTPrice" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
                </div>
            </div>

            <div class="mt-3 isEinpackPauschal">
                <label class="col-form-label" for="l0">Pauschal</label>
                <input type="checkbox"  name="isEinpackPauschal" id="isEinpackPauschal" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false"
                @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'fixedPrice')) checked @endif>
            </div>

            <div class="einpack-pauschal-area " @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'fixedPrice')) style="display: block;" @else style="display: none;" @endif>
                <input class="form-control"  name="einpackDefaultPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;"
                @if($einpack && \App\Models\OfferteEinpack::InfoEinpack($einpack,'fixedPrice'))
                    value="{{ \App\Models\OfferteEinpack::InfoEinpack($einpack,'fixedPrice') }}"
                @endif>

                <div class="mt-2">
                    <small class=" text-primary">manuell gesetzt</small>
                    <input type="checkbox" name="isEinpackFxPrice" id="isEinpackFxPrice" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
                </div>
            </div>
        </div>
    </div>
</div>
