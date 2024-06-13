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
            <li class="breadcrumb-item active">Offerte</li>
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
                                <h5>Quittung Table</h5>
                            </div>
                        </div>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body clearfix">
                    <div class="row">
                        <div class="col-md-12" id="date-range">
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
                    </div>

                    <div class="row mt-3 @if (!in_array(Auth::user()->permName, ['superAdmin'])) d-flex justify-content-end @endif">
                        @if (in_array(Auth::user()->permName, ['superAdmin']))
                            <div class="col-md-2 ">
                                <div class="p-3 text-white bg-primary shadow-custom">
                                    <table style="font-size:0.85rem">
                                        <tr>
                                            <td><span>Umsatz</span></td>
                                            <td>: <span id="filteredTotal"></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="p-3 text-white bg-primary shadow-custom">
                                    <h6 class="m-0" style="border-bottom: 1px solid white;">Ausgaben</h6>
                                    <table class="mt-2" style="font-size:0.85rem">
                                        <tr>
                                            <td><span>Möbellift Miete</span></td>
                                            <td>: <span id="mobeExpense">-</span></td>
                                        </tr>
                                        <tr>
                                            <td><span>Lieferwagen Miete</span></td>
                                            <td>: <span id="liefeExpense">-</span></td>
                                        </tr>
                                        <tr>
                                            <td><span>Schutzmaterial</span></td>
                                            <td>: <span id="schutzExpense">-</span></td>
                                        </tr>
                                        <tr>
                                            <td><span>Schaden</span></td>
                                            <td>: <span id="schadenExpense">-</span></td>
                                        </tr>
                                        <tr>
                                            <td><span>Busse</span></td>
                                            <td>: <span id="busseExpense">-</span></td>
                                        </tr>
                                        <tr>
                                            <td><span>Entgegenkommen</span></td>
                                            <td>: <span id="entExpense">-</span></td>
                                        </tr>
                                        <tr>
                                            <td><span>Mitarbeiter</span></td>
                                            <td>: <span id="arbeExpense">-</span></td>
                                        </tr>
                                        <tr>
                                            <td><span>Diesel</span></td>
                                            <td>: <span id="dieExpense">-</span></td>
                                        </tr>
                                        <tr>
                                            <td><span>Other</span></td>
                                            <td>: <span id="otherExpense">-</span></td>
                                        </tr>
                                        <tr style="border-top:1px solid white;">
                                            <td><span>Total</span></td>
                                            <td>: <span id="giderler"></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-2 ">
                                <div class="p-3 text-white bg-primary shadow-custom">
                                    <table style="font-size:0.85rem">
                                        <tr>
                                            <td><span>Gewinn</span></td>
                                            <td>: <span id="profit"></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-2">
                            <div class="p-3 text-white bg-primary shadow-custom">
                                <table style="font-size:0.85rem">
                                    <tr>
                                        <td><span>Quittung</span></td>
                                        <td>: <span id="filteredQuittung"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 @if (!in_array(Auth::user()->permName, ['superAdmin'])) d-none @endif">
                        <div id="checkbox-container" class="col-md-10 mt-3">
                            <table border="0" class="text-dark" cellspacing="5" cellpadding="5">
                                <tbody>
                                    <tr>
                                        <td>
                                            <b class="text-dark">Quittung Erhalten</b><br>
                                            <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedValues()" id="checkbox1" name="docTakenFilter[]" value="Taken" >
                                            <label class="form-check-label mr-1" for="checkbox1">JA</label>

                                            / <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedValues()" id="checkbox2" name="docTakenFilter[]" value="Untaken" >
                                            <label class="form-check-label mr-1" for="checkbox2">NEIN</label>
                                        </td>

                                        <td class="pl-3">
                                            <b class="text-dark">Quittung Type</b><br>
                                            <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedTypeValues()" id="quittungTypeFilter1" name="quittungTypeFilter[]" value="Umzug" >
                                            <label class="form-check-label mr-1" for="quittungTypeFilter1">UMZUG</label>

                                            / <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedTypeValues()" id="quittungTypeFilter2" name="quittungTypeFilter[]" value="Reinigung" >
                                            <label class="form-check-label mr-1" for="quittungTypeFilter2">REINIGUNG</label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-3">
                        <table id="makbuz" class="table table-striped table-responsive">
                            <thead>
                                <tr class="text-dark">
                                    <th>Quittungsnr</th>
                                    <th>Offerte</th>
                                    <th>Vorname</th>
                                    <th>Nachname</th>
                                    <th>Auftragstermin</th>
                                    @if (in_array(Auth::user()->permName, ['superAdmin']))
                                        <th>Umsatz</th>
                                        <th>Ausgaben</th>
                                        <th>Gewinn</th>
                                        <th>Quittung Erhalten</th>
                                    @endif
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
    let checkedTypeValues = [];

    function updateCheckedValues() {
        const checkboxIds = [ 'checkbox1', 'checkbox2' ];

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


    function updateCheckedTypeValues() {
        const checkboxIds = [ 'quittungTypeFilter1', 'quittungTypeFilter2' ];

        checkboxIds.forEach(checkboxId => {
            const checkbox = document.getElementById(checkboxId);
            checkbox.addEventListener('change', () => {
                const index = checkedTypeValues.indexOf(checkbox.value);
                if (checkbox.checked && index === -1) {
                    checkedTypeValues.push(checkbox.value);
                } else if (!checkbox.checked && index !== -1) {
                    checkedTypeValues.splice(index, 1);
                }
            });
        });
    }


    $(document).ready(function() {
        const userPerm = "{{ Auth::user()->permName }}";
        console.log(userPerm);

        let columns = [
            { data: 'makbuzNo', name: 'makbuzNo' },
            { data: 'offerId', name: 'offerId' },
            { data: 'customer', name: 'customer' },
            { data: 'customerSurname', name: 'customerSurname' },
            { data: 'created_at',name: 'created_at' },
            { data: 'option',name: 'detail',orderable: false,searchable: false,exportable: false },

        ];

        // Eğer kullanıcı superAdmin ise 'docTaken' sütununu ekle
        if (userPerm.includes('superAdmin')) {
            columns.splice(-1, 0,
            { data: 'tutar', name: 'tutar' },
            { data: 'expensePrice', name: 'expensePrice' },
            { data: 'profit', name: 'profit' },
            { data: 'docTaken', name: 'docTaken', searchable: false, width: '10%',}
            );
        }

        let table = $('#makbuz').DataTable({
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
                url: '{{ route('statistics.receiptData') }}',
                data: function(d) {
                    d.min_date = $('#start_date').val();
                    d.max_date = $('#end_date').val();
                    d.docTakenFilter = checkedValues;
                    d.quittungTypeFilter = checkedTypeValues;
                    return d
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

            "footerCallback": function ( row, data, start, end, display ) {
                var rsTot = table.ajax.json();
                var api = this.api(), data;
                console.log(rsTot)


                if(rsTot.total)
                {
                    let total = rsTot.total;
                    ciroH = rsTot.total;
                    let formattedTotal = total.toLocaleString('de-CH', { style: 'currency', currency: 'CHF' });
                    $('#filteredTotal').text(formattedTotal);

                    let expense = rsTot.expense;
                    let formattedExpense = expense.toLocaleString('de-CH', { style: 'currency', currency: 'CHF' });
                    $('#giderler').text(formattedExpense);

                    let mobeExpense = rsTot.MobeTotal || '-';
                    let frmtMexpense = mobeExpense.toLocaleString('de-CH', { style: 'currency', currency: 'CHF' });
                    $('#mobeExpense').text(frmtMexpense);

                    let liefeExpense = rsTot.LiefTotal || '-';
                    let frmtLiExpense = liefeExpense.toLocaleString('de-CH', { style: 'currency', currency: 'CHF' });
                    $('#liefeExpense').text(frmtLiExpense);

                    let schuExpense = rsTot.SchuTotal || '-';
                    let frmtscExpense = schuExpense.toLocaleString('de-CH', { style: 'currency', currency: 'CHF' });
                    $('#schutzExpense').text(frmtscExpense);

                    let schaExpense = rsTot.SchaTotal || '-';
                    let frmtschaExpense = schaExpense.toLocaleString('de-CH', { style: 'currency', currency: 'CHF' });
                    $('#schadenExpense').text(frmtschaExpense);

                    let bussExpense = rsTot.BussTotal || '-';
                    let frmtbussExpense = bussExpense.toLocaleString('de-CH', { style: 'currency', currency: 'CHF' });
                    $('#busseExpense').text(frmtbussExpense);

                    let entExpense = rsTot.EntgTotal || '-';
                    let frmtentExpense = entExpense.toLocaleString('de-CH', { style: 'currency', currency: 'CHF' });
                    $('#entExpense').text(frmtentExpense);

                    let arbExpense = rsTot.ArbeTotal || '-';
                    let frmtarbExpense = arbExpense.toLocaleString('de-CH', { style: 'currency', currency: 'CHF' });
                    $('#arbeExpense').text(frmtarbExpense);

                    let dieExpense = rsTot.DiesTotal || '-';
                    let frmtdieExpense = dieExpense.toLocaleString('de-CH', { style: 'currency', currency: 'CHF' });
                    $('#dieExpense').text(frmtdieExpense);

                    let othExpense = rsTot.OtheTotal || '-';
                    let frmtothExpense = othExpense.toLocaleString('de-CH', { style: 'currency', currency: 'CHF' });
                    $('#otherExpense').text(frmtothExpense);

                    let profit = total - expense;
                    let formattedProfit = profit.toLocaleString('de-CH', { style: 'currency', currency: 'CHF'});
                    $('#profit').text(formattedProfit)
                }
                $('#filteredQuittung').text(rsTot.recordsFiltered + '/' + rsTot.totalQuittung);
            }
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


        $('#start_date, #end_date, #quittungTypeFilter1, #quittungTypeFilter2,#searchInput,#checkbox-container').on('change', function() {
            table.draw();
        });
        $('#reset').on('click', function() {
            $('#start_date').val('');
            $('#end_date').val('');
            $('#serviceType').val('Alle');
            $('#standType').val('Alle');
            $('#appType').val('Alle');
            $('#searchInput').val('');
            table.draw();
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
<script>
     $('#example').on('draw.dt', function() {
        testajax();
        let total= 0;
        $('#example tbody tr').each(function() {
            let offertePrice = parseFloat($(this).find('td:eq(4)').text());

            if(!isNaN(offertePrice)){
                total += offertePrice;
            }


        });
        $('#gratTotalPriceDiv').text(total);
     })

</script>

@endsection
