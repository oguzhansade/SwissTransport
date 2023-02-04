
@section('header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" rel="stylesheet" type="text/css">
@endsection

<div class="row">
    <div class="col-md-12">
        <div class="table-reponsive">
            <table id="faturaData" class="table">
                <thead>
                    <tr>
                        <th>Kalem</th>
                        <th>Ürün</th>
                        <th>Adet / Gün</th>
                        <th>Tutar</th>
                        <th>Toplam Tutar</th>
                        <th>Kdv</th>
                        <th>Kdv Toplam</th>
                        <th>Genel Toplam</th>
                        <th>Açıklama</th>
                        <th>Kaldır</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<button type="button" id="addRowBtn" class="btn-rounded btn btn-primary">+</button>

<div class="row">
    <div class="col-md-12">
        <table class="table">
            <tr>
                <td align="left">Ara toplam:</td>
                <td align="right" class="ara_toplam">0.00</td>
            </tr>

            <tr>
                <td align="left">Kdv toplam:</td>
                <td align="right" class="kdv_toplam">0.00</td>
            </tr>

            <tr>
                <td align="left">Gnl. toplam:</td>
                <td align="right" class="genel_toplam">0.00</td>
            </tr>
        </table>
    </div>
</div>

@section('footer')



<script>
    var i = $(".islem_field").lenght;
    $("#addRowBtn").click(function () {
        
        console.log('TIKLANDI')
    });


    $("body").on("change",".kalem",function () {
         var kdv = $(this).find(":selected").data("k");
         $(this).closest(".islem_field").find("#kdv").val(kdv);
    })

    $("body").on("change",".urun",function () {
        var fiyat = $(this).find(":selected").data("fiyat");
        $(this).closest(".islem_field").find("#tutar").val(fiyat);
    })

    $("body").on("click","#removeButton", function () {
        $(this).closest(".islem_field").remove();
        calc();
    })

    $("body").on("change","#faturaData input", function (){

        var $this = $(this);
        if($this.is("#tutar, #gun_adet, #toplam_tutar, #genel_tutar, #kdv"))
        {
            var adet = $this.closest("tr").find("#gun_adet").val();
            var tutar = $this.closest("tr").find("#tutar").val();
            var kdv = $this.closest("tr").find("#kdv").val();
            var toplam_tutar;
            var genel_tutar;
            var kdv_tutar;

            if (adet =="" && tutar=="") 
            {
                toplam_tutar = $this.closest("tr").find("#toplam_tutar").val();
                if(toplam_tutar == "")
                {
                    genel_tutar = parseFloat($this.closest("tr").find("#genel_toplam").val());
                    kdv_tutar = genel_tutar/(1+kdv/100);
                    toplam_tutar = genel_tutar - kdv_tutar;
                }
                else
                {
                    toplam_tutar=parseFloat($this.closest("tr").find("#toplam_tutar").val());
                    kdv_tutar = toplam_tutar*kdv/100;
                    genel_tutar = kdv_tutar+toplam_tutar;
                }
            }
            else {
                toplam_tutar = adet * tutar;
                kdv_tutar = toplam_tutar*kdv/100;
                genel_tutar = toplam_tutar+kdv_tutar;
            }
            
            kdv_tutar = kdv_tutar.toFixed(2);
            toplam_tutar = toplam_tutar.toFixed(2);
            genel_tutar = genel_tutar.toFixed(2);
            $this.closest("tr").find("#toplam_tutar").val(toplam_tutar);
            $this.closest("tr").find("#kdv_toplam").val(kdv_tutar);
            $this.closest("tr").find("#genel_toplam").val(genel_tutar);
        }
        calc();
    });

    function calc() {

        var kdv_toplam = 0;
        var ara_toplam = 0;
        var genel_toplam = 0;

        $("[id=kdv_toplam]").each(function () {
            kdv_toplam = parseFloat(kdv_toplam) + parseFloat($(this).val());
        });

        $("[id=toplam_tutar]").each(function () {
           ara_toplam = parseFloat(ara_toplam) + parseFloat($(this).val());
        });

        $("[id=genel_toplam]").each(function () {
            genel_toplam = parseFloat(genel_toplam) + parseFloat($(this).val());
        });

        $(".kdv_toplam").html(kdv_toplam);
        $(".ara_toplam").html(ara_toplam);
        $(".genel_toplam").html(genel_toplam);

    }
</script>

@endsection