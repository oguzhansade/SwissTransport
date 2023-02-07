@extends('layouts.app')
@section('content')
@section('sidebarType') sidebar-collapse @endsection
<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Neuen Kunden erfassen</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Panel</a>
            </li>
            <li class="breadcrumb-item active">Kunden</li>
        </ol>
        {{-- <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Yeni Müşteri Ekle</a>
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
                    <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        
                        <div class="form-group row">
                            <div class="col-md-12 ">

                                <label for="" class="col-form-label">Typ</label>
                                <div class="radiobox">
                                    <label>
                                        <input type="radio" class="change-customerType" name="customerType" value="0" checked="checked"> <span class="label-text">Privatperson</span>
                                    </label>
                                </div>

                                <div class="radiobox">
                                    <label>
                                        <input type="radio" class="change-customerType" name="customerType" value="1"> <span class="label-text">Firma</span>
                                    </label>
                                </div>

                                
                            </div>                            
                        </div>

                        <div class="form-group row firma--area" style="display: none;">
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Firmenname</label>
                                    <input class="form-control" name="companyName"  type="text">                                
                                </div>
    
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Kontaktperson</label>
                                    <input class="form-control"  name="contactPerson"  type="text">                                
                                </div>
                        </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Vorname</label>
                                    <input class="form-control" name="name"  type="text" required>                                
                                </div>
    
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Nachname</label>
                                    <input class="form-control"  name="surname"  type="text" required>                                
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="" class="col-form-label">Anrede</label>
                                    <div class="radiobox">
                                        <label>
                                            <input type="radio"  name="gender" value="male" checked> <span class="label-text">Herr</span>
                                        </label>
                                    </div>
                                    <div class="radiobox">
                                        <label>
                                            <input type="radio"  name="gender" value="female"> <span class="label-text">Frau</span>
                                        </label>
                                    </div>
                                </div>  
                            </div>

                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">E-Mail</label>
                                    <input class="form-control" name="email"  type="text" required>                                
                                </div>
    
                                <div class="col-md-4 form-group">
                                    <label class="col-form-label"  for="l0">Telefon</label>
                                    <input class="form-control" type="text"  placeholder="Phone Number" name="phone">
                                </div>
    
                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">Mobile</label>
                                    <input class="form-control" type="text" id="phone"  placeholder="Phone Number" value="+41" name="mobile" required>
                                    <small class="text-primary"><i>Important For Notifications</i></small>
                                </div>
                            </div>

    
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">Strasse</label>
                                    <input class="form-control"  name="street"  type="text" required>                                
                                </div>
    
                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">PLZ</label>
                                    <input class="form-control"  name="postCode"  type="text" required>                                
                                </div>

                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">Ort</label>
                                    <input class="form-control"  name="Ort"  type="text" required>                                
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">Land</label>
                                    <input class="form-control"  name="country"  type="text" required>                                
                                </div>
    
                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">Kundenquelle</label>
                                    <input class="form-control"  name="source1"  type="text">                                
                                </div>
    
                                <div class="col-md-4">
                                    <label class=" col-form-label" for="l0">Andere Quelle</label>
                                    <input class="form-control"  name="source2"  type="text">                                
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">Notiz</label>
                                    <textarea name="note" class="form-control" id="" cols="30" rows="10"></textarea>                               
                                </div>
                            </div>
                      
                        
                        <div class="form-actions">
                            <div class="form-group row">
                                <div class="col-md-12 ml-md-auto btn-list">
                                    <button class="btn btn-primary btn-rounded" type="submit">Erstellen</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.0/metisMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/js/perfect-scrollbar.jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/3.1.2/jquery.bootstrap-touchspin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.1.7/js/ion.rangeSlider.min.js"></script>

<script>
    // Vanilla Javascript
    var input = document.querySelector("#phone");
    window.intlTelInput(input,({
        preferredCountries : ["ch","tr","de","li","at","it","fr"],
        formatOnDisplay:true,
        nationalMode:true,
    }));
 
    $(document).ready(function() {
        $('.iti__flag-container').click(function() { 
          var countryCode = $('.iti__selected-flag').attr('title');
          var countryCode = countryCode.replace(/[^0-9]/g,'')
          $('#phone').val("");
          $('#phone').val("+"+countryCode+ $('#phone').val());
       });
    });
</script>

<script>
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