@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <style>
        .custom-shadow {
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            border-radius: 25px;
        }
    </style>
@endsection
@section('content')

 <!-- Page Title Area -->
 <div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Bexio Index Müşteri Sayfası</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Panel</a>
            </li>
            <li class="breadcrumb-item active">Bexio</li>
        </ol>
        {{-- <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Müşteri Listesi</a>
        </div> --}}
    </div>
    <!-- /.page-title-right -->
</div>

@if (session('success'))
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="alert alert-success">
                <i class="feather feather-check-circle" ></i> {{ session('success') }}
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <i class="feather feather-x-circle" ></i> {{ session('error') }}
            </div>
        </div>
    </div>
@endif

<div class="col-md-2">
    <a href="{{ route('receipt.detail',['id' => $receipt['id']]) }}"
        class="h4 px-4 py-2 bg-primary text-white b-shadow  text-center d-flex align-items-center back-button rounded-custom">
        <i class="feather feather-arrow-left align-self-center pr-1"></i>Quitttung Detail (592)</b>
    </a>
</div>

<div class="widget-list">
    <div class="row d-flex justify-content-center ">
        <div class="col-md-12 widget-holder ">
            <div class="widget-bg custom-shadow">
                <div class="widget-body clearfix">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="h6">@if($customer[0]['contact_type_id'] == 2) Müşteri Adı: @else Firma Adı: @endif {{ $customer[0]['name_1'] }} {{ $customer[0]['name_2'] }} </span>
                            <table border="0">
                                <tr>
                                    <td><strong>Id:</strong></td>
                                    <td>{{ $customer[0]['id'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nr:</strong></td>
                                    <td>{{ $customer[0]['nr'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Contact_type_id:</strong></td>
                                    <td>@if($customer[0]['contact_type_id'] == 2) Privat @else Firmen @endif</td>
                                </tr>
                                <tr>
                                    <td><strong>Salutation_id:</strong></td>
                                    <td> @if($customer[0]['salutation_id'] == 1) Herr @else Frau @endif</td>
                                </tr>
                                <tr>
                                    <td><strong>Address:</strong></td>
                                    <td>{{ $customer[0]['address'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Postcode:</strong></td>
                                    <td>{{ $customer[0]['postcode'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>City:</strong></td>
                                    <td>{{ $customer[0]['city'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Country_id:</strong></td>
                                    <td>{{ $customer[0]['country_id'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Mail:</strong></td>
                                    <td>{{ $customer[0]['mail'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone_mobile:</strong></td>
                                    <td>{{ $customer[0]['phone_mobile'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Bexio Rechnung Id: </strong></td>
                                    <td>{{ $receipt['bexioId'] }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">

                        </div>
                    </div>
                    <div class="row mt-3">
                        @if($receipt['bexioId'])
                        <strong class="btn btn-success btn-rounded custom-shadow"><b>FATURA MEVCUT (ID: {{ $receipt['bexioId'] }})</b></strong>
                        <a  class="btn bg-primary  btn-rounded custom-shadow ml-1" target="_blank" href="{{ route('receipt.bexioShowPdf',['invoiceId' => $receipt['bexioId']])}}">PDF GÖR</a>
                        <a class="btn bg-danger  btn-rounded custom-shadow ml-1" href="{{ route('receipt.emptyBexioId',['id' => $receipt['id']])}}">ID yi Sil</a>

                        @else
                        <a id="faturaOlustur" class="btn btn-success btn-rounded custom-shadow" href="{{ route('receipt.bexioCreateInvoice',['customerId' => $customer[0]['id'],'receiptId' => $receipt['id']]) }}"><strong>Quit: {{ $receipt['id'] }} için Fatura Oluştur</strong></a>
                        @endif
                    </div>
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
    </div>
</div>
<!-- /.widget-list -->
@endsection
@section('footer')

{{-- // Fatura oluştururken loading bar --}}
<script>
    $(document).ready(function() {
        // Bağlantı tıklandığında 'loading-body' gösterilir
        $('#faturaOlustur').on('click', function() {
            $('#loading-body').show();
        });

        $('#faturaGor').on('click', function() {
            $('#loading-body').show();
        });

        // Sayfa tamamen yüklendiğinde 'loading-body' gizlenir
        $(window).on('load', function() {
            $('#loading-body').hide();
        });
    });
</script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>



@endsection
