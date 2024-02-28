

<div class="rounded bg-service-primary">
    <div class=" row p-3"  > 
        {{-- Offerte Umzug Sol --}}
        <div class="col-md-6">
            <h5 class="font-weight-bold">Hauptadresse [Auszug/Reinigung/Beladeort]</h5>
            <label class=" col-form-label" for="l0">Strasse</label>
            <input class="form-control" name="ausStreet1"  type="text" @if ($auszug1) value="{{  \App\Models\offerteAddress::InfoAdress($auszug1,'street')  }}" @endif>
            <div class="row">
                <div class="col-md-5 ">
                    <label class=" col-form-label" for="l0">PLZ</label>
                    <input class="form-control" name="ausPostcode1"  type="text" @if ($auszug1) value="{{   \App\Models\offerteAddress::InfoAdress($auszug1,'postCode')  }}" @endif >
                </div> 
                <div class="col-md-7">
                    <label class=" col-form-label" for="l0">Ort</label>
                    <input class="form-control" name="ausCity1"  type="text" @if ($auszug1) value="{{ \App\Models\offerteAddress::InfoAdress($auszug1,'city')}}" @endif >
                </div>  
            </div> 
            
            <div class="row">
                <div class="col-md-12">
                    <label for="" class="col-form-label">Land</label><br>
                    <select class="form-control" name="ausCountry1" id="ausCountry1" required>
                        <option value="Schweiz" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'country') == 'Schweiz') selected @endif>Schweiz</option>
                        <option value="Fürstentum Liechtenstein" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'country') == 'Fürstentum Liechtenstein') selected @endif>Fürstentum Liechtenstein</option>
                        <option value="Deutschland" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'country') == 'Deutschland') selected @endif>Deutschland</option>
                        <option value="Österreich" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'country') == 'Österreich') selected @endif>Österreich</option>
                        <option value="Italien" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'country') == 'Italien') selected @endif>Italien</option>
                        <option value="Frankreich" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'country') == 'Frankreich') selected @endif>Frankreich</option>
                    </select> 

                    <div class="mt-1 isAusCustomLand1">
                        <label class="col-form-label" for="l0">Custom Land</label>
                        <input type="checkbox"  name="isAusCustomLand1" id="isAusCustomLand1" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" 
                        @if (
                            $auszug1 &&
                        \App\Models\offerteAddress::InfoAdress($auszug1,'country') != 'Schweiz' && 
                        \App\Models\offerteAddress::InfoAdress($auszug1,'country') != 'Fürstentum Liechtenstein' &&
                        \App\Models\offerteAddress::InfoAdress($auszug1,'country') != 'Deutschland' &&
                        \App\Models\offerteAddress::InfoAdress($auszug1,'country') != 'Österreich' &&
                        \App\Models\offerteAddress::InfoAdress($auszug1,'country') != 'Italien' &&
                        \App\Models\offerteAddress::InfoAdress($auszug1,'country') != 'Frankreich' 
                        )
                        checked
                        @else
                        unchecked
                        @endif
                        >
                    </div>
                    <div class="custom-aus-land-area-1" 
                    @if (
                         $auszug1 &&
                        \App\Models\offerteAddress::InfoAdress($auszug1,'country') != 'Schweiz' && 
                        \App\Models\offerteAddress::InfoAdress($auszug1,'country') != 'Fürstentum Liechtenstein' &&
                        \App\Models\offerteAddress::InfoAdress($auszug1,'country') != 'Deutschland' &&
                        \App\Models\offerteAddress::InfoAdress($auszug1,'country') != 'Österreich' &&
                        \App\Models\offerteAddress::InfoAdress($auszug1,'country') != 'Italien' &&
                        \App\Models\offerteAddress::InfoAdress($auszug1,'country') != 'Frankreich' 
                        )
                        style="display:block;"
                        @else
                        style="display:none;"
                        @endif
                    >
                        <input class="form-control" type="text" name="ausCustomLand1" @if($auszug1 && \App\Models\offerteAddress::InfoAdress($auszug1,'country')) value="{{  \App\Models\offerteAddress::InfoAdress($auszug1,'country') }}" @endif>
                    </div>
                </div> 
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <label for="" class="col-form-label">Gebäude</label><br>
                    <select class="form-control" name="ausBuildType1" id="ausBuildType" >
                        <option value=""@if (\App\Models\offerteAddress::InfoAdress($auszug1,'buildType') == NULL) selected @endif>Bitte wählen</option>
                        <option value="EFH" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'buildType') == 'EFH') selected @endif>EFH</option>
                        <option value="MFH" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'buildType') == 'MFH') selected @endif>MFH</option>
                        <option value="RFH" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'buildType') == 'RFH') selected @endif>RFH</option>
                        <option value="Geschäft/Büro" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'buildType') == 'Geschäft/Büro') selected @endif>Geschäft/Büro</option>
                        <option value="Lagerhaus" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'buildType') == 'Lagerhaus') selected @endif>Lagerhaus</option>
                    </select> 
                </div> 
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <label for="" class="col-form-label">Etage</label><br>
                    <select class="form-control" name="ausFloorType1" id="ausFloorType1" >
                        <option value=""@if (\App\Models\offerteAddress::InfoAdress($auszug1,'floor') == NULL) selected @endif>Bitte wählen</option>
                        <option value="1" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'floor') == '1') selected @endif>1</option>
                        <option value="2" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'floor') == '2') selected @endif>2</option>
                        <option value="3" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'floor') == '3') selected @endif>3</option>
                        <option value="4" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'floor') == '4') selected @endif>4</option>
                        <option value="5" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'floor') == '5') selected @endif>5</option>
                        <option value="6" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'floor') == '6') selected @endif>6</option>
                        <option value="7" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'floor') == '7') selected @endif>7</option>
                        <option value="8" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'floor') == '8') selected @endif>8</option>
                        <option value="9" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'floor') == '9') selected @endif>9</option>
                        <option value="10" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'floor') == '10') selected @endif>10</option>
                        <option value="10+" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'floor') == '10+') selected @endif>10+</option>
                        <option value="UG" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'floor') == 'UG') selected @endif>UG</option>
                        <option value="EG" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'floor') == 'EG') selected @endif>EG</option>
                        <option value="Hochparterre" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'floor') == 'Hochparterre') selected @endif>Hochparterre</option>
                    </select> 
                </div> 
            </div> 
            
            <div class=" row">
                <div class="col-md-12">
                    <label for="" class="col-form-label">Lift:</label>  
                    <div class="radiobox">                                                
                        <label class="text-dark">
                            <input type="radio" class="offerte-type"  name="isAusLift1" value="1"@if (\App\Models\offerteAddress::InfoAdress($auszug1,'lift') == 1) checked @endif > <span class="label-text">Ja</span>
                        </label>
                        <label class="text-dark ml-1">
                            <input type="radio"  class="offerte-type"  name="isAusLift1" value="0" @if (\App\Models\offerteAddress::InfoAdress($auszug1,'lift') == 0) checked @endif> <span class="label-text">Nein</span>
                        </label>
                    </div>                                        
                </div>                            
            </div>
    
            <div class="form-group row ">
                <div class="col-md-12 offer-auszug-2 ">
                    <label for="" class="col-form-label">2. Auszugsadresse</label><br>
                    <input type="checkbox" name="isofferAuszug2" id="isofferAuszug2" class="js-switch " data-color="#286090" data-switchery="false" @if($auszug2) checked @endif>  
                </div>                            
            </div>
        </div>
    
        <div class="col-md-6">
                <h5 class="font-weight-bold">Einzugsadresse / Entladeadresse</h5>
                <label class=" col-form-label" for="l0">Strasse</label>
                <input class="form-control" name="einStreet1"  type="text"  @if ($einzug1) value="{{   \App\Models\offerteAddress::InfoAdress($einzug1,'street')  }}" @endif >
                <div class="row">
                    <div class="col-md-5">
                        <label class=" col-form-label" for="l0">PLZ</label>
                        <input class="form-control" name="einPostcode1"  type="text"  @if ($einzug1) value="{{   \App\Models\offerteAddress::InfoAdress($einzug1,'postCode')  }}" @endif >
                    </div> 
                    <div class="col-md-7">
                        <label class=" col-form-label" for="l0">Ort</label>
                        <input class="form-control" name="einCity1"  type="text"  @if ($einzug1) value="{{   \App\Models\offerteAddress::InfoAdress($einzug1,'city')  }}" @endif>
                    </div>  
                </div> 
                
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Land</label><br>
                        <select class="form-control" name="einCountry1" id="einCountry1" >
                            <option value="Schweiz" @if ($einzug1  && \App\Models\offerteAddress::InfoAdress($einzug1,'country') == 'Schweiz') selected @endif>Schweiz</option>
                            <option value="Fürstentum Liechtenstein" @if ( $einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'country') == 'Fürstentum Liechtenstein') selected @endif>Fürstentum Liechtenstein</option>
                            <option value="Deutschland" @if ($einzug1  && \App\Models\offerteAddress::InfoAdress($einzug1,'country') == 'Deutschland') selected @endif>Deutschland</option>
                            <option value="Österreich" @if ( $einzug1  && \App\Models\offerteAddress::InfoAdress($einzug1,'country') == 'Österreich') selected @endif>Österreich</option>
                            <option value="Italien" @if ( $einzug1  && \App\Models\offerteAddress::InfoAdress($einzug1,'country') == 'Italien') selected @endif>Italien</option>
                            <option value="Frankreich" @if ( $einzug1  && \App\Models\offerteAddress::InfoAdress($einzug1,'country') == 'Frankreich') selected @endif>Frankreich</option>
                        </select> 

                        <div class="mt-1 isEinCustomLand1">
                            <label class="col-form-label" for="l0">Custom Land</label>
                            <input type="checkbox"  name="isEinCustomLand1" id="isEinCustomLand1" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" 
                            @if (
                                $einzug1 &&
                            \App\Models\offerteAddress::InfoAdress($einzug1,'country') != 'Schweiz' && 
                            \App\Models\offerteAddress::InfoAdress($einzug1,'country') != 'Fürstentum Liechtenstein' &&
                            \App\Models\offerteAddress::InfoAdress($einzug1,'country') != 'Deutschland' &&
                            \App\Models\offerteAddress::InfoAdress($einzug1,'country') != 'Österreich' &&
                            \App\Models\offerteAddress::InfoAdress($einzug1,'country') != 'Italien' &&
                            \App\Models\offerteAddress::InfoAdress($einzug1,'country') != 'Frankreich' 
                            )
                            checked
                            @else
                            unchecked
                            @endif
                            >
                        </div>
                        <div class="custom-ein-land-area-1" @if (
                        $einzug1 &&
                        \App\Models\offerteAddress::InfoAdress($einzug1,'country') != 'Schweiz' && 
                        \App\Models\offerteAddress::InfoAdress($einzug1,'country') != 'Fürstentum Liechtenstein' &&
                        \App\Models\offerteAddress::InfoAdress($einzug1,'country') != 'Deutschland' &&
                        \App\Models\offerteAddress::InfoAdress($einzug1,'country') != 'Österreich' &&
                        \App\Models\offerteAddress::InfoAdress($einzug1,'country') != 'Italien' &&
                        \App\Models\offerteAddress::InfoAdress($einzug1,'country') != 'Frankreich' 
                        )
                        style="display:block;"
                        @else
                        style="display:none;"
                        @endif >
                            <input class="form-control" type="text" name="einCustomLand1" @if($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'country')) value="{{  \App\Models\offerteAddress::InfoAdress($einzug1,'country') }}" @endif>
                        </div>
                    </div> 
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Gebäude</label><br>
                        <select class="form-control" name="einBuildType1" id="einBuildType1">
                            <option value=""@if ($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'buildType') == NULL) selected @endif>Bitte wählen</option>
                            <option value="EFH" @if ( $einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'buildType') == 'EFH') selected @endif>EFH</option>
                            <option value="MFH" @if ($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'buildType') == 'MFH') selected @endif>MFH</option>
                            <option value="RFH" @if ($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'buildType') == 'RFH') selected @endif>RFH</option>
                            <option value="Geschäft/Büro" @if ($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'buildType') == 'Geschäft/Büro') selected @endif>Geschäft/Büro</option>
                            <option value="Lagerhaus" @if ($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'buildType') == 'Lagerhaus') selected @endif>Lagerhaus</option>
                        </select> 
                    </div> 
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Etage</label><br>
                        <select class="form-control" name="einFloorType1" id="einFloorType1" >
                            <option value=""@if ($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'floor') == NULL) selected @endif>Bitte wählen</option>
                            <option value="1" @if ($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'floor') == '1') selected @endif>1</option>
                            <option value="2" @if ($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'floor') == '2') selected @endif>2</option>
                            <option value="3" @if ($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'floor') == '3') selected @endif>3</option>
                            <option value="4" @if ($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'floor') == '4') selected @endif>4</option>
                            <option value="5" @if ($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'floor') == '5') selected @endif>5</option>
                            <option value="6" @if ($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'floor') == '6') selected @endif>6</option>
                            <option value="7" @if ($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'floor') == '7') selected @endif>7</option>
                            <option value="8" @if ($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'floor') == '8') selected @endif>8</option>
                            <option value="9" @if ($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'floor') == '9') selected @endif>9</option>
                            <option value="10" @if ($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'floor') == '10') selected @endif>10</option>
                            <option value="10+" @if ($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'floor') == '10+') selected @endif>10+</option>
                            <option value="UG" @if ($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'floor') == 'UG') selected @endif>UG</option>
                            <option value="EG" @if ($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'floor') == 'EG') selected @endif>EG</option>
                            <option value="Hochparterre" @if ($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'floor') == 'Hochparterre') selected @endif>Hochparterre</option>
                        </select> 
                    </div> 
                </div> 
                
                <div class=" row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Lift:</label>  
                        <div class="radiobox">                                                
                            <label class="text-dark">
                                <input type="radio" class="offerte-lift2"  name="isEinLift1" value="1" @if ($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'lift') == 1) checked @endif> <span class="label-text">Ja</span>
                            </label>
                            <label class="text-dark ml-1">
                                <input type="radio"  class="offerte-lift2"  name="isEinLift1" value="0" @if ($einzug1 && \App\Models\offerteAddress::InfoAdress($einzug1,'lift') == 0) checked @elseif ($einzug1 == NULL) checked @endif > <span class="label-text">Nein</span>
                            </label>
                        </div>                                        
                    </div>                            
                </div>
    
                <div class="form-group row">
                    <div class="col-md-12 offer-einzug-2">
                        <label for="" class="col-form-label">2. Einzugsadresse</label><br>
                        <input type="checkbox" name="isofferEinzug2" id="isofferEinzug2" class="js-switch " data-color="#286090" data-switchery="false" @if($einzug2) checked @endif>  
                    </div>                            
                </div>
            </div>
        </div>
    
    
    
        {{-- 2.Kısım --}}
        <div class="form-group row mt-0 p-3 mb-0" > 
            {{-- Offerte Umzug2 Sol --}}
            <div class="col-md-6 aus-area-2" @if($auszug2 == NULL) style="display: none;" @endif >
                <h5 class="font-weight-bold">2. Auszugsadresse</h5>
                <label class=" col-form-label" for="l0">Strasse</label>
                <input class="form-control" name="ausStreet2"  type="text"  @if ($auszug2) value="{{  \App\Models\offerteAddress::InfoAdress($auszug2,'street')  }}" @endif>
                <div class="row">
                    <div class="col-md-5 ">
                        <label class=" col-form-label" for="l0">PLZ</label>
                        <input class="form-control" name="ausPostcode2"  type="text" @if ($auszug2) value="{{  \App\Models\offerteAddress::InfoAdress($auszug2,'postCode')  }}" @endif>
                    </div> 
                    <div class="col-md-7">
                        <label class=" col-form-label" for="l0">Ort</label>
                        <input class="form-control" name="ausCity2"  type="text" @if ($auszug2) value="{{  \App\Models\offerteAddress::InfoAdress($auszug2,'city')  }}" @endif>
                    </div>  
                </div> 
                
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Land</label><br>
                        <select class="form-control" name="ausCountry2" id="ausCountry2">
                            <option value="Schweiz" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'country') == 'Schweiz') selected @endif>Schweiz</option>
                            <option value="Fürstentum Liechtenstein" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'country') == 'Fürstentum Liechtenstein') selected @endif>Fürstentum Liechtenstein</option>
                            <option value="Deutschland" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'country') == 'Deutschland') selected @endif>Deutschland</option>
                            <option value="Österreich" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'country') == 'Österreich') selected @endif>Österreich</option>
                            <option value="Italien" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'country') == 'Italien') selected @endif>Italien</option>
                            <option value="Frankreich" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'country') == 'Frankreich') selected @endif>Frankreich</option>
                        </select> 

                        <div class="mt-1 isAusCustomLand2">
                            <label class="col-form-label" for="l0">Custom Land</label>
                            <input type="checkbox"  name="isAusCustomLand2" id="isAusCustomLand2" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false"
                            @if (
                                $auszug2 &&
                            \App\Models\offerteAddress::InfoAdress($auszug2,'country') != 'Schweiz' && 
                            \App\Models\offerteAddress::InfoAdress($auszug2,'country') != 'Fürstentum Liechtenstein' &&
                            \App\Models\offerteAddress::InfoAdress($auszug2,'country') != 'Deutschland' &&
                            \App\Models\offerteAddress::InfoAdress($auszug2,'country') != 'Österreich' &&
                            \App\Models\offerteAddress::InfoAdress($auszug2,'country') != 'Italien' &&
                            \App\Models\offerteAddress::InfoAdress($auszug2,'country') != 'Frankreich' 
                            )
                            checked
                            @else
                            unchecked
                            @endif >
                        </div>
                        <div class="custom-aus-land-area-2" 
                        @if (
                        $auszug2 &&
                        \App\Models\offerteAddress::InfoAdress($auszug2,'country') != 'Schweiz' && 
                        \App\Models\offerteAddress::InfoAdress($auszug2,'country') != 'Fürstentum Liechtenstein' &&
                        \App\Models\offerteAddress::InfoAdress($auszug2,'country') != 'Deutschland' &&
                        \App\Models\offerteAddress::InfoAdress($auszug2,'country') != 'Österreich' &&
                        \App\Models\offerteAddress::InfoAdress($auszug2,'country') != 'Italien' &&
                        \App\Models\offerteAddress::InfoAdress($auszug2,'country') != 'Frankreich' 
                        )
                        style="display:block;"
                        @else
                        style="display:none;"
                        @endif >
                            <input class="form-control" type="text" name="ausCustomLand2" @if($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'country')) value="{{  \App\Models\offerteAddress::InfoAdress($auszug2,'country') }}" @endif>
                        </div>
                    </div> 
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Gebäude</label><br>
                        <select class="form-control" name="ausBuildType2" id="ausBuildType2">
                            <option value=""@if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'buildType') == NULL) selected @endif>Bitte wählen</option>
                            <option value="EFH" @if ( $auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'buildType') == 'EFH') selected @endif>EFH</option>
                            <option value="MFH" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'buildType') == 'MFH') selected @endif>MFH</option>
                            <option value="RFH" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'buildType') == 'RFH') selected @endif>RFH</option>
                            <option value="Geschäft/Büro" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'buildType') == 'Geschäft/Büro') selected @endif>Geschäft/Büro</option>
                            <option value="Lagerhaus" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'buildType') == 'Lagerhaus') selected @endif>Lagerhaus</option>
                        </select> 
                    </div> 
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Etage</label><br>
                        <select class="form-control" name="ausFloorType2" id="ausFloorType2">
                            <option value=""@if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'floor') == NULL) selected @endif>Bitte wählen</option>
                            <option value="1" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'floor') == '1') selected @endif>1</option>
                            <option value="2" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'floor') == '2') selected @endif>2</option>
                            <option value="3" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'floor') == '3') selected @endif>3</option>
                            <option value="4" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'floor') == '4') selected @endif>4</option>
                            <option value="5" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'floor') == '5') selected @endif>5</option>
                            <option value="6" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'floor') == '6') selected @endif>6</option>
                            <option value="7" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'floor') == '7') selected @endif>7</option>
                            <option value="8" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'floor') == '8') selected @endif>8</option>
                            <option value="9" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'floor') == '9') selected @endif>9</option>
                            <option value="10" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'floor') == '10') selected @endif>10</option>
                            <option value="10+" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'floor') == '10+') selected @endif>10+</option>
                            <option value="UG" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'floor') == 'UG') selected @endif>UG</option>
                            <option value="EG" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'floor') == 'EG') selected @endif>EG</option>
                            <option value="Hochparterre" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'floor') == 'Hochparterre') selected @endif>Hochparterre</option>
                        </select> 
                    </div> 
                </div> 
                
                <div class=" row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Lift:</label>  
                        <div class="radiobox">                                                
                            <label class="text-dark">
                                <input type="radio" class="offerte-type"  name="isAusLift2" value="1" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'lift') == 1) checked @endif> <span class="label-text" >Ja</span>
                            </label>
                            <label class="text-dark ml-1">
                                <input type="radio"  class="offerte-type"  name="isAusLift2" value="0" @if ($auszug2 && \App\Models\offerteAddress::InfoAdress($auszug2,'lift') == 0) checked @elseif ($auszug2 == NULL) checked @endif> <span class="label-text">Nein</span>
                            </label>
                        </div>                                        
                    </div>                            
                </div>

                <div class="form-group row">
                    <div class="col-md-12 offer-auszug-3">
                        <label for="" class="col-form-label">3. Auszugsadresse</label><br>
                        <input type="checkbox" name="isofferAuszug3" id="isofferAuszug3" class="js-switch " data-color="#286090" data-switchery="false" @if($auszug3) checked @endif>  
                    </div>                            
                </div>
    
              
            </div>
        
            <div class="col-md-6 offset-md-6 ein-area-2 mt-0" @if($einzug2 == NULL) style="display: none;" @endif>
                    <h5 class="font-weight-bold">2. Einzugsadresse</h5>
                    <label class=" col-form-label" for="l0">Strasse</label>
                    <input class="form-control" name="einStreet2"  type="text"  @if ($einzug2) value="{{ \App\Models\offerteAddress::InfoAdress($einzug2,'street') }}"  @endif>
                    <div class="row">
                        <div class="col-md-5 p-0">
                            <label class=" col-form-label" for="l0">PLZ</label>
                            <input class="form-control" name="einPostcode2"  type="text"  @if ($einzug2) value="{{ \App\Models\offerteAddress::InfoAdress($einzug2,'postCode') }}"  @endif>
                        </div> 
                        <div class="col-md-7">
                            <label class=" col-form-label" for="l0">Ort</label>
                            <input class="form-control" name="einCity2"  type="text" @if ($einzug2) value="{{ \App\Models\offerteAddress::InfoAdress($einzug2,'city') }}"  @endif >
                        </div>  
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="col-form-label">Land</label><br>
                            <select class="form-control" name="einCountry2" id="einCountry2">
                                <option value="Schweiz" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'country') == 'Schweiz') selected @endif>Schweiz</option>
                                <option value="Fürstentum Liechtenstein" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'country') == 'Fürstentum Liechtenstein') selected @endif>Fürstentum Liechtenstein</option>
                                <option value="Deutschland" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'country') == 'Deutschland') selected @endif>Deutschland</option>
                                <option value="Österreich" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'country') == 'Österreich') selected @endif>Österreich</option>
                                <option value="Italien" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'country') == 'Italien') selected @endif>Italien</option>
                                <option value="Frankreich" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'country') == 'Frankreich') selected @endif>Frankreich</option>
                            </select> 

                            <div class="mt-1 isEinCustomLand2">
                                <label class="col-form-label" for="l0">Custom Land</label>
                                <input type="checkbox"  name="isEinCustomLand2" id="isEinCustomLand2" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" 
                                @if (
                                $einzug2 &&
                            \App\Models\offerteAddress::InfoAdress($einzug2,'country') != 'Schweiz' && 
                            \App\Models\offerteAddress::InfoAdress($einzug2,'country') != 'Fürstentum Liechtenstein' &&
                            \App\Models\offerteAddress::InfoAdress($einzug2,'country') != 'Deutschland' &&
                            \App\Models\offerteAddress::InfoAdress($einzug2,'country') != 'Österreich' &&
                            \App\Models\offerteAddress::InfoAdress($einzug2,'country') != 'Italien' &&
                            \App\Models\offerteAddress::InfoAdress($einzug2,'country') != 'Frankreich' 
                            )
                            checked
                            @else
                            unchecked
                            @endif>
                            </div>
                            <div class="custom-ein-land-area-2" 
                            @if (
                                $einzug2 &&
                                \App\Models\offerteAddress::InfoAdress($einzug2,'country') != 'Schweiz' && 
                                \App\Models\offerteAddress::InfoAdress($einzug2,'country') != 'Fürstentum Liechtenstein' &&
                                \App\Models\offerteAddress::InfoAdress($einzug2,'country') != 'Deutschland' &&
                                \App\Models\offerteAddress::InfoAdress($einzug2,'country') != 'Österreich' &&
                                \App\Models\offerteAddress::InfoAdress($einzug2,'country') != 'Italien' &&
                                \App\Models\offerteAddress::InfoAdress($einzug2,'country') != 'Frankreich' 
                                )
                                style="display:block;"
                                @else
                                style="display:none;"
                                @endif 
                            >
                                <input class="form-control" type="text" name="einCustomLand2" @if($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'country')) value="{{  \App\Models\offerteAddress::InfoAdress($einzug2,'country') }}" @endif>
                            </div>
                        </div> 
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="col-form-label">Gebäude</label><br>
                            <select class="form-control" name="einBuildType2" id="einBuildType2">
                                <option value=""@if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'buildType') == NULL) selected @endif>Bitte wählen</option>
                                <option value="EFH" @if ( $einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'buildType') == 'EFH') selected @endif>EFH</option>
                                <option value="MFH" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'buildType') == 'MFH') selected @endif>MFH</option>
                                <option value="RFH" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'buildType') == 'RFH') selected @endif>RFH</option>
                                <option value="Geschäft/Büro" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'buildType') == 'Geschäft/Büro') selected @endif>Geschäft/Büro</option>
                                <option value="Lagerhaus" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'buildType') == 'Lagerhaus') selected @endif>Lagerhaus</option>
                            </select> 
                        </div> 
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="col-form-label">Etage</label><br>
                            <select class="form-control" name="einFloorType2" id="einFloorType2">
                                <option value=""@if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'floor') == NULL) selected @endif>Bitte wählen</option>
                                <option value="1" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'floor') == '1') selected @endif>1</option>
                                <option value="2" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'floor') == '2') selected @endif>2</option>
                                <option value="3" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'floor') == '3') selected @endif>3</option>
                                <option value="4" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'floor') == '4') selected @endif>4</option>
                                <option value="5" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'floor') == '5') selected @endif>5</option>
                                <option value="6" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'floor') == '6') selected @endif>6</option>
                                <option value="7" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'floor') == '7') selected @endif>7</option>
                                <option value="8" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'floor') == '8') selected @endif>8</option>
                                <option value="9" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'floor') == '9') selected @endif>9</option>
                                <option value="10" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'floor') == '10') selected @endif>10</option>
                                <option value="10+" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'floor') == '10+') selected @endif>10+</option>
                                <option value="UG" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'floor') == 'UG') selected @endif>UG</option>
                                <option value="EG" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'floor') == 'EG') selected @endif>EG</option>
                                <option value="Hochparterre" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'floor') == 'Hochparterre') selected @endif>Hochparterre</option>
                            </select> 
                        </div> 
                    </div> 
                    
                    <div class=" row">
                        <div class="col-md-12">
                            <label for="" class="col-form-label">Lift:</label>  
                            <div class="radiobox">                                                
                                <label class="text-dark">
                                    <input type="radio" class="offerte-lift2"  name="isEinLift2" value="1" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'lift') == 1) checked @endif> <span class="label-text" >Ja</span>
                                </label>
                                <label class="text-dark ml-1">
                                    <input type="radio"  class="offerte-lift2"  name="isEinLift2" value="0" @if ($einzug2 && \App\Models\offerteAddress::InfoAdress($einzug2,'lift') == 0) checked @elseif ($einzug2 == NULL) checked @endif > <span class="label-text" >Nein</span>
                                </label>
                            </div>                                        
                        </div>                            
                    </div>    

                    <div class="form-group row">
                        <div class="col-md-12 offer-einzug-3">
                            <label for="" class="col-form-label">3. Einzugsadresse</label><br>
                            <input type="checkbox" name="isofferEinzug3" id="isofferEinzug3" class="js-switch " data-color="#286090" data-switchery="false" @if($einzug3) checked @endif>  
                        </div>                            
                    </div>
                </div>
        </div>

        {{-- 3.Kısım --}}
        <div class="form-group row mt-0 p-3 " > 
            {{-- Offerte Umzug3 Sol --}}
            <div class="col-md-6 aus-area-3" @if($auszug3 == NULL) style="display: none;" @endif>
                <h5 class="font-weight-bold">3. Auszugsadresse</h5>
                <label class=" col-form-label" for="l0">Strasse</label>
                <input class="form-control" name="ausStreet3"  type="text"  @if ($auszug3) value="{{ \App\Models\offerteAddress::InfoAdress($auszug3,'street') }}"  @endif>
                <div class="row">
                    <div class="col-md-5 ">
                        <label class=" col-form-label" for="l0">PLZ</label>
                        <input class="form-control" name="ausPostcode3"  type="text" @if ($auszug3) value="{{ \App\Models\offerteAddress::InfoAdress($auszug3,'postCode') }}"  @endif>
                    </div> 
                    <div class="col-md-7">
                        <label class=" col-form-label" for="l0">Ort</label>
                        <input class="form-control" name="ausCity3"  type="text" @if ($auszug3) value="{{ \App\Models\offerteAddress::InfoAdress($auszug3,'city') }}"  @endif>
                    </div>  
                </div> 
                
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Land</label><br>
                        <select class="form-control" name="ausCountry3" id="ausCountry3">
                            <option value="Schweiz" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'country') == 'Schweiz') selected @endif>Schweiz</option>
                            <option value="Fürstentum Liechtenstein" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'country') == 'Fürstentum Liechtenstein') selected @endif>Fürstentum Liechtenstein</option>
                            <option value="Deutschland" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'country') == 'Deutschland') selected @endif>Deutschland</option>
                            <option value="Österreich" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'country') == 'Österreich') selected @endif>Österreich</option>
                            <option value="Italien" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'country') == 'Italien') selected @endif>Italien</option>
                            <option value="Frankreich" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'country') == 'Frankreich') selected @endif>Frankreich</option>
                        </select> 

                        <div class="mt-1 isAusCustomLand3">
                            <label class="col-form-label" for="l0">Custom Land</label>
                            <input type="checkbox"  name="isAusCustomLand3" id="isAusCustomLand3" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" 
                            @if (
                                $auszug3 &&
                            \App\Models\offerteAddress::InfoAdress($auszug3,'country') != 'Schweiz' && 
                            \App\Models\offerteAddress::InfoAdress($auszug3,'country') != 'Fürstentum Liechtenstein' &&
                            \App\Models\offerteAddress::InfoAdress($auszug3,'country') != 'Deutschland' &&
                            \App\Models\offerteAddress::InfoAdress($auszug3,'country') != 'Österreich' &&
                            \App\Models\offerteAddress::InfoAdress($auszug3,'country') != 'Italien' &&
                            \App\Models\offerteAddress::InfoAdress($auszug3,'country') != 'Frankreich' 
                            )
                            checked
                            @else
                            unchecked
                            @endif>
                        </div>
                        <div class="custom-aus-land-area-3" 
                        @if (
                                $auszug3 &&
                                \App\Models\offerteAddress::InfoAdress($auszug3,'country') != 'Schweiz' && 
                                \App\Models\offerteAddress::InfoAdress($auszug3,'country') != 'Fürstentum Liechtenstein' &&
                                \App\Models\offerteAddress::InfoAdress($auszug3,'country') != 'Deutschland' &&
                                \App\Models\offerteAddress::InfoAdress($auszug3,'country') != 'Österreich' &&
                                \App\Models\offerteAddress::InfoAdress($auszug3,'country') != 'Italien' &&
                                \App\Models\offerteAddress::InfoAdress($auszug3,'country') != 'Frankreich' 
                                )
                                style="display:block;"
                                @else
                                style="display:none;"
                                @endif 
                        >
                            <input class="form-control" type="text" name="ausCustomLand3" @if($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'country')) value="{{  \App\Models\offerteAddress::InfoAdress($auszug3,'country') }}" @endif>
                        </div>
                    </div> 
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Gebäude</label><br>
                        <select class="form-control" name="ausBuildType3" id="ausBuildType3">
                            <option value=""@if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'buildType') == NULL) selected @endif>Bitte wählen</option>
                                <option value="EFH" @if ( $auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'buildType') == 'EFH') selected @endif>EFH</option>
                                <option value="MFH" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'buildType') == 'MFH') selected @endif>MFH</option>
                                <option value="RFH" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'buildType') == 'RFH') selected @endif>RFH</option>
                                <option value="Geschäft/Büro" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'buildType') == 'Geschäft/Büro') selected @endif>Geschäft/Büro</option>
                                <option value="Lagerhaus" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'buildType') == 'Lagerhaus') selected @endif>Lagerhaus</option>
                        </select> 
                    </div> 
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Etage</label><br>
                        <select class="form-control" name="ausFloorType3" id="ausFloorType3">
                            <option value=""@if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'floor') == NULL) selected @endif>Bitte wählen</option>
                                <option value="1" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'floor') == '1') selected @endif>1</option>
                                <option value="2" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'floor') == '2') selected @endif>2</option>
                                <option value="3" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'floor') == '3') selected @endif>3</option>
                                <option value="4" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'floor') == '4') selected @endif>4</option>
                                <option value="5" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'floor') == '5') selected @endif>5</option>
                                <option value="6" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'floor') == '6') selected @endif>6</option>
                                <option value="7" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'floor') == '7') selected @endif>7</option>
                                <option value="8" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'floor') == '8') selected @endif>8</option>
                                <option value="9" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'floor') == '9') selected @endif>9</option>
                                <option value="10" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'floor') == '10') selected @endif>10</option>
                                <option value="10+" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'floor') == '10+') selected @endif>10+</option>
                                <option value="UG" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'floor') == 'UG') selected @endif>UG</option>
                                <option value="EG" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'floor') == 'EG') selected @endif>EG</option>
                                <option value="Hochparterre" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'floor') == 'Hochparterre') selected @endif>Hochparterre</option>
                        </select> 
                    </div> 
                </div> 
                
                <div class=" row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Lift:</label>  
                        <div class="radiobox">                                                
                            <label class="text-dark">
                                <input type="radio" class="offerte-type"  name="isAusLift3" value="1" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'lift') == 1) checked @endif> <span class="label-text">Ja</span>
                            </label>
                            <label class="text-dark ml-1">
                                <input type="radio"  class="offerte-type"  name="isAusLift3" value="0" @if ($auszug3 && \App\Models\offerteAddress::InfoAdress($auszug3,'lift') == 0) checked @elseif ($auszug3 == NULL) checked @endif> <span class="label-text">Nein</span>
                            </label>
                        </div>                                        
                    </div>                            
                </div>
    
              
            </div>
        
            <div class="col-md-6 offset-md-6 ein-area-3" @if($einzug3 == NULL) style="display: none;" @endif>
                    <h5 class="font-weight-bold">3. Einzugsadresse</h5>
                    <label class=" col-form-label" for="l0">Strasse</label>
                    <input class="form-control" name="einStreet3"  type="text"  @if ($einzug3) value="{{ \App\Models\offerteAddress::InfoAdress($einzug3,'street') }}"  @endif>
                    <div class="row">
                        <div class="col-md-5 p-0">
                            <label class=" col-form-label" for="l0">PLZ</label>
                            <input class="form-control" name="einPostcode3"  type="text"  @if ($einzug3) value="{{ \App\Models\offerteAddress::InfoAdress($einzug3,'postCode') }}"  @endif>
                        </div> 
                        <div class="col-md-7">
                            <label class=" col-form-label" for="l0">Ort</label>
                            <input class="form-control" name="einCity3"  type="text"  @if ($einzug3) value="{{ \App\Models\offerteAddress::InfoAdress($einzug3,'city') }}"  @endif>
                        </div>  
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="col-form-label">Land</label><br>
                            <select class="form-control" name="einCountry3" id="einCountry3">
                                <option value="Schweiz" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'country') == 'Schweiz') selected @endif>Schweiz</option>
                                <option value="Fürstentum Liechtenstein" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'country') == 'Fürstentum Liechtenstein') selected @endif>Fürstentum Liechtenstein</option>
                                <option value="Deutschland" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'country') == 'Deutschland') selected @endif>Deutschland</option>
                                <option value="Österreich" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'country') == 'Österreich') selected @endif>Österreich</option>
                                <option value="Italien" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'country') == 'Italien') selected @endif>Italien</option>
                                <option value="Frankreich" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'country') == 'Frankreich') selected @endif>Frankreich</option>
                            </select> 

                            <div class="mt-1 isEinCustomLand3">
                                <label class="col-form-label" for="l0">Custom Land</label>
                                <input type="checkbox"  name="isEinCustomLand3" id="isEinCustomLand3" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" 
                                @if (
                                $einzug3 &&
                            \App\Models\offerteAddress::InfoAdress($einzug3,'country') != 'Schweiz' && 
                            \App\Models\offerteAddress::InfoAdress($einzug3,'country') != 'Fürstentum Liechtenstein' &&
                            \App\Models\offerteAddress::InfoAdress($einzug3,'country') != 'Deutschland' &&
                            \App\Models\offerteAddress::InfoAdress($einzug3,'country') != 'Österreich' &&
                            \App\Models\offerteAddress::InfoAdress($einzug3,'country') != 'Italien' &&
                            \App\Models\offerteAddress::InfoAdress($einzug3,'country') != 'Frankreich' 
                            )
                            checked
                            @else
                            unchecked
                            @endif>
                            </div>
                            <div class="custom-ein-land-area-3" 
                            @if (
                                $einzug3 &&
                                \App\Models\offerteAddress::InfoAdress($einzug3,'country') != 'Schweiz' && 
                                \App\Models\offerteAddress::InfoAdress($einzug3,'country') != 'Fürstentum Liechtenstein' &&
                                \App\Models\offerteAddress::InfoAdress($einzug3,'country') != 'Deutschland' &&
                                \App\Models\offerteAddress::InfoAdress($einzug3,'country') != 'Österreich' &&
                                \App\Models\offerteAddress::InfoAdress($einzug3,'country') != 'Italien' &&
                                \App\Models\offerteAddress::InfoAdress($einzug3,'country') != 'Frankreich' 
                                )
                                style="display:block;"
                                @else
                                style="display:none;"
                                @endif>
                                <input class="form-control" type="text" name="einCustomLand3" @if($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'country')) value="{{  \App\Models\offerteAddress::InfoAdress($einzug3,'country') }}" @endif>
                            </div>
                        </div> 
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="col-form-label">Gebäude</label><br>
                            <select class="form-control" name="einBuildType3" id="einBuildType3">
                                <option value="EFH" @if ( $einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'buildType') == 'EFH') selected @endif>EFH</option>
                                <option value="MFH" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'buildType') == 'MFH') selected @endif>MFH</option>
                                <option value="RFH" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'buildType') == 'RFH') selected @endif>RFH</option>
                                <option value="Geschäft/Büro" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'buildType') == 'Geschäft/Büro') selected @endif>Geschäft/Büro</option>
                                <option value="Lagerhaus" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'buildType') == 'Lagerhaus') selected @endif>Lagerhaus</option>
                            </select> 
                        </div> 
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="col-form-label">Etage</label><br>
                            <select class="form-control" name="einFloorType3" id="einFloorType3">
                                <option value="1" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'floor') == '1') selected @endif>1</option>
                                <option value="2" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'floor') == '2') selected @endif>2</option>
                                <option value="3" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'floor') == '3') selected @endif>3</option>
                                <option value="4" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'floor') == '4') selected @endif>4</option>
                                <option value="5" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'floor') == '5') selected @endif>5</option>
                                <option value="6" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'floor') == '6') selected @endif>6</option>
                                <option value="7" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'floor') == '7') selected @endif>7</option>
                                <option value="8" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'floor') == '8') selected @endif>8</option>
                                <option value="9" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'floor') == '9') selected @endif>9</option>
                                <option value="10" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'floor') == '10') selected @endif>10</option>
                                <option value="10+" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'floor') == '10+') selected @endif>10+</option>
                                <option value="UG" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'floor') == 'UG') selected @endif>UG</option>
                                <option value="EG" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'floor') == 'EG') selected @endif>EG</option>
                                <option value="Hochparterre" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'floor') == 'Hochparterre') selected @endif>Hochparterre</option>
                            </select> 
                        </div> 
                    </div> 
                    
                    <div class=" row">
                        <div class="col-md-12">
                            <label for="" class="col-form-label">Lift:</label>  
                            <div class="radiobox">                                                
                                <label class="text-dark">
                                    <input type="radio" class="offerte-lift3"  name="isEinLift3" value="1" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'lift') == 1) checked @endif> <span class="label-text">Ja</span>
                                </label>
                                <label class="text-dark ml-1">
                                    <input type="radio"  class="offerte-lift3"  name="isEinLift3" value="0" @if ($einzug3 && \App\Models\offerteAddress::InfoAdress($einzug3,'lift') == 0) checked @elseif ($einzug3 == NULL) checked @endif > <span class="label-text">Nein</span>
                                </label>
                            </div>                                        
                        </div>                            
                    </div> 
                </div>
        </div>
</div>











