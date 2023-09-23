<div class="form-group row">
    <div class="col-md-12 reinigung2-control">
        <label for="" class="col-form-label">Reinigung 2</label><br>
        <input type="checkbox" name="isReinigung" id="isReinigung" class="js-switch " data-color="#286090" data-switchery="false" @if($reinigung2) checked @endif>  
    </div>                            
</div>

<div class="rounded reinigung2--area" style="background-color: #C8DFF3; @if($reinigung2 == NULL) display:none; @endif">
    <div class="row p-3">
        <div class="col-md-6">
            <label class=" col-form-label" for="l0">Datum</label>
            <input class="form-control" class="date"  name="reinigung2Date"  type="date" 
            @if($reinigung2) value="{{ $reinigung2['reinigungDate'] }}" @endif> 

            <label class=" col-form-label" for="l0">Reinigungsart</label>
            <select class="form-control reinigung2Type" name="reinigung2Type" id="reinigung2Type" >
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

            <div class="row reinigung2-type-manuel-area" 
            @if($reinigung2 
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
                <input class="form-control reinigung2TypeManuel"  name="reinigung2TypeManuel"  type="text" 
                @if($reinigung2 
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
                value="{{ $reinigung2['reinigungType'] }}"
                @endif>
            </div>
            
            <div class="mb-3">
                <label class="col-form-label" for="l0">Optional: Leistungen (für Teilreinigung oder Baureinigungsleistungen)</label>
                <input class="form-control extraReinigung "  name="extraReinigung"  type="text" 
                @if ($reinigung2 && $reinigung2['extraReinigung']) value="{{ $reinigung2['extraReinigung'] }}" @endif>
            </div>

            <div class="row p-1 mt-5 mb-3 rounded" style="background-color: #286090;">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Zimmer  [3.5]</label>
                    <input class="form-control" class="reinigung2FixedRoom"  name="reinigung2FixedRoom"  type="text" 
                    @if ($reinigung2 && $reinigung2['reinigungRoom']) value="{{ $reinigung2['reinigungRoom'] }}" @endif>
                </div>

                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Tarifpreis</label>
                    <input class="form-control" class="reinigung2FixedPrice"  name="reinigung2FixedPrice"  type="number" 
                    @if ($reinigung2 && $reinigung2['reinigungFixedPrice']) value="{{ $reinigung2['reinigungFixedPrice'] }}" @else value="0" @endif min="0">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Anzahl Std</label>
                    <input class="form-control" class="time"  name="reinigung2Hours"  type="number" 
                    @if ($reinigung2 && $reinigung2['reinigungHours']) value="{{ $reinigung2['reinigungHours'] }}" @else value="0" @endif> 
                </div>
    
                <div class="col-md-6">
                    <label class=" col-form-label" for="l0">Ansatz  [CHF]</label>
                    <input class="form-control" class="date"  name="reinigung2Chf"  type="number" 
                    @if ($reinigung2 && $reinigung2['reinigungChf']) value="{{ $reinigung2['reinigungChf'] }}" @else value="0" @endif> 
                </div>
            </div>

            <div class="reinigung2-extra-cost mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="isReinigungExtra" id="isReinigungExtra" class="js-switch " data-color="#286090" data-switchery="false" 
                @if($reinigung2
                && $reinigung2['extra1'] == NULL
                && $reinigung2['extra2'] == NULL
                && $reinigung2['extra3'] == NULL
                && $reinigung2['extraValue1'] == NULL
                && $reinigung2['extraValue2'] == NULL
                ) 
                unchecked
                @else checked
                @endif>  
            </div>  

            <div class="reinigung2-extra-cost-area" 
            @if($reinigung2
            && $reinigung2['extra1'] == NULL
            && $reinigung2['extra2'] == NULL
            && $reinigung2['extra3'] == NULL
            && $reinigung2['extraValue1'] == NULL
            && $reinigung2['extraValue2'] == NULL
            ) 
            style="display: none;"
            @endif>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="reinigung2Masraf1" @if ($reinigung2 && $reinigung2['extra1']) checked @endif> 
                                    <span class="label-text text-dark"><strong>Hochdruckreiniger</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="reinigung2Extra1" type="number" 
                            @if ($reinigung2 && $reinigung2['extra1']) value="{{ $reinigung2['extra1'] }}" @else value="200" @endif>
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="reinigung2Masraf2" @if ($reinigung2 && $reinigung2['extra2']) checked @endif> 
                                    <span class="label-text text-dark"><strong>Stein- und Parkettböden</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="reinigung2Extra2" type="number" 
                            @if ($reinigung2 && $reinigung2['extra2']) value="{{ $reinigung2['extra2'] }}" @else value="350" @endif>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-7">
                            <div class="checkbox checkbox-rounded checkbox-color-scheme">
                                <label class="checkbox">
                                    <input type="checkbox" name="reinigung2Masraf3" @if ($reinigung2 && $reinigung2['extra3']) checked @endif> 
                                    <span class="label-text text-dark"><strong>Teppichschamponieren</strong></span>                       
                                </label>                   
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" name="reinigung2Extra3" type="number" 
                            @if ($reinigung2 && $reinigung2['extra3']) value="{{ $reinigung2['extra3'] }}" @else value="200" @endif>
                        </div>
                    </div> 

                    <div class="row ">
                        <div class="col-md-7">
                            <input class="form-control"  name="reinigung2Extra1CostText" placeholder="Freier Text"  type="text" 
                            @if ($reinigung2 && $reinigung2['extraValue1']) value="{{ $reinigung2['extraText1'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="reinigung2Extra1Cost" placeholder="0"  type="text" 
                            @if ($reinigung2 && $reinigung2['extraValue1']) value="{{ $reinigung2['extraValue1'] }}" @else value="0.00" @endif>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <input class="form-control"  name="reinigung2Extra2CostText" placeholder="Freier Text"  type="text" 
                            @if ($reinigung2 && $reinigung2['extraValue2']) value="{{ $reinigung2['extraText2'] }}" @endif>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control"  name="reinigung2Extra2Cost" placeholder="0"  type="text" 
                            @if ($reinigung2 && $reinigung2['extraValue2']) value="{{ $reinigung2['extraValue2'] }}" @else value="0.00" @endif>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Rabatt</label>
            <input class="form-control"  name="reinigung2Discount" placeholder="0"  type="text" 
            @if($reinigung2 && $reinigung2['discount']) value="{{ $reinigung2['discount'] }}" @else value="0.00" @endif> 

            <label class="col-form-label" for="l0">Rabatt[%]</label>
            <input class="form-control"  name="reinigung2DiscountPercent" placeholder="0"  type="text" 
            @if($reinigung2 && $reinigung2['discountPercent']) value="{{ $reinigung2['discountPercent'] }}" @else value="0.00" @endif> 

            <label class="col-form-label" for="l0">Entgegenkommen</label>
            <input class="form-control"  name="reinigung2Discount2" placeholder="0"  type="text" 
            @if($reinigung2 && $reinigung2['discount2']) value="{{ $reinigung2['discount2'] }}" @else value="0.00" @endif>

            <div class="row ">
                <div class="col-md-7">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="reinigung2ExtraDiscountText" placeholder="Freier Text"  type="text"
                    @if($reinigung2 && $reinigung2['extraDiscountValue1']) value="{{ $reinigung2['extraDiscountText1'] }}" @endif>
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" for="l0">Weitere Abzüge</label>
                    <input class="form-control"  name="reinigung2ExtraDiscount" placeholder="0"  type="text" 
                    @if($reinigung2 && $reinigung2['extraDiscountValue1']) value="{{ $reinigung2['extraDiscountValue1'] }}" @else value="0.00" @endif>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-md-7">
                    <input class="form-control"  name="reinigung2ExtraDiscountText2" placeholder="Freier Text"  type="text" 
                    @if($reinigung2 && $reinigung2['extraDiscountValue2']) value="{{ $reinigung2['extraDiscountText2'] }}" @endif>
                </div>
                <div class="col-md-5">
                    <input class="form-control"  name="reinigung2ExtraDiscount2" placeholder="0"  type="text"  
                    @if($reinigung2 && $reinigung2['extraDiscountValue2']) value="{{ $reinigung2['extraDiscountValue2'] }}" @else value="0.00" @endif>
                </div>
            </div>
            
            <label class="col-form-label mt-1 mb-2" for="l0">Preis</label>
            <input class="form-control" id="reinigung2Cost"  name="reinigung2Cost" placeholder="0"  type="text" style="background-color: #286090;color:white;" 
            @if($reinigung2 && $reinigung2['reinigungCost']) value="{{ $reinigung2['reinigungCost'] }}" @else value="0.00" @endif> 

            <label class="col-form-label mt-5" for="l0">Schadenzahlung</label>
            <input class="form-control"  name="reinigung2Paid1" placeholder="0"  type="text" style="background-color: #286090;color:white;" 
            @if($reinigung2 && $reinigung2['reinigungPaid1']) value="{{ $reinigung2['reinigungPaid1'] }}" @else value="0.00" @endif>

            <label class="col-form-label" for="l0">Anzahlung</label>
            <input class="form-control"  name="reinigung2Paid2" placeholder="0"  type="text" style="background-color: #286090;color:white;" 
            @if($reinigung2 && $reinigung2['reinigungPaid2']) value="{{ $reinigung2['reinigungPaid2'] }}" @else value="0.00" @endif>

            <label class="col-form-label" for="l0">Bar Bezahlt</label>
            <input class="form-control"  name="reinigung2Paid3" placeholder="0"  type="text" style="background-color: #286090;color:white;" 
            @if($reinigung2 && $reinigung2['reinigungPaid3']) value="{{ $reinigung2['reinigungPaid3'] }}" @else value="0.00" @endif>

            <label class="col-form-label" for="l0">Betrag</label>
            <input class="form-control total-piece"  name="reinigung2TotalPrice" placeholder="0"  type="text" style="background-color: #286090;color:white;" 
            @if($reinigung2 && $reinigung2['reinigungTotalPrice']) value="{{ $reinigung2['reinigungTotalPrice'] }}" @else value="0.00" @endif>
        </div>
    </div>
</div>
@section('invoiceEditFooterReinigung')

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