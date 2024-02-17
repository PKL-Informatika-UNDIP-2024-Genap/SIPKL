let periode_pkl = $('#periode-pkl').val();
var arr_periode = $('#periode-pkl').find('option').map(function() {
  // Memeriksa apakah nilai value tidak kosong
  if ($(this).val() !== "") {
      return $(this).val();
  }
}).get();

let tabel_arsip;

$(document).on('click', '.btn-detail', function() {
  let data_arsip = JSON.parse($(this).attr('data-arsip'));
  
  $("#data-nama").html(data_arsip.nama);
  $("#data-nim").html(data_arsip.nim);
  $("#data-instansi").html(data_arsip.instansi);
  $("#data-judul-pkl").html(data_arsip.judul);
  $("#data-periode-pkl").html(data_arsip.periode_pkl);

  let nilai = data_arsip.nilai;
  if(nilai == "A"){
    $("#data-nilai").html("<h5 class='p-0 m-0'><span class='badge bg-success'>A</span></h5>");
  } else if(nilai == "B"){
    $("#data-nilai").html("<h5 class='p-0 m-0'><span class='badge bg-primary'>B</span></h5>");
  } else if(nilai == "C"){
    $("#data-nilai").html("<h5 class='p-0 m-0'><span class='badge bg-warning'>C</span></h5>");
  }

  let link = data_arsip.link_laporan;
  if (!link.startsWith('http://') || !link.startsWith('https://') || !link.startsWith('//')) {
    link = 'https://' + link;
  }
  $("#data-link-laporan").attr("href", link);

  let keyword = data_arsip.keyword1 + '; ' + data_arsip.keyword2 + '; ' + data_arsip.keyword3;

  if(data_arsip.keyword4 != null){
    keyword += '; ' + data_arsip.keyword4;
  }
  if(data_arsip.keyword5 != null){
    keyword += '; ' + data_arsip.keyword5;
  }
  
  $("#data-kata-kunci").html(keyword);

  $("#data-abstrak").off("click", "#readToggle");

  $("#data-abstrak").addClass("collapsed");
  var $dataAbstrak = $("#data-abstrak");
  var maxLength = 200;

  var originalText = data_arsip.abstrak;
  var truncatedText = originalText.substring(0, maxLength);

  // Menambahkan teks yang akan ditampilkan dan tombol "read more"
  $dataAbstrak.html(truncatedText + '<span id="readToggle" style="cursor: pointer; color: blue;"> Read more...</span>');

  // Menambahkan event listener untuk menangani klik pada tombol "read more" atau "read less"
  $dataAbstrak.on("click", "#readToggle", function() {
    if ($dataAbstrak.hasClass("collapsed")) {
      // Menampilkan seluruh teks abstrak dan tombol "read less"
      $dataAbstrak.html(originalText + '<span id="readToggle" style="cursor: pointer; color: blue;"> Read less</span>');
      $dataAbstrak.removeClass("collapsed");
    } else {
      // Menampilkan teks yang dipotong dan tombol "read more"
      $dataAbstrak.html(truncatedText + '<span id="readToggle" style="cursor: pointer; color: blue;"> Read more...</span>');
      $dataAbstrak.addClass("collapsed");
    }
  });
});


