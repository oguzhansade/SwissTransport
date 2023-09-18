@section('header')
{{-- DataTable Stilleri --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet"
        type="text/css">
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
        border-color: #03a9f3;
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
        background: #8253eb;
        border: 0;
        border-radius: 0;
        color: #fff !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #6125e6;
        border: 0;
        color: #fff !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.next,
    .dataTables_wrapper .dataTables_paginate .paginate_button.previous {
        border: 0;
    }
</style>
{{-- DataTable Stilleri --}}

<style>
    .btn-detail {
        transition: all 0.3s ease;
        background-color: #337AB6;
        color:white;
    }
    .btn-detail:hover {
        color:white;
        background-color: #286090;
    }
</style>
@endsection
@if (App\Models\UserPermission::getMyControl(4))

@endif


@extends('layouts.app')
@section('content')
<!-- Page Title Area -->
<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">@if (App\Models\UserPermission::getMyControl(4)) Worker Panel @else Admin Panel @endif</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Panel</a>
            </li>
            <li class="breadcrumb-item active">Homepage</li>
        </ol>
    </div>
    <!-- /.page-title-right -->
</div>
<!-- /.page-title -->
<!-- =================================== -->
<!-- Different data widgets ============ -->
<!-- =================================== -->

@if (App\Models\UserPermission::getMyControl(4))

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Welcome <b>{{ App\Models\User::getUser(Auth::id(),'name') }}</b></h3>
        </div>
    </div>

    <div class="row">
        <a href="{{ route('workerPanel.index') }}">Tasks</a>
    </div>
</div>
@else
<h3>Willkommen im Admin-Panel Datenschutz: {{ \Carbon\Carbon::now() }}</h3>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1>Potentielle Kunden</h1>
        </div>
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

    <div class="row">
        <div class="col-md-12 widget-holder">
            <div class="widget-bg">
                <div class="widget-heading clearfix">
                    <h5>Kandidatenliste</h5>
                </div>
                <table border="0" class="text-dark" cellspacing="5" cellpadding="5" >
                    <tbody>
                        <tr>
                            <td><b class="test-dark ml-3">Erfasst</b></td>
                            <td><input class="form-control" type="date" id="start_date" name="min_date"></td>
                            <td><b class="test-dark">bis</b></td>
                            <td><input class="form-control" type="date" id="end_date" name="max_date"></td>
                            <td><button id="reset" class="btn btn-danger">Zurücksetzen</button></td>
                        </tr>
                       
                       
                    </tbody>
                </table>
                <!-- /.widget-heading -->
                <div class="widget-body clearfix">
                    <table id="example" class="table table-striped table-responsive">
                        <thead>
                            <tr class="text-dark">
                                <th>Name</th>
                                <th>E-Mail</th>
                                <th>Telefon</th>
                                <th>Formular-Typ</th>
                                <th>Datum</th>
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
</div>

@endif
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

    <script>
        $(document).ready(function() {
            let table = $('#example').DataTable({
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
                "order": [4, 'desc'],
                lengthMenu: [
                    [25, 100, -1],
                    [25, 100, "All"]
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: '{{ route('customerForms.data') }}',
                    data: function(d) {
                        d.min_date = $('#start_date').val();
                        d.max_date = $('#end_date').val();
                        return d
                    }
                },
                columns: [{
                        data: 'customerName',
                        name: 'customerName'
                    },
                    {
                        data: 'mail',
                        name: 'mail'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'option',
                        name: 'option',
                        orderable: false,
                        searchable: false
                    },
                ],

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

            $('#start_date, #end_date').on('change', function() {
                table.draw();
            });

            $('#reset').on('click', function() {
                $('#start_date').val('');
                $('#end_date').val('');
                table.draw();
            });
        });
    </script>

    {{-- <script>
        function statusChanger(id, type) {
            if (confirm("Are you sure you want to change the status?")) {
                confirmAndChange(id, type);
            }
        }
    </script>
    <script>
        function confirmAndChange(id,type){
        let table= $('#example').DataTable();
        
            console.log(id,type);
                $.ajax({
                    type:'POST',
                    headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                    url: '{{ route('offerList.statusChanger', ['id' => ':id', 'type' => ':type']) }}'.replace(':id', id).replace(':type', type),
                    success: function(response) {
                    table.draw();
                    },
                    error: function(xhr, status, error) {
                        // handle error response
                    }
                });
            }
    </script> --}}
@endsection