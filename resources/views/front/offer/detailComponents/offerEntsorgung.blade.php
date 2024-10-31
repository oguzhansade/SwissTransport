<div class="form-group row">
    <div class="col-md-12 entsorgung-control">
        <label for="" class="col-form-label">Entsorgung</label><br>
        <input type="checkbox" name="isEntsorgung" id="isEntsorgung" class="js-switch " data-color="#286090"
            data-switchery="false" @if ($entsorgung) checked @endif>
    </div>
</div>

<div class="rounded entsorgung--area bg-service-primary"
    style=" @if ($entsorgung == null) display:none; @endif">
    <div class="row p-3">
        <div class="col-md-6">
            <label class=" col-form-label" for="l0">Volumen-Tarif</label>
            <select class="form-control" class="entsorgungVolume" name="entsorgungVolume" id="entsorgungVolume">
                <option data-selection="bos" value>Bitte wählen</option>
                @foreach (\App\Models\Tariff::getList(2) as $key => $value)
                    <option data-selection="0" data-chf="{{ $value['chf'] }}" value="{{ $value['id'] }}"
                        @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'volume') == $value['id']) selected @endif>{{ $value['description'] }}</option>
                @endforeach
            </select>

            <div class="row entsorgung-chfVolume--area p-2 mt-1 rounded"
                style="background-color:#286090;
            @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'volumeCHF') == null) display:none;" @endif>
                <label class="col-form-label
                text-danger" for="l0"><span class="text-white">CHF-Ansatz</span></label>
                <input class="form-control" class="entsorgungVolumeChf" name="entsorgungVolumeChf" type="text"
                    @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'volumeCHF') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'volumeCHF') }}" @endif>
            </div>


            <div class="row  rounded">
                <label class="col-form-label" for="l0">Entsorgungsaufwand Pauschal</label>
                <input class="form-control" class="entsorgungFixedChf" name="entsorgungFixedChf" type="text"
                    @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'fixedCost') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'fixedCost') }}" @else value="160" @endif>
            </div>


            <div class="row  rounded">
                <label class="col-form-label" for="l0">Geschätztes Volumen [m3]</label>
                <input class="form-control" class="estimatedVolume" name="estimatedVolume" type="text"
                    @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'm3') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'm3') }}" @endif>
            </div>

            <small class="text-primary"><i>Entweder Mitarbeiter-Tarif oder Volumen-Tarif ausfüllen. Oder beides
                    zusammen.</i></small><br>
            <label class=" col-form-label" for="l0">Tarif</label>
            <select class="form-control" class="entsorgungTariff" name="entsorgungTariff" id="entsorgungTariff">
                <option data-selection="bos" value>Bitte wählen</option>
                @foreach (\App\Models\Tariff::getList(3) as $key => $value)
                    <option data-selection="0" data-ma="{{ $value['ma'] }}" data-lkw="{{ $value['lkw'] }}"
                        data-an="{{ $value['anhanger'] }}" data-chf="{{ $value['chf'] }}" value="{{ $value['id'] }}"
                        @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'tariff') == $value['id']) selected @endif>{{ $value['description'] }}</option>
                @endforeach
            </select>

            <div class="row entsorgung-tariffs--area" @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'tariff') == null) style="display: none;" @endif>
                <div class="col">
                    <label class=" col-form-label" for="l0">MA</label>
                    <input class="form-control" name="entsorgungma" placeholder="0" type="number"
                        @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'ma') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'ma') }}" @endif>
                </div>
                <div class="col">
                    <label class=" col-form-label" for="l0">LKW</label>
                    <input class="form-control" name="entsorgunglkw" placeholder="0" type="number"
                        @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'lkw') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'lkw') }}" @endif>
                </div>
                <div class="col">
                    <label class=" col-form-label" for="l0">Anhänger</label>
                    <input class="form-control" name="entsorgunganhanger" placeholder="0" type="number"
                        @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'anhanger') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'anhanger') }}"
                        @else value="{{ 0 }}" @endif>
                </div>
                <div class="col">
                    <label class=" col-form-label " for="l0">CHF-Ansatz</label>
                    <input class="form-control" name="entsorgungchf" placeholder="0" type="number"
                        @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'chf') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'chf') }}" @endif>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label class=" col-form-label" for="l0">Dauer [h]</label>
                    <input class="form-control" name="entsorgungHours" placeholder="4-5" type="text"
                        @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'hour') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'hour') }}" @endif>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Entsorgungstermin</label>
                    <input class="form-control" name="entsorgungDate" placeholder="0" type="date"
                        @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'entsorgungDate') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'entsorgungDate') }}" @endif>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Arbeitsbeginn</label>
                    <input class="form-control" name="entsorgungTime" placeholder="0" type="time"
                        @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'entsorgungTime') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'entsorgungTime') }}" @endif>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label class=" col-form-label" for="l0">Anfahrt [CHF]</label>
                    <input class="form-control" class="date"  name="entsorgungArrivalGas"  type="number"
                    @if($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung,'arrivalGas'))
                        value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung,'arrivalGas') }}"
                        @else value="0"
                    @endif>
                </div>
                <div class="col">
                    <label class=" col-form-label" for="l0">Rückfahrt [CHF]</label>
                    <input class="form-control" class="date"  name="entsorgungReturnGas"  type="number"
                    @if($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung,'returnGas'))
                        value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung,'returnGas') }}"
                        @else value="0"
                    @endif>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="extra-cost-entsorgung mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="entsorgungisExtra" id="entsorgungisExtra" class="js-switch "
                    data-color="#286090" data-switchery="false"
                    @if (
                        $entsorgung &&
                            \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'entsorgungExtra1') == null &&
                            \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'extraCostValue1') == 0 &&
                            \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'extraCostValue2') == 0) unchecked
                    @else checked @endif>
            </div>

            <div class="entsorgung--extra--cost--area"
                @if (
                    $entsorgung &&
                        \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'entsorgungExtra1') == null &&
                        \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'extraCostValue1') == 0 &&
                        \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'extraCostValue2') == 0) style="display: none;" @endif>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="entsorgungmasraf"
                                        @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'entsorgungExtra1')) checked @endif>
                                    <span class="label-text text-dark"><strong>Spesen</strong></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="entsorgungextra1" type="number"
                                @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'entsorgungExtra1') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'entsorgungExtra1') }}"
                                @else value="{{ 10 }}" @endif>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control" name="entsorgungCostText1" placeholder="Freier Text"
                                type="text"
                                @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'extraCostText1') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'extraCostText1') }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="entsorgungCost1" placeholder="0" type="number"
                                @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'extraCostValue1') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'extraCostValue1') }}"
                                @else value="{{ 0 }}" @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control" name="entsorgungCostText2" placeholder="Freier Text"
                                type="text"
                                @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'extraCostText2') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'extraCostText2') }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="entsorgungCost2" placeholder="0" type="number"
                                @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'extraCostValue2') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'extraCostValue2') }}"
                                @else value="{{ 0 }}" @endif>
                        </div>
                    </div>
                </div>
            </div>

            <label class="col-form-label" for="l0">Kosten</label>
            <input class="form-control" name="entsorgungCostPrice" placeholder="0" type="text"
                style="background-color: #286090;color:white;"
                @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'costPrice') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'costPrice') }}"
                @else value="{{ 0 }}" @endif>

            <div class="row">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Rabatt</label>
                    <input class="form-control" name="entsorgungDiscount" type="number"
                        @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'discount') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'discount') }}"
                        @else value="{{ 0 }}" @endif>
                </div>

                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Rabatt[%]</label>
                    <input class="form-control" name="entsorgungDiscountPercent" type="number"
                        @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'discountPercent') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'discountPercent') }}"
                        @else value="{{ 0 }}" @endif>
                </div>
            </div>

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control" name="entsorgungExtraDiscountText" placeholder="Freier Text"
                        type="text"
                        @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'extraDiscountText') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'extraDiscountText') }}" @endif>
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control" name="entsorgungExtraDiscount" placeholder="0" type="number"
                        @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'extraDiscountPrice') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'extraDiscountPrice') }}"
                        @else value="{{ 0 }}" @endif>
                </div>
            </div>

            <label class="col-form-label" for="l0">Geschätzte Kosten</label>
            <input class="form-control" name="entsorgungTotalPrice" placeholder="0" type="text"
                style="background-color: #286090;color:white;"
                @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'defaultPrice') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'defaultPrice') }}"
                @else value="{{ 0 }}" @endif>

            <label class="col-form-label" for="l0">Kostendach</label>
            <input class="form-control" name="entsorgungTopPrice" placeholder="0" type="text"
                style="background-color: #286090;color:white;"
                @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'topCost') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'topCost') }}"
                @else value="{{ 0 }}" @endif>

            <div class="mt-2">
                <small class=" text-primary">manuell gesetzt</small>
                <input type="checkbox" name="isEntsorgungMTPrice" id="isEntsorgungMTPrice" class="js-switch mt-1"
                    data-color="#286090" data-size="small" data-switchery="false">
            </div> <br>

            <label class="col-form-label" for="l0">Pauschal</label>
            <input class="form-control" name="entsorgungDefaultPrice" placeholder="0" type="text"
                style="background-color: #286090;color:white;"
                @if ($entsorgung && \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'fixedPrice') != null) value="{{ \App\Models\OfferteEntsorgung::InfoEntsorgung($entsorgung, 'fixedPrice') }}"
                @else value="{{ 0 }}" @endif>
        </div>
    </div>
</div>

