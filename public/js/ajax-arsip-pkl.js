let periode_pkl = $('#periode-pkl').val();
var arr_periode = $('#periode-pkl').find('option').map(function() {
  // Memeriksa apakah nilai value tidak kosong
  if ($(this).val() !== "") {
      return $(this).val();
  }
}).get();

let tabel_arsip;

$(document).on('change', '#periode-pkl', function() {
  periode_pkl = $(this).val();

  $.ajax({
    url: '/arsip_pkl/update_tabel_arsip/',
    method: 'GET',
    data: {
      periode_pkl: periode_pkl,
      arr_periode: arr_periode
    },
    success: function(response) {
      $('#tabel-arsip').html(response.html);
      tabel_arsip = simpleDatatable();
      tabel_arsip.order([[1, 'asc'],[3, 'desc'],[4, 'asc']]).draw();
    },
    error: function(response) {
      console.log(response);
    }

  });
  
});

$(document).on('click', '#btn-export', function() {
  $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);

  let arr_arsip = JSON.parse($('#data-arsip').attr('data-arsip'));

  // Membuat objek data yang akan dikirimkan
  let postData = {
    arr_arsip: arr_arsip
  };

  // Mengirimkan data dengan metode POST menggunakan AJAX
  $.ajax({
    url: '/arsip_pkl/export_nilai',
    type: 'POST',
    data: postData,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    xhrFields: {
      responseType: 'blob' // Mengatur responseType ke 'blob' untuk menerima data biner
    },
    success: function(response, status, xhr) {
      // Membuat objek URL untuk file Excel
      var url = window.URL.createObjectURL(new Blob([response]));

      // Membuat elemen anchor untuk memicu unduhan file
      var a = document.createElement('a');
      a.href = url;
      a.download = 'export_nilai.xlsx';

      // Menambahkan elemen anchor ke dokumen dan memicu unduhan file
      document.body.appendChild(a);
      a.click();

      // Menghapus elemen anchor setelah selesai
      window.URL.revokeObjectURL(url);
    },
    error: function(xhr, status, error) {
      // Handle error
      console.error(error);
    },
    complete: function() {
      $('#btn-export').html('Export Nilai').prop('disabled', false);
    }
  });
});


