@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">
    <style>
        .table {
            width: 100% !important;
        }

        .b-shadow {
            box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
        }

        .back-button {
            cursor: pointer;
            border-radius: 35px !important;
            box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
        }

        .shadow-custom {
            box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset,
                rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset,
                rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset,
                rgba(0, 0, 0, 0.06) 0px 2px 1px,
                rgba(0, 0, 0, 0.09) 0px 4px 2px,
                rgba(0, 0, 0, 0.09) 0px 8px 4px,
                rgba(0, 0, 0, 0.09) 0px 16px 8px,
                rgba(0, 0, 0, 0.09) 0px 32px 16px;
        }

        .bg-custom-success {
            color: white;
            background-color: #28A745;
            border-radius: 55px;
            box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset,
                rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset,
                rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset,
                rgba(0, 0, 0, 0.06) 0px 2px 1px,
                rgba(0, 0, 0, 0.09) 0px 4px 2px,
                rgba(0, 0, 0, 0.09) 0px 8px 4px,
                rgba(0, 0, 0, 0.09) 0px 16px 8px,
                rgba(0, 0, 0, 0.09) 0px 32px 16px;
            /* box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px
        inset; */
        }

        .bg-custom-danger {
            color: white;
            background-color: #E6614F;
            border-radius: 55px;
            box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset,
                rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset,
                rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset,
                rgba(0, 0, 0, 0.06) 0px 2px 1px,
                rgba(0, 0, 0, 0.09) 0px 4px 2px,
                rgba(0, 0, 0, 0.09) 0px 8px 4px,
                rgba(0, 0, 0, 0.09) 0px 16px 8px,
                rgba(0, 0, 0, 0.09) 0px 32px 16px;
            /* box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px
        inset; */
        }

        .bg-custom-warning {
            color: white;
            background-color: #FFC107;
            border-radius: 55px;
            box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset,
                rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset,
                rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset,
                rgba(0, 0, 0, 0.06) 0px 2px 1px,
                rgba(0, 0, 0, 0.09) 0px 4px 2px,
                rgba(0, 0, 0, 0.09) 0px 8px 4px,
                rgba(0, 0, 0, 0.09) 0px 16px 8px,
                rgba(0, 0, 0, 0.09) 0px 32px 16px;
            /* box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px
        inset; */
        }

        #infoTooltip {
            display: none;
            position: absolute;
            background-color: #000000;
            border-radius: 5px;
            color:white;
            font-size:12px;
            padding: 3px;
            z-index: 1;
        }

        #termineBadge:hover + #infoTooltip {
            display: block;
        }
    </style>

