@extends('layouts.app')
@section('content')
@section('sidebarType') sidebar-collapse @endsection
<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Neue Produkte Erfassen</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Panel</a>
            </li>
            <li class="breadcrumb-item active">Produkte</li>
        </ol>
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

@if (session("status2"))
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="alert alert-danger">
                {{ session("status2") }}
            </div>
        </div>
    </div>
@endif

<div class="widget-list">
    <div class="row">
        <div class="col-md-12 widget-holder product-area">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="l0">Produktname</label>
                                    <input class="form-control" name="productName"  type="text" required>                                
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Kaufpreis</label>
                                    <input class="form-control float-number"  name="buyPrice" step="0.01"  type="text"  required>                                
                                </div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="l0">Mietepreis</label>
                                    <input class="form-control float-number"  name="rentPrice" step="0.01"  type="text"  required>                                
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
{{-- <script>
    $(document).ready(function(){
        $("body").on("change",".product-area",function(){
            var rent = parseFloat($("input[name=rentPrice]").val()).toFixed(2)
            var buy = parseFloat($("input[name=buyPrice]").val()).toFixed(2)
            $("input[name=buyPrice]").val(buy)
            $("input[name=rentPrice]").val(rent)
        })
        
    })
</script> --}}
<script>
    jQuery(document).ready(function() {
    $('.float-number').keypress(function(event) {
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.0/metisMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/js/perfect-scrollbar.jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/3.1.2/jquery.bootstrap-touchspin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.1.7/js/ion.rangeSlider.min.js"></script>
@endsection