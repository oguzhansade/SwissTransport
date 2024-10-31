<div class="form-group row">
    <div class="col-md-12 transport-control">
        <label for="" class="col-form-label">Transport</label><br>
        <input type="checkbox" name="isTransport" id="isTransport" class="js-switch " data-color="#286090" data-switchery="false" @if ($transport) checked @endif>
    </div>
</div>

<div class="rounded transport--area bg-service-primary" style="
@if ($transport == NULL) display:none; @endif">
    <div class="row p-3">
        <div class="col-md-6">

            <div class="row">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Optional: Transport-Art Text (kommt in Pdf)</label>
                    <input class="form-control"  name="pdfText"   type="text"
                    @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'pdfText') != NULL)
                        value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'pdfText') }}"
                    @endif>
                </div>
            </div>

            <div class="row p-2 mt-1 rounded" style="background-color: #286090">
                <div class="col-md-12">
                    <label class="col-form-label text-white" for="l0">Pauschalpreis-Tarif</label>
                    <input class="form-control"  name="transportFixedTariff" placeholder="0"  type="number"
                    @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'fixedChf') != NULL)
                        value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'fixedChf') }}"
                    @endif>
                </div>
            </div>
            <small class="text-primary"><i>Entweder "Pauschalpreis-Tarif" oder "Stundenansatz-Tarif" ausfüllen. Falls Pauschalpreis-Tarif gefüllt ist, wird dieser genommen.</i></small><br>

            <label class=" col-form-label" for="l0">Tarif</label>
            <select class="form-control" class="transportTariff" name="transportTariff" id="transportTariff" >
                <option data-selection="bos" value>Bitte wählen</option>
                @foreach (\App\Models\Tariff::getList(4) as $key=>$value )
                    <option data-selection="0" data-ma="{{ $value['ma'] }}" data-lkw="{{ $value['lkw'] }}" data-an="{{ $value['anhanger'] }}" data-chf ="{{ $value['chf'] }}" value="{{ $value['id'] }}"
                    @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'tariff') == $value['id']) selected @endif>{{ $value['description'] }}</option>
                @endforeach
            </select>

            <div class="row transport-tariffs--area"
            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'tariff')) style="display: block;" @else style="display: none;" @endif>
                <div class="col">
                    <label class=" col-form-label" for="l0">MA</label>
                    <input class="form-control"  name="transportma" placeholder="0"  type="number"
                    @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'ma') != NULL)
                        value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'ma') }}"
                    @endif>
                </div>

                <div class="col">
                    <label class=" col-form-label" for="l0">LKW</label>
                    <input class="form-control"  name="transportlkw" placeholder="0"  type="number"
                    @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'lkw') != NULL)
                        value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'lkw') }}"
                    @endif>
                </div>

                <div class="col">
                    <label class=" col-form-label" for="l0">Anhänger</label>
                    <input class="form-control"  name="transportanhanger" placeholder="0"  type="number"
                    @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'anhanger') != NULL)
                        value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'anhanger') }}"
                        @else value="{{ 0 }}"
                    @endif>
                </div>

                <div class="col">
                    <label class=" col-form-label" for="l0">CHF-Ansatz</label>
                    <input class="form-control"  name="transportchf" placeholder="0"  type="number"
                    @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'chf') != NULL)
                        value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'chf') }}"
                        @else value="{{ 0 }}"
                    @endif>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label class=" col-form-label" for="l0">Dauer [h]</label>
                    <input class="form-control"  name="transporthour" placeholder="4-5"  type="text"
                    @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'hour') != NULL)
                        value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'hour') }}"
                        @else value="{{ 0 }}"
                    @endif>
                </div>
            </div>

            <label class=" col-form-label" for="l0">Transporttermin</label>
            <input class="form-control" class="date"  name="transportDate"  type="date"
            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'transportDate') != NULL)
                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'transportDate') }}"
            @endif>

            <label class=" col-form-label" for="l0">Arbeitsbeginn</label>
            <input class="form-control" class="time"  name="transportTime"  type="time"
            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'transportTime') != NULL)
                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'transportTime') }}"
            @endif>

            <div class="row">
                <div class="col">
                    <label class=" col-form-label" for="l0">Anfahrt [CHF]</label>
                    <input class="form-control" class="date"  name="transportArrivalGas"  type="number"
                    @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'arrivalGas'))
                        value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'arrivalGas') }}"
                        @else value="0"
                    @endif>
                </div>
                <div class="col">
                    <label class=" col-form-label" for="l0">Rückfahrt [CHF]</label>
                    <input class="form-control" class="date"  name="transportReturnGas"  type="number"
                    @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'returnGas'))
                        value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'returnGas') }}"
                        @else value="0"
                    @endif>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="extra-cost-transport mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="transportisExtra" id="transportisExtra" class="js-switch " data-color="#286090" data-switchery="false"
                @if($transport
                    && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue1') == NULL
                    && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue2') == NULL
                    && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue3') == NULL
                    && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue4') == NULL
                    && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue5') == NULL
                    && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue6') == NULL
                    && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue7') == NULL
                    )
                    unchecked
                    @else checked
                @endif>
            </div>

            <div class="transport--extra--cost--area mt-3"
            @if($transport
                && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue1') == NULL
                && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue2') == NULL
                && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue3') == NULL
                && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue4') == NULL
                && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue5') == NULL
                && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue6') == NULL
                && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue7') == NULL
                )
                style="display: none;"
            @endif>

                <div class="form-group">
                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportCostText1" placeholder="Freier Text"  type="text"
                            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostText1') != NULL)
                                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'extraCostText1') }}"
                            @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportCost1" placeholder="0"  type="number"
                            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue1') != NULL)
                                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue1') }}"
                                @else value="{{ 0 }}"
                            @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportCostText2" placeholder="Freier Text"  type="text"
                            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostText2') != NULL)
                                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'extraCostText2') }}"
                            @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportCost2" placeholder="0"  type="number"
                            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue2') != NULL)
                                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue2') }}"
                                @else value="{{ 0 }}"
                            @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportCostText3" placeholder="Freier Text"  type="text"
                            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostText3') != NULL)
                                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'extraCostText3') }}"
                            @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportCost3" placeholder="0"  type="number"
                            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue3') != NULL)
                                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue3') }}"
                                @else value="{{ 0 }}"
                            @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportCostText4" placeholder="Freier Text"  type="text"
                            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostText4') != NULL)
                                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'extraCostText4') }}"
                            @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportCost4" placeholder="0"  type="number"
                            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue4') != NULL)
                                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue4') }}"
                                @else value="{{ 0 }}"
                            @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportCostText5" placeholder="Freier Text"  type="text"
                            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostText5') != NULL)
                                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'extraCostText5') }}"
                            @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportCost5" placeholder="0"  type="number"
                            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue5') != NULL)
                                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue5') }}"
                                @else value="{{ 0 }}"
                            @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportCostText6" placeholder="Freier Text"  type="text"
                            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostText6') != NULL)
                                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'extraCostText6') }}"
                            @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportCost6" placeholder="0"  type="number"
                            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue6') != NULL)
                                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue6') }}"
                                @else value="{{ 0 }}"
                            @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="transportCostText7" placeholder="Freier Text"  type="text"
                            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostText7') != NULL)
                                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'extraCostText7') }}"
                            @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="transportCost7" placeholder="0"  type="number"
                            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue7') != NULL)
                                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'extraCostValue7') }}"
                                @else value="{{ 0 }}"
                            @endif>
                        </div>
                    </div>
                </div>



            </div>

            <label class="col-form-label mt-1 " for="l0">Kosten</label>
            <input class="form-control" id="transportCost"  name="transportCost" placeholder="0"  type="text" style="background-color: #286090;color:white;"
            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'totalPrice') != NULL)
                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'totalPrice') }}"
                @else value="{{ 0 }}"
            @endif>

            <label class="col-form-label" for="l0">Rabatt</label>
            <input class="form-control"  name="transportDiscount" placeholder="0"  type="number"
            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'discount') != NULL)
                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'discount') }}"
                @else value="{{ 0 }}"
            @endif>

            <label class="col-form-label" for="l0">Rabatt[%]</label>
            <input class="form-control"  name="transportDiscountPercent" placeholder="0"  type="number"
            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'discountPercent') != NULL)
                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'discountPercent') }}"
                @else value="{{ 0 }}"
            @endif>

            <label class="col-form-label" for="l0">Entgegenkommen</label>
            <input class="form-control"  name="transportCompromiser" placeholder="0"  type="number"
            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'compromiser') != NULL)
                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'compromiser') }}"
                @else value="{{ 0 }}"
            @endif>

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="transportExtraDiscountText" placeholder="Freier Text"  type="text"
                    @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'extraDiscountText') != NULL)
                        value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'extraDiscountText') }}"
                    @endif>
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="transportExtraDiscount" placeholder="0"  type="number"
                    @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'extraDiscountValue') != NULL)
                        value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'extraDiscountValue') }}"
                        @else value="{{ 0 }}"
                    @endif>
                </div>
            </div>

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="transportExtraDiscountText2" placeholder="Freier Text"  type="text"
                    @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'extraDiscountText2') != NULL)
                        value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'extraDiscountText2') }}"
                    @endif>
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="transportExtraDiscount2" placeholder="0"  type="number"
                    @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'extraDiscountValue2') != NULL)
                        value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'extraDiscountValue2') }}"
                        @else value="{{ 0 }}"
                    @endif>
                </div>
            </div>

            <label class="col-form-label" for="l0">Geschätzte Kosten</label>
            <input class="form-control"  name="transportDefaultPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;"
            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'defaultPrice') != NULL)
                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'defaultPrice') }}"
                @else value="{{ 0 }}"
            @endif>

            <div class="mt-2 isTransportKostendach">
                <label class="col-form-label" for="l0">Kostendach</label>
                <input type="checkbox"  name="isTransportKostendach" id="isTransportKostendach" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false"
                @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'topCost')) checked @endif>
            </div>

            <div class="transport-kostendach-area" @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'topCost')) style="display: block;" @else style="display: none;" @endif >
                <input class="form-control"  name="transportTopPrice" placeholder="0"  type="number" style="background-color: #286090;color:white;"
                @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'topCost') != NULL)
                    value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'topCost') }}"
                    @else value="{{ 0 }}"
                @endif>

                <div class="mt-2">
                    <small class=" text-primary">manuell gesetzt</small>
                    <input type="checkbox" name="isTransportMTPrice" id="isTransportMTPrice" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
                </div>
            </div>

            <div class="mt-3 isTransportPauschal">
                <label class="col-form-label" for="l0">Pauschal</label>
                <input type="checkbox"  name="isTransportPauschal" id="isTransportPauschal" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false"
                @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'fixedPrice')) checked @endif>
            </div>

            <div class="transport-pauschal-area " @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'fixedPrice')) style="display: block;" @else style="display: none;" @endif>
                <input class="form-control"  name="transportFixedPrice" placeholder="0"  type="number" style="background-color: #286090;color:white;"
                @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'fixedPrice') != NULL)
                    value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'fixedPrice') }}"
                    @else value="{{ 0 }}"
                @endif>

                <div class="mt-2">
                    <small class=" text-primary">manuell gesetzt</small>
                    <input type="checkbox" name="isTransportFxPrice" id="isTransportFxPrice" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
                </div>
            </div>
        </div>
    </div>
</div>
