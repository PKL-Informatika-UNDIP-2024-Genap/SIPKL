let periode_pkl = $('#periode-pkl').val();
var arr_periode = $('#periode-pkl').find('option').map(function() {
  // Memeriksa apakah nilai value tidak kosong
  if ($(this).val() !== "") {
      return $(this).val();
  }
}).get();

let tabel_arsip;

function simpleDatatable() {
	const table = new DataTable('#myTable', {
    columnDefs: [
      {
        searchable: false,
        orderable: false,
        targets: [0, "action"]
      },
    ],
    order: [[1, 'asc']],
    lengthMenu: [5, 10, 25, 50],
    pageLength: 10,
    buttons: [
      {
        extend: 'excelHtml5',
        text: 'Export to Excel',
        filename: 'export_nilai',
        exportOptions: {
          columns: ':visible', // Ini akan mengekspor semua kolom yang terlihat
          columns: ':not(:last-child)' // Ini akan mengekspor semua kolom kecuali kolom terakhir
        }
      }
    ],
    "initComplete": function (settings, json) {
      $.fn.dataTable.ext.search.push(
        function (settings, data, index) {
          if (settings.nTable.id !== 'myTable') {
            return true;
          }
          var selectedPeriode = $('#periode-pkl').val();
          if (selectedPeriode == "") {
            return true;
          }
          if (selectedPeriode == data[3]) {
            return true;
          }
          return false;
        }
      )
    }
  });


  $('#myTable_filter input').css('width', '210px');
  table.on('order.dt search.dt', function () {
    let i = 1;
    table
      .cells(null, 0, { search: 'applied', order: 'applied' })
      .every(function (cell) {
        this.data(i++);
      });
  }).draw();

	return table;
}

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

// $(document).on('click', '#btn-export', function() {
//   $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);

//   let arr_arsip = JSON.parse($('#data-arsip').attr('data-arsip'));

//   // Membuat objek data yang akan dikirimkan
//   let postData = {
//     arr_arsip: arr_arsip
//   };

//   // Mengirimkan data dengan metode POST menggunakan AJAX
//   $.ajax({
//     url: '/arsip_pkl/export_nilai',
//     type: 'POST',
//     data: postData,
//     headers: {
//       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     },
//     xhrFields: {
//       responseType: 'blob' // Mengatur responseType ke 'blob' untuk menerima data biner
//     },
//     success: function(response, status, xhr) {
//       // Membuat objek URL untuk file Excel
//       var url = window.URL.createObjectURL(new Blob([response]));

//       // Membuat elemen anchor untuk memicu unduhan file
//       var a = document.createElement('a');
//       a.href = url;
//       a.download = 'export_nilai.xlsx';

//       // Menambahkan elemen anchor ke dokumen dan memicu unduhan file
//       document.body.appendChild(a);
//       a.click();

//       // Menghapus elemen anchor setelah selesai
//       window.URL.revokeObjectURL(url);
//     },
//     error: function(xhr, status, error) {
//       // Handle error
//       console.error(error);
//     },
//     complete: function() {
//       $('#btn-export').html('Export Nilai').prop('disabled', false);
//     }
//   });
// });

$(document).on('click', '.btn-detail', function() {
  let data_arsip = JSON.parse($(this).attr('data-arsip'));
  
  $("#data-nama").html(data_arsip.nama);
  $("#data-nim").html(data_arsip.nim);
  $("#data-instansi").html(data_arsip.instansi);
  $("#data-judul-pkl").html(data_arsip.judul);
  $("#data-periode-pkl").html(data_arsip.periode_pkl);

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


