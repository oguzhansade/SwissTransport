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
        .custom-modal-dialog {
            max-width: 90%;
            width: auto;
        }

        .custom-modal-content {
            width: 100%;
        }

        #example {
            width: 100%;
        }

        table.table {
            width: 100%;
        }
        .dataTables_scrollBody
        {
        overflow-x:hidden !important;
        overflow-y:auto !important;
        }
        #notizTable {
            margin-top: 0px;
        }
        .dataTables_wrapper table.dataTable thead .sorting::before {
            opacity: 0;
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
                                </tbody>
                            </table>
                            <table  border="0" class="text-dark" cellspacing="5" cellpadding="5">
                                <tbody>
                                    <tr>
                                        <td><b class="test-dark">Umzugsdatum</b></td>
                                        <td><input class="form-control" type="date" id="umzugstart_date" name="umzugmin_date"></td>
                                        <td><b class="test-dark">bis</b></td>
                                        <td><input class="form-control" type="date" id="umzugend_date" name="umzugmax_date"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table border="0" class="text-dark mt-3" cellspacing="5" cellpadding="5" >
                                <tbody>
                                    <tr>
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
                                          </select>
                                        </td>
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
                            <div id="zimmer-container" class="col-md-10 mt-3">
                                <b class="text-dark">Zimmer Filter</b><br>
                                <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedZimmers()" id="zimmer1" name="zimmerFilter[]" value="1-1.5 Zimmer" >
                                <label class="form-check-label mr-1" for="zimmer1">1-1.5 Zimmer</label>

                                <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedZimmers()" id="zimmer2" name="zimmerFilter[]" value="2-2.5 Zimmer" >
                                <label class="form-check-label mr-1" for="zimmer2">2-2.5 Zimmer</label>

                                <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedZimmers()" id="zimmer3" name="zimmerFilter[]" value="3-3.5 Zimmer" >
                                <label class="form-check-label mr-1" for="zimmer3">3-3.5 Zimmer</label>

                                <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedZimmers()" id="zimmer4" name="zimmerFilter[]" value="4-4.5 Zimmer" >
                                <label class="form-check-label mr-1" for="zimmer4">4-4.5 Zimmer</label>

                                <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedZimmers()" id="zimmer5" name="zimmerFilter[]" value="5-5.5 Zimmer" >
                                <label class="form-check-label mr-1" for="zimmer5">5-5.5 Zimmer</label>

                                <input class="form-check-input ml-0"  type="checkbox" onclick="updateCheckedZimmers()" id="zimmer6" name="zimmerFilter[]" value="6-6.5 Zimmer" >
                                <label class="form-check-label mr-1" for="zimmer6">6-6.5 Zimmer</label>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mt-3">
                                    <b class="text-dark">Kunde Search</b>
                                            <input class="form-control" type="text" id="searchInput" name="searchInput">
                                </div>
                                {{-- <div class="col-md-3 mt-3">
                                    <b class="text-dark">Kontakt Person</b><br>
                                    <select class="form-control" name="contactPersonFilter" id="">
                                        <option value="Alle">Alle</option>
                                        @foreach (\App\Models\ContactPerson::all() as $key=>$value )
                                            <option value="{{ $value['id'] }}">{{ $value['name'] }} {{ $value['surname'] }}</option>
                                        @endforeach
                                    </select>        
                                </div> --}}
                                <div class="col-md-3 mt-3">
                                    <b class="text-dark">Kontakt Person Search</b><br>
                                    <input class="form-control" type="text" id="contactPersonSearch" name="contactPersonSearch">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-2 ">
                            <div class="p-3 text-white bg-primary shadow-custom">
                                <table style="font-size:1rem">
                                    @if (in_array(Auth::user()->permName, ['superAdmin'])) 
                                    <tr>
                                        <td><span>Gefiltert</span></td>
                                        <td>: <span id="filteredTotal"></span></td>
                                    </tr>

                                    <tr>
                                        <td><span>Ungefiltert</span></td>
                                        <td>: <span id="nonFilteredTotal"></span></td>
                                    </tr>

                                    <tr>
                                        <td><span>Bestätigung</span></td>
                                        <td>: <span id="percentBestatig"></span></td>
                                    </tr>
                                    @endif
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
                                    <th>Besichtigung</th>
                                    <th>Dienstleistung</th>
                                    <th>Kunde</th>
                                    <th>Stand</th>
                                    @if (in_array(Auth::user()->permName, ['superAdmin'])) 
                                        <th>Esimated Income</th>
                                    @endif
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

                    <!-- Notiz Table Modal HTML -->
                    <div class="modal fade" id="notizModal" tabindex="-1" role="dialog" aria-labelledby="notizModalLabel" aria-hidden="true">
                        <div class="modal-dialog custom-modal-dialog" role="document">
                        <div class="modal-content custom-modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title " id="notizModalLabel">Notiz </h5>  
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> 
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="h5">Kunde:</span><span id="customerName" class="ml-1 text-primary h5">Ömer Sade</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <span id="newNotizSuccess" class="bg-success text-white py-1 px-2  rounded" style="display: none;">Başarılı: Not Eklendi</span>
                                    </div>
                                </div>
                                <div class="row d-flex mb-2 ">
                                    <div class="col-md-6">
                                        <button onclick="tableReloader()"  class="btn btn-sm btn-primary p-1 reloadNote" >Refresh <i class="ml-1 list-icon feather feather-refresh-cw "></i></button>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end">
                                        <a class="btn btn-sm btn-success" href="#" data-toggle="modal" data-target="#addNotizModal" data-id="">Add New Notiz+</a>
                                    </div>
                                    <input id="offerId" type="text" value="" hidden>
                                </div>
                                <table id="notizTable" class="table table-striped table-responsive" width="100%">
                                    <thead>
                                        <tr class="text-dark">
                                            <th>#</th>
                                            <th>OfferteNR</th>
                                            <th>Notiz</th>
                                            <th>Created</th>
                                            <th>Updated</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>

                    {{-- Add New Notiz Modal --}}
                    <div class="modal fade custom-modal mt-2" id="addNotizModal" tabindex="-1" role="dialog" aria-labelledby="addNotizModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title " id="addNotizModal">Add New Notiz </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <span id="newNotizError" class="bg-danger text-white py-1 px-2  rounded " style="display: none;">HATA: Not Eklenemedi</span>
                                        <span id="emptyNotizError" class="bg-danger text-white py-1 px-2  rounded " style="display: none;">HATA: Not Alanı Boş Olamaz</span>
                                    </div>
                                </div>
                                <div class="row d-flex mt-2 ">
                                    <div class="col-md-12">
                                        <textarea  id="note" class="form-control" name="" id="" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <a href="#" id="addNewNotiz" class="btn btn-success justify-content-end" data-id=""  onclick="addNewNotiz(this)">Erstellen</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    {{-- Notiz Edit --}}
                    <div class="modal fade custom-modal mt-2" id="editNotizModal" tabindex="-1" role="dialog" aria-labelledby="editNotizModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title " id="editNotizModal">Edit Notiz</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span>Notiz NR #</span><span id="notizId" class="text-primary"></span>
                                    </div>
                                </div>
                                <div class="row d-flex mt-2 ">
                                    <div class="col-md-12">
                                        <input id="notizIdHolder" type="text" value="" hidden>
                                        <textarea  id="editNotiz" class="form-control" name="" id="" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <a href="#" id="addNewNotiz" class="btn btn-success justify-content-end" data-id=""  onclick="updateNotiz()">Erstellen</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    {{-- Detail Notiz --}}
                    <div class="modal fade custom-modal mt-2" id="detailNotizModal" tabindex="-1" role="dialog" aria-labelledby="detailNotizModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title " id="detailNotizModal">Notiz Detail</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span>Notiz NR #</span><span id="notizIdDetail" class="text-primary"></span>
                                    </div>
                                </div>
                                <div class="row d-flex mt-2 ">
                                    <div class="col-md-12">
                                        <textarea  id="detailNotiz" class="form-control" name="" id="" rows="10" disabled></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    {{-- Delete Notiz --}}
                    <div class="modal fade custom-modal mt-2" id="deleteNotizModal" tabindex="-1" role="dialog" aria-labelledby="deleteNotizModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title " id="deleteNotizModal">Notiz Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row d-flex mt-2 ">
                                    <div class="col-md-12">
                                        <h5>#<span  class="text-danger"><strong id="notizIdDelete"></strong></span><h5>Nolu Notu Silmek İstediğinize Emin misiniz?</h5>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <button href="#" id="deleteNotiz" class="btn btn-danger justify-content-end" data-id="" onclick="notizDeleteVerify()">Delete</button>
                                    </div>
                                </div>
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
    function openFilter() {
 var checkboxContainer = $('#checkbox-container-2');
 
 if (checkboxContainer.css('display') === 'none') {
     checkboxContainer.show(); // 300ms içinde yukarı aç
 } else {
     checkboxContainer.hide();   // 300ms içinde yukarı kapat
 }
}
     
 </script>
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

    let checkedZimmers = [];

    function updateCheckedZimmers() {
        const checkboxIds = [
            'zimmer1', 'zimmer2', 'zimmer3', 'zimmer4', 
            'zimmer5', 'zimmer6'
        ];

        checkboxIds.forEach(checkboxId => {
            const checkbox = document.getElementById(checkboxId);
            checkbox.addEventListener('change', () => {
                const index = checkedZimmers.indexOf(checkbox.value);
                if (checkbox.checked && index === -1) {
                    checkedZimmers.push(checkbox.value);
                } else if (!checkbox.checked && index !== -1) {
                    checkedZimmers.splice(index, 1);
                }
            });
        });
        
    }

    $(document).ready(function() {
        const userPerm = "{{ Auth::user()->permName }}";
        console.log(userPerm);
        let columns = [
                { data: 'id', name: 'id'},
                { data: 'appType', name: 'appType' , searchable:true},
                { data: 'services', name: 'services' , searchable:true},
                { data:'customerId', name:'customerId' , searchable:true, orderable: true},
                { data:'offerteStatus', name:'offerteStatus' , searchable:true},
                { data:'created_at',name:'created_at', searchable:true},
                { data: 'option', name: 'option', orderable: false, searchable: false ,exportable:false},
        ];
        // Eğer kullanıcı superAdmin ise 'docTaken' sütununu ekle
        if (userPerm.includes('superAdmin')) {
            columns.splice(-2, 0, {
                data: 'offerPrice',
                name: 'offerPrice',
                searchable: false,
            });
        }
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
            "columnDefs": [
                {
                    "className": "dt-center",
                    "targets": 1,
                    "createdCell": function(td, cellData, rowData, row, col) {
                        if (cellData == 0) {
                            $(td).html(
                                '<span class="bg-custom-danger px-3 py-1 text-center shadow" >Nein<i class="text-center feather feather-x-circle pl-1"></i></span>'
                            )
                        } else if (cellData == 1) {
                            
                            $(td).html(
                                '<span class="bg-custom-success px-3 py-1 text-center shadow" >Gemacht <i class="text-center feather feather-check-circle pl-1"></i></span>'
                            )
                        } else if(cellData == 2) {
                            $(td).html(
                                '<span class="bg-custom-danger px-3 py-1 text-center shadow" >Nein<i class="text-center feather feather-x-circle pl-1"></i></span>'
                            )
                        }
                    }
                },
                {
                    "className": "dt-center",
                    "targets": 4,
                    "createdCell": function(td, cellData, rowData, row, col) {
                        if (cellData == 'Onaylandı') {
                            $(td).html(
                                '<span class="bg-custom-success px-3 py-1 text-center shadow" >Bestätigt <i class="text-center feather feather-check-circle pl-1"></i></span>'
                            )
                        } else if (cellData == 'Beklemede') {
                            
                            $(td).html(
                                '<span class="bg-custom-warning px-3 py-1 text-center shadow" >Offen<i class="text-center feather feather-alert-circle pl-1"></i></span>'
                            )
                        } else if(cellData == 'Onaylanmadı') {
                            $(td).html(
                                '<span class="bg-custom-danger px-3 py-1 text-center shadow" >Abgesagt<i class="text-center feather feather-x-circle pl-1"></i></span>'
                            )
                        }
                    }
                },
                
                {
                    "targets": 5,
                    "createdCell": function(td, cellData, rowData, row, col) {
                        $(td).html(cellData);
                        $("#gratTotalPriceDiv2").html(cellData); // gratTotalPrice sütununu div'e yazdırma
                    }
                },
                        
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
                    d.umzugmin_date = $('#umzugstart_date').val();
                    d.umzugmax_date = $('#umzugend_date').val();
                    d.serviceType = $('#serviceType').val();
                    d.typeFilter = checkedValues;
                    d.zimmerFilter = checkedZimmers;
                    d.standType = $('#standType').val();
                    d.appType = $('#appType').val();
                    d.searchInput =  $('#searchInput').val(); // Müşteri adı veya soyadı arama değeri
                    d.contactPersonInput = $('#contactPersonSearch').val();
                    return d
                },
                
            },
            columns: columns,
            

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
                let bestatigPercent = (rsTot.filteredBestatig / rsTot.recordsFiltered)*100;
                bestatigPercent = bestatigPercent.toFixed(2);
                $('#filteredOfferte').text(rsTot.recordsFiltered + '/' + rsTot.totalOfferte);
                $('#percentBestatig').text('%'+bestatigPercent);
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

        $('#zimmer-container').on('change', function () {
                table.draw();
                console.log(checkedZimmers,'zimmer değerleri')
        })

        $('#contactPersonSearch').keyup(function(){
            table.draw();
        })
        $('#start_date, #end_date, #umzugstart_date, #umzugend_date, #serviceType, #standType,#appType,#searchInput').on('change', function() {
            table.draw();
        });
        $('#reset').on('click', function() {
            $('#start_date').val('');
            $('#end_date').val('');
            $('#umzugstart_date').val('');
            $('#umzugend_date').val('');
            $('#serviceType').val('Alle');
            $('#standType').val('Alle');
            $('#appType').val('Alle');
            $('#searchInput').val('');
            $('#contactPersonSearch').val('');
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


{{-- Notiz İşlemleri --}}
<script>
    $(document).on('click', '.notizButton', function () {
        // reinitialise hatası için her butona tıkladığında datatable oluşturmuşsa destroy ediyoruz
        if ($.fn.DataTable.isDataTable('#notizTable')) {
            $('#notizTable').DataTable().destroy();
        }
        var offerId = $(this).data('id');
        var customerId = $(this).data('customer');
        var url = '/note/data/' + offerId;
        $('#offerId').val(offerId);
        console.log(customerId,'Müşteri ID')

        $.ajax({
                url: '/note/getCustomer/' + customerId,
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                type: 'GET',
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}', // CSRF token
                },
                success: function (response) {
                    var customerName = response.data.name+' '+response.data.surname;
                    $('#customerName').text(customerName)
                    console.log(customerName,'Müşteri ')
                    
                },
                error: function (response) {
                    $('#customerName').text('No Name')
                    console.log(response, 'Müşteri  Hatası');
                }
        });
        
        tableDrawer(url)
        
    });

    function tableReloader()
    {
        if ($.fn.DataTable.isDataTable('#notizTable')) {
            var table = $('#notizTable').DataTable();
            table.search('').draw();
        }

    }

    function addNewNotiz(element) {
        var offerId = $('#offerId').val();
        
        var url = '/note/create/' + offerId
        var note = $('#note').val();
        if(note)
        {
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                type: 'POST',
                dataType: 'json',
                data: {
                '_token': '{{ csrf_token() }}', // CSRF token
                'note': note // noticeArea değeri
                },
                success: function (response) {
                    toastr.success('ERFOLGREICH HINZUGEFÜGT')
                    $('#note').val('');
                    $('#addNotizModal').modal('hide');
                    tableReloader();
                },
                error: function (response) {
                    toastr.success(response,'FEHLER! HINZUFÜGUNG NICHT MÖGLICH')
                    console.log(response,'Add New Erstellen Error')
                }
            })
        }
        else{
            toastr.error('FELD DARF NICHT LEER BLEIBEN')
        }
        
    }
    function tableDrawer(url)
    {
        let noteTable =  $('#notizTable').DataTable( {
            lengthMenu: [[25, 100, -1], [25, 100, "All"]],
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            scrollY: '50vh',
            paging: false,
            ajax: {
                type:'POST',
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                url: url,
                data: function (d) {
                    d.startDate = $('#datepicker_from').val();
                    d.endDate = $('#datepicker_to').val();
                }
            },
            "order": [0, 'desc'],
            columns: [
                { data: 'id', name: 'id'},
                { data: 'offerId', name: 'offerId'},
                {
                    data: 'note',
                    name: 'note',
                    render: function (data, type, row) {
                        if (type === 'display' && data.length > 30) { // 50 karakter sınırı, istediğiniz uzunluğu ayarlayabilirsiniz
                            return data.substr(0, 30) + '...';
                        }
                        return data;
                    }
                },
                { data: 'created_at', name: 'created_at'},
                { data: 'updated_at', name: 'updated_at'},
                { data: 'option', name: 'option', orderable: false, searchable: false },
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
        $('#notizTable_filter input').keyup(function() {
            noteTable
                .search(
                    jQuery.fn.DataTable.ext.type.search.string(this.value)
                )
                .draw();
        });
        $('#notizTable').css('overflow-x','hidden');
    }
</script>
    {{-- Notiz Update Fonksiyonu --}}
    <script>
        function notizEdit(id){
            var url = '/note/edit/' + id;
            $('#notizIdHolder').val(id);
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                type: 'GET',
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}', // CSRF token
                },
                success: function (response) {
                    var note = response.note; // response'dan note değerini alın
                    $('#editNotiz').val(note);
                    $('#notizId').text(response.id);
                },
                error: function (response) {
                    console.log(response, 'Notice Edit Hatası');
                }
            });
        }

        function notizDetail(id){
            var url = '/note/edit/' + id;
            $('#notizIdDetail').val(id);
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                type: 'GET',
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}', // CSRF token
                },
                success: function (response) {
                    var note = response.note; // response'dan note değerini alın
                    $('#detailNotiz').val(note);
                    $('#notizIdDetail').text(response.id);
                },
                error: function (response) {
                    console.log(response, 'Notice Edit Hatası');
                }
            });
        }

        function notizDelete(id){
            var url = '/note/edit/' + id;
            $('#notizIdDelete').text(id);
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                type: 'GET',
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}', // CSRF token
                },
                success: function (response) {
                    $('#notizIdDelete').text(response.id);
                },
                error: function (response) {
                    console.log(response, 'Notice Edit Hatası');
                }
            });
        }
        
        function notizDeleteVerify(id){
            var id = $('#notizIdDelete').text();
            var url = '/note/delete/' + id;
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                type: 'GET',
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}', // CSRF token
                },
                success: function (response) {
                    toastr.success('ERFOLGREICH GELÖSCHT');
                    $('#deleteNotizModal').modal('hide');
                    tableReloader();
                },
                error: function (response) {
                    toastr.error('FEHLER! LÖSCHUNG NICHT MÖGLICH')
                }
            });
        }
        
        function updateNotiz(id){
            var id = $('#notizIdHolder').val();
            var url = '/note/edit/' + id;
            var note = $('#editNotiz').val();
            if(note)
            {
                $.ajax({
                    url: url,
                    headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                    type: 'POST',
                    dataType: 'json',
                    data: {
                    '_token': '{{ csrf_token() }}', // CSRF token
                    'note': note // noticeArea değeri
                    },
                    success: function (response) {
                        toastr.success('NICHT ERFOLGREICH AKTUALISIERT')
                        $('#editNotizModal').modal('hide');
                        tableReloader();
                    },
                    error: function (response) {
                        toastr.error(response,'FEHLER! AKTUALISIERUNG NICHT MÖGLICH')
                        console.log(response,'Add New Erstellen Error')
                    }
                })
            }
            else{
                toastr.error('FELD DARF NICHT LEER BLEIBEN')
            }
        }
    </script>
  {{-- Notiz Update Fonksiyonu --}}

@endsection