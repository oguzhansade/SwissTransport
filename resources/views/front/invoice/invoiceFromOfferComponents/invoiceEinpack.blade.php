<div class="form-group row">
    <div class="col-md-12 einpack-control">
        <label for="" class="col-form-label">Einpack</label><br>
        <input type="checkbox" name="isEinpack" id="isEinpack" class="js-switch " data-color="#286090" data-switchery="false"
            @if ($einpack) checked @endif>
    </div>
</div>

<div id="einpack--area" class="rounded einpack--area"
    style="background-color: #C8DFF3; @if ($einpack == null) display:none; @endif">
    <div class="row p-3">
        <div class="col-md-6">
            <label class=" col-form-label" for="l0">Datum</label>
            <input class="form-control" class="date" name="einpackDate" type="date"
                @if ($einpack && $einpack['einpackDate']) value="{{ $einpack['einpackDate'] }}" @endif>

            <div class="row">
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Anzahl Std</label>
                    <?php
                    if ($einpack && $einpack['moveHours']) {
                        $einpackHours = is_numeric($einpack['moveHours']) ? $einpack['moveHours'] : explode('-', $einpack['moveHours'])[1];
                        $einpackHours = (int) $einpackHours; // "$umzugHours" değişkenini integer'a dönüştürür
                    }
                    ?>
                    <input class="form-control" class="time" name="einpackHours" type="number"
                        @if ($einpack) value="{{ $einpackHours }}" @endif>
                    <a onclick="extraAreaEinpack()" class="extraTimeEinpack text-primary" style="cursor: pointer;">+ Weitere
                        Zeiteingabe</a>
                </div>

                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Ansatz [CHF]</label>
                    <input class="form-control" class="date" name="einpackChf" type="number"
                        @if ($einpack && $einpack['chf']) value="{{ $einpack['chf'] }}" @else value="0" @endif>
                </div>
            </div>

            <div class="row extraTime-einpack-area" style="display: none;">
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Anzahl Std </label>
                    <input class="form-control" class="time" name="einpackHours2" type="number" value="0">
                </div>

                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Ansatz [CHF]</label>
                    <input class="form-control" class="date" name="einpackChf2" type="number" value="0">
                </div>
            </div>

            <label class=" col-form-label" for="l0">Anfahrt/Rückfahrt [CHF]</label>
            <input class="form-control" class="date" name="einpackRoadChf" type="number"
                @if ($einpack && $einpack['arrivalReturn']) value="{{ $einpack['arrivalReturn'] }}" @else value="0" @endif>

            <div class="einpack-extra-cost mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="isEinpackExtra" id="isEinpackExtra" class="js-switch " data-color="#286090"
                    data-switchery="false"
                    @if (
                        $einpack &&
                            $einpack['extra'] == null &&
                            $einpack['extra1'] == null &&
                            $einpack['extraValue1'] == null &&
                            $einpack['extraValue2'] == null) unchecked
                @else checked @endif>
            </div>

            <div class="einpack-extra-cost-area" @if (
                $einpack &&
                    $einpack['extra'] == null &&
                    $einpack['extra1'] == null &&
                    $einpack['extraValue1'] == null &&
                    $einpack['extraValue2'] == null) style="display: none;" @endif>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="einpackMasraf"
                                        @if ($einpack && $einpack['extra']) checked @endif>
                                    <span class="label-text text-dark"><strong>Spesen</strong></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="einpackExtra1" type="number"
                                @if ($einpack && $einpack['extra']) value="{{ $einpack['extra'] }}" @else value="10" @endif>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="einpackMasraf1"
                                        @if ($einpack && $einpack['extra1']) checked @endif>
                                    <span class="label-text text-dark"><strong>Verpackungsmaterial</strong></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="einpackExtra2" type="number"
                                @if ($einpack && $einpack['extra1']) value="{{ $einpack['extra1'] }}" @else value="0" @endif>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control" name="einpackExtra1CostText" placeholder="Freier Text"
                                type="text"
                                @if ($einpack && $einpack['customCostPrice1']) value="{{ $einpack['customCostName1'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="einpackExtra1Cost" placeholder="0" type="text"
                                @if ($einpack && $einpack['customCostPrice1']) value="{{ $einpack['customCostPrice1'] }}" @else value="0.00" @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control" name="einpackExtra2CostText" placeholder="Freier Text"
                                type="text"
                                @if ($einpack && $einpack['customCostPrice2']) value="{{ $einpack['customCostName2'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="einpackExtra2Cost" placeholder="0" type="text"
                                @if ($einpack && $einpack['customCostPrice2']) value="{{ $einpack['customCostPrice2'] }}" @else value="0.00" @endif>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Rabatt</label>
            <input class="form-control" name="einpackDiscount" placeholder="0" type="text"
                @if ($einpack && $einpack['discount']) value="{{ $einpack['discount'] }}" @else value="0.00" @endif>

            <label class="col-form-label" for="l0">Rabatt[%]</label>
            <input class="form-control"  name="einpackDiscountPercent" placeholder="0"  type="text" 
            @if($einpack && $einpack['discountPercent']) value="{{ $einpack['discountPercent'] }}" @else value="0.00" @endif> 

            <label class="col-form-label" for="l0">Entgegenkommen</label>
            <input class="form-control" name="einpackDiscount2" placeholder="0" type="text"
                @if ($einpack && $einpack['compromiser']) value="{{ $einpack['compromiser'] }}" @else value="0.00" @endif>

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control" name="einpackExtraDiscountText" placeholder="Freier Text"
                        type="text"
                        @if ($einpack && $einpack['extraCostPrice']) value="{{ $einpack['extraCostName'] }}" @endif>
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control" name="einpackExtraDiscount" placeholder="0" type="text"
                        @if ($einpack && $einpack['extraCostPrice']) value="{{ $einpack['extraCostPrice'] }}" @else value="0.00" @endif>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-md-7">
                    <input class="form-control" name="einpackExtraDiscountText2" placeholder="Freier Text"
                        type="text">
                </div>
                <div class="col-md-5">
                    <input class="form-control" name="einpackExtraDiscount2" placeholder="0" type="text"
                        value="0.00">
                </div>
            </div>

            <label class="col-form-label mt-1 " for="l0">Zwischenbetrag</label>
            <?php
            if ($einpack && $einpack['costPrice']) {
                $einpackCost = is_numeric($einpack['costPrice']) ? $einpack['costPrice'] : explode('-', $einpack['costPrice'])[1];
                $einpackCost = floatval($einpackCost); // "$einpackCost" değişkenini integer'a dönüştürür
            }
            ?>
            <input class="form-control" id="einpackCost" name="einpackCost" placeholder="0" type="text"
                style="background-color: #286090;color:white;"
                @if ($einpack) value="{{ $einpackCost }}" @else value="0.00" @endif>

            <div class="einpack-fixed-price mt-1">
                <label for="" class="col-form-label">Pauschal</label><br>
                <input type="checkbox" name="isEinpackFixedPrice" id="isEinpackFixedPrice" class="js-switch "
                    data-color="#286090" data-size="small" data-switchery="false"
                    @if ($einpack && $einpack['fixedPrice']) checked @endif>
            </div>

            <div class="einpack-fixed-price-area mt-1 mb-1"
                @if ($einpack && $einpack['fixedPrice'] == null) style="display: none;" @endif>
                <input class="form-control" name="einpackFixedPrice" placeholder="0" type="text"
                    style="background-color: #286090;color:white;"
                    @if ($einpack && $einpack['fixedPrice']) value="{{ $einpack['fixedPrice'] }}" @else value="0.00" @endif>
            </div>

            <label class="col-form-label" for="l0">Schadenzahlung</label>
            <input class="form-control" name="einpackPaid1" placeholder="0" type="text"
                style="background-color: #286090;color:white;" value="0.00">

            <label class="col-form-label" for="l0">Anzahlung</label>
            <input class="form-control" name="einpackPaid2" placeholder="0" type="text"
                style="background-color: #286090;color:white;" value="0.00">

            <label class="col-form-label" for="l0">Bar Bezahlt</label>
            <input class="form-control" name="einpackPaid3" placeholder="0" type="text"
                style="background-color: #286090;color:white;" value="0.00">

            <label class="col-form-label" for="l0">Betrag</label>
            <input class="form-control total-piece" name="einpackTotalPrice" placeholder="0" type="text"
                style="background-color: #286090;color:white;"
                @if ($einpack && $einpack['fixedPrice']) value="{{ $einpack['fixedPrice'] }}" @elseif($einpack && $einpack['costPrice']) value="{{ $einpack['fixedPrice'] }}" @else value="0.00" @endif>
        </div>
    </div>
