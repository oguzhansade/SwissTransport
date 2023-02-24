@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">
    <style>
        .table{
            width:100%!important;
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
            color:white;
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
            /* box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset; */
        }
        .bg-custom-danger {
            color:white;
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
            /* box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset; */
        }

        .bg-custom-warning {
            color:white;
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
            /* box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset; */
        }
    </style>
@endsection
@section('content')

@if (session("status"))
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="alert alert-success">
                {{ session("status") }}
            </div>
        </div>
    </div>

@endif

@if (session("status-danger"))
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="alert alert-danger">
                {{ session("status-danger") }}
            </div>
        </div>
    </div>

@endif

<div class="col-12 col-md-12 mr-b-30 mt-5">
    <ul class="nav nav-tabs contact-details-tab">

        <li class="nav-item" style=""><a href="#profile-tab-bordered-1" class="nav-link active" data-toggle="tab" aria-expanded="true">Profil</a>
        </li>
        @if (App\Models\UserPermission::getMyControl(9))  
        <li class="nav-item" style=""><a href="#offer-tab-bordered-1" class="nav-link" data-toggle="tab" aria-expanded="false">Offerte</a>
        </li> 
        @endif

        @if (App\Models\UserPermission::getMyControl(6)) 
        <li class="nav-item" style=""><a href="#appointment-tab-bordered-1" class="nav-link" data-toggle="tab" aria-expanded="false">Termine</a>
        </li>
        @endif

        @if (App\Models\UserPermission::getMyControl(10)) 
        <li class="nav-item" style=""><a href="#fatura-tab-bordered-1" class="nav-link" data-toggle="tab" aria-expanded="false">Rechnungen</a>
        </li>
        @endif

        @if (App\Models\UserPermission::getMyControl(11)) 
        <li class="nav-item" style=""><a href="#makbuz-tab-bordered-1" class="nav-link" data-toggle="tab" aria-expanded="false">Quittungen</a>
        </li>
        @endif
        
    </ul>
    <div class="tab-content">

        <!-- /.tab-pane Müşteri Profili -->
        <div role="tabpanel" class="tab-pane active " id="profile-tab-bordered-1" aria-expanded="true" >
            
            <div class="contact-details-profile ">
                <div class="row">
                    <div class="col-md-9">
                        <h5 class="mr-b-20"> Kunde : <span class="color-color-scheme font-weight-bold">{{ $data[0]['name'] }}</span></h5>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('customer.edit',['id' => $data[0]['id']]) }}" class="btn btn-color-scheme d-flex justify-content-center">
                            <i class="feather feather-edit"></i> <span class="pl-1">Kunden Bearbeiten</span>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-details-cell"><small class="heading-font-family fw-500 text-dark">Vorname</small>  <span class="text-primary">{{$data[0]['name']}} {{$data[0]['surname']}}</span>
                        </div>
                        <!-- /.contact-details-cell -->
                    </div>
                    <!-- /.col-md-6 -->
                    <div class="col-md-6">
                        <div class="contact-details-cell"><small class="heading-font-family fw-500 text-dark">E-mail</small>  <span class="text-primary">{{$data[0]['email']}}</span>
                        </div>
                        <!-- /.contact-details-cell -->
                    </div>
                    <div class="col-md-6">
                        <div class="contact-details-cell"><small class="heading-font-family fw-500 text-dark">Anrede</small>  <span class="text-primary">@if($data[0]['gender'] == 'male') Herr @else Frau @endif</span>
                        </div>
                        <!-- /.contact-details-cell -->
                    </div>
                    <!-- /.col-md-6 -->
                    <div class="col-md-6">
                        <div class="contact-details-cell"><small class="heading-font-family fw-500 text-dark">Telefon</small>  <span class="text-primary">{{$data[0]['phone']}}</span>
                        </div>
                        <!-- /.contact-details-cell -->
                    </div>
                    <div class="col-md-6">
                        <div class="contact-details-cell"><small class="heading-font-family fw-500 text-dark">Mobil</small>  <span class="text-primary">{{$data[0]['mobile']}}</span>
                        </div>
                        <!-- /.contact-details-cell -->
                    </div>
                    <!-- /.col-md-6 -->
                    <div class="col-md-6">
                        <div class="contact-details-cell"><small class="heading-font-family fw-500 text-dark">Strasse</small>  <span class="text-primary">{{$data[0]['street']}}</span>
                        </div>
                        <!-- /.contact-details-cell -->
                    </div>

                    <div class="col-md-6">
                        <div class="contact-details-cell"><small class="heading-font-family fw-500 text-dark">PLZ</small>  <span class="text-primary">{{$data[0]['postCode']}}</span>
                        </div>
                        <!-- /.contact-details-cell -->
                    </div>
                    
                    <div class="col-md-6">
                        <div class="contact-details-cell"><small class="heading-font-family fw-500 text-dark">Ort</small>  <span class="text-primary">{{$data[0]['Ort']}}</span>
                        </div>
                        <!-- /.contact-details-cell -->
                    </div>

                    <div class="col-md-6">
                        <div class="contact-details-cell"><small class="heading-font-family fw-500 text-dark">Land</small>  <span class="text-primary">{{$data[0]['country']}}</span>
                        </div>
                        <!-- /.contact-details-cell -->
                    </div>

                    <div class="col-md-6">
                        <div class="contact-details-cell"><small class="heading-font-family fw-500 text-dark">Kundenquelle</small>  <span class="text-primary">{{$data[0]['source1']}}</span>
                        </div>
                        <!-- /.contact-details-cell -->
                    </div>

                    <div class="col-md-6">
                        <div class="contact-details-cell"><small class="heading-font-family fw-500 text-dark">Andere Quelle</small>  <span class="text-primary">{{$data[0]['source2']}}</span>
                        </div>
                        <!-- /.contact-details-cell -->
                    </div>

                    <div class="col-md-6">
                        <div class="contact-details-cell"><small class="heading-font-family fw-500 text-dark">Notiz</small>  <span class="text-primary">{{$data[0]['note']}}</span>
                        </div>
                        <!-- /.contact-details-cell -->
                    </div>
                    <!-- /.col-md-6 -->
                </div>
            </div>
            
        </div>
        <!-- /.tab-pane Teklifler -->
        <div role="tabpanel" class="tab-pane" id="offer-tab-bordered-1" aria-expanded="false">
            <div class="contact-details-profile ">
                <div class="row">
                    <div class="col-md-9">
                        <h5 class="mr-b-20">Kunde : <span class="color-color-scheme font-weight-bold">{{ $data[0]['name'] }}</span> </h5>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('offer.create',['id' => $data[0]['id']]) }}" class="btn btn-color-scheme d-flex justify-content-center">
                            <i class="feather feather-plus"></i> <span class="pl-1"> Neue Offerte erfassen</span>
                        </a>
                    </div>
                </div>
                
                
                <div class="widget-list" >
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
        <div role="tabpanel" class="tab-pane" id="appointment-tab-bordered-1" aria-expanded="false">
            
            <div class="contact-details-profile ">
                <div class="row">
                    <div class="col-md-9">
                        <h5 class="mr-b-20">Kunde : <span class="color-color-scheme font-weight-bold">{{ $data[0]['name'] }}</span> </h5>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('appointment.create',['id' => $data[0]['id']]) }}" class="btn btn-color-scheme d-flex justify-content-center">
                            <i class="feather feather-plus"></i> <span class="pl-1">Neuen Termin erfassen</span>
                        </a>
                    </div>
                </div>
                
              
                <div class="widget-list" >
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
        <div role="tabpanel" class="tab-pane" id="fatura-tab-bordered-1" aria-expanded="false">
            <div class="contact-details-profile ">
                <div class="row">
                    <div class="col-md-9">
                        <h5 class="mr-b-20">Kunde : <span class="color-color-scheme font-weight-bold">{{ $data[0]['name'] }}</span> </h5>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('invoice.create',['id' => $data[0]['id']]) }}" class="btn btn-color-scheme d-flex justify-content-center">
                            <i class="feather feather-plus"></i> <span class="pl-1">Neue Rechnung erstellen</span>
                        </a>
                    </div>
                </div>
                
                <div class="widget-list" >
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
        <div role="tabpanel" class="tab-pane" id="makbuz-tab-bordered-1" aria-expanded="false">
            <div class="contact-details-profile ">
                <div class="row">
                    <div class="col-md-9">
                        <h5 class="mr-b-20">Kunde : <span class="color-color-scheme font-weight-bold">{{ $data[0]['name'] }}</span> </h5>
                    </div>
                </div>
                
                <div class="widget-list" >
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
                                                <th>Quittung erstellt am</th>
                                                <th>Betrag</th>
                                                <th>Zahlungsart</th>
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
    </div>
    <!-- /.tab-content -->
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


