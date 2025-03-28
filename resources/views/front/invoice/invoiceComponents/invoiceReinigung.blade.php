<div class="form-group row">
    <div class="col-md-12 reinigung-control">
        <label for="" class="col-form-label">Reinigung</label><br>
        <input type="checkbox" name="isReinigung" id="isReinigung" class="js-switch " data-color="#286090" data-switchery="false" >  
    </div>                            
</div>

<div class="rounded reinigung--area" style="background-color: #C8DFF3; display:none;">
    <div class="row p-3">
        <div class="col-md-6">
            <label class=" col-form-label" for="l0">Datum</label>
            <input class="form-control" class="date"  name="reinigungDate"  type="date" > 

            <label class=" col-form-label" for="l0">Reinigungsart</label>
            <select class="form-control reinigungType" name="reinigungType" id="reinigungType" >
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

            <div class="row reinigung-type-manuel-area">
                <label class=" col-form-label" for="l0">manuelle Eingabe (Reinigungsart)</label>
                <input class="form-control reinigungTypeManuel"  name="reinigungTypeManuel"  type="text" >
            </div>
            
            <div class="mb-3">
                <label class="col-form-label" for="l0">Optional: Leistungen (für Teilreinigung oder Baureinigungsleistungen)</label>
                <input class="form-control extraReinigung "  name="extraReinigung"  type="text" >
            </div>

            <div class="row p-1 mt-5 mb-3 rounded" style="background-color: #286090;">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Zimmer [3.5]</label>
                    <input class="form-control" class="reinigungFixedRoom"  name="reinigungFixedRoom"  type="text" >
                </div>

                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Tarifpreis</label>
                    <input class="form-control" class="reinigungFixedPrice"  name="reinigungFixedPrice"  type="number" value="0" min="0">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Anzahl Std</label>
                    <input class="form-control" class="time"  name="reinigungHours"  type="number" value="0"> 
                </div>
    
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Ansatz [CHF]</label>
                    <input class="form-control" class="date"  name="reinigungChf"  type="number" value="0"> 
                </div>
            </div>

            <div class="reinigung-extra-cost mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="isReinigungExtra" id="isReinigungExtra" class="js-switch " data-color="#286090" data-switchery="false" >  
            </div>  

            <div class="reinigung-extra-cost-area" style="display: none;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="reinigungMasraf1"> <span class="label-text text-dark"><strong>Hochdruckreiniger</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="reinigungExtra1" type="number" value="200">
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="reinigungMasraf2"> <span class="label-text text-dark"><strong>Stein- und Parkettböden</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="reinigungExtra2" type="number" value="350">
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="reinigungMasraf3"> <span class="label-text text-dark"><strong>Teppichschamponieren</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="reinigungExtra3" type="number" value="200">
                        </div>
                    </div> 

                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="reinigungExtra1CostText" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="reinigungExtra1Cost" placeholder="0"  type="text" value="0.00">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="reinigungExtra2CostText" placeholder="Freier Text"  type="text" >
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="reinigungExtra2Cost" placeholder="0"  type="text" value="0.00">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Rabatt</label>
            <input class="form-control"  name="reinigungDiscount" placeholder="0"  type="text" value="0.00"> 

            <label class="col-form-label" for="l0">Rabatt[%]</label>
            <input class="form-control"  name="reinigungDiscountPercent" placeholder="0"  type="text" value="0.00"> 

            <label class="col-form-label" for="l0">Entgegenkommen</label>
            <input class="form-control"  name="reinigungDiscount2" placeholder="0"  type="text" value="0.00">

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="reinigungExtraDiscountText" placeholder="Freier Text"  type="text">
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="reinigungExtraDiscount" placeholder="0"  type="text" value="0.00">
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-md-7">
                    <input class="form-control"  name="reinigungExtraDiscountText2" placeholder="Freier Text"  type="text" >
                </div>
                <div class="col-md-5">
                    <input class="form-control"  name="reinigungExtraDiscount2" placeholder="0"  type="text"  value="0.00">
                </div>
            </div>
            
            <label class="col-form-label mt-1 mb-2" for="l0">Preis</label>
            <input class="form-control" id="reinigungCost"  name="reinigungCost" placeholder="0"  type="text" style="background-color: #286090;color:white;" value="0.00"> 

            <label class="col-form-label mt-5" for="l0">Schadenzahlung</label>
            <input class="form-control"  name="reinigungPaid1" placeholder="0"  type="text" style="background-color: #286090;color:white;" value="0.00">

            <label class="col-form-label" for="l0">Anzahlung</label>
            <input class="form-control"  name="reinigungPaid2" placeholder="0"  type="text" style="background-color: #286090;color:white;" value="0.00">

            <label class="col-form-label" for="l0">Bar Bezahlt</label>
            <input class="form-control"  name="reinigungPaid3" placeholder="0"  type="text" style="background-color: #286090;color:white;" value="0.00">

            <label class="col-form-label" for="l0">Betrag</label>
            <input class="form-control total-piece"  name="reinigungTotalPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;" value="0.00">
        </div>
    </div>