</div>
@section('invoiceOfferEinpack')
    {{-- Tarife Fiyatları --}}
    <script>
        function isRequiredEinpack() {
            $("input[name=einpackDate]").prop('required', true);
            $("input[name=einpackHours]").prop('required', true);
            $("input[name=einpackChf]").prop('required', true);
            $("input[name=einpackHours]").attr({
                'min': 1
            });
            $("input[name=einpackChf]").attr({
                'min': 1
            });
        }

        function isNotRequiredEinpack() {
            $("input[name=einpackDate]").prop('required', false);
            $("input[name=einpackHours]").prop('required', false);
            $("input[name=einpackChf]").prop('required', false);
            $("input[name=einpackHours]").removeAttr('min');
            $("input[name=einpackChf]").removeAttr('min');
            $("input[name=einpackChf2]").removeAttr('min');
            $("input[name=einpackHours2]").removeAttr('min');
        }

        function extraAreaEinpack() {
            $(".extraTime-einpack-area").show(300);
            $(".extraTimeEinpack").hide();
            $("input[name=einpackChf2]").attr({
                'min': 1
            });
            $("input[name=einpackHours2]").attr({
                'min': 1
            });
        }

        $("body").on("change", ".einpack--area", function() {
            isRequiredEinpack()
            einpackInvoiceCalc()
        })

        var morebutton3 = $("div.einpack-control");
        morebutton3.click(function() {
            if ($(this).hasClass("checkbox-checked")) {
                $(".einpack--area").show(700);
                isRequiredEinpack()
            } else {
                $(".einpack--area").hide(500);
                isNotRequiredEinpack()
            }
        })

        var isEinpackFixedbutton = $("div.einpack-fixed-price");
        isEinpackFixedbutton.click(function() {
            if ($(this).hasClass("checkbox-checked")) {
                $(".einpack-fixed-price-area").show(700);
            } else {
                $(".einpack-fixed-price-area").hide(500);
            }
        })


        $(document).ready(function() {
            einpackInvoiceCalc()
            if($("div.einpack--area").is(":visible"))
            {
                isRequiredEinpack()
            }
        })
        
        function einpackInvoiceCalc() {
            const einpackChf = parseInt($("input[name=einpackChf]").val()) || 0;
            const einpackHours = parseInt($("input[name=einpackHours]").val()) || 0;
            const einpackChf2 = parseInt($("input[name=einpackChf2]").val()) || 0;
            const einpackHours2 = parseInt($("input[name=einpackHours2]").val()) || 0;
            const einpackRoadChf = parseInt($("input[name=einpackRoadChf]").val()) || 0;
            const einpackExtras = [
                {name: 'einpackExtra1', masraf: 'einpackMasraf'},
                {name: 'einpackExtra2', masraf: 'einpackMasraf1'},
            ];
            let einpackExtrasTotal = 0;
            for (const einpackExtra of einpackExtras) {
                if ($(`input[name=${einpackExtra.masraf}]`).is(':checked')) {
                const value = parseInt($(`input[name=${einpackExtra.name}]`).val()) || 0;
                einpackExtrasTotal += isNaN(value) ? 0 : value;
                }
            }

            const einpackExtra1Cost = parseFloat($('input[name=einpackExtra1Cost]').val()) || 0;
            const einpackExtra2Cost = parseFloat($('input[name=einpackExtra2Cost]').val()) || 0;
            const einpackDiscount = parseFloat($('input[name=einpackDiscount]').val()) || 0 ;
            const einpackDiscount2 = parseFloat($('input[name=einpackDiscount2]').val()) || 0;
            const einpackExtraDiscount = parseFloat($('input[name=einpackExtraDiscount]').val()) || 0;
            const einpackExtraDiscount2 = parseFloat($('input[name=einpackExtraDiscount]').val()) || 0;
            const einpackDiscountPercent = parseFloat($('input[name=einpackDiscountPercent]').val()) || 0;

            const einpackPaid1 = parseFloat($('input[name=einpackPaid1]').val()) || 0;
            const einpackPaid2 = parseFloat($('input[name=einpackPaid2]').val()) || 0;
            const einpackPaid3 = parseFloat($('input[name=einpackPaid3]').val()) || 0;
            let einpackTotalPrice;

            const einpackPreCost = (einpackHours * einpackChf) + (einpackHours2 * einpackChf2) +
            (einpackRoadChf + einpackExtrasTotal + einpackExtra1Cost + einpackExtra2Cost) ;

            const einpackCost = (einpackHours * einpackChf) + (einpackHours2 * einpackChf2) +
            (einpackRoadChf + einpackExtrasTotal + einpackExtra1Cost + einpackExtra2Cost) - (einpackPreCost*einpackDiscountPercent/100) -
            einpackDiscount - einpackDiscount2 - einpackExtraDiscount - einpackExtraDiscount2;

            $("input[name=einpackCost]").val(einpackCost);

            const isEinpackFixedPrice = $('input[name=isEinpackFixedPrice]').is(":checked");
            const einpackFixedPrice = parseFloat($('input[name=einpackFixedPrice]').val()) || 0;
            einpackTotalPrice = isEinpackFixedPrice ? einpackFixedPrice : einpackCost;
            einpackTotalPrice -= einpackPaid1 + einpackPaid2 + einpackPaid3;
            $("input[name=einpackTotalPrice]").val(einpackTotalPrice);
            
        }

    </script>
    {{-- İlave ücret Aç/kapa --}}
    <script>
        var einpackextracostbutton = $("div.einpack-extra-cost");
        einpackextracostbutton.click(function() {
            if ($(this).hasClass("checkbox-checked")) {
                $(".einpack-extra-cost-area").show(700);
            } else {
                $(".einpack-extra-cost-area").hide(500);
            }
        })
    </script>
@endsection