{{-- Makbuz --}}
@if (App\Models\UserPermission::getMyControl(11))
<script>
    $(document).ready(function() {
        let table =  $('#makbuz').DataTable( {
            lengthMenu: [[25, 100, -1], [25, 100, "All"]],
            dom: 'Blfrtip',                                 
            buttons: [
                'copy',
                'excel',
                'pdf',
            ],
            processing: true,
            serverSide: true,
            language:{
                'emptyTable': 'Görüntülenecek Veri Yok'
            },
            ajax: {
                type:'POST',
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                url: '{{route('receipt.data',['id' => $data[0]['id']])}}',
                data: function (d) {
                    d.startDate = $('#datepicker_from').val();
                    d.endDate = $('#datepicker_to').val();
                }
            },
            columns: [
                
                { data:'makbuzNo', name:'makbuzNo' },
                { data:'receiptType', name:'receiptType' },
                { data:'orderDate', name:'orderDate' },
                { data:'created_at', name:'created_at'},
                { data:'tutar', name:'tutar'},
                { data:'payType', name:'payType'},
                { data:'status', name:'status'},
                { data: 'option', name: 'detail', orderable: false, searchable: false,exportable:false },

            ]
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

{{-- Fatura --}}
@if (App\Models\UserPermission::getMyControl(10))
<script>
    $(document).ready(function() {
        let table =  $('#example4').DataTable( {
            lengthMenu: [[25, 100, -1], [25, 100, "All"]],
            dom: 'Blfrtip',                                 
            buttons: [
                'copy',
                'excel',
                'pdf',
            ],
            processing: true,
            serverSide: true,
            language:{
                'emptyTable': 'Görüntülenecek Veri Yok'
            },
            ajax: {
                type:'POST',
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                url: '{{route('invoice.data',['id' => $data[0]['id']])}}',
                data: function (d) {
                    d.startDate = $('#datepicker_from').val();
                    d.endDate = $('#datepicker_to').val();
                }
            },
            columns: [
                
                { data:'id', name:'id' },
                { data:'created_at', name:'created_at'},
                { data:'expiryDate', name:'expiryDate'},
                { data:'services', name:'services',orderable: false, searchable: false,exportable:false},
                { data:'totalPrice', name:'totalPrice'},
                { data:'status', name:'status'},
                { data: 'option', name: 'detail', orderable: false, searchable: false,exportable:false },

            ]
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
@if (App\Models\UserPermission::getMyControl(9))
<script>
    $(document).ready(function() {
        let table =  $('#example3').DataTable( {
            // En Yenisi en başta olacak şekilde sıralama
            "order" : [[1,'desc']], 
            "columnDefs": [ 
                {
                    "className": "dt-center",
                    "targets": 3,
                    "createdCell": function (td, cellData, rowData, row, col) {
                        if ( cellData == 'Onaylandı' ) {
                            $(td).css('vertical-align','middle');
                            $(td).html('<span class="bg-custom-success px-3 py-1 text-center shadow" >Bestätigt <i class="text-center feather feather-check-circle pl-1"></i></span>')
                        }
                        else if(cellData == 'Beklemede'){
                            $(td).css('vertical-align','middle');
                            $(td).html('<span class="bg-custom-warning px-3 py-1 text-center shadow" >in Wartestellung<i class="text-center feather feather-alert-circle pl-1"></i></span>')
                        }
                        else{
                            $(td).css('vertical-align','middle');
                            $(td).html('<span class="bg-custom-danger px-3 py-1 text-center shadow" >Nicht Bestätigt<i class="text-center feather feather-x-circle pl-1"></i></span>')
                        }
                        
                    }
                },
                {
                        "targets": 4,
                        "createdCell": function (td, cellData, rowData, row, col) {
                                $(td).css('vertical-align','middle');
                        }
                }
            ],
            lengthMenu: [[25, 100, -1], [25, 100, "All"]],
            dom: 'Blfrtip',                                 
            buttons: [
                'copy',
                'excel',
                'pdf',
            ],
            processing: true,
            serverSide: true,
            language:{
                'emptyTable': 'Görüntülenecek Veri Yok'
            },
            ajax: {
                type:'POST',
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                url: '{{route('offer.data',['id' => $data[0]['id']])}}',
                data: function (d) {
                    d.startDate = $('#datepicker_from').val();
                    d.endDate = $('#datepicker_to').val();
                }
            },
            columns: [
                
                { data:'id', name:'id' },
                { data:'created_at', name:'created_at'},
                { data:'services', name:'services',orderable: false, searchable: false,exportable:false},
                { data:'offerteStatus', name:'offerteStatus'},
                { data: 'option', name: 'option', orderable: false, searchable: false,exportable:false },

            ]
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
@if (App\Models\UserPermission::getMyControl(6))
<script>
    $(document).ready(function() {
        let table =  $('#appointmentTable').DataTable( {
            lengthMenu: [[25, 100, -1], [25, 100, "All"]],
            dom: 'Blfrtip',                                 
            buttons: [
               
                'copy',  'excel', 'pdf', 
            ],
            processing: true,
            serverSide: true,
            language:{
                'emptyTable': 'Görüntülenecek Veri Yok'
            },
            ajax: {
                type:'POST',
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                url: '{{route('appointment.data',['id' => $data[0]['id']])}}',
                data: function (d) {
                    d.startDate = $('#datepicker_from').val();
                    d.endDate = $('#datepicker_to').val();
                }
            },
            columns: [
                
                { data:'appType', name:'appType' },
                { data:'adres', name:'adres' },
                { data:'tarih', name:'tarih' },
                { data:'option', name:'option', orderable:false, searchable:false, exportable:false },

            ]
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