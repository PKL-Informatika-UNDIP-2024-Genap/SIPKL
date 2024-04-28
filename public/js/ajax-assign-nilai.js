let data_mhs;

function update_tabel_nilai() {
  $.ajax({
    type: 'GET',
    url: '/pkl/assign_nilai/update_tabel_nilai',
    success: function(response) {
      $('#tabel-nilai').html(response.view);
      let tabel = simpleDatatable();
      tabel.order([3, 'asc']).draw();
    },
    error: function(response) {
      console.log('Error:', response);
    }
  });
}

function formatDate(dateString) {
  const date = new Date(dateString);
  const options = {
    day: "numeric",
    month: "long",
    year: "numeric"
  };
  return date.toLocaleDateString("id-ID", options);
}

$(document).on('click', '.btn-detail-nilai', function() {
  data_mhs = JSON.parse($(this).attr('data-mhs'));
  console.log(data_mhs);
  $("#data-nama").html(data_mhs.nama);
  $("#data-nim").html(data_mhs.nim);
  $("#data-instansi").html(data_mhs.instansi);
  $("#data-judul-pkl").html(data_mhs.judul);
  $("#data-tgl-verif-laporan").html(formatDate(data_mhs.tgl_verif_laporan));
  $("#data-dospem").html(data_mhs.nama_dospem);
  if(data_mhs.no_wa == null){
    $("#link-wa").attr("href", "#");
    $("#btn-wa").attr("disabled", "true");
  } else {
    $("#btn-wa").removeAttr("disabled");
    $("#link-wa").attr("href", "https://wa.me/" + data_mhs.no_wa);
  }


  let link = data_mhs.link_laporan;
  if (!link.startsWith('http://') || !link.startsWith('https://') || !link.startsWith('//')) {
    link = 'https://' + link;
  }
  $("#data-link-laporan").attr("href", link);

  let keyword = data_mhs.keyword1 + '; ' + data_mhs.keyword2 + '; ' + data_mhs.keyword3;

  if(data_mhs.keyword4 != null){
    keyword += '; ' + data_mhs.keyword4;
  }
  if(data_mhs.keyword5 != null){
    keyword += '; ' + data_mhs.keyword5;
  }
  
  $("#data-kata-kunci").html(keyword);

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
});

$(document).on('click', '.btn-simpan', function() {
  Swal.fire({
    title: 'Apakah anda yakin menyimpan nilai PKL mahasiswa ini?',
    text: "Nilai PKL mahasiswa yang sudah disimpan tidak dapat diubah lagi, pastikan sudah benar sebelum menyimpan",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#007bff',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'Terima',
    cancelButtonText: 'Batal',
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/pkl/assign_nilai/'+ data_mhs.nim +'/assign',
        type: 'POST',
        data: { nilai : $('input[name="nilai"]:checked').val() },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
          $("#modal-detail-nilai").modal('hide');
          Swal.fire({
            title: 'Berhasil!',
            text: 'Berhasil menerima nilai mahasiswa dengan nim ' + data_mhs.nim,
            icon: 'success',
          });
          update_tabel_nilai();
        },
        error: function (error) {
          console.error('Error:', error);
          Swal.fire({
            title: 'Error!',
            text: error.responseJSON.message,
            icon: 'error',
          });
        },
      });
    }
  });
});

$(document).on('click', '.btn-tolak', function() {
  Swal.fire({
    title: 'Apakah anda yakin menolak nilai mahasiswa ini?',
    text: "nilai mahasiswa yang sudah ditolak tidak dapat dibatalkan lagi",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#dc3545',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'Tolak',
    cancelButtonText: 'Batal',
    input: 'text',
    inputPlaceholder: 'Tuliskan alasan menolak...',
    inputValidator: (value) => {
      if (!value) {
        return 'Anda harus memberikan alasan untuk menolak.';
      }
    }
  }).then((result) => {
    if (result.isConfirmed) {
      var alasan_menolak = Swal.getInput().value;

      $.ajax({
        url: '/pkl/assign_nilai/' + data_mhs.nim + '/tolak',
        type: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        data: { alasan_menolak: alasan_menolak },
        success: function(response) {
          $("#modal-detail-nilai").modal('hide');
          Swal.fire({
            title: 'Berhasil!',
            text: 'Berhasil menolak nilai mahasiswa dengan nim ' + data_mhs.nim,
            icon: 'success',
          });
          update_tabel_nilai();
        },
        error: function(error) {
          console.error('Error:', error);
          Swal.fire({
            title: 'Error!',
            text: 'Terjadi kesalahan.',
            icon: 'error',
          });
        },
      });
    }
  });
});
