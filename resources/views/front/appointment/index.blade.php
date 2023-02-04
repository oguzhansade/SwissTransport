@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
 <!-- Page Title Area -->
 <div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Randevu Listesi</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Panel</a>
            </li>
            <li class="breadcrumb-item active">Randevu</li>
        </ol>
        {{-- <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Randevu Listesi</a>
        </div> --}}
    </div>
    <!-- /.page-title-right -->
</div>

<div class="widget-list">
    <div class="row">
        <div class="col-md-12 widget-holder">
            <div class="widget-bg">
                <div class="widget-heading clearfix">
                    <h5>Randevu Listesi
                    </h5>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body clearfix">
                    <table id="example" class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>Ad</th>
                                <th>Müşteri Tipi</th>
                                <th>Email</th>
                                <th>Telefon</th>
                                <th>Mobil</th>
                                <th>Detay</th>
                                <th>Düzenle</th>
                                <th>Sil</th>
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
                url: '{{route('appointment.data')}}',
                data: function (d) {
                    d.startDate = $('#datepicker_from').val();
                    d.endDate = $('#datepicker_to').val();
                }
            },
            columns: [
                { data:'address', name:'address' },
                { data:'date', name:'date' },
                { data:'time', name:'time' },
                { data:'calendarTitle', name:'calendarTitle' },
                { data:'calendarContent', name:'calendarContent' },
                { data:'emailContent', name:'emailContent' },
                { data: 'edit', name: 'edit', orderable: false, searchable: false },
                { data: 'delete', name: 'delete', orderable: false, searchable: false }

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