<style>
    /* DataTables
            ========================*/
    .dataTables_wrapper label {
        font-weight: normal;
    }

    .dataTables_wrapper .dataTables_filter input {
        padding: 0.35714em 0.71429em;
        border: 0.0625rem solid #eee;
        border-radius: 0.125rem;
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #03a9f3!important;
    }

    .dataTables_wrapper .dataTables_length {
        margin: 1.07143em auto;
    }

    .dataTables_wrapper .dataTables_length select {
        padding: 0.21429em 0.5em;
    }

    .dataTables_wrapper table.dataTable {
        border: 0.0625rem solid #eee;
        margin-top: 1.42857em;
    }

    .dataTables_wrapper table.dataTable thead th {
        border-color: #eef1f2;
    }

    .dataTables_wrapper table.dataTable th,
    .dataTables_wrapper table.dataTable td {
        padding: 1.07143em 1.42857em;
    }

    .dataTables_wrapper table.dataTable tfoot th {
        border-top: 0.0625rem solid #eee;
    }

    .dataTables_wrapper table.dataTable thead th {
        border-top: 0;
    }

    .dataTables_wrapper table.dataTable thead .sorting,
    .dataTables_wrapper table.dataTable thead .sorting_asc,
    .dataTables_wrapper table.dataTable thead .sorting_desc {
        background: none;
        position: relative;
    }

    .dataTables_wrapper table.dataTable thead .sorting:before,
    .dataTables_wrapper table.dataTable thead .sorting_asc:before,
    .dataTables_wrapper table.dataTable thead .sorting_desc:before {
        position: absolute;
        top: 50%;
        right: 0.71429em;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        font-family: "Material Icons";
        -webkit-font-feature-settings: 'liga';
        font-feature-settings: 'liga';
        font-size: 1.28571em;
    }

    .dataTables_wrapper table.dataTable thead .sorting_asc::before {
        content: 'expand_less';
    }

    .dataTables_wrapper table.dataTable thead .sorting_desc::before {
        content: 'expand_more';
    }

    .dataTables_wrapper table.dataTable thead .sorting::before {
        content: 'sort';
        opacity: 0.1;
    }

    .dataTables_wrapper .dataTables_info {
        margin-top: 1.42857em;
    }

    .dataTables_wrapper .dataTables_paginate {
        margin-top: 2.14286em;
        padding: 0;
        border: 0.0625rem solid #eee;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
        border: 0;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: none;
        border: 0;
        color: #999 !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:focus {
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #337AB6;
        border: 0;
        border-radius: 0;
        color: #fff !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #286090;
        border: 0;
        color: #fff !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.next,
    .dataTables_wrapper .dataTables_paginate .paginate_button.previous {
        border: 0;
    }
</style>
@endsection
@section('content')
    @if (session('status'))
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            </div>
        </div>
    @endif

    @if (session('status-danger'))
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    {{ session('status-danger') }}
                </div>
            </div>
        </div>
    @endif

    <div class="col-md-2">
        <a href="{{ route('customer.index') }}"
            class="h4 px-4 py-2 bg-primary text-white b-shadow  text-center d-flex align-items-center back-button rounded-custom">
            <i class="feather feather-arrow-left align-self-center pr-1"></i>Kundenliste</b>
        </a>
    </div>
    <div class="col-12 col-md-12 mr-b-30 mt-5">

        <ul class="nav nav-tabs contact-details-tab">

            <li class="nav-item" style=""><a href="#profile-tab-bordered-1"
                    class="nav-link
        @if (session('cat') != 'Offerte' && session('cat') != 'Termine' && session('cat') != 'Rechnung' && session('cat') != 'Quittung') active @endif" data-toggle="tab"
                    aria-expanded="true">Profil</a>
            </li>
            @if (in_array(Auth::user()->permName, ['superAdmin', 'chef', 'officer']))
                <li class="nav-item" style=""><a href="#offer-tab-bordered-1"
                        class="nav-link @if (session('cat') == 'Offerte') active @endif" data-toggle="tab"
                        aria-expanded="false">Offerte</a>
                </li>
            @endif

            @if (in_array(Auth::user()->permName, ['superAdmin', 'chef', 'officer']))
                <li class="nav-item" style=""><a href="#appointment-tab-bordered-1"
                        class="nav-link @if (session('cat') == 'Termine') active @endif" data-toggle="tab"
                        aria-expanded="false">Termine</a>
                </li>
            @endif

            @if (in_array(Auth::user()->permName, ['superAdmin', 'chef', 'officer']))
                <li class="nav-item " style=""><a href="#fatura-tab-bordered-1"
                        class="nav-link @if (session('cat') == 'Rechnung') active @endif" data-toggle="tab"
                        aria-expanded="false">Rechnungen</a>
                </li>
            @endif

            @if (in_array(Auth::user()->permName, ['superAdmin', 'chef', 'officer']))
                <li class="nav-item " style=""><a href="#makbuz-tab-bordered-1"
                        class="nav-link @if (session('cat') == 'Quittung') active @endif" data-toggle="tab"
                        aria-expanded="false">Quittungen</a>
                </li>
            @endif
            @if (in_array(Auth::user()->permName, ['superAdmin', 'chef', 'officer']))
                <li class="nav-item " style=""><a href="#notiz-tab-bordered-1"
                        class="nav-link @if (session('cat') == 'Notiz') active @endif" data-toggle="tab"
                        aria-expanded="false"> Notiz  @if (strlen($data[0]['note']) > 1)
                        <span class="badge badge-pill badge-success" style="border-radius: 100%">✓</span>
                    @endif</a>

                </li>
            @endif

        </ul>
        <div class="tab-content">

            <!-- /.tab-pane Müşteri Profili -->
            <div role="tabpanel" class="tab-pane @if (session('cat') != 'Offerte' && session('cat') != 'Termine' && session('cat') != 'Rechnung' && session('cat') != 'Quittung') active @endif "
                id="profile-tab-bordered-1" aria-expanded="false">

                <div class="contact-details-profile ">
                    <div class="row">
                        <div class="col-md-9">
                            <h5 class="mr-b-20"> Kunde : <span
                                    class="color-color-scheme font-weight-bold">{{ $data[0]['name'] }}</span></h5>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('customer.edit', ['id' => $data[0]['id']]) }}"
                                class="btn btn-color-scheme d-flex justify-content-center">
                                <i class="feather feather-edit"></i> <span class="pl-1">Kunden Bearbeiten</span>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="contact-details-cell"><small
                                    class="heading-font-family fw-500 text-dark">Name / Vorname</small> <span
                                    class="text-primary">{{ $data[0]['name'] }} {{ $data[0]['surname'] }}</span>
                            </div>
                            <!-- /.contact-details-cell -->
                        </div>
                        <!-- /.col-md-6 -->
                        <div class="col-md-6">
                            <div class="contact-details-cell"><small
                                    class="heading-font-family fw-500 text-dark">E-mail</small> <span
                                    class="text-primary">{{ $data[0]['email'] }}</span>
                            </div>
                            <!-- /.contact-details-cell -->
                        </div>
                        <div class="col-md-6">
                            <div class="contact-details-cell"><small
                                    class="heading-font-family fw-500 text-dark">Anrede</small> <span class="text-primary">
                                    @if ($data[0]['gender'] == 'male')
                                        Herr
                                    @else
                                        Frau
                                    @endif
                                </span>
                            </div>
                            <!-- /.contact-details-cell -->
                        </div>
                        <!-- /.col-md-6 -->
                        <div class="col-md-6">
                            <div class="contact-details-cell"><small
                                    class="heading-font-family fw-500 text-dark">Telefon</small> <span
                                    class="text-primary">{{ $data[0]['phone'] }}</span>
                            </div>
                            <!-- /.contact-details-cell -->
                        </div>
                        <div class="col-md-6">
                            <div class="contact-details-cell"><small
                                    class="heading-font-family fw-500 text-dark">Mobil</small> <span
                                    class="text-primary">{{ $data[0]['mobile'] }}</span>
                            </div>
                            <!-- /.contact-details-cell -->
                        </div>
                        <!-- /.col-md-6 -->
                        <div class="col-md-6">
                            <div class="contact-details-cell"><small
                                    class="heading-font-family fw-500 text-dark">Strasse</small> <span
                                    class="text-primary">{{ $data[0]['street'] }}</span>
                            </div>
                            <!-- /.contact-details-cell -->
                        </div>

                        <div class="col-md-6">
                            <div class="contact-details-cell"><small
                                    class="heading-font-family fw-500 text-dark">PLZ</small> <span
                                    class="text-primary">{{ $data[0]['postCode'] }}</span>
                            </div>
                            <!-- /.contact-details-cell -->
                        </div>

                        <div class="col-md-6">
                            <div class="contact-details-cell"><small
                                    class="heading-font-family fw-500 text-dark">Ort</small> <span
                                    class="text-primary">{{ $data[0]['Ort'] }}</span>
                            </div>
                            <!-- /.contact-details-cell -->
                        </div>

                        <div class="col-md-6">
                            <div class="contact-details-cell"><small
                                    class="heading-font-family fw-500 text-dark">Land</small> <span
                                    class="text-primary">{{ $data[0]['country'] }}</span>
                            </div>
                            <!-- /.contact-details-cell -->
                        </div>

                        <div class="col-md-6">
                            <div class="contact-details-cell"><small
                                    class="heading-font-family fw-500 text-dark">Kundenquelle</small> <span
                                    class="text-primary">{{ $data[0]['source1'] }}</span>
                            </div>
                            <!-- /.contact-details-cell -->
                        </div>

                        <div class="col-md-6">
                            <div class="contact-details-cell"><small class="heading-font-family fw-500 text-dark">Andere
                                    Quelle</small> <span class="text-primary">{{ $data[0]['source2'] }}</span>
                            </div>
                            <!-- /.contact-details-cell -->
                        </div>

                    </div>
                </div>

            </div>
            <!-- /.tab-pane Teklifler -->
            <div role="tabpanel" class="tab-pane @if (session('cat') == 'Offerte') active @endif"
                id="offer-tab-bordered-1"
                @if (session('cat') == 'Offerte') aria-expanded="true" @else aria-expanded="false" @endif>
                <div class="contact-details-profile ">
                    <div class="row">
                        <div class="col-md-9">
                            <h5 class="mr-b-20">Kunde : <span
                                    class="color-color-scheme font-weight-bold">{{ $data[0]['name'] }}</span> </h5>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('offer.create', ['id' => $data[0]['id']]) }}"
                                class="btn btn-color-scheme d-flex justify-content-center">
                                <i class="feather feather-plus"></i> <span class="pl-1"> Neue Offerte erfassen</span>
                            </a>
                        </div>
                    </div>


                    <div class="widget-list">
                        <div class="row">
                            <div class="col-md-12 widget-holder">
                                <div class="widget-bg">
                                    <div class="widget-heading clearfix">
                                        <h5>Offerten
                                        </h5>
                                    </div>
                                    <!-- /.widget-heading -->
                                    <div class="widget-body clearfix">
                                        <table id="example3" class="table table-striped table-responsive">
                                            <thead>
                                                <tr class="text-dark">
                                                    <th>Offertennr</th>
                                                    <th>Erstellt am</th>
                                                    <th>Services</th>
                                                    <th>Stand</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    <!-- /.widget-body -->
                                </div>
                                <!-- /.widget-bg -->
                            </div>
                            <!-- /.widget-holder -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>

            <!-- /.tab-pane Randevular -->
            <div role="tabpanel" class="tab-pane  @if (session('cat') == 'Termine') active @endif"
                id="appointment-tab-bordered-1" aria-expanded="false">

                <div class="contact-details-profile ">
                    <div class="row">
                        <div class="col-md-9">
                            <h5 class="mr-b-20">Kunde : <span
                                    class="color-color-scheme font-weight-bold">{{ $data[0]['name'] }}</span> </h5>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('appointment.create', ['id' => $data[0]['id']]) }}"
                                class="btn btn-color-scheme d-flex justify-content-center">
                                <i class="feather feather-plus"></i> <span class="pl-1">Neuen Termin erfassen</span>
                            </a>
                        </div>
                    </div>


                    <div class="widget-list">
                        <div class="row">
                            <div class="col-md-12 widget-holder">
                                <div class="widget-bg">
                                    <div class="widget-heading clearfix">
                                        <h5>Termine
                                        </h5>
                                    </div>
                                    <!-- /.widget-heading -->
                                    <div class="widget-body clearfix">

                                        <table id="appointmentTable" class="table table-striped table-responsive">
                                            <thead>
                                                <tr class="text-dark">
                                                    <th>Dienstleistung</th>
                                                    <th>Wo</th>
                                                    <th>Datum</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    <!-- /.widget-body -->
                                </div>
                                <!-- /.widget-bg -->
                            </div>
                            <!-- /.widget-holder -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>

            <!-- /.tab-pane Faturalar -->
            <div role="tabpanel" class="tab-pane @if (session('cat') == 'Rechnung') active @endif" id="fatura-tab-bordered-1" aria-expanded="false">
                <div class="contact-details-profile ">
                    <div class="row">
                        <div class="col-md-9">
                            <h5 class="mr-b-20">Kunde : <span
                                    class="color-color-scheme font-weight-bold">{{ $data[0]['name'] }}</span> </h5>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('invoice.create', ['id' => $data[0]['id']]) }}"
                                class="btn btn-color-scheme d-flex justify-content-center">
                                <i class="feather feather-plus"></i> <span class="pl-1">Neue Rechnung erstellen</span>
                            </a>
                        </div>
                    </div>

                    <div class="widget-list">
                        <div class="row">
                            <div class="col-md-12 widget-holder">
                                <div class="widget-bg">
                                    <div class="widget-heading clearfix">
                                        <h5>Rechnungen
                                        </h5>
                                    </div>
                                    <!-- /.widget-heading -->
                                    <div class="widget-body clearfix">

                                        <table id="example4" class="table table-striped table-responsive">
                                            <thead>
                                                <tr class="text-dark">
                                                    <th>Rechnungsnr</th>
                                                    <th>Erstellt am</th>
                                                    <th>Fälligkeit am</th>
                                                    <th>Services</th>
                                                    <th>Betrag Total</th>
                                                    <th>Status</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    <!-- /.widget-body -->
                                </div>
                                <!-- /.widget-bg -->
                            </div>
                            <!-- /.widget-holder -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>

            <!-- /.tab-pane Makbuzlar -->
            <div role="tabpanel" class="@if (session('cat') == 'Quittung') active @endif tab-pane" id="makbuz-tab-bordered-1" aria-expanded="false">
                <div class="contact-details-profile ">
                    <div class="row">
                        <div class="col-md-9">
                            <h5 class="mr-b-20">Kunde : <span
                                    class="color-color-scheme font-weight-bold">{{ $data[0]['name'] }}</span> </h5>
                        </div>
                    </div>

                    <div class="widget-list">
                        <div class="row">
                            <div class="col-md-12 widget-holder">
                                <div class="widget-bg">
                                    <div class="widget-heading clearfix">
                                        <h5>Quittungen</h5>
                                    </div>
                                    <!-- /.widget-heading -->
                                    <div class="widget-body clearfix">
                                        <table id="makbuz" class="table table-striped table-responsive">
                                            <thead>
                                                <tr class="text-dark">
                                                    <th>Quittungsnr</th>
                                                    <th>Quittungsart</th>
                                                    <th>Auftragstermin</th>
                                                    <th>Erstellt am</th>
                                                    <th>Betrag</th>
                                                    <th>Zahlungsart</th>
                                                    <th>Status</th>
                                                    @if (in_array(Auth::user()->permName, ['superAdmin']))
                                                    <th>Quittung Erhalten</th>
                                                    @endif
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    <!-- /.widget-body -->
                                </div>
                                <!-- /.widget-bg -->
                            </div>
                            <!-- /.widget-holder -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>

            {{-- Müşteri Notu --}}
            <!-- /.tab-pane Müşteri Profili -->
            <div role="tabpanel" class="tab-pane"
                id="notiz-tab-bordered-1" aria-expanded="false">

                <div class="contact-details-profile ">
                    <div class="row">
                        <div class="col-md-9">
                            <h5 class="mr-b-20"> Kunde : <span
                                    class="color-color-scheme font-weight-bold">{{ $data[0]['name'] }}</span></h5>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('customer.edit', ['id' => $data[0]['id']]) }}"
                                class="btn btn-color-scheme d-flex justify-content-center">
                                <i class="feather feather-edit"></i> <span class="pl-1">Kunden Bearbeiten</span>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-primary"></h5>
                            <div class="contact-details-cell">
                                <textarea id="customerNote" class="form-control" name="" id="" cols="30" rows="10">{{ $data[0]['note'] }}</textarea>

                            </div>
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-center">
                                    <a href="#" class="btn btn-success" onclick="updateCustomerNote()">Erstellen</a>
                                </div>
                            </div>
                            <!-- /.contact-details-cell -->
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                </div>

            </div>
        </div>
        <!-- /.tab-content -->

        {{-- <a href="{{ route('customer.reminderTest') }}">ReminderTest</a> --}}
        <a href="{{ route('offer.sendSms') }}">SMSTESTER</a>
    </div>
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
    <script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>

    <script>
        function updateCustomerNote()
        {
            var note = $('#customerNote').val();
            if(note)
            {
                $.ajax({
                    url: '{{ route('customer.updateNote', ['id' => $data[0]['id']]) }}',
                    headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                    type: 'POST',
                    dataType: 'json',
                    data: {
                    '_token': '{{ csrf_token() }}', // CSRF token
                    'note': note // noticeArea değeri
                    },
                    success: function (response) {
                        toastr.success('KUNDENNOTIZ AKTUALISIERT')
                    },
                    error: function (response) {
                        toastr.error(response,'FEHLER! KUNDENNOTIZ KONNTE NICHT AKTUALISIERT WERDEN')
                        console.log(response,'Müşteri Notu Güncellenemedi')
                    }
                })
            }
            else{
                toastr.error('FELD DARF NICHT LEER BLEIBEN')
            }
        }
    </script>
    {{-- Makbuz --}}
    @if (in_array(Auth::user()->permName, ['superAdmin', 'chef', 'officer']))
        <script>
            $(document).ready(function() {
                const userPerm = "{{ Auth::user()->permName }}";
                console.log(userPerm);

                let columns = [
                    {
                        data: 'makbuzNo',
                        name: 'makbuzNo',
                        width: '10%'
                    },
                    {
                        data: 'receiptType',
                        name: 'receiptType',
                        width: '10%'
                    },
                    {
                        data: 'orderDate',
                        name: 'orderDate',
                        width: '10%'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        width: '12%'
                    },
                    {
                        data: 'tutar',
                        name: 'tutar',
                        width: '7%'
                    },
                    {
                        data: 'payType',
                        name: 'payType',
                        width: '7%'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        width: '7%'
                    },
                    {
                        data: 'option',
                        name: 'detail',
                        orderable: false,
                        searchable: false,
                        exportable: false
                    }
                ];

                // Eğer kullanıcı superAdmin ise 'docTaken' sütununu ekle
                if (userPerm.includes('superAdmin')) {
                    columns.splice(-1, 0, {
                    data: 'docTaken',
                    name: 'docTaken',
                    searchable: false,
                    width: '10%',
                });
                }

                let table = $('#makbuz').DataTable({
                    "order": [0, 'desc'],
                    lengthMenu: [
                        [25, 100, -1],
                        [25, 100, "All"]
                    ],
                    dom: 'Blfrtip',
                    buttons: [
                        'copy',
                        'excel',
                        'pdf',
                    ],
                    processing: true,
                    serverSide: true,
                    language: {
                        'emptyTable': 'Keine gespeicherte Angaben'
                    },
                    ajax: {
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        url: '{{ route('receipt.data', ['id' => $data[0]['id']]) }}',
                        data: function(d) {
                            d.startDate = $('#datepicker_from').val();
                            d.endDate = $('#datepicker_to').val();
                        }
                    },
                    columns: columns,
                    "language": {
                        "paginate": {
                            "previous": "Vorherige",
                            "next" : "Nächste"
                        },
                        "search" : "Suche",
                        "lengthMenu": "_MENU_ Einträge pro Seite anzeigen",
                        "zeroRecords": "Nichts gefunden - es tut uns leid",
                        "info": "Zeige Seite _PAGE_ von _PAGES_",
                        "infoEmpty": "Keine Einträge verfügbar",
                        "infoFiltered": "(aus insgesamt _MAX_ Einträgen gefiltert)",
                    },
                });

                jQuery.fn.DataTable.ext.type.search.string = function(data) {
                    var testd = !data ?
                        '' :
                        typeof data === 'string' ?
                        data
                        .replace(/i/g, 'İ')
                        .replace(/ı/g, 'I') :
                        data;
                    return testd;
                };

                $('#example_filter input').keyup(function() {
                    table
                        .search(
                            jQuery.fn.DataTable.ext.type.search.string(this.value)
                        )
                        .draw();
                });
            });
            </script>

        <script>
            function docTaken(id, type) {
            if (confirm("Are you sure you want to change the docTaken?")) {
                confirmAndChange(id, type);
            }
        }
        </script>

        <script>
            function confirmAndChange(id,type){
            let table= $('#makbuz').DataTable();

            console.log(id,type);
                $.ajax({
                    type:'POST',
                    headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                    url: '{{ route('receipt.docTaken', ['id' => ':id', 'type' => ':type']) }}'.replace(':id', id).replace(':type', type),
                    success: function(response) {
                        table.draw();
                    },
                    error: function(xhr, status, error) {
                        // handle error response
                    }
                });
            }
        </script>
    @endif

    {{-- Fatura --}}
    @if (in_array(Auth::user()->permName, ['superAdmin', 'chef', 'officer']))
        <script>
            $(document).ready(function() {
                let table = $('#example4').DataTable({

                    lengthMenu: [
                        [25, 100, -1],
                        [25, 100, "All"]
                    ],
                    dom: 'Blfrtip',
                    buttons: [
                        'copy',
                        'excel',
                        'pdf',
                    ],
                    processing: true,
                    serverSide: true,
                    language: {
                        'emptyTable': 'Keine gespeicherte Angaben'
                    },
                    ajax: {
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        url: '{{ route('invoice.data', ['id' => $data[0]['id']]) }}',
                        data: function(d) {
                            d.startDate = $('#datepicker_from').val();
                            d.endDate = $('#datepicker_to').val();
                        }
                    },
                    columns: [

                        {
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'expiryDate',
                            name: 'expiryDate'
                        },
                        {
                            data: 'services',
                            name: 'services',
                            orderable: false,
                            searchable: false,
                            exportable: false
                        },
                        {
                            data: 'totalPrice',
                            name: 'totalPrice'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'option',
                            name: 'detail',
                            orderable: false,
                            searchable: false,
                            exportable: false
                        },

                    ],
                    "language": {
                    "paginate": {
                        "previous": "Vorherige",
                        "next" : "Nächste"
                    },
                    "search" : "Suche",
                    "lengthMenu": "_MENU_ Einträge pro Seite anzeigen",
                    "zeroRecords": "Nichts gefunden - es tut uns leid",
                    "info": "Zeige Seite _PAGE_ von _PAGES_",
                    "infoEmpty": "Keine Einträge verfügbar",
                    "infoFiltered": "(aus insgesamt _MAX_ Einträgen gefiltert)",

                },
                });
                jQuery.fn.DataTable.ext.type.search.string = function(data) {
                    var testd = !data ?
                        '' :
                        typeof data === 'string' ?
                        data
                        .replace(/i/g, 'İ')
                        .replace(/ı/g, 'I') :
                        data;
                    return testd;
                };
                $('#example_filter input').keyup(function() {
                    table
                        .search(
                            jQuery.fn.DataTable.ext.type.search.string(this.value)
                        )
                        .draw();
                });

            });
        </script>
    @endif

    {{-- Teklifler --}}
    @if (in_array(Auth::user()->permName, ['superAdmin', 'chef', 'officer']))
        <script>
            $(document).ready(function() {
                let table = $('#example3').DataTable({

                    // En Yenisi en başta olacak şekilde sıralama
                    "order": [0, 'desc'],
                    "columnDefs": [{
                            "className": "dt-center",
                            "targets": 3,
                            "createdCell": function(td, cellData, rowData, row, col) {
                                if (cellData == 'Onaylandı') {
                                    $(td).html(
                                        '<span class="bg-custom-success px-3 py-1 text-center shadow" >Bestätigt <i class="text-center feather feather-check-circle pl-1"></i></span>'
                                    )
                                } else if (cellData == 'Beklemede') {

                                    $(td).html(
                                        '<span class="bg-custom-warning px-3 py-1 text-center shadow" >Offen<i class="text-center feather feather-alert-circle pl-1"></i></span>'
                                    )
                                } else if(cellData == 'Onaylanmadı') {
                                    $(td).html(
                                        '<span class="bg-custom-danger px-3 py-1 text-center shadow" >Abgesagt<i class="text-center feather feather-x-circle pl-1"></i></span>'
                                    )
                                }

                            }
                        },
                        {
                            "targets": 4,
                            "createdCell": function(td, cellData, rowData, row, col) {
                                $(td).css('vertical-align', 'middle');
                            }
                        }
                    ],
                    lengthMenu: [
                        [25, 100, -1],
                        [25, 100, "All"]
                    ],
                    dom: 'Blfrtip',
                    buttons: [
                        'copy',
                        'excel',
                        'pdf',
                    ],
                    processing: true,
                    serverSide: true,
                    language: {
                        'emptyTable': 'Keine gespeicherte Angaben'
                    },
                    ajax: {
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        url: '{{ route('offer.data', ['id' => $data[0]['id']]) }}',
                        data: function(d) {
                            d.startDate = $('#datepicker_from').val();
                            d.endDate = $('#datepicker_to').val();
                        }
                    },
                    columns: [

                        {
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'services',
                            name: 'services',
                            orderable: false,
                            searchable: true,
                            exportable: false
                        },
                        {
                            data: 'offerteStatus',
                            name: 'offerteStatus'
                        },
                        {
                            data: 'option',
                            name: 'option',
                            orderable: false,
                            searchable: false,
                            exportable: false
                        },

                    ],
                    "language": {
                    "paginate": {
                        "previous": "Vorherige",
                        "next" : "Nächste"
                    },
                    "search" : "Suche",
                    "lengthMenu": "_MENU_ Einträge pro Seite anzeigen",
                    "zeroRecords": "Nichts gefunden - es tut uns leid",
                    "info": "Zeige Seite _PAGE_ von _PAGES_",
                    "infoEmpty": "Keine Einträge verfügbar",
                    "infoFiltered": "(aus insgesamt _MAX_ Einträgen gefiltert)",

                },
                });
                jQuery.fn.DataTable.ext.type.search.string = function(data) {
                    var testd = !data ?
                        '' :
                        typeof data === 'string' ?
                        data
                        .replace(/i/g, 'İ')
                        .replace(/ı/g, 'I') :
                        data;
                    return testd;
                };
                $('#example_filter input').keyup(function() {
                    table
                        .search(
                            jQuery.fn.DataTable.ext.type.search.string(this.value)
                        )
                        .draw();
                });


            });
        </script>
    @endif


    {{-- Randevular --}}
    @if (in_array(Auth::user()->permName, ['superAdmin', 'chef', 'officer']))
        <script>
            $(document).ready(function() {
                let table = $('#appointmentTable').DataTable({

                    "order": [
                        [2, 'desc']
                    ],
                    lengthMenu: [
                        [25, 100, -1],
                        [25, 100, "All"]
                    ],
                    dom: 'Blfrtip',
                    buttons: [

                        'copy', 'excel', 'pdf',
                    ],
                    processing: true,
                    serverSide: true,
                    language: {
                        'emptyTable': 'Keine gespeicherte Angaben'
                    },
                    ajax: {
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        url: '{{ route('appointment.data', ['id' => $data[0]['id']]) }}',
                        data: function(d) {
                            d.startDate = $('#datepicker_from').val();
                            d.endDate = $('#datepicker_to').val();
                        }
                    },
                    columns: [

                        {
                            data: 'appType',
                            name: 'appType'
                        },
                        {
                            data: 'adres',
                            name: 'adres'
                        },
                        {
                            data: 'tarih',
                            name: 'tarih'
                        },
                        {
                            data: 'option',
                            name: 'option',
                            orderable: false,
                            searchable: false,
                            exportable: false
                        },

                    ],
                    "language": {
                    "paginate": {
                        "previous": "Vorherige",
                        "next" : "Nächste"
                    },
                    "search" : "Suche",
                    "lengthMenu": "_MENU_ Einträge pro Seite anzeigen",
                    "zeroRecords": "Nichts gefunden - es tut uns leid",
                    "info": "Zeige Seite _PAGE_ von _PAGES_",
                    "infoEmpty": "Keine Einträge verfügbar",
                    "infoFiltered": "(aus insgesamt _MAX_ Einträgen gefiltert)",

                },
                });
                jQuery.fn.DataTable.ext.type.search.string = function(data) {
                    var testd = !data ?
                        '' :
                        typeof data === 'string' ?
                        data
                        .replace(/i/g, 'İ')
                        .replace(/ı/g, 'I') :
                        data;
                    return testd;
                };
                $('#example_filter input').keyup(function() {
                    table
                        .search(
                            jQuery.fn.DataTable.ext.type.search.string(this.value)
                        )
                        .draw();
                });
            });
        </script>
    @endif
@endsection
