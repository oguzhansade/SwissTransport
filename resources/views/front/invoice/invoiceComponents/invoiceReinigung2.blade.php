<div class="form-group row">
    <div class="col-md-12 reinigung2-control">
        <label for="" class="col-form-label">Reinigung 2</label><br>
        <input type="checkbox" name="isReinigung2" id="isReinigung2" class="js-switch " data-color="#9c27b0" data-switchery="false" >  
    </div>                            
</div>

<div class="rounded reinigung2--area" style="background-color: #CBB4FF; display:none;">
    <div class="row p-3">
        <div class="col-md-6">
            <label class=" col-form-label" for="l0">Datum</label>
            <input class="form-control" class="date"  name="reinigung2Date"  type="date" > 

            <label class=" col-form-label" for="l0">Reinigungsart</label>
            <select class="form-control reinigung2Type" name="reinigung2Type" id="reinigung2Type" >
                <option data-selection="bos" value>Bitte wählen</option>
                <option data-selection="0" value="Wohnungsreinigung inkl. Abnahmegarantie">Wohnungsreinigung inkl. Abnahmegarantie</option>
                <option data-selection="1" value="Wohnungsreinigung inkl. Besenrein">Wohnungsreinigung inkl. Besenrein</option>
                <option data-selection="2" value="EFH-Reinigung inkl. Abnahmegarantie">EFH-Reinigung inkl. Abnahmegarantie</option>
                <option data-selection="3" value="EFH-Reinigung inkl. Besenrein">EFH-Reinigung inkl. Besenrein</option>
                <option data-selection="4" value="RFH-Reinigung inkl. Abnahmegarantie">RFH-Reinigung inkl. Abnahmegarantie</option>
                <option data-selection="5" value="RFH-Reinigung inkl. Besenrein">RFH-Reinigung inkl. Besenrein</option>
                <option data-selection="6" value="Baureinigung">Baureinigung</option>
                <option data-selection="7" value="Baureinigung inkl. Abnahmegarantie">Baureinigung inkl. Abnahmegarantie</option>
                <option data-selection="8" value="Baureinigung inkl. Besenrein">Baureinigung inkl. Besenrein</option>
                <option data-selection="9" value="Unterhaltsreinigung">Unterhaltsreinigung</option>
                <option data-selection="10" value="Geschäftsreinigung">Geschäftsreinigung</option>
                <option data-selection="11" value="Büroreinigung">Büroreinigung</option>
                <option data-selection="12" value="Lagerraum-Reinigung">Lagerraum-Reinigung</option>       
            </select>

            <div class="row reinigung2-type-manuel-area">
                <label class=" col-form-label" for="l0">manuelle Eingabe (Reinigungsart)</label>
                <input class="form-control reinigung2TypeManuel"  name="reinigung2TypeManuel"  type="text" >
            </div>
            
            <div class="mb-3">
                <label class="col-form-label" for="l0">Optional: Leistungen (für Teilreinigung oder Baureinigungsleistungen)</label>
                <input class="form-control extraReinigung2 "  name="extraReinigung2"  type="text" >
            </div>

            <div class="row p-1 mt-5 mb-3 rounded" style="background-color: #8778AA;">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Zimmer [3.5]</label>
                    <input class="form-control" class="reinigung2FixedRoom"  name="reinigung2FixedRoom"  type="text" >
                </div>

                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Tarifpreis</label>
                    <input class="form-control" class="reinigung2FixedPrice"  name="reinigung2FixedPrice"  type="number" value="0" min="0">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Anzahl Std</label>
                    <input class="form-control" class="time"  name="reinigung2Hours"  type="number" value="0"> 
                </div>
    
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Ansatz [CHF]</label>
                    <input class="form-control" class="date"  name="reinigung2Chf"  type="number" value="0"> 
                </div>
            </div>

            <div class="reinigung2-extra-cost mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="isReinigung2Extra" id="isReinigung2Extra" class="js-switch " data-color="#9c27b0" data-switchery="false" >  
            </div>  

            <div class="reinigung2-extra-cost-area" style="display: none;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="reinigung2Masraf1"> <span class="label-text text-dark"><strong>Hochdruckreiniger</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="reinigung2Extra1" type="number" value="200">
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="reinigung2Masraf2"> <span class="label-text text-dark"><strong>Stein- und Parkettböden</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="reinigung2Extra2" type="number" value="350">
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="reinigung2Masraf3"> <span class="label-text text-dark"><strong>Teppichschamponieren</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="reinigung2Extra3" type="number" value="200">
                        </div>
                    </div> 

                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="reinigung2Extra1CostText" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="reinigung2Extra1Cost" placeholder="0"  type="text" value="0.00">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="reinigung2Extra2CostText" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="reinigung2Extra2Cost" placeholder="0"  type="text" value="0.00">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Rabatt</label>
            <input class="form-control"  name="reinigung2Discount" placeholder="0"  type="text" value="0.00"> 

            <label class="col-form-label" for="l0">Rabatt[%]</label>
            <input class="form-control"  name="reinigung2DiscountPercent" placeholder="0"  type="text" value="0.00"> 

            <label class="col-form-label" for="l0">Entgegenkommen</label>
            <input class="form-control"  name="reinigung2Discount2" placeholder="0"  type="text" value="0.00">

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="reinigung2ExtraDiscountText" placeholder="Freier Text"  type="text">
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="reinigung2ExtraDiscount" placeholder="0"  type="text" value="0.00">
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-md-7">
                    <input class="form-control"  name="reinigung2ExtraDiscountText2" placeholder="Freier Text"  type="text" >
                </div>
                <div class="col-md-5">
                    <input class="form-control"  name="reinigung2ExtraDiscount2" placeholder="0"  type="text"  value="0.00">
                </div>
            </div>
            
            <label class="col-form-label mt-1 mb-2" for="l0">Preis</label>
            <input class="form-control" id="reinigung2Cost"  name="reinigung2Cost" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00"> 

            <label class="col-form-label mt-5" for="l0">Schadenzahlung</label>
            <input class="form-control"  name="reinigung2Paid1" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">

            <label class="col-form-label" for="l0">Anzahlung</label>
            <input class="form-control"  name="reinigung2Paid2" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">

            <label class="col-form-label" for="l0">Bar Bezahlt</label>
            <input class="form-control"  name="reinigung2Paid3" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">

            <label class="col-form-label" for="l0">Betrag</label>
            <input class="form-control total-piece"  name="reinigung2TotalPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">
        </div>
    </div>
