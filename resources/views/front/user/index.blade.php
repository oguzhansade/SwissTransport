@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
       
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

 <!-- Page Title Area -->
<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Benutzerliste</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Panel</a>
            </li>
            <li class="breadcrumb-item active">Benutzer</li>
        </ol>
        {{-- <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Kullanıcı Listesi</a>
        </div> --}}
    </div>
    <!-- /.page-title-right -->
</div>

<div class="widget-list">
    <div class="row">
        <div class="col-md-12 widget-holder">
            <div class="widget-bg">
                <div class="widget-heading clearfix">
                    <h5>Benutzerliste
                    </h5>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body clearfix">
                    <table id="example" class="table table-striped table-responsive">
                        <thead>
                            <tr class="text-dark">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
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

<script>
    $(document).ready(function() {


        let table =  $('#example').DataTable( {
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
            lengthMenu: [[25, 100, -1], [25, 100, "All"]],
            /*
            dom: 'Blfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            */
            processing: true,
            serverSide: true,
            ajax: {
                type:'POST',
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                url: '{{route('user.data')}}',
                data: function (d) {
                    d.startDate = $('#datepicker_from').val();
                    d.endDate = $('#datepicker_to').val();
                }
            },
            columns: [
                { data: 'name', name: 'name'},
                { data: 'email', name: 'email'},
                { data: 'permName', name: 'permName'},
                { data: 'option', name: 'option', orderable: false, searchable: false },

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

@endsection