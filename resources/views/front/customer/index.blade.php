@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

    <style>
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

        #offerteBadge:hover + #infoTooltip {
            display: block;
        }
    </style>


<style>

    .duplicate-row {
        background-color: #ffcccc; /* Örnek bir arka plan rengi */
    }
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
        <h6 class="page-title-heading mr-0 mr-r-5">Kundenliste</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Panel</a>
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
                    <div id="date-range">
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
                    </div>
                    <div class="row">
                        <div id="checkbox-container" class="col-md-12 mt-3">
                            <table border="0" class="text-dark" cellspacing="5" cellpadding="5">
                                <tbody>
                                    <tr>
                                        <td>
                                            <b class="text-dark">Services</b><br>
                                            <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedValues()" id="checkbox1" name="serviceFilter[]" value="Offerte" >
                                            <label class="form-check-label mr-1" for="checkbox1">OFFERIERT</label>

                                            / <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedValues()" id="checkbox2" name="serviceFilter[]" value="Nicht Offerte" >
                                            <label class="form-check-label mr-1" for="checkbox2">Nicht OFFERIERT</label>

                                            <input class="form-check-input ml-3"  type="checkbox" onclick="updateCheckedValues()" id="checkbox3" name="serviceFilter[]" value="Termine" >
                                            <label class="form-check-label ml-3 mr-1" for="checkbox3">TERMINIERT</label>

                                            / <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedValues()" id="checkbox4" name="serviceFilter[]" value="Nicht Termine" >
                                            <label class="form-check-label mr-1" for="checkbox4">Nicht TERMINIERT</label>

                                            <input class="form-check-input ml-3"  type="checkbox" onclick="updateCheckedValues()" id="checkbox5" name="serviceFilter[]" value="Quittung" >
                                            <label class="form-check-label ml-3 mr-1" for="checkbox5">QUITTUNG</label>

                                            / <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedValues()" id="checkbox6" name="serviceFilter[]" value="Nicht Quittung" >
                                            <label class="form-check-label mr-1" for="checkbox6">Nicht QUITTUNG</label>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <input class="ml-1"  type="checkbox"  id="duplicateFilter" name="duplicateFilter" value="test">
                            <label class="form-check-label px-1" for="duplicateFilter">Duplicate Kunden</label>
                        </div>
                    </div>

                    <div class="mt-3">
                        <table id="example" class="table table-striped table-responsive">
                            <thead>
                                <tr class="text-dark">
                                    <th>#</th>
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
    let checkedValues = [];

    function updateCheckedValues() {
        const checkboxIds = [
            'checkbox1', 'checkbox2', 'checkbox3' ,'checkbox4', 'checkbox5' , 'checkbox6'
        ];

        checkboxIds.forEach(checkboxId => {
            const checkbox = document.getElementById(checkboxId);
            checkbox.addEventListener('change', () => {
                const index = checkedValues.indexOf(checkbox.value);
                if (checkbox.checked && index === -1) {
                    checkedValues.push(checkbox.value);
                } else if (!checkbox.checked && index !== -1) {
                    checkedValues.splice(index, 1);
                }
            });

        });

    }

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
            "order" : [[5,'desc']],
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
                    d.min_date = $('#start_date').val();
                    d.max_date = $('#end_date').val();
                    d.serviceFilter = checkedValues;
                    d.duplicateFilter = $('#duplicateFilter').is(":checked") ? 1 : 0;
                    return d
                }
            },
            columns: [
                { data: 'offerteFilter', name: 'offerteFilter' , searchable:false ,orderable:false},
                { data: 'name', name: 'name' , searchable:true},
                { data: 'surname', name: 'surname' , searchable:true},
                { data:'email', name:'email' , searchable:true},
                { data:'mobile', name:'mobile' , searchable:true},
                { data:'created_at',name:'created_at', searchable:true},
                { data: 'option', name: 'option', orderable: false, searchable: false ,exportable:false},
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

        $('#checkbox-container').on('change', function () {
                table.draw();
                console.log(checkedValues,'çekbox değerleri Müşteri')
        })

        $('#start_date, #end_date').on('change', function() {
            table.draw();
        });
        $('#reset').on('click', function() {
            $('#start_date').val('');
            $('#end_date').val('');
            table.draw();
        });

        $('#duplicateFilter').on('change', function() {

            if ($(this).is(":checked")) {
                table.order([[3, 'asc']]).draw();
            } else {
                table.order([[5, 'desc']]).draw();
            }
        });
    });
</script>

@endsection
