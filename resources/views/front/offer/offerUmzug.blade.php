

<div class="rounded bg-service-primary" >
    <div class=" row p-3"  > 
        {{-- Offerte Umzug Sol --}}
        <div class="col-md-6">
            <h5 class="font-weight-bold">Hauptadresse [Auszug/Reinigung/Beladeort]</h5>
            <label class=" col-form-label" for="l0">Strasse</label>
            <input class="form-control" name="ausStreet1"  type="text"  value="{{   $data['street']  }} " >
            <div class="row">
                <div class="col-md-5 ">
                    <label class=" col-form-label" for="l0">PLZ</label>
                    <input class="form-control" name="ausPostcode1"  type="text" value="{{   $data['postCode']  }} " >
                </div> 
                <div class="col-md-7">
                    <label class=" col-form-label" for="l0">Ort</label>
                    <input class="form-control" name="ausCity1"  type="text" value="{{   $data['Ort']  }} " >
                </div>  
            </div> 
            
            <div class="row">
                <div class="col-md-12">
                    <label for="" class="col-form-label">Land</label><br>
                    <select class="form-control" name="ausCountry1" id="ausCountry1" required>
                        <option value="Schweiz">Schweiz</option>
                        <option value="Fürstentum Liechtenstein">Fürstentum Liechtenstein</option>
                        <option value="Deutschland">Deutschland</option>
                        <option value="Österreich">Österreich</option>
                        <option value="Italien">Italien</option>
                        <option value="Frankreich">Frankreich</option>
                    </select>

                    <div class="mt-1 isAusCustomLand1">
                        <label class="col-form-label" for="l0">Custom Land</label>
                        <input type="checkbox"  name="isAusCustomLand1" id="isAusCustomLand1" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
                    </div>
                    <div class="custom-aus-land-area-1" style="display:none;">
                        <input class="form-control" type="text" name="ausCustomLand1">
                    </div>

                </div> 
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <label for="" class="col-form-label">Gebäude</label><br>
                    <select class="form-control" name="ausBuildType1" id="ausBuildType" >
                        <option value="">Bitte wählen</option>
                        <option value="EFH">EFH</option>
                        <option value="MFH">MFH</option>
                        <option value="RFH">RFH</option>
                        <option value="Geschäft/Büro">Geschäft/Büro</option>
                        <option value="Lagerhaus">Lagerhaus</option>
                    </select> 
                </div> 
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <label for="" class="col-form-label">Etage</label><br>
                    <select class="form-control" name="ausFloorType1" id="ausFloorType1" >
                        <option value="">Bitte wählen</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="10+">10+</option>
                        <option value="UG">UG</option>
                        <option value="EG">EG</option>
                        <option value="Hochparterre">Hochparterre</option>
                    </select> 
                </div> 
            </div> 
            
            <div class=" row">
                <div class="col-md-12">
                    <label for="" class="col-form-label">Lift:</label>  
                    <div class="radiobox">                                                
                        <label class="text-dark">
                            <input type="radio" class="offerte-type"  name="isAusLift1" value="1" > <span class="label-text">Ja</span>
                        </label>
                        <label class="text-dark ml-1">
                            <input type="radio"  class="offerte-type"  name="isAusLift1" value="0" checked> <span class="label-text">Nein</span>
                        </label>
                    </div>                                        
                </div>                            
            </div>
    
            <div class="form-group row">
                <div class="col-md-12 offer-auszug-2">
                    <label for="" class="col-form-label">2. Auszugsadresse</label><br>
                    <input type="checkbox" name="isofferAuszug2" id="isofferAuszug2" class="js-switch " data-color="#286090" data-switchery="false" >  
                </div>                            
            </div>
        </div>
    
        <div class="col-md-6">
                <h5 class="font-weight-bold">Einzugsadresse / Entladeadresse</h5>
                <label class=" col-form-label" for="l0">Strasse </label>
                <input class="form-control" name="einStreet1"  type="text"  @if($formData && $formData['nachStreet']) value="{{ $formData['nachStreet'] }}" @endif>
                <div class="row">

                    @php
                        
                            if($formData && $formData['nachPlz'])
                            {
                                $fullPlz = $formData['nachPlz'];
                                $wordCount = str_word_count($fullPlz);
                                $lastSpaceIndex = strrpos($fullPlz, ' ');

                                $plz = '';
                                $ort = '';

                                // Eğer boşluk varsa ayrıştırma işlemini gerçekleştir
                                if ($lastSpaceIndex !== false) {
                                    $plz = substr($fullPlz, 0, $lastSpaceIndex);
                                    $ort = substr($fullPlz, $lastSpaceIndex + 1);
                                } else {
                                    // Boşluk yoksa direkt olarak $data['vonPlz'] yi plz'ye atayın
                                    $plz = $fullPlz;
                                }
                            }
                            else {
                                $plz = '';
                                $ort = '';
                            }
                        
                    @endphp

                    <div class="col-md-5">
                        <label class=" col-form-label" for="l0">PLZ</label>
                        <input class="form-control" name="einPostcode1"  type="text"  value="{{ $plz }}">
                    </div> 
                    <div class="col-md-7">
                        <label class=" col-form-label" for="l0">Ort</label>
                        <input class="form-control" name="einCity1"  type="text"  value="{{ $ort }}">
                    </div>  
                </div> 
                
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Land</label><br>
                        <select class="form-control" name="einCountry1" id="einCountry1" >
                            <option value="Schweiz">Schweiz</option>
                            <option value="Fürstentum Liechtenstein">Fürstentum Liechtenstein</option>
                            <option value="Deutschland">Deutschland</option>
                            <option value="Österreich">Österreich</option>
                            <option value="Italien">Italien</option>
                            <option value="Frankreich">Frankreich</option>
                        </select> 

                        <div class="mt-1 isEinCustomLand1">
                            <label class="col-form-label" for="l0">Custom Land</label>
                            <input type="checkbox"  name="isEinCustomLand1" id="isEinCustomLand1" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
                        </div>
                        <div class="custom-ein-land-area-1" style="display:none;">
                            <input class="form-control" type="text" name="einCustomLand1">
                        </div>
                    </div> 
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Gebäude</label><br>
                        <select class="form-control" name="einBuildType1" id="einBuildType1"  >
                            <option value="">Bitte wählen</option>
                            <option value="EFH">EFH</option>
                            <option value="MFH">MFH</option>
                            <option value="RFH">RFH</option>
                            <option value="Geschäft/Büro">Geschäft/Büro</option>
                            <option value="Lagerhaus">Lagerhaus</option>
                        </select> 
                    </div> 
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Etage</label><br>
                        <select class="form-control" name="einFloorType1" id="einFloorType1" >
                            <option value="">Bitte wählen</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="10+">10+</option>
                            <option value="UG">UG</option>
                            <option value="EG">EG</option>
                            <option value="Hochparterre">Hochparterre</option>
                        </select> 
                    </div> 
                </div> 
                
                <div class=" row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Lift:</label>  
                        <div class="radiobox">                                                
                            <label class="text-dark">
                                <input type="radio" class="offerte-lift2"  name="isEinLift1" value="1" > <span class="label-text">Ja</span>
                            </label>
                            <label class="text-dark ml-1">
                                <input type="radio"  class="offerte-lift2"  name="isEinLift1" value="0"checked > <span class="label-text">Nein</span>
                            </label>
                        </div>                                        
                    </div>                            
                </div>
    
                <div class="form-group row">
                    <div class="col-md-12 offer-einzug-2">
                        <label for="" class="col-form-label">2. Einzugsadresse</label><br>
                        <input type="checkbox" name="isofferEinzug2" id="isofferEinzug2" class="js-switch " data-color="#286090" data-switchery="false" >  
                    </div>                            
                </div>
            </div>
        </div>
    
    
    
        {{-- 2.Kısım --}}
        <div class="form-group row mt-0 p-3 mb-0" > 
            {{-- Offerte Umzug2 Sol --}}
            <div class="col-md-6 aus-area-2" style="display: none;">
                <h5 class="font-weight-bold">2. Auszugsadresse</h5>
                <label class=" col-form-label" for="l0">Strasse</label>
                <input class="form-control" name="ausStreet2"  type="text"  >
                <div class="row">
                    <div class="col-md-5 ">
                        <label class=" col-form-label" for="l0">PLZ</label>
                        <input class="form-control" name="ausPostcode2"  type="text" >
                    </div> 
                    <div class="col-md-7">
                        <label class=" col-form-label" for="l0">Ort</label>
                        <input class="form-control" name="ausCity2"  type="text" >
                    </div>  
                </div> 
                
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Land</label><br>
                        <select class="form-control" name="ausCountry2" id="ausCountry2">
                            <option value="Schweiz">Schweiz</option>
                            <option value="Fürstentum Liechtenstein">Fürstentum Liechtenstein</option>
                            <option value="Deutschland">Deutschland</option>
                            <option value="Österreich">Österreich</option>
                            <option value="Italien">Italien</option>
                            <option value="Frankreich">Frankreich</option>
                        </select> 

                        <div class="mt-1 isAusCustomLand2">
                            <label class="col-form-label" for="l0">Custom Land</label>
                            <input type="checkbox"  name="isAusCustomLand2" id="isAusCustomLand2" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
                        </div>
                        <div class="custom-aus-land-area-2" style="display:none;">
                            <input class="form-control" type="text" name="ausCustomLand2">
                        </div>
                    </div> 
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Gebäude</label><br>
                        <select class="form-control" name="ausBuildType2" id="ausBuildType2">
                            <option value="">Bitte wählen</option>
                            <option value="EFH">EFH</option>
                            <option value="MFH">MFH</option>
                            <option value="RFH">RFH</option>
                            <option value="Geschäft/Büro">Geschäft/Büro</option>
                            <option value="Lagerhaus">Lagerhaus</option>
                        </select> 
                    </div> 
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Etage</label><br>
                        <select class="form-control" name="ausFloorType2" id="ausFloorType2">
                            <option value="">Bitte wählen</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="10+">10+</option>
                            <option value="UG">UG</option>
                            <option value="EG">EG</option>
                            <option value="Hochparterre">Hochparterre</option>
                        </select> 
                    </div> 
                </div> 
                
                <div class=" row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Lift:</label>  
                        <div class="radiobox">                                                
                            <label class="text-dark">
                                <input type="radio" class="offerte-type"  name="isAusLift2" value="1" > <span class="label-text">Ja</span>
                            </label>
                            <label class="text-dark ml-1">
                                <input type="radio"  class="offerte-type"  name="isAusLift2" value="0" checked> <span class="label-text">Nein</span>
                            </label>
                        </div>                                        
                    </div>                            
                </div>

                <div class="form-group row">
                    <div class="col-md-12 offer-auszug-3">
                        <label for="" class="col-form-label">3. Auszugsadresse</label><br>
                        <input type="checkbox" name="isofferAuszug3" id="isofferAuszug3" class="js-switch " data-color="#286090" data-switchery="false" >  
                    </div>                            
                </div>
    
              
            </div>
        
            <div class="col-md-6 offset-md-6 ein-area-2 mt-0" style="display: none;">
                    <h5 class="font-weight-bold">2. Einzugsadresse</h5>
                    <label class=" col-form-label" for="l0">Strasse</label>
                    <input class="form-control" name="einStreet2"  type="text"  >
                    <div class="row">
                        <div class="col-md-5 p-0">
                            <label class=" col-form-label" for="l0">PLZ</label>
                            <input class="form-control" name="einPostcode2"  type="text"  >
                        </div> 
                        <div class="col-md-7">
                            <label class=" col-form-label" for="l0">Ort</label>
                            <input class="form-control" name="einCity2"  type="text"  >
                        </div>  
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="col-form-label">Land</label><br>
                            <select class="form-control" name="einCountry2" id="einCountry2">
                                <option value="Schweiz">Schweiz</option>
                                <option value="Fürstentum Liechtenstein">Fürstentum Liechtenstein</option>
                                <option value="Deutschland">Deutschland</option>
                                <option value="Österreich">Österreich</option>
                                <option value="Italien">Italien</option>
                                <option value="Frankreich">Frankreich</option>
                            </select> 

                            <div class="mt-1 isEinCustomLand2">
                                <label class="col-form-label" for="l0">Custom Land</label>
                                <input type="checkbox"  name="isEinCustomLand2" id="isEinCustomLand2" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
                            </div>
                            <div class="custom-ein-land-area-2" style="display:none;">
                                <input class="form-control" type="text" name="einCustomLand2">
                            </div>
                        </div> 
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="col-form-label">Gebäude</label><br>
                            <select class="form-control" name="einBuildType2" id="einBuildType2">
                                <option value="">Bitte wählen</option>
                                <option value="EFH">EFH</option>
                                <option value="MFH">MFH</option>
                                <option value="RFH">RFH</option>
                                <option value="Geschäft/Büro">Geschäft/Büro</option>
                                <option value="Lagerhaus">Lagerhaus</option>
                            </select> 
                        </div> 
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="col-form-label">Etage</label><br>
                            <select class="form-control" name="einFloorType2" id="einFloorType2">
                                <option value="">Bitte wählen</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="10+">10+</option>
                                <option value="UG">UG</option>
                                <option value="EG">EG</option>
                                <option value="Hochparterre">Hochparterre</option>
                            </select> 
                        </div> 
                    </div> 
                    
                    <div class=" row">
                        <div class="col-md-12">
                            <label for="" class="col-form-label">Lift:</label>  
                            <div class="radiobox">                                                
                                <label class="text-dark">
                                    <input type="radio" class="offerte-lift2"  name="isEinLift2" value="1" > <span class="label-text">Ja</span>
                                </label>
                                <label class="text-dark ml-1">
                                    <input type="radio"  class="offerte-lift2"  name="isEinLift2" value="0"checked > <span class="label-text">Nein</span>
                                </label>
                            </div>                                        
                        </div>                            
                    </div>    

                    <div class="form-group row">
                        <div class="col-md-12 offer-einzug-3">
                            <label for="" class="col-form-label">3. Einzugsadresse</label><br>
                            <input type="checkbox" name="isofferEinzug3" id="isofferEinzug3" class="js-switch " data-color="#286090" data-switchery="false" >  
                        </div>                            
                    </div>
                </div>
        </div>

        {{-- 3.Kısım --}}
        <div class="form-group row mt-0 p-3 " > 
            {{-- Offerte Umzug3 Sol --}}
            <div class="col-md-6 aus-area-3" style="display: none;">
                <h5 class="font-weight-bold">3. Auszugsadresse</h5>
                <label class=" col-form-label" for="l0">Strasse</label>
                <input class="form-control" name="ausStreet3"  type="text"  >
                <div class="row">
                    <div class="col-md-5 ">
                        <label class=" col-form-label" for="l0">PLZ</label>
                        <input class="form-control" name="ausPostcode3"  type="text" >
                    </div> 
                    <div class="col-md-7">
                        <label class=" col-form-label" for="l0">Ort</label>
                        <input class="form-control" name="ausCity3"  type="text" >
                    </div>  
                </div> 
                
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Land</label><br>
                        <select class="form-control" name="ausCountry3" id="ausCountry3">
                            <option value="Schweiz">Schweiz</option>
                            <option value="Fürstentum Liechtenstein">Fürstentum Liechtenstein</option>
                            <option value="Deutschland">Deutschland</option>
                            <option value="Österreich">Österreich</option>
                            <option value="Italien">Italien</option>
                            <option value="Frankreich">Frankreich</option>
                        </select> 

                        <div class="mt-1 isAusCustomLand3">
                            <label class="col-form-label" for="l0">Custom Land</label>
                            <input type="checkbox"  name="isAusCustomLand3" id="isAusCustomLand3" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
                        </div>
                        <div class="custom-aus-land-area-3" style="display:none;">
                            <input class="form-control" type="text" name="ausCustomLand3">
                        </div>
                    </div> 
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Gebäude</label><br>
                        <select class="form-control" name="ausBuildType3" id="ausBuildType3">
                            <option value="">Bitte wählen</option>
                            <option value="EFH">EFH</option>
                            <option value="MFH">MFH</option>
                            <option value="RFH">RFH</option>
                            <option value="Geschäft/Büro">Geschäft/Büro</option>
                            <option value="Lagerhaus">Lagerhaus</option>
                        </select> 
                    </div> 
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Etage</label><br>
                        <select class="form-control" name="ausFloorType3" id="ausFloorType3">
                            <option value="">Bitte wählen</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="10+">10+</option>
                            <option value="UG">UG</option>
                            <option value="EG">EG</option>
                            <option value="Hochparterre">Hochparterre</option>
                        </select> 
                    </div> 
                </div> 
                
                <div class=" row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label">Lift:</label>  
                        <div class="radiobox">                                                
                            <label class="text-dark">
                                <input type="radio" class="offerte-type"  name="isAusLift3" value="1" > <span class="label-text">Ja</span>
                            </label>
                            <label class="text-dark ml-1">
                                <input type="radio"  class="offerte-type"  name="isAusLift3" value="0" checked> <span class="label-text">Nein</span>
                            </label>
                        </div>                                        
                    </div>                            
                </div>
    
              
            </div>
        
            <div class="col-md-6 offset-md-6 ein-area-3" style="display: none;">
                    <h5 class="font-weight-bold">3. Einzugsadresse</h5>
                    <label class=" col-form-label" for="l0">Strasse</label>
                    <input class="form-control" name="einStreet3"  type="text"  >
                    <div class="row">
                        <div class="col-md-5 p-0">
                            <label class=" col-form-label" for="l0">PLZ</label>
                            <input class="form-control" name="einPostcode3"  type="text"  >
                        </div> 
                        <div class="col-md-7">
                            <label class=" col-form-label" for="l0">Ort</label>
                            <input class="form-control" name="einCity3"  type="text"  >
                        </div>  
                    </div> 
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="col-form-label">Land</label><br>
                            <select class="form-control" name="einCountry3" id="einCountry3">
                                <option value="Schweiz">Schweiz</option>
                                <option value="Fürstentum Liechtenstein">Fürstentum Liechtenstein</option>
                                <option value="Deutschland">Deutschland</option>
                                <option value="Österreich">Österreich</option>
                                <option value="Italien">Italien</option>
                                <option value="Frankreich">Frankreich</option>
                            </select> 

                            <div class="mt-1 isEinCustomLand3">
                                <label class="col-form-label" for="l0">Custom Land</label>
                                <input type="checkbox"  name="isEinCustomLand3" id="isEinCustomLand3" class="js-switch mt-1" data-color="#286090" data-size="small" data-switchery="false" >
                            </div>
                            <div class="custom-ein-land-area-3" style="display:none;">
                                <input class="form-control" type="text" name="einCustomLand3">
                            </div>
                        </div> 
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="col-form-label">Gebäude</label><br>
                            <select class="form-control" name="einBuildType3" id="einBuildType3">
                                <option value="">Bitte wählen</option>
                                <option value="EFH">EFH</option>
                                <option value="MFH">MFH</option>
                                <option value="RFH">RFH</option>
                                <option value="Geschäft/Büro">Geschäft/Büro</option>
                                <option value="Lagerhaus">Lagerhaus</option>
                            </select> 
                        </div> 
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="col-form-label">Etage</label><br>
                            <select class="form-control" name="einFloorType3" id="einFloorType3">
                                <option value="">Bitte wählen</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="10+">10+</option>
                                <option value="UG">UG</option>
                                <option value="EG">EG</option>
                                <option value="Hochparterre">Hochparterre</option>
                            </select> 
                        </div> 
                    </div> 
                    
                    <div class=" row">
                        <div class="col-md-12">
                            <label for="" class="col-form-label">Lift:</label>  
                            <div class="radiobox">                                                
                                <label class="text-dark">
                                    <input type="radio" class="offerte-lift3"  name="isEinLift3" value="1" > <span class="label-text">Ja</span>
                                </label>
                                <label class="text-dark ml-1">
                                    <input type="radio"  class="offerte-lift3"  name="isEinLift3" value="0"checked > <span class="label-text">Nein</span>
                                </label>
                            </div>                                        
                        </div>                            
                    </div> 
                    
                    
                </div>
        </div>
