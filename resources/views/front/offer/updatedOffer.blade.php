@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">
    <style>
        .table{
            width:100%!important;
        }
        
        .rounded-custom {
        
        }
        .bg-custom-danger {
            color:white;
            background-color: #E6614F;
            border-radius: 35px;
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
        .bg-custom-success {
            color:white;
            background-color: #28A745;
            border-radius: 35px;
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
 <!-- Page Title Area -->
 <div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Offerteliste</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Panel</a>
            </li>
            <li class="breadcrumb-item active">Offerte</li>
        </ol>
        <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Offerteliste</a>
        </div>
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
        <div class="col-md-12 widget-holder">
            <div class="widget-bg">
                <div class="widget-heading clearfix">
                    <h5>Offerteliste <br>Offertennr: <span class="text-primary h4 "><strong>{{ $data['id'] }}</strong></span></h5>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body clearfix">
                    <table id="example" class="table table-striped table-responsive">
                        <thead>
                            <tr class="text-dark">
                                <th>Offertennr</th>
                                <th>Verändertes Datum</th>
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
<script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>


<script>
    $(document).ready(function() {
        let table =  $('#example').DataTable( {
            "columnDefs": [ 
                {
                    "className": "dt-center",
                    "targets": 3,
                    "createdCell": function (td, cellData, rowData, row, col) {
                        if ( cellData == 'Onaylandı' ) {
                            $(td).css('vertical-align','middle');
                            $(td).html('<span class="bg-custom-success px-3 py-1 text-center shadow" >Zugelassen <i class="text-center feather feather-check-circle"></i></span>')
                        }
                        else{
                            $(td).css('vertical-align','middle');
                            $(td).html('<span class="bg-custom-danger px-3 py-1 text-center shadow" >Nicht Bestätigt <i class="text-center feather feather-x-circle"></i></span>')
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
                url: '{{route('offer.updatedOffer',['customerId' => $data['customerId'],'id' => $data['id']])}}',
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

@endsection