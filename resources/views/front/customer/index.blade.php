@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
 <!-- Page Title Area -->
 <div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Kundenliste</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Panel</a>
            </li>
            <li class="breadcrumb-item active">Kunden</li>
        </ol>
        {{-- <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Müşteri Listesi</a>
        </div> --}}
    </div>
    <!-- /.page-title-right -->
</div>

<div class="widget-list">
    <div class="row">
        <div class="col-md-12 widget-holder">
            <div class="widget-bg">
                <div class="widget-heading clearfix">
                        <div class="row">
                            <div class="col-md-12 d-flex">
                                <h5>Kundenliste</h5>
                            </div>
                        </div>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body clearfix">
                    {{-- <div id="date-range">
                        <table border="0" cellspacing="5" cellpadding="5">
                            <tbody>
                                <tr>
                                    <td>Minimum date:</td>
                                    <td><input type="date" id="start-date" name="min"></td>
                                </tr>
                            <tr>
                                <td>Maximum date:</td>
                                <td><input type="date" id="end-date" name="max"></td>
                            </tr>
                        </tbody></table>
                    </div> --}}
                    <table id="example" class="table table-striped table-responsive">
                        <thead>
                            <tr class="text-dark">
                                <th>Nachname</th>
                                <th>Vorname</th>
                                <th>Email</th>
                                <th>Mobil</th>
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
    
</script>
<script>
    $(document).ready(function() {
        let table =  $('#example').DataTable( {
            "order" : [[4,'desc']], 
            
            lengthMenu: [[25, 100, -1], [25, 100, "All"]],
            dom: 'Blfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 
            ],
            processing: true,
            serverSide: true,
            ajax: {
                type:'POST',
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                url: '{{route('customer.data')}}',
                data: function (d) {
                    d.startDate = $('#start-date').val();
                    d.endDate = $('#end-date').val();
                    return d
                }
            },
            columns: [
                { data: 'name', name: 'name' , searchable:true},
                { data: 'surname', name: 'surname' , searchable:true},
                { data:'email', name:'email' , searchable:true},
                { data:'mobile', name:'mobile' , searchable:true},
                { data:'created_at',name:'created_at', searchable:true},
                { data: 'option', name: 'option', orderable: false, searchable: false ,exportable:false},
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

        // Add event listener for date range filter
        $('#date-range').on('change', function() {
        table.draw();
        });
    });
    
</script>

@endsection