</div>



@section('offerFooter')

<script>
    var isAusCustomLand1 = $("div.isAusCustomLand1");
    isAusCustomLand1.click(function() {
        if ($(this).hasClass("checkbox-checked"))
        { 
            $(".custom-aus-land-area-1").show(300);
        }
        else{
            $(".custom-aus-land-area-1").hide(200);
        }
    })

    var isAusCustomLand2 = $("div.isAusCustomLand2");
    isAusCustomLand2.click(function() {
        if ($(this).hasClass("checkbox-checked"))
        { 
            $(".custom-aus-land-area-2").show(300);
        }
        else{
            $(".custom-aus-land-area-2").hide(200);
        }
    })

    var isAusCustomLand3 = $("div.isAusCustomLand3");
    isAusCustomLand3.click(function() {
        if ($(this).hasClass("checkbox-checked"))
        { 
            $(".custom-aus-land-area-3").show(300);
        }
        else{
            $(".custom-aus-land-area-3").hide(200);
        }
    })

    var isEinCustomLand1 = $("div.isEinCustomLand1");
    isEinCustomLand1.click(function() {
        if ($(this).hasClass("checkbox-checked"))
        { 
            $(".custom-ein-land-area-1").show(300);
        }
        else{
            $(".custom-ein-land-area-1").hide(200);
        }
    })

    var isEinCustomLand2 = $("div.isEinCustomLand2");
    isEinCustomLand2.click(function() {
        if ($(this).hasClass("checkbox-checked"))
        { 
            $(".custom-ein-land-area-2").show(300);
        }
        else{
            $(".custom-ein-land-area-2").hide(200);
        }
    })

    var isEinCustomLand3 = $("div.isEinCustomLand3");
    isEinCustomLand3.click(function() {
        if ($(this).hasClass("checkbox-checked"))
        { 
            $(".custom-ein-land-area-3").show(300);
        }
        else{
            $(".custom-ein-land-area-3").hide(200);
        }
    })

    var morebutton = $("div.offer-auszug-2");
    morebutton.click(function() {
        if ($(this).hasClass("checkbox-checked"))
        {
            $("input[name=ausStreet2]").prop('required',true);      
            $("input[name=ausPostcode2]").prop('required',true);   
            $("input[name=ausCity2]").prop('required',true);  
            $("input[name=ausCountry2]").prop('required',true);  
            $("input[name=ausBuildType2]").prop('required',true);  
            $("input[name=ausFloorType2]").prop('required',true); 
            $(".einaus--area2").show(300);
            $(".aus-area-2").show(500);
            
        }
        else {
            $("input[name=ausStreet2]").prop('required',false);      
            $("input[name=ausPostcode2]").prop('required',false);   
            $("input[name=ausCity2]").prop('required',false);  
            $("input[name=ausCountry2]").prop('required',false);  
            $("input[name=ausBuildType2]").prop('required',false);  
            $("input[name=ausFloorType2]").prop('required',false); 
            $(".aus-area-2").hide(500);
        }
    })
