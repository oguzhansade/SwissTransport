<div class="form-group row">
    <div class="col-md-12 reinigung-control">
        <label for="" class="col-form-label">Reinigung</label><br>
        <input type="checkbox" name="isReinigung" id="isReinigung" class="js-switch " data-color="#9c27b0" data-switchery="false" @if($reinigung) checked @endif>  
    </div>                            
</div>

<div class="rounded reinigung--area" style="background-color: #CBB4FF; @if($reinigung == NULL) display:none; @endif">
    <div class="row p-3">
        <div class="col-md-6">
            <label class=" col-form-label" for="l0">Datum</label>
            <input class="form-control" class="date"  name="reinigungDate"  type="date" 
            @if($reinigung) value="{{ $reinigung['startDate'] }}" @endif> 

            <label class=" col-form-label" for="l0">Reinigungsart</label>
            <select class="form-control reinigungType" name="reinigungType" id="reinigungType" >
                <option data-selection="bos" value>Bitte wählen</option>
                <option data-selection="0" value="Wohnungsreinigung inkl. Abnahmegarantie" 
                @if($reinigung && $reinigung['reinigungType'] == 'Wohnungsreinigung inkl. Abnahmegarantie') selected @endif>Wohnungsreinigung inkl. Abnahmegarantie</option>
                <option data-selection="1" value="Wohnungsreinigung inkl. Besenrein"
                @if($reinigung && $reinigung['reinigungType'] == 'Wohnungsreinigung inkl. Besenrein') selected @endif>Wohnungsreinigung inkl. Besenrein</option>
                <option data-selection="2" value="EFH-Reinigung inkl. Abnahmegarantie"
                @if($reinigung && $reinigung['reinigungType'] == 'EFH-Reinigung inkl. Abnahmegarantie') selected @endif>EFH-Reinigung inkl. Abnahmegarantie</option>
                <option data-selection="3" value="EFH-Reinigung inkl. Besenrein"
                @if($reinigung && $reinigung['reinigungType'] == 'EFH-Reinigung inkl. Besenrein') selected @endif>EFH-Reinigung inkl. Besenrein</option>
                <option data-selection="4" value="RFH-Reinigung inkl. Abnahmegarantie"
                @if($reinigung && $reinigung['reinigungType'] == 'RFH-Reinigung inkl. Abnahmegarantie') selected @endif>RFH-Reinigung inkl. Abnahmegarantie</option>
                <option data-selection="5" value="RFH-Reinigung inkl. Besenrein"
                @if($reinigung && $reinigung['reinigungType'] == 'RFH-Reinigung inkl. Besenrein') selected @endif>RFH-Reinigung inkl. Besenrein</option>
                <option data-selection="6" value="Baureinigung"
                @if($reinigung && $reinigung['reinigungType'] == 'Baureinigung') @endif>Baureinigung</option>
                <option data-selection="7" value="Baureinigung inkl. Abnahmegarantie"
                @if($reinigung && $reinigung['reinigungType'] == 'Baureinigung inkl. Abnahmegarantie') selected @endif>Baureinigung inkl. Abnahmegarantie</option>
                <option data-selection="8" value="Baureinigung inkl. Besenrein"
                @if($reinigung && $reinigung['reinigungType'] == 'Baureinigung inkl. Besenrein') selected @endif>Baureinigung inkl. Besenrein</option>
                <option data-selection="9" value="Unterhaltsreinigung"
                @if($reinigung && $reinigung['reinigungType'] == 'Unterhaltsreinigung') selected @endif>Unterhaltsreinigung</option>
                <option data-selection="10" value="Geschäftsreinigung"
                @if($reinigung && $reinigung['reinigungType'] == 'Geschäftsreinigung') selected @endif>Geschäftsreinigung</option>
                <option data-selection="11" value="Büroreinigung"
                @if($reinigung && $reinigung['reinigungType'] == 'Büroreinigung') selected @endif>Büroreinigung</option>
                <option data-selection="12" value="Lagerraum-Reinigung"
                @if($reinigung && $reinigung['reinigungType'] == 'Lagerraum-Reinigung') selected @endif>Lagerraum-Reinigung</option>
            </select>

            <div class="row reinigung-type-manuel-area" 
            @if($reinigung 
                && $reinigung['reinigungType'] == 'Wohnungsreinigung inkl. Abnahmegarantie'
                && $reinigung['reinigungType'] == 'Wohnungsreinigung inkl. Besenrein'
                && $reinigung['reinigungType'] == 'EFH-Reinigung inkl. Abnahmegarantie'
                && $reinigung['reinigungType'] == 'EFH-Reinigung inkl. Besenrein'
                && $reinigung['reinigungType'] == 'RFH-Reinigung inkl. Abnahmegarantie'
                && $reinigung['reinigungType'] == 'RFH-Reinigung inkl. Besenrein'
                && $reinigung['reinigungType'] == 'Baureinigung'
                && $reinigung['reinigungType'] == 'Baureinigung inkl. Abnahmegarantie'
                && $reinigung['reinigungType'] == 'Baureinigung inkl. Besenrein'
                && $reinigung['reinigungType'] == 'Unterhaltsreinigung'
                && $reinigung['reinigungType'] == 'Geschäftsreinigung'
                && $reinigung['reinigungType'] == 'Büroreinigung'
                && $reinigung['reinigungType'] == 'Lagerraum-Reinigung'
                )  
                style="display: block;"
                @else style="display: none;"
                @endif>
                <label class=" col-form-label" for="l0">manuelle Eingabe (Reinigungsart)</label>
                <input class="form-control reinigungTypeManuel"  name="reinigungTypeManuel"  type="text" 
                @if($reinigung 
                && $reinigung['reinigungType'] == 'Wohnungsreinigung inkl. Abnahmegarantie'
                && $reinigung['reinigungType'] == 'Wohnungsreinigung inkl. Besenrein'
                && $reinigung['reinigungType'] == 'EFH-Reinigung inkl. Abnahmegarantie'
                && $reinigung['reinigungType'] == 'EFH-Reinigung inkl. Besenrein'
                && $reinigung['reinigungType'] == 'RFH-Reinigung inkl. Abnahmegarantie'
                && $reinigung['reinigungType'] == 'RFH-Reinigung inkl. Besenrein'
                && $reinigung['reinigungType'] == 'Baureinigung'
                && $reinigung['reinigungType'] == 'Baureinigung inkl. Abnahmegarantie'
                && $reinigung['reinigungType'] == 'Baureinigung inkl. Besenrein'
                && $reinigung['reinigungType'] == 'Unterhaltsreinigung'
                && $reinigung['reinigungType'] == 'Geschäftsreinigung'
                && $reinigung['reinigungType'] == 'Büroreinigung'
                && $reinigung['reinigungType'] == 'Lagerraum-Reinigung'
                )  
                value="{{ $reinigung['reinigungType'] }}"
                @endif>
            </div>
            
            <div class="mb-3">
                <label class="col-form-label" for="l0">Optional: Leistungen (für Teilreinigung oder Baureinigungsleistungen)</label>
                <input class="form-control extraReinigung "  name="extraReinigung"  type="text" 
                @if ($reinigung && $reinigung['extraReinigung']) value="{{ $reinigung['extraReinigung'] }}" @endif>
            </div>

            <div class="row p-1 mt-5 mb-3 rounded" style="background-color: #8778AA;">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Zimmer  [3.5]</label>
                    <input class="form-control" class="reinigungFixedRoom"  name="reinigungFixedRoom"  type="text" value="0">
                </div>

                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Tarifpreis</label>
                    <input class="form-control" class="reinigungFixedPrice"  name="reinigungFixedPrice"  type="number" 
                    @if ($reinigung && $reinigung['reinigungFixedPrice']) value="{{ $reinigung['reinigungFixedPrice'] }}" @else value="0" @endif min="0">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Anzahl Std </label>
                    <input class="form-control" class="time"  name="reinigungHours"  type="number" 
                    @if ($reinigung && $reinigung['hours']) value="{{ $reinigung['hours'] }}" @else value="0" @endif> 
                </div>
    
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Ansatz  [CHF]</label>
                    <input class="form-control" class="date"  name="reinigungChf"  type="number" 
                    @if ($reinigung && $reinigung['chf']) value="{{ $reinigung['chf'] }}" @else value="0" @endif> 
                </div>
            </div>

            <div class="reinigung-extra-cost mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="isReinigungExtra" id="isReinigungExtra" class="js-switch " data-color="#9c27b0" data-switchery="false" 
                @if($reinigung
                && $reinigung['extra1'] == NULL
                && $reinigung['extra2'] == NULL
                && $reinigung['extra3'] == NULL
                && $reinigung['extraValue1'] == NULL
                && $reinigung['extraValue2'] == NULL
                ) 
                unchecked
                @else checked
                @endif>  
            </div>  

            <div class="reinigung-extra-cost-area" 
            @if($reinigung
            && $reinigung['extra1'] == NULL
            && $reinigung['extra2'] == NULL
            && $reinigung['extra3'] == NULL
            && $reinigung['extraValue1'] == NULL
            && $reinigung['extraValue2'] == NULL
            ) 
            style="display: none;"
            @endif>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="reinigungMasraf1" @if ($reinigung && $reinigung['extra1']) checked @endif> 
                                    <span class="label-text text-dark"><strong>Hochdruckreiniger</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="reinigungExtra1" type="number" 
                            @if ($reinigung && $reinigung['extra1']) value="{{ $reinigung['extra1'] }}" @else value="200" @endif>
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="reinigungMasraf2" @if ($reinigung && $reinigung['extra2']) checked @endif> 
                                    <span class="label-text text-dark"><strong>Stein- und Parkettböden</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="reinigungExtra2" type="number" 
                            @if ($reinigung && $reinigung['extra2']) value="{{ $reinigung['extra2'] }}" @else value="350" @endif>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="reinigungMasraf3" @if ($reinigung && $reinigung['extra3']) checked @endif> 
                                    <span class="label-text text-dark"><strong>Teppichschamponieren</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="reinigungExtra3" type="number" 
                            @if ($reinigung && $reinigung['extra3']) value="{{ $reinigung['extra3'] }}" @else value="200" @endif>
                        </div>
                    </div> 

                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="reinigungExtra1CostText" placeholder="Freier Text"  type="text" 
                            @if ($reinigung && $reinigung['extraCostValue1']) value="{{ $reinigung['extraCostText1'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="reinigungExtra1Cost" placeholder="0"  type="text" 
                            @if ($reinigung && $reinigung['extraCostValue1']) value="{{ $reinigung['extraCostValue1'] }}" @else value="0.00" @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="reinigungExtra2CostText" placeholder="Freier Text"  type="text" 
                            @if ($reinigung && $reinigung['extraCostValue2']) value="{{ $reinigung['extraCostText2'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="reinigungExtra2Cost" placeholder="0"  type="text" 
                            @if ($reinigung && $reinigung['extraCostValue2']) value="{{ $reinigung['extraCostValue2'] }}" @else value="0.00" @endif>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Rabatt</label>
            <input class="form-control"  name="reinigungDiscount" placeholder="0"  type="text" value="0.00"> 

            <label class="col-form-label" for="l0">Entgegenkommen</label>
            <input class="form-control"  name="reinigungDiscount2" placeholder="0"  type="text" value="0.00">

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0"> Weitere Abzüge</label>
                    <input class="form-control"  name="reinigungExtraDiscountText" placeholder="Freier Text"  type="text"
                    @if($reinigung && $reinigung['discount']) value="{{ $reinigung['discountText'] }}" @endif>
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0"> Weitere Abzüge</label>
                    <input class="form-control"  name="reinigungExtraDiscount" placeholder="0"  type="text" 
                    @if($reinigung && $reinigung['discount']) value="{{ $reinigung['discount'] }}" @else value="0.00" @endif>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-md-7">
                    <input class="form-control"  name="reinigungExtraDiscountText2" placeholder="Freier Text"  type="text">
                </div>
                <div class="col-md-5">
                    <input class="form-control"  name="reinigungExtraDiscount2" placeholder="0"  type="text" value="0.00">
                </div>
            </div>
            
            <label class="col-form-label mt-1 mb-2" for="l0">Preis</label>
            <input class="form-control" id="reinigungCost"  name="reinigungCost" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00"> 

            <label class="col-form-label mt-5" for="l0">Schadenzahlung</label>
            <input class="form-control"  name="reinigungPaid1" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">

            <label class="col-form-label" for="l0">Anzahlung</label>
            <input class="form-control"  name="reinigungPaid2" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">

            <label class="col-form-label" for="l0">Bar Bezahlt</label>
            <input class="form-control"  name="reinigungPaid3" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" value="0.00">

            <label class="col-form-label" for="l0">Betrag</label>
            <input class="form-control total-piece"  name="reinigungTotalPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;" 
            @if($reinigung && $reinigung['totalPrice']) value="{{ $reinigung['totalPrice'] }}" @else value="0.00" @endif>
        </div>
    </div>
