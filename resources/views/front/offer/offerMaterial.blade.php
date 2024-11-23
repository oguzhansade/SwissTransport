@section('header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" rel="stylesheet" type="text/css">
<style>
#removeButton {
    box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
}
</style>
@endsection

<div class="row p-3">
    <div id="alert-container" class="col-md-12">

    </div>
    <div class="col-md-12">
        <div class="table-reponsive">
            <table id="faturaData" class="table">
                <thead>
                    <tr class="text-dark">
                        <th>Produktname</th>
                        <th>Mieten/Kaufen</th>
                        <th>Preis</th>
                        <th>Anzahl</th>
                        <th>Total</th>
                        <th>Löschen</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div class="row  d-flex justify-content-center align-items-center text-center">
    <div class="col-md-12">
        <span id="urun_adet"  class="h5 urun_adet">Sie haben noch keine Produkte hinzugefügt</span>
    </div>
</div>
<div class="row p-3">
    <div class="col-md-12 d-flex justify-content-center">
        <button type="button"  id="addRowBtn" class="box-shadow btn-rounded btn btn-primary " style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;"> <i class="feather feather-plus "></i>Hinzufügen</button>
        <button type="button" id="removeAllButton" class="btn-rounded btn btn-danger ml-1" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">Alles löschen</button>
    </div>
</div>
<div id="faturaData">

    <div class="row p-3">
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Reduktion </label>
            <input class="form-control indirim" name="materialDiscount" type="number" value="0" min="0">
        </div>
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Reduktion[%]</label>
            <input class="form-control indirim_yuzde" name="materialDiscountPercent" type="number" value="0" min="0">
        </div>
    </div>

    <div class="row p-3">
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Lieferung</label>
            <input class="form-control teslimat_ucreti" name="materialShipPrice" type="number" value="40" min="0">
        </div>
    </div>

    <div class="row p-3">
        <div class="col-md-6">
            <label class="col-form-label" for="l0">Abholung</label>
            <input class="form-control toplama_ucreti" name="materialRecievePrice" type="number" value="40" min="0">
        </div>
    </div>
</div>


<div class="row p-3">
    <div class="col-md-6">
        <label class="col-form-label" for="l0">Total</label>
        <input class="form-control ara_toplam" name="materialTotalPrice" type="text" value="0">
    </div>
</div>

@section('offerMaterialCreate')


<script>
    let say = 0;
    var i = $(".islem_field").length || 0;

    // Yeni satır ekleme butonu
    $("#addRowBtn").click(function () {
        var topitop = 0;

        $("[id=toplam]").each(function () {
            topitop++;
        });

        let adet = say + 1;
        $(".urun_adet").html(adet + ' ' + 'Stück Produkte');
        console.log(topitop + 1, 'ADET');

        var newRow = `
        <tr class="islem_field">
            <td>
                <select class="form-control urun" name="islem[${i}][urunId]" required>
                    <option class="form-control" value="0"> Bitte wählen </option>
                    @foreach (\App\Models\Product::all() as $value)
                        <option class="form-control"
                            data-id="{{ $value->id }}"
                            data-kirala="{{ $value->rentPrice }}"
                            data-fiyat="{{ $value->buyPrice }}"
                            data-urunadi="{{ $value->productName }}"
                            value="{{ $value->id }}">{{ $value->productName }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="form-control buyType" name="islem[${i}][buyType]" required>
                    <option class="form-control" data-buy="0" value="0">Bitte wählen</option>
                    <option class="form-control" data-buy="1" value="1">Kaufen</option>
                    <option class="form-control" data-buy="2" value="2">Mieten</option>
                </select>
            </td>
            <td><input type="text" class="form-control" id="tutar" name="islem[${i}][tutar]" value="0"></td>
            <td><input type="text" class="form-control" id="adet" name="islem[${i}][adet]" value="1"></td>
            <td><input type="text" class="form-control" id="toplam" name="islem[${i}][toplam]" value="0"></td>
            <td>
                <button id="removeButton" type="button" class="btn btn-danger remove-btn">X</button>
            </td>
        </tr>`;

        $(newRow).appendTo("#faturaData");

        i++;
        say++;
    });

    // İşlem alanında değişiklik
    $("body").on("change", ".islem_field", function () {
        const $islemField = $(this);
        const urun = $islemField.find(".urun :selected");
        const fiyat = parseFloat(urun.data("fiyat")) || 0;
        const kirala = parseFloat(urun.data("kirala")) || 0;
        const buyType = $islemField.find(".buyType :selected").data("buy");
        let adet = parseFloat($islemField.find("#adet").val()) || 0;

        // Tutarı belirle
        let tutar = buyType === 1 ? fiyat : buyType === 2 ? kirala : 0;
        $islemField.find("#tutar").val(tutar.toFixed(2));
        $islemField.find("#toplam").val((tutar * adet).toFixed(2));

        calc();
    });

    // Satır silme işlemi
    $("body").on("click", "#removeButton", function () {
        say--;
        $(".urun_adet").html(say > 0 ? say + ' Stück Produkte' : 'Sie haben noch keine Produkte hinzugefügt');
        $(this).closest(".islem_field").remove();
        calc();
    });

    // Tüm satırları silme
    $("body").on("click", "#removeAllButton", function () {
        say = 0;
        $(".urun_adet").html('Sie haben noch keine Produkte hinzugefügt');
        $("[id=toplam]").each(function () {
            $(this).closest(".islem_field").remove();
        });
        calc();
    });

    // Tutar/Adet değişikliklerinde güncelleme
    $("body").on("change", "#faturaData input", function () {
        const $this = $(this);
        if ($this.is("#tutar, #adet, #toplam")) {
            const $row = $this.closest("tr");
            const adet = parseFloat($row.find("#adet").val()) || 0;
            const tutar = parseFloat($row.find("#tutar").val()) || 0;

            const toplam = (adet * tutar).toFixed(2);
            $row.find("#toplam").val(toplam);
        }
        calc();
    });

    // Toplamları hesaplama
    function calc() {
        let ara_toplam = 0;
        const indirim = parseFloat($("input[name=materialDiscount]").val()) || 0;
        const indirimyuzde = parseFloat($(".indirim_yuzde").val()) || 0;
        const teslimat_ucreti = parseFloat($(".teslimat_ucreti").val()) || 0;
        const teslimalma_ucreti = parseFloat($(".toplama_ucreti").val()) || 0;

        $("[id=toplam]").each(function () {
            ara_toplam += parseFloat($(this).val()) || 0;
        });

        ara_toplam += teslimat_ucreti + teslimalma_ucreti - indirim - (ara_toplam * indirimyuzde / 100);
        $(".ara_toplam").val(ara_toplam.toFixed(2));
    }
</script>

@endsection
