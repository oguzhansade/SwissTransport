@extends('layouts.app')
@section('header')
<style>
    .custom-shadow {
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        border-radius: 25px;
    }
</style>
@endsection
@section('content')
@section('sidebarType') sidebar-collapse @endsection
<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Bexio Customer Create</h6>
    </div>

    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Panel</a>
            </li>
            <li class="breadcrumb-item active">Bexio</li>
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




<a href="{{ route('receipt.detail',['id' => $receipt['id']]) }}"
    class=" px-2 bg-primary text-white b-shadow  text-center d-flex align-items-center back-button rounded-custom mt-3" style="max-width: 100px;">
    <i class="feather feather-arrow-left align-self-center pr-1"></i>Zurück</b>
</a>

<div class="widget-list">
    <div class="row d-flex justify-content-center ">
        <div class="col-md-10 widget-holder ">
            <div class="widget-bg custom-shadow">
                <div class="widget-body clearfix">
                    <form action="{{ route('receipt.bexioStoreCustomer',['customerId' => $customer['id']]) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12 ">

                                <label for="" class="col-form-label">Typ</label>
                                <div class="radiobox">
                                    <label>
                                        <input type="radio" class="change-customerType" name="customerType" value="2" checked="checked"> <span class="label-text">Privatperson</span>
                                    </label>
                                </div>

                                <div class="radiobox">
                                    <label>
                                        <input type="radio" class="change-customerType" name="customerType" value="1"> <span class="label-text">Firma</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0">Vorname</label>
                                <input class="form-control" name="name"  type="text" required value="{{ $customer['name'] }}">
                            </div>

                            <div class="col-md-6">
                                <label id="name2" class=" col-form-label" for="l0">Nachname</label>
                                <input class="form-control"  name="surname"  type="text" required value="{{ $customer['surname'] }}" required>
                                <small class="text-danger">Wenn der Kundentyp eine Firma ist, wird dieses Feld als Firmenname akzeptiert.</small>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="" class="col-form-label">Anrede</label>
                                <div class="radiobox">
                                    <label>
                                        <input type="radio"  name="gender" value="1" checked> <span class="label-text">Herr</span>
                                    </label>
                                </div>
                                <div class="radiobox">
                                    <label>
                                        <input type="radio"  name="gender" value="2"> <span class="label-text">Frau</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0">E-Mail</label>
                                <input class="form-control" name="email"  type="text" required value="{{ $customer['email'] }}">
                            </div>

                            <div class="col-md-6">
                                <label class=" col-form-label" for="l0">Mobile</label>
                                <input class="form-control" type="text" id="phone"  placeholder="Phone Number" value="+41" name="mobile" required value="{{ $customer['mobile'] }}">

                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class=" col-form-label" for="l0">Strasse</label>
                                <input class="form-control"  name="street"  type="text" required value="{{ $customer['street'] }}">
                            </div>

                            <div class="col-md-3">
                                <label class=" col-form-label" for="l0">PLZ</label>
                                <input class="form-control"  name="postCode"  type="text" required value="{{ $customer['postCode'] }}">
                            </div>

                            <div class="col-md-3">
                                <label class=" col-form-label" for="l0">Ort</label>
                                <input class="form-control"  name="Ort"  type="text" required value="{{ $customer['Ort'] }}">
                            </div>

                            <div class="col-md-3">
                                <label for="" class="col-form-label">Land</label><br>
                                <select class="form-control" name="country" id="country" required>
                                    @foreach ($countryList as $country)
                                        <option value="{{ $country['id'] }}" @if($customer['country'] == $country['name']) selected @endif>{{ $country['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-actions d-flex justify-content-end">
                            <div class="form-group row">
                                <div class="col-md-12  btn-list">
                                    <button class="btn btn-success btn-rounded custom-shadow" type="submit">Continue >></button>
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
    $(".change-customerType").click(function() {
        var value = $(this).val();
        if(value == 1)
        {
            $("#name2").text('Firmenname');
        }
        else{
            $("#name2").text('Nachname')
        }
    });
</script>
@endsection
