<div class="form-group row">
    <div class="col-md-12 transport-control">
        <label for="" class="col-form-label">Transport</label><br>
        <input type="checkbox" name="isTransport" id="isTransport" class="js-switch " data-color="#9c27b0" data-switchery="false" @if ($transport) checked @endif>  
    </div>                            
</div>

<div class="rounded transport--area" style="background-color: #CBB4FF;
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
            
            <div class="row p-2 mt-1 rounded" style="background-color: #8778aa">
                <div class="col-md-12">
                    <label class="col-form-label" for="l0">Pauschalpreis-Tarif</label>
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

            <label class=" col-form-label" for="l0">Anfahrt/Rückfahrt [CHF]</label>
            <input class="form-control" class="date"  name="transportRoadChf"  type="number" 
            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'arrivalReturn') != NULL) 
                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'arrivalReturn') }}"
                @else value="{{ 0 }}"
            @endif> 

        </div>
        <div class="col-md-6">
            <div class="extra-cost-transport mt-1">
                <label for="" class="col-form-label">Zusatzkosten</label><br>
                <input type="checkbox" name="transportisExtra" id="transportisExtra" class="js-switch " data-color="#9c27b0" data-switchery="false" 
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
            <input class="form-control" id="transportCost"  name="transportCost" placeholder="0"  type="text" style="background-color: #8778aa;color:white;"
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
            <input class="form-control"  name="transportDefaultPrice" placeholder="0"  type="text" style="background-color: #8778aa;color:white;"
            @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'defaultPrice') != NULL) 
                value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'defaultPrice') }}"
                @else value="{{ 0 }}"
            @endif>

            <div class="mt-2 isTransportKostendach">
                <label class="col-form-label" for="l0">Kostendach</label>
                <input type="checkbox"  name="isTransportKostendach" id="isTransportKostendach" class="js-switch mt-1" data-color="#9c27b0" data-size="small" data-switchery="false" 
                @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'topCost')) checked @endif>
            </div>

            <div class="transport-kostendach-area" @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'topCost')) style="display: block;" @else style="display: none;" @endif >
                <input class="form-control"  name="transportTopPrice" placeholder="0"  type="number" style="background-color: #8778aa;color:white;"
                @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'topCost') != NULL) 
                    value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'topCost') }}"
                    @else value="{{ 0 }}"
                @endif>

                <div class="mt-2">
                    <small class=" text-primary">manuell gesetzt</small>
                    <input type="checkbox" name="isTransportMTPrice" id="isTransportMTPrice" class="js-switch mt-1" data-color="#9c27b0" data-size="small" data-switchery="false" >
                </div>
            </div>

            <div class="mt-3 isTransportPauschal">
                <label class="col-form-label" for="l0">Pauschal</label>
                <input type="checkbox"  name="isTransportPauschal" id="isTransportPauschal" class="js-switch mt-1" data-color="#9c27b0" data-size="small" data-switchery="false" 
                @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'fixedPrice')) checked @endif>
            </div>

            <div class="transport-pauschal-area " @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'fixedPrice')) style="display: block;" @else style="display: none;" @endif>
                <input class="form-control"  name="transportFixedPrice" placeholder="0"  type="number" style="background-color: #8778aa;color:white;"
                @if($transport && \App\Models\OfferteTransport::InfoTransport($transport,'fixedPrice') != NULL) 
                    value="{{ \App\Models\OfferteTransport::InfoTransport($transport,'fixedPrice') }}"
                    @else value="{{ 0 }}"
                @endif>

                <div class="mt-2">
                    <small class=" text-primary">manuell gesetzt</small>
                    <input type="checkbox" name="isTransportFxPrice" id="isTransportFxPrice" class="js-switch mt-1" data-color="#9c27b0" data-size="small" data-switchery="false" >
                </div>
            </div>
        </div>
    </div>
</div>
@section('offerFooterTransport')