</div>
@section('invoiceOfferFooterReinigung')

{{-- Tarife Fiyatları --}}
<script>
    $(document).ready(function (){
        let isFixedPrice = parseInt($('input[name=reinigungFixedPrice]').val());
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

    $("body").on("change",".reinigung--area", function() {
        let reinigungChf = parseInt($("input[name=reinigungChf]").val());
        let reinigungHours = parseInt($("input[name=reinigungHours]").val());
        let reinigungFixedPrice = parseInt($("input[name=reinigungFixedPrice]").val());

        let reinigungCost = 0;
        let reinigungTotalPrice = 0;

        
        if ($('input[name=reinigungMasraf1]').is(":checked")){
            var extra1 = parseInt($('input[name=reinigungExtra1]').val());               
            }
            else {
                extra1 = 0;
            }
            if ($('input[name=reinigungMasraf2]').is(":checked")){
               var extra2 = parseInt($('input[name=reinigungExtra2]').val());               
            }
            else {
                extra2 = 0;
            }
            if ($('input[name=reinigungMasraf3]').is(":checked")){
               var extra3 = parseInt($('input[name=reinigungExtra3]').val());               
            }
            else {
                extra3 = 0;
            }

            let reinigungExtra1Cost = parseFloat($('input[name=reinigungExtra1Cost]').val());               
            let reinigungExtra2Cost = parseFloat($('input[name=reinigungExtra2Cost]').val()); 
            let reinigungDiscount = parseFloat($('input[name=reinigungDiscount]').val());
            let reinigungDiscount2 = parseFloat($('input[name=reinigungDiscount2]').val());
            let reinigungExtraDiscount = parseFloat($('input[name=reinigungExtraDiscount]').val());
            let reinigungExtraDiscount2 = parseFloat($('input[name=reinigungExtraDiscount2]').val());

            reinigungTotalPrice = parseFloat($('input[name=reinigungTotalPrice]').val());

            let reinigungPaid1 = parseFloat($('input[name=reinigungPaid1]').val());
            let reinigungPaid2 = parseFloat($('input[name=reinigungPaid2]').val());
            let reinigungPaid3 = parseFloat($('input[name=reinigungPaid3]').val());

            if (reinigungFixedPrice == 0 || !reinigungFixedPrice){
                console.log('BURDA','fixed 0')
                reinigungCost = (reinigungHours*reinigungChf) + 
                (reinigungExtra1Cost+reinigungExtra2Cost+extra1+extra2+extra3)-
                reinigungDiscount-reinigungDiscount2-reinigungExtraDiscount-reinigungExtraDiscount2;
                reinigungCost = parseFloat(reinigungCost);
                $("input[name=reinigungCost]").val(reinigungCost.toFixed(2))
                
            }
            else{
                reinigungCost = parseFloat(reinigungFixedPrice);
                $("input[name=reinigungCost]").val(reinigungCost.toFixed(2))
            }

            reinigungTotalPrice = reinigungCost - reinigungPaid1 - reinigungPaid2 - reinigungPaid3;
            $("input[name=reinigungTotalPrice]").val(reinigungTotalPrice.toFixed(2));

    })
    
    
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