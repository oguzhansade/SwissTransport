@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')

  <!-- Page Title Area -->
<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Aufgabenliste</h6>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Panel</a>
            </li>
            <li class="breadcrumb-item active">Aufgaben</li>
        </ol>
        {{-- <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Görev Listesi</a>
        </div> --}}
    </div>
    <!-- /.page-title-right -->
</div>


<div class="widget-list mt-3">
    
    <div class="row">
        <div class="col-md-12 widget-holder">
            <div class="widget-bg">
                <div class="row">
                    <div class="col-md-12 p-3">
                        <button onclick="testajax()" class="btn btn-danger">Toplu Sil</button>
                    </div>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body clearfix">
                    <table id="admintask" class="table table-striped table-responsive">
                        <thead>
                            <tr class="text-dark">
                                <th><input type="checkbox" id="selectAll" class="selectAll" name="selectAll"></th>
                                <th>Quittungnnr</th>
                                <th>Aufgaben Am</th>
                                <th>Erstellt Am</th>
                                <th>Totalt</th>
                                @if (Auth::user()->permName == 'superAdmin' || Auth::user()->permName == 'chef') 
                                    <th>Quittung Spesens</th>
                                @endif
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
const selectedValues = [];

// "Select All" checkbox'ını seçin
const selectAllCheckbox = document.querySelector('.selectAll');

// "Select All" checkbox'ının değişiklik olayını dinleyin
selectAllCheckbox.addEventListener('change', function() {
  const selectAllChecked = selectAllCheckbox.checked;

  // "deleteInput" sınıfına sahip tüm checkbox'ları seçin
  const deleteInputCheckboxes = document.querySelectorAll('.deleteInput');

  // Diğer tüm "deleteInput" checkbox'larını "Select All" checkbox'ına göre işaretleyin (checked yapın)
  deleteInputCheckboxes.forEach(checkbox => {
    checkbox.checked = selectAllChecked;

    // Checkbox'ın value değerini diziye ekleyin veya çıkarın
    if (selectAllChecked) {
      selectedValues.push(checkbox.value);
    } else {
      const index = selectedValues.indexOf(checkbox.value);
      if (index > -1) {
        selectedValues.splice(index, 1);
      }
    }
  });

  console.log(selectedValues, "Dizi Değeri");
});

</script>

<script>
    
    function onCheckBoxChange(checkbox) {
        if (checkbox.checked) {
            // Checkbox seçildiğinde yapılacak işlem
            console.log(`Input ${checkbox.value} seçildi.`);
            // Checkbox'ın değerini diziye ekleyin
            selectedValues.push(checkbox.value);

            console.log(selectedValues,"Dizi Değeri")
            // İşlemlerinizi buraya ekleyin
        } else {
            // Checkbox seçimi kaldırıldığında yapılacak işlem
            console.log(`Input ${checkbox.value} seçimi kaldırıldı.`);

            // Checkbox'ın değerini diziden kaldırın
            const index = selectedValues.indexOf(checkbox.value);
            if (index > -1) {
            selectedValues.splice(index, 1);
            }

            console.log(selectedValues,"Dizi Değeri")
            // İşlemlerinizi buraya ekleyin
        }
    }
</script>

<script>
    $(document).ready(function() {
        const userPerm = "{{ Auth::user()->permName }}";
        console.log(userPerm);
        let columns = [
            { data: 'selector', name: 'selector' , orderable:false, searchable:false},
            { data: 'receiptUmzugId', name: 'receiptUmzugId' },
            { data: 'taskDate', name: 'taskDate' },
            { data: 'created_at', name:'created_at' },
            { data: 'taskTotalPrice', name: 'taskTotalPrice' },
            { data: 'option', name: 'option', orderable: false, searchable: false },
        ]

        if (userPerm.includes('superAdmin') || userPerm.includes('chef')) {
            columns.splice(-1, 0, { data: 'expense', name: 'expense', searchable: false, width: '10%' });
        }
        let table =  $('#admintask').DataTable( {
            lengthMenu: [[25, 100, -1], [25, 100, "All"]],
            dom: 'Blfrtip',                                 
            buttons: [
                'copy',
                'excel',
                'pdf',
            ],
            columnDefs: [
             { type: 'turkish', targets: '_all' }
            ],
            processing: true,
            serverSide: true,
            language:{
                'emptyTable': 'No Data to show'
            },
            ajax: {
                type:'POST',
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                url: '{{route('task.data')}}',
                data: function (d) {
                    d.startDate = $('#datepicker_from').val();
                    d.endDate = $('#datepicker_to').val();
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
<script>
   function testajax() {
        // Göndermek istediğiniz dizi
        var ids = selectedValues; // selectedValues dizisini kullan

        $.ajax({
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: '{{ route('task.bulkDelete') }}',
            data: { taskIds: ids }, // Diziyi "ids" adıyla gönderin
            success: function(response) {
                console.log('AJAX isteği başarılı tasklar silindi')
                toastr.success('Tasks deleted')
                tableReloader();
            },
            error: function() {
                console.log('AJAX isteği başarısız oldu.');
                toastr.error('Tasks cannot deleted')
            }
        });
    }

</script>

<script>
    function tableReloader()
    {
        if ($.fn.DataTable.isDataTable('#admintask')) {
            var table = $('#admintask').DataTable();
            table.search('').draw();
        }
    }
</script>
@endsection