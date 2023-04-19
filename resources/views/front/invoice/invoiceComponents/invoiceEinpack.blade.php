<div class="form-group row">
    <div class="col-md-12 einpack-control">
        <label for="" class="col-form-label">Einpack</label><br>
        <input type="checkbox" name="isEinpack" id="isEinpack" class="js-switch " data-color="#9c27b0" data-switchery="false" >  
    </div>                            
</div>

<div id="einpack--area" class="rounded einpack--area" style="background-color: #CBB4FF; display:none;">
    <div class="row p-3">
        <div class="col-md-6">
            <label class=" col-form-label" for="l0">Datum</label>
            <input class="form-control" class="date"  name="einpackDate"  type="date" > 

            <div class="row">
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Anzahl Std </label>
                    <input id="einpackHours" class="form-control" class="time"  name="einpackHours"  type="number" value="0"> 
                    <a onclick="extraAreaEinpack()" class="extraTimeEinpack text-primary" style="cursor: pointer;">+ Weitere Zeiteingabe</a>
                </div>
    
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Ansatz [CHF]</label>
                    <input class="form-control" class="date"  name="einpackChf"  type="number" value="0"> 
                </div>
            </div>

            <div class="row extraTime-einpack-area" style="display: none;">
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Anzahl Std </label>
                    <input class="form-control" class="time"  name="einpackHours2"  type="number" value="0"> 
                </div>
    
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Ansatz [CHF]</label>
                    <input class="form-control" class="date"  name="einpackChf2"  type="number" value="0"> 
                </div>
            </div>

            <label class=" col-form-label" for="l0">Anfahrt/Rückfahrt [CHF]</label>
            <input class="form-control" class="date"  name="einpackRoadChf"  type="number" value="0"> 

            <div class="einpack-extra-cost mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="isEinpackExtra" id="isEinpackExtra" class="js-switch " data-color="#9c27b0" data-switchery="false" >  
            </div>  

            <div class="einpack-extra-cost-area" style="display: none;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="einpackMasraf"> <span class="label-text text-dark"><strong>Spesen</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="einpackExtra1" type="number" value="10">
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="einpackMasraf1"> <span class="label-text text-dark"><strong>Verpackungsmaterial</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="einpackExtra2" type="number" value="0">
                        </div>
                    </div>  

                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="einpackExtra1CostText" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="einpackExtra1Cost" placeholder="0"  type="text" value="0.00">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="einpackExtra2CostText" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="einpackExtra2Cost" placeholder="0"  type="text" value="0.00">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Rabatt</label>
            <input class="form-control"  name="einpackDiscount" placeholder="0"  type="text" value="0.00"> 

            <label class="col-form-label" for="l0">Rabatt[%]</label>
            <input class="form-control"  name="einpackDiscountPercent" placeholder="0"  type="text" value="0.00">

            <label class="col-form-label" for="l0">Entgegenkommen</label>
            <input class="form-control"  name="einpackDiscount2" placeholder="0"  type="text" value="0.00">

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="einpackExtraDiscountText" placeholder="Freier Text"  type="text">
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="einpackExtraDiscount" placeholder="0"  type="text" value="0.00">
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-md-7">
                    <input class="form-control"  name="einpackExtraDiscountText2" placeholder="Freier Text"  type="text" >
                </div>
                <div class="col-md-5">
                    <input class="form-control"  name="einpackExtraDiscount2" placeholder="0"  type="text"  value="0.00">
                </div>
            </div>
            
            <label class="col-form-label mt-1 " for="l0">Zwischenbetrag</label>
            <input class="form-control" id="einpackCost"  name="einpackCost" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00"> 

            <div class="einpack-fixed-price mt-1">
                <label for="" class="col-form-label">Pauschal</label><br>
                <input type="checkbox" name="isEinpackFixedPrice" id="isEinpackFixedPrice" class="js-switch " data-color="#9c27b0" data-size="small" data-switchery="false" >  
            </div> 

            <div class="einpack-fixed-price-area mt-1 mb-1" style="display: none;">
                <input class="form-control"  name="einpackFixedPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">
            </div>

            <label class="col-form-label" for="l0">Schadenzahlung</label>
            <input class="form-control"  name="einpackPaid1" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">

            <label class="col-form-label" for="l0">Anzahlung</label>
            <input class="form-control"  name="einpackPaid2" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">

            <label class="col-form-label" for="l0"> Bar Bezahlt</label>
            <input class="form-control"  name="einpackPaid3" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">

            <label class="col-form-label" for="l0">Betrag</label>
            <input class="form-control total-piece"  name="einpackTotalPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">
        </div>
    </div>
</div>
@section('invoiceFooter2')
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