{{-- Tarife Fiyatları --}}
<script>        
    var morebutton8 = $("div.transport-control");
     morebutton8.click(function(){
         if($(this).hasClass("checkbox-checked"))
         {
            $(".transport--area").show(700);
            $("input[name=transportFixedTariff]").prop('required',true);      
            $("select[name=transportTariff]").prop('required',true); 
            $("input[name=transporthour]").prop('required',true); 
            $("input[name=transportma]").prop('required',true); 
            $("input[name=transportlkw]").prop('required',true); 
            $("input[name=transportanhanger]").prop('required',true); 
            $("input[name=transportchf]").prop('required',true);  
         }
         else{
            $(".transport--area").hide(500);
            $("input[name=transportFixedTariff]").prop('required',false);      
            $("select[name=transportTariff]").prop('required',false); 
            $("input[name=transporthour]").prop('required',false); 
            $("input[name=transportma]").prop('required',false); 
            $("input[name=transportlkw]").prop('required',false); 
            $("input[name=transportanhanger]").prop('required',false); 
            $("input[name=transportchf]").prop('required',false); 
         }
     })

    var isTransportKostendachButton = $("div.isTransportKostendach");
    var isTransportPauschalbutton = $("div.isTransportPauschal");
    isTransportKostendachButton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".transport-kostendach-area").show(700);
        }
        else{
            $(".transport-kostendach-area").hide(500);
        }
    })

    isTransportPauschalbutton.click(function(){
        if($(this).hasClass("checkbox-checked"))
        {
            $(".transport-pauschal-area").show(700);
        }
        else{
            $(".transport-pauschal-area").hide(500);
        }
    })
 
     $("select[name=transportTariff]").on("change",function () {
         let chf = $(this).find(":selected").data("chf");
         let ma = $(this).find(":selected").data("ma");
         let lkw = $(this).find(":selected").data("lkw");
         let anhanger = $(this).find(":selected").data("an");
         let control = $(this).find(":selected").data('selection');
 
         if (control != 'bos')
         {
         $('.transport-tariffs--area').show(300)
         $("input[name=transportFixedTariff]").prop("required",false);
         }
         else{
             $('input[name=transportchf]').val(0);
             $('input[name=transportma]').val(0);
             $('input[name=transportlkw]').val(0);
             $('input[name=transportanhanger]').val(0);
             $('.transport-tariffs--area').hide(300)
         }
 
         $('input[name=transportchf]').val(chf);
         $('input[name=transportma]').val(ma);
         $('input[name=transportlkw]').val(lkw);
         $('input[name=transportanhanger]').val(anhanger);
     })
     $("input[name=transportFixedTariff]").on("change",function (){
         if($("input[name=transportFixedTariff]").val())
         {
            $("select[name=transportTariff]").prop('required',false); 
            $("input[name=transportma]").prop('required',false); 
            $("input[name=transportlkw]").prop('required',false); 
            $("input[name=transportanhanger]").prop('required',false); 
            $("input[name=transportchf]").prop('required',false);  
         }
     })
 
 </script>
 
 {{-- İlave ücret Aç/kapa --}}
 <script>
     var extracostbutton = $("div.extra-cost-transport");
     extracostbutton.click(function(){
         if($(this).hasClass("checkbox-checked"))
         {
             $(".transport--extra--cost--area").show(700);
         }
         else{
             $(".transport--extra--cost--area").hide(500);
         }
     })

    
 </script>
 
 <script>
     $(document).ready(function(){
         transportCost = 0;
         var transportTopPrice = 0;
         var transportDefaultPrice = 0;
         $("body").on("change",".transport--area",function(){      
             var roadchf = parseFloat($('input[name=transportRoadChf]').val());
             var chf = parseFloat($('input[name=transportchf]').val());
             var Hours = $('input[name=transporthour]').val();
             let allHours = Hours.split("-");
             let leftHour = parseFloat(allHours[0]);
             let rightHour = parseFloat(allHours[1]);
 
             var transportFixedTariff = $('input[name=transportFixedTariff]').val();
             var extra1 = parseFloat($('input[name=transportCost1]').val())
             var extra2 = parseFloat($('input[name=transportCost2]').val())
             var extra3 = parseFloat($('input[name=transportCost3]').val())
             var extra4 = parseFloat($('input[name=transportCost4]').val())
             var extra5 = parseFloat($('input[name=transportCost5]').val())
             var extra6 = parseFloat($('input[name=transportCost6]').val())
             var extra7 = parseFloat($('input[name=transportCost7]').val())
 
             transportCostLeft = chf * leftHour + roadchf + extra1 + extra2 + extra3 + extra4 + extra5 + extra6 + extra7;
             transportCostRight = chf * rightHour + roadchf + extra1 + extra2 + extra3 + extra4 + extra5 + extra6 + extra7;
 
             if(transportFixedTariff == 0)
             {
                 if(rightHour){
                 $('input[name=transportCost]').val(transportCostRight)
                 }
                 if(leftHour){
                     $('input[name=transportCost]').val(transportCostLeft)
                 }
                 if(leftHour && rightHour ){
                     $('input[name=transportCost]').val(transportCostLeft+'-'+transportCostRight) 
                 }
                 if(leftHour == null && rightHour == null)
                 {
                     $('input[name=transportCost]').val('')
                 }
             }
             else {
                 $('input[name=transportCost]').val(transportFixedTariff)
             }
            console.log(leftHour,rightHour,roadchf,chf,extra1,extra2,extra3,extra4,extra5,extra6,extra7)
         })  
         $("body").on("change",".transport--area",function(){
             var transportFixedTariff = $('input[name=transportFixedTariff]').val();
             var discount = $('input[name=transportDiscount]').val();
             var discountPercent = $('input[name=transportDiscountPercent]').val();
             var compromiser = $('input[name=transportCompromiser]').val();
             var extraDiscount = $('input[name=transportExtraDiscount]').val();
             var extraDiscount2 = $('input[name=transportExtraDiscount2]').val();
             var Hours = $('input[name=transporthour]').val();
             let allHours = Hours.split("-");
             let leftHour = parseFloat(allHours[0]);
             let rightHour = parseFloat(allHours[1]);
 
             transportDefaultPriceLeft = transportCostLeft - discount - (transportCostLeft*discountPercent/100) - compromiser - extraDiscount - extraDiscount2;
             transportDefaultPriceRight = transportCostRight - discount - (transportCostLeft*discountPercent/100) - compromiser - extraDiscount - extraDiscount2;
 
             if(transportFixedTariff == 0)
             {
                 if(rightHour){
                 $('input[name=transportDefaultPrice]').val(transportDefaultPriceRight)
                 }
                 if(leftHour){
                     $('input[name=transportDefaultPrice]').val(transportDefaultPriceLeft)
                 }
                 if(leftHour && rightHour ){
                     $('input[name=transportDefaultPrice]').val(transportDefaultPriceLeft+'-'+transportDefaultPriceRight) 
                 }
                 if(leftHour == null && rightHour == null)
                 {
                     $('input[name=transportDefaultPrice]').val('')
                 }
             }
             else{
                 $('input[name=transportDefaultPrice]').val(transportFixedTariff);
             }
             
         })
         $("body").on("change",".transport--area",function(){
             var chf = $('input[name=transportchf]').val();
             var Hours = $('input[name=transporthour]').val();
 
             let transportTotalPrices = $('input[name=transportDefaultPrice]').val();
             transportTotalPricesARR = transportTotalPrices.split("-");
             let transportTotalPrice = 0;
             
             leftTotal = parseFloat(transportTotalPricesARR[0]);
             rightTotal = parseFloat(transportTotalPricesARR[1]);
             if(leftTotal >= rightTotal)
             {
                 transportTotalPrice = leftTotal;
             }
             else if(rightTotal >= leftTotal)
             {
                 transportTotalPrice = rightTotal;
             }
             else{
                 transportTotalPrice = parseFloat($('input[name=transportDefaultPrice]').val());
             }
             if($('input[name=isTransportMTPrice]').is(":checked"))
             {
                 $('input[name=transportTopPrice]').val();
             }
             else{
                 transportTopPrice = transportTotalPrice + parseFloat(chf);
                 $('input[name=transportTopPrice]').val(transportTopPrice);
             }
 
             if($('input[name=isTransportFxPrice]').is(":checked"))
            {
                $('input[name=transportFixedPrice]').val();
            }
            else{
                transportFixedPrice = transportTotalPrice + parseFloat(chf);
                $('input[name=transportFixedPrice]').val(transportFixedPrice);
            }
         })  
     })
 </script>
@endsection