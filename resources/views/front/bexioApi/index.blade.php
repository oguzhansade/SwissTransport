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
                            </table>
                        </div>

                        <div class="col-md-6">

                        </div>
                    </div>
                    <div class="row mt-3">
                        @if(count($invoice) == 0)
                        <a class="btn btn-success btn-rounded custom-shadow" href="{{ route('receipt.bexioCreateInvoice',['customerId' => $customer[0]['id'],'receiptId' => $receipt['id']]) }}"><strong>Fatura Oluştur</strong></a>
                        @else
                        <a class="btn btn-success  btn-rounded custom-shadow" href=""><strong>Pozisyon Ekle </strong></a>
                        @endif
                        <a class="btn btn-info ml-1  btn-rounded custom-shadow" href="#"><strong>Elden Ödeme Girişi</strong></a>
                        <a class="btn btn-warning ml-1  btn-rounded custom-shadow" href="{{ route('receipt.bexioSendInvoice',['customerId' => $customer[0]['id'],'receiptId' => $receipt['id'],'invoiceId' => $invoice[0]['id']]) }}"><strong>Müşteriye Mail Gönder</strong></a>
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
