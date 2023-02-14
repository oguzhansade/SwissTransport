@extends('layouts.app')

@section('content')
@section('sidebarType') sidebar-collapse @endsection

<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Kunden Bearbeiten</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Panel</a>
            </li>
            <li class="breadcrumb-item active">Kunden</li>
        </ol>
        {{-- <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">{{ \App\Models\Customer::getPublicName($data[0]['id']) }}</a>
        </div> --}}
    </div>
    <!-- /.page-title-right -->
</div> 

@if (session("status"))
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="alert alert-success">
                {{ session("status") }}
            </div>
        </div>
    </div>

@endif

<div class="widget-list">
    <div class="row">
        <div class="col-md-12 widget-holder">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <form action="{{ route('customer.update',['id' => $data[0]['id']]) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="" class="col-form-label">Typ</label>
                                <div class="radiobox">
                                    <label>
                                        <input type="radio" class="change-customerType" name="customerType" value="0" @if ($data[0]['customerType'] == 0) checked @endif> <span class="label-text">Privatperson</span>
                                    </label>
                                </div>

                                <div class="radiobox">
                                    <label>
                                        <input type="radio" class="change-customerType" name="customerType" value="1" @if ($data[0]['customerType'] == 1) checked @endif> <span class="label-text">Firma</span>
                                    </label>
                                </div>
                            </div>                            
                        </div>

                        <div class="form-group row firma--area" @if($data[0]['customerType'] == 0) style="display: none;" @endif>
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Firmenname</label>
                                    <input class="form-control" name="companyName"  type="text" value="{{ $data[0]['companyName'] }}" >                                
                                </div>
    
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Kontaktperson</label>
                                    <input class="form-control"  name="contactPerson"  type="text" value="{{ $data[0]['contactPerson'] }}">                                
                                </div>
                        </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Vorname</label>
                                    <input class="form-control" name="name"  type="text" value="{{ $data[0]['name'] }}" required>                                
                                </div>
    
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Nachname</label>
                                    <input class="form-control"  name="surname"  type="text" value="{{ $data[0]['surname'] }}" required>                                
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="" class="col-form-label">Anrede</label>
                                    <div class="radiobox">
                                        <label>
                                            <input type="radio"  name="gender" value="male" @if ($data[0]['gender'] == 'male') checked @endif> <span class="label-text">Herr</span>
                                        </label>
                                    </div>

                                    <div class="radiobox">
                                        <label>
                                            <input type="radio"  name="gender" value="female" @if ($data[0]['gender'] == 'female') checked @endif> <span class="label-text">Frau</span>
                                        </label>
                                    </div>
                                </div>  
                            </div>

                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">E-Mail</label>
                                    <input class="form-control" name="email"  type="text" value="{{ $data[0]['email'] }}" required>                                
                                </div>
    
                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">Telefon</label>
                                    <input class="form-control"  name="phone"  type="text" value="{{ $data[0]['phone'] }}">                                
                                </div>
    
                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">Mobile</label>
                                    <input class="form-control" type="text" id="phone"  placeholder="Phone Number" name="mobile" value="{{ $data[0]['mobile'] }}" required>
                                    <small class="text-primary"><i>Important For Notifications</i></small>                               
                                </div>
                            </div>

    
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">Strasse</label>
                                    <input class="form-control"  name="street"  type="text" value="{{ $data[0]['street'] }}" required>                                
                                </div>
    
                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">PLZ</label>
                                    <input class="form-control"  name="postCode"  type="text" value="{{ $data[0]['postCode'] }}" required>                                
                                </div>

                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">Ort</label>
                                    <input class="form-control"  name="Ort"  type="text" value="{{ $data[0]['Ort'] }}" required>                                
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Land</label><br>
                                    <select class="form-control" name="country" id="country" required>
                                        <option value="Schweiz" @if ($data[0]['country'] == 'Schweiz') selected @endif>Schweiz</option>
                                        <option value="Fürstentum Liechtenstein" @if ($data[0]['country'] == 'Fürstentum Liechtenstein') selected @endif>Fürstentum Liechtenstein</option>
                                        <option value="Deutschland" @if ($data[0]['country'] == 'Deutschland') selected @endif>Deutschland</option>
                                        <option value="Österreich" @if ($data[0]['country'] == 'Österreich') selected @endif>Österreich</option>
                                        <option value="Italien" @if ($data[0]['country'] == 'Italien') selected @endif>Italien</option>
                                        <option value="Frankreich" @if ($data[0]['country'] == 'Frankreich') selected @endif>Frankreich</option>
                                    </select>

                                    <div class="mt-1 isCustomCountry">
                                        <label class="col-form-label" for="l0">Custom Land</label>
                                        <input type="checkbox"  name="isCustomCountry" id="isCustomCountry" class="js-switch mt-1" data-color="#9c27b0" data-size="small" data-switchery="false" 
                                    @if (
                                        $data[0] &&
                                        $data[0]['country'] != 'Schweiz' && 
                                        $data[0]['country'] != 'Fürstentum Liechtenstein' &&
                                        $data[0]['country'] != 'Deutschland' &&
                                        $data[0]['country'] != 'Österreich' &&
                                        $data[0]['country'] != 'Italien' &&
                                        $data[0]['country'] != 'Frankreich' 
                                    )
                                    checked
                                    @else
                                    unchecked
                                    @endif
                                    >
                                    </div>
                                    <div class="custom-land-area" 
                                    @if (
                                        $data[0] &&
                                        $data[0]['country'] != 'Schweiz' && 
                                        $data[0]['country'] != 'Fürstentum Liechtenstein' &&
                                        $data[0]['country'] != 'Deutschland' &&
                                        $data[0]['country'] != 'Österreich' &&
                                        $data[0]['country'] != 'Italien' &&
                                        $data[0]['country'] != 'Frankreich' 
                                    )
                                    style="display:block;"
                                    @else
                                    style="display:none;"
                                    @endif
                                     >
                                        <input class="form-control" type="text" name="customCountry" @if($data[0] && $data[0]['country']) value="{{  $data[0]['country'] }}" @endif>
                                    </div>
                                </div>
    
                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">Kundenquelle</label>
                                    <input class="form-control"  name="source1"  type="text" value="{{ $data[0]['source1'] }}">                                
                                </div>
    
                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">Andere Quelle</label>
                                    <input class="form-control"  name="source2"  type="text" value="{{ $data[0]['source2'] }}">                                
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">Notiz</label>
                                    <textarea name="note" class="form-control" id="" cols="30" rows="10">{{ $data[0]['note'] }}</textarea>                               
                                </div>
                            </div>
                      
                        
                        <div class="form-actions">
                            <div class="form-group row">
                                <div class="col-md-12 ml-md-auto btn-list">
                                    <button class="btn btn-primary btn-rounded" type="submit">Speichern</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
    </div>
</div>

@endsection

@section('footer')
<script>
    // Vanilla Javascript
    var input = document.querySelector("#phone");
    window.intlTelInput(input,({
        preferredCountries : ["ch","tr","de","li","at","it","fr"],
        formatOnDisplay:true,
        nationalMode:true,
    }));
 
        $('.iti__flag-container').click(function() { 
            var countryCode = $('.iti__selected-flag').attr('title');
            var countryCode = countryCode.replace(/[^0-9]/g,'')
            $('#phone').val('');
            $('#phone').val("+"+countryCode+$('#phone').val());
        });
</script>

    <script>
        var isCustomCountry = $("div.isCustomCountry");
    isCustomCountry.click(function() {
        if ($(this).hasClass("checkbox-checked"))
        { 
            $(".custom-land-area").show(300);
            $('input[name=country]').prop('required',false)
        }
        else{
            $(".custom-land-area").hide(200);
            $('input[name=customCountry]').prop('required',true)
        }
    })

        $(".change-customerType").click(function() {
            var value = $(this).val();
            if(value == 1)
            {
                $(".firma--area").show();
            }
            else {
                $(".firma--area").hide();
            }
        });
    </script>
@endsection