</div>
@section('invoiceFooterReinigung')

{{-- Tarife Fiyatları --}}
<script>
    $(document).ready(function (){
        let isFixedPrice = parseInt($('input[name=reinigungFixedPrice]').val());
        reinigungInvoiceCalc()
        
        if($("div.reinigung--area").is(":visible"))
        {
            isRequiredReinigung()
        }
    })
    
    function isRequiredReinigung()
    {
        $("input[name=reinigungDate]").prop('required',true);  
        $("select[name=reinigungType]").prop("required",true);   
        $("input[name=reinigungHours]").prop('required',true);   
        $("input[name=reinigungChf]").prop('required',true); 
        $("input[name=reinigungFixedPrice]").prop("required",true);
        $("input[name=reinigungHours]").attr({'min':1}); 
        $("input[name=reinigungChf]").attr({'min':1});  
    }

    function isNotRequiredReinigung()
    {
        $("input[name=reinigungDate]").prop('required',false); 
        $("select[name=reinigungType]").prop("required",false);     
        $("input[name=reinigungHours]").prop('required',false);   
        $("input[name=reinigungChf]").prop('required',false);  
        $("input[name=reinigungFixedPrice]").prop("required",false);
        $("input[name=reinigungTypeManuel]").prop("required",false);
        $("input[name=reinigungHours]").removeAttr('min'); 
        $("input[name=reinigungChf]").removeAttr('min');
        
    }

        $("body").on("change",".reinigung--area",function (){
            let isFixedPrice = parseInt($('input[name=reinigungFixedPrice]').val());
            if(isFixedPrice != 0){
                $("input[name=reinigungHours]").prop("required",false);
                $("input[name=reinigungChf]").prop("required",false);
                $("input[name=reinigungHours]").removeAttr('min'); 
                $("input[name=reinigungChf]").removeAttr('min');
            }
            else{
                $("input[name=reinigungFixedPrice]").prop("required",false);
                $("input[name=reinigungHours]").prop("required",true);
                $("input[name=reinigungChf]").prop("required",true);
                $("input[name=reinigungHours]").removeAttr('min'); 
                $("input[name=reinigungChf]").removeAttr('min');
            
            }
            reinigungInvoiceCalc()
        })  

        $("select[name=reinigungType]").on("change",function () {
            let control = $(this).find(":selected").data('selection');

            if (control == 'bos')
            {
                $('.reinigung-type-manuel-area').show(300)
                $("select[name=reinigungType]").prop("required",false);
                $("input[name=reinigungTypeManuel]").prop("required",true);
            }
            else
            {
                $('.reinigung-type-manuel-area').hide(300)
                $("select[name=reinigungType]").prop("required",true);
                $("input[name=reinigungTypeManuel]").prop("required",false);
                $("input[name=reinigungTypeManuel]").val("");
            }
        })

        var morebutton5 = $("div.reinigung-control");
        morebutton5.click(function(){
            if($(this).hasClass("checkbox-checked"))
            {
                $(".reinigung--area").show(700);
                isRequiredReinigung()
                
            }
            else{
                $(".reinigung--area").hide(500);
                isNotRequiredReinigung()
            }
        })

    
    
        function reinigungInvoiceCalc() {
            const reinigungChf = parseInt($("input[name=reinigungChf]").val()) || 0;
            const reinigungHours = parseInt($("input[name=reinigungHours]").val()) || 0;
            const reinigungRoadChf = parseInt($("input[name=reinigungRoadChf]").val()) || 0;
            const reinigungDiscountPercent = parseInt($("input[name=reinigungDiscountPercent]").val()) || 0;
            
            let reinigungTotalPrice = 0;
            let reinigungExtrasTotal = 0;
            const reinigungExtras = [
                {name: 'reinigungExtra1', masraf: 'reinigungMasraf1'},
                {name: 'reinigungExtra2', masraf: 'reinigungMasraf2'},
                {name: 'reinigungExtra3', masraf: 'reinigungMasraf3'},
            ];
            
            for (const reinigungExtra of reinigungExtras) {
                if ($(`input[name=${reinigungExtra.masraf}]`).is(':checked')) {
                const value = parseInt($(`input[name=${reinigungExtra.name}]`).val()) || 0;
                reinigungExtrasTotal += isNaN(value) ? 0 : value;
                }
            }

            const reinigungExtra1Cost = parseFloat($('input[name=reinigungExtra1Cost]').val()) || 0;
            const reinigungExtra2Cost = parseFloat($('input[name=reinigungExtra2Cost]').val()) || 0;
            const reinigungDiscount = parseFloat($('input[name=reinigungDiscount]').val()) || 0 ;
            const reinigungDiscount2 = parseFloat($('input[name=reinigungDiscount2]').val()) || 0;
            const reinigungExtraDiscount = parseFloat($('input[name=reinigungExtraDiscount]').val()) || 0;
            const reinigungExtraDiscount2 = parseFloat($('input[name=reinigungExtraDiscount2]').val()) || 0;

            const reinigungPaid1 = parseFloat($('input[name=reinigungPaid1]').val()) || 0;
            const reinigungPaid2 = parseFloat($('input[name=reinigungPaid2]').val()) || 0;
            const reinigungPaid3 = parseFloat($('input[name=reinigungPaid3]').val()) || 0;
            
            const reinigungFixedPrice = parseFloat($('input[name=reinigungFixedPrice]').val()) || 0;

            if(reinigungFixedPrice > 0) {
                $("input[name=reinigungCost]").val(reinigungFixedPrice);
                reinigungTotalPrice = reinigungFixedPrice;
            }
            else {
                const reinigungPreCost = (reinigungHours * reinigungChf)  +
                (reinigungRoadChf + reinigungExtrasTotal + reinigungExtra1Cost + reinigungExtra2Cost);

                const reinigungCost = (reinigungHours * reinigungChf) +
                (reinigungRoadChf + reinigungExtrasTotal + reinigungExtra1Cost + reinigungExtra2Cost) - (reinigungPreCost*reinigungDiscountPercent/100) -
                reinigungDiscount - reinigungDiscount2 - reinigungExtraDiscount - reinigungExtraDiscount2;
           
                $("input[name=reinigungCost]").val(reinigungCost);
                reinigungTotalPrice = reinigungCost;
            }
            
            reinigungTotalPrice -= reinigungPaid1 + reinigungPaid2 + reinigungPaid3;
            reinigungTotalPrice = parseFloat(reinigungTotalPrice);
            $("input[name=reinigungTotalPrice]").val(reinigungTotalPrice.toFixed(2));
            console.log(reinigungPaid1, reinigungPaid2 , reinigungPaid3)
            
        }
    
</script>

{{-- İlave ücret Aç/kapa --}}
<script>
    var reinigungextracostbutton = $("div.reinigung-extra-cost");
    reinigungextracostbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".reinigung-extra-cost-area").show(700);
        }
        else{
            $(".reinigung-extra-cost-area").hide(500);
        }
    })
</script>
@endsection