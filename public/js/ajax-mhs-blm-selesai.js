function update_tabel_mhs() {
  $.ajax({
    type: 'GET',
    url: '/mhs/daftar_mhs_belum_selesai/update_tabel_belum_selesai',
    success: function(response) {
      $('#tabel-belum-selesai').html(response.view);
      let tabel = simpleDatatable();
    },
    error: function(response) {
      console.log('Error:', response);
    }
  });
}

$(document).on('click', '#reset-status', function() {
  Swal.fire({
    title: 'Apakah Anda yakin?',
    text: "Status seluruh mahasiswa yang ada pada tabel akan direset menjadi Nonaktif!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Reset'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: 'PUT',
        url: '/mhs/daftar_mhs_belum_selesai/reset_status',
        data:{
          arr_nim: $(this).data('arr-nim'),
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          Swal.fire({
            icon: 'success',
            title: 'Status seluruh mahasiswa berhasil direset',
            showConfirmButton: false,
            timer: 1500
          });
          // update_tabel_mhs();
          tabel.clear().draw();
        },
        error: function(response) {
          console.log('Error:', response);
          Swal.fire({
            icon: 'error',
            title: 'Status seluruh mahasiswa gagal direset',
            showConfirmButton: false,
            timer: 1500
          });
        }
      });
    }
  });
});

$(document).on('click', '.btn-detail-mhs', function() {
  let data_mhs = $(this).data('mhs');

  $("#data-nama").html(data_mhs.nama);
  $("#data-nim").html(data_mhs.nim);
  $("#data-instansi").html(data_mhs.instansi);
  $("#data-judul-pkl").html(data_mhs.judul);
  $("#data-dospem").html(data_mhs.nama_dospem || "-");
  $("#data-judul-pkl").html(data_mhs.judul || "-");
  $("#data-instansi").html(data_mhs.instansi || "-");
  $("#data-no-wa").html(data_mhs.no_wa || "-");
  $("#data-email").html(data_mhs.email || "-");

  if(data_mhs.keyword1 != null){
    let keyword = data_mhs.keyword1 + '; ' + data_mhs.keyword2 + '; ' + data_mhs.keyword3;

    if(data_mhs.keyword4 != null){
      keyword += '; ' + data_mhs.keyword4;
    }
    if(data_mhs.keyword5 != null){
      keyword += '; ' + data_mhs.keyword5;
    }
    $("#data-kata-kunci").html(keyword);
  } else {
    $("#data-kata-kunci").html("-");
  }

  if(data_mhs.abstrak != null){
    $("#data-abstrak").off("click", "#readToggle");
  
    $("#data-abstrak").addClass("collapsed");
    var $dataAbstrak = $("#data-abstrak");
    var maxLength = 200;
  
    var originalText = data_mhs.abstrak;
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
  } else {
    $("#data-abstrak").html("-");
  }
});