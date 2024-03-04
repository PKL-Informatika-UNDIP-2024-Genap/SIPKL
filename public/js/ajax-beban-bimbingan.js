let periode_pkl = $('#periode-pkl').val();
var arr_periode = $('#periode-pkl').find('option').map(function() {
  // Memeriksa apakah nilai value tidak kosong
  if ($(this).val() !== "") {
      return $(this).val();
  }
}).get();

let tabel_modal;
let data_dospem;

$(document).on('change', '#periode-pkl', function() {
  $('#tabel-index').html('<div class="d-flex align-items-center"><div class="spinner-border spinner-border-lg me-2" role="status" aria-hidden="true"></div><div class="fs-5">Mengambil Data ...</div></div>');
  
  periode_pkl = $(this).val();

  $.ajax({
    url: '/dospem/beban_bimbingan/update_tabel_index/',
    method: 'GET',
    data: {
      periode_pkl: periode_pkl,
      arr_periode: arr_periode
    },
    success: function(response) {
      $('#tabel-index').html(response.html);
      simpleDatatable();
    },
    error: function(response) {
      console.log(response);
    }

  });
  
});

$(document).on('click', '.btn-detail', function() {
  $("#tabel-modal").html('<div class="d-flex align-items-center"><div class="spinner-border spinner-border-lg me-2" role="status" aria-hidden="true"></div><div class="fs-5">Mengambil Data Bimbingan...</div></div>')
  data_dospem = $(this).data('dospem');

  $("#data-nama").html(data_dospem.nama);
  $("#data-nip").html(data_dospem.nip);
  $("#data-jml-bimbingan").html(data_dospem.jml_bimbingan);
  $('#periode-pkl-modal').val(periode_pkl);

  $.ajax({
    type: "GET",
    url: "/dospem/beban_bimbingan/get_bimbingan/",
    data: {
      id_dospem: data_dospem.id,
      periode_pkl: periode_pkl
    },
    success: function (response) {
      $("#tabel-modal").html(response.html);
      tabel_modal = simpleDatatable2();
    },
    error: function (response) {
      console.log(response);
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Terjadi kesalahan saat mengambil data!',
      });

    }
  });
});

$(document).on('change', '#periode-pkl-modal', function() {
  periode_pkl_modal = $(this).val();
  $("#tabel-modal").html('<div class="d-flex align-items-center"><div class="spinner-border spinner-border-lg me-2" role="status" aria-hidden="true"></div><div class="fs-5">Mengambil Data Bimbingan...</div></div>')

  $.ajax({
    type: "GET",
    url: "/dospem/beban_bimbingan/get_bimbingan/",
    data: {
      id_dospem: data_dospem.id,
      periode_pkl: periode_pkl_modal
    },
    success: function (response) {
      $("#tabel-modal").html(response.html);
      tabel_modal = simpleDatatable2();
    },
    error: function (response) {
      console.log(response);
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Terjadi kesalahan saat mengambil data!',
      });

    }
  });
  
});

$(document).on('click', 'td.details-control', function() {
  let tr = $(this).closest('tr');
  let row = tabel_modal.row(tr);

  if (row.child.isShown()) {
    row.child.hide();
    tr.removeClass('shown');
  }
  else {
    tr.addClass('shown');
    row.child(
      '<div class="row">'+
      '<div class="col-md-4">'+
      '<dl>' +
      '<dt>Instansi PKL:</dt>' +
      '<dd>' + tr.data("instansi") +'</dd>' +
      '</dl>'+
      '</div>'+
      '<div class="col-md-8">'+
      '<dl>' +
      '<dt>Judul PKL:</dt>' +
      '<dd>' + tr.data("judul") +'</dd>' +
      '</dl>'+
      '</div>'+
      '</div>'
    ).show();
  }
});