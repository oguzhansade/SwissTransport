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
                                <h5>Offerte Table</h5>
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
                                   <tr>
                                    
                                   </tr>
                                   
                                </tbody>
                            </table>
                            <table border="0" class="text-dark mt-3" cellspacing="5" cellpadding="5" >
                                <tbody>
                                    <tr>
                                        {{-- <td>
                                            <b class="test-dark">Service Type</b>
                                            <select class="form-control" name="serviceType" id="serviceType">
                                            <option value="Alle">Alle</option>
                                            <option value="Umzug">Umzug</option>
                                            <option value="Einpack">Einpack</option>
                                            <option value="Auspack">Auspack</option>
                                            <option value="Entsorgung">Entsorgung</option>
                                            <option value="Reinigung">Reinigung</option>
                                            <option value="Transport">Transport</option>
                                            <option value="Lagerung">Lagerung</option>
                                            <option value="Verpackungsmaterial">Verpackungsmaterial</option>
                                          </select>
                                        </td> --}}
                                        
                                        
                                        <td>
                                            <b class="test-dark">Stand</b>
                                            <select class="form-control" name="standType" id="standType">
                                            <option value="Alle">Alle</option>
                                            <option value="Beklemede">Wartet Auf Kunde</option>
                                            <option value="Onaylandı">Bestätigung</option>
                                            <option value="Onaylanmadı">Abgesagt</option>
                                          </select>
                                        </td>
                                        <td>
                                            <b class="test-dark">Besichtigung</b>
                                            <select class="form-control" name="appType" id="appType">
                                            <option value="Alle">Alle</option>
                                            <option value="Nein">Nein</option>
                                            <option value="Gemacht">Gemacht</option>
                                            <option value="Winscht Keine">Winscht Keine</option>
                                          </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                    </tr>
                                </tbody>
                            </table>
                            <div id="checkbox-container" class="col-md-10 mt-3">
                                <td>
                                    <b class="text-dark">Service Types</b><br>
                                    <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedValues()" id="checkbox1" name="typeFilter[]" value="Alle" >
                                    <label class="form-check-label mr-1" for="checkbox1">Alle</label>

                                    <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedValues()" id="checkbox2" name="typeFilter[]" value="Umzug" >
                                    <label class="form-check-label mr-1" for="checkbox2">Umzug</label>

                                    <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedValues()" id="checkbox3" name="typeFilter[]" value="Einpack" >
                                    <label class="form-check-label mr-1" for="checkbox3">Einpack</label>

                                    <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedValues()" id="checkbox4" name="typeFilter[]" value="Auspack" >
                                    <label class="form-check-label mr-1" for="checkbox4">Auspack</label>

                                    <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedValues()" id="checkbox5" name="typeFilter[]" value="Entsorgung" >
                                    <label class="form-check-label mr-1" for="checkbox5">Entsorgung</label>

                                    <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedValues()" id="checkbox6" name="typeFilter[]" value="Reinigung" >
                                    <label class="form-check-label mr-1" for="checkbox6">Reinigung</label>

                                    <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedValues()" id="checkbox7" name="typeFilter[]" value="Transport" >
                                    <label class="form-check-label mr-1" for="checkbox7">Transport</label>

                                    <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedValues()" id="checkbox8" name="typeFilter[]" value="Lagerung" >
                                    <label class="form-check-label mr-1" for="checkbox8">Lagerung</label>

                                    <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedValues()" id="checkbox9" name="typeFilter[]" value="Verpackungsmaterial" >
                                    <label class="form-check-label" for="checkbox9">Verpackungsmaterial</label>
                                </td>
                            </div>
                            <div class="col-md-3 mt-3">
                                <b class="text-dark">Kunde Search</b>
                                        <input class="form-control" type="text" id="searchInput" name="searchInput">
                            </div>
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
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <table id="example" class="table table-striped table-responsive">
                            <thead>
                                <tr class="text-dark">
                                    <th>OfferteNR</th>
                                    <th>Dienstleistung</th>
                                    <th>Kunde</th>
                                    <th>Stand</th>
                                    <th>Esimated Income</th>
                                    <th>Datum</th>
                                    {{-- <th>GratTotal</th> --}}
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
                    <!-- notizModal HTML -->
                    <div class="modal fade" id="notizModal" tabindex="-1" role="dialog" aria-labelledby="notizModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="notizModalLabel">Notiz Bearbeiten</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <!-- Modal içeriği buraya gelir -->
                            <form id="notizForm" action="" method="POST">
                                @csrf
                                <textarea name="notizTextArea" class="form-control" id="notizTextArea" rows="4" cols="50"></textarea>
                            
                            <!-- $data->id'yi burada kullanabilirsiniz -->
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                            <button  type="submit" class="btn btn-primary">Kaydet</button>
                            </form>
                            </div>
                        </div>
                        </div>
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
            'checkbox1', 'checkbox2', 'checkbox3', 'checkbox4', 
            'checkbox5', 'checkbox6', 'checkbox7', 'checkbox8', 
            'checkbox9'
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
            lengthMenu: [[25, 100, -1], [25, 100, "All"]],
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
            
            "order": [0, 'desc'],
            "columnDefs": [{
                            "className": "dt-center",
                            "targets": 3,
                            "createdCell": function(td, cellData, rowData, row, col) {
                                if (cellData == 'Onaylandı') {
                                    $(td).html(
                                        '<span class="bg-custom-success px-3 py-1 text-center shadow" >Bestätigt <i class="text-center feather feather-check-circle pl-1"></i></span>'
                                    )
                                } else if (cellData == 'Beklemede') {
                                    
                                    $(td).html(
                                        '<span class="bg-custom-warning px-3 py-1 text-center shadow" >is Offen<i class="text-center feather feather-alert-circle pl-1"></i></span>'
                                    )
                                } else if(cellData == 'Onaylanmadı') {
                                    $(td).html(
                                        '<span class="bg-custom-danger px-3 py-1 text-center shadow" >Abgesagt<i class="text-center feather feather-x-circle pl-1"></i></span>'
                                    )
                                }

                            }
                        },
                        {
                            "targets": 6,
                            "createdCell": function(td, cellData, rowData, row, col) {
                                $(td).html(cellData);
                                $("#gratTotalPriceDiv2").html(cellData); // gratTotalPrice sütununu div'e yazdırma
                            }
                        },
                        {
                            "targets": 3,
                            "createdCell": function(td, cellData, rowData, row, col) {
                                $(td).css('vertical-align', 'middle');
                            }
                        }
                    ],
            
                    dom: 'Blfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 
            ],
            
            processing: true,
            serverSide: true,
            ajax: {
                type:'POST',
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                url: '{{route('statistics.offerData')}}',
                data: function (d) {
                    d.min_date = $('#start_date').val();
                    d.max_date = $('#end_date').val();
                    d.serviceType = $('#serviceType').val();
                    d.typeFilter = checkedValues;
                    d.standType = $('#standType').val();
                    d.appType = $('#appType').val();
                    d.search =  $('#searchInput').val(); // Müşteri adı veya soyadı arama değeri
                    return d
                },
                
            },
            columns: [
                { data: 'id', name: 'id' , searchable:true},
                { data: 'services', name: 'services' , searchable:true},
                { data:'customerId', name:'customerId' , searchable:true, orderable: true},
                { data:'offerteStatus', name:'offerteStatus' , searchable:true},
                { data:'offerPrice',name:'offerPrice', searchable:false},
                { data:'created_at',name:'created_at', searchable:true},
                { data: 'option', name: 'option', orderable: false, searchable: false ,exportable:false},
            ],

            "footerCallback": function ( row, data, start, end, display ) {
                var rsTot = table.ajax.json();    
                var api = this.api(), data;
                console.log(rsTot)
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
 
                ent = api
                    .column( 4 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
        
                $( api.column( 4 ).footer() ).html(ent);
                if(rsTot.filteredTotal)
                {
                    let filteredTotal = rsTot.filteredTotal;
                    let formattedTotal = filteredTotal.toLocaleString('de-CH', { style: 'currency', currency: 'CHF' });
                    $('#filteredTotal').text(formattedTotal);

                    if(rsTot.nonFilteredTotal)
                    {
                        let nonFilteredTotal = rsTot.nonFilteredTotal;
                        let nfFormattedTotal = nonFilteredTotal.toLocaleString('de-CH', { style: 'currency', currency: 'CHF' });
                        $('#nonFilteredTotal').text(nfFormattedTotal);
                    }
                }
               
                $('#filteredOfferte').text(rsTot.recordsFiltered + '/' + rsTot.totalOfferte);
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

        $('#searchInput').keyup(function(){
            table.draw();
        })

        $('#checkbox-container').on('change', function () {
                table.draw();
                console.log(checkedValues,'çekbox değerleri')
        })

        $('#start_date, #end_date, #serviceType, #standType,#appType,#searchInput').on('change', function() {
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
<script>
    function testajax(){
        $.ajax({
    type:'POST',
    headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
    url: '{{route('statistics.offerData')}}',
    success: function(response) {
    var totalPrice = response.totalPrice; // Backend'den gelen totalPrice değerini alın

    // Frontend'de totalPrice'ı göstermek istediğiniz div'in ID'sini buraya yazın
    $('#totalPriceDiv').text(totalPrice);
  },
  error: function() {
    console.log('AJAX isteği başarısız oldu.');
  }
});
    }
</script>
<script>
    // Notiz düğmesine tıklanınca id'yi modal içeriğine yerleştirme
    $(document).on('click', '.btn-info', function () {
        
        var id = $(this).data('id');
        var url = '/offer/getOfferte/' + id

        var formAction = '{{ route('offer.noticeUpdate', ['id' => ':id']) }}';
        formAction = formAction.replace(':id', id);
        $('#notizForm').attr('action', formAction);

        $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            var offerteData = response.offerte;

            if (offerteData) {
                // offerteData içinde belirli bir offertenin bütün verileri bulunuyor
                $('#notizTextArea').val(offerteData.panelNote);
                // Örneğin, offerteData.field1, offerteData.field2 vb. şeklinde verilere erişebilirsiniz
            } else {
                $('#notizTextArea').val('Veri bulunamadı');
            }
        },
        error: function () {
            $('#notizTextArea').val('Sunucu hatası');
        }
    });
    // noticeUpdater fonksiyonunu çağırmadan önce id'yi bir değişkende saklayın
    var idForNoticeUpdater = id;

    $('#updateNotice').on('click', function(){
            noticeUpdater(idForNoticeUpdater)
        })
    });
  </script>
  <script>
    function noticeUpdater(id)
    {
        var url = '/offer/noticeUpdate/' + id
        var panelNote = $('#notizTextArea').val();
            $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
            type: 'POST',
            dataType: 'json',
            data: {
            '_token': '{{ csrf_token() }}', // CSRF token
            'panelNote': panelNote // noticeArea değeri
            },
            success: function (response) {
                
            },
            error: function () {
                $('#notizTextArea').val('Sunucu hatası');
            }
        })
    }
    
  </script>
@endsection