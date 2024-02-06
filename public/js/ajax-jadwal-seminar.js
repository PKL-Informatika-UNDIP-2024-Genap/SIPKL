let data_mhs;
let data_jadwal;
let data_dospem;
let data_nim;
let data_tgl_seminar;
let data_waktu_seminar;
let data_ruang;
const options = {
  weekday: 'long',
  year: 'numeric',
  month: 'long',
  day: 'numeric',
};

function update_tabel_jadwal() {
  $.ajax({
    type: 'GET',
    url: '/seminar/jadwal_seminar/update_tabel_jadwal',
    success: function(response) {
      $('#tabel-jadwal').html(response.view);
      let tabel = simpleDatatable();
      tabel.order([3, 'asc']).draw();
    },
    error: function(response) {
      console.log('Error:', response);
    }
  });
}

$(document).on('click', '.btn-detail-jadwal', function() {
  data_mhs = JSON.parse($(this).attr('data-mhs'));
  data_jadwal = JSON.parse($(this).attr('data-jadwal'));
  data_dospem = JSON.parse($(this).attr('data-dospem'));

  data_tgl_seminar = data_jadwal.tgl_seminar;
  data_waktu_seminar = data_jadwal.waktu_seminar;
  data_ruang = data_jadwal.ruang;
  
  let tanggal_seminar = new Date(data_jadwal.tgl_seminar);
  tanggal_seminar = tanggal_seminar.toLocaleDateString('id-ID', options);

  $("#data-nama").html(data_mhs.nama);
  $("#data-nim").html(data_mhs.nim);
  $("#data-dospem").html(data_dospem.nama);
  $("#data-tgl-seminar").html(tanggal_seminar);
  $("#data-waktu-seminar").html(data_jadwal.waktu_seminar);
  $("#data-ruang").html(data_jadwal.ruang);
  $("#data-jenis-seminar").html(data_jadwal.status);
});

$(document).on('click', '#btn-edit', function() {
  
  if(!$(this).hasClass('edit')) {
    $(this).addClass('edit');
    $(this).html('Simpan');
    $("#data-tgl-seminar").addClass('d-none');
    $("#data-waktu-seminar").addClass('d-none');
    $("#data-ruang").addClass('d-none');
    $(".edit-item").removeClass('d-none');

    let waktu_seminar = data_jadwal.waktu_seminar.split('-');
    
    $("#input-tgl-seminar").val(data_tgl_seminar);
    $("#input-waktu-mulai").val(waktu_seminar[0]);
    $("#input-waktu-selesai").val(waktu_seminar[1]);
    $("#input-ruang").val(data_jadwal.ruang);
    $("#btn-batal").removeClass('d-none');
  } else {
    let tgl_seminar = $("#input-tgl-seminar").val();
    let waktu_seminar = $("#input-waktu-mulai").val() + '-' + $("#input-waktu-selesai").val();
    let ruang = $("#input-ruang").val();
    console.log(tgl_seminar);
    console.log(waktu_seminar);
    console.log(ruang);
    $.ajax({
      type: "PUT",
      url: "/seminar/jadwal_seminar/" + data_jadwal.nim + "/update",
      data: {
        tgl_seminar: tgl_seminar,
        waktu_seminar: waktu_seminar,
        ruang: ruang,
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response) {
        console.log(response);
        Swal.fire({
          title: "Success",
          text: "Jadwal Seminar mahasiswa dengan nim " + data_jadwal.nim + " Berhasil Diupdate",
          icon: "success",
          showConfirmButton: false,
          timer: 2000
        })
        update_tabel_jadwal();
        $("#btn-edit").removeClass('edit');
        $("#btn-edit").html('Edit');
        $("#btn-batal").addClass('d-none');
        $("#data-tgl-seminar").removeClass('d-none');
        $("#data-tgl-seminar").html(tgl_seminar);
        $("#data-waktu-seminar").removeClass('d-none');
        $("#data-waktu-seminar").html(waktu_seminar);
        $("#data-ruang").removeClass('d-none');
        $("#data-ruang").html(ruang);
        $(".edit-item").addClass('d-none');

        $(this).removeClass('edit');
        $(this).html('Edit');
      },
      error: function (response) {
        Swal.fire({
          title: "Error",
          text: "Jadwal Seminar mahasiswa dengan nim " + data_jadwal.nim + " Gagal Diupdate",
          icon: "error",
          showConfirmButton: false,
          timer: 2000
        })
        console.log('Error:', response);
      },
    });
  }

});

$(document).on('click', '#btn-batal', function() {
  $("#btn-edit").removeClass('edit');
  $("#btn-edit").html('Edit');
  $("#btn-batal").addClass('d-none');
  $("#data-tgl-seminar").removeClass('d-none');
  $("#data-waktu-seminar").removeClass('d-none');
  $("#data-ruang").removeClass('d-none');
  $(".edit-item").addClass('d-none');
});