</div>
@section('invoiceFooterReinigung2')

{{-- Tarife Fiyatları --}}
<script>
    $(document).ready(function (){
        let isFixedPrice = parseInt($('input[name=reinigung2FixedPrice]').val());
        reinigung2InvoiceCalc()
        if($("div.reinigung2--area").is(":visible"))
        {
            isRequiredReinigung2()
        }
    })
    
    function isRequiredReinigung2()
    {
        $("input[name=reinigung2Date]").prop('required',true);  
        $("select[name=reinigung2Type]").prop("required",true);   
        $("input[name=reinigung2Hours]").prop('required',true);   
        $("input[name=reinigung2Chf]").prop('required',true); 
        $("input[name=reinigung2FixedPrice]").prop("required",true);
        $("input[name=reinigung2Hours]").attr({'min':1}); 
        $("input[name=reinigung2Chf]").attr({'min':1});  
    }

    function isNotRequiredReinigung2()
    {
        $("input[name=reinigung2Date]").prop('required',false); 
        $("select[name=reinigung2Type]").prop("required",false);     
        $("input[name=reinigung2Hours]").prop('required',false);   
        $("input[name=reinigung2Chf]").prop('required',false);  
        $("input[name=reinigung2FixedPrice]").prop("required",false);
        $("input[name=reinigung2TypeManuel]").prop("required",false);
        $("input[name=reinigung2Hours]").removeAttr('min'); 
        $("input[name=reinigung2Chf]").removeAttr('min');
        
    }

    $("body").on("change",".reinigung2--area",function (){
        let isFixedPrice = parseInt($('input[name=reinigung2FixedPrice]').val());
        if(isFixedPrice != 0){
            $("input[name=reinigung2Hours]").prop("required",false);
            $("input[name=reinigung2Chf]").prop("required",false);
            $("input[name=reinigung2Hours]").removeAttr('min'); 
            $("input[name=reinigung2Chf]").removeAttr('min');
        }
        else{
            $("input[name=reinigung2FixedPrice]").prop("required",false);
            $("input[name=reinigung2Hours]").prop("required",true);
            $("input[name=reinigung2Chf]").prop("required",true);
            $("input[name=reinigung2Hours]").removeAttr('min'); 
            $("input[name=reinigung2Chf]").removeAttr('min');
           
        }
        reinigung2InvoiceCalc()
    })

    $("select[name=reinigung2Type]").on("change",function () {
        let control = $(this).find(":selected").data('selection');

        if (control == 'bos')
        {
            $('.reinigung2-type-manuel-area').show(300)
            $("select[name=reinigung2Type]").prop("required",false);
            $("input[name=reinigung2TypeManuel]").prop("required",true);
        }
        else
        {
            $('.reinigung2-type-manuel-area').hide(300)
            $("select[name=reinigung2Type]").prop("required",true);
            $("input[name=reinigung2TypeManuel]").prop("required",false);
            $("input[name=reinigung2TypeManuel]").val("");
        }
    })

    var morebutton6 = $("div.reinigung2-control");
    morebutton6.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".reinigung2--area").show(700);
            isRequiredReinigung2()
            
        }
        else{
            $(".reinigung2--area").hide(500);
            isNotRequiredReinigung2()
        }
    })

    function reinigung2InvoiceCalc() {
            const reinigung2Chf = parseInt($("input[name=reinigung2Chf]").val()) || 0;
            const reinigung2Hours = parseInt($("input[name=reinigung2Hours]").val()) || 0;
            const reinigung2RoadChf = parseInt($("input[name=reinigung2RoadChf]").val()) || 0;
            const reinigung2DiscountPercent = parseInt($("input[name=reinigung2DiscountPercent]").val()) || 0;
            let reinigung2TotalPrice = 0;
            let reinigung2ExtrasTotal = 0;
            const reinigung2Extras = [
                {name: 'reinigung2Extra1', masraf: 'reinigung2Masraf1'},
                {name: 'reinigung2Extra2', masraf: 'reinigung2Masraf2'},
                {name: 'reinigung2Extra3', masraf: 'reinigung2Masraf3'},
            ];
            
            for (const reinigung2Extra of reinigung2Extras) {
                if ($(`input[name=${reinigung2Extra.masraf}]`).is(':checked')) {
                const value = parseInt($(`input[name=${reinigung2Extra.name}]`).val()) || 0;
                reinigung2ExtrasTotal += isNaN(value) ? 0 : value;
                }
            }

            const reinigung2Extra1Cost = parseFloat($('input[name=reinigung2Extra1Cost]').val()) || 0;
            const reinigung2Extra2Cost = parseFloat($('input[name=reinigung2Extra2Cost]').val()) || 0;
            const reinigung2Discount = parseFloat($('input[name=reinigung2Discount]').val()) || 0 ;
            const reinigung2Discount2 = parseFloat($('input[name=reinigung2Discount2]').val()) || 0;
            const reinigung2ExtraDiscount = parseFloat($('input[name=reinigung2ExtraDiscount]').val()) || 0;
            const reinigung2ExtraDiscount2 = parseFloat($('input[name=reinigung2ExtraDiscount2]').val()) || 0;

            const reinigung2Paid1 = parseFloat($('input[name=reinigung2Paid1]').val()) || 0;
            const reinigung2Paid2 = parseFloat($('input[name=reinigung2Paid2]').val()) || 0;
            const reinigung2Paid3 = parseFloat($('input[name=reinigung2Paid3]').val()) || 0;
            
            const reinigung2FixedPrice = parseFloat($('input[name=reinigung2FixedPrice]').val()) || 0;

            if(reinigung2FixedPrice > 0) {
                $("input[name=reinigung2Cost]").val(reinigung2FixedPrice);
                reinigung2TotalPrice = reinigung2FixedPrice;
            }
            else {
                const reinigung2PreCost = (reinigung2Hours * reinigung2Chf)  +
                (reinigung2RoadChf + reinigung2ExtrasTotal + reinigung2Extra1Cost + reinigung2Extra2Cost);

                const reinigung2Cost = (reinigung2Hours * reinigung2Chf) +
                (reinigung2RoadChf + reinigung2ExtrasTotal + reinigung2Extra1Cost + reinigung2Extra2Cost) - (reinigung2PreCost*reinigung2DiscountPercent/100) -
                reinigung2Discount - reinigung2Discount2 - reinigung2ExtraDiscount - reinigung2ExtraDiscount2;
           
                $("input[name=reinigung2Cost]").val(reinigung2Cost);
                reinigung2TotalPrice = reinigung2Cost;
            }
            
            reinigung2TotalPrice -= reinigung2Paid1 + reinigung2Paid2 + reinigung2Paid3;
            reinigung2TotalPrice = parseFloat(reinigung2TotalPrice);
            $("input[name=reinigung2TotalPrice]").val(reinigung2TotalPrice.toFixed(2));
            console.log(reinigung2Paid1, reinigung2Paid2 , reinigung2Paid3)
            
        }
    
    
</script>

{{-- İlave ücret Aç/kapa --}}
<script>
    var reinigung2extracostbutton = $("div.reinigung2-extra-cost");
    reinigung2extracostbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".reinigung2-extra-cost-area").show(700);
        }
        else{
            $(".reinigung2-extra-cost-area").hide(500);
        }
    })
</script>
@endsection