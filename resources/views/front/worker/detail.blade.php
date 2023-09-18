@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <style>
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
        .shadow-custom {
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            border-radius: 30px;
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

    </style>
@endsection
@section('content')
 <!-- Page Title Area -->
 <div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Arbeiterliste</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Panel</a>
            </li>
            <li class="breadcrumb-item active"><a class="text-primary" href="{{ route('worker.index') }}">Arbeiter</a></li>
        </ol>
        {{-- <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">İşçi Listesi</a>
        </div> --}}
    </div>
    <!-- /.page-title-right -->
</div>

<div class="widget-list">
    <div class="row">
        <div class="col-md-12 widget-holder">
            <div class="widget-bg">
                <div class="widget-heading clearfix ">
                    <h5>Arbeiter: <span class="text-primary">{{ $data['name'] }} {{ $data['surname'] }}</span>  </h5>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body clearfix">
                    <div class="container-fluid " id="date-range">
                        <div class="row d-flex justify-content-between mb-1">
                            <div class="col-md-6 pl-0">
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
                            <div class="col-md-2 p-0 d-flex justify-content-center " >
                                <div class="p-3 text-white bg-primary shadow-custom">
                                    <table>
                                        <tr>
                                            <td><span style="font-size: 1rem;" class="total-price">System Uhr </span></td>
                                            <td>: <span style="font-size: 1rem;"  id="systemTotalHours"></span></td>
                                        </tr>
                                        <tr>
                                            <td><span style="font-size: 1rem;">Arbeitsstunde </span></td>
                                            <td>: <span style="font-size: 1rem;"  id="workerTotalHours"></span></td>
                                        </tr> 
                                        <tr style="border-top: 1px solid rgb(255, 255, 255);">
                                            <td><span style="font-size: 1rem;">Zeitunterschied </span></td>
                                            <td>: <span style="font-size: 1rem;"  id="differenceHours"></span></td>
                                        </tr> 
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-2  d-flex justify-content-center " >
                                <div class="p-3 bg-primary text-white shadow-custom">
                                    <table>
                                        <tr>
                                            <td><span style="font-size: 1rem;" class="total-price">Gesamtsystem </span></td>
                                            <td>: <span style="font-size: 1rem;"  id="systemTotalPrice"></span></td>
                                        </tr>
                                        <tr>
                                            <td><span style="font-size: 1rem;">Arbeiterzahl </span></td>
                                            <td>: <span style="font-size: 1rem;"  id="workerTotalPrice"></span></td>
                                        </tr> 
                                        <tr style="border-top: 1px solid rgb(255, 255, 255);">
                                            <td><span style="font-size: 1rem;">Preisabweichung</span></td>
                                            <td>: <span style="font-size: 1rem;"  id="differencePrice"></span></td>
                                        </tr> 
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-2  d-flex justify-content-center " >
                                <div class="p-3 bg-primary text-white shadow-custom">
                                    <table>
                                        <tr>
                                            <td><span style="font-size: 1rem;" class="total-price">Gebühr bezahlt </span></td>
                                            <td>: <span style="font-size: 1rem;"  id="odenmis"></span></td>
                                        </tr>
                                        <tr>
                                            <td><span style="font-size: 1rem;">Unbezahlte Gebühr </span></td>
                                            <td>: <span style="font-size: 1rem;"  id="odenmemis"></span></td>
                                        </tr> 
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-end">
                            <div class="col-md-6 d-flex justify-content-center ">
                                <div id="calc-notify" class=" px-3 py-1">
                                    <span id="workerWaitCounter">Notification</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <table id="example" class="table table-striped table-responsive">
                        <thead>
                            <tr class="text-dark">
                                <th>Kunde</th>
                                <th>Datum</th>
                                <th>Stunde [h]</th>
                                <th>Stunde(Arbeiter)</th>
                                <th>Preis [h]</th>
                                <th>Total</th>
                                <th>Paid</th>
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
            pageLength: -1, // Display all records on a single page
            "columnDefs": [{
                            "targets": 3,
                            "createdCell": function(td, cellData, rowData, row, col) {
                                if (cellData == '0') {
                                    $(td).html(
                                        // "<span class='bg-custom-warning px-3 py-1 text-center shadow'>Beklemede" +cellData +"</span>"
                                        "<span class='bg-custom-warning px-3 py-1 text-center shadow'>in Wartestellung</span>"
                                    )
                                } else {
                                    $(td).css({
                                        'color': 'red',
                                    });
                                }

                            }
                        },

                        
                    ],
            dom: 'Blfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            
            processing: true,
            serverSide: true,
            ajax: {
                type:'POST',
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                url: '{{route('worker.taskData',['id' => $data['id']])}}',
                data: function (d) {
                    d.min_date = $('#start_date').val();
                    d.max_date = $('#end_date').val();
                    return d
                }
            },
            columns: [
                { data: 'customerName', name: 'customerName'},
                { data: 'created_at', name: 'created_at'},
                { data: 'workHour', name: 'workHour'},
                { data: 'workerHour', name: 'workerHour'},
                { data: 'workerPrice', name: 'workerPrice'},
                { data: 'totalPrice', name: 'totalPrice' },
                { data: 'payStatus', name: 'payStatus' },
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

        $('#start_date, #end_date').on('change', function() {
            table.draw();
        });

        $('#reset').on('click', function() {
            $('#start_date').val('');
            $('#end_date').val('');
            table.draw();
        });

        // Örnek bir değer değişimi senaryosu
        let totalPrice = 0;
        const totalPriceSpans = document.querySelectorAll(".total-price");

        function updateTotalPrice(newPrice) {
        totalPriceSpans.forEach(priceSpan => {
            priceSpan.textContent = newPrice;
            if (newPrice > totalPrice) {
            priceSpan.classList.remove("animate-shrink");
            priceSpan.classList.add("animate-grow");
            } else if (newPrice < totalPrice) {
            priceSpan.classList.remove("animate-grow");
            priceSpan.classList.add("animate-shrink");
            }
        });
        totalPrice = newPrice;
        }

        

        table.on('draw', function() {
            let systemTotal = 0;
            let workerTotal = 0;
            let differencePrice = 0;
            let systemHours = 0;
            let workerHours = 0;
            let waitForWorker = 0;
            let unpaidTotal = 0;
            let paidTotal = 0;
            $('#example tbody tr').each(function() {
                let systemValue = parseFloat($(this).find('td:eq(5)').text());
                let workerHourValue = parseFloat($(this).find('td:eq(3)').text());
                let workerPriceValue = parseFloat($(this).find('td:eq(4)').text());
                let systemHour = parseFloat($(this).find('td:eq(2)').text());
                let workerHour = parseFloat($(this).find('td:eq(3)').text());
                let workerValue = workerHourValue * workerPriceValue;
                let workerHourCounterValue = $(this).find('td:eq(3)').text();
                let workerPaymentStatus = $(this).find('td:eq(6)').text().trim();
                
                
                if(workerHourCounterValue == 'in Wartestellung'){
                    waitForWorker = waitForWorker+1
                }
                if(!isNaN(workerHour))
                {
                    workerHours += workerHour;
                }

                if(!isNaN(systemHour))
                {
                    systemHours += systemHour;
                }
                if(!isNaN(workerHourValue))
                {
                    workerTotal += workerValue;
                    console.log(workerPaymentStatus,'paymentStatus')
                    if(workerPaymentStatus == 'Paid')
                    {
                        paidTotal += workerValue;
                    }
                    if(workerPaymentStatus == 'Unpaid')
                    {
                        unpaidTotal += workerValue;
                    }
                }
                if (!isNaN(systemValue)) {
                    systemTotal += systemValue;
                }
                if(!isNaN(workerTotal) && !isNaN(systemTotal))
                {
                    differencePrice = systemTotal - workerTotal;
                }
                if(!isNaN(workerHours) && !isNaN(systemHours))
                {
                    differenceHours = systemHours - workerHours;
                }
            });
            
            $('#systemTotalHours').text(systemHours+' Stunde');
            $('#workerTotalHours').text(workerHours+' Stunde');
            $('#differenceHours').text(differenceHours+' Stunde');
            $('#systemTotalPrice').text(systemTotal+' CHF');
            $('#workerTotalPrice').text(workerTotal+' CHF');
            $('#differencePrice').text(differencePrice+' CHF');
            $('#odenmis').text(paidTotal+' CHF');
            $('#odenmemis').text(unpaidTotal+' CHF');
            
            if(waitForWorker <= 0)
            {
                $('#workerWaitCounter').text('Alle Daten berechnet');
                $("#calc-notify").css({
                    "background-color":"#28A745", 
                    "color":"white",
                    "border-radius":"30px",
                });
            }
            else{
                $('#workerWaitCounter').text(waitForWorker+' Daten nicht enthalten '+ waitForWorker+ ' Eingabe der Arbeitsstunden erforderlich');
                $("#calc-notify").css({
                    "background-color":"#A87F04", 
                    "color":"white",
                    "border-radius":"30px",
                });
            }
        });
    });
</script>
<script>
    function payStatusChanger(id) {
    if (confirm("Are you sure you want to change the payment status?")) {
        confirmAndPay(id);
    }
}
</script>
<script>
    // Şu anki tarihi al
    var today = new Date();

    // Bulunduğumuz ayın başlangıcını hesapla
    var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 2);

    // Tarihi ISO formatına dönüştür ve min_date alanına ata
    document.getElementById('start_date').value = firstDayOfMonth.toISOString().split('T')[0];
</script>
<script>
   function confirmAndPay(id){
   let table= $('#example').DataTable();
   
    console.log(id,'Task Id');
        $.ajax({
            type:'POST',
            headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
            url: '{{ route('worker.payStatusChanger', ['id' => ':id']) }}'.replace(':id', id),
            success: function(response) {
               table.draw();
            },
            error: function(xhr, status, error) {
                // handle error response
            }
        });
    }
</script>

@endsection