</script>

<script>
    var morebutton = $("div.offer-auszug-3");
    morebutton.click(function() {
        if ($(this).hasClass("checkbox-checked"))
        {
            $("input[name=ausStreet3]").prop('required',true);      
            $("input[name=ausPostcode3]").prop('required',true);   
            $("input[name=ausCity3]").prop('required',true);  
            $("input[name=ausCountry3]").prop('required',true);  
            $("input[name=ausBuildType3]").prop('required',true);  
            $("input[name=ausFloorType3]").prop('required',true); 
            $(".einaus--area2").show(300);
            $(".aus-area-3").show(500);
            
        }
        else {
            $("input[name=ausStreet3]").prop('required',false);      
            $("input[name=ausPostcode3]").prop('required',false);   
            $("input[name=ausCity3]").prop('required',false);  
            $("input[name=ausCountry3]").prop('required',false);  
            $("input[name=ausBuildType3]").prop('required',false);  
            $("input[name=ausFloorType3]").prop('required',false);
            $(".aus-area-3").hide(500);
        }
    })
</script>

<script>
    var morebutton = $("div.offer-einzug-3");
    morebutton.click(function() {
        if ($(this).hasClass("checkbox-checked"))
        {
            $("input[name=einStreet3]").prop('required',true);      
            $("input[name=einPostcode3]").prop('required',true);   
            $("input[name=einCity3]").prop('required',true);  
            $("input[name=einCountry3]").prop('required',true);  
            $("input[name=einBuildType3]").prop('required',true);  
            $("input[name=einFloorType3]").prop('required',true); 
            $(".einaus--area2").show(300);
            $(".ein-area-3").show(500);
            
        }
        else {
            $("input[name=einStreet3]").prop('required',false);      
            $("input[name=einPostcode3]").prop('required',false);   
            $("input[name=einCity3]").prop('required',false);  
            $("input[name=einCountry3]").prop('required',false);  
            $("input[name=einBuildType3]").prop('required',false);  
            $("input[name=einFloorType3]").prop('required',false);
            $(".ein-area-3").hide(500);
        }
    })
</script>

<script>
    var morebutton = $("div.offer-einzug-2");
    morebutton.click(function() {
        if ($(this).hasClass("checkbox-checked"))
        {
            $("input[name=einStreet2]").prop('required',true);      
            $("input[name=einPostcode2]").prop('required',true);   
            $("input[name=einCity2]").prop('required',true);  
            $("input[name=einCountry2]").prop('required',true);  
            $("input[name=einBuildType2]").prop('required',true);  
            $("input[name=einFloorType2]").prop('required',true); 
            $(".einaus--area2").show(300);
            $(".ein-area-2").show(500);
            
        }
        else {
            $("input[name=einStreet2]").prop('required',false);      
            $("input[name=einPostcode2]").prop('required',false);   
            $("input[name=einCity2]").prop('required',false);  
            $("input[name=einCountry2]").prop('required',false);  
            $("input[name=einBuildType2]").prop('required',false);  
            $("input[name=einFloorType2]").prop('required',false);
            $(".ein-area-2").hide(500);
        }
    })
</script>

@endsection







