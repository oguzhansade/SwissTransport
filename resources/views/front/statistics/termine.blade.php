@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <style>
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
        .shadow-custom {
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            border-radius: 30px;
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
        .custom-modal-dialog {
            max-width: 90%;
            width: auto;
        }

        .custom-modal-content {
            width: 100%;
        }

        #example {
            width: 100%;
        }

        table.table {
            width: 100%;
        }
        .dataTables_scrollBody
        {
        overflow-x:hidden !important;
        overflow-y:auto !important;
        }
        #notizTable {
            margin-top: 0px;
        }
        .dataTables_wrapper table.dataTable thead .sorting::before {
            opacity: 0;
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
@endsection
@section('content')

 <!-- Page Title Area -->
 <div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Statistiken</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Panel</a>
            </li>
            <li class="breadcrumb-item active">Termine</li>
        </ol>
        {{-- <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Müşteri Listesi</a>
        </div> --}}
    </div>
    <!-- /.page-title-right -->
</div>
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

<div class="widget-list">
    <div class="row">
        <div class="col-md-12 widget-holder">
            <div class="widget-bg">
                <div class="widget-heading clearfix">
                        <div class="row">
                            <div class="col-md-12 d-flex">
                                <h5>Termine Table</h5>
                            </div>
                        </div>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body clearfix">
                    <div class="row">
                        <div class="col-md-10" id="date-range">
                            <table border="0" class="text-dark" cellspacing="5" cellpadding="5" >
                                <tbody>
                                    <tr>
                                        <td><b class="test-dark">Erfasst</b></td>
                                        <td><input class="form-control" type="date" id="start_date" name="min_date"></td>
                                        <td><b class="test-dark">bis</b></td>
                                        <td><input class="form-control" type="date" id="end_date" name="max_date"></td>
                                        <td><button id="reset" class="btn btn-danger">Zurücksetzen</button></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <table border="0" class="text-dark mt-3" cellspacing="5" cellpadding="5" >
                                <tbody>
                                    <tr>
                                        <td>
                                            <b class="test-dark">AppType</b>
                                            <select class="form-control" name="appType" id="appType">
                                            <option value="Alle">Alle</option>
                                            <option value="1">Besichtigung</option>
                                            <option value="3">Auftragsbestätigung</option>
                                            <option value="2">Lieferung</option>
                                          </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                           
                        </div>
                        
                        <div class="col-md-2 ">
                            <div class="p-3 text-white bg-primary shadow-custom">
                                <table style="font-size:1rem">
                                    <tr>
                                        <td><span>Gefiltert</span></td>
                                        <td>: <span id="filteredTotal"></span></td>
                                
                                    </tr>
                                    <tr>
                                        <td><span>Ungefiltert</span></td>
                                        <td>: <span id="nonFilteredTotal"></span></td>
                                    </tr>
                                    <tr>
                                        <td><span>Offerte</span></td>
                                        <td>: <span id="filteredOfferte"></span></td>
                                    </tr>
                                    <tr>
                                        <td><span>Bestätigung</span></td>
                                        <td>: <span id="percentBestatig"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <table id="termineTable" class="table table-striped table-responsive">
                            <thead>
                                <tr class="text-dark">
                                    <th>termineId</th>
                                    <th>appType</th>
                                    <th>Wo</th>
                                    <th>CustomerId</th>
                                    <th>Datum</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" style="text-align:right">Total:</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
    </div>
    <!-- /.row -->
</div>
<!-- /.widget-list -->
@endsection
@section('footer')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>

<script>
    $(document).ready(function() {
        let table = $('#termineTable').DataTable({
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
                'emptyTable': 'Görüntülenecek Veri Yok'
            },
            ajax: {
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '{{ route('statistics.termineData') }}',
                data: function(d) {
                    d.min_date = $('#start_date').val();
                    d.max_date = $('#end_date').val();
                    d.appType = $('#appType').val();
                }
            },
            columns: [

                {data: 'id', name: 'id'},
                {data: 'appType', name: 'appType'},
                { data: 'adres', name: 'adres'},
                { data: 'customerId',name: 'customerId'},
                {data: 'tarih',name: 'tarih'},
                {data: 'option',name: 'option',orderable: false,searchable: false,exportable: false},

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

        $('#start_date, #end_date, #serviceType, #standType,#appType,#searchInput').on('change', function() {
            table.draw();
        });
        $('#reset').on('click', function() {
            $('#start_date').val('');
            $('#end_date').val('');
            $('#serviceType').val('Alle');
            $('#appType').val('Alle');
            $('#searchInput').val('');
            table.draw();
        });

    });
</script>

@endsection