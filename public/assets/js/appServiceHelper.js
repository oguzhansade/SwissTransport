$(document).ready( function(){
        
    let dateArray = [];
    var tarih1 = $('input[name=umzug1date]').val();
    dateArray[dateArray.length] = '<tr>' + '<td>Umzug</td>' + '<td> ' + tarih1 +'</td>'+ '</tr>' + '<br>';
    console.log(dateArray,'Tarihler');
    // TODO: bu bölüm blade import değil api olarak kullanılacak
    setTimeout(() => {
        tinymce.get("customEmail").setContent(`@include('../../cemail',['date' => '${dateArray}'])`);
    tinymce.execCommand("mceRepaint");
    }, 500);
    
    $("input[name=umzug1date]").on("input", function(){
    
    let dateArray = []; // Güncelleme sayfası olduğu için array in tekrardan sıfırlanması gerekiyor yoksa yanına ekler
    var tarih1 = $(this).val();
    dateArray[dateArray.length] = '<tr>' + '<td>Umzug</td>' + '<td> ' + tarih1 +'</td>'+ '</tr>' + '<br>'
    console.log(dateArray,'Tarihler');
    // TODO: bu bölüm blade import değil api olarak kullanılacak
    tinymce.get("customEmail").setContent(`@include('../../cemail',['date' => '${dateArray}'])`);
    tinymce.execCommand("mceRepaint");
         
    }); 